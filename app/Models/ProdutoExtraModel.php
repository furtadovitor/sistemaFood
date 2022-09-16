<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutoExtraModel extends Model
{
    protected $table            = 'produtos_extras';
    protected $returnType       = 'object';
    protected $allowedFields    = ['produto_id', 'extra_id'];

    protected $validationRules = [
        'extra_id'         => 'required|integer',

        
    ];
    protected $validationMessages = [
        'extra_id' => [
            'required' => 'O campo Extra é obrigatório.',
        ],       

    ];


    /**
     * @descrição: recupera os extras dos protuds em questão
     * @uso controller Admin/Produtos/extra($id)
     * #parametro int $produto_id
     * @parametro int $quantidade_paginacao
     * 
     */
    public function buscaExtrasDoProduto(int $produto_id = null, int $quantidade_paginacao = null){

        return $this->select('extras.nome AS extra, extras.preco, produtos_extras.*')
                    ->join('extras', 'extras.id = produtos_extras.extra_id')
                    ->join('produtos', 'produtos.id = produtos_extras.produto_id')
                    ->where('produtos_extras.produto_id', $produto_id)
                    ->paginate($quantidade_paginacao);

    }


}
