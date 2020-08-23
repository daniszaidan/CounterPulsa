<?php

$kode = "I5";
$no_hp = 081225467581;

$url = 'https://portalpulsa.com/api/connect/';

$header = array(
'portal-userid: lorem',
'portal-key: lorem', // lihat hasil autogenerate di member area
'portal-secret: lorem', // lihat hasil autogenerate di member area
);

$data = array( 
'inquiry' => 'I', // konstan
'code' => '$kode', // kode produk
'phone' => '$no_hp', // nohp pembeli
'trxid_api' => 'xxxx', // Trxid / Reffid dari sisi client
'no' => '1', // untuk isi lebih dari 1x dlm sehari, isi urutan 1,2,3,4,dst
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$result = curl_exec($ch);

echo $result;
        
?>