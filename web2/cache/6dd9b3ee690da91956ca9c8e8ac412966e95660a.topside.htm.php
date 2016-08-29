<?php
/*%%SmartyHeaderCode:99253209857c39fdd91f264_74876484%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6dd9b3ee690da91956ca9c8e8ac412966e95660a' => 
    array (
      0 => '/home/theprogrammer/project/cabinet-stable/web2/templates/topside.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '99253209857c39fdd91f264_74876484',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'url' => 0,
    'logonya' => 0,
    'user' => 0,
    'fotonya' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c39fdd92afc0_25572633',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c39fdd92afc0_25572633')) {
function content_57c39fdd92afc0_25572633 ($_smarty_tpl) {
?>
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
				<a href="http://agendafx.com/"><img src="templates/home_03/logo.png" 
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
							Login as <br />
<b>Notice</b>:  Trying to get property of non-object in <b>/home/theprogrammer/project/cabinet-stable/web2/templates_c/6dd9b3ee690da91956ca9c8e8ac412966e95660a_0.file.topside.htm.cache.php</b> on line <b>85</b><br />
 </a></li>
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
<script src="custom/js/autoload_noty.js"></script><?php }
}
?>