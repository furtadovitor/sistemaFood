<?php

namespace App\Models;

use CodeIgniter\Model;

class BairroModel extends Model
{
    protected $table            = 'bairros';
    protected $returnType       = 'App\Entities\Bairro';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = ['nome', 'slug', 'valor_entrega', 'ativo'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

       // Validation
       protected $validationRules = [
        'nome'         => 'required|min_length[4]|is_unique[bairros.nome]|max_length[120]',
        'valor_entrega' => 'required',

    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo nome é obrigatório.',
            'is_unique' => 'Essa Bairro já existe.',

        ], 

        'valor_entrega' => [
            'required' => 'O campo Valor de entrega é obrigatório.',
        ], 
      
        
    ];

    
    //Eventos callback (antes de inserir, chamar criaSlug dentro do modelo.)
    protected $beforeInsert = ['criaSlug'];
    protected $beforeUpdate = ['criaSlug'];

    //recebe um array data e verifica se existe um post nome vindo da view
    protected function criaSlug(array $data){

        //valida se estiver setada
        if(isset($data['data']['nome'])){

            //cria uma chave chamda "slug", a partir do nome da categoria
            $data['data']['slug'] = mb_url_title($data['data']['nome'], '-', TRUE);
            
       
        
        }
        return $data;
    }

        public function procurar($term){

            if($term === null){
    
                return [];
            }
    
            return $this->select('id, nome')
                            ->like('nome', $term)
                            ->withDeleted(true)
                            ->get()
                            ->getResult();
    }
    
        public function desfazerExclusao(int $id){
            
    
            return $this->protect(false)
            ->where('id', $id)
            ->set('deletado_em', null)
            ->update();
        }
}
        


