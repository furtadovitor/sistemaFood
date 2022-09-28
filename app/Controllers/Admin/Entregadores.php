<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

use App\Entities\Entregador;

class Entregadores extends BaseController
{

    private $entregadorModel;

    public function __construct(){

        $this->entregadorModel = new \App\Models\EntregadorModel();
    }
    

    public function index()
    {
        $data = [
            'titulo' => 'Listando os entregadores',
            'entregadores' => $this->entregadorModel->withDeleted(true)->paginate(10),
            'pager' => $this->entregadorModel->pager,
        ];

        return view('Admin/Entregadores/index', $data);

    }

    public function procurar(){

        //IF para não mostrar ao usuário. Pois ele só deve ser acessado via AJAX REQUEST. 
         if(!$this->request->isAJAX()){
 
             exit('Página não encontrada');
         }
 
         $entregadores = $this->entregadorModel->procurar($this->request->getGet('term'));
 
         $retorno = [];
 
         foreach ($entregadores as $entregador) {
 
             //Esse id é do index.php de admin/entregadores dentro do else.
             //O valure é do index.php de admin/entregadores dentro do if.
 
             $data['id'] = $entregador->id;
             $data['value'] = $entregador->nome;
 
             $retorno[] = $data;
 
         }
 
         return $this->response->setJSON($retorno);
 
         /**
     * 
     * @param int $id
     * @return objeto entregador
     */ 

     }

     public function criar(){

        $entregador = new Entregador();
        
        $data = [
            'titulo' => "Cadastrando o entregador",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/criar', $data);

     }

     public function cadastrar(){

        if($this->request->getMethod() === 'post'){

            $entregador = new Entregador($this->request->getPost());

            if($this->entregadorModel->save($entregador)){

                return redirect()->to(site_url("admin/entregadores/show/" . $this->entregadorModel->getInsertID()))->with('sucesso', "Entregador $entregador->nome cadastrado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }



        }else{

            return redirect()->back();
        }


     }

     public function show($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        $data = [
            'titulo' => "Detalhando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/show', $data);

     }

     public function editar($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        $data = [
            'titulo' => "Editando o entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar', $data);

     }

     public function atualizar($id = null){

        if($this->request->getMethod() === 'post'){

            $entregador = $this->buscaEntregadorOu404($id);

            $entregador->fill($this->request->getPost());

            if(!$entregador->hasChanged()){

                return redirect()->back()->with('info', 'Não há dados para atualizar');
            }

            if($this->entregadorModel->save($entregador)){

                return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))->with('sucesso', "Entregador $entregador->nome atualizado com sucesso");
           
            }else{

                return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();


            }



        }else{

            return redirect()->back();
        }


     }

     public function editarImagem($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        if($entregador->deletado_em != null){

            return redirect()->back()->with('info', 'Não é possível editar a imagem de um entregador que já encontra-se excluído');

        }

        $data = [
            'titulo' => "Editando a imagem do entregador $entregador->nome",
            'entregador' => $entregador,
        ];

        return view('Admin/Entregadores/editar_imagem', $data);
    }

    public function upload($id = null){

        $entregador = $this->buscaEntregadorOu404($id);

        $imagem = $this->request->getFile('foto_entregador');


        //Mostrando erro caso não suba nenhuma imagem e clique em salvar 
        if(!$imagem->isValid()){

            $codigoErro = $imagem->getError();

            if($codigoErro == UPLOAD_ERR_NO_FILE){

                return redirect()->back()->with('atencao', "Nenhum arquivo foi selecionado");
            }
        }

        $tamanhoImagem = $imagem->getSizeByUnit('mb');

        if($tamanhoImagem > 2){
            

            return redirect()->back()->with('atencao', "O arquivo selecionado é muito grande. Máximo permitido é 2MB.");

        }


        $tipoImagem = $imagem->getMimeType();

        $tipoImagemLimpo = explode('/', $tipoImagem);

        $tiposPermitidos = [

            'jpeg', 'jpg', 'png', 'webp',

        ];

        if(!in_array($tipoImagemLimpo[1], $tiposPermitidos)){

            return redirect()->back()->with('atencao', "O arquivo enviado não é permitido. Arquivos permitidos: jpeg, png e webp.");

        }

        list($largura, $altura) = getimagesize($imagem->getPathName());
        

        if($largura < "400" || $altura < "400"){

            return redirect()->back()->with('atencao', "A imagem enviada não pode ser menor do que 400 x 400 pixels");

        }


        //------------------------- A partir daqui, faço o store da imagem --------------------//


        //Fazendo o store da imagem e recuperando o caminho da mesma
        $imagemCaminho = $imagem->store('entregadores');

        $imagemCaminho = WRITEPATH . 'uploads/'. $imagemCaminho;

        // Fazendo o resize da mesma imagem 
        service('image')
                ->withFile($imagemCaminho)
                ->fit(400, 400, 'center')
                ->save($imagemCaminho);



        //Ruperando a imagem antiga para excluir
        $imagemAntiga = $entregador->imagem;
           
       //Atribuindo a nova imaegm
        $entregador->imagem = $imagem->getName();

        //Atualizando a imagem do entregador
        $this->entregadorModel->save($entregador);

        //Definindo o caminho da imagem antiga 
        $caminhoImagem = WRITEPATH.'uploads/entregadores/'.$imagemAntiga;

        //Verifica se a imagem existe e é valida 
        if(is_file($caminhoImagem)){

            unlink($caminhoImagem);

        }

        return redirect()->to(site_url("admin/entregadores/show/$entregador->id"))->with('sucesso', 'Imagem alterada com sucesso.');
    }

    public function imagem(string $imagem = null){

        if($imagem){

            $caminhoImagem = WRITEPATH . 'uploads/entregadores/'. $imagem;

            $infoImagem = new \finfo(FILEINFO_MIME);

            $tipoImagem = $infoImagem->file($caminhoImagem);

            header("Content-Type: $tipoImagem");

            header("Content-Length: ".filesize($caminhoImagem));

            readfile($caminhoImagem);

            exit;
        }
    }

    public function excluir($id = null){

        //verificando se existe na base de dados

        $entregador = $this->buscaEntregadorOu404($id);


        if($this->request->getMethod() === 'post'){

            //excluindo o entregador
            $this->entregadorModel->delete($id);

  
            /**
             * 
             * Se eu quiser remover a imagem do entregador qnd excluir ele
             * 
             * if($entregador->imagem){

             *  //encontrando a imagem pelo caminho da mesma.
             *   $caminhoImagem = WRITEPATH.'uploads/entregadores/'.$entregador->imagem;
             *
             *   //Se ele tem uma imagem, estou removendo aqui no método abaixo.
             *   if(is_file($caminhoImagem)){
             *
             *       unlink($caminhoImagem);
             *
             *   }
             * }
             * 
             * 
             */
           

            return redirect()->to(site_url("admin/entregadores"))->with('sucesso', 'entregador excluído com sucesso.');


        }


        $data = [
            'titulo' => "Excluindo o entregador $entregador->nome",
            'entregador' => $entregador,

        ];
        return view('Admin/Entregadores/excluir', $data);
    }

    public function desfazerExclusao($id = null){

        //extra ta sendo criado através da recupoeração do metodo buscaextraOu404
        $entregador = $this->buscaEntregadorOu404($id);

        if($entregador->deletado_em == null){

            return redirect()->back()->with('info', 'Apenas entregadores exclúidos podem ser recuperados.');

        }

        
        if($this->entregadorModel->desfazerExclusao($id)){

            return redirect()->back()->with('sucesso', 'Exclusão desfeita com sucesso.');
        }else{

            return redirect()->back()->with('errors_model', $this->entregadorModel->errors())->with('atencao', 'Dados inválidos, favor verificar.')->withInput();

        
        }
       

    }

     private function buscaEntregadorOu404(int $id = null){

        if(!$id || !$entregador = $this->entregadorModel->withDeleted(true)->where('id', $id)->first()){

            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o entregador $id");
        }

        return $entregador;
    }
}