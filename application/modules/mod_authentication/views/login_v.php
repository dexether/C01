<div class="columns-container">
    <div class="container" id="columns">
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Authentication</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Buat Akun</h3>
                        <p>Mohon isi Form dibawah ini untuk mendaftar.</p>
                        <?php echo form_open('auth/signup'); ?>
                        <div class="form-group">
                          <label for="full_name">Nama Lengkap</label>
                          <input id="full_name" name="full_name" type="text" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('full_name') ?>">
                          <?php echo form_error('full_name', '<p class="text-danger text-bold">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="email">Alamat Email</label>
                          <input id="email" type="email" name="email" class="form-control" placeholder="email" value="<?= set_value('email') ?>">
                          <?php echo form_error('email', '<p class="text-danger text-bold">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="password">Kata Sandi</label>
                          <input id="password" type="password" name="password" class="form-control">
                          <?php echo form_error('password', '<p class="text-danger text-bold">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                          <label for="confirm_password">Ulangi Kata Sandi</label>
                          <input id="confirm_password" type="password" name="confirm_password" class="form-control">
                          <?php echo form_error('confirm_password', '<p class="text-danger text-bold">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                          <?php echo form_error('g-recaptcha-response', '<p class="text-danger text-bold">', '</p>'); ?>
                          <div class="g-recaptcha" data-sitekey="<?= $this->config->item('google_recaptcha_site_key') ?>"></div>
                        </div>
                        <button type="submit" class="button"><i class="fa fa-user"></i> Create an account</button>
                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                      <?php echo form_open('auth') ?>
                        <h3>Sudah punya akun AgendaFX?</h3>
                        <label for="login_user">Alamat Email</label>
                        <input id="login_user" name="login_user" type="text" class="form-control" value="">
                        <?php echo form_error('login_user', '<p class="text-danger text-bold">', '</p>'); ?>
                        <label for="login_password">Password</label>
                        <input id="login_password" type="password" name="login_password" class="form-control">
                        <?php echo form_error('login_password', '<p class="text-danger text-bold">', '</p>'); ?>
                        <p class="forgot-pass"><a href="#">Lupa Katasandi ??</a></p>
                        <button class="button" type="submit"><i class="fa fa-lock"></i> Masuk</button>
                      <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
