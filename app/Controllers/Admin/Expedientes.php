<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Expedientes extends BaseController
{

    private $expedienteModel;

    public function __construct()
    {
        $this->expedienteModel = new \App\Models\ExpedienteModel();
        
    }

    public function expedientes()
    {


        if($this->request->getMethod() === 'post'){

            $postExpedientes = $this->request->getPost();

            $arrayExpedientes = [];

            //for para percorrer o array dos dias da seman de funcionamento
            for($contador = 0;$contador < count($postExpedientes['dia_descricao']); $contador++){

                array_push($arrayExpedientes, [

                    'dia_descricao' => $postExpedientes['dia_descricao'][$contador],
                    'abertura_hora' => $postExpedientes['abertura_hora'][$contador],
                    'fechamento_hora' => $postExpedientes['fechamento_hora'][$contador],
                    'situacao' => $postExpedientes['situacao'][$contador],

                ]);

            }


            //fazendo a atualização no banco de dados

            $this->expedienteModel->updateBatch($arrayExpedientes, 'dia_descricao');

            return redirect()->back()->with('sucesso', 'Expedientes atualizados com sucesso.');
        }

        //Get, pois isso retorno a View
        $data = [

            'titulo' => 'Gerenciar o horário de funcionamento',
            'expedientes' => $this->expedienteModel->findAll(),

        ];

        return view('Admin/Expedientes/expedientes', $data);
        

    }
}
