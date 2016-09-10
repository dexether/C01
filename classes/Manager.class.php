<?php

include_once("$_SERVER[DOCUMENT_ROOT]/classes/User.class.php");

/******************************************************************************
* Manager.class.php                                                          
*                                                                             
* @description                                                                
* Description goes here                                                       
*                                                                                                                  
*
******************************************************************************/

class Manager extends User
{
 /****************************************************************************
 * ATTRIBUTES                                                                *
 ****************************************************************************/
 var $branches; // Matrix of branches/accounts belonging to manager, e.g. $branches[branchid][accountid];
 var $accounts; // Matrix of accounts belonging to manager, e.g. $accounts[]
  
 /****************************************************************************
 * CONSTRUCTOR                                                               *
 ****************************************************************************/
 function Manager($userid="")
 {
  if (!empty($userid))
  {
   $this->userid = $userid;
  }
 }
 
 /****************************************************************************
 * METHODS                                                                   *
 ****************************************************************************/
 function setBranches($branches) { $this->branches = $branches; }
 function getBranches() { return $this->branches; } 

 function setBrancheGroups($branchgroups) { $this->branchgroups = $branchgroups; }
 function getBrancheGroups() { return $this->branchgroups; } 
  
 function setAccounts($accounts) { $this->accounts = $accounts; }
 function getAccounts() { return $this->accounts; } 

 function fetchBrancheGroups($DB_odbc)
 {
 	$query = "SELECT * FROM branchgroups WHERE userid = '$this->userid';";
 	//tradelog("Manager.class.php-45-".$query); 
 	$result = mysql_query($query) OR DIE(mysql_error());
 
  if (mysql_num_rows($result)>0)
  {
 	 while ($row = mysql_fetch_array($result))
 	 {
  		$branchgroups[] = $row[branchgroupsid];
  		//tradelog("Manager.class.php-53-".$row[branchgroupsid]); 
 	 }

   for ($i=0; $i<count($branchgroups); $i++)
   {
   	$branchgroups_select[] = "bafile.group = '$branchgroups[$i]'"; 
   }
   $branchgroups_select = implode(" OR ", $branchgroups_select);
  
   $query = "SELECT trim(bafile.group) AS branchgroupsid, trim(AccNo) AS account
             from bafile
             WHERE
             $branchgroups_select
             ORDER BY AccNo ASC"; 
   //tradelog("Manager.class.php-66=".$query);               
   $result = $DB_odbc->query($query) OR DIE(odbc_error());
   while ($row = $DB_odbc->fetch_array($result))
   {
    $this->branchgroups[$row[branchgroupsid]][] = $row[account];
    $this->accounts[] = $row[account];
   }
   
   return TRUE;
  }
  else // Manager has not been assigned any group yet.
  {
  	return FALSE;
  }
 }
 
  
 function fetchBranches($DB_odbc)
 {
 	$query = "SELECT * FROM branch WHERE userid = '$this->userid';";
 	$result = mysql_query($query) OR DIE(mysql_error());
 
  if (mysql_num_rows($result)>0)
  {
 	 while ($row = mysql_fetch_array($result))
 	 {
  		$branches[] = $row[branchid];
 	 }

   for ($i=0; $i<count($branches); $i++)
   {
   	$branches_select[] = "Branch = '$branches[$i]'"; 
   }
   $branches_select = implode(" OR ", $branches_select);
  
   $query = "SELECT trim(Branch) AS branchid, trim(AccNo) AS account
             from bafile
             WHERE
             $branches_select
             ORDER BY AccNo";
   //tradelog($query);          
   $result = $DB_odbc->query($query) OR DIE(odbc_error());
   while ($row = $DB_odbc->fetch_array($result))
   {
    $this->branches[$row[branchid]][] = $row[account];
    $this->accounts[] = $row[account];
   }
   
   return TRUE;
  }
  else // Manager has not been assigned any branches yet.
  {
  	return FALSE;
  }
 }
 

 
 
 /****************************************************************************
 * END OF CLASS                                                              *
 ****************************************************************************/
}



?>