<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
$var_to_pass = null;
$_SESSION['page'] = "ar_family_treview";

$sql = "SELECT
 mlm.ACCNO,
 Upline,
 client_aecode.name,
 client_accounts.suspend,
 client_aecode.foto
 FROM mlm
 INNER JOIN client_accounts ON mlm.ACCNO = client_accounts.accountname
 INNER JOIN client_aecode ON client_accounts.aecodeid = client_aecode.aecodeid
 ";
$result = $DB->execresultset($sql);
// [
//   {v:'Mike', f:'Mike<div style="color:red; font-style:italic">President</div>'},
//  '', 'The President'],
foreach ($result as $key => $value) {
  if ($value['suspend'] == true) {
    $gabungan[] = [
      [
        "v" => $value['ACCNO'],
        "f" => "<div id=".$value['ACCNO']." style='color : red; width: 100%;'>".$value['ACCNO']."<br/><strong>".$value['name']."</strong><p>SUSPENDED ACCOUNT</p></div>"
      ],
      $value['Upline'] , ""
    ];
  }else{
    $gabungan[] = [
      [
        "v" => $value['ACCNO'],
        "f" => $value['ACCNO'] . "<div id=".$value['ACCNO']."><strong>".$value['name']."</strong></div>"
      ],
      $value['Upline'] , ""
    ];
  }

}
$json = json_encode($gabungan, JSON_PRETTY_PRINT);
$template->assign('json' , $json);

$template->display('ar_family_treview.htm');
?>
