  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url('admin/vendors/select2/select2.min.css'); ?>" />


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">

              <div class="card-header bg-primary pb-0 pt-4">
                  <h4 class="card-title text-white"><?= esc($titulo); ?></h4>
              </div>

              <div class="card-body">

                  <?php if(session()->has('errors_model')): ?>

                  <ul>
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>


                  <?php endif; ?>



                  <?php echo form_open("admin/produtos/cadastrarextras/$produto->id"); ?>

                  <div class="form-row">

                      <div class="form-group col-lg-6">

                          <label for="">Escolha o extra do produto (opcional)</label>

                          <select class="form-control js-example-basic-single" name="extra_id">

                              <option>Escolha..</option>

                              <?php foreach($extras as $extra) :?>

                              <option value="<?php echo $extra->id ?>"><?php echo esc($extra->nome) ?></option>
                              <?php endforeach; ?>
                          </select>
                      </div>


                  </div>

                  <button type="submit" class="btn btn-primary mr-2 btn-sm">
                      <i class="mdi mdi-check btn-icon-prepend"></i>
                      Inserir extra
                  </button>
                  <a href="<?= site_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-info btn-sm mr-2">
                      <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                      Voltar
                  </a>


                  <?php echo form_close(); ?>

                  <hr class="mt-5 mb-3">

                  <div class="form-row">
                      <div class="col-md-8">

                          <?php if(empty($produtosExtras)): ?>

                          <p>Esse produto não possui extras até o momento</p>
                          <?php else: ?>

                          <h4 class="card-title">Extras do produto</h4>

                          <div class="table-responsive">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Extra</th>
                                          <th>Preço</th>
                                          <th>Remover</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      <?php foreach($produtosExtras as $extraProduto):?>
                                      <tr>
                                          <td><?php echo esc($extraProduto->extra); ?> </td>
                                          <td><?php echo esc(number_format($extraProduto->preco, 2) ); ?></td>
                                          <td><label class="badge badge-danger">&nbsp;X&nbsp;</label></td>
                                      </tr>

                                      <?php endforeach; ?>

                                  </tbody>
                              </table>
                          </div>

                          <?php endif; ?>
                      </div>

                  </div>

              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>

      <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
      <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>
      <script src="<?php echo site_url('admin/vendors/select2/select2.min.js'); ?>"></script>
      <script>
      // Instalando o plugin select2 para conseguir pesquisar os extras
      $(document).ready(function() {
          $('.js-example-basic-single').select2({

              placeholder: 'Digite o nome do Extra...',
              allowClear: false,

              "language": {

                  "noResults": function() {
                      return "Extra não encontrado&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/extras/criar'); ?>'>Cadastrar</a>";
                  }


              },

              escapeMarkup: function(markup) {

                  return markup;

              }

          });
      });
      </script>


      <?= $this->endSection(); ?>