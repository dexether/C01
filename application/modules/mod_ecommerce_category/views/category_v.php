<?php
// add_js(base_url('assets/js/category-page.js'));
?>
<div class="columns-container">
    <div class="container" id="columns">

        <!-- row -->
        <div class="row">
            <!-- Left colunm -->
            <div class="column col-xs-12 col-sm-3" id="left_column">
                <!-- block filter -->
                <?php echo form_open('', ['method' => 'GET']) ?>
                <div class="block left-module">
                    <p class="title_block">Pilih Filter</p>
                    <div class="block_content">
                        <!-- layered -->
                        <div class="layered layered-filter-price">
                            <!-- filter price -->
                            <div class="layered_subtitle">Harga</div>
                            <div class="layered-content slider-range">
                                <div class="amount-range-price">Range: <?php echo number_format($filter_limit_price['min']) ?> - <?php echo number_format($filter_limit_price['max']) ?></div>
                                <ul class="check-box-list">
                                  <?php foreach ($filter_limit_price['range'] as $key => $value): ?>
                                    <li>
                                        <input type="checkbox" id="<?php echo $value[1] ?>" name="range_price" value="<?php echo $value[1] ?>" />
                                        <label for="<?php echo $value[1] ?>">
                                        <span class="button"></span>
                                        <?php echo $value[0] ?>
                                        <!-- <span class="count">(0</span> -->
                                        </label>
                                    </li>
                                  <?php endforeach; ?>
                                </ul>
                            </div>
                            <!-- ./filter price -->
                            <div class="products-block">
                                <div class="products-block-bottom">
                                    <button class="link-all" href="#">Filter</button>
                                </div>
                            </div>
                        </div>
                        <!-- ./layered -->

                    </div>
                </div>
                <?php echo form_close() ?>
                <!-- ./block filter  -->
                <!-- TAGS -->
                <div class="block left-module">
                    <p class="title_block">TAGS</p>
                    <div class="block_content">
                        <div class="tags">
                            <a href="#"><span class="level1">Forex</span></a>
                            <a href="#"><span class="level2">Book</span></a>
                        </div>
                    </div>
                </div>
                <!-- ./TAGS -->
            </div>
            <!-- ./left colunm -->
            <!-- Center colunm-->
            <div class="center_column col-xs-12 col-sm-9" id="center_column">
                <!-- subcategories -->
                <div class="subcategories">
                    <ul>
                        <li class="current-categorie">
                            <a href="<?= '/c/' . $category_details->cat_name; ?> "><?= $category_details->cat_alias ?></a>
                        </li>
                    </ul>
                </div>
                <!-- ./subcategories -->
                <!-- view-product-list-->
                <div class="">

                </div>
                <ul>
        <div class="">
          <button @click="showCart = !showCart" v-show="!verified">

          </button>
        </div>
        <!-- <li v-for="item in shop">
          {{ item }}
          <button @click="addToCart(item)">Add to cart</button>
        </li> -->
      </ul>
                <div id="view-product-list" class="view-product-list">
                    <h2 class="page-heading">
                        <span class="page-heading-title"><?php echo $category_details->cat_desc ?></span>
                    </h2>
                    <ul class="display-product-option">
                        <li class="view-as-grid selected">
                            <span>grid</span>
                        </li>
                        <li class="view-as-list">
                            <span>list</span>
                        </li>
                    </ul>
                    <!-- PRODUCT LIST -->
                    <ul class="row product-list grid">
                      <?php if (count($products > 0)): ?>
                        <?php foreach ($products as $key => $product): ?>
                        <li class="col-sx-12 col-sm-4">
                            <div class="product-container">
                                <div class="left-block">
                                    <a href="<?php echo base_url('/c/'.$product->cat_name . '/' . $product->prod_name)  ?>">
                                        <img class="img-responsive" style="height : 247px;" alt="product" src="<?= modules::run('product/ProductRESTController/getPrimaryImages', $product->id, true) ?>" />
                                    </a>
                                    <div class="quick-view">
                                      <a title="Add to my wishlist" class="heart" href="#"></a>
                                      <a title="Add to compare" class="compare" href="#"></a>
                                      <a title="Quick view" class="search" href="#"></a>
                                    </div>
                                    <div class="add-to-cart">
                                        <button type="button" @click="addToCart(<?= $product->id ?> , $event)" name="button">Tambah ke Keranjang</button>
                                    </div>
                                </div>
                                <div class="right-block">
                                    <h5 class="product-name"><a href="<?php echo base_url('/c/'.$product->cat_name . '/' . $product->prod_name)  ?>"><?php echo $product->prod_alias ?></a></h5>
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
                      <?php else: ?>
                      <?php endif; ?>
                    </ul>
                    <!-- ./PRODUCT LIST -->
                </div>
                <!-- ./view-product-list-->
                <div class="sortPagiBar">
                    <div class="bottom-pagination">
                        <nav>
                          <?php echo $paging; ?>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div>
</div>
