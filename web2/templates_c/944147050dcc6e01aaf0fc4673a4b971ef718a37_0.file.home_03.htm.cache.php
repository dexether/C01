<?php /* Smarty version 3.1.27, created on 2016-09-02 08:21:39
         compiled from "/var/www/cabinet-stable/web2/templates/home_03/home_03.htm" */ ?>
<?php
/*%%SmartyHeaderCode:163310187957c8d423320cf0_65329607%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '944147050dcc6e01aaf0fc4673a4b971ef718a37' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/home_03/home_03.htm',
      1 => 1472724567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '163310187957c8d423320cf0_65329607',
  'variables' => 
  array (
    'status' => 0,
    'companys' => 0,
    'ewallet' => 0,
    'bonus' => 0,
    'account' => 0,
    'goldsaving' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c8d4233483c4_79490458',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c8d4233483c4_79490458')) {
function content_57c8d4233483c4_79490458 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '163310187957c8d423320cf0_65329607';
?>
<link href="assets/libs/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<div class="content" id="main_content">
   <!-- Additional -->
   <!-- Extra CSS Libraries Start -->
   <link href="assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <style type="text/css">
      .img-responsive {
  margin-bottom: 30px;
}
/*.row{
  margin-top: 1px;
  margin-bottom: 1px
}*/
   </style>
   <?php if ($_smarty_tpl->tpl_vars['status']->value == '0') {?>
   <br/>
   <div class="alert alert-danger">
      <strong>
         NOTE:
      </strong>
      <p class="text-justify">
         You haven't confirmed your email, please check your e-mail now and click the activation link has been sent
      </p>
   </div>
   <?php }?>
   <div class="carousel slide" data-ride="carousel" id="carousel-example">
      <ol class="carousel-indicators">
         <li class="active" data-slide-to="0" data-target="#carousel-example">
         </li>
         <li data-slide-to="1" data-target="#carousel-example">
         </li>
         <li data-slide-to="2" data-target="#carousel-example">
         </li>
      </ol>
      <div class="carousel-inner">
         <div class="item active">
            <a href="#">
               <img src="images/slider/slide4.jpg"/>
            </a>
         </div>
         <div class="item">
            <a href="#">
               <img src="images/slider/slide5.jpg"/>
            </a>
         </div>
         <div class="item">
            <a href="#">
               <img src="images/slider/slide6.jpg"/>
            </a>
         </div>
      </div>
      <a class="left carousel-control" data-slide="prev" href="#carousel-example">
         <span class="glyphicon glyphicon-chevron-left">
         </span>
      </a>
      <a class="right carousel-control" data-slide="next" href="#carousel-example">
         <span class="glyphicon glyphicon-chevron-right">
         </span>
      </a>
   </div>
   <div class="row">
      <div class="col-md-12 portlets">
         <div class="content">
            <!-- Start info box -->
            <div class="row top-summary">
               <button class="btn btn-primary btn-lg btn-block" type="button">
                  Welcome to <?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>

                  <p class="text-muted">
                     Solution for Financial Risk and Reward
                  </p>
               </button>
               <p>
                  <br>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget green-1 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="icon-globe-inv">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       WALLET (USD)
                                    </b>
                                 </p>
                                 <h3>
                                    <span class="animate-number" data-duration="3000" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['ewallet']->value['total'],2);?>
">
                                       <?php echo number_format($_smarty_tpl->tpl_vars['ewallet']->value['total'],2);?>

                                    </span>
                                 </h3>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget darkblue-2 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-trophy">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       REWARD ( USD )
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['bonus']->value['bonus'],2);?>
">
                                       <?php echo number_format($_smarty_tpl->tpl_vars['bonus']->value['bonus'],2);?>

                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget orange-4 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-user">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       ACCOUNT
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="<?php echo $_smarty_tpl->tpl_vars['account']->value['account'];?>
">
                                       <?php echo $_smarty_tpl->tpl_vars['account']->value['account'];?>

                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget lightblue-1 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-dollar">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       AFILIATE
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['goldsaving']->value['total'],2);?>
">
                                       <?php echo number_format($_smarty_tpl->tpl_vars['goldsaving']->value['total'],2);?>

                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                  </br>
               </p>
            </div>
            <!-- End of info box -->

         </div>
      </div>
   </div>
   <?php echo '<script'; ?>
 src="assets/libs/d3/d3.v3.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/rickshaw/rickshaw.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/raphael/raphael-min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/morrischart/morris.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-knob/jquery.knob.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-clock/clock.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/js/apps/calculator.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/js/apps/todo.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/js/apps/notes.js">
   <?php echo '</script'; ?>
>
   <?php echo '<script'; ?>
 src="assets/js/pages/index.js">
   <?php echo '</script'; ?>
>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js">
<?php echo '</script'; ?>
>
<!-- Page Specific JS Libraries -->
<?php echo '<script'; ?>
 src="assets/libs/jquery-blockui/jquery.blockUI.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/d3/d3.v3.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/rickshaw/rickshaw.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/raphael/raphael-min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/morrischart/morris.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-knob/jquery.knob.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-clock/clock.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/calculator.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/todo.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/notes.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/pages/index.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/fullcalendar/fullcalendar.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/pages/calendar.js">
<?php echo '</script'; ?>
>
<?php }
}
?>