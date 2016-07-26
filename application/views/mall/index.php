<!DOCTYPE HTML>
<html>

<head>
    <title><?php echo $this->config->item('APP_TITLE'); ?> - <?php echo $this->config->item('APP_DESC'); ?></title>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="keywords" content="Template, html, premium, themeforest" />
    <meta name="description" content="TheBox - premium e-commerce template">
    <meta name="author" content="Tsoy">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:500,300,700,400italic,400' rel='stylesheet' type='text/css'>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/styles.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/css/mystyles.css">

</head>

<body>
    <div class="global-wrapper clearfix" id="global-wrapper">
        <!-- Start of mainheader -->
        
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
    <script src="<?php echo base_url('assets') ?>/js/jquery.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/icheck.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/ionrangeslider.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/jqzoom.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/card-payment.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/owl-carousel.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/magnific.js"></script>
    <script src="<?php echo base_url('assets') ?>/js/custom.js"></script>





</body>

</html>
