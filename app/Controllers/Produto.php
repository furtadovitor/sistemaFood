<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Produto extends BaseController
{

    private $produtoModel;
    private $produtoEspecificacaoModel;
    private $produtoExtraModel;

    public function __construct()
    {

        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->produtoEspecificacaoModel = new \App\Models\ProdutoEspecificacaoModel();
        $this->produtoExtraModel = new \App\Models\ProdutoExtraModel();

        
    }
    public function detalhes(string $produto_slug = null)
    {
       
        //se cair no if, é pq não foi informado o slug ou foi alterado na url

        if(!$produto_slug || !$produto = $this->produtoModel->where('slug', $produto_slug)->where('ativo',true)->first()){

            return redirect()->to(site_url('/'));
        }

        $data = [

            'titulo' => "Detalhando o produto $produto->nome",
            'produto' => $produto,
            'especificacoes' => $this->produtoEspecificacaoModel->buscaEspecificacoesDoProdutoDetalhes($produto->id),
                
        ];

        //Verificando se há extras 

        $extras = $this->produtoExtraModel->buscaExtrasDoProdutoDetalhes($produto->id);

        if($extras){

            $data['extras'] = $extras;

        }

        

        return view ('Produto/detalhes', $data);



        
    }

    public function customizar(string $produto_slug = null)
    {

        if(!$produto_slug || !$produto = $this->produtoModel->where('slug', $produto_slug)->where('ativo',true)->first()){

            return redirect()->back();
        }

        if(! $this->produtoEspecificacaoModel->where('produto_id', $produto->id)->where('customizavel', true)->first()){

            return redirect()->back()->with('info', "O produto <strong>$produto->nome</strong> não pode ser vendido com nenhuma especificação.");

        }

        $data = [

            'titulo' => "Customizando o produto $produto->nome",
            'produto' => $produto,
            'especificacoes' => $this->produtoEspecificacaoModel->buscaEspecificacoesDoProdutoDetalhes($produto->id),
            'opcoes'  => $this->produtoModel->exibeOpcoesProdutosParaCustomizar($produto->categoria_id),    
        ];


        return view('Produto/customizar', $data);

     
    }
      
    public function imagem(string $imagem = null){

        if($imagem){

            $caminhoImagem = WRITEPATH . 'uploads/produtos/'. $imagem;

            $infoImagem = new \finfo(FILEINFO_MIME);

            $tipoImagem = $infoImagem->file($caminhoImagem);

            header("Content-Type: $tipoImagem");

            header("Content-Length: ".filesize($caminhoImagem));

            readfile($caminhoImagem);

            exit;
        }
    }
    
}
