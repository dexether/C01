
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $data['title']['prod_alias'] ?> review</h4>
      </div>
      <div class="modal-body">

        <?php
        echo form_open('Buy_sell/setReviewsByUser', array('name' => 'modalForm'));
        ?>
        <input type="hidden" name="star"/>
        <?php echo form_hidden('productIdentification', $this->encrypt->encode($data['title']['id'])) ?>
 <div class="form-group">
   <label for="email">Judul reviews</label>
   <input type="text" class="form-control" name="subject" required>
 </div>
 <div class="form-group">
   <label for="pwd">Komentar</label>
   <?php echo form_textarea(array('class' => 'form-control', 'name' => 'komentar', 'required' => 'true')); ?>
 </div>
 <div class="form-group">
   <label for="pwd">Pilih bintang</label>
    <div class="my-rating-clicked" data-rating="0"></div>
 </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Review</button>
      </div>
      <?php echo form_close() ?>
    </div>
  </div>
</div>
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
                  <!-- <div class="col-md-5"> -->
                   <div class="product-page-product-wrap jqzoom-stage">
                       <div class="clearfix">
                           <a href="<?php echo base_url().$data['title']['prod_images']; ?>" id="jqzoom" data-rel="gal-1">
                               <img src="<?php echo base_url().$data['title']['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                           </a>
                       </div>
                   </div>
                   <ul class="jqzoom-list">
                       <li>
                           <a class="zoomThumbActive" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url().$data['title']['prod_images']; ?>', largeimage: '<?php echo base_url().$data['title']['prod_images']; ?>'}">
                               <img src="<?php echo base_url().$data['title']['prod_images']; ?>" alt="Image Alternative text" title="Image Title" />
                           </a>
                       </li>
                        <?php
                        foreach ($images as $key => $value) {
                            ?>
                         <li>
                            <a href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '<?php echo base_url($value->image_location) ?>', largeimage: '<?php echo base_url($value->image_location) ?>'}">
                               <img src="<?php echo base_url($value->image_location) ?>" alt="Image Alternative text" title="Image Title" />
                           </a>
                        </li>
                        <?php } ?>

                   </ul>

                </div>
                <div class="col-md-6">
                    <div class="_box-highlight">
                        <ul class="product-page-product-rating">
                            <!-- avg_rating -->
                            <div class="my-rating" data-rating="<?php echo $reviews['count']['avg_rating'] ?>"></div>
                        </ul>
                        <p class="product-page-product-rating-sign"><a href="#"><?php echo $reviews['count']['count_review'] ?> customer reviews</a>
                        </p>
                        <h1><?php echo $data['title']['prod_alias'] ?></h1>
                        <p class="product-page-price">

                        <?php echo "Rp. ". number_format($data['title']['final_price']); ?>
                        </p>
                        <!-- <p class="text-muted text-sm">Free Shipping</p> -->
                        <div class="gap-small"></div>
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
                            <!-- <li class="product-page-qty-item">
                                <button class="product-page-qty product-page-qty-minus">-</button>
                                <input class="product-page-qty product-page-qty-input" type="text" value="1" />
                                <button class="product-page-qty product-page-qty-plus">+</button>
                            </li> -->
                            <li><a class="btn btn-lg btn-primary" href="<?php echo base_url()."cart/add/".$data['title']['prod_name']."/1" ?>"><i class="fa fa-shopping-cart"></i>Add to Cart</a>
                            </li>
                            <!-- <li><a class="btn btn-lg btn-default" href="#"><i class="fa fa-star"></i>Wishlist</a> -->
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
                    </li> -->
                    <li><a href="#tab-3" data-toggle="tab">Rating and Reviews</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab-1">
                    <?php echo $data['title']['prod_desc_long'] ?>
                        <!-- <p>Imperdiet fusce viverra mollis taciti lectus scelerisque augue quisque felis posuere nulla facilisis scelerisque pharetra quisque dignissim elit diam nisi penatibus magnis dapibus pretium lacinia torquent convallis egestas posuere
                            etiam</p>
                        <p>Aliquam posuere duis a fringilla enim dictum tortor accumsan litora</p> -->
                    </div>
                    <!-- <div class="tab-pane fade" id="tab-2">
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
                    </div> -->
                    <div class="tab-pane fade" id="tab-3">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                foreach ($reviews['reviews'] as $key => $value) {
                                ?>
                                <article class="product-review">
                                    <div class="product-review-author">
                                        <img class="product-review-author-img" src="<?php echo base_url($value['foto']) ?>" />
                                    </div>
                                    <div class="product-review-content-full">
                                        <h5 class="product-review-title"><?php echo $value['rating_subject'] ?></h5>
                                        <div class="my-rating" data-rating="<?php echo $value['rating_star'] ?>"></div>
                                        <p class="product-review-meta"><?php echo $value['name']." pada ". $value['timestamp'] ?></p>
                                        <p class="product-review-body"><?php echo $value['rating_comm'] ?></p>
                                        <!-- <p class="text-success"><strong><i class="fa fa-check"></i> I would recommend this to a friend!</strong> -->
                                        </p>

                                    </div>
                                </article>
                                <?php } ?>
                            </div>
                            <div class="col-md-4">
                                <h3 class="product-tab-rating-title">Overall Customer Rating:</h3>
                                <ul class="product-page-product-rating product-rating-big">
                                    <div class="my-rating" data-rating="<?php echo $reviews['count']['avg_rating'] ?>"></div>
                                    <li class="count"><?php echo $reviews['count']['avg_rating'] ?></li>
                                </ul><small><?php echo $reviews['count']['count_review'] ?> customer reviews</small>
                                <p><strong><?php echo $reviews['count']['percentase'] ?>%</strong> of reviewers would recommend this product</p>
                                <?php if($this->nativesession->getObject('username') && ($check == false)): ?>
                                <a class="btn btn-primary" id="modalButtonShow" href="#">Write a Review</a>
                              <?php endif; ?>
                            </div>
                        </div>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <p class="category-pagination-sign"><?php echo $reviews['count']['count_review'] ?> customer reviews found. Showing 1 - 5</p>
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
        <script type="text/javascript">
        	$(document).ready(function($) {
            $('#modalButtonShow').click(function(event) {
              /* Act on the event */
              $('#myModal').modal('toggle');
            });
        		$(".my-rating").starRating({
        			starSize: 20,
              readOnly: true
        		});
            $(".my-rating-clicked").starRating({
        			starSize: 20,
              callback: function(currentRating, $el){
                $('input[name=star]').val(currentRating);
              }
        		});
        	});
        </script>
