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



                  <div class="row">

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

                      <div class="col-sm-4">

                          <input id="btn-adiciona" type="submit" class="btn btn-success btn-block "
                              value="Adicionar ao carrinho">

                      </div>


                      <!-- Colocando o botão customizavel para aparecer somento se o item for customizavel -->
                      <?php foreach($especificacoes as $especificacao): ?>

                      <?php if($especificacao->customizavel): ?>

                      <div class="col-sm-4">

                          <a href="<?php echo site_url("produto/customizar/$produto->slug"); ?>"
                              class="btn btn-primary btn-block ">Customizar</a>
                      </div>

                      <?php break; ?>
                      <?php endif; ?>
                      <?php endforeach; ?>

                      <div class="col-sm-4">

                          <a href="<?php echo site_url("/"); ?>" class="btn btn-info btn-block ">Mais produtos</a>
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

    var especificacao_id;

    //se a especificacao id não tiver valor, o botão fica desabilitado
    if (!especificacao_id) {

        $("#btn-adiciona").prop("disabled", true);

        $("#btn-adiciona").prop("value", "Selecione um valor");

    }

    $(".especificacao").on('click', function() {

        var especificacao_id = $(this).attr('data-especificacao');

        $("#especificacao_id").val(especificacao_id);

        $("#btn-adiciona").prop("disabled", false);

        $("#btn-adiciona").prop("value", "Adicionar ao carrinho");

    });

    $(".extra").on('click', function() {

        var extra_id = $(this).attr('data-extra');

        $("#extra_id").val(extra_id);


    });
});
  </script>

  <?= $this->endSection(); ?>