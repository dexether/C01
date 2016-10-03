<?php

$crypt_key = '282d95a2009e19fb3570ccb4d98b820f+�������';

class CTools {

    //put your code here
    function Crypt($data, $ckey) {
        $key = $box = array();
        $keylen = strlen($ckey);
        //----
        for ($i = 0; $i <= 255; ++$i) {
            //tradelogwr("WR_Tools-13;i=" . $i . ";keylen=" . $keylen.";ckey=".$ckey);
            $key[$i] = ord($ckey{$i % $keylen});
            $box[$i] = $i;
        }
        //---
        for ($x = $i = 0; $i <= 255; $i++) {
            $x = ($x + $box[$i] + $key[$i]) % 256;
            list($box[$i], $box[$x]) = array($box[$x], $box[$i]);
        }
        //----
        $k = $cipherby = $cipher = '';
        $datalen = strlen($data);
        //----
        for ($a = $j = $i = 0; $i < $datalen; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            //----
            list ($box[$a], $box[$j]) = array($box[$j], $box[$a]);
            $k = $box[($box[$a] + $box[$j]) % 256];
            $cipherby = ord($data{$i}) ^ $k;
            $cipher .= chr($cipherby);
        }
        //----
        return $cipher;
    }

}

function tradelogwr($msg) {
    $fp = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

?>
