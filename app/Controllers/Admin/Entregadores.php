<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Entregador;

class Entregadores extends BaseController
{

    private $entregadorModel;

    public function __construct(){

        $this->entregadorModel = new \App\Models\EntregadorModel();
    }
    

    public function index()
    {
        $data = [
            'titulo' => 'Listando os entregadores',
            'entregadores' => $this->entregadorModel->withDeleted(true)->paginate(10),
            'pager' => $this->entregadorModel->pager,
        ];

        return view('Admin/Entregadores/index', $data);

    }

    public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $entregadores = $this->entregadorModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($entregadores as $entregador) {
 
             //Esse id é do index.php de admin/entregadores dentro do else.
             //O valure é do index.php de admin/entregadores dentro do if.
 
             $data['id'] = $entregador->id;
             $data['value'] = $entregador->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         /**
     * 
     * @param int $id
     * @return objeto entregador
     */ 

     }

     public function show($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        $data = [
            'titulo' => "Detalhando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/show', $data);

     }

     public function editar($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        $data = [
            'titulo' => "Editando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar', $data);

     }

     public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $entregador = $this->buscaEntregadorOu404($id);

            $entregador->fill($this->request->getPost());

            if(!$entregador->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }

            if($this->entregadorModel->save($entregador)){

                return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))->with('sucesso', "Entregador $entregador->nome atualizado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }



        }else{

            return redirect()->back();
        }


     }

     private function buscaEntregadorOu404(int $id = null){

        if(!$id || !$entregador = $this->entregadorModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o entregador $id");
        }

        return $entregador;
    }
}