<?php

include '../../config/functions.php';

$responses = array("code" => null,"data" => null,"message" => null);
$idx = 0;

$userid = $_GET['userid'];

$rssql = "SELECT DISTINCT(a.id_barang),a.userid,SUM(a.harga) AS harga, SUM(a.qty) AS qty, (SELECT nama_barang FROM flutter_barang WHERE id_barang = a.id_barang) AS nama_barang, (SELECT image FROM flutter_barang WHERE id_barang = a.id_barang) AS gambar FROM flutter_shopping_cart a WHERE a.userid = '$userid' AND id_barang in (SELECT id_barang FROM flutter_barang) GROUP BY a.id_barang ";

$sql = mysqli_query($con,$rssql);

while ($a = mysqli_fetch_array($sql)) {
    $responseField['id_barang'] = $a['id_barang'];
    $responseField['userid'] = $a['userid'];
    $responseField['nama_barang'] = $a['nama_barang'];
    $responseField['gambar'] = $a['gambar'];
    $responseField['harga'] = $a['harga'];
    $responseField['qty'] = $a['qty'];

    $responses["data"][$idx] = $responseField;
    // array_push($responses, $responseField);
    $idx++;
}

// var_dump($sql);
if ($sql) {
    header('Content-Type: application/json',true,200);
    $responses["code"] = 200;
    $responses["message"] = "Success";
} else {
    header('Content-Type: application/json',true,500);
    $responses["code"] = 500;
    $responses["message"] = "Internal server error";
}

echo json_encode($responses);