<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Braseiro Nobre | <?= $this->renderSection('titulo') ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>vendors/base/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo site_url('admin/'); ?>css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo site_url('admin/'); ?>images/favicon.png" />

    <!-- Essa section renderizará os estilos específicos da view que estender esse layout.-->
    <?= $this->renderSection('estilos') ?>
</head>

<body>
    <div class="container-scroller">


       <!-- Essa section renderizará os conteúdos específicos da view que estender esse layout.-->
       <?= $this->renderSection('conteudo') ?>

    
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo site_url('admin/'); ?>vendors/base/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="<?php echo site_url('admin/'); ?>js/off-canvas.js"></script>
    <script src="<?php echo site_url('admin/'); ?>js/hoverable-collapse.js"></script>
    <script src="<?php echo site_url('admin/'); ?>js/template.js"></script>
    <!-- endinject -->
    <?= $this->renderSection('scripts') ?>

</body>

</html>