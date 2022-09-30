  <!-- Extendendo o layout principal -->
  <?= $this->extend('Admin/layout/principal'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>


  <?= $this->section('conteudo'); ?>
  <div class="row">


      <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
              <div class="card-body">
                  <h4 class="card-title"><?= $titulo; ?></h4>

                <?php if(session()->has('errors_model')): ?>
                  <ul>
                      <?php foreach(session('errors_model') as $error) : ?>

                      <li class="text-danger"><?php echo $error ?></li>

                      <?php endforeach; ?>
                  </ul>

                <?php endif; ?>


                  <?php echo form_open("admin/expedientes/expedientes", ['class' => 'form-row']); ?>
                  <div class="table-responsive">
                      <table class="table table-hover">
                          <thead>
                              <tr>
                                  <th>Dia</th>
                                  <th>Horário de abertura</th>
                                  <th>Horário de fechamento</th>
                                  <th>Situação</th>

                              </tr>
                          </thead>
                          <tbody>

                              <?php foreach($expedientes as $dia): ?>
                              <tr>
                                  <td class="form-group col-md-3">

                                      <input type="text" name="dia_descricao[]" class="form-control"
                                          value="<?php echo esc($dia->dia_descricao); ?>" readonly="">

                                  </td>

                                  <td class="form-group col-md-3">

                                      <input type="time" name="abertura_hora[]" class="form-control"
                                          value="<?php echo esc($dia->abertura_hora); ?>" required="">

                                  </td>

                                  <td class="form-group col-md-3">

                                      <input type="time" name="fechamento_hora[]" class="form-control"
                                          value="<?php echo esc($dia->fechamento_hora); ?>" required="">

                                  </td>

                                  <td class="form-group col-md-3">

                                      <select class="form-control" name="situacao[]" required="">

                                          <option value="1" <?php echo ($dia->situacao ? 'selected' : '');?>>Aberto</option>
                                          <option value="1" <?php echo (!$dia->situacao ? 'selected' : '');?>>Fechado</option>


                                      </select>

                                  </td>

                              </tr>

                              <?php endforeach; ?>

                            
                              
                          </tbody>

                        
                      </table>

                      <div class="col-md-12">
                              <button type="submit" class="btn btn-primary mt-3 mr-2 btn-sm">
                              <i class="mdi mdi-check btn-icon-prepend"></i>
                              Salvar
                          </button>
                              </div>

                  </div>

                  <?php echo form_close(); ?>
              </div>
          </div>
      </div>


      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>
      <!-- Aqui enviamos p/ template pricipal os scripts -->
      <script src="<?= site_url('admin/vendors/auto-complete/jquery-ui.js'); ?>"></script>

      <script>
      $(function() {

          $("#query").autocomplete({
              source: function(request, response) {

                  $.ajax({

                      url: "<?= site_url('admin/expedientes/procurar'); ?>",
                      dataType: "json",
                      data: {
                          term: request.term
                      },

                      success: function(data) {

                          if (data.length < 1) {

                              var data = [

                                  {
                                      label: 'bairro não encontrado',
                                      value: -1
                                  }
                              ];
                          }

                          response(data); //aqui temos valor no data

                      },

                  }); // fim do ajax

              },
              minLenght: 1,
              select: function(event, ui) {

                  if (ui.item.value == -1) {

                      $(this).val("");
                      return false;

                  } else {

                      window.location.href = '<?= site_url('admin/expedientes/show/'); ?>' + ui.item
                          .id;

                  }
              }

          }); //fim autocomplete


      });
      </script>


      <?= $this->endSection(); ?>