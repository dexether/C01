<?php /* Smarty version 3.1.27, created on 2016-07-15 08:10:21
         compiled from "D:\web-dir\git\cabinet\web2\templates\imp_treeview.htm" */ ?>
<?php
/*%%SmartyHeaderCode:11382578837fd7df0a2_60826094%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f56f34541aa7400f74d672906b5bf1bb7d4ae4e0' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\imp_treeview.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11382578837fd7df0a2_60826094',
  'variables' => 
  array (
    'longtree' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578837fd81bc75_33271907',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578837fd81bc75_33271907')) {
function content_578837fd81bc75_33271907 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '11382578837fd7df0a2_60826094';
?>
<link rel="stylesheet" href="custom/treview/css/easyTree.css">
<?php echo '<script'; ?>
 src="custom/treview/src/easyTree.js"><?php echo '</script'; ?>
>
<div id="main_content" class="content">
    <div class="page-heading">
        <h1><i class="icon-user-3"></i>MLM Treview</h1>
    </div>
    <div class="row">
        <div class="col-md-12 portlets">
            <div class="widget">
                <div class="widget-header">
                    <h3 class="text-success">Downline</h3>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div class="easy-tree" >
                            
                             <?php echo $_smarty_tpl->tpl_vars['longtree']->value;?>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo '<script'; ?>
>
        (function($) {
        function init() {
        $('.easy-tree').EasyTree({
        addable: false,
        editable: false,
        deletable: false
        });
        }
        window.onload = init();
        })(jQuery)
        <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
        function myDetail(ACCNO) {
        //alert("I am an alert box: " + ACCNO);
        Treview_JS.accountdetail2(ACCNO)
        }
        <?php echo '</script'; ?>
>
    </div>
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
        </div>
        <div class="modal-body">
            <p>One fine body…</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
        </div>
    </div>
    <div class="md-modal md-3d-sign" data-modal="md-3d-sign" id="md-3d-sign">
        <div class="md-content">
            <h3>Modal Dialog</h3>
            <div>
                <p>This is a modal window. You can do the following things with it:</p>
                <ul>
                    <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
                    <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
                    <li><strong>Close:</strong> click on the button below to close the modal.</li>
                </ul>
                <p>
                    <button class="btn btn-danger md-close">Close me!</button>
                    <button class="btn btn-success md-close">Some button</button>
                </p>
            </div>
            </div><!-- End div .md-content -->
            </div><!-- End div .md-modal .md-3d-sign -->
            <?php echo '<script'; ?>
 src="custom/js/jquery.validate.min.js" type="text/javascript"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/libs/bootstrap-inputmask/inputmask.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="custom/js/treview.js" type="text/javascript"><?php echo '</script'; ?>
>
            
            <?php echo '<script'; ?>
>
            jQuery(document).ready(function() {
            Treview_JS.init();
            });
            <?php echo '</script'; ?>
>
            
            <?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/notify.min.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"><?php echo '</script'; ?>
>
            <?php echo '<script'; ?>
 src="custom/js/noty_general.js"><?php echo '</script'; ?>
><?php }
}
?>