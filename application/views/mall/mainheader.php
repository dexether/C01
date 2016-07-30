
<div class="navbar-before mobile-hidden">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <p class="navbar-before-sign"><?php echo $this->lang->line('header_welcome_title'). " ".$this->config->item('APP_TITLE'); ?></p>
                    </div>
                    <div class="col-md-6">
                        <ul class="nav navbar-nav navbar-right navbar-right-no-mar">
                            <li><a href="#"><?php echo $this->lang->line('header_menu_about'); ?></a>
                            </li>
                            <li><a href="#"><?php echo $this->lang->line('header_menu_contact'); ?></a>
                            </li>
                            <li><a href="#"><?php echo $this->lang->line('header_menu_faq'); ?></a>
                            </li>
                            <li><a href="#"><?php echo $this->lang->line('header_menu_help'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <nav class="navbar navbar-inverse navbar-main yamm">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#main-nav-collapse" area_expanded="false"><span class="sr-only">Main Menu</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url('assets') ?>/img/logo-w.png" alt="Image Alternative text" title="Image Title" />
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="main-nav-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a href="#"><i class="fa fa-reorder"></i>&nbsp; <?php echo $this->lang->line('header_cat_title'); ?><i class="drop-caret" data-toggle="dropdown"></i></a>
                            <ul class="dropdown-menu dropdown-menu-category">
                                <!-- <li><a href="#"><i class="fa fa-home dropdown-menu-category-icon"></i>Home & Garden</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Home & Garden</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Home</a>
                                                                <p>Habitant vehicula dui lacus ante</p>
                                                            </li>
                                                            <li><a href="#">Kitchen</a>
                                                                <p>Turpis massa malesuada bibendum et</p>
                                                            </li>
                                                            <li><a href="#">Furniture & Decor</a>
                                                                <p>Taciti aenean facilisi accumsan tincidunt</p>
                                                            </li>
                                                            <li><a href="#">Bedding & Bath</a>
                                                                <p>Praesent adipiscing nibh penatibus scelerisque</p>
                                                            </li>
                                                            <li><a href="#">Appilances</a>
                                                                <p>Consequat viverra sapien vulputate ultricies</p>
                                                            </li>
                                                            <li><a href="#">Patio, Lawn & Garden</a>
                                                                <p>Parturient hendrerit mattis eu natoque</p>
                                                            </li>
                                                            <li><a href="#">Wedding Registry</a>
                                                                <p>Vitae auctor mollis donec posuere</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Home Improvement</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Home Improvement</a>
                                                                <p>Tortor mollis mi diam porttitor</p>
                                                            </li>
                                                            <li><a href="#">Lamps & Light Fixtures</a>
                                                                <p>Nostra a libero potenti nulla</p>
                                                            </li>
                                                            <li><a href="#">Kitchen & Bath Fixtures</a>
                                                                <p>Nisi cum orci tristique sagittis</p>
                                                            </li>
                                                            <li><a href="#">Home Automation</a>
                                                                <p>Habitant posuere facilisi mollis ornare</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/2-i.png" alt="Image Alternative text" title="Image Title" style="right: -10px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-diamond dropdown-menu-category-icon"></i>Jewelry</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Jewelry</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Necklances & Pendants</a>
                                                                <p>Nunc cum felis cubilia nunc</p>
                                                            </li>
                                                            <li><a href="#">Bracelets</a>
                                                                <p>Fames class justo lacus condimentum</p>
                                                            </li>
                                                            <li><a href="#">Rings</a>
                                                                <p>Fusce neque elementum inceptos ad</p>
                                                            </li>
                                                            <li><a href="#">Errings</a>
                                                                <p>Dui risus metus nisi justo</p>
                                                            </li>
                                                            <li><a href="#">Wedding & Engagement</a>
                                                                <p>Et feugiat arcu rutrum laoreet</p>
                                                            </li>
                                                            <li><a href="#">Charms</a>
                                                                <p>Curabitur suspendisse integer magna sodales</p>
                                                            </li>
                                                            <li><a href="#">Booches</a>
                                                                <p>Vestibulum tempor cum purus suscipit</p>
                                                            </li>
                                                            <li><a href="#">Men's Jewelry</a>
                                                                <p>Euismod nunc porta magna elementum</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Jewelry Shops</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Contemporary & Designer</a>
                                                                <p>Penatibus amet gravida sit ligula</p>
                                                            </li>
                                                            <li><a href="#">Juniors</a>
                                                                <p>Odio id nunc proin sem</p>
                                                            </li>
                                                            <li><a href="#">Meternity</a>
                                                                <p>Augue quis posuere interdum in</p>
                                                            </li>
                                                            <li><a href="#">Pettite</a>
                                                                <p>Sapien congue rutrum scelerisque sociosqu</p>
                                                            </li>
                                                            <li><a href="#">Uniforms, Works & Safety</a>
                                                                <p>Cubilia ridiculus et luctus mollis</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/3-i.png" alt="Image Alternative text" title="Image Title" style="right: -10px; bottom: -10px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-child dropdown-menu-category-icon"></i>Toy & Kids</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Kids Clothing</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Accessories</a>
                                                                <p>Praesent est semper massa lobortis</p>
                                                            </li>
                                                            <li><a href="#">Active Wear</a>
                                                                <p>Quisque lectus ridiculus hac eget</p>
                                                            </li>
                                                            <li><a href="#">Coats & Jackets</a>
                                                                <p>Leo morbi enim nullam lacinia</p>
                                                            </li>
                                                            <li><a href="#">Jeans</a>
                                                                <p>Nam lobortis lacus lorem adipiscing</p>
                                                            </li>
                                                            <li><a href="#">Sets</a>
                                                                <p>Taciti nisl dictum parturient rutrum</p>
                                                            </li>
                                                            <li><a href="#">Indoors</a>
                                                                <p>Nulla ornare pharetra auctor leo</p>
                                                            </li>
                                                            <li><a href="#">Swimwear</a>
                                                                <p>Litora scelerisque at mus praesent</p>
                                                            </li>
                                                            <li><a href="#">Special Occasion</a>
                                                                <p>Erat non ullamcorper accumsan quis</p>
                                                            </li>
                                                            <li><a href="#">Shoes</a>
                                                                <p>Ante viverra lectus mauris eleifend</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">More For Kids</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Kids Furniture</a>
                                                                <p>Pulvinar nibh eros malesuada parturient</p>
                                                            </li>
                                                            <li><a href="#">Kids Jewelry & Watches</a>
                                                                <p>Nam donec porta placerat varius</p>
                                                            </li>
                                                            <li><a href="#">Toys & Games</a>
                                                                <p>Auctor cursus felis sit augue</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/4-i.png" alt="Image Alternative text" title="Image Title" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-plug dropdown-menu-category-icon"></i>Electronics</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Electronics</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">TV & Video</a>
                                                                <p>Purus malesuada semper varius rutrum</p>
                                                            </li>
                                                            <li><a href="#">Home Audio & Theater</a>
                                                                <p>Praesent vulputate tempus conubia ut</p>
                                                            </li>
                                                            <li><a href="#">Camera, Photo & Video</a>
                                                                <p>Venenatis nostra consequat nostra sem</p>
                                                            </li>
                                                            <li><a href="#">Cell Phones & Accessories</a>
                                                                <p>Hac nisi proin convallis sociosqu</p>
                                                            </li>
                                                            <li><a href="#">Headphones</a>
                                                                <p>Ullamcorper quis adipiscing est tristique</p>
                                                            </li>
                                                            <li><a href="#">Video Games</a>
                                                                <p>Ornare augue himenaeos ullamcorper tincidunt</p>
                                                            </li>
                                                            <li><a href="#">Gar Electronics</a>
                                                                <p>Imperdiet hac sapien lacus montes</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Computers</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Laptops & Tablets</a>
                                                                <p>Velit tempus quis ornare iaculis</p>
                                                            </li>
                                                            <li><a href="#">Desktops & Monitors</a>
                                                                <p>Adipiscing sociis eu habitant nam</p>
                                                            </li>
                                                            <li><a href="#">Computer Accessories</a>
                                                                <p>Consequat mus augue fringilla nisi</p>
                                                            </li>
                                                            <li><a href="#">Software</a>
                                                                <p>Ante euismod porta primis taciti</p>
                                                            </li>
                                                            <li><a href="#">Printers & Ink</a>
                                                                <p>Donec maecenas maecenas netus mollis</p>
                                                            </li>
                                                            <li><a href="#">Networking</a>
                                                                <p>Amet feugiat felis mattis duis</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/5-i.png" alt="Image Alternative text" title="Image Title" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-tags dropdown-menu-category-icon"></i>Clothes & Shoes</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">TheBox Fashion</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Woman</a>
                                                                <p>Eleifend ornare sodales habitasse per</p>
                                                            </li>
                                                            <li><a href="#">Men</a>
                                                                <p>Pharetra quam euismod nisl viverra</p>
                                                            </li>
                                                            <li><a href="#">Girls</a>
                                                                <p>Vel iaculis massa pharetra per</p>
                                                            </li>
                                                            <li><a href="#">Boys</a>
                                                                <p>Leo fusce gravida nulla suscipit</p>
                                                            </li>
                                                            <li><a href="#">Baby</a>
                                                                <p>Neque augue ad lectus dignissim</p>
                                                            </li>
                                                            <li><a href="#">Luggage</a>
                                                                <p>Lorem netus morbi ornare nullam</p>
                                                            </li>
                                                            <li><a href="#">Accessories</a>
                                                                <p>Montes ad ullamcorper conubia non</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/6-i.png" alt="Image Alternative text" title="Image Title" style="right: -20px;" />
                                        </div>
                                    </div>
                                </li> -->
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Analisa</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-analisa'; ?>">Forex Analisa</a>
                                                                <p>Berbagai Analisa tentang Forex</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Buku</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-book'; ?>">Buku Finansial</a>
                                                                <p>Menjual Semua tentang Buku</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Edukasi</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-education'; ?>">Edukasi Finansial</a>
                                                                <p>Menjual Semua tentang Edukasi Finansial</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>EA & Bots</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-robot'; ?>">Forex EA</a>
                                                                <p>Menjual Semua tentang EA & Bot</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Indikator</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-indicator'; ?>">Indikator Forex</a>
                                                                <p>Menjual Semua tentang Indikator</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                                <!--  <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Produk</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Indikator Forex</a>
                                                                <p>Menjual Semua tentang Indikator</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li> -->
                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Seminar</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="<?php echo base_url().'c/forex-seminar'; ?>">Seminar Finansial</a>
                                                                <p>Semua tentang seminar Finansial</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/seminar.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>


                               <!--  <li><a href="#"><i class="fa fa-music dropdown-menu-category-icon"></i>Entertaiment</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Entertaiment</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Video Games & Consoles</a>
                                                                <p>Leo ante tortor facilisis turpis</p>
                                                            </li>
                                                            <li><a href="#">Music</a>
                                                                <p>Nunc est luctus elementum himenaeos</p>
                                                            </li>
                                                            <li><a href="#">DVD & Movies</a>
                                                                <p>Fames phasellus ullamcorper hendrerit eget</p>
                                                            </li>
                                                            <li><a href="#">Tickets</a>
                                                                <p>Purus tortor dui quisque ad</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Memorabilia</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Autographs</a>
                                                            </li>
                                                            <li><a href="#">Movie</a>
                                                            </li>
                                                            <li><a href="#">Music</a>
                                                            </li>
                                                            <li><a href="#">Television</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/9-i.png" alt="Image Alternative text" title="Image Title" style="right: -27px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-location-arrow dropdown-menu-category-icon"></i>Travel</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Travel Equepment</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Luggage</a>
                                                                <p>Pellentesque a conubia habitant dapibus</p>
                                                            </li>
                                                            <li><a href="#">Travel Accessories</a>
                                                                <p>Feugiat aenean auctor tortor eu</p>
                                                            </li>
                                                            <li><a href="#">Luggage Accessories</a>
                                                                <p>Porta aliquam sem lobortis sollicitudin</p>
                                                            </li>
                                                            <li><a href="#">Lodging</a>
                                                                <p>Neque id vestibulum porttitor nam</p>
                                                            </li>
                                                            <li><a href="#">Maps</a>
                                                                <p>Natoque id vitae fames suscipit</p>
                                                            </li>
                                                            <li><a href="#">Other Travel</a>
                                                                <p>Scelerisque tincidunt per dolor semper</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Booking</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Vacation Packages</a>
                                                                <p>Curabitur volutpat auctor mi a</p>
                                                            </li>
                                                            <li><a href="#">Campground & RV</a>
                                                                <p>Consectetur lectus mi cras imperdiet</p>
                                                            </li>
                                                            <li><a href="#">Rail</a>
                                                                <p>Rutrum turpis sagittis ornare aptent</p>
                                                            </li>
                                                            <li><a href="#">Car Rental</a>
                                                                <p>Eros pharetra elementum proin phasellus</p>
                                                            </li>
                                                            <li><a href="#">Cruises</a>
                                                                <p>Accumsan ad rutrum rhoncus metus</p>
                                                            </li>
                                                            <li><a href="#">Airline</a>
                                                                <p>Faucibus pharetra nisl ipsum vestibulum</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/11-i.png" alt="Image Alternative text" title="Image Title" style="right: -100px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-picture-o dropdown-menu-category-icon"></i>Art & Design</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Art</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Paintings from Dealers & Resellers</a>
                                                                <p>Iaculis sapien justo fusce hac</p>
                                                            </li>
                                                            <li><a href="#">Paintings Direct from Artist</a>
                                                                <p>Lacus purus erat nibh commodo</p>
                                                            </li>
                                                            <li><a href="#">Art Prints</a>
                                                                <p>Consequat augue mollis tristique quis</p>
                                                            </li>
                                                            <li><a href="#">Art Photographs from Resellers</a>
                                                                <p>Nunc dapibus lacinia id etiam</p>
                                                            </li>
                                                            <li><a href="#">Art Photographs from the Artist</a>
                                                                <p>Velit ridiculus dolor sodales tellus</p>
                                                            </li>
                                                            <li><a href="#">Art Posters</a>
                                                                <p>Mi varius placerat himenaeos sagittis</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Design</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Home Decor Decals</a>
                                                                <p>Senectus orci lacus curabitur nam</p>
                                                            </li>
                                                            <li><a href="#">Furniture</a>
                                                                <p>Arcu metus posuere himenaeos risus</p>
                                                            </li>
                                                            <li><a href="#">Wallpapers</a>
                                                                <p>Nostra ante vivamus cubilia dapibus</p>
                                                            </li>
                                                            <li><a href="#">Bar Flasks</a>
                                                                <p>Et nisl vulputate cursus vestibulum</p>
                                                            </li>
                                                            <li><a href="#">Posters & Prints</a>
                                                                <p>Velit placerat arcu eleifend eros</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/12-i.png" alt="Image Alternative text" title="Image Title" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-motorcycle dropdown-menu-category-icon"></i>Motors</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Motors</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Parts & Accessories</a>
                                                                <p>Ante sit penatibus eleifend lectus</p>
                                                            </li>
                                                            <li><a href="#">Cars & Trucks</a>
                                                                <p>Varius habitant commodo platea hac</p>
                                                            </li>
                                                            <li><a href="#">Motorcycles</a>
                                                                <p>Tempus natoque curabitur nam hac</p>
                                                            </li>
                                                            <li><a href="#">Passenger Vehicles</a>
                                                                <p>Tellus per mattis himenaeos potenti</p>
                                                            </li>
                                                            <li><a href="#">Industry Vehicles</a>
                                                                <p>Neque pharetra ad fermentum proin</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Brands</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">BMW</a>
                                                            </li>
                                                            <li><a href="#">Land Rover</a>
                                                            </li>
                                                            <li><a href="#">Nissan</a>
                                                            </li>
                                                            <li><a href="#">Honda</a>
                                                            </li>
                                                            <li><a href="#">Ford</a>
                                                            </li>
                                                            <li><a href="#">Porsche</a>
                                                            </li>
                                                            <li><a href="#">Audi</a>
                                                            </li>
                                                            <li><a href="#">Mercedes-Benz</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/13-i.png" alt="Image Alternative text" title="Image Title" style="right: -15px; bottom: -15px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-paw dropdown-menu-category-icon"></i>Pets</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <h5 class="dropdown-menu-category-title">Pet Supplies</h5>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Backyard Poultry Supplies</a>
                                                                <p>Leo sem etiam quis lobortis</p>
                                                            </li>
                                                            <li><a href="#">Bird Supplies</a>
                                                                <p>Magna malesuada in sit lacinia</p>
                                                            </li>
                                                            <li><a href="#">Cat Supplies</a>
                                                                <p>Nostra tortor malesuada donec fusce</p>
                                                            </li>
                                                            <li><a href="#">Dog Supplies</a>
                                                                <p>Non vel ut tincidunt iaculis</p>
                                                            </li>
                                                            <li><a href="#">Pet Memorials & Urns</a>
                                                                <p>Curabitur dolor vivamus molestie nascetur</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Fish & Aquariums</a>
                                                                <p>Class sociosqu ut dapibus dui</p>
                                                            </li>
                                                            <li><a href="#">Horse Supplies</a>
                                                                <p>Diam ultricies lacinia parturient dui</p>
                                                            </li>
                                                            <li><a href="#">Reptile Supplies</a>
                                                                <p>Fusce fames a pharetra metus</p>
                                                            </li>
                                                            <li><a href="#">Small Animal Supplies</a>
                                                                <p>Et hac ridiculus fermentum fames</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Wholesale Lots</a>
                                                                <p>Faucibus eget bibendum taciti venenatis</p>
                                                            </li>
                                                            <li><a href="#">Other Pet Supplies</a>
                                                                <p>Eros orci ultricies tortor netus</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/14-i.png" alt="Image Alternative text" title="Image Title" style="right: -15px;" />
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fa fa-cubes dropdown-menu-category-icon"></i>Hobbies & DIY</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Hobby & DIY</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="#">Model & Kit Tools</a>
                                                                <p>Aenean tincidunt interdum lobortis aliquam</p>
                                                            </li>
                                                            <li><a href="#">Supplies & Engines</a>
                                                                <p>Auctor dis nunc penatibus diam</p>
                                                            </li>
                                                            <li><a href="#">RC Airline & Helicopter</a>
                                                                <p>Interdum nascetur id etiam erat</p>
                                                            </li>
                                                            <li><a href="#">RC Car, Truck & motorcycle</a>
                                                                <p>Consequat cursus viverra litora nullam</p>
                                                            </li>
                                                            <li><a href="#">Military Airline Models & Kits</a>
                                                                <p>Lorem id elit varius eu</p>
                                                            </li>
                                                            <li><a href="#">Craft Airbrushing Supplies</a>
                                                                <p>Auctor fermentum inceptos arcu cras</p>
                                                            </li>
                                                            <li><a href="#">Card Making Supplies</a>
                                                                <p>Ullamcorper sodales rhoncus dictum proin</p>
                                                            </li>
                                                            <li><a href="#">Craft Sewing</a>
                                                                <p>Nullam tincidunt euismod accumsan netus</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/15-i.png" alt="Image Alternative text" title="Image Title" style="height: 100%;" />
                                        </div>
                                    </div>
                                </li> -->
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left navbar-main-search" role="search">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('header_field_seacrh'); ?>" />
                        </div>
                        <a class="fa fa-search navbar-main-search-submit" href="#"></a>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                    	<?php if (!$this->nativesession->getObject('username')) {
                    		# code...
                    	?>
                        <li><a href="<?php echo base_url(); ?>web2/index.php?redirect=<?php echo base_url() ?>" ><?php echo $this->lang->line('header_menu_sign'); ?></a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>web2/openaccount.php?cabang=1"><?php echo $this->lang->line('header_menu_register'); ?></a>
                        </li>
                        <?php }else{ ?>
                        <li><a href="<?php echo base_url(); ?>web2/mainmenu.php" target="_blank"><?php echo $this->lang->line('header_menu_myagenda'); ?></a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>auth/logout"><?php echo $this->lang->line('header_menu_logout'); ?></a>
                        </li>
                        <?php } ?>
                        <li><a class="fa fa-shopping-cart" href="<?php echo base_url('cart') ?>"></a>
                        </li>
                      
                    </ul>
                </div>
            </div>
        </nav>