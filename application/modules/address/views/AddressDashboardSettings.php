<?php
add_js(base_url('assets/js/jquery.chained.remote.min.js'));
add_js(base_url('assets/js/checkout.js'));
?>
<div class="col-md-12">
    <!-- Nav tabs -->
    <h1 class="transaction">Pengaturan</h1>
    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><a href="/account/setting">Akun</a></li>
            <li role="presentation"  class="active"><a href="/account/address">Alamat</a></li>
            <li role="presentation"><a href="/account/bankaccount">Rekening Bank</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="tagihan">
              <input type="hidden" id="aecodeid" name="" value="<?= $this->session->aecodeid ?>">
              <button class="btn btn-success" data-toggle="modal" data-target="#myModal">Tambah Alamat</button>
              <table class="table">
                <thead>
                  <tr>
                    <td>Nama Penerima</td>
                    <td>Alamat</td>
                    <td></td>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="row, index in address">
                    <td>
                      {{row.receiver_name}}<br/>
                      <span><strong>{{row.telphone_number}}</strong></span>
                    </td>
                    <td>{{row.address}}</td>
                    <td class="text-success">
                      <div v-if="row.is_primary">
                        <i class="glyphicon glyphicon-ok"></i> Alamat Utama
                        <div class="">
                          <!--<button type="button" class="btn btn-sm btn-warning" name="button"><i class="glyphicon glyphicon-pencil"></i> Ubah</button>-->
                          <change-address></change-address>
                        </div>
                      </div>
                      <div v-else>
                          <set-active-address v-on:setactivemethod="fetchAddress" :message="row.address_id" source="<?= base_url('api/address/set_primary') ?>"></set-active-address>
                          <change-address></change-address>
                      </div>

                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
        </div>
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
      <?php echo form_hidden('redirect', current_url()); ?>
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
                <option value="0"></option>
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
