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
                      <span class="font-weight-bold">Nosssme:</span>
                      <?= esc($bairro->nome); ?>
                  </p>

                  <p class="card-text">
                      <span class="font-weight-bold">Valor de entrega:</span>
                      R$&nbsp;<?= esc(number_format($bairro->valor_entrega,2)); ?>
                  </p>
            
                  <p class="card-text">
                      <span class="font-weight-bold">Ativo:</span>
                      <?= ($bairro->ativo ? 'Sim' : 'Não'); ?>
                  </p>
           

                  <p class="card-text">
                      <span class="font-weight-bold">Criado em:</span>
                      <?= $bairro->criado_em->humanize()?>
                  </p>

                  <?php if($bairro->deletado_em == null): ?>

                  <p class="card-text">
                      <span class="font-weight-bold">Atualizado em:</span>
                      <?= $bairro->atualizado_em->humanize()?>
                  </p>

                  <?php else: ?>

                  <p class="card-text">
                      <span class="font-weight-bold text-danger">Excluído em:</span>
                      <?= $bairro->deletado_em->humanize()?>
                  </p>

                  <?php endif; ?>

                  <div class="mt-3">

                      <?php if($bairro->deletado_em == null): ?>

                      <a href="<?= site_url("admin/bairros/editar/$bairro->id"); ?>" class="btn btn-dark btn-sm mr-2">
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Editar
                      </a>

                      <a href="<?= site_url("admin/bairros/excluir/$bairro->id"); ?>"
                          class="btn btn-danger btn-sm mr-2">
                          <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                          Excluir
                      </a>
                      <a href="<?= site_url("admin/bairros"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                      <?php else: ?>

                      <a href="<?= site_url("admin/bairros/desfazerexclusao/$bairro->id"); ?>"
                          class="btn btn-dark btn-sm">
                          <i class="mdi mdi-undo btn-icon-prepend"></i>
                          Desfazer
                      </a>

                      <a href="<?= site_url("admin/bairros"); ?>" class="btn btn-info btn-sm mr-2">
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