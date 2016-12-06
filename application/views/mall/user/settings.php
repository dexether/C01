
<div class="container">
  <div class="gap">
  </div>
<h3>Ubah Setting Anda</h3>
<div class="tabbable product-tabs">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#tab-1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list nav-tab-icon"></i>Alamat</a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tab-1">
          <div class="alert alert-warning">
            * Alamat yang disimpan, adalah Patokan untuk Mengirim barang.s
          </div>
          <?php if($this->nativesession->flashdata()): ?>
          <div class="alert alert-success">
            <?php echo $this->nativesession->flashdata('status') ?>
          </div>
          <?php endif; ?>

          <?php
          $aecodeid = $this->nativesession->getObject('aecodeid');
          $data = $this->penjual->ambil_alamat($aecodeid);
          if(count($data->result()) < 0):
          $attributes = array('id' => 'myform');
          echo form_open('Pengguna/simpan_alamat', $attributes);
          echo form_hidden('aecodeid', $this->nativesession->getObject('aecodeid'));
          ?>

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="provinsi">Pilih Provinsis</label>
                    <select name="provinsi" id="provinsi" class="form-control">
                      <?php foreach ($dataProvinsi as $key => $value): ?>
                        <option value="<?php echo $value->province_id ?>"><?php echo $value->province ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                    <p class="help-block">Pilih Provinsi tujuan.</p>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="kota">Pilih Kota</label>
                    <select name="kota" id="kota" class="form-control">
                    </select>
                    <p class="help-block">Pilih kota tujuan.</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button name="submit" type="submit" class="btn btn-warning">Lanjutkan</button>
                </div>
              </div>

            </form>
          <?php else: ?>
            <div class="alert alert-warning">
              <p>
                Anda sudah melengkapi Alamat anda,
              </p>
            </div>
          <?php endif; ?>
        </div>
    </div>
</div>
<div class="gap">
</div>
</div>
<script src="<?php echo base_url('assets/js/jquery.chained.remote.min.js'); ?> "></script>
<script>
$("#kota").remoteChained({
    parents : "#provinsi",
    url : "<?php echo base_url('Ongkir/getCity/') ?>"
});
// parents : "#series, #model",
</script>
