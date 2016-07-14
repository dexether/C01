<?php


//tradeLogTop("TopSide-95-Dir:" . $dir);

$get = "";
if (isset($_GET['a'])) {
	$get = base64_decode($_GET['a']);

}

echo listFolderFiles2($get);

function listFolderFiles2($account) {
	global $user;
	$dir2 = "C:/Project/GlobalGains/mlm/fileupload/". $account;
    //tradeLogProfile("Profile-142-Dir:" . $dir2);
	$urlnya2 = "Sorry, there is no image for this account";
	if (is_dir($dir2)) {
        //tradeLogProfile("Profile-145");
		$ffs = scandir($dir2);
        //tradeLogProfile("Profile-147-Count:" . count($ffs));
        // var_dump($ffs);
		foreach ($ffs as $ff) {
			if ($ff != '.' && $ff != '..') {
				$lv2_dir = $dir2. "/". $ff;
				if (is_dir($lv2_dir)) {
					$lv2_dir_scan = scandir($lv2_dir);
					foreach($lv2_dir_scan as $lv2){
						if ($lv2 != '.' && $lv2 != '..') {
							$file_dir = $lv2_dir. "/" . $lv2;
							// echo $file_dir;
							$content = file_get_contents($file_dir);
							$imgData = base64_encode($content);
							$urlnya2 = "<img src='data:image/jpeg;base64, $imgData' align='middle' style='width:50%;height:50%;'  />";
						}
					}
				}

			}
        }//foreach ($ffs as $ff) { 
    }//if (is_dir($dir2)) {
    //tradeLogTop("TopSide-45-Urlnya:" . $urlnya2);
    	return $urlnya2;
    }

 function getDate($account) {
	global $user;
	$dir2 = "C:/Project/GlobalGains/mlm/fileupload/". $account;
    //tradeLogProfile("Profile-142-Dir:" . $dir2);
	$urlnya2 = "Sorry, there is no image for this account";
	$data = 0;
	if (is_dir($dir2)) {
        //tradeLogProfile("Profile-145");
		$ffs = scandir($dir2);
        //tradeLogProfile("Profile-147-Count:" . count($ffs));
        // var_dump($ffs);
		foreach ($ffs as $ff) {
			if ($ff != '.' && $ff != '..') {
				
				$data = $ff;
			}
        }//foreach ($ffs as $ff) { 
    }//if (is_dir($dir2)) {
    //tradeLogTop("TopSide-45-Urlnya:" . $urlnya2);
    	return $data;
    }
?>