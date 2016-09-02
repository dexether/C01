<?php /* Smarty version 3.1.27, created on 2016-09-02 08:21:39
         compiled from "/var/www/cabinet-stable/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:187085947157c8d423354f34_92926368%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c46dde2211b25ef308c1234fea29af3c0ac1a80' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/footerside.htm',
      1 => 1472724567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '187085947157c8d423354f34_92926368',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c8d423359482_39247859',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c8d423359482_39247859')) {
function content_57c8d423359482_39247859 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '187085947157c8d423354f34_92926368';
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