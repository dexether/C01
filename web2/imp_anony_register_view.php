<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
require_once dirname(__FILE__) . '/../classes/mlm/Mlm.class.php';
$multilevel = new Mlm();
$list_account = $multilevel->get_account();
$status = $_POST['status'];
$msg = $_POST['msg'];
?>
<?php if ($status == 0): ?>
  <!-- jika email belum terdaftar -->
  <div class="alert alert-success">
    <?php echo $msg ?>
  </div>
    <form class="form-horizontal" id="form-new">
      <input type="hidden" name="login" value="<?= $_POST['login'] ?>" />
      <input type="hidden" name="mt4dt" value="<?= $_POST['mt4dt'] ?>" />
      <input type="hidden" name="email" value="<?= $_POST['email'] ?>" />
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Upline</label>
        <div class="col-sm-10">
          <select name="upline" id="upline" class="form-control">
            <?php foreach ($list_account as $key => $value): ?>
              <option value="<?php echo $value->accountname ?>"><?php echo $value->accountname ?> - <?php echo $value->name ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="button" onClick="imp_comm_JS.save_new()" class="btn btn-default">Daftarkan</button>
        </div>
      </div>
    </form>
  <!-- end of jika email belum terdaftar -->
<?php endif; ?>

<?php if ($status == 1): ?>
  <!-- jika email sudah terdaftar -->
  <div class="alert alert-success">
    <?php echo $msg ?>
  </div>
    <form class="form-horizontal">
      <input type="hidden" name="login" value="<?= $_POST['login'] ?>" />
      <input type="hidden" name="mt4dt" value="<?= $_POST['mt4dt'] ?>" />
      <input type="hidden" name="email" value="<?= $_POST['email'] ?>" />
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Upline</label>
        <div class="col-sm-10">
          <select name="accountname" id="accountname" class="form-control">
            <option value=""></option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Buat Cabinet ID Saya</button>
        </div>
      </div>
    </form>
  <!-- end of jika email sudah terdaftar -->
<?php endif; ?>

<?php if ($status == 2): ?>
  <!-- jika sudah terdaftar -->
  <div class="alert alert-warning">
    <?php echo $msg ?>
  </div>
  <!-- end jika email sudah terdaftar -->

<?php endif; ?>
