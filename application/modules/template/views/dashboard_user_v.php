<div class="columns-container">
    <div class="container" id="columns">
      <div class="row">
        <div class="col-lg-2" id="user-sidebar">
            <nav class="nav-left" >
                <ul class="nav-left-list">
                    <li class="nav-left-item active"><a href="#">Ringkasan Akun</a></li>
                    <li class="nav-left-item"><a href="#">Barang Dijual</a></li>
                    <li class="nav-left-item"><a href="#">Barang Tidak Dijual</a></li>
                    <li class="nav-left-item"><a href="#">Barang Draf</a></li>
                    <li class="nav-left-item"><a href="#">Label Barang</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item"><a href="#">Barang Favorit</a></li>
                    <li class="nav-left-item"><a href="#">langganan</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item"><a href="#">Transaksi</a></li>
                    <li class="nav-left-item"><a href="#">Feedback</a></li>
                    <li class="nav-left-divider"></li>
                    <li class="nav-left-item"><a href="#">Pesan</a></li>
                    <li class="nav-left-item"><a href="#">Pengaturan</a></li>
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
