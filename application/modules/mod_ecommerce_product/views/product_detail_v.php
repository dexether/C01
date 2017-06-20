<?php
add_js('/assets/lib/jquery.elevatezoom.js');
add_js('/assets/lib/fancyBox/jquery.fancybox.js');
add_js('https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/jquery.barrating.min.js');
add_js(base_url('assets/js/product-view.js'));
?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bar-rating/1.2.2/themes/fontawesome-stars.min.css">
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
                                         <img id="product-zoom" src='<?= modules::run('product/ProductRESTController/getPrimaryImages', $product->id, false) ?>' data-zoom-image="<?= modules::run('product/ProductRESTController/getPrimaryImages', $product->id , false) ?>"/>
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
                                     <div class="product-share">
                                      <div class="addthis_inline_share_toolbox"></div>
                                     </div>
                                     <div class="comments-advices">
                                         <a href="#reviews">Berdasarkan <?php echo count($reviews) ?> Review</a>
                                     </div>
                                 </div>
                                 <div class="product-price-group">
                                     <span class="price">Rp. <?= number_format($product->prod_price) ?></span>
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
                         <div class="product-tab" id="myTab">
                             <ul class="nav-tab">
                                 <li class="active">
                                     <a aria-expanded="false" data-toggle="tab" href="#product-detail">Detail Barang</a>
                                 </li>
                                 <!-- <li>
                                     <a aria-expanded="true" data-toggle="tab" href="#information">Informasi</a>
                                 </li> -->
                                 <li>
                                     <a data-toggle="tab" href="#reviews">Ulasan Barang</a>
                                 </li>
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
                                        <?php foreach($reviews as $key => $row): ?>
                                         <div class="comment row">
                                             <div class="col-sm-3 author">
                                                 <div class="grade">
                                                     <span>Grade</span>
                                                     <span class="reviewRating">
                                                         <?php echo $this->format->rating($row->rating_star); ?>
                                                     </span>
                                                 </div>
                                                 <div class="info-author">
                                                     <span><strong><?php echo $row->client_aecode->name ?></strong></span>
                                                     <p><em><?php echo $row->created_at->diffForHumans() ?></em></p>
                                                 </div>
                                             </div>
                                             <div class="col-sm-9 commnet-dettail">
                                                 <?php echo $row->rating_comm; ?>
                                             </div>
                                         </div>
                                        <?php endforeach; ?>
                                         <p>
                                           <?php if (!$this->session->login): ?>
                                             <a class="btn-comment" href="<?php echo base_url('auth/?redirect=' . urlencode(current_url())) ?>">Write your review !</a>
                                           <?php else: ?>
                                             <?php echo form_open('product/set_rating/'.$product->id); ?>
                                               <textarea name="rating_comm" class="form-control" rows="8" cols="80"></textarea>
                                               <span class="help-block">Minimal 30 huruf</span>
                                               <select id="rating" name="rating">
                                                 <option value="1">1</option>
                                                 <option value="2">2</option>
                                                 <option value="3">3</option>
                                                 <option value="4">4</option>
                                                 <option value="5">5</option>
                                               </select>
                                               <button type="submit" name="button" class="btn-comment" >Tulis review anda</button>
                                             </form>
                                           <?php endif; ?>

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
                               <img src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $value->id, true) ?>">
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
