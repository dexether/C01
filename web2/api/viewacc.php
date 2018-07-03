<?php 
if (isset($_GET['login'])) {

	$koneksi = new mysqli("localhost", "root", "", "mahadana_source");
	$con=mysqli_connect("localhost", "root", "", "mahadana_source");
	if($koneksi->connect_error)
	{
	echo "Koneksi gagal->".$dbconnect ->connect_error;
	}else{

	}

	$qmarginin = $koneksi->query("SELECT sum(MT4_TRADES.PROFIT) FROM MT4_TRADES WHERE LOGIN = ".$_GET['login']." AND CMD = 6 AND COMMENT LIKE '%dep%'");
	$marginin = mysqli_fetch_row($qmarginin);

	$qmarginout = $koneksi->query("SELECT sum(MT4_TRADES.PROFIT) FROM MT4_TRADES WHERE LOGIN = ".$_GET['login']." AND CMD = 6 AND COMMENT LIKE '%with%'");
	$marginout = mysqli_fetch_row($qmarginout);

	$qclosed = $koneksi->query("SELECT sum(MT4_TRADES.PROFIT) FROM MT4_TRADES WHERE LOGIN = ".$_GET['login']." AND CMD IN (0,1) AND date(CLOSE_TIME) > '1970-01-02'");
	$closed = mysqli_fetch_row($qclosed);

	$qfloating = $koneksi->query("SELECT MT4_TRADES.PROFIT FROM MT4_TRADES WHERE LOGIN = ".$_GET['login']." AND CMD IN (0,1) AND date(CLOSE_TIME) = '1970-01-01 00:00:00'");
	$floating = mysqli_fetch_row($qfloating);

	$qvolume = $koneksi->query("SELECT sum(MT4_TRADES.VOLUME)/100 FROM MT4_TRADES WHERE LOGIN = ".$_GET['login']." AND CMD IN (0,1) AND date(CLOSE_TIME) > '1970-01-02'");
	$volume = mysqli_fetch_row($qvolume);

	// $quser = $koneksi->query("SELECT * from MT4_USERS where LOGIN = 88000166");
	// $user = $quser->mysqli_fetch_object();

	$sql="SELECT * from MT4_USERS where LOGIN = ".$_GET['login'];
	$result=mysqli_query($con,$sql);

	$data = array(($marginin[0]==null)?0:$marginin[0],($marginout[0]==null)?0:$marginout[0],($closed[0]==null)?0:$closed[0],($floating[0]==null)?0:$floating[0],$volume[0],mysqli_fetch_object($result));
	$a = json_encode($data);
	echo $a;
}else {
	echo "Parameter Required";
}
 ?>
