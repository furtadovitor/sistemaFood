<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Produto;

class Produtos extends BaseController
{

    private $produtoModel;
    private $categoriaModel;


    public function __construct(){

        $this->produtoModel = new \App\Models\ProdutoModel();
        $this->categoriaModel = new \App\Models\CategoriaModel();


    }
    public function index()
    {
        
        $data = [

            'titulo' => 'Listando os produtos',
            'produtos' => $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
                                            ->join('categorias', 'categorias.id = produtos.categoria_id',)
                                            ->withDeleted(true)
                                            ->paginate(10),
            'pager' => $this->produtoModel->pager,
        ];

        return view('Admin/Produtos/index', $data);
    }

    public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $produtos = $this->produtoModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($produtos as $produto) {
 
             //Esse id é do index.php de admin/produtos dentro do else.
             //O valure é do index.php de admin/produtos dentro do if.
 
             $data['id'] = $produto->id;
             $data['value'] = $produto->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         
     }

     public function show($id = null){

        $produto = $this->buscaProdutoOu404($id);
       
        $data = [
            'titulo' => "Detalhando o Produto $produto->nome",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/show', $data);
    }
    public function editar($id = null){

        $produto = $this->buscaProdutoOu404($id);
       
        $data = [
            'titulo' => "Editando o Produto $produto->nome",
            'produto' => $produto,
            'categorias' => $this->categoriaModel->where('ativo', true)->findAll()
        ];

        return view('Admin/Produtos/editar', $data);
    }

    public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $produto = $this->buscaProdutoOu404($id);

            $produto->fill($this->request->getPost());//fill serve para preencher automaticamente os dados que vem do post

            //verificando se houve alteração do objeto produto 
            if(!$produto->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }
            
            if($this->produtoModel->save($produto)){

                return redirect()->to(site_url("admin/produtos/show/$id"))->with('sucesso', 'Produto atualizado com sucesso');

            }else{

                /*Erro de validação */

                return redirect()->back()->with('errors_model', $this->produtoModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

            }
        }else{

            return redirect()->back();
        }
    }

    public function editarImagem($id = null){

        $produto = $this->buscaProdutoOu404($id);

        $data = [
            'titulo' => "Editando a imagem do produto $produto->nome",
            'produto' => $produto,
        ];

        return view('Admin/Produtos/editar_imagem', $data);
    }

    public function upload($id = null){

        $produto = $this->buscaProdutoOu404($id);

        $imagem = $this->request->getFile('foto_produto');


        //Mostrando erro caso não suba nenhuma imagem e clique em salvar 
        if(!$imagem->isValid()){

            $codigoErro = $imagem->getError();

            if($codigoErro == UPLOAD_ERR_NO_FILE){

                return redirect()->back()->with('atencao', "Nenhum arquivo foi selecionado");
            }
        }

        $tamanhoImagem = $imagem->getSizeByUnit('mb');

        if($tamanhoImagem > 2){

            return redirect()->back()->with('atencao', "O arquivo selecionado é muito grande. Máximo permitido é 2MB.");

        }
        dd($imagem);

        


    }
     public function criar(){

        //produto ta sendo criado através da recupoeração do metodo buscaprodutoOu404
        $produto = new Produto();
       
        $data = [
            'titulo' => "Criando novo produto",
            'produto' => $produto,
            'categorias' => $this->categoriaModel->where('ativo', true)->findAll(),
        ];

        return view('Admin/Produtos/criar', $data);
    }

    public function cadastrar(){

        if($this->request->getMethod() === 'post'){

            $produto = new Produto($this->request->getPost());
            
            if($this->produtoModel->save($produto)){

                return redirect()->to(site_url("admin/produtos/show/" . $this->produtoModel->getInsertID()))
                                ->with('sucesso', "Produto $produto->nome cadastrado com sucesso");

            }else{

                /*Erro de validação */

                return redirect()->back()->with('errors_model', $this->produtoModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

            }
        }else{

            return redirect()->back();
        }
    }


     /**
     * 
     * @param int $id
     * @return objeto produto
     */

    private function buscaProdutoOu404(int $id = null){

        if(!$id || !$produto = $this->produtoModel->select('produtos.*, categorias.nome AS categoria')
                                                    ->join('categorias', 'categorias.id = produtos.categoria_id')
                                                    ->where('produtos.id', $id)
                                                    ->withDeleted(true)
                                                    ->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o Produto $id");
        }

        return $produto;
    }
}