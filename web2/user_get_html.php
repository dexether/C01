<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");

// $apex = New Apexregent();
// require_once dirname(__FILE__) . '../../classes/apexregent/apexregent.class.php';
$aecodeid = @$_GET['aecodeid'];
$query = "SELECT
client_aecode.aecodeid,
client_aecode.name,
client_aecode.gender,
client_aecode.status,
client_aecode.telephone_mobile,
client_aecode.address,
client_aecode.email,
client_aecode.foto,
client_aecode_bank.aeaccountnumber,
client_aecode_bank.aeaccountname,
client_aecode_bank.banktype
FROM client_aecode
LEFT JOIN client_aecode_bank ON client_aecode.aecode = client_aecode_bank.aecode
WHERE client_aecode.`aecodeid` = '".$aecodeid."'";
$data = $DB->execresultset($query);
$userdata = [];
foreach ($data as $key => $row) {
  $userdata = $row;
}

$query = "SELECT
  client_accounts.`accountname`,
  mlm.`Upline`,
  mlm.datetime
FROM
  client_accounts
  LEFT JOIN mlm ON mlm.`ACCNO` = client_accounts.`accountname`
WHERE client_accounts.`aecodeid` = '".$userdata['aecodeid']."' ";
$result = $DB->execresultset($query);

?>
<div class="row">
  <div class="col-sm-4">
    <img src="<?php echo ($userdata['foto'] == "" || empty($userdata['foto'])) ? "https://www.gravatar.com/avatar/" . base64_encode($userdata['email']) . "?s=200" : $userdata['foto'] ;  ?>" class="img-responsive img-thumbanil" alt="">
  </div>
  <div class="col-sm-8">
    <table>
      <tr>
        <th >Name</th>
        <td width="10%">:</td>
        <td><?php echo $userdata['name'] ?></td>
      </tr>
      <tr>
        <th>Gender</th>
        <td width="10%">:</td>
        <td><?php echo $userdata['gender'] ?></td>
      </tr>
      <tr>
        <th>Phone Number</th>
        <td width="10%">:</td>
        <td><?php echo $userdata['telephone_mobile'] ?></td>
      </tr>
      <tr>
        <th>E-mail</th>
        <td width="10%">:</td>
        <td><?php echo $userdata['email'] ?></td>
      </tr>
      <tr>
        <th>Address</th>
        <td width="10%">:</td>
        <td><?php echo $userdata['address'] ?></td>
      </tr>
      <tr>
        <th>Status</th>
        <td width="10%">:</td>
        <td><?php echo ($userdata['status'] == "1") ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" ; ?></td>
      </tr>
    </table>
  </div>
  <div class="col-sm-12">
    <div class="bs-callout bs-callout-info">
      <h4>Bank Account Information</h4>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>Bank Account Name</th>
            <th>Bank Account Number</th>
            <th>Bank Account Branch</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <?php if ($userdata['aeaccountnumber'] == ""): ?>
              <td colspan="4" class="text-center">No Bank Account</td>
            <?php else: ?>
              <td>1</td>
              <td><?php echo $userdata['aeaccountname'] ?></td>
              <td><?php echo $userdata['aeaccountnumber'] ?></td>
              <td><?php echo $userdata['banktype'] ?></td>
            <?php endif; ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="bs-callout bs-callout-success">
      <h4>Account list</h4>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-bordered">
        <thead>
          <tr>
            <th>No.</th>
            <th>Account Number</th>
            <th>Upline</th>
            <th>Date Created</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($result as $key => $value): ?>
            <tr>
              <td><?=  $key + 1; ?></td>
              <td><?=  $value['accountname']; ?></td>
              <td><?=  $value['Upline']; ?></td>
              <td><?= $value['datetime']; ?></td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
