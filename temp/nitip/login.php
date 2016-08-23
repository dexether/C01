<?php

function bacaHTML($url){
     // inisialisasi CURL
	$data = curl_init();
     // setting CURL
	curl_setopt($data, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($data, CURLOPT_URL, $url);
	curl_setopt($data,CURLOPT_FOLLOWLOCATION,true);
	curl_setopt($data, CURLOPT_SSL_VERIFYPEER, false);
     // menjalankan CURL untuk membaca isi file
	$hasil = curl_exec($data);
	curl_close($data);
	return $hasil;
}

$kodeHTML =  bacaHTML('http://register.askappremier.com/login.html');


echo $kodeHTML;
?>
