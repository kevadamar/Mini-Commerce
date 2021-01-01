<?php 
    include  '../../config/functions.php';

    $query = "SELECT * FROM flutter_kategori";

    $sql = mysqli_query($con, $query);

    // $responses = [];
    $responses = array("code" => null,"data" => null);
    $idx = 0;

    while ($dbField = mysqli_fetch_assoc($sql)) {
        
        $responseField['id'] = $dbField['id_kategori'];
        $responseField['nama_kategori'] = $dbField['nama_kategori'];
        
        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
    header('Content-Type: application/json',true,200);
    $responses["code"] = 200;
    // echo ($responses["data"]);
    echo json_encode($responses);
