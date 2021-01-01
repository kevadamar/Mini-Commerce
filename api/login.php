<?php 

include '../config/functions.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$namaTable = "flutter_users";

$responses = array("code" => null,"data" => null,"message" => null);
$idx = 0;

$rows = $db->get_results("SELECT * FROM `$namaTable` WHERE username = '$username' AND password = '$password'");

$jumlahRec = $db->get_var("SELECT COUNT(*) FROM `$namaTable` WHERE username = '$username' AND password = '$password' ");

if ($jumlahRec > 0) {
    
    header('Content-Type: application/json',true,200);
    $responses['code'] = 200;
    $responses["message"] = "Success Login!";
    
    foreach ($rows as $row) {
        $responseField['userid'] = (int)$row->userid;
        $responseField['username'] = $row->username;
        $responseField['password'] = $row->password;
        $responseField['level'] = (int)$row->level;
        
        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
    } else {

    header('Content-Type: application/json',true,404);

    $responses['code'] = 404;
    $responses['message'] = "Username atau Password salah : " . $jumlahRec . " data";
}

echo json_encode($responses);
