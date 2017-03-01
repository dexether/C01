<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/assets/lib/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lib/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lib/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lib/jquery.bxslider/jquery.bxslider.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lib/owl.carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="/assets/lib/jquery-ui/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/responsive.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/custom.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script type="text/javascript" src="/assets/js/vue.js"></script>
    <script src="/assets/js/vue-resource.min.js"></script>
    <?= (isset($meta) ? meta_tags($meta) : meta_tags());?>
    <meta name="google-site-verification" content="FggMHXkLtoP9I5hAfGbHJFrVrr9pkynEpzw37v8BP3E" />
    <!-- Google rechatpcha -->
    <script src='https://www.google.com/recaptcha/api.js?hl=id'></script>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
    document,'script','https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '1653939341575034'); // Insert your pixel ID here.
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1653939341575034&ev=PageView&noscript=1"
    /></noscript>
    <!-- DO NOT MODIFY -->
    <!-- End Facebook Pixel Code -->

</head>
<body class="<?= (isset($page)) ? $page : "home"; ?>">
<div id="app">
<!-- HEADER -->
<div id="header" class="header">
    <div class="top-header">
        <div class="container">
            <div class="nav-top-links hidden-xs">
                <a class="first-item" href="#"><img alt="phone" src="/assets/images/phone.png" />xxx-xxxx-xxxx</a>
                <a href="#"><img alt="email" src="/assets/images/email.png" />Contact us today!</a>
            </div>
            <div id="user-info-top" class="user-info pull-right">
                <div class="dropdown">
                    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#"><span><?= ($this->session->login) ? "Selamat Datang, " . $this->session->name : "My Account"; ?></span></a>
                    <ul class="dropdown-menu mega_dropdown" role="menu">
                      <?php if ($this->session->login): ?>
                        <li><a href="/web2">My Dashboard</a></li>
                        <li><a href="/auth/logout">Logout</a></li>
                      <?php else: ?>
                        <li><a href="/auth">Login</a></li>
                        <li><a href="/auth">Daftar</a></li>
                      <?php endif; ?>


                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/.top-header -->
    <!-- MAIN HEADER -->
    <div class="container main-header">
        <div class="row">
            <div class="col-xs-12 col-sm-3 logo">
                <a href="/"><img alt="Agenda FX" src="/assets/images/logo/logo-black.png" /></a>
            </div>
            <div class="col-xs-7 col-sm-6 header-search-box">
                <form class="form-inline">
                      <div class="form-group form-category">
                        <select class="select-category">
                            <option value="2">All Categories</option>
                        </select>
                      </div>
                      <div class="form-group input-serach">
                        <input type="text"  placeholder="Saya ingin Beli ....">
                      </div>
                      <button type="submit" class="pull-right btn-search"></button>
                </form>
            </div>
            <div id="cart-block" class="col-xs-5 col-sm-3 shopping-cart-box">
                <a class="cart-link" href="/cart">
                    <span class="title">Shopping cart</span>
                    <span class="total">{{ shop.length + (shop.length > 1 || shop.length === 0 ? " items" : " item") }} - Rp. {{ total }}</span>
                    <span class="notify notify-left">{{ shop.length }}</span>
                </a>
                <div class="cart-block">
                    <div class="cart-block-content">
                        <h5 class="cart-title">{{ shop.length + (shop.length > 1 || shop.length === 0 ? " items" : " item") }}  Items in my cart</h5>
                        <div class="cart-block-list">
                            <ul v-for="item in shop">
                                <li class="product-info">
                                    <div class="p-left">
                                        <a href="/" v-on:click.prevent="removeFromCart(item.rowid)" class="remove_link"></a>
                                        <a href="#">
                                        <img class="img-responsive" v-bind:src="'/' + item.img" />
                                        </a>
                                    </div>
                                    <div class="p-right">
                                        <p class="p-name">{{ item.name }}</p>
                                        <p class="p-rice">Rp. {{ (item.subtotal).formatMoney(2, '.', ',') }}</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="toal-cart">
                            <span>Total</span>
                            <span class="toal-price pull-right">Rp. {{ total }}</span>
                        </div>
                        <div class="cart-buttons">
                            <a href="/cart" class="btn-check-out">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MANIN HEADER -->
    <div id="nav-top-menu" class="nav-top-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-3" id="box-vertical-megamenus">
                    <div class="box-vertical-megamenus">
                        <h4 class="title">
                            <span class="title-menu">Categories</span>
                            <span class="btn-open-mobile pull-right home-page"><i class="fa fa-bars"></i></span>
                        </h4>
                    <div class="vertical-menu-content is-home">
                        <ul class="vertical-menu-list">
                            <li class="active"><a href="/c/forex-book"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Forex Book</a></li>
                            <li><a href="/c/forex-education"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Forex Education</a></li>
                            <li><a href="/c/forex-indicator"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Forex Indicator</a></li>
                            <li><a href="/c/forex-merchandise"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Forex Merchandise</a></li>
                            <li><a href="/c/forex-robot"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">EA & Robot</a></li>
                            <li><a href="/c/forex-seminar"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Forex Seminar</a></li>
                            <li><a href="/c/forex-copytrade"><img class="icon-menu" alt="Funky roots" src="/assets/data/1.png">Master Trader</a></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div id="main-menu" class="col-sm-9 main-menu">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <a class="navbar-brand" href="#">MENU</a>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav">
                                    <li class="active"><a href="#">Partnertship</a></li>
                                    <li class=""><a href="#">Became Seller</a></li>
                                    <li class=""><a href="#">Affiliate</a></li>
                                    <li class=""><a href="#">Workshop</a></li>
                                    <li class=""><a href="#">Hot News</a></li>
                                    <?php if ($this->session->login == false): ?>
                                      <li class=""><a href="/auth">Login</a></li>
                                    <?php else: ?>
                                      <li class=""><a href="/auth/logout">Logout</a></li>
                                    <?php endif; ?>

                                </ul>
                            </div><!--/.nav-collapse -->
                        </div>
                    </nav>
                </div>
            </div>
            <!-- userinfo on top-->
            <div id="form-search-opntop">
            </div>
            <!-- userinfo on top-->
            <div id="user-info-opntop">
            </div>
            <!-- CART ICON ON MMENU -->
            <div id="shopping-cart-box-ontop">
                <i class="fa fa-shopping-cart"></i>
                <div class="shopping-cart-box-ontop-content"></div>
            </div>
        </div>
    </div>

</div>
<!-- end header -->
  <div class="container">

    <!-- breadcrumb -->
    <?php if (isset($page) && $page != "home"): ?>
      <br/>
      <div class="breadcrumb clearfix">
          <?php echo (isset($breadcrumb)) ? $breadcrumb : "" ; ?>
      </div>
    <?php endif; ?>

    <!-- ./breadcrumb -->
  </div>
<!-- start of content -->
<?php $this->load->view($content); ?>
<!-- end of content -->
</div>
<!-- Footer -->
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <a href="#"><img src="/assets/images/logo/logo-black.png" alt="" /></a>
                        <div id="address-list">
                            <div class="tit-name">Address:</div>
                            <div class="tit-contain">Ruko H5 Pasar Laris Palm Paradise, Pegadungan Jakarta Barat</div>
                            <div class="tit-name">Phone:</div>
                            <div class="tit-contain">+xxx xxx xxx xxx</div>
                            <div class="tit-name">Email:</div>
                            <div class="tit-contain">info@agendafx.com</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="introduce-title">Company</div>
                            <ul id="introduce-company"  class="introduce-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <div class="introduce-title">My Account</div>
                            <ul id = "introduce-Account" class="introduce-list">
                                <li><a href="#">My Order</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">My Credit Slip</a></li>
                                <li><a href="#">My Addresses</a></li>
                                <li><a href="#">My Personal In</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <div class="introduce-title">Support</div>
                            <ul id = "introduce-support"  class="introduce-list">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Testimonials</a></li>
                                <li><a href="#">Affiliate Program</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
                        <div class="introduce-title">Let's Socialize</div>
                        <div class="social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div><!-- /#introduce-box -->

            <br>
            <!-- #trademark-text-box -->
            <div id="trademark-text-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-search-list" class="trademark-list">
                        <li class="trademark-text-tit">HOT SEARCHED KEYWORDS:</li>
                        <li><a href="#" >Jual Indikator</a></li>
                        <li><a href="#" >Indikator murah</a></li>
                        <li><a href="#" >Robot Trading</a></li>
                    </ul>
                </div>
            </div><!-- /#trademark-text-box -->
            <div id="footer-menu-box">
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Info perusahaan & Partnership</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Online Shopping</a></li>
                        <li><a href="#" >Promotions</a></li>
                        <li><a href="#" >My Orders</a></li>
                        <li><a href="#" >Help</a></li>
                        <li><a href="#" >Site Map</a></li>
                        <li><a href="#" >Customer Service</a></li>
                        <li><a href="#" >Support</a></li>
                    </ul>
                </div>
                <p class="text-center">Copyrights &#169; 2017 AgendaFX.</p>
            </div><!-- /#footer-menu-box -->
        </div>
</footer>

<a href="#" class="scroll_top" title="Scroll to Top" style="display: inline;">Scroll</a>
<!-- Script-->
<script type="text/javascript" src="/assets/lib/jquery/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/assets/lib/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/lib/select2/js/select2.min.js"></script>
<script type="text/javascript" src="/assets/lib/jquery.bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="/assets/lib/owl.carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="/assets/lib/jquery.countdown/jquery.countdown.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.actual.min.js"></script>
<script type="text/javascript" src="/assets/js/theme-script.js"></script>
<script type="text/javascript" src="/assets/js/category-page.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<?php $status = 'success'; if ($this->session->flashdata('success')): ?>
<script>
  toastr.<?php echo $status; ?>('<?php echo $this->session->flashdata('success') ?>')
</script>
<?php endif; ?>
<?php $status = 'warning'; if ($this->session->flashdata('warning')): ?>
<script>
  toastr.<?php echo $status; ?>('<?php echo $this->session->flashdata('warning') ?>')
</script>
<?php endif; ?>
<?php $status = 'error'; if ($this->session->flashdata('error')): ?>
<script>
  toastr.<?php echo $status; ?>('<?php echo $this->session->flashdata('error') ?>')
</script>
<?php endif; ?>
<?php echo put_headers(); ?>
</body>
</html>
