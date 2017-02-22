<!-- Home slideder-->
<div id="home-slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 slider-left" >
            </div>
            <div class="col-sm-9 header-top-right">
                <div class="homeslider">
                    <div class="content-slide">
                        <ul id="contenhomeslider">
                          <!-- <li><img alt="Funky roots" src="http://lorempixel.com/666/447/city" title="Funky roots" /></li> -->
                          <li><img alt="Funky roots" src="/assets/images/banner/banner-im-trader.jpg" title="" /></li>
                          <li><img alt="Funky roots" src="/assets/images/banner/banner-apk.jpg" title="" /></li>
                          <li><img alt="Funky roots" src="/assets/images/banner/banner-imlek.jpg" title="" /></li>
                        </ul>
                    </div>
                </div>
                <div class="header-banner banner-opacity">
                    <a href="#"><img alt="Funky roots" src="/assets/images/banner/reza.png" /></a>
                </div>
                <div class="header-banner banner-opacity">
                    <a href="#"><img style="height : 150px;" alt="Funky roots" src="/assets/images/banner/flash.png" /></a>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="service ">
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/assets/data/s1.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>Free Shipping</h3></a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/assets/data/s2.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>30-day return</h3></a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/assets/data/s3.png" />
                        </div>

                        <div class="info" >
                            <a href="#"><h3>24/7 support</h3></a>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 service-item">
                        <div class="icon">
                            <img alt="services" src="/assets/data/s4.png" />
                        </div>
                        <div class="info">
                            <a href="#"><h3>SAFE SHOPPING</h3></a>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- END Home slideder-->

<div class="content-page">
    <div class="container">
        <!-- featured category Indikator -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-green show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#">Indikator</a></div>
                  <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active">
                      <a data-toggle="tab" href="#tab-4">Produk Terbaru</a>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <div id="elevator-1" class="floor-elevator">
                    <a href="#" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
              </div>
            </nav>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <!-- <div class="featured-text"><span>featured</span></div> -->
                    <div class="banner-img">
                        <a href="#"><img alt="Featurered 1" src="/assets/images/banner/banner-indikator.png" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-4">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                  <?php foreach (modules::run('floor/get_product' , 'forex-indicator') as $key => $value): ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>">
                                            <img class="img-responsive" alt="product" src="<?= base_url($value->prod_images) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" @click="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>"><?= $value->prod_alias ?></a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">Rp. <?= number_format($value->prod_price) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php echo $this->format->rating($value->prod_star) ?>
                                            </div>
                                        </div>
                                      </li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category Indikator -->

        <!-- featured category merchandise -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-red show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#">Merchandise</a></div>
                  <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active">
                      <a data-toggle="tab" href="#tab-4">Produk Terbaru</a>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <div id="elevator-1" class="floor-elevator">
                    <a href="#" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
              </div>
            </nav>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <!-- <div class="featured-text"><span>featured</span></div> -->
                    <div class="banner-img">
                        <a href="#"><img alt="Featurered 1" src="/assets/images/banner/banner-merchandise.png" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-4">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                  <?php foreach (modules::run('floor/get_product' , 'forex-merchandise') as $key => $value): ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>">
                                            <img class="img-responsive" alt="product" src="<?= base_url($value->prod_images) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" @click="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>"><?= $value->prod_alias ?></a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">Rp. <?= number_format($value->prod_price) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php echo $this->format->rating($value->prod_star) ?>
                                            </div>
                                        </div>
                                      </li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category merchandise -->

        <!-- featured category education -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-orange show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#">Education</a></div>
                  <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active">
                      <a data-toggle="tab" href="#tab-4">Produk Terbaru</a>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <div id="elevator-1" class="floor-elevator">
                    <a href="#" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
              </div>
            </nav>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <!-- <div class="featured-text"><span>featured</span></div> -->
                    <div class="banner-img">
                        <a href="#"><img alt="Featurered 1" src="/assets/images/banner/banner-education.png" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-4">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                  <?php foreach (modules::run('floor/get_product' , 'forex-education') as $key => $value): ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>">
                                            <img class="img-responsive" alt="product" src="<?= base_url($value->prod_images) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" @click="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>"><?= $value->prod_alias ?></a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">Rp. <?= number_format($value->prod_price) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php echo $this->format->rating($value->prod_star) ?>
                                            </div>
                                        </div>
                                      </li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category education -->

        <!-- featured category Ea -->
        <div class="category-featured">
            <nav class="navbar nav-menu nav-menu-blue show-brand">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-brand"><a href="#">Expert Advisor</a></div>
                  <span class="toggle-menu"></span>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active">
                      <a data-toggle="tab" href="#tab-4">Produk Terbaru</a>
                    </li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
              <div id="elevator-1" class="floor-elevator">
                    <a href="#" class="btn-elevator up disabled fa fa-angle-up"></a>
                    <a href="#elevator-2" class="btn-elevator down fa fa-angle-down"></a>
              </div>
            </nav>
           <div class="product-featured clearfix">
                <div class="banner-featured">
                    <!-- <div class="featured-text"><span>featured</span></div> -->
                    <div class="banner-img">
                        <a href="#"><img alt="Featurered 1" src="/assets/images/banner/banner-ea.png" /></a>
                    </div>
                </div>
                <div class="product-featured-content">
                    <div class="product-featured-list">
                        <div class="tab-container">
                            <!-- tab product -->
                            <div class="tab-panel active" id="tab-4">
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                  <?php foreach (modules::run('floor/get_product' , 'forex-robot') as $key => $value): ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>">
                                            <img class="img-responsive" alt="product" src="<?= base_url($value->prod_images) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" @click="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="right-block">
                                            <h5 class="product-name"><a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>"><?= $value->prod_alias ?></a></h5>
                                            <div class="content_price">
                                                <span class="price product-price">Rp. <?= number_format($value->prod_price) ?></span>
                                            </div>
                                            <div class="product-star">
                                                <?php echo $this->format->rating($value->prod_star) ?>
                                            </div>
                                        </div>
                                      </li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
           </div>
        </div>
        <!-- end featured category Ea -->
    </div>
</div>

<div class="container">
    <div class="brand-showcase">
        <h2 class="brand-showcase-title">
            Joined Brokers
        </h2>
        <div class="brand-showcase-box">
            <ul class="brand-showcase-logo owl-carousel" data-loop="true" data-nav = "true" data-dots="false" data-margin = "1" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":5},"1000":{"items":8}}'>
                <li data-tab="showcase-1" class="item active">
                  ASKAP IMPERIUM
                </li>
                <li data-tab="showcase-1" class="item">
                  OTHER BROKER
                </li>
            </ul>
            <div class="brand-showcase-content">
                <div class="brand-showcase-content-tab active" id="showcase-1">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 trademark-info">
                            <div class="trademark-logo">
                                <a href="#"><img src="/assets/images/logo/imperium100x30.png" alt="trademark"></a>
                            </div>
                            <div class="trademark-desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <a href="#" class="trademark-link">Lebih Lanjut tentang Askap Imperium</a>
                        </div>
                        <div class="col-xs-12 col-sm-8 trademark-product">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 product-item">
                                  <img src="http://lorempixel.com/600/300/city/" alt="" class="img-responsive" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="brand-showcase-content-tab" id="showcase-2">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 trademark-info">
                            <div class="trademark-logo">
                                <a href="#"><img src="/assets/images/logo/imperium100x30.png" alt="trademark"></a>
                            </div>
                            <div class="trademark-desc">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <a href="#" class="trademark-link">Lebih Lanjut tentang Askap Imperium</a>
                        </div>
                        <div class="col-xs-12 col-sm-8 trademark-product">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 product-item">
                                  <img src="http://lorempixel.com/600/300/city/" alt="" class="img-responsive" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
