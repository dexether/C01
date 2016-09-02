<?php

include("$_SERVER[DOCUMENT_ROOT]/classes/Menu.class.php");



$menu = new Menu();
$menu->setMouseOver("closeSub(previous_menu)");

$menu->addButton($language->parse("Temp Statement"),"tempstatement.php","updateTooltip('Check your temporary account status')","resetTooltip()");
$menu->addButton($language->parse("Temp Daily Statement"),"daily_statement.php","updateTooltip('Check your daily statement')","resetTooltip()");
if(	   $user->companygroup!="hodsburgh" 
	&& $user->companygroup!="agrodana" 
	&& $user->companygroup!="cayman" 
	&& $user->companygroup!="danareksa" 
){
	$menu->addButton($language->parse("History_Transaction"),"history_statement.php","updateTooltip('Check your history temporary account status')","resetTooltip()");
}
	$query = "select user.countertype from user where user.userid='$user->userid' and countertype like ('%ORI%')";
	$addcounter = "no_add";
	$result = mysql_query($query) OR DIE (mysql_error() . " $query");
	while ($row = mysql_fetch_array($result))
	{   
	 $addcounter = "yes_add";
	}
	if ($addcounter=="yes_add")
	{
		$menu->addButton($language->parse("counter_duration"),"markettime.php","updateTooltip('Market Time')","resetTooltip()");
	}
//if($user->groupid!=2 && $user->groupid!=4 ){
	$menu->addButton($language->parse("Category"),"user_category.php","updateTooltip('Click here to select category')","resetTooltip()");
//}
//$menu->addButton($language->parse("Chart Currency"),"chart.php","updateTooltip('View Charts')","resetTooltip()");
//$menu->addButton($language->parse("Chart Stock"),"chart_stockcharts2.php","updateTooltip('View Charts')","resetTooltip()");
//$menu->addButton($language->parse("Graph")." Forex/Index","http://bbj.stg9.com/index.php","updateTooltip('Charts')","resetTooltip()");
//$menu->addButton($language->parse("Graph")." TGE","http://graphics.stg9.com/tge.php","updateTooltip('Charts')","resetTooltip()");
$menu->addButton("Chart Demo Bid","http://demochart.stg9.com/demo/graphics/bid.php","updateTooltip('Chart Demo Bid')","resetTooltip()");
$menu->addButton("Chart Demo Ask","http://demochart.stg9.com/demo/graphics/ask.php","updateTooltip('Chart Demo Ask')","resetTooltip()");
$menu->addButton("Chart Demo Last","http://demochart.stg9.com/demo/graphics/last.php","updateTooltip('Chart Demo Last')","resetTooltip()");
$menu->addButton($language->parse("utility"),"user.php?mode=changepassword","updateTooltip('Click here to change password')","resetTooltip()");
$menu->addButton($language->parse("Help"),"help.php","updateTooltip('Need help using Profx? Click here')","resetTooltip()");
//$menu->addButton($language->parse("LiveChat"),"livechat.php","updateTooltip('LiveChat Click here')","resetTooltip()");
//$menu->addButton($language->parse("Payment"),"payment.php","updateTooltip('Need help using Acemach? Click here')","resetTooltip()");
$menu->addButton($language->parse("log_out"),"logout.php","updateTooltip('Logout of Online System')","resetTooltip()","top");

$template->assign("logo",$template->fetch("menu.htm"));
$template->assign("user",$user);
$template->assign("menu",$menu);

/*****************************************************************************
* GET ANNOUNCEMENT                                                           *
*****************************************************************************/
$query = "SELECT message FROM announcement WHERE announcementid = '1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$message = $row[message];
$template->assign("message",$message);
 
//$template->assign("menu_html",$template->fetch("menu_blank.htm"));
 
$query = " select userview.hdr,userview.detail,userview.logo 
	from userview,user  
	where userview.viewtype = user.viewtype 
	and user.userid= '$user->userid'";		
//tradelog("menu-53=".$query);
$result = $DB->query($query) OR DIE ("User details not found or not created yet"); 
while ($row = $DB->fetch_array($result))
{
	$viewtype_hdr = $row[hdr];
	//$viewtype_dtl = $row[detail];
	$viewtype_logo = $row[logo];
}
//tradelog("main=viewtype_dtl".$viewtype_dtl); 

mysql_free_result($result);
$template->assign("viewtype_logo",$viewtype_logo);	
$template->assign("menu_html",$template->fetch($viewtype_hdr)); 


?>