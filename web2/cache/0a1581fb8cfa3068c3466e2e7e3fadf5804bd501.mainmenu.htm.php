<?php
/*%%SmartyHeaderCode:15596578600d9346b62_25095855%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a1581fb8cfa3068c3466e2e7e3fadf5804bd501' => 
    array (
      0 => 'D:\\web-dir\\cabinet\\web2\\templates\\mainmenu.htm',
      1 => 1466148025,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15596578600d9346b62_25095855',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'companys' => 0,
    'pagenya' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578600decb97e1_34461451',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578600decb97e1_34461451')) {
function content_578600decb97e1_34461451 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>The Cabinet Systems</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="description" content="">
    <meta name="keywords" content="SiCoId Cabinet Management System">
    <meta name="author" content="SiCoId Cabinet Management System">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    
    <!-- Base Css Files -->
    <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css"
    rel="stylesheet" />
    <link href="assets/libs/bootstrap/css/bootstrap.min.css"
    rel="stylesheet" />
    <link href="assets/libs/font-awesome/css/font-awesome.min.css"
    rel="stylesheet" />
    <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
    <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
    <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
    <link href="assets/libs/magnific-popup/magnific-popup.css"
    rel="stylesheet" />
    <link href="assets/libs/pace/pace.css" rel="stylesheet" />
    <link href="assets/libs/sortable/sortable-theme-bootstrap.css"
    rel="stylesheet" />
    <link href="assets/libs/bootstrap-datepicker/css/datepicker.css"
    rel="stylesheet" />
    <link href="custom/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- <script src="custom/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script> -->
    <!-- <link href="assets/libs/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" /> -->
    <!-- Code Highlighter for Demo -->
    <link href="assets/libs/prettify/github.css" rel="stylesheet" />
    <!-- Extra CSS Libraries Start -->
    <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
    <!-- Extra CSS Libraries End -->
    <link href="assets/css/style-responsive.css" rel="stylesheet" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                                        <!--[if lt IE 9]>
                                        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                                        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
                                        <![endif]-->
                                        <link rel="shortcut icon" href="templates/home_03/faicon.png">
                                        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
                                        <link rel="apple-touch-icon" sizes="57x57"
                                        href="assets/img/apple-touch-icon-57x57.png" />
                                        <link rel="apple-touch-icon" sizes="72x72"
                                        href="assets/img/apple-touch-icon-72x72.png" />
                                        <link rel="apple-touch-icon" sizes="76x76"
                                        href="assets/img/apple-touch-icon-76x76.png" />
                                        <link rel="apple-touch-icon" sizes="114x114"
                                        href="assets/img/apple-touch-icon-114x114.png" />
                                        <link rel="apple-touch-icon" sizes="120x120"
                                        href="assets/img/apple-touch-icon-120x120.png" />
                                        <link rel="apple-touch-icon" sizes="144x144"
                                        href="assets/img/apple-touch-icon-144x144.png" />
                                        <link rel="apple-touch-icon" sizes="152x152"
                                        href="assets/img/apple-touch-icon-152x152.png" />
                                        <link rel="stylesheet" href="custom/css/custom.css">
                                        <script src="custom/accounting/accounting.js"></script>
                                        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                                        <script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
                                        <script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
                                        <script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
                                        <script src="assets/libs/fastclick/fastclick.js"></script>

                                        
                                    </head>
                                    <body class="fixed-left">
                                        <!-- start: MODAL -->
                                        
<!-- Modal Start -->
<!-- Modal Task Progress -->
<div class="md-modal md-3d-flip-vertical" id="task-progress">
	<div class="md-content">
		<h3>
			<strong>Task Progress</strong> Information
		</h3>
		<div>
			<p>CLEANING BUGS</p>
			<div class="progress progress-xs for-modal">
				<div class="progress-bar progress-bar-success" role="progressbar"
					aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
					style="width: 80%">
					<span class="sr-only">80&#37; Complete</span>
				</div>
			</div>
			<p>POSTING SOME STUFF</p>
			<div class="progress progress-xs for-modal">
				<div class="progress-bar progress-bar-warning" role="progressbar"
					aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
					style="width: 65%">
					<span class="sr-only">65&#37; Complete</span>
				</div>
			</div>
			<p>BACKUP DATA FROM SERVER</p>
			<div class="progress progress-xs for-modal">
				<div class="progress-bar progress-bar-info" role="progressbar"
					aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
					style="width: 95%">
					<span class="sr-only">95&#37; Complete</span>
				</div>
			</div>
			<p>RE-DESIGNING WEB APPLICATION</p>
			<div class="progress progress-xs for-modal">
				<div class="progress-bar progress-bar-primary" role="progressbar"
					aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
					style="width: 100%">
					<span class="sr-only">100&#37; Complete</span>
				</div>
			</div>
			<p class="text-center">
				<button class="btn btn-danger btn-sm md-close">Close</button>
			</p>
		</div>
	</div>
</div>

<!-- Modal Logout -->
<div class="md-modal md-just-me" id="logout-modal">
	<div class="md-content">
		<h3>
			<strong>Logout</strong> Confirmation
		</h3>
		<div>
			<p class="text-center">Do you really want to Log Out ?</p>
			<p class="text-center">
				<button class="btn btn-danger md-close">No!</button>
				<a href="logout.php" class="btn btn-success md-close">Yes, I am sure</a>
			</p>
		</div>
	</div>
</div>
<!-- Modal End -->

                                        
                                        <!-- end: MODAL -->
                                        <!-- Begin page -->
                                        <div id="wrapper">
                                            <!-- Left Sidebar Start -->
                                            
<script language="javascript">
    var doubleclick = '1';
    function cek_active(thenewid)
    {
        //alert("LeftSide-6:"+thenewid);        
        var pengactive = document.getElementById('pengactive');
        var pengactivevalue = pengactive.value;
        // alert("LeftSide-9:"+pengactivevalue);    
        var yangmati = document.getElementById(pengactivevalue);
        // alert("LeftSide-11-Mati:"+yangmati);  
        yangmati.className = yangmati.className - " active";
        // alert("LeftSide-13:"+ yangmati.className);
        pengactive.value = thenewid;
        var yangactive = document.getElementById(thenewid);
        //alert("LeftSide-16:"+yangactive);
        yangactive.className = yangactive.className + " active";
    }
</script>

<!-- Left Sidebar Start -->
<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <!--- Profile -->
        <div class="profile-info">
            <div class="col-xs-4">
                <a href="profile.php" class="rounded-image profile-image mm_menuitem">
                              
                    <img src="images/users/user-100.jpg">          
                     
                </a>
            </div>
            <div class="col-xs-8">
                <div class="profile-text">Welcome <b> </b></div>
                <div class="profile-buttons">                    
                    <a href="#connect" class="open-right"><i class="fa fa-envelope-o pulse"></i></a>
                    <a href="#feed" class="open-right"><i class="icon-rss-2"></i></a>
                    <a href="#settings" class="open-right"><i class="icon-wrench"></i></a>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!--- Divider -->
		
		 <div id="sidebar-menu">
			
		<ul class='list-unstyled' id='updates-list'>
			<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-list"></i>Home<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
				<ul class='list-unstyled' id='updates-list'>
					<li class='has_sub'><a href="home_03.php" onclick=cek_active("home_03") class="mm_menuitem"  id="home_03"><i class=""></i>Dashboard</a></li>
					<li class='has_sub'><a href="trade_investigationform.php" onclick=cek_active("trade_investigationform") class="mm_menuitem"  id="trade_investigationform"><i class=""></i>Trade Investigation Form</a></li>
				</ul>
			</li>
			<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-asterisk"></i>Brokers<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
				<ul class='list-unstyled' id='updates-list'>
					<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-asterisk"></i>Imperium<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
						<ul class='list-unstyled' id='updates-list'>
							<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class=""></i>Administrator<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
								<ul class='list-unstyled' id='updates-list'>
									<li class='has_sub'><a href="imp_upline_change.php" onclick=cek_active("imp_upline_change") class="mm_menuitem"  id="imp_upline_change"><i class=""></i>Upline Changer</a></li>
									<li class='has_sub'><a href="imp_agent.php" onclick=cek_active("imp_agent") class="mm_menuitem"  id="imp_agent"><i class=""></i>Agent Register</a></li>
									<li class='has_sub'><a href="imp_connect.php" onclick=cek_active("imp_connect") class="mm_menuitem"  id="imp_connect"><i class=""></i>Account Syhncronise</a></li>
									<li class='has_sub'><a href="imp_account_mm.php" onclick=cek_active("imp_account_mm") class="mm_menuitem"  id="imp_account_mm"><i class=""></i>Account Management</a></li>
									<li class='has_sub'><a href="imp_comm_report.php" onclick=cek_active("imp_comm_report") class="mm_menuitem"  id="imp_comm_report"><i class=""></i>Commision Generator</a></li>
									<li class='has_sub'><a href="imp_manage_schema.php" onclick=cek_active("imp_manage_schema") class="mm_menuitem"  id="imp_manage_schema"><i class=""></i>Manage Schema</a></li>
									<li class='has_sub'><a href="imp_detailed_report.php" onclick=cek_active("imp_detailed_report") class="mm_menuitem"  id="imp_detailed_report"><i class=""></i>Detailed Comm. Report</a></li>
								</ul>
							</li>
							<li class='has_sub'><a href="imp_myaccount.php" onclick=cek_active("imp_myaccount") class="mm_menuitem"  id="imp_myaccount"><i class=""></i>My Account</a></li>
							<li class='has_sub'><a href="imp_registration.php" onclick=cek_active("imp_registration") class="mm_menuitem"  id="imp_registration"><i class=""></i>Imperium Registration</a></li>
							<li class='has_sub'><a href="imp_treeview.php" onclick=cek_active("imp_treeview") class="mm_menuitem"  id="imp_treeview"><i class=""></i>Treeview</a></li>
							<li class='has_sub'><a href="menu_openlive.php" onclick=cek_active("menu_openlive") class="mm_menuitem"  id="menu_openlive"><i class=""></i>Open Live Account</a></li>
							<li class='has_sub'><a href="imp_client_comm.php" onclick=cek_active("imp_client_comm") class="mm_menuitem"  id="imp_client_comm"><i class=""></i>Commision report</a></li>
							<li class='has_sub'><a href="kliring_day_end.php" onclick=cek_active("kliring_day_end") class="mm_menuitem"  id="kliring_day_end"><i class=""></i>Kliring Day End</a></li>
							<li class='has_sub'><a href="fx_report.php" onclick=cek_active("fx_report") class="mm_menuitem"  id="fx_report"><i class=""></i>Forex Report</a></li>
						</ul>
					</li>
					<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-asterisk"></i>Two Forex<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
						<ul class='list-unstyled' id='updates-list'>
							<li class='has_sub'><a href="two_webtrader.php" onclick=cek_active("two_webtrader") class="mm_menuitem"  id="two_webtrader"><i class=""></i>Web Trader</a></li>
							<li class='has_sub'><a href="menu_openlive_two.php" onclick=cek_active("menu_openlive_two") class="mm_menuitem"  id="menu_openlive_two"><i class=""></i>Open Live Account</a></li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		</div>
		
        <div id="sidebar-menu">        
            <ul class="list-unstyled" id="updates-list">
                <input type="hidden" id="pengactive" value="dashboard1">
                                <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='icon-home-3'></i><span>Programmer Menu</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='checklicense.php?value=onlyprogrammer' class='mm_menuitem' id="checklicense" onclick="cek_active('checklicense');" >
                                <i class='icons icon-award-empty'></i><span>Update License</span>
                            </a>
                        </li>
                        <li><a href='../backoffice/cronjob/backprocess.php?getsend=yes&getsend=yes' class='mm_menuitem' id="backprocess" onclick="cek_active('backprocess');" >
                                <i class='icons icon-target-1'></i><span>Cronjob</span>
                            </a>
                        </li>
                        <li><a href='http://cabinet.si.co.id:86/login.php' target="_blank"  id="backprocessold"  >
                                <i class='icons icon-keyboard'></i><span>BackOffice</span>
                            </a>
                        </li>
                        <li><a href='underconstruct.php' class='mm_menuitem' id="underconstruct" onclick="cek_active('underconstruct');" >
                                <i class='fa fa-file-o'></i><span>Underconstruct Not Secure</span>
                            </a>
                        </li>
                        <li><a href='underconstruct_secure.php' class='mm_menuitem' id="underconstruct_secure" onclick="cek_active('underconstruct_secure');" >
                                <i class='fa fa-file-text'></i><span>Underconstruct Secure</span>
                            </a>
                        </li>    
                        <li><a href='mql5_146316.php'  onclick="cek_active('mql5_146316');" class='mm_menuitem'  id="mql5_146316"><i class="fa fa-money"></i><span>MQL5 146316</span></a></li>
					</ul>
                </li>
                
                <!--                 <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='icon-address-book'></i><span>Admin</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                                                <li><a href='logip2.php' class='mm_menuitem' id="logip2.php" onclick="cek_active('logip2.php');" >
                                <i class='icons icon-user'></i><span>Log IP Maxwell Demo</span>
                            </a>
                        </li>
                                                <li><a href='logip1.php' class='mm_menuitem' id="logip1.php" onclick="cek_active('logip1.php');" >
                                <i class='icons icon-user'></i><span>Log IP Maxwell Real</span>
                            </a>
                        </li>
                                                <li><a href='logip4.php' class='mm_menuitem' id="logip4.php" onclick="cek_active('logip4.php');" >
                                <i class='icons icon-user'></i><span>Log IP Trado Demo</span>
                            </a>
                        </li>
                                                <li><a href='logip3.php' class='mm_menuitem' id="logip3.php" onclick="cek_active('logip3.php');" >
                                <i class='icons icon-user'></i><span>Log IP Trado Real</span>
                            </a>
                        </li>
                                                <li><a href='logip.php'  onclick="cek_active('logip');" class='mm_menuitem'  id="logip"><i class="fa fa-money"></i><span>Log IP Cabinet</span></a></li>                   
                        <li><a href='acckota.php' class='mm_menuitem' id="acckota" onclick="cek_active('acckota');" >
                                <i class='icons icon-user'></i><span>Acc Kota</span>
                            </a>
                        </li>
                        <li><a href='report_summary_client.php'  onclick="cek_active('report_summary_client');"  class='mm_menuitem' id="report_summary_client" ><i class=' icon-arrows-cw'></i><span  >Today Summary</span></a></li>            
                        <li><a href='report_summary_client_daily.php'  onclick="cek_active('report_summary_client_daily');" class='mm_menuitem'  id="report_summary_client_daily"><i class="icon-ccw-1"></i><span>Daily Summary</span></a></li>
                        <li><a href='report_turnover_running.php'  onclick="cek_active('report_turnover_running');" class='mm_menuitem'  id="report_turnover_running"><i class="icon-folder-open"></i><span>Report Turnover Equity</span></a></li>
                        <li><a href='report_equity.php'  onclick="cek_active('report_equity');" class='mm_menuitem'  id="report_equity"><i class=" icon-doc-circled"></i><span>Report NTR Summary</span></a></li>
                        <li><a href='ntr_update.php'  onclick="cek_active('ntr_update');" class='mm_menuitem'  id="ntr_update"><i class=" icon-doc-circled"></i><span>NTR Update</span></a></li>
                        <li><a href='mt4_weekly_initial.php'  onclick="cek_active('mt4_weekly_initial');" class='mm_menuitem'  id="mt4_weekly_initial"><i class=" icon-doc-circled"></i><span>MT4 Weekly Initial</span></a></li>
                    </ul>
                </li>
                 -->

               <!--  <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='glyphicon glyphicon-list'></i><span>Home</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='dashboard1.php'  onclick="cek_active('dashboard1');"  class='mm_menuitem' id="dashboard1" ><i class='icon-star'></i><span  >Dashboard</span></a></li>                                   
                        <li><a href='Trade_Investigationform.php'  onclick="cek_active('Trade_Investigationform');" class='mm_menuitem'  id="Trade_Investigationform"><i class="icon icon-exclamation"></i><span>Trade Investigation Form</span></a></li>

                    </ul>
                </li> -->


               <!--  <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa fa-money'></i><span>Program Wallet</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='deposit.php'  onclick="cek_active('deposit');" class='mm_menuitem'  id="deposit"><i class="icon icon-paper-plane-1"></i><span>Deposit Fund</span></a></li>
                        <li><a href='withdrawal.php'  onclick="cek_active('withdrawal');" class='mm_menuitem'  id="withdrawal"><i class="icon icon-database"></i><span>Withdrawal Fund</span></a></li>
                        <li><a href='transfer_funds.php'  onclick="cek_active('transfer_funds');" class='mm_menuitem'  id="transfer_funds"><i class="icon icon-export-1"></i><span>Transfer Fund</span></a></li>
                        <li><a href='withdrawal_detail.php'  onclick="cek_active('withdrawal_detail');" class='mm_menuitem'  id="withdrawal_detail"><i class="icon icon-folder-1"></i><span>Withdrawal Details</span></a></li>
                        <li><a href='transaction_histori.php'  onclick="cek_active('transaction_histori.php');" class='mm_menuitem'  id="transaction_histori.php"><i class="icon icon-data-science-inv"></i><span>Transaction History</span></a></li>
                        <li><a href='investigation_wallet.php'  onclick="cek_active('investigation_wallet');" class='mm_menuitem'  id="investigation_wallet"><i class="icon icon-desktop-circled"></i><span>Investigation Wallet</span></a></li>
                    </ul>
                </li> -->

               <!-- <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='glyphicon glyphicon-bullhorn'></i><span>Program Education</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='investigation_education.php'  onclick="cek_active('investigation_education');" class='mm_menuitem'  id="investigation_education"><i class="icon icon-desktop-circled"></i><span>Investigation Education</span></a></li>
                        <li><a href='edu_member_list.php'  onclick="cek_active('edu_member_list');" class='mm_menuitem'  id="edu_member_list"><i class="icon icon-desktop-circled"></i><span>Edu Member List</span></a></li>
                        <li><a href='edu_registration.php'  onclick="cek_active('edu_registration');" class='mm_menuitem'  id="edu_registration"><i class="icon icon-desktop-circled"></i><span>Edu Registration</span></a></li>
                        <li><a href='edu_robot_trading.php'  onclick="cek_active('edu_robot_trading');" class='mm_menuitem'  id="edu_robot_trading"><i class="icon icon-desktop-circled"></i><span>Edu Robot Trading</span></a></li>
                        <li><a href='education.php'  onclick="cek_active('education');" class='mm_menuitem'  id="education"><i class="icon icon-desktop-circled"></i><span>Education</span></a></li>
                        <li><a href='download.php'  onclick="cek_active('download');" class='mm_menuitem'  id="download"><i class="icon icon-inbox"></i><span>Download</span></a></li>
                        <li><a href='requestvps.php'  onclick="cek_active('requestvps');" class='mm_menuitem'  id="requestvps"><i class="icon icon-desktop-circled"></i><span>Request a VPS</span></a></li>
                    </ul>
                </li> -->

                <!-- <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa  fa-ticket'></i><span>Program MLM</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>                     
                        <li><a href='mlm_registration.php'  onclick="cek_active('mlm_registration');" class='mm_menuitem'  id="mlm_registration"><i class="icon icon-list-add"></i><span>MLM Registration</span></a></li>  
                        <li><a href='treview.php'  onclick="cek_active('treview');" class='mm_menuitem'  id="treview"><i class="icon icon-list-add"></i><span>MLM Tree View</span></a></li>  
                        <li><a href='investigation_mlm.php'  onclick="cek_active('investigation_mlm');" class='mm_menuitem'  id="investigation_mlm"><i class="icon icon-desktop-circled"></i><span>Investigation MLM</span></a></li>

                    </ul>
                </li> -->

              <!--  <li class='has_sub'>
                    <a href='javascript:void(0);'>
                        <i class='fa fa-usd'></i><span>Program Trado</span> 
                        <span class="pull-right"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li><a href='marketing_plan.php?broker=trado'  onclick="cek_active('marketing_plan');" class='mm_menuitem'  id="marketing_plan"><i class="icon  icon-tag-2"></i><span>Marketing Plan</span></a></li>
                        <li><a href='registration.php?broker=trado'  onclick="cek_active('registration');" class='mm_menuitem'  id="registration"><i class="icon icon-list-add"></i><span>Registration</span></a></li>
                        <li><a href='account_list.php?broker=trado'  onclick="cek_active('account_list');" class='mm_menuitem'  id="member_list"><i class="icon  icon-login-1"></i><span>Account List</span></a></li>                       
                        <li><a href='underconstruct.php?broker=trado'  onclick="cek_active('report03');" class='mm_menuitem'  id="report03"><i class="icon icon-attach"></i><span>Order Report</span></a></li>
                        <li><a href='live_account.php?broker=trado'  onclick="cek_active('live_account');" class='mm_menuitem'  id="live_account"><i class="icon icon-lightbulb-alt"></i><span>Open A new Live Account</span></a></li>
                        <li><a href='demo_account.php?broker=trado'  onclick="cek_active('demo_account');" class='mm_menuitem'  id="demo_account"><i class="icon icon-lightbulb"></i><span>Open A new Demo Account</span></a></li>
                        <li><a href='platform_credentials.php?broker=trado'  onclick="cek_active('platform_credentials');" class='mm_menuitem'  id="platform_credentials"><i class="icon icon-check"></i><span>Platform Credentials</span></a></li>
                        <li><a href='change_leverage.php?broker=trado'  onclick="cek_active('change_leverage');" class='mm_menuitem'  id="change_leverage"><i class="icon icon-cogs"></i><span>Change Leverage</span></a></li>						
                        <li><a href='change_account_password.php?broker=trado'  onclick="cek_active('change_account_password');" class='mm_menuitem'  id="change_account_password"><i class="icon icon-cog"></i><span>Change Account Password</span></a></li>
                        <li><a href='investigation_trado.php?broker=trado'  onclick="cek_active('investigation_trado');" class='mm_menuitem'  id="investigation_trado"><i class="icon icon-desktop-circled"></i><span>Investigation Trado</span></a></li>
                    </ul>
                </li> -->
				
				
				<!-- <li class='has_sub'>
					<a href='javascript:void(0);'>
					<i class='fa fa-desktop'></i><span>BackOffice</span>
					<span class="pull-right"><i class="fa fa-angle-down"></i></span>
					</a>
					<ul>
						<li class='has_sub'>
							<a href='javascript:void(0);'>
							<i class='fa fa-keyboard-o'></i><span>Admin</span>
							<span class="pull-right"><i class="fa fa-angle-down"></i></span>
							</a>
							<ul>
								<li>
									<a href='group_account.php' onclick="cek_active('group_account');" class='mm_menuitem' id="group_account"><i class="icon icon-list-add"></i><span> Groups Account</span></a>
								</li>
							</ul>
						</li>
					</ul>
				</li> -->

    <!-- <li class='has_sub'>
	<a href='javascript:void(0);'>
		<i class='glyphicon glyphicon-asterisk'></i><span> Apex Regent</span>
		<span class="pull-right"><i class="fa fa-angle-down"></i></span>
	</a>
	<ul>
		<li class='has_sub'>
			<a href='javascript:void(0);'>
				<i class='fa fa-keyboard-o'></i><span>Admin</span>
				<span class="pull-right"><i class="fa fa-angle-down"></i></span>
			</a>
			<ul>
				<li>
					<a href='ar_admin_payment.php' onclick="cek_active('ar_admin_payment');" class='mm_menuitem' id="ar_admin_payment"><i class="icon icon-list-add"></i><span> Payment</span></a>
				</li>
				<li>
					<a href='ar_admin_cron.php' onclick="cek_active('ar_admin_cron');" class='mm_menuitem' id="ar_admin_cron"><i class="icon icon-list-add"></i><span> Cronjob Management</span></a>
				</li>
			</ul>
		</li>
		<li>
			<a href='ar_registration.php' onclick="cek_active('ar_registration');" class='mm_menuitem' id="ar_registration"><i class="glyphicon glyphicon-saved"></i><span> Registration</span></a>
		</li>
		<li>
			<a href='ar_marketing_plan.php' onclick="cek_active('ar_marketing_plan');" class='mm_menuitem' id="ar_marketing_plan"><i class="glyphicon glyphicon-globe"></i><span> Marketing Plan</span></a>
		</li>
		<li>
			<a href='ar_member_list.php' onclick="cek_active('ar_member_list');" class='mm_menuitem' id="ar_member_list"><i class="glyphicon glyphicon-tasks"></i><span> Member List</span></a>
		</li>
		<li>
			<a href='ar_exchange_rate.php' onclick="cek_active('ar_exchange_rate');" class='mm_menuitem' id="ar_exchange_rate"><i class="fa fa-stack-exchange"></i><span> Exchange Rate</span></a>
		</li>
		<li class='has_sub'>
			<a href='javascript:void(0);'>
				<i class='glyphicon glyphicon-transfer'></i><span> Gold Saving</span>
				<span class="pull-right"><i class="fa fa-angle-down"></i></span>
			</a>
			<ul>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure');" class='mm_menuitem'  id="underconstruct_secure"><i class="icon icon-paper-plane-1"></i><span>Deposit Fund</span></a>
				</li>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure');" class='mm_menuitem'  id="underconstruct_secure"><i class="icon icon-database"></i><span>Withdrawal Fund</span></a>
				</li>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure');" class='mm_menuitem'  id="underconstruct_secure"><i class="icon icon-export-1"></i><span>Transfer Fund</span></a>
				</li>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure');" class='mm_menuitem'  id="underconstruct_secure"><i class="icon icon-folder-1"></i><span>Withdrawal Details</span></a>
				</li>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure.php');" class='mm_menuitem'  id="underconstruct_secure.php"><i class="icon icon-data-science-inv"></i><span>Transaction History</span></a>
				</li>
				<li>
					<a href='underconstruct_secure.php'  onclick="cek_active('underconstruct_secure');" class='mm_menuitem'  id="underconstruct_secure"><i class="icon icon-desktop-circled"></i><span>Investigation Wallet</span></a>
				</li>
			</ul>
		</li>
		<li class='has_sub'>
			<a href='javascript:void(0);'>
				<i class='fa fa-money'></i><span> Payment Center</span>
				<span class="pull-right"><i class="fa fa-angle-down"></i></span>
			</a>
			<ul>
				<li>
					<a href='ar_payment.php' onclick="cek_active('ar_payment');" class='mm_menuitem' id="ar_payment"><i class="fa fa-check-circle-o"></i><span> Payment Confirmation</span></a>
				</li>
			</ul>
		</li>
	</ul>
</li> -->
				
						<!-- <li class='has_sub'>
							<a href='javascript:void(0);'>
								<i class='fa fa-money'></i><span> Copy Trade</span>
								<span class="pull-right"><i class="fa fa-angle-down"></i></span>
							</a>
							<ul>
								<li>
									<a href='copy_trade.php' onclick="cek_active('copy_trade');" class='mm_menuitem' id="copy_trade"><i class="fa fa-check-circle-o"></i><span> Coffe Trade</span></a>
									<a href='coco.php' onclick="cek_active('coco');" class='mm_menuitem' id="coco"><i class="fa fa-check-circle-o"></i><span>Test</span></a>
								</li>
							</ul>
						</li> -->


                <div class="clearfix"></div>
        </div>


        <div class="clearfix"></div>
        <br> <br> <br>
    </div>

    <div class="left-footer">
        <div class="progress progress-xs">
            <div class="progress-bar bg-green-1" role="progressbar"
                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                 style="width: 80%">
                <span class="progress-precentage">80%</span>
            </div>

            <a data-toggle="tooltip" title="See task progress"
               class="btn btn-default md-trigger" data-modal="task-progress"><i
                    class="fa fa-inbox"></i></a>
        </div>
    </div>
</div>
<!-- Left Sidebar End -->
                                            <!-- Left Sidebar End -->
                                            <!-- start: TOPBAR -->
                                            
<script>
	setInterval(function() {
		autoloadpage();
	}, 30000); // it will call the function autoload() after each 30 seconds. 
	function autoloadpage() {
		$.ajax({
			url : "autoload.php",
			type : "POST",
			success : function(data) {
				//alert("AutoLoad:"+data); // here the wrapper is main div
				var arr = data.split(";");
				if (arr[0] == '1') {
					var title = arr[1];
					var keterangan = '';
					notifysuccess_autoload('success', 'top right', title,
							keterangan);
					setTimeout('history.go(0);', 10000);
				}
			}
		});
	}
</script>

<!-- Top Bar Start -->
<div class="topbar">
	<div class="topbar-left">
		<div class="logo">
			<h1>
				<a href="#"><img src="templates/home_03/logo.png" 
					alt="Logo"></a>
			</h1>
		</div>
		<button class="button-menu-mobile open-left">
			<i class="fa fa-bars"></i>
		</button>
	</div>
	<!-- Button mobile view to collapse sidebar menu -->
	<div class="navbar navbar-default" role="navigation">
		<div class="container">
			<div class="navbar-collapse2">
				<ul class="nav navbar-nav hidden-xs">

				</ul>
				<ul class="nav navbar-nav navbar-right top-navbar">
					<li class="language_bar dropdown hidden-xs"><a href="#"
						data-toggle="tooltip" data-placement="bottom" title=''>
							Login as THEPROGRAMMER </a></li>
					<li class="dropdown iconify hide-phone"><a href="#"
						onclick="javascript:toggle_fullscreen()"><i
							class="icon-resize-full-2"></i></a></li>
					<li class="dropdown topbar-profile"><a href="#"
						class="dropdown-toggle" data-toggle="dropdown"> <span
							class="rounded-image topbar-profile-image">
														<img src="images/logo/sicoid/sicoid_logo.png">
													</span> <i class="fa fa-caret-down"> </i>
					</a>
						<ul class="dropdown-menu">
							<li><a href="profile.php" class='mm_menuitem'>My Profile</a></li>
							<li><a href="user.php" class='mm_menuitem'>Change
									Password</a></li>

							<li class="divider"></li>
							<li><a href="help.php" class='mm_menuitem'><i
									class="icon-help-2"></i> Help</a></li>
							<li><a href="settings.php" class='mm_menuitem'><i
									class="icon-cog-3"></i> Settings</a></li>
							<li><a class="md-trigger" data-modal="logout-modal"><i
									class="icon-logout-1"></i> Logout</a></li>
						</ul></li>
					<li class="right-opener"><a href="javascript:;"
						class="open-right"><i class="fa fa-angle-double-left"></i><i
							class="fa fa-angle-double-right"></i></a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
</div>
<!-- Top Bar End -->

<script src="custom/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="assets/libs/bootstrap-inputmask/inputmask.js"></script>
<script src="assets/libs/summernote/summernote.js"></script>


<script src="assets/libs/jquery-notifyjs/notify.min.js"></script>
<script src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"></script>
<script src="custom/js/autoload_noty.js"></script>
                                            <!-- end: TOPBAR -->
                                            
                                            <div class="content-page">
                                                <!-- ============================================================== -->
                                                <!-- Start Content here -->
                                                <!-- ============================================================== -->
                                                <!-- CONTENT -->
                                                
                                                <link rel="stylesheet" href="custom/treview/css/easyTree.css">
<script src="custom/treview/src/easyTree.js"></script>
<div id="main_content" class="content">
    <div class="page-heading">
        <h1><i class="icon-user-3"></i>MLM Treview</h1>
    </div>
    <div class="row">
        <div class="col-md-12 portlets">
            <div class="widget">
                <div class="widget-header">
                    <h3 class="text-success">Downline</h3>
                    <div class="additional-btn">
                        <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                        <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                        <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div class="easy-tree" >
                            
                             <ul><li>COMPANY<ul><li>160712141 - Ade Widya<ul><li>1607121797 - Dedy Kurniawan<ul></ul></li><li>16071217135 - Freddy Hoo Han Wonokusumo<ul></ul></li><li>16071217190 - Jeffri<ul></ul></li><li>16071217246 - Ade Widiya<ul></ul></li><li>16071217320 - Sonny Indro Utomo<ul></ul></li></ul></li><li>160712142 - Alif Marsya<ul><li>16071217278 - Reza Pramudya<ul></ul></li><li>16071217355 - Alif Marsya<ul><li>1607130987 - DRS.Kurnia Tahki, M.PD<ul></ul></li><li>16071309118 - Riana<ul></ul></li></ul></li></ul></li><li>160712143 - Amin<ul><li>1607121736 - Ardiyanto Tedjo Baskoro<ul></ul></li></ul></li><li>160712144 - Asti<ul><li>1607121746 - Astiari Irianti<ul><li>1607130998 - Maulana Aji Wicaksono<ul></ul></li><li>16071309144 - Suhartini<ul></ul></li></ul></li></ul></li><li>160712145 - Betty<ul><li>1607121729 - Anies Listyowati<ul></ul></li><li>1607121754 - Betty Rachmawati<ul><li>1607130949 - Dwi Handayani<ul><li>16071309195 - Monika Widjaya<ul></ul></li><li>16071309217 - Maria Fransiska<ul></ul></li></ul></li><li>16071309124 - Riza Ruhlizar Anwar<ul></ul></li></ul></li><li>1607121755 - Betty Rachmawati<ul></ul></li><li>16071217128 - Ferlina Kirtiasih S.SOS<ul></ul></li><li>16071217139 - Betty Rachmawati<ul></ul></li><li>16071217153 - Henny Yunara Muslim<ul></ul></li><li>16071217227 - Aryanto<ul></ul></li><li>16071217236 - Ir. Budi Santoso<ul></ul></li><li>16071217349 - Andriani Soesilowati<ul><li>1607130913 - Annisa Maghfira<ul></ul></li><li>1607130927 - Basrizal.b<ul></ul></li><li>16071309107 - Khairunnisa Nirmala Devi<ul></ul></li></ul></li><li>16071217383 - Yohanes Andri<ul></ul></li></ul></li><li>160712146 - Chalrles<ul><li>16071217336 - Susanto<ul><li>1607130932 - Agus Cahyono<ul></ul></li></ul></li></ul></li><li>160712147 - Christian Manalu<ul><li>16071217299 - Rudy Hartono<ul></ul></li><li>16071217301 - Rusli<ul></ul></li><li>16071217348 - Carla Manalu<ul></ul></li></ul></li><li>160712148 - Danu Nurseha<ul><li>16071217113 - Enny Noviany<ul><li>1607130958 - Ferlina Kirtiasih S.SOS<ul><li>16071309193 - Muhammad Arief Herfia Yulianto<ul></ul></li><li>16071309200 - Indra Hendrawan M.SE<ul></ul></li><li>16071309201 - Irwan Firmansyah<ul><li>16071309260 - Maria Genita Dra<ul></ul></li></ul></li><li>16071309219 - Nungki Sumiati<ul></ul></li><li>16071309224 - Rachman Hakim<ul></ul></li><li>16071309236 - Sundari Bs<ul></ul></li><li>16071309238 - Drs.Syahroni<ul></ul></li></ul></li><li>16071309108 - Ernita Himawati<ul><li>16071309172 - B. Aloysia B Pakiding<ul></ul></li><li>16071309199 - Imanuel Tibian<ul></ul></li></ul></li><li>16071309132 - Wati Triningsih<ul></ul></li><li>16071309145 - IR Sunarsi Awaloedin<ul></ul></li><li>16071309160 - Muhammad Husni<ul></ul></li></ul></li></ul></li><li>160712149 - Dedy Yusuf<ul><li>1607121760 - Sutan Alamsaputra Ad<ul></ul></li></ul></li><li>1607121410 - Dewi Rosiana<ul><li>16071217132 - Freddy Hoo Han Wonokusumo<ul></ul></li><li>16071217247 - Nancy Oktavia Christiningrum<ul></ul></li></ul></li><li>1607121411 - Dholvy<ul><li>1607121784 - Deny Helmani<ul></ul></li><li>16071217124 - Luki Purwandari<ul><li>1607130914 - Mohamad Ardira Cahya<ul></ul></li><li>16071309136 - Siska Marthio<ul></ul></li></ul></li></ul></li><li>1607121412 - Dian Debora<ul><li>1607121792 - Dian Debora Manullang<ul></ul></li><li>16071217145 - Fendi<ul></ul></li><li>16071217158 - Heriyanto Kurniawan G<ul></ul></li><li>16071217325 - Steven Glen<ul></ul></li><li>16071217346 - Syafruddin<ul><li>1607130963 - Ny. Go Indrati<ul></ul></li><li>1607130979 - Joko Antono<ul><li>16071309180 - Boby<ul></ul></li><li>16071309214 - Nurdiyanto<ul></ul></li></ul></li><li>1607130981 - Ike Dewi Prasetyanti<ul></ul></li><li>16071309109 - Njoo Gwat Siang<ul></ul></li><li>16071309116 - Raissa Purnamasari Setiawan<ul><li>16071309233 - Tan Tjhing Hong<ul></ul></li></ul></li><li>16071309143 - Suhardi<ul></ul></li><li>16071309146 - Yustiani<ul></ul></li><li>16071309149 - Syafruddin<ul><li>16071309150 - Syafruddin<ul></ul></li></ul></li></ul></li><li>16071217359 - Tresia Lidjah<ul></ul></li><li>16071217375 - Yeni Windrastuti<ul></ul></li></ul></li><li>1607121413 - Edi Supriatna<ul><li>16071217151 - Hendri<ul></ul></li></ul></li><li>1607121414 - Edward Yonathan<ul><li>1607121748 - Agus Setiawan<ul></ul></li><li>1607121753 - Benyamin Patiung<ul></ul></li><li>1607121772 - Christine Natalia<ul></ul></li><li>1607121773 - Yung Lie<ul></ul></li><li>16071217102 - Imanuel David Suwu<ul></ul></li><li>16071217125 - Felia Yuliana<ul></ul></li><li>16071217156 - Henry Wijaya Susanto<ul></ul></li><li>16071217157 - Anik Haryanti<ul></ul></li><li>16071217161 - Hendro Prasetyo Masori<ul></ul></li><li>16071217207 - Kusuma Indra<ul></ul></li><li>16071217229 - Merry Christiani<ul></ul></li><li>16071217317 - Kenni Gho<ul></ul></li></ul></li><li>1607121415 - Elena Adelara<ul><li>16071217369 - Wahyu Yasa Sumantra<ul></ul></li></ul></li><li>1607121416 - Enny<ul><li>16071217257 - Enny Noviany<ul></ul></li><li>16071217331 - IR Sunarsi Awaloedin<ul></ul></li></ul></li><li>1607121417 - Ernest Raenald<ul><li>16071217116 - Ernest Raenald<ul><li>160713096 - Thong Sian Lan<ul></ul></li></ul></li></ul></li><li>1607121418 - Fajar Adrian<ul><li>16071217182 - Siti Homisah<ul></ul></li></ul></li><li>1607121419 - Feri Iskandar<ul><li>1607121766 - Charles Irwan Adhyatman<ul></ul></li><li>16071217163 - Howard Soeharjanto S<ul></ul></li><li>16071217177 - Imelda Nirwana Adji<ul></ul></li><li>16071217219 - Deden<ul></ul></li><li>16071217288 - Fauzi Kurniawan<ul></ul></li></ul></li><li>1607121420 - Fika<ul><li>16071217340 - Syafruddin<ul></ul></li></ul></li><li>1607121421 - Fikri<ul><li>16071217109 - Muhamad Fakih Nurul Huda<ul></ul></li><li>16071217214 - M. Nurbadruddin<ul><li>1607130961 - Fikri<ul></ul></li></ul></li></ul></li><li>1607121422 - Filhanuddin<ul><li>1607121740 - Arniaty Sinuraya<ul></ul></li><li>16071217111 - Elly Herawati<ul></ul></li><li>16071217184 - Ivan Nyoman Putra ,S.KOM<ul></ul></li><li>16071217220 - Deden<ul></ul></li><li>16071217252 - Nengsih Suhendro<ul><li>1607130921 - Age Septian Prahandoko<ul></ul></li><li>1607130924 - Parsaoran B Pardede, SH<ul></ul></li><li>1607130925 - Bambang Widodo<ul></ul></li><li>1607130931 - Bambang Widodo<ul><li>16071309247 - Yulita<ul></ul></li></ul></li><li>1607130933 - Monica Christantie<ul></ul></li><li>1607130994 - Marcel Trias<ul></ul></li><li>16071309103 - Monica Christantie<ul><li>16071309174 - Andrew Susanto<ul></ul></li><li>16071309186 - Erick Susanto<ul></ul></li><li>16071309203 - Ivan Nyoman Putra ,S.KOM<ul></ul></li></ul></li><li>16071309129 - Rudy Ruslan, SH. MBA<ul></ul></li><li>16071309148 - Dr Sulaeman Sutanto<ul></ul></li><li>16071309165 - Arnold Yudid Willianto, ST<ul><li>16071309177 - Angga Megatruh Eka M<ul><li>16071309274 - Lerry Partogi<ul></ul></li></ul></li></ul></li></ul></li><li>16071217297 - Rudy Ruslan, SH. MBA<ul></ul></li><li>16071217327 - Sugiharto Muchlis<ul></ul></li></ul></li><li>1607121423 - Fitri<ul><li>16071217238 - Mukesh Om Prakash Gupta<ul></ul></li></ul></li><li>1607121424 - Franky<ul><li>160712177 - Ade Nurmansyah<ul></ul></li><li>1607121735 - Antony<ul></ul></li><li>1607121762 - M Brigite Caroline E R W<ul></ul></li><li>16071217165 - Ridho Hutomo, ST, MM<ul></ul></li><li>16071217179 - Achmad Rivai<ul></ul></li><li>16071217242 - Ilham Zain<ul></ul></li><li>16071217276 - Rendy Augusta Wilopo<ul></ul></li><li>16071217284 - Rizki Kahuripan<ul></ul></li><li>16071217350 - Tantan Darul Taufik<ul></ul></li><li>16071217351 - Tanti Erayati K<ul></ul></li><li>16071217373 - Muhammad Lutfi Wicaksana<ul></ul></li></ul></li><li>1607121425 - Gideon<ul><li>16071217228 - Maria Christina Setyawati<ul></ul></li></ul></li><li>1607121426 - Haerunisa<ul><li>160712171 - A.Teguh Wibowo S.T<ul></ul></li><li>16071217123 - Fauzan Arya Dawami<ul></ul></li><li>16071217129 - Ferry Kurniawan<ul></ul></li><li>16071217194 - Muhajirin Isnain<ul></ul></li><li>16071217272 - H ABD RAHMAN<ul></ul></li></ul></li><li>1607121427 - Hartanto<ul><li>1607121717 - Agung Wiratmoko<ul></ul></li><li>16071217159 - Herman<ul></ul></li><li>16071217162 - Hotma Pandapotan Tambunan, SE<ul></ul></li><li>16071217171 - Indra Darmawan<ul></ul></li><li>16071217201 - Yuli Wigianti<ul></ul></li><li>16071217258 - R Nugroho Waskito<ul></ul></li><li>16071217290 - Robert Abintur Hutagaol<ul></ul></li><li>16071217322 - Sri Mukminin,SPD<ul><li>1607130945 - Bpk Dimas Suwarno<ul></ul></li><li>1607130973 - Ana Rosala Indah<ul><li>16071309175 - Eda Andri Hendrawan<ul></ul></li><li>16071309228 - Rina Susilawati, SS MA<ul><li>16071309265 - Minarti<ul></ul></li><li>16071309284 - Sumardi Mardiraharja<ul></ul></li></ul></li></ul></li><li>1607130983 - Djliteng Pamungkas<ul></ul></li><li>16071309100 - Milko Hutabarat<ul></ul></li><li>16071309131 - Aldy Fahreza<ul></ul></li></ul></li><li>16071217333 - Hartanto<ul><li>1607130948 - Dwi Sunu Nugroho Utomo<ul></ul></li><li>16071309113 - Taufik Herminarsa<ul></ul></li></ul></li></ul></li><li>1607121428 - Hary<ul><li>16071217305 - Tommy Putranto Oetomo<ul><li>160713097 - Alexander Butama<ul></ul></li><li>16071309102 - Soesilowati<ul><li>16071309222 - Bregas Soeryo Soeyogyo<ul></ul></li></ul></li><li>16071309112 - Riyono<ul></ul></li><li>16071309123 - Riza Dewi Permatasari<ul><li>16071309183 - Cahyo Hendro Margo Sayuto<ul></ul></li></ul></li></ul></li></ul></li><li>1607121429 - Henny Yunara<ul><li>16071217287 - RM Satrio Wibowo, DRS<ul></ul></li><li>16071217371 - Wasith Suady<ul></ul></li></ul></li><li>1607121430 - Imas<ul><li>16071217221 - Deden<ul></ul></li><li>16071217245 - Munggar Wintang Adi W<ul></ul></li><li>16071217338 - Sempu Willyanto<ul></ul></li></ul></li><li>1607121431 - Indra<ul><li>1607121750 - Bambang Irawan<ul></ul></li><li>1607121765 - Florencelo<ul></ul></li><li>1607121786 - Deorawesta Purba<ul></ul></li><li>16071217105 - Dwi Djijanarko<ul></ul></li><li>16071217112 - Ema Harisusanti<ul></ul></li><li>16071217222 - Maria Retno Umani<ul></ul></li><li>16071217303 - Setyo Anggraini<ul></ul></li><li>16071217309 - Sigid Noviarianto<ul></ul></li><li>16071217310 - Drs Hartoto<ul></ul></li><li>16071217321 - Sigit Purwadi<ul></ul></li><li>16071217353 - Tubagus Lasdita Wulandono<ul><li>1607130971 - Dego Hendrata<ul></ul></li></ul></li></ul></li><li>1607121432 - Irmanawati<ul><li>16071217186 - Iwan Tafrida<ul></ul></li><li>16071217262 - Budi Purnomo<ul></ul></li></ul></li><li>1607121433 - Jefry<ul><li>16071217191 - Jeffri<ul><li>160713091 - Wong Sunardy<ul><li>16071309208 - Victor Salim Kusumanegara<ul></ul></li><li>16071309240 - Bong Janha<ul><li>16071309254 - Tjong Tjay Fhung<ul><li>16071309286 - Budiarto Lukito<ul><li>16071309304 - Teguh Iman Suyatno<ul></ul></li></ul></li></ul></li></ul></li></ul></li></ul></li></ul></li><li>1607121434 - Jimmy Wijaya<ul><li>16071217122 - Fanny Oktavianty<ul></ul></li><li>16071217193 - Jimmy Wijaya<ul></ul></li><li>16071217304 - Maries Syafira<ul><li>160713099 - Andalan Utama Goenawan<ul></ul></li><li>1607130936 - Edgar flittner glenn rompis<ul></ul></li><li>1607130946 - Dedy Kurniawan<ul><li>16071309170 - Agustar Radjali<ul></ul></li><li>16071309211 - Lioe Eva Nuryani<ul></ul></li></ul></li><li>1607130969 - Hezty Hermawan<ul></ul></li><li>1607130977 - James Henry S<ul></ul></li><li>1607130986 - Kelly Yuzarly Sadeli<ul></ul></li><li>16071309120 - Risky Novriadi<ul></ul></li><li>16071309142 - Irma Subakti<ul></ul></li><li>16071309157 - Vivi Tendy<ul></ul></li></ul></li><li>16071217366 - Fitri Yanni<ul></ul></li><li>16071217379 - Yanti Selfiana<ul></ul></li></ul></li><li>1607121435 - Joshua<ul><li>1607121752 - Bebi wati<ul></ul></li><li>16071217316 - Posma Salomo Panggabean<ul><li>16071309155 - Dale Lumbantoruan<ul></ul></li></ul></li><li>16071217341 - Syafruddin<ul></ul></li></ul></li><li>1607121436 - Kartini<ul><li>1607121790 - Dewi Hartati<ul></ul></li><li>16071217239 - Kartini<ul><li>1607130940 - Rinto Cahyadi<ul></ul></li><li>1607130944 - Dewi Sirwinastuti<ul><li>16071309187 - Febrianisa Untariwati<ul></ul></li><li>16071309232 - M P Selvya H G<ul></ul></li></ul></li><li>1607130954 - Endang Riadi<ul><li>16071309167 - Adithia Wira Permadi<ul><li>16071309255 - Diska Ayela Dwi Octaviany<ul></ul></li><li>16071309266 - Masriah<ul></ul></li><li>16071309275 - Ghaniy Ageng<ul></ul></li><li>16071309279 - Donny Mauritz Hasiholan<ul></ul></li><li>16071309280 - Rina Metiane<ul></ul></li></ul></li><li>16071309168 - Agung Santosa<ul></ul></li><li>16071309173 - Noviyanto<ul></ul></li><li>16071309176 - L Andryanne Marliani Manurung<ul></ul></li><li>16071309182 - Budi Riyono<ul></ul></li><li>16071309185 - Eko Riyanto<ul></ul></li><li>16071309189 - Gunawan Wijaya<ul></ul></li><li>16071309205 - Jemmi Hasibuan, S. Kom<ul></ul></li><li>16071309207 - Koswandi<ul></ul></li><li>16071309209 - Leomansu H. Simanjuntak Ssi<ul></ul></li><li>16071309218 - Noviyanto<ul></ul></li><li>16071309225 - Purwiyanto Abadi<ul></ul></li><li>16071309243 - Totok Warsito<ul></ul></li></ul></li><li>1607130955 - Fauzan Karim<ul></ul></li><li>1607130967 - Nurhasan Bachtiar<ul></ul></li><li>1607130988 - Etty Christiana<ul></ul></li><li>1607130991 - Maymay Suriani<ul></ul></li><li>16071309104 - Naftalia<ul></ul></li><li>16071309130 - Samanta Widjaja<ul><li>16071309213 - Samanta Widjaja<ul></ul></li><li>16071309248 - Antony Raharja Widjaja<ul><li>16071309250 - Andre Prawira Putra<ul></ul></li><li>16071309253 - Rudi Hartono<ul></ul></li><li>16071309267 - Jepry<ul></ul></li></ul></li></ul></li><li>16071309151 - Syafruddin<ul><li>16071309156 - Ria Endriana Utami<ul></ul></li><li>16071309158 - Martinus Wahyu Dyan Purnomo<ul></ul></li><li>16071309171 - Alfian Wangsa<ul></ul></li><li>16071309197 - Linggih Saputro<ul></ul></li><li>16071309206 - King U Widjaja<ul></ul></li><li>16071309223 - Pinta Ngena S S<ul></ul></li><li>16071309229 - Dr. Ritawaty Kamaruddin<ul><li>16071309269 - Juliani Tanuwiguna<ul></ul></li><li>16071309270 - Irwan Kamaruddin<ul></ul></li><li>16071309271 - Kamaruddin<ul></ul></li></ul></li><li>16071309237 - Syafruddin<ul></ul></li></ul></li><li>16071309154 - Teguh Prayogi<ul></ul></li></ul></li></ul></li><li>1607121437 - Kasem<ul><li>1607121726 - Anen Tumanggung<ul></ul></li></ul></li><li>1607121438 - Lenny Taher<ul><li>16071217370 - E.Prajoko.Ir<ul></ul></li></ul></li><li>1607121439 - Lingga<ul><li>16071217110 - Eli Suneri<ul></ul></li></ul></li><li>1607121440 - Lot 1<ul><li>160712174 - Abdul Fiqri<ul><li>1607130953 - Eko Supriyadi<ul></ul></li><li>16071309139 - Supriyadi<ul></ul></li></ul></li><li>1607121718 - Ahmad Bustomi<ul></ul></li><li>1607121725 - Andra Ungking<ul></ul></li><li>1607121732 - Anita Gunawan<ul></ul></li><li>1607121733 - Anita Gunawan<ul><li>160713094 - Adjun<ul></ul></li><li>1607130930 - Liem Sioe Tjhiang<ul><li>16071309194 - Tju Sau Thin<ul></ul></li></ul></li><li>1607130951 - Benly Suki<ul></ul></li><li>1607130964 - Benny Gunawan<ul></ul></li><li>1607130996 - Mariani<ul></ul></li><li>16071309101 - Mirah Taniaga<ul><li>16071309178 - Arieska Taniaga<ul><li>16071309272 - Kiki Purbaya<ul></ul></li><li>16071309281 - Doristin<ul><li>16071309290 - Nixon Prayogo<ul></ul></li><li>16071309291 - Yunin<ul></ul></li><li>16071309296 - Frans Adiseisha Mandeko<ul></ul></li><li>16071309298 - Yoesak<ul></ul></li></ul></li></ul></li><li>16071309192 - Hendra Setiawan<ul></ul></li></ul></li><li>16071309111 - Oey Milana<ul></ul></li><li>16071309114 - Edi Purwanto<ul></ul></li><li>16071309115 - Renata Sari Burhanudin<ul></ul></li></ul></li><li>1607121780 - Medi Wibowo<ul></ul></li><li>1607121785 - Deny Helmani<ul><li>1607130938 - Siti Rachmawati<ul></ul></li><li>16071309164 - Lucius Marotua Sitanggang<ul></ul></li></ul></li><li>16071217118 - Endang Riadi<ul></ul></li><li>16071217147 - Ginda Tjandra<ul></ul></li><li>16071217254 - R. Achmad Dennis Qadar W.k<ul></ul></li><li>16071217256 - Susan Nopiyanti<ul></ul></li><li>16071217329 - Sulistyawati<ul></ul></li><li>16071217357 - Taufik<ul></ul></li><li>16071217365 - V.G.Ivan Moningka<ul></ul></li></ul></li><li>1607121441 - Lot 2<ul><li>1607121720 - Ahmad Antoni<ul></ul></li><li>1607121761 - Amiruddin<ul></ul></li><li>1607121776 - Dewi Noviandari<ul></ul></li><li>16071217131 - Franky Frentiono Nangoy<ul><li>1607130915 - Antonius Ariawan Sardjono<ul></ul></li><li>1607130926 - Andri Sudaryanto<ul></ul></li><li>1607130935 - Edgar flittner glenn rompis<ul></ul></li><li>1607130990 - Lucia Wiguna<ul></ul></li><li>1607130992 - Lutfi Noviandri<ul></ul></li><li>16071309106 - M. Ninda Receivianti H.<ul></ul></li></ul></li><li>16071217160 - Suhermanto<ul></ul></li><li>16071217226 - Meidy Raseda<ul></ul></li><li>16071217233 - Michael Johnny Bun<ul></ul></li><li>16071217368 - Ir. Winna Wilano<ul></ul></li></ul></li><li>1607121442 - Lot 3<ul><li>160712179 - Muhammad Adib<ul></ul></li><li>1607121710 - Muhammad Adib<ul></ul></li><li>1607121724 - Teuku Muhammad Isfandi<ul></ul></li><li>1607121728 - Dewi Isma<ul></ul></li><li>1607121730 - Anis Suprapto<ul></ul></li><li>1607121756 - Bharata Valency Sibarani<ul></ul></li><li>1607121774 - Cicilia Lucinda<ul></ul></li><li>1607121781 - David Adnan<ul></ul></li><li>16071217106 - Eduardus Sarwoko<ul></ul></li><li>16071217133 - Freddy Hoo Han Wonokusumo<ul></ul></li><li>16071217137 - Gunawan Wijaya<ul></ul></li><li>16071217142 - G Hardianto Djamianto<ul></ul></li><li>16071217154 - Henny Yunara Muslim<ul></ul></li><li>16071217167 - Hendra Widjayanto<ul></ul></li><li>16071217173 - Irfan Falahuddin<ul></ul></li><li>16071217178 - Achmad Rivai<ul></ul></li><li>16071217183 - Riza Ismail<ul></ul></li><li>16071217208 - Lamria Matanari<ul></ul></li><li>16071217213 - Luberto Sihombing<ul><li>1607130923 - Pandapotan Sitompul<ul></ul></li><li>1607130943 - Devid<ul><li>16071309220 - Nurdalia<ul></ul></li><li>16071309221 - Novi Ekayanti<ul></ul></li><li>16071309231 - Selvi Fransisca<ul></ul></li></ul></li><li>16071309162 - Wahyu Trialtos<ul></ul></li></ul></li><li>16071217240 - Irma Nawati<ul></ul></li><li>16071217249 - Nancy Rijadi<ul><li>1607130950 - Sri Natalia<ul></ul></li></ul></li><li>16071217270 - Alwin Purba SE<ul></ul></li><li>16071217292 - Alberto Pakpahan<ul></ul></li><li>16071217307 - Sergio Taslim<ul></ul></li><li>16071217354 - Febian Achmad Subagjo<ul><li>1607130966 - Hakim Ramli<ul></ul></li></ul></li><li>16071217361 - Anwar Sani<ul></ul></li><li>16071217372 - Waskito Tirtanto<ul></ul></li></ul></li><li>1607121443 - Lot 4<ul><li>160712172 - Aang Sujana<ul></ul></li><li>1607121716 - Drs. Syarifuddin Yusmar<ul></ul></li><li>1607121737 - Arie Suparto<ul></ul></li><li>1607121751 - Basuki Rahma<ul></ul></li><li>1607121779 - Daoni Lawrenz<ul><li>1607130937 - Daniel Pangihutan S<ul></ul></li><li>1607130970 - Hezty Hermawan<ul></ul></li><li>1607130978 - Jana Sandra<ul></ul></li><li>16071309119 - Rikki Novebri<ul></ul></li><li>16071309141 - Stefanus M.AS.<ul></ul></li></ul></li><li>16071217130 - Florita Retnoningrum<ul></ul></li><li>16071217148 - Ridwan Tananto<ul></ul></li><li>16071217155 - Henny Yunara Muslim<ul></ul></li><li>16071217166 - Ridho Hutomo, ST, MM<ul></ul></li><li>16071217174 - Dego Hendrata<ul></ul></li><li>16071217197 - July Morgan Julianti<ul></ul></li><li>16071217200 - Joko Hananto<ul></ul></li><li>16071217210 - Leny Imaniasari<ul></ul></li><li>16071217230 - Merry Christiani<ul></ul></li><li>16071217241 - Ghaniy Ageng<ul></ul></li><li>16071217268 - Prayitno Wibowo<ul></ul></li><li>16071217275 - Renaldi Muhammad Nur Fattah<ul></ul></li><li>16071217279 - Reza Ginanjar<ul></ul></li><li>16071217281 - Yunin<ul></ul></li><li>16071217337 - Susilawati Sari<ul></ul></li><li>16071217339 - Syafdinur Mahyudin<ul></ul></li><li>16071217363 - E.F.Veniantoro<ul></ul></li><li>16071217380 - Yanti Selfiana<ul></ul></li><li>16071217381 - Yasinta<ul></ul></li><li>16071217387 - Yusandi Pratama<ul></ul></li><li>16071217388 - Bambang Heru Yuwono<ul></ul></li></ul></li><li>1607121444 - Lot 5<ul><li>1607121778 - Danny Suprawesti<ul></ul></li><li>1607121789 - Devid<ul></ul></li><li>1607121793 - Birviq Ady Sanjaya<ul></ul></li><li>16071217127 - Fenti Herawati<ul></ul></li><li>16071217152 - Hendri<ul></ul></li><li>16071217185 - Iwan Marvianto, SE<ul></ul></li><li>16071217224 - Mario Abraham Kastanja<ul></ul></li><li>16071217289 - Robby Susanto<ul></ul></li><li>16071217323 - Stefanus Sugianto<ul></ul></li><li>16071217324 - Stella Fiona<ul></ul></li><li>16071217362 - Untung Waluyo<ul></ul></li></ul></li><li>1607121445 - Mamay<ul><li>16071217217 - Mamay Handayani<ul></ul></li><li>16071217342 - Syafruddin<ul></ul></li></ul></li><li>1607121446 - Meliana Sari<ul><li>16071217117 - Estiannasari<ul></ul></li><li>16071217149 - Meliana Sari<ul><li>1607130911 - Andrianto Pandra Setiawan<ul></ul></li><li>1607130952 - Soeparto Nilam<ul></ul></li></ul></li><li>16071217198 - Liauw Yiok The<ul></ul></li><li>16071217206 - DRS.Kurnia Tahki, M.PD<ul></ul></li></ul></li><li>1607121447 - Moch Zen, SE<ul><li>16071217103 - Natalia Oktavia Supardi<ul></ul></li><li>16071217175 - Imelda Theresia<ul></ul></li></ul></li><li>1607121448 - Muttaqin<ul><li>16071217244 - Muttaqin<ul></ul></li></ul></li><li>1607121449 - Nanung Setiawan<ul><li>1607121747 - Nanung Setiawan<ul></ul></li></ul></li><li>1607121450 - Natalia<ul><li>1607121769 - Perwita Rosmawati<ul></ul></li><li>16071217104 - Natalia Oktavia Supardi<ul><li>1607130972 - Imelda Theresia<ul></ul></li><li>16071309121 - Rita Sari<ul></ul></li></ul></li><li>16071217250 - Nancy Tanowijono<ul></ul></li><li>16071217384 - Yohanes Andri<ul></ul></li><li>16071217385 - Yohanes Andri<ul></ul></li></ul></li><li>1607121451 - Nila<ul><li>160712178 - Adhitya Pratomo<ul><li>160713092 - Adhitya Pratomo<ul></ul></li></ul></li><li>1607121775 - Cit Chandra Woen<ul></ul></li><li>1607121799 - Devakinandan Maru<ul><li>1607130929 - Devakinandan Maru<ul></ul></li></ul></li><li>16071217234 - Miftakhul Hadi<ul></ul></li><li>16071217255 - Nila Fitria<ul></ul></li><li>16071217343 - Syafruddin<ul></ul></li></ul></li><li>1607121452 - Nureen<ul><li>1607121711 - Adi Robert Taning<ul></ul></li><li>1607121742 - Arwindo<ul></ul></li><li>1607121743 - Taryono<ul></ul></li><li>1607121794 - Tjetjep Djaja Laksana<ul></ul></li><li>16071217176 - Imah Dwi Lestari<ul></ul></li><li>16071217332 - IR Sunarsi Awaloedin<ul></ul></li><li>16071217334 - Suryanto Tejokusumo<ul></ul></li><li>16071217389 - Yunaldi<ul></ul></li></ul></li><li>1607121453 - Patricia<ul><li>16071217223 - Maria Christine<ul></ul></li></ul></li><li>1607121454 - Perwita M<ul><li>1607121727 - Anggadewi Mahayani<ul><li>160713095 - Anggadewi Agnitara<ul><li>16071309191 - A. Haytamie Hamsie<ul><li>16071309277 - Anggadewi Rilawati<ul><li>16071309287 - Perwita Rosmawati<ul></ul></li></ul></li></ul></li></ul></li></ul></li><li>16071217243 - Mustakim<ul></ul></li></ul></li><li>1607121455 - Presli Simon<ul><li>16071217311 - Hernawati Simbolon<ul></ul></li></ul></li><li>1607121456 - Reynold Albert Laoh<ul><li>16071217209 - Reynold Albert Laoh<ul><li>160713093 - Ettawadi<ul></ul></li><li>16071309153 - Tatang Heryadi<ul></ul></li></ul></li></ul></li><li>1607121457 - Reza<ul><li>1607121712 - Adi Robert Taning<ul><li>1607130934 - Ade Diyan Sanura<ul><li>16071309181 - Budi Anak Robert Taning<ul></ul></li><li>16071309198 - Imah Dwi Lestari<ul></ul></li></ul></li></ul></li><li>1607121715 - Agustinus Banu Mulyawan<ul></ul></li><li>1607121749 - Mochamad Nizar Bajuber<ul></ul></li><li>1607121767 - Tina Caroline Ch Sutedja<ul></ul></li><li>1607121770 - Chris Yadi Yacob<ul><li>1607130975 - Muhammad Iqbal<ul><li>16071309190 - Grandi Thoro Edison<ul><li>16071309252 - Bunga Lin<ul></ul></li><li>16071309256 - Edward Yonathan S<ul></ul></li><li>16071309258 - Danang Dwi Setyo<ul><li>16071309294 - Bernadus Sugiarto W. SH<ul><li>16071309301 - Tina Caroline Ch Sutedja<ul></ul></li><li>16071309302 - Noor Vito Priyantomo<ul></ul></li></ul></li></ul></li><li>16071309259 - Florentius Thomas Edison<ul></ul></li><li>16071309278 - Rizki Fadillah<ul></ul></li><li>16071309282 - Siska Marthio<ul></ul></li></ul></li><li>16071309215 - Catur Prayogo Edhi Nugroho<ul></ul></li></ul></li><li>16071309161 - Chris Yadi Yacob<ul></ul></li></ul></li><li>1607121795 - Djuita Liana<ul></ul></li><li>1607121798 - Dedy Kurniawan<ul></ul></li><li>16071217114 - Endang Yuharningsih<ul></ul></li><li>16071217119 - Endang Riadi<ul></ul></li><li>16071217169 - Muhammad Iman SE MM<ul></ul></li><li>16071217170 - Minarti<ul></ul></li><li>16071217172 - Nur Aida Zulhana<ul></ul></li><li>16071217203 - Kevin Ismail Harum Pulungan<ul></ul></li><li>16071217212 - Antonius Suhartanto Amin<ul></ul></li><li>16071217231 - IR. Agung Setiya Budhi<ul><li>1607130910 - Andi Firmansyah<ul></ul></li><li>1607130939 - Al Viano De Partho<ul></ul></li><li>1607130959 - Budi Ferza<ul></ul></li><li>16071309166 - Supriyadi<ul></ul></li></ul></li><li>16071217248 - Nancy Oktavia Christiningrum<ul></ul></li><li>16071217260 - Octo Bryan<ul></ul></li><li>16071217271 - Rr Novita Primadani<ul></ul></li><li>16071217291 - Robin Kobero<ul></ul></li><li>16071217298 - Rudy Ruslan, SH. MBA<ul></ul></li><li>16071217312 - Siska Marthio<ul></ul></li><li>16071217328 - Ahmad Mulyono Yakin<ul><li>16071309117 - Rian Nurdian<ul></ul></li><li>16071309159 - Wihenti<ul></ul></li></ul></li><li>16071217344 - Syafruddin<ul></ul></li><li>16071217367 - Ria Endriana Utami<ul></ul></li></ul></li><li>1607121458 - Reza Pahlefi<ul><li>16071217277 - Reza Pahlefi<ul><li>16071309126 - Jimmy Chin<ul></ul></li></ul></li></ul></li><li>1607121459 - Richard Dondokambey<ul><li>16071217100 - Richard Dondokambey<ul></ul></li></ul></li><li>1607121460 - Riri<ul><li>1607121713 - Umar Tuming<ul></ul></li><li>1607121745 - Hendrawinata Sujanto<ul></ul></li><li>16071217144 - Mathias Putra<ul></ul></li><li>16071217232 - Mega Muliana<ul></ul></li><li>16071217286 - Rizki Fadillah<ul><li>1607130947 - Dedy Kurniawan<ul></ul></li><li>16071309125 - Rizki Fadillah<ul><li>16071309128 - Alberto Pakpahan<ul></ul></li></ul></li></ul></li><li>16071217293 - Alberto Pakpahan<ul></ul></li></ul></li><li>1607121461 - Roby<ul><li>16071217134 - Freddy Hoo Han Wonokusumo<ul></ul></li><li>16071217218 - Mamay Handayani<ul><li>160713098 - Andalan Utama Goenawan<ul></ul></li><li>1607130917 - Ario Bimo Seno RNG<ul><li>16071309246 - Bambang Pahlawan Yudha Angkasa<ul></ul></li></ul></li><li>1607130941 - Dessyana Fransisca<ul><li>16071309226 - Oey Soe Kiong<ul></ul></li><li>16071309245 - Ria Endriana Utami<ul></ul></li></ul></li><li>1607130942 - Dessyana Fransisca<ul></ul></li><li>1607130965 - Jong Hai Hoa<ul></ul></li><li>1607130995 - IR. Marhaenda Arvai Kemala S<ul></ul></li></ul></li></ul></li><li>1607121462 - Roni BS<ul><li>16071217259 - Nurul Fitriana<ul></ul></li><li>16071217295 - Roni Budi Santoso<ul><li>16071309127 - Roland Hasibuan<ul><li>16071309234 - Ferry<ul></ul></li></ul></li></ul></li><li>16071217308 - Jumbang Budina<ul></ul></li><li>16071217330 - Liong Kang SE<ul></ul></li></ul></li><li>1607121463 - Ruben<ul><li>16071217264 - Ruben Tahiro Panjaitan<ul><li>1607130912 - Anindya Kurniawan<ul></ul></li></ul></li></ul></li><li>1607121464 - Santoso<ul><li>1607121763 - Budi Utomo<ul></ul></li><li>1607121791 - Novalita Senjaya<ul></ul></li></ul></li><li>1607121465 - Scotina<ul><li>16071217138 - Scortina Indira Sagita<ul></ul></li></ul></li><li>1607121466 - Shinta<ul><li>1607121783 - Dedi Putra<ul></ul></li></ul></li><li>1607121467 - Siska Marthio<ul><li>16071217280 - Reza Ginanjar<ul><li>1607130976 - Irma Novalia<ul><li>16071309216 - Mazda Novi Mukhlisa<ul></ul></li></ul></li></ul></li><li>16071217313 - Siska Marthio<ul></ul></li><li>16071217364 - E.F.Veniantoro<ul></ul></li><li>16071217386 - Yulen Agustin<ul></ul></li></ul></li><li>1607121468 - Siswandi<ul><li>16071217314 - Siswandi Waluyo, ST<ul></ul></li></ul></li><li>1607121469 - Slamet Rahardjo<ul><li>1607121719 - Ahmad Bustomi<ul></ul></li><li>1607121721 - Ahmad Imran<ul></ul></li><li>1607121731 - Anis Suprapto<ul></ul></li><li>1607121764 - Umi Rodiah<ul></ul></li><li>16071217121 - Fajar Cahyono<ul></ul></li><li>16071217265 - Pae Pinan Mesakaraeng<ul></ul></li></ul></li><li>1607121470 - Team Aini<ul><li>1607121741 - Arry Cahyo Chrisnugroho<ul></ul></li><li>1607121768 - Erwien Sri Ujianto<ul></ul></li><li>16071217120 - Fakhruddin Karmani<ul></ul></li><li>16071217253 - Andi Masniar. SH<ul><li>1607130919 - Aslim<ul></ul></li><li>16071309138 - Triani Rochmiati<ul></ul></li></ul></li><li>16071217294 - Ronald Posta Yitzak<ul><li>1607130997 - Maria Br Sigalingging<ul></ul></li></ul></li><li>16071217352 - Hj. Tarmi<ul></ul></li></ul></li><li>1607121471 - Team Hary<ul><li>1607121771 - Christine Haryono, SE<ul><li>1607130980 - Jasmin<ul></ul></li><li>16071309133 - Sienti<ul></ul></li></ul></li><li>16071217211 - A. Setiawan<ul></ul></li><li>16071217335 - Suryanto Tejokusumo<ul></ul></li><li>16071217356 - Tiolina Ia T. Se. Ak<ul></ul></li><li>16071217382 - Bregas Soeryo Soeyogyo<ul></ul></li></ul></li><li>1607121472 - Team Josua<ul><li>16071217195 - Josua Marasalmo<ul></ul></li><li>16071217202 - Jusuf Budianto<ul><li>1607130920 - Astri Almasih<ul></ul></li><li>1607130968 - Herdiman Santosa<ul></ul></li><li>1607130989 - Suwanto<ul></ul></li><li>16071309152 - Syafruddin<ul></ul></li></ul></li><li>16071217345 - Syafruddin<ul></ul></li></ul></li><li>1607121473 - Team Kartini<ul><li>16071217143 - Gerardo Alexsander Suwandy<ul></ul></li><li>16071217267 - Ir. E. Prajoko Msi<ul><li>1607130922 - Heny Mulyawati<ul></ul></li><li>1607130984 - I Made Sumasta<ul></ul></li><li>1607130993 - Nyoman Upadana<ul><li>16071309212 - I Made Subrata<ul></ul></li></ul></li></ul></li><li>16071217274 - Gilang Rizqhon S.A.H<ul></ul></li></ul></li><li>1607121474 - Team Mamay<ul><li>16071217107 - Edi Budi Santoso<ul><li>1607130928 - Bagus Ilman Lazuardi<ul></ul></li><li>1607130960 - Sefiyansyah<ul></ul></li><li>16071309137 - Siti Khadijah<ul></ul></li></ul></li><li>16071217180 - Purnomo Yudi Putra<ul></ul></li><li>16071217302 - Dian Ario Sekunda, S.IP<ul><li>16071309110 - Novriza<ul></ul></li><li>16071309134 - Silma Agustiani<ul></ul></li></ul></li></ul></li><li>1607121475 - Team Rina<ul><li>1607121739 - Arif Nurrawi S.IP<ul><li>1607130957 - Ferlina Kirtiasih S.SOS<ul></ul></li></ul></li><li>1607121777 - Yowel Nanto Caroko<ul></ul></li><li>1607121788 - Devid<ul></ul></li><li>16071217237 - Mitchell Busono<ul></ul></li><li>16071217283 - Saulina Riawaty<ul></ul></li><li>16071217315 - Sitha Mawarti<ul></ul></li></ul></li><li>1607121476 - Team Thoro<ul><li>16071217115 - Ermi Wijayanti<ul></ul></li></ul></li><li>1607121477 - Toro<ul><li>160712173 - M.Syaibi<ul></ul></li><li>1607121734 - Anthoni Roy<ul></ul></li><li>1607121757 - Bherdika Constantia Lambertus<ul></ul></li><li>1607121758 - Biffi Christian<ul></ul></li><li>1607121782 - David Sutiono<ul><li>1607130962 - Eva Pattilaya<ul></ul></li><li>16071309135 - Simon Petrus<ul></ul></li></ul></li><li>16071217108 - Mariatie Wijaya<ul><li>1607130916 - Arieska Taniaga<ul></ul></li><li>1607130956 - Fanya Gosal<ul></ul></li><li>1607130985 - Julianingsih<ul><li>16071309184 - Edwin Gozal<ul></ul></li><li>16071309188 - Foenawaty Soewito<ul></ul></li><li>16071309210 - Liliana Soewito<ul></ul></li><li>16071309230 - Inge Sakurawati Ting<ul></ul></li><li>16071309235 - Sugiarto<ul></ul></li></ul></li><li>16071309140 - Soekandi Soetrisno<ul></ul></li><li>16071309147 - Susilawati Sari<ul></ul></li></ul></li><li>16071217146 - Fendi<ul></ul></li><li>16071217150 - Ir.Handojo Indrapudjiono<ul></ul></li><li>16071217188 - James Henry S<ul></ul></li><li>16071217189 - Jaffrai Andreas Esrom<ul><li>1607130999 - Mikael Pai<ul></ul></li><li>16071309105 - Nery Bid<ul></ul></li><li>16071309163 - Yusandi Pratama<ul><li>16071309241 - Vitaria<ul></ul></li></ul></li></ul></li><li>16071217192 - Hengki Sentosa<ul></ul></li><li>16071217204 - Kiki Damsah<ul></ul></li><li>16071217216 - Roweni<ul></ul></li><li>16071217225 - David Sutiono<ul></ul></li><li>16071217235 - Mikael Pai<ul></ul></li><li>16071217251 - Nasikhin Ahsanto<ul></ul></li><li>16071217261 - Fajar Adrian Daswir<ul></ul></li><li>16071217263 - Pambant Setyadji Bas<ul></ul></li><li>16071217266 - Piter Halim<ul></ul></li><li>16071217273 - Fajar Adrian Daswir<ul></ul></li><li>16071217285 - Rizki Fadillah<ul></ul></li><li>16071217296 - Rudolf Lodewyk Masoara<ul></ul></li><li>16071217300 - Ruly Kusuma Wahyuni<ul></ul></li><li>16071217306 - Skolastika Phoebe<ul></ul></li><li>16071217318 - Sofyan Hamzani<ul></ul></li><li>16071217319 - Fahrizal<ul></ul></li><li>16071217378 - Benny Setyawan<ul></ul></li></ul></li><li>1607121478 - Umar<ul><li>160712176 - Achfas Prihatna<ul></ul></li><li>1607121744 - Taryono<ul></ul></li><li>16071217101 - Dr Noor Alya<ul></ul></li><li>16071217140 - Putro Pamungkas<ul></ul></li><li>16071217187 - Iyan Fatmah Assegaf<ul></ul></li><li>16071217269 - Pudji Basuki<ul></ul></li><li>16071217347 - Syahrul Alamsyah<ul></ul></li><li>16071217360 - Umar<ul><li>1607130918 - R Ariyanto Setiawan<ul><li>16071309239 - Mohammad Taswin<ul><li>16071309268 - Jonny<ul></ul></li><li>16071309273 - Layyinatus Syifa<ul></ul></li></ul></li></ul></li><li>1607130974 - Indriati Utami<ul></ul></li><li>1607130982 - Jaumil Diandri Perkasa Putra<ul><li>16071309169 - Agus Kurniawan<ul><li>16071309249 - Agus Kurniawan<ul></ul></li><li>16071309251 - Tubagus Maulana<ul></ul></li><li>16071309262 - Taty Haryaty<ul><li>16071309299 - Yohanes Himawan Sutjiono<ul></ul></li><li>16071309300 - Yulia Sugiarti<ul></ul></li></ul></li></ul></li><li>16071309179 - Pandu Praptoadi PY<ul><li>16071309283 - Arman Hasudungan Manurung<ul></ul></li></ul></li><li>16071309196 - Rudy M. Ridwan<ul></ul></li><li>16071309202 - Irwan Nugraha K<ul></ul></li><li>16071309204 - Jaumil Indah Dwi Purnama<ul></ul></li><li>16071309227 - Riki Sunarya<ul></ul></li><li>16071309242 - Tina Permatasari<ul><li>16071309261 - Genta Sumarlan<ul></ul></li></ul></li><li>16071309244 - E.F.Veniantoro<ul><li>16071309257 - Egar Morthen Phang<ul></ul></li><li>16071309263 - Hendri<ul><li>16071309285 - Gilang Rizqhon S.A.H<ul></ul></li><li>16071309288 - Dandy<ul></ul></li><li>16071309292 - Dian Ario Sekunda<ul></ul></li><li>16071309293 - Siti Zudiar Ifriza<ul></ul></li><li>16071309295 - Syarli Nopriansyah<ul><li>16071309303 - Sulastri Anggraini<ul></ul></li></ul></li></ul></li><li>16071309264 - Trinugroho Tunggul Kuncoro<ul><li>16071309289 - Yuniwati Pertami Boentaran<ul></ul></li><li>16071309297 - Yasinta<ul></ul></li></ul></li><li>16071309276 - Rian Nurdian<ul></ul></li></ul></li></ul></li><li>16071309122 - Riza Alfarizi<ul></ul></li></ul></li></ul></li><li>1607121479 - Verawati<ul><li>16071217326 - Steven Glen<ul></ul></li></ul></li><li>1607121480 - Vera Anandari<ul><li>1607121738 - Arief Gunawan<ul></ul></li><li>1607121796 - Djuita Liana<ul></ul></li><li>16071217126 - Djoniharto Tjahaja<ul></ul></li><li>16071217164 - Syamsuddin Hs<ul></ul></li><li>16071217181 - Irawan<ul></ul></li><li>16071217215 - I Made Subrata<ul></ul></li><li>16071217358 - IR Gondo Maruto<ul></ul></li></ul></li><li>1607121481 - Vira<ul><li>16071217136 - Faisal D<ul></ul></li></ul></li><li>1607121482 - Widi<ul><li>16071217374 - Widya Resvianti<ul></ul></li></ul></li><li>1607121483 - Wisye<ul><li>16071217168 - Hezty Hermawan<ul></ul></li><li>16071217199 - Liauw Yiok The<ul></ul></li><li>16071217377 - F. Y. Wisye<ul></ul></li></ul></li><li>1607121484 - Yuli Handayani<ul><li>160712175 - Rio Granda Asa Biasna<ul></ul></li><li>1607121714 - Afried Horasman Leonard<ul></ul></li><li>1607121722 - Aldi Santos, SE<ul></ul></li><li>1607121723 - Tarmizi<ul></ul></li><li>1607121759 - Budi Irawan<ul></ul></li><li>1607121787 - Rudy Desmond Tampi<ul></ul></li><li>16071217141 - Donny How Gentania<ul></ul></li><li>16071217196 - J.S Suryo Santoso<ul></ul></li><li>16071217205 - Krisma Nuansa Wibisono<ul></ul></li><li>16071217282 - Rina Susilawati, SS MA<ul></ul></li><li>16071217376 - Muhammad Husni<ul></ul></li><li>16071217390 - Yunaldi<ul></ul></li></ul></li></ul></li></ul>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        (function($) {
        function init() {
        $('.easy-tree').EasyTree({
        addable: false,
        editable: false,
        deletable: false
        });
        }
        window.onload = init();
        })(jQuery)
        </script>
        <script>
        function myDetail(ACCNO) {
        //alert("I am an alert box: " + ACCNO);
        Treview_JS.accountdetail2(ACCNO)
        }
        </script>
    </div>
    <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Modal header</h3>
        </div>
        <div class="modal-body">
            <p>One fine body…</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary">Save changes</button>
        </div>
    </div>
    <div class="md-modal md-3d-sign" data-modal="md-3d-sign" id="md-3d-sign">
        <div class="md-content">
            <h3>Modal Dialog</h3>
            <div>
                <p>This is a modal window. You can do the following things with it:</p>
                <ul>
                    <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
                    <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
                    <li><strong>Close:</strong> click on the button below to close the modal.</li>
                </ul>
                <p>
                    <button class="btn btn-danger md-close">Close me!</button>
                    <button class="btn btn-success md-close">Some button</button>
                </p>
            </div>
            </div><!-- End div .md-content -->
            </div><!-- End div .md-modal .md-3d-sign -->
            <script src="custom/js/jquery.validate.min.js" type="text/javascript"></script>
            <script src="assets/libs/bootstrap-inputmask/inputmask.js"></script>
            <script src="custom/js/treview.js" type="text/javascript"></script>
            
            <script>
            jQuery(document).ready(function() {
            Treview_JS.init();
            });
            </script>
            
            <script src="assets/libs/jquery-notifyjs/notify.min.js"></script>
            <script src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"></script>
            <script src="custom/js/noty_general.js"></script>
                                                
                                                <!-- /END OF CONTENT -->
                                                <!-- Footer Sidebar Start -->
                                                <!-- Footer Start -->
<footer>
    Copyright Cabinet System Team, 2016
    <div class="footer-links pull-right">
        <a href="http://thecabinetsystems.com/" target="_new">The Cabinet Systems</a>
    </div>
</footer>
<!-- Footer End -->

                                                <!-- Footer Sidebar End -->
                                                <div id='firechat-wrapper'></div>
                                            </div>
                                            
                                            <!-- Right Sidebar Start -->
                                            <!-- Right Sidebar Start -->

<script language="javascript">
    var doubleclick = '1';
    function cek_validasi(keyurl)
    {
        var el = document.getElementById('thebutton');
        var e2 = document.getElementById('idupdate_button');
        e2.innerHTML = "Processiong is in progress, Please wait";
        if (el.style.display != 'none') {
            //alert("Line-136-DoubleClick:" + doubleclick);
            if (doubleclick == '2') {
                //alert("Line-138-DoubleClick");
                //var formnya = document.getElementById("updateps-form");
                //formnya.action = "#";
                //calreadyclick();
            }
            if (doubleclick == '1') {
                //alert("DashBoardAwal-Line-146:" + e2.innerHTML);
                //e2.innerHTML = "Processiong is in progress, Please wait";
                doubleclick = '2';
                var formnya = document.getElementById("updateps-form");
                //formnya.action = "openaccount2.php";
                //el.style.display = 'none'
                //alert("Line-150");
                //Dash_CompanyConfirmAdmin_JS2.seetugas('{$account1}');
            } else {
                //e2.innerHTML = "Submit";
                return false;
            }
        } else {
            //e2.innerHTML = "Submit";
            return false;
        }
    }
    function calreadyclick()
    {
        bootbox.alert('Please do not click again');
        return false;
    }
</script>

<div class="right side-menu">

    <ul class="nav nav-tabs nav-justified" id="right-tabs">
        <li><a href="#connect" data-toggle="tab" title="Chat"><i class="fa fa-envelope-o pulse"></i></a></li>
        <li><a href="#feed" data-toggle="tab" title="Live Feed"><i class="icon-rss-2"></i></a></li>        
        <li><a href="#settings" data-toggle="tab" title="Preferences"><i class="icon-wrench"></i></a></li>   
    </ul>
    <div class="clearfix"></div>
    <div class="tab-content">

        <div class="tab-pane" id="connect">
            <div class="tab-inner slimscroller">
                <div class="panel-group" id="collapse">
                    <div class="panel panel-default" id="chat-panel">
                        <div class="panel-heading bg-darkblue-2">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" href="#chat-coll"><i class="fa fa-envelope-o pulse"></i> Email To Admin 
                                    <span  class="label bg-darkblue-1 pull-right"></span>
                                </a>
                            </h4>
                        </div>
                        <div id="chat-coll" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="widget">   
                                    
                                    <form id="updateps-email" name ="updateps-email" 
                                          role="form"  
                                          method="post" 
                                          action="email_admin.php?postmode=emailtoadmin&tradedby=THEPROGRAMMER">
                                        <br>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Please email us anything about your feed back</label>

                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label for="input-text" >Subject</label>
                                                <input type="text" name="email_subject"  id="email_subject" placeholder="The Subject" class="form-control">
                                                <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <label>Message</label>
                                                <textarea class="form-control" rows="5" name="email_message" 
                                                          id="email_message" placeholder="Please put the message here"></textarea>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>                                        
                                        <div class="form-group">   
                                            <div class="col-sm-12">
                                                <div id="thebutton">
                                                    <button class="btn btn-info" type="button" id="updateps-email-btn" name='updateps-email-btn'>
                                                        <div id="idupdate_button" name="idupdate_button">Submit</div>
                                                    </button>
                                                </div>
                                                <div class="form-group" id="themessage2"></div>
                                                <p class="help-block">We will reply to THEPROGRAMMER</p>
                                            </div>
                                        </div>
                                    </form>
                                    
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane " id="feed">
            <div class="tab-inner slimscroller">                
                <div class="panel-group" id="collapse">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-orange-1">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#rnotifications"> <i class="fa fa-globe top-news-icon"></i>  RSS 
                                    <span class="label bg-darkblue-1 pull-right">0</span>
                                </a>
                            </h4>
                        </div>
                        
                        <div id="rnotifications" class="panel-collapse collapse in">
                            <div class="panel-body">                                
                                <ul class="list-unstyled" id="notification-list">
                                    <div id="worldnews_portlet" class="col-md-12">
                                     
                                    </div>                                    
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>



        <div class="tab-pane active" id="settings">
            <div class="tab-inner slimscroller">
                <div class="panel-group" id="collapse">
                    <div class="panel panel-default">
                        <div class="panel-heading bg-green-3">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion"  href="#remails">
                                    <i class="icon-lamp-1"></i> Education<span class="label bg-darkblue-1 pull-right">0</span>
                                </a></h4>
                        </div>
                        <div id="remails" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <ul class="list-unstyled" id="inbox-list">
                                <!--
                                    <li><iframe width="280" height="108" src="https://www.youtube.com/embed/DYAnoSdCE1s" frameborder="0" allowfullscreen></iframe>
                                    </li>
                                    <li><iframe width="280" height="108" src="https://www.youtube.com/embed/nsF6j5WZ_No" frameborder="0" allowfullscreen></iframe>
                                    </li>
                                    <li><iframe width="280" height="108" src="https://www.youtube.com/embed/FyuWpDMAP1k" frameborder="0" allowfullscreen></iframe>
                                    </li>
                                -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>



</div>
</div>



<script src="assets/admin/pages/scripts/news_rss.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        MainRSS.init();
    });
</script>
<script src="assets/libs/prettify/prettify.js"></script>

<script src="custom/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="custom/js/bootstrapValidator.min.js"></script>

<script src="custom/js/email_admin.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function() {
        EmailAdminVar.init();
    });

</script>

<script src="assets/libs/jquery-notifyjs/notify.min.js"></script>
<script src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"></script>
<script src="custom/js/noty_general.js"></script>


<!-- End right content -->

<!-- Right Sidebar End -->

                                            <!-- Right Sidebar End -->
                                        </div>
                                        <!-- End page -->
                                        <div class="md-overlay"></div>
                                        <!-- End of eoverlay modal -->
                                        <script>
                                            var resizefunc = [];
                                        </script>
                                        
                                        <!-- <script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script> -->
                                        <script src="assets/libs/jquery-detectmobile/detect.js"></script>
                                        <script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
                                        <script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
                                        <script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
                                        <script src="assets/libs/nifty-modal/js/classie.js"></script>
                                        <script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
                                        <!-- <script src="assets/libs/sortable/sortable.min.js"></script> -->
                                        <script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
                                        <!-- ini Untuk checkbox aw -->
                                        
                                        <script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
                                        <script src="assets/libs/pace/pace.min.js"></script>
                                        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
                                        <!-- <script src="assets/libs/bootstrap-combobox/js/bootstrap-combobox.js"></script> -->
                                        <!-- Demo Specific JS Libraries -->
                                        <script src="assets/libs/prettify/prettify.js"></script>
                                        <script src="assets/js/init.js"></script>
                                        <!-- Custom -->

                                        <!-- Firebase -->

                                        <script src="custom/js/md_index.js"></script>
                                        
                                        


                                        <script>
                                            function formatRp(value) {
                                                if (value) {
                                                    return accounting.formatMoney(value);
                                                } else {
                                                    return '';
                                                }
                                            }
                                        </script>
                                        <script>
                                            jQuery(document).ready(function() {
                                                Mainpage.init();
                                            });
                                        </script>
                                        
                                    </body>
                                    <!-- end: BODY -->
                                    </html><?php }
}
?>