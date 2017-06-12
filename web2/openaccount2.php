<?php

$skip_authentication = 1;
include("../includes/functions.php");
include_once("includes/wr_tools.php");
$lines = "a=1";
if ($mysql['crypt_key'] != '') {
	$crypt_key = $mysql['crypt_key'];
}
$var_to_pass = null;

$groupid = '1';
//tradeLog("OpenAccount2-13");

@$redirect = anti_injection($_GET['redirect']);
$template->assign('redirect', $redirect);
@$email = anti_injection($_POST["email"]);
@$username = $email;
@$userpass1 = $_POST["password"];
@$userpass = MD5(anti_injection($userpass1));
@$namaawal = anti_injection($_POST["register_name"]);
@$namatengah = '';
//$namatengah = anti_injection($_POST["register_name_tengah"]);
@$namaakhir = '';
//$namaakhir = anti_injection($_POST["register_name_akhir"]);
//tradeLog("OpenAccount2-24-NamaAwal:".$namaawal);
//$address = anti_injection($_POST["address"]);
// $address = anti_injection($_POST["address"]);
// $address = anti_injection($_POST["address"]);
//tradeLog("OpenAccount2-28-Email:" . $email . ";NamaAwal:" . $namaawal);
//$checkterms = anti_injection($_POST["acceptTerms"]);
//$banktype = anti_injection($_POST["banktype"]);
//$aeaccountname = anti_injection($_POST["aeaccountname"]);
//$aeaccountnumber = anti_injection($_POST["aeaccountnumber"]);
//$no_identitas = anti_injection($_POST["no_identitas"]);
// $no_identitas = anti_injection($_POST["countryid"]);
$template->assign("username", $username);
$template->assign("userpass", anti_injection(@$_POST["password"]));


$query = "SELECT * FROM usercompany";
$result = $DB->execresultset($query);
$years = date('Y', time());
foreach($result as $rows) {
	$companys = $rows;
}
$template->assign("companys", $companys);
//$phonenumber = anti_injection($_POST["phoneNumber"]);
//$phonenumber = str_replace(' ', '-', $phonenumber);
$phonenumber = '';
//$register_birthday = anti_injection($_POST["register_birthday"]);
$register_birthday = '';

$description1 = anti_injection(@$_POST["description1"]);
$description2 = anti_injection(@$_POST["upline"]);
$description = NULL;
if($description1 == "Agent"):
$description = $description1.":".@$_POST["agen"];
else:
$description = $description1.":".$description2;
endif;

$afiliasi = $description2;

//display_error("Debuging<br>$description1<br>$description2<br>$afiliasi");
//$countries_states1 = anti_injection($_POST["countries_states1"]);
$countries_states2 = anti_injection(@$_POST["nationality"]);
//$countries_states2 = ''
//tradeLog("OpenAccount2-44-Country1:" . $countries_states1.";Country2:".$countries_states2);
//tradelog(">>>>>: " . $username . " >> " . $email . " >> " . $userpass . " >> " . $namaawal . " >> " . $phonenumber . " >> " . $register_birthday.";Check Terms:".$checkterms);
//         >>>>>: useralbert >> albertoscarina@gmail.com >> 202cb962ac59075b964b07152d234b70 >> Mr._Bill_Gates >> 06281779009112 >> 1976/02/28


$output = "No Problem Found";
$lanjutprocess = "true";

$query = "SELECT * FROM user WHERE username = '$username'";
//tradeLog("OpenAccount2-72:" . $query);
$rows = $DB->execresultset($query);
foreach ($rows as $row) {
	$output = "Username has been just taken";
	$lanjutprocess = $output;
}

$query2 = "SELECT * FROM client_aecode WHERE aecode = '$username'";
$rows2 = $DB->execresultset($query2);
foreach ($rows2 as $row) {
	$output = "Username has been just taken";
	$lanjutprocess = $output;
}


/*
  $query2 = "SELECT * FROM client_aecode WHERE aeaccountname = '$aeaccountname' and aeaccountnumber='$aeaccountnumber' and suspend='1'";
  tradeLog("OpenAccount2-Query2:".$query2);
  $rows2 = $DB->execresultset($query2);
  foreach ($rows2 as $row) {
  $output = "Your Account is being suspend, please call Admin";
  $lanjutprocess = $output;
  }
 */

//tradeLog("OpenAccount2-93:" . $lanjutprocess);
//$lanjutprocess = "debugging";
  if ($lanjutprocess == "true") {
		$DB->transaction();
		try {
			$query = "insert into client_aecode
	  	set groupid = '$groupid',
	  	aecode = '$username',
	  	name = '$namaawal',
	  	nametengah = '$namatengah',
	  	nameakhir = '$namaakhir',
	  	telephone_home = '$phonenumber',
	  	sendmethod = 'Email',
	  	email = '$email',
	  	afiliasi = '$afiliasi',
	  	nationality = '$countries_states2',
	  	address = '',
	  	no_identitas = '',
	  	suspend = '0',
	  	status = '0',
	  	description = '$description',
	  	last_updated = NOW();
	  	";
	    //tradeLog("OpenAccount2-115:" . $query);
	  	$DB->execonly($query);

	    // $query = "SELECT * FROM todo";
	    // $todos = $DB->execresultset($query);
			//
			//
	    // $query = "SELECT aecodeid FROM client_aecode WHERE aecode = '$username'";
	    // $result = $DB->execresultset($query);
	    // foreach ($result as $key => $value) {
	    //   $userdata = $value;
	    // }
			//
	    // // $arrayName = array('' => , );
	    // foreach ($todos as $key => $value) {
	    //   $query = "INSERT INTO todo_list SET id_todo = '$value[id]', aecodeid = '$userdata[aecodeid]'";
	    //   $DB->execonly($query);
	    // }


	  	$query = "INSERT INTO client_aecode_bank
	  	SET aecode = '$username',
	  	banktype = '',
	  	aeaccountname = '$namaawal',
	  	aeaccountnumber = '',
	  	status = '0',
	  	last_updated = NOW();
	  	";
	    //tradeLog("OpenAccount2-97:" . $query);
	  	$DB->execonly($query);

	  	$query = "INSERT INTO user
	  	SET username = '$username',
	  	password = '$userpass',
	  	groupid = '3',
	  	languageid = '1',
	  	viewtype='stg9_summary',
	  	companygroup = 'cabinet',
	  	lockingid = '1',
	  	directdone = 'yes',
	  	login_end = DATE_ADD(NOW(),INTERVAL +90 DAY),
	  	countertype = 'Currency'";
	    //tradeLog("OpenAccount2-111:" . $query);
	  	$DB->execonly($query);

	  	$output = "true";



	  	$query = "SELECT appurl FROM usercompany;";
	    //tradelog("forgetpassword.php-39:".$query);
	  	$rows = $DB->execresultset($query);
	  	foreach ($rows as $row) {
	  		$urlcompany = $row['appurl'];
	  	}

	  	$tools = new CTools();
	  	$accountkey = "a=1&email=" . $email . "&postmode=approveuser&password=$userpass1";
	  	$linezip = gzcompress($accountkey);
	    //tradelog("forgetpassword.php-129:".$accountkey.";LineZip:".$linezip.";Crypt:".$crypt_key);
	  	$key = str_replace(array('+', '/'), array('123', ','), rtrim(base64_encode($tools->Crypt($linezip, $crypt_key)), '='));

	  	$urlnya = $urlcompany . "/".$companys['version']."/openaccount3_approval.php?key=" . $key;
	  	$subject = "Thank you for your registration in ".$companys['programname']." ";
			//$body = "Time: " . date('Y-m-d H:i') . "<br>";
	  	$body = "Dear Sir / Madam,<br>";
	  	$body = $body . " <br>";
	  	$body = $body . " <br>";
	  	$body = $body . "We have received an application on our ".$companys['programname']." via this email: $email, in order to confirm your application, please click or copy the link <br>";
	  	$body = $body . " <br>";
	  	$body = $body . "<a href=$urlnya>$urlnya</a>";
	  	$body = $body . " <br> <br>";
	  	$body = $body . "Please ignore this email if you did not apply for it <br>";
	  	$body = $body . " <br>";
	  	$body = $body . " <br>";
	  	$body = $body . "Thank you," . "<br>";
	  	$body = $body . "<br><strong>".$companys['companyname']."</strong>" . "<br>";
	  	$body = $body . $companys['long_address'];
	  	$body = $body . " Email : ".$companys['email']." <br>";
	  	$body = $body . " ".$companys['companyurl']." <br>";

	  	$timeupdate = date('Y-m-d H:i', strtotime('-1 hour'));
	  	$query = "insert into email set
	  	timeupdate = '$timeupdate',
	  	email_to = '$email',
	  	email_subject = '$subject',
	  	email_body = '$body',
	  	timesend = '1970-01-31 00:00:00'
	  	";
	    //tradeLogCompanyConfirm_Admin3("Withdrawal-301:" . $query);
	  	$DB->execonly($query);

	  	$themessage = "Approval pengaktifan $email already sent to your Username: " . $email . " email";
	    //tradeLogMMNewLevel("mm_new_level-249");
	    //End Send Email
			$DB->commit();
		} catch (Exception $e) {
			$DB->rollback();
			display_error("Please call webmaster " . $e->getMessage(), "Failed While Create Account");
		}


  } else {
    //display_error("Error No.229. $lanjutprocess");
    //tradeLog("Error No.247" . $lanjutprocess);
  	echo $lanjutprocess;
  }
//tradeLog("OpenAccount2-250");
  $template->assign("output", $output);

  $template->display("openaccount2.htm");

  function tradeLog($msg) {
  	$fp = fopen("trader.log", "a");
  	$logdate = date("Y-m-d H:i:s => ");
  	$msg = preg_replace("/\s+/", " ", $msg);
  	fwrite($fp, $logdate . $msg . "\n");
  	fclose($fp);
  	return;
  }

  ?>
