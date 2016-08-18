<?php /* Smarty version 3.1.27, created on 2016-08-17 11:03:02
         compiled from "D:\web-dir\git\cabinet\web2\templates\footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:2223757b3e1f6322a94_56666641%%*/
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
  'nocache_hash' => '2223757b3e1f6322a94_56666641',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57b3e1f637c064_01113380',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57b3e1f637c064_01113380')) {
function content_57b3e1f637c064_01113380 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2223757b3e1f6322a94_56666641';
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