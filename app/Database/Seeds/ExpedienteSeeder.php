<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder usado qnd hospedar o projeto 
 */

class ExpedienteSeeder extends Seeder
{
    public function run()
    {
        
        $expedienteModel = new \App\Models\ExpedienteModel();

        $expedientes = [ 
            [

            'dia' => '0',
            'dia_descricao' => 'Domingo',
            'abertura_hora' => '18:00:00',
            'fechamento_hora' => '23:00:00',
            'situacao' => true,

            ],

            [
                
                'dia' => '1',
                'dia_descricao' => 'Segunda-Feira',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],

            [
                
                'dia' => '2',
                'dia_descricao' => 'Terça-Feira',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],

            [
                
                'dia' => '3',
                'dia_descricao' => 'Quarta-Feira',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],

            [
                
                'dia' => '4',
                'dia_descricao' => 'Quinta-Feira',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],
            [
                
                'dia' => '5',
                'dia_descricao' => 'Sexta-Feira',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],

            [
                
                'dia' => '6',
                'dia_descricao' => 'Sábado',
                'abertura_hora' => '18:00:00',
                'fechamento_hora' => '23:00:00',
                'situacao' => true,
    
            ],

                




        ];

        foreach($expedientes as $expediente){

            $expedienteModel->protect(false)->insert($expediente);
        }

        dd($expedienteModel->errors());
    }
}
