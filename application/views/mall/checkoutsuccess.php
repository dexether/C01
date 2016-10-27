<div class="gap"></div>
 <div class="container">
    <div class="payment-success-icon fa fa-check-circle-o"></div>
    <div class="payment-success-title-area">
        <h1 class="payment-success-title"><?php echo $user['name'] ?>, <?php echo $this->lang->line('checkout_success_info'); ?>!</h1>
        <p class="lead"><?php echo $this->lang->line('checkout_success_detail'); ?> <strong><?php echo $user['email'] ?></strong>
        </p>
    </div>
    <div class="gap gap-small"></div>
    <div class="row row-col-gap">
        <div class="col-md-6">
            <h3 class="widget-title">Order Summary</h3>
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>QTY</th>
                            <th width="30%">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($list as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['prod_alias'] ?></td>
                            <td><?php echo $value['qty'] ?></td>
                            <td align="right"><?php echo $this->format->set_rp($value['final_price'])?></td>
                        </tr>
                        <?php
                        @$total = $total + $value['final_price'];
                        }
                        ?>
                        <tr>
                            <td colspan="2">Subtotal</td>
                            <td align="right"><?php echo $this->format->set_rp($total); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Kode Unix</td>
                            <td align="right"><?php echo $value['unix_price'] - $total - $value['ongkir']; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Biaya pengiriman</td>
                            <td align="right"><?php echo $this->format->set_rp($value['ongkir']); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="font-weight: bold;">Total</td>
                            <td align="right" style="font-weight: bold;"><?php echo $this->format->set_rp($value['unix_price']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <h3 class="widget-title">Billing/Shipping Details</h3>
            <div class="box">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Shipping Details</th>
                            <th>Billing Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Penerima</td>
                            <td><?php echo $user['name']; ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td><?php echo $user['address']; ?></td>
                        </tr>
                        <tr>
                            <td>Metode Pembayaran</td>
                            <td><?php echo "transfer"?></td>
                        </tr>
                        <tr>
                            <td>No Telp</td>
                            <td><?php echo $user['telephone_mobile']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="gap gap-small"></div>
</div>
