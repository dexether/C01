<?php
/*%%SmartyHeaderCode:1776157a0237bdbc318_13828056%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b4844a9d586fc7ac55b070ea54d73dbde712b08' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\leftside.htm',
      1 => 1468493004,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1776157a0237bdbc318_13828056',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'alldatas' => 0,
    'user' => 0,
    'menu' => 0,
    'database_ips' => 0,
    'database_ip' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57a0237c28d7b8_58706786',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57a0237c28d7b8_58706786')) {
function content_57a0237c28d7b8_58706786 ($_smarty_tpl) {
?>

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
<!-- Left Sidebar End --><?php }
}
?>