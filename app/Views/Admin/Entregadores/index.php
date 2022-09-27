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
                      <input id="query" name="query" placeholder="Pesquise por um usuário"
                          class="form-control bg-light mb-5">
                  </div>


                  <a href="<?= site_url("admin/entregadores/criar"); ?>" class="btn btn-success mb-5">
                      <i class="mdi mdi-plus btn-icon-prepend"></i>
                      Cadastrar usuário
                  </a>

                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Imagem</th>
                                  <th>Nome</th>
                                  <th>CPF</th>
                                  <th>Placa</th>
                                  <th>Telefone</th>
                                  <th>Ativo</th>
                                  <th>Situação</th>
                              </tr>
                          </thead>
                          <tbody>

                              <?php foreach($entregadores as $entregador): ?>
                              <tr>
                                  <td class="py-1">

                                  <?php if($entregador->imagem): ?>

                                    <img src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>" alt="<?php echo esc($entregador->nome); ?>" />


                                  <?php else: ?>

                                    <img src="<?php echo site_url("admin/images/usuario_sem_imagem.png"); ?>" alt="Entregador sem imagem" />

                                  <?php endif; ?>
                                  </td>
                                  <td>
                                      <a href="<?= site_url("admin/entregadores/show/$entregador->id"); ?>">
                                          <?= $entregador->nome; ?> </a>
                                  </td>
                                  <td><?= $entregador->cpf; ?></td>
                                  <td><?= $entregador->placa; ?></td>
                                  <td><?= $entregador->telefone; ?></td>


                                  <td><?= ($entregador->ativo && $entregador->deletado_em == null? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-danger">Não</label>') ?>
                                  </td>
                                  <td>

                                      <?= ($entregador->deletado_em == null ? '<label class="badge badge-primary">Disponível</label>' : '<label class="badge badge-danger">Excluído</label>') ?>

                                      <?php if($entregador->deletado_em != null): ?>

                                      <a href="<?= site_url("admin/entregadores/desfazerexclusao/$entregador->id"); ?>"
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

                      url: "<?= site_url('admin/entregadores/procurar'); ?>",
                      dataType: "json",
                      data: {
                          term: request.term
                      },

                      success: function(data) {

                          if (data.length < 1) {

                              var data = [

                                  {
                                      label: 'Entregador não encontrado',
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

                      window.location.href = '<?= site_url('admin/entregadores/show/'); ?>' + ui
                          .item
                          .id;

                  }
              }

          }); //fim autocomplete


      });
      </script>


      <?= $this->endSection(); ?>