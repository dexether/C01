<?php /* Smarty version 3.1.27, created on 2016-08-29 07:49:31
         compiled from "/root/project/cabinet-stable/web2/templates/mall_payment.htm" */ ?>
<?php
/*%%SmartyHeaderCode:50249676557c3869be6bb25_34862988%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ba413eebe59febcce728cf18364fc15b6f4a44d7' => 
    array (
      0 => '/root/project/cabinet-stable/web2/templates/mall_payment.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '50249676557c3869be6bb25_34862988',
  'variables' => 
  array (
    'token' => 0,
    'list_cmd' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c3869be90d75_56132847',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c3869be90d75_56132847')) {
function content_57c3869be90d75_56132847 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '50249676557c3869be6bb25_34862988';
?>
<div id="main_content" class="content">
    <link href="custom/daterange/css/daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
    <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js"><?php echo '</script'; ?>
>
    <link rel="stylesheet" href="custom/sweetalert/dist/sweetalert.css">
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1><i class="icon-user-3"></i> Admin Transaction Approval
    </h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header ">
                    <h2><strong>Admin</strong> Approval</h2>
                    <div class="additional-btn">
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                    </div>
                </div>
                <br>
                <div class="widget-content padding">
                    <!-- <div class="input-group">
                        <div class="input-group-btn">
                            <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="true">Action <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div>

                    </div> -->
                    <div class="data-table-toolbar">
                        <div class="row">
                            <div class="col-md-12 pull-right">
                                <form class="form-inline" id="ajax-form">
                                    <input type="hidden" name="token" id="token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
                                    <div class="form-group">
                                        <div class="pull-right" id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar">
                                          </i>
                                            <span>
                                          </span>
                                            <b class="caret">
                                          </b>
                                        </div>
                                        <input id="tglnya" name="tglnya" type="hidden" value="">
                                        </input>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="cmd">
                                            <?php
$_from = $_smarty_tpl->tpl_vars['list_cmd']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['cmd'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['row']->value['cmd_alias'];?>

                                            </option>
                                            <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-primary fa fa-filter" value="Filter" />

                                </form>

                            </div>
                            <hr/>
                            <br/>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th >Invoice</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>
                                  Action
                                </th>
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

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo '<script'; ?>
 src="custom/daterange/js/moment.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/daterange/js/daterangepicker.js" type="text/javascript">
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    $(function() {

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#tglnya').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        }
        cb(moment().subtract(29, 'days'), moment());

        $('#reportrange').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

    });
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="custom/js/mall_payment.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        mall_payment_JS.init();

    });
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function($) {
        $("form").submit(function(event) {
            // Get the submit button element
            event.preventDefault();
            var btn = $(this).find("input[type=submit]:focus");
            var data = $(this).serializeArray();
            $(btn).button('loading');
            mall_payment_JS.get_data(data, btn);
            // console.log(data);
            // console.log(btn)
        });

    });
<?php echo '</script'; ?>
>
<?php }
}
?>