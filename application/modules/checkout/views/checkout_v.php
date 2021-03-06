<?php
add_js(base_url('assets/js/jquery.chained.remote.min.js'));
add_js(base_url('assets/js/checkout.js'));
 ?>
<input type="hidden" name="aecodeid" id="aecodeid" value="<?= $this->session->userdata('aecodeid') ?>">
<div class="columns-container">
    <div class="container" id="columns">
        <!-- page heading-->
        <h2 class="page-heading no-line">
            <span class="page-heading-title2">Pembayaran</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content page-order">
            <ul class="step">
                <li><span>01. Summary</span></li>
                <li><span>02. Sign in</span></li>
                <li  class="current-step"><span>03. Address</span></li>
                <li><span>04. Shipping</span></li>
                <li><span>05. Payment</span></li>
            </ul>
            <?php echo form_open('/checkout/payment' , ['class' => 'form-horizontal']) ?>
            <div class="row">
              <div class="col-sm-8">
                <div class="heading-counter warning card card-1">
                  <div class="alert alert-warning">
                    Data Anda selalu rahasia dan hanya akan kami beritahukan kepada Penjual.
                  </div>

                    <div class="form-group row no-gutters">
                      <label class="control-label col-sm-2 pull-left" for="email">Alamat : </label>
                      <div class="col-sm-9">
                        <select class="form-control" name="address" @change.prevent="fetchSelectedAddress">
                          <option selected>-- pilih alamat --</option>
                          <option v-for="row, index in address" :value="index">
                           {{ row.receiver_name }} - {{ row.address }}
                         </option>
                        </select>
                      </div>
                      <div class="col-sm-1">
                        <button type="button" name="button" class="btn btn-info"  data-toggle="modal" data-target="#myModal">+</button>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="control-label col-sm-2" for="email"></label>
                      <div class="col-sm-10">
                        <div class="border-dash" v-if="displayAddress != ''">
                          <strong>Nama : {{ displayAddress.receiver_name }}</strong>
                          <p>
                          <input type="hidden" name="selected_address" :value="displayAddress.address_id">
                          Telp : {{ displayAddress.telphone_number }}
                          </p>
                          <p>
                          {{ displayAddress.address }}
                          </p>
                        </div>

                      </div>
                    </div>

                  <br>
                  <div class="" id="app-vue">

                  </div>
                  Daftar Belanja dan Pengiriman contoh
                  <div class="border-header">
                    &nbsp;
                  </div>
                  <div class="border">
                    <div class="box-content">
                      <form class="form-horizontal">
                        <div class="form-group row no-gutters">
                          <label class="control-label col-sm-2 pull-left">Barang : </label>
                          <div class="col-sm-9" >
                            <div class="checkout-product-list" v-for="row in shop">
                              <div class="row">
                                <div class="col-sm-3">
                                  <img :src=" row.img" />
                                </div>
                                <div class="col-sm-9">
                                  {{ row.name }}
                                  <div class="">
                                    Rp. {{  (row.subtotal).formatMoney(2, '.', ',') }}
                                  </div>
                                </div>
                              </div>
                              <br/>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row no-gutters">
                          <label class="control-label col-sm-2 pull-left">Catatan untuk Penjual : </label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="catatan_penjual" rows="3" cols="10" placeholder="Untuk Penjual : Warna, Ukuran jumlah"></textarea>
                          </div>
                        </div>
                        <div class="form-group row no-gutters">
                          <label class="control-label col-sm-2 pull-left">Jasa Pengiriman : </label>
                          <div class="col-sm-9">
                            <select name="" class="form-control" @change.prevent="fetchSelectedOngkir">
                              <option selected >-- pilih pengiriman --</option>
                              <option v-for="row, index in listOngkir" :value="index">
                                {{ row.description }} - Rp. {{ (row.harga_akhir).formatMoney(2, '.', ',') }}
                              </option>
                            </select>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6"></div>
                          <div class="col-sm-6 pull-right">
                            <table class="table">
                              <tbody>
                                <tr>
                                  <td>Harga Barang</td>
                                  <td style="text-align: right;">Rp. {{ total }}</td>
                                </tr>
                                <tr>
                                  <td>Biaya Kirim</td>
                                  <td style="text-align: right;">Rp. {{ (ongkir).formatMoney(2, '.', ',') }}</td>
                                </tr>
                                <tr>
                                  <td>Subtotal</td>
                                  <td style="text-align: right;"><strong>Rp. {{ (subtotalCheckout).formatMoney(2, '.', ',') }}</strong></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="heading-counter warning card card-1">
                  <h3>Ringkasan Belanja</h3>
                  <br>
                  <hr>
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>Harga Barang</td>
                        <td style="text-align: right;">Rp. {{ total }}</td>
                        <input type="hidden" name="harga_barang" :value="totalNumber">
                      </tr>
                      <tr>
                        <td>Biaya Kirim</td>
                        <td style="text-align: right;">Rp. {{ (ongkir).formatMoney(2, '.', ',') }}</td>
                        <input type="hidden" name="ongkir" :value="ongkir">
                      </tr>
                      <tr>
                        <td>Subtotal</td>
                        <td style="text-align: right;">Rp. {{ (subtotalCheckout).formatMoney(2, '.', ',') }}</td>
                      </tr>
                      <tr>
                        <td>Total Belanja</td>
                        <td style="text-align: right;">Rp. {{ (subtotalCheckout).formatMoney(2, '.', ',') }}</td>
                        <input type="hidden" name="total" :value="subtotalCheckout">
                      </tr>
                    </tbody>
                  </table>
                  <button class="btn btn-block btn-lg btn-success" type="submit" name="button" v-if="displayAddress && ongkir != 0">Pilih Metode Pembayaran</button>
                  <button class="btn btn-block btn-lg btn-success" type="submit" name="button" disabled v-else>{{ displayAddress.lenght }} Pilih Metode Pembayaran</button>
                </div>
              </div>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <?php echo form_open('/address/new/' . $this->session->userdata('aecodeid') , ['class' => 'form-horizontal']); ?>
      <div class="modal-body">
          <div class="form-group">
            <label class="control-label col-sm-3" for="receiver_name">Nama Penerima</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="receiver_name" name="receiver_name" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="telphone_number">Telephone / Home</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="telphone_number" name="telphone_number" placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="province_id">Provinsi</label>
            <div class="col-sm-7">
              <!-- <input type="email" class="form-control" id="province_id" name="province_id" placeholder=""> -->
              <select class="form-control" name="province_id" id="provinsi">
                <?php foreach ($provinces->rajaongkir->results as $key => $row): ?>
                  <option value="<?= $row->province_id ?>"><?= $row->province ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="city_id">Kota / Kabupaten</label>
            <div class="col-sm-7">
              <!-- <input type="email" class="form-control" id="city_id" name="city_id" placeholder=""> -->
              <select class="form-control" name="city_id" id="kota">
                <option value=""></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-3" for="city_id">Alamat lengkap</label>
            <div class="col-sm-7">
              <textarea name="address" class="form-control"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-3" for="pos_code">Kode POS</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="pos_code" name="pos_code" placeholder="">
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Save changes">
      </form>

      </div>

    </div>
  </div>
</div>
<script>
fbq('track', 'InitiateCheckout');
fbq('track', 'AddPaymentInfo');
</script>
