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
            'is_admin' => true,
            'ativo' => true,

        ];

        $usuarioModel->protect(false)->insert($usuario);
    

    }
}
