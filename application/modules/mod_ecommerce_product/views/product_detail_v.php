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
                                       <?php echo $this->format->rating($product->prod_star); ?>
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
                                         <a class="btn-add-cart" href="#" @click="addToCart(<?= $product->id ?> , $event)">Tambah ke Keranjang</a>
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
                                 <!-- <li>
                                     <a aria-expanded="true" data-toggle="tab" href="#information">Informasi</a>
                                 </li>
                                 <li>
                                     <a data-toggle="tab" href="#reviews">Ulasan Barang</a>
                                 </li> -->
                             </ul>
                             <div class="tab-container">
                                 <div id="product-detail" class="tab-panel active">
                                     <?php echo nl2br($product->prod_desc_long); ?>
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
                 <p class="title_block">Produk Baru</p>
                 <div class="block_content">
                   <ul class="products-block best-sell">
                     <?php foreach ($product_list as $key => $value): ?>
                        <li>
                           <div class="products-block-left">
                             <a href="<?= base_url('c/' . $value->cat_name . '/' . $value->prod_name) ?>">
                               <img src="<?= base_url($value->prod_images);?>" alt="<?= $value->prod_alias ?>">
                             </a>
                           </div>
                           <div class="products-block-right">
                           <p class="product-name">
                             <a href="<?= base_url('c/' . $value->cat_name . '/' . $value->prod_name) ?>"><?= $value->prod_alias ?></a>
                           </p>
                           <p class="product-price">Rp. <?= number_format($value->prod_price); ?></p>
                           <p class="product-star">
                             <?php echo $this->format->rating($value->prod_star); ?>
                           </p>
                         </div>
                        </li>
                     <?php endforeach; ?>
                   </ul>
                 </div>
               </div>
               <!-- ./block best sellers  -->
               <!-- block category -->
               <!-- ./block category  -->
             </div>
             <!-- ./left colunm -->
         </div>
         <!-- ./row-->
     </div>
 </div>
 <script>
 fbq('track', 'ViewContent', {
   value: <?= $product->prod_price ?>,
   currency: 'IDR'
 });
 </script>
