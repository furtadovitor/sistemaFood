  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>" />

  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>

  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
      <div class="col-sm-12 col-md-12 col-lg-12">
          <!-- product -->
          <div class="product-content product-wrap clearfix product-deatil">
              <div class="row">

                  <h2 class="name" style="margin-bottom: 1em">

                      <?php echo esc($titulo); ?>

                  </h2>




                  <?php echo form_open("carrinho/especial"); ?>



                  <div class="row" style="min-height:300px">

                      <div class="col-md-12">


                          <?php if(session()->has('errors_model')): ?>

                          <ul style="margin-left: -1.6em !important; list-style:decimal">
                              <?php foreach(session('errors_model') as $error) : ?>

                              <li class="text-danger"><?php echo $error ?></li>

                              <?php endforeach; ?>
                          </ul>


                          <?php endif; ?>



                      </div>

                      <div class="col-md-6" style="margin-bottom: 2em">

                          <label>Escolha o seu produto</label>

                          <select id="primeira_metade" class="form-control" name="primeira_metade">

                              <option>Escolha seu produto...</option>

                              <?php foreach ($opcoes as $opcao): ?>

                              <option value="<?php echo $opcao->id; ?>"><?php echo esc($opcao->nome); ?></option>


                              <?php endforeach; ?>

                          </select>



                      </div>

                      <div class="col-md-6" style="margin-bottom: 2em">

                          <label>Segunda metade</label>

                          <select id="segunda_metade" class="form-control" name="segunda_metade">

                             <!-- Aqui será renderizada as pções de metade via js -->
                             
                          </select>



                      </div>

                  </div>

                  <div class="row">

                      <div class="col-sm-2">

                          <input id="btn-adiciona" type="submit" class="btn btn-success "
                              value="Adicionar ao carrinho">

                      </div>

                      <div class="col-sm-2">

                          <a href="<?php echo site_url("produto/detalhes/$produto->slug"); ?>" class="btn btn-info  ">Voltar</a>
                      </div>
                  </div>

                  <?php echo form_close(); ?>
              </div>
          </div>
      </div>
      <!-- end product -->
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>

  <script>
$(document).ready(function() {
  

    $("#btn-adiciona").prop("disabled", true);

    $("#btn-adiciona").prop("value", "Selecione um tamanho");

    

    $("#primeira_metade").on('change', function() {


        var primeira_metade = $(this).val();

        var categoria_id = '<?php echo $produto->categoria_id ?>';

        if(primeira_metade){

            $.ajax({

                type: 'get',
                url: '<?php echo site_url('produto/procurar'); ?>',
                dataType: 'json',
                data: {
                  primeira_metade: primeira_metade,
                  categoria_id: categoria_id,  
                },

                success: function(data){


                },
        });

        

        }else{

            /*Cliente não escolheu a 1 metade */
        }
        

    });


});
  </script>

  <?= $this->endSection(); ?>