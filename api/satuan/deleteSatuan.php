<?php 
    include  '../../config/functions.php';

    $id = $_POST['id'];

    $query = "DELETE FROM `flutter_satuan`  WHERE `id_satuan` = '$id'";
    
    $hasil = $db->query($query);
    
    $responses = array("code" => null,"data" => null,"message" => null);

    if ($hasil) {
        $responses["code"] = 200;
        $responses["message"] = "Berhasil Hapus Data";
    } else {
        $responses["code"] = 422;
        $responses["message"] = "Gagal Hapus Data";
    }
    
    echo json_encode($responses);
