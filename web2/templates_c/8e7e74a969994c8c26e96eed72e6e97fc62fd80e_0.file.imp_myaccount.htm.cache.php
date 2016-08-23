<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:47
         compiled from "/var/www/html/cabinet/web2/templates/imp_myaccount.htm" */ ?>
<?php
/*%%SmartyHeaderCode:44361886357bc4f8f6f74e5_47489497%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e7e74a969994c8c26e96eed72e6e97fc62fd80e' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/imp_myaccount.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44361886357bc4f8f6f74e5_47489497',
  'variables' => 
  array (
    'alldatas' => 0,
    'i' => 0,
    'a' => 0,
    'b' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f8f7a4e42_52697601',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f8f7a4e42_52697601')) {
function content_57bc4f8f7a4e42_52697601 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '44361886357bc4f8f6f74e5_47489497';
?>
<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
               <span aria-hidden="true">
                  ×
               </span>
            </button>
            <h4 class="modal-title" id="myModalLabel">
               Change You Package
            </h4>
         </div>
         <div class="modal-body">
         </div>
         <div class="modal-footer">
            <button class="btn btn-default" data-dismiss="modal" type="button">
               Close
            </button>
            <button class="btn btn-primary" onclick="ar_myaccount_JS.savetodb(this)" type="button">
               Save changes
            </button>
         </div>
      </div>
   </div>
</div>
<div class="content" id="main_content">
   <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js">
   <?php echo '</script'; ?>
>
   <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet">
      <!-- Page Heading Start -->
      <div class="page-heading">
         <h1>
            <i class="fa fa-wrench">
            </i>
            My Account
         </h1>
      </div>
      <!-- Page Heading End-->
      <div class="row">
         <div class="col-md-12">
            <div class="widget">
               <div class="widget-header ">
                  <h2>
                     <strong>
                        Account
                     </strong>
                     list
                  </h2>
                  <div class="additional-btn">
                     <a class="widget-toggle" href="#">
                        <i class="icon-down-open-2">
                        </i>
                     </a>
                  </div>
               </div>
               <br>
                  <div class="widget-content padding">
                     <div class="table-responsive">
                        <table class="table table-hover">
                           <thead>
                              <tr>
                                 <th>
                                    No
                                 </th>
                                 <th>
                                    Account
                                 </th>
                                 <th>
                                    Package
                                 </th>
                                 <th>
                                    Status
                                 </th>
                                 <th>
                                    Meta LOGIN
                                 </th>
                                 <th>
                                    Referal Link
                                 </th>
                              </tr>
                           </thead>
                           <?php if (isset($_smarty_tpl->tpl_vars["i"])) {$_smarty_tpl->tpl_vars["i"] = clone $_smarty_tpl->tpl_vars["i"];
$_smarty_tpl->tpl_vars["i"]->value = "1"; $_smarty_tpl->tpl_vars["i"]->nocache = null; $_smarty_tpl->tpl_vars["i"]->scope = 0;
} else $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable("1", null, 0);?>
              <?php
$_from = $_smarty_tpl->tpl_vars['alldatas']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['a']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->_loop = true;
$foreach_a_Sav = $_smarty_tpl->tpl_vars['a'];
?>
                           <tr>
                              <td>
                                 <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

                              </td>
                              <td>
                                 <?php echo $_smarty_tpl->tpl_vars['a']->value['accountname'];?>

                              </td>
                              <td>
                                 <?php echo $_smarty_tpl->tpl_vars['a']->value['description'];?>

                              </td>
                              <td>
                                 <?php if ($_smarty_tpl->tpl_vars['a']->value['suspend'] == '0') {?>
                                 <span class="label label-success">
                                    Active
                                 </span>
                                 <?php } else { ?>
                                 <span class="label label-danger">
                                    Suspend
                                 </span>
                                 <?php }?>
                              </td>
                              <td>
                              <?php
$_from = $_smarty_tpl->tpl_vars['a']->value['mt4dt_login'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['b'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['b']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->_loop = true;
$foreach_b_Sav = $_smarty_tpl->tpl_vars['b'];
?>
                              <?php echo $_smarty_tpl->tpl_vars['b']->value['alias'];?>
 (<?php echo $_smarty_tpl->tpl_vars['b']->value['mt4login'];?>
),
                              <?php
$_smarty_tpl->tpl_vars['b'] = $foreach_b_Sav;
}
if (!$_smarty_tpl->tpl_vars['b']->_loop) {
?>
                              <span class="label label-warning">Not Sync to Any meta LOGIN</span>
                              <?php
}
?>
                              
                              </td>
                              <td>
                                 <button class="btn btn-xs btn-blue-1" data-clipboard-text="<?php echo $_smarty_tpl->tpl_vars['a']->value['url'];?>
">
                           Copy to clipboard
                        </button>
                              </td>
                           </tr>
                           <?php if (isset($_smarty_tpl->tpl_vars["i"])) {$_smarty_tpl->tpl_vars["i"] = clone $_smarty_tpl->tpl_vars["i"];
$_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars['i']->value+1; $_smarty_tpl->tpl_vars["i"]->nocache = null; $_smarty_tpl->tpl_vars["i"]->scope = 0;
} else $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
              <?php
$_smarty_tpl->tpl_vars['a'] = $foreach_a_Sav;
}
if (!$_smarty_tpl->tpl_vars['a']->_loop) {
?>
                           <tr>
                              <td colspan="4">
                                 No Data
                              </td>
                           </tr>
                           <?php
}
?>
                        </table>
                        
                     </div>
                  </div>
               </br>
            </div>
         </div>
      </div>
   </link>
</div>
<?php echo '<script'; ?>
 src="custom/clipboard/clipboard.min.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/js/ar_myaccount.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
   
      $(document).ready(function() {
        $(".btn").unbind();
          // console.log('ready');
          var clipboard = new Clipboard('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });
    clipboard.on('error', function(e) {
        console.log(e);
    });
          ar_myaccount_JS.init();
      });
      
<?php echo '</script'; ?>
>
<?php }
}
?>