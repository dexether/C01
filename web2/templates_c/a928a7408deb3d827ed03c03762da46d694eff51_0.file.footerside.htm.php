<?php /* Smarty version 3.1.27, created on 2016-07-30 20:58:08
         compiled from "D:\web-dir\git\cabinet\web2\templates\footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:24924579cb270cf5954_31925119%%*/
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
  'nocache_hash' => '24924579cb270cf5954_31925119',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579cb270d37984_10499021',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579cb270d37984_10499021')) {
function content_579cb270d37984_10499021 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '24924579cb270cf5954_31925119';
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