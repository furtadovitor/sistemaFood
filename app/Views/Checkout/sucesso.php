  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>" />

  <style>
@media only screen and (max-width: 767px) {

    .section-title {
        font-size: 20px !important;
        margin-top: -9em !important;
    }

    #titulo-situacao{

        margin-top: -8em !important;
    }

    #topo{

        margin-top: 6em !important;


    }
}

  </style>

  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>

  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">

      <div class="col-sm-12 col-md-12 col-lg-12">
        
      <div class="col-md-12 col-xs-12">

                        
          <div id="topo" class="product-content product-wrap clearfix product-deatil">
              <div class="row">

              <h2 class="section-title "><?php echo esc($titulo); ?></h2>

</div>



                  <?php if ($pedido->situacao == 0) : ?>

                      

                  <?php endif; ?>

                  <div id="titulo-situacao" class="col-md-12 col-xs-12">

                  <h4>No momento, o seu pedido está com o status de <?php echo $pedido->exibeSituacaoPedido(); ?></h4>

                  </div>


                  <?php if ($pedido->situacao != 3) : ?>

                      <div class="col-md-12 col-xs-12">

                          <h5>Quando ocorrer uma mudança no pedido, iremos notificá-lô por email.</h5>

                      </div>

                  <?php endif; ?>

                  <div class="col-md-12">

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


                      <a href="<?php echo site_url("/"); ?>" class="btn btn-food">Mais produtos</a>

                  </div> <!-- fim 12 -->

                  <div class="col-md-12">




                  </div>




              </div>

          </div>
       
      </div>




  </div>





  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>
  <script src="https://kit.fontawesome.com/2a6efc6cee.js" crossorigin="anonymous"></script>
  <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
  <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>

  <?= $this->endSection(); ?>