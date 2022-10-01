<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Bairro;

class Bairros extends BaseController
{
    private $bairroModel;

    public function __construct()
    {

        $this->bairroModel = new \App\Models\BairroModel();
        
    }

    public function index()
    {
        
        $data = [

            'titulo' => 'Listando os bairros atendidos',
            'bairros' => $this->bairroModel->withDeleted(true)->orderBy('nome','ASC')->paginate(10),
            'pager' => $this->bairroModel->pager,

        ];

        return  view('Admin/Bairros/index', $data);
    }

     public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $bairros = $this->bairroModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($bairros as $bairro) {
 
             //Esse id é do index.php de admin/bairros dentro do else.
             //O valure é do index.php de admin/bairros dentro do if.
 
             $data['id'] = $bairro->id;
             $data['value'] = $bairro->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         
     }

     public function criar(){

        $bairro = new Bairro();

        $data = [

            'titulo' => "Cadastrando novo Bairro",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/criar', $data);

     }

     public function cadastrar(){

        if($this->request->getMethod() === 'post'){

            $bairro = new Bairro($this->request->getPost());

            //Retirando o vírgula do preço 

            $bairro->valor_entrega = str_replace(",", "", $bairro->valor_entrega);


            if($this->bairroModel->save($bairro)){

                return redirect()->to(site_url("admin/bairros/show/".$this->bairroModel->getInsertID()))
                                  ->with('sucesso', "Bairro: $bairro->nome cadastrado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->bairroModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            return redirect()->back();
        }
     }
     public function show($id = null){

        $bairro = $this->buscaBairroOu404($id);

        $data = [

            'titulo' => "Detalhando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/show', $data);

     }

     public function editar($id = null){

        $bairro = $this->buscaBairroOu404($id);

        if($bairro->deletado_em != null){
            
            return redirect()->back()->with('info', "O Bairro $bairro->nome encontra-se excluído. Logo, não é possível editá-la.");
        }

        $data = [

            'titulo' => "Editando o Bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/editar', $data);

     }

     public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $bairro = $this->buscaBairroOu404($id);

            $bairro->fill($this->request->getPost());

            //Retirando o vírgula do preço 

            $bairro->valor_entrega = str_replace(",", "", $bairro->valor_entrega);

            if(! $bairro->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar.');
            }

            if($this->bairroModel->save($bairro)){

                return redirect()->to(site_url("admin/bairros/show/$bairro->id"))
                                  ->with('sucesso', "Bairro: $bairro->nome atualizado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->bairroModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }


        }else{

            return redirect()->back();
        }
     }

     public function consultaCep(){

        if(!$this->request->isAJAX()){

            return redirect()->to(site_url());

        }


        $validacao = service('validation');

        $validacao->setRule('cep','CEP','required|exact_length[9]');
        
        $retorno = [];
        //se o cep não for válido, cair no if
        if(! $validacao->withRequest($this->request)->run()){

            $retorno['erro'] = '<span class="text-danger small">'.$validacao->getError() . '</span>';

            return $this->response->setJSON($retorno);
        }

        //formatando o cep para tirar o "-"
        $cep = str_replace('-', '', $this->request->getGet('cep'));

        //carregando o Helper Consulta CEP 

        helper('consulta_cep');
        
        $consulta = consultaCep($cep);
      

        if(isset($consulta->erro) && !isset($consulta->cep)){

            $retorno['erro'] = '<span class="text-danger small"> CEP inválido. </span>';

            return $this->response->setJSON($retorno);


        
        }


    

        $retorno['endereco'] = $consulta;

        return $this->response->setJSON($retorno);


     }

     public function excluir($id = null){

        $bairro = $this->buscaBairroOu404($id);

        if($bairro->deletado_em != null){
            
            return redirect()->back()->with('info', "O bairro $bairro->nome encontra-se excluído. Logo, não é possível editá-la.");
        }

        if($bairro->deletado_em != null){
            
            return redirect()->back()->with('info', "O bairro $bairro->nome já encontra-se excluído.");
        }


        if($this->request->getMethod() === 'post'){

            $this->bairroModel->delete($id);
            return redirect()->to(site_url('admin/bairros'))->with('sucesso', "bairro $bairro->nome excluído com sucesso.");
        }

               
        $data = [
            'titulo' => "Excluindo o bairro $bairro->nome",
            'bairro' => $bairro,
        ];

        return view('Admin/Bairros/excluir', $data);
    }

    public function desfazerExclusao($id = null){

        //bairro ta sendo criado através da recupoeração do metodo buscabairroOu404
        $bairro = $this->buscaBairroOu404($id);

        if($bairro->deletado_em == null){

            return redirect()->back()->with('info', 'Apenas bairros exclúidos podem ser recuperados.');

        }

        
        if($this->bairroModel->desfazerExclusao($id)){

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso.');
        }else{

            return redirect()->back()->with('errors_model', $this->bairroModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

        
        }
       

    }


    private function buscaBairroOu404(int $id = null){

        if(!$id || !$bairro = $this->bairroModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o Bairro $id");
        }

        return $bairro;
    }
   
}
