<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Checkout extends BaseController
{

    private $usuario;
    private $formaPagamentoModel;
    private $bairroModel;


    public function __construct()
    {
        $this->usuario = service('autenticacao')->pegaUsuarioLogado();
        $this->formaPagamentoModel = new \App\Models\FormaPagamentoModel();
        $this->bairroModel = new \App\Models\BairroModel();

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
       . ' - ' .  esc($consulta->uf) 
       . '  </span>';

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

        }else{

            return redirect()->back();
        }
    }

    //Funções privadas //

    private function somaValorProdutosCarrinho()
    {

        $produtosCarrinho = array_map(function($linha){

            return $linha['quantidade'] * $linha['preco'];
        }, session()->get('carrinho'));

        return array_sum($produtosCarrinho);
    }

}
