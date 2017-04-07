<?php
add_js(base_url('assets/js/dashboard-user.js'));
?>
<div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class="col-lg-2" id="user-sidebar">
            <a href="/product/new/?from=user_dashboard" class="btn btn-block btn-primary btn-outline">Jual Barang</a>
            <nav class="nav-left" >
                <ul class="nav-left-list">
                    <li class="nav-left-item <?= ($du_menu === 'du_dashbard') ? 'active' : ''; ?>"><a href="<?= base_url('account'); ?>">Ringkasan Akun</a></li>
                    <li class="nav-left-item"><a href="#">Barang Dijual</a></li>
                    <li class="nav-left-item"><a href="#">Barang Tidak Dijual</a></li>
                    <li class="nav-left-item"><a href="#">Barang Draf</a></li>
                    <li class="nav-left-item"><a href="#">Label Barang</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item"><a href="#">Barang Favorit</a></li>
                    <li class="nav-left-item"><a href="#">langganan</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item <?= ($du_menu === 'du_transaction') ? 'active' : ''; ?>"><a href="/payment/invoices">Transaksi</a></li>
                    <li class="nav-left-item"><a href="#">Feedback</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item"><a href="#">Pesan</a></li>
                    <li class="nav-left-item <?= ($du_menu === 'du_config') ? 'active' : ''; ?>"><a href="/account/setting">Pengaturan</a></li>
                    <li></li>
                </ul>
            </nav>
        </div>
        <div class="col-lg-10">
            <div class="content-dashboard">
                <?php echo (isset($contentDashboard)) ? $this->load->view($contentDashboard) : ""; ?>
            </div>
        </div>
      </div>
    </div>
</div>
