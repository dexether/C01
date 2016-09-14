<?php
/*%%SmartyHeaderCode:142074787157d9da0e334642_62373510%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68231b6d184c440d1ceb426a4897c73c9a10f5bf' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/imp_detailed_report.htm',
      1 => 1473887587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '142074787157d9da0e334642_62373510',
  'tpl_function' => 
  array (
  ),
  'version' => '3.1.27',
  'unifunc' => 'content_57d9da7e9153d7_80220957',
  'has_nocache_code' => false,
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57d9da7e9153d7_80220957')) {
function content_57d9da7e9153d7_80220957 ($_smarty_tpl) {
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
                      <option value="01" >
                        Januari
                      </option>
                      <option value="02" >
                        Februari
                      </option>
                      <option value="03" >
                        Maret
                      </option>
                      <option value="04" >
                        April
                      </option>
                      <option value="05" >
                        Mei
                      </option>
                      <option value="06" >
                        Juni
                      </option>
                      <option value="07" >
                        Juli
                      </option>
                      <option value="08" >
                        Agustus
                      </option>
                      <option value="09"  selected >
                        September
                      </option>
                      <option value="10" >
                        Oktober
                      </option>
                      <option value="11" >
                        November
                      </option>
                      <option value="12" >
                        Desember
                      </option>
                    </select>
                  </div>
                  <div class="form-group">

                    <select class="form-control" name="tahun">
                                            <option value="2015" >2015
                      </option>
                                            <option value="2016"  selected >2016
                      </option>
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
  <script type="text/javascript" src="custom/js/imp_detailed_commison.js"></script>

  <script type="text/javascript">
    jQuery(document).ready(function() {
      imp_comm_JS.init();
      $('button[type=button]').click(function(event) {
        imp_comm_JS.get_data(this);
      });
    });
  </script>
</div><?php }
}
?>