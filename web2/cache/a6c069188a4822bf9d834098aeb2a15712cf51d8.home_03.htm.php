<?php
/*%%SmartyHeaderCode:146081516957c39fdf224b16_32773453%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a6c069188a4822bf9d834098aeb2a15712cf51d8' => 
    array (
      0 => '/home/theprogrammer/project/cabinet-stable/web2/templates/home_03/home_03.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146081516957c39fdf224b16_32773453',
  'tpl_function' => 
  array (
  ),
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
  'unifunc' => 'content_57c39fdf24e785_38876668',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c39fdf24e785_38876668')) {
function content_57c39fdf24e785_38876668 ($_smarty_tpl) {
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
                  Welcome to AgendaFX
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
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
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
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
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
                                    <span class="animate-number" data-duration="3000" data-value="0">
                                       0
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
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
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
   <script src="assets/libs/d3/d3.v3.js">
   </script>
   <script src="assets/libs/rickshaw/rickshaw.min.js">
   </script>
   <script src="assets/libs/raphael/raphael-min.js">
   </script>
   <script src="assets/libs/morrischart/morris.min.js">
   </script>
   <script src="assets/libs/jquery-knob/jquery.knob.js">
   </script>
   <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
   </script>
   <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
   </script>
   <script src="assets/libs/jquery-clock/clock.js">
   </script>
   <script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
   </script>
   <script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
   </script>
   <script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
   </script>
   <script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
   </script>
   <script src="assets/js/apps/calculator.js">
   </script>
   <script src="assets/js/apps/todo.js">
   </script>
   <script src="assets/js/apps/notes.js">
   </script>
   <script src="assets/js/pages/index.js">
   </script>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js">
</script>
<!-- Page Specific JS Libraries -->
<script src="assets/libs/jquery-blockui/jquery.blockUI.js">
</script>
<script src="assets/libs/d3/d3.v3.js">
</script>
<script src="assets/libs/rickshaw/rickshaw.min.js">
</script>
<script src="assets/libs/raphael/raphael-min.js">
</script>
<script src="assets/libs/morrischart/morris.min.js">
</script>
<script src="assets/libs/jquery-knob/jquery.knob.js">
</script>
<script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
</script>
<script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
</script>
<script src="assets/libs/jquery-clock/clock.js">
</script>
<script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
</script>
<script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
</script>
<script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
</script>
<script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
</script>
<script src="assets/js/apps/calculator.js">
</script>
<script src="assets/js/apps/todo.js">
</script>
<script src="assets/js/apps/notes.js">
</script>
<script src="assets/js/pages/index.js">
</script>
<script src="assets/libs/fullcalendar/fullcalendar.min.js">
</script>
<script src="assets/js/pages/calendar.js">
</script>
<?php }
}
?>