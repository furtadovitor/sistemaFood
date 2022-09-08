  <!-- Extendendo o layout principal --> 
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>

  
  
  
  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>


  
  
  
  <?= $this->section('conteudo'); ?>
    <!-- Aqui enviamos p/ template pricipal os estilos -->

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>



  

    
  <?= $this->section('scripts'); ?>
    <!-- Aqui enviamos p/ template pricipal os scripts -->


  <?= $this->endSection(); ?>