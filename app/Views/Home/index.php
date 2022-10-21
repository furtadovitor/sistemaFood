  <!-- Extendendo o layout principal_site -->
  <?= $this->extend('layout/principal_site'); ?>

  <?= $this->section('titulo'); ?>

  <?php echo $titulo; ?>

  <?= $this->endSection(); ?>




  <?= $this->section('estilos'); ?>


  <?= $this->endSection(); ?>





  <?= $this->section('conteudo'); ?>
  <!-- Aqui enviamos p/ template pricipal os estilos -->

  <!-- Begin Sections-->


  <!--    Menus   -->
  <div class="container section" id="menu" data-aos="fade-up" style="margin-top: 3em">
      <div class="title-block">
          <h1 class="section-title">CONHEÇA O NOSSO MENU</h1>

      </div>

      <!--    Menus filter    -->
      <div class="menu_filter text-center">
          <ul class="list-unstyled list-inline d-inline-block">


              <li id="todas" class="item active">
                  <a href="javascript:;" class="filter-button" data-filter="todas">Todas</a>
              </li>

              <?php foreach($categorias as $categoria): ?>

              <li class="item">
                  <a href="javascript:;" class="filter-button"
                      data-filter="<?php echo $categoria->slug ?>"><?php echo esc($categoria->nome); ?></a>
              </li>

              <?php endforeach; ?>






          </ul>
      </div>

      <!--    Menus items     -->
      <div id="menu_items">

          <div class="row">

              <?php foreach ($produtos as $produto): ?>

              <div class="col-sm-6 filtr-item image filter active <?php echo $produto->categoria_slug?>">

                  <a href="<?php echo site_url("produto/detalhes/$produto->slug"); ?> "class="block
              fancybox" data-fancybox-group="fancybox">
                      <div class="content">
                          <div class="filter_item_img">
                              <i class="fa fa-search-plus"></i>
                              <img src="<?php echo site_url("produto/imagem/$produto->imagem"); ?>" alt="<?php echo esc($produto->imagem); ?>" />
                          </div>
                          <div class="info">
                              <div class="name"><?php echo esc($produto->nome); ?></div>
                              <div class="short"><?php echo word_limiter($produto->ingredientes, 5) ?></div>
                              <span class="filter_item_price">A partir de R$ <?php echo esc(number_format($produto->preco,2)); ?></span>
                          </div>
                      </div>
                  </a>
              </div>

              <?php endforeach; ?>



          </div>


      </div>
  </div>


  <!--    Gallery    -->
  <div class="container section" id="gallery" data-aos="fade-up">
      <div class="title-block">
          <h1 class="section-title">Gallery</h1>
      </div>
      <div id="photo_gallery" class="list1">
          <div class="row loadMore">
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-1.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-1.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/picanha.png" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/picanha.png" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-3.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-3.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-4.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-4.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-5.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/picanha.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-6.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-6.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-7.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-7.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-8.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-8.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-1.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-1.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-2.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-2.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-3.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-3.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-sm-4 col-md-3 item">
                  <a href="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-4.jpg" class="block fancybox"
                      data-fancybox-group="fancybox">
                      <div class="content">
                          <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/gallery-4.jpg" alt="sample" />
                          <div class="zoom">
                              <span class="zoom_icon"><i class="fa fa-search-plus"></i></span>
                          </div>
                      </div>
                  </a>
              </div>
          </div>
      </div>
  </div>

  <!--    About Us    -->
  <div class="container section" id="about_us">
      <div class="col-sm-12 d-flex flex-xs-column">
          <div class="col-sm-6 d-flex align-items-center padd_lr0" data-aos="fade-up">
              <div class="content">
                  <h1 class="section-title title_sty1">Sobre nós</h1>
                  <p class="short">Fundado em 2021, em plena Pandemia, o Braseiro Nobre é um dos FoodTruck's mais tradicionais do bairro. Localizado na Praça do Viseu, Vila da Penha, O Braseiro Nobre contém no cardápio carnes nobres, petiscos e muita alegria. Cortes criados pela casa se destacam, como a Picanha Borboleta, Paleta de Cordeiro ao Douro e a Costela Prime.</p>
              </div>
          </div>
          <div class="col-sm-6 img text-center padd_lr0" data-aos="fade-down">
              <div class="border_on">
                  <img src="<?php echo site_url('web/'); ?>src/assets/img/photos/about-us.jpg" alt="sample"
                      class="about_img" />
              </div>
          </div>
      </div>
  </div>

  <!-- End Sections -->

  <?= $this->endSection(); ?>






  <?= $this->section('scripts'); ?>
  <!-- Aqui enviamos p/ template pricipal os scripts -->


  <?= $this->endSection(); ?>