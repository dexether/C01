<?php
/*%%SmartyHeaderCode:2592757a0237ca380c3_72068783%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e49f660e3a862c10f4af451f7abaabbe4de51a50' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\home_03\\home_03.htm',
      1 => 1468914036,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2592757a0237ca380c3_72068783',
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
    'todo' => 0,
    'row' => 0,
    'news' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57a0237ceea6b8_35769241',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57a0237ceea6b8_35769241')) {
function content_57a0237ceea6b8_35769241 ($_smarty_tpl) {
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
                                    <span class="animate-number" data-duration="3000" data-value="1">
                                       1
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
            <div class="row">
               <div class="col-lg-8 portlets">
                  <div class="widget" id="website-statistics1">
                     <div class="widget-content">
                        <a href="https://twofrx.com/trading-contest-2016/" target="_new" title="Trading Contest 2016">
                           <div class="img-wrap">
                              <img alt="Image gallery" class="mfp-fade" height="100%" src="images/education/thecabinet.jpg" title="Trading Contest 2016" width="100%">
                              </img>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 portlets">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="widget" id="todo-app">
                           <div class="widget-header centered">
                              <!-- <div class="left-btn"><a class="btn btn-sm btn-default add-todo"><i class="fa fa-plus"></i></a></div> -->
                              <h2>
                                 Todo List
                              </h2>
                              <div class="additional-btn">
                                 <a class="hidden reload" href="#">
                                    <i class="icon-ccw-1">
                                    </i>
                                 </a>
                                 <a class="widget-popout hidden tt" href="#" title="Pop Out/In">
                                    <i class="icon-publish">
                                    </i>
                                 </a>
                                 <a class="widget-maximize hidden" href="#">
                                    <i class="icon-resize-full-1">
                                    </i>
                                 </a>
                                 <a class="widget-toggle" href="#">
                                    <i class="icon-down-open-2">
                                    </i>
                                 </a>
                                 <a class="widget-close" href="#">
                                    <i class="icon-cancel-3">
                                    </i>
                                 </a>
                              </div>
                           </div>
                           <div class="widget-content padding-sm">
                              <ul class="todo-list">
                                                               </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-8 portlets">
                  <div class="widget">
                     <div class="widget-header">
                        <h2>
                           News
                        </h2>
                        <div class="additional-btn">
                           <a class="hidden reload" href="#">
                              <i class="icon-ccw-1">
                              </i>
                           </a>
                           <a class="widget-toggle" href="#">
                              <i class="icon-down-open-2">
                              </i>
                           </a>
                           <a class="widget-close" href="#">
                              <i class="icon-cancel-3">
                              </i>
                           </a>
                        </div>
                     </div>
                     <div class="widget-content padding">
                        <div class="col-md-12">
                           <div class="widget bg-white">
                              <div class="widget-body">
                                 <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/111053/3266484/4/di-depan-petinggi-negara-islam-jokowi-2016-tahun-penuh-tantangan" target="_blank" title="Di Depan Petinggi Negara Islam, Jokowi: 2016 Tahun Penuh Tantangan">Di Depan Petinggi Negara Islam, Jokowi: 2016 Tahun Penuh Tantangan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/02/d5f7793c-230d-4bc7-ae46-6f38e46db8ff_169.jpg" align="left" hspace="7" width="100" />Dalam sambutannya, Jokowi menyinggung soal krisis ekonomi global 2008 dan tantangan ekonomi. Jokowi menilai, tahun ini sebagai tahun yang penuh tantangan.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/110026/3266478/459/mimpi-pertamina-jadi-perusahaan-kelas-dunia" target="_blank" title="Mimpi Pertamina Jadi Perusahaan Kelas Dunia">Mimpi Pertamina Jadi Perusahaan Kelas Dunia</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/01/91d2a381-1a67-4b6c-8160-03f2e6fc56ad.jpg" align="left" hspace="7" width="100" />Tak ada kata terlambat bagi Direktur Utama PT Pertamina, Dwi Soetjipto, untuk membangun Pertamina menjadi perusahaan energi berskala global.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/104008/3266458/4/jokowi-buka-pertemuan-petinggi-negara-islam-di-senayan" target="_blank" title="Jokowi Buka Pertemuan Petinggi Negara Islam di Senayan">Jokowi Buka Pertemuan Petinggi Negara Islam di Senayan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/02/d5f7793c-230d-4bc7-ae46-6f38e46db8ff.jpg" align="left" hspace="7" width="100" />Delapan Kepala Negara beserta Menteri dari 18 Negara Islam hadir dalam perhelatan akbar bertajuk 12 th World Islamic Economic Forum (WIEF).</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/102823/3266448/4/3-menteri-merapat-ke-kantor-darmin-bahas-paket-kebijakan" target="_blank" title="3 Menteri Merapat ke Kantor Darmin, Bahas Paket Kebijakan">3 Menteri Merapat ke Kantor Darmin, Bahas Paket Kebijakan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/07/18/ac3610c9-0d7a-42cb-8a83-178d0859ee5f.jpg" align="left" hspace="7" width="100" />Rapat membahas implementasi dari paket-paket ekonomi jilid I hingga XII yang telah dikeluarkan pemerintah sejak Oktober 2015.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/102324/3266446/4/harga-emas-antam-naik-rp-2000-gram" target="_blank" title="Harga Emas Antam Naik Rp 2.000/Gram">Harga Emas Antam Naik Rp 2.000/Gram</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/07/28/52585041-6d00-4e2d-a06f-ca20024021ac_169.jpg" align="left" hspace="7" width="100" />Harga Logam Mulia milik PT Aneka Tambang Tbk (Antam) hari ini dibuka naik di Rp 2.000/gram, sementara harga buyback juga dibuka naik Rp 2.000/gram.</p>
                                       <hr/>
                                                                           </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 portlets">
                  <div class="widget">
                     <div class="widget-header transparent">
                        <h2>
                           <strong>
                              Online Trading
                           </strong>
                           Platform
                        </h2>
                        <div class="additional-btn">
                           <a class="hidden reload" href="#">
                              <i class="icon-ccw-1">
                              </i>
                           </a>
                           <a class="hidden" data-toggle="dropdown" id="dropdownMenu1">
                              <i class="fa fa-cogs">
                              </i>
                           </a>
                           <ul aria-labelledby="dropdownMenu1" class="dropdown-menu pull-right" role="menu">
                              <li>
                                 <a href="#">
                                    Action
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    Another action
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    Something else here
                                 </a>
                              </li>
                              <li class="divider">
                              </li>
                              <li>
                                 <a href="#">
                                    Separated link
                                 </a>
                              </li>
                           </ul>
                           <a class="widget-popout hidden tt" href="#" title="Pop Out/In">
                              <i class="icon-publish">
                              </i>
                           </a>
                           <a class="widget-maximize hidden" href="#">
                              <i class="icon-resize-full-1">
                              </i>
                           </a>
                           <a class="widget-toggle" href="#">
                              <i class="icon-down-open-2">
                              </i>
                           </a>
                           <a class="widget-close" href="#">
                              <i class="icon-cancel-3">
                              </i>
                           </a>
                        </div>
                     </div>
                     <div class="widget-content">
                        <div class="gallery-wrap">
                           <div class="column1">
                              <div class="inner">
                                 <a href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img alt="Please click here for download" class="mfp-fade" src="images/metatrader/mt4_logo_white.jpg" title="MetaTrader 4">
                                       </img>
                                    </div>
                                    <div class="caption-hover">
                                       Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                              <div class="inner">
                                 <a href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img alt="Image gallery" class="mfp-fade" src="images/thecabinet/education.jpg" title="Education" width="50%">
                                       </img>
                                    </div>
                                    <div class="caption-hover">
                                       Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="https://twofrx.com/" target="_new" title="Two Forex">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/twofrx.png" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Two Forex
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="#" target="_new" title="The Art of Money Maker">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/copytrade.png" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Copytrade
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="http://www.askapimperium.com/" target="_new" title="Askap Futurus">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/askapnew.jpg" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Askap Imperium
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-custom">
               <div class="row ">
                  <div class="row col-sm-6">
                     <div class="col-sm-12">
                        <img alt="" class="img-responsive" src="images/thecabinet/edu.png"/>
                     </div>
                     <div class="col-sm-12">
                        <!-- <img src="http://placehold.it/600x195/2ecc71/fff" alt="" class="img-responsive"> -->
                        <div class="row nopadding">
                           <div class="col-sm-6">
                              <img alt="" class="img-responsive" src="images/thecabinet/ea.png">
                              </img>
                           </div>
                           <div class="col-sm-6">
                              <img alt="" class="img-responsive" src="images/thecabinet/indikator.png">
                              </img>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row col-sm-6">
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/book.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/analisa.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/produk.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/seminar.png"/>
                     </div>
                  </div>
               </div>
            </div>
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