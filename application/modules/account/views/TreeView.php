<?php
add_js(base_url("web2/custom/treview/src/easyTree.js"));
add_js(base_url("assets/js/dashboard/treeview.js"));
?>
<style media="screen">
  .easy-tree ul , li{
    padding: 100 ;
  },
  ul {
    padding-left: 200px !important;
  },
  li {
    padding: 200px !important;
  }
</style>
<link rel="stylesheet" href="<?= base_url("web2/custom/treview/css/easyTree.css") ?>">
<div class="row">
<div class="col-md-12">
    <!-- Nav tabs -->
    <h1 class="transaction">TreeView</h1>
    <div class="card">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#rekening" aria-controls="penjualan" role="tab" data-toggle="tab">Tree</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="rekening">
              <div class="easy-tree">
                <?php echo $treeviews ?>
              </div>
            </div>
        </div>
    </div>
    </div>
</div>
