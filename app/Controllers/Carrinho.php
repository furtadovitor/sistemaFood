<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Carrinho extends BaseController
{

    private $validacao;
    private $produtoEspecificacaoModel;
    private $extraModel;
    private $produtoModel;
    private $acao;


    public function __construct()
    {

        $this->validacao = service('validation');

        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->extraModel = new \App\Models\ExtraModel();
        $this->produtoModel = new \App\Models\ProdutoModel();


        $this->acao = service('router')->methodName();
    }
    public function index()
    {
        $data = [
            'titulo' => 'Meu carrinho de compras'

        ];

        if (session()->has('carrinho') && count(session()->get('carrinho')) > 0) {

            //convertendo array de objetos
            $data['carrinho'] = json_decode(json_encode(session()->get('carrinho')), false);
        }

        return view('Carrinho/index', $data);
    }

    public function adicionar()
    {

        if ($this->request->getMethod() === 'post') {


            $produtoPost = $this->request->getPost('produto');

            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.especificacao_id' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.preco' => ['label' => 'Valor do produto', 'rules' => 'required|greater_than[0]'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],


            ]);

            //Se o formulário não for validado, eu mostro os erros de validação
            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor, verifique os erros abaixo e tente novamente.')->withInput();
            }

            /* validando a existência da especificacao_id*/

            $especificacaoProduto = $this->produtoEspecificacaoModel
                ->join('medidas', 'medidas.id = produtos_especificacoes.medida_id')
                ->where('produtos_especificacoes.id', $produtoPost['especificacao_id'])
                ->first();

            //retornando para a index se o especificacaoProduto for nulo
            if ($especificacaoProduto == null) {

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 001</strong>'); //alteração no form

            }

            //caso, o extra id venha no posto, valido o extra

            if ($produtoPost['extra_id'] && $produtoPost['extra_id'] !=  "") {

                $extra = $this->extraModel->where('id', $produtoPost['extra_id'])->first();

                if ($extra == null) {

                    return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 002</strong>'); //alteração no form chave extra_id


                }
            }

            //buscando o produto como objeto
            $produto = $this->produtoModel->select(['id', 'nome', 'slug', 'ativo'])->where('slug', $produtoPost['slug'])->first();


            //validando a existencia do produto e se o msm está ativo
            if ($produto == null || $produto->ativo == false) {

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 003</strong>'); //alteração no form na chave produto_slug

            }

            //convertendo obj para array 215
            $produto = $produto->toArray();



            //Criando o slug composto para identificar ou não a existencia do item no carrinho na hora de adicionar
            $produto['slug'] = mb_url_title($produto['slug'] . '-' . $especificacaoProduto->nome . '-' . (isset($extra) ? 'com extra - ' . $extra->nome : ''), '-', true);

            //Criando o nome do produto a partir da especificaca e/ou extra
            $produto['nome'] = $produto['nome'] . ' ' . $especificacaoProduto->nome . ' ' . (isset($extra) ? 'Com extra - ' . $extra->nome : '');

            //Compondo o preço e a quantidade do produto
            $preco = $especificacaoProduto->preco + (isset($extra) ? $extra->preco : 0);

            $produto['preco'] = number_format($preco, 2);
            $produto['quantidade'] = (int) $produtoPost['quantidade'];
            $produto['tamanho'] = $especificacaoProduto->nome;

            //Removi o atributo ativo, pois não tinha utilidade
            unset($produto['ativo']);

            //Inserindo o produto no carrinho 

            if (session()->has('carrinho')) {

                //Recuperando os itens do carrinho
                $produtos = session()->get('carrinho');

                //Recuperando apenas os slugs do carrinho

                $produtosSlugs = array_column($produtos, 'slug');

                //Já existe produto no carrinho, logo incremento a quantidade
                if (in_array($produto['slug'], $produtosSlugs)) {

                    $produtos = $this->atualizaProduto($this->acao, $produto['slug'], $produto['quantidade'], $produtos);

                    //sobrescrendo a chave carrinho que existia na sessão, colocando os dados atualizaros
                    session()->set('carrinho', $produtos);
                } else {

                    //não existe no carrinho, logo eu adiciono
                    session()->push('carrinho', [$produto]);
                }
            } else {

                $produtos[] = $produto;

                session()->set('carrinho', $produtos);
            }

            return redirect()->to(site_url('carrinho'))->with('sucesso', 'Produto adicionado com sucesso!');
        } else {

            return redirect()->back();
        }
    }

    public function atualizar()
    {

        if ($this->request->getMethod() === 'post') {

            $produtoPost = $this->request->getPost('produto');

            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],
                'produto.quantidade' => ['label' => 'Quantidade', 'rules' => 'required|greater_than[0]'],


            ]);

            //Se o formulário não for validado, eu mostro os erros de validação
            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor, verifique os erros abaixo e tente novamente.')->withInput();
            }

            //Recuperando os itens do carrinho
            $produtos = session()->get('carrinho');

            //Recuperando apenas os slugs do carrinho

            $produtosSlugs = array_column($produtos, 'slug');

            if (!in_array($produtoPost['slug'], $produtosSlugs)) {

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 004</strong>'); //alteração no form na chave produto_slug

            }else{

                //Produto validado.. atualizando a quantidade do carrinho 
            
            $produtos = $this->atualizaProduto($this->acao, $produtoPost['slug'], $produtoPost['quantidade'], $produtos);

            //sobrescrendo a chave carrinho que existia na sessão, colocando os dados atualizaros
            session()->set('carrinho', $produtos);

            return redirect()->back()->with('sucesso', 'Quantidade atualizada com sucesso.');

        }

        }else{
            return redirect()->back();
        }
    }

    public function remover()
    {

        if ($this->request->getMethod() === 'post') {

            $produtoPost = $this->request->getPost('produto');

            $this->validacao->setRules([
                'produto.slug' => ['label' => 'Produto', 'rules' => 'required|string'],

            ]);

            //Se o formulário não for validado, eu mostro os erros de validação
            if (!$this->validacao->withRequest($this->request)->run()) {

                return redirect()->back()->with('errors_model', $this->validacao->getErrors())->with('atencao', 'Por favor, verifique os erros abaixo e tente novamente.')->withInput();
            }

            //Recuperando os itens do carrinho
            $produtos = session()->get('carrinho');

            //Recuperando apenas os slugs do carrinho

            $produtosSlugs = array_column($produtos, 'slug');

            if (!in_array($produtoPost['slug'], $produtosSlugs)) {

                return redirect()->back()->with('fraude', 'Não conseguimos processar a sua solicitação. Favor entrar em contato com a equipe informando o código de erro <strong>ERRO - 004</strong>'); //alteração no form na chave produto_slug

            }else{

                $produtos = $this->removeProduto($produtos, $produtoPost['slug']);

                /* atualizei o carrinho na sessão com o array $produtos sem o item que foi deletado */
                session()->set('carrinho', $produtos);

            return redirect()->back()->with('sucesso', 'Produto removido do carrinho de compras.');

        }

        }else{
            return redirect()->back();
        }
    }

    public function limparCarrinho(){
        
        session()->remove('carrinho');

        return redirect()->to(site_url('carrinho'));
    }
    private function atualizaProduto(string $acao, string $slug, int $quantidade, array $produtos)
    {

        $produtos = array_map(function ($linha) use ($acao, $slug, $quantidade) {

            if ($linha['slug'] == $slug) {

                if ($acao === 'adicionar') {

                    $linha['quantidade'] += $quantidade;
                }

                if ($acao === 'atualizar') {

                    $linha['quantidade'] = $quantidade;
                }
            }

            return $linha;
        }, $produtos);

        return $produtos;
    }

    private function removeProduto(array $produtos, string $slug){

        return array_filter($produtos, function ($linha) use ($slug){

            return $linha['slug'] != $slug;

        });
    }
}