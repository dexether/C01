<?php /* Smarty version 3.1.27, created on 2016-09-15 06:11:18
         compiled from "/var/www/cabinet-stable/web2/templates/imp_comm_report.htm" */ ?>
<?php
/*%%SmartyHeaderCode:156464508457d9d91614ee86_60625654%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b9ecf7e9b239202e8a5213fa57af3c160820e760' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/imp_comm_report.htm',
      1 => 1473887587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '156464508457d9d91614ee86_60625654',
  'variables' => 
  array (
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57d9d916159749_06485296',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57d9d916159749_06485296')) {
function content_57d9d916159749_06485296 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '156464508457d9d91614ee86_60625654';
?>
<!-- Include Required Prerequisites -->
<!-- <?php echo '<script'; ?>
 src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<link href="assets/css/style.css" rel="stylesheet"/>
<!-- Include Date Range Picker -->
<?php echo '<script'; ?>
 src="custom/daterange/js/moment.min.js" type="text/javascript">
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/daterange/js/daterangepicker.js" type="text/javascript">
<?php echo '</script'; ?>
>
<link href="custom/daterange/css/daterangepicker.css" rel="stylesheet" type="text/css"/>
<div class="content" id="main_content">
    <div class="page-heading">
        <h1>
            <i class="icon-vcard">
            </i>
            Commision Report
        </h1>
    </div>
    <div class="row">
        <div class="col-md-12 portlets">
            <div class="widget">
                <div class="widget-header ">
                    <h2>
                        <strong>
                            Commision
                        </strong>
                        Generator
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
                   <p><strong>NOTE :</strong> if you check the "Replace Existing Data" the commision data on that priode will be replaced by new data</p>
                </div>
                    <form class="form-inline " id="ajax-form" role="form">
                        <div class="form-group">
                            <input name="replace" type="checkbox"/>
                            Replace Existing data
                        </div>
                        <div class="form-group">
                            <div class="dropdown" id="period">
                            </div>
                        </div>
                        <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"/>
                        <button class="btn btn-success" type="button">
                            Submit
                        </button>
                        <br/>
                        <br/>
                        <!-- <div class="form-group"> -->
                        <div class="progress no-rounded progress-striped active">
                            <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" class="progress-bar progress-bar-success" role="progressbar" style="width: 0%">
                            </div>
                        </div>
                        <span class="help-block">
                        </span>
                        <ul id="progress-msg">
                        </ul>
                        <!-- </div> -->
                        <?php echo '<script'; ?>
 src="custom/js/imp_detailed_commison.js" type="text/javascript">
                        <?php echo '</script'; ?>
>
                        <?php echo '<script'; ?>
 type="text/javascript">
                            jQuery(document).ready(function($) {
                           imp_comm_JS.init();
                           $('button[type=button]').click(function(event) {
                           imp_comm_JS.generate(this);
                           });
                        });
                        <?php echo '</script'; ?>
>
                        <?php echo '<script'; ?>
 type="text/javascript">
                            var s = document.createElement("select");
                        s.id = 'periode';
                        s.name = 'periode';
                        s.className = 'form-control';
                        var p = document.createElement("option");
                        p.value = "periode";
                        p.textContent = "Periode";
                        s.appendChild(p);
                        var m;
                        var mo;




                        function label(months) {
                           switch (months) {
                              case 1:
                              mo = "Januari";
                              break;
                              case 2:
                              mo = "Februari";
                              break;
                              case 3:
                              mo = "Maret";
                              break;
                              case 4:
                              mo = "April";
                              break;
                              case 5:
                              mo = "Mei";
                              break;
                              case 6:
                              mo = "Juni";
                              break;
                              case 7:
                              mo = "Juli";
                              break;
                              case 8:
                              mo = "Agustus";
                              break;
                              case 9:
                              mo = "September";
                              break;
                              case 10:
                              mo = "Oktober";
                              break;
                              case 11:
                              mo = "November";
                              break;
                              case 12:
                              mo = "Desember";
                              break;
                           }
                           return mo;
                        }

                        for(var i = 1; i < moment().format('M'); i++){
                           m = moment().format('M') - i;
                           var t = document.createElement("option");
                           t.value = moment().subtract(m,'month').startOf('month').format('YYYY-MM-DD') + " - " + moment().subtract(m,'month').endOf('month').format('YYYY-MM-DD');
                           t.textContent = label(i);
                           s.appendChild(t);
                        }
                        
                        document.getElementById('period').appendChild(s);
                        <?php echo '</script'; ?>
>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }
}
?>