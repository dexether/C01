<div class="navbar-before mobile-hidden">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="navbar-before-sign"><?php echo $this->lang->line('header_welcome_title'). " ".$this->config->item('APP_TITLE'); ?></p>
            </div>
            <div class="col-md-6">
                <ul class="nav navbar-nav navbar-right navbar-right-no-mar">
                    <li><a href="<?php echo base_url('about-us') ?>"><?php echo $this->lang->line('header_menu_about'); ?></a>
                    </li>
                    <li><a href="mailto:<?php echo $this->config->item('faq_email') ?>?subject=Isi Judul Pesan anda"><?php echo $this->lang->line('header_menu_contact'); ?></a>
                    </li>
                    <li><a href="mailto:<?php echo $this->config->item('support_email') ?>?subject=Tanya AgendaFX"><?php echo $this->lang->line('header_menu_faq'); ?></a>
                    </li>
                    <li><a href="<?php echo base_url('help/how-to-sell') ?>">Cara jual</a>
                    </li>
                    <li><a href="<?php echo base_url('help/how-to-buy') ?>">Cara belanja</a>
                    </li>
                    <li><a href="<?php echo base_url('terms') ?>">Informasi pengguna</a>
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
                        <li><a href="<?php echo base_url().'c/forex-book'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Forex Books</a>
                            <!-- <div class="dropdown-menu-category-section">
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
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-education'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Forex Education</a>
                            <!-- <div class="dropdown-menu-category-section">
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
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-indicator'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Forex Indicator</a>
                            <!-- <div class="dropdown-menu-category-section">
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
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-merchandise'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Forex Merchandise</a>
                            <!-- <div class="dropdown-menu-category-section">
                                <div class="dropdown-menu-category-section-inner">
                                    <div class="dropdown-menu-category-section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="dropdown-menu-category-title">Forex</h5>
                                                <ul class="dropdown-menu-category-list">
                                                    <li><a href="<?php echo base_url().'c/forex-merchandise'; ?>">Forex Merchandise</a>
                                                        <p>Best Merchandise</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/seminar.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                </div>
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-robot'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>EA & Robotic</a>
                            <!-- <div class="dropdown-menu-category-section">
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
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-seminar'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Forex Seminar</a>
                            <!-- <div class="dropdown-menu-category-section">
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
                            </div> -->
                        </li>
                        <li><a href="<?php echo base_url().'c/forex-copytrade'; ?>"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Master Trader</a>
                            <!-- <div class="dropdown-menu-category-section">
                                <div class="dropdown-menu-category-section-inner">
                                    <div class="dropdown-menu-category-section-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5 class="dropdown-menu-category-title">Forex</h5>
                                                <ul class="dropdown-menu-category-list">
                                                    <li><a href="<?php echo base_url().'c/forex-copytrade'; ?>">Copytrade</a>
                                                        <p>Best Copytrade</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/seminar.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                </div>
                            </div> -->
                        </li>



                                <li><a href="#"><i class="fa fa-futbol-o dropdown-menu-category-icon"></i>Brokers</a>
                                    <div class="dropdown-menu-category-section">
                                        <div class="dropdown-menu-category-section-inner">
                                            <div class="dropdown-menu-category-section-content">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="dropdown-menu-category-title">Forex Brokers</h5>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="http://www.askapimperium.com" target="_blank">Askap Imperium</a>
                                                                <!-- <p>Askap Imperium</p> -->
                                                            </li>
                                                        </ul>
                                                        <ul class="dropdown-menu-category-list">
                                                            <li><a href="http://www.twofrx.com" target="_blank">Two Forex</a>
                                                                <!-- <p>Best Merchandise</p> -->
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <img class="dropdown-menu-category-section-theme-img" src="<?php echo base_url('assets') ?>/img/test_cat/seminar.png" alt="Image Alternative text" title="Image Title" style="right: 0px;" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <!-- <form class="navbar-form navbar-left navbar-main-search" role="search">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="<?php echo $this->lang->line('header_field_seacrh'); ?>" />
                        </div>
                        <a class="fa fa-search navbar-main-search-submit" href="#"></a>
                    </form> -->
                    <ul class="nav navbar-nav navbar-right">
                    	<?php if (!$this->nativesession->getObject('username')) {
                    		# code...
                           ?>
                           <li><a href="<?php echo base_url(); ?>web2/index.php?redirect=<?php echo urlencode(base_url()) ?>" ><?php echo $this->lang->line('header_menu_sign'); ?></a>
                           </li>
                           <li><a href="<?php echo base_url(); ?>web2/openaccount.php?cabang=1"><?php echo $this->lang->line('header_menu_register'); ?></a>
                           </li>
                           <li><a class="fa fa-shopping-cart" href="<?php echo base_url('cart') ?>" data-toggle="tooltip" title="Cart" data-placement="bottom"></a>
                           </li>
                           <?php }else{ ?>
                           </li>
                           <li><a href="<?php echo base_url('product/new'); ?>"><?php echo $this->lang->line('header_menu_sell'); ?></a>
                           </li>
                           <li><a class="fa fa-money" href="<?php echo base_url('payment/transactions') ?>" data-toggle="tooltip" title="Transaksi" data-placement="bottom"></a>
                           </li>
                           <li><a class="fa fa-shopping-cart" href="<?php echo base_url('cart') ?>" data-toggle="tooltip" title="Cart" data-placement="bottom"></a>
                           </li>
                           <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $this->format->getFirstNameWithEs($this->nativesession->getObject('aename'))." ".$this->lang->line('header_menu_myagenda'); ?></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url(); ?>web2/mainmenu.php">My Dashboard</a></li>
                              <li><a href="<?php echo base_url('myproduct'); ?>"><?php echo $this->lang->line('header_menu_myproduct'); ?></a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="<?php echo base_url(); ?>auth/logout"><?php echo $this->lang->line('header_menu_logout'); ?></a>
                              </li>
                            </ul>
                          </li>
                           <?php } ?>


                        </li>

                       </ul>
                   </div>
               </div>
           </nav>
