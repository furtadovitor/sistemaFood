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


      <div class="product-content product-wrap clearfix product-deatil center-block" style="max-width: 40%">
          <div class="row">

              <div class="col-md-12">

                  <p><?php echo $titulo ?></p>

                  <?php if(session()->has('errors_model')): ?>

                  <ul style="margin-left: -1.6em !important;">
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>


                  <?php endif; ?>

                  <?php echo form_open("registrar/criar") ?>
                  <div class="form-group">
                      <label>Nome completo</label>
                      <input type="text" class="form-control" name="nome" value="<?php echo old('nome') ?>">
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" name="email" value="<?php echo old('email') ?>">
                  </div>
                  <div class="form-group">
                      <label>CPF</label>
                      <input type="text" class="cpf form-control" name="cpf" value="<?php echo old('cpf') ?>">
                  </div>
                  <div class="form-group">
                      <label>Sua senha</label>
                      <input type="password" class="form-control" name="password" placeholder="Senha">
                  </div>
                  <div class="form-group">
                      <label>Confirme sua senha</label>
                      <input type="password" class="form-control" name="confirmPassword"
                          placeholder="Confirme sua senha">
                  </div>

                  <button type="submit" class="btn btn-food" style="margin-top: 3em">Criar conta</button>
                  <?php form_close() ?>
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