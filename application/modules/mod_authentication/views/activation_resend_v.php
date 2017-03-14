<div class="columns-container">
    <div class="container" id="columns">
        <!-- page heading-->
        <h2 class="page-heading">
            <span class="page-heading-title2">Authentication Resend</span>
        </h2>
        <!-- ../page heading-->
        <div class="page-content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-authentication">
                        <h3>Kirim Ulang Link Aktifasi</h3>
                        <p>Mohon isi Form dibawah ini untuk mendaftar.</p>
                        <?php echo form_open('auth/activation/resend'); ?>
                        <div class="form-group">
                          <label for="full_name">Alamat E-mail</label>
                          <input id="email" name="email" type="email" class="form-control" placeholder="Alamat Email" value="<?= set_value('email') ?>">
                          <?php echo form_error('email', '<p class="text-danger text-bold">', '</p>'); ?>
                        </div>
                        <div class="form-group">
                          <?php echo form_error('g-recaptcha-response', '<p class="text-danger text-bold">', '</p>'); ?>
                          <div class="g-recaptcha" data-sitekey="<?= $this->config->item('google_recaptcha_site_key') ?>"></div>
                        </div>
                        <button type="submit" class="button"><i class="fa fa-user"></i> Kirim </button>
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
