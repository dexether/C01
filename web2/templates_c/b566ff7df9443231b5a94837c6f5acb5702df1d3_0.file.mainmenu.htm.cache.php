<?php /* Smarty version 3.1.27, created on 2016-07-18 19:15:45
         compiled from "D:\web-dir\git\cabinet\web2\templates\mainmenu.htm" */ ?>
<?php
/*%%SmartyHeaderCode:2538578cc871884e99_37370838%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b566ff7df9443231b5a94837c6f5acb5702df1d3' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\mainmenu.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2538578cc871884e99_37370838',
  'variables' => 
  array (
    'companys' => 0,
    'pagenya' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578cc872442086_21119975',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578cc872442086_21119975')) {
function content_578cc872442086_21119975 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2538578cc871884e99_37370838';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="SiCoId Cabinet Management System">
    <meta name="author" content="SiCoId Cabinet Management System">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    
    <!-- Base Css Files -->
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css"
    rel="stylesheet" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css"
    rel="stylesheet" />
    <link href="assets/libs/font-awesome/css/font-awesome.min.css"
    rel="stylesheet" />
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
    <link href="assets/libs/magnific-popup/magnific-popup.css"
    rel="stylesheet" />
    <link href="assets/libs/pace/pace.css" rel="stylesheet" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css"
    rel="stylesheet" />
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css"
    rel="stylesheet" />
    <link href="custom/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- <?php echo '<script'; ?>
 src="custom/bootstrap-switch/dist/js/bootstrap-switch.min.js"><?php echo '</script'; ?>
> -->
    <!-- <link href="assets/libs/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" /> -->
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
                                        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['companys']->value['company_icon'];?>
">
                                        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
                                        <link rel="apple-touch-icon" sizes="57x57"
                                        href="assets/img/apple-touch-icon-57x57.png" />
                                        <link rel="apple-touch-icon" sizes="72x72"
                                        href="assets/img/apple-touch-icon-72x72.png" />
                                        <link rel="apple-touch-icon" sizes="76x76"
                                        href="assets/img/apple-touch-icon-76x76.png" />
                                        <link rel="apple-touch-icon" sizes="114x114"
                                        href="assets/img/apple-touch-icon-114x114.png" />
                                        <link rel="apple-touch-icon" sizes="120x120"
                                        href="assets/img/apple-touch-icon-120x120.png" />
                                        <link rel="apple-touch-icon" sizes="144x144"
                                        href="assets/img/apple-touch-icon-144x144.png" />
                                        <link rel="apple-touch-icon" sizes="152x152"
                                        href="assets/img/apple-touch-icon-152x152.png" />
                                        <link rel="stylesheet" href="custom/css/custom.css">
                                        <?php echo '<script'; ?>
 src="custom/accounting/accounting.js"><?php echo '</script'; ?>
>
                                        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                                        <?php echo '<script'; ?>
 src="assets/libs/jquery/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/fastclick/fastclick.js"><?php echo '</script'; ?>
>

                                        
                                    </head>
                                    <body class="fixed-left">
                                        <!-- start: MODAL -->
                                        <?php include_once ('modalside.php');?>

                                        
                                        <!-- end: MODAL -->
                                        <!-- Begin page -->
                                        <div id="wrapper">
                                            <!-- Left Sidebar Start -->
                                            <?php include_once ('leftside.php');?>

                                            <!-- Left Sidebar End -->
                                            <!-- start: TOPBAR -->
                                            <?php include_once ('topside.php');?>

                                            <!-- end: TOPBAR -->
                                            
                                            <div class="content-page">
                                                <!-- ============================================================== -->
                                                <!-- Start Content here -->
                                                <!-- ============================================================== -->
                                                <!-- CONTENT -->
                                                
                                                <?php include_once ('ar_wrb_report.php');?>

                                                
                                                <!-- /END OF CONTENT -->
                                                <!-- Footer Sidebar Start -->
                                                <?php include_once ('footerside.php');?>

                                                <!-- Footer Sidebar End -->
                                                <div id='firechat-wrapper'></div>
                                            </div>
                                            
                                            <!-- Right Sidebar Start -->
                                            <?php include_once ('rightside.php');?>

                                            <!-- Right Sidebar End -->
                                        </div>
                                        <!-- End page -->
                                        <div class="md-overlay"></div>
                                        <!-- End of eoverlay modal -->
                                        <?php echo '<script'; ?>
>
                                            var resizefunc = [];
                                        <?php echo '</script'; ?>
>
                                        
                                        <!-- <?php echo '<script'; ?>
 src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"><?php echo '</script'; ?>
> -->
                                        <?php echo '<script'; ?>
 src="assets/libs/jquery-detectmobile/detect.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"><?php echo '</script'; ?>
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
                                        <!-- <?php echo '<script'; ?>
 src="assets/libs/sortable/sortable.min.js"><?php echo '</script'; ?>
> -->
                                        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"><?php echo '</script'; ?>
>
                                        <!-- ini Untuk checkbox aw -->
                                        
                                        <?php echo '<script'; ?>
 src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/pace/pace.min.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"><?php echo '</script'; ?>
>
                                        <!-- <?php echo '<script'; ?>
 src="assets/libs/bootstrap-combobox/js/bootstrap-combobox.js"><?php echo '</script'; ?>
> -->
                                        <!-- Demo Specific JS Libraries -->
                                        <?php echo '<script'; ?>
 src="assets/libs/prettify/prettify.js"><?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
 src="assets/js/init.js"><?php echo '</script'; ?>
>
                                        <!-- Custom -->

                                        <!-- Firebase -->

                                        <?php echo '<script'; ?>
 src="custom/js/md_index.js"><?php echo '</script'; ?>
>
                                        
                                        


                                        <?php echo '<script'; ?>
>
                                            function formatRp(value) {
                                                if (value) {
                                                    return accounting.formatMoney(value);
                                                } else {
                                                    return '';
                                                }
                                            }
                                        <?php echo '</script'; ?>
>
                                        <?php echo '<script'; ?>
>
                                            jQuery(document).ready(function() {
                                                Mainpage.init();
                                            });
                                        <?php echo '</script'; ?>
>
                                        
                                    </body>
                                    <!-- end: BODY -->
                                    </html><?php }
}
?>