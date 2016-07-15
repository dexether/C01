<?php /* Smarty version 3.1.27, created on 2016-07-15 17:52:24
         compiled from "D:\web-dir\git\cabinet\web2\templates\rightside.htm" */ ?>
<?php
/*%%SmartyHeaderCode:313265788c068ae02b3_68625736%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b9ee8caf1af0612042cd686780eca8607e90f2e' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\rightside.htm',
      1 => 1468493006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '313265788c068ae02b3_68625736',
  'variables' => 
  array (
    'actionemail' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5788c068c5f127_18799217',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5788c068c5f127_18799217')) {
function content_5788c068c5f127_18799217 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '313265788c068ae02b3_68625736';
?>
<!-- Right Sidebar Start -->

<?php echo '<script'; ?>
 language="javascript">
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
<?php echo '</script'; ?>
>

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
                                          action="<?php echo $_smarty_tpl->tpl_vars['actionemail']->value;?>
">
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
                                                <p class="help-block">We will reply to <?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
</p>
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



<?php echo '<script'; ?>
 src="assets/admin/pages/scripts/news_rss.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        MainRSS.init();
    });
<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="assets/libs/prettify/prettify.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="custom/js/jquery.validate.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="custom/js/bootstrapValidator.min.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="custom/js/email_admin.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
        EmailAdminVar.init();
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


<!-- End right content -->

<!-- Right Sidebar End -->
<?php }
}
?>