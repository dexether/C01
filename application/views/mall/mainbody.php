<div class="gap gap-small"></div>
<div class="container">
    <!-- Today Promo -->
    <h3 class="widget-title-lg"><?php echo $this->lang->line('main_daily_promo_title') ?></h3>
    <div class="row row-sm-gap" data-gutter="10">
        <?php
        foreach ($promo as $key => $value) {
            # code...
            ?>
            <div class="col-md-4">
                <div class="product">
                    <ul class="product-labels">
                        <li>
                            <?php if(!$value['promo_alias'] == NULL){
                                echo $value['promo_alias'];
                            }
                            ?>
                        </li>
                    </ul>
                    <div class="product-img-wrap">
                        <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                        <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                    </div>
                    <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                    <div class="product-caption">
                    <!-- <ul class="product-caption-rating">
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li class="rated"><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                        <li><i class="fa fa-star"></i>
                        </li>
                    </ul> -->
                    <div class="my-rating" data-rating="4.5"></div>
                    <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                    <div class="product-caption-price">
                        <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                            echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                        }else{
                            echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                            echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                        }

                        ?>
                    </div>
                    <!-- <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul> -->
                </div>
            </div>
        </div>
        <?php 
    }
    ?>
</div>
<!-- End Of Today Promo -->
<div class="gap"></div>
<div class="row" data-gutter="15">
    <div class="col-md-4">
        <div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/backgrounds/categories-indicator.png);">
            <a class="banner-link" href="#"></a>
                       <!--  <div class="banner-caption-left">
                            <h5 class="banner-title">Discover The Mountains</h5>
                            <p class="banner-desc">Pro Backpacks 70% Off.</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>

                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/16-i.png" alt="Image Alternative text" title="Image Title" style="bottom: -68px; right: -32px; width: 200px;" /> -->
                    </div>
                </div>
                <div class="col-md-8">

                    <div class="banner banner-o-hid" style="background-image:url(http://placehold.it/750x200/2ecc71/fff);">
                        <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">Family Vacation Packs</h5>
                            <p class="banner-desc">Save Your Family Budget</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="banner banner-o-hid" style="background-color:#EA873B;">
                        <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">Made by Nature</h5>
                            <p class="banner-desc">Just for the Taste of Health</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/17-i.png" alt="Image Alternative text" title="Image Title" style="top: 17px; right: -45px; width: 350px;" />
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="banner banner-o-hid" style="background-image:url(http://placehold.it/560x200/2ecc71/fff);">
                        <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">Smartphones Under $80</h5>
                            <p class="banner-desc">Low Price for Great Perfomance</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/18-i.png" alt="Image Alternative text" title="Image Title" style="top: 17px; right: -45px; width: 350px;" />
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="banner banner-o-hid" style="background-image:url(<?php echo base_url() ?>assets/img/backgrounds/categories-indicator.png);">
                        <!-- <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">Back to School</h5>
                            <p class="banner-desc">Class is Almost in Session!</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/20-i.png" alt="Image Alternative text" title="Image Title" style="bottom: -20px; right: -60px; width: 240px;" /> -->
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="banner banner-o-hid" style="background-image:url(http://placehold.it/380x200/2ecc71/fff);">
                        <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">New Jeans Collection</h5>
                            <p class="banner-desc">Exeedingly Good Jeans</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/21-i.png" alt="Image Alternative text" title="Image Title" style="bottom: -29px; right: -51px; width: 240px;" />
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="banner banner-o-hid" style="background-image:url(http://placehold.it/380x200/2ecc71/fff);">
                        <a class="banner-link" href="#"></a>
                        <div class="banner-caption-left">
                            <h5 class="banner-title">Top Office Furniture</h5>
                            <p class="banner-desc">Officeized!!</p>
                            <p class="banner-shop-now">Shop Now <i class="fa fa-caret-right"></i>
                            </p>
                        </div>
                        <img class="banner-img" src="<?php echo base_url('assets') ?>/img/test_banner/23-i.png" alt="Image Alternative text" title="Image Title" style="bottom: -118px; right: 8px; width: 190px;" />
                    </div>
                </div>
            </div>
            <div class="gap"></div>
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_ea'); ?></h3>
           <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-robot'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>       
        </div>
        
        <div class="gap"></div>
        <div class="slider-item-sm" style="background-image:url(<?php echo base_url('assets') ?>/img/1200x500.png);">
            <div class="slider-item-mask"></div>
            <div class="container">
                <div class="slider-item-inner">
                    <div class="slider-item-caption-right slider-item-caption-white">
                        <h4 class="slider-item-caption-title">Trips To Paris Just from $99</h4>
                        <p class="slider-item-caption-desc">Make Someone Happy with a Paris.</p><a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start of books -->
        <div class="gap"></div>
        <div class="container">
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_book'); ?></h3>
            <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-book'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="gap"></div>
        <div class="slider-item-sm" style="background-color:#E66514;">
            <div class="container">
                <div class="slider-item-inner">
                    <div class="slider-item-caption-left slider-item-caption-white">
                        <h4 class="slider-item-caption-title">Time to Upgrade Your Smartphone</h4>
                        <p class="slider-item-caption-desc">It's Smartphone Time.</p><a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a>
                    </div>
                    <img class="slider-item-img" src="<?php echo base_url('assets') ?>/img/test_slider/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0; bottom: 0; width: 22%;" />
                </div>
            </div>
        </div>
        <!-- End Of book -->
        <!-- Start of indikator -->
        <div class="gap"></div>
        <div class="container">
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_indicator'); ?></h3>
            <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-indicator'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="gap"></div>
        <div class="slider-item-sm" style="background-color:#E66514;">
            <div class="container">
                <div class="slider-item-inner">
                    <div class="slider-item-caption-left slider-item-caption-white">
                        <h4 class="slider-item-caption-title">Time to Upgrade Your Smartphone</h4>
                        <p class="slider-item-caption-desc">It's Smartphone Time.</p><a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a>
                    </div>
                    <img class="slider-item-img" src="<?php echo base_url('assets') ?>/img/test_slider/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0; bottom: 0; width: 22%;" />
                </div>
            </div>
        </div>
        <!--  End of indikator -->
        <!-- Start of copytrade -->
       <!--  <div class="gap"></div>
        <div class="container">
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_copytrade'); ?></h3>
            <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-book'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="gap"></div>
        <div class="slider-item-sm" style="background-color:#E66514;">
            <div class="container">
                <div class="slider-item-inner">
                    <div class="slider-item-caption-left slider-item-caption-white">
                        <h4 class="slider-item-caption-title">Time to Upgrade Your Smartphone</h4>
                        <p class="slider-item-caption-desc">It's Smartphone Time.</p><a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a>
                    </div>
                    <img class="slider-item-img" src="<?php echo base_url('assets') ?>/img/test_slider/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0; bottom: 0; width: 22%;" />
                </div>
            </div>
        </div> -->
        <!-- End Of copytrade -->
        <!-- Start of Education -->
        <!-- <div class="gap"></div>
        <div class="container">
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_education'); ?></h3>
            <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-book'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="gap"></div>
        <div class="slider-item-sm" style="background-color:#E66514;">
            <div class="container">
                <div class="slider-item-inner">
                    <div class="slider-item-caption-left slider-item-caption-white">
                        <h4 class="slider-item-caption-title">Time to Upgrade Your Smartphone</h4>
                        <p class="slider-item-caption-desc">It's Smartphone Time.</p><a class="btn btn-lg btn-ghost btn-white" href="#">Shop Now</a>
                    </div>
                    <img class="slider-item-img" src="<?php echo base_url('assets') ?>/img/test_slider/7-i.png" alt="Image Alternative text" title="Image Title" style="right: 0; bottom: 0; width: 22%;" />
                </div>
            </div>
        </div> -->
        <!-- End Of education -->
        <!-- Start of merch -->
        <div class="gap"></div>
        <div class="container">
            <h3 class="widget-title-lg"><?php echo $this->lang->line('main_best_merch'); ?></h3>
            <div class="row row-sm-gap" data-gutter="10">
                <?php
                foreach ($brand['forex-merchandise'] as $key => $value) {
                    # code...
                    ?>
                    <div class="col-md-4">
                        <div class="product">
                            <ul class="product-labels">
                                <li>
                                    <?php if(!$value['promo_alias'] == NULL){
                                        echo $value['promo_alias'];
                                    }
                                    ?>
                                </li>
                            </ul>
                            <div class="product-img-wrap">
                                <img class="product-img-primary" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                                <img class="product-img-alt" src="<?php echo base_url() ?><?php echo $value['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                            </div>
                            <a class="product-link" href="<?php echo base_url()."c/".$value['cat_name']."/".$value['prod_name'] ?>"></a>
                            <div class="product-caption">

                                <div class="my-rating" data-rating="4.5"></div>
                                <h5 class="product-caption-title"><?php echo $value['prod_alias']; ?></h5>
                                <div class="product-caption-price">
                                    <?php if($value['promo_name'] == NULL || $value['promo_value'] == 0 ){
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['prod_price']).'</span>';
                                    }else{
                                        echo '<span class="product-caption-price-old">'.$this->format->set_rp($value['prod_price']).'</span>';
                                        echo '<span class="product-caption-price-new">'.$this->format->set_rp($value['final_price']).'</span>';
                                    }

                                    ?>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <?php 
                }
                ?>
            </div>
        </div>
        <div class="gap"></div>

        <script type="text/javascript">
            $(document).ready(function($) {
                $(".my-rating").starRating({
                    starSize: 25
                });
            }); 
        </script>