<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Bairro;

class Bairros extends BaseController
{
    private $bairroModel;

    public function __construct()
    {

        $this->bairroModel = new \App\Models\BairroModel();
        
    }

    public function index()
    {
        
        $data = [

            'titulo' => 'Listando os bairros atendidos',
            'bairros' => $this->bairroModel->withDeleted(true)->paginate(10),
            'pager' => $this->bairroModel->pager,

        ];

        return  view('Admin/Bairros/index', $data);
    }

    public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $bairros = $this->bairroModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($bairros as $bairro) {
 
             //Esse id é do index.php de admin/bairros dentro do else.
             //O valure é do index.php de admin/bairros dentro do if.
 
             $data['id'] = $bairro->id;
             $data['value'] = $bairro->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         
     }
     public function show($id = null){

        $bairro = $this->buscaBairroOu404($id);

        $data = [

            'titulo' => "Detalhando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/show', $data);

     }

     public function editar($id = null){

        $bairro = $this->buscaBairroOu404($id);

        $data = [

            'titulo' => "Editando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/editar', $data);

     }

     private function buscaBairroOu404(int $id = null){

        if(!$id || !$bairro = $this->bairroModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o Bairro $id");
        }

        return $bairro;
    }
   
}
