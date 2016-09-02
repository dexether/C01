<?php /* Smarty version 3.1.27, created on 2016-09-02 08:21:45
         compiled from "/var/www/cabinet-stable/web2/templates/index.htm" */ ?>
<?php
/*%%SmartyHeaderCode:161814338457c8d4298db8b7_86697350%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a8cc98464f4df376b0213452b24585bb880d07b9' => 
    array (
      0 => '/var/www/cabinet-stable/web2/templates/index.htm',
      1 => 1472724567,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '161814338457c8d4298db8b7_86697350',
  'variables' => 
  array (
    'companys' => 0,
    'target' => 0,
    'redirect' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c8d42990c886_69370303',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c8d42990c886_69370303')) {
function content_57c8d42990c886_69370303 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '161814338457c8d4298db8b7_86697350';
?>
<!DOCTYPE html> 
<html lang="en">
    <head> 

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>
</title>
        <meta name="description" content="">
        <meta name="keywords" content="Komoditas,Commodity,Multilateral,Pasar,Market,Berjangka,Derivatives,Futures">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Favicons -->
        <!-- <link rel="stylesheet" type="text/css" href="custom/css/login.css"/> -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="script1/assets-minified/images/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="script1/assets-minified/images/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="script1/assets-minified/images/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="script1/assets-minified/images/icons/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['companys']->value['company_icon'];?>
">
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />



        <!-- JS Core -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/js-core.js"><?php echo '</script'; ?>
>
        
        <?php echo '<script'; ?>
 language="javascript" type="text/javascript">
            function windowClose() {
                //alert("Hi");
                window.open('', '_parent', '');
                window.close();
            }
        <?php echo '</script'; ?>
>
        

        <?php echo '<script'; ?>
 type="text/javascript">
            $(window).load(function() {
                setTimeout(function() {
                    $('#loading').fadeOut(400, "linear");
                }, 300);
            });
        <?php echo '</script'; ?>
>
        
        <style>
            #loading {position: fixed;width: 100%;height: 100%;left: 0;top: 0;right: 0;bottom: 0;display: block;background: #fff;z-index: 10000;}
            #loading img {position: absolute;top: 50%;left: 50%;margin: -23px 0 0 -23px;}
        </style>



        <!-- HELPERS -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/helpers/helpers-all.css">

        <!-- ELEMENTS -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/elements/elements-all.css">

        <!-- Icons -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/icons/fontawesome/fontawesome.css">
        <link rel="stylesheet" type="text/css" href="script1/assets-minified/icons/linecons/linecons.css">

        <!-- SNIPPETS -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/snippets/snippets-all.css">

        <!-- APPLICATIONS -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/applications/mailbox.css">



        <!-- Admin Theme -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/themes/supina/layout.css">
        <link id="layout-color" rel="stylesheet" type="text/css" href="script1/assets-minified/themes/supina/default/layout-color.css">
        <link id="framework-color" rel="stylesheet" type="text/css" href="script1/assets-minified/themes/supina/default/framework-color.css">
        <link rel="stylesheet" type="text/css" href="script1/assets-minified/themes/supina/border-radius.css">

        <!-- Color Helpers CSS -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/helpers/colors.css">

    </head> 
    <body>
        <div id="loading"><img src="script1/assets-minified/images/spinner/loader-dark.gif" alt="Loading..."></div>
        
        <style type="text/css">

            body {
                background: url(images/big/allpeople.jpg) no-repeat center center fixed; 
                /*background: blue;*/
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-color: #fff;
            }

        </style>
        
        <div class="center-vertical">
            <div class="center-content">

                <div class="col-md-6 clearfix center-margin">

                    <!--
                    <form method="post" action="login.php" target="_blank" onClick="javascript:window.close();">
                    -->
                    <form method="post" action="login.php" target="<?php echo $_smarty_tpl->tpl_vars['target']->value;?>
" >
                        <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['redirect']->value;?>
" name="redirect"></input>
                        <div class="content-box">   
                            <h3 class="content-box-header content-box-header-alt bg-default">
                                <span class="icon-separator">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['companys']->value['company_icon'];?>
" alt="MT <?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>
" class="img-responsive">
                                </span>
                                <div class="header-wrapper">
                                    <?php echo $_smarty_tpl->tpl_vars['companys']->value['programname'];?>

                                    <small>&nbsp</small>
                                </div>
                            </h3>
                            <div class="content-box-wrapper">
                                <div class="form-group"> 
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="login_user" name='login_user' placeholder="Please fill in your email">
                                        <span class="input-group-addon bg-blue">
                                            <i class="glyph-icon icon-envelope-o"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="login_password" name='login_password' placeholder="Please Fill in your Password">
                                        <span class="input-group-addon bg-blue">
                                            <i class="glyph-icon icon-unlock-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <button class="btn btn-md btn-primary" >Next</button>

                                <!--
                                <button class="btn btn-success btn-block" onclick="windowClose();">Login</button>
                                -->
                                <br>
                                <br>
                                <?php if ($_smarty_tpl->tpl_vars['target']->value == '_self') {?>
                                <input style="float: center;" class="btn btn-info"  type="button" value="Self Reset Password" onclick="window.open('forgetpassword.php','_self')" />
                                
                                <input style="float: center;" class="btn btn-info"  type="button" value="First time Login?" onclick="window.open('openaccount.php?cabang=1','_self')" />
                                
                                <?php } else { ?>
                                <input style="float: center;" class="btn btn-info"  type="button" value="Self Reset Password" onclick="window.open('forgetpassword.php')" />
                                
                                <input style="float: center;" class="btn btn-info"  type="button" value="First time Login?" onclick="window.open('openaccount.php?cabang=1')" />
                                
                                <?php }?>
                                <small>
                                    <dt>Have you forgotten your password?</dt> 
                                    <p>You can reset your password anytime by yourself by clicking the <b>"Self Reset Password"</b> button</p></small>
                            </div>

                        </div>

                    </form>




                </div>

            </div>
        </div>




        <!-- WIDGETS -->



        <!-- WIDGETS -->

        <!-- Bootstrap Dropdown -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/dropdown/dropdown.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/dropdown/dropdown.js"><?php echo '</script'; ?>
>

        <!-- PieGage charts -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/charts/piegage/piegage.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/charts/piegage/piegage.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/charts/piegage/piegage-demo.js"><?php echo '</script'; ?>
>

        <!-- Bootstrap Tooltip -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/tooltip/tooltip.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/tooltip/tooltip.js"><?php echo '</script'; ?>
>

        <!-- Bootstrap Popover -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/popover/popover.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/popover/popover.js"><?php echo '</script'; ?>
>


        <!-- Bootstrap Buttons -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/button/button.js"><?php echo '</script'; ?>
>

        <!-- Bootstrap Collapse -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/collapse/collapse.js"><?php echo '</script'; ?>
>

        <!-- Bootstrap Progress Bar -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/progressbar/progressbar.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/progressbar/progressbar.js"><?php echo '</script'; ?>
>

        <!-- Uniform -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/uniform/uniform.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/uniform/uniform.js"><?php echo '</script'; ?>
>

        <!-- Chosen -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/chosen/chosen.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/chosen/chosen.js"><?php echo '</script'; ?>
>

        <!-- Superfish -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/superfish/superfish.js"><?php echo '</script'; ?>
>

        <!-- Superclick -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/superclick/superclick.js"><?php echo '</script'; ?>
>

        <!-- Nice scroll -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/nicescroll/nicescroll.js"><?php echo '</script'; ?>
>

        <!-- Overlay -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/overlay/overlay.js"><?php echo '</script'; ?>
>

        <!-- jQueryUI Autocomplete -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/autocomplete/autocomplete.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/autocomplete/menu.js"><?php echo '</script'; ?>
>

        <!-- Skycons -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/skycons/skycons.js"><?php echo '</script'; ?>
>

        <!-- Content box -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/content-box/contentbox.js"><?php echo '</script'; ?>
>

        <!-- Bootstrap Tabs -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/tabs/tabs.js"><?php echo '</script'; ?>
>

        <!-- Sparklines charts -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/charts/sparklines/sparklines.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/charts/sparklines/sparklines-demo.js"><?php echo '</script'; ?>
>

        <!-- Slidebars -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/slidebars/slidebars.css">
        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets/slidebars/slidebars.js"><?php echo '</script'; ?>
>

        <!-- Widgets init for demo -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/widgets-init.js"><?php echo '</script'; ?>
>

        <!-- Theme layout -->

        <?php echo '<script'; ?>
 type="text/javascript" src="script1/assets-minified/themes/supina/js/layout.js"><?php echo '</script'; ?>
>






    </body>
</html>
<?php }
}
?>