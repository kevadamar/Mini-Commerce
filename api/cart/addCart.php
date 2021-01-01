<?php 

include '../../config/functions.php';

$userID = $_POST['userid'];
$idBarang = $_POST['id_barang'];

$responses = array("code" => null,"data" => null,"message" => null);

$rssql = "SELECT qty,harga FROM `flutter_shopping_cart` WHERE userid = '$userID' AND id_barang = '$idBarang'";

$getQty = 0;
$cekHarga = 0;

$sql = mysqli_query($con,$rssql);

while ($a = mysqli_fetch_array($sql)) {
    $sqlBrg = "SELECT harga FROM `flutter_barang` WHERE id_barang = '$idBarang'";

    $rssqlBrg = mysqli_query($con,$sqlBrg);
    while ($b = mysqli_fetch_array($rssqlBrg)) {
        $hargasatuan = $b['harga'];
    }

    $getQty += $a['qty'];
    $cekHarga += ($a['harga'] + $hargasatuan);
}


$qty = ($getQty + 1);
$harga = ($cekHarga === 0 ? $_POST['harga'] : $cekHarga);
$hasil;
if ($idBarang != 0) {
    if ($getQty > 0) {
        $hasil = $db->query("UPDATE `flutter_shopping_cart` SET qty = '$qty', harga = '$harga' WHERE userid = '$userID' AND id_barang = '$idBarang'");
        $getQty = 0;
        $qty = 0;
    } else {
        $hasil = $db->query("INSERT INTO `flutter_shopping_cart` VALUES(NULL,'$userID','$idBarang','$qty','$harga',NOW())");
        $getQty = 0;
        $qty = 0;
    }
    
    if ($hasil) {
        header('Content-Type: application/json',true,200);
        $responses['code'] = 200;
        $responses['message'] = "Berhasil Tambah Data";
    } else {
        header('Content-Type: application/json',true,400);
        $responses['code'] = 400;
        $responses['message'] = "Gagal Tambah Data";
    }
} else {
        header('Content-Type: application/json',true,500);
        $responses['code'] = 500;
        $responses['message'] = "Internal server orror";
}

echo json_encode($responses);
