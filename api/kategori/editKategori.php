<?php
include '../../config/functions.php';

$id = $_POST['id'] ;
$namaKategori = $_POST['nama_kategori'];
header('Content-Type: text/xml');
$hasil;

$query = "SELECT * FROM `flutter_kategori` WHERE `id_kategori` = '$id'";
$sql = mysqli_query($con, $query);
$responses = array("code" => null,"data" => null,"message" => null);
if (mysqli_num_rows($sql) > 0) {
    $query = "UPDATE `flutter_kategori` SET `nama_kategori` = '$namaKategori' WHERE `id_kategori` = '$id'";
    $sql = mysqli_query($con, $query);
    $hasil = $sql;
} else {
    $responses["code"] = 404;
    $responses['message'] = "Data Not Found";
    echo json_encode($responses);
    return;
}
// var_dump($hasil);
if ($hasil) {
    $responses['code'] = 200;
    $responses['message'] = "Berhasil Update";
} else {
    $responses["code"] = 400;
    $responses['message'] = "Gagal Update";
}
// echo ($responses["data"]);
echo json_encode($responses);