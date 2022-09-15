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



                  <?php echo form_open_multipart("admin/produtos/upload/$produto->id"); ?>

                  <div class="form-group mb-5">
                      <label>Envio de imagem</label>
                      <input type="file" name="foto_produto" class="file-upload-default">
                      <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Escolha uma imagem">
                          <span class="input-group-append">
                              <button class="file-upload-browse btn btn-danger" type="button">Escolher</button>
                          </span>
                      </div>
                  </div>




                  <button type="submit" class="btn btn-primary mr-2 btn-sm">
                      <i class="mdi mdi-check btn-icon-prepend"></i>
                      Salvar
                  </button>

                  <a href="<?= site_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-info btn-sm mr-2">
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
      <script src="<?php echo site_url('admin/js/file-upload.js'); ?>"></script>




      <?= $this->endSection(); ?>