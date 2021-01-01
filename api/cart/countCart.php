<?php 

include '../../config/functions.php';

$responses = array("code" => null,"data" => null,"message" => null);
$idx = 0;

$userID = $_GET['userid'];

$rssql = "SELECT IFNULL(SUM(qty),0) AS jumlah, IFNULL(SUM(harga),0) AS totalHarga FROM `flutter_shopping_cart` WHERE userid = '$userID'";

$sql = mysqli_query($con,$rssql);

while ($dbField = mysqli_fetch_array($sql)) {
    
    $responseField['jumlah'] = $dbField['jumlah'];
    $responseField['totalHarga'] = $dbField['totalHarga'];
    
    $responses["data"][$idx] = $responseField;
    // array_push($responses, $responseField);
    $idx++;
}

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
