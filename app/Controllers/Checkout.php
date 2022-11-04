<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{

    private $usuario;
    private $formaPagamentoModel;
    private $bairroModel;
    private $pedidoModel;



    public function __construct()
    {
        $this->usuario = service('autenticacao')->pegaUsuarioLogado();
        $this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
        $this->bairroModel = new \App\Models\BairroModel();
        $this->pedidoModel = new \App\Models\PedidoModel();


    }
    public function index()
    {
        if(!session()->has('carrinho') || count(session()->get('carrinho')) < 1 ){

            return redirect()->to(site_url('carrinho'));
        }

        $data = [

            'titulo' => 'Finalizar pedido',
            'carrinho' => session()->get('carrinho'),
            'formas' => $this->formaPagamentoModel->where('ativo', true)->findAll(),
        ];

        return view('Checkout/index', $data);

    }

    public function consultaCep()
    {
        if(!$this->request->isAJAX()){

            return redirect()->to(site_url('/'));
        }

        $validacao = service('validation');

        $validacao->setRule('cep', 'CEP', 'required|exact_length[9]');

        if(!$validacao->withRequest($this->request)->run()){

            $retorno['erro'] = '<span class="text-danger small">'.$validacao->getError().'</span>';
       
            return $this->response->setJSON($retorno);
        }

        $cep = str_replace("-", "", $this->request->getGet('cep'));
        //carregando o helper consultaCep
        helper('consulta_cep');

        $consulta = consultaCep($cep);

       if(isset($consulta->erro) && !isset($consulta->cep)){

        $retorno['erro'] = '<span class="text-danger" small>"Informe um CEP válido"</span>';

        return $this->response->setJSON($retorno);
       }

       $bairroRetornoSlug = mb_url_title($consulta->bairro, '-', true);

       $bairro = $this->bairroModel->select('nome, valor_entrega, slug')->where('slug', $bairroRetornoSlug)->where('ativo', true)->first();
   
   
       if($consulta->bairro == null || $bairro == null){

        $retorno['erro'] = '<span class="text-danger small">Não atendemos ao Bairro: '
        . esc($consulta->bairro) 
        . ' - ' .  esc($consulta->localidade) 
        . ' - CEP ' .  esc($consulta->cep)   
        . ' - ' .  esc($consulta->uf) 
        . '  </span>';

        return $this->response->setJSON($retorno);
       }

       $retorno['valor_entrega'] = 'R$ '. esc(number_format($bairro->valor_entrega,2));

       $retorno['bairro'] = '<span class="small">Valor de entrega do Bairro: '
       . esc($consulta->bairro) 
       . ' - ' .  esc($consulta->localidade)  
       . ' - ' .  esc($consulta->uf) 
       . ' -<strong> R$  ' .  esc(number_format($bairro->valor_entrega, 2))
       . '  </span>';

       $retorno['endereco'] = esc($consulta->bairro) 
       . ' - ' .  esc($consulta->localidade)  
       . ' - ' .  esc($consulta->logradouro)  
       . ' - ' .  esc($consulta->cep)  
       . ' - ' .  esc($consulta->uf);

       $retorno['logradouro'] = $consulta->logradouro;

       $retorno['bairro_slug'] = $bairro->slug;

       $retorno['total'] = "R$ ".number_format($this->somaValorProdutosCarrinho() + $bairro->valor_entrega, 2);


       session()->set('endereco_entrega', $retorno['endereco']);

       return $this->response->setJSON($retorno);
    }

    public function processar()
    {

        if($this->request->getMethod() === 'post'){

            $checkoutPost = $this->request->getPost('checkout');

            $validacao = service('validation');

            $validacao->setRules([
                'checkout.rua' => ['label' => 'Endereço', 'rules' => 'required|max_length[60]'],
                'checkout.numero' => ['label' => 'Número', 'rules' => 'required|max_length[30]'],
                'checkout.referencia' => ['label' => 'Ponto de referência', 'rules' => 'required|max_length[50]'],
                'checkout.forma_id' => ['label' => 'Forma de pagamento na entrega', 'rules' => 'required|integer'],
                'checkout.bairro_slug' => ['label' => 'Endereço de entrega', 'rules' => 'required|string|max_length[40]'],
            ]);

            //Se o formulário não for validado, eu mostro os erros de validação
            if (!$validacao->withRequest($this->request)->run()) {

                session()->remove('endereco_entrega');

                return redirect()->back()->with('errors_model', $validacao->getErrors())->with('atencao', 'Por favor, verifique os erros abaixo e tente novamente.');
            }

            $forma = $this->formaPagamentoModel->where('id', $checkoutPost['forma_id'])->where('ativo', true)->first();

            if($forma == null){

                session()->remove('endereco_entrega');

                return redirect()->back()->with('atencao', 'Por favor, escolha uma forma de pagamento válida');
            }

            $bairro = $this->bairroModel->where('slug', $checkoutPost['bairro_slug'])->where('ativo', true)->first();

            if($bairro == null){

                session()->remove('endereco_entrega');

                return redirect()->back()->with('atencao', 'Por favor, informe o seu cep e consulte novamente a taxa de entrega');
            }

            if(!session()->get('endereco_entrega')){

                return redirect()->back()->with('atencao', 'Por favor, informe o seu cep e consulte novamente a taxa de entrega');

            }

            //Salvando o pedido // 

            $codigoPedido = $this->pedidoModel->geraCodigoPedido();

            $pedido = new \App\Entities\Pedido();

            $pedido->usuario_id = $this->usuario->id;
            $pedido->codigo = $codigoPedido;

            $pedido->forma_pagamento = $forma->nome;
            $pedido->produtos = serialize(session()->get('carrinho'));
            $pedido->valor_produtos = number_format($this->somaValorProdutosCarrinho(), 2);
            $pedido->valor_entrega = number_format($bairro->valor_entrega,2);
            $pedido->valor_pedido = number_format($pedido->valor_produtos + $pedido->valor_entrega,2);
            $pedido->endereco_entrega = session()->get('endereco_entrega').'- Número '.$checkoutPost['numero'];

            dd($pedido);
            
            if($forma->id == 1 ){

                if(isset($checkoutPost['sem_troco'])){

                    $pedido->observacoes = 'Complemento e ponto de referência: '.$checkoutPost['referencia']. ' - Número: '.$checkoutPost['numero']. '. Você informou que não precisa de troco.';
                }

                if(isset($checkoutPost['troco_para'])){

                    $trocoPara = str_replace(',', '', $checkoutPost['troco_para']);

                    //caso envie um valor vazio(string)

                    if($trocoPara < 1){

                        return redirect()->back()->with('atencao', 'Ao escolher a opção que <strong>precisa de troco</strong>, favor informar um valor mais que 0');

                    }


                    $pedido->observacoes = 'Complemento e ponto de referência: '.$checkoutPost['referencia']. ' - Número: '.$checkoutPost['numero']. '. Você informou que precisa de troco para: R$ '. number_format($trocoPara,2);

                }

            }else{
                
                //caso o cliente escolha forma de pagamento diferente de dinheiro

                $pedido->observacoes = 'Complemento e ponto de referência: '.$checkoutPost['referencia']. ' - Número: '.$checkoutPost['numero'];


            }
            



            $this->pedidoModel->save($pedido);

            $pedido->usuario = $this->usuario;

            $this->enviaEmailPedidoRealizado($pedido);

            session()->remove('carrinho');
            session()->remove('endereco_entrega');


            return redirect()->to("checkout/sucesso/$pedido->codigo");
        
            

        }else{

            return redirect()->back();
        }
    }

    public function sucesso($codigoPedido = null){

        $pedido = $this->buscaPedidoOu404($codigoPedido);

        $data = [

            'titulo' => "Pedido $codigoPedido realizado com sucesso.",
            'pedido' => $pedido,
            'produtos' => unserialize($pedido->produtos),
       
        ];

        return view('Checkout/sucesso', $data);

        
         


    }

    //Funções privadas //

    private function somaValorProdutosCarrinho()
    {

        $produtosCarrinho = array_map(function($linha){

            return $linha['quantidade'] * $linha['preco'];
        }, session()->get('carrinho'));

        return array_sum($produtosCarrinho);
    }

    public function enviaEmailPedidoRealizado(object $pedido){

        $email = service('email');

        $email->setFrom('no-reply@braseironobre.com.br', 'Braseiro Nobre');

        $email->setTo($this->usuario->email);

        $email->setSubject("Pedido $pedido->codigo realizado com sucesso - Braseiro Nobre");
        
        $mensagem = view ('Checkout/pedido_email', ['pedido' => $pedido]);

        $email->setMessage($mensagem);

        $email->send();
            
    }

    private function buscaPedidoOu404(string $codigoPedido = null){

        if(!$codigoPedido || !$pedido = $this->pedidoModel->where('codigo', $codigoPedido)                                                  
                                                    ->where('usuario_id', $this->usuario->id)
                                                    ->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o Pedido $codigoPedido");
        }

        return $pedido;
    }

}
