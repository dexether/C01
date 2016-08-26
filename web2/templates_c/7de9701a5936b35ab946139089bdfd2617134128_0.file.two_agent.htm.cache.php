<?php /* Smarty version 3.1.27, created on 2016-08-25 11:22:42
         compiled from "/var/www/html/cabinet/web2/templates/two_agent.htm" */ ?>
<?php
/*%%SmartyHeaderCode:103591778757be7292949090_88841873%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7de9701a5936b35ab946139089bdfd2617134128' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/two_agent.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '103591778757be7292949090_88841873',
  'variables' => 
  array (
    'token' => 0,
    'accountlist' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57be7292978633_00702282',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57be7292978633_00702282')) {
function content_57be7292978633_00702282 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '103591778757be7292949090_88841873';
?>
<div class="content" id="main_content">
   <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js">
   <?php echo '</script'; ?>
>
   <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
   <link href="assets/libs/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <!-- validator -->
   <link href="custom/validator/dist/css/formValidation.min.css" rel="stylesheet"/>
   <!-- Sweat Alert -->
   <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js">
   <?php echo '</script'; ?>
>
   <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet"/>
   <div class="page-heading">
      <h1>
         <i class="fa fa-wrench">
         </i>
         TWO Agent Registration
      </h1>
   </div>
   <!-- Page Heading End-->
   <div class="row">
      <div class="col-md-12">
         <div class="widget">
            <div class="widget-header ">
               <h2>
                  <strong>
                     Account
                  </strong>
                  Management Connection
               </h2>
               <div class="additional-btn">
                  <a class="widget-toggle" href="#">
                     <i class="icon-down-open-2">
                     </i>
                  </a>
               </div>
            </div>
            <br/>
            <div class="widget-content padding">
               <div class="alert alert-success">
                  <p class="text-justify">
                     Admin only can define Agent Who's registered on the systems
                  </p>
               </div>
               <form class="form-horizontal" id="registerForm" method="post" role="form">
                  <div class="form-group">
                     <input id="token" name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"/>
                     <label class="col-sm-2 control-label">
                        Select Member
                     </label>
                     <div class="col-sm-5">
                        <select class="form-control" id="users" name="users">
                           <option disabled="" selected="" value="">
                              -- select Users --
                           </option>
                           <?php
$_from = $_smarty_tpl->tpl_vars['accountlist']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                           <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['aecodeid'];?>
">
                              <?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>

                           </option>
                           <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">
                     </label>
                     <div class="col-sm-5">
                        <input type="password" name="password" class="form-control" placeholder="Input your password here ..."></input>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">
                     </label>
                     <div class="col-sm-5">
                        <div class="input-group" id="ajax-btn">
                           <button class="btn btn-primary" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing ..." id="load" type="submit">
                              Register
                           </button>
                        </div>
                        <!-- /input-group -->
                     </div>
                  </div>
               </form>
               <hr/>
               <div class="table-div" hidden="">
                  <h3>
                     Account list Sync To Tarikh
                  </h3>
                  <table class="table table-responsive table-hover" id="login-list">
                     <thead>
                        <tr>
                           <th>
                              #
                           </th>
                           <th>
                              Brokers
                           </th>
                           <th>
                              LOGIN
                           </th>
                           <th>
                              Action
                           </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>
                           </td>
                           <td>
                           </td>
                           <td>
                           </td>
                           <td>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
   jQuery(document).ready(function($) {
    $('form').submit(function(event) {
      event.preventDefault();
      var data = $(this).serializeArray();
    });
  });
<?php echo '</script'; ?>
>

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<?php echo '<script'; ?>
 src="custom/validator/dist/js/formValidation.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/validator/dist/js/framework/bootstrap.min.js">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" src="custom/chain/jquery.chained.js?v=1.0.0" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" src="custom/chain/jquery.chained.remote.js?v=1.0.0" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/js/ar_account_mm.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
   $(document).ready(function() {
     ar_account_mm_JS.init();
     $('#registerForm').formValidation({
         framework: 'bootstrap',
         icon: {
             valid: 'glyphicon glyphicon-ok',
             invalid: 'glyphicon glyphicon-remove',
             validating: 'fa fa-circle-o-notch fa-spin'
         },
         fields: {
             password: {
                 validators: {
                     notEmpty: {
                         message: 'The Password is required'
                     }
                 }
             },
             users: {
                 validators: {
                     notEmpty: {
                         message: 'The Users is required'
                     }
                 }
             }
         }
     })
     .on('success.form.fv', function(e) {
           e.preventDefault();           
             var $form = $(e.target),
                 fv = $form.data('formValidation');
            
            ar_account_mm_JS.create_agent_two($form);
            // console.log('success clicked');
        });
 });
<?php echo '</script'; ?>
>

<?php }
}
?>