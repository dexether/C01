<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:46
         compiled from "/var/www/html/cabinet/web2/templates/imp_registration.htm" */ ?>
<?php
/*%%SmartyHeaderCode:37861915157bc4f8eaa5c27_64651724%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d1ea352d589598108cd98c79bf9eacd49c634b4' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/imp_registration.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '37861915157bc4f8eaa5c27_64651724',
  'variables' => 
  array (
    'user' => 0,
    'clientaecode' => 0,
    'token' => 0,
    'group_play' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f8eb0cb81_39597329',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f8eb0cb81_39597329')) {
function content_57bc4f8eb0cb81_39597329 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '37861915157bc4f8eaa5c27_64651724';
?>
<div id="main_content" class="content">
  <link rel="stylesheet" href="custom/js/phone/intlTelInput.css">
  <link href="assets/libs/jquery-notifyjs/styles/metro/notify-metro.css" rel="stylesheet" type="text/css" />
  <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js"><?php echo '</script'; ?>
>
 <link rel="stylesheet" href="custom/sweetalert/dist/sweetalert.css">
  <!-- Page Heading Start -->
  <div class="page-heading">
    <h1><i class="icon-user-3"></i> Afiliate Registration
    </h1>
  </div>
  <!-- Page Heading End-->
  <div class="row">
    <div class="col-md-12">
      <div class="widget">
        <div class="widget-header ">
          <h2>Dear <?php if ($_smarty_tpl->tpl_vars['user']->value->groupid == '9') {?> Admin <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['clientaecode']->value['name'];?>
 are You Ready to join ? <?php }?>,</h2>
          <div class="additional-btn">
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
          </div>
        </div>
        <br>
        <div class="widget-content padding">
          <?php if ($_smarty_tpl->tpl_vars['user']->value->groupid == '9') {?>
          <div class="alert alert-danger nomargin">
            * Admin Can not create user yet
          </div>
          <?php } else { ?>
          <div class="alert alert-warning nomargin">
            * If you Know us From Ads or Mass media, and not from agent, fill the referall with <b>COMPANY</b>
            <br>
            
          </div>
          <br>
          
          <form id="registerForm" class="form-horizontal"  role="form"  method="post" action="mm_new_level?postmode=createnewlevel">
            <div class="form-group">
              <label class="col-sm-6 control-label">Please Fill your Upline Code / Email</label>
              <div class="col-sm-6">
                <input type="text" name="accnomlm" id="accnomlm" class="form-control" placeholder="Enter Upline Code / Email" value=''>
                <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"></input>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-6 control-label">Type plan do you want to join</label>
              <div class="col-sm-6">
                <select name="plan" class="form-control">
                  <option value="0" selected>Follow your upline plan</option>
                  <?php
$_from = $_smarty_tpl->tpl_vars['group_play']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_play'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['alias'];?>
</option>
                  <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                </select>
              </div>
            </div>
            <!-- <div class="form-group">
              <label class="col-sm-6 control-label">Please Select the Plan</label>
              <div class="col-sm-6">
                <select class="form-control" name="plan" id="plan">
                  <?php
$_from = $_smarty_tpl->tpl_vars['group_play']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                  	<option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['group_play'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['description'];?>
</option>
                  <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-6 control-label">Please Fill in / Update your HP</label>
              <div class="col-sm-6">
                <input type="text" class="form-control" id="telephone_mobile" name="telephone_mobile" value="">
              </div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-6 control-label"></label>
              <div class="col-sm-6">
                <div class="input-group" id="ajax-btn">
                  <button type="button" class="btn btn-primary" id="load" onclick="AR_Registration_JS.imp_registration(this);" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ...">Register</button>
                </div><!-- /input-group -->
              </div>
            </div>
          </form>
          <?php }?>
        </div>
      </div>
    </div>


  </div>
</div>

<?php echo '<script'; ?>
 src="custom/js/phone/intlTelInput.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
  function onCountryChange() {
  //alert($("#country").val());
}
$("#telephone_home").intlTelInput({
  //allowExtensions: true,
  //autoFormat: true,
  //autoHideDialCode: true,
  autoPlaceholder: true,
  //defaultCountry: "auto",
  //geoIpLookup: "ID",
  nationalMode: false,
  //numberType: "MOBILE",
  //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
  preferredCountries: ['id', 'my', 'sg'],
  utilsScript: "custom/js/phone/utils.js"
});
$("#telephone_fax").intlTelInput({
  autoPlaceholder: true,
  nationalMode: false,
  preferredCountries: ['id', 'my', 'sg'],
  utilsScript: "custom/js/phone/utils.js"
});
$("#telephone_mobile").intlTelInput({
  autoPlaceholder: true,
  nationalMode: false,
  preferredCountries: ['id', 'my', 'sg'],
  utilsScript: "custom/js/phone/utils.js"
});
$("#telephone_office").intlTelInput({
  autoPlaceholder: true,
  nationalMode: false,
  preferredCountries: ['id', 'my', 'sg'],
  utilsScript: "custom/js/phone/utils.js"
});
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="custom/js/ar_registration.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
  jQuery(document).ready(function() {
    AR_Registration_JS.init();
    $('form').submit(function(event) {
      event.preventDefault();
      AR_Registration_JS.imp_registration($('button'));
    });
  });
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="custom/js/noty_general.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/notify.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"><?php echo '</script'; ?>
><?php }
}
?>