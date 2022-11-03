  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/conta.css"); ?>" />

  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>

  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em; min-height: 300px">


      <?php echo $this->include("Conta/sidebar"); ?>

      <div class="row" style="margin-top: 2em">

          <div class="col-md-12 col-xs-12">

              <h2 class="section-title "><?php echo esc($titulo); ?></h2>


              <div class="col-md-6">

                  <?php if(session()->has('errors_model')): ?>

                  <ul style="margin-left: -1.6em !important; list-style:decimal">
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>


                  <?php endif; ?>


                  <?php echo form_open('conta/atualizar'); ?>

                  <div class="panel panel-info">
                      <div class="panel-body">

                          <div>

                              <label>Nome completo</label>
                              <input type="text" class="form-control" name="nome"
                                  value="<?php echo old('nome', esc($usuario->nome)); ?>">

                          </div>

                          <hr>

                          <div>

                              <label>Email</label>
                              <input type="email" class="form-control" name="email"
                                  value="<?php echo old('email', esc($usuario->email)); ?>">

                          </div>


                          <hr>

                          <div>

                              <label>Telefone</label>
                              <input type="tel" class="form-control sp_celphones" name="telefone"
                                  value="<?php echo old('telefone', esc($usuario->telefone)); ?>">

                          </div>

                          <hr>

                          <div>

                              <label>CPF <i class="fa fa-lock text-warner"></i></label>
                              <div class="wel wel-sm"><?php echo old('cpf', esc($usuario->cpf)); ?></div>
                          </div>

                      </div>
                      <div class="panel-footer">

                          <button type="submit" class="btn btn-primary">Atualizar</button>

                          <a href="<?php echo site_url('conta/show'); ?>" class="btn btn-danger">Cancelar</a>

                      </div>
                  </div>
              </div>

              <?php echo form_close(); ?>


          </div>
      </div>
      <!-- end product -->
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>


  <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
  <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>




  <script>
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}
  </script>

  <?= $this->endSection(); ?>