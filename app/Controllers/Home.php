<?php

namespace App\Controllers;

class Home extends BaseController
{

    private $categoriaModel;
    private $produtoModel;

    public function __construct(){

        $this->categoriaModel = new \App\Models\CategoriaModel();
        $this->produtoModel = new \App\Models\ProdutoModel();


    }
    public function index()
    {

        $data = [

            'titulo' =>'Seja bem vindo(a)!',
            'categorias' => $this->categoriaModel->buscaCategoriasSiteHome(),
            'produtos' => $this->produtoModel->buscaProdutosSiteHome(),
        ];

        return view('Home/index', $data);
    }

}
