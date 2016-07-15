<?php /* Smarty version 3.1.27, created on 2016-07-15 08:46:17
         compiled from "D:\web-dir\git\cabinet\web2\templates\imp_treeview_detail.htm" */ ?>
<?php
/*%%SmartyHeaderCode:2425157884069d58a69_26018659%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89bafc89057c7fcffce68afc6baf5ca96f931d8b' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\imp_treeview_detail.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2425157884069d58a69_26018659',
  'variables' => 
  array (
    'datalogin' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5788406a78d398_60271615',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5788406a78d398_60271615')) {
function content_5788406a78d398_60271615 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2425157884069d58a69_26018659';
?>
<div class="content" id="main_content">
   <div class="page-heading">
      <h1>
         <i class="icon-vcard">
         </i>
         Treeview details
      </h1>
   </div>
   <div class="row">
      <div class="col-md-12 portlets">
         <div class="widget">
            <div class="widget-header transparent">
               <h2>
                  <strong>
                     Treeview
                  </strong>
                  Details
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
            <?php if (!empty($_smarty_tpl->tpl_vars['datalogin']->value)) {?>
               <form action="" class="form-inline" method="POST" role="form">
                  <div class="form-group">
                     <label for="">
                        Pilih Login
                     </label>
                     <select class="form-control" name="login" id="login">
                        <option selected="" value="">
                           - Pilih Login -
                        </option>
                        <?php
$_from = $_smarty_tpl->tpl_vars['datalogin']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['mt4login'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['mt4login'];?>
</option>
                        <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                     </select>
                  </div>
                  <button class="btn btn-primary" type="button" onclick="myDetail(login.value);">
                     Submit
                  </button>
               </form>
            <?php } else { ?>
            <div class="alert alert-warning">
              <p>Anda tidak diperbolehkan mengakses halaman ini</p>
            </div>
            <?php }?>
               <br/>
               <br/>
            </div>
         </div>
      </div>
   </div>
   <div id="ajax-load">
     
   </div>
</div>
<?php echo '<script'; ?>
 src="custom/js/treview.js" type="text/javascript">
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
   function myDetail(ACCNO) {
        // alert("I am an alert box: " + ACCNO);
        Treview_JS.accountdetail3(ACCNO)
      }
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
   jQuery(document).ready(function() {
    Treview_JS.init();
  });
<?php echo '</script'; ?>
>

<?php }
}
?>