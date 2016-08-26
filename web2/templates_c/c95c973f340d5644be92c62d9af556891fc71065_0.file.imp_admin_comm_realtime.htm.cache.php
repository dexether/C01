<?php /* Smarty version 3.1.27, created on 2016-08-25 11:22:44
         compiled from "/var/www/html/cabinet/web2/templates/imp_admin_comm_realtime.htm" */ ?>
<?php
/*%%SmartyHeaderCode:8808512357be729460c145_97342500%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c95c973f340d5644be92c62d9af556891fc71065' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/imp_admin_comm_realtime.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8808512357be729460c145_97342500',
  'variables' => 
  array (
    'token' => 0,
    'alldatas' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57be7294638029_41281842',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57be7294638029_41281842')) {
function content_57be7294638029_41281842 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8808512357be729460c145_97342500';
?>
<div class="content" id="main_content">
<link href="custom/daterange/css/daterangepicker.css" media="all" rel="stylesheet" type="text/css"/>
  <style type="text/css">
    table thead {
      background-color: #000099;
      color: white;

    }
    .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
      background-color: #FF9966;
    }
    
  </style>
  <div class="page-heading">
    <h1>
      <i class="icon-vcard">
      </i>
      Realtime Commision Report
    </h1>
  </div>
  <div class="row">
    <div class="col-md-12 portlets">
      <div class="widget">
        <div class="widget-header ">
          <h2>
            <strong>
              Realtime
            </strong>
            Commision Report
          </h2>
          <div class="additional-btn">
            <a class="widget-toggle" href="#">
              <i class="icon-down-open-2">
              </i>
            </a>
          </div>
        </div>
        <div class="widget-content padding">
        <div class="alert alert-warning">
          <p class="text-justify">
            <strong>NOTE : </strong> Membuat laporan akan memakan waktu paling lama 2 menit, mohon bersabar
          </p>
        </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-5"></div>
              <div class="col-sm-7" align="right">
                <form class="form-inline " role="form" id="ajax-form">
                <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"></input>
                  <div class="form-group">
                    <select class="form-control" name="account">
                      <option value="0">- Semua member -</option>
                      <?php
$_from = $_smarty_tpl->tpl_vars['alldatas']->value['listaccount'];
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
                  <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                  </div>
                    <input type="hidden" name="tglnya" id="tglnya" value="">
                 </div>
                  <button id="ajax-button" class="btn btn-blue-2" type="button">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
          <h3 class="text-center"><strong> Summary Report</strong></h3>
          <hr/>
          <table class="table table-striped table-hover" id="table-komisi-group">
          <thead>
            <tr>
              <th>Member ID</th>
              <th>Nama</th>
              <th>Keanggotaan</th>
              <th>Komisi</th>
            </tr>
          </thead>
          <tbody>
             <td colspan=5 class=text-center> Tidak ada komisi untuk bulan ini </td>
          </tbody>
          </table>
          <br/>
          <h3 class="text-center"><strong> Laporan Komisi Lengkap / Member id</strong></h3>
          <table class="table table-striped table-hover" id="table-komisi">
            <thead>
              <tr>
                <th>Member ID</th>
                <th>Nama</th>
                <th>Dari Member</th>
                <th>Keanggotaan</th>
                <th>Level</th>
                <th>Lot</th>
                <th>Komisi</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan=8 class=text-center> Tidak ada komisi untuk bulan ini </td>
                
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php echo '<script'; ?>
 type="text/javascript" src="custom/js/imp_realtime.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function() {
      imp_realtime_JS.init();
      $('button[type=button]').click(function(event) {
        imp_realtime_JS.generate_admin(this);
      });
    });
  <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="custom/daterange/js/moment.js" type="text/javascript">
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="custom/daterange/js/daterangepicker.js" type="text/javascript"/>
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