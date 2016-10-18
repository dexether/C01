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
    <?php

    if ($userdata['address'] == "" || $userdata['telephone_mobile'] == "" || empty($userdata['address'])) {
        $this->nativesession->set('page', 'profile');
    ?>
        <div class="alert alert-warning">
            <?php echo $this->lang->line('sell_disallow'); ?><a href="<?php echo base_url('web2/mainmenu.php') ?>" target="_blank"><?php echo $this->lang->line('sell_disallow_link'); ?></a>
        </div>
    <?php                                                                                                         } ?>
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
            <h3 class="widget-title">
                <?php echo $this->
                lang->line('sell_title_detail'); ?>
            </h3>

            <!-- <form> -->
            <?php echo form_open_multipart('Uploader/secureSaveUploadedImages');?>
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_prod'); ?>
                    </label>
                    <input class="form-control" type="text" name="prod_alias" value="" required/>
                </div>

                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_cat'); ?>
                    </label>
                    <select name="cat" class="form-control">
                        <?php foreach ($list_cat as $key => $value) {
                            # code...
                        ?>
                        <option value="<?php echo $value['id'] ?>"><?php echo $value['cat_alias'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <legend></legend>

                <div class="form-group">
                    <label>
                        Masukan gambar Utama anda
                    </label>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="slim"
                           data-label="Tarik gambar anda kesini"
                           accept="image/jpeg"
                           data-size="640,640"
                           data-ratio="1:1">
                           <input type="file" name="slim[]" required />
                        </div>
                      </div>
                    </div>
                </div>
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
                <div class="form-group">
                    <label>
                        <?php echo $this->lang->line('sell_name_price'); ?>
                    </label>
                    <input class="form-control" type="text" name="prod_price" value="" />
                </div>
                <div class="form-group">
                    <label>
                        Deskripsi Short
                    </label>
                    <textarea class="form-control" name="prod_desc"></textarea>
                </div>
                <div class="form-group">
                    <label>
                        Deskripsi Long
                    </label>
                    <textarea class="form-control" id="summernote" name="prod_desc_long"></textarea>
                </div>
                <?php

                if ($userdata['address'] == "" || $userdata['telephone_mobile'] == "" || empty($userdata['address'])) {
                            ?>
                                <div class="alert alert-warning">
                                    <?php echo $this->lang->line('sell_disallow'); ?><a href="<?php echo base_url('web2/mainmenu.php') ?>" target="_blank"><?php echo $this->lang->line('sell_disallow_link'); ?></a>
                    </div>
                <?php                                                                                                                                                                                                                                                                                                                                                                                                                     }else { ?>
                <div class="form-group">
                    <input type="submit" value="Simpan" class="btn btn-success"></input>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
                <?php } ?>
            </form>
        </div>
        <div class="col-md-1">
        </div>
    </div>
</div>
<script type="text/javascript">
    Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

      // The configuration we've talked about above
        autoProcessQueue: false,
        uploadMultiple: true,
        parallelUploads: 100,
        maxFiles: 100,

        // The setting up of the dropzone
        init: function() {
        var myDropzone = this;

        // First change the button to actually tell Dropzone to process the queue.
        this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
          // Make sure that the form isn't actually being sent.
          e.preventDefault();
          e.stopPropagation();
          myDropzone.processQueue();
        });

        // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
        // of the sending event because uploadMultiple is set to true.
        this.on("sendingmultiple", function() {
          // Gets triggered when the form is actually being sent.
          // Hide the success button or the complete form.
        });
        this.on("successmultiple", function(files, response) {
          // Gets triggered when the files have successfully been sent.
          // Redirect user or notify of success.
        });
        this.on("errormultiple", function(files, response) {
          // Gets triggered when there was an error sending the files.
          // Maybe show form again, and notify user of error
        });
      }

    }
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
    url: "<?php echo base_url('uploader/uploadMultipleImages') ?>",
    paramName: "file",
    maxFiles: 5,
    parallelUploads: 5,
    maxFilesize: 10, // MB
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    dictRemoveFile: "Hapus gambar",
    // autoDiscover: false,
    uploadMultiple: true,
    params: {
      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
    },
    maxfilesexceeded: function(file)
    {
      alert('You have uploaded more than 1 Image. Only the first file will be uploaded!');
    },
    success: function (response) {
      console.log(response)
    }
  });
});
</script>
