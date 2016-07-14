<?php
class user{
	function __construct(){
		
		$this->mysqli   = new mysqli('localhost','root','','buku_induk');

	}

	public function query()
	{
		return $this->mysqli->query('SELECT * FROM siswa');
	}


}

$test = new user();



$data = $test->query();
$array = $data->fetch_row();
var_dump($array);

?>


 class user{
function db(){
$mysqli = new mysqli('localhost','root','','buku_induk');

if($mysqli->connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}
}

function query(){

$do = $mysqli->query('SELECT * FROM siswa');
return $do;
}
}

$user = new user();

$data=$user->db()->query();

while ($row=$data->fetch_row()) {
echo "NAMA : ".$row[2]."<br/>";
echo "JENIS KELAMIN : ".$row[3]."<hr/>";
}