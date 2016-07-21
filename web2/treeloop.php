<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
include_once "$_SERVER[DOCUMENT_ROOT]/classes/Manager.class.php";
include_once "includes/wr_tools.php";
$var_to_pass = null;
global $user;
global $template;
global $themonth;
global $mysql;
global $DB;

// $start = "160712142";
$query0  = "SELECT * FROM mlm_realtime WHERE ACCNO = '160712148'";
$result0 = $DB->execresultset($query0);
// On level 9
$data = array();
$i = 0;

foreach ($result0 as $key0 => $value0) {
    $query     = "SELECT * FROM mlm_realtime WHERE Upline = '$value0[ACCNO]' AND is_compress = TRUE";
    $result    = $DB->execresultset($query);
    $data[$i] = $value0;
    $i2 = 0;
    foreach ($result as $key => $value) {
        $query2  = "SELECT * FROM mlm_realtime WHERE Upline = '$value[ACCNO]' AND is_compress = TRUE";
        $result2 = $DB->execresultset($query2);
        $data[$i]['child'][$i2] = $value;
        $i3 = 0;
        foreach ($result2 as $key2 => $value2) {
            $query3  = "SELECT * FROM mlm_realtime WHERE Upline = '$value2[ACCNO]' AND is_compress = TRUE";
            $result3 = $DB->execresultset($query3);
            $data[$i]['child'][$i2]['child'][$i3] = $value2;
            $i4 = 0;
            foreach ($result3 as $key3 => $value3) {
                $query4  = "SELECT * FROM mlm_realtime WHERE Upline = '$value3[ACCNO]' AND is_compress = TRUE";
                $result4 = $DB->execresultset($query4);
                $data[$i]['child'][$i2]['child'][$i3]['child'][$i4] = $value3;
                $i5 = 0;
                foreach ($result4 as $key4 => $value4) {
                    $query5  = "SELECT * FROM mlm_realtime WHERE Upline = '$value4[ACCNO]' AND is_compress = TRUE";
                    $result5 = $DB->execresultset($query5);
                    $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i5] = $value4;
                    $i6 = 0;
                    foreach ($result5 as $key5 => $value5) {
                        $query6  = "SELECT * FROM mlm_realtime WHERE Upline = '$value5[ACCNO]' AND is_compress = TRUE";
                        $result6 = $DB->execresultset($query6);
                        $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6] = $value5;
                        $i7 = 0;
                        foreach ($result6 as $key6 => $value6) {
                            $query7  = "SELECT * FROM mlm_realtime WHERE Upline = '$value6[ACCNO]' AND is_compress = TRUE";
                            $result7 = $DB->execresultset($query7);
                            $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6]['child'][$i7] = $value6;
                            $i8 = 0;
                            foreach ($result7 as $key7 => $value7) {
                               $query8  = "SELECT * FROM mlm_realtime WHERE Upline = '$value7[ACCNO]' AND is_compress = TRUE";
                               $result8 = $DB->execresultset($query8);
                               $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6]['child'][$i7]['child'][$i8] = $value7;
                               $i9 = 0;
                               foreach ($result8 as $key8 => $value8) {
                                   $query9  = "SELECT * FROM mlm_realtime WHERE Upline = '$value8[ACCNO]' AND is_compress = TRUE";
                                   $result9 = $DB->execresultset($query9);
                                   $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6]['child'][$i7]['child'][$i8]['child'][$i9] = $value8;
                                   $i10 = 0;
                                   foreach ($result9 as $key9 => $value9) {

                                    $query10  = "SELECT * FROM mlm_realtime WHERE Upline = '$value9[ACCNO]' AND is_compress = TRUE";
                                    $result10 = $DB->execresultset($query10);
                                    $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6]['child'][$i7]['child'][$i8]['child'][$i9]['child'][$i10] = $value9;
                                    $i11 = 0;
                                    foreach ($result10 as $key10 => $value10) {
                                        $query11  = "SELECT * FROM mlm_realtime WHERE Upline = '$value10[ACCNO]' AND is_compress = TRUE";
                                        $result11 = $DB->execresultset($query11);
                                        $data[$i]['child'][$i2]['child'][$i3]['child'][$i4]['child'][$i6]['child'][$i7]['child'][$i8]['child'][$i9]['child'][$i10]['child'][$i11] = $value10;
                                        foreach ($result10 as $key10 => $value10) {

                                        }
                                        $i11++;
                                    }
                                    $i10++;

                                }
                                $i9++;
                            }
                            $i8++;
                        }
                        $i7++;
                    }
                    $i6++;
                }
                $i5++;
            }
            $i4++;
        }
        $i3++;
    }
    $i2++;
}
$i++;
}


echo "<pre>";
print_r(array_reverse($data));
echo "</pre>";
function TradeLogUnderConstruct_Secure($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}
