<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController
{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;


    public function __construct(){

        $this->validacao = service('validation');

        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();


    }
    public function index()
    {
        //
    }

    public function adicionar()
    {

        if($this->request->getMethod() === 'post'){

            $produtoPost = $this->request->getPost('produto');

            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.especificacao_id' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.preco' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],


            ]);

            //Se o formulário não for validado, eu mostro os erros de validação
            if(! $this->validacao->withRequest($this->request)->run()){

                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor, verifique os erros abaixo e tente novamente.')->withInput();

            }

            /* validando a existência da especificacao_id*/

            $especificacaoProduto = $this->produtoEspecificacaoModel->where('id', $produtoPost['especificacao_id'])->first();

            //retornando para a index se o especificacaoProduto for nulo
            if($especificacaoProduto == null){

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 001</strong>'); //alteração no form

            }

            //caso, o extra id venha no posto, valido o extra

            if($produtoPost['extra_id'] && $produtoPost['extra_id'] !=  "" ){

                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();
            
                if($extra == null){

                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 002</strong>'); //alteração no form chave extra_id
    
            
            }
        }

        //validandos a existência do produtos 

        $produto = $this->produtoModel->where('slug', $produtoPost['slug'])->first();


        //validando a existencia do produto e se o msm está ativo
        if($produto == null || $produto->ative == false){

            return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 003</strong>'); //alteração no form na chave produto_slug

        }


        }else{

            return redirect()->back();
        }
    }
}
