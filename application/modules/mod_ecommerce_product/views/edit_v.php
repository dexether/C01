<!-- include summernote css/js-->
<link href="<?php echo base_url() ?>assets/js/libs/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/libs/bootstrap-slider/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/libs/summernote/summernote.js"></script>

<!-- Range Slider -->
<script src="<?php echo base_url() ?>assets/js/jquery.price_format.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.kickstart.min.js"></script>

<!-- Dropzone -->
<script src="<?php echo base_url() ?>assets/js/libs/dropzone-master/dist/min/dropzone.min.js"></script>
<!-- Dropzone CSS -->
<link href="<?php echo base_url() ?>assets/js/libs/dropzone-master/dist/min/dropzone.min.css" rel="stylesheet">

<div class="container">
    <header class="page-header">
        <h1 class="page-title">
            <?php echo $this->
            lang->line('sell_title'); ?>
        </h1>
    </header>

    <div class="row row-col-gap" data-gutter="60">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <h3 class="widget-title">
                <?php echo $this->
                lang->line('sell_title_detail'); ?>
            </h3>

            <!-- <form> -->
            <?php echo form_open_multipart('mod_ecommerce_product/product_edit/editProductDo');?>
            <?php echo form_hidden('prod_id', $dataBarang->id); ?>
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_prod'); ?>
                    </label>
                    <input class="form-control" type="text" name="prod_alias" value="<?php echo $dataBarang->prod_alias ?>" required/>
                </div>

                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_cat'); ?>
                    </label>
                    <select name="cat" class="form-control">
                        <?php foreach ($list_cat as $key => $value) {
                            # code...
                        ?>
                        <option value="<?php echo $value['id'] ?>" <?php if($dataBarang->id_cat == $value['id']): echo "selected"; endif; ?>><?php echo $value['cat_alias'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <legend></legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Masukan gambar Utama anda
                        </label>
                        <div class="slim"
                         data-label="Tarik gambar anda kesini"
                         accept="image/jpeg"
                         data-size="640,640"
                         data-ratio="1:1">
                         <img src="<?php echo base_url($dataBarang->prod_images) ?>" alt=""/>
                        <input type="file" name="slim[]" required />
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Masukkan 5 Gambar terbaik disini
                        </label>
                        <div class="uploadform dropzone no-margin dz-clickable">
                        <div class="dz-default dz-message">
                        <span>Drag your Pictures Here</span>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>


                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_price'); ?>
                    </label>
                    <input class="form-control" type="text" name="prod_price" value="<?php echo $dataBarang->prod_price ?>" />
                </div>
                <div class="form-group">
                    <label>
                        Deskripsi Short
                    </label>
                    <textarea class="form-control" name="prod_desc"><?php echo $dataBarang->prod_desc ?></textarea>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
                <div class="form-group">
                    <label>
                        Deskripsi Long
                    </label>
                    <textarea class="form-control" id="summernote" name="prod_desc_long"><?php echo $dataBarang->prod_desc_long ?></textarea>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Berat Barang
                        </label>
                        <input type="text" class="form-control" name="weight" placeholder="satuan dalam gram" value="<?php echo $dataBarang->prod_weight ?>" />
                        <small>Satuan berat barang dalam gram</small>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>
                            Kirim via
                        </label>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="send_method" <?= $data = ($dataBarang->by_email == "1") ? "checked" : ""; ?>> Kirim via email ?
                          </label>

                        </div>
                        <small>Dikirim via email tidak akan ditambah dengan ongkos kirim</small>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-success"></input>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
            </form>
        </div>
        <div class="col-md-1">
        </div>
    </div>
</div>
<script type="text/javascript">
    // Jquery
    jQuery(document).ready(function($) {
        $('#myids').dropzone();
        $('#ex1').slider({
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
        $('input[name=prod_price]').priceFormat({
            prefix: 'Rp ',
            centsSeparator: '',
            thousandsSeparator: '',
             centsLimit: 0
        });
        $('input[name=weight]').priceFormat({
            prefix: '',
            centsSeparator: ',',
            thousandsSeparator: '.',
             centsLimit: 0
        });
        $("#ex1").on("slide", function(slideEvt) {
            $("#percent").text(slideEvt.value + "%");
        });
        $('#summernote').summernote({
          height: 300,                 // set editor height
          minHeight: null,             // set minimum height of editor
          maxHeight: null,             // set maximum height of editor
          focus: true                  // set focus to editable area after initializing summernote
        });
    });
</script>
<script>
$(document).ready(function(){
  Dropzone.autoDiscover = false; // keep this line if you have multiple dropzones in the same page
  $(".uploadform").dropzone({
    url: "<?php echo base_url('uploader/editStatement') ?>",
    paramName: "file",
    maxFiles: 5,
    // parallelUploads: 5,
    maxFilesize: 10, // MB
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    removedfile: function(file) {
      var result = confirm("Apakah yakin anda mau menghapus file ini ?");
      if (result) {
          //Logic to delete the item
          var dataArray = {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
            'image_location' : file.name
          };
          $.post('<?php echo base_url("product/removeFiles") ?>' , dataArray);
          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      }

    },
    thumbnailWidth:"1000",
    thumbnailHeight:"1000",
    dictRemoveFile: "Hapus gambar",
    // autoDiscover: false,
    // uploadMultiple: true,
    params: {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    },
    maxfilesexceeded: function(file)
    {
      alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
    },
    success: function (response) {

    },
    init: function () {
      thisDropzone = this;
      $.get('<?php echo base_url("mod_ecommerce_product/product_edit/getImagesDropZone/".$dataBarang->id) ?>', function(data) {
        $.each(data, function(index, val) {
          var mockFile = { name: val.image_location , size: val.size };
          // thisDropzone.emit("addedfile", mockFile);
          thisDropzone.options.addedfile.call(thisDropzone, mockFile);
          thisDropzone.options.thumbnail.call(thisDropzone, mockFile, 'http://agendafx.dev/' + val.image_location);
          // myDropzone.createThumbnailFromUrl(mockFile, val.image_location
          thisDropzone.createThumbnailFromUrl(val.image_location, 'http://agendafx.dev/' + val.image_location);
          $('.dz-preview').addClass('dz-complete');

        });
      });
    }
  });
});
</script>
