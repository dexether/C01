<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
include_once("includes/wr_tools.php");
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

$accountname = '';
if (isset($_POST['accountname'])) {
    $accountname = $_POST['accountname'];
}
$group_play = '';
if (isset($_POST['group_play'])) {
    $group_play = $_POST['group_play'];
}
$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
    $companys = $rows;
    $companys['year'] = $years;
}

if ($postmode == "show") {
    $query = "SELECT group_play, description FROM mlm_bonus_settings";
    $result1 = $DB->execresultset($query);
    $query = "SELECT
    mlm.`ACCNO`,
    mlm_bonus_settings.`group_play`,
    mlm_bonus_settings.`description`
    FROM
    mlm,
    mlm_bonus_settings
    WHERE mlm.`group_play` = mlm_bonus_settings.`group_play`
    AND mlm.ACCNO = '$accountname'";
    $result = $DB->execresultset($query);
    foreach($result as $row){
        $hasil = $row;
    }

    ?>
    <div class="alert alert-warning">
        <p class="text-justify">
            <strong>NOTE : </strong>if you upgrade your club package, you will pay the Club Package FREE as you choose, after you submit. You must Confirm your payment in <strong>Apex Regent -> Payment Center -> Payment Confirmation</strong> Menu and admin will conrim your payment. If you don't confirm your payment we will suspend your accout 5 day from request as you send.
        </p>

    </div>
    <form class="form-horizontal" id="ajax-form" method="post" >
      <div class="form-group">
        <label for="accountname" class="col-sm-3 control-label">Your Account</label>
        <div class="col-md-7">

            <p class="form-control-static"><?php echo $hasil['ACCNO'] ?></p>
            <input type="hidden" name="accountname" value="<?php echo $hasil['ACCNO'] ?>"></input>

        </div>
    </div>
    <div class="form-group">
        <label for="group_play" class="col-sm-3 control-label">Your Package</label>
        <div class="col-md-7">
          <select class="form-control" name="group_play">
              <?php foreach($result1 as $rows) {?>
              <option value="<?php echo $rows['group_play'] ?>"
                  <?php

                  if($group_play == $rows['group_play']) {
                    echo "selected";
                }

                ?>><?php echo $rows['description'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</form>
<?php
exit;
}

if ($postmode == "save") {
    // print_r($_POST);
    $query = "UPDATE mlm SET group_play = '$group_play', companyconfirm = '0', payment = '0', datetime = NOW() WHERE ACCNO = '$accountname'";
    $DB->execonly($query);

    $query = "INSERT INTO mlm_payment SET aecode = '$user->username', Account = '$accountname', TxnDate = '".date('Y-m-d', time())."', PayType = 'Club Package', Status = '0' ";
    $DB->execonly($query);

    $iden = getIdentitas($accountname);


    $to = $iden['email'];
    $subject = "Change the Club Package of ".$accountname."";
    $body = "Time: " . date('Y-m-d H:i:s', strtotime('-1 hour')) . "<br> <br>";
    $body = $body . "Dear ".$iden['name'].",<br>";
    $body = $body . " <br>";
    $body = $body . "We have received your Package necessary changes on Apex account ".$accountname.", next you need to confirm your payment.<br>";
    $body = $body . "If you do not confirm your payment within 5 days, calculated at the time you make a request, then we will suspend your account<br>";
    $body = $body . " <br>";
    $body = $body . "You may login to your APR program account via our website at ".$companys['companyurl']." <br>";
    $body = $body . " <br>";
    $body = $body . " <br>";
    $body = $body . "Thank you,<br>";
    $body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
    $body = $body . $companys['long_address'];
    $body = $body . " Email : ".$companys['email']." <br>";
    $body = $body . " ".$companys['companyurl']." <br>";
    sendEmail($to, $subject, $body, 'ar_myaccount_do');

}
function sendEmail($to, $subject, $body, $module) {
    global $DB;
    $timeupdate = date('Y-m-d H:i:s', strtotime('-1 hour'));
    $query = "insert into email set
    timeupdate = '$timeupdate',
    email_to = '$to',
    email_subject = '$subject',
    email_body = '$body',
    timesend = '1970-01-31 00:00:00',
    module = '$module'
    ";
    $DB->execonly($query);
}
function trdeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function getIdentitas($account) {
    global $DB;
    $query = "SELECT
    client_accounts.`accountname`,
    client_aecode.`email`,
    client_aecode.`name`
    FROM
    client_accounts,
    client_aecode
    WHERE client_accounts.`accountname` = '$account'
    AND client_aecode.`aecodeid` = client_accounts.`aecodeid`";
    $result = $DB->execresultset($query);
    foreach($result as $rows) {
        $datas = $rows;
    }
    return $datas;
}

?>
