<?php /* Smarty version 3.1.27, created on 2016-09-02 10:56:25
         compiled from "/var/www/cabinet-stable/web2/templates/messagebox.htm" */ ?>
<?php
/*%%SmartyHeaderCode:24099968657c8f8698375f0_80105524%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dddb2e47d63d9d5f8f95229751e8574d967bad93' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/messagebox.htm',
      1 => 1472724567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24099968657c8f8698375f0_80105524',
  'variables' => 
  array (
    'message' => 0,
    'problem' => 0,
    'alamat' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c8f869867eb6_98766539',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c8f869867eb6_98766539')) {
function content_57c8f869867eb6_98766539 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24099968657c8f8698375f0_80105524';
?>
<!DOCTYPE html>
<html>

    <!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/404.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 02 Nov 2014 15:13:21 GMT -->
    <head>
        <meta charset="UTF-8">
        <title>MT Cabinet Management System</title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">
        <meta name="keywords" content="Komoditas,Commodity,Multilateral,Pasar,Market,Berjangka,Derivatives">

        <!-- Base Css Files -->
        <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        <link href="assets/libs/prettify/github.css" rel="stylesheet" />

        <!-- Extra CSS Libraries Start -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
        <!-- Extra CSS Libraries End -->
        <link href="assets/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

        <link rel="shortcut icon" href="images/logo/sicoid/sicoid.ico">
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />
    </head>
    <body class="fixed-left full-content">
        <!-- Modal Start -->
        <!-- Modal Task Progress -->	
        <div class="md-modal md-3d-flip-vertical" id="task-progress">
            <div class="md-content">
                <h3><strong>Task Progress</strong> Information</h3>
                <div>
                    <p>CLEANING BUGS</p>
                    <div class="progress progress-xs for-modal">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                            <span class="sr-only">80&#37; Complete</span>
                        </div>
                    </div>
                    <p>POSTING SOME STUFF</p>
                    <div class="progress progress-xs for-modal">
                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                            <span class="sr-only">65&#37; Complete</span>
                        </div>
                    </div>
                    <p>BACKUP DATA FROM SERVER</p>
                    <div class="progress progress-xs for-modal">
                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                            <span class="sr-only">95&#37; Complete</span>
                        </div>
                    </div>
                    <p>RE-DESIGNING WEB APPLICATION</p>
                    <div class="progress progress-xs for-modal">
                        <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            <span class="sr-only">100&#37; Complete</span>
                        </div>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-danger btn-sm md-close">Close</button>
                    </p>
                </div>
            </div>
        </div>

        <!-- Modal Logout -->
        <div class="md-modal md-just-me" id="logout-modal">
            <div class="md-content">
                <h3><strong>Logout</strong> Confirmation</h3>
                <div>
                    <p class="text-center">Are you sure want to logout from this awesome system?</p>
                    <p class="text-center">
                        <button class="btn btn-danger md-close">Nope!</button>
                        <a href="index.php" class="btn btn-success md-close">Yeah, I'm sure</a>
                    </p>
                </div>
            </div>
        </div>        <!-- Modal End -->	

        <!-- Begin page -->
        <div class="container">
            <div class="full-content-center animated flipInX">
                <h1></h1>
                <h2>Notice</h2><br>
                <p class="text-lightblue-2"><?php echo $_smarty_tpl->tpl_vars['message']->value;?>
</p>
                <br>


                <?php if ($_smarty_tpl->tpl_vars['problem']->value == "tidak") {?>
                <form method="post" action='<?php echo $_smarty_tpl->tpl_vars['alamat']->value;?>
'>
                    <a class="btn btn-primary btn-sm" href="<?php echo $_smarty_tpl->tpl_vars['alamat']->value;?>
"><i class="fa fa-angle-left"></i> Back to Previous</a>
                </form>
                <?php } else { ?>
                <form method="post" action="index.php">
                    <a class="btn btn-primary btn-sm" href="index.php"><i class="fa fa-angle-left"></i> Back To Main Menu</a>
                </form>
                <?php }?>
            </div>
        </div>
        <!-- End of page -->
        <!-- the overlay modal element -->
        <div class="md-overlay"></div>
        <!-- End of eoverlay modal -->
        <?php echo '<script'; ?>
>
            var resizefunc = [];
        <?php echo '</script'; ?>
>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <?php echo '<script'; ?>
 src="assets/libs/jquery/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-detectmobile/detect.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/ios7-switch/ios7.switch.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/fastclick/fastclick.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-blockui/jquery.blockUI.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-bootbox/bootbox.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-sparkline/jquery-sparkline.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/nifty-modal/js/classie.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/nifty-modal/js/modalEffects.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/sortable/sortable.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-select/bootstrap-select.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-select2/select2.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"><?php echo '</script'; ?>
> 
        <?php echo '<script'; ?>
 src="assets/libs/pace/pace.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="assets/libs/jquery-icheck/icheck.min.js"><?php echo '</script'; ?>
>

        <!-- Demo Specific JS Libraries -->
        <?php echo '<script'; ?>
 src="assets/libs/prettify/prettify.js"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="assets/js/init.js"><?php echo '</script'; ?>
>
    </body>

    <!-- Mirrored from hubancreative.com/projects/templates/coco/corporate/404.html by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 02 Nov 2014 15:13:21 GMT -->
</html><?php }
}
?>