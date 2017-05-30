<div class="row">
    <div class="col-md-12">
        <!-- Nav tabs -->
        <h1 class="transaction">Barang Yang Diinginkan</h1>
        <div class="card">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="<?= base_url('account/wishlist'); ?>">Barang</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="rekening">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <ul class="row product-list grid">
                                <?php foreach ($wishlists as $key => $product):
                                    $product = $product->product;
                                    $category = $product->category;
                                ?>
                                  <li class="col-sx-12 col-sm-4">
                                      <div class="product-container">
                                          <div class="left-block">
                                              <a href="<?php echo base_url('/c/'.$category->cat_name . '/' . $product->prod_name)  ?>">
                                                  <img class="img-responsive" style="height : 247px;" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $product->id, true) ?>" />
                                              </a>
                                              <div class="quick-view">
                                                <a title="Add to my wishlist" class="heart" href="#" @click.prevent="setWishList('<?= $product->id ?>')"></a>
                                                <a title="Add to compare" class="compare" href="#"></a>
                                                <a title="Quick view" class="search" href="#"></a>
                                              </div>
                                              <div class="add-to-cart">
                                                  <button type="button" @click="addToCart(<?= $product->id ?> , $event)" name="button">Tambah ke Keranjang</button>
                                              </div>
                                          </div>
                                          <div class="right-block">
                                              <h5 class="product-name"><a href="<?php echo base_url('/c/'.$category->cat_name . '/' . $product->prod_name)  ?>"><?php echo $product->prod_alias ?></a></h5>
                                              <div class="product-star">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star-half-o"></i>
                                              </div>
                                              <div class="content_price">
                                                  <span class="price product-price"><?= currency($product->prod_price) ?></span>
                                              </div>
                                              <div class="info-orther">
                                                  <p>Item Code: #<?php echo $product->id ?></p>
                                                  <p class="availability">Availability: <span>In stock</span></p>
                                                  <div class="product-desc">
                                                      <?php echo $product->prod_desc; ?>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                    </li>
                                <?php endforeach; ?>
                                <?php if(empty($wishlists)): ?>
                                  <div class="alert alert-warning">
                                    Maaf, anda belum memiliki barang favorit
                                  </div>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
