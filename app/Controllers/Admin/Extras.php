<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Extra;

class Extras extends BaseController
{

    private $extraModel;

    public function __construct(){

        $this->extraModel = new \App\Models\ExtraModel();

    }
    public function index()
    {
        
        $data = [

            'titulo' => 'Listando os extras de produtos:',
            'extras' => $this->extraModel->withDeleted(true)->paginate(10),
            'pager' => $this->extraModel->pager,
        ];

        return view('Admin/Extras/index', $data);
    }

    public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $extras = $this->extraModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($extras as $extra) {
 
             //Esse id é do index.php de admin/extras dentro do else.
             //O valure é do index.php de admin/extras dentro do if.
 
             $data['id'] = $extra->id;
             $data['value'] = $extra->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         
     }
     public function criar(){

        //extra ta sendo criado através da recupoeração do metodo buscaExtraOu404
        $extra = new Extra();
       
        $data = [
            'titulo' => "Detalhando o Extra $extra->nome",
            'extra' => $extra,
        ];

        return view('Admin/Extras/criar', $data);
    }

    public function cadastrar(){

        if($this->request->getMethod() === 'post'){

            $extra = new Extra($this->request->getPost());          

            if($this->extraModel->save($extra)){

                return redirect()->to(site_url("admin/extras/show/".$this->extraModel->getInsertID()))->with('sucesso', "Extra: $extra->nome cadastrado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->extraModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            /* Não é post */

            return redirect()->back();

        }
    }

    public function excluir($id = null){

        $extra = $this->buscaEXtraOu404($id);

        if($extra->deletado_em != null){
            
            return redirect()->back()->with('info', "O Extra $extra->nome já encontra-se excluído.");
        }


        if($this->request->getMethod() === 'post'){

            $this->extraModel->delete($id);
            return redirect()->to(site_url('admin/extras'))->with('sucesso', "Extra $extra->nome excluído com sucesso.");
        }

               
        $data = [
            'titulo' => "Excluindo o extra $extra->nome",
            'extra' => $extra,
        ];

        return view('Admin/Extras/excluir', $data);
    }

    public function desfazerExclusao($id = null){

        //extra ta sendo criado através da recupoeração do metodo buscaextraOu404
        $extra = $this->buscaextraOu404($id);

        if($extra->deletado_em == null){

            return redirect()->back()->with('info', 'Apenas extras exclúidos podem ser recuperados.');

        }

        
        if($this->extraModel->desfazerExclusao($id)){

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso.');
        }else{

            return redirect()->back()->with('errors_model', $this->extraModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

        
        }
       

    }


     public function show($id = null){

        $extra = $this->buscaExtraOu404($id);
       
        $data = [
            'titulo' => "Detalhando o Extra $extra->nome",
            'extra' => $extra,
        ];

        return view('Admin/Extras/show', $data);
    }
    public function editar($id = null){

        //extra ta sendo criado através da recupoeração do metodo buscaextraOu404
        $extra = $this->buscaExtraOu404($id);

        
       
        if($extra->deletado_em != null){
            
            return redirect()->back()->with('info', "O Extra $extra->nome encontra-se excluído. Logo, não é possível editá-lô.");
        }
        $data = [
            'titulo' => "Editando o Extra $extra->nome",
            'extra' => $extra,
        ];

        return view('Admin/Extras/editar', $data);
    }

    public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $extra = $this->buscaExtraOu404($id);


            if($extra->deletado_em != null){
            
                return redirect()->back()->with('info', "O Extra $extra->nome encontra-se excluído. Logo, não é possível editá-la.");
            }

            
            $extra->fill($this->request->getPost());

            //se não for alterado nada na edição.
            if(!$extra->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar.');
            }

           

            if($this->extraModel->save($extra)){

                return redirect()->to(site_url("admin/extras/show/$extra->id"))->with('sucesso', "Extra: $extra->nome atualizado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->extraModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            /* Não é post */

            return redirect()->back();

        }
    }

     /**
     * 
     * @param int $id
     * @return objeto usuário
     */

    private function buscaExtraOu404(int $id = null){

        if(!$id || !$extra = $this->extraModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o Extra $id");
        }

        return $extra;
    }
}
