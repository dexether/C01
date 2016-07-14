<?php /* Smarty version 3.1.27, created on 2016-07-13 15:50:38
         compiled from "D:\web-dir\cabinet\web2\templates\footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:31537578600de970226_27256835%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a00962f2959edea67c8729e0c0661f64746f5c4' => 
    array (
      0 => 'D:\\web-dir\\cabinet\\web2\\templates\\footerside.htm',
      1 => 1460626924,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31537578600de970226_27256835',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578600de9c1b17_29624115',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578600de9c1b17_29624115')) {
function content_578600de9c1b17_29624115 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '31537578600de970226_27256835';
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