<?php
set_time_limit(0);
//Declarations
$file = "rss.xml"; //The file to read from.

#Read the file
$fp = fopen($file, "r") or die("Couldn't Open"); //Open the file

$FoundXmlTagStep = 0;
$FoundEndXMLTagStep = 0;
$curXML = "";
$firstXMLTagRead = false;
while(!feof($fp)) //Loop through the file, read it till the end.
{
    $data = fgets($fp, 2);
    if ($FoundXmlTagStep==0 && $data == "<")
        $FoundXmlTagStep=1;
    else if ($FoundXmlTagStep==1 && $data == "x")
        $FoundXmlTagStep=2;
    else if ($FoundXmlTagStep==2 && $data == "m")
        $FoundXmlTagStep=3;
    else if ($FoundXmlTagStep==3 && $data == "l")
    {
        $FoundXmlTagStep=4;
        $firstXMLTagRead = true;
    }
    else if ($FoundXmlTagStep!=4)
        $FoundXmlTagStep=0;

    if ($FoundXmlTagStep==4)
    {
        if ($firstXMLTagRead)
        {
            $firstXMLTagRead = false;
            $curXML = "<xm";
        }
        $curXML .= $data;

        //Start trying to match end of xml
        if ($FoundEndXMLTagStep==0 && $data == "<")
            $FoundEndXMLTagStep=1;
        elseif ($FoundEndXMLTagStep==1 && $data == "/")
            $FoundEndXMLTagStep=2;
        elseif ($FoundEndXMLTagStep==2 && $data == "x")
            $FoundEndXMLTagStep=3;
        elseif ($FoundEndXMLTagStep==3 && $data == "m")
            $FoundEndXMLTagStep=4;
        elseif ($FoundEndXMLTagStep==4 && $data == "l")
            $FoundEndXMLTagStep=5;
        elseif ($FoundEndXMLTagStep==5 && $data == ">")
        {
            $FoundEndXMLTagStep=0;
            $FoundXmlTagStep=0;
            #finished Reading XML
            ParseXML ($curXML);
        }
        elseif ($FoundEndXMLTagStep!=5)
            $FoundEndXMLTagStep=0;
    }
} 
fclose($fp); //Close file
function ParseXML($xml)
{
    //echo $sxml;
    $reader = new XMLReader(); //Initialize the reader
    $reader->xml($xml) or die("File not found"); //open the current xml string
    while($reader->read()) //Read it
    {
        switch($reader->nodeType)
        {
            case constant('XMLREADER::ELEMENT'): //Read element
                if ($reader->name == 'record')
                {
                    $dataa = $reader->readInnerXml(); //get contents for <record> tag.
                    echo $dataa; //Print it to screen.
                }
            break;
        }
    }
    $reader->close(); //close reader
}
?>