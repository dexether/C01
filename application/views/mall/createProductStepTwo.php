<!-- Dropzone -->
<script src="<?php echo base_url() ?>assets/js/libs/dropzone-master/dist/min/dropzone.min.js"></script>

<!-- Dropzone CSS -->
<link href="<?php echo base_url() ?>assets/js/libs/dropzone-master/dist/min/dropzone.min.css" rel="stylesheet">

<div class="container">
  <div class="gap"></div>
  <div class="text-center">
    <h1 class="title">
      <!-- <?php echo $this->lang->line('product_new_title'); ?> -->
      Silahkan upload foto lainnya
    </h1>
    <p class="lead">
        Maksimal 5 gambar
    </p>
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3">
        <form action="/file-upload"
      class="dropzone"
      id="my-awesome-dropzone"></form>
      </div>
    </div>
    <!-- <p class="lead">
    <?php echo $this->lang->line('product_new_msg'); ?>
  </p> -->
  <div class="gap-small">

  </div>
  <button class="btn btn-success" name="upload">Upload</button>

</div>
<div class="gap">
</div>
</div>
<script type="text/javascript">
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone('#my-awesome-dropzone', {
  url: "<?php echo base_url('uploader/uploadMultipleImages') ?>",
  paramName: "file",
  maxFiles: 5,
  parallelUploads: 5,
  maxFilesize: 10, // MB
  acceptedFiles: 'image/*',
  addRemoveLinks: true,
  dictRemoveFile: "Hapus gambar",
  autoProcessQueue: false,
  // autoDiscover: false,
  uploadMultiple: true,
  params: {
    '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>',
    'product_encrypt' : '<?php echo $this->encrypt->encode($productid); ?>'
  },
  init: function () {
      // Set up any event handlers
      this.on('successmultiple', function () {
          // redirect
          window.location.href = "<?php echo base_url('product/success/'.$productname) ?>";
          // alert('hello');
          // console.log('Hello');
      });
  }
});
$('button[name=upload]').click(function(event) {
  /* Act on the event */
  myDropzone.processQueue();
});
// console.log(Dropzone);
// Dropzone.options.myAwesomeDropzone = {
//   url: "<?php echo base_url('uploader/secureImagesUpload') ?>",
//   maxFiles: 4,
//   maxFilesize: 0.1, // MB
//   acceptedFiles: 'image/*',
//   addRemoveLinks: true,
//   dictRemoveFile: "Hapus gambar",
//   autoProcessQueue: false,
//   autoDiscover: false,
//   params: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
//
// };

jQuery(document).ready(function($) {
  // $('button[name=upload]').click(function(event) {
  //   /* Act on the event */
  //   Dropzone.processQueue();
  // });
  // $("#myDropZone").dropzone({ url: "<?php echo base_url('uplaoder/secureImagesUpload')?>file/post" });
  // $(".dropzone").dropzone({
  //   url: "<?php echo base_url('uploader/secureImagesUpload') ?>",
  //   maxFiles: 5,
  //   maxFilesize: 1,
  //   acceptedFiles: 'image/*',
  //   addRemoveLinks: true,
  //   dictRemoveFile: "Hapus gambar",
  //
  //   //  autoProcessQueue: false,
  //   autoDiscover: false,
  //
  //   params: {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
  //   init: function () {
  //     this.on("addedfile", function (file) {
  //       console.log(file)
  //       $('#init_empty_msg').addClass('hidden');
  //     });
  //   }
  //
  // });
});
</script>
