<?php /* Smarty version 3.1.27, created on 2016-08-29 07:49:31
         compiled from "/root/project/cabinet-stable/web2/templates/imp_mall.htm" */ ?>
<?php
/*%%SmartyHeaderCode:179435696257c3869b21dbe6_80554584%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c631d8f3c1c4c425a3d8019c015113605aab2d6' => 
    array (
      0 => '/root/project/cabinet-stable/web2/templates/imp_mall.htm',
      1 => 1472441354,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '179435696257c3869b21dbe6_80554584',
  'variables' => 
  array (
    'row' => 0,
    'token' => 0,
    'product_list' => 0,
    'i' => 0,
    'base_url' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57c3869b258dd8_73194810',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57c3869b258dd8_73194810')) {
function content_57c3869b258dd8_73194810 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '179435696257c3869b21dbe6_80554584';
?>
<div class="content" id="main_content">
    <!-- Modal -->
    <div aria-labelledby="myModalLabel" class="modal fade" id="myModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Nama Product
                    </h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                    <legend>Data Publisher</legend>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">
                                Nama
                            </label>
                            <div class="col-sm-10">
                                <p class="form-control-static" id="name">Nama</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">
                                Email
                            </label>
                            <div class="col-sm-10">
                              <p class="form-control-static" id="email">Email</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">
                                Phone
                            </label>
                            <div class="col-sm-10">
                              <p class="form-control-static" id="telphone_number">0857125</p>
                            </div>
                        </div>
                        <input type="hidden" name="aidi" id="aidi" value="100"></input>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="pwd">
                                Desc
                            </label>
                            <div class="col-sm-10">
                              <p class="form-control-static text-justify">-</p>
                            </div>
                            <!-- <button class="btn btn-success" name="approve" onclick="imp_mall_JS.approved('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
')">
                                                    Approv
                                                </button>
                                                <button class="btn btn-danger" name="approve" onclick="imp_mall_JS.reject('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
')">
                                                    Reject
                                                </button> -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default" data-dismiss="modal" type="button">
                        Close
                    </button>
                    <button class="btn btn-danger" type="button" onclick="imp_mall_JS.reject(aidi.value, this)">
                        Reject
                    </button>
                    <button class="btn btn-primary" type="button" onclick="imp_mall_JS.approved(aidi.value, this)">
                        Approved
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- validator -->
    <link href="custom/validator/dist/css/formValidation.min.css" rel="stylesheet">
        <!-- Sweat Alert -->
        <?php echo '<script'; ?>
 src="custom/sweetalert/dist/sweetalert-dev.js">
        <?php echo '</script'; ?>
>
        <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet">
            <style type="text/css">
                p.separator {
   background: #363435 none repeat scroll 0 0;
   height: 10px;
   }
   .must {
   color: red;
   font-size: 11px;
   }
   label{
   cursor:pointer
   }
   /*   h2{
   border-width:1px!important;
   font-size:14px;
   text-align:center;
   }*/
   table.risk td{
   border:1px solid #ccc;
   padding:10px
   }
   .just{
   text-align:justify;
   border-bottom:none!important;
   }
   .notop{
   border-top:none!important;
   }
   .right{
   text-align:right;
   font-weight:bold;
   padding:5px 10px!important;
   }
   td.tick,td.tickall{
   width:10px;
   padding:5px 10px!important;
   cursor:pointer;
   }
   td.tickall{
   cursor:default;
   }
   td p{
   margin-top:5px;
   margin-bottom:0px;
   margin-left:16px;
   }
   ol{
   padding-left:18px
   }
            </style>
            <link href="custom/sweetalert/dist/sweetalert.css" rel="stylesheet">
                <!-- Page Heading Start -->
                <div class="page-heading">
                    <h1>
                        <i class="icon-user-3">
                        </i>
                        Product Confirmation
                    </h1>
                </div>
                <!-- Page Heading End-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="widget">
                            <div class="widget-header ">
                                <h2>
                                    <strong>
                                        Product
                                    </strong>
                                    Confirmation
                                </h2>
                                <div class="additional-btn">
                                    <a class="widget-toggle" href="#">
                                        <i class="icon-down-open-2">
                                        </i>
                                    </a>
                                </div>
                            </div>
                            <br/>
                            <div class="widget-content padding">
                                <form>
                                    <input name="token" type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
"/>
                                </form>
                                <table class="table table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th>
                                                No.
                                            </th>
                                            <th>
                                                Product
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Commision
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($_smarty_tpl->tpl_vars["i"])) {$_smarty_tpl->tpl_vars["i"] = clone $_smarty_tpl->tpl_vars["i"];
$_smarty_tpl->tpl_vars["i"]->value = 1; $_smarty_tpl->tpl_vars["i"]->nocache = null; $_smarty_tpl->tpl_vars["i"]->scope = 0;
} else $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable(1, null, 0);?>
                  <?php
$_from = $_smarty_tpl->tpl_vars['product_list']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['row'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['row']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->_loop = true;
$foreach_row_Sav = $_smarty_tpl->tpl_vars['row'];
?>
                                        <tr>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['i']->value;?>

                                            </td>
                                            <td>
                                                <a href="<?php echo $_smarty_tpl->tpl_vars['base_url']->value;?>
/c/<?php echo $_smarty_tpl->tpl_vars['row']->value['cat_name'];?>
/<?php echo $_smarty_tpl->tpl_vars['row']->value['prod_name'];?>
" target="_blank">
                                                    <?php echo $_smarty_tpl->tpl_vars['row']->value['prod_alias'];?>

                                                </a>
                                            </td>
                                            <td>
                                                <?php echo number_format($_smarty_tpl->tpl_vars['row']->value['prod_price'],0);?>

                                            </td>
                                            <td>
                                                <?php echo $_smarty_tpl->tpl_vars['row']->value['comm'];?>
%
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" id="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" data-target="#myModal" data-toggle="modal" name="view" data-idnya="<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
" onclick="imp_mall_JS.view_data('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
')" type="button">
                                                    View
                                                </button>
                                                <!-- <button class="btn btn-success" name="approve" onclick="imp_mall_JS.approved('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
')">
                                                    Approv
                                                </button>
                                                <button class="btn btn-danger" name="approve" onclick="imp_mall_JS.reject('<?php echo $_smarty_tpl->tpl_vars['row']->value['id'];?>
')">
                                                    Reject
                                                </button> -->
                                            </td>
                                        </tr>
                                        <?php if (isset($_smarty_tpl->tpl_vars["i"])) {$_smarty_tpl->tpl_vars["i"] = clone $_smarty_tpl->tpl_vars["i"];
$_smarty_tpl->tpl_vars["i"]->value = $_smarty_tpl->tpl_vars['i']->value+1; $_smarty_tpl->tpl_vars["i"]->nocache = null; $_smarty_tpl->tpl_vars["i"]->scope = 0;
} else $_smarty_tpl->tpl_vars["i"] = new Smarty_Variable($_smarty_tpl->tpl_vars['i']->value+1, null, 0);?>
                  <?php
$_smarty_tpl->tpl_vars['row'] = $foreach_row_Sav;
}
?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </link>
        </link>
    </link>
</div>
<?php echo '<script'; ?>
 src="custom/js/imp_mall.js" type="text/javascript">
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function() {
      imp_mall_JS.init();
      // $('table').on('click','button',function(e){
      //   e.preventDefault();
      //   $(this).closest('tr').remove();
      // });
   });
<?php echo '</script'; ?>
>

<!-- FormValidation plugin and the class supports validating Bootstrap form -->
<?php }
}
?>