<?php /* Smarty version 3.1.27, created on 2016-07-15 17:52:24
         compiled from "D:\web-dir\git\cabinet\web2\templates\ar_transaction_history.htm" */ ?>
<?php
/*%%SmartyHeaderCode:22725788c068506b27_67386990%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1cac4f51947866ac6b8f90572b71068303e20797' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\ar_transaction_history.htm',
      1 => 1468574041,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22725788c068506b27_67386990',
  'variables' => 
  array (
    'token' => 0,
    'accounts' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5788c06865a699_04313880',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5788c06865a699_04313880')) {
function content_5788c06865a699_04313880 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '22725788c068506b27_67386990';
?>
<div class="content" id="main_content">
    <link href="custom/daterange/css/daterangepicker.css" media="all" rel="stylesheet" type="text/css"/>
    <style type="text/css">
        table thead {
      background-color: orange;
      color: white;

    }
    </style>
    <div class="page-heading">
        <h1>
            <i class="icon-vcard">
            </i>
            Detail Commission
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12 portlets">
            <div class="widget">
                <div class="widget-header ">
                    <h2>
                        <strong>
                            Detail
                        </strong>
                        Commission
                    </h2>
                    <div class="additional-btn">
                        <a class="widget-toggle" href="#">
                            <i class="icon-down-open-2">
                            </i>
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                            </div>
                            <div align="right" class="col-sm-9">
                                <form action="imp_comm_excel.php" class="form-inline " id="ajax-form" method="post" role="form">
                                    <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"/>
                                    <div class="form-group">
                                        <select class="form-control" name="accounts">
                                            <option selected="true" value="0">
                                                -- All Account --
                                            </option>
                                            <?php
$_from = $_smarty_tpl->tpl_vars['accounts']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['accountname'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['accountname'];?>
</option>
                                            <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                                        </select>
                                    </div>
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
                                        <select class="form-control" name="type">
                                            <option value="0">
                                                -- Select Transaction --
                                            </option>
                                            <option value="withdrawal">
                                                Withdrawal
                                            </option>
                                            <option value="transfer">
                                                Transfer
                                            </option>
                                            <option value="bonus">
                                                Bonus
                                            </option>
                                        </select>
                                    </div>
                                    <button class="btn btn-blue-2" name="get_data" type="button">
                                        Submit
                                    </button>
                                    <!-- <button class="btn btn-green-1" type="submit">
                                        Export to Excel
                                    </button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center">
                        <strong>
                            Transaction History
                        </strong>
                    </h3>
                    <hr/>
                    <table class="table table-striped table-hover" id="table-komisi-group">
                        <thead>
                            <tr>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Account Number
                                </th>
                                <th>
                                    Description
                                </th>
                                <th>
                                    Amount
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <td class="text-center" colspan="5">
                                There is no data
                            </td>
                        </tbody>
                    </table>
                    <br/>
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
 src="custom/js/ar_transaction_history.js" type="text/javascript">
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type="text/javascript">
        jQuery(document).ready(function($) {
        ar_transaction_history_JS.init();
        $('button[name=get_data]').click(function(event) {
          /* Act on the event */
          $data = $('form[id=ajax-form]').serializeArray();
          // console.log($data);
          ar_transaction_history_JS.get_data($data, this);
        });
      });
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
</div><?php }
}
?>