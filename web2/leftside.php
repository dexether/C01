<?php
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");
include_once("$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php");
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
}
$template->assign("user", $user);
// var_dump($user);

//tradeLogLeft("LeftSide-23-Username:".$user->username);
global $template;
global $DB;

function get_menu($data, $parent = 0) {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		$html = "\n$tab<ul class='list-unstyled' id='updates-list'>";
		$i++;
		foreach ($data[$parent] as $v) {
			$child = get_menu($data, $v['id']);
			$html .= "\n\t$tab<li class='has_sub'>";
			$cek = $v['id_url'];
			$conditition = "";
			if($cek != '0'){
				$conditition = 'onclick=cek_active("'.$cek.'")';
			}
			// var_dump($conditition);
			$html .= '<a href="'.$v['url'].'" '.$conditition.' class="'.$v['class'].'"  id="'.$cek.'"><i class="'.$v['img'].'"></i>'.$v['title'].''.$v['span_img'].'</a>';

			if ($child) {
				$i--;
				$html .= $child;
				$html .= "\n\t$tab";
			}
			$html .= '</li>';
		}
		$html .= "\n$tab</ul>";
		return $html;
	} else {
		return false;
	}
}

$data = array();
$result = "SELECT * FROM
menu
WHERE enable = '1'
AND access LIKE '%$user->groupid%'
ORDER BY menu_order";
$rows = $DB->execresultset($result);
foreach ($rows as $row) {
	if ($user->groupid != '9') {
		if ($row['special_access'] == 'all') {
			$data[$row['parent_id']][] = $row;
		}else{
			$pecah = explode(',', $row['special_access']);
			if (in_array($user->username, $pecah)) {
				$data[$row['parent_id']][] = $row;
			}
		}
	}else{
		$data[$row['parent_id']][] = $row;
	}

}

$menu = get_menu($data);
$template->assign("menu", $menu);
 // var_dump($menu);
// echo htmlspecialchars($menu);

$query = "SELECT
client_accounts.`email`
FROM
client_accounts
WHERE client_accounts.`email`  = '$user->username' ";

$rows = $DB->execresultset($query);
$clientaecode="";
foreach ($rows as $row) {
	$clientaecode = $row;
}
$template->assign("clientaecode", $clientaecode);
// var_dump($clientaecode);

$query = "SELECT
secretaris.`email`
FROM
secretaris
WHERE secretaris.`email` ='$user->username' ";

$rows = $DB->execresultset($query);
$secretaris="";
foreach ($rows as $row) {
	$secretaris = $row['email'];
}
$template->assign("secretaris", $secretaris);
	// var_dump($secretaris);

$query = "SELECT
branch_manager.`email`
FROM
branch_manager
WHERE branch_manager.`email` ='$user->username' ";

$rows = $DB->execresultset($query);
$bm="";
foreach ($rows as $row) {
	$bm = $row['email'];
}
$template->assign("bm", $bm);
	// var_dump($bm);

$query = "SELECT
marketing.`email`
FROM
marketing
WHERE marketing.`email` ='$user->username' ";

$rows = $DB->execresultset($query);
$sudahdaftar ="";
foreach ($rows as $row) {
	$sudahdaftar = $row['email'];
}
$template->assign("sudahdaftar", $sudahdaftar);
	// var_dump($sudahdaftar);

$query = "SELECT * FROM client_aecode WHERE aecode = '$user->username'";
//tradeLogProfile("Profile-20-Query:".$query);
$rows = $DB->execresultset($query);
$allpersonaldata = array('foto' => '');
foreach ($rows as $key => $row) {
    $allpersonaldata = $row;
}
$template->assign('alldatas', $allpersonaldata);

$userstatus = '';
if (isset($_SESSION['userstatus'])) {
	$userstatus = $_SESSION['userstatus'];
}
//tradeLogLeft("LeftSide-9-UserStatus:".$userstatus);
$template->assign("userstatus", $userstatus);

$accounttype = '';
if (isset($_SESSION['accounttype'])) {
	$accounttype = $_SESSION['accounttype'];
}
$template->assign("accounttype", $accounttype);

$direpalce0 = $user->username;
$direpalce1 = str_replace("@", "_", $direpalce0);
$direpalce2 = str_replace(".", "__", $direpalce1);
$dir = "C:/Project/FileUpload/fileupload_foto/" . $direpalce2 . "/";
//tradeLogTop("TopSide-95-Dir:" . $dir);
$file_display = array('jpg', 'jpeg', 'png', 'gif');

function listFolderFiles2b($dir2, $file_display) {
	global $user;
    //tradeLogProfile("Profile-142-Dir:" . $dir2);
	$urlnya2 = "none";
	if (is_dir($dir2)) {
        //tradeLogProfile("Profile-145");
		$ffs = scandir($dir2);
        //tradeLogProfile("Profile-147-Count:" . count($ffs));
		foreach ($ffs as $ff) {
			if ($ff != '.' && $ff != '..') {
				$haiya = explode('.', $ff);
				$file_type = strtolower(end($haiya));
                //echo '&nbsp;&nbsp;&nbsp; FileType :' . $file_type;
				if ($ff !== '.' && $ff !== '..' && in_array($file_type, $file_display) == true) {
					$imgPath = $dir2 . "/" . $ff;
                    //tradeLogProfile("Profile-154:" . $imgPath);
					$content = file_get_contents($imgPath);
					$imgData = base64_encode($content);
					$urlnya2 = "<img src='data:image/jpeg;base64, $imgData' alt='$user->username' align='middle' style='width:100%;height:100%;'  />";
				}
			}
        }//foreach ($ffs as $ff) {
    }//if (is_dir($dir2)) {
    //tradeLogTop("TopSide-45-Urlnya:" . $urlnya2);
    	return $urlnya2;
    }

    $urlnya2 = listFolderFiles2b($dir, $file_display);
    $template->assign("urlnya2", $urlnya2);



    $template->display("leftside.htm");

    function tradeLogLeft($msg) {
    	$fp = fopen("trader.log", "a");
    	$logdate = date("Y-m-d H:i:s => ");
    	$msg = preg_replace("/\s+/", " ", $msg);
    	fwrite($fp, $logdate . $msg . "\n");
    	fclose($fp);
    	return;
    }

    ?>
