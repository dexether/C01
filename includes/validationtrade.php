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
	$trade_go_in = "account:".$account;
	$action_type = strtolower($_action_type);
	$trade_go_in = $trade_go_in . ";action_type:".$action_type;
	$query = "select counter_type.action from counter_type  where counter_type.ctr_type = '$action_type'";
	$DB->connect();
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		$action = $row[action];		
	}
	$trade_go_in = $trade_go_in . ";action:".$action;
	$counterid = $_counterid ;
	$trade_go_in = $trade_go_in . ";counterid:".$counterid;
	$price = $_price ;
	$trade_go_in = $trade_go_in . ";price:".$price;
	$price_to = $_price_to ;
	$trade_go_in = $trade_go_in . ";price_to:".$price_to;
	$quantity = round($_quantity);
	$trade_go_in = $trade_go_in . ";_quantity:".$_quantity;
	$type = strtolower($_type); // New/Liquidate
	$trade_go_in = $trade_go_in . ";type:".$type;
	$liquidate_price = $_liquidate_price;	
	if($liquidate_price==null || $liquidate_price=='')
	{
		$liquidate_price = 0;
	}
	$trade_go_in = $trade_go_in . ";liquidate_price:".$liquidate_price;
	$liquidate_ref =$_liquidate_ref;
	$trade_go_in = $trade_go_in . ";liquidate_ref:".$liquidate_ref;
	$duration = strtolower($_duration ); // am1
	$trade_go_in = $trade_go_in . ";duration:".$duration;
	$durationto = strtolower($_durationto); // am3 
	$trade_go_in = $trade_go_in . ";durationto:".$durationto;
	$isorder =  $_isorder; 
	$trade_go_in = $trade_go_in . ";isorder:".$isorder;
	$closetrade = $_closetrade;
	$trade_go_in = $trade_go_in . ";closetrade:".$closetrade;
	$tradeid=$_tradeid;
	$trade_go_in = $trade_go_in . ";tradeid:".$tradeid;
	$harga=$_harga;
	$trade_go_in = $trade_go_in . ";harga:".$harga;
	
	$query_dealing = "select directdone from user where username = '$account'"; 
	$result = $DB->query($query_dealing);
	$row = mysql_fetch_array($result);
	$query_directdone = $row[directdone];
	$trade_go_in = $trade_go_in . ";query_directdone:".$query_directdone;
//tradelog("59");	
	$result_log_file = set_log_file($user->userid,'Trader','Trade','',$trade_go_in);
	
//echo "<script>alert('$tradeid');</script>";die;
if ($closetrade=="empty") { unset($closetrade); }
$index_counter_open = getCounterName($counterid);

if ($index_counter_open[open]==0 && empty($isorder))
{
echo "<SCRIPT language=\"Javascript1.2\">";
echo "parent.myTrade.showMessage(\"<font color=red><b>ref.147 $index[name]</b> counters are currently<br>closed for live trading.<br>Please try again when trading is resumed.</font>\");\n";
echo "parent.myTrade.showBusy(false);\n";
echo "</SCRIPT>";  
$result_log_file = set_log_file($user->userid,'Trader','CounterClosed1',"index_counter_open","0");
exit;
}

if ($index_counter_open[activeorder]==0 && !empty($isorder))
{  
echo "<SCRIPT language=\"Javascript1.2\">";
echo "parent.myTrade.showMessage(\"<font color=red><b>ref. 156 $index[name]</b> counters are currently<br>closed for live trading.<br>Please try again when trading is resumed.</font>\");\n";
echo "parent.myTrade.showBusy(false);\n";
echo "</SCRIPT>";  
$result_log_file = set_log_file($user->userid,'Trader','CounterClosed2',"activeorder",$isorder);  
exit;
}

//Check AE wheter he take right counter 061229
if ($user->groupid==3 || $user->groupid==4 || $user->groupid==5 || $user->groupid==11 ) //tambahan for Account Executive so he will not take wrong counter
{
	$query = "select marketindex.exchangecode from marketindex where marketindex.indexid =(
		    			select counter.indexid from counter where counter.counterid = '$counterid'
		   			)";
	//tradelog("trader-168=".$query);		   			
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$ae_counter_name = $row[exchangecode]; 	   			
 			
	$query = "select countertype from user where username = '$account' 
			and countertype  like ('%$ae_counter_name%')";
	//tradelog("trader-171=".$query);			
	$result = mysql_query($query);
	if (mysql_num_rows($result)==0)
	{	
		$result_log_file = set_log_file($user->userid,'Trader','NotMatchCounter',$counterid,$query);
		return "<font color='red'><b>Ref. 174-83 Counter Not Match</b></font><br>The Account doesn't have the counter trade<br>Please try another counter.";
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
$result_log_file = set_log_file($user->userid,'Trader','Max. Lot',$tradeid,"The maximum quantity allowed are");  
return "<font color='red'><b>Maximum.quantity exceeded</b></font><br>The maximum quantity allowed are  {$r['LotsMax']} units";
}

$query = "SELECT
	counter.name,counter.symbol,counter.spread,counter.decimal,counter.lotsize,counter.marginday,counter.quotemodeid,counter.topping,
	marketindex.checkhighlow, marketindex.multiplier, marketindex.limitmultiplier, marketindex.limitceiling,
	quotemode.functionname,counter.minqty 
	FROM counter
	LEFT JOIN marketindex ON counter.indexid = marketindex.indexid
	LEFT JOIN quotemode ON counter.quotemodeid = quotemode.quotemodeid
	WHERE counter.counterid = '$counterid'";
//tradelog("validation_trade-148=".$query);
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
//tradelog("validation_trade-160=".$symbol);

$checkhighlow = $row[checkhighlow]; // Used to determine whether to permit trades outside the day high/low
$multiplier = $row[multiplier]; // Used to give +- allowance to the current trading price 
$limitmultiplier = $row[limitmultiplier]; // Used to restrict orders from being to0 close to current price. (multiplier)
$limitceiling = $row[limitceiling]; // Used to restrict orders from being too far from current price.

$functionname = $row[functionname]; // Used to calculate the check_price based on quoting mode
$quotemodeid = $row[quotemodeid];

//Replace MarginDay from eacct 20070513
	$broker = new broker;
	$query_branchid = "select branchid from client_group,client_aecode,client_accounts 
				where 
				client_group.groupid = client_aecode.groupid 
				and client_aecode.aecodeid = client_accounts.aecodeid 
				and accountname='$_account'";	
	$query_broker_temp=$broker->query_first($query_branchid);				
	$account_branchid = $query_broker_temp[branchid];	
	$counter_temp = $broker->counter_setting_view($account_branchid);
	for($z_count=0;$counter_temp[$z_count];$z_count++)
	{			
		if($counter_temp[$z_count][counter]==$_counterid){
			$marginday_counter[$counter_temp[$z_count][counter]]  = $counter_temp[$z_count][marginday];			
	            	$hedgeratio[$counter_temp[$z_count][counter]] = $counter_temp[$z_count][hedge];            		  
			$counter_commissions = $counter_temp[$z_count][commission];	
			$pending_float_comission_required = $counter_temp[$z_count][close_comm]/100;	
			//return "<font color='red'><b>test-188</b></font><br>$pending_float_comission_required"; 	
			if($counter_commissions!='floating'){
				$pending_float_comission_required = 0;
			}
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
  	$result_log_file = set_log_file($user->userid,'Trader','Value-202',"empty",ucfirst($key));
  	if ($language->languageid=="1" ){
  		if (empty($val))  { $error[] = "The value of <b>".ucfirst($key)."</b> cannot be empty";  }
  	}
  	if ($language->languageid=="2" ){
  		if (empty($val))  { $error[] = ucfirst($key)."&#x7684;&#x4EF7;&#x503C;&#x4E0D;&#x80FD;&#x7559;&#x7A7A;";  }
  	}
}	
}

//2)by pass price_to for all, buy and sell anyprice
if (ucfirst($key)!="Price_to" && $action_type=='buy_mo' && $action_type=='sell_mo'){ 
if (!preg_match("/^\d+\.{0,1}\d*$/",$price)) { 
	$error[] = "1.You have entered an invalid <b>Price</b> type."; 
	$result_log_file = set_log_file($user->userid,'Trader','Value-215',"invalid-price",$price); 
	}
}else{
if (!preg_match("/^\d+\.{0,1}\d*$/",$price)) { 
	$error[] = "2.You have entered an invalid <b>Price</b> type."; 
	$result_log_file = set_log_file($user->userid,'Trader','Value-215',"invalid-price",$price); 
	} 	
}

//3)
if (!preg_match("/^\d+$/",$quantity)) { 
	$error[] = "You have entered an invalid <b>Quantity</b> type."; 
	$result_log_file = set_log_file($user->userid,'Trader','Value-228',"invalid-qty",$quantity); 
}

if ($quantity==0)  { 
	$error[] = "You have entered an invalid <b>Quantity</b> type."; 
	$result_log_file = set_log_file($user->userid,'Trader','Value-233',"invalid-qty",$quantity);  
	}
if ($action=='')  {
	$error[] = "Action cannot be blank ".$action;
	$result_log_file = set_log_file($user->userid,'Trader','Value-237',"invalid-action",$action);
}
if (count($error)>0)
{
return "<font color='red'><b>Empty Fields</b></font><br>".implode("<br>",$error);
exit;
}



/*****************************************************************************
* Fetch Current price/datetime/timestamp/high/low FROM realtime database for checking/comparison*
*****************************************************************************/
include("includes/globals_realtime.php");

//Price Feed Stop more than 30 Seconds
$query = "SELECT UNIX_TIMESTAMP() - UNIX_TIMESTAMP(MAX(time)) AS lastupdated1 FROM `quote` WHERE symbol = '$symbol' "; 
//tradeLog("query-268=".$query);
$result = mysql_query($query) OR DIE (mysql_error() . " $query");
$row = mysql_fetch_array($result);
$time_price_feed = $row[lastupdated1]; 

if ($query_directdone=="yes"){
	if ($time_price_feed>=30 && $symbol!='XAU'){
		//global $DB;
		//if ($DB->close()){
		//tradeLog("hapus");
		//}
		$time_price_feed_desc = "PriceFeed Error" . ";" . $price . ";" . $quantity . ";" . $action_type;
		$result_log_file = set_log_file($user->userid,'Trader','PriceFeedError-273',$time_price_feed,$time_price_feed_desc); 
		//return "<font color='red'><b>Price Not Update-273</b></font><br>Price Not Update<br>Ref.285 Please try again after price blink/ Ask Dealing for DQ.";
		$dealing_quote="pricefeed";
		$query_directdone="no";
	} 
	
	if ($time_price_feed>=90 && $symbol=='XAU'){
		//global $DB;
		//if ($DB->close()){
		//tradeLog("hapus");
		//}
		$time_price_feed_desc = "PriceFeed Error" . ";" . $price . ";" . $quantity . ";" . $action_type;
		$result_log_file = set_log_file($user->userid,'Trader','PriceFeedError-285',$time_price_feed,$time_price_feed_desc); 
		//return "<font color='red'><b>Price Not Update-286</b></font><br>Gold Price Not Update<br>Ref.293 Please try again after price blink/ Ask Dealing for DQ.";
		$dealing_quote="pricefeed";
		$query_directdone="no";
	} 
}

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

//echo $_sell;
//echo "<br>".$_buy;
// die;
//##############################################################


//### Check that realtime database was last updated within 10 seconds
if ($isorder!=1)
{
$query = "SELECT UNIX_TIMESTAMP() - UNIX_TIMESTAMP(MAX(time)) AS lastupdated FROM quote HAVING lastupdated <= 5";
$result = mysql_query($query);
if (mysql_num_rows($result)==0)
{
//comment, ko datanya Blingking tapi disetop ?
// return "<font color='red'><b>PriceFeed Error</b></font><br>Please call dealing center<br>or try again later." ;
}
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
    $campuran = "price=".$price.";day-high=". $day_high.";$spread=".$spread.":day_low=".$day_low;
    $result_log_file = set_log_file($user->userid,'Trader','PriceBuy-384',"rangehilo-wrong",$campuran); 
return "<font color='#33FF33'><b>Price Buy outside High Low range doesn't allow</b></font>" ;
}
break;

case "sell":
if (($price+$spread) >= $day_high || $price <= $day_low)
{
    $campuran = "price=".$price.";day-high=". $day_high.";$spread=".$spread.":day_low=".$day_low;
    $result_log_file = set_log_file($user->userid,'Trader','PriceSell-394',"rangehilo-wrong",$campuran); 
return "<font color='#33FF33'><b>Price Sell outside High Low range doesn't allow</b></font>" ;
}
break;
}
}
  //2)   
  if (!$closetrade)
  {
	//tradelog("trader-412-action=".$action);
	//tradelog("trader-413-price=".$price);
	//tradelog($check_price[$action]+($spread*$multiplier));
	//tradelog($check_price[$action]-($spread*$multiplier)); 
	if ($query_directdone=="yes"){
		if ($price > ($check_price[$action]+($spread*$multiplier))  )
		{	
			if ($action == 'sell'){
				//global $DB;
				//if ($DB->close()){
					//tradeLog("hapus");
				//}
				$ceilingUp = $check_price[$action]+($spread*$multiplier);
				$ceilingDown = $check_price[$action]-($spread*$multiplier);
				$desc_ceiling = $ceilingUp . ";" . $ceilingDown . ";" . $quantity . ";" . $action_type;
				$result_log_file = set_log_file($user->userid,'Trader','Price Limit Ceiling-418',$price,$desc_ceiling); 
				//return "<font color='#33FF33'><b>Price Limit Ceiling has changed</b></font>"; 
				$dealing_quote="limit_ceiling";
				$query_directdone="no";
			}	
		}	
		if ( $price < ($check_price[$action]-($spread*$multiplier)) )
		{	
			if ($action == 'buy'){
				//global $DB;
				//if ($DB->close()){
					//tradeLog("hapus");
				//}
				$ceilingUp = $check_price[$action]+($spread*$multiplier);
				$ceilingDown = $check_price[$action]-($spread*$multiplier);
				$desc_ceiling = $ceilingUp . ";" . $ceilingDown . ";" . $quantity . ";" . $action_type;
				$result_log_file = set_log_file($user->userid,'Trader','Price Limit Ceiling-434',$price,$desc_ceiling); 
				//return"<font color='#33FF33'><b>Price Limit Ceiling has changed</b></font>"; 
				$dealing_quote="limit_ceiling";
				$query_directdone="no";
			}	
		}
	}	
  }
}

/*****************************************************************************
* Price checks for Orders
*****************************************************************************/ 

$isorderpass="notpass";
if ($isorderpass=="notpass")
{ 
	if (!empty($isorder))
	{ 	
		if ($action_type!='oco_buy' && $action_type!='oco_sell')
		{
			if ($price < ($check_price[$action]+($spread*$limitmultiplier)) && $price > ($check_price[$action]-($spread*$limitmultiplier)))
			{
				$campuran=  "price=".$price.";checkprice=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
                		$result_log_file = set_log_file($user->userid,'Trader','Orderwrong-457',"to_close",$campuran);
				return "<font color='red'><b>Ref(390) Order price is too close to current price</b></font><br>Your price is too close to the current price. Please try again."; 
			}		
			if ($limitceiling != 0)
			{
				//tradelog("checkPrice=".$check_price[$action].";and spread=".$spread.";and limitceiling=".$limitceiling);
				if ($price < ($check_price[$action]-($spread*$limitceiling)) OR $price > ($check_price[$action]+($spread*$limitceiling)))
				{
					$campuran=  "price=".$price.";checkprice=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
                    			$result_log_file = set_log_file($user->userid,'Trader','Orderwrong-467',"to_far",$campuran);
					return "<font color='red'><b>Ref(397) Order price exceeds allowed range</b></font><br>Your price is too far from the current price. Please try again."; 
				}
			} // end $limitceiling != 0
		}


		
		//tambahan untuk OCO 200060804 
		if ($action_type=='oco_buy')
		{
			//1.Limit Buy from price		
			//$checkatas = $check_price[$action]+($spread*$limitmultiplier);
			$checkbawah = $check_price[$action]-($spread*$limitmultiplier);

			if ($price > $checkbawah)
			{
				$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
                		$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-485',"too_high",$campuran);
				return "<font color='red'><b>Ref(411)Order price Limit Buy $price is too High</b></font><br>Your price must lower than $checkbawah. Please try again."; 
			}		
			if ($limitceiling != 0)
			{
				//$check_superatas = $check_price[$action]+($spread*$limitceiling);
				$check_superbawah = $check_price[$action]-($spread*$limitceiling);
				if ($price < $check_superbawah)
				{
					$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitceiling=".$limitceiling;
					$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-495',"too_Low",$campuran);
					return "<font color='red'><b>Ref(434) Order price Limit Buy $price is too Low</b></font><br>Your price must higher than $check_superbawah. Please try again."; 
				}
			}
			//1.End Limit Buy from price	
			//2.Stop Buy from price		
			$checkatas = $check_price[$action]+($spread*$limitmultiplier);
			//$checkbawah = $check_price[$action]-($spread*$limitmultiplier);
			
			if ($price_to < $checkatas)
			{
				$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
                		$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-507',"too_Low",$campuran);
				return "<font color='red'><b>Ref(429)Order price Stop Buy $price_to is too Low</b></font><br>Your price must higher than $checkatas. Please try again."; 
			}		
			if ($limitceiling != 0)
			{
				$check_superatas = $check_price[$action]+($spread*$limitceiling);
				//$check_superbawah = $check_price[$action]-($spread*$limitceiling);
				if ($price_to > $check_superatas)
				{
					$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitceiling=".$limitceiling;
					$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-517',"too_Low",$campuran);
					return "<font color='red'><b>Ref(437) Order price Stop Buy $price_to is too High</b></font><br>Your price must lower than $check_superatas. Please try again."; 
				}
			}
			//2.End Stop Buy from price
		}
		if ($action_type=='oco_sell')
		{					
			//3.Limit Sell from price		
			$checkatas = $check_price[$action]+($spread*$limitmultiplier);
			//$checkbawah = $check_price[$action]-($spread*$limitmultiplier);
			
			if ($price < $checkatas)
			{
				$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
				$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-532',"too_Low",$campuran);
				return "<font color='red'><b>Ref(447)Order price Limit Sell $price is too Low</b></font><br>Your price must be higher than $checkatas. Please try again."; 
			}		
			if ($limitceiling != 0)
			{
				$check_superatas = $check_price[$action]+($spread*$limitceiling);
				//$check_superbawah = $check_price[$action]-($spread*$limitceiling);
				if ($price > $check_superatas)
				{
					$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitceiling=".$limitceiling;
					$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-542',"too_high",$campuran);
					return "<font color='red'><b>Ref(458) Order price Limit Sell $price is too High</b></font><br>Your price must be lower than $check_superatas. Please try again."; 
				}
			}
			//3.End Limit Sell from price				
			//4.Stop Sell from price		
			//$checkatas = $check_price[$action]+($spread*$limitmultiplier);
			$checkbawah = $check_price[$action]-($spread*$limitmultiplier);

			if ($price_to > $checkbawah)
			{
				$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitmultiplier=".$limitmultiplier;
				$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-554',"too_high",$campuran);
				return "<font color='red'><b>Ref(468)Order price Stop Sell $price_to is too High</b></font><br>Your price must be lower than $checkbawah. Please try again."; 
			}		
			if ($limitceiling != 0)
			{
				//$check_superatas = $check_price[$action]+($spread*$limitceiling);
				$check_superbawah = $check_price[$action]-($spread*$limitceiling);
				if ($price_to < $check_superbawah)
				{
					$campuran=  "price=".$price.";check_price=".$check_price[$action].";spread=".$spread.";limitceiling=".$limitceiling;
					$result_log_file = set_log_file($user->userid,'Trader','OCOwrong-564',"too_low",$campuran);
					return "<font color='red'><b>Ref(476) Order price Stop Buy $price_to is too Low</b></font><br>Your price must be higher than $check_superbawah. Please try again."; 
				}
			}
			//4.End Stop Sell from price				 
		}
	//End tambahan untuk OCO 200060804 		
	}
}	


mysql_close($realtime_connection);
include("includes/globals.php");  



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
if ($cek_current_pending==1){
//return "<font color='red'><b>Ref 645 Double Type </b></font><br>You cannot create another pending order with the same type."; 
//exit;
}
//1. End Cek same type	

//End Cek current pending cannot double

// TEMPORARY MODIFICATION: REFUSE ALL TRADES ATTEMPTING TO GO BELOW 22% OF AVAILABLE EQUITY
// 1) Get all prices
// 2) Caculate Total Floating Price
// 3) Check Equity Ratio

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
//tradelog("trader-660");
if (substr($row[ItemCode],0,7)=="USDJPY2" || substr($row[ItemCode],0,7)=="USDCHF2" || substr($row[ItemCode],0,2)=="UJ")
					{
						$row[Floating] = $row[Floating] / $row[CurrentPrice];
					}
if (substr($row[ItemCode],0,7)=="EUR/GBP")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] * $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
} 	
if (substr($row[ItemCode],0,7)=="EUR/CHF")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}   
if (substr($row[ItemCode],0,7)=="EUR/JPY" || substr($row[ItemCode],0,7)=="EURJPY2")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}        
if (substr($row[ItemCode],0,7)=="GBP/JPY")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}   

$TotalFloating += $row[Floating] + $row[FLCOMM];

$newlimit[$row[ItemCode]] += $row[Unit]; // absolute hedging quantity of open positions for a counter.     
}
else
{
$row[CurrentPrice] = number_format($prices[$row[ItemCode]][buy],$row[Format],".","");
$row[Floating] = ($row[SellPrice] - $row[CurrentPrice]) * $row[Unit] * $row[LotSize];
if (preg_match("/^USD\/.+/",$row[ItemCode])) { $row[Floating] = $row[Floating] / $row[CurrentPrice];  }
if (substr($row[ItemCode],0,7)=="USDJPY2" || substr($row[ItemCode],0,7)=="USDCHF2" || substr($row[ItemCode],0,2)=="UJ" )
					{
						$row[Floating] = $row[Floating] / $row[CurrentPrice];
					}
if (substr($row[ItemCode],0,7)=="EUR/GBP")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'GBP A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] * $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}  
if (substr($row[ItemCode],0,7)=="EUR/CHF")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'CHF A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
} 
if (substr($row[ItemCode],0,7)=="EUR/JPY" || substr($row[ItemCode],0,7)=="EURJPY2")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}        
if (substr($row[ItemCode],0,7)=="GBP/JPY")
{
//tradelog("tempstatement Sell New-".$row[ItemCode]);
global $DB_quote;
$query = "SELECT quote.last FROM $DB_quote->db.quote WHERE quote.symbol = 'JPY A0-FX'";
$result = $DB_quote->query($query);
$row_quote = mysql_fetch_array($result);
$lastclosing = $row_quote[last];
unset($row_quote);    
//tradelog("tempstatement Sell New-".$row[ItemCode].";".$lastclosing); 
include("includes/globals.php");
$row[Floating] = $row[Floating] / $lastclosing;	
//tradelog("Temp Statement2=".$row[Floating]);
}   

$TotalFloating += $row[Floating] + $row[FLCOMM];

$newlimit[$row[ItemCode]] -= $row[Unit]; // absolute hedging quantity of open positions for a counter.   
}
}
}

// $NEWLIMIT
// If a client owns 3 EUR (BUY) and 1 EUR (SELL) position. He has an effective/absolute 
// quantity of remaining 2 (SELL) to be considered a hedge.

// $HEDGEATTEMPT : If user is attempting to hedge an existing position and has sufficient quantity.

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
// $query = "SELECT credit FROM tempcredit WHERE account = '$account'";
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
//### User must have sufficient funds to trade
//1) Get effective margin from bafile & Current prices
// 1.0) Get live prices 
// 1.1) Get all open positions
// 1.2) Calculate $TotalFloating (TO BE DONE)
// 1.3) Get New balance and Margin Required (TO BE DONE)
// 1.4) Calculate Effective Margin (TO BE DONE)
//2) ********************** "Processing positions" must not exceed the quantity (TO BE DONE)
//2) Quantity must not be exceed margin.
// 2.1)Processing = within margin,
// 2.2)If less than margin required (e.g. <$1000) = reject
// 3) If sell+order, only allow it if the queue price is higher than current price & he has no open positions

//1.0)
//$prices = fetchPrices();   
########################################

$query = "SELECT DISTINCT(symbol) AS symbol FROM counter WHERE active=1";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
$symbols[] = $row[symbol];
//tradelog("symbol=".$row[symbol]);
}

//tradeLog("875");
//global $DB_quote;
//if ($DB_quote->close()){
//tradeLog("hapus");
//}

// GET ALL PRICES FROM QUOTE
$query = "SELECT symbol, last FROM `quote` WHERE symbol IN ('".implode("','",$symbols)."')";
$result = $DB_quote->query($query);
while ($row = $DB_quote->fetch_array($result))
{
$quote[$row[symbol]] = $row[last];
//tradelog("Row=".$row[last]);
} 


//if (!$DB->close()){
//tradeLog("hapus DB2");
//$DB->connect();
//} 
$query = "SELECT name, symbol, spread FROM counter WHERE active = 1"; 
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
$new_equity = $row[Equity];
$effective_margin = $newBalance+$TotalFloating-$row[MarginReq];

//$margin_required = $marginday;
$margin_required  = intval($marginday_counter[$counterid]);

//2.1)
//tradelog("effective_margin=".$effective_margin. " and margin_required=".$margin_required." and quantity=".$quantity." PrevBal=".$PrevBal.";NewBal=".$NewBal);
$log_campuran = "eff=".$effective_margin.":margin_required=".$margin_required.":qty=".$quantity.":PrevBal=".$PrevBal;
$result_log_file = set_log_file($user->userid,'Trader','effective-916',"effective",$log_campuran);
   	    					

	//071018 untuk jltm	
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' and LiqStatus=''";
	$result = $DB->query($query);
	$bypass = "notbypass";
	while ($row = $DB->fetch_array($result))
	{
		$bypass ="passmargin";
	}	
	if($bypass=="notbypass"){
		$min_margin = $margin_required * 2; //minimal bisa untuk 2 lot
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
			if($effective_margin < ($other_minimal_margin*2)){
			   	$result_log_file = set_log_file($user->userid,'Trader','Ref(930)Insufficient Funds',$price,$query_log);    
			    	showError("<font color='red'><b>Ref(930)Insufficient Funds</b></font><br>You do not have sufficient funds for margin more than 2 lot.");    				
			}
			//tradelog("validationtge-minimal_margin-602-".$minimal_margin);		   	
		}
		if ($type=='new' && $quantity < $minqty){ 
		   	$result_log_file = set_log_file($user->userid,'Trader','Ref(934) Minimum Qty',$quantity,$minqty);    
		    	showError("<font color='red'><b>Ref(934) Minimum Qty</b></font><br>$quantity lot does not allow, minimum is $minqty lot");    	    		
		}
    	}   	

    	//tambahan 071110
    	$query = "SELECT client_accounts.daycall from client_accounts  where accountname = '$account';";
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
	    $marginratio_rationnya = $row[daycall]/100;
	}
	
	$query = "SELECT counter.name, marketindex.hedgeratio, marketindex.marginratio FROM counter LEFT JOIN marketindex USING (indexid)";
	//tradelog("validationtrade-949-".$query);
	$result = $DB->query($query);
	while ($row = $DB->fetch_array($result))
	{
		//$ratios[$row[name]][hedgeratio] = intval($hedgeratio[$row[name]] * $marginratio_rationnya);
		$ratios[$row[name]][hedgeratio] = intval($hedgeratio[$row[name]] );
		//$ratios[$row[name]][marginratio] = intval($marginday_counter[$row[name]] * $marginratio_rationnya); 
		$ratios[$row[name]][marginratio] = intval($marginday_counter[$row[name]]); 
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
	if ($action=="buy") { $hedge_action = "buy"; } else { $hedge_action = "sell"; }
	$trades[$counter][$hedge_action] += $quantity; 

	if ($trades[$counter][$action] > 0) // Has opposing trades
	{
		$query = "SELECT Equity, MarginReq FROM bafile WHERE AccNo = '$account'";
		$result = $DB_odbc->query($query);
		$row = $DB_odbc->fetch_array($result);
		$row[Equity] += $credit;
		$effective_margin = $newBalance+$TotalFloating-$row[MarginReq];
		$equity = $row[Equity];
		//$margin_required = $marginday;
		$margin_required  = $ratios[$counterid][marginratio];
		if (count($trades) > 0)
		{
			$required_margin = 0;
			foreach ($trades AS $name => $trade)
			{
			
				$campuran = $campuran . ";" . "name=" . $name;
				$campuran = $campuran . ";" . "required_margin=" . $required_margin;
				$hedgevalue = $ratios[$name][hedgeratio];
				$campuran = $campuran . ";" . "hedgevalue=" . $hedgevalue;
				$marginvalue = $ratios[$name][marginratio];
				$campuran = $campuran . ";" . "marginvalue-1473=" . $marginvalue;

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
				
				if($hedgeattempt=='1' && $new_equity<$required_margin){
					$querylog = "$name: required margin: $required_margin" . " ( ($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))";
    				   	$result_log_file = set_log_file($user->userid,'Trader','Ref(1007) Call Margin','',$querylog);    
		    			showError("<font color='red'><b>Ref(1007) Call Margin</b></font><br>Equity $new_equity must greater than Margin Req. $required_margin");    	    					
    				}    				
			}
		}
	}	  
	//end tambahan 071110
	//end 071018 untuk jltm 

//if (($effective_margin >= ($margin_required * $quantity)) && (($margin_required * $quantity)<=$NewBal)) //ini belum solve kalo newbal minus

if (($effective_margin >= ($margin_required * $quantity)) )
{
	//tradelog("duration=".$duration);
	if (empty($duration)) // Immediate trade
	{
		if ($query_directdone=="yes"){
		$ta_message[message] = "<font color='red'><b>Order Processing1</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br></font>";
		$ta_message[refreshOpenPositions] = 0;
		$ta_message[refreshTradeHistory] = 1;
		$ta_message[code] = "";
		$statusid = 3; // Processing
		}else{
			if ($language->languageid=="1" ){			
				$ta_message[message] = "<font color='red'><b>Ref(1288) Please wait 1</b></font><font color='#FBFF47'><br>Please allow a few moments for price checking<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
			}
			if ($language->languageid=="2" ){
				$ta_message[message] = "<font color='red'><b>Ref(1288) Please wait 1</b></font><font color='#FBFF47'><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
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
		$ta_message[message] = "<font color='red'><b>Ref(1100)Order Pending1</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action_type ($quantity) of $counter Limit($price) and Stop ($price_to)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.</font>";
		}else{
			$ta_message[message] = "<font color='red'><b>Ref(1102)Order Pending1</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.</font>";      
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
	$log_campuran = $log_campuran.":hedgeattempt=".$hedgeattempt;
	$result_log_file = set_log_file($user->userid,'Trader','effective-911',"effective",$log_campuran);
// Allow user to bypass EM check if he's attempting to hedge
//tradelog("trader 2.2=".$margin_required.";".$quantity.";".$PrevBal);
if ($hedgeattempt==1)
{    
if (empty($duration)) // Immediate trade
{      	
if ($query_directdone=="yes"){
$ta_message[message] = "<font color='red'><b>Order Processing2</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br></font>";    		
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 3; // Processing
}else{
if ($language->languageid=="1" ){
$ta_message[message] = "<font color='red'><b>Ref(1328) Please wait 2</b></font><font color='#FBFF47'><br>Please allow a few moments for price checking.<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";    		
}
if ($language->languageid=="2" ){
$ta_message[message] = "<font color='red'><b>Ref(1328) Please wait 2</b></font><font color='#FBFF47'><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;.<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";    		
}	      		
$ta_message[refreshOpenPositions] = 0;
$ta_message[refreshTradeHistory] = 1;
$ta_message[code] = "";
$statusid = 8; // Waiting Dealing To Answer
}      		
}
else{
$ta_message[message] = "<font color='red'><b>Order Pending2</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.</font>";      		
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
$result_log_file = set_log_file($user->userid,'Trader','Ref(805)Insufficient Funds',$price,$query_log);    
return "<font color='red'><b>Ref(805)Insufficient Funds</b></font><br>You do not have sufficient funds.";
}

}


// tradelog("xxx");
break; // End new

/*****************************************************************************
* LIQUIDATE                                                                  *
*****************************************************************************/
case "liquidate":
// tradelog("xxx");
//### Pending order units must not be greater than existing position units.
//0) Convert liquidate_ref into "order_date" and "order_ref" type
//1) Get total liquidation quantity (Check whether position still exists.)
//1a) Get Close Pair Trades

//2.1) Get total order units currently processing (update: done(1)/processing(3)),
//   thus determining the remaining quantity allowed to trade
//2.2) Get total order units currently pending (update: pending(2))
//2.3) Get final units (done + processing + pending)

//3.1) If there are 0 available quantity, then open positions may
//     already have been liquidated completely.
//3.2) Order units must be less than pending units
//3.3) Order units must be less than existing (done/processing) position units

//0)
$reference = explode("_",$liquidate_ref);
$order_date = $reference[0];
$order_ref = $reference[1];
$unique_ref = $order_date . "_" . $order_ref; // 20040506_48

unset($reference);


// If liquidating, check whether user's position is still available
// Note: This is because ECU now assigns a new order reference whenever the position has changed (quantity, etc) due to
// partial liquidation, etc.

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

$query = "select client_tradeorders.status from client_tradeorders 
        where client_tradeorders.tradeid = '".$order_ref."'";
$row = $DB->query_first($query);
$status_open = trim($row[status]);       

if ($status_open!='OPEN') 
{
    $result_log_file = set_log_file($user->userid,'Trader','Ref(1133)Outdated Position',$status_open,$query);
    return "<font color=red><b>Outdated Position</b></font><br>The position you are attempting to trade does not exist; or has been liquidated already.";
}


//1)
switch ($action)
{
case "buy":
$query = "SELECT Unit,SellPrice AS price FROM dafile WHERE AccNo = '$account' AND SellDate='$order_date' AND SellOrder=$order_ref AND LiqStatus=''";
// $query = "SELECT Unit,SellPrice AS price FROM dafile WHERE AccNo = '$account'";
break;

case "sell":
$query = "SELECT Unit,BuyPrice AS price FROM dafile WHERE AccNo = '$account' AND BuyDate='$order_date' AND BuyOrder=$order_ref AND LiqStatus=''";
//$query = "SELECT Unit,BuyPrice AS price FROM dafile WHERE AccNo = '$account'";
break;
}
$result = $DB_odbc->query( $query);

//echo "start".odbc_result_all($result);
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
FROM trade
WHERE account = '$account'
AND action = 'sell'
AND type = 'liquidate'
AND statusid = 2
AND isorder = '1'";
break;

case "sell":
$query = "SELECT
SUM(quantity) AS pendingquantity
FROM trade
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
//if ($quantity > ($close[quantity] - $pendingquantity)) { $quantity = ($close[quantity] - $pendingquantity); }

if (($close[quantity] - $pendingquantity)>0)
{   
if ($quantity > ($close[quantity] - $pendingquantity)) { $quantity = ($close[quantity] - $pendingquantity); }
}
else
{
    $campuran = "quantity=".$quantity.";close_qty=".$close[quantity].";pendingqty=".$pendingquantity;
    $result_log_file = set_log_file($user->userid,'Trader','Pending Position-1159',"ClosePair",$campuran);  
return "<font color=red><b>Pending positions exist</b></font><br>The close pair trade you are attempting already has standing orders. You need to remove them in order to continue.";
}

//1a.5)


} // end Close Pair Trades   

//2.1)
$query = "SELECT SUM(quantity) AS processing_quantity  FROM trade WHERE account='$account' AND liquidate_ref LIKE '$unique_ref%' AND statusid = 3";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$processing_quantity = $row[processing_quantity];

echo "processing quantity: $processing_quantity";

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
// 
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
//tradelog("trader1359 isoco=1".$_harga);
}

//$query = "SELECT AccNo,ItemCode,Unit,BuyOrder,BuyPrice,BuyDate,SellOrder,SellPrice,SellDate FROM dafile WHERE (LiqStatus = '') AND AccNo = '$account' ORDER BY ItemCode";
//$pending_quantity =0;
}

//tradelog("trader-1266-liquidate_quantity=".$liquidate_quantity.";pending_quantity=".$pending_quantity);
$permitted_pending = $liquidate_quantity - $pending_quantity;  
$campuran = "liquidate_qty=".$liquidate_quantity.";pending_qty=".$pending_quantity;   
//2.3)
$final_quantity = $processing_quantity + $pending_quantity;
$campuran = $campuran .";process_qty=".$processing_quantity; 
//$final_quantity=0;
$permitted_final = $liquidate_quantity - $final_quantity;
$campuran = $campuran .";permitted_final=".$permitted_final; 

//3.1)
if ($permitted_quantity==0)
{
$result_log_file = set_log_file($user->userid,'Trader','Permited-1230',"AlreadyLiquidate",$campuran); 
return "<font color='red'><b>Ref. 1174 Notice</b></font><br>This position has been liquidated. Please allow the system a few moments to update.";    
}

//3.2)

if($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
	//bypass karena masalah double sudah di cek di atas
}else{ 
	if($quantity>$permitted_pending && ( $_harga=="empty" || $_harga=="" ) ) 
	{ 		
		$campuran = "quantity=".$quantity.";permitted_pending=".$permitted_pending.";harga=".$_harga; 
		if ($_type=="liquidate" && $_duration==""){
			$campuran = $campuran .";type=liquidate;duration="; 
			if($query_directdone=="yes"){
				$campuran = $campuran .";query_directdone=yes";  
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
					//$DB->close(); 
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
					$result_log_file = set_log_file($user->userid,'Trader','Permited-1283',"AlreadyPending",$campuran); 
					return "<font color='red'><b>(1283)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
				}
			}else{
				$result_log_file = set_log_file($user->userid,'Trader','Permited-1287',"AlreadyPending",$campuran); 
				return "<font color='red'><b>(1287)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
			}	
		}
		else{
			$result_log_file = set_log_file($user->userid,'Trader','Permited-1292',"AlreadyPending",$campuran); 
			return "<font color='red'><b>(1292)Notice</b></font><br>You already have 'pending' orders for this position. Please remove the pending orders before attempting an immediate liquidation." ; 
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
	        $campuran = "quantity=".$quantity.";permitted_final=".$permitted_final;
        	$result_log_file = set_log_file($user->userid,'Trader','Permited-1313',"Exceed",$campuran); 
		return "<font color='red'><b>Ref.1837 Notice</b></font><br>You have exceeded your allowed<br>quantity for the position: <b>($counter) $liquidate_price ,$permitted_final,$quantity,$order_date,$order_ref,$liquidate_quantity,$final_quantity, $processing_quantity, $pending_quantity</b>";
	}
}

if (!$isorder)
{
	if ($query_directdone=="yes"){
		$ta_message[message] = "<font color='red'><b>Ref(1396) Order Processing3</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br></font><br>";
		if ($closetrade)
		{
			$ta_message[message] .= "<font color='red'><b>Ref(1400) Close Pair Trade</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$close[action] ($quantity) of $counter ($close[price])<br></font><br>";
		}
		//$ta_message[message] .= "<font color='#FBFF47'>".$language->parse("Please allow a few moments for system update").".<br></font><br><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
		$ta_message[refreshOpenPositions] = 0;
		$ta_message[refreshTradeHistory] = 1;
		$ta_message[code] = "";
		$statusid = 3; // Processing
	}else{
		if ($language->languageid=="1" ){
			$ta_message[message] = "<font color='red'><b>Ref(1632) Please wait 3</b></font><font color='#FBFF47'><br>Please allow a few moments for price checking<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
		}
		if ($language->languageid=="2" ){
			$ta_message[message] = "<font color='red'><b>Ref(1635) Please wait 3</b></font><font color='#FBFF47'><br>&#31995;&#32479;&#27491;&#21521;&#24066;&#22330;&#25253;&#20215;<br></font><marquee id='scroller' style='background:#BDBABD; width:200; height:5; border: inset 3px #3385B3' direction='right' scrollamount='5'><div style='width:100%; background:blue'></div></marquee>";
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
		$ta_message[message] = "<font color='red'><b>Ref(1412) Order Pending</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action_type ($quantity) of $counter Limit($price) and Stop ($price_to)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.</font>";
	}else{
		$ta_message[message] = "<font color='red'><b>Ref(1464) Order Pending</b></font><font color='#FBFF47'><br>Your order for account ($account),<br>$action ($quantity) of $counter ($price)<br>has been submitted.<br><br>When the order is executed, your trade will show a 'Done' status.</font>";     
	}
	$ta_message[refreshOpenPositions] = 1;
	$ta_message[refreshTradeHistory] = 1;
	$ta_message[code] = "";
	$statusid = 2; // Pending       
}

//tradelog("traedr-1458".$closetrade);
if (!$closetrade)
{
//4) Check for Liquidate Equity (Added: 7th April 2005)
//4.0) Get all Hedge Ratios for all counters
//4.1) Has opposing trades
//  4.1N) Bypass
//  4.1Y) Get all positions (minus current trade position) to calculate Total Margin Required
//     4.2Is Equity sufficient?
//        4.2Y) Allow Trade
//        4.2N) Disallow Trade (  return "<font color='red'><b>Insufficient Maintenance Margin</b></font><br>This account can only do a Buy/Sell Liquidation(Close Pair)."; )

//4.0)

$query = "SELECT client_accounts.daycall from client_accounts  where accountname = '$account';";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
    $marginratio_rationnya = $row[daycall]/100;
}
//tradelog("validationtrade-1382-marginratio=".$marginratio);

$query = "SELECT counter.name, marketindex.hedgeratio, marketindex.marginratio FROM counter LEFT JOIN marketindex USING (indexid)";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
	$ratios[$row[name]][hedgeratio] = intval($hedgeratio[$row[name]] * $marginratio_rationnya);
	$ratios[$row[name]][marginratio] = intval($marginday_counter[$row[name]] * $marginratio_rationnya); 
	
	//tradelog("validationtrade-1410-name=".$row[name]);
	//tradelog("validationtrade-1412-marginratio_rationnya=".$marginratio_rationnya);	
	
	//tradelog("validationtrade-1411-hedgeratio=".$hedgeratio[$row[name]]);
	//tradelog("validationtrade-1411-marginday_counter=".$marginday_counter[$row[name]]);
	
	//tradelog("validationtrade-1414-hedgeratio=".$ratios[$row[name]][hedgeratio]);		
	//tradelog("validationtrade-1416-marginratio=".$ratios[$row[name]][marginratio]);
}

//4.1)
//### Get all positions of user
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

// Deduct current trades from list of positions to determine the remaining trades lefts and calculate equity
$trades[$counter][$hedge_action] -= $quantity; 

// Has Opposing trade(s)
if ($trades[$counter][$action] > 0) // Has opposing trades
{
//echo "has opposing trades (".$trades[$counter][$action].")";

//4.2) // Get Equity & MarginRequired Per Lot/Hedge
$query = "SELECT Equity, MarginReq FROM bafile WHERE AccNo = '$account'";
$result = $DB_odbc->query($query);
$row = $DB_odbc->fetch_array($result);
$row[Equity] += $credit;
$effective_margin = $newBalance+$TotalFloating-$row[MarginReq];
$equity = $row[Equity];

//     $query = "SELECT IAFILE.EURSize AS margin_required FROM bafile LEFT JOIN IAFILE ON bafile.IntTable = IAFILE.IntTable WHERE bafile.AccNo = '$account'";
//     if ($result = $DB_odbc->query($query))
//     {
//      $row = $DB_odbc->fetch_array($result);   
//      
//      $margin_required = ($row[margin_required] / 100);  // Lot size divided by 100, e.g. 100,000 = 1000 margin required
//     }
//     else
//     {
//      $margin_required = "1000";
//     }

//$margin_required = $marginday;
$margin_required  = $ratios[$counterid][marginratio];

if (count($trades) > 0)
{
$required_margin = 0; // Init

foreach ($trades AS $name => $trade)
{
$hedgeratio = $ratios[$name][hedgeratio];
$marginratio = $ratios[$name][marginratio];
$hedgevalue = intval($hedgeratio);
$marginvalue = intval($marginratio);

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
if($name==$_counterid){
	if($action=="sell" && $trade[sell]>$trade[buy] && $statusid == "2"){
		$campuran = "Ref(F1604) Sell = ".$trade[sell].";buy=".$trade[buy].";action=".$action;
		$result_log_file = set_log_file($user->userid,'Trader','Contigent-1604',"Contigent",$campuran); 
		//showError("<font color='red'><b>Ref(1604)Contigent Order</b></font><br>Stop/Limit order sell doesn't allow for Sell : $trade[sell] and Buy : $trade[buy] doesn't allow");
	}
	if($action=="buy" && $trade[sell]<$trade[buy] && $statusid == "2"){
		$campuran = "Ref(F1610) Sell = ".$trade[sell].";buy=".$trade[buy].";action=".$action;
		$result_log_file = set_log_file($user->userid,'Trader','Contigent-1610',"Contigent",$campuran); 
		//showError("<font color='red'><b>Ref(1610)Contigent Order</b></font><br>Stop/Limit order buy doesn't allow  for Sell : $trade[sell] and Buy : $trade[buy] doesn't allow");
	}
}
$required_margin += intval($hedge_quantity * $hedgevalue) + intval($open_quantity * $marginvalue);
//echo "<br>$name: required margin: $required_margin" . " (($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))";
}
}  	    

} // End
$campuran = "$name: required margin: $required_margin" . " (($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))";
$result_log_file = set_log_file($user->userid,'Trader','check-1612',$equity,$campuran); 

if ($equity < $required_margin)
{
//echo "required margin: $required_margin" . " (($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))";
//tradelog("required margin: $required_margin" . " (($hedge_quantity * $hedgevalue) + ($open_quantity * $marginvalue))");
// if (!empty($liquidate_ref) || !empty($closetrade))
// {
// 
// }else
// {
        $campuran = "equity=".$equity.";required_margin=".$required_margin;
        $result_log_file = set_log_file($user->userid,'Trader','Insufficient-1478',"Insufficient",$campuran); 
	return "<font color='red'><b>(1443) Insufficient Maintenance Margin</b></font><br>This account can only do a Buy/Sell Liquidation(Close Pair).";
// }
}       
}
break; // End liquidate
}
//tradelog("End Liquidity");

//tambahan check OCO 060802 --> ini sudah tidak dipakai lagi karena oco ini sudah dihapus
if ($_harga!='empty' &&  $_harga!=''){
$there_is_refoco = 0;
$query_check = "select trade.RefOCO from trade WHERE tradeid = $_harga";
//tradelog("trader-query_check".$query_check);
$result = $DB->query($query_check);
while ($row = $DB->fetch_array($result))
{
$there_is_refoco = $row[RefOCO];
}
//tradelog("trader-there_is_refoco".$there_is_refoco);
if ($isoco==1 && $there_is_refoco != 0){
	$campuran = "isoco=".$isoco.";there_is_refoco=".$there_is_refoco;
	$result_log_file = set_log_file($user->userid,'Trader','Double-OCO-1500',$campuran,$query_check); 
	return "<font color='red'><b>Double OCO</b></font><br>You already have OCO with this Price.";  
}
}
//tradelog("trader 1451-harga=".$_harga);
//return "<font color='red'><b>test</b></font><br>test2.";  			  
//end tambahan check OCO 060802


if ($user->username  == $account)
{
$trade[userid] = $user->userid;
$trade[tradedby] = $user->userid;
$trade[tradedbyname] = $account;  
}
else
{
// AE Trade
$query = "SELECT userid FROM user WHERE username = '$account'";
$row = $DB->query_first($query);
$trade[userid] = $row[userid];
$trade[tradedby] = $user->userid;
$trade[tradedbyname] = $user->username; 
}
//tradelog("isoco=".$isoco);
if($isoco==null)
{
//tradelog("isoconull");
$isoco = 0;
}

if ($isorder=='' || $isorder == null){
$isorder=0;
}
//tradelog("trader1583-isoco=".$isoco.";duration=".$duration);
if($isoco==0)
{
if ($duration=='gtn' || $duration=='gtf'){
//tradelog("Statusid=".$statusid);
$statusid = 2; //Pending
}

if ($duration=='gtn' || $duration=='gtf' || $duration==''){
if ( $action_type=='oco_sell' || $action_type=='oco_buy' ){
$trade_query = "INSERT INTO trade
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
durationto = '$duration',
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
}else{		
//tradelog("Account1=" . $account . ";duration=" . $duration . "Check DateTime=" . $check_datetime);		
$trade_query = "INSERT INTO trade
SET
userid = '$trade[userid]',
account = '$account',
action = '$action',
counterid = '$counterid',
price = '$price',
quantity = '$quantity',
type = '$type',
datetime = NOW(),
liquidate_price = '$liquidate_price',
liquidate_ref = '$liquidate_ref',             
duration = '$duration',
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
//tradelog("trader-trade_query=".$trade_query);		
}

if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
$trade_query = "INSERT INTO trade
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

//tradelog("trader-duration=".$duration);
//060603 Multilateral Table, add 
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
$trade_query = "INSERT INTO trade_multi
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
//tradeLog("1880".$trade_query);
if($isoco==1)
{

if ($duration=='gtn' || $duration=='gtf'){
$statusid = 2; //Pending
}

if ($duration=='gtn' || $duration=='gtf' || $duration==''){
//tradelog("Account2=" . $account . ";duration=" . $duration . "Check DateTime=" . $check_datetime);
$trade_query = "INSERT INTO trade
SET
userid = '$trade[userid]',
account = '$account',
action = '$action',
counterid = '$counterid',
price = '$price',
quantity = '$quantity',
type = '$type',
datetime = NOW(),
liquidate_price = '$liquidate_price',
liquidate_ref = '$liquidate_ref',             
duration = '$duration',
isorder = '$isorder',
statusid = $statusid,
isbbj = '0',
check_price = '$check_price[$action]',
check_high = '$day_high',
check_low = '$day_low',
check_datetime = '$check_datetime',
done_datetime = NOW(),
RefOCO ={$_harga},
tradedby = '$trade[tradedby]',
tradedbyname = '$trade[tradedbyname]',
typeorder='{$mode_order}'";
}	

//tambahan Future 060617 add 
if ($duration=='am1' || $duration=='am2' || $duration=='am3' || $duration=='pm1' || $duration=='pm2' || $duration=='pm3'){
$trade_query = "INSERT INTO trade
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
$trade_query = "INSERT INTO trade_multi
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


if ($closetrade)
{   

if ($duration=='gtn' || $duration=='gtf'){
$statusid = 2; //Pending			
}

if ($duration=='gtn' || $duration=='gtf' || $duration==''){
$closetrade_query = "INSERT INTO trade
SET
userid = '$trade[userid]',
account = '$account',
action = '$close[action]',
counterid = '$counterid',
price = '$close[price]',
quantity = '$quantity',
type = '$type',
datetime = NOW(),
isbbj = '0',
liquidate_price = '$close[liquidate_price]',
liquidate_ref = '$closetrade"."_"."$close[quantity]',             
duration = '$duration',
isorder = '$isorder',
statusid = $statusid,
check_price = '$check_price[$action]',
check_high = '$day_high',
check_low = '$day_low',
check_datetime = '$check_datetime',
done_datetime = NOW(),
tradedbyname = '$trade[tradedbyname]',
tradedby = '$trade[tradedby]'";  
}	
//tradelog("trader.php-closetrade;-closetrade_query=".$closetrade_query);                            	
}
$log_closetrade_query= $closetrade_query;


///###############CEK if another transaction already done add By 060209####################//
//tradeLog("trader-query2-2003");
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

//lockingid==1 means locking yes, 2 means cannot lock
if ($user->lockingid==2 && $type=="new") {
	if ($newlimit[$counter]<0 && $action=="buy"){  // mean buy new
	        $campuran = "locking=2;type=new;newlimit=".$newlimit[$counter].";action=buy";
	        $result_log_file = set_log_file($user->userid,'Trader','Locking-1868',"Buy",$campuran); 
				  return "<font color='red'><b>Ref. 1868 Notice</b></font><br>You cannot Buy for Locking this counter."; 
	}
	if ($newlimit[$counter]>0 && $action=="sell"){
	        $campuran = "locking=2;type=new;newlimit=".$newlimit[$counter].";action=sell";
	        $result_log_file = set_log_file($user->userid,'Trader','Locking-1874',"Sell",$campuran); 		
	        return "<font color='red'><b>Ref. 1875 Notice</b></font><br>You cannot Sell for Locking this counter.";  
	}  			
}

//tambahan untuk New STOP 20060816
if ($action_type=='buy' && empty($liquidate_ref) && $price > $check_price[$action] )
{
	//if hedgeattempt bukan 1 maka artinya tidak hedging
	if($hedgeattempt != 1){
		if ($duration=='gtn' || $duration=='gtf'){
		        $campuran = "$quantity=".$quantity.";not allow";
            		$result_log_file = set_log_file($user->userid,'Trader','StopNew-1886',"Stop Buy",$campuran);
			return "<font color='red'><b>Ref(1886) Order price with qty ". $quantity ." Stop Buy New Doesn't Allow</b></font><br>Your price must be lower than running Price. Please try again.";
		}
	}	
}
if ($action_type=='sell' && empty($liquidate_ref) && $price < $check_price[$action] )
{
	//if hedgeattempt bukan 1 maka artinya tidak hedging
	if($hedgeattempt != 1){
		if ($duration=='gtn' || $duration=='gtf'){
			$campuran = "$quantity=".$quantity.";not allow";
            		$result_log_file = set_log_file($user->userid,'Trader','StopNew-1898',"Stop sell",$campuran);
			return "<font color='red'><b>Ref(1898) Order price with qty ". $quantity ." Stop Sell New Doesn't Allow</b></font><br>Your price must be higher than running Price. Please try again.";
		}
	}	
}			
//End tambahan untuk New STOP 20060816

$result_log_file = set_log_file($user->userid,'Trader','Trade_query',"line-1903",$trade_query); 
/*****************************************************************************
* INSERT TRADES                                                               *
*****************************************************************************/
//tradeLog("trader-2112");
if ($duration=='gtn' || $duration=='gtf' || $duration==''){ 			 
	if ($result = $DB->query($trade_query))
	{
		$tradeid = mysql_insert_id();
		if($statusid == '3' || $statusid == '2'){
			$ta_message[message] .= "<font color='red'><br><b>Tradeid is</b></font><font color='#FBFF47'><br>$tradeid<br></font><br>";
		}
		if($statusid == '3'){
			$ta_message[message] .= "<font color='#FBFF47'>Please check on the Transaction History<br></font><font color='red'>at Left Below on the screen.<br>to see Process already </font><font color='red'>'Done'.</font><font color='#FBFF47'>To erase this message, Please Refresh by Click </font><font color='red'>F5</font><br>";
		}
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
				return "<font color='red'><b>Fatal Error</b></font><font color='#FBFF47'><br>The System is currently unavailable.<br>Please try again.</font>"; 			
			}else{
				$tradeid = mysql_insert_id();
				if($statusid == '3' || $statusid == '2'){
					$ta_message[message] .= "<font color='red'><b>Close Tradeid is</b></font><font color='#FBFF47'><br>$tradeid<br></font><br>";
					//tradelog_validation("validationtrade.php-1811-ta_message=".$ta_message[message]);			
				}
			}
		}			      	
		//showMessage($ta_message[message],$ta_message[refreshOpenPositions],$ta_message[refreshTradeHistory],$ta_message[code]); 
		return $ta_message;
	}
	else
	{
		echo mysql_error() . " " . $trade_query;
		return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again.";
	}
}	
//tradeLog("trader-2156-duration=".$duration);
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
//showMessage($ta_message[message],$ta_message[refreshOpenPositions],$ta_message[refreshTradeHistory],$ta_message[code]); 
return $ta_message;
}
else
{
echo mysql_error() . " " . $trade_query;
return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again.";
}
}	   
//tradeLog("trader-2189");
if ($duration=='d' || $duration=='c'
|| $duration=='d1' || $duration=='c1' 
|| $duration=='d2' || $duration=='c2' 
|| $duration=='d3' || $duration=='c3'  
|| $duration=='d4' || $duration=='c4'    
|| $duration=='t'){
	//tradeLog("trader-2196-duration=".$duration.";qty=".$quantity);
	for ($i_multi=0; $i_multi<$quantity; $i_multi++)
	{ 
		//tradeLog("2197"); 
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
			//showMessage($ta_message[message],$ta_message[refreshOpenPositions],$ta_message[refreshTradeHistory],$ta_message[code]); 
			return $ta_message;
		}
		else
		{
			echo mysql_error() . " " . $trade_query;
			return "<font color='red'><b>Fatal Error</b></font><br>The System is currently unavailable.<br>Please try again.";
		}
	}
	//Update process
	
	//End Update process
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

?>