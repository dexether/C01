<?php /* Smarty version 3.1.27, created on 2016-07-26 10:04:49
         compiled from "D:\web-dir\git\cabinet\web2\templates\ar_email_admin.htm" */ ?>
<?php
/*%%SmartyHeaderCode:279695796d3516c5a06_46624511%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '058f6b3bc54641176c3b4446eff01f3198a1cc6d' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\ar_email_admin.htm',
      1 => 1469501489,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '279695796d3516c5a06_46624511',
  'variables' => 
  array (
    'token' => 0,
    'view' => 0,
    'i' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5796d35182f7e4_70053419',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5796d35182f7e4_70053419')) {
function content_5796d35182f7e4_70053419 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '279695796d3516c5a06_46624511';
?>
<link rel="stylesheet" href="assets/libs/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
<?php echo '<script'; ?>
 type="text/javascript" src="assets/libs/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"><?php echo '</script'; ?>
>

<link href="assets/libs/summernote/summernote.css" rel="stylesheet" type="text/css" />
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

<div id="main_content" class="content">
	`
	<div class="page-heading">
		<h1>&nbsp;&nbsp;<i class="fa fa-envelope">&nbsp;&nbsp;</i>Admin Announcement</h1>           	
	</div>


	<div class="row">
		<div class="col-md-12">
			<div class="widget">
				<div class="widget-content padding">
				<div class="alert alert-danger" hidden id="ajax-error">
					<p>Error Found :</p>
					<ul class="ajax-error-msg">
						<!-- <li>Test</li> -->
					</ul>
				</div>
				<div class="alert alert-success" hidden id="ajax-success">
					<p>Success :</p>
					<ul class="ajax-success-msg">
						<!-- <li>Test</li> -->
					</ul>
				</div>
					<form role="form" class="form-horizontal" id='formnya'>
						<input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"></input>
						<div class="form-group">
							<label class="control-label col-sm-2">To:</label>
							<div class="col-sm-10">
								<div class="example">
									<?php echo '<script'; ?>
 type="text/javascript">
										$(document).ready(function() {
											$('#example-large-includeSelectAllOption-enableFiltering').multiselect({
												maxHeight: 200,
												includeSelectAllOption: true,
												enableFiltering: true
											});
										});
									<?php echo '</script'; ?>
>
									<select id="example-large-includeSelectAllOption-enableFiltering" multiple="multiple" name="emails[]">
										<?php
$_from = $_smarty_tpl->tpl_vars['view']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['i']->_loop = false;
$_smarty_tpl->tpl_vars['view'] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars['view']->value => $_smarty_tpl->tpl_vars['i']->value) {
$_smarty_tpl->tpl_vars['i']->_loop = true;
$foreach_i_Sav = $_smarty_tpl->tpl_vars['i'];
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['i']->value['email'];?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value['email'];?>
</option>
										<?php
$_smarty_tpl->tpl_vars['i'] = $foreach_i_Sav;
}
?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Subject:</label>
							<div class="col-sm-10">
								<input type="text" name="subject" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2">Announcement:</label>
							<div class="col-sm-10">
								<textarea class="smallnya" name="body"></textarea>
							</div>
						</div>
						
						<div class="row">
							<label class="control-label col-sm-2"></label>
							<div class="col-xs-8">
								<button type="button" class="btn btn-success" name="ajax-button" id="ajax-button">
									<i class="icon-paper-plane-1"></i> Send</button>
									<!-- <button type="submit" class="btn btn-danger">Save</button> -->
								</div>

							</div>	
						</form>
					</div>
				</div>

			</div>
		</div>  
	</div>

	<?php echo '<script'; ?>
 src="assets/libs/pace/pace.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="assets/libs/summernote/summernote.js"><?php echo '</script'; ?>
>
	<!-- <?php echo '<script'; ?>
 src="assets/js/pages/new-message.js"><?php echo '</script'; ?>
> -->

	
	<?php echo '<script'; ?>
 src="custom/js/ar_email_admin.js" type="text/javascript"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		jQuery(document).ready(function() {
			announcementJS.init();
			$('button[name=ajax-button]').click(function(event) {
				/* Act on the event */
										// console.log('Clicked')
										var data = $('form[id=formnya]').serializeArray();
										var textareaValue = $(".smallnya").code();
										data.push({name: 'bodyisi', value: textareaValue});

										
										announcementJS.announcement(data);
										
									});

		});

	<?php echo '</script'; ?>
>

	<?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/notify.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="assets/libs/jquery-notifyjs/styles/metro/notify-metro.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="custom/js/noty_general.js"><?php echo '</script'; ?>
>
	

	
	<?php echo '<script'; ?>
>
		$('.smallnya').summernote({
			toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']]
			],
			height: 200
		});
	<?php echo '</script'; ?>
>
	
<?php }
}
?>