<?php
add_js(base_url('assets/js/home.js'));
?>
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
                                                <img class="img-responsive" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $value->id) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" v-on:click.prevent="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
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
                                            <img class="img-responsive" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $value->id) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" v-on:click.prevent="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
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
                                <ul class="product-list owl-carousel" data-dots="false" data-loop="false" data-nav = "true" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                                  <?php foreach (modules::run('floor/get_product' , 'forex-education') as $key => $value): ?>
                                    <li>
                                        <div class="left-block">
                                            <a href="<?= base_url('c/' . $value->cat_name  . '/' . $value->prod_name) ?>">
                                            <img class="img-responsive" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $value->id) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" v-on:click.prevent="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
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
                                            <img class="img-responsive" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $value->id) ?>" /></a>
                                            <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                            </div>
                                            <div class="add-to-cart">
                                                <a title="Add to Cart" href="#" v-on:click.prevent="addToCart(<?= $value->id ?> , $event)">Add to Cart</a>
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
        <div class="joined-brokers" style="margin-top : 10px;">
          <div class="row">
        			<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
      					<div class="panel price panel-red same">
      						<div class="panel-heading text-center">
                    <a target="_blank" href="http://www.askapimperium.com/">
                      <img src="/assets/images/logo/imperium200x60.png"/>
                    </a>
      						</div>
      						<ul class="list-group list-group-flush text-center">
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $500 </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Mini Lot 0.1 Lot </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Spread Start from 2.3 Point </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> STP Broker </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> 100% No Requote - Guarantee </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage 1:100 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision $3/0.1 Lot </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating & Fix Rate $1 = Rp 10.000 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Fast Deposit & Withdrawal </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> 24/5 Service </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free Education & Consultation </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free Coffee Break </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> ABC System bonus </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Copy Trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
      						</ul>
      						<div class="panel-footer">
      							<a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://www.askapimperium.com/">Buka Akun !</a>
      						</div>
      					</div>
    				  </div>
              <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                <div class="panel price panel-red">
                  <div class="panel-heading text-center">
                    <a target="_blank" href="http://clicks.pipaffiliates.com/c?c=222516&l=id&p=0">
                      <img src="/assets/images/logo/xm.png"/>
                    </a>
                  </div>
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Multi Regulated Broker (FCA, CySec, ASIC) </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> No Requote, No Rejection </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> No Virtual Dealer</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> ECN Account </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Market Execution </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Min Deposit $5</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Min Lot - 0,01 Micro Lot </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:888 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread as low as 0 pips </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Islamic Account </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> EA & News Trading allowed </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Trading Platfrom MT4, MT5, WebTrader </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Platform PC/MAC, Smartphone, Tablet </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free Daily Forex Signal </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free Forex Calculator </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free VPS* </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Free Weekly Webinar </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Personal Account Manager for each Client </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Live Chat 24/7 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Official Sponsor of USAIN BOLT</li>
                  </ul>
                  <div class="panel-footer">
                      <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://clicks.pipaffiliates.com/c?c=222516&l=id&p=0">Buka Akun !</a>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
      					<div class="panel price panel-red same">
      						<div class="panel-heading text-center">
                    <a target="_blank" href="http://fbspremium.com">
                      <img src="/assets/images/logo/fbs.png"/>
                    </a>
      						</div>
      						<ul class="list-group list-group-flush text-center">
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $1 (Cent) </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.001 Lot (Cent) </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start form 0.2 pips </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> No Swap Fee </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> STP Broker </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> No Requote </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:3000 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision start from $0/Lot </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating & Fix Rate $1 = Rp 10.000 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Anti Loss Insurance  </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Bonus Deposit $123 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Local </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Copy Trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
      						</ul>
      						<div class="panel-footer">
      							<a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://fbspremium.com">Buka Akun !</a>
      						</div>
      					</div>
    				  </div>
              <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
      					<div class="panel price panel-red same">
      						<div class="panel-heading text-center">
                    <a target="_blank" href="http://Mtradingfx.com">
                      <img src="/assets/images/logo/mtrading.png"/>
                    </a>
      						</div>
      						<ul class="list-group list-group-flush text-center">
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $10 Standard & $500 Pro </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.01 Lot </li>
      							<li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start form 2 pips </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> No Swap Fee </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Instant & STP Broker </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Requote (Standard), No Requote (Pro) </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:1000 </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision $0/Lot (Standard), $10/Lot (Pro) </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating Rate </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Local  </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Copy Trade </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i> Autochartist </li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                    <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
      						</ul>
      						<div class="panel-footer">
      							<a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://Mtradingfx.com">Buka Akun !</a>
      						</div>
      					</div>
    				  </div>
    			</div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                  <a target="_blank" href="http://hfxpremium.com">
                    <img src="/assets/images/logo/hotforex.png"/>
                  </a>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $5  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.01 Lot  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start form 1 pips </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> No Swap Fee </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Market Execution </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:1000 </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision $0/Lot  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating Rate </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Local </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                </ul>
                <div class="panel-footer">
                  <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://hfxpremium.com">Buka Akun !</a>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                  <a target="_blank" href="http://fullertrade.com">
                    <img src="/assets/images/logo/fulleton.png"/>
                  </a>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $100  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.01 Lot   </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread Variable </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Market Execution </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:500 </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision $0/Lot  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating Rate </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Local </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Robotic Copy Trade </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;<br>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>

                </ul>
                <div class="panel-footer">
                  <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://fullertrade.com">Buka Akun !</a>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                  <a target="_blank" href="http://fxp-premium.com">
                    <img src="/assets/images/logo/fx-pro.png"/>
                  </a>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>Minimum Deposit $100</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.01 Lot  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start from 0.1 pips (cTrader)</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Islamic Account </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Market Execution </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:500</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Commission $0/Lot & $9/Lot (cTrader)  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Floating Rate </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Lokal </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> 4 Trading Platform (MT4, MT5, cTrader, FxPro Markets) </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Autochartist & Trading Central </li>
                </ul>
                <div class="panel-footer">
                  <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://fxp-premium.com">Buka Akun !</a>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                  <a target="_blank" href="http://sagafx.com/auth/create/SagaPremium">
                    <img src="/assets/images/logo/sagafx.png"/>
                  </a>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $200 </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.1 Lot </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start from 3 pips </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Enable EA & News trade </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Fix Rate $1 = Rp 10.000</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Commision $2/0,1 lot </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Depo & WD Bank Lokal </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Requote </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                </ul>
                <div class="panel-footer">
                    <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://sagafx.com/auth/create/SagaPremium">Buka Akun !</a>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                  <a target="_blank" href="http://www.octafx.com/?refid=848342">
                    <img src="/assets/images/logo/octafxnew.png"/>
                  </a>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Deposit $100</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Minimum Lot 0.01 Lot </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Spread start from 0 pips</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Islamic Account </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Market Execution </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Leverage up to 1:500 </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Commission $0/Lot</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> Trading Platform (MT4, MT5, cTrader) </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                </ul>
                <div class="panel-footer">
                    <a class="btn btn-lg btn-block btn-danger" target="_blank" href="http://www.octafx.com/?refid=848342">Buka Akun !</a>
                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                   <img src="/assets/images/logo/comming-soon-broker-NEW.png"/>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                </ul>
                <div class="panel-footer">

                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                   <img src="/assets/images/logo/comming-soon-broker-NEW.png"/>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                </ul>
                <div class="panel-footer">

                </div>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
              <div class="panel price panel-red">
                <div class="panel-heading text-center">
                   <img src="/assets/images/logo/comming-soon-broker-NEW.png"/>
                </div>
                <ul class="list-group list-group-flush text-center">
                  <li class="list-group-item"><i class="icon-ok text-danger"></i>&nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;</li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp;  </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                  <li class="list-group-item"><i class="icon-ok text-danger"></i> &nbsp; </li>
                </ul>
                <div class="panel-footer">

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
