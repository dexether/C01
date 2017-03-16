<div class="row">
<div class="col-md-12">
    <!-- Nav tabs -->
    <h1 class="transaction">Pengaturan</h1>
    <div class="card">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#akun" aria-controls="tagihan" role="tab" data-toggle="tab">Akun</a></li>
            <li role="presentation"><a href="#alamat" aria-controls="pembelian" role="tab" data-toggle="tab">Alamat</a></li>
            <li role="presentation" class="active"><a href="/account/bankaccount" aria-controls="penjualan" role="tab" data-toggle="tab">Rekening Bank</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="rekening">
              <div class="alert alert-warning">
                <strong>PENTING :</strong>
                <p class="text-jutify">Cermatlah dalam mengisi data rekening bank. AgendaFX.com tidak bertanggung jawab apabila terjadi hal yang tidak diinginkan akibat kesalahan dalam pengisian data rekening bank yang meliputi nomor rekening, nama pemilik rekening dan nama bank.</p>
              </div>
              <?php echo form_open('' , ['class' => 'form-horizontal']); ?>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="bank_id">Nama Bank</label>
                  <div class="col-sm-6">
                    <select class="form-control" name="bank_id">
                      <?php foreach ($banks as $key => $row): ?>
                        <option value="<?= $row->id ?>"><?= $row->bank_name ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group <?= (form_error('aeaccountname')) ? 'has-error' : '' ?>">
                  <label class="control-label col-sm-2" for="aeaccountname">Atas Nama</label>
                  <div class="col-sm-6">
                    <input class="form-control" type="text" name="aeaccountname" value="<?= set_value('aeaccountname') ?>" placeholder="<?= $this->session->name ?>">
                    <?php echo form_error('aeaccountname', '<div class="help-block">', '</div>'); ?>
                    <p class="help-block">Nama sesuai dengan yang tercantum pada rekening bank.</p>
                  </div>
                </div>
                <div class="form-group  <?= (form_error('aeaccountnumber')) ? 'has-error' : '' ?>">
                  <label class="control-label col-sm-2" for="aeaccountnumber">Nomor Rekening</label>
                  <div class="col-sm-6">
                    <input class="form-control" type="text" name="aeaccountnumber" value="<?= set_value('aeaccountnumber') ?>" placeholder="xxxxxxxxx">
                    <?php echo form_error('aeaccountnumber', '<div class="help-block">', '</div>'); ?>
                    <p class="help-block">Pastikan nomor rekening Anda valid.</p>
                  </div>
                </div>
                <div class="form-group  <?= (form_error('password')) ? 'has-error' : '' ?>">
                  <label class="control-label col-sm-2" for="aeaccountnumber">Password AgendaFX</label>
                  <div class="col-sm-6">
                    <input class="form-control" type="password" name="password" value="">
                    <?php echo form_error('password', '<div class="help-block">', '</div>'); ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-6 col-sm-offset-2">
                    <button type="submit" name="button" class="btn btn-success">Simpan</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
    </div>
</div>
