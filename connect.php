<?php

$servername='34.93.155.184';
$username='root';
$userpasswd='apkove';
$database='test';

$connection= new mysqli($servername,$username,$userpasswd,$database,3306);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}


else{
    // echo "connected";
}
?>