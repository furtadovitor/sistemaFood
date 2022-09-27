  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-5 grid-margin stretch-card">
          <div class="card">

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <div class="text-center">

                      <?php if($entregador->imagem && $entregador->deletado_em == null): ?>

                      <img class="card-img-top w-75"
                          src="<?php echo site_url("admin/entregadores/imagem/$entregador->imagem"); ?>"
                          alt="<?php echo esc($entregador->nome); ?>">

                      <?php else: ?>

                      <img class="card-img-top w-75"
                          src="<?php echo site_url("admin/images/usuario_sem_imagem.png"); ?>"
                          alt="entregador sem imagem por enquanto">


                      <?php endif; ?>
                  </div>

                  <?php if($entregador->deletado_em == null): ?>

                  <hr>

                  <a href="<?= site_url("admin/entregadores/editarimagem/$entregador->id"); ?>"
                      class="btn btn-outline-primary mt-2 mb-3 btn-sm ">
                      <i class="mdi mdi-image btn-icon-prepend"></i>
                      Editar imagem
                  </a>

                  <hr>

                  <?php endif; ?>

                  <p class="card-text">
                      <span class="font-weight-bold">Nome:</span>
                      <?= esc($entregador->nome); ?>
                  </p>
                  <p class="card-text">
                      <span class="font-weight-bold">CPF:</span>
                      <?= esc($entregador->cpf); ?>
                  </p>
                  <p class="card-text">
                      <span class="font-weight-bold">Veículo:</span>
                      <?= esc($entregador->veiculo).  " - Placa: ". esc($entregador->placa) ; ?>
                  </p>
                  <p class="card-text">
                      <span class="font-weight-bold">Telefone:</span>
                      <?= esc($entregador->telefone); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Ativo:</span>
                      <?= ($entregador->ativo ? 'Sim' : 'Não'); ?>
                  </p>


                  <p class="card-text">
                      <span class="font-weight-bold">Criado em:</span>
                      <?= $entregador->criado_em->humanize()?>
                  </p>

                  <?php if($entregador->deletado_em == null): ?>

                  <p class="card-text">
                      <span class="font-weight-bold">Atualizado em:</span>
                      <?= $entregador->atualizado_em->humanize()?>
                  </p>

                  <?php else: ?>

                  <p class="card-text">
                      <span class="font-weight-bold text-danger">Excluído em:</span>
                      <?= $entregador->deletado_em->humanize()?>
                  </p>

                  <?php endif; ?>

                  <div class="mt-3">

                      <?php if($entregador->deletado_em == null): ?>

                      <a href="<?= site_url("admin/entregadores/editar/$entregador->id"); ?>"
                          class="btn btn-dark btn-sm mr-2">
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Editar
                      </a>


                      <a href="<?= site_url("admin/entregadores/excluir/$entregador->id"); ?>"
                          class="btn btn-danger btn-sm mr-2">
                          <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                          Excluir
                      </a>
                      <a href="<?= site_url("admin/entregadores"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                      <?php else: ?>

                      <a href="<?= site_url("admin/entregadores/desfazerexclusao/$entregador->id"); ?>"
                          class="btn btn-dark btn-sm">
                          <i class="mdi mdi-undo btn-icon-prepend"></i>
                          Desfazer
                      </a>

                      <a href="<?= site_url("admin/entregadores"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                      <?php endif; ?>



                  </div>



              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>



      <?= $this->endSection(); ?>