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
                      <h2 class="name">

                          <?php echo esc($produto->nome); ?>

                      </h2>
                      <hr />
                      <h3 class="price-container">
                          $129.54
                      </h3>

                      <div class="description description-tabs">

                          <div id="myTabContent" class="tab-content">
                              <div class="tab-pane fade active in" id="more-information">
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

                          <input type="text" name="produto[slug]" placeholder="produto[slug]" value="<?php echo $produto->slug; ?>">
                     
                          <input type="text" id="especificacao_id" placeholder="produto[especificacao_id]" name="produto[especificacao_id]">

                          <input type="text" id="extra_id" placeholder="produto[extra_id]" name="produto[extra_id]">

                        </div>
                      <div class="row">
                          <div class="col-sm-12 col-md-6 col-lg-6">
                          
                          <input type="submit" class="btn btn-success btn-lg" value="Adicionar ao carrinho">
                          
                          
                          <a href="<?php echo site_url("/"); ?>" class="btn btn-info btn-lg">Mais produtos</a>
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
  <!-- Aqui enviamos p/ template pricipal os scripts -->


  <?= $this->endSection(); ?>