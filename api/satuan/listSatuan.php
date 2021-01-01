<?php 
    include  '../../config/functions.php';

    $query = "SELECT * FROM flutter_satuan ORDER BY `id_satuan` DESC";

    $sql = mysqli_query($con, $query);

    // $responses = [];
    $responses = array("code" => null,"data" => null);
    $idx = 0;

    while ($dbField = mysqli_fetch_assoc($sql)) {
        
        $responseField['id'] = $dbField['id_satuan'];
        $responseField['nama_satuan'] = $dbField['nama_satuan'];
        $responseField['satuan'] = $dbField['satuan'];
        
        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
    header('Content-Type: application/json',true,200);
    $responses["code"] = 200;
    // echo ($responses["data"]);
    echo json_encode($responses);
