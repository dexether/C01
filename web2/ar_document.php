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


if (isset($_GET['key'])) {
    $account = base64_decode($_GET['key']);
}
$query = "SELECT 
  client_aecode.`name`,
  client_accounts.`accountname`,
  client_aecode.`identity`,
  mlm.`datetime`,
  mlm_bonus_settings.`amount`
FROM
  mlm,
  mlm_bonus_settings,
  client_accounts,
  client_aecode
  WHERE client_aecode.`aecode` = '$user->username'
  AND client_accounts.`aecodeid` = client_aecode.`aecodeid`
  AND client_accounts.`accountname` = mlm.`ACCNO`
  AND mlm.`group_play` = mlm_bonus_settings.`group_play`";
$result = $DB->execresultset($query);
foreach($result as $row){
    $data = $row;
}

$new_date = date('dS F Y', strtotime($data['datetime']));
if (empty($row['identity'])) {
    $identity = "-";
}else{
    $identity = $row['identity'];
}

$imagenya = 'images/company/cert.jpg';
  $cek = getimagesize($imagenya);
  $width = $cek[0];
  $height = $cek[1];
  // var_dump(getimagesize($imagenya));
   $jpg_image = imagecreatefromjpeg($imagenya);
  // Allocate A Color For The Text
  $white1 = imagecolorallocate($jpg_image, 135,80,64);

  // Set Path to Font File
  $font_path1 = 'images/company/basker.ttf';

  // Set Text to Be Printed On Image
  $text1 = $data['name'];
  // $text1 = singkatname($text1);
  // Print Text On Image
  $x = center_text($text1, 80, $width);  
  imagettftext($jpg_image, 80, 0, $x, 1525, $white1, $font_path1,$text1);
  // imagettftext($jpg_image, 80, 0, 1650, 1544, $white1, $font_path1, $text1);

  $y = imagesy($jpg_image);
  $x = center_text('*** USD '.number_format($data['amount'], 2).' ***', 80, $width);  
  imagettftext($jpg_image, 80, 0, $x, 1730, $white1, $font_path1,'*** USD '.number_format($data['amount'], 2).' ***');

  $x = center_text('Identity Card / Passport *** '.$identity.' ***', 60, $width);  
  imagettftext($jpg_image, 60, 0, $x, 1830, $white1, $font_path1,'Identity Card / Passport *** '.$identity.' ***');

  $x = center_text('Date Deposited *** '.$new_date.' ***', 60, $width);  
  imagettftext($jpg_image, 60, 0, $x, 1930, $white1, $font_path1,'Date Deposited *** '.$new_date.' ***');

  $x = center_text('**APCODE**', 50, 1874);  
  imagettftext($jpg_image, 50, 0, $x, 600, $white1, $font_path1,'**APCODE**');

  $x = center_text('**'.$data['accountname'].'**', 50, 6418); 
  tradeLog('X '.$x); 
  imagettftext($jpg_image, 50, 0, $x, 600, $white1, $font_path1,'**'.$data['accountname'].'**');
  // tradeLog('X '.$x . ' Y ' . $y);
  // Send Image to Browser
  imagejpeg($jpg_image);
  header('Content-type: image/jpeg');
  // Clear Memory
  imagedestroy($jpg_image);

  function center_text($string, $font_size, $width){

      global $font_path1;

      // $image_width = 800;
      $dimensions = imagettfbbox($font_size, 0, $font_path1, $string);
      
      return ceil(($width - $dimensions[4]) / 2);       
  }
  function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
function singkatname($name){
    if (strlen($name) >= 20) {
        $pecah = explode(' ', $name);
        $akhir = '';
        foreach ($pecah as $key => $row) {
            // var_dump($row);
            if ($key > 0) {
                // var_dump($akhir);
                if (strlen($akhir) < 15) {
                    // echo $akhir."<br>";

                    $akhir = $akhir . " " . $row;
                }else{
                    if (strlen($akhir) > 18) {
                        # code...
                    }else{
                        $akhir = $akhir . " " . substr($row, 0 , 1);
                    }
                    
                }

            }else{
                $akhir = $akhir . " ".$row;
            }

        }
    }else{
        $akhir = $name;
    }
    return $akhir;
}

?>