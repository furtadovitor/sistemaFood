  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <!-- Aqui enviamos p/ template pricipal os estilos -->
  <link rel="stylesheet" href="<?php echo site_url('admin/vendors/auto-complete/jquery-ui.css'); ?>" />


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title"><?= $titulo; ?></h4>

                  <!-- Peguei do Jquery autocomplete, classe que incorpora o estilo do arquivo css do jquery. -->
                  <div class="ui-widget">
                      <input id="query" name="query" placeholder="Pesquise por uma categoria"
                          class="form-control bg-light mb-5">
                  </div>


                  <a href="<?= site_url("admin/categorias/criar"); ?>" class="btn btn-success mb-5">
                      <i class="mdi mdi-plus btn-icon-prepend"></i>
                      Cadastrar categoria
                  </a>


                  <?php if (empty($categorias)): ?>

                  <div class="alert alert-warning" role="alert">
                      <h4>Ainda não foi criada nenhuma categoria. <a href="<?= site_url("admin/categorias/criar/"); ?>" >Clique aqui</a>, caso queira criar alguma. </h4>
                  </div>

                  <?php else: ?>

                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Nome</th>
                                  <th>Data de criação</th>
                                  <th>Ativo</th>
                                  <th>Situação</th>

                              </tr>
                          </thead>
                          <tbody>

                              <?php foreach($categorias as $categoria): ?>
                              <tr>
                                  <td>
                                      <a href="<?= site_url("admin/categorias/show/$categoria->id"); ?>">
                                          <?= $categoria->nome; ?> </a>
                                  </td>
                                  <td><?= $categoria->criado_em->humanize(); ?></td>

                                  <td><?= ($categoria->ativo && $categoria->deletado_em == null? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>') ?>
                                  </td>
                                  <td>

                                      <?= ($categoria->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluído</label>') ?>

                                      <?php if($categoria->deletado_em != null): ?>

                                      <a href="<?= site_url("admin/categorias/desfazerexclusao/$categoria->id"); ?>"
                                          class="badge badge-dark ml-2">
                                          <i class="mdi mdi-undo btn-icon-prepend"></i>
                                          Desfazer
                                      </a>

                                      <?php endif; ?>

                                  </td>
                              </tr>

                              <?php endforeach; ?>

                          </tbody>
                      </table>
                      <div class="mt-3">
                          <?= $pager->links() ?>
                      </div>
                  </div>


                  <?php endif; ?>



              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>
      <!-- Aqui enviamos p/ template pricipal os scripts -->
      <script src="<?= site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>

      <script>
      $(function() {

          $("#query").autocomplete({
              source: function(request, response) {

                  $.ajax({

                      url: "<?= site_url('admin/categorias/procurar'); ?>",
                      dataType: "json",
                      data: {
                          term: request.term
                      },

                      success: function(data) {

                          if (data.length < 1) {

                              var data = [

                                  {
                                      label: 'Categoria não encontrada',
                                      value: -1
                                  }
                              ];
                          }

                          response(data); //aqui temos valor no data

                      },

                  }); // fim do ajax

              },
              minLenght: 1,
              select: function(event, ui) {

                  if (ui.item.value == -1) {

                      $(this).val("");
                      return false;

                  } else {

                      window.location.href = '<?= site_url('admin/categorias/show/'); ?>' + ui.item
                          .id;

                  }
              }

          }); //fim autocomplete


      });
      </script>


      <?= $this->endSection(); ?>