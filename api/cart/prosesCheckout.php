<?php

include '../../config/functions.php';

$responses = array("code" => null,"data" => null,"message" => null);

$namaTable = "flutter_shopping_cart";
$tableProduk = "flutter_barang";
$tableJual = "flutter_penjualan";
$tableJualDetail = "flutter_penjualan_detail";

$userid = $_POST['userid'];
$grandTotal = $_POST['grandtotal'];
$nilaiBayar = $_POST['nilaibayar'];
$nilaiKembali = $_POST['nilaikembali'];


if ($userid != "") {
    //INSERT DATA PENJUALAN
    $hasil = $db->query("INSERT INTO $tableJual VALUES(NULL,'','$userid',NOW(),'$grandTotal','$nilaiBayar','$nilaiKembali')");
    
    if ($hasil) {
        $id_faktur = "0";
        $sqlF = "SELECT IFNULL(id_faktur,0) id_faktur FROM $tableJual ORDER BY id_faktur DESC LIMIT 1";
        $rssqlF = mysqli_query($con,$sqlF);

        while ($f = mysqli_fetch_array($rssqlF)) {
            $id_faktur = $f['id_faktur'];
        }

        //INSERT DETAIL PENJUALAN
        $rssql = "SELECT a.id_cart id_cart, a.id_barang id_barang, a.qty qty, a.harga harga, b.nama_barang nama_barang FROM $namaTable a JOIN $tableProduk b ON a.id_barang = b.id_barang WHERE a.userid = '$userid'";
        $sql = mysqli_query($con,$rssql);

        while ($a = mysqli_fetch_array($sql)) {
            $id_cart = $a['id_cart'];
            $id_barang = $a['id_barang'];
            $qty = $a['qty'];
            $harga = $a['harga'];

            $hasilDetail = $db->query("INSERT INTO $tableJualDetail VALUES(NULL,'$id_faktur','$id_barang','$qty','$harga')");
            
            if ($hasilDetail) {
                $ddel = $db->query("DELETE FROM $namaTable WHERE id_cart='$id_cart' AND userid = '$userid'");
                if ($ddel) {
                    header('Content-Type: application/json',true,200);

                    $responses['code'] = 200;
                    $responses['message'] = "Berhasil Tambah Data";

                } else {
                    header('Content-Type: application/json',true,400);

                    $responses['code'] = 400;
                    $responses['message'] = "Gagal Tambah Data";
                }
                
            } else {
                header('Content-Type: application/json',true,400);

                $responses['code'] = 400;
                $responses['message'] = "Data Detail Gagal Disimpan";
            }
        }
    } else {
        header('Content-Type: application/json',true,400);

        $responses['code'] = 400;
        $responses['message'] = "Data Master Gagal Disimpan";
    }
} else {
    header('Content-Type: application/json',true,404);

    $responses['code'] = 404;
    $responses['message'] = "user_id is required";
}

echo json_encode($responses);
