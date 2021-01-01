<?php
include '../../config/functions.php';

$namaKategori = $_POST['nama_kategori'];

$hasil = mysqli_query($con,"INSERT INTO `flutter_kategori` VALUES(null, '$namaKategori')");

$responses = array("code" => null,"data" => null,"message" => null);
// var_dump($hasil);
if ($hasil) {
    header('Content-Type: application/json',true,201);
    $responses['code'] = 201;
    $responses['message'] = "Berhasil simpan";
} else {
    header('Content-Type: application/json',true,400);
    $responses["code"] = 400;
    $responses['message'] = "Gagal simpan";
}
// echo ($responses["data"]);
echo json_encode($responses);