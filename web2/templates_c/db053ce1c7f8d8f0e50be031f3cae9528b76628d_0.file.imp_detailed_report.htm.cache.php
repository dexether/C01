<?php /* Smarty version 3.1.27, created on 2016-08-25 11:22:46
         compiled from "/var/www/html/cabinet/web2/templates/imp_detailed_report.htm" */ ?>
<?php
/*%%SmartyHeaderCode:108766421757be729676d061_15703915%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db053ce1c7f8d8f0e50be031f3cae9528b76628d' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/imp_detailed_report.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '108766421757be729676d061_15703915',
  'variables' => 
  array (
    'tahun' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57be72967f1526_36225747',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57be72967f1526_36225747')) {
function content_57be72967f1526_36225747 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '108766421757be729676d061_15703915';
?>
<div class="content" id="main_content">
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
              <div class="col-sm-3"></div>
              <div class="col-sm-9" align="right">
                <form class="form-inline " role="form" id="ajax-form" method="post" action="imp_comm_excel.php">
                  <div class="form-group">
                    <select class="form-control" name="bulan">
                      <option value="0">
                        -- Select Month --
                      </option>
                      <option value="01" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '01') {?> selected <?php }?>>
                        Januari
                      </option>
                      <option value="02" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '02') {?> selected <?php }?>>
                        Februari
                      </option>
                      <option value="03" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '03') {?> selected <?php }?>>
                        Maret
                      </option>
                      <option value="04" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '04') {?> selected <?php }?>>
                        April
                      </option>
                      <option value="05" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '05') {?> selected <?php }?>>
                        Mei
                      </option>
                      <option value="06" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '06') {?> selected <?php }?>>
                        Juni
                      </option>
                      <option value="07" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '07') {?> selected <?php }?>>
                        Juli
                      </option>
                      <option value="08" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '08') {?> selected <?php }?>>
                        Agustus
                      </option>
                      <option value="09" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '09') {?> selected <?php }?>>
                        September
                      </option>
                      <option value="10" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '10') {?> selected <?php }?>>
                        Oktober
                      </option>
                      <option value="11" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '11') {?> selected <?php }?>>
                        November
                      </option>
                      <option value="12" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['bulan_selected'] == '12') {?> selected <?php }?>>
                        Desember
                      </option>
                    </select>
                  </div>
                  <div class="form-group">

                    <select class="form-control" name="tahun">
                      <?php
$_from = $_smarty_tpl->tpl_vars['tahun']->value['tahun'];
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
" <?php if ($_smarty_tpl->tpl_vars['tahun']->value['tahun_selected'] == $_smarty_tpl->tpl_vars['row']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value;?>

                      </option>
                      <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                    </select>
                  </div>
                  <div class="form-group">

                    <select class="form-control" name="keanggotaan">
                      <option value="0">-- pilih tipe keanggotaan</option>
                      <option value="true">Agen</option>
                      <option value="false">Nasabah</option>
                    </select>
                  </div>
                  <button class="btn btn-blue-2" type="button">
                    Submit
                  </button>
                  <button class="btn btn-green-1" type="submit">
                    Export to Excel
                  </button>
                </form>
              </div>
            </div>
          </div>
          <h3 class="text-center"><strong> Laporan Komisi Total / Member</strong></h3>
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
          <span class="help-block" align="left">Laporan Komisi</span>
          <table class="table table-striped table-hover" id="table-komisi">
            <thead>
              <tr>
                <th>
                  Member ID
                </th>
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
                <td colspan=7 class=text-center> Tidak ada komisi untuk bulan ini </td>
                
              </tr>

            </tbody>
          </table>
          <br/>
          <h3 class="text-center"><strong>LOGIN tidak teregistrasi</strong></h3>
          <table class="table table-striped table-hover" id="table-anony">
            <thead>
              <tr>
                <th>
                  LOGIN
                </th>
                <th>Tipe</th>
                <th>Periode</th>
                <th>lot</th>
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
 type="text/javascript" src="custom/js/imp_detailed_commison.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function() {
      imp_comm_JS.init();
      $('button[type=button]').click(function(event) {
        imp_comm_JS.get_data(this);
      });
    });
  <?php echo '</script'; ?>
>
</div><?php }
}
?>