  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <!-- Aqui enviamos p/ template pricipal os estilos -->


  <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body dashboard-tabs p-0">

                  <div class="tab-content py-0 px-0">
                      <div class="tab-pane fade show active" id="overview" role="tabpanel"
                          aria-labelledby="overview-tab">
                          <div class="d-flex flex-wrap justify-content-xl-between">
                              <div
                                  class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                  <i class="mdi mdi-currency-usd icon-lg mr-3 text-primary"></i>
                                  <div class="d-flex flex-column justify-content-around">
                                      <small class="mb-1 text-muted">Pedidos entregues
                                          <span
                                              class="badge badge-pill badge-primary"><?php echo $valorPedidosEntregues->total; ?></span>
                                      </small>
                                      <h5 class="mr-2 mb-0">
                                          R$&nbsp;<?php echo number_format($valorPedidosEntregues->valor_pedido, 2); ?>
                                      </h5>

                                  </div>
                              </div>
                              <div
                                  class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                  <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                                  <div class="d-flex flex-column justify-content-around">
                                      <small class="mb-1 text-muted">Pedidos Cancelados
                                          <span
                                              class="badge badge-pill badge-danger"><?php echo $valorPedidosCancelados->total; ?></span>
                                      </small>
                                      <h5 class="mr-2 mb-0">R$&nbsp;<?php echo $valorPedidosCancelados->valor_pedido; ?>
                                      </h5>
                                  </div>
                              </div>
                              <div
                                  class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                  <i class="mdi mdi-account-multiple mr-3 icon-lg text-success"></i>
                                  <div class="d-flex flex-column justify-content-around">
                                      <small class="mb-1 text-muted">Clientes Ativos</small>
                                      <h5 class="mr-2 mb-0"><?php echo $totalClientesAtivos ?></h5>
                                  </div>
                              </div>
                              <div
                                  class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                  <i class="mdi mdi-motorbike mr-3 icon-lg text-warning"></i>
                                  <div class="d-flex flex-column justify-content-around">
                                      <small class="mb-1 text-muted">Entregadores Ativos</small>
                                      <h5 class="mr-2 mb-0"><?php echo $totalEntregadoresAtivos ?></h5>
                                  </div>
                              </div>

                          </div>
                      </div>


                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">

                  <?php $expedienteHoje = expedienteHoje(); ?>

                  <?php if($expedienteHoje->situacao == false): ?>

                  <h5 class="text-info"> <i class="mdi mdi-calendar-alert"></i>&nbsp;Hoje é
                      <?php echo esc($expedienteHoje->dia_descricao); ?> e estamos fechados, logo não há novos pedidos.
                  </h5>


                  <?php else: ?>

                  <div id="atualiza">

                      <?php if(!isset($novosPedidos)): ?>

                      <h5 class="text-info">Não há novos pedidos no momento! <?php echo date('d/m/Y H:i:s'); ?></h5>

                      <?php else: ?>

                      <h6>Novos pedidos realizados</h6>

                      <hr>


                      <div class="table-responsive">
                          <table class="table table-hover">
                              <thead>
                                  <tr>
                                      <th>Código do pedido</th>
                                      <th>Valor</th>
                                      <th>Data do Pedido</th>

                                  </tr>
                              </thead>
                              <tbody>

                                  <?php foreach($novosPedidos as $pedido): ?>
                                  <tr>
                                      <td>
                                          <a href="<?= site_url("admin/pedidos/show/$pedido->codigo"); ?>">
                                              <?= $pedido->codigo; ?> </a>
                                      </td>
                                      <td>R$&nbsp;<?= esc(number_format($pedido->valor_pedido,2)); ?></td>
                                      <td><?php echo $pedido->criado_em->humanize(); ?></td>

                                  </tr>

                                  <?php endforeach; ?>




                              </tbody>
                          </table>

                      </div>

                      <?php endif; ?>

                  </div> <!-- fechando div do atualiza -->


                  <?php endif; ?>



              </div>
          </div>
      </div>
  </div>

  <div class="row">


      <div class="col-md-7 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <p class="card-title">Produtos mais vendidos</p>


                  <ul class="list-arrow">

                      <?php if (!isset($produtosMaisVendidos)): ?>

                      <p class="card-title text-info">Não há dados para exibir no momento.</p>

                      <?php else: ?>

                      <?php foreach($produtosMaisVendidos as $produto): ?>

                      <li class="mb-2">
                          <?php echo word_limiter($produto->produto, 5); ?>
                          <span
                              class="badge badge-pill badge-primary float-right"><?php echo esc($produto->quantidade); ?></span>
                      </li>
                      <?php endforeach; ?>


                      <?php endif; ?>



                  </ul>
              </div>
          </div>
      </div>

      <div class="col-md-7 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <p class="card-title">TOP clientes</p>


                  <ul class="list-arrow">

                      <?php if (!isset($clientesFieis)): ?>

                      <p class="card-title text-info">Não há dados para exibir no momento.</p>

                      <?php else: ?>

                      <?php foreach($clientesFieis as $cliente): ?>

                      <li class="mb-2">
                          <?php echo esc($cliente->nome); ?>
                          <span
                              class="badge badge-pill badge-success float-right"><?php echo esc($cliente->pedidos); ?></span>
                      </li>
                      <?php endforeach; ?>


                      <?php endif; ?>



                  </ul>
              </div>
          </div>
      </div>

      <div class="col-md-7 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <p class="card-title">TOP entregadores</p>


                  <ul class="list-unstyled">

                      <?php if (!isset($melhoresEntregadores)): ?>

                      <p class="card-title text-info">Não há dados para exibir no momento.</p>

                      <?php else: ?>

                      <?php foreach($melhoresEntregadores as $entregador): ?>

                      <li class="mb-2">
                        <img class="rounded-circle" width="40px" src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem");?>" alt="">
                          <?php echo esc($entregador->nome); ?>
                          <span
                              class="badge badge-pill badge-warning float-right"><?php echo esc($entregador->entregas); ?></span>
                      </li>
                      <?php endforeach; ?>


                      <?php endif; ?>



                  </ul>
              </div>
          </div>
      </div>


  </div>

  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>
  <!-- Aqui enviamos p/ template pricipal os scripts -->

  <script>
setInterval("atualiza()", 12000); //equivalendo a milisegundos = 2 min

function atualiza() {

    $("#atualiza").toggleClass('bg-info');
    $("#atualiza").load('<?php echo site_url('admin/home'); ?>' + ' #atualiza');
}
  </script>


  <?= $this->endSection(); ?>