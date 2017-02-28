<div class="columns-container">
    <div class="container" id="columns">
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Shopping Cart Summary</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content page-order">
            <ul class="step">
                <li class="current-step"><span>01. Summary</span></li>
                <li><span>02. Sign in</span></li>
                <li><span>03. Address</span></li>
                <li><span>04. Shipping</span></li>
                <li><span>05. Payment</span></li>
            </ul>
            <div class="heading-counter warning" v-if="shop.length > 0">
              Anda mempunyai :
                <span>{{ shop.length }} Produk di Keranjang anda</span>
            </div>
            <div class="heading-counter warning" v-else>
              Anda belum memiliki Produk apapun pada Keranjang Belanja anda.
            </div>
            <div class="order-detail-content">
                <div v-if="shop.length > 0">
                    <div class="table-responsive ">
                    <table class="table table-bordered cart_summary">
                        <thead>
                            <tr>
                                <th class="cart_product">Product</th>
                                <th>Description</th>
                                <th>Avail.</th>
                                <th>Unit price</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th  class="action"><i class="fa fa-trash-o"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in shop">
                                <td class="cart_product">
                                    <a href="#"><img v-bind:src="'/' + item.img" alt="Product"></a>
                                </td>
                                <td class="cart_description">
                                    <p class="product-name"><a href="#"> {{ item.name}} </a></p>
                                </td>
                                <td class="cart_avail"><span class="label label-success">In stock</span></td>
                                <td class="price"><span>Rp. {{ (item.price).formatMoney(2, '.', ',') }}</span></td>
                                <td class="qty">
                                    <input class="form-control input-sm" type="text" v-bind:value="item.quantity">
                                    <a href="#"><i class="fa fa-caret-up"></i></a>
                                    <a href="#"><i class="fa fa-caret-down"></i></a>
                                </td>
                                <td class="price">
                                    <span>Rp. {{ (item.subtotal).formatMoney(2, '.', ',') }}</span>
                                </td>
                                <td class="action">
                                    <a  href="/" v-on:click.prevent="removeFromCart(item.rowid)">Delete item</a>
                                </td>
                            </tr>
                            </div>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" rowspan="2"></td>
                                <td colspan="3"><strong>Total</strong></td>
                                <td colspan="2">Rp. {{ total }}</td>
                                <input type="text" id="total" name="total" :value="totalNumber">
                            </tr>
                        </tfoot>
                    </table>
                    </div>
                  <div class="cart_navigation">
                      <a class="prev-btn" href="/">Lanjutkan Berbelanja</a>
                      <a class="next-btn" href="/checkout">Lanjutkan ke pembayaran</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
fbq('track', 'AddToCart');
</script>
