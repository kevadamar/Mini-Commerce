<?php 
    include  '../../config/functions.php';

    $id = $_POST['id'];

    $query = "DELETE FROM `flutter_kategori`  WHERE `id_kategori` = '$id'";
    
    $hasil = $db->query($query);
    
    $responses = array("code" => null,"data" => null,"message" => null);

    if ($hasil) {
        header('Content-Type: application/json',true,200);
        $responses["code"] = 200;
        $responses["message"] = "Berhasil Hapus Data";
    } else {
        header('Content-Type: application/json',true,400);
        $responses["code"] = 400;
        $responses["message"] = "Gagal Hapus Data";
    }
    
    echo json_encode($responses);
