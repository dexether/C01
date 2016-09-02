<?php

include("includes/functions.php"); 



/*****************************************************************************
* DEFAULT                                                                    *
*****************************************************************************/
echo $account = $_GET[account];
echo $counterid = $_GET[counterid];
echo $action = $_GET[action];
echo $type = $_GET[type];
echo $quantity = $_GET[quantity];
echo $liquidate_price = $_GET[liquidate_price];
echo $liquidate_ref = $_GET[liquidate_ref];
echo $isorder = $_GET[isorder];

//##########################################Tambahan by indra 25122005################################################//

//=============LOCKING===================//

if($_GET["lock"]==1)
{
		 $query = "SELECT name,`decimal` FROM counter WHERE counterid = '$counterid'";
 		 $result = $DB->query($query);
 		 $row = $DB->fetch_array($result);
 		 $counter = $row[name];
		 $decimal = $row[decimal];
		 unset($row);
		 $query = "SELECT AccNo,ItemCode,Unit,BuyOrder,BuyPrice,BuyDate,SellOrder,SellPrice,SellDate FROM dafile WHERE (LiqStatus = '') AND AccNo = '$account' AND ItemCode='{$counterid}'ORDER BY ItemCode";
$result = $DB_odbc->query($query);
while ($row = $DB_odbc->fetch_array($result))
{
 	if ($row[SellOrder]!=0)
	{
		$qty_sell+=$row[Unit];
	}
	if ($row[BuyOrder]!=0)
	{
		$qty_buy+=$row[Unit];
	}
}
if($qty_sell!=$qty_buy)
{
	if($action=="buy" && ( $qty_buy < $qty_sell ) )
	{
		$status="locking buy";
		$qty=$qty_buy - $qty_sell;
	}
	else if($action=="sell" && ($qty_sell < $qty_buy) )
	{
		$status="locking sell";
		$qty=$qty_buy - $qty_sell;
	}
	else
	{
		$status="nothing";
	}
}
else
{
	$status="nothing";
}

if($status!="nothing")
{
		
		 echo "<SCRIPT language=\"Javascript1.2\">\n";
		 echo "parent.myTrade.closeTrade = new parent.CloseTrade();\n";
		 echo "parent.myTrade.closeTrade.setPositions('$positions_html');\n";
 		 echo 		 "parent.myTrade.tradeCounter('$counterid','$counter','$action','new_lock','$qty','$liquidate_price','$liquidate_ref','$isorder','$quotepips','$harga','$tradeid');\n";
 echo "</SCRIPT>";
		
		die;
}
else
{
		showError("<font color='yellow'>Can't locking this open positions","0","0");
}
}

//=============LOCKING===================//

//========================CHECK MARGIN PAIR===========================================//

$query = "SELECT AccNo,ItemCode,Unit,BuyOrder,BuyPrice,BuyDate,SellOrder,SellPrice,SellDate FROM dafile WHERE (LiqStatus = '') AND AccNo = '$account' AND ItemCode='{$counterid}'ORDER BY ItemCode";
$result = $DB_odbc->query($query);
while ($row = $DB_odbc->fetch_array($result))
{
 	if ($row[SellOrder]!=0)
	{
		$qty_sell+=$row[Unit];
	}
	if ($row[BuyOrder]!=0)
	{
		$qty_buy+=$row[Unit];
	}
}
$query = "SELECT Equity, MarginReq FROM bafile WHERE AccNo = '$account'";
$result = $DB_odbc->query($query);
$row = $DB_odbc->fetch_array($result);
$row[Equity] += $credit;
$effective_margin = $row[Equity]-$row[MarginReq];
$margin_required = $marginday;
if ($effective_margin<= ($margin_required * $quantity))
{
	if($qty_sell !=0 && $qty_buy!=0)
	showError("<font color='yellow'>You can't proceed again , Please contact administrator.","0","0");
}

//========================CHECK MARGIN PAIR===========================================//


//##############################################################################################################//


$index = getIndex($counterid);
$query = "SELECT AutoLock FROM lookup";
$result = mysql_query($query);
$eq=mysql_fetch_assoc($result);
/*
$string.="<script language=\"Javascript\">";
$string.="alert($account)";
$string.="</script>";
echo $string;

die;*/
//---------CHECK MARGIN REQUIRED------------//
// tambahan by ind
function checkAutoLock($account,$autolock)
{
	
	global $DB_odbc;
	 global  $db_connection;
	$query = "SELECT TRIM(bafile.AccNo) AS account, Equity, MarginReq as margin_required FROM bafile LEFT JOIN IAFILE ON (bafile.IntTable = IAFILE.IntTable) WHERE bafile.MarginReq > 0 and bafile.AccNo='$account'";
	$result = $DB_odbc->query($query);
	
	$row = $DB_odbc->fetch_array($result);
	$margin_required = round($row[margin_required]);
 	$equity = $row[Equity];
	
	$query = "SELECT * FROM dafile WHERE AccNo = '$account' AND LiqStatus = ''";
	$result = $DB_odbc->query($query);
	while ($row = $DB_odbc->fetch_array($result))
	{
		$name = trim($row[ItemCode]);
		$quantity = round($row[Unit]);
		
    if (!empty($row[BuyOrder]))
    {
  	$trades[$name][buy] += $quantity;
   }
  else
  {
  	$trades[$name][sell] += $quantity;
  }
	} 
	
	if (count($trades) > 0)
 {
 	foreach ($trades AS $name => $trade)
 	{
 		if ($trade[buy]>$trade[sell]) // More Bought Positions
 		{
    $absolute += $trade[buy];
    $trigger = 1;
 		}
 		elseif ($trade[sell]>$trade[buy]) // More Sell Positions
 		{
 			$absolute += $trade[sell];			
 			$trigger = 1;
 		}
 		else
 		{
 			$absolute += $trade[buy];
 		}
 	}
	}
	
	if ($trigger == 1)
	{
 	$equity_required = $margin_required;

 	if ($equity*100 < $equity_required*$autolock)
 	{
 		return false;

 	}
 	else
 	{
	
	 	return true;
 	}
 }
 else
 {
 	return true;
 }
}

//----------------END------------------------//
//checkAutoLock('1238');die;
//if(checkAutoLock('1237'))echo "PLUS";else echo "MINUS" ;die;

//comment by Albert Temporary if(!checkAutoLock($account,$eq['AutoLock']) && $type!="liquidate" )die; // tambahan by ind

if ($index[open]==0)
{
 echo "<SCRIPT language=\"Javascript1.2\">";
 echo "parent.myTrade.showMessage(\"<font color=yellow><b>$index[name]</b></font> counters are currently<br>closed for live trading.<br>Please try again when trading is resumed.\");\n";
 echo "parent.myTrade.showBusy(false);\n";
 echo "</SCRIPT>";  
 exit;
}



////================CHECK OCO========================//

$query = "SELECT
          price, quantity, liquidate_ref
          FROM trade
          WHERE
          account = '$account' AND
          isorder = '1' AND
          statusid = '2' AND counterid='$counterid '";
$result = $DB->query($query);
while ($row = $DB->fetch_array($result))
{
	$split_liqref = explode("_",$row[liquidate_ref]);
	$liqref_index = $split_liqref[0] . "_" . $split_liqref[1]; // 20041231_40
	$liqref[$liqref_index][] = $row; // e.g. 2 units
}

$query = "SELECT AccNo,ItemCode,Unit,BuyOrder,BuyPrice,BuyDate,SellOrder,SellPrice,SellDate FROM dafile WHERE (LiqStatus = '') AND AccNo = '$account' and ItemCode='$counterid'";
$result = $DB_odbc->query($query);
while ($row = $DB_odbc->fetch_array($result))
{
 	if ($row[BuyOrder]!=0)
	{
	 $row[liquidate_ref] = $row[BuyDate] . "_" . $row[BuyOrder];
	}
	else
	{
	 $row[liquidate_ref] = $row[SellDate] . "_" . $row[SellOrder];
	}
	if (count($liqref[$row[liquidate_ref]])>0)
	{
		if (count($liqref[$row[liquidate_ref]])==2)
		{
			
			showError("<font color='yellow'><b>(253)Trade OCO</b></font><br>Cannot Order again .","0","0");
		}
	}
	
}

////================CHECK OCO========================//
// If user has processing trades. Prohibit him from starting a new transaction.
$query = "SELECT * FROM trade WHERE statusid = '3' AND account = '$account'";
$result = $DB->query($query);
if ($DB->num_rows($result)>0)
{
 showError("<font color='yellow'><b>Trade Processing</b></font><br>Your trade is still processing.<br>Please try again in a moment.","0","0");
}

// If liquidating, check whether user's position is still available
// Note: This is because ECU now assigns a new order reference whenever the position has changed (quantity, etc) due to
// partial liquidation, etc.
if ($type == "liquidate")
{
 // Get reference number
 $refparts = explode("_",$liquidate_ref);
 $refdate = $refparts[0]; // Date -> required for obtaining counter from MDB
 $ref = $refparts[1]; // Ref No -> required for obtaining counter from MDB
 
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
 
 $query = "SELECT
               Unit,*
               FROM
               dafile
               LEFT JOIN bafile ON dafile.AccNo = bafile.AccNo
               WHERE
               dafile.$reftype = $ref
               AND dafile.$refdatetype = '$refdate'
               AND dafile.LiqStatus = ''
               AND bafile.AccNo = '$account'";
               
 $row = $DB_odbc->query_first($query);
 
 // Adjust quantities if MDB quantity has been adjusted
 if ($row[Unit]>0)
 {
  if ($row[Unit] != $refparts[2])
  { 
   //print_r($row);
   print_r($refparts[2]);
   $refparts[2] = $row[Unit];
   $quantity = round($row[Unit]);
   $liquidate_ref = implode("_",$refparts);
   if ($user->groupid==1)
   {
    echo "<SCRIPT language=\"Javascript1.2\">\n";
    echo "parent.myTrade.refreshPanel('openpositions');\n";
    echo "</SCRIPT>";    
   }
  }
 }
 elseif (empty($row[Unit]))
 {
  echo "<SCRIPT language=\"Javascript1.2\">";
  echo "parent.myTrade.showMessage(\"<font color=yellow><b>Outdated Position</b></font><br>The position you are attempting to trade does not exist; or has been liquidated already.\",'1','1');\n";
  echo "parent.myTrade.showBusy(false);\n";
  echo "</SCRIPT>";  
  exit;  
 }
}












//1 If Liquidating: Get MARGIN REQUIRED
//2 If Effective Margin is below MARGIN REQUIRED, then it's compulsory to liquidate the corresponding pair.
//3 Get all positions
//4 User is attempting to liquidate part of a hedged pair, e.g. 2 BUY (with corresponding 2 SELL)

//1
if ($type == "liquidate" && $isorder != 1)
{
	// Get Minimum Margin Required
	
// $query = "SELECT IAFILE.EURSize AS margin_required FROM bafile LEFT JOIN IAFILE ON bafile.IntTable = IAFILE.IntTable WHERE bafile.AccNo = '$account'";
// if ($result = $DB_odbc->query($query))
// {
//  $row = $DB_odbc->fetch_array($result);   
//  $margin_required = ($row[margin_required] / 100);  // Lot size divided by 100, e.g. 100,000 = 1000 margin required
// }
// else
// {
//  $margin_required = "1000";
// }
 
 $query = "SELECT marginday FROM counter WHERE counterid = '$counterid'";
 $row = $DB->query_first($query);
 $margin_required = $row[marginday];
 
 //2
 // Get temporary credit for this account
 $query = "SELECT credit FROM tempcredit WHERE account = '$account'";
 $result = mysql_query($query);
 $row = mysql_fetch_array($result);
 $credit = $row[credit];
 unset($row);

 $query = "SELECT Equity, MarginReq FROM bafile WHERE AccNo = '$account'";
 $result = $DB_odbc->query($query);
 $row = $DB_odbc->fetch_array($result);
 $row[Equity] += $credit;
 
 $effective_margin = $row[Equity]-$row[MarginReq];

 //3
 // Get ECU counter name & decimals
 $query = "SELECT name,`decimal` FROM counter WHERE counterid = '$counterid'";
 $result = $DB->query($query);
 $row = $DB->fetch_array($result);
 $counter = $row[name];
 $decimal = $row[decimal];
 unset($row);
 
 // Get all opposing positions (eg. buy versus sell)
 $query = "SELECT * FROM dafile WHERE AccNo = '$account' AND ItemCode = '$counter' AND " . ucfirst($action) . "Order <> 0 AND LiqStatus = '' ORDER BY " . ucfirst($action) . "Price";
 $result = $DB_odbc->query($query);
 while ($row = $DB_odbc->fetch_array($result))
 { 	
  if (trim($row[SellOrder]) != 0) // Sell position
  {
  	$position[quantity] = round($row[Unit]);
  	$position[price] = sprintf("%0.".$decimal."f",$row[SellPrice]); 
   $position[liquidate_ref] = $row[SellDate] . "_" . $row[SellOrder];     	 
   $positions[] = $position;
   unset($position);
  }
  if (trim($row[BuyOrder]) != 0) // Buy position
  {
   $position[liquidate_ref] = $row[BuyDate] . "_" . $row[BuyOrder];     	
  	$position[quantity] = round($row[Unit]);
  	$position[price] = sprintf("%0.".$decimal."f",$row[BuyPrice]); 
   $positions[] = $position;
   unset($position);
  }
 }
 
 // Get all pending positions for this account
 switch ($action)
 {
 	case "buy":
    $query = "SELECT
              price, quantity, liquidate_ref
              FROM trade
              WHERE account = '$account'
              AND action = 'sell'
              AND type = 'liquidate'
              AND statusid = 2
              AND isorder = '1'";
 	break;
 	
 	case "sell":
    $query = "SELECT
              price, quantity, liquidate_ref
              FROM trade
              WHERE account = '$account'
              AND action = 'buy'
              AND type = 'liquidate'
              AND statusid = 2
              AND isorder = '1'";
 	break;
 }
 $result = $DB->query($query);
 while ($row = $DB->fetch_array($result))
 {
 	$split_liqref = explode("_",$row[liquidate_ref]);
 	$liqref_index = $split_liqref[0] . "_" . $split_liqref[1]; // 20041231_40
 	$pending[$liqref_index][] = $row;
 }
 
 for ($i=0; $i<count($positions); $i++)
 {
 	for ($j=0; $j<count($pending[$positions[$i][liquidate_ref]]);$j++) // found matching pending trade
  {
  	$positions[$i][quantity] -= $pending[$positions[$i][liquidate_ref]][$j][quantity];
  }
  
  if ($positions[$i][quantity]>0)
  {
   $positions_html[] = $positions[$i][liquidate_ref] . "|" . $positions[$i][quantity] . "|" . $positions[$i][price];
  }
 }

 if (count($positions_html)>0)
 {
  $positions_html = implode(";",$positions_html);
 }
}


if (!empty($counterid))
{
 // Get quotepips for counter
 switch($action)
 {
  case "buy":
    $query = "SELECT marketindex.quotebuypips AS quotepips, counter.decimal FROM marketindex LEFT JOIN counter USING (indexid) WHERE counter.counterid = '$counterid'";  
  break;
  
  case "sell":
    $query = "SELECT marketindex.quotesellpips AS quotepips, counter.decimal FROM marketindex LEFT JOIN counter USING (indexid) WHERE counter.counterid = '$counterid'";  
  break;
 }
 
 $row = $DB->query_first($query);
 if (!empty($row[quotepips ]))
 {
  $quotepips = ($row[quotepips] / pow(10,$row[decimal]));
 }
 
 $query = "SELECT name FROM counter WHERE counterid = '$counterid'";
 $result = mysql_query($query);
 $row = mysql_fetch_array($result);
 $counter = $row[name];

 //--------GET PENDING------//

$query = "SELECT
          trade.tradeid,user.countertype,trade.account, trade.action, trade.price, trade.quantity, trade.type, trade.liquidate_price, trade.remark, trade.duration, DATE_FORMAT(trade.datetime, \"%e %b (%H:%i:%s)\") AS datetime, DATE_FORMAT(trade.done_datetime, \"%e %b (%H:%i:%s)\") AS done_datetime,
          tradestatus.statusid, tradestatus.description AS status, tradestatus.color AS color,
          counter.name AS counter, counter.decimal,
          user.username AS tradedbyname, bbjstatustable.description as bbjstatus,
          trade.isbbj
          FROM $mysql[database].trade
          LEFT JOIN $mysql[database].counter ON trade.counterid = counter.counterid
          LEFT JOIN $mysql[database].tradestatus ON trade.statusid = tradestatus.statusid
          LEFT JOIN $mysql[database].bbjtable as bbjstatustable ON trade.bbjstatus = bbjstatustable.statusid
          LEFT JOIN $mysql[database].user ON trade.account = user.username
		  where trade.statusid='2' and trade.account='{$user->username}' and trade.liquidate_price='{$_GET[liquidate_price]}'";
$result = mysql_query($query) OR DIE (mysql_error() . " $query");
$harga='';
$tradeid='';
while($row = mysql_fetch_array($result))
{
if($harga!='')$harga.=";";
if($tradeid!='')$tradeid.=";";
	$harga.=number_format($row['price'],$row['decimal']);
	$tradeid.=$row['tradeid'];

}

//-------PENDING------//


 echo "<SCRIPT language=\"Javascript1.2\">\n";
 echo "parent.myTrade.closeTrade = new parent.CloseTrade();\n";
 echo "parent.myTrade.closeTrade.setPositions('$positions_html');\n";
 //echo "parent.myTrade.testing_a()";
 echo "parent.myTrade.tradeCounter('$counterid','$counter','$action','$type','$quantity','$liquidate_price','$liquidate_ref','$isorder','$quotepips','$harga','$tradeid');\n";
 echo "</SCRIPT>";
}

/*****************************************************************************
* FUNCTIONS                                                                  *
*****************************************************************************/
function showMessage($message, $refreshOpenPositions=0, $refreshTradeHistory=0, $code="")
{
 $message = str_replace("\"","&quot;",$message);
 echo "<SCRIPT language='Javascript'>";
 echo "parent.myTrade.showMessage(\"$message\",'$refreshOpenPositions','$refreshTradeHistory');\n";
 echo "$code\n";
 echo "parent.myTrade.showBusy(false);\n";
 // Reset double-click check
 echo "parent.busyBuffer=0;";
 echo "</SCRIPT>";
}

function showError($message, $refreshOpenPositions=0, $refreshTradeHistory=0, $code="")
{
 showMessage($message, $refreshOpenPositions, $refreshTradeHistory, $code);
 exit;
}



?>