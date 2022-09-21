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



                  <?php echo form_open("admin/produtos/cadastrarespecificacoes/$produto->id"); ?>

                  <div class="form-row">

                      <div class="form-group col-md-4">

                          <label for="">Escolha a medida do produto (opcional)</label>

                          <div class="ls-custom-select col-lg-12">
                              <select class="form-control js-example-basic-single" name="medida_id">
                                  <option value="">Escolha..</option>
                                  <?php foreach($medidas as $medida) :?>

                                  <option value="<?php echo $medida->id ?>"><?php echo esc($medida->nome) ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>

                      </div>

                      <div class="form-group col-md-4">
                          <label for="nome">Preço:</label>
                          <input type="text" class="money form-control" name="preco" id="preco"
                              value="<?= old('preco'); ?>">
                      </div>

                      <div class="form-group col-md-4">

                          <label for="">Produto customizável</label>

                          <select class="form-control" name="customizavel">

                              <option value="">Escolha..</option>
                              <option value="1">Sim</option>
                              <option value="0">Não</option>


                          </select>
                      </div>


                  </div>

                  <button type="submit" class="btn btn-primary mr-2 btn-sm">
                      <i class="mdi mdi-check btn-icon-prepend"></i>
                      Inserir especificação
                  </button>
                  <a href="<?= site_url("admin/produtos/show/$produto->id"); ?>" class="btn btn-info btn-sm mr-2">
                      <i class="mdi mdi-arrow-left btn-icon-prepend"></i>
                      Voltar
                  </a>


                  <?php echo form_close(); ?>

                  <hr class="mt-5 mb-3">

                  <div class="form-row">
                      <div class="col-md-8">

                          <?php if(empty($produtoEspecificacoes)): ?>

                          <div class="alert alert-warning" role="alert">
                              <h4 class="alert-heading">Atenção!!!</h4>
                              <p>Esse produto não possui especificações até o momento, logo ele <strong>não será
                                      exibido</strong> como opção de compra na área pública</p>
                              <hr>
                              <p class="mb-0">Aproveite para cadastrar pelo menos uma especificação para o produto
                                  <strong><?php echo esc($produto->nome); ?></strong>.
                              </p>
                          </div>
                          <?php else: ?>

                          <h4 class="card-title">Especificações do produto</h4>

                          <div class="table-responsive">
                              <table class="table table-hover">
                                  <thead>
                                      <tr>
                                          <th>Medida</th>
                                          <th>Preço</th>
                                          <th>Customizável</th>

                                          <th class="text-center">Remover</th>
                                      </tr>
                                  </thead>
                                  <tbody>

                                      <?php foreach($produtoEspecificacoes as $especificacao):?>
                                      <tr>
                                          <td><?php echo esc($especificacao->medida); ?> </td>
                                          <td>R$&nbsp;<?php echo esc(number_format($especificacao->preco, 2) ); ?>
                                          </td>

                                          <td><?php echo ($especificacao->customizavel ? '<label class="badge badge-primary">Sim</label>' : '<label class="badge badge-warning">Não</label>') ?>
                                          </td>

                                          <td class="text-center">

                                              <a href="<?= site_url("admin/produtos/excluirespecificacao/$especificacao->id/$especificacao->produto_id"); ?>"
                                                  class="btn badge badge-danger">
                                                  &nbsp;X&nbsp;
                                              </a>

                                              
                                          </td>
                                      </tr>

                                      <?php endforeach; ?>

                                  </tbody>
                              </table>

                              <div class="mt-3">
                                  <?= $pager->links() ?>
                              </div>

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

              placeholder: 'Digite o nome da Medida...',
              allowClear: false,

              "language": {

                  "noResults": function() {
                      return "Medida não encontrada&nbsp;&nbsp;<a class='btn btn-primary btn-sm' href='<?php echo site_url('admin/medidas/criar'); ?>'>Cadastrar</a>";
                  }


              },

              escapeMarkup: function(markup) {

                  return markup;

              }

          });
      });
      </script>


      <?= $this->endSection(); ?>