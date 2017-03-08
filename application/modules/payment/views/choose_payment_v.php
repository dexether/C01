<div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class="col-lg-8">
          <div class="panel card-1 panel-default">
            <div class="panel-heading">
              Pilih Metode Pembayaran
            </div>
            <div class="panel-body">
              <br/>
              <div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse1">Transfer</a>
                      <img src="/assets/images/logo/atm_bca.gif" width="30px" style="margin-left: 10px;" alt="">
                    </h4>
                  </div>
                  <div id="collapse1" class="panel-collapse collapse in active" aria-expanded="true">
                    <div class="panel-body">
                      <strong>Ketentuan Pembayaran :</strong>
                      <ul id="listed">
                        <li>Pembayaran dapat dilakukan melalui transfer ke rekening BCA.</li>
                        <li>Total belanja kamu belum termasuk kode embayaran untuk keperluam proses Verifikasi</li>
                        <li>Mohon transfer tepat sampai 3 Digit trakhir</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="panel-footer">

            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="panel panel-default card-1">
            <div class="panel-heading">
              Ringkasan Belanja
            </div>
            <table class="table">
              <tr>
                <td>Total Harga Barang</td>
                <td class="text-right">Rp. <?= number_format($payments->amount) ?></td>
              </tr>
              <tr>
                <td>Biaya Kirim</td>
                <td class="text-right">Rp. <?= number_format($payments->shipping_amount) ?></td>
              </tr>
            </table>
            <br>
            <hr>
            <table class="table">
              <tr>
                <td><h4>Total Belanja</h4></td>
                <td class="text-right text-danger"><strong>Rp. <?= number_format($payments->amount + $payments->shipping_amount) ?></strong></td>
              </tr>
            </table>
            <div class="button-payment">
              <a href="/payment/purchases/<?= $payments->order_number ?>/confirmation" class="btn btn-success btn-block">Bayar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
