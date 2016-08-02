<!-- include summernote css/js-->
<link href="<?php echo base_url() ?>assets/js/libs/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/libs/bootstrap-slider/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.min.css" rel="stylesheet">
<script src="<?php echo base_url() ?>assets/js/libs/summernote/summernote.js"></script>

<!-- Range Slider -->
<script src="<?php echo base_url() ?>assets/js/jquery.price_format.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/bootstrap-slider/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/libs/slim-image/slim/slim.kickstart.min.js"></script>

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
                        <?php echo $this->lang->line('sell_name_price'); ?>
                    </label>
                       <div class="slim"
                     data-label="Drop your avatar here"
                     data-size="640,640"
                     data-ratio="1:1">
                    <input type="file" name="slim[]" required />
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
                    <!-- <input class="form-control" type="text"/> -->
                </div>
                <div class="form-group">
                    <label>
                        Deskripsi Long
                    </label>
                    <textarea class="form-control" id="summernote" name="prod_desc_long"></textarea>
                    <!-- <input class="form-control" type="text"/> -->
                </div>
                <div class="form-group">
                    <label>
                        Komisi untuk perusahaan sebesar : <p id="percent"></p>
                    </label>
                    <br/>
                    <input id="ex1" name="comm" class="form-control" data-slider-id='ex1Slider' type="text" data-slider-min="10" data-slider-max="100" data-slider-step="1" data-slider-value="10"/>
                    <!-- <input class="form-control" type="text"/> -->
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
    jQuery(document).ready(function($) {
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