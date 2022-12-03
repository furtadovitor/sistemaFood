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
          <!-- product -->
          <div class="product-content product-wrap clearfix product-deatil">
              <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12">
                      <div class="product-image">

                          <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>"
                              alt="<?php echo esc($produto->imagem); ?>" />

                      </div>
                  </div>



                  <?php echo form_open("carrinho/adicionar"); ?>
                  <div class="col-md-7 col-md-offset-1 col-sm-12 col-xs-12">


                      <?php if(session()->has('errors_model')): ?>

                      <ul style="margin-left: -1.6em !important; list-style:decimal">
                          <?php foreach(session('errors_model') as $error) : ?>

                          <li class="text-danger"><?php echo $error ?></li>

                          <?php endforeach; ?>
                      </ul>


                      <?php endif; ?>

                      <h2 class="name">

                          <?php echo esc($produto->nome); ?>

                      </h2>
                      <hr />
                      <h3 class="price-container">

                          <p class="small">Escolha o valor</p>


                          <?php foreach ($especificacoes as $especificacao) : ?>
                          <div class="radio">

                              <label style="font-size: 15px" ;>

                                  <input type="radio" style="margin-top: 2px" class="especificacao"
                                      data-especificacao="<?php echo $especificacao->especificacao_id ?>"
                                      name="produto[preco]" value="<?php echo $especificacao->preco; ?>">

                                  <?php echo esc($especificacao->nome); ?>
                                  <?php echo esc(number_format($especificacao->preco, 2)); ?>

                              </label>

                          </div>

                          <?php endforeach; ?>

                          <?php if(isset($extras)): ?>

                          <hr>

                          <p class="small">Extras do produto</p>

                          <div class="radio">

                              <label style="font-size: 15px" ;>

                                  <input type="radio" style="margin-top: 2px" class="extra" name="extra" checked="">Sem
                                  extra

                              </label>

                          </div>




                          <?php foreach ($extras as $extra) : ?>
                          <div class="radio">

                              <label style="font-size: 15px" ;>

                                  <input type="radio" class="extra" data-extra="<?php echo $extra->id ?>"
                                      name="extra" value="<?php echo $extra->preco; ?>">

                                  <?php echo esc($extra->nome); ?>
                                  <?php echo esc(number_format($extra->preco, 2)); ?>

                              </label>

                          </div>

                          <?php endforeach; ?>

                          <?php endif; ?>
                      </h3>

                      <div class="row" style="margin-top: 4rem">

                          <div class="col-md-4">

                              <label>Quantidade</label>

                              <input type="number" class="form-control" placeholder="Quantidade"
                                  name="produto[quantidade]" value="1" min="1" max="10" step="1" required="">


                          </div>



                      </div>

                      <div class="description description-tabs">

                          <div id="myTabContent" class="tab-content">
                              <div class="tab-pane fade active in" style="font-size:15px;" id="more-information">
                                  <br />
                                  <strong>É uma delícia &#x1F60B;</strong>
                                  <p>
                                      <?php echo esc($produto->ingredientes); ?>
                                  </p>
                              </div>

                          </div>
                      </div>
                      <hr />

                      <div>

                          <!-- Campos hidden que to usando no controller -->

                          <input type="hidden" name="produto[slug]" placeholder="produto[slug]"
                              value="<?php echo $produto->slug; ?>">

                          <input type="hidden" id="especificacao_id" placeholder="produto[especificacao_id]"
                              name="produto[especificacao_id]">

                          <input type="hidden" id="extra_id" placeholder="produto[extra_id]" name="produto[extra_id]">

                      </div>
                      <div class="row">
                          <div class="col-sm-4">

                              <input id="btn-adiciona" type="submit" class="btn btn-success btn-block "
                                  value="Adicionar ao carrinho">

                          </div>


                          <!-- Colocando o botão customizavel para aparecer somento se o item for customizavel -->
                          

                          <div class="col-sm-4">

                              <a href="<?php echo site_url("/"); ?>" class="btn btn-info btn-block ">Mais produtos</a>
                          </div>

                      </div>
                  </div>

                  <?php echo form_close(); ?>
              </div>
          </div>
      </div>
      <!-- end product -->
  </div>




  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>

  <script>
$(document).ready(function() {

    var especificacao_id;

    //se a especificacao id não tiver valor, o botão fica desabilitado
    if (!especificacao_id) {

        $("#btn-adiciona").prop("disabled", true);

        $("#btn-adiciona").prop("value", "Selecione um valor");

    }

    $(".especificacao").on('click', function() {

        var especificacao_id = $(this).attr('data-especificacao');

        $("#especificacao_id").val(especificacao_id);

        $("#btn-adiciona").prop("disabled", false);

        $("#btn-adiciona").prop("value", "Adicionar ao carrinho");

    });

    $(".extra").on('click', function() {

        var extra_id = $(this).attr('data-extra');

        $("#extra_id").val(extra_id);


    });
});
  </script>

  <?= $this->endSection(); ?>