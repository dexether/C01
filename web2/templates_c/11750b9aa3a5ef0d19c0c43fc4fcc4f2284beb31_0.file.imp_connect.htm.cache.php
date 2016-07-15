<?php /* Smarty version 3.1.27, created on 2016-07-15 09:07:23
         compiled from "D:\web-dir\git\cabinet\web2\templates\imp_connect.htm" */ ?>
<?php
/*%%SmartyHeaderCode:129405788455bd4cff4_53964468%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11750b9aa3a5ef0d19c0c43fc4fcc4f2284beb31' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\imp_connect.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '129405788455bd4cff4_53964468',
  'variables' => 
  array (
    'token' => 0,
    'accountlist' => 0,
    'row' => 0,
    'party' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5788455c075528_05423721',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5788455c075528_05423721')) {
function content_5788455c075528_05423721 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '129405788455bd4cff4_53964468';
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
         Account connect
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
                     Admin can connect the Account to Thirdty Party program Like Meta Trader account
                  </p>
               </div>
               <form class="form-horizontal" id="registerForm" method="post" role="form">
                  <div class="form-group">
                     <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" id="token" />
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
                        Select Cabinet ID
                     </label>
                     <div class="col-sm-5">
                        <select class="form-control" id="cabinetid" name="cabinetid">
                           <option disabled="" selected="" value="">
                              -
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">
                        Select the thirty party
                     </label>
                     <div class="col-sm-5">
                        <select class="form-control" id="party" name="party">
                           <option disabled="" selected="" value="">
                              -- select thirty party --
                           </option>
                           <?php
$_from = $_smarty_tpl->tpl_vars['party']->value['typenya'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                           <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value;?>
">
                              <?php echo $_smarty_tpl->tpl_vars['row']->value;?>

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
                        Select IB
                     </label>
                     <div class="col-sm-5">
                        <select class="form-control" id="ib" name="ib">
                           <option disabled="" selected="" value="">
                              -
                           </option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-sm-2 control-label">
                        Select LOGIN
                     </label>
                     <div class="col-sm-5">
                        <select class="form-control" id="number" name="number">
                           <option disabled="" selected="" value="">
                              -
                           </option>
                        </select>
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
               <div class="table-div" hidden>
               <h3>
                  Account list Sync To Tarikh
               </h3>
               <table class="table table-responsive table-hover" id="login-list">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Brokers</th>
                    <th>LOGIN</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
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
    $('select[name=cabinetid]').change(function(event) {
      /* Act on the event */
      var memberid = $(this).val();
      // login-list
      $.ajax({
        url: 'json.php', 
        data: {postmode: 'list', memberid: memberid},
        type: 'GET',
        dataType: 'json',
        beforeSend: function(){
          $('table[id=login-list] tbody').html('');
          $('.table-div').show();
          $('.table-div h3').html('Account list Sync To '+ $('#users').find('option:selected').text());
          
        },
        success: function(response){
          // console.log(response)
          var number = 1;
          if (response.length > 0) {
              for (var i = 0; i < response.length; i++) {
              tr = $('<tr/>');
              tr.append("<td>" + number + "</td>");
              tr.append("<td>" + response[i].alias + "</td>");
              tr.append("<td>" + response[i].mt4login + "</td>");
              tr.append("<td><button class='btn btn-danger' type='button' onclick='ar_account_mm_JS.delete_do("+response[i].id+", token.value);'>Delete</button></td>");
              $('table[id=login-list] tbody').append(tr);
              number++;
            }
          }else{
            $('table[id=login-list] tbody').html('<tr><td colspan=4 align=center>No LOGIN connected to this Cabinet ID</td></tr>');
          }
          

        }
      });
      // alert();
    });

     ar_account_mm_JS.init();
     $('#registerForm').formValidation({
         framework: 'bootstrap',
         icon: {
             valid: 'glyphicon glyphicon-ok',
             invalid: 'glyphicon glyphicon-remove',
             validating: 'fa fa-circle-o-notch fa-spin'
         },
         fields: {
             cabinetid: {
                 validators: {
                     notEmpty: {
                         message: 'The Account is required'
                     }
                 }
             },
             users: {
                 validators: {
                     notEmpty: {
                         message: 'The Users is required'
                     }
                 }
             },
             party: {
                 validators: {
                     notEmpty: {
                         message: 'The Party is required'
                     }
                 }
             },
             ib: {
                 validators: {
                     notEmpty: {
                         message: 'The IB option is required'
                     }
                 }
             },
             number: {
                 validators: {
                     notEmpty: {
                         message: 'The Number option is required'
                     },
                     numeric: {
                         message: 'The price must be a number'
                     }
                 }
             }
         }
     })
     .on('success.form.fv', function(e) {
           e.preventDefault();
            // e, data parameters are the same as in err.field.fv event handler
            // Despite that the field is valid, by default, the submit button will be disabled if all the following conditions meet
            // - The submit button is clicked
            // - The form is invalid
             var $form = $(e.target),
                 fv = $form.data('formValidation');
            // ar_account_mm_JS.connect_do($form);
            ar_account_mm_JS.connect_do($form);
            // console.log('success clicked');
        });
     /*$("#model-remote").remoteChained({
        parents : "#series-remote",
        url : "json.php?sleep=1",
        loading : "--"
    });
    $("#engine-remote").remoteChained({
        parents : "#series-remote, #model-remote",
        url : "json.php?sleep=1",
        loading : "--",
        clear : true
    });*/
 });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 charset="utf-8" type="text/javascript">
   $(function() {
    $("#ib").remoteChained({
        parents : "#party",
        url : "json.php?postmode=cekib",
        clear : true,
        loading : "Loading..."
    });
    $("#cabinetid").remoteChained({
        parents : "#users",
        url : "json.php?postmode=cekid",
        clear : true,
        loading : "Loading..."
    });
    $("#number").remoteChained({
        parents : "#ib",
        url : "json.php?postmode=meta",
        clear : true,
        loading : "Loading..."
    });
  });
<?php echo '</script'; ?>
>


<?php }
}
?>