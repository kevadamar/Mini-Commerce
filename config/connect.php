<?php

$config["server"]='localhost:8889';
$config["username"]='root';
$config["password"]='root';
$config["database_name"]='mobile_globalshop';

////SERVER
define('DB_HOST', $config["server"]);
define('DB_USER', $config["username"]);
define('DB_PASS', $config["password"]);	
define('DB_NAME', $config["database_name"]);

 //membuat koneksi dengan database
 $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die('Unable to Connect');

;?>