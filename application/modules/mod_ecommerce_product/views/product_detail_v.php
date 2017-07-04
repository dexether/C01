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
                                 <li>
                                     <a data-toggle="tab" href="#discuss">Diskusi Produk</a>
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
                                 <div id="discuss" class="tab-panel">
                                   <p>
                                     <b>Ada pertanyaan mengenai produk ini?</b>
                                     <br>
                                     <small>Diskusikan langsung dengan penjual.</small>
                                   </p>
                                  <?php if (!$this->session->login): ?>
                                    <a href="<?= base_url('auth?redirect='.current_url()) ?>" class="btn btn-block btn-success">Gabung Diskusi</a>
                                  <?php else: ?>
                                    <?php echo form_open('discuss/'.$product->id); ?>
                                      <textarea name="discuss_message" rows="8" cols="80" class="form-control" placeholder="Isi pertanyaan anda disini ....">
                                      </textarea>
                                      <br>
                                      <button type="submit" name="button" class="btn btn-block btn-success">Diskusi</button>

                                    </form>
                                  <?php endif; ?>

                                  <hr>

                                  <?php foreach ($discuss as $key => $value): ?>
                                    <div class="discuss lg-m-10 card-2">
                                      <div class="discuss-reply-buyer-detail-box lg-mb-20 lg-p-5">
                                        <?php if ($value->client_aecode->foto == null):
                                          $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $value->client_aecode->email ) ) );
                                        ?>
                                          <img class="pull-left lg-m-5" src="<?= $grav_url ?>" width="50" height="50" title="<?= $value->client_aecode->name ?>" alt="<?= $value->client_aecode->name ?>">
                                        <?php else: ?>
                                          <img class="pull-left lg-m-5" src="<?= base_url($value->client_aecode->foto); ?>" width="50" height="50" title="<?= $value->client_aecode->name ?>" alt="<?= $value->client_aecode->name ?>">
                                        <?php endif; ?>
                                        <a href="#" class="">
                                          <small><b> <?php echo $value->client_aecode->name ?></b></small>
                                        </a>
                                        <?php if ($product->aecodeid == $value->aecodeid): ?>
                                          <label class="label label-danger">Penjual</label>
                                        <?php else: ?>
                                          <label class="label label-success">Pembeli</label>
                                        <?php endif; ?>
                                        <small><?php echo $value->created_at->formatLocalized('%A %d %B %Y');    ?></small>
                                        <br>
                                        <p><?php echo $value->message ?></p>
                                      </div>

                                      <?php foreach ($value->discuss_reply as $key => $row): ?>
                                        <div class="discuss-reply-seller-detail-box lg-p-5">
                                        <?php if ($row->client_aecode->foto == null):
                                          $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $row->client_aecode->email ) ) );
                                        ?>
                                          <img class="pull-left lg-m-5" src="<?= $grav_url ?>" width="50" height="50" title="<?= $row->client_aecode->name ?>" alt="<?= $row->client_aecode->name ?>">
                                        <?php else: ?>
                                          <img class="pull-left lg-m-5" src="<?= base_url($row->client_aecode->foto); ?>" width="50" height="50" title="<?= $row->client_aecode->name ?>" alt="<?= $row->client_aecode->name ?>">
                                        <?php endif; ?>
                                        <a href="#" class="">
                                          <small><b> <?php echo $row->client_aecode->name ?></b></small>
                                        </a>
                                        <?php if ($product->aecodeid == $row->aecodeid): ?>
                                          <label class="label label-danger">Penjual</label>
                                        <?php else: ?>
                                          <label class="label label-success">Pembeli</label>
                                        <?php endif; ?>
                                        <small><?php echo $row->created_at->formatLocalized('%A %d %B %Y');    ?></small>
                                        <br>
                                        <p><?php echo $row->message ?></p>
                                      </div>
                                      <?php endforeach; ?>

                                      <?php if ($this->session->login): ?>
                                        <div class="discuss-reply-seller-detail-box lg-p-5">
                                          <?php echo form_open('discuss/comment/'.$value->id); ?>
                                          <input type="text" name="comment" value="" class="form-control" placeholder="Komentar kamu disini...">
                                          <div class="button-comment lg-pb-5 lg-m-5">
                                            <button type="submit" name="button" class="btn btn-success pull-right">Komentar</button>
                                          </div>
                                          <br>
                                        </div>
                                      <?php endif; ?>


                                    </div>
                                  <?php endforeach; ?>

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
