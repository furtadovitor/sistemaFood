  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-12 grid-margin stretch-card">
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



                  <?php echo form_open("admin/categorias/atualizar/$categoria->id"); ?>

                  <?= $this->include('Admin/Categorias/formulario'); ?>

                  

              
                  <?php echo form_close(); ?>



              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>

      <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
      <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>




      <?= $this->endSection(); ?>