  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal_autenticacao'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <!-- Aqui enviamos p/ template pricipal os estilos -->


  <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                  <div class="auth-form-light text-left py-5 px-4 px-sm-5">


                      <?php if(session()->has('sucesso')): ?>

                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                          <strong>Perfeito!</strong> <?= session('sucesso'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <?php endif; ?>

                      <?php if(session()->has('info')): ?>

                      <div class="alert alert-info alert-dismissible fade show" role="alert">
                          <strong>Informaçao!</strong> <?= session('info'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <?php endif; ?>

                      <?php if(session()->has('atencao')): ?>

                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Atenção!</strong> <?= session('atencao'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <?php endif; ?>

                      <!-- Captura os erros de CSRF, ação nao permitida! -->
                      <?php if(session()->has('error')): ?>

                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                          <strong>Erro!</strong> <?= session('error'); ?>
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>

                      <?php endif; ?>
                      
                      <div class="brand-logo">
                          <img src="<?php echo site_url('admin/')?>images/logo1.png" alt="logo">
                      </div>
                      <h4>Recuperando a senha!</h4>
                      <h6 class="font-weight-light mb-3">Esqueci a minha senha</h6>

                      <?= form_open('password/processaesqueci'); ?>
                      <div class="form-group">
                          <input type="email" name="email" value="<?php echo old('email'); ?>"
                              class="form-control form-control-lg" id="exampleInputEmail1"
                              placeholder="Digite o seu email">
                      </div>
                      
                      <div class="mt-3">
                          <button type="submit"
                              class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Recuperar senha</button>
                      </div>

                      <div class="mt-3 d-flex justify-content-between align-items-center">

                      <a href="<?php echo site_url('login'); ?>" class=" auth-link text-black ">Lembrei a minha senha.</a>
                  </div>
               

                  <?= form_close(); ?>

              </div>
          </div>
      </div>
  </div>
  <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->



  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>
  <!-- Aqui enviamos p/ template pricipal os scripts -->


  <?= $this->endSection(); ?>