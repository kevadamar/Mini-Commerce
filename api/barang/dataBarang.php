<?php
include  '../../config/functions.php';

$dateNow = date('Y-m-d');
// var_dump($dateNow);
$qparam = $_GET['q'];
$userid = $_GET['userid'];

$query = "SELECT * FROM flutter_barang  /*HERE `tglexpired` >= '$dateNow'*/ ORDER BY `tglinput` DESC, `id_barang` DESC";
$responses = array("code" => null, "data" => null);
$idx = 0;

$sql;
if (empty($qparam) && empty($userid)) {

    $sql = mysqli_query($con, $query);

    while ($dbField = mysqli_fetch_assoc($sql)) {

        $responseField['id'] = $dbField['id_barang'];
        $responseField['id_kategori'] = $dbField['id_kategori'];
        $responseField['id_satuan'] = $dbField['id_satuan'];
        $responseField['image'] = $dbField['image'];
        $responseField['nama_barang'] = $dbField['nama_barang'];
        $responseField['harga'] = $dbField['harga'];
        $responseField['tglexpired'] = $dbField['tglexpired'];

        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
} else if ($qparam == "true" && !empty($userid)) {

    $queryd = "SELECT fb.id_barang,fb.id_kategori,fb.id_satuan,fb.harga,fb.image,fb.nama_barang,fb.tglexpired,fpd.qty,fp.tgl_penjualan,fp.userid FROM flutter_barang fb INNER JOIN flutter_penjualan_detail fpd ON fpd.id_barang = fb.id_barang INNER JOIN flutter_penjualan fp ON fp.id_faktur = fpd.id_faktur WHERE fp.userid = '$userid' ORDER BY fpd.qty DESC,fp.tgl_penjualan DESC";

    $sql = mysqli_query($con, $queryd);

    $responses['data'] = [];

    while ($dbField = mysqli_fetch_assoc($sql)) {

        $responseField['id'] = $dbField['id_barang'];
        $responseField['id_kategori'] = $dbField['id_kategori'];
        $responseField['id_satuan'] = $dbField['id_satuan'];
        $responseField['image'] = $dbField['image'];
        $responseField['nama_barang'] = $dbField['nama_barang'];
        $responseField['harga'] = $dbField['harga'];
        $responseField['tglexpired'] = $dbField['tglexpired'];
        $responseField['tgl_penjualan'] = $dbField['tgl_penjualan'];
        $responseField['userid'] = $dbField['userid'];

        $responses["data"][$idx] = $responseField;
        // array_push($responses, $responseField);
        $idx++;
    }
    if (count($responses['data']) == 0) {
        $idx = 0;
        $sql = mysqli_query($con, $query);

        while ($dbField = mysqli_fetch_assoc($sql)) {

            $responseField['id'] = $dbField['id_barang'];
            $responseField['id_kategori'] = $dbField['id_kategori'];
            $responseField['id_satuan'] = $dbField['id_satuan'];
            $responseField['image'] = $dbField['image'];
            $responseField['nama_barang'] = $dbField['nama_barang'];
            $responseField['harga'] = $dbField['harga'];
            $responseField['tglexpired'] = $dbField['tglexpired'];

            $responses["data"][$idx] = $responseField;
            // array_push($responses, $responseField);
            $idx++;
        }
    }
    $responses['data'] = my_array_unique($responses['data']);
} else {
    if (empty($qparam) || $qparam == "" || $userid == "" || empty($userid)) {
        header('Content-Type: application/json', true, 400);
        $responses["code"] = 400;
        $responses["message"] = "param is required";

        echo json_encode($responses);
        return;
    } else {
        header('Content-Type: application/json', true, 400);
        $responses["code"] = 400;
        $responses["message"] = "invalid param";

        echo json_encode($responses);
        return;
    }
}

// var_dump($sql);
if ($sql) {
    header('Content-Type: application/json', true, 200);
    $responses["code"] = 200;
    $responses["message"] = "Success";
} else {
    header('Content-Type: application/json', true, 500);
    $responses["code"] = 500;
    $responses["message"] = "Internal server error";
}

echo json_encode($responses);


function my_array_unique($array, $keep_key_assoc = false)
{
    $duplicate_keys = array();
    $tmp = array();

    foreach ($array as $key => $val) {
        // convert objects to arrays, in_array() does not support objects
        if (is_object($val))
            $val = (array)$val;

        if (!in_array($val, $tmp))
            $tmp[] = $val;
        else
            $duplicate_keys[] = $key;
    }

    foreach ($duplicate_keys as $key)
        unset($array[$key]);

    return $keep_key_assoc ? $array : array_values($array);
}
