<?php /* Smarty version 3.1.27, created on 2016-07-15 08:10:21
         compiled from "D:\web-dir\git\cabinet\web2\templates\footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:4727578837fd970d93_61224616%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a928a7408deb3d827ed03c03762da46d694eff51' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\footerside.htm',
      1 => 1468493003,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4727578837fd970d93_61224616',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578837fd9beee7_86602615',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578837fd9beee7_86602615')) {
function content_578837fd9beee7_86602615 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '4727578837fd970d93_61224616';
?>
<!-- Footer Start -->
<footer>
    Copyright <?php echo $_smarty_tpl->tpl_vars['companys']->value['companyname'];?>
, <?php echo $_smarty_tpl->tpl_vars['companys']->value['year'];?>

    <div class="footer-links pull-right">
        <a href="<?php echo $_smarty_tpl->tpl_vars['companys']->value['companyurl'];?>
" target="_new"><?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>
</a>
    </div>
</footer>
<!-- Footer End -->
<?php }
}
?>