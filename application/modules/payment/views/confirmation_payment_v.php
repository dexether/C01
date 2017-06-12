<?php
add_js(base_url('assets/js/clipboard.min.js'));
add_js(base_url('assets/js/payment.js'));
?>
<div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="panel card-1 panel-default">
            <div class="panel-heading">
              Pembayaran via Transfer
            </div>
            <div class="panel-body">
              <br/>
              <p class="text-center" style="margin-bottom: 10px;">Lakukan pembayaran sebelum hari <strong><?php echo $order->expired_at;  ?></strong></p>
              <div class="detail-transfer text-center">
                <span><?php echo $order->amountWithRp ?></span>
                <br>
                <div class="clipboard" data-clipboard-text="<?php echo $order->amount ?>">
                  Salin Jumlah
                </div>
                <br>
                <div class="c-tooltip c-tooltip--bottom u-pad-bottom--0">
                  <div class="c-tooltip__pointer"></div>
                  <div class="c-tooltip__content u-txt--base">
                    Transfer tepat hingga 3 digit terakhir agar
                    <br>
                    tidak menghambat proses verifikasi
                  </div>
                </div>
                <div class="paymnet-invoice">
                  <p style="margin-bottom : 5px;">Nomor tagihan:</p>
                  <span class="paymnet-invoice-number"><?php echo $order->order_number ?></span>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <p>Pembayaran dapat dilakukan ke salah satu rekening a/n Roby Martiarto berikut:</p>
              <div class="row">
                <div class="col-lg-4 col-lg-offset-4">
                  <div class="payment-confirmation-footer card-2" align="center">
                    <div class="payment-confirmation-footer-rekening">
                      <img src="/assets/images/logo/logo-bca.gif" alt="Logo BCA" />
                      <p>Bank BCA, Jakarta</p>
                      <span>221 805 0455</span>
                      <br>
                      <div class="clipboard" data-clipboard-text="2218050455">
                        Salin Rekening
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <p class="payment-confirmation-footer-text text-justify">Pembelianmu dicatat dengan nomor tagihan pembayaran <?php echo $order->order_number ?>. AgendaFX akan melakukan verifikasi paling lama 1 x 24 Jam setelah kamu melakukan Konfirmasi pembayaran. Jika kamu menghadapi kendala mengenai verifikasi pembayaran, silakan Hubungi AgendaFX.</p>
              <a href="/payment/invoices/<?php echo $order->id ?>" class="btn btn-lg btn-block btn-success">Lihat Tagihan Pembayaran</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
