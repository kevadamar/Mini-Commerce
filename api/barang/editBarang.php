<?php 
    include  '../../config/functions.php';


    $id = $_POST['id_barang'];
    $id_kategori = $_POST['id_kategori'];
    $id_satuan = $_POST['id_satuan'];
    $userid = $_POST['userid'];
    $imgServe = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];
    
    $nama_barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $tglexpired = $_POST['tglexpired'];
    
    $responses = array("code" => null,"data" => null,"message" => null);
    $idx = 0;
    
    $queryImg = "";
    if ($imgServe != "") {
        $image = date('dmYHis').str_replace(" ","",basename($imgServe));
        $imagePath = sprintf('../../uploads/%s',$image);
        move_uploaded_file($tempName,$imagePath);
        $queryImg = ",image='$image'";
    }
    
    $query = "SELECT * FROM `flutter_barang` WHERE id_barang = '$id'";
    $hasil = mysqli_query($con, $query);

    if (mysqli_num_rows($hasil) > 0) {
        $query = "UPDATE `flutter_barang` SET nama_barang = '$nama_barang' , harga='$harga' $queryImg , id_kategori='$id_kategori', id_satuan='$id_satuan', tglexpired = '$tglexpired' WHERE id_barang = '$id'";
        $hasil = mysqli_query($con, $query);
    } else {
        header('Content-Type: application/json',true,404);
        $responses["code"] = 404;
        $responses['message'] = "Data Not Found";
        echo json_encode($responses);
        return;
    }
    
    

    // var_dump($hasil);

    if ($hasil) {
        header('Content-Type: application/json',true,200);
        $responses['code'] = 200;
        $responses['message'] = "Berhasil Update Data";
    } else {
        header('Content-Type: application/json',true,400);
        $responses["code"] = 400;
        $responses['message'] = "Gagal Update Data";
    }
    

    // echo ($responses["data"]);
    echo json_encode($responses);
