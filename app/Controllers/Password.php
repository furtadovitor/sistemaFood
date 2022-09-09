<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Password extends BaseController
{

    private $usuarioModel;

    public function __construct(){

        $this->usuarioModel = new \App\Models\UsuarioModel();

    }



    public function esqueci()
    {

        $data = [

            'titulo' => 'Esqueci a minha senha',

        ];

        return view('Password/esqueci', $data);
    }

    public function processaEsqueci(){

        if($this->request->getMethod() === 'post'){

            $usuario = $this->usuarioModel->buscaUsuarioPorEmail($this->request->getPost('email'));
        

            if($usuario === null || !$usuario->ativo){

                return redirect()->to(site_url('password/esqueci'))
                                 ->with('atencao', 'Não encontramos uma conta válida com esse email')
                                 ->withInput();
            
            
            }

            $usuario->iniciaPasswordReset();

            $this->usuarioModel->save($usuario);

             $this->enviaEmailRedefinicaoSenha($usuario);

             return redirect()->to(site_url('login'))->with('sucesso', 'E-mail de redefinição de senha enviado para sua caixa de entrada.');

            dd($usuario);
        }else{

            /* Não é post */

            return redirect()->back();
        }
    }

    public function reset($token = null){

        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado');

        }

        $usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);


        //SE o usuário for encontrado
        if($usuario != null){

            $data = [

                'titulo' => 'Redefina a sua senha',
                'token' => $token,

            ];

            return view('Password/reset', $data);

        //Se não for encontrado 

        }else{

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado.');

        }

    }

    //Verifica se o token não foi manipulado no form
    public function processaReset($token = null){

        if($token === null){

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado');

        }

        //Passando do if, vamos no banco e buscamos o usuario de acordo com o token

        $usuario = $this->usuarioModel->buscaUsuarioParaResetarSenha($token);


        //Se for encontrado e diferente de null
        if($usuario != null){


            //Preenchendo o objeto usuário com po método fill com todos os dados vindo do formulário

            $usuario->fill($this->request->getPost());

            //Se veio no form um campo com nome password, criptogrfa la no usuarioModel 
            if($this->usuarioModel->save($usuario)){

                /**
                 * Setando as colunasd do reset_hash e reset_expira_em como null ao invocar o método abaixo 
                 * que foi definido ENtidade USer
                 * 
                 * Invalidei o link antigo que foi enviado pra o e-mail do usuário
                 */

                 $usuario->completaPasswordReset();

                 $this->usuarioModel->save($usuario);

                return redirect()->to(site_url("login"))->with('sucesso', 'Nova senha cadastrada com sucesso.');

            }else{

                return redirect()->to(site_url("password/reset/$token"))->with('errors_model', $this->usuarioModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

            }
            

        //Se não for encontrado 

        }else{

            return redirect()->to(site_url('password/esqueci'))->with('atencao', 'Link inválido ou expirado.');

        }

    }

    private function enviaEmailRedefinicaoSenha(object $usuario){

        $email = service('email');

        $email->setFrom('no-reply@braseironobre.com.br', 'Braseiro Nobre');

        $email->setTo($usuario->email);
      //  $email->setCC('another@another-example.com');
        //$email->setBCC('them@their-example.com');

        $email->setSubject('Redefinição de senha');
        
        $mensagem = view ('Password/reset_email', ['token' => $usuario->reset_token ]);

        $email->setMessage($mensagem);

        $email->send();
            
          
    }
}
