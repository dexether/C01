<!-- Trigger the modal with a button -->

<!-- load CSS -->
<link href="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.kickstart.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/js/libs/daterange-picker/css/daterangepicker.css">

<!-- Load sweat alert -->
<script src="<?php echo base_url() ?>web2/custom/sweetalert/dist/sweetalert.min.js"></script>
<link href="<?php echo base_url() ?>web2/custom/sweetalert/dist/sweetalert.css" rel="stylesheet">
<!-- Modal -->

<div class="container">
    <header class="page-header">
        <h1 class="page-title">Transaksi Anda</h1>
    </header>
    <div class="gap gap-small"></div>
    <div class="row" data-gutter="60">
        <div class="col-md-12">

        <div class="gap-small"></div>
        <?php if($bank_data['banktype'] == ""): ?>
            <div class="alert alert-warning">
                <strong>PERINGATAN : </strong>
                Nampaknya anda belum mengisi data rekeing anda, Lengkapi data rekening anda <a href="<?php echo base_url() ?>web2/mainmenu.php" target="_blank">disini</a> , masuk ke tab Bank Account
            </div>
        <?php elseif($bank_data['status'] == '1'): ?>
            <div class="alert alert-warning">
                <strong>PERINGATAN : </strong>
                Terimakasih anda telah melengkapi data rekening anda, silahkan tunggu untuk approval Admin
            </div>
        <?php endif;?>
        <hr/>
        <br/>
        <table  cellspacing="" cellpadding="1" class="table table-responsive">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Total</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // var_dump($data);
                foreach ($data as $key => $value) {
                    # code...
                    ?>
                    <tr>
                        <td><a href="#"><?php echo $value['invoice'] ?></a></td>
                        <td><?php echo $this->format->set_rp($value['unix_price'] + $value['ongkir']) ?></td>
                        <td><?php echo $value['timestamp'] ?></td>
                        <td><?php echo $value['cmd_alias'] ?></td>
                        <td>
                            <?php if(!$bank_data['banktype'] == '' && $bank_data['status'] == '0'): ?>

                                <?php if($value['cmd']== '9'): ?>
                                    <button type="button" name="confirm" class="btn btn-success" data-aecodeid="<?php echo $value['aecodeid'] ?>" data-inv="<?php echo $value['invoice'] ?>" name="confirm">Konfirmasi</button>

                            <?php elseif($value['cmd']== '13'): ?>
                                  <button type="button" name="terima" class="btn btn-success" data-aecodeid="<?php echo $value['aecodeid'] ?>" data-inv="<?php echo $value['invoice'] ?>" name="confirm">Konfirmasi penerimaan</button>
                                  <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>


    </div>
</div>
<div id="myModals" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi pembayaran</h4>
    </div>
    <div class="modal-body">
        <!-- <p>Some text in the modal.</p> -->
        <!-- <form action="" method="POST" role="form" class="form-horizontal"> -->
        <?php echo form_open('mod_ecommerce_payment/confirmPayment', array('class' => "form-horizontal", "name" => "ajax-form"));
        echo form_hidden('aecodeid', '0');
        echo form_hidden('inv', '0');
        ?>
            <div class="form-group">
                <label class="control-label col-sm-3" for="email">Invoice</label>
                <div class="col-sm-9">
                  <!-- <input type="email" class="form-control" id="email" placeholder="Enter email"> -->
                  <p class="form-control-static">IIJIJI</p>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Tanggal Pembayaran</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="tgl_pay"></input>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Dari rekening</label>
                <div class="col-sm-9">
                  <!-- <input type="password" class="form-control" id="pwd" placeholder="Enter password"> -->
                  <select class="form-control" name="norek">
                      <option></option>
                  </select>
                </div>
            </div>
            <hr/>

                <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Bukti pembayaran</label>
                <div class="col-sm-9">
                   <div class="slim"
                     data-label="Tarik gambar anda kesini"
                     data-size="640,640"
                     data-ratio="1:1">
                    <input type="file" name="slim[]" required />
                </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="pwd">Rekening Tujuan</label>
                <div class="col-sm-9">
                  <select class="form-control" name="rekto">
                      <option value="bca">BCA</option>
                  </select>
                </div>
            </div>
           <!--  <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Submit</button>
              </div>
            </div> -->
<!-- </form> -->
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-success" name="konfirmasi">Konfirmasi</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>

</div>
</div>
<div class="gap"></div>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/libs/daterange-picker/js/moment.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/libs/daterange-picker/js/daterangepicker.js"></script>
<script type="text/javascript">
$(function() {
    $('input[name="tgl_pay"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
});
</script>
<!-- <script type="text/javascript" src="<?php echo base_url() ?>assets/js/libs/daterange-picker/js/package.js"></script> -->

<script type="text/javascript">
    $('button[name=terima]').click(function(event) {
      /* Act on the event*/
      var btn = $(this);

          swal({
              title: "Konfirmasi barang",
              text: "Apakah anda yakin telah menerima pesanan anda ?",
              type: "info",
              showCancelButton: true,
              closeOnConfirm: false,
              showLoaderOnConfirm: true,
            },
          function(){
            //
            $.ajax({
              url: '<?php echo base_url('mod_ecommerce_payment/barangSudahDiterima') ?>',
              type: 'POST',
              dataType: 'JSON',
              data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                invoice: $(btn).data('inv')
            },
            })
            .done(function(response) {
              $(btn).closest('tr').remove();
              swal({
                title: response.msg,

              });
            })
            .fail(function() {
              swal('Terjadi kesalahan tidak dikenal, silahkan coba kembali');
            })
            .always(function() {
              // console.log("complete");
            });

            // setTimeout(function(){
            //   // swal("Ajax request finished!");
            // }, 2000);
          });
    });
    $('button[name=confirm]').click(function(event) {
        /* Act on the event */
        $aecodeid = $(this).data('aecodeid');
        $inv = $(this).data('inv');
        /* Start of ajax */
        $button = $(this).button();
        $button.button('loading');
        $.ajax({
            url: '<?php echo base_url() ?>mod_ecommerce_payment/getTransactionData',
            type: 'GET',
            dataType: 'JSON',
            data: {},
        })
        .done(function(response) {

            $('select[name=norek]').html('<option value="'+response.banktype+'">'+response.bank_name+'</option>');
            $('input[name=aecodeid]').val($aecodeid);
            $('input[name=inv]').val($inv);
            $('p[class=form-control-static]').html($inv);
            $('#myModals').modal('show');
            $button.button('reset');
            // $(this).button('reset');
        })
        .fail(function() {
            alert('Error')
        })
        .always(function() {

        });
        // $(this).button('reset');

    });
    $('button[name=konfirmasi]').click(function(event) {
         /*Act on the event */
        $(this).button('loading');
    });
</script>
