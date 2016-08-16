<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $this->config->item('APP_TITLE'); ?> - <?php echo $this->config->item('APP_DESC'); ?></title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="keywords" content="Finance, Forex, Ecommerce, Robot, Trading, Broker" />
    <meta name="description" content="><?php echo $this->config->item('APP_TITLE'); ?> - <?php echo $this->config->item('APP_DESC'); ?>">
    <meta name="author" content="<?php echo $this->config->item('APP_TITLE'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/mystyles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/js/libs/ratings/css/star-rating-svg.css">
    <style type="text/css">
        img {
          opacity: 50;
          transition: opacity .3s ease-in;
        }
    </style>

</head>

<body>
    <div class="global-wrapper clearfix" id="global-wrapper">
        <!-- Start of mainheader -->
        <script src="<?php echo base_url('assets') ?>/js/jquery.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/jquery.unveil.js"></script>
        <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
        <?php echo $header ?>
        <!-- End of mainheader -->
        <?php echo $slider ?>
        <!-- Start Of Crausel -->
        
        <!-- End Of Crausel -->

        <!-- Start Of Body -->
        <?php echo $body ?>
        <!-- End Of Body -->

        <!-- Start of Footer -->
        <?php include "mainfooter.php"; ?>
        <!-- End Of Footer -->
        
    </div>
    
    <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/icheck.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/ionrangeslider.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/jqzoom.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/card-payment.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/owl-carousel.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/magnific.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/custom.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/libs/ratings/jquery.star-rating-svg.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $("img").unveil(200, function() {
              $(this).load(function() {
                this.style.opacity = 1;
              });
            });
        });
    </script>
    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?48z3QEE1Jhu4lUowt2wyKCcnsIMIEPV8";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->



</body>

</html>
