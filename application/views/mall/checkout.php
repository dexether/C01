<div class="container">
  <header class="page-header">
    <h1 class="page-title">
      <?php echo $this->
      lang->line('checkout_title'); ?>
    </h1>
  </header>
  <?php
  if (empty($user['address']) || $user['address'] == '') {
      $this->nativesession->set('page', 'profile'); ?>
    <div class="alert alert-warning">Profile anda belum lengkap, silahkan lengkapi <a href="<?php echo base_url('web2/mainmenu.php') ?>" target="_blank">disini</a></div>
    <?php

  }
  ?>
  <div class="row row-col-gap" data-gutter="60">
    <div class="col-md-4">
      <h3 class="widget-title">
        <?php echo $this->
        lang->line('checkout_order_info'); ?>
      </h3>
      <div class="box">
        <table class="table">
          <thead>
            <tr>
              <th>
                Product
              </th>
              <th>
                QTY
              </th>
              <th>
                Price
              </th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($list as $key => $value) {
                // code...
              ?>

              <tr>
                <td>
                  <?php echo $value['prod_alias']; ?>
                </td>
                <td>
                  <?php echo $value['qty']; ?>
                </td>
                <td>
                  <?php echo $this->format->set_rp($value['final_price']); ?>
                </td>
              </tr>
              <?php
              @$total = $total + $value['final_price'];
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <h3 class="widget-title">
        <?php echo $this->
        lang->line('checkout_alamat_info'); ?>
      </h3>
      <form>
        <div class="form-group">
          <label>
            First & Last Name
          </label>
          <input class="form-control" type="text" name="name" value="<?php echo $user['name'] ?>" readonly />
        </div>
        <div class="form-group">
          <label>
            E-mail
          </label>
          <input class="form-control" type="text" value="<?php echo $user['email'] ?>" readonly />
        </div>
        <!--  <div class="form-group">
        <label>
        Phone Number
      </label>
      <input class="form-control" type="text" value="<?php echo $user['name'] ?>" readonly/>
    </div> -->
    <!-- <div class="checkbox">
    <label>
    <input class="i-check" id="create-account-checkbox" type="checkbox"/>
    Create TheBox Profile
  </label>
</div> -->
<!-- <div class="form-group">
<label>
Country
</label>
<input class="form-control" type="text" value="<?php echo $user['nationality'] ?>" readonly/>
</div> -->
<div class="form-group">
  <label>
    Address
  </label>
  <textarea class="form-control" readonly><?php echo $user['address'] ?></textarea>
  <!-- <input class="form-control" type="text"/> -->
</div>
</form>
</div>
<div class="col-md-4">
  <h3 class="widget-title">
    <?php echo $this->lang->line('checkout_payment_info'); ?>
  </h3>
  <img src="<?php echo base_url() ?>assets/logo/atm_bca.gif" style="height: 100px" class="img-responsive img-rounded" alt="BCA">
  <!-- <div class="cc-form">
    <p>Silahkan transfer Ke :</p>
    <p><strong>No : 2218050455</strong></p>
    <p><strong>A.n : Roby Martiarto</strong></p>
  </div> -->
</div>
</div>
<div class="row">
  <div class="col-md-12">
    <h3 class="widget-title">
      Pengiriman
    </h3>
    <div class="box">
      <!-- <form class="" action="index.html" method="post" class="form-horizontal"> -->
      <?php
      echo form_open('checkout');
      echo form_hidden('ongkir', 0);
      echo form_hidden('invoice', $this->uri->segment(2));
      echo form_hidden('total_val', $total);
      ?>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="provinsi">Pilih Provinsi</label>
              <select name="provinsi" id="provinsi" class="form-control">
                <?php foreach ($provinces as $key => $value): ?>
                  <option value="<?php echo $value->province_id ?>"><?php echo $value->province ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <p class="help-block">Pilih Provinsi tujuan.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="kota">Pilih Kota</label>
              <select name="kota" id="kota" class="form-control">

              </select>
              <p class="help-block">Tipe Kota.</p>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="tipe">Tipe Pengiriman</label>
              <select name="tipe" id="tipe" class="form-control">

              </select>
              <p class="help-block">Tipe Pengiriman</p>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="kota"><strong>Harga Ongkir</strong></label>
              <p class="form-control-static" id="ongkir" class="text-right" align="right">-</p>
              <input type="hidden" name="ongkir" />
            </div>
          </div>
        </div>


      <!-- </form> -->
    </div>
  </div>
</div>
<div class="gap-small">

</div>
<!-- Payment -->
<div class="row">
  <div class="col-md-12">
    <h3 class="widget-title">
      Tipe Pembayaran
    </h3>
    <style>
    .notes {
      padding: 15px;
      border: 1px dashed #ddd;
    }
    </style>
    <div class="box">
      <label>
        <input type="radio" name="type" value="transfer" checked="checked"/>
        Bank Transfer
      </label>
      <div class="notes">

        <img src="<?php echo base_url() ?>assets/logo/atm_bca.gif" style="height: 100px" class="img-responsive img-rounded" alt="BCA">
        <div class="gap-small">

        </div>
        <div class="alert alert-success">
          <p>
            *Total belanja Anda
            <strong class="text-danger">BELUM TERMASUK</strong>
            kode pembayaran.
          </p>
          <hr>
          <strong>Ketentuan pembayaran dengan transfer:</strong>
          <br>
          <br>
          <ol>
            <li>Transaksi dengan menggunakan metode pembayaran transfer akan ditambahkan kode pembayaran*.</li>
            <li>Pembayaran dengan angka yang tidak tepat menyebabkan proses verifikasi terhambat.</li>
            <li>
              Total pembayaran transaksi yang harus dibayar beserta kode pembayaran dapat diketahui setelah mengklik tombol
              <strong>LANJUT</strong>.
            </li>
          </ol>
          <div class="">
            <p>
              <input name="" value="1" type="hidden">
              <label for="">
                Klik tombol
                <strong class="text-danger">LANJUT</strong>
                jika Anda telah memahami dan menyetujui ketentuan transaksi di atas. AgendaFX akan mengirim tagihan pembayaran ke
                <strong class="text-danger">EMAIl ANDA</strong>.
              </label>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">

            <button name="lanjut" type="submit" class="btn btn-warning" disabled>Lanjutkan</button>
          </div>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <div class="gap">

  </div>
</div>
  <!-- Ongkir -->

  <div class="gap">

  </div>
</div>
<script src="<?php echo base_url('assets/js/jquery.chained.remote.min.js'); ?> "></script>
<script>
$("#kota").remoteChained({
  parents : "#provinsi",
  url : "<?php echo base_url('mod_ecommerce_ongkir/getCity/') ?>"
});
$("#kota").change(function(){
  var provinsi = $('#provinsi').val();
  var kota = $('#kota').val();
  var invoice = "<?php echo $invoice; ?>";
  $.get( "<?php echo base_url('mod_ecommerce_ongkir/getOngkos/"+provinsi+"/"+kota+"/"+ invoice +"') ?>", function( data ) {
    // $('#ongkir').html(data);
    // console.log(data);
    var response = JSON.parse(data);
    $("select[id=tipe]").empty();
    $.each(response,function( key, value ) {
      var option = $('<option></option>').attr("value", value).text(key);
      $("select[id=tipe]").append(option);
    });
  });
});
$("#tipe").change(function(){
  $('p[id=ongkir]').html(addCommas($(this).val()));
  $('input[name=ongkir]').val($(this).val());
  // $(this).val()

  $('button[name=lanjut]').attr('disabled',false);
});
function addCommas(nStr)
{
  nStr += '';
  x = nStr.split('.');
  x1 = x[0];
  x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return "Rp. " + x1 + x2;
}
// parents : "#series, #model",
</script>
