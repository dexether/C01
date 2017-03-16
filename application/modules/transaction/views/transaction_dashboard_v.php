<?php
add_js(base_url('assets/lib/slim-image/slim/slim.kickstart.min.js'));
add_js(base_url('assets/lib/pickerdate/compressed/picker.js'));
add_js(base_url('assets/lib/pickerdate/compressed/legacy.js'));
add_js(base_url('assets/lib/pickerdate/compressed/picker.date.js'));
add_js(base_url('assets/lib/pickerdate/compressed/picker.time.js'));
add_js(base_url('assets/js/dashboard-user.js'));
add_js(base_url('assets/lib/pickerdate/compressed/translations/id_ID.js'));
?>
<link href="/assets/lib/slim-image/slim/slim.min.css" rel="stylesheet">
<link href="/assets/lib/pickerdate/compressed/themes/default.css" rel="stylesheet">
<link href="/assets/lib/pickerdate/compressed/themes/default.date.css" rel="stylesheet">

<div class="row">
                    <div class="col-md-12">
                        <!-- Nav tabs -->
                        <h1 class="transaction">Transaksi</h1>
                        <div class="card">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tagihan" aria-controls="tagihan" role="tab" data-toggle="tab">Tagihan</a></li>
                                <li role="presentation"><a href="#pembelian" aria-controls="pembelian" role="tab" data-toggle="tab">Pembelian</a></li>
                                <li role="presentation"><a href="#penjualan" aria-controls="penjualan" role="tab" data-toggle="tab">Penjualan</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="tagihan">
                                    <div class="transaction-form">
                                        <form class="form-inline">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="transactionSearch" placeholder="Cari Transaksi .." name="transactionSearch">
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="transactionCategory">
                                                <option value="1">Berhasil</option>
                                            </select>
                                        </div>
                                        </form>
                                    </div>
                                    <hr/>
                                    <div class="transaction-table">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>DETAIL TAGIHAN</th>
                                                        <th>JUMLAH TAGIHAN</th>
                                                        <th>STATUS TAGIHAN</th>
                                                        <th>TINDAKAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($orders as $key => $order): ?>
                                                    <tr >
                                                        <td>
                                                            <span class="invoice-number-transaction"><?= $order->order_number ?></span>
                                                            <p class="invoice-time-transaction"><?= $order->human_times; ?></p>
                                                        </td>
                                                        <td>
                                                            <span class="invoice-amount"><?= $order->amountWithRp ?></span>
                                                        </td>
                                                        <td>
                                                            <span class="invoice-amount"><?= $order->command->cmd_alias ?></span>
                                                        </td>
                                                        <td>
                                                          <?php if ($order->cmd == 9): ?>
                                                            <button class="btn btn-block btn-success" onclick="showConfirmationModal('<?= $order->order_number ?>')"><i class="glyphicon glyphicon-ok" aria-hidden="true"></i> Konfirmasi</button>
                                                          <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                    <?php if (empty($orders)): ?>
                                                      <tr>
                                                        <td colspan="5" class="text-center">Tidak ada tagihan</td>
                                                      </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="pembelian">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</div>
                                <div role="tabpanel" class="tab-pane" id="penjualan">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Modal -->
                        <div class="modal fade" id="danger" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                  <!-- <form class="" action="index.html" method="post"> -->
                                  <?php echo form_open('/payment/invoices/userconfirmation/') ?>
                                    <div class="modal-header modal-header-success">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h2><i class="glyphicon glyphicon glyphicon-ok"></i> Konfirmasi Pembayaran</h2>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                          <label for="invoice_number">Nomor Tagihan :</label>
                                          <div class="ajax-invoice-number" style="font-size: 16px; font-weight: bold;">
                                            -
                                          </div>
                                          <input type="hidden" name="order_number" />
                                        </div>
                                        <?php if (!empty($bankAccounts->all())): ?>
                                        <div class="form-group">
                                          <label for="payment_date" class="control-label">Tanggal Pembayaran</label>
                                          <input type="text" name="payment_date" class="form-control datepicker" value="">
                                        </div>
                                        <div class="form-group">
                                          <label for="rekening_number" class="control-label">Dari Rekening</label>
                                          <div class="row">
                                            <div class="col-sm-10">
                                              <select name="rekening_number" class="form-control">
                                                <?php foreach ($bankAccounts as $key => $bank): ?>
                                                  <option value="<?= $bank->id ?>"><?= $bank->aeaccountname ?> - <?= $bank->bank->bank_name ?></option>
                                                <?php endforeach; ?>
                                              </select>
                                            </div>
                                            <div class="col-sm-2">
                                              <a href="/account/bankaccount/new" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i></a>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                          <div class="col-sm-6">
                                            <label for="">Upload Bukti Transaksi</label>
                                            <div class="slim"
                                                 data-label="Tarik gambar anda kesini"
                                                 data-size="640,640"
                                                 data-ratio="1:1">
                                                <input type="file" name="slim[]" accept="image/*" required/>
                                            </div>
                                          </div>
                                        </div>
                                        <hr>
                                        <?php else: ?>
                                          <div class="alert alert-warning dashes">
                                            Mohon maaf, nampaknya anda belum Melengkapi Data rekening Silahkan <a href="/account/bankaccount">Klik disi</a>  untuk melangkapi Nomor rekening
                                          </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                        <?php if (!empty($bankAccounts->all())): ?>
                                          <button type="submit" class="btn btn-success pull-right" >Konfirmasi</button>
                                        <?php else: ?>
                                          <a href="/account/bankaccount" class="btn btn-success">Lengkapi Data</a>
                                        <?php endif; ?>
                                    </div>
                                  </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- Modal -->
