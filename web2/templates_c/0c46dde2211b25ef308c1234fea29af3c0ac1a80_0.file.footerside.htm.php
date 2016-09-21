<?php /* Smarty version 3.1.27, created on 2016-09-20 12:25:49
         compiled from "/var/www/cabinet-stable/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:54111063357e0c85d562d41_66263092%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c46dde2211b25ef308c1234fea29af3c0ac1a80' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/footerside.htm',
      1 => 1474343347,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54111063357e0c85d562d41_66263092',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57e0c85d5671e5_66774668',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57e0c85d5671e5_66774668')) {
function content_57e0c85d5671e5_66774668 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '54111063357e0c85d562d41_66263092';
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