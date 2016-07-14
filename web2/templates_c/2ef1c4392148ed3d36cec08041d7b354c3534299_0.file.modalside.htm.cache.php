<?php /* Smarty version 3.1.27, created on 2016-07-13 15:50:34
         compiled from "D:\web-dir\cabinet\web2\templates\modalside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:2229578600da5cb2d8_80514476%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2ef1c4392148ed3d36cec08041d7b354c3534299' => 
    array (
      0 => 'D:\\web-dir\\cabinet\\web2\\templates\\modalside.htm',
      1 => 1440735994,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2229578600da5cb2d8_80514476',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_578600da6ab581_44480978',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_578600da6ab581_44480978')) {
function content_578600da6ab581_44480978 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2229578600da5cb2d8_80514476';
?>

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
<?php }
}
?>