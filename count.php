<?php

session_start();

include 'connect.php';

$SessionID = $_POST['SessionID'];
$qrcode = $_POST['qrcode'];

$DepartrQID = $_POST['DepartrQID'];
$SubjectQID = $_POST['SubjectQID'];

$count = "SELECT count(MoodleID) from attendance where SessionID='$SessionID' AND SubjectID='$SubjectQID' AND DepartAID='$DepartrQID'";
if($result = mysqli_query($connection,$count)){
    $row = mysqli_fetch_array($result);
}
echo $row[0];
?>
