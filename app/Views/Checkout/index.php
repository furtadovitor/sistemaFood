  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>

  <link rel="stylesheet" href="<?php echo site_url("web/src/assets/css/produto.css"); ?>" />

  <?= $this->endSection(); ?>



  <?= $this->section('conteudo'); ?>

  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">

      <div class="col-sm-12 col-md-12 col-lg-12">

          <div class="product-content product-wrap clearfix product-deatil">
              <div class="row">


                  <div class="col-md-12 col-xs-12">



                      <h2 class="section-title "><?php echo esc($titulo); ?></h2>

                  </div>

                  <div class="col-md-7">

                      <ul class="list-group">

                          <?php $total = 0; ?>

                          <?php foreach($carrinho as $produto): ?>

                          <?php $subTotal = $produto['preco'] * $produto['quantidade']; ?>


                          <?php $total += $subTotal; ?>


                          <li class="list-group-item">
                              <div>
                                  <h4><?php echo ellipsize($produto['nome'], 60);?></h4>
                                  <p class="text-muted">Quantidade: <?php echo $produto['quantidade']; ?></p>
                                  <p class="text-muted">Preço: <?php echo $produto['preco']; ?></p>
                                  <p class="text-muted">Subtotal: <?php echo number_format($subTotal, 2); ?></p>

                              </div>
                          </li>

                          <?php endforeach; ?>

                          <li class="list-group-item">

                              <span>Total de produtos:</span>
                              <strong><?php echo 'R$&nbsp'. number_format($total,2); ?></strong>

                          </li>

                          <li class="list-group-item">

                              <span>Taxa de entrega:</span>
                              <strong id="valor_entrega" class="text-danger">Obrigatório *</strong>

                          </li>

                          <li class="list-group-item">

                              <span>Valor total do pedido:</span>
                              <strong id="total"><?php echo 'R$&nbsp'. number_format($total,2); ?></strong>

                          </li>


                          <li class="list-group-item">

                              <span>Endereço de entrega:</span>
                              <strong id="endereco" class="text-danger">Obrigatório *</strong>

                          </li>
                      </ul>


                      <a href="<?php echo site_url("carrinho"); ?>" class="btn btn-primary"
                          style="font-family: 'Montserrat-Bold';">Ver carrinho</a>

                      <a href="<?php echo site_url("/"); ?>" class="btn btn-food">Mais produtos</a>

                  </div> <!-- fim 7 -->

                  <div class="col-md-5">

                      <?php echo form_open('checkout/processar', ['id' => 'form-checkout']); ?>


                      <?php if(session()->has('errors_model')): ?>

                      <ul style="margin-left: -1.6em !important; list-style:decimal">
                          <?php foreach(session('errors_model') as $error) : ?>

                          <li class="text-danger"><?php echo $error ?></li>

                          <?php endforeach; ?>
                      </ul>


               
                      <?php endif; ?>
                      <p style="font-size: 18px; font-weight: bold">Escolha a forma de pagamento na entrega</p>

                      <div class="row">

                          <?php foreach ($formas as $forma) : ?>
                          <div class="radio">

                              <label style="font-size: 15px" ;>

                                  <input id="forma" name="forma" type="radio" style="margin-top: 2px" class="forma"
                                      data-forma="<?php echo $forma->id ?>">

                                  <?php echo esc($forma->nome); ?>

                              </label>

                          </div>

                          <?php endforeach; ?>

                          <hr>

                          <!-- div exibida qnd escolher a forma de pagamento dinheiro -->
                          <div id="troco" class="hidden">

                              <div class="form-group col-md-12" style="padding-left: 0">

                                  <label>Troco para</label>
                                  <input type="text" id="troco_para" name="checkout[troco_para]"
                                      class="form-control money" placeholder="Enviar troco para">
                                  <label>

                                      <input type="checkbox" id="sem_troco" name="checkout[sem_troco]">
                                      Não preciso de troco
                                  </label>

                                  <hr>

                              </div>

                          </div> <!-- fim troco -->


                          <div class="form-group col-md-12" style="padding-left: 0">
                              <label>Taxa de entrega</label>
                              <input type="text" name="cep" class="form-control cep" placeholder="Informe seu cep"
                                  value="">
                              <div id="cep"></div>
                          </div>


                          <div class="form-group col-md-9" style="padding-left: 0">

                              <label>Rua</label>
                              <input id="rua" type="text" name="checkout[rua]" class="form-control" readonly=""
                                  required="">

                          </div>


                          <div class="form-group col-md-3" style="padding-left: 0">

                              <label>Número *</label>
                              <input type="text" name="checkout[numero]" class="form-control" required="">
                              <div id="cep"></div>
                          </div>

                          <div class="form-group col-md-9" style="padding-left: 0">

                              <label>Ponto de referência</label>
                              <input type="text" name="checkout[referencia]" class="form-control" required="">
                              <div id="cep"></div>
                          </div>

                          <div class="form-group col-md-12">

                              <input type="text" id="forma_id" name="checkout[forma_id]"
                                  placeholder="checkout[forma_id]">
                              <input type="text" id="bairro_slug" name="checkout[bairro_slug]"
                                  placeholder="checkout[bairro_slug]">


                          </div>

                          <div class="form-group col-md-12">

                              <input type="submit" id="btn-checkout" class="btn btn-food"
                                  value="Consultar a taxa de entrega">


                          </div>




                      </div>

                  </div>
                  <?php echo form_close(); ?>
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

  <script>
$("#btn-checkout").prop('disabled', true);

$(".forma").on('click', function() {

    var forma_id = $(this).attr('data-forma');

    $("#forma_id").val(forma_id);


    if (forma_id == 3) {

        $("#troco").removeClass('hidden');

    } else {

        $("#troco").addClass('hidden');


    }


}); //fim do troco

$("#sem_troco").on('click', function() {

    if (this.checked) {

        $("#troco_para").prop('disabled', true);

        $("#troco_para").attr('placeholder', 'Não preciso de troco.')

    } else {

        $("#troco_para").prop('disabled', false);

        $("#troco_para").attr('placeholder', 'Enviar troco para')

    }


}); //fim do semtroco







$("[name=cep]").focusout(function() {


    var cep = $(this).val();

    if (cep.length === 9) {
        $.ajax({

            type: 'get',
            url: '<?php echo site_url('checkout/consultacep'); ?>',
            dataType: 'json',
            data: {
                cep: cep
            },
            beforeSend: function() {
                $("#cep").html('Consultando cep..');

                $("[name=cep]").val('');

                $("#btn-checkout").prop('disabled', true);
                $("#btn-checkout").val('Consultando a taxa de entrega...');

            },

            success: function(response) {
                if (!response.erro) {


                    $("#valor_entrega").html(response.valor_entrega);

                    $("#bairro_slug").val(response.bairro_slug);

                    $("#btn-checkout").prop('disabled', false);
                    $("#btn-checkout").val('Processar pedido');

                    if (response.logradouro) {

                        $("#rua").val(response.logradouro);

                    } else {

                        $("#rua").prop('readonly', false);
                    }

                    $("#endereco").html(response.endereco);

                    $("#total").html(response.total);

                    $("#cep").html(response.bairro);

                } else {

                    $("#cep").html(response.erro);



                }
            },

            error: function() {
                alert('Não foi possível consultar a taxa de entrega.')


                $("#btn-checkout").prop('disabled', true);

                $("#btn-checkout").val('Consulte a taxa de entrega');
            }


        });
    }


});
  </script>

  <?= $this->endSection(); ?>