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

@$red = anti_injection($_GET['redirect']);
@$email = anti_injection($_POST["email"]);
@$birthday = anti_injection($_POST["register_birthday"]);
@$phone_number = anti_injection($_POST["register_phone"]);
@$username = $email;
@$userpass1 = $_POST["password"];
@$userpass = MD5(anti_injection($userpass1));
@$namaawal = anti_injection($_POST["register_name"]);
@$namatengah = '';
//$namatengah = anti_injection($_POST["register_name_tengah"]);
@$namaakhir = '';

$query = "SELECT * FROM config";
$result = $DB->execresultset($query);
foreach($result as $rows) {
	$configs[$rows['name']] = $rows['value'];
}

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
			if($configs['sync'] == 1){
				$apidata = array();
				$apidata['name'] = $namaawal;
				$apidata['email'] = $email;
				$apidata['password'] = $userpass1;
				$apidata['phone'] = $phone_number;
				$apidata['dob'] = $birthday;
				$data = base64_encode(serialize($apidata));
				$ch = curl_init();
                                tradeLog('curl data register : '.$data);
				// set URL and other appropriate options
                                if($configs['sk_url'] == 'members.cfforex.com'){
                                   curl_setopt($ch, CURLOPT_URL, "https://".$configs['sk_url']."/api2/postregister/".$data);
                                }else{
                                   curl_setopt($ch, CURLOPT_URL, "http://".$configs['sk_url']."/api2/postregister/".$data);
                                }
				
				curl_setopt($ch, CURLOPT_HEADER, 0);

				// grab URL and pass it to the browser
				curl_exec($ch);

				// close cURL resource, and free up system resources
				curl_close($ch);
			}	
			$query = "insert into client_aecode
	  	set groupid = '$groupid',
	  	aecode = '$username',
	  	name = '$namaawal',
	  	nametengah = '$namatengah',
	  	nameakhir = '$namaakhir',
	  	telephone_mobile = '$phone_number',
	  	sendmethod = 'Email',
	  	email = '$email',
	  	afiliasi = '$afiliasi',
			lastlogin = NOW(),
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
	  	login_end = DATE_ADD(NOW(),INTERVAL +10 YEAR),
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
	    tradeLog("query :" . $query);
	  	$DB->execonly($query);

	  	$themessage = "Approval pengaktifan $email already sent to your Username: " . $email . " email";
	    //tradeLogMMNewLevel("mm_new_level-249");
	    //End Send Email
			$DB->commit();
			
		if (!isset($_GET['redirect'])) {			
					$last            = 0;
					$update_tradeby  = $username;
					$rolldate        = date('Y-m-d', time());
					$accountnamebaru = check_account($update_tradeby, $last);
					$query           = "SELECT client_branch.branch,client_group.group AS thegroup,
					client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
					client_aecode.email,client_aecode.description
					FROM client_branch,client_group,client_aecode
					WHERE client_branch.branchid = client_group.branchid
					AND client_group.groupid = client_aecode.groupid
					and client_aecode.aecode = '$username'
					";
					//tradeLogMMNewLevel("MM_New_Level-131-Query:" . $query);
					$rows = $DB->execresultset($query);
					foreach ($rows as $row) {
						$usernya = $row;
					}
					$query = "INSERT INTO client_accounts SET " .
						"aecodeid = '" . $usernya['aecodeid'] . "', " .
						"accountname = '" . $accountnamebaru . "', " .
						"name = '" . $accountnamebaru . "', " .
						"address = '', " .
						"telephone_home = '', " .
						"telephone_office = '', " .
						"telephone_mobile = '', " .
						"suspend = '1', " .
						"email = '', " .
						"daycall = '0', " .
						"nightcall = '0', " .
						"`float_rate` = '0', " .
						"telephone_fax = '', " .
						"last_updated = NOW(), " .
						"status = 'normal', " .
						"rolldate='" . $rolldate . "', " .
						"sendmethod = 'Email'";
					//tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
					$DB->execonly($query);
					
					$query  = "SELECT value FROM config WHERE name = 'pt'";
					$result = $DB->execresultset($query);
					foreach ($result as $row) {
					 $tipe = $row['value'];
					}
					
					$query = "insert into mlm set
					 mt4dt = 'nometa',
					 ACCNO='$accountnamebaru',
					 Upline = 'COMPANY',
					 datetime = NOW(),
					 companyconfirm = '2',
					 payment = '0',
					 group_play = '$tipe',
					 updateby = '$username'
					 ";
					$DB->execonly($query);

					$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
					$subject = "New Cabinet ID $accountnamebaru has been created";
					$body    = "Time: " . $timenya . "<br> <br>";
					$body    = $body . "Dear  $usernya[name] $usernya[nametengah] $usernya[nameakhir],<br>";
					$body    = $body . " <br>";
					$body    = $body . "Your New Cabinet ID has been created. you will need the admin confirmation to confirm your Cabinet ID<br>";
					$body    = $body . "We will confirm your Cabinet ID as soon as possible<br>";
					$body    = $body . "Did you know? With cabinet ID you can Sync to MetaTrader LOGIN, Education and more, and with once E-Mail you can registered unlimited Cabinet ID,<br>";
					$body    = $body . " <br>";
					$body    = $body . "Thank you," . "<br>";
					$body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
					$body    = $body . $companys['long_address'];
					$body    = $body . " Email : " . $companys['email'] . " <br>";
					$body    = $body . " " . $companys['companyurl'] . " <br>";

					$query = "insert into email set
					 timeupdate = '$timenya',
					 email_to = '$usernya[email]',
					 email_subject = '$subject',
					 email_body = '$body',
					 timesend = '1970-01-31 00:00:00'
					 ";
					$DB->execonly($query);
					$error            = "success";
					$subject          = "Your Account " . $accountnamebaru . " for this plan has been created ";
					$msg              = "";
					$link             = $companys['appurl'] . "/web2/mainmenu.php";
					$_SESSION['page'] = 'imp_treeview';
		}else{			
		$agent = false;
		# code...
		$redir = explode('=',$red);
		$membercode = $redir[1];
		$agent = anti_injection(base64_decode($membercode));
		$query = $DB->execresultset("SELECT client_accounts.accountname, client_aecode.email FROM client_accounts, client_aecode WHERE client_accounts.aecodeid = client_aecode.aecodeid AND client_accounts.accountname = '$agent'");
		$agent = false;
		foreach ($query as $key => $value) {
			$accno = $value['accountname'];
			$accnomlm = $value['accountname'];
		}
		
		$query = $DB->execresultset("SELECT group_play FROM mlm WHERE ACCNO='$accno'");
		foreach ($query as $key => $value) {
			$plan = $value['group_play'];
		}
		$condition_plan = "";
				if ($plan == '0') {
					$condition_plan = "";
				} else {
					$condition_plan = " AND mlm.group_play = '$plan'";
				}
				$condition = "";
				if (isEmail($accnomlm)) {
					$condition = " AND client_aecode.`aecode` = '$accnomlm'";
				} else {
					$condition = " AND client_accounts.accountname = '$accnomlm'";
				}
				$query = "SELECT
			   client_accounts.`accountname`,
			   client_aecode.email,
			   client_aecode.name,
			   client_aecode.aecodeid,
			   client_aecode.status,
			   mlm.group_play
			   FROM
			   client_aecode,
			   client_accounts,
			   mlm
			   WHERE 1=1
			   $condition
			   $condition_plan
			   AND client_aecode.`aecodeid` = client_accounts.`aecodeid`
			   AND client_accounts.accountname = mlm.ACCNO
			   AND client_aecode.status = '1'
			   AND client_accounts.suspend = '0'
			   ORDER BY client_accounts.`accountname` DESC
			   LIMIT 0, 1 ";
				
				$adaae      = 'noae';
				$rows       = $DB->execresultset($query);
				$lastaccout = 0;
				$upline_plan = "no_plan";
				
				foreach ($rows as $row) {
					
					$adaae      = 'adaae';
					
					$aecodeid   = $row['aecodeid'];
					$lastaccout = $row['accountname'];
					if ($plan == '0') {
						$upline_plan = $row['group_play'];
					} else {
						$upline_plan = $plan;
					}

				}
				
				if ($adaae != 'adaae' && $accnomlm != 'COMPANY') {
					$error   = "error";
					$subject = "Sorry, We found an error";
					$msg     = "02. The upline's code or email you entered is wrong or maybe your upline dont have registered Cabinet ID with plan you have entetered. Easy stop is input the detalis correctly and select 'Follow your upline plan', Please check the upline's Email";
					$link    = $companys['appurl'] . "/web2/mainmenu.php";
				} else {
					$last            = 0;
					$update_tradeby  = $username;
					$rolldate        = date('Y-m-d', time());
					$accountnamebaru = check_account($update_tradeby, $last);
					$query           = "SELECT client_branch.branch,client_group.group AS thegroup,
					client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir,
					client_aecode.email,client_aecode.description
					FROM client_branch,client_group,client_aecode
					WHERE client_branch.branchid = client_group.branchid
					AND client_group.groupid = client_aecode.groupid
					and client_aecode.aecode = '$username'
					";
					//tradeLogMMNewLevel("MM_New_Level-131-Query:" . $query);
					$rows = $DB->execresultset($query);
					foreach ($rows as $row) {
						$usernya = $row;
					}
					$query = "INSERT INTO client_accounts SET " .
						"aecodeid = '" . $usernya['aecodeid'] . "', " .
						"accountname = '" . $accountnamebaru . "', " .
						"name = '" . $accountnamebaru . "', " .
						"address = '', " .
						"telephone_home = '', " .
						"telephone_office = '', " .
						"telephone_mobile = '', " .
						"suspend = '1', " .
						"email = '', " .
						"daycall = '0', " .
						"nightcall = '0', " .
						"`float_rate` = '0', " .
						"telephone_fax = '', " .
						"last_updated = NOW(), " .
						"status = 'normal', " .
						"rolldate='" . $rolldate . "', " .
						"sendmethod = 'Email'";
					//tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);
					$DB->execonly($query);
					// Select Account that upline mine
					if ($accnomlm == 'COMPANY') {
						$lastaccout = 'COMPANY';
					}
					// $plan
					if($lastaccout == 'company' || $lastaccout == 'COMPANY' && $plan != '0'):
					  $upline_plan = $plan;
					endif;

					$query = "insert into mlm set
					 mt4dt = 'nometa',
					 ACCNO='$accountnamebaru',
					 Upline = '$lastaccout',
					 datetime = NOW(),
					 companyconfirm = '2',
					 payment = '0',
					 group_play = '$upline_plan',
					 updateby = '$username'
					 ";
					$DB->execonly($query);
					//  tambahan jika askap maka auto Sync
					$auto_registered = false;
					if($upline_plan == "royal"):
					  $query = "SELECT alias, mt4dt FROM mt_database WHERE mt_database.`alias` LIKE '%royal%' AND mt_database.`enabled` = 'yes'";
					  $hasil = $DB->execresultset($query);
					  foreach ($hasil as $key => $value) {
						$query = "SELECT LOGIN, EMAIL FROM ".$value['mt4dt'].".`mt4_users` WHERE ".$value['mt4dt'].".`mt4_users`.`EMAIL` = '".$username."'";
						$hasil_mt = $DB->execresultset($query);
						foreach ($hasil_mt as $key_mt => $value_mt) {
						  # code...
						  $cekdullu = checkLoginMetaIfRegistered($value_mt['LOGIN'], $value['mt4dt']);
						  if($cekdullu):
						  else:
							$insert = "INSERT INTO mlm2 SET ACCNO = '$accountnamebaru', mt4dt = '$value[mt4dt]', mt4login = '$value_mt[LOGIN]', suspend = '0'";
							$DB->execonly($insert);
							$auto_registered = true;
							$registered_login[] = $value_mt['LOGIN'];
						  endif;
						}


					  }
					endif;
					//tradeLogMMNewLevel("tradeLogMMNewLevel-800:" . $query);

					$timenya = date('Y-m-d H:i', strtotime('-1 hour'));
					$subject = "New Cabinet ID $accountnamebaru has been created";
					$body    = "Time: " . $timenya . "<br> <br>";
					$body    = $body . "Dear  $usernya[name] $usernya[nametengah] $usernya[nameakhir],<br>";
					$body    = $body . " <br>";
					$body    = $body . "Your New Cabinet ID has been created. you will need the admin confirmation to confirm your Cabinet ID<br>";
					if($auto_registered):
					  $body    = $body. "and your LOGIN number ".$value_mt['LOGIN']."  has been sync automatically to this account<br/>";
					endif;
					$body    = $body . "We will confirm your Cabinet ID as soon as possible<br>";
					$body    = $body . "Did you know? With cabinet ID you can Sync to MetaTrader LOGIN, Education and more, and with once E-Mail you can registered unlimited Cabinet ID,<br>";
					$body    = $body . " <br>";
					$body    = $body . "Thank you," . "<br>";
					$body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
					$body    = $body . $companys['long_address'];
					$body    = $body . " Email : " . $companys['email'] . " <br>";
					$body    = $body . " " . $companys['companyurl'] . " <br>";

					$query = "insert into email set
					 timeupdate = '$timenya',
					 email_to = '$usernya[email]',
					 email_subject = '$subject',
					 email_body = '$body',
					 timesend = '1970-01-31 00:00:00'
					 ";
					$DB->execonly($query);
					$error            = "success";
					$subject          = "Your Account " . $accountnamebaru . " for this plan has been created ";
					if($auto_registered):
					  $subject    = $subject. "and your LOGIN number on ".$value_mt['LOGIN']."  has been sync automatically to this account";
					endif;
					$msg              = "You need Admin confrimation to confirm your account, We will confirm your account as soon as possible";
					$link             = $companys['appurl'] . "/web2/mainmenu.php";
					$_SESSION['page'] = 'imp_treeview';
				}
			}			
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
  header("Location: ".$companys['companyurl']."web2/thankyou.php"); /* Redirect browser */
  exit();

  function tradeLog($msg) {
  	$fp = fopen("trader.log", "a");
  	$logdate = date("Y-m-d H:i:s => ");
  	$msg = preg_replace("/\s+/", " ", $msg);
  	fwrite($fp, $logdate . $msg . "\n");
  	fclose($fp);
  	return;
  }

  function check_account($update_tradeby, $last)
{
    global $DB;
    //$waktucheck1 = date('ymdH'); //2014 Aug 21 21:03:55
    $waktucheck1 = date('ymdH', strtotime('-1 hour'));
    $query       = "select * from mlm where ACCNO  like ('$waktucheck1%') order by ACCNO desc limit 0,1";
    //tradeLogMMNewLevel("MM_New_Level-378:".$query);
    $lastACCNO = 0;
    $rows      = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO = $row['ACCNO'];
    }
    $val1 = strlen($lastACCNO); //150403110000001
    $val2 = substr($lastACCNO, 8, $val1);
    //tradeLogMMNewLevel("MM_New_Level-386-Val1;".$val1.";Val2::".$val2);
    $val3 = intval($val2);
    //tradeLogMMNewLevel("MM_New_Level-239-Va32::".$val3);
    if ($last == '0') {
        $last = $val2 + 1;
    } else {
        $last = $last + 1;
    }

    //tradeLogMMNewLevel("MM_New_Level-241-Last:".$last);

    $account_name_check = $waktucheck1 . $last;
    //tradeLogMMNewLevel("MM_New_Level-397:".$account_name_check);//MM_New_Level-246:A000001

    $query = "select * from mlm where ACCNO  = '$account_name_check'";
    //tradeLogMMNewLevel("MM_New_Level-399-Query:".$query);//Query
    $is_accountname_already_taken = "no";
    $rows                         = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['ACCNO'];
        $is_accountname_already_taken = "yes";
    }

    $query = "select * from client_accounts where accountname='$account_name_check'";
    //tradeLogMMNewLevel("mm_new_level-301-query:" . $query);
    $rows = $DB->execresultset($query);
    foreach ($rows as $row) {
        $lastACCNO                    = $row['accountname'];
        $is_accountname_already_taken = "yes";
    }

    if ($is_accountname_already_taken == "yes") {
        $accountname = check_account($update_tradeby, $last);
    } else {
        $accountname = $account_name_check;
    }
    return $accountname;
}

function ae_gen_password($syllables = 3, $use_prefix = false)
{

    // Define function unless it is already exists
    if (!function_exists('ae_arr')) {

        // This function returns random array element
        function ae_arr(&$arr)
        {
            return $arr[rand(0, sizeof($arr) - 1)];
        }

    }

    // 20 prefixes
    $prefix = array('aero', 'anti', 'auto', 'bi', 'bio',
        'cine', 'deca', 'demo', 'dyna', 'eco',
        'ergo', 'geo', 'gyno', 'hypo', 'kilo',
        'mega', 'tera', 'mini', 'nano', 'duo');

    // 10 random suffixes
    $suffix = array('dom', 'ity', 'ment', 'sion', 'ness',
        'ence', 'er', 'ist', 'tion', 'or');

    // 8 vowel sounds
    $vowels = array('a', 'o', 'e', 'i', 'y', 'u', 'ou', 'oo');

    // 20 random consonants
    $consonants = array('w', 'r', 't', 'p', 's', 'd', 'f', 'g', 'h', 'j',
        'k', 'l', 'z', 'x', 'c', 'v', 'b', 'n', 'm', 'qu');

    $password        = $use_prefix ? ae_arr($prefix) : '';
    $password_suffix = ae_arr($suffix);

    for ($i = 0; $i < $syllables; $i++) {
        // selecting random consonant
        $doubles = array('n', 'm', 't', 's');
        $c       = ae_arr($consonants);
        if (in_array($c, $doubles) && ($i != 0)) {
            // maybe double it
            if (rand(0, 2) == 1) // 33% probability
            {
                $c .= $c;
            }

        }
        $password .= $c;
        //
        // selecting random vowel
        $password .= ae_arr($vowels);

        if ($i == $syllables - 1) // if suffix begin with vovel
        {
            if (in_array($password_suffix[0], $vowels)) // add one more consonant
            {
                $password .= ae_arr($consonants);
            }
        }

    }

    // selecting random suffix
    $password .= $password_suffix;

    return $password;
}

function create_or_use_upline($group_play, $email, $tradeby)
{
    global $DB;
    $update_tradeby = $tradeby;
    $rolldate       = date('Y-m-t');
    //tradeLogMMNewLevel("mm_Registration2-332:".$rolldate);

    $query              = "SELECT value FROM broker_settings WHERE settings IN ('mailfrom','mailhost','mailpassword','mailto','mailport') order by urutan asc";
    $mailbrokersettings = array();
    $rows               = $DB->execresultset($query);
    foreach ($rows as $row) {
        $mailbrokersettings[] = $row['value'];
    }

    $query = "SELECT companyurl FROM usercompany;";
    $rows  = $DB->execresultset($query);
    foreach ($rows as $row) {
        $urlcompany = $row['companyurl'];
    }
    $tools = new CTools();

    //Start apakah company
    //tradeLogMMNewLevel("mm_new_level.php-348-StartCheck Email:" . $email);
    if ($email == $companys['email']) {
        $upline = 'COMPANY';
        return $upline;
    } else {
//if ($email == 'admin@globalgains.co') {
        //Start check Upline
        $query = "SELECT mlm.group_play,mlm.ACCNO,client_accounts.*
  FROM client_aecode,client_accounts,mlm
  WHERE
  client_aecode.aecodeid = client_accounts.`aecodeid`
  AND mlm.ACCNO = client_accounts.accountname
  AND mlm.group_play = '$group_play'
  AND client_aecode.email = '$email' order by mlm.datetime asc";
        //tradeLogMMNewLevel("mm_new_level.php-361:" . $query); //$email = cucudua@si.co.id
        $checkuplines = array();
        $rows         = $DB->execresultset($query);
        foreach ($rows as $row) {
            $checkuplines[] = $row;
        }

        $upline       = "upline_new";
        $upline_accno = '';
        if (count($checkuplines) > 0) {
            for ($icount = 0; $icount < count($checkuplines); $icount++) {
// si upline punya beberapa ACCNO dan akan di check anaknya berapa
                $checkupline  = $checkuplines[$icount];
                $upline_accno = $checkupline['ACCNO']; //150926112 milik cucudua@si.co.id

                $query = "SELECT mlm.ACCNO,mlm.datetime,client_aecode.email
            FROM MLM,client_accounts,client_aecode
            WHERE MLM.Upline = '$upline_accno'
            and MLM.ACCNO = client_accounts.accountname
            and client_accounts.aecodeid = client_aecode.aecodeid
            ORDER BY DATETIME DESC";
                //tradeLogMMNewLevel("mm_new_level.php-380-ACCNO:" . $upline_accno . ";Query:" . $query);
                $hitung = 2;
                $rows   = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $hitung = $hitung - 1; //minus 150926121 dan minus 150926122
                }
                if ($hitung > 0) {
                    // artinya ACCNO si upline masih ada yang koson
                    $upline = $upline_accno;
                    //tradeLogMMNewLevel("mm_new_level.php-554-Upline:" . $upline_accno . ";masih ada yang kosong, yaitu ACCNO:" . $upline);
                    return $upline;
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-391-Email:" . $email . " ACCNo nya sudah penuh");
                }
            } //if (count($checkuplines) > 0) {
        } //for ($icount = 0; $icount < count($checkuplines); $icount++) {
        //tradeLogMMNewLevel("mm_new_level.php-396-Kalau baca ini, artinya masih belum dapat Uplinenya");

        if ($upline == "upline_new") {

            if ($upline_accno != '') {
                //Upline need to have a new Account
                //cari tahu apa email kakeknya
                //$upline_accno == 150926112
                $query = "SELECT mlm.Upline
            FROM MLM
            WHERE MLM.ACCNO = '$upline_accno' ";
                //tradeLogMMNewLevel("mm_new_level.php-552-Query:" . $query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $upline2_accno = $row['Upline']; //ACCNO 150926111
                }

                $query = "select client_aecode.email from client_aecode,client_accounts
           where client_accounts.aecodeid = client_aecode.aecodeid
           and client_accounts.accountname = '$upline2_accno'";
                //tradeLogMMNewLevel("mm_new_level.php-417-;Query:" . $query);
                $rows = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $kakek_email = $row['email']; //cucusatu@si.co.id
                }
                //tradeLogMMNewLevel("mm_new_level.php-585-;Start Cari Kakek_email:" . $kakek_email.";Group_Play:".$group_play);
                //end cari tahu apa email kakeknya
                $kakeknya = create_or_use_upline($group_play, $kakek_email, $tradeby);
                //tradeLogMMNewLevel("mm_new_level.php-588-Kakeknya:".$kakeknya);
            } //if ($upline_accno != '') {
            else {
                $query = "SELECT client_aecode.afiliasi FROM client_aecode WHERE client_aecode.`aecode` = '$email'";
                $rows  = $DB->execresultset($query);
                foreach ($rows as $row) {
                    $kakeknya = $row['afiliasi']; //ACCNO 150926111
                }
                $kakek_email = $kakeknya;
                //tradeLogMMNewLevel("mm_new_level.php-578-Kakek_email:" . $kakek_email . ";Email Upline:" . $email);
                if ($kakek_email == $companys['email'] || $kakek_email == '') {
                    //tradeLogMMNewLevel("mm_new_level.php-580-Jalur Company");
                    $kakeknya = create_or_use_upline_khusus($group_play);
                } else {
                    //tradeLogMMNewLevel("mm_new_level.php-583-Jalur Kakek");
                    $kakeknya = create_or_use_upline($group_play, $kakek_email, $tradeby);
                }
                //tradeLogMMNewLevel("mm_new_level.php-586-Kakeknya:" . $kakeknya);
            }

            //tradeLogMMNewLevel("mm_new_level.php-445-Kakeknya:" . $kakeknya);

            $last         = 0;
            $jumlah_digit = 6; //maksimum 6
            //tradeLogMMNewLevel("mm_new_level-593:");
            $accountname = check_account($update_tradeby, $last);
            //tradeLogMMNewLevel("mm_new_level-595-AccountName:" . $accountname);

            $query = "SELECT client_branch.branch,client_group.group AS thegroup,client_aecode.email,
         client_aecode.aecodeid,client_aecode.name,client_aecode.nametengah,client_aecode.nameakhir
         FROM client_branch,client_group,client_aecode
         WHERE client_branch.branchid = client_group.branchid
         AND client_group.groupid = client_aecode.groupid
         and client_aecode.email = '$email'
         ";
            //tradeLogMMNewLevel("MM_New_Level-461-Query:" . $query);
            $rows = $DB->execresultset($query);
            foreach ($rows as $row) {
                $uplinenya = $row;
            }

            $query = "INSERT INTO client_accounts SET " .
                "aecodeid = '" . $uplinenya['aecodeid'] . "', " .
                "accountname = '" . $accountname . "', " .
                "name = '" . $accountname . "', " .
                "address = '', " .
                "telephone_home = '', " .
                "telephone_office = '', " .
                "telephone_mobile = '', " .
                "suspend = '1', " .
                "email = '$email', " .
                "daycall = '0', " .
                "nightcall = '0', " .
                "`float_rate` = '0', " .
                "telephone_fax = '', " .
                "last_updated = NOW(), " .
                "status = 'normal', " .
                "rolldate='" . $rolldate . "', " .
                "sendmethod = 'Email'";
            //tradeLogMMNewLevel("mm_new_level-484:" . $query);
            $DB->execonly($query);

            $query = "insert into mlm set
        ACCNO='$accountname',
        mt4dt = 'nometa',
        Upline = '$kakeknya',
        datetime = NOW(),
        companyconfirm = '0',
        payment = '0',
        group_play = '$group_play',
        updateby = '$tradeby'
        ";
            //tradeLogMMNewLevel("mm_new_level-496-query:" . $query);
            $DB->execonly($query);

            $timenya = date('Y-m-d H:i', strtotime('-1 hour'));
            $subject = "New Account $accountname has been created";
            $body    = "Time: " . $timenya . "<br> <br>";
            $body    = $body . "Dear  $uplinenya[name] $uplinenya[nametengah] $uplinenya[nameakhir],<br>";
            $body    = $body . " <br>";
            $body    = $body . "Please be informed that your downline just created and as your Binary system already completed. <br>";
            $body    = $body . "We created a new link for your new downline <br>";
            $body    = $body . " <br>";
            $body    = $body . "Thank you," . "<br>";
            $body    = $body . "<br><strong>" . $companys['companyname'] . "</strong>" . "<br>";
            $body    = $body . $companys['long_address'];
            $body    = $body . " Email : " . $companys['email'] . " <br>";
            $body    = $body . " " . $companys['companyurl'] . " <br>";

            $query = "insert into email set
        timeupdate = '$timenya',
        email_to = '$uplinenya[email]',
        email_subject = '$subject',
        email_body = '$body',
        timesend = '1970-01-31 00:00:00'
        ";
            //tradeLogMMNewLevel("mm_new_level-522-query:" . $query);
            $DB->execonly($query);

            $upline = $accountname;
            return $upline;
        } // if ($upline == "upline_new") {
        //tradeLogMMNewLevel("mm_new_level.php-645-Upline Looping:" . $upline);
    } //end apakah company if ($email == 'admin@globalgains.co') {

    return $upline;
}

function create_or_use_upline_khusus($group_play)
{
    if ($group_play == 'no_plan') {
        $upline   = 'COMPANY';
        $kakeknya = $upline;
    }
    return $upline;
}

function isEmail($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $output = true;
    } else {
        $output = false;
    }
    return $output;

}
function checkLoginMetaIfRegistered($login, $mt4dt)
{
    global $DB;
    global $user;
      $query = "SELECT * FROM mlm2 WHERE mt4login = '$login' AND mt4dt = '$mt4dt'";
    $result = $DB->execresultset($query);
    if(count($result) > 0):
      return true;
    else:
      return false;
    endif;

}
  ?>
