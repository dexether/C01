<?php /* Smarty version 3.1.27, created on 2016-08-23 20:28:36
         compiled from "/var/www/html/cabinet/web2/templates/imp_client_comm.htm" */ ?>
<?php
/*%%SmartyHeaderCode:200996859357bc4f847b2436_68637641%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52c22ce82a17bf8c83b7c3aa293a9e98d90618d7' => 
    array (
      0 => '/var/www/html/cabinet/web2/templates/imp_client_comm.htm',
      1 => 1471709247,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '200996859357bc4f847b2436_68637641',
  'variables' => 
  array (
    'alldata' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57bc4f84813b82_70464584',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57bc4f84813b82_70464584')) {
function content_57bc4f84813b82_70464584 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '200996859357bc4f847b2436_68637641';
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
      Commission Report
    </h1>
  </div>
  <div class="row">
    <div class="col-md-12 portlets">
      <div class="widget">
        <div class="widget-header ">
          <h2>
            <strong>
              Client
            </strong>
            Commission Report
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
              <div class="col-sm-5"></div>
              <div class="col-sm-7" align="right">
                <form class="form-inline " role="form" id="ajax-form">
                  <div class="form-group">
                    <select class="form-control" name="account">
                      <option value="">- pilih Member ID -</option>
                      <?php
$_from = $_smarty_tpl->tpl_vars['alldata']->value['listaccount'];
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
"><?php echo $_smarty_tpl->tpl_vars['row']->value;?>
</option>
                      <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                    </select>
                  </div>
                  <div class="form-group">
                  <select class="form-control" name="rolldate">
                      <option value="">- pilih Periode -</option>
                      <?php
$_from = $_smarty_tpl->tpl_vars['alldata']->value['rolldate'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                      <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['value'];?>
"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</option>
                      <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                    </select>
                  </div>
                  <button class="btn btn-blue-2" type="button">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
          <h3 class="text-center"><strong> Laporan Komisi Total / Mamber</strong></h3>
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
 type="text/javascript" src="custom/js/imp_detailed_commison.js"><?php echo '</script'; ?>
>

  <?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function() {
      imp_comm_JS.init();
      $('button[type=button]').click(function(event) {
        imp_comm_JS.get_data_client(this);
      });
    });
  <?php echo '</script'; ?>
>
</div><?php }
}
?>