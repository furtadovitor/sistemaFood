<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpedienteModel extends Model
{
    protected $table            = 'expediente';
    protected $returnType       = 'object';
    protected $allowedFields    = ['abertura_hora', 'fechamento_hora', 'situacao'];

     // Validation
     protected $validationRules = [
        'abertura_hora'         => 'required',
        'fechamento_hora'         => 'required',
    ];
    protected $validationMessages = [
        'abertura_hora' => [
            'required' => 'O Horário de abertura é obrigatório.',
            

        ], 

        'fechamento_hora' => [
            'required' => 'O Horário de fechamento é obrigatório.',
            

        ],      
        
    ];

}
