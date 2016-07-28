<div class="container">
            <header class="page-header">
                <!-- <ol class="breadcrumb page-breadcrumb">
                    <li><a href="#">Home</a>
                    </li>
                    <li><a href="#">Clothing, Shoes & Accessories</a>
                    </li>
                    <li><a href="#">Women's Handbags & Bags</a>
                    </li>
                    <li class="active">Vera Bradley Round Travel Bag</li>
                </ol> -->
            </header>
            <div class="row">
                <div class="col-md-6">
                    <div class="product-page-product-wrap jqzoom-stage jqzoom-stage-lg">
                        <div class="clearfix">
                            <a href="<?php echo base_url() ?>/assets/img/product/1.jpg" id="jqzoom" data-rel="gal-1">
                                <img src="<?php echo base_url() ?>/assets/img/product/1.jpg" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </div>
                    </div>
                    <!-- <ul class="jqzoom-list">
                        <li>
                            <a class="zoomThumbActive" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url() ?>/assets/img/500x500.png', largeimage: '<?php echo base_url() ?>/assets/img/800x800.png'}">
                                <img src="<?php echo base_url() ?>/assets/img/100x100.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url() ?>/assets/img/500x500.png', largeimage: '<?php echo base_url() ?>/assets/img/800x800.png'}">
                                <img src="<?php echo base_url() ?>/assets/img/100x100.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url() ?>/assets/img/500x500.png', largeimage: '<?php echo base_url() ?>/assets/img/800x800.png'}">
                                <img src="<?php echo base_url() ?>/assets/img/100x100.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url() ?>/assets/img/500x500.png', largeimage: '<?php echo base_url() ?>/assets/img/800x800.png'}">
                                <img src="<?php echo base_url() ?>/assets/img/100x100.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url() ?>/assets/img/500x500.png', largeimage: '<?php echo base_url() ?>/assets/img/800x800.png'}">
                                <img src="<?php echo base_url() ?>/assets/img/100x100.png" alt="Image Alternative text" title="Image Title" />
                            </a>
                        </li>
                    </ul> -->
                </div>
                <div class="col-md-6">
                    <div class="_box-highlight">
                        <ul class="product-page-product-rating">
                            <?php
                            for ($i=0; $i < $data['title']['prod_star']; $i++) { 
                                # code...
                                echo '<li class="rated"><i class="fa fa-star"></i></li>';
                            }
                            if ($i <= '5') {
                                for ($i2=0; $i2 < 5-$i; $i2++) { 
                                    # code...
                                    echo '<li><i class="fa fa-star"></i></li>';
                                }
                            }
                            
                            ?>
                            
                            <!-- <li class="rated"><i class="fa fa-star"></i>
                            </li>
                            <li class="rated"><i class="fa fa-star"></i>
                            </li>
                            <li class="rated"><i class="fa fa-star"></i>
                            </li>
                            <li><i class="fa fa-star"></i>
                            </li> -->
                        </ul>
                        <p class="product-page-product-rating-sign"><a href="#">238 customer reviews</a>
                        </p>
                        <h1><?php echo $data['title']['prod_alias'] ?></h1>
                        <p class="product-page-price"><?php echo "Rp. ". number_format($data['title']['prod_price']); ?></p>
                        <!-- <p class="text-muted text-sm">Free Shipping</p> -->
                        <p class="product-page-desc-lg"><?php echo $data['title']['prod_desc'] ?></p>
                        <!-- <ul class="product-page-option-list">
                            <li class="clearfix">
                                <h5 class="product-page-option-title">Color</h5>
                                <select class="product-page-option-select">
                                    <option selected>Clementine</option>
                                    <option>Fanfare</option>
                                    <option>Flower Shower</option>
                                    <option>Flutterby</option>
                                    <option>Petal Paisley</option>
                                    <option>Ziggy Zinnia</option>
                                </select>
                            </li>
                            <li class="clearfix">
                                <h5 class="product-page-option-title">Size</h5>
                                <select class="product-page-option-select">
                                    <option selected>Normal</option>
                                    <option>Large</option>
                                    <option>Small</option>
                                </select>
                            </li>
                        </ul> -->
                        <ul class="product-page-actions-list">
                            <li class="product-page-qty-item">
                                <button class="product-page-qty product-page-qty-minus">-</button>
                                <input class="product-page-qty product-page-qty-input" type="text" value="1" />
                                <button class="product-page-qty product-page-qty-plus">+</button>
                            </li>
                            <li><a class="btn btn-lg btn-primary" href="#"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                            </li>
                            <li><a class="btn btn-lg btn-default" href="#"><i class="fa fa-star"></i>Wishlist</a>
                            </li>
                        </ul>
                        <div class="gap gap-small"></div>
                    </div>
                </div>
            </div>
            <div class="gap"></div>
            <div class="tabbable product-tabs">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#tab-1" data-toggle="tab">Description</a>
                    </li>
                    <!-- <li><a href="#tab-2" data-toggle="tab">Additional Information</a>
                    </li>
                    <li><a href="#tab-3" data-toggle="tab">Rating and Reviews</a>
                    </li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-1">
                    <?php echo $data['title']['prod_desc_long'] ?>
                        <!-- <p>Imperdiet fusce viverra mollis taciti lectus scelerisque augue quisque felis posuere nulla facilisis scelerisque pharetra quisque dignissim elit diam nisi penatibus magnis dapibus pretium lacinia torquent convallis egestas posuere
                            etiam</p>
                        <p>Aliquam posuere duis a fringilla enim dictum tortor accumsan litora</p> -->
                    </div>
                   <!--  <div class="tab-pane fade" id="tab-2">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Weight:</td>
                                    <td>0.3 kg</td>
                                </tr>
                                <tr>
                                    <td>Dimensions:</td>
                                    <td>20 ½" W x 12" H x 10 ¾" D with 9" strap drop and 52" removable, adjustable strap</td>
                                </tr>
                                <tr>
                                    <td>Materials :</td>
                                    <td>100% Cotton</td>
                                </tr>
                                <tr>
                                    <td>Care Tips:</td>
                                    <td>Machine wash cold, gentle cycle, only non-chlorine bleach when needed; line dry</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-3">
                        <div class="row">
                            <div class="col-md-8">
                                <article class="product-review">
                                    <div class="product-review-author">
                                        <img class="product-review-author-img" src="<?php echo base_url() ?>/assets/img/70x70.png" alt="Image Alternative text" title="Image Title" />
                                    </div>
                                    <div class="product-review-content-full">
                                        <h5 class="product-review-title">Terrific Buy!</h5>
                                        <ul class="product-page-product-rating">
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <p class="product-review-meta">by Alison Mackenzie on 08/14/2015</p>
                                        <p class="product-review-body">Aliquam nam gravida hendrerit primis class egestas primis porta egestas non eleifend risus turpis commodo nisi felis nullam risus aliquam curae fusce elit est ornare</p>
                                        <p class="text-success"><strong><i class="fa fa-check"></i> I would recommend this to a friend!</strong>
                                        </p>
                                        <ul class="list-inline product-review-actions">
                                            <li><a href="#"><i class="fa fa-flag"></i> Flag this review</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-comment"></i> Comment review</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <article class="product-review">
                                    <div class="product-review-author">
                                        <img class="product-review-author-img" src="<?php echo base_url() ?>/assets/img/70x70.png" alt="Image Alternative text" title="Image Title" />
                                    </div>
                                    <div class="product-review-content-full">
                                        <h5 class="product-review-title">Too Big. Unusable.</h5>
                                        <ul class="product-page-product-rating">
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                            <li><i class="fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <p class="product-review-meta">by Keith Churchill on 08/14/2015</p>
                                        <p class="product-review-body">Lacus molestie aptent elementum nascetur a blandit aenean fusce eleifend hendrerit ac fringilla vehicula eget odio orci hac mauris tincidunt tellus</p>
                                        <p class="text-danger"><strong><i class="fa fa-close"></i> No, I would not recommend this to a friend.</strong>
                                        </p>
                                        <ul class="list-inline product-review-actions">
                                            <li><a href="#"><i class="fa fa-flag"></i> Flag this review</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-comment"></i> Comment review</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                                <article class="product-review">
                                    <div class="product-review-author">
                                        <img class="product-review-author-img" src="<?php echo base_url() ?>/assets/img/70x70.png" alt="Image Alternative text" title="Image Title" />
                                    </div>
                                    <div class="product-review-content-full">
                                        <h5 class="product-review-title">Worth it</h5>
                                        <ul class="product-page-product-rating">
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                            <li class="rated"><i class="fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <p class="product-review-meta">by Alison Mackenzie on 08/14/2015</p>
                                        <p class="product-review-body">Imperdiet maecenas suspendisse diam lorem nisi quis elit augue mus interdum porttitor ante</p>
                                        <p class="text-success"><strong><i class="fa fa-check"></i> I would recommend this to a friend!</strong>
                                        </p>
                                        <ul class="list-inline product-review-actions">
                                            <li><a href="#"><i class="fa fa-flag"></i> Flag this review</a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-comment"></i> Comment review</a>
                                            </li>
                                        </ul>
                                    </div>
                                </article>
                            </div>
                            <div class="col-md-4">
                                <h3 class="product-tab-rating-title">Overall Customer Rating:</h3>
                                <ul class="product-page-product-rating product-rating-big">
                                    <li class="rated"><i class="fa fa-star"></i>
                                    </li>
                                    <li class="rated"><i class="fa fa-star"></i>
                                    </li>
                                    <li class="rated"><i class="fa fa-star"></i>
                                    </li>
                                    <li class="rated"><i class="fa fa-star"></i>
                                    </li>
                                    <li class="rated"><i class="fa fa-star"></i>
                                    </li>
                                    <li class="count">4.9</li>
                                </ul><small>238 customer reviews</small>
                                <p><strong>98%</strong> of reviewers would recommend this product</p><a class="btn btn-primary" href="#">Write a Review</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="category-pagination-sign">238 customer reviews found. Showing 1 - 5</p>
                            </div>
                            <div class="col-md-6">
                                <nav>
                                    <ul class="pagination category-pagination pull-right">
                                        <li class="active"><a href="#">1</a>
                                        </li>
                                        <li><a href="#">2</a>
                                        </li>
                                        <li><a href="#">3</a>
                                        </li>
                                        <li><a href="#">4</a>
                                        </li>
                                        <li><a href="#">5</a>
                                        </li>
                                        <li class="last"><a href="#"><i class="fa fa-long-arrow-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="gap"></div>
            <!-- Start Of pilihan Lain -->
            <!-- <h3 class="widget-title">You Might Also Like</h3>
            <div class="row" data-gutter="15">
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Hobo</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$56</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Chevron Large Slim Wristlet</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$141</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Claremont Field Bag</h5>
                            <div class="product-caption-price"><span class="product-caption-price-old">$110</span><span class="product-caption-price-new">$33</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>2 left</li>
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Claremont Dover</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$127</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>2 left</li>
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" data-gutter="15">
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
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
                            </ul>
                            <h5 class="product-caption-title">Vera Bradley Vera Tote Bag</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$84</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
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
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Hobo</h5>
                            <div class="product-caption-price"><span class="product-caption-price-old">$106</span><span class="product-caption-price-new">$75</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>1 left</li>
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Vera Bradley Mandy Tote Bag</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$93</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
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
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Lexington</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$69</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" data-gutter="15">
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Chevron Large Slim Wristlet</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$85</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>5 left</li>
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Hobo</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$100</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Dooney & Bourke Pebble Grain Lexington</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$126</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="product product-sm-left ">
                        <ul class="product-labels"></ul>
                        <div class="product-img-wrap">
                            <img class="product-img" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                        </div>
                        <a class="product-link" href="#"></a>
                        <div class="product-caption">
                            <ul class="product-caption-rating">
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                                <li class="rated"><i class="fa fa-star"></i>
                                </li>
                            </ul>
                            <h5 class="product-caption-title">Vera Bradley Vera Tote Bag</h5>
                            <div class="product-caption-price"><span class="product-caption-price-new">$80</span>
                            </div>
                            <ul class="product-caption-feature-list">
                                <li>Free Shipping</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>