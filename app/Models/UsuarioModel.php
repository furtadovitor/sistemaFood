<?php

namespace App\Models;

use CodeIgniter\Model;

use App\Libraries\Token;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $returnType       = 'App\Entities\Usuario';
    protected $allowedFields    = ['nome', 'email','cpf', 'telefone','password','reset_hash', 'reset_expira_em'];


    //Datas
    protected $useTimestamps    = true;
    protected $createdField     = 'criado_em'; // Nome da coluna no banco de dados
    protected $updatedField     = 'atualizado_em'; // Nome da coluna no banco de dados
    protected $dateFormat = 'datetime'; //Para uso com useSoftDeletes
    protected $useSoftDeletes   = true; //preenche o campo "deletado em"
    protected $deletedField     = 'deletado_em'; // Nome da coluna no banco de dados
    

    //Validação das regras dos formulários

    protected $validationRules = [
        'nome'         => 'required|min_length[4]|max_length[120]',
        'email'        => 'required|valid_email|is_unique[usuarios.email]',
        'cpf'          => 'required|exact_length[14]|validaCpf|is_unique[usuarios.cpf]',
        'telefone'          => 'required',
        'password'      => 'required|min_length[6]',
        'confirmPassword' => 'required_with[password]|matches[password]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo nome é obrigatório.',
        ],       
        
        'email' => [
            'required' => 'O campo E-mail é obrigatório.',
            'is_unique' => 'Desculpe. Esse email já existe.',

        ],

        'cpf' => [
            'required' => 'O campo CPF é obrigatório.',
            'is_unique' => 'Desculpe. Esse cpf já existe.',

        ],
        'telefone' => [
            'required' => 'O campo Telefone é obrigatório.',
        ],
    ];

    //Pra criptografia de senhas através do campo password_hash no BD.
    
    //Eventos callback (antes de inserir e dps de inserir senha)
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data){

        if(isset($data['data']['password'])){

            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            
            unset($data['data']['password']);
            unset($data['data']['confirmPassword']);
        
        }
        return $data;
    }

    /**
    * @uso Controller usuarios no método procurar através com o autocomplete
    * @param string $term
    * @return array usuarios
    *

    */
    public function procurar($term){

        if($term === null){

            return [];
        }

        return $this->select('id, nome')
                        ->like('nome', $term)
                        ->get()
                        ->getResult();
    }

    public function desabilitaValidacaoSenha(){

        unset($this->validationRules['password']);
        unset($this->validationRules['confirmPassword']);

    }

    public function desfazerExclusao(int $id){
        

        return $this->protect(false)
        ->where('id', $id)
        ->set('deletado_em', null)
        ->update();
    }
    
    /**
     * 
     * @uso Classe/Biblioteca autenticação
     * @parametro string $email
     * @return objeto usuario 
     * 
     */
    public function buscaUsuarioPorEmail(string $email){

        return $this->where('email', $email)->first();
    }

    public function buscaUsuarioParaResetarSenha(string $token){


        $token = new Token($token);

        $tokenHash = $token->getHash();

        $usuario = $this->where('reset_hash', $tokenHash)->first();

        //Se o usuario é difereente de null, foi encontrado..

        if($usuario != null){


            //verificando se o reset_expira está expirado.

            if($usuario->reset_expira_em < date('Y-m-d H:i:s')){

                //se estiver expirado, retornada null (false)
                $usuario = null;


            }

            return $usuario;
        }
    }

  

}
