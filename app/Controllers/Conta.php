<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Conta extends BaseController
{

    private $usuario;

    public function __construct() {

        $this->usuario = service('autenticacao')->pegaUsuarioLogado();
    }
    
    public function index()
    {
       
       
    }

    public function show()
    {

        $data = [

            'titulo' => 'Meus dados',
            'usuario' => $this->usuario,
        ];

        return view('Conta/show', $data);


    }

    public function editar() {

        if(!session()->has('pode_editar_ate')){

            return redirect()->to(site_url('conta/autenticar'));

        }

        if(session()->get('pode_editar_ate') < time())

        $data = [

            'titulo' => 'Editar meus dados',
            'usuario' => $this->usuario,
        ];

        return view('Conta/editar', $data);

    }

    public function autenticar()
    {

        $data = [

            'titulo' => 'Por favor, se autentique novamente.',
            'usuario' => $this->usuario,
        ];

        return view('Conta/autenticar', $data);


    }

    public function processaAutenticacao()
    {

     if($this->request->getMethod() === 'post'){

        if($this->usuario->verificaPassword($this->request->getPost('password')))
        {

            session()->set('pode_editar_ate', time()+ 300); //5 minutos

            
        return redirect()->to(site_url('conta/editar'));

        }else{

            return redirect()->back()->with('atencao', 'Senha inválida');


        }


     }else{
        return redirect()->back();
     }


    }
}
