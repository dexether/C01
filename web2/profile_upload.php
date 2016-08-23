<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

if (isset($user)) {
    $user;
}
$user = $_SESSION['user'];
$template->assign("user", $user);

//TradeLogUnderConstruct_Secure("Profile-175-Get_PostMode:" . $_GET[postmode]);
$postmode = '';
if (isset($_GET['postmode'])) {
    $postmode = $_GET['postmode'];
}

// print_r($_POST);
// print_r($_FILES);
$type    = @$_POST['description1'];
$comment = @$_POST['comment'];
$file    = @$_FILES['filenya'];
$date    = date('Ymd', time());

// Check If Avaible
$query = "SELECT
  client_aecode.`aecodeid`
FROM
  client_aecode
WHERE client_aecode.`aecode` = '$user->username'";
$result = $DB->execresultset($query);
$datas  = array();
foreach ($result as $row) {
    $datas = $row;
}
$query = "SELECT
  id,
  aecodeid
FROM
  client_document
WHERE client_document.`aecodeid` = '$datas[aecodeid]'
AND client_document.`type` = '$type' ";
$result        = $DB->execresultset($query);
$documentdatas = array();
foreach ($result as $key => $value) {
    $documentdatas = $value;
}
if (!empty($datas)) {
    if (!empty($file)) {
        if (is_uploaded_file($file['tmp_name'])) {
            $file['name'] = $datas['aecodeid'] . "_" . $type . "_" . $date . ".jpg";
            $sourcePath   = $file['tmp_name'];
            $targetPath   = "images/data/document/" . $file['name'];
            if (move_uploaded_file($sourcePath, $targetPath)) {
            }
        }
    }
    if (!(count($documentdatas) > 0)) {
        $query = "INSERT INTO client_document SET aecodeid = '$datas[aecodeid]', type = '$type' , source = '$targetPath' , comment = '$comment'";
        $DB->execonly($query);
    } else {
        $update = "UPDATE client_document SET source = '$targetPath' , comment = '$comment' WHERE id = '$documentdatas[id]' ";
        $DB->execonly($update);
    }
}
$response['title'] = 'Success ..';
$response['msg'] = 'Your data has been success uploaded, thanks you';
$response['status'] = 'success';
echo json_encode($response);
function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
