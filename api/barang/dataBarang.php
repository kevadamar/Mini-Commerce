<?php 
    include  '../../config/functions.php';

    $dateNow = date('Y-m-d');
    // var_dump($dateNow);

    $query = "SELECT * FROM flutter_barang  /*HERE `tglexpired` >= '$dateNow'*/ ORDER BY `tglinput` DESC, `id_barang` DESC";
    
    $sql = mysqli_query($con, $query);

    $responses = array("code" => null,"data" => null);
    $idx = 0;


    while ($dbField = mysqli_fetch_assoc($sql)) {
        
        $responseField['id'] = $dbField['id_barang'];
        $responseField['id_kategori'] = $dbField['id_kategori'];
        $responseField['id_satuan'] = $dbField['id_satuan'];
        $responseField['userid'] = $dbField['userid'];
        $responseField['image'] = $dbField['image'];
        $responseField['nama_barang'] = $dbField['nama_barang'];
        $responseField['harga'] = $dbField['harga'];
        $responseField['tglexpired'] = $dbField['tglexpired'];

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