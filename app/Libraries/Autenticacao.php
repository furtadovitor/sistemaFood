<?php 


namespace App\Libraries;

/*
* Essa biblioteca/classe cuidará da parte de autenticação na nossa aplicação.
*
*/

class Autenticacao{



    private $usuario;

    public function login(string $email, string $password){

        $usuarioModel = new \App\Models\UsuarioModel();

        $usuario = $usuarioModel->buscaUsuarioPorEmail($email);

        /** SE não encontrar o usuário por e-mail, retornar falso. */
        if($usuario === null){
            return false;

        }

    

      /** SE a senha não combinar com o password hash, retornar falso. */

    if(!$usuario->verificaPassword($password)){

        return false;
    }

    /** 
     * Só permitiremos o login de usuarios ativos
     */

     if(!$usuario->ativo){
        return false;
     }


     /** Aqui está tudo certo e podemos logar o usuário na aplicação, invocando o método abaixo. */
     $this->logaUsuario($usuario);

     return true;

  }  

    public function logout(){

        session()->destroy();
    }

    public function pegaUsuarioLogado(){

        /* 
        * COmpartilhar a instãncia com services
        *
         */
        if($this->usuario === null){

            $this->usuario = $this->pegaUsuarioSessao();

        }

        /*Retornando o usuário que foi definido no inicio da classe */

        return $this->usuario;
    }

    /**
     * Método só permite ficar logado na aplicação aquele que ainda exister na base
     * e que do contrário, será feito o logout do mesmo, caso haja uma mudança na conta
     * durante a sessão.
     * 
     * retorna true se o método pegaUsuarioLogado() não for null. Ou seja, se o usuário estiver logdo.
     * 
     */
    public function estarLogado(){

        return $this->pegaUsuarioLogado() !== null;
    }

    private function pegaUsuarioSessao(){

        if(!session()->has('usuario_id')){
            return null;
        }

        /**Instanciando o model usuário */

        $usuarioModel = new \App\Models\UsuarioModel();


        /*Recupero o usuário de acordo como a chave da sessão usuario_id */
        $usuario = $usuarioModel->find(session('usuario_id'));

        /*Só retorno o obj usuario se o mesmo for encontrado e estiver ativo */
        if($usuario && $usuario->ativo){

            return $usuario;
        }
    }




/**
 * Credenciaais validaddas, regeneramos a session_id e inserimos o usuario_id na sessão
 * 
 * param object, $usuario
 * 
 * Antes de inserirmos os dados do usuário na sessão, devemos regenerar o ID da sessão.
 * Pois, quando carregamos a view pela primeira vez, o valor da variável 'ci_session' do debug toolbar é um,
 * quando é realizado o loigin, o valor muda.
 * Ao fazermos isso, estamos prevenindo sessio lixation attack.
 * 
 */


  


       private function logaUsuario(object $usuario){

        $session = session();
        $session->regenerate();
        $session->set('usuario_id', $usuario->id);
       }

  
  
}