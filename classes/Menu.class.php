<?php

/******************************************************************************
* Menu.class.php                                                          
*                                                                             
* @description                                                                
* Description goes here                                                       
*                                                                                                                 
*
******************************************************************************/

class Menu
{
 /****************************************************************************
 * ATTRIBUTES                                                                *
 ****************************************************************************/
 var $buttons; // Array of buttons
 var $mouseOver;
 var $mouseOut;
 
 var $name;
  
 var $html;
  
 /****************************************************************************
 * CONSTRUCTOR                                                               *
 ****************************************************************************/
 function Menu($name="")
 {
  if (!empty($name))
  {
   $this->name = $name;
  }
 }
 
 /****************************************************************************
 * METHODS                                                                   *
 ****************************************************************************/
 function setName($name) { $this->name = $name; }
 function getName() { return $this->name; }

 function setTarget($target) { $this->target = $target; }
 function getTarget() { return $this->target; }

 function setMouseOver($mouseOver) { $this->mouseOver = $mouseOver; }
 function getMouseOver() { return $this->mouseOver; }

 function setMouseOut($mouseOut) { $this->mouseOut = $mouseOut; }
 function getMouseOut() { return $this->mouseOut; }

 function setButtons($buttons) { $this->buttons = $buttons; }
 function getButtons() { return $this->buttons; }

 function addButton($text, $url, $mouseOver="", $mouseOut="", $target="")
 {
  $button[text] = $text;
  $button[url] = $url;
  if (!empty($this->name)) { $button[name] = $this->name; }  
  if (!empty($target)) { $button[target] = $target; }
  
  if (!empty($mouseOver)) { $button[mouseOver] = $mouseOver; } else { $button[mouseOver] = $this->mouseOver; }
  if (!empty($mouseOut)) { $button[mouseOut] = $mouseOut; } else { $button[mouseOut] = $this->mouseOut; }
  $this->buttons[] = $button;
 }
 
 function getHTML() // Formats data to be output as HTML
 {
  return $this->html;
 }
 
 function display() // Displays output for this class
 { echo $this->getHTML(); }
 
 
 /****************************************************************************
 * END OF CLASS                                                              *
 ****************************************************************************/
}

?>