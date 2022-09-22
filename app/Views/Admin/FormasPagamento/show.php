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

           <?php if($forma->nome === 'Dinheiro' || $forma->nome ===  'Cash' ||$forma->nome ===  'dinheiro' ||$forma->nome ===  'Money' ||$forma->nome ===  'money' ||$forma->nome ===  'cash'): ?>
             <div class="alert alert-primary" role="alert">
  
             A forma de pagamento <strong><?php echo esc($forma->nome) ;?></strong>
             não pode ser <span class="text-danger">editada ou excluída</span>, pois essa opção será vinculada ou não ao envio de troco para o cliente 
             quando o mesmo estiver no <strong>Checkout</strong>.

         </div>

         <?php endif;?>
           

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <p class="card-text">
                      <span class="font-weight-bold">Nome:</span>
                      <?= esc($forma->nome); ?>
                  </p>
              
                  <p class="card-text">
                      <span class="font-weight-bold">Ativo:</span>
                      <?= ($forma->ativo ? 'Sim' : 'Não'); ?>
                  </p>
           

                  <p class="card-text">
                      <span class="font-weight-bold">Criado em:</span>
                      <?= $forma->criado_em->humanize()?>
                  </p>

                  <?php if($forma->deletado_em == null): ?>

                  <p class="card-text">
                      <span class="font-weight-bold">Atualizado em:</span>
                      <?= $forma->atualizado_em->humanize()?>
                  </p>

                  <?php else: ?>

                  <p class="card-text">
                      <span class="font-weight-bold text-danger">Excluído em:</span>
                      <?= $forma->deletado_em->humanize()?>
                  </p>

                  <?php endif; ?>

                  <div class="mt-3">

                      <?php if($forma->deletado_em == null): ?>

                        <?php if($forma->nome != "Dinheiro" && $forma->nome !=  'Cash' && $forma->nome !=  'dinheiro' && $forma->nome !=  'Money' && $forma->nome !=  'money' && $forma->nome !=  'cash'): ?>

                        <a href="<?= site_url("admin/formas/editar/$forma->id"); ?>" class="btn btn-dark btn-sm mr-2">
                          <i class="mdi mdi-pencil btn-icon-prepend"></i>
                          Editar
                      </a>

                      <a href="<?= site_url("admin/formas/excluir/$forma->id"); ?>"
                          class="btn btn-danger btn-sm mr-2">
                          <i class="mdi mdi-trash-can btn-icon-prepend"></i>
                          Excluir
                      </a>

                      <?php endif;?>

                      <a href="<?= site_url("admin/formas"); ?>" class="btn btn-info btn-sm mr-2">
                          <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                          Voltar
                      </a>

                      <?php else: ?>

                      <a href="<?= site_url("admin/formas/desfazerexclusao/$forma->id"); ?>"
                          class="btn btn-dark btn-sm">
                          <i class="mdi mdi-undo btn-icon-prepend"></i>
                          Desfazer
                      </a>

                      <a href="<?= site_url("admin/formas"); ?>" class="btn btn-info btn-sm mr-2">
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