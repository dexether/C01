<?php 
 
class database{
 
	// var $host = "localhost";
	// var $uname = "root";
	// var $pass = "";
	// var $db = "cabinet_royal";
	public $kon;
 
	function __construct(){
		// mysql_connect($this->host, $this->uname, $this->pass);
		// mysql_select_db($this->db);
		$this->kon = mysqli_connect("localhost","root","","cabinet_royal");
	}
	function emailnya($idlogin){
	$query = "SELECT client_aecode.email FROM mlm2 INNER JOIN client_accounts ON client_accounts.accountname = mlm2.ACCNO INNER JOIN client_aecode ON client_accounts.aecodeid = client_aecode.aecodeid WHERE mlm2.mt4login =".$idlogin;
	$data = mysqli_query($this->kon,$query);
	$d = mysqli_fetch_array($data);
	$hasil = $d;
	return $hasil[0];
	}
 
} 

 // 	$kon = mysqli_connect("localhost","root","","cabinet_royal");
 //    $query2 = "SELECT client_aecode.email FROM mlm2 INNER JOIN client_accounts ON client_accounts.accountname = mlm2.ACCNO INNER JOIN client_aecode ON client_accounts.aecodeid = client_aecode.aecodeid";
	// $data2 = mysqli_query($kon,$query2);
	// var_dump(mysqli_fetch_array($data2));
?>