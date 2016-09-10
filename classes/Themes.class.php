<?php

/******************************************************************************
* Themes.class.php                                                          
*                                                                             
* @description                                                                
* Localization support for acemach
*                                                                             
* @author: Albert (gohsupport@acemach.com)                                       
*
******************************************************************************/

class Themes
{
 /****************************************************************************
 * ATTRIBUTES                                                                *
 ****************************************************************************/
 var $Themesid; // unique ID

  
 /****************************************************************************
 * CONSTRUCTOR                                                               *
 ****************************************************************************/
 function Themes($Themesid)
 {
  if (!empty($Themesid))
  {
   $this->Themesid = $Themesid;
  }
 }
 
 /****************************************************************************
 * METHODS                                                                   *
 ****************************************************************************/
 function setThemesid($Themesid) { $this->Themesid = $Themesid; }
 function getThemesid() { return $this->Themesid; }

 function fetch()
 {
 
  $query = "SELECT
            themes.themesname,
            themes.value
            FROM themes
            WHERE themes.Themesid = '$this->Themesid'";
          
  $result = mysql_query($query);

  while ($row=mysql_fetch_array($result))
  {
   $this->phrase[$row[themesname]] = $row[value];  
  }
  if (count($this->phrase)==0)
  {
   echo "Themes is empty ($this->Themesid)";
  }
 }

 function display($phrase) // Displays output for this class
 {
  echo $this->parse($phrase);
 }

function parse($phrase)
{
 if (array_key_exists($phrase,$this->phrase))
 {
  return $this->phrase[$phrase];
 }
 else
 {
  return "(".$phrase.")";
 }
}

 
 /****************************************************************************
 * END OF CLASS                                                              *
 ****************************************************************************/
}

?>