<?php
add_js('/assets/lib/jquery.elevatezoom.js');
add_js('/assets/lib/fancyBox/jquery.fancybox.js');
 ?>
 <div class="columns-container">
     <div class="container" id="columns">
         <!-- row -->
         <div class="row">
             <!-- Center colunm-->
             <div class="center_column col-xs-12 col-sm-9" id="left_column">
                 <!-- Product -->
                     <div id="product">
                         <div class="primary-box row">
                             <div class="pb-left-column col-xs-12 col-sm-6">
                                 <!-- product-imge-->
                                 <div class="product-image">
                                     <div class="product-full">
                                         <img id="product-zoom" src='<?= base_url($product->prod_images) ?>' data-zoom-image="<?= base_url($product->prod_images) ?>"/>
                                     </div>
                                 </div>
                                 <!-- product-imge-->
                             </div>
                             <div class="pb-right-column col-xs-12 col-sm-6">
                                 <h1 class="product-name"><?= $product->prod_alias ?></h1>
                                 <div class="product-comments">
                                     <div class="product-star">
                                        <?php for ($i= 1; $i < 6; $i++) { ?>
                                          <?php if ($product->prod_star >= $i): ?>
                                            <i class="fa fa-star"></i>
                                          <?php elseif($i - $product->prod_star == 0.5): ?>
                                            <i class="fa fa-star-half-o"></i>
                                          <?php else: ?>
                                            <i class="fa fa-star-o"></i>
                                          <?php endif; ?>
                                          <!-- <i class="fa fa-star"></i> -->
                                        <?php } ?>

                                     </div>
                                     <div class="comments-advices">
                                         <a href="#">Berdasarkan 3 Review</a>
                                         <!-- <a href="#"><i class="fa fa-pencil"></i> write a review</a> -->
                                     </div>
                                 </div>
                                 <div class="product-price-group">
                                     <span class="price">Rp. <?= number_format($product->prod_price) ?></span>
                                     <!-- <span class="old-price">$52.00</span>
                                     <span class="discount">-30%</span> -->
                                 </div>
                                 <div class="info-orther">
                                     <p>Kode barang: #<?= $product->id; ?></p>
                                     <p>Ketersediaan: <span class="in-stock">In stock</span></p>
                                     <p>Kondisi: New</p>
                                 </div>
                                 <div class="product-desc">
                                     <?= $product->prod_desc ?>
                                 </div>
                                 <div class="form-action">
                                     <div class="button-group">
                                         <a class="btn-add-cart" href="#">Tambah ke Keranjang</a>
                                     </div>
                                 </div>
                                 <div class="form-share">
                                     <div class="sendtofriend-print">
                                         <a href="javascript:print();"><i class="fa fa-print"></i> Cetak</a>
                                     </div>
                                     <div class="network-share">
                                       <!-- start of share -->

                                       <!-- end of share -->
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!-- tab product -->
                         <div class="product-tab">
                             <ul class="nav-tab">
                                 <li class="active">
                                     <a aria-expanded="false" data-toggle="tab" href="#product-detail">Detail Barang</a>
                                 </li>
                                 <li>
                                     <a aria-expanded="true" data-toggle="tab" href="#information">Informasi</a>
                                 </li>
                                 <li>
                                     <a data-toggle="tab" href="#reviews">Ulasan Barang</a>
                                 </li>
                             </ul>
                             <div class="tab-container">
                                 <div id="product-detail" class="tab-panel active">
                                     <?php echo $product->prod_desc_long; ?>
                                 </div>
                                 <div id="information" class="tab-panel">
                                     <table class="table table-bordered">
                                         <tr>
                                             <td width="200">Compositions</td>
                                             <td>Cotton</td>
                                         </tr>
                                         <tr>
                                             <td>Styles</td>
                                             <td>Girly</td>
                                         </tr>
                                         <tr>
                                             <td>Properties</td>
                                             <td>Colorful Dress</td>
                                         </tr>
                                     </table>
                                 </div>
                                 <div id="reviews" class="tab-panel">
                                     <div class="product-comments-block-tab">
                                         <div class="comment row">
                                             <div class="col-sm-3 author">
                                                 <div class="grade">
                                                     <span>Grade</span>
                                                     <span class="reviewRating">
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                     </span>
                                                 </div>
                                                 <div class="info-author">
                                                     <span><strong>Jame</strong></span>
                                                     <em>04/08/2015</em>
                                                 </div>
                                             </div>
                                             <div class="col-sm-9 commnet-dettail">
                                                 Phasellus accumsan cursus velit. Pellentesque egestas, neque sit amet convallis pulvinar
                                             </div>
                                         </div>
                                         <div class="comment row">
                                             <div class="col-sm-3 author">
                                                 <div class="grade">
                                                     <span>Grade</span>
                                                     <span class="reviewRating">
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                         <i class="fa fa-star"></i>
                                                     </span>
                                                 </div>
                                                 <div class="info-author">
                                                     <span><strong>Author</strong></span>
                                                     <em>04/08/2015</em>
                                                 </div>
                                             </div>
                                             <div class="col-sm-9 commnet-dettail">
                                                 Phasellus accumsan cursus velit. Pellentesque egestas, neque sit amet convallis pulvinar
                                             </div>
                                         </div>
                                         <p>
                                             <a class="btn-comment" href="#">Write your review !</a>
                                         </p>
                                     </div>

                                 </div>
                             </div>
                         </div>
                         <!-- ./tab product -->
                         <!-- box product -->

                         <!-- ./box product -->
                         <!-- box product -->
                        
                         <!-- ./box product -->
                     </div>
                 <!-- Product -->
             </div>
             <!-- ./ Center colunm -->
             <!-- Left colunm -->
             <div class="column col-xs-12 col-sm-3" id="center_column">
               <!-- block best sellers -->
               <div class="block left-module">
                 <p class="title_block">NEW PRODUCTS</p>
                 <div class="block_content">
                   <ul class="products-block best-sell">
                     <li>
                       <div class="products-block-left">
                         <a href="#">
                           <img src="assets/data/product-100x122.jpg" alt="SPECIAL PRODUCTS">
                         </a>
                       </div>
                       <div class="products-block-right">
                         <p class="product-name">
                           <a href="#">Woman Within Plus Size Flared</a>
                         </p>
                         <p class="product-price">$38,95</p>
                         <p class="product-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-half-o"></i>
                         </p>
                       </div>
                     </li>
                     <li>
                       <div class="products-block-left">
                         <a href="#">
                           <img src="assets/data/p11.jpg" alt="SPECIAL PRODUCTS">
                         </a>
                       </div>
                       <div class="products-block-right">
                         <p class="product-name">
                           <a href="#">Woman Within Plus Size Flared</a>
                         </p>
                         <p class="product-price">$38,95</p>
                         <p class="product-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-half-o"></i>
                         </p>
                       </div>
                     </li>
                     <li>
                       <div class="products-block-left">
                         <a href="#">
                           <img src="assets/data/p12.jpg" alt="SPECIAL PRODUCTS">
                         </a>
                       </div>
                       <div class="products-block-right">
                         <p class="product-name">
                           <a href="#">Plus Size Rock Star Skirt</a>
                         </p>
                         <p class="product-price">$38,95</p>
                         <p class="product-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-half-o"></i>
                         </p>
                       </div>
                     </li>
                     <li>
                       <div class="products-block-left">
                         <a href="#">
                           <img src="assets/data/p52.jpg" alt="SPECIAL PRODUCTS">
                         </a>
                       </div>
                       <div class="products-block-right">
                         <p class="product-name">
                           <a href="#">Plus Size Rock Star Skirt</a>
                         </p>
                         <p class="product-price">$38,95</p>
                         <p class="product-star">
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star"></i>
                           <i class="fa fa-star-half-o"></i>
                         </p>
                       </div>
                     </li>
                   </ul>
                 </div>
               </div>
               <!-- ./block best sellers  -->
               <!-- block category -->
               <div class="block left-module">
                 <p class="title_block">INFORMATION</p>
                 <div class="block_content">
                   <!-- layered -->
                   <div class="layered layered-category">
                     <div class="layered-content">
                       <ul class="tree-menu">
                         <li class="active">
                           <span></span><a href="#">Tops</a>
                           <ul>
                             <li><span></span><a href="#">T-shirts</a></li>
                             <li><span></span><a href="#">Dresses</a></li>
                             <li><span></span><a href="#">Casual</a></li>
                             <li><span></span><a href="#">Evening</a></li>
                             <li><span></span><a href="#">Summer</a></li>
                             <li><span></span><a href="#">Bags & Shoes</a></li>
                             <li><span></span><a href="#"><span></span>Blouses</a></li>
                           </ul>
                         </li>
                         <li><span></span><a href="#">T-shirts</a></li>
                         <li><span></span><a href="#">Dresses</a></li>
                         <li><span></span><a href="#">Jackets and coats </a></li>
                         <li><span></span><a href="#">Knitted</a></li>
                         <li><span></span><a href="#">Pants</a></li>
                         <li><span></span><a href="#">Bags & Shoes</a></li>
                         <li><span></span><a href="#">Best selling</a></li>
                       </ul>
                     </div>
                   </div>
                   <!-- ./layered -->
                 </div>
               </div>
               <!-- ./block category  -->


               <!-- left silide -->
               <div class="col-left-slide left-module">
                 <ul class="owl-carousel owl-style2" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                   <li><a href="#"><img src="assets/data/slide-left.jpg" alt="slide-left"></a></li>
                   <li><a href="#"><img src="assets/data/slide-left2.jpg" alt="slide-left"></a></li>
                   <li><a href="#"><img src="assets/data/slide-left3.png" alt="slide-left"></a></li>
                 </ul>
               </div>
               <!--./left silde-->
               <!-- block best sellers -->
               <div class="block left-module">
                 <p class="title_block">ON SALE</p>
                 <div class="block_content product-onsale">
                   <ul class="product-list owl-carousel" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
                     <li>
                       <div class="product-container">
                         <div class="left-block">
                           <a href="#">
                             <img class="img-responsive" alt="product" src="assets/data/product-260x317.jpg" />
                           </a>
                           <div class="price-percent-reduction2">-30% OFF</div>
                         </div>
                         <div class="right-block">
                           <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                           <div class="product-star">
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star-half-o"></i>
                           </div>
                           <div class="content_price">
                             <span class="price product-price">$38,95</span>
                             <span class="price old-price">$52,00</span>
                           </div>
                         </div>
                         <div class="product-bottom">
                           <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                         </div>
                       </div>
                     </li>
                     <li>
                       <div class="product-container">
                         <div class="left-block">
                           <a href="#">
                             <img class="img-responsive" alt="product" src="assets/data/p35.jpg" />
                           </a>
                           <div class="price-percent-reduction2">-10% OFF</div>
                         </div>
                         <div class="right-block">
                           <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                           <div class="product-star">
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star-half-o"></i>
                           </div>
                           <div class="content_price">
                             <span class="price product-price">$38,95</span>
                             <span class="price old-price">$52,00</span>
                           </div>
                         </div>
                         <div class="product-bottom">
                           <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                         </div>
                       </div>
                     </li>
                     <li>
                       <div class="product-container">
                         <div class="left-block">
                           <a href="#">
                             <img class="img-responsive" alt="product" src="assets/data/p37.jpg" />
                           </a>
                           <div class="price-percent-reduction2">-42% OFF</div>
                         </div>
                         <div class="right-block">
                           <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                           <div class="product-star">
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star"></i>
                             <i class="fa fa-star-half-o"></i>
                           </div>
                           <div class="content_price">
                             <span class="price product-price">$38,95</span>
                             <span class="price old-price">$52,00</span>
                           </div>
                         </div>
                         <div class="product-bottom">
                           <a class="btn-add-cart" title="Add to Cart" href="#add">Add to Cart</a>
                         </div>
                       </div>
                     </li>
                   </ul>
                 </div>
               </div>
               <!-- ./block best sellers  -->
               <!-- left silide -->
               <div class="col-left-slide left-module">
                 <div class="banner-opacity">
                   <a href="#"><img src="assets/data/ads-banner.jpg" alt="ads-banner"></a>
                 </div>
               </div>
               <!--./left silde-->
             </div>
             <!-- ./left colunm -->
         </div>
         <!-- ./row-->
     </div>
 </div>
