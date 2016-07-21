<?php /* Smarty version 3.1.27, created on 2016-07-21 07:13:04
         compiled from "D:\web-dir\git\cabinet\web2\templates\home_01\home_01.htm" */ ?>
<?php
/*%%SmartyHeaderCode:1805757901390301451_89358824%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4408e23985549fbcb7880dedece0a31c0f2dfe34' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\home_01\\home_01.htm',
      1 => 1468925494,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1805757901390301451_89358824',
  'variables' => 
  array (
    'companys' => 0,
    'ewallet' => 0,
    'bonus' => 0,
    'account' => 0,
    'goldsaving' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579013904a3c99_41641297',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579013904a3c99_41641297')) {
function content_579013904a3c99_41641297 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1805757901390301451_89358824';
?>
<link href="assets/libs/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/libs/datatable-server-side/css/jquery.dataTables.css">
<?php echo '<script'; ?>
 type="text/javascript" language="javascript" src="assets/libs/datatable-server-side/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" language="javascript" >
			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						url :"tampil_email.php", // json datasource
						type: "post",  // method  , by default get
						error: function(){  // error handling
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
			} );
		<?php echo '</script'; ?>
>
<div id="main_content" class="content">
   <div id="carousel-example" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
         <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
         <li data-target="#carousel-example" data-slide-to="1"></li>
         <li data-target="#carousel-example" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
         <div class="item active">
            <a href="#"><img src="images/slider/slide1.jpg" /></a>
            <div class="carousel-caption">
               <h3>YOUR BEST
                  TRADING PARTNER
               </h3>
               <p>We provide brokerage service in Forex trading, Commodity, and Stock Index</p>
            </div>
         </div>
         <div class="item">
            <a href="#"><img src="images/slider/slide2.jpg" /></a>
            <div class="carousel-caption">
               <h3>YOUR BEST
                  TRADING PARTNER
               </h3>
               <p>We provide brokerage service in Forex trading, Commodity, and Stock Index</p>
            </div>
         </div>
         <div class="item">
            <a href="#"><img src="images/slider/slide3.jpg" /></a>
            <div class="carousel-caption">
               <h3>YOUR BEST
                  TRADING PARTNER
               </h3>
               <p>We provide brokerage service in Forex trading, Commodity, and Stock Index</p>
            </div>
         </div>
      </div>
      <a class="left carousel-control" href="#carousel-example" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
   </div>
   <div class="row">
      <div class="col-md-12 portlets">
         <div class="content">
            <!-- Start info box -->
            <div class="row top-summary">
               <button class="btn btn-primary btn-lg btn-block" type="button" >
                  Welcome to <?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>

                  <p class="text-muted">Solution for Financial Risk and Reward</p>
               </button>
               <p>
                  <br>
               <div class="col-lg-3 col-md-6">
                  <div class="widget green-1 animated fadeInDown">
                     <div class="widget-content padding">
                        <div class="widget-icon">
                           <i class="icon-globe-inv"></i>
                        </div>
                        <div class="text-box">
                           <p class="maindata">TOTAL <b>WALLET (USD)</b></p>
                           <h3><span class="animate-number" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['ewallet']->value['total'],2);?>
" data-duration="3000"><?php echo number_format($_smarty_tpl->tpl_vars['ewallet']->value['total'],2);?>
</span></h3>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="widget-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <i class="fa rel-change"></i> <b></b>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6">
                  <div class="widget darkblue-2 animated fadeInDown">
                     <div class="widget-content padding">
                        <div class="widget-icon">
                           <i class="fa fa-trophy"></i>
                        </div>
                        <div class="text-box">
                           <p class="maindata">TOTAL <b>REWARD ( USD )</b></p>
                           <h2><span class="animate-number" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['bonus']->value['bonus'],2);?>
" data-duration="3000"><?php echo number_format($_smarty_tpl->tpl_vars['bonus']->value['bonus'],2);?>
</span></h2>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="widget-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <i class="fa rel-change"></i> <b></b>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6">
                  <div class="widget orange-4 animated fadeInDown">
                     <div class="widget-content padding">
                        <div class="widget-icon">
                           <i class="fa fa-user"></i>
                        </div>
                        <div class="text-box">
                           <p class="maindata">TOTAL <b>ACCOUNT</b></p>
                           <h2><span class="animate-number" data-value="<?php echo $_smarty_tpl->tpl_vars['account']->value['account'];?>
" data-duration="3000"><?php echo $_smarty_tpl->tpl_vars['account']->value['account'];?>
</span></h2>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="widget-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <i class="fa rel-change"></i> <b></b>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-3 col-md-6">
                  <div class="widget lightblue-1 animated fadeInDown">
                     <div class="widget-content padding">
                        <div class="widget-icon">
                           <i class="fa fa-dollar"></i>
                        </div>
                        <div class="text-box">
                           <p class="maindata">TOTAL <b>GOLD SAVING</b></p>
                           <h2><span class="animate-number" data-value="<?php echo number_format($_smarty_tpl->tpl_vars['goldsaving']->value['total'],2);?>
" data-duration="3000"><?php echo number_format($_smarty_tpl->tpl_vars['goldsaving']->value['total'],2);?>
</span></h2>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                     <div class="widget-footer">
                        <div class="row">
                           <div class="col-sm-12">
                              <i class="fa rel-change"></i> <b></b>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- End of info box -->
            <div class="row">
               <div class="col-lg-8 portlets">
                  <div id="website-statistics1" class="widget">
                     <div class="widget-header transparent">
                        <h2><i class="icon-chart-line"></i> <strong>TradoMarket.com</strong> Copyy Trade and Education</h2>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                           <i class="fa fa-cogs"></i>
                           </a>
                           <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                           </ul>
                           <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                           <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                           <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div class="widget-content">
                        <!-- <a  href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                           <div class="img-wrap">
                              <img src="images/education/1.jpg" width="100%" height="315px" alt="Image gallery" title="The Art of Money Maker" class="mfp-fade">
                           </div>
                        </a> -->
						<div class="container">
							<table id="employee-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
									<thead>
										<tr>
											<th>Time Send</th>
											<th>Email Subject</th>
											<th>Email Descriptions</th>
										</tr>
									</thead>
							</table>
						</div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 portlets">
                  <div class="row">
                     <div class="col-sm-12">
                        <div id="todo-app" class="widget">
                           <div class="widget-header centered">
                              <div class="left-btn"><a class="btn btn-sm btn-default add-todo"><i class="fa fa-plus"></i></a></div>
                              <h2>Todo List</h2>
                              <div class="additional-btn">
                                 <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                                 <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                                 <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                                 <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                                 <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                              </div>
                           </div>
                           <div class="widget-content padding-sm">
                              <ul class="todo-list">
                                 <li>
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Complete Profile</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                    <span class="todo-tags pull-right">
                                       <div class="label label-danger">Important</div>
                                    </span>
                                 </li>
                                 <li>
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Open A New Demo Account</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                    <span class="todo-tags pull-right">
                                       <div class="label label-warning"><i class="icon-search"></i></div>
                                    </span>
                                 </li>
                                 <li class="low">
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Subscribe Education</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                 </li>
                                 <li>
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Open Live Account</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                    <span class="todo-tags pull-right">
                                       <div class="label label-success">New</div>
                                    </span>
                                 </li>
                                 <li class="medium">
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Create Affiliate</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                    <span class="todo-tags pull-right">
                                       <div class="label label-info">Today</div>
                                    </span>
                                 </li>
                                 <li class="medium">
                                    <span class="check-icon"><input type="checkbox" /></span>
                                    <span class="todo-item">Check Report</span>
                                    <span class="todo-options pull-right">
                                    <a href="javascript:;" class="todo-delete"><i class="icon-cancel-3"></i></a>
                                    </span>
                                    <span class="todo-tags pull-right">
                                       <div class="label label-info"></div>
                                    </span>
                                 </li>
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
                        <h2>Events Manager</h2>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div class="widget-content padding">
                        <div class="col-md-12">
                           <div class="widget bg-white">
                              <div class="widget-body">
                                 <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <div id="calendar"></div>
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
                        <h2><strong>Online Trading</strong> Platform</h2>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                           <i class="fa fa-cogs"></i>
                           </a>
                           <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                           </ul>
                           <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                           <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                           <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div class="widget-content">
                        <div class="gallery-wrap">
                           <div class="column1">
                              <div class="inner">
                                 <a  href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img src="images/metatrader/mt4_logo_white.jpg" alt="Please click here for download" title="MetaTrader 4" class="mfp-fade">
                                    </div>
                                    <div class="caption-hover">
                                       &nbsp;Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                              <div class="inner">
                                 <a  href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img src="images/metatrader/metatrader-mobile.png" width="100%" height="150px" alt="Image gallery" title="The Art of Money Maker" class="mfp-fade">
                                    </div>
                                    <div class="caption-hover">
                                       &nbsp;Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                              <div class="inner">
                                 <a  href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img src="images/metatrader/metatrader4_devices_v2.jpg" width="100%" height="163px" alt="Image gallery" title="The Art of Money Maker" class="mfp-fade">
                                    </div>
                                    <div class="caption-hover">
                                       &nbsp;Click Here to download Demo
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
               <div class="col-lg-4 col-md-6 portlets">
                  <div id="weather-widget" class="widget">
                     <div class="widget-header transparent">
                        <h2><strong>Weather</strong> Widget</h2>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a class="hidden" id="dropdownMenu1" data-toggle="dropdown">
                           <i class="fa fa-cogs"></i>
                           </a>
                           <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu1">
                              <li><a href="#">Action</a></li>
                              <li><a href="#">Another action</a></li>
                              <li><a href="#">Something else here</a></li>
                              <li class="divider"></li>
                              <li><a href="#">Separated link</a></li>
                           </ul>
                           <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                           <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                           <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div id="weather" class="widget-content">
                     </div>
                     <i class="wi-day-rain-mix"></i>
                     <button class="js-geolocation btn btn-sm btn-default" style="display: none;">Use Your Location</button>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 portlets">
                  <div id="calc" class="widget darkblue-2">
                     <div class="widget-header">
                        <div class="additional-btn left-toolbar">
                           <div class="btn-group">
                              <a class="additional-icon" id="dropdownMenu2" data-toggle="dropdown">
                              Calculator <i class="fa fa-angle-down"></i>
                              </a>
                              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                                 <li><a href="#">Save</a></li>
                                 <li><a href="#">Export</a></li>
                                 <li class="divider"></li>
                                 <li><a href="#">Quit</a></li>
                              </ul>
                           </div>
                        </div>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div id="calculator" class="widget-content">
                        <div class="calc-top col-xs-12">
                           <div class="row">
                              <div class="col-xs-3"><span class="calc-clean">C</span></div>
                              <div class="col-xs-9">
                                 <div class="calc-screen"></div>
                              </div>
                           </div>
                        </div>
                        <div class="calc-keys col-xs-12">
                           <div class="row">
                              <div class="col-xs-3"><span>7</span></div>
                              <div class="col-xs-3"><span>8</span></div>
                              <div class="col-xs-3"><span>9</span></div>
                              <div class="col-xs-3"><span class="calc-operator">+</span></div>
                           </div>
                           <div class="row">
                              <div class="col-xs-3"><span>4</span></div>
                              <div class="col-xs-3"><span>5</span></div>
                              <div class="col-xs-3"><span>6</span></div>
                              <div class="col-xs-3"><span class="calc-operator">-</span></div>
                           </div>
                           <div class="row">
                              <div class="col-xs-3"><span>1</span></div>
                              <div class="col-xs-3"><span>2</span></div>
                              <div class="col-xs-3"><span>3</span></div>
                              <div class="col-xs-3"><span class="calc-operator">÷</span></div>
                           </div>
                           <div class="row">
                              <div class="col-xs-3"><span>0</span></div>
                              <div class="col-xs-3"><span>.</span></div>
                              <div class="col-xs-3"><span class="calc-eval">=</span></div>
                              <div class="col-xs-3"><span class="calc-operator">x</span></div>
                           </div>
                        </div>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 col-md-6 portlets">
                  <div id="notes-app" class="widget">
                     <div class="notes-line"></div>
                     <div class="widget-header centered transparent">
                        <div class="left-btn btn-group"><a class="btn btn-sm btn-primary add-note"><i class="fa fa-plus"></i></a><a class="btn btn-sm btn-primary back-note-list"><i class="icon-align-justify"></i></a></div>
                        <h2>Notes</h2>
                        <div class="additional-btn">
                           <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                           <a href="#" class="widget-popout hidden tt" title="Pop Out/In"><i class="icon-publish"></i></a>
                           <a href="#" class="widget-maximize hidden"><i class="icon-resize-full-1"></i></a>
                           <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                           <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                        </div>
                     </div>
                     <div class="widget-content padding-sm">
                        <div id="notes-list">
                           <div class="scroller">
                              <ul class="list-unstyled">
                              </ul>
                           </div>
                        </div>
                        <div id="note-data">
                           <form>
                              <textarea class="form-control" id="note-text" placeholder="Your note..."></textarea>
                           </form>
                        </div>
                        <div class="status-indicator">Saved</div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"><?php echo '</script'; ?>
>
<!-- Page Specific JS Libraries -->
<?php echo '<script'; ?>
 src="assets/libs/jquery-blockui/jquery.blockUI.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/d3/d3.v3.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/rickshaw/rickshaw.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/raphael/raphael-min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/morrischart/morris.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-knob/jquery.knob.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-clock/clock.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/calculator.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/todo.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/apps/notes.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/pages/index.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/fullcalendar/fullcalendar.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/js/pages/calendar.js"><?php echo '</script'; ?>
>
</body><?php }
}
?>