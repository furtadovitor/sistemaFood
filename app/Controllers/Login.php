<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Login extends BaseController
{
    public function novo()
    
    {

        $data = [

            'titulo' => 'Realize o login',
        ];
        
        return view('Login/novo', $data);
    }

    public function criar(){

        if($this->request->getMethod() === "post"){

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $autenticacao = \Config\Services::autenticacao();
            

            if($autenticacao->login($email, $password)){

                $usuario = $autenticacao->pegaUsuarioLogado();
                

                if(!$usuario->is_admin){

                    if(session()->has('carrinho')){

                        return redirect()->to(site_url('carrinho'));

                    }
                
                    return redirect()->to(site_url('/'));

                }
                return redirect()->to(site_url('admin/home'))->with('sucesso', "Olá $usuario->nome, que bom ver você de volta.");

            }else{

                return redirect()->back()->with('atencao', 'Não encontramos suas credenciais de acesso. ');

            }




        }else{

            return redirect()->back();
        }
    }

    /**
     * Para que possamos exibir a msg "sua sessão expirou",
     * Após o logout, devemos fazer uma requisição para uma URL.
     * Pois, quando faemos o logout, todos os dados da sessão atual, incluiondo os flashdatsa são destruidos.
     * OU seja, as mensagens nunca serão exibidas.
     * 
     * Portanto, para exeibila, basta crtiarmos o método "showLogoutMessage" que fará o redirect para a Home, com a mensagem deejada.
     * 
     * E como se trata de um redirect, a mensagem só será exibida uma vez.
     */
    public function logout(){

        service('autenticacao')->logout();

        return redirect()->to(site_url('login/mostraMensagemLogout'));
    }

    public function mostraMensagemLogout(){

        return redirect()->to(site_url("login"))->with('info', 'Esperamos ver você novamente.');
    }
}
