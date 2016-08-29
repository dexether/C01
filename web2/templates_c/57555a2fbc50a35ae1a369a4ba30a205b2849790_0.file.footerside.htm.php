<?php /* Smarty version 3.1.27, created on 2016-08-29 09:37:19
         compiled from "/home/theprogrammer/project/cabinet-stable/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:80732815957c39fdf252b79_84725389%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57555a2fbc50a35ae1a369a4ba30a205b2849790' => 
    array (
      0 => '/home/theprogrammer/project/cabinet-stable/web2/templates/footerside.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '80732815957c39fdf252b79_84725389',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c39fdf257c13_89118474',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c39fdf257c13_89118474')) {
function content_57c39fdf257c13_89118474 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '80732815957c39fdf252b79_84725389';
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