<?php
//require 'libs/Smarty.class.php';
//$smarty = new Smarty;
//$smarty->debugging = false;
include_once("$_SERVER[DOCUMENT_ROOT]/includes/functions.php");

//HOW to call http://192.168.56.1:88/goldgram/news_rss.php?tr=asianews_rss.html&rss=http://www.forbes.com/real-time/feed2/
$target = $_GET[tr];
$rssurl = $_GET[rss];
	
if (!empty($target) && !empty($rssurl)) {
	//$rssurl = "http://www.forbes.com/real-time/feed2/";
	
	// $feedContent = getRSS($rssurl);	
	

	
	if($feedContent && !empty($feedContent)) {
		$feedXml = @simplexml_load_string($feedContent);
		$namespaces = $feedXml->getNamespaces(true); 
		if($feedXml) {
			$rssitems = array();
			$irow = 0;
			foreach($feedXml->channel->item as $oitem) {	
				if ($irow > 4)
					break; 
				$item = new RssItems();
				$item->rssitem = $oitem;
				$thumbnail = 'assets/admin/layout/img/404.png'; 
				
				preg_match_all('#<img src=\"(.*?)\"[^>]*>([\w|\W]*)#s', $oitem->description, $matches );
				foreach($matches[1] as $value)
				{
					$thumbnail = $value;
				}
				
				foreach($matches[2] as $value)
				{
					$oitem->description = $value;
				}

				
				/*$media = $oitem->children($namespaces['media'])->content;			
				if (!empty($media)) {
					$media_url = trim((string)$media->attributes()->url);
					if (!empty($media_url)) 
						$thumbnail =  $media_url;
				}*/
					
				$item->thumbnail = $thumbnail;	
				array_push($rssitems, $item);	
				$irow++;	
			}	
		}	
	}	
	$template->assign("rssitems", $rssitems);
	$template->display($target);
}

class RssItems {
    var $rssitem;
    var $thumbnail;

}

function getRSS($url) {
	$feedUrl = $url;
	$feedContent = "";

	// Fetch feed from URL
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $feedUrl);
	curl_setopt($curl, CURLOPT_TIMEOUT, 3);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HEADER, false);

	// FeedBurner requires a proper USER-AGENT...
	curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
	curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");

	$feedContent = curl_exec($curl);
	curl_close($curl);
	return $feedContent;
}

function tradeLog($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
?>