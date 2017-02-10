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
                        <h3>Create an account</h3>
                        <p>Please enter your email address to create an account.</p>
                        <label for="emmail_register">Email address</label>
                        <input id="emmail_register" type="text" class="form-control">
                        <button class="button"><i class="fa fa-user"></i> Create an account</button>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-authentication">
                      <?php echo form_open('auth') ?>
                        <h3>Sudah punya akun AgendaFX?</h3>
                        <?php echo validation_errors('<div class="alert alert-danger">' , '</div>'); ?>
                        <label for="login_user">Alamat Email</label>
                        <input id="login_user" name="login_user" type="text" class="form-control">
                        <label for="login_password">Password</label>
                        <input id="login_password" type="password" name="login_password" class="form-control">
                        <p class="forgot-pass"><a href="#">Lupa Katasandi ??</a></p>
                        <button class="button" type="submit"><i class="fa fa-lock"></i> Masuk</button>
                      <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
