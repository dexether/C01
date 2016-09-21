<?php /* Smarty version 3.1.27, created on 2016-09-15 06:11:18
         compiled from "/var/www/cabinet-stable/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:100295896657d9d916164060_52031800%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c46dde2211b25ef308c1234fea29af3c0ac1a80' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/footerside.htm',
      1 => 1473887587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '100295896657d9d916164060_52031800',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57d9d9161685c3_71204063',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57d9d9161685c3_71204063')) {
function content_57d9d9161685c3_71204063 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '100295896657d9d916164060_52031800';
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