<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Usuario;

class Usuarios extends BaseController
{

    private $usuarioModel;

    public function __construct(){

        $this->usuarioModel = new \App\Models\UsuarioModel();

    }
    public function index()
    {

        $usuario = service('autenticacao');

        $data = [

            'titulo' => 'Listando os usuários:',
            'usuarios' => $this->usuarioModel->withDeleted(true)->paginate(10),
            'pager' => $this->usuarioModel->pager,
        ];

        

        return view('Admin/Usuarios/index', $data);
        
    }

    //Função criada pq temos um JS na view de usuários que fará um GET para esse método procurar
    public function procurar(){

       //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
        if(!$this->request->isAJAX()){

            exit('Página não encontrada');
        }

        $usuarios = $this->usuarioModel->procurar($this->request->getGet('term'));

        $retorno = [];

        foreach ($usuarios as $usuario) {

            //Esse id é do index.php de admin/usuarios dentro do else.
            //O valure é do index.php de admin/usuarios dentro do if.

            $data['id'] = $usuario->id;
            $data['value'] = $usuario->nome;

            $retorno[] = $data;

        }

        return $this->response->setJSON($retorno);

        
    }

    public function criar(){

        $usuario = new Usuario();

                      
       
        $data = [
            'titulo' => "Criando um novo usuário.",
            'usuario' => $usuario,
        ];

        return view('Admin/Usuarios/criar', $data);
    }

    public function cadastrar(){

        if($this->request->getMethod() === 'post'){

            $usuario = new Usuario($this->request->getPost()); 
                      

            if($this->usuarioModel->protect(false)->save($usuario)){

                return redirect()->to(site_url("admin/usuarios/show/".$this->usuarioModel->getInsertID()))->with('sucesso', "Usuário $usuario->nome cadastrado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            /* Não é post */

            return redirect()->back();

        }
    }

    public function show($id = null){

        //usuario ta sendo criado através da recupoeração do metodo buscaUsuarioOu404
        $usuario = $this->buscaUsuarioOu404($id);

        
       
        $data = [
            'titulo' => "Detalhando o usuário $usuario->nome",
            'usuario' => $usuario,
        ];

        return view('Admin/Usuarios/show', $data);
    }


    public function editar($id = null){

        //usuario ta sendo criado através da recupoeração do metodo buscaUsuarioOu404
        $usuario = $this->buscaUsuarioOu404($id);

        
       
        if($usuario->deletado_em != null){
            
            return redirect()->back()->with('info', "O usuário $usuario->nome encontra-se excluído. Logo, não é possível editá-lô.");
        }
        $data = [
            'titulo' => "Editando o usuário $usuario->nome",
            'usuario' => $usuario,
        ];

        return view('Admin/Usuarios/editar', $data);
    }

    public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $usuario = $this->buscaUsuarioOu404($id);

            $post = $this->request->getPost();

            if($usuario->deletado_em != null){
            
                return redirect()->back()->with('info', "O usuário $usuario->nome encontra-se excluído. Logo, não é possível editá-lô.");
            }

            if(empty($post['password'])){

                $this->usuarioModel->desabilitaValidacaoSenha();
                unset($post['password']);
                unset($post['confirmPassword']);
                
            }
            
            $usuario->fill($post);

            //se não for alterado nada na edição.
            if(!$usuario->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar.');
            }

           

            if($this->usuarioModel->protect(false)->save($usuario)){

                return redirect()->to(site_url("admin/usuarios/show/$usuario->id"))->with('sucesso', "Usuário $usuario->nome atualizado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            /* Não é post */

            return redirect()->back();

        }
    }

    public function excluir($id = null){

        $usuario = $this->buscaUsuarioOu404($id);

        if($usuario->deletado_em != null){
            
            return redirect()->back()->with('info', "O usuário $usuario->nome já encontra-se excluído.");
        }

        if($usuario->is_admin){

            return redirect()->back()->with('info', 'Não é possível excluir um usuário <b> ADMINISTRADOR </b>');

        }

        if($this->request->getMethod() === 'post'){

            $this->usuarioModel->delete($id);
            return redirect()->to(site_url('admin/usuarios'))->with('sucesso', "Usuário $usuario->nome excluído com sucesso.");
        }

               
        $data = [
            'titulo' => "Excluindo o usuário $usuario->nome",
            'usuario' => $usuario,
        ];

        return view('Admin/Usuarios/excluir', $data);
    }

    public function desfazerExclusao($id = null){

        //usuario ta sendo criado através da recupoeração do metodo buscaUsuarioOu404
        $usuario = $this->buscaUsuarioOu404($id);

        if($usuario->deletado_em == null){

            return redirect()->back()->with('info', 'Apenas usuários exclúidos podem ser recuperados.');

        }

        
        if($this->usuarioModel->desfazerExclusao($id)){

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso.');
        }else{

            return redirect()->back()->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

        
        }
       

    }



    /**
     * 
     * @param int $id
     * @return objeto usuário
     */

    private function buscaUsuarioOu404(int $id = null){

        if(!$id || !$usuario = $this->usuarioModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
        }

        return $usuario;
    }
}
