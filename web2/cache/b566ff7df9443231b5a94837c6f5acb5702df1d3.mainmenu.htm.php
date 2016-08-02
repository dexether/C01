<?php
/*%%SmartyHeaderCode:2391557a0237ba505a7_96944357%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b566ff7df9443231b5a94837c6f5acb5702df1d3' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\mainmenu.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2391557a0237ba505a7_96944357',
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
  'unifunc' => 'content_57a0237d481e86_19865786',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57a0237d481e86_19865786')) {
function content_57a0237d481e86_19865786 ($_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>AgendaFX</title>
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
                                        <img src="images/data/profile/profile_987.jpg">
                     
                </a>
            </div>
            <div class="col-xs-8">
                <div class="profile-text">Welcome <b>Reza </b></div>
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
							<li class='has_sub'><a href="imp_treeview.php" onclick=cek_active("imp_treeview") class="mm_menuitem"  id="imp_treeview"><i class=""></i>Treeview</a></li>
							<li class='has_sub'><a href="menu_openlive.php" onclick=cek_active("menu_openlive") class="mm_menuitem"  id="menu_openlive"><i class=""></i>Open Live Account</a></li>
							<li class='has_sub'><a href="imp_client_comm_realtime.php" onclick=cek_active("imp_client_comm_realtime") class="mm_menuitem"  id="imp_client_comm_realtime"><i class=""></i>Realtime Commision</a></li>
							<li class='has_sub'><a href="imp_client_comm.php" onclick=cek_active("imp_client_comm") class="mm_menuitem"  id="imp_client_comm"><i class=""></i>Monthly Commision report</a></li>
							<li class='has_sub'><a href="kliring_day_end.php" onclick=cek_active("kliring_day_end") class="mm_menuitem"  id="kliring_day_end"><i class=""></i>Kliring Day End</a></li>
						</ul>
					</li>
					<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-asterisk"></i>Two Forex<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
						<ul class='list-unstyled' id='updates-list'>
							<li class='has_sub'><a href="two_webtrader.php" onclick=cek_active("two_webtrader") class="mm_menuitem"  id="two_webtrader"><i class=""></i>Web Trader</a></li>
							<li class='has_sub'><a href="menu_openlive_two.php" onclick=cek_active("menu_openlive_two") class="mm_menuitem"  id="menu_openlive_two"><i class=""></i>Open Live Account</a></li>
							<li class='has_sub'><a href="imp_client_comm.php" onclick=cek_active("imp_client_comm") class="mm_menuitem"  id="imp_client_comm"><i class=""></i>Monthly Commision report</a></li>
							<li class='has_sub'><a href="imp_client_comm_realtime.php" onclick=cek_active("imp_client_comm_realtime") class="mm_menuitem"  id="imp_client_comm_realtime"><i class=""></i>Realtime Commision</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<li class='has_sub'><a href="javascript:void(0);"  class=""  id="0"><i class="glyphicon glyphicon-asterisk"></i>Your Plan<span class="pull-right"><i class="fa fa-angle-down"></i></span></a>
				<ul class='list-unstyled' id='updates-list'>
					<li class='has_sub'><a href="imp_registration.php" onclick=cek_active("imp_registration") class="mm_menuitem"  id="imp_registration"><i class=""></i>New Plan</a></li>
					<li class='has_sub'><a href="imp_myaccount.php" onclick=cek_active("imp_myaccount") class="mm_menuitem"  id="imp_myaccount"><i class=""></i>My Account</a></li>
				</ul>
			</li>
		</ul>
		</div>
		
        <div id="sidebar-menu">        
            <ul class="list-unstyled" id="updates-list">
                <input type="hidden" id="pengactive" value="dashboard1">
                
                <!--  -->

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
                                            <!-- 
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
 -->
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
							Login as reza@thecabinetsystems.com </a></li>
					<li class="dropdown iconify hide-phone"><a href="#"
						onclick="javascript:toggle_fullscreen()"><i
							class="icon-resize-full-2"></i></a></li>
					<li class="dropdown topbar-profile"><a href="#"
						class="dropdown-toggle" data-toggle="dropdown"> <span
							class="rounded-image topbar-profile-image">
														<img src="images/data/profile/profile_987.jpg">
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
                                                
                                                <link href="assets/libs/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<div class="content" id="main_content">
   <!-- Additional -->
   <!-- Extra CSS Libraries Start -->
   <link href="assets/libs/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/morrischart/morris.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-clock/clock.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/bootstrap-calendar/css/bic_calendar.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/jquery-weather/simpleweather.css" rel="stylesheet" type="text/css"/>
   <link href="assets/libs/bootstrap-xeditable/css/bootstrap-editable.css" rel="stylesheet" type="text/css"/>
   <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
   <style type="text/css">
      .img-responsive {
  margin-bottom: 30px;
}
/*.row{
  margin-top: 1px;
  margin-bottom: 1px
}*/
   </style>
      <div class="carousel slide" data-ride="carousel" id="carousel-example">
      <ol class="carousel-indicators">
         <li class="active" data-slide-to="0" data-target="#carousel-example">
         </li>
         <li data-slide-to="1" data-target="#carousel-example">
         </li>
         <li data-slide-to="2" data-target="#carousel-example">
         </li>
      </ol>
      <div class="carousel-inner">
         <div class="item active">
            <a href="#">
               <img src="images/slider/slide4.jpg"/>
            </a>
         </div>
         <div class="item">
            <a href="#">
               <img src="images/slider/slide5.jpg"/>
            </a>
         </div>
         <div class="item">
            <a href="#">
               <img src="images/slider/slide6.jpg"/>
            </a>
         </div>
      </div>
      <a class="left carousel-control" data-slide="prev" href="#carousel-example">
         <span class="glyphicon glyphicon-chevron-left">
         </span>
      </a>
      <a class="right carousel-control" data-slide="next" href="#carousel-example">
         <span class="glyphicon glyphicon-chevron-right">
         </span>
      </a>
   </div>
   <div class="row">
      <div class="col-md-12 portlets">
         <div class="content">
            <!-- Start info box -->
            <div class="row top-summary">
               <button class="btn btn-primary btn-lg btn-block" type="button">
                  Welcome to AgendaFX
                  <p class="text-muted">
                     Solution for Financial Risk and Reward
                  </p>
               </button>
               <p>
                  <br>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget green-1 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="icon-globe-inv">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       WALLET (USD)
                                    </b>
                                 </p>
                                 <h3>
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
                                    </span>
                                 </h3>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget darkblue-2 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-trophy">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       REWARD ( USD )
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget orange-4 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-user">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       ACCOUNT
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="1">
                                       1
                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-3 col-md-6">
                        <div class="widget lightblue-1 animated fadeInDown">
                           <div class="widget-content padding">
                              <div class="widget-icon">
                                 <i class="fa fa-dollar">
                                 </i>
                              </div>
                              <div class="text-box">
                                 <p class="maindata">
                                    TOTAL
                                    <b>
                                       AFILIATE
                                    </b>
                                 </p>
                                 <h2>
                                    <span class="animate-number" data-duration="3000" data-value="0.00">
                                       0.00
                                    </span>
                                 </h2>
                                 <div class="clearfix">
                                 </div>
                              </div>
                           </div>
                           <div class="widget-footer">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <i class="fa rel-change">
                                    </i>
                                    <b>
                                    </b>
                                 </div>
                              </div>
                              <div class="clearfix">
                              </div>
                           </div>
                        </div>
                     </div>
                  </br>
               </p>
            </div>
            <!-- End of info box -->
            <div class="row">
               <div class="col-lg-8 portlets">
                  <div class="widget" id="website-statistics1">
                     <div class="widget-content">
                        <a href="https://twofrx.com/trading-contest-2016/" target="_new" title="Trading Contest 2016">
                           <div class="img-wrap">
                              <img alt="Image gallery" class="mfp-fade" height="100%" src="images/education/thecabinet.jpg" title="Trading Contest 2016" width="100%">
                              </img>
                           </div>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 portlets">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="widget" id="todo-app">
                           <div class="widget-header centered">
                              <!-- <div class="left-btn"><a class="btn btn-sm btn-default add-todo"><i class="fa fa-plus"></i></a></div> -->
                              <h2>
                                 Todo List
                              </h2>
                              <div class="additional-btn">
                                 <a class="hidden reload" href="#">
                                    <i class="icon-ccw-1">
                                    </i>
                                 </a>
                                 <a class="widget-popout hidden tt" href="#" title="Pop Out/In">
                                    <i class="icon-publish">
                                    </i>
                                 </a>
                                 <a class="widget-maximize hidden" href="#">
                                    <i class="icon-resize-full-1">
                                    </i>
                                 </a>
                                 <a class="widget-toggle" href="#">
                                    <i class="icon-down-open-2">
                                    </i>
                                 </a>
                                 <a class="widget-close" href="#">
                                    <i class="icon-cancel-3">
                                    </i>
                                 </a>
                              </div>
                           </div>
                           <div class="widget-content padding-sm">
                              <ul class="todo-list">
                                                               </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-8 portlets">
                  <div class="widget">
                     <div class="widget-header">
                        <h2>
                           News
                        </h2>
                        <div class="additional-btn">
                           <a class="hidden reload" href="#">
                              <i class="icon-ccw-1">
                              </i>
                           </a>
                           <a class="widget-toggle" href="#">
                              <i class="icon-down-open-2">
                              </i>
                           </a>
                           <a class="widget-close" href="#">
                              <i class="icon-cancel-3">
                              </i>
                           </a>
                        </div>
                     </div>
                     <div class="widget-content padding">
                        <div class="col-md-12">
                           <div class="widget bg-white">
                              <div class="widget-body">
                                 <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/111053/3266484/4/di-depan-petinggi-negara-islam-jokowi-2016-tahun-penuh-tantangan" target="_blank" title="Di Depan Petinggi Negara Islam, Jokowi: 2016 Tahun Penuh Tantangan">Di Depan Petinggi Negara Islam, Jokowi: 2016 Tahun Penuh Tantangan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/02/d5f7793c-230d-4bc7-ae46-6f38e46db8ff_169.jpg" align="left" hspace="7" width="100" />Dalam sambutannya, Jokowi menyinggung soal krisis ekonomi global 2008 dan tantangan ekonomi. Jokowi menilai, tahun ini sebagai tahun yang penuh tantangan.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/110026/3266478/459/mimpi-pertamina-jadi-perusahaan-kelas-dunia" target="_blank" title="Mimpi Pertamina Jadi Perusahaan Kelas Dunia">Mimpi Pertamina Jadi Perusahaan Kelas Dunia</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/01/91d2a381-1a67-4b6c-8160-03f2e6fc56ad.jpg" align="left" hspace="7" width="100" />Tak ada kata terlambat bagi Direktur Utama PT Pertamina, Dwi Soetjipto, untuk membangun Pertamina menjadi perusahaan energi berskala global.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/104008/3266458/4/jokowi-buka-pertemuan-petinggi-negara-islam-di-senayan" target="_blank" title="Jokowi Buka Pertemuan Petinggi Negara Islam di Senayan">Jokowi Buka Pertemuan Petinggi Negara Islam di Senayan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/08/02/d5f7793c-230d-4bc7-ae46-6f38e46db8ff.jpg" align="left" hspace="7" width="100" />Delapan Kepala Negara beserta Menteri dari 18 Negara Islam hadir dalam perhelatan akbar bertajuk 12 th World Islamic Economic Forum (WIEF).</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/102823/3266448/4/3-menteri-merapat-ke-kantor-darmin-bahas-paket-kebijakan" target="_blank" title="3 Menteri Merapat ke Kantor Darmin, Bahas Paket Kebijakan">3 Menteri Merapat ke Kantor Darmin, Bahas Paket Kebijakan</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/07/18/ac3610c9-0d7a-42cb-8a83-178d0859ee5f.jpg" align="left" hspace="7" width="100" />Rapat membahas implementasi dari paket-paket ekonomi jilid I hingga XII yang telah dikeluarkan pemerintah sejak Oktober 2015.</p>
                                       <hr/>
                                                                              <p><strong><a href="http://finance.detik.com/read/2016/08/02/102324/3266446/4/harga-emas-antam-naik-rp-2000-gram" target="_blank" title="Harga Emas Antam Naik Rp 2.000/Gram">Harga Emas Antam Naik Rp 2.000/Gram</a></strong><br />
                                       <small><em>Posted on Tuesday August 02, 2016</em></small></p>
                                       <p><img src="http://images.detik.com/visual/2016/07/28/52585041-6d00-4e2d-a06f-ca20024021ac_169.jpg" align="left" hspace="7" width="100" />Harga Logam Mulia milik PT Aneka Tambang Tbk (Antam) hari ini dibuka naik di Rp 2.000/gram, sementara harga buyback juga dibuka naik Rp 2.000/gram.</p>
                                       <hr/>
                                                                           </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 portlets">
                  <div class="widget">
                     <div class="widget-header transparent">
                        <h2>
                           <strong>
                              Online Trading
                           </strong>
                           Platform
                        </h2>
                        <div class="additional-btn">
                           <a class="hidden reload" href="#">
                              <i class="icon-ccw-1">
                              </i>
                           </a>
                           <a class="hidden" data-toggle="dropdown" id="dropdownMenu1">
                              <i class="fa fa-cogs">
                              </i>
                           </a>
                           <ul aria-labelledby="dropdownMenu1" class="dropdown-menu pull-right" role="menu">
                              <li>
                                 <a href="#">
                                    Action
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    Another action
                                 </a>
                              </li>
                              <li>
                                 <a href="#">
                                    Something else here
                                 </a>
                              </li>
                              <li class="divider">
                              </li>
                              <li>
                                 <a href="#">
                                    Separated link
                                 </a>
                              </li>
                           </ul>
                           <a class="widget-popout hidden tt" href="#" title="Pop Out/In">
                              <i class="icon-publish">
                              </i>
                           </a>
                           <a class="widget-maximize hidden" href="#">
                              <i class="icon-resize-full-1">
                              </i>
                           </a>
                           <a class="widget-toggle" href="#">
                              <i class="icon-down-open-2">
                              </i>
                           </a>
                           <a class="widget-close" href="#">
                              <i class="icon-cancel-3">
                              </i>
                           </a>
                        </div>
                     </div>
                     <div class="widget-content">
                        <div class="gallery-wrap">
                           <div class="column1">
                              <div class="inner">
                                 <a href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img alt="Please click here for download" class="mfp-fade" src="images/metatrader/mt4_logo_white.jpg" title="MetaTrader 4">
                                       </img>
                                    </div>
                                    <div class="caption-hover">
                                       Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                              <div class="inner">
                                 <a href="http://panendollar.com/" target="_new" title="The Art of Money Maker">
                                    <div class="img-wrap">
                                       <img alt="Image gallery" class="mfp-fade" src="images/thecabinet/education.jpg" title="Education" width="50%">
                                       </img>
                                    </div>
                                    <div class="caption-hover">
                                       Click Here to download Demo
                                    </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="https://twofrx.com/" target="_new" title="Two Forex">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/twofrx.png" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Two Forex
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="#" target="_new" title="The Art of Money Maker">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/copytrade.png" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Copytrade
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-sm-4">
                  <div align="center" class="widget ">
                     <div class="gallery-wrap">
                        <div class="column1">
                           <div class="inner">
                              <a href="http://www.askapimperium.com/" target="_new" title="Askap Futurus">
                                 <div class="img-wrap">
                                    <img alt="Image gallery" src="images/thecabinet/askapnew.jpg" title="Education">
                                    </img>
                                 </div>
                                 <div class="caption-hover">
                                    Askap Imperium
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="grid-custom">
               <div class="row ">
                  <div class="row col-sm-6">
                     <div class="col-sm-12">
                        <img alt="" class="img-responsive" src="images/thecabinet/edu.png"/>
                     </div>
                     <div class="col-sm-12">
                        <!-- <img src="http://placehold.it/600x195/2ecc71/fff" alt="" class="img-responsive"> -->
                        <div class="row nopadding">
                           <div class="col-sm-6">
                              <img alt="" class="img-responsive" src="images/thecabinet/ea.png">
                              </img>
                           </div>
                           <div class="col-sm-6">
                              <img alt="" class="img-responsive" src="images/thecabinet/indikator.png">
                              </img>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row col-sm-6">
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/book.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/analisa.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/produk.png"/>
                     </div>
                     <div class="col-xs-6">
                        <img alt="" class="img-responsive" src="images/thecabinet/seminar.png"/>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <script src="assets/libs/d3/d3.v3.js">
   </script>
   <script src="assets/libs/rickshaw/rickshaw.min.js">
   </script>
   <script src="assets/libs/raphael/raphael-min.js">
   </script>
   <script src="assets/libs/morrischart/morris.min.js">
   </script>
   <script src="assets/libs/jquery-knob/jquery.knob.js">
   </script>
   <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
   </script>
   <script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
   </script>
   <script src="assets/libs/jquery-clock/clock.js">
   </script>
   <script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
   </script>
   <script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
   </script>
   <script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
   </script>
   <script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
   </script>
   <script src="assets/js/apps/calculator.js">
   </script>
   <script src="assets/js/apps/todo.js">
   </script>
   <script src="assets/js/apps/notes.js">
   </script>
   <script src="assets/js/pages/index.js">
   </script>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js">
</script>
<!-- Page Specific JS Libraries -->
<script src="assets/libs/jquery-blockui/jquery.blockUI.js">
</script>
<script src="assets/libs/d3/d3.v3.js">
</script>
<script src="assets/libs/rickshaw/rickshaw.min.js">
</script>
<script src="assets/libs/raphael/raphael-min.js">
</script>
<script src="assets/libs/morrischart/morris.min.js">
</script>
<script src="assets/libs/jquery-knob/jquery.knob.js">
</script>
<script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-1.2.2.min.js">
</script>
<script src="assets/libs/jquery-jvectormap/js/jquery-jvectormap-us-aea-en.js">
</script>
<script src="assets/libs/jquery-clock/clock.js">
</script>
<script src="assets/libs/jquery-easypiechart/jquery.easypiechart.min.js">
</script>
<script src="assets/libs/jquery-weather/jquery.simpleWeather-2.6.min.js">
</script>
<script src="assets/libs/bootstrap-xeditable/js/bootstrap-editable.min.js">
</script>
<script src="assets/libs/bootstrap-calendar/js/bic_calendar.min.js">
</script>
<script src="assets/js/apps/calculator.js">
</script>
<script src="assets/js/apps/todo.js">
</script>
<script src="assets/js/apps/notes.js">
</script>
<script src="assets/js/pages/index.js">
</script>
<script src="assets/libs/fullcalendar/fullcalendar.min.js">
</script>
<script src="assets/js/pages/calendar.js">
</script>

                                                
                                                <!-- /END OF CONTENT -->
                                                <!-- Footer Sidebar Start -->
                                                <!-- Footer Start -->
<footer>
    Copyright AgendaFX, 2016
    <div class="footer-links pull-right">
        <a href="http://thecabinetsystems.com/" target="_new">AgendaFX</a>
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
                                          action="email_admin.php?postmode=emailtoadmin&tradedby=reza@thecabinetsystems.com">
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
                                                <p class="help-block">We will reply to reza@thecabinetsystems.com</p>
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