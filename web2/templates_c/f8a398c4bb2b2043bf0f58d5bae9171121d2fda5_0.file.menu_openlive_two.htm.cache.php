<?php /* Smarty version 3.1.27, created on 2016-07-28 09:59:23
         compiled from "D:\web-dir\git\cabinet\web2\templates\menu_openlive_two.htm" */ ?>
<?php
/*%%SmartyHeaderCode:246465799750ba57423_84548102%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f8a398c4bb2b2043bf0f58d5bae9171121d2fda5' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\menu_openlive_two.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '246465799750ba57423_84548102',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799750bc032f7_63885894',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799750bc032f7_63885894')) {
function content_5799750bc032f7_63885894 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '246465799750ba57423_84548102';
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