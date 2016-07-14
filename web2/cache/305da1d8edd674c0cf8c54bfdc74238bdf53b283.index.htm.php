<?php
/*%%SmartyHeaderCode:2254757876e1a4d6015_41246311%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '305da1d8edd674c0cf8c54bfdc74238bdf53b283' => 
    array (
      0 => 'D:\\web-dir\\git\\cabinet\\web2\\templates\\index.htm',
      1 => 1468493336,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2254757876e1a4d6015_41246311',
  'tpl_function' => 
  array (
  ),
  'variables' => 
  array (
    'companys' => 0,
    'target' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57876e1a7f7eb8_01309320',
  'cache_lifetime' => 120,
),true);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57876e1a7f7eb8_01309320')) {
function content_57876e1a7f7eb8_01309320 ($_smarty_tpl) {
?>
<!DOCTYPE html> 
<html lang="en">
    <head> 

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>The Cabinet Systems</title>
        <meta name="description" content="">
        <meta name="keywords" content="Komoditas,Commodity,Multilateral,Pasar,Market,Berjangka,Derivatives,Futures">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Favicons -->
        <!-- <link rel="stylesheet" type="text/css" href="custom/css/login.css"/> -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="script1/assets-minified/images/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="script1/assets-minified/images/icons/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="script1/assets-minified/images/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="script1/assets-minified/images/icons/apple-touch-icon-57-precomposed.png">
        <link rel="shortcut icon" href="templates/home_03/faicon.png">
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />



        <!-- JS Core -->

        <script type="text/javascript" src="script1/assets-minified/js-core.js"></script>
        
        <script language="javascript" type="text/javascript">
            function windowClose() {
                //alert("Hi");
                window.open('', '_parent', '');
                window.close();
            }
        </script>
        

        <script type="text/javascript">
            $(window).load(function() {
                setTimeout(function() {
                    $('#loading').fadeOut(400, "linear");
                }, 300);
            });
        </script>
        
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
                    <form method="post" action="login.php" target="_self" >
                        <div class="content-box">
                            <h3 class="content-box-header content-box-header-alt bg-default">
                                <span class="icon-separator">
                                    <img src="templates/home_03/faicon.png" alt="MT The Cabinet Systems" class="img-responsive">
                                </span>
                                <div class="header-wrapper">
                                    The Cabinet Systems
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
                                                                <input style="float: center;" class="btn btn-info"  type="button" value="Self Reset Password" onclick="window.open('forgetpassword.php','_self')" />
                                
                                <input style="float: center;" class="btn btn-info"  type="button" value="First time Login?" onclick="window.open('openaccount.php?cabang=1','_self')" />
                                
                                                                <small>
                                    <dt>Have you forgotten your password? ini contoh tamahan</dt> 
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
        <script type="text/javascript" src="script1/assets-minified/widgets/dropdown/dropdown.js"></script>

        <!-- PieGage charts -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/charts/piegage/piegage.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/charts/piegage/piegage.js"></script>
        <script type="text/javascript" src="script1/assets-minified/widgets/charts/piegage/piegage-demo.js"></script>

        <!-- Bootstrap Tooltip -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/tooltip/tooltip.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/tooltip/tooltip.js"></script>

        <!-- Bootstrap Popover -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/popover/popover.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/popover/popover.js"></script>


        <!-- Bootstrap Buttons -->

        <script type="text/javascript" src="script1/assets-minified/widgets/button/button.js"></script>

        <!-- Bootstrap Collapse -->

        <script type="text/javascript" src="script1/assets-minified/widgets/collapse/collapse.js"></script>

        <!-- Bootstrap Progress Bar -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/progressbar/progressbar.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/progressbar/progressbar.js"></script>

        <!-- Uniform -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/uniform/uniform.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/uniform/uniform.js"></script>

        <!-- Chosen -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/chosen/chosen.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/chosen/chosen.js"></script>

        <!-- Superfish -->

        <script type="text/javascript" src="script1/assets-minified/widgets/superfish/superfish.js"></script>

        <!-- Superclick -->

        <script type="text/javascript" src="script1/assets-minified/widgets/superclick/superclick.js"></script>

        <!-- Nice scroll -->

        <script type="text/javascript" src="script1/assets-minified/widgets/nicescroll/nicescroll.js"></script>

        <!-- Overlay -->

        <script type="text/javascript" src="script1/assets-minified/widgets/overlay/overlay.js"></script>

        <!-- jQueryUI Autocomplete -->

        <script type="text/javascript" src="script1/assets-minified/widgets/autocomplete/autocomplete.js"></script>
        <script type="text/javascript" src="script1/assets-minified/widgets/autocomplete/menu.js"></script>

        <!-- Skycons -->

        <script type="text/javascript" src="script1/assets-minified/widgets/skycons/skycons.js"></script>

        <!-- Content box -->

        <script type="text/javascript" src="script1/assets-minified/widgets/content-box/contentbox.js"></script>

        <!-- Bootstrap Tabs -->

        <script type="text/javascript" src="script1/assets-minified/widgets/tabs/tabs.js"></script>

        <!-- Sparklines charts -->

        <script type="text/javascript" src="script1/assets-minified/widgets/charts/sparklines/sparklines.js"></script>
        <script type="text/javascript" src="script1/assets-minified/widgets/charts/sparklines/sparklines-demo.js"></script>

        <!-- Slidebars -->

        <link rel="stylesheet" type="text/css" href="script1/assets-minified/widgets/slidebars/slidebars.css">
        <script type="text/javascript" src="script1/assets-minified/widgets/slidebars/slidebars.js"></script>

        <!-- Widgets init for demo -->

        <script type="text/javascript" src="script1/assets-minified/widgets-init.js"></script>

        <!-- Theme layout -->

        <script type="text/javascript" src="script1/assets-minified/themes/supina/js/layout.js"></script>






    </body>
</html>
<?php }
}
?>