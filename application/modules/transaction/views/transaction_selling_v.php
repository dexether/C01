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
            <li role="presentation" ><a href="/payment/invoices">Tagihan</a></li>
            <li role="presentation"><a href="/payment/buyer">Pembelian</a></li>
            <li role="presentation" class="active"><a href="/payment/selling">Penjualan</a></li>
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