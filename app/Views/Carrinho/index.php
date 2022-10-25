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

                  <?php if(!isset($carrinho)): ?>

                  <div class="text-center">
                      <h2 class="text-center">Seu carrinho de compras está vazio.</h2>


                      <a href="<?php echo site_url("/"); ?>" class="btn btn-lg"
                          style="background-color: #990100; color: white; margin-top: 2em">Mais produtos</a>

                  </div>
                  <?php else: ?>

                  <div class="table-responsive">

                      <?php if(session()->has('errors_model')): ?>

                      <ul style="margin-left: -1.6em !important; list-style:decimal">
                          <?php foreach(session('errors_model') as $error) : ?>

                          <li class="text-danger"><?php echo $error ?></li>

                          <?php endforeach; ?>
                      </ul>


                      <?php endif; ?>


                      <p style="margin-bottom: 2em">Resumo do carrinho de compras</p>


                      <table class="table">
                          <thead>
                              <tr>
                                  <th class="text-center" scope="col">Remover</th>
                                  <th scope="col">Produto</th>
                                  <th scope="col">Tamanho</th>
                                  <th class="text-center" scope="col">Quantidade</th>
                                  <th scope="col">Preço</th>
                                  <th scope="col">Total</th>

                              </tr>
                          </thead>
                          <tbody>

                              <?php $total = 0; ?>

                              <?php foreach($carrinho as $produto): ?>


                              <tr>
                                  <th class="text-center" scope="row">



                                      <?php echo form_open("carrinho/remover", ['class' => 'form-inline']); ?>

                                      <div class="form-group">

                                          <input type="hidden" name="produto[slug]"
                                              value="<?php echo $produto->slug ?>">

                                      </div>

                                      <button type="submit" class="btn btn-danger float-right">
                                          <i class="fa fa-trash"></i> </button>

                                      <?php echo form_close(); ?>


                                      <!--  <a class="btn btn-danger btn-sm"
                                      href="<?php echo site_url("carrinho/remover/$produto->slug"); ?> ">X</a>
                                  </th> -->
                                  <td><?php echo esc($produto->nome) ?></td>
                                  <td><?php echo esc($produto->tamanho) ?></td>
                                  <td class="text-center">

                                      <?php echo form_open("carrinho/atualizar", ['class' => 'form-inline']); ?>

                                      <div class="form-group">

                                          <input type="number" class="form-control" name="produto[quantidade]"
                                              value="<?php echo ($produto->quantidade) ?>" min="1" max="10" step="1"
                                              required="">
                                          <input type="hidden" name="produto[slug]"
                                              value="<?php echo $produto->slug ?>">

                                      </div>

                                      <button type="submit" class="btn btn-primary float-right">
                                          <i class="fa fa-refresh"></i>
                                  <td>R$&nbsp;<?php echo esc($produto->preco); ?></td>
                                  <?php echo form_close(); ?>
                                  </td>

                                  <?php 

                                  $subTotal = (int) $produto->preco * $produto->quantidade;

                                  $total += $subTotal;

                                  ?>

                                  <td>R$&nbsp;<?php echo number_format($subTotal, 2) ?></td>
                              </tr>


                              <?php endforeach; ?>

                              <tr>
                                  <td class="text-right" colspan="5" style="font-weight: bold">Total produtos:</td>
                                  <td colspan="5"><?php echo number_format($total, 2) ?></td>
                              </tr>

                              <tr>
                                  <td class="text-right border-top-0" colspan="5" style="font-weight: bold">Taxa de
                                      entrega:</td>
                                  <td class="border-top-0" colspan="5" id="valor_entrega">R$&nbsp;30.00</td>
                              </tr>

                              <tr>
                                  <td class="text-right border-top-0" colspan="5" style="font-weight: bold">Total do
                                      pedido:</td>
                                  <td class="border-top-0" colspan="5" id="total">
                                      <?php echo 'R$&nbsp' . number_format($total, 2) ?></td>
                              </tr>



                          </tbody>
                      </table>

                      <div class="form-group col-md-3">

                          <label>Consulte a taxa de entrega</label>
                          <input type="text" name="cep" class="cep form-control" placeholder="Informe o seu cep">
                          <div id="cep"></div>
                      </div>

                  </div>

                  <div class="col-md-12">

                      <a href="<?php echo site_url("carrinho/limparCarrinho"); ?>" class="btn btn-default"
                          style="font-family: 'Montserrat-Bold';">Limpar carrinho</a>

                      <a href="<?php echo site_url("/"); ?>" class="btn btn-primary"
                          style="font-family: 'Montserrat-Bold';">Mais produtos</a>

                      <a href="<?php echo site_url("checkout"); ?>" class="btn pull-right"
                          style="background-color: #990100; color:white; font-family: 'Montserrat-Bold';">Finalizar
                          pedido</a>

                  </div>

                  <?php endif; ?>








              </div>
          </div>
      </div>
      <div>
          <!-- end product -->
      </div>




      <?= $this->endSection(); ?>






      <?= $this->section('scripts'); ?>
      <script src="https://kit.fontawesome.com/2a6efc6cee.js" crossorigin="anonymous"></script>
      <script src="<?= site_url('admin/vendors/mask/jquery.mask.min.js'); ?>"></script>
      <script src="<?= site_url('admin/vendors/mask/app.js'); ?>"></script>

      <script>

        $("[name=cep]").focusout(function(){


            var cep = $(this).val();

            if(cep.length === 9){
                $.ajax({
                   
                    type: 'get',
                    url: '<?php echo site_url('carrinho/consultacep'); ?>',
                    dataType: 'json',
                    data: {
                        cep : cep
                    },
                    beforeSend: function(){
                        $("cep").html('Consultando cep..');

                        $("[name=cep]").val('');
                    },

                    success: function(response){
                        if(!response.error){

                            //sucesso , cep válido
                        }else{

                            //erro de validação

                        }
                    },

                    error:function(){
                        alert('Não foi possível consultar a taxa de entrega.')
                    }


                });
            }

            alert(cep)
            
        });

      </script>

      <?= $this->endSection(); ?>