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

          </div>
          <div class="col-md-12">

              <?php if(!isset($pedidos)): ?>

              <h4>Nessa área, aparecerá o seu histórico de pedidos:</h4>

              <?php else: ?>

              <?php foreach($pedidos as $key => $pedido): ?>

              <div class="panel-group">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapse<?php echo $key; ?>">Pedido
                                  <?php echo esc($pedido->codigo); ?> - Relizado
                                  <?php echo esc($pedido->criado_em->humanize()); ?></a>
                          </h4>
                      </div>
                      <div id="collapse<?php echo $key; ?>" class="panel-collapse collapse">
                          <div class="panel-body">

                          <h5>Situação do pedido: <?php echo $pedido->exibeSituacaoPedido() ?></h5>

                          <?php $produtos = unserialize($pedido->produtos); ?>

                              <ul class="list-group">


                                  <?php foreach ($produtos as $produto) : ?>

                                  <li class="list-group-item">
                                      <div>

                                          <h4><?php echo ellipsize($produto['nome'], 100); ?></h4>
                                          <p class="text-muted">Quantidade: <?php echo $produto['quantidade']; ?></p>
                                          <p class="text-muted">Preço: <?php echo $produto['preco']; ?></p>

                                      </div>
                                  </li>

                                  <?php endforeach; ?>

                                  <li class="list-group-item">

                                      <span>Data do pedido:</span>
                                      <strong><?php echo $pedido->criado_em->humanize(); ?></strong>

                                  </li>


                                  <li class="list-group-item">

                                      <span>Total de produtos:</span>
                                      <strong><?php echo 'R$&nbsp' . number_format($pedido->valor_produtos, 2); ?></strong>

                                  </li>

                                  <li class="list-group-item">

                                      <span>Taxa de entrega:</span>
                                      <strong><?php echo 'R$&nbsp' . number_format($pedido->valor_entrega, 2); ?></strong>

                                  </li>

                                  <li class="list-group-item">

                                      <span>Valor final do pedido:</span>
                                      <strong><?php echo 'R$&nbsp' . number_format($pedido->valor_pedido, 2); ?></strong>

                                  </li>


                                  <li class="list-group-item">

                                      <span>Endereço de entrega:</span>
                                      <strong><?php echo esc($pedido->endereco_entrega); ?></strong>

                                  </li>


                                  <li class="list-group-item">

                                      <span>Forma de pagamento na entrega:</span>
                                      <strong><?php echo esc($pedido->forma_pagamento); ?></strong>

                                  </li>

                                  <li class="list-group-item">

                                      <span>Complemento e observações:</span>
                                      <strong><?php echo esc($pedido->observacoes); ?></strong>

                                  </li>
                              </ul>



                          </div>
                      </div>
                  </div>
              </div>

              <?php endforeach; ?>

              <?php endif; ?>

          </div>


      </div>
  </div>
  <!-- end product -->
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>

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