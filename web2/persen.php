<?php
$a = 1000;
$b = 1100;
$p = ($b - $a)/$b*100;
// Berapah Persen kah ?
// echo "Persen : "."$p"."%";
if ($p > 30) {
	echo "Tampils ".$p;
}else{
	echo "Kurang Bro";
}
?>
<?php
$conn = mysql_connect('localhost','root','mugen1996') or die(mysql_error());
// mysql_select_db("cabinet");
// $q = "SELECT * FROM isf_source.mt4_daily WHERE LOGIN = '1012' AND DATE_FORMAT(mt4_daily.TIME, '%Y-%m-%d') = '2008-08-22'";
// $query = mysql_fetch_assoc(mysql_query($q));
$q1 = mysql_query("SELECT * FROM isf_source.mt4_daily WHERE LEFT(mt4_daily.TIME,10) = '2014-01-02' LIMIT 0,100");

while ($data=mysql_fetch_assoc($q1)) { 
    $satu = $data['PROFIT'] + $data['PROFIT_CLOSED']+ $data['DEPOSIT'];
    $TGL1 = $data['TIME'];
    $login1 = $data['LOGIN'];
    $q2 = mysql_query("SELECT * FROM isf_source.mt4_daily WHERE LOGIN = '$login1' AND LEFT(mt4_daily.TIME,10) = '2014-01-01' LIMIT 0,100");
    while ($data2=mysql_fetch_assoc($q2)) {
      $dua = $data2['PROFIT'];
      $TGL2 = $data2['TIME'];
      $login2 = $data2['LOGIN'];
          $q3 = mysql_query("SELECT * FROM isf_source.mt4_daily WHERE LOGIN = '$login1' AND LEFT(mt4_daily.TIME,10) = '2013-12-31' LIMIT 0,100");
          while ($data3=mysql_fetch_assoc($q3)) {
          $tiga = $data3['PROFIT'];
          $TGL3 = $data3['TIME'];
          $login3 = $data3['LOGIN'];
          }
    $NTR2 = $dua - $tiga;
    }
    $NTR1 = $satu - $dua;
    $p = @(($NTR2 - $NTR1)/$NTR2)*100;
    echo $p."<br>";
    // if ($NTR2 > $NTR1) {
    //   echo "NTR ". $TGL1." :".$NTR1."<br>";
    //   echo "NTR ". $TGL2." :".$NTR2."<br>";
    //   echo "LOGIN1:".$login1."<br>";
    //   echo "------------------------------------------------ <br>";
    // }else{
    //   // echo "NO Data";
    // }
    // echo "NTR ". $TGL1." :".$hasil."<br>";
    // echo "NTR ". $TGL2." :".$NTR2."<br>";
    // echo "TGL1  :".$TGL1."<br>";
    // echo "TGL2  :".$TGL2."<br>";
    // echo "TGL3  :".$TGL3."<br>";
    // echo "LOGIN1:".$login1."<br>";
    // echo "LOGIN2:".$login2."<br>";
    // echo "LOGIN2:".$login3."<br>";
    // echo "------------------------------------------------ <br>";
}   



?>