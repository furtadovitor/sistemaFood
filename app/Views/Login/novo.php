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

                  <?php if(session()->has('errors_model')): ?>

                  <ul style="margin-left: -1.6em !important;">
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>


                  <?php endif; ?>

                  <div class="brand-logo">
                          <img src="<?php echo site_url('admin/')?>images/logo1.png" alt="logo">
                      </div>
                      <h3>Olá, seja bem vindo(a) ao Braseiro Nobre!</h3>
                      <h5 class="font-weight-light mb-3">Por favor, realize o login para continuar.</h5>
                      
                      <hr>

                  <?= form_open('login/criar'); ?>
                      <div class="form-group">
                          <input type="email" name="email" value="<?php echo old('email'); ?>"
                              class="form-control form-control-lg" id="exampleInputEmail1"
                              placeholder="Digite o seu email">
                      </div>
                      <div class="form-group">
                          <input type="password" name="password" class="form-control form-control-lg"
                              id="exampleInputPassword1" placeholder="Digite a sua senha">
                      </div>
                      <div class="text-center">
                          <button type="submit"
                              class="btn btn-food font-weight-medium auth-form-btn" style="margin-top: 3em">Entrar</button>

                      </div>

                      <hr>

                      <div class="mt-3 d-flex justify-content-between align-items-center">

                      <a href="<?php echo site_url('password/esqueci'); ?>" class=" auth-link text-black ">Esqueceu sua senha?</a>
                      
                      
                  </div>

                  <br>
                  
                  <div class="text-nowrap text-center font-weight-light">
                      Ainda não possui uma conta? <a href="<?php echo site_url('registrar') ?>"class="text-primary">Cadastre-se. </a>
                  </div>

                  <?= form_close(); ?>
              </div>

          </div>


      </div>
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>

  <?= $this->endSection(); ?>