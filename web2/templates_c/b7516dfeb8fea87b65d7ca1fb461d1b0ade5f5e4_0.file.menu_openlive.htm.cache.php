<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:44
         compiled from "/var/www/html/cabinet/web2/templates/menu_openlive.htm" */ ?>
<?php
/*%%SmartyHeaderCode:41848045257bc4f8c12b966_10281390%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7516dfeb8fea87b65d7ca1fb461d1b0ade5f5e4' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/menu_openlive.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '41848045257bc4f8c12b966_10281390',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f8c175850_36374279',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f8c175850_36374279')) {
function content_57bc4f8c175850_36374279 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '41848045257bc4f8c12b966_10281390';
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
                              <img align="middle" src="images/logo/imperium/logo.png" width="233">
                              <br/>
                              <br/>
                                 <ul class="list-group">
                                    <li class="list-group-item">
                                       Metatrader 4
                                    </li>
                                    <li class="list-group-item">
                                      Spread Start From 2.3
                                    </li>
                                    <li class="list-group-item">
                                       Min Depo $500
                                    </li>
                                    <li class="list-group-item">
                                       Leverage 1:100
                                    </li>
                                 </ul>
                                 <input type="button" name="imp-button" class="btn btn-blue-1" value="Open Account" onclick="window.open('http://www.askapimperium.com/')" />
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