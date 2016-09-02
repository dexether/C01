<?php

function posting_trading($_account,$_action_type,$_counterid,$_price,$_price_to,$_quantity,$_type,$_liquidate_price,$_liquidate_ref,$_duration,$_durationto,$_isorder,$_closetrade,$_tradeid,$_harga)
{
	global $func;
	global $DB;
	global $DB_odbc;
	global $DB_quote;
	global $user;
	global $language;
	$account = $_account;
	$action_type = strtolower($_action_type);
	$query = "select counter_type.action from counter_type  where counter_type.ctr_type = '$action_type'";
	$DB->connect();
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$action = $row[action];
	}
	$counterid = $_counterid ;
	$price = $_price ;
	$price_to = $_price_to ;
	$quantity = round($_quantity);
	$type = strtolower($_type); // New/Liquidate
	$liquidate_price = $_liquidate_price;
	if($liquidate_price==null || $liquidate_price=='')
	{
		$liquidate_price = 0;
	}
	$liquidate_ref =$_liquidate_ref;
	$duration = strtolower($_duration ); // am1
	$durationto = strtolower($_durationto); // am3 
	$isorder =  $_isorder; 
	$closetrade = $_closetrade;
	$tradeid=$_tradeid;
	$harga=$_harga;
	
	$query_dealing = "select directdone from user where username = '$account'"; 
	$result = $DB->query($query_dealing);
	$row = mysql_fetch_array($result);
	$query_directdone = $row[directdone];

//echo "<script>alert('$tradeid');</script>";die;
if ($closetrade=="empty") { unset($closetrade); }
$index_counter_open = getCounterName($counterid);

if ($index_counter_open[open]==0 && empty($isorder))
{
echo "<SCRIPT language=\"Javascript1.2\">";
echo "parent.myTrade.showMessage(\"<font color=red><b>ref.147 $index[name]</b> counters are currently<br>closed for live trading.<br>Please try again when trading is resumed.</font>\");\n";
echo "parent.myTrade.showBusy(false);\n";
echo "</SCRIPT>";  
exit;
}

if ($index_counter_open[activeorder]==0 && !empty($isorder))
{  
echo "<SCRIPT language=\"Javascript1.2\">";
echo "parent.myTrade.showMessage(\"<font color=red><b>ref. 156 $index[name]</b> counters are currently<br>closed for live trading.<br>Please try again when trading is resumed.</font>\");\n";
echo "parent.myTrade.showBusy(false);\n";
echo "</SCRIPT>";  
exit;
}

//Check AE wheter he take right counter 061229
if ($user->groupid==3 || $user->groupid==4 || $user->groupid==5 || $user->groupid==11 ) //tambahan for Account Executive so he will not take wrong counter
{
	$query = "select marketindex.name from marketindex where marketindex.indexid =(
		    			select counter.indexid from counter where counter.counterid = '$counterid'
		   			)";
	//tradelog("trader-168=".$query);		   			
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$ae_counter_name = $row[name]; 	   			
 			
 	$query_category_name = "select marketindex.exchangecode from marketindex where marketindex.name = '$ae_counter_name'";	
 	$result = mysql_query($query_category_name);
 	$row = mysql_fetch_array($result);
 	$ae_counter_name_exchangecode = $row[exchangecode]; 	
	$query = "select countertype from user where username = '$account' 
			and countertype  like ('%$ae_counter_name_exchangecode%') ";
	//tradelog("trader-171=".$query);			
	$result = mysql_query($query);
	if (mysql_num_rows($result)==0)
	{	
		$result_log_file = set_log_file($user->userid,'Trader','NotMatchCounter',$counterid,$query);
		return "<font color='red'><b>Ref. 174 Counter Not Match</b></font><br>The Account doesn't have the counter trade<br>Please try another counter.";
	}
}
//End Check AE wheter he take right counter 061229

// Check whether account has been suspended
$query = "SELECT * FROM suspension WHERE account='$account'";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
	if($row[suspend]=='Cannot Login' || $row[suspend]=='Total' || $row[suspend]=='T'){
		$result_log_file = set_log_file($user->userid,'Trader','Suspended1',$tradeid,"This account suspend=".$row[suspend]);
		return "<font color='red'><b>Ref.116 Account $account has been Suspended </b></font><br>Reason : Please Contant Broker to un-Suspend the Account";
	}
	if ($row[suspend]=='Call')
	{
		$result_log_file = set_log_file($user->userid,'Trader','Suspended2',$tradeid,"This account suspend=".$row[suspend]);
		return "<font color='red'><b>Ref.121 Account $account has been Suspended </b></font><br>Reason : Only can Liquid position. Please Contant Broker to un-Suspend the Account";
	}
	if (empty($liquidate_ref) && empty($closetrade))
	{
		$result_log_file = set_log_file($user->userid,'Trader','Suspended3',$tradeid,"This account can only do a Buy/Sell Liquidation(Close Pair)");
		return "<font color='red'><b>Ref.126 Account $account has been Suspended </b></font><br>Reason : Margin Call or Overtrade. This account can only do a Buy/Sell Liquidation(Close Pair)";
	}	
}
$que="Select LotsMax from lookup";
$res=mysql_query($que);
$r=mysql_fetch_array($res);
// Quantity cannot exceed 20

if ($quantity > $r['LotsMax'])
{
//$result_log_file = set_log_file($user->userid,'Trader','Max Lot',$tradeid,"The maximum quantity allowed are");  
//return "<font color='red'><b>Maximum quantity exceeded</b></font><br>The maximum quantity allowed are  {$r['LotsMax']} units";
}

$query = "SELECT
counter.name,counter.symbol,counter.spread,counter.decimal,counter.lotsize,counter.marginday,counter.quotemodeid,counter.topping,
marketindex.checkhighlow, marketindex.multiplier, marketindex.limitmultiplier, marketindex.limitceiling,
quotemode.functionname,counter.minqty 
FROM counter
LEFT JOIN marketindex ON counter.indexid = marketindex.indexid
LEFT JOIN quotemode ON counter.quotemodeid = quotemode.quotemodeid
WHERE counter.counterid = '$counterid'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);

$counter = $row[name];
$symbol = $row[symbol]; // Used to query realtime for check_price
$spread = $row[spread]; // Used to compare range of price allowed
$decimal = $row[decimal]; // Used to query realtime for check_price
$lotsize = $row[lotsize];
$topping = $row[topping];
$marginday = $row[marginday];
$minqty = $row[minqty];

$checkhighlow = $row[checkhighlow]; // Used to determine whether to permit trades outside the day high/low
$multiplier = $row[multiplier]; // Used to give +- allowance to the current trading price 
$limitmultiplier = $row[limitmultiplier]; // Used to restrict orders from being to0 close to current price. (multiplier)
$limitceiling = $row[limitceiling]; // Used to restrict orders from being too far from current price.

$functionname = $row[functionname]; // Used to calculate the check_price based on quoting mode
$quotemodeid = $row[quotemodeid];

//Replace MarginDay from eacct 20070513
	$broker = new broker;
	$query_branchid = "select client_group.branchid,client_accounts.accountid from client_group,client_aecode,client_accounts 
				where 
				client_group.groupid = client_aecode.groupid 
				and client_aecode.aecodeid = client_accounts.aecodeid 
				and accountname='$_account'";	
	$query_broker_temp=$broker->query_first($query_branchid);				
	$account_branchid = $query_broker_temp[branchid];	
	$account_accountid = $query_broker_temp[accountid];
	$counter_temp = $broker->counter_setting_view_with_accountid($account_branchid,$accountid);
	for($z_count=0;$counter_temp[$z_count];$z_count++)
	{			
		if($counter_temp[$z_count][counter]==$_counterid){
			$marginday = $counter_temp[$z_count][marginday];	
			$counter_commissions = $counter_temp[$z_count][commission];	
			$pending_float_comission_required = $counter_temp[$z_count][close_comm]/100;	
			if($counter_commissions!='floating'){
				$pending_float_comission_required = 0;
			}	
			//tradelog("validationtrade-130-marginday=".$marginday);		
		}

		
	}	
//End Replace MarginDay from eacct 20070513





/*****************************************************************************
* INITIAL CHECKING                                                           *
*****************************************************************************/
//### User MUST BE the AeCode in charge of the account
if ($user->username != $account)
{
checkAccountPermission($account);  
} 
//### Check that required fields are present/filled in correctly 
//1) All fields cannot be empty
//2) Price must be unsigned integer or float
//3) Quantity must be unsigned integer

//1)by pass price_to for all, buy and sell anyprice
while (list($key, $val) = each($_POST))
{
if (ucfirst($key)!="Price_to" && $action_type=='buy_mo' && $action_type=='sell_mo'){
if (empty($val))  { $error[] = "The value of <b>".ucfirst($key)."</b> cannot be empty";  }
}	
}

//2)by pass price_to for all, buy and sell anyprice
if (ucfirst($key)!="Price_to" && $action_type=='buy_mo' && $action_type=='sell_mo'){ 
	if (!preg_match("/^\d+\.{0,1}\d*$/",$price)) { $error[] = "1-196.You have entered an invalid <b>Price</b> type."; }
}else{
	if (ucfirst($key)!="Price" && $action_type=='buy_mo' && $action_type=='sell_mo'){ 
		if (!preg_match("/^\d+\.{0,1}\d*$/",$price)) { $error[] = "2-198.You have entered an invalid <b>Price</b> type."; } 	
	}	
}

//3)
if (!preg_match("/^\d+$/",$quantity)) { $error[] = "You have entered an invalid <b>Quantity</b> type."; }

if ($quantity==0)  { $error[] = "You have entered an invalid <b>Quantity</b> type."; }

if (count($error)>0)
{
return "<font color='red'><b>Empty Fields 208</b></font><br>".implode("<br>",$error);
exit;
}

//tambahan untuk order range 200060710 
if ($action_type=='buy_range' || $action_type=='sell_range')
{
if ($price >= $price_to)
{	
return "<font color='red'><b>Price Range Wrong</b></font><br>'Price Range To' $price_to must greater than Price Range From $price<br> Please try again later.";
exit;
}	
} 
//End tambahan untuk order range 200060710 


//tambahan untuk order range 200060915 check duration there or not 
if ($action_type=='buy_higher' || $action_type=='buy_lower' || $action_type=='buy_range' || $action_type=='buy_mo' 
|| $action_type=='sell_higher' || $action_type=='sell_lower' || $action_type=='sell_range' || $action_type=='sell_mo'
){
	if ($duration=='') {
		return "<font color='red'><b>Market is Close</b></font><br>Market is close please wait for the next open market" ;
		exit;	
	}
}

//End tambahan untuk order range 200060915 check duration there or not 

//Checking Duration From To 
if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	if ($durationto!=null || $durationto!=''){
		$duration_from_sequence = 0;
		$duration_to_sequence = 0;
		//1.get sequence_duration_from
			$query = " select counter.counterid,counter_duration.duration,counter_duration.dura_view,counter_duration.sequence  
				   from counter_duration,marketindex,counter 
				   where dura_start < CURTIME() 
				   and CURTIME() < dura_finish 
				   and marketindex.type_future = counter_duration.category 
				   and marketindex.indexid=counter.indexid 
				   and counterid = '$counterid'
				   and counter_duration.duration = '$duration' ";	  
			$result = $DB->query($query);	
			while ($row = $DB->fetch_array($result))
			{
				$duration_from_sequence = $row[sequence];
			}
			//tradelog("duration_from_sequence=".$duration_from_sequence);
		//1. end get sequence_duration_from
		
		//2.get sequence_duration_from
			$query = " select counter.counterid,counter_duration.duration,counter_duration.dura_view,counter_duration.sequence  
				   from counter_duration,marketindex,counter 
				   where dura_start < CURTIME() 
				   and CURTIME() < dura_finish 
				   and marketindex.type_future = counter_duration.category 
				   and marketindex.indexid=counter.indexid 
				   and counterid = '$counterid'
				   and counter_duration.duration = '$durationto' ";	  
			$result = $DB->query($query);	
			while ($row = $DB->fetch_array($result))
			{
				$duration_to_sequence = $row[sequence];
			}
			//tradelog("duration_to_sequence=".$duration_to_sequence);
		//2. end get sequence_duration_from		
		
		if ($duration_from_sequence > $duration_to_sequence )
		{
			return "<font color='red'><b>Duration Range Wrong</b></font><br>Duration range cannot until the next day end."; 
			exit;
		}
		
		//Check if Duration expired already
		if ($duration_from_sequence ==0 ||  $duration_to_sequence ==0)
		{
			if($user->groupid!='12'){
				return "<font color='red'><b>Duration already expired</b></font><br>Please change to another duration."; 
				exit;
			}	
		}
	}
} 
//End Check duration expired

/*****************************************************************************
* Fetch Current price/datetime/timestamp/high/low FROM realtime database for checking/comparison*
*****************************************************************************/
include("includes/globals_realtime.php");
$query = "SELECT ROUND(last,$decimal) AS check_price,
time AS check_datetime,
high, low 
FROM `quote`
WHERE symbol = '$symbol'";

$result = mysql_query($query) OR DIE (mysql_error() . " $query");
$row = mysql_fetch_array($result);
$check_price = $row[check_price]; // Last
$check_datetime = $row[check_datetime];
//tradelog("check_datetime=".$check_datetime);
$day_high = $row[high];
$day_low = $row[low];

//##################TAMBAHAN BY INDRA OTOMATIS LIMIT ATO ORDER TANGGAL 09 DECEMBER 2005 ########################3

if($check_price!="")
{
if ($quotemodeid==1)
{
$_sell = $check_price;
$_buy =  $check_price  + $spread;
}
if ($quotemodeid==2)
{
$_sell = $check_price - $spread/2;
$_buy =  $check_price + $spread/2;
} 
if ($quotemodeid==3)
{
$_sell = $check_price- $spread;
$_buy  = $check_price;
} 

}
if($action=="buy")
{
if($price < $_buy ) $mode_order="LIMIT";else $mode_order="STOP";

}
if($action=="sell")
{
if($price > $_sell) $mode_order="LIMIT";else $mode_order="STOP";

}


/*****************************************************************************
* Price checks for Immediate Positions (not orders)
*****************************************************************************/
//1) Check that price must not be greater or lesser than high/low of the day [Added: 7th May 2004]
// - IF sell, submitted price must not be lesser or equal than day low & not be greater or equal than day high
// - IF buy, submitted price must not be lesser or equal than day low & not be greater or equal than day high

//2) Check that difference between price and realtime price is within range 1 spread range  [7th May 2004]
// - This means that the submitted price should be within actual price +/- spread
// UNIQUE: Do not check for close pair trades

$check_price = $functionname($check_price, $spread, $decimal,$topping); // $check_price[buy] & $check_price[sell];

if (empty($isorder))
{
	//1)
	if ($checkhighlow==1)
	{
		switch ($action)
		{
			case "buy":
				if ($price >= $day_high || ($price-$spread) <= $day_low)
				{
					return "<font color='#33FF33'><b>Price Buy outside High Low range doesn't allow</b></font>" ;
				}
			break;
			
			case "sell":
				if (($price+$spread) >= $day_high || $price <= $day_low)
				{
					return "<font color='#33FF33'><b>Price Sell outside High Low range doesn't allow</b></font>" ;
				}
			break;
		}
	}
	
	//2)   
	if (!$closetrade)
	{
		if ($price > ($check_price[$action]+($spread*$multiplier)) || $price < ($check_price[$action]-($spread*$multiplier)))
		{	
			global $DB;
			if ($DB->close()){
			//tradeLog("hapus");
		}
		$ceilingUp = $check_price[$action]+($spread*$multiplier);
		$ceilingDown = $check_price[$action]-($spread*$multiplier);
		$desc_ceiling = $ceilingUp . ";" . $ceilingDown . ";" . $quantity . ";" . $action_type;
		$result_log_file = set_log_file($user->userid,'Trader','Price Limit Ceiling',$price,$desc_ceiling); 
		return "<font color='#33FF33'><b>Price changed please try again.</b></font>" ; 
	}
}
}

/*****************************************************************************
* Price checks for Orders
*****************************************************************************/ 

$isorderpass="notpass";

//Cek current pending cannot double
$cek_current_pending == 0;
//1.Cek same type
$query = "  select trade.* from trade 
	where trade.statusid='2' 
	and trade.account='$account' 				
	and trade.counterid = '$counterid' 
	and trade.typeorder = '$action_type' 
	and trade.liquidate_price = '$liquidate_price'";
//tradelog("trader-cek_current_pending=".$query);	
$result = $DB->query($query);	
while ($row = $DB->fetch_array($result))
{
	$cek_current_pending = 1;
}	


// 1)
$prices = fetchPrices();

// 2)
$query_cross = "SELECT * FROM dafile WHERE AccNo = '$account' ORDER BY ItemCode ASC";
$result_cross = $DB_odbc->query($query_cross);

$TotalFloating = 0;

while ($row = $DB_odbc->fetch_array($result_cross))
{
	$row[ItemCode] = trim($row[ItemCode]);
	$row[FLCOMM] = - $row[FLCOMM]; 
	if (trim($row[LiqStatus])=="")
	{
		if (trim($row[BuyDate]) != "")
		{
			$row[CurrentPrice] = number_format($prices[$row[ItemCode]][sell],$row[Format],".","");    
			$row[Floating] = ($row[CurrentPrice] - $row[BuyPrice]) * $row[Unit] * $row[LotSize];    
			if (preg_match("/^USD\/.+/",$row[ItemCode])) { $row[Floating] = $row[Floating] / $row[CurrentPrice];  }
			$TotalFloating += $row[Floating] + $row[FLCOMM];
			$newlimit[$row[ItemCode]] += $row[Unit]; // absolute hedging quantity of open positions for a counter.     
		}
		else
		{
			$row[CurrentPrice] = number_format($prices[$row[ItemCode]][buy],$row[Format],".","");
			$row[Floating] = ($row[SellPrice] - $row[CurrentPrice]) * $row[Unit] * $row[LotSize];
			if (preg_match("/^USD\/.+/",$row[ItemCode])) { $row[Floating] = $row[Floating] / $row[CurrentPrice];  }
			$TotalFloating += $row[Floating] + $row[FLCOMM];
			$newlimit[$row[ItemCode]] -= $row[Unit]; // absolute hedging quantity of open positions for a counter.   
		}
	}
}

$hedgeattempt = 0;

if ($newlimit[$counter]!=0)
{
	echo "Newlimit:<br>";
	switch($action)
	{
		case "buy":
			if (($quantity + $newlimit[$counter]) <= 0) // Check that user is attempting to hedge does not exceed his available hedgable quantity
			{
				$hedgeattempt = 1;
			}  
			break;
		
		case "sell":
			if (($newlimit[$counter] - $quantity) >= 0) // Check that user is attempting to hedge does not exceed his available hedgable quantity
			{
				$hedgeattempt = 1;
			}  
			break;
	}
}

$hedgeattempt = check_liquidpending($account,$counterid,$action_type,$price,$price_to,$quantity);

//return "<font color='red'><b>Test 491 Test</b></font><br>hedgeattempt= $hedgeattempt";

// $NOTFULLYHEDGE : If the positions are fully hedged, bypass equity ratio check, instead check for equity
if (count($newlimit)>0)
{
while (list($key, $val) = each($newlimit))
{
if ($val != "0")
{
$notfullyhedged = 1;
break;
}
}
}
// 3)
// Get temporary credit for this account
// $query = "SELECT credit FROM $mysql[database].tempcredit WHERE account = '$account'";
// $result = mysql_query($query);
// $row = mysql_fetch_array($result);
// $credit = $row[credit];
// unset($row);

$query = "SELECT NewBal FROM bafile WHERE AccNo = '$account'";
$result = $DB_odbc->query($query);
$row = $DB_odbc->fetch_array($result);
$row[NewBal] += $credit;
$row[Equity] = $row[NewBal] + $TotalFloating;
$newBalance = $row[NewBal];

switch($type)
{
/*****************************************************************************
* NEW                                                                        *
*****************************************************************************/
case "new":
//tambahan liqonly untuk yg product expired 080610
$query = "SELECT liqonly from counter where counterid = '$counterid'";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
	$liqonly = $row[liqonly];
}
if($liqonly=='yes'){
	$result_log_file = set_log_file($user->userid,'Trader','Ref(534)Product LiqOnly',$liqonly,$query);    
	return "<font color='red'><b>Ref(535) New position doesn't allow</b></font><br>This product can only do liquid";
}
//end tambahan liqonly untuk yg product expired 080610

$query = "SELECT DISTINCT(symbol) AS symbol FROM $mysql[database].counter WHERE active=1";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
$symbols[] = $row[symbol];
}

if ($DB_quote->close()){
//tradeLog("hapus");
}

// GET ALL PRICES FROM QUOTE
$query = "SELECT symbol, last FROM `quote` WHERE symbol IN ('".implode("','",$symbols)."')";
$result = $DB_quote->query($query);
while ($row = $DB_quote->fetch_array($result))
{
$quote[$row[symbol]] = $row[last];
} 

if (!$DB->close()){
//tradeLog("hapus DB2");
$DB->connect();
} 
$query = "SELECT name, symbol, spread FROM $mysql[database].counter WHERE active = 1"; 
// Assign buy/sell prices to counters
$result = $DB->query($query);
//tradelog("query=".$query);
while ($row = $DB->fetch_array($result))
{
//tradelog("xyz".$quote[$row[symbol]]);
$prices[$row[name]][sell] = $quote[$row[symbol]];
$prices[$row[name]][buy] = $quote[$row[symbol]] + $row[spread];
}


 #########################################
 
    $query = "SELECT Equity, MarginReq,PrevBal,NewBal FROM bafile WHERE AccNo = '$account'";
    
    $result = $DB_odbc->query($query);
    $row = $DB_odbc->fetch_array($result);
    $PrevBal=$row[PrevBal];	
    $NewBal=$row[NewBal];
    
    $row[Equity] += $credit;
    $effective_margin = $newBalance+$TotalFloating-$row[MarginReq];

    $margin_required = $marginday;
    
	//071018 untuk jltm	
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' and LiqStatus=''";
	//tradelog("validationtge-577=".$query);
	$result = $DB->query($query);
	$bypass = "notbypass";
	while ($row = $DB->fetch_array($result))
	{
		$bypass ="passmargin";
	}	
	if($bypass=="notbypass"){
		$min_margin = $margin_required * 2; //minimal bisa untuk 2 lot
		//tradelog("validationtge-586=".$effective_margin.";min_margin=".$min_margin.";qty=".$quantity);
		if ($type=='new' && $effective_margin < $min_margin && $quantity == '1'){					
			$query = "SELECT countertype from user where username = '$account' ";	
			$result = $DB->query($query);	
			while ($row = $DB->fetch_array($result))
			{   
				$ctrtype=explode(",",$row['countertype']);
			}
			$other_minimal_margin = $margin_required;
			//tradelog("validationtge-margin_required-587-".$margin_required);
			$all_counter = array();		
			for ($i_ctrtype=0; $i_ctrtype<count($ctrtype); $i_ctrtype++)
			{
				
				$query = "select counterid from counter,marketindex 
					where marketindex.exchangecode = '$ctrtype[$i_ctrtype]' 
					and counter.indexid = marketindex.indexid ";
				//tradelog("validationtge-query-595-".$query);			
				$result = $DB->query($query);
				while ($row = $DB->fetch_array($result))
				{ 	
					$all_counter[]= $row[counterid];
				}
			}
			for ($i_all_counter=0; $i_all_counter<count($all_counter); $i_all_counter++)
			{
				$the_counterid = $all_counter[$i_all_counter];			
				$query = "select counter_com.marginday from counter_com where counter like ('".$the_counterid."%') order by rolldate desc limit 0,1; ";	
				$result = $DB->query($query);
				while ($row = $DB->fetch_array($result))
				{   
					//tradelog("validationtge-marginday-608=".$the_counterid."=".$row[marginday]);	
					if($row[marginday]<$other_minimal_margin){
						$other_minimal_margin = $row[marginday];
					}	
				}							
			}
			$min_margin = $other_minimal_margin * 2; //minimal bisa untuk 2 lot
			//tradelog("validationtge-minimal_margin-624-min_margin-".$min_margin);	
			if($effective_margin < $min_margin){
			   	$result_log_file = set_log_file($user->userid,'Trader','Ref(930)Insufficient Funds',$price,$query_log);    
			    	showError("<font color='red'><b>Ref(930)Insufficient Funds</b></font><br>You do not have sufficient funds for margin more than 2 lot.");    				
			}
			//tradelog("validationtge-minimal_margin-602-minqty-".$minqty);		   	
		}
		if ($type=='new' && $quantity < $minqty){ 
		   	$result_log_file = set_log_file($user->userid,'Trader','Ref(934) Minimum Qty',$quantity,$minqty);    
		    	showError("<font color='red'><b>Ref(934) Minimum Qty</b></font><br>$quantity lot does not allow, minimum is $minqty lot");    	    		
		}
	}   
	//showError("<font color='red'><b>Ref(632) Test</b></font><br>$quantity lot does not allow, minimum is $minqty lot");    	    		
    //2.1)
    //tradelog("effective_margin=".$effective_margin. " and margin_required=".$margin_required." and quantity=".$quantity." PrevBal=".$PrevBal.";NewBal=".$NewBal);
    //return "<font color='red'><b>Test Insufficient Funds</b></font><br>Log Testing.";

    //tambahan marginrequirement untuk pending order 060713
	$query = "select counter.marginday,(counter.marginday*trade.quantity) as tot_marginday,
		trade.* 
		from trade,counter  
		where trade.statusid='2' and account='$account' 
		and trade.counterid=counter.counterid 
		and trade.type = 'new' 
		";
	//080907 ini jangan ditambah and trade.counterid = 'counterid' lagi nanti bla blas	
	//tradelog("trader-query-662=".$query);	
	//noted:margin hedge belum ada di table counter		
	$result = mysql_query($query);
	$subtot_margin_pending_requirement_buy = array();
	$subtot_margin_pending_requirement_sell = array();
	$subtot_qty_pending_requirement_buy = array();
	$subtot_qty_pending_requirement_sell = array();
	$subtot_typeorder_pending_requirement_buy = array();
	$subtot_typeorder_pending_requirement_sell = array();
	$subtot_price_pending_requirement_buy = array();
	$subtot_price_to_pending_requirement_buy = array();
	$subtot_price_pending_requirement_sell = array();
	$subtot_price_to_pending_requirement_sell = array();
	$subtot_floating_to_pending_requirement_buy_sell = array();
	$subtot_product = array();
	while ($row = mysql_fetch_array($result))
	{
		$subtot_product[] = $row[counterid];
		if ($row[action]=='buy'){
			$subtot_margin_pending_requirement_buy[] = $row[tot_marginday];
			$subtot_qty_pending_requirement_buy[] = $row[quantity];
			$subtot_typeorder_pending_requirement_buy[] = $row[typeorder];
			$subtot_price_pending_requirement_buy[] = $row[price];
			$subtot_price_to_pending_requirement_buy[] = $row[price_to];
		}else{	
			$subtot_margin_pending_requirement_sell[] = $row[tot_marginday];
			$subtot_qty_pending_requirement_sell[] = $row[quantity];
			$subtot_typeorder_pending_requirement_sell[] = $row[typeorder];
			$subtot_price_pending_requirement_sell[] = $row[price];
			$subtot_price_to_pending_requirement_sell[] = $row[price_to];
		}	
		for($z_count=0;$counter_temp[$z_count];$z_count++)
		{			
			if($counter_temp[$z_count][counter]==$row[counterid]){
				if($counter_commissions=='floating'){
					$subtot_floating_to_pending_requirement_buy_sell[] = $counter_temp[$z_count][close_comm]/100;
					//tradelog("validationtge-597-:$row[counterid]:".$counter_temp[$z_count][close_comm]/100);
				}		
			}	
		}
	} 
	
	$tot_floating_to_pending_requirement_buy_sell = 0;
	//total yg buy
		$tot_margin_requirement_buy = 0;
		$tot_qty_requirement_buy = 0;
		for ($i_margin_pending_req=0; $i_margin_pending_req<count($subtot_margin_pending_requirement_buy); $i_margin_pending_req++)
		{
	    		$tot_margin_requirement_buy = $tot_margin_requirement_buy + $subtot_margin_pending_requirement_buy[$i_margin_pending_req];
	    		//tradelog("validationtge-690-marginreq:".$subtot_margin_pending_requirement_buy[$i_margin_pending_req]);
	    		
	    		$tot_qty_requirement_buy = $subtot_qty_pending_requirement_buy[$i_margin_pending_req];
	    		//tradelog("validationtge-693-marginreq:".$tot_qty_requirement_buy);
	    		//tradelog("validationtge-floatincommision-694-:".$subtot_floating_to_pending_requirement_buy_sell[$i_margin_pending_req]);
	    		
	    		$tot_floating_to_pending_requirement_buy_sell = $tot_floating_to_pending_requirement_buy_sell + ($subtot_floating_to_pending_requirement_buy_sell[$i_margin_pending_req] * $tot_qty_requirement_buy);			
			//tradelog("validationtge-697:pending_margin_floating:".$tot_floating_to_pending_requirement_buy_sell);
	    	}
	//end  total yg buy   	
	//total yg sell
		$tot_margin_requirement_sell = 0;
		$tot_qty_requirement_sell = 0;
		for ($i_margin_pending_sell_req=0; $i_margin_pending_sell_req<count($subtot_margin_pending_requirement_sell); $i_margin_pending_sell_req++)
		{
	    		$tot_margin_requirement_sell = $tot_margin_requirement_sell + $subtot_margin_pending_requirement_sell[$i_margin_pending_sell_req];
	    		$tot_qty_requirement_sell = $tot_qty_requirement_sell + $subtot_qty_pending_requirement_sell[$i_margin_pending_sell_req];
	    		$tot_floating_to_pending_requirement_buy_sell = $tot_floating_to_pending_requirement_buy_sell + $subtot_floating_to_pending_requirement_buy_sell[$i_margin_pending_sell_req] * $tot_qty_requirement_sell;
	    		//tradelog("validationtge-subtot_margin_pending_requirement_sell-726-:".$subtot_margin_pending_requirement_sell[$i_margin_pending_sell_req]);
	    		//tradelog("validationtge-tot_qty_requirement_sell-727-:".$tot_qty_requirement_sell);
	    	}
	//end  total yg sell

	$tot_margin_requirement = 0;
	$tot_quantity_requirement = 0;
	//if pending order we not calculated as hedging
		$tot_margin_requirement = $tot_margin_requirement_buy + $tot_margin_requirement_sell;	
		$tot_quantity_requirement = $tot_qty_requirement_buy + $tot_qty_requirement_sell;
		//tradelog("trader-tot_margin_requirement_buy-735=".$tot_margin_requirement_buy);
		//tradelog("trader-tot_margin_requirement_sell-736=".$tot_margin_requirement_sell);
		//tradelog("trader-tot_margin_requirement-737=".$tot_margin_requirement);
		//tradelog("trader-tot_quantity_requirement-738=".$tot_quantity_requirement);
		
	//end if pending order we not calculated as hedging
	$bypass_permited_qty = 0;// ini untuk tanda boleh isi qty double	
	//Validation margin requirement
		$pending_margin_required = $margin_required;
		$pending_quantity = $quantity;
		//tradelog("bypass_permited_qty-897=".$bypass_permited_qty);
		//tradelog("trader-902");
		//1. Check per typeorder buy
			for ($i_validation_buy=0; $i_validation_buy<count($subtot_typeorder_pending_requirement_buy); $i_validation_buy++)
			{
				//1.1. If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
					//tradelog("trader-907=".$pending_quantity);
					//tradelog("trader-908=".$subtot_qty_pending_requirement_buy[$i_validation_buy]);
					if ($pending_quantity == $subtot_qty_pending_requirement_buy[$i_validation_buy] && $subtot_product[$i_validation_buy]==$counterid ){
						//1.1.1 Check buy_higher
							//tradelog("bypass_permited_qty-903=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_higher'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher' || $action_type=='sell_higher'){
									//tradelog("trader-notpass748");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='buy_range' || $action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price_to<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass753");
										$pending_margin_required = 0;
									}else{
										//not pass
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower' || $action_type=='sell_lower'){
									if($price<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass761");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass764");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_mo' || $action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass768");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.1 End Check buy_higher
						//1.1.2 Check buy_lower
							//tradelog("bypass_permited_qty-936=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_lower'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher' || $action_type=='sell_higher'){
									if($price>$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass778");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass781");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_range' || $action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price>$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass787");
										$pending_margin_required = 0;
									}else{
										tradelog("trader-notpass790");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower' || $action_type=='sell_lower'){
									//tradelog("trader-notpass794");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='buy_mo' || $action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass797");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.2 End Check buy_lower	
						//1.1.3 Check buy_range	
							//tradelog("bypass_permited_qty-970=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_range'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher' || $action_type=='sell_higher'){
									if($price>$subtot_price_to_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass806");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass809");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_range' || $action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price>$subtot_price_to_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass815");
										$pending_margin_required = 0;
									}elseif($price_to<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass818");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass821");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower' || $action_type=='sell_lower'){
									if($price<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass826");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass829");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_mo' || $action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass834");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.3 End Check buy_range	
						//1.1.4 Check buy_mo	
							//tradelog("bypass_permited_qty-1012=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_mo'){
								//tradelog("trader-notpass834");
								$bypass_permited_qty = 	$bypass_permited_qty + 1;
							}
						//1.1.4 End Check buy_mo																
					}else{
						//by pass validation langsung ke penjegalan
						$bypass_permited_qty = 	$bypass_permited_qty + 1;
						//tradelog("bypass_permited_qty-1030=".$bypass_permited_qty);
					}
					//tambahan 070112 jegal jika product berbeda
						$query_jegal = "select * from trade where account = '$account'  
								and counterid = '$counterid'  
								and statusid = '2' 
								and liquidate_price = '$liquidate_price'
								";
						//tradelog("trader-query_jegal-853=".$query_jegal);		
						//$result = mysql_query($query_jegal);
						//if (mysql_num_rows($result)==0)
 						//{		
 							//$bypass_permited_qty =  $bypass_permited_qty + 1; //ini untuk apa ya ?
 						//}
 						//tradelog("bypass_permited_qty-859=".$bypass_permited_qty);
					//End tambahan 070112 jegal jika product berbeda
				//1.1. End If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
			}
		//1. End Check per typeorder buy
		//2. Check per typeorder sell
			for ($i_validation_sell=0; $i_validation_sell<count($subtot_typeorder_pending_requirement_sell); $i_validation_sell++)
			{
				//2.1. If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
					if ($pending_quantity == $subtot_qty_pending_requirement_sell[$i_validation_sell] && $subtot_product[$i_validation_sell]==$counterid){
						//2.1.1 Check sell_higher
							//tradelog("bypass_permited_qty-870=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_higher'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type=".$action_type);
								if ($action_type=='sell_higher' || $action_type=='buy_higher'){
									//tradelog("trader-notpass859");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='sell_range' || $action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price_to<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass864");
										$pending_margin_required = 0;
									}else{
										//not pass
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower' || $action_type=='buy_lower'){
									if($price<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass872");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass875");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_mo' || $action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass879");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price-bypass_permited_qty-900=".$bypass_permited_qty);
							}
						//2.1.1 End Check sell_higher
						//2.1.2 Check sell_lower
							//tradelog("bypass_permited_qty-904=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_lower'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type=".$action_type);
								if ($action_type=='sell_higher' || $action_type=='buy_higher'){
									if($price>$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass889");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass892");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_range' || $action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price>$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass898");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass901");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower' || $action_type=='buy_lower'){
									//tradelog("trader-notpass905");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='sell_mo' || $action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass908");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
							}
						//2.1.2 End Check sell_lower	
						//2.1.3 Check sell_range	
							//tradelog("bypass_permited_qty-938=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_range'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type-971=".$action_type);
								if ($action_type=='sell_higher' || $action_type=='buy_higher'){
									if($price>$subtot_price_to_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass918");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass921");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_range' || $action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price>$subtot_price_to_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass927");
										$pending_margin_required = 0;
									}elseif($price_to<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass930");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass933");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower' || $action_type=='buy_lower'){
									if($price<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass938");
										$pending_margin_required = 0;
									}else{
										//tradelog("trader-notpass941");
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_mo' || $action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass945");
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
							}
						//2.1.3 End Check sell_range	
						//2.1.4 Check sell_mo	
							//tradelog("bypass_permited_qty-980=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_mo'){
								//tradelog("trader-notpass952");
								$bypass_permited_qty = 	$bypass_permited_qty + 1;
							}
						//2.1.4 End Check sell_mo																
					}else{
						//by pass validation langsung ke penjegalan
						$bypass_permited_qty = 	$bypass_permited_qty + 1;
						//tradelog("bypass_permited_qty-1170=".$bypass_permited_qty);
					}
					//tambahan 070112 jegal jika product berbeda
						$query_jegal = "select * from trade where account = '$account'  
								and counterid = '$counterid'  
								and statusid = '2' 
								and liquidate_price = '$liquidate_price' 
								";
						//tradelog("trader-query_jegal-997=".$query_jegal);		
						$result = mysql_query($query_jegal);
						if (mysql_num_rows($result)==0)
 						{		
 							//$bypass_permited_qty = 	$bypass_permited_qty + 1;
 						}
 						//tradelog("bypass_permited_qty-1003=".$bypass_permited_qty);
					//End tambahan 070112 jegal jika product berbeda
				//2.1. End If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
			}		
		//2. End Check per typeorder sell

	//End Validation margin requirement

        //tambahan penjegalan terlalu banyak pending order untuk Future
        	if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	       		$campuran = "eff.margin=".$effective_margin.";tot_margin_requirement=".$tot_margin_requirement.";tot_floating_to_pending_requirement_buy_sell=".$tot_floating_to_pending_requirement_buy_sell;
	       		$pending_effective_margin = $effective_margin - $tot_floating_to_pending_requirement_buy_sell;
	       		$campuran = $campuran.";pending_effective_margin=".$pending_effective_margin;	       		
	       		$tot_floating_pending_margin_required =  $pending_float_comission_required * $pending_quantity;
	       		$campuran = $campuran .";tot_floating_pending_margin_required=".$tot_floating_pending_margin_required;
	       		$campuran = $campuran .";pending_margin_required=".$pending_margin_required;
	       		$campuran = $campuran .";pending_quantity=".$pending_quantity;
	       		$tot_pending_margin_required = $pending_margin_required * $pending_quantity + $tot_floating_pending_margin_required;
	       		//tradelog("trader-1050-pending_margin_required=".$pending_margin_required);	
	       		//tradelog("trader-1051-pending_quantity=".$pending_quantity);
	       		//tradelog("trader-1052-tot_floating_pending_margin_required=".$tot_floating_pending_margin_required);       		
	       		$campuran = $campuran .";tot_pending_margin_required=".$tot_pending_margin_required;
	       		$campuran = $campuran .";NewBal=".$NewBal;
	       		$campuran = $campuran .";PrevBal=".$PrevBal;
	       		$campuran = $campuran .";hedgeattempt=".$hedgeattempt;
	       		$campuran = $campuran .";margin_required=".$margin_required;
	       		$campuran = $campuran .";hedgeattempt=".$hedgeattempt;
	       		$result_log_file = set_log_file($user->userid,'Trader','tgecheck',$tradeid,$campuran);   
	       		//tradelog("trader-1055-pending_effective_margin=".$pending_effective_margin);//125.500
       			//tradelog("trader-1056-tot_pending_margin_required=".$tot_pending_margin_required);//110.000
       			//tradelog("trader-1057-quantity=".$quantity.":".$tot_margin_requirement); //2:50.000
	       			
	       		if ( ($pending_effective_margin >= $tot_pending_margin_required) && ($tot_pending_margin_required<=$NewBal) )
	       		{
	       			//pass
	       			//tradelog("trader-1058-pending_effective_margin=".$pending_effective_margin);//128.500.27
	       			//tradelog("trader-1059-tot_pending_margin_required=".$tot_pending_margin_required);//80.000
	       			//tradelog("trader-1060-quantity=".$quantity.":".$tot_margin_requirement); //1:/75000

	       			$sisa = $pending_effective_margin  - ($quantity * $tot_margin_requirement) - $tot_pending_margin_required;
				//tradelog("trader-didalam-1101-bypass_permited_qty=".$bypass_permited_qty);
				//tradelog("trader-didalam-1102-sisa=".$sisa);
				if($sisa<0 && $hedgeattempt!=1 ){
					$result_log_file = set_log_file($user->userid,'Trader','Ref(1063)Insufficient Funds',$price,$query_log);    
					return "<font color='red'><b>Ref(1078) Insufficient Funds</b></font><br>You do not have sufficient funds , please remove some of your Pending Order.";
				}			
	       		}
	       		elseif ( ($pending_effective_margin < $tot_pending_margin_required) || ($tot_pending_margin_required>$PrevBal)  )
	       		{			
				
				if ($hedgeattempt==1)
				{
					//pass
					//tradelog("trader-apakah order pending diterima - 1177 - karena hedging");					
				}
				else{
					//tradelog("trader-effective_margin=".$effective_margin.";margin_required=".$margin_required.";quantity=".$quantity.";NewBal=".$NewBal);
					//tradelog("trader-tot_floating_pending_margin_required=".$tot_floating_pending_margin_required);			
					//tradelog("trader-ini bukan hedging 1182");
					
					if (($effective_margin >= ($margin_required * $quantity + $tot_floating_pending_margin_required)) && (($margin_required * $quantity + $tot_floating_pending_margin_required)<=$NewBal))
	    				{
						//tradelog("trader-didalam-1195-bypass_permited_qty=".$bypass_permited_qty);
						if($bypass_permited_qty=='0'){
							//pass karena sebelumnya sudah ada qty dan tidak bentrok
						}else{
							$result_log_file = set_log_file($user->userid,'Trader','Ref(1098)Insufficient Funds',$price,$query_log);    
							return "<font color='red'><b>Ref(1059) Insufficient Funds</b></font><br>You do not have sufficient funds, please remove some of your Pending Order.";
						}
					}else{
						$result_log_file = set_log_file($user->userid,'Trader','Ref(1071)Insufficient Funds',$price,$query_log);    
						return "<font color='red'><b>Ref(1071) Insufficient Funds</b></font><br>You do not have sufficient funds,Eff Margin now is $effective_margin ,margin req. need another $tot_pending_margin_required";
					}	
					//return "<font color='red'><b>Ref(947) Test Debug</b></font><br>Ask admin to remove this bug.";
				}
				//return "<font color='red'><b>Ref(949) Test</b></font><br>hedgeattempt=$hedgeattempt";
	       		}
	       		//tradelog("trader-lolos kelulusan effective margin-1194");
	       	}	
        //end tambahan penjegalan terlalu banyak pending order

    //End. tambahan marginrequirement untuk pending order 060713
    
    
//return "<font color='red'><b>Ref(1101) Test</b></font><br>sisa=$sisa";    
    
    
//effective_margin=34829.86 and margin_required=100 and quantity=1 PrevBal=61443.13  
if (($effective_margin >= ($margin_required * $quantity)) && (($margin_required * $quantity)<=$NewBal))
{
//tradelog("duration=".$duration);
if (empty($duration)) // Immediate trade
{
if ($query_directdone=="yes"){
$ta_message[message] = "<font color='red'><b>Order Processing1</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>Please allow a few moments for system update.<br><br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 3; // Processing
}else{
if ($language->languageid=="1" ){			
$ta_message[message] = "<font color='red'><b>Ref(1288) Please wait 1</b></font><br>Please allow a few moments for system update<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
}
if ($language->languageid=="2" ){
$ta_message[message] = "<font color='red'><b>Ref(1288) Please wait 1</b></font><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
}	 
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 8; // Waiting Dealing to Answer      
}	   
}
else // Queue Order
{
//tradelog("trader-02");
if ($action_type=='oco_sell' || $action_type=='oco_buy')
{
$ta_message[message] = "<font color='red'><b>Ref(1100)Order Pending1</b></font><br>Your order for account ($account),<br>$action_type ($quantity) of $counter Limit($price) and Stop ($price_to)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.";
}else{
$ta_message[message] = "<font color='red'><b>Ref(1102)Order Pending1</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.";      
}      
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 2; // Pending      
}
}

//2.2

elseif ($effective_margin < ($margin_required * $quantity) || (($margin_required * $quantity)>$PrevBal)  )
{     
// Allow user to bypass EM check if he's attempting to hedge
//tradelog("trader 2.2=".$margin_required.";".$quantity.";".$PrevBal);
if ($hedgeattempt==1)
{    
if (empty($duration)) // Immediate trade
{      	
if ($query_directdone=="yes"){
$ta_message[message] = "<font color='red'><b>Order Processing2</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>Please allow a few moments for system update.<br><br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";    		
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 3; // Processing
}else{
if ($language->languageid=="1" ){
$ta_message[message] = "<font color='red'><b>Ref(1328) Please wait 2</b></font><br>Please allow a few moments for system update.<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";    		
}
if ($language->languageid=="2" ){
$ta_message[message] = "<font color='red'><b>Ref(1328) Please wait 2</b></font><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;.<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";    		
}	      		
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 8; // Waiting Dealing To Answer
}      		
}
else{
$ta_message[message] = "<font color='red'><b>Order Pending2</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.";      		
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 2; // Pending
}    
}  
else{
$query_log = "e.m=" . $effective_margin;
$query_log = $query_log . ";m.req=" . $margin_required;
$query_log = $query_log . ";qty=" . $quantity;
$query_log = $query_log . ";PrevBal=" . $PrevBal;
$query_log = $query_log . ";action=" . $action;
$result_log_file = set_log_file($user->userid,'Trader','Ref(1174)Insufficient Funds',$price,$query_log);    
return "<font color='red'><b>Ref(1174)Insufficient Funds</b></font><br>You do not have sufficient funds.";
}

}

//return "<font color='red'><b>(1194) Test</b></font><br>End of new transaction.";   
// tradelog("xxx");
break; // End new

/*****************************************************************************
* LIQUIDATE                                                                  *
*****************************************************************************/
case "liquidate":
	$reference = explode("_",$liquidate_ref);
	$order_date = $reference[0];
	$order_ref = $reference[1];
	$unique_ref = $order_date . "_" . $order_ref; // 20040506_48
	unset($reference);

switch($action)
{
	case "buy":
		$reftype = "SellOrder";
		$refdatetype = "SellDate";
	break;
	case "sell":
		$reftype = "BuyOrder";
		$refdatetype = "BuyDate";
	break;
}

$query = "SELECT Unit,*
	FROM dafile
	LEFT JOIN bafile ON dafile.AccNo = bafile.AccNo
	WHERE
	dafile.$reftype = $order_ref
	AND dafile.$refdatetype = '$order_date'
	AND dafile.LiqStatus = ''";
$row = $DB_odbc->query_first($query);
$row[Unit] = round($row[Unit]);

// Adjust quantities if MDB quantity has been adjusted
if (($row[Unit] < $quantity)  )
{
	return "<font color=red><b>Outdated Position</b></font><br>The position you are attempting to trade does not exist; or has been liquidated already.";
}

//1)
switch ($action)
{
	case "buy":
		$query = "SELECT Unit,SellPrice AS price FROM dafile WHERE AccNo = '$account' AND SellDate='$order_date' AND SellOrder=$order_ref AND LiqStatus=''";
	break;
	
	case "sell":
		$query = "SELECT Unit,BuyPrice AS price FROM dafile WHERE AccNo = '$account' AND BuyDate='$order_date' AND BuyOrder=$order_ref AND LiqStatus=''";
	break;
}
$result = $DB_odbc->query( $query);
$row = $DB_odbc->fetch_array($result);
$liquidate_quantity = $row[Unit];
$liquidate_price = $row[price]; // Buy/Sell price of current open position

//1a)####### Close Pair Trades
//1a.1) Break down $closetrade into relevant references
//1a.2) Use references to query MDB to get the trade details
//1a.3) Get all pending orders for secondary trades - and deduct.
//1a.4) Compare quantity with primary trade. Choose the lower quantity, whichever is lower (primary or secondary)
//1a.5) With trade details, formulate the query for a opposing secondary trade

if ($closetrade) // Closetrade is present
{
	//1a.1)
	$closereference = explode("_",$closetrade);
	$close[date] = $closereference[0];
	$close[ref] = $closereference[1];
	unset($closereference);

	//1a.2) Get details of closetrade (Unit, Price, Ref)
	switch ($action)
	{
		case "buy":
			$query = "SELECT Unit,BuyPrice AS liquidate_price FROM dafile WHERE AccNo = '$account' AND BuyDate='$close[date]' AND BuyOrder=$close[ref]";
			$close[action]="sell";
			$close[price]=round(($price-$spread),$decimal);
		break;
		case "sell":
			$query = "SELECT Unit,SellPrice AS liquidate_price FROM dafile WHERE AccNo = '$account' AND SellDate='$close[date]' AND SellOrder=$close[ref]";
			$close[action]="buy";
			$close[price]=round(($price+$spread),$decimal);      
			break;
	}
	$result = $DB_odbc->query( $query);
	$row = $DB_odbc->fetch_array($result);
	$close[quantity] = round($row[Unit]);
	$close[liquidate_price] = $row[liquidate_price];
	//1a.3)
	switch ($action)
	{
		case "buy":
			$query = "SELECT
			SUM(quantity) AS pendingquantity
			FROM $mysql[database].trade
			WHERE account = '$account'
			AND action = 'sell'
			AND type = 'liquidate'
			AND statusid = 2
			AND isorder = '1'";
		break;
		case "sell":
			$query = "SELECT
			SUM(quantity) AS pendingquantity
			FROM $mysql[database].trade
			WHERE account = '$account'
			AND action = 'buy'
			AND type = 'liquidate'
			AND statusid = 2
			AND isorder = '1'";
		break;
	}
	$result = $DB->query($query);
	if ($DB->num_rows($result)>0)
	{
		$row = $DB->fetch_array($result);
		$pendingquantity = $row[pendingquantity];
	}

	//1a.4) 
	if (($close[quantity] - $pendingquantity)>0)
	{   
		if ($quantity > ($close[quantity] - $pendingquantity)) { $quantity = ($close[quantity] - $pendingquantity); }
	}
	else
	{
		return "<font color=red><b>Pending positions exist</b></font><br>The close pair trade you are attempting already has standing orders. You need to remove them in order to continue.";
	}
} // end Close Pair Trades   

//2.1)
$query = "SELECT SUM(quantity) AS processing_quantity  FROM trade WHERE account='$account' AND liquidate_ref LIKE '$unique_ref%' AND statusid = 3";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$processing_quantity = $row[processing_quantity];
//echo "processing quantity: $processing_quantity";
$permitted_quantity = $liquidate_quantity - $processing_quantity;

//2.2)
$pending_quantity = 0;
$query = "SELECT max(quantity) AS pending_quantity  FROM trade WHERE account='$account' AND liquidate_ref LIKE '$unique_ref%' AND statusid = 2 and trade.refoco is not null";
//tradelog("trader1243=".$query);
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($_harga=="empty" || $_harga=="")
{
	$pending_quantity = $pending_quantity + $row[pending_quantity];
}

$query = "SELECT SUM(quantity) AS pending_quantity  FROM trade WHERE account='$account' AND liquidate_ref LIKE '$unique_ref%' AND statusid = 2 and trade.refoco is null";
//tradelog("trader1249=".$query);
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$isoco=0;
if($_harga=="empty" || $_harga=="")
{ 
	$pending_quantity = $pending_quantity + $row[pending_quantity];
}
else
{
	if (!$isorder)
	{
		$_query = "UPDATE trade SET statusid = 0 WHERE tradeid = {$_harga}";
		$_result = mysql_query($_query); 
	}
	else
	{
		$isoco=1;
	}
	$query = "SELECT AccNo,ItemCode,Unit,BuyOrder,BuyPrice,BuyDate,SellOrder,SellPrice,SellDate FROM dafile WHERE (LiqStatus = '') AND AccNo = '$account' ORDER BY ItemCode";
}

//tradelog("trader-1266-liquidate_quantity=".$liquidate_quantity.";pending_quantity=".$pending_quantity);
$permitted_pending = $liquidate_quantity - $pending_quantity;   
//2.3)
$final_quantity = $processing_quantity + $pending_quantity;
//tradelog("trader-1266-processing_quantity=".$processing_quantity.";final_quantity=".$final_quantity);
$permitted_final = $liquidate_quantity - $final_quantity;
//tradelog("trader-1266-permitted_final=".$permitted_final);

 
//Future Liquid 061006
if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	//1.Future Cek current pending cannot double
		$query = "  select trade.* from trade 
			where trade.statusid='2' 
			and trade.account='$account' 			
			and trade.counterid = '$counterid' 
			and trade.typeorder = '$action_type' 
			and trade.liquidate_price = '$liquidate_price'";
		//tradelog("trader-cek_current_pending=".$query);	
		$result = $DB->query($query);	
		while ($row = $DB->fetch_array($result))
		{		
			$cek_current_pending = 1;
			//tradelog("trader-cek_action_type-1341=".$action_type);
			//tradelog("trader-cek_groupid-1342=".$user->groupid);
			if ( $action_type=="sell_range" || $action_type=="buy_range" ){
				$cek_current_pending = 0;	
			}
		}	
		if ($cek_current_pending==1 ){
			return "<font color='red'><b>Ref.1467 Double Type Liquid</b></font><br>You cannot create another pending order with the same type."; 
			exit;
		}		
	//1.End Future Cek current pending cannot double	
	
	$query = "select counter.marginday,(counter.marginday*trade.quantity) as tot_marginday,
		trade.* 
		from trade,counter  
		where trade.statusid='2' and account='$account' 
		and trade.counterid = '$counterid' 
		and trade.counterid=counter.counterid 
		and trade.type = 'liquidate' 
		";
	//tradelog("trader-query=".$query);	
	//noted:margin hedge belum ada di table counter		
	$result = mysql_query($query);
	$subtot_margin_pending_requirement_buy = array();
	$subtot_margin_pending_requirement_sell = array();
	$subtot_qty_pending_requirement_buy = array();
	$subtot_qty_pending_requirement_sell = array();
	$subtot_typeorder_pending_requirement_buy = array();
	$subtot_typeorder_pending_requirement_sell = array();
	$subtot_price_pending_requirement_buy = array();
	$subtot_price_to_pending_requirement_buy = array();
	$subtot_price_pending_requirement_sell = array();
	$subtot_price_to_pending_requirement_sell = array();
	while ($row = mysql_fetch_array($result))
	{
		if ($row[action]=='buy'){
			$subtot_margin_pending_requirement_buy[] = $row[tot_marginday];
			$subtot_qty_pending_requirement_buy[] = $row[quantity];
			$subtot_typeorder_pending_requirement_buy[] = $row[typeorder];
			$subtot_price_pending_requirement_buy[] = $row[price];
			$subtot_price_to_pending_requirement_buy[] = $row[price_to];
		}else{	
			$subtot_margin_pending_requirement_sell[] = $row[tot_marginday];
			$subtot_qty_pending_requirement_sell[] = $row[quantity];
			$subtot_typeorder_pending_requirement_sell[] = $row[typeorder];
			$subtot_price_pending_requirement_sell[] = $row[price];
			$subtot_price_to_pending_requirement_sell[] = $row[price_to];
		}	
	} 
	//total yg buy
		$tot_margin_requirement_buy = 0;
		$tot_qty_requirement_buy = 0;
		for ($i_margin_pending_req=0; $i_margin_pending_req<count($subtot_margin_pending_requirement_buy); $i_margin_pending_req++)
		{
	    		$tot_margin_requirement_buy = $tot_margin_requirement_buy + $subtot_margin_pending_requirement_buy[$i_margin_pending_req];
	    		$tot_qty_requirement_buy = $tot_qty_requirement_buy + $subtot_qty_pending_requirement_buy[$i_margin_pending_req];
	    	}
	//end  total yg buy   	
	//total yg sell
		$tot_margin_requirement_sell = 0;
		$tot_qty_requirement_sell = 0;
		for ($i_margin_pending_sell_req=0; $i_margin_pending_sell_req<count($subtot_margin_pending_requirement_sell); $i_margin_pending_sell_req++)
		{
	    		$tot_margin_requirement_sell = $tot_margin_requirement_sell + $subtot_margin_pending_requirement_sell[$i_margin_pending_sell_req];
	    		$tot_qty_requirement_sell = $tot_qty_requirement_sell + $subtot_qty_pending_requirement_sell[$i_margin_pending_sell_req];
	    	}
	//end  total yg sell

	$tot_margin_requirement = 0;
	$tot_quantity_requirement = 0;
	//if pending order we not calculated as hedging
		$tot_margin_requirement = $tot_margin_requirement_buy + $tot_margin_requirement_sell;	
		$tot_quantity_requirement = $tot_qty_requirement_buy + $tot_qty_requirement_sell;
	//end if pending order we not calculated as hedging
	//tradelog("trader-tot_margin_requirement-1533=".$tot_margin_requirement); //30.000
	//tradelog("trader-tot_quantity_requirement-1534=".$tot_quantity_requirement); //6.000
	$bypass_permited_qty = 0; //artinya belum ada double so still can pass
	//Validation margin requirement
		$pending_margin_required = $margin_required;
		$pending_quantity = $quantity;
		//tradelog("bypass_permited_qty-1577=".$bypass_permited_qty);
		//1. Check per typeorder buy
			for ($i_validation_buy=0; $i_validation_buy<count($subtot_typeorder_pending_requirement_buy); $i_validation_buy++)
			{
				//1.1. If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
					if ($pending_quantity == $subtot_qty_pending_requirement_buy[$i_validation_buy]){
						//1.1.1 Check buy_higher
							//tradelog("bypass_permited_qty-1584=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_higher'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher'){
									//tradelog("trader-notpass748");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;							
								}
								if ($action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price_to<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass753");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//not pass
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower'){
									if($price<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass761");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass764");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass768");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.1 End Check buy_higher
						//1.1.2 Check buy_lower
							//tradelog("bypass_permited_qty-1624=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_lower'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher'){
									if($price>$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass778");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass781");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price>$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass787");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass790");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower'){
									//tradelog("trader-notpass794");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass797");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.2 End Check buy_lower	
						//1.1.3 Check buy_range	
							//tradelog("bypass_permited_qty-1664=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_range'){
								//tradelog("trader-subtot_typeorder_pending_requirement_buy-action_type=".$action_type);
								if ($action_type=='buy_higher'){
									if($price>$subtot_price_to_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass806");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass809");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
									if($price>$subtot_price_to_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass815");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}elseif($price_to<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass818");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass821");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='buy_lower'){
									if($price<$subtot_price_pending_requirement_buy[$i_validation_buy]){
										//tradelog("trader-pass826");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass829");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='buy_mo'){ //Any Price
									//tradelog("trader-notpass834");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_buy=".$subtot_price_pending_requirement_buy[$i_validation_buy]);
							}
						//1.1.3 End Check buy_range	
						//1.1.4 Check buy_mo
							//tradelog("bypass_permited_qty-1714=".$bypass_permited_qty);	
							if ($subtot_typeorder_pending_requirement_buy[$i_validation_buy]=='buy_mo'){
								//tradelog("trader-notpass834");
								$bypass_permited = 'double_so_cannot_pass';
								$bypass_permited_qty = 	$bypass_permited_qty + 1;
							}
						//1.1.4 End Check buy_mo																
					}else{
						tradelog("bypass_permited_qty-1722=".$bypass_permited_qty);
						//by pass validation langsung ke penjegalan
						$bypass_permited = 'double_so_cannot_pass'; //kalo qty beda ga boleh aja, bikin bingun aja
						$bypass_permited_qty = 	$bypass_permited_qty + 1;
					}
				//1.1. End If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
			}
		//1. End Check per typeorder buy
		//tradelog("bypass_permited_qty-1725=".$bypass_permited_qty);
		//2. Check per typeorder sell			
			for ($i_validation_sell=0; $i_validation_sell<count($subtot_typeorder_pending_requirement_sell); $i_validation_sell++)
			{
				//2.1. If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
					//tradelog("trader_liquid-1652-pending_quantity=".$pending_quantity.";qty_ygsudahpending=".$subtot_qty_pending_requirement_sell[$i_validation_sell] );
					if ($pending_quantity == $subtot_qty_pending_requirement_sell[$i_validation_sell]){
						//2.1.1 Check sell_higher
							//tradelog("bypass_permited_qty-1738=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_higher'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type=".$action_type);
								if ($action_type=='sell_higher'){
									//tradelog("trader-notpass859");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price_to<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass864");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//not pass
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower'){
									if($price<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass872");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass875");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass879");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
							}
						//2.1.1 End Check sell_higher
						//tradelog("trader-liquid-bypass-1712=".$bypass_permited);
						//2.1.2 Check sell_lower
							//tradelog("bypass_permited_qty-1779=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_lower'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type=".$action_type);
								if ($action_type=='sell_higher'){
									if($price>$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass889");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass892");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price>$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass898");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass901");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower'){
									//tradelog("trader-notpass905");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								if ($action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass908");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
							}
						//2.1.2 End Check sell_lower	
						//2.1.3 Check sell_range
							//tradelog("bypass_permited_qty-1819=".$bypass_permited_qty);	
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_range'){
								//tradelog("trader-subtot_typeorder_pending_requirement_sell-action_type=".$action_type);
								if ($action_type=='sell_higher'){
									if($price>$subtot_price_to_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass918");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass921");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_range'){
								        //tradelog("trader-price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
									if($price>$subtot_price_to_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass927");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}elseif($price_to<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass930");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass933");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}									
								}
								if ($action_type=='sell_lower'){
									if($price<$subtot_price_pending_requirement_sell[$i_validation_sell]){
										//tradelog("trader-pass938");
										$pending_margin_required = 0;
										$bypass_permited = 'pleasebypass';
									}else{
										//tradelog("trader-notpass941");
										$bypass_permited = 'double_so_cannot_pass';
										$bypass_permited_qty = 	$bypass_permited_qty + 1;
									}
								}
								if ($action_type=='sell_mo'){ //Any Price
									//tradelog("trader-notpass945");
									$bypass_permited = 'double_so_cannot_pass';
									$bypass_permited_qty = 	$bypass_permited_qty + 1;
								}
								//tradelog("trader-price=".$price.";price_to=".$price_to.";subtot_price_pending_requirement_sell=".$subtot_price_pending_requirement_sell[$i_validation_sell]);
							}
						//2.1.3 End Check sell_range	
						//2.1.4 Check sell_mo	
							//tradelog("bypass_permited_qty-1869=".$bypass_permited_qty);
							if ($subtot_typeorder_pending_requirement_sell[$i_validation_sell]=='sell_mo'){
								//tradelog("trader-notpass952");
								$bypass_permited = 'double_so_cannot_pass';
								$bypass_permited_qty = 	$bypass_permited_qty + 1;
							}
						//2.1.4 End Check sell_mo																
					}else{
						tradelog("bypass_permited_qty-1877=".$bypass_permited_qty);
						//by pass validation langsung ke penjegalan
						$bypass_permited = 'double_so_cannot_pass'; //kalo Qty beda maka ga boleh bikin bingung aja
						$bypass_permited_qty = 	$bypass_permited_qty + 1;
					}
				//2.1. End If Qty beda maka tidak perlu di check lagi langsung by pass validation margin requirement
				//tradelog("bypass_permited_qty-1863=".$bypass_permited_qty);
				if($bypass_permited_qty > 0){	
					//Dibawah ini di comment untuk Liquid, biarin aja double, toh nanti di check lagi Qty opennya kalo cukup ok, kalo tidak order di Remove		
					//return "<font color='red'><b>(1805)Notice</b></font><br>You already have 'pending' orders for this position. Which is the Price can be hit more than 1 time. Please try another"; 
				}
			}		
		//2. End Check per typeorder sell	
	//End Validation margin requirement			

}
//End Future Liquid 061006

//3.1)
if ($permitted_quantity==0)
{
	return "<font color='red'><b>Notice</b></font><br>This position has been liquidated. Please allow the system a few moments to update.";    
}

//3.2)

if($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	//bypass karena masalah double sudah di cek di atas
}else{ 
	if($quantity>$permitted_pending && ( $_harga=="empty" || $_harga=="" ) ) 
	{ 		
		if ($_type=="liquidate" && $_duration==""){
			if($query_directdone=="yes"){
				if(	   $user->companygroup!="hodsburgh" 
					&& $user->companygroup!="agrodana" 
					&& $user->companygroup!="cayman" 
					&& $user->companygroup!="danareksa" 
				){
					$requirement_pending = $quantity - $permitted_pending;
					$query_select_pending = "select trade.* from trade where account='$_account' and statusid ='2' order by trade.tradeid asc";
					$result_select_pending = $DB->query($query_select_pending);
					$pending_tradeid = array();
					$pending_quantity = array();
					while ($row_select_pending = $DB->fetch_array($result_select_pending))
					{
						$pending_tradeid[] = $row_select_pending[tradeid];
						$pending_quantity[] = $row_select_pending[quantity];
					}
					$DB->close(); 
					for ($i_count=0; $i_count<count($pending_tradeid); $i_count++)
					{
						if($requirement_pending>$pending_quantity[$i_count]){
							$pending_hapus = $pending_quantity[$i_count];
							$requirement_pending  = $requirement_pending - $pending_quantity[$i_count];
						}else{
							$pending_hapus = $requirement_pending;
							$requirement_pending = 0;
						}
						$new_pending_quantity = $pending_quantity[$i_count] - $pending_hapus;
						if($new_pending_quantity<=0){
							$query_update_new_pending = "update trade set quantity = '0',statusid = '0' where tradeid = '$pending_tradeid[$i_count]';";
						}else{
							$query_update_new_pending = "update trade set quantity = '$new_pending_quantity' where tradeid = '$pending_tradeid[$i_count]';";
						}	
						$DB->query($query_update_new_pending); 
					}
					$permited_final_bypass="bypass";
				}else{
					return "<font color='red'><b>(1218)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
				}
			}else{
				return "<font color='red'><b>(1221)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
			}	
		}
		else{
			return "<font color='red'><b>(1225)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
		}
	}
}	


//3.3)
//tradelog("trader-liquid-bypass-1835=".$quantity.";permitted_final=".$permitted_final );

if($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	if($bypass_permited_qty==0){
		$permitted_final = $quantity ;//ini dibuat sama dengan quantity agar boleh insert lagi, toh tidak akan bentrok
	}
}

if ($quantity > $permitted_final )
{
	//tradelog("validationtrade-1194-quantity-".$quantity.";permitted_final=".$permitted_final);
	if($permited_final_bypass!="bypass"){
		return "<font color='red'><b>Ref.1837 Notice</b></font><br>You have exceeded your allowed<br>quantity for the position: <b>($counter) $liquidate_price ,$permitted_final,$quantity,$order_date,$order_ref,$liquidate_quantity,$final_quantity, $processing_quantity, $pending_quantity</b>";
	}
}

//tambahan supaya ga liquid position pending pada saat new pending sudah ada 080507
	if($action=='buy'){
		$new_liquid_qty = $quantity; //pertama masuk quantity yg akan di liquid,buy positif		
	}else{
		$new_liquid_qty = -1 * $quantity; //pertama masuk quantity yg akan di liquid,sell minus
	}
	$harus_di_check_new_position = check_newpending($account,$counterid,$action_type,$price,$price_to);
	$query_cross = "SELECT * FROM trade WHERE account = '$account' and counterid = '$counterid'  and type = 'new' and statusid = '2' ";
	if($harus_di_check_new_position!=''){
		$query_cross = $query_cross . " and tradeid not in (".$harus_di_check_new_position.")";
	}
	//bagian ini cek new nya harus cek liquid pending yg lain	
	$query_cross = $query_cross . " ORDER BY tradeid ASC";
	//tradelog("validationtge-1861=".$query_cross);
	$result_cross = $DB->query($query_cross);
	$harus_di_check_new_position = "tidak_check";	
	while ($row = $DB->fetch_array($result_cross))
	{
		$harus_di_check_new_position = "harus_check";
		if($row[action]=='buy'){
			$new_liquid_qty = $new_liquid_qty + $row[quantity];
			$query_cross_liquid = "SELECT quantity,duration,left(liquidate_ref,13) as liquidate_ref FROM trade WHERE account = '$account' and counterid = '$counterid'  and action = 'buy' and type = 'liquidate' and statusid = '2' and liquidate_ref not like ('$unique_ref%')  ";
		}else{
			$new_liquid_qty = $new_liquid_qty - $row[quantity];
			$query_cross_liquid = "SELECT quantity,duration,left(liquidate_ref,13) as liquidate_ref FROM trade WHERE account = '$account' and counterid = '$counterid'  and action = 'sell' and type = 'liquidate' and statusid = '2' and liquidate_ref not like ('$unique_ref%')  ";
		}
		$query_cross_liquid = $query_cross_liquid ." union " .$query_cross_liquid;
	}
	
	//return "<font color='red'><b>(1867)test</b></font><br>harus_di_check_new_position_test=$harus_di_check_new_position_test";	
	//bagian ini cek new nya harus cek liquid pending yg lain
	if($harus_di_check_new_position=="harus_check"){
		//1.check jumlah open
		$query_cross = "SELECT * FROM dafile WHERE AccNo = '$account' and ItemCode = '$counterid' ORDER BY ItemCode ASC";
		$result_cross = $DB->query($query_cross);
		while ($row = $DB->fetch_array($result_cross))
		{
			if (trim($row[LiqStatus])=="")
			{
				if (trim($row[BuyDate]) != "")
				{
					$new_liquid_qty += $row[Unit]; // absolute hedging quantity of open positions for a counter.     
				}
				else
				{
					$new_liquid_qty -= $row[Unit]; // absolute hedging quantity of open positions for a counter.   
				}
			}
		}
		//2.check jumlah liquid
		$result_cross = $DB->query($query_cross_liquid);
		while ($row = $DB->fetch_array($result_cross))
		{
			if($action=='buy'){
				$new_liquid_qty += $row[quantity];
			}else{
				$new_liquid_qty -= $row[quantity];
			}
		}
		if($new_liquid_qty!=0){
			//artinya harus full margin
			$broker = new broker;
			$broker_counters = $broker->fetch_all_counters();
			$realtime = new realtime;						
			for($i=0;$broker_counters[$i];$i++)
			{
			        $broker_counters[$i][realtime] = $realtime->fetch_counter($broker_counters[$i][counter]);
			        $query_spread = "select spread from counter where name = '".$broker_counters[$i][counter]."';";	
			        $result_spread = $DB->query($query_spread);
			        while($row_spread = $DB->fetch_array($result_spread))
			        {           
			            $broker_counters[$i][realtime][spread] = $row_spread[spread];
			        }  
			        $product_name = $broker_counters[$i][counter];
			        $broker_counters[$i][realtime][bid] = number_format($broker_counters[$i][realtime][Last], $broker_counters[$i][decimal], '.', '');
			        $broker_counters[$product_name][sell] = number_format($broker_counters[$i][realtime][Last], $broker_counters[$i][decimal], '.', ''); 
			        $broker_counters[$i][realtime][ask] = number_format($broker_counters[$i][realtime][Last]+$broker_counters[$i][realtime][spread], $broker_counters[$i][decimal], '.', '');
			        $broker_counters[$product_name][buy] = number_format($broker_counters[$i][realtime][Last]+$broker_counters[$i][realtime][spread], $broker_counters[$i][decimal], '.', '');         
			}
			include("eacct/classes/statement_floating.class.php");
			$statement_floating = new statement_floating;
			$statement = $statement_floating->fetchStatement($account,$broker_counters);
			$broker_eff_margin = $statement[status][NewBal]+$statement[status][TotalFloating]-$statement[status][MarginReq]; 
			$broker_margin_req = ($marginday+$pending_float_comission_required) * $quantity;
			if($broker_eff_margin<=$broker_margin_req && $bypass_permited_qty!=0) {
				$query_log = $query_log.";broker_eff_margin=".$broker_eff_margin;
				$query_log = $query_log.";pending_float_comission_required=".$pending_float_comission_required;
				$query_log = $query_log.";quantity=".$quantity;				
				$result_log_file = set_log_file($user->userid,'Trader','Ref(1930)Insufficient Funds',$price,$query_log);    
				return "<font color='red'><b>(1930) Insufficient New Position Margin</b></font><br>The Pending New Position Margin $broker_margin_req is not greater than effective margin $broker_eff_margin";
			}
		}
		//tradelog("validationtge-1931-effective_margin=".$broker_eff_margin."margin_required=".$marginday);
	}
//end tambahan supaya ga liquid position pending pada saat new pending sudah ada 080507
	
if (!$isorder)
{
	if ($query_directdone=="yes"){
		$ta_message[message] = "<font color='red'><b>Ref(1396) Order Processing3</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>";
		if ($closetrade)
		{
			$ta_message[message] .= "<font color='red'><b>Ref(1400) Close Pair Trade</b></font><br>Your order for account ($account),<br>$close[action] ($quantity) of $counter ($close[price])<br><br>";
		}
		$ta_message[message] .= $language->parse("Please allow a few moments for system update").".<br><br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
		$ta_message[refreshOpenPositions] = 0;
		$ta_message[refreshTradeHistory] = 1;
		$ta_message[code] = "";
		$statusid = 3; // Processing
	}else{
		if ($language->languageid=="1" ){
			$ta_message[message] = "<font color='red'><b>Ref(1632) Please wait 3</b></font><br>Please allow a few moments for system update<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
		}
		if ($language->languageid=="2" ){
			$ta_message[message] = "<font color='red'><b>Ref(1635) Please wait 3</b></font><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;<br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
		}		
		$ta_message[refreshOpenPositions] = 0;
		$ta_message[refreshTradeHistory] = 1;
		$ta_message[code] = "";
		$statusid = 8; // Waiting Dealing to Answer	
	}       
}
else
{   
	if ($action_type=='oco_sell' || $action_type=='oco_buy')
	{	
		$ta_message[message] = "<font color='red'><b>Ref(1412) Order Pending</b></font><br>Your order for account ($account),<br>$action_type ($quantity) of $counter Limit($price) and Stop ($price_to)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.";
	}else{
		$ta_message[message] = "<font color='red'><b>Ref(1810) Order Pending</b></font><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.";     
	}
	$ta_message[refreshOpenPositions] = 1;
	$ta_message[refreshTradeHistory] = 1;
	$ta_message[code] = "";
	$statusid = 2; // Pending       
}

//tradelog("traedr-1458".$closetrade);

if (!$closetrade)
{
	$query = "SELECT counter.name, marketindex.hedgeratio, marketindex.marginratio FROM $mysql[database].counter LEFT JOIN $mysql[database].marketindex USING (indexid)";
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$ratios[$row[name]][hedgeratio] = $row[hedgeratio]; // e.g. 0.5/0.3
		$ratios[$row[name]][marginratio] = $row[marginratio]; // e.g. 0.5/0.3
	}
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' AND LiqStatus = ''";
	$result = $DB_odbc->query($query);
	while ($row = $DB_odbc->fetch_array($result))
	{
		$tempname = trim($row[ItemCode]);
		$tempquantity = round($row[Unit]);
		if (!empty($row[BuyOrder]))
		{
			$trades[$tempname][buy] += $tempquantity;
		}
		else
		{
			$trades[$tempname][sell] += $tempquantity;
		}
	}
	if ($action=="buy") { $hedge_action = "sell"; } else { $hedge_action = "buy"; }
	$trades[$counter][$hedge_action] -= $quantity; 
	// Has Opposing trade(s)
	if ($trades[$counter][$action] > 0) // Has opposing trades
	{
		//echo "has opposing trades (".$trades[$counter][$action].")";
		//4.2) // Get Equity & MarginRequired Per Lot/Hedge
		$query = "SELECT NewBal,Equity, MarginReq FROM bafile WHERE AccNo = '$account'";
		
		$result = $DB_odbc->query($query);
		$row = $DB_odbc->fetch_array($result);
		$row[Equity] = $row[NewBal] + $TotalFloating;
		//tradelog("validationtge-2026=".$row[Equity]);
		$row[Equity] += $credit;
		$effective_margin = $newBalance+$TotalFloating-$row[MarginReq];
		$equity = $row[Equity];
		//$margin_required = $marginday;
		$margin_required = $row[MarginReq];
		if (count($trades) > 0)
		{
			$required_margin = 0; // Init
			foreach ($trades AS $name => $trade)
			{
				$hedgeratio = $ratios[$name][hedgeratio];
				$marginratio = $ratios[$name][marginratio];
				//Perbaikan karena JBAA1133 080603
				for($z_count=0;$counter_temp[$z_count];$z_count++)
				{			
					if($counter_temp[$z_count][counter]==$name){
						$margin_required = $counter_temp[$z_count][marginday];				
					}
				}				
				//End Perbaikan karena JBAA1133 080603
				$hedgevalue = $hedgeratio * $margin_required;
				$marginvalue = $marginratio * $margin_required;	
				$hedge_quantity = 0;
				$open_quantity = 0;
				if ($trade[buy]>$trade[sell]) // More Bought Positions
				{
					$hedge_quantity = $trade[sell];
					$open_quantity = $trade[buy] - $trade[sell];
				}
				elseif ($trade[sell]>$trade[buy]) // More Sell Positions
				{
					$hedge_quantity = $trade[buy];
					$open_quantity = $trade[sell] - $trade[buy];
				}
				else
				{
					$hedge_quantity = $trade[buy];
				}
				$required_margin += ($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue);
				//echo "<br>$name: required margin: $required_margin" . " (($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))";
				}
			}  	    
		} // End
		if ($equity < $required_margin)
		{
			$query_log = $query_log.";equity=".$equity;
			$query_log = $query_log.";required_margin=".$required_margin;
			$result_log_file = set_log_file($user->userid,'Trader','Ref(1443)Insufficient Funds',$price,$query_log);    
			return "<font color='red'><b>(1443) Insufficient Maintenance Margin</b></font><br>This account can only do a Buy/Sell Liquidation(Close Pair).";
		}   
		$query_log = $query_log.";equity=".$equity;
		$query_log = $query_log.";required_margin=".$required_margin;
		$result_log_file = set_log_file($user->userid,'Trader','Check 2081','',$query_log);
		//return "<font color='red'><b>(2079) Test</b></font><br>Test.";    
	}
	break; // End liquidate
}

if ($user->username  == $account)
{
	$trade[userid] = $user->userid;
	$trade[tradedby] = $user->userid;
	$trade[tradedbyname] = $account;  
}
else
{
	// AE Trade
	$query = "SELECT userid FROM $mysql[database].user WHERE username = '$account'";
	$row = $DB->query_first($query);
	$trade[userid] = $row[userid];
	$trade[tradedby] = $user->userid;
	$trade[tradedbyname] = $user->username; 
}

if($isoco==null)
{
	$isoco = 0;
}

if ($isorder=='' || $isorder == null){
	$isorder=0;
}

//return "<font color='red'><b>Test 2066 Insufficient Funds</b></font><br>$equity.";

if($isoco==0)
{
	if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
		$trade_query = "INSERT INTO $mysql[database].trade
		SET
		userid = '$trade[userid]',
		account = '$account',
		action = '$action',
		counterid = '$counterid',
		price = '$price',
		price_from = '$price',
		price_to = '$price_to',
		quantity = '$quantity',
		type = '$type',
		datetime = NOW(),
		liquidate_price = '$liquidate_price',
		liquidate_ref = '$liquidate_ref',             
		duration = '$duration',
		durationfrom = '$duration',
		durationto = '$durationto',
		isorder = '$isorder',
		statusid = $statusid,
		isbbj = '0',
		check_price = '$check_price[$action]',
		check_high = '$day_high',
		check_low = '$day_low',
		check_datetime = '$check_datetime',
		done_datetime = NOW(),
		tradedby = '$trade[tradedby]',
		tradedbyname = '$trade[tradedbyname]',
		typeorder='$action_type'";
	}

	if ($duration=='d' || $duration=='c' 
	|| $duration=='d1' || $duration=='c1' 
	|| $duration=='d2' || $duration=='c2' 
	|| $duration=='d3' || $duration=='c3'  
	|| $duration=='d4' || $duration=='c4' 
	|| $duration=='t'){	
		if ($duration=='d' || $duration=='d1' || $duration=='d2'  || $duration=='d3'  || $duration=='d4'){
			$check_price[$action] = $price;
		}	
		$hdr_id = $account ."_". date("YmdHis") . "_". $counterid . "_". $quantity;
		$trade_query = "INSERT INTO $mysql[database].trade_multi
			SET
			hdr_id = '$hdr_id',
			userid = '$trade[userid]',
			account = '$account',
			action = '$action',
			counterid = '$counterid',
			price = '$price',
			quantity = '1',
			quantity_order = '$quantity',
			type = '$type',
			datetime = NOW(),
			liquidate_price = '$liquidate_price',
			liquidate_ref = '$liquidate_ref',             
			duration = '$duration',
			duration_order = '$duration',
			isorder = '$isorder',
			statusid = $statusid,
			isbbj = '0',
			check_price = '$check_price[$action]',
			check_high = '$day_high',
			check_low = '$day_low',
			check_datetime = '$check_datetime',
			done_datetime = NOW(),
			tradedby = '$trade[tradedby]',
			tradedbyname = '$trade[tradedbyname]',
			typeorder='{$mode_order}'";			
	}	
	//tradelog("trader.php-isoco=0;-trade_query=".$trade_query);	
}

if($isoco==1)
{
	if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
		$trade_query = "INSERT INTO $mysql[database].trade
			SET
			userid = '$trade[userid]',
			account = '$account',
			action = '$action',
			counterid = '$counterid',
			price = '$price',
			price_from = '$price',
			price_to = '$price_to',
			quantity = '$quantity',
			type = '$type',
			datetime = NOW(),
			liquidate_price = '$liquidate_price',
			liquidate_ref = '$liquidate_ref',             
			duration = '$duration',
			durationfrom = '$duration',
			durationto = '$durationto',
			isorder = '$isorder',
			statusid = $statusid,
			isbbj = '0',
			check_price = '$check_price[$action]',
			check_high = '$day_high',
			check_low = '$day_low',
			check_datetime = '$check_datetime',
			done_datetime = NOW(),
			tradedby = '$trade[tradedby]',
			RefOCO ={$_harga},
			tradedbyname = '$trade[tradedbyname]',
			typeorder='$action_type'";
	}

	//060603 Multilateral Table
	if ($duration=='d' || $duration=='c' 
	|| $duration=='d1' || $duration=='c1' 
	|| $duration=='d2' || $duration=='c2' 
	|| $duration=='d3' || $duration=='c3'  
	|| $duration=='d4' || $duration=='c4' 
	|| $duration=='t'){	
		if ($duration=='d' || $duration=='d1' || $duration=='d2'  || $duration=='d3'  || $duration=='d4'){
			$check_price[$action] = $price;
		}	
		$hdr_id = $account ."_". date("YmdHis") . "_". $counterid . "_". $quantity;
		$trade_query = "INSERT INTO $mysql[database].trade_multi
			SET
			hdr_id = '$hdr_id',
			userid = '$trade[userid]',
			account = '$account',
			action = '$action',
			counterid = '$counterid',
			price = '$price',
			quantity = '1',
			quantity_order = '$quantity',
			type = '$type',
			datetime = NOW(),
			liquidate_price = '$liquidate_price',
			liquidate_ref = '$liquidate_ref',             
			duration = '$duration',
			duration_order = '$duration',
			isorder = '$isorder',
			statusid = $statusid,
			isbbj = '0',
			check_price = '$check_price[$action]',
			check_high = '$day_high',
			check_low = '$day_low',
			check_datetime = '$check_datetime',
			done_datetime = NOW(),
			tradedby = '$trade[tradedby]',
			RefOCO ={$_harga},
			tradedbyname = '$trade[tradedbyname]',
			typeorder='{$mode_order}'";			
	}	
	//tradelog("trader.php-isoco=1;-trade_query=".$trade_query);	
}
$log_trade_query= $trade_query;              

///###############CEK if another transaction already done add By 060209####################//

if ($liquidate_price<>'0.0000' || $liquidate_price<>'' || $liquidate_ref<>''){
	$query2 = "select tradeid from trade where account ='$account' and liquidate_price = '$liquidate_price' and liquidate_ref ='$liquidate_ref' and statusid=1 and type='liquidate'";
	//tradeLog("trader-query2-1752-".$query2);
	$query2 = $DB->query($query2); 	
	$chek_liquid="no_check";		
	if(mysql_num_rows($query2)>0){
		$ref=mysql_fetch_array($query2);
		$opentradeid = $ref['tradeid'];		
		$txt_message = "Insert by Customer Fail because trade id =" . $opentradeid . " already done to liquid";
		$result_log_file = set_log_file($user->userid,'ClientFail','insert_order',$opentradeid,$txt_message);
		$chek_liquid="please_check";
	}	
	if($chek_liquid=="please_check"){
		if($action=='buy'){
			$action_open = "sell";
		}else{
			$action_open = "buy";
		}
		$query_get_open_tradeid = "select * from trade where account='$account' and statusid='1' 
			and type='new' and counterid='$counterid' 
			and trade.price = '$liquidate_price' 
			and trade.action = '$action_open'  
			and trade.rollover = LEFT('$liquidate_ref',8); ";			
		//tradeLog("trader-open_tradeid-1772-".$query_get_open_tradeid);	
		$result = mysql_query($query_get_open_tradeid);
		$row = mysql_fetch_array($result);
		$open_tradeid = $row[tradeid];	
		//tradeLog("trader-open_tradeid-1776-".$open_tradeid);					
		//$update_account = $SETTINGS_Update_EACCT . "?update_again=".$open_tradeid;
		//tradeLog("validationtrade-1795-".$update_account);	
		readfile($update_account);		
		return "<font color='red'><b>Ref. 2440 Notice</b></font><br>You already liquid this position. Please let our system refresh the open position to liquid."; 							
	}
}	


if ($user->lockingid==2 && $type=="new") {
	if ($newlimit[$counter]<0 && $action=="buy"){  // mean buy new
		return "<font color='red'><b>Ref. 2444 Notice</b></font><br>You cannot Buy for Locking this counter."; 
	}
	if ($newlimit[$counter]>0 && $action=="sell"){
		return "<font color='red'><b>Ref. 2447 Notice</b></font><br>You cannot Sell for Locking this counter."; 
	}  			
}


/*****************************************************************************
* INSERT TRADES                                                               *
*****************************************************************************/
if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){ 			 
	if ($result = $DB->query($trade_query))
	{
		$tradeid = mysql_insert_id();
		if($isoco==1)
		{
			$_query = "UPDATE trade SET RefOCO = {$tradeid } WHERE tradeid = {$_harga}";
			$_result = mysql_query($_query); 
		} 
		$result_log_file = set_log_file($user->userid,'Trader','insert_order',$tradeid,$log_trade_query);
		if ($result_log_file!='1'){
			tradeLog("TradeID5: Error at " . $log_trade_query); 	  
		}		   	
		if ($closetrade_query)
		{
			if (!$result = $DB->query($closetrade_query))
			{
				$tradeid = mysql_insert_id();
				$result_log_file = set_log_file($user->userid,'Trader','close_order',$tradeid,$log_closetrade_query);		    
				return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again."; 			
			}
		}			      	 
		return $ta_message;
	}
	else
	{
		echo mysql_error() . " " . $trade_query;
		return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again.";
	}
}	   

if ($duration=='d' 
|| $duration=='d1' || $duration=='c1' 
|| $duration=='d2' || $duration=='c2' 
|| $duration=='d3' || $duration=='c3'  
|| $duration=='d4' || $duration=='c4'    
|| $duration=='t'){
	for ($i_multi=0; $i_multi<$quantity; $i_multi++)
	{ 
		if ($result = $DB->query($trade_query))
		{
			$tradeid = mysql_insert_id();
			if($isoco==1)
			{
				$_query = "UPDATE trade_multi SET RefOCO = {$tradeid } WHERE tradeid = {$_harga}";
				$_result = mysql_query($_query); 			
			} 
			$result_log_file = set_log_file($user->userid,'Trader','insert_order',$tradeid,$log_trade_query);
			if ($result_log_file!='1'){
				tradeLog("TradeID7: Error at " . $log_trade_query); 	  
			}		   	
			if ($closetrade_query)
			{
				if (!$result = $DB->query($closetrade_query))
				{
					$tradeid = mysql_insert_id();
					$result_log_file = set_log_file($user->userid,'Trader','close_order',$tradeid,$log_closetrade_query);		    
					return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again."; 			
				}
			}			      	 
			return $ta_message;
		}
		else
		{
			echo mysql_error() . " " . $trade_query;
			return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again.";
		}
	}
}

$func++;
}

function tradelog_validation($msg)
{
	$fp = fopen("trader.log","a");
	$logdate = date("Y-m-d H:i:s => ");
	$msg = preg_replace("/\s+/"," ",$msg);
	fwrite($fp,$logdate . $msg . "\n");
	fclose($fp);
	return;
}

function check_newpending($account,$counterid,$the_new_liquid_pending_ordertype,$tnlpo_price_from,$tnlpo_price_to)
{
	//1.List Open Position
	//2.List New Pending
	global $DB;
	$result_check_newpending=0;
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' and ItemCode = '$counterid' and LiqStatus=''";
	//tradelog_validation("validationtge-2371=".$query);
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$new_open[] =$row;
		//tradelog_validation("validationtge-2377=".$row[online_tradeid]);
	}	
	//2.Cek Pending Liquid
	for ($i_detail=0; $i_detail<count($new_open); $i_detail++)
	{
		//tradelog_validation("validationtge-2392=".$new_open[$i_detail][online_tradeid]);
		if($new_open[$i_detail][SellRef]!=''){
			$liquidate_ref = $new_open[$i_detail][SellDate]."_".$new_open[$i_detail][SellRef];
			$new_open[$i_detail][action] = "sell";
			$query = "SELECT * FROM trade where account = '$account' and type = 'liquidate' and statusid = '2' 
				and counterid = '$counterid' and liquidate_ref like '$liquidate_ref%' ";
		}else{
			$liquidate_ref = $new_open[$i_detail][BuyDate]."_".$new_open[$i_detail][BuyRef];
			$new_open[$i_detail][action] = "buy";
			$query = "SELECT * FROM trade where account = '$account' and type = 'liquidate' and statusid = '2' 
				and counterid = '$counterid' and liquidate_ref like '$liquidate_ref%' ";		
		}		
		//tradelog_validation("validationtge-2444=".$query);
		$result = $DB->query($query);
		$liquid_pending = array();
		while ($row = $DB->fetch_array($result))
		{
			$liquid_pending[] =$row;
			//tradelog_validation("validationtge-2407=".$row[tradeid]);
		}
		//tradelog_validation("validationtge-2404-the_new_liquid_pending_ordertype=".$the_new_liquid_pending_ordertype);	
		if($the_new_liquid_pending_ordertype=='buy_higher'){
			$new_open[$i_detail][buy_higher] = $tnlpo_price_from;
		}
		if($the_new_liquid_pending_ordertype=='buy_lower'){
			$new_open[$i_detail][buy_lower] = $tnlpo_price_from;
		}
		if($the_new_liquid_pending_ordertype=='buy_mo'){
			$new_open[$i_detail][buy_mo] = "liq_mo";
		}
		if($the_new_liquid_pending_ordertype=='buy_range'){
			$buy_range[price_from] = $tnlpo_price_from;
			$buy_range[price_to] = $tnlpo_price_to;
			$new_open[$i_detail][buy_range][]= $buy_range;
		}
		//------------------------------
		if($the_new_liquid_pending_ordertype=='sell_higher'){
			$new_open[$i_detail][sell_higher] = $tnlpo_price_from;
		}
		if($the_new_liquid_pending_ordertype=='sell_lower'){
			$new_open[$i_detail][sell_lower] = $tnlpo_price_from;
		}
		if($the_new_liquid_pending_ordertype=='sell_mo'){
			$new_open[$i_detail][sell_mo] = "liq_mo";
		}
		if($the_new_liquid_pending_ordertype=='sell_range'){
			$sell_range[price_from] = $tnlpo_price_from;
			$sell_range[price_to] = $tnlpo_price_to;
			$new_open[$i_detail][sell_range][]= $sell_range;
		}
		
		for ($i_liquid_pending=0; $i_liquid_pending<count($liquid_pending); $i_liquid_pending++)
		{
			$action_type = $liquid_pending[$i_liquid_pending][typeorder];
			//-------------------------------------------------
			if ($action_type=='buy_higher'){
					$new_open[$i_detail][buy_higher] = $liquid_pending[$i_liquid_pending][price_from];
			}
			if ($action_type=='buy_lower'){
				$new_open[$i_detail][buy_lower] = $liquid_pending[$i_liquid_pending][price_from];
			}
			if ($action_type=='buy_range'){
				$buy_range[price_from] = $liquid_pending[$i_liquid_pending][price_from];
				$buy_range[price_to] = $liquid_pending[$i_liquid_pending][price_to];
				$new_open[$i_detail][buy_range][]= $buy_range;
			}
			if ($action_type=='buy_mo'){
				$new_open[$i_detail][buy_mo]= $liquid_pending[$i_liquid_pending][tradeid];
			}
						
			//-------------------------------------------------
			if ($action_type=='sell_higher'){
				$new_open[$i_detail][sell_higher] = $liquid_pending[$i_liquid_pending][price_from];
			}
			if ($action_type=='sell_lower'){
				$new_open[$i_detail][sell_lower] = $liquid_pending[$i_liquid_pending][price_from];
			}
			if ($action_type=='sell_range'){
				$sell_range[price_from] = $liquid_pending[$i_liquid_pending][price_from];
				$sell_range[price_to] = $liquid_pending[$i_liquid_pending][price_to];
				$new_open[$i_detail][sell_range][]= $sell_range;
			}
			if ($action_type=='sell_mo'){
				$new_open[$i_detail][sell_mo]= $liquid_pending[$i_liquid_pending][tradeid];
			}
		}			
	}
	//3.List New Pending
	$query = "SELECT * FROM trade where account = '$account' and type = 'new' and statusid = '2' and counterid = '$counterid'";
	//tradelog_validation("validationtge-2521=".$query);
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$new_pending[] =$row;
		//tradelog_validation("validationtge-2387=".$row[tradeid]);
	}

	for ($i_detail=0; $i_detail<count($new_open); $i_detail++)
	{
		for ($i_new_pending=0; $i_new_pending<count($new_pending); $i_new_pending++)
		{
			if($new_pending[$i_new_pending][pasangan]==''){
				$gacocok = 0;
				$action = $new_pending[$i_new_pending][action];
				$typeorder = $new_pending[$i_new_pending][typeorder];
				if($action=="buy"){
					//tradelog_validation("validationtge-2493=".$new_open[$i_detail][buy_mo]);	
					if($new_open[$i_detail][buy_mo]!=''){
						$gacocok = $gacocok + 1;
					}	
					//tradelog_validation("validationtge-gacocok-2497=".$gacocok);				
					if($new_open[$i_detail][buy_higher]!=''){
						if ($typeorder=='buy_mo'){
							$gacocok = $gacocok + 1;
						}
						if ($typeorder=='buy_higher'){
							$gacocok = $gacocok + 1;
						}						
						if ($typeorder=='buy_lower'){
							if($new_pending[$i_new_pending][price_from]>=$new_open[$i_detail][buy_higher]){
								$gacocok = $gacocok + 1;
							}
						}						
						if ($typeorder=='buy_range'){
							//tradelog_validation("validationtge-2504-buy_range_price_from:".$buy_range[$i_buy_range][price_from]);
							//tradelog_validation("validationtge-2505-price_to:".$new_pending[$i_new_pending][price_to]);
							//tradelog_validation("validationtge-2507-price_from:".$new_pending[$i_new_pending][price_from]);
							if($new_pending[$i_new_pending][price_to]>=$new_open[$i_detail][buy_higher]){
								$gacocok = $gacocok + 1;
							}																							
						}
					}	
					if($new_open[$i_detail][buy_lower]!=''){						
						if ($typeorder=='buy_mo'){
							$gacocok = $gacocok + 1;
						}
						if ($typeorder=='buy_higher'){							
							if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][buy_lower]){
								$gacocok = $gacocok + 1;
							}
						}						
						if ($typeorder=='buy_lower'){
							$gacocok = $gacocok + 1;
						}
						if ($typeorder=='buy_range'){						
							if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][buy_lower]){
								$gacocok = $gacocok + 1;
							}																							
						}
					}				
					if($new_open[$i_detail][buy_range]!=''){						
						if ($typeorder=='buy_mo'){
							$gacocok = $gacocok + 1;
						}
						$buy_range = $new_open[$i_detail][buy_range];
						for ($i_buy_range=0; $i_buy_range<count($buy_range); $i_buy_range++)
						{
							if ($typeorder=='buy_higher'){		
								//tradelog_validation("validationtge-2539-typeorder:".$typeorder); //buy_higher
								//tradelog_validation("validationtge-2540-the_new_liquid_pending_ordertype:".$the_new_liquid_pending_ordertype); //buy_range
								//tradelog_validation("validationtge-2541-new_from:".$new_pending[$i_new_pending][price_from]);//40000
								//tradelog_validation("validationtge-2542-price_to:".$buy_range[$i_buy_range][price_to]);	//30000	
								//tradelog_validation("validationtge-2543-tnlpo_price_from:".$tnlpo_price_from);			
								if($new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_to]){
									$gacocok = $gacocok + 1;											
								}
								//tradelog_validation("validationtge-2545-gacocok:".$gacocok);
							}						
							if ($typeorder=='buy_lower'){
								if($new_pending[$i_new_pending][price_from]>=$buy_range[$i_buy_range][price_from]){
									$gacocok = $gacocok + 1;
								}
							}
							if ($typeorder=='buy_range'){
								//tradelog_validation("validationtge-2556-buy_range_price_from:".$buy_range[$i_buy_range][price_from]);
								//tradelog_validation("validationtge-2557-price_to:".$new_pending[$i_new_pending][price_to]);
								//tradelog_validation("validationtge-2558-price_from:".$new_pending[$i_new_pending][price_from]);
								$buy_range = $new_open[$i_detail][buy_range];
								for ($i_buy_range=0; $i_buy_range<count($buy_range); $i_buy_range++)
								{
									if($new_pending[$i_new_pending][price_to]>=$buy_range[$i_buy_range][price_from] 
									&& $new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_from] ){
										$gacocok = $gacocok + 1;
									}
									if($new_pending[$i_new_pending][price_to]>=$buy_range[$i_buy_range][price_to] 
									&& $new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_to] ){
										$gacocok = $gacocok + 1;
									}	
								}																											
							}
						}	
					}		
					if($gacocok == 0 ){
						//tradelog_validation("validationtge-online_tradeid-2576-xxxx".$new_open[$i_detail][online_tradeid]);
						$new_pending[$i_new_pending][pasangan]= $new_open[$i_detail][online_tradeid];
						//tradelog_validation("validationtge-2576-".$new_pending[$i_new_pending][tradeid].":".$new_pending[$i_new_pending][pasangan]);
					}		
					//tradelog_validation("validationtge-2578-tradeid:".$new_open[$i_detail][online_tradeid]);
					//tradelog_validation("validationtge-2579-SellPrice:".$new_open[$i_detail][SellPrice]);
					//tradelog_validation("validationtge-2580-buy_mo,isinya".$new_open[$i_detail][buy_mo]);
					//tradelog_validation("validationtge-2581-buy_higher,isinya".$new_open[$i_detail][buy_higher]);
					//tradelog_validation("validationtge-2582-buy_lower,isinya".$new_open[$i_detail][buy_lower]);
					//tradelog_validation("validationtge-2583-buy_range,isinya".$new_open[$i_detail][buy_range][price_from]);	
					//tradelog_validation("validationtge-2584-action:".$new_open[$i_detail][action]);					
				}else{
					if($new_open[$i_detail][sell_mo]!=''){$gacocok = $gacocok + 1;
					}
					if($new_open[$i_detail][sell_higher]!=''){
						if ($typeorder=='sell_mo'){
							$gacocok = $gacocok + 1;							
						}
						if ($typeorder=='sell_higher'){
							$gacocok = $gacocok + 1;							
						}						
						if ($typeorder=='sell_lower'){
							if($new_pending[$i_new_pending][price_from]>=$new_open[$i_detail][sell_higher]){
								$gacocok = $gacocok + 1;
							}
						}
						if ($typeorder=='sell_range'){
							if($new_pending[$i_new_pending][price_to]>=$new_open[$i_detail][sell_higher]){
								$gacocok = $gacocok + 1;
							}																
						}
					}	
					if($new_open[$i_detail][sell_lower]!=''){
						if ($typeorder=='sell_mo'){
							$gacocok = $gacocok + 1;							
						}
						if ($typeorder=='sell_higher'){							
							if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][sell_lower]){
								$gacocok = $gacocok + 1;
							}
						}						
						if ($typeorder=='sell_lower'){
							$gacocok = $gacocok + 1;														
						}						
						if ($typeorder=='sell_range'){
							if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][sell_lower]){
								$gacocok = $gacocok + 1;
							}															
						}
					}				
					if($new_open[$i_detail][sell_range]!=''){
						if ($typeorder=='sell_mo'){
							$gacocok = $gacocok + 1;							
						}
						$sell_range = $new_open[$i_detail][sell_range];
						for ($i_sell_range=0; $i_sell_range<count($sell_range); $i_sell_range++)
						{
							if ($typeorder=='sell_higher'){							
								if($new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_to]){
									$gacocok = $gacocok + 1;
								}
							}						
							if ($typeorder=='sell_lower'){
								if($new_pending[$i_new_pending][price_from]>=$sell_range[$i_sell_range][price_from]){
									$gacocok = $gacocok + 1;
								}
							}
							if ($typeorder=='sell_range'){
								$sell_range = $new_open[$i_detail][sell_range];
								for ($i_sell_range=0; $i_sell_range<count($sell_range); $i_sell_range++)
								{
									if($new_pending[$i_new_pending][price_to]>=$sell_range[$i_sell_range][price_from] 
									&& $new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_from] ){
										$gacocok = $gacocok + 1;
									}
									if($new_pending[$i_new_pending][price_to]>=$sell_range[$i_sell_range][price_to] 
									&& $new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_to] ){
										$gacocok = $gacocok + 1;
									}	
								}																															
							}							
						}	
					}		
					if($gacocok == 0)
					{
						//tradelog_validation("validationtge-online_tradeid-2656-yyyyy".$new_open[$i_detail][online_tradeid]);
						$new_pending[$i_new_pending][pasangan]= $new_open[$i_detail][online_tradeid];
						//tradelog_validation("validationtge-2604-".$new_pending[$i_new_pending][tradeid].":".$new_pending[$i_new_pending][pasangan]);
					}					
					//tradelog_validation("validationtge-2466-tradeid:".$new_open[$i_detail][online_tradeid]);
					//tradelog_validation("validationtge-2467-BuyPrice:".$new_open[$i_detail][BuyPrice]);
					//tradelog_validation("validationtge-2468-sell_mo,isinya".$new_open[$i_detail][sell_mo]);
					//tradelog_validation("validationtge-2469-sell_higher,isinya".$new_open[$i_detail][sell_higher]);
					//tradelog_validation("validationtge-2470-sell_lower,isinya".$new_open[$i_detail][sell_lower]);
					//tradelog_validation("validationtge-2471-sell_range,isinya".$new_open[$i_detail][sell_range]);	
					//tradelog_validation("validationtge-2472-action:".$new_open[$i_detail][action]);	
							
				}
			}		
		}
	}

	for ($i_new_pending=0; $i_new_pending<count($new_pending); $i_new_pending++)
	{
		//tradelog_validation("validationtge-2621-".$new_pending[$i_new_pending][tradeid].":".$new_pending[$i_new_pending][pasangan]);
		if($new_pending[$i_new_pending][pasangan]!=''){
			$countervalue[] = $new_pending[$i_new_pending][tradeid]; 
		}	
	}
	if(count($countervalue)>0){
		$counter_implode = implode(",", $countervalue);	
	}else{
		$counter_implode = "";
	}
	//tradelog_validation("validationtge-2670-counter_implode:".$counter_implode);
	return $counter_implode ;
}

function check_liquidpending($account,$counterid,$the_new_pending_ordertype,$tnlpo_price_from,$tnlpo_price_to,$quantity)
{
	$hedgeattempt = 0;
	//tradelog_validation("validationtge-hedgeattempt-2746:".$hedgeattempt);	
	//1.List Open Position
	//2.List New Pending
	global $DB;
	$result_check_newpending=0;
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' and ItemCode = '$counterid' and LiqStatus=''";
	//tradelog_validation("validationtge-2371=".$query);
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$new_open[] =$row;
		//tradelog_validation("validationtge-2377=".$row[online_tradeid]);
	}	
		//new pending1 adalah order yg akan masuk yg perlu di check
		$new_pending1[price] = $tnlpo_price_from;
		$new_pending1[price_from] = $tnlpo_price_from;
		$new_pending1[price_to] = $tnlpo_price_to;
		
		if($the_new_pending_ordertype=='buy_higher'){	
			$new_pending1[action] = "buy";		
			$new_pending1[typeorder] = "buy_higher";
		}
		if($the_new_pending_ordertype=='buy_lower'){
			$new_pending1[action] = "buy";
			$new_pending1[typeorder] = "buy_lower";
		}
		if($the_new_pending_ordertype=='buy_mo'){
			$new_pending1[action] = "buy";
			$new_pending1[typeorder] = "buy_mo";
		}
		if($the_new_pending_ordertype=='buy_range'){
			$new_pending1[action] = "buy";
			$new_pending1[typeorder] = "buy_range";
		}
		//------------------------------
		if($the_new_pending_ordertype=='sell_higher'){
			$new_pending1[action] = "sell";		
			$new_pending1[typeorder] = "sell_higher";
		}
		if($the_new_pending_ordertype=='sell_lower'){
			$new_pending1[action] = "sell";
			$new_pending1[typeorder] = "sell_lower";
		}
		if($the_new_pending_ordertype=='sell_mo'){
			$new_pending1[action] = "sell";
			$new_pending1[typeorder] = "sell_mo";
		}
		if($the_new_pending_ordertype=='sell_range'){
			$new_pending1[action] = "sell";
			$new_pending1[typeorder] = "sell_range";
		}
		
	//2.Cek Pending Liquid,adalah dari table trade,liquid status 2
	for ($i_detail=0; $i_detail<count($new_open); $i_detail++)
	{
		//tradelog_validation("validationtge-2800-product_lama=".$new_open[$i_detail][ItemCode]);
		//tradelog_validation("validationtge-2801-product_baru=".$counterid);
		
		//tradelog_validation("validationtge-2392=".$new_open[$i_detail][online_tradeid]);
		if($new_open[$i_detail][SellRef]!=''){
			$liquidate_ref = $new_open[$i_detail][SellDate]."_".$new_open[$i_detail][SellRef];
			$new_open[$i_detail][action] = "sell";
			$new_open[$i_detail][sell] = $new_open[$i_detail][SellPrice];
			//tradelog_validation("validationtge-2802-product_lama_action=".$new_open[$i_detail][action]);
			//tradelog_validation("validationtge-2803-product_baru_action=".$new_pending1[action]);
			$query = "SELECT * FROM trade where account = '$account' and type = 'liquidate' and statusid = '2' 
				and counterid = '$counterid' and liquidate_ref like '$liquidate_ref%' ";
		}else{
			$liquidate_ref = $new_open[$i_detail][BuyDate]."_".$new_open[$i_detail][BuyRef];
			$new_open[$i_detail][action] = "buy";
			$new_open[$i_detail][buy] = $new_open[$i_detail][BuyPrice];
			$query = "SELECT * FROM trade where account = '$account' and type = 'liquidate' and statusid = '2' 
				and counterid = '$counterid' and liquidate_ref like '$liquidate_ref%' ";		
		}		
			
		//tradelog_validation("validationtge-2821=".$query);
		$liquid_pending = array();
		$result = $DB->query($query);
		while ($row = $DB->fetch_array($result))
		{
			$liquid_pending[] =$row;
			//tradelog_validation("validationtge-2407=".$row[tradeid]);
		}
		//tradelog_validation("validationtge-2404-the_new_liquid_pending_ordertype=".$the_new_liquid_pending_ordertype);	
		
		
		//tradelog_validation("validationtge-hedgeattempt-2832:".$hedgeattempt);
		for ($i_liquid_pending=0; $i_liquid_pending<count($liquid_pending); $i_liquid_pending++)
		{
			//1.Liquid Pending di match ke new open
			$action_type = $liquid_pending[$i_liquid_pending][typeorder];
			//-------------------------------------------------
			//tradelog_validation("validationtge-2793-action_type=".$action_type);
			if ($action_type=='buy_higher'){
					$new_open[$i_detail][buy_higher] = $liquid_pending[$i_liquid_pending][price_from];
					$new_open[$i_detail][buy] = $liquid_pending[$i_liquid_pending][price_from];
					$new_open[$i_detail][buy_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='buy_lower'){
				$new_open[$i_detail][buy_lower] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][buy] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][buy_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='buy_range'){
				$buy_range[price_from] = $liquid_pending[$i_liquid_pending][price_from];
				$buy_range[price_to] = $liquid_pending[$i_liquid_pending][price_to];
				$new_open[$i_detail][buy_range][]= $buy_range;
				$new_open[$i_detail][buy]= $buy_range[price_from];
				$new_open[$i_detail][buy_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='buy_mo'){
				$new_open[$i_detail][buy_mo]= $liquid_pending[$i_liquid_pending][tradeid];
				$new_open[$i_detail][buy]= $liquid_pending[$i_liquid_pending][tradeid];
				$new_open[$i_detail][buy_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
						
			//-------------------------------------------------
			if ($action_type=='sell_higher'){
				$new_open[$i_detail][sell_higher] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][sell] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][sell_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='sell_lower'){
				//tradelog_validation("validationtge-2814-action_type=".$action_type);
				$new_open[$i_detail][sell_lower] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][sell] = $liquid_pending[$i_liquid_pending][price_from];
				$new_open[$i_detail][sell_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='sell_range'){
				$sell_range[price_from] = $liquid_pending[$i_liquid_pending][price_from];
				$sell_range[price_to] = $liquid_pending[$i_liquid_pending][price_to];
				$new_open[$i_detail][sell_range][]= $sell_range;
				$new_open[$i_detail][sell]= $sell_range[price_from];
				$new_open[$i_detail][sell_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
			}
			if ($action_type=='sell_mo'){
				$new_open[$i_detail][sell_mo]= $liquid_pending[$i_liquid_pending][tradeid];
				$new_open[$i_detail][sell]= $liquid_pending[$i_liquid_pending][tradeid];
				$new_open[$i_detail][sell_pending_qty] = $liquid_pending[$i_liquid_pending][quantity];
				//tradelog("validationtge-2885=".$new_open[$i_detail][sell_pending_qty]);
			}
		}			
	}
	//3.List New Pending dari table trade dengan new status 2
	$query = "SELECT * FROM trade where account = '$account' and type = 'new' and statusid = '2' and counterid = '$counterid'";
	//tradelog_validation("validationtge-2891=".$query);
	$result = $DB->query($query);
	$new_pending = array();
	$new_pending[] = $new_pending1;
	while ($row = $DB->fetch_array($result))
	{
		$new_pending[] =$row;
		//tradelog_validation("validationtge-2878=".$row[tradeid]);
	}
	
	if($new_pending1[action]=="sell"){
		$new_sell = $new_sell + $quantity;
	}else{
		$new_buy = $new_buy + $quantity;
	}
	$new_sell_awal = $new_sell;
	$new_buy_awal = $new_buy;
	//tradelog("validationtge-2905-new_sell_awal=".$new_sell);
	//tradelog("validationtge-2906-new_buy_awal=".$new_buy);	
	for ($i_detail=0; $i_detail<count($new_open); $i_detail++)
	{
		//tradelog_validation("validationtge-check_dafile or status2-2909=".$new_open[$i_detail][BuyOrder]);
		if($new_open[$i_detail][BuyOrder]==0){
			$new_sell = $new_sell + $new_open[$i_detail][Unit];						
		}
		else{
			$new_buy = $new_buy + $new_open[$i_detail][Unit];			
		}
		//tradelog("validationtge-2919-new_sell_kemudian=".$new_sell);
		//tradelog("validationtge-2920-new_buy_kemudian=".$new_buy);	
		for ($i_new_pending=0; $i_new_pending<count($new_pending); $i_new_pending++)
		{
			if($new_pending_sudah_check[$new_pending[$i_new_pending][tradeid]]=="sudah_check"){
				$check_pending ="not_continue";
			}else{
				$check_pending ="continue";
				$new_pending_sudah_check[$new_pending[$i_new_pending][tradeid]] = "sudah_check";
			}
			//tradelog_validation("validationtge-2928:".$new_pending[$i_new_pending][tradeid]."=".$new_pending_sudah_check[$new_pending[$i_new_pending][tradeid]].":".$check_pending);
			if($check_pending =="continue"){
			//2.New Pending di match ke new open, new open adalah dari dafile
			//if($new_pending[$i_new_pending][tradeid]!=''){ //pasti new pending belum punya tradeid, tapi kan ada juga yg punya tradeid yg statusnya 2
				//tradelog_validation("validationtge-2842=".$new_pending[$i_new_pending][tradeid]);
				if($new_pending[$i_new_pending][pasangan]==''){
					$gacocok = 0;
					$action = $new_pending[$i_new_pending][action];
					$typeorder = $new_pending[$i_new_pending][typeorder];	
					//tradelog_validation("validationtge-2934-tradeid=".$new_pending[$i_new_pending][tradeid]);	
					//tradelog_validation("validationtge-2926-typeorder=".$typeorder);
					//tradelog_validation("validationtge-2927-action_detail=".$new_open[$i_detail][sell_mo]);				
					
					if($action=="buy"){
						//tradelog_validation("validationtge-hedgeattempt-2909:".$hedgeattempt);
						
						if($new_open[$i_detail][buy]!=''){
							$gacocok = "2906";
							$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
						}
						if($new_open[$i_detail][buy_mo]!=''){
							$gacocok = "2909";
							$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
						}					
						//tradelog_validation("validationtge-buy_higher-2832=".$new_open[$i_detail][buy_higher]);						
						if($new_open[$i_detail][buy_higher]!=''){	
							//tradelog_validation("validationtge-2851-typeorder=".$typeorder);						
							if($typeorder=="buy_mo"){
								$gacocok = "2915";
								$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
							}	
							//tradelog_validation("validationtge-2837-gacocok=".$gacocok);						
							if ($typeorder=='buy_higher'){
								$gacocok = "2919";
								$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
							}											
							if ($typeorder=='buy_lower'){
								if($new_pending[$i_new_pending][price_from]>=$new_open[$i_detail][buy_higher]){
									$gacocok = "2923";
									$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
								}
							}
							if ($typeorder=='buy_range'){
								//tradelog_validation("validationtge-2854-gacocok=".$gacocok);				
								//tradelog_validation("validationtge-2855-buy_range_price_buy_higher:".$new_open[$i_detail][buy_higher]);
								//tradelog_validation("validationtge-2857-price_to:".$new_pending[$i_new_pending][price_to]);
								//tradelog_validation("validationtge-2858-price_from:".$new_pending[$i_new_pending][price_from]);
								if($new_pending[$i_new_pending][price_to]>=$new_open[$i_detail][buy_higher]){
									$gacocok = "2932";
									$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
								}
																								
							}
						}	
						if($new_open[$i_detail][buy_lower]!=''){						
							if ($typeorder=='buy_higher'){							
								if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][buy_lower]){
									$gacocok = "2940";
									$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
								}
							}						
							if ($typeorder=='buy_lower'){
								$gacocok = "2944";
								$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
							}
							if ($typeorder=='buy_range'){
								if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][buy_lower]){
									$gacocok = "2948";
									$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
								}																
							}
						}				
						if($new_open[$i_detail][buy_range]!=''){						
							$buy_range = $new_open[$i_detail][buy_range];
							for ($i_buy_range=0; $i_buy_range<count($buy_range); $i_buy_range++)
							{
								if ($typeorder=='buy_higher'){		
									//tradelog_validation("validationtge-2884-gacocok:".$gacocok);
									//tradelog_validation("validationtge-2885-new_pending[$i_new_pending][price_from]:".$new_pending[$i_new_pending][price_from]); //buy_higher
									//tradelog_validation("validationtge-2886-buy_range[$i_buy_range][price_to]:".$buy_range[$i_buy_range][price_to]); 			
									if($new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_to]){
										$gacocok = "2961";
										$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];											
									}
									//tradelog_validation("validationtge-2893-gacocok:".$gacocok);
								}						
								if ($typeorder=='buy_lower'){
									if($new_pending[$i_new_pending][price_from]>=$buy_range[$i_buy_range][price_from]){
										$gacocok = "2967";
										$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
									}
								}
								if ($typeorder=='buy_range'){
									//tradelog_validation("validationtge-2884-gacocok:".$gacocok);
									$buy_range = $new_open[$i_detail][buy_range];
									for ($i_buy_range=0; $i_buy_range<count($buy_range); $i_buy_range++)
									{
										if($new_pending[$i_new_pending][price_to]>=$buy_range[$i_buy_range][price_from] 
										&& $new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_from] ){
											$gacocok = "2977";
											$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
										}
										
										if($new_pending[$i_new_pending][price_to]>=$buy_range[$i_buy_range][price_to] 
										&& $new_pending[$i_new_pending][price_from]<=$buy_range[$i_buy_range][price_to] ){
											$gacocok = "2969";
											$new_buy = $new_buy + $new_pending[$i_new_pending][quantity];
										}
																			
										//tradelog_validation("validationtge-2911-gacocok:".$gacocok);
										//tradelog_validation("validationtge-2912-price_to:".$new_pending[$i_new_pending][price_to]);
										//tradelog_validation("validationtge-2913-price_from:".$new_pending[$i_new_pending][price_from]);
									}
																																	
								}
							}	
						}	
							
						if($gacocok == 0){
							//$hedgeattempt = 1;
							//$new_buy = $new_buy + $quantity;
						}	
						//tradelog_validation("validationtge-gacocok-3007:".$gacocok);
						//tradelog_validation("validationtge-new_sell-3008:".$new_sell.":new_buy=".$new_buy);		
						//tradelog_validation("validationtge-2578-tradeid:".$new_open[$i_detail][online_tradeid]);
						//tradelog_validation("validationtge-2579-SellPrice:".$new_open[$i_detail][SellPrice]);
						//tradelog_validation("validationtge-2580-buy_mo,isinya".$new_open[$i_detail][buy_mo]);
						//tradelog_validation("validationtge-2581-buy_higher,isinya".$new_open[$i_detail][buy_higher]);
						//tradelog_validation("validationtge-2582-buy_lower,isinya".$new_open[$i_detail][buy_lower]);
						//tradelog_validation("validationtge-2583-buy_range,isinya".$new_open[$i_detail][buy_range][price_from]);	
						//tradelog_validation("validationtge-2584-action:".$new_open[$i_detail][action]);					
					}else{ //artinya new pending1 yg mau masuk plus new pending dari table trade status 2 yg juga adalah sell
					       //akan di match dengan newopen dari dafile
					       //tradelog_validation("validationtge-2995-action=".$action);	
					       //tradelog_validation("validationtge-2996-typeorder=".$typeorder);
					       //tradelog_validation("validationtge-3008-action_detail=".$new_open[$i_detail][sell]);
					       //tradelog_validation("validationtge-new_sell-3052:".$new_sell);
						if($new_open[$i_detail][sell]!=''){ //artinya pending yg mau masuk melihat ada open di dafile yang sudah ada pricenya, jadi perlu ditambah
							$gacocok = "3069-".$new_open[$i_detail][sell];
							$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
							//tradelog_validation("validationtge-pendingqty-3065:".$new_open[$i_detail][sell_pending_qty]);
						}
						if($new_open[$i_detail][sell_mo]!=''){
							$gacocok = "3050";
							$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
						}
						if($new_open[$i_detail][sell_higher]!=''){
							//tradelog_validation("validationtge-2954-");
							if ($typeorder=='sell_higher'){
								$gacocok = "3018";	
								$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];						
							}						
							if ($typeorder=='sell_lower'){
								if($new_pending[$i_new_pending][price_from]>=$new_open[$i_detail][sell_higher]){
									$gacocok = "3022";
									$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
								}
							}
							if ($typeorder=='sell_range'){
								if($new_pending[$i_new_pending][price_to]>=$new_open[$i_detail][sell_higher]){
									$gacocok = "3027";
									$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
								}																
							}
						}	
						//tradelog_validation("validationtge-3001-hedgeattempt:".$hedgeattempt.":".$new_open[$i_detail][sell_mo]);
						if($new_open[$i_detail][sell_lower]!=''){
							if ($typeorder=='sell_higher'){							
								if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][sell_lower]){
									$gacocok = "3035";
									$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
								}
							}						
							if ($typeorder=='sell_lower'){
								$gacocok = "3039";	
								$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
								//tradelog_validation("validationtge-3010-hedgeattempt:".$hedgeattempt);													
							}						
							if ($typeorder=='sell_range'){
								if($new_pending[$i_new_pending][price_from]<=$new_open[$i_detail][sell_lower]){
									$gacocok = "3044";
									$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
								}																
							}
						}				
						if($new_open[$i_detail][sell_range]!=''){
							$sell_range = $new_open[$i_detail][sell_range];
							for ($i_sell_range=0; $i_sell_range<count($sell_range); $i_sell_range++)
							{
								if ($typeorder=='sell_higher'){							
									if($new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_to]){
										$gacocok = "3122";
										$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
									}
								}						
								if ($typeorder=='sell_lower'){
									if($new_pending[$i_new_pending][price_from]>=$sell_range[$i_sell_range][price_from]){
										$gacocok = "3059";
										$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
									}
								}
								if ($typeorder=='sell_range'){
									$sell_range = $new_open[$i_detail][sell_range];
									for ($i_sell_range=0; $i_sell_range<count($sell_range); $i_sell_range++)
									{
										if($new_pending[$i_new_pending][price_to]>=$sell_range[$i_sell_range][price_from] 
										&& $new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_from] ){
											$gacocok = "3068";
											$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
										}
										if($new_pending[$i_new_pending][price_to]>=$sell_range[$i_sell_range][price_to] 
										&& $new_pending[$i_new_pending][price_from]<=$sell_range[$i_sell_range][price_to] ){
											$gacocok = "3072";
											$new_sell = $new_sell + $new_pending[$i_new_pending][quantity];
										}
									}																																
								}							
							}	
						}	
							
						if($gacocok == 0)
						{
							//$hedgeattempt = 1;
							//$new_sell = $new_sell + $quantity;
						}
						//tradelog_validation("validationtge-3156-gacocok=".$gacocok);	
						//tradelog_validation("validationtge-new_sell-3157:".$new_sell.":new_buy=".$new_buy);					
						//tradelog_validation("validationtge-3158-tradeid:".$new_open[$i_detail][online_tradeid]);
						//tradelog_validation("validationtge-3159-BuyPrice:".$new_open[$i_detail][BuyPrice]);
						//tradelog_validation("validationtge-3160-sell_mo,isinya".$new_open[$i_detail][sell_mo]);
						//tradelog_validation("validationtge-3161-sell_higher,isinya".$new_open[$i_detail][sell_higher]);
						//tradelog_validation("validationtge-3162-sell_lower,isinya".$new_open[$i_detail][sell_lower]);
						//tradelog_validation("validationtge-3163-sell_range,isinya".$new_open[$i_detail][sell_range]);	
						//tradelog_validation("validationtge-3163-action:".$new_open[$i_detail][action]);	
								
					}
				//}//end check if $new_pending[$i_new_pending][tradeid] is not null	
				}//end if check_pending
			}		
		}
	}	
	$new_sell_awal = $new_sell - $new_sell_awal;
	$new_buy_awal = $new_buy - $new_buy_awal;	
	$perbedaan = $new_buy - $new_sell;
	//tradelog_validation("validationtge-3176-new_buy_awal:".$new_buy_awal.";new_sell_awal=".$new_sell_awal);
	//tradelog_validation("validationtge-3177-new_buy_kemudian:".$new_buy.";new_sell_kemudian=".$new_sell.";perbedaan=".$perbedaan);
	if($perbedaan == 0){
		$hedgeattempt = 1;
	}else{
		if(
			( $new_buy==$new_buy_awal && $new_buy_awal>$new_sell_awal && $new_sell>$new_sell_awal && $new_buy_awal>=$new_sell) 
		      ||( $new_sell==$new_sell_awal && $new_sell_awal>$new_buy_awal && $new_buy>$new_buy_awal && $new_sell_awal>=$new_buy)	 
		)
		{ //tambahan jika mau hedging
			$hedgeattempt = 1;
		}else{
			$hedgeattempt = 0;
		}	
	}
	//tradelog_validation("validationtge-3121-hedgeattempt:".$hedgeattempt);
	return $hedgeattempt ;
}

?>