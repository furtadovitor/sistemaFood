<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Pedidos extends BaseController
{

    private $pedidoModel;
    private $entregadorModel;

    public function __construct()
    {

        $this->pedidoModel = new \App\Models\PedidoModel();
        $this->entregadorModel = new \App\Models\EntregadorModel();

    }
    public function index()
    {

        $data = [

            'titulo' => 'Pedidos realizados',
            'pedidos' => $this->pedidoModel->listaTodosOsPedidos(),
            'pager' => $this->pedidoModel->pager
        ];

        return view('Admin/Pedidos/index', $data);
        
    }

    public function show($codigoPedido = null)
    {

        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);
        
        $data = [

            'titulo' => "Detalhando o pedido $pedido->codigo",
            'pedido' => $pedido,
        ];

        return view('Admin/Pedidos/show', $data);



        
    }

    public function editar($codigoPedido = null )
    {

        $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);
        
        if($pedido->situacao == 2){

            return redirect()->back()->with('info', "O pedido $codigoPedido já foi entregue, logo é impossível editá-lo");
        }

        if($pedido->situacao == 3){

            return redirect()->back()->with('info', "O pedido $codigoPedido foi cancelado, logo é impossível editá-lo");
        }

        $data = [

            'titulo' => "Editando o pedido $pedido->codigo",
            'pedido' => $pedido,
            'entregadores' => $this->entregadorModel->select('id, nome')->where('ativo', true)->findAll()

        ];

        return view('Admin/Pedidos/editar', $data);



        
    }

    public function atualizar($codigoPedido = null)
    {
        if($this->request->getMethod() === 'post'){

            $pedido = $this->pedidoModel->buscaPedidoOu404($codigoPedido);


            if($pedido->situacao == 2){

                return redirect()->back()->with('info', "O pedido $codigoPedido já foi entregue, logo é impossível editá-lo");
            }
    
            if($pedido->situacao == 3){
    
                return redirect()->back()->with('info', "O pedido $codigoPedido foi cancelado, logo é impossível editá-lo");
            }


            $pedidoPost = $this->request->getPost();

            if(!isset($pedidoPost['situacao'])){

                return redirect()->back()->with('atencao', 'Escolha a situação do pedido');

            }

            if($pedidoPost['situacao'] == 1){

                if(strlen($pedidoPost['entregador_id']) < 1) {

                    return redirect()->back()->with('atencao', 'Se o pedido estiver saindo para entrega, escolha o entregador do pedido');
                }

            }

            if($pedido->situacao == 0){

                if($pedidoPost['situacao'] == 2) {

                    return redirect()->back()->with('atencao', 'O pedido não pode ser entregue(finalizado), pois ainda não saiu para entrega.');
                }

            }

            //desetando o entregador_id  do pedidoPost qnd o pedido for entregue

            if($pedidoPost['situacao'] != 1){

               unset($pedidoPost['entregador_id']);

            }

            //deixando nulo o entregador_id quando o pedido for cancelado
            if($pedidoPost['situacao'] == 3){

                $pedidoPost['entregador_id'] = null;
 
             }

             //usarei para orientar o admin de que o pedido foi cancelado (avisar ao entregador)
             $situacaoAnteriorPedido = $pedido->situacao;

             $pedido->fill($pedidoPost);

            
             if(!$pedido->hasChanged()){

                return redirect()->back()->with('info', 'Não há informações para serem atualizadas');

             }


             if($this->pedidoModel->save($pedido)){

                //enviado e-mail qnd o pedido sair para entrega
                if($pedido->situacao == 1){

                    $entregador = $this->entregadorModel->find($pedido->entregador_id);

                    $pedido->entregador = $entregador;

                    $this->enviaEmailPedidoSaiuEntrega($pedido);


                }

                if($pedido->situacao == 2){

                    $this->enviaEmailPedidoFoiEntregue($pedido);

                    $this->insereProdutosDoPedido($pedido);


                }

                return redirect()->to(site_url("admin/pedidos/show/$codigoPedido"))->with('sucesso', "Pedido $pedido->codigo atualizado com sucesso");



             }else{

                return redirect()->back()->with('errors_model', $this->pedidoModel->errors())->with('atencao', 'Dados inválidos, favor verificar.');
             }

            
    }else{
        return redirect()->back();
    }
  }

  private function enviaEmailPedidoSaiuEntrega(object $pedido){

    $email = service('email');

    $email->setFrom('no-reply@braseironobre.com.br', 'Braseiro Nobre');

    $email->setTo($pedido->email);

    $email->setSubject("Uhuuuuuuuuuuul!!!! Pedido $pedido->codigo saiu para entrega - Braseiro Nobre");
    
    $mensagem = view ('Admin/Pedidos/pedido_saiu_entrega_email', ['pedido' => $pedido]);

    $email->setMessage($mensagem);

    $email->send();
        
      
}

private function enviaEmailPedidoFoiEntregue(object $pedido){

    $email = service('email');

    $email->setFrom('no-reply@braseironobre.com.br', 'Braseiro Nobre');

    $email->setTo($pedido->email);

    $email->setSubject("Uhuuuuuuuuuuul!!!! Pedido $pedido->codigo Foi entregue - Braseiro Nobre");
    
    $mensagem = view ('Admin/Pedidos/pedido_foi_entregue_email', ['pedido' => $pedido]);

    $email->setMessage($mensagem);

    $email->send();
        
      
}

private function insereProdutosDoPedido(object $pedido)
{

    $pedidoProdutoModel = new \App\Models\PedidoProdutoModel();

    $produtos = unserialize($pedido->produtos);

    // Receberá o push
    $produtosDoPedido = [];

    foreach($produtos as $produto){

        array_push($produtosDoPedido, [
            
            'pedido_id' => $pedido->id,
            'produto' => $produto['nome'],
            'quantidade' => $produto['quantidade'],


        ]);
    }

    $pedidoProdutoModel->insertBatch($produtosDoPedido);
}



}
