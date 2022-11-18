  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>" />

  <style>
@media only screen and (max-width: 767px) {

    .section-title {
        font-size: 20px !important;
        margin-top: -6em !important;
    }
}
  </style>
  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>

  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
      <div class="col-sm-12 col-md-12 col-lg-12">
          <!-- product -->
          <div class="product-content product-wrap clearfix product-deatil">
              <div class="row">



                  <?php if(empty($bairros)): ?>

                  <h3 class="section-title">Não há dados para exibir</h3>


                  <?php else: ?>

                  <div class="col-md-12 col-xs-12">

                      <h2 class="section-title"><?php echo esc($titulo); ?></h2>
                  </div>

                  <?php foreach ($bairros as $bairro): ?>


                  <div class="col-md-4">
                      <div class="panel panel-default">
                          <div class="panel-heading panel-food"><?php echo esc($bairro->nome); ?> -
                              <?php echo esc($bairro->cidade); ?> </div>
                          <div class="panel-body font-food">Taxa de entrega:
                              R$&nbsp;<?php echo esc(number_format($bairro->valor_entrega)); ?></div>
                      </div>
                  </div>



                  <?php endforeach; ?>

                  <?php endif; ?>







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