  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>" />

  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>



  <div class="container section " id="menu" data-aos="fade-up" style="margin-top: 3em">


      <div class="product-content product-wrap clearfix product-deatil center-block">
          <div class="row">

              <div class="col-md-12">

                  <div class="alert alert-success" role="alert" style="margin-top: 2em">
                      <h4 class="alert-heading">Sucesso!</h4>
                      <p><?php echo $titulo ?> 
                      </p>
                      <hr>
                      <p class="mb-0">Verifique sua caixa de entrada para ativar a sua conta.</p>
                  </div>
              </div>

          </div>
      </div>
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>
  <script src="https://kit.fontawesome.com/2a6efc6cee.js" crossorigin="anonymous"></script>
  <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
  <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>



  <?= $this->endSection(); ?>