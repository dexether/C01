<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:33
         compiled from "/var/www/html/cabinet/web2/templates/menu_openlive_two.htm" */ ?>
<?php
/*%%SmartyHeaderCode:11220497057bc4f818d4210_56005323%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7dd38ff867d3373a381d1fb1ea375de48317aed2' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/menu_openlive_two.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11220497057bc4f818d4210_56005323',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f8190a630_49836549',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f8190a630_49836549')) {
function content_57bc4f8190a630_49836549 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11220497057bc4f818d4210_56005323';
?>
<link href="assets/css/style.css" rel="stylesheet"/>
<style type="text/css">
   .list-group-item {
		color: black;
		font-weight: bold;
	}
</style>
<link href="custom/css/btn_openlive.css" rel="stylesheet"/>
<div class="content">
   <div class="page-heading">
      <h1>
         <i class="icon-th-list">
         </i>
         Open Live Account
      </h1>
   </div>
   <div class="row">
      <div class="col-sm-12 portlets">
         <div class="widget">
            <div class="widget-header transparent">
               <h2>
                  <strong>
                     Open
                  </strong>
                  New Live Account
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
               <div class="row">
                  <div class="col-sm-12">
                     <div class="col-sm-6 col-sm-offset-3">
                        <div class="widget">
                           <div align="center" class="widget-content padding center-block">
                              <img align="middle" src="images/logo/two/logo.png" width="233">
                              <br/>
                              <br/>
                                 <ul class="list-group">
                                    <li class="list-group-item">
                                       Metatrader 4 | Web Trader
                                    </li>
                                    <li class="list-group-item">
                                       Spread Start From 1
                                    </li>
                                    <li class="list-group-item">
                                       Min Depo $10
                                    </li>
                                    <li class="list-group-item">
                                       Leverage 1:500
                                    </li>
                                 </ul>
                                 <input type="button" name="imp-button" class="btn btn-blue-1" value="Open Account" onclick="window.open('https://trade.twofrx.com/signup')" />
                              </img>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php }
}
?>