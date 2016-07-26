<div class="container">
    <header class="page-header">
    <h1 class="page-title"><?php echo $data['title']['cat_alias']; ?></h1>
        <ol class="breadcrumb page-breadcrumb">
            <li><?php echo $data['title']['cat_desc']; ?></li>
           
        </ol>
        <ul class="category-selections clearfix">
            <li>
                <a class="fa fa-th-large category-selections-icon active" href="#"></a>
            </li>
            <li>
                <a class="fa fa-th-list category-selections-icon" href="#"></a>
            </li>
            <li><span class="category-selections-sign">Sort by :</span>
                <select class="category-selections-select">
                    <option selected>Newest First</option>
                    <option>Best Sellers</option>
                    <option>Trending Now</option>
                    <option>Best Raited</option>
                    <option>Price : Lowest First</option>
                    <option>Price : Highest First</option>
                    <option>Title : A - Z</option>
                    <option>Title : Z - A</option>
                </select>
            </li>
            <li><span class="category-selections-sign">Items :</span>
                <select class="category-selections-select">
                    <option>9 / page</option>
                    <option selected>12 / page</option>
                    <option>18 / page</option>
                    <option>All</option>
                </select>
            </li>
        </ul>
    </header>
    <div class="row" data-gutter="15">
    <?php 
    $i = 0;
    $last = 12;
    for ($i=0; $i < $last; $i++) { 
        # code...
    ?>
        <div class="col-md-3">
            <div class="product ">
               <!--  <ul class="product-labels">
                    <li>-10%</li>
                    <li>hot</li>
                </ul> -->
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/product/1.jpg" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/product/1.jpg" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Indikator Forex - Profit Konsisten Minimal 5% Perhari Dari Modal</h5>
                    <div class="product-caption-price"><span class="product-caption-price-old">Rp 60.000</span><span class="product-caption-price-new">Rp 50.000</span>
                    </div>
                   <!--  <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul> -->
                </div>
            </div>
        </div>
        <?php  } ?>
    </div>
    <!-- <div class="row" data-gutter="15">
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels">
                    <li>stuff pick</li>
                </ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Timex Women's | Elevated Classics Swarovski Crystals Black Strap | Watch T2N450</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$142</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>5 left</li>
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Bulova Women's Dress 98V02 Silver Stainless-Steel Quartz Watch</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$134</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Fossil Women's Original Boyfriend ES3380 Rose-Gold Stainless-Steel Quartz Watch</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$88</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels">
                    <li>-50%</li>
                    <li>hot</li>
                </ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Bulova Fairlawn Women's Quartz Watch 96R160</h5>
                    <div class="product-caption-price"><span class="product-caption-price-old">$127</span><span class="product-caption-price-new">$64</span>
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
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Timex Women's | Elevated Classics Swarovski Crystals Black Strap | Watch T2N450</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$126</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>2 left</li>
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">WENGER WOMEN'S STAINLESS STEEL DATE NEW WATCH 0721.102</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$60</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">TechnoMarine Sea Pearl Women's Quartz Watch 714001</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$104</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="product ">
                <ul class="product-labels"></ul>
                <div class="product-img-wrap">
                    <img class="product-img-primary" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
                    <img class="product-img-alt" src="<?php echo base_url() ?>/assets/img/500x500.png" alt="Image Alternative text" title="Image Title" />
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
                    <h5 class="product-caption-title">Bulova Women's Dress 98V02 Silver Stainless-Steel Quartz Watch</h5>
                    <div class="product-caption-price"><span class="product-caption-price-new">$142</span>
                    </div>
                    <ul class="product-caption-feature-list">
                        <li>Free Shipping</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="category-pagination-sign">58 items found in Cell Phones. Showing 1 - 12</p>
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
    </div> -->
</div>