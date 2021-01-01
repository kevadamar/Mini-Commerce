<?php 
    include  '../../config/functions.php';


    $responses = array("code" => null,"data" => null,"message" => null);
    $idx = 0;

    $id = $_POST['id_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_satuan = $_POST['id_satuan'];
    $userid = $_POST['userid'];

    //image handler
    $imgName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    $image = date('dmYHis').str_replace(" ","",basename($imgName));
    $imagePath = ("../../uploads/$image");
    $cek = move_uploaded_file($tempName,$imagePath);
    // var_dump($imgName);

    if (!$cek) {
        header('Content-Type: application/json',true,500);
        $responses['code'] = 500;
        $responses['message'] = "Internal Server Error ";
        echo json_encode($responses);
        return;
    }
    //end image handler

    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $tglexpired = $_POST['tglexpired'];
    
    header('Content-Type: text/xml');

    $hasil = $db->query("INSERT INTO `flutter_barang` VALUES(NULL,'$id_kategori','$id_satuan','$userid','$nama_barang','$harga','$image','$tglexpired', NOW())");

    // $sql = mysqli_query($con, $query);

    if ($hasil) {
        header('Content-Type: application/json',true,201);
        $responses['code'] = 201;
        $responses['message'] = "Berhasil simpan";
    } else {
        header('Content-Type: application/json',true,400);
        $responses['code'] = 400;
        $responses['message'] = "Gagal simpan";
    }

    echo json_encode($responses);
