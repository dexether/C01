<?php /* Smarty version 3.1.27, created on 2016-07-18 19:15:47
         compiled from "D:\web-dir\git\cabinet\web2\templates\ar_wrb_report.htm" */ ?>
<?php
/*%%SmartyHeaderCode:23222578cc873386b58_15647597%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fba3db591ae88a633e85f4a810471c12b41b39c' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\ar_wrb_report.htm',
      1 => 1468842349,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23222578cc873386b58_15647597',
  'variables' => 
  array (
    'token' => 0,
    'dataACCNO' => 0,
    'row' => 0,
    'allbonus' => 0,
    'a' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578cc87355c1c8_68366736',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578cc87355c1c8_68366736')) {
function content_578cc87355c1c8_68366736 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '23222578cc873386b58_15647597';
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
            Wealth Referal Bonus History
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12 portlets">
            <div class="widget">
                <div class="widget-header ">
                    <h2>
                        <strong>
                            Wealth
                        </strong>
                        Referal Bonus History
                    </h2>
                    <div class="additional-btn">
                        <a class="widget-toggle" href="#">
                            <i class="icon-down-open-2">
                            </i>
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                <div class="table-responsive">
            <!-- <div class="text-center"><h4><strong>Bonus Log</strong></h4></div> -->
            <!-- location.href = 'daily_statement.php?account=' + account.value +  '&datesearch=' + datesearch.value + '&mt4dt='+ mt4dt.value +'&excell=yes' -->
            <form class="form-inline" role="form" method="post" name="ajax-form" action="bonus_detail.php?postmode=excell">
            <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"></input>
              <div class="form-group">
                <!-- <input type="hidden" name="account" value="<?php echo $_smarty_tpl->tpl_vars['dataACCNO']->value['ACCNO'];?>
"></input> -->
                <select name="accounts" class="form-control">
                  <?php
$_from = $_smarty_tpl->tpl_vars['dataACCNO']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['ACCNO'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['ACCNO'];?>
</option>
                  <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                </select>
               <!--  <select class="form-control" name="bonus" id="bonus">
                  <option value="">-- All Bonus --</option>
                  <?php
$_from = $_smarty_tpl->tpl_vars['allbonus']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['a'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['a']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->_loop = true;
$foreach_a_Sav = $_smarty_tpl->tpl_vars['a'];
?>
                  <option value="<?php echo $_smarty_tpl->tpl_vars['a']->value['module'];?>
"><?php echo $_smarty_tpl->tpl_vars['a']->value['full'];?>
</option>
                  <?php
$_smarty_tpl->tpl_vars['a'] = $foreach_a_Sav;
}
?>
                </select> -->
              </div>
              <div class="form-group">
                <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                  <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                  <span></span> <b class="caret"></b>
                </div>
                <input type="hidden" name="tglnya" id="tglnya" value="">
              </div>

              <button type="button" class="btn btn-success" id="ajax-button"><span class="ladda-label">Submit</span></button>
              <aa id="to-excel-bonus" hidden>
                <!-- <button id="to-excel" type="submit" class="btn btn-green-3">
                  <i class="fa fa-file-text"></i> Export to Excell
                </button> -->
              </aa>
            </form>
            <br/>
            <table class="table table-hover table-striped" id="ajax-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Account</th>
                  <th>From</th>
                  <th>Amount</th>
                  <th>Date</th>
                  <th>Comment</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="8" class="text-center"><em>No data ...</em></td>

                </tr>


              </tbody>
            </table>
            <br>
            <br>
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
    <?php echo '<script'; ?>
 src="custom/js/ar_wrb_report.js" type="text/javascript"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
  jQuery(document).ready(function() {
    ar_wrb_report_JS.init();
    $('button[id=ajax-button]').click(function(event) {
      $button = $(this);
      $data = $('form[name=ajax-form]').serializeArray();
      ar_wrb_report_JS.get_data($data, $button);
    });
    
  });
<?php echo '</script'; ?>
>

</div><?php }
}
?>