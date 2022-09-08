<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        
        $usuarioModel = new \App\Models\UsuarioModel;

        $usuario = 
        [

            'nome' => 'Vitor Hugo Furtado Pereira',
            'email' => 'admin@admin.com',
            'cpf' => '116.584.620-92',
            'telefone' => '21 - 99100-5822',
        ];

        $usuarioModel->protect(false)->insert($usuario);
    

    $usuario = 
    [

        'nome' => 'Fulano Hugo De TAL',
        'email' => 'fefefe@gmail.com',
        'cpf' => '447.532.240-58',
        'telefone' => '21 - 99999-5822',
    ];

    $usuarioModel->protect(false)->insert($usuario);

    dd($usuarioModel->errors());

    }
}
