<?php /* Smarty version 3.1.27, created on 2016-08-29 07:47:04
         compiled from "/root/project/cabinet-stable/web2/templates/footerside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:190742203857c3860879f669_87904749%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b68128764efbf3886349ce5eb6409e60689d59ff' => 
    array (
      0 => '/root/project/cabinet-stable/web2/templates/footerside.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190742203857c3860879f669_87904749',
  'variables' => 
  array (
    'companys' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c386087a4931_55285064',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c386087a4931_55285064')) {
function content_57c386087a4931_55285064 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '190742203857c3860879f669_87904749';
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