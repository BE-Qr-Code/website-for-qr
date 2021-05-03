<?php
session_start();
include 'connect.php';
// $id = $_SESSION["id"];

$session = $_POST['session'];
$resultArray = array();
$query = "SELECT MoodleID from attendance where SessionID='$session'";
   $result = mysqli_query($connection,$query);
    //    $row = mysqli_fetch_array($result);
  
while($row = mysqli_fetch_array($result)){
    array_push($resultArray,$row['0']);
    $mid= $row['0'];
    $query2 = "SELECT fname from registration where MoodleID='$mid' ";
    $result2 = mysqli_query($connection, $query2);
    while($row2 = mysqli_fetch_array($result2)){
        array_push($resultArray, $row2['0']);
    }

}


$stmt = $connection->prepare("SELECT qrcode,SubjectQID FROM qrcode WHERE SessionID=? ");
$stmt->bind_param("s", $session);
$stmt->execute();
$stmt->store_result();



$stmt->bind_result($qrcode, $subject);
$stmt->fetch();
// print_r($qrcode);
// print_r($subject);
array_push($resultArray,$subject);
array_push($resultArray,$qrcode);
echo json_encode($resultArray);
// echo json_encode($session);
