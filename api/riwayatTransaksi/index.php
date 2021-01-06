<?php

include '../../config/functions.php';

$responses = array("code" => null, "message" => null, "totalData" => null, "data" => null);
$idx = 0;
$idFaktur = $_POST['idfaktur'];
$idbrg = $_POST['idbrg'];
$userid = $_POST['userid'];
$rssql = "SELECT fp.id_faktur, fpd.id_barang, fb.nama_barang,fb.harga AS harga_satuan, fb.image AS gambar, fpd.harga AS harga_detail_per_barang,fpd.qty,fs.nama_satuan,fs.satuan,fp.grandtotal,fp.nilaibayar,fp.nilaikembali,fp.tgl_penjualan FROM `flutter_penjualan` fp INNER JOIN `flutter_penjualan_detail` fpd ON fp.id_faktur = fpd.id_faktur INNER JOIN `flutter_barang` fb ON fpd.id_barang = fb.id_barang INNER JOIN `flutter_satuan` fs ON fs.id_satuan = fb.id_satuan WHERE fp.userid = '$userid'";

if(empty($userid)){
    header('Content-Type: application/json', true, 404);
    $responses["code"] = 404;
    $responses["message"] = "iduser is required";
    
    echo json_encode($responses);
    return;
}

if (empty($idFaktur) && empty($idbrg)) {

    $rssql = $rssql . " ORDER BY tgl_penjualan DESC";

    $sql = mysqli_query($con, $rssql);
    while ($dbField = mysqli_fetch_assoc($sql)) {

        $responseField['id_faktur'] = $dbField['id_faktur'];
        $responseField['id_barang'] = $dbField['id_barang'];
        $responseField['harga_satuan'] = $dbField['harga_satuan'];
        $responseField['gambar'] = $dbField['gambar'];
        $responseField['nama_barang'] = $dbField['nama_barang'];
        $responseField['harga_detail_per_barang'] = $dbField['harga_detail_per_barang'];
        $responseField['qty'] = $dbField['qty'];
        $responseField['nama_satuan'] = $dbField['nama_satuan'];
        $responseField['satuan'] = $dbField['satuan'];
        $responseField['grandtotal'] = $dbField['grandtotal'];
        $responseField['nilaibayar'] = $dbField['nilaibayar'];
        $responseField['nilaikembali'] = $dbField['nilaikembali'];
        $responseField['tgl_penjualan'] = $dbField['tgl_penjualan'];

        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
} else {
    
    if (empty($idFaktur)) {
        header('Content-Type: application/json', true, 400);
        $responses["code"] = 400;
        $responses["message"] = "idfaktur is required";
    
        echo json_encode($responses);
        return;
    }
    
    if (empty($idbrg)) {
        header('Content-Type: application/json', true, 400);
        $responses["code"] = 400;
        $responses["message"] = "idbrg is required";
        
        echo json_encode($responses);
        return;
    }

    $rssqldetail = $rssql . " AND fp.id_faktur = '$idFaktur' AND fpd.id_barang = '$idbrg'";
    $sql = mysqli_query($con, $rssqldetail);
    while ($dbField = mysqli_fetch_assoc($sql)) {

        $responseField['id_faktur'] = $dbField['id_faktur'];
        $responseField['id_barang'] = $dbField['id_barang'];
        $responseField['harga_satuan'] = $dbField['harga_satuan'];
        $responseField['gambar'] = $dbField['gambar'];
        $responseField['nama_barang'] = $dbField['nama_barang'];
        $responseField['harga_detail_per_barang'] = $dbField['harga_detail_per_barang'];
        $responseField['qty'] = $dbField['qty'];
        $responseField['nama_satuan'] = $dbField['nama_satuan'];
        $responseField['satuan'] = $dbField['satuan'];
        $responseField['grandtotal'] = $dbField['grandtotal'];
        $responseField['nilaibayar'] = $dbField['nilaibayar'];
        $responseField['nilaikembali'] = $dbField['nilaikembali'];
        $responseField['tgl_penjualan'] = $dbField['tgl_penjualan'];

        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
}


// var_dump($sql);
if ($sql) {
    header('Content-Type: application/json', true, 200);
    $responses["code"] = 200;
    $responses["message"] = "Success";
    $responses["totalData"] = count($responses["data"]);
} else {
    header('Content-Type: application/json', true, 500);
    $responses["code"] = 500;
    $responses["message"] = "Internal server error";
}

echo json_encode($responses);
