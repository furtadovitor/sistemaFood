  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <?php if(session()->has('errors_model')): ?>

                  <ul>
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>


                  <?php endif; ?>



                  <?php echo form_open("admin/bairros/cadastrar"); ?>

                  <?= $this->include('Admin/Bairros/formulario'); ?>

                  <a href="<?= site_url("admin/bairros"); ?>" class="btn btn-info btn-sm mr-2">
                      <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                      Voltar
                  </a>


             
                  <?php echo form_close(); ?>



              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>

      <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
      <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>
      
      <!-- script do viaCep -->
      <script>

        //Desabilitando o botão do submit
        $("#btn-salvar").prop('disabled', true);

        //pegando o valor do campo cep
        $('[name=cep]').focusout(function(){

            var cep = $(this).val();

        //preparando o ajax request

        $.ajax({

            //definindo tipo da requisião e url
            type: 'get',
            url: '<?php echo site_url('admin/bairros/consultacep'); ?>',
            dataType: 'json',
            data: {
                cep: cep
            },
                beforeSend: function(){
                    $("$cep").html('Consultando...');
                

                //limpando os campos cidades, etc..

                $('[name=nome]').val('');
                $('[name=cidade]').val('');
                $('[name=estado]').val('');

                $("#btn-salvar").prop('disabled', true);


            },

            //definindo o success em caso de sucesso na requisição

            success: function(response) {

                //verificando se existe algum erro

                if(!response.erro){

                    /* Sucesso .. */

                     $('[name=nome]').val(response.endereco.bairro);
                     $('[name=cidade]').val(response.endereco.cidade);
                     $('[name=estado]').val(response.endereco.uf);

                     $("#btn-salvar").prop('disabled', false);
                     $("$cep").html('');


                }else{

                    /* Existem erros de validação, cep não encontradoo */
               
                    $("$cep").html(response.erro);

               
                }



            }, // fim do success

            error: function(){

                alert("Não foi possível consultar o CEP. Favor entrar em contato com o suporte técnico.")
                $("#btn-salvar").prop('disabled', true)              

            },
            
        });
           
    });



      </script>                 



      <?= $this->endSection(); ?>