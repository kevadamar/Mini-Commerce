<?php
include '../../config/functions.php';

$idSatuan = $_POST['id'] ;
$namaSatuan = $_POST['nama_satuan'];
$satuan = $_POST['satuan'];
// header('Content-Type: text/xml');
$hasil;

$query = "SELECT * FROM `flutter_satuan` WHERE `id_satuan` = '$idSatuan'";
$sql = mysqli_query($con, $query);
$responses = array("code" => null,"data" => null,"message" => null);
if (mysqli_num_rows($sql) > 0) {
    $query = "UPDATE `flutter_satuan` SET `nama_satuan` = '$namaSatuan', `satuan` = '$satuan' WHERE `id_satuan` = '$idSatuan'";
    $sql = mysqli_query($con, $query);
    $hasil = $sql;
} else {
    header('Content-Type: application/json',true,404);
    $responses["code"] = 404;
    $responses['message'] = "Data Not Found";
    echo json_encode($responses);
    return;
}

// $hasil = $db->query("UPDATE `flutter_satuan` SET nama_satuan = '$namaSatuan' , satuan = '$satuan' WHERE id_satuan = '$idSatuan'");
// var_dump($hasil);
if ($hasil) {
    header('Content-Type: application/json',true,200);
    $responses['code'] = 200;
    $responses['message'] = "Berhasil Update";
} else {
    header('Content-Type: application/json',true,400);
    $responses["code"] = 400;
    $responses['message'] = "Gagal Update";
}
// echo ($responses["data"]);
echo json_encode($responses);