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
                      <input id="query" name="query" placeholder="Pesquise por um pedido (código)"
                          class="form-control bg-light mb-5">
                  </div>

                  <?php if(!isset($pedidos)): ?>

                    <p>Não há pedidos</p>

                  <?php else: ?>

                  <?php endif; ?>
                


                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Código do pedido</th>
                                  <th>Data do pedido</th>
                                  <th>Cliente</th>
                                  <th>Valor</th>
                                  <th>Situação</th>
                                  
                              </tr>
                          </thead>
                          <tbody>

                              <?php foreach($pedidos as $pedido): ?>
                              <tr>
                                  <td>
                                      <a href="<?= site_url("admin/pedidos/show/$pedido->codigo"); ?>">
                                          <?= $pedido->codigo; ?> </a>
                                  </td>

                                  <td><?php echo $pedido->criado_em->humanize(); ?></td>
                                  <td><?php echo $pedido->cliente; ?></td>

                                  <td>R$&nbsp;<?= esc(number_format($pedido->valor_pedido,2)); ?></td>

                                  <td><?php $pedido->exibeSituacaoPedido(); ?></td>

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

                      url: "<?= site_url('admin/pedidos/procurar'); ?>",
                      dataType: "json",
                      data: {
                          term: request.term
                      },

                      success: function(data) {

                          if (data.length < 1) {

                              var data = [

                                  {
                                      label: 'Pedido não encontrado',
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

                      window.location.href = '<?= site_url('admin/pedidos/show/'); ?>' + ui.item
                          .value;

                  }
              }

          }); //fim autocomplete


      });
      </script>


      <?= $this->endSection(); ?>