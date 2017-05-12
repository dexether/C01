<div class="row">
<div class="col-md-12">
    <!-- Nav tabs -->
    <h1 class="transaction">Ringkasan Akun</h1>
    <?php if ($clientAddress): ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="dashboard-block card-1 lg-p-10">
          <div class="row">
            <div class="col-lg-3">
              <h3 class="lg-m-10"><?= $this->session->name; ?></h3>
            </div>
            <div class="col-lg-4">
              <p>Email : <?= $this->session->email; ?></p>
              <p>No. Telp : <?= $clientAddress->telphone_number ?></p>
            </div>
            <div class="col-lg-3">
              <p>Alamat : <?= $clientAddress->address ?></p>
            </div>
            <div class="col-lg-2">
              <a href="<?= base_url('account/address'); ?>" class="btn btn-default pull-right" name="button"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>
    <br>
    <div class="row">
      <div class="col-lg-6">
        <div class="dashboard-block card-1 lg-p-10">
          <h4>Pending Top Up</h4>
          <div class="price-topup">
            0
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="dashboard-block card-1 lg-p-10">
          <h4>Pending Pencairan</h4>
          <div class="price-topup">
            0
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-sm-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong>Transaksi</strong>
          </div>
          <div class="panel-body">
            <strong class="lg-mb-10">Periksa Transaksi Kamu</strong>
            <table class="table">
              <tr>
                <td>Penjualan</td>
                <td><?= $productSelling; ?></td>
              </tr>
              <tr>
                <td>Tagihan</td>
                <td><?= $invoiceNotPay; ?></td>
              </tr>
              <tr>
                <td>Pembelian</td>
                <td><?= $allInvoice ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong>Pengaturan</strong>
          </div>
          <div class="panel-body">
            <table class="table">
              <tr>
                <td>
                  <span class="help-block lg-m-0">NOTIFIKASI</span>
                  <p>Info komunitas, Newsletter</p>
                </td>
                <td><button type="button" class="btn btn-default"><i class="glyphicon glyphicon-cog"></i> Atur</button></td>
              </tr>
              <tr>
                <td>
                  <span class="help-block lg-m-0">SHARING</span>
                  <p>Facebook, Twitter</p>
                </td>
                <td><button type="button" class="btn btn-default"><i class="glyphicon glyphicon-cog"></i> Atur</button></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong>Barang</strong>
          </div>
          <div class="panel-body">
            <table class="table">
              <tr>
                <td>
                  Barang dijual
                </td>
                <td><?= $userProductActive ?></td>
              </tr>
              <tr>
                <td>
                  Barang tidak dijual
                </td>
                <td><?= $userProductNotActive ?></td>
              </tr>
              <tr>
                <td>
                  Barang favorit
                </td>
                <td>0</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong>Reputasi</strong>
          </div>
          <div class="panel-body">
            <strong>Feedback Penjualan:</strong>
            <table class="table">
              <tr>
                <td>
                  <p>Positif</p>
                </td>
                <td>0</td>
              </tr>
              <tr>
                <td>
                  <p>Positif</p>
                </td>
                <td>0</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="panel panel-info">
          <div class="panel-heading">
            <strong>Agen AgendaFX</strong>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-sm-8">
                <p class="text-jutify">Gabung jadi Agen AgendaFX dan dapatkan cashback setiap minggunya!</p>
                <span><a href="#">Baca syarat dan ketentuan</a></span>
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-primary lg-m-10" name="button">Daftar Agen</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
