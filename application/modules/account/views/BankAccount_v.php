<div class="row">
<div class="col-md-12">
    <!-- Nav tabs -->
    <h1 class="transaction">Pengaturan</h1>
    <div class="card">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><a href="#akun" aria-controls="tagihan" role="tab" data-toggle="tab">Akun</a></li>
            <li role="presentation"><a href="#alamat" aria-controls="pembelian" role="tab" data-toggle="tab">Alamat</a></li>
            <li role="presentation" class="active"><a href="#rekening" aria-controls="penjualan" role="tab" data-toggle="tab">Rekening Bank</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="rekening">
              <div class="alert alert-warning">
                <strong>PENTING :</strong>
                <p class="text-jutify">Cermatlah dalam mengisi data rekening bank. AgendaFX.com tidak bertanggung jawab apabila terjadi hal yang tidak diinginkan akibat kesalahan dalam pengisian data rekening bank yang meliputi nomor rekening, nama pemilik rekening dan nama bank.</p>
              </div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Pemilik</th>
                      <th>Nomor Rekening</th>
                      <th>Nama Bank</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($BankAccounts as $key => $row): ?>
                      <tr>
                        <td><?= $key+1; ?></td>
                        <td><?= $row->aeaccountname ?></td>
                        <td><?= $row->aeaccountnumber ?></td>
                        <td><?= $row->bank->bank_name ?></td>
                      </tr>
                    <?php endforeach; ?>
                    <?php if (empty($BankAccounts->all())): ?>
                      <tr>
                        <td colspan="5" class="text-center">Anda belum mendaftarkan rekening Bank</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
                <a href="/account/bankaccount/new" class="btn btn-success pull-right">Tambah Rekening</a>
            </div>
        </div>
    </div>
    </div>
</div>
