  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-6 grid-margin stretch-card">
          <div class="card">

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <p class="card-text">
                      <span class="font-weight-bold">Situação:</span>
                      <?= $pedido->exibeSituacaoPedido(); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Criado:</span>
                      <?= $pedido->criado_em->humanize()?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Atualizado</span>
                      <?= $pedido->atualizado_em->humanize()?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Forma de pagamento na entrega:</span>
                      <?= esc($pedido->forma_pagamento); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Valor dos produtos:</span>
                      R$&nbsp;<?= esc(number_format($pedido->valor_produtos,2)); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Valor de entrega:</span>
                      R$&nbsp;<?= esc(number_format($pedido->valor_entrega,2)); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Valor do pedido:</span>
                      R$&nbsp;<?= esc(number_format($pedido->valor_pedido,2)); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Endereço de entrega:</span>
                      R$&nbsp;<?= esc($pedido->endereco_entrega); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Observações do pedido:</span>
                      <?= esc($pedido->observacoes); ?>
                  </p>

                  <?php if($pedido->entregador_id != null): ?>


                  <p class="card-text">
                      <span class="font-weight-bold">Entregador:</span>
                      <?= esc($pedido->entregador); ?>
                  </p>

                  <?php endif; ?>

                  <ul>

                  <?php $produtos = unserialize($pedido->produtos); ?>

                      <ul class="list-group">

                      <?php foreach($produtos as $produto): ?>

                          <li class="list-group-item">

                          <p><strong>Produto:</strong> <?php echo $produto['nome']; ?></p>
                          <p><strong>Quantidade:</strong> <?php echo $produto['quantidade']; ?></p>
                          <p><strong>Preço:</strong> R$&nbsp;<?php echo number_format($produto['preco'],2); ?></p>

                          
                          
                          </li>
                         
                        <?php endforeach; ?>
                      </ul>
                  </ul>





                  <div class="mt-3">

                      <a href="<?= site_url("admin/pedidos/editar/$pedido->codigo"); ?>"
                          class="btn btn-dark btn-sm mr-2">
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Alterar situação
                      </a>

                      <a href="<?= site_url("admin/pedidos/excluir/$pedido->codigo"); ?>"
                          class="btn btn-danger btn-sm mr-2">
                          <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                          Excluir pedido
                      </a>
                      <a href="<?= site_url("admin/pedidos"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                  </div>



              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>



      <?= $this->endSection(); ?>