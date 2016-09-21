<?php /* Smarty version 3.1.27, created on 2016-09-20 12:25:49
         compiled from "/var/www/cabinet-stable/web2/templates/loket_finansial.htm" */ ?>
<?php
/*%%SmartyHeaderCode:95550648057e0c85d555a93_48497382%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cba3403bb56ba6f0c4ae06f8532e11afde7e0a77' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/loket_finansial.htm',
      1 => 1474347231,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95550648057e0c85d555a93_48497382',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57e0c85d559e98_49540959',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57e0c85d559e98_49540959')) {
function content_57e0c85d559e98_49540959 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '95550648057e0c85d555a93_48497382';
?>
<link href="custom/daterange/css/daterangepicker.css" media="all" rel="stylesheet" type="text/css" />
<?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="custom/sweetalert/dist/sweetalert.css">
<!-- Modal -->
<div class="content" id="main_content">
    <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js">
    <?php echo '</script'; ?>
>
    <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet">
    <!-- Page Heading Start -->
    <div class="page-heading">
        <h1>
            <i class="fa fa-wrench">
            </i>
            Multi Loket
         </h1>
    </div>
    <!-- Page Heading End-->
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header ">
                    <h2>
					Finansial Loket
                  </h2>
                    <div class="additional-btn">
                        <a class="widget-toggle" href="#">
                            <i class="icon-down-open-2">
                        </i>
                        </a>
                    </div>
                </div>
                <br>
                <div class="widget-content padding">
                    <div class="row">
                        <div class="col-sm-6">
                            <table width="100%" border="1" cellspacing="0" cellpadding="3">
								  <tr>
									<td width="2%" align="center" bgcolor="#CCCCCC"><strong>#</strong></td>
									<td width="27%" align="center" bgcolor="#CCCCCC"><strong>Tgl</strong></td>
									<td width="40%" align="center" bgcolor="#CCCCCC"><strong>Keterangan</strong></td>
									<td width="11%" align="right" bgcolor="#CCCCCC"><strong>Debet</strong></td>
									<td width="10%" align="right" bgcolor="#CCCCCC"><strong>Kredit</strong></td>
									<td width="10%" align="right" bgcolor="#CCCCCC"><strong>Saldo</strong></td>
								  </tr>
									<tr>
									<td align="center">1</td>
									<td align="center">2016-09-13 21:03:22</td>
									<td>XL25 >> 08179009112</td>
									<td align="right">25.100</td>
									<td align="right">0</td>
									<td align="right">55.979</td>
								  </tr>
										<tr>
									<td align="center">2</td>
									<td align="center">2016-08-25 17:10:52</td>
									<td>TELKOMSEL25 >> 082338680999</td>
									<td align="right">24.500</td>
									<td align="right">0</td>
									<td align="right">81.079</td>
								  </tr>
										<tr>
									<td align="center">3</td>
									<td align="center">2016-08-25 17:09:13</td>
									<td>Transfer Saldo Dari Admin ke albe3118</td>
									<td align="right">0</td>
									<td align="right">105.579</td>
									<td align="right">105.579</td>
								  </tr>
								</table>

                        </div>
                    </div>
                </div>
                </br>
            </div>
        </div>
    </div>
    </link>
</div>
<?php echo '<script'; ?>
 src="custom/daterange/js/moment.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/daterange/js/daterangepicker.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php }
}
?>