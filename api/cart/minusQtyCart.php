<?php

include '../../config/functions.php';

$responses = array("code" => null,"data" => null,"message" => null);

$namaTable = "flutter_shopping_cart";
$namaTableBrg = "flutter_barang";

$userid = $_POST['userid'];
$id_barang = $_POST['id_barang'];

if ($id_barang != 0) {
    $rssql = "SELECT qty,harga FROM $namaTable WHERE userid='$userid' AND id_barang='$id_barang'";

    $getQty = 0;
    $cekHarga = 0;
    $hargaSatuan = 0;
    $hasil;

    $sql = mysqli_query($con,$rssql);
    while ($a = mysqli_fetch_array($sql)) {
        $sqlBrg = "SELECT harga FROM $namaTableBrg WHERE id_barang='$id_barang'";
        $rssqlBrg = mysqli_query($con,$sqlBrg);
        while ($b = mysqli_fetch_array($rssqlBrg)) {
            $hargaSatuan = $b['harga'];
        }

        $getQty = $a['qty'];
        $cekHarga = ($a['harga']);
    }

    $qty = ($getQty - 1);
    $harga  = ($cekHarga == 0 ? 0 : ($cekHarga - $hargaSatuan));

    if ($getQty == 0 || $getQty <= 1) {
        $hasil = $db->query("DELETE FROM $namaTable WHERE userid='$userid' AND id_barang='$id_barang'");
    } else {
        $hasil = $db->query("UPDATE $namaTable SET qty = '$qty', harga='$harga' WHERE userid='$userid' AND id_barang='$id_barang'");
    }

    
    if ($hasil) {
        header('Content-Type: application/json',true,200);
        $responses['code'] = 200;
        $responses['message'] = "Berhasil Update Data";
    } else {
        header('Content-Type: application/json',true,400);
        $responses['code'] = 400;
        $responses['message'] = "Gagal Update Data";
    }
    

} else {
    header('Content-Type: application/json',true,404);

    $responses['code'] = 404;
    $responses['message'] = "id_barang is required";
}

echo json_encode($responses);