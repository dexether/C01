<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:05
         compiled from "/var/www/html/cabinet/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:75568581857bc4f653fd7a6_66954130%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '51b9e9eeb42dad41e951f8b84480a1952330d41f' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/footerside.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '75568581857bc4f653fd7a6_66954130',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f65405eb6_01046208',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f65405eb6_01046208')) {
function content_57bc4f65405eb6_01046208 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '75568581857bc4f653fd7a6_66954130';
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