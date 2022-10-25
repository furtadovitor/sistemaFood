<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Produto extends Entity
{
    protected $datamap = [];
    protected $dates   = ['criado_em', 'atualizado_em', 'deletado_em'];
    protected $casts   = [];

    public function combinaExtrasDosProdutos(array $extrasPrimeiroProduto, array $extrasSegundoProduto)
    {

        $extrasUnicos = [];

        $extrasCombinados = array_merge($extrasPrimeiroProduto, $extrasSegundoProduto);


        foreach ($extrasCombinados as $extra) {

            $extraExiste = (bool) in_array($extra->id, array_column($extrasUnicos, 'id'));

            if ($extraExiste == false) {

                array_push($extrasUnicos, [
                    'id' => $extra->id,
                    'nome' => $extra->nome,
                    'preco' => $extra->preco,


                ]);
            }
        }

        echo '<pre>';
        print_r($extrasUnicos);
        exit;

        return $extrasUnicos;
    }

    public function recuperaMedidasEmComum(array $especificacoesPrimeiroProduto, array $especificacoesSegundoProduto)
    {

        $primeiroArrayMedidas = [];

        foreach ($especificacoesPrimeiroProduto as $especificacao) {

            if ($especificacao->customizavel) {
                array_push($primeiroArrayMedidas, $especificacao->medida_id);
            }
        }

        $segundoArrayMedidas = [];

        foreach ($especificacoesPrimeiroProduto as $especificacao) {

            if ($especificacao->customizavel) {
                array_push($segundoArrayMedidas, $especificacao->medida_id);
            }
        }

        return array_intersect($primeiroArrayMedidas, $segundoArrayMedidas);



    }
}
