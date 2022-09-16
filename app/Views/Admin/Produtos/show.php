  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-4 grid-margin stretch-card">
          <div class="card">

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <div class="text-center">

                      <?php if($produto->imagem): ?>

                      <img class="card-img-top w-75" src="<?php echo site_url("admin/produtos/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->nome); ?>">

                      <?php else: ?>

                      <img class="card-img-top w-75"
                          src="<?php echo site_url('admin/images/produto_sem_imagem.jpg'); ?>"
                          alt="Produto sem imagem por enquanto">


                      <?php endif; ?>
                  </div>

                  <hr>

                  <a href="<?= site_url("admin/produtos/editarimagem/$produto->id"); ?>"
                      class="btn btn-outline-primary mt-2 mb-3 btn-sm ">
                      <i class="mdi mdi-image btn-icon-prepend"></i>
                      Editar
                  </a>

                  <hr>

                  <p class="card-text">
                      <span class="font-weight-bold">Nome:</span>
                      <?= esc($produto->nome); ?>
                  </p>
                  <p class="card-text">
                      <span class="font-weight-bold">Categoria:</span>
                      <?= esc($produto->categoria); ?>
                  </p>
                  <p class="card-text">
                      <span class="font-weight-bold">Slug:</span>
                      <?= esc($produto->slug); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Ativo:</span>
                      <?= ($produto->ativo ? 'Sim' : 'Não'); ?>
                  </p>


                  <p class="card-text">
                      <span class="font-weight-bold">Criado em:</span>
                      <?= $produto->criado_em->humanize()?>
                  </p>

                  <?php if($produto->deletado_em == null): ?>

                  <p class="card-text">
                      <span class="font-weight-bold">Atualizado em:</span>
                      <?= $produto->atualizado_em->humanize()?>
                  </p>

                  <?php else: ?>

                  <p class="card-text">
                      <span class="font-weight-bold text-danger">Excluído em:</span>
                      <?= $produto->deletado_em->humanize()?>
                  </p>

                  <?php endif; ?>

                  <div class="mt-3">

                      <?php if($produto->deletado_em == null): ?>

                      <a href="<?= site_url("admin/produtos/editar/$produto->id"); ?>" class="btn btn-dark btn-sm mr-2">
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Editar
                      </a>


                      <a href="<?= site_url("admin/produtos/extras/$produto->id"); ?>" class="btn btn-success btn-sm mr-2">
                          <i class="mdi mdi-plus-circle btn-icon-prepend"></i>
                          Extras
                      </a>


                      <a href="<?= site_url("admin/produtos/excluir/$produto->id"); ?>"
                          class="btn btn-danger btn-sm mr-2">
                          <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                          Excluir
                      </a>
                      <a href="<?= site_url("admin/produtos"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                      <?php else: ?>

                      <a href="<?= site_url("admin/produtos/desfazerexclusao/$produto->id"); ?>"
                          class="btn btn-dark btn-sm">
                          <i class="mdi mdi-undo btn-icon-prepend"></i>
                          Desfazer
                      </a>

                      <a href="<?= site_url("admin/produtos"); ?>" class="btn btn-info btn-sm mr-2">
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