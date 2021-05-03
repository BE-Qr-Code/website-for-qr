<?php
session_start();
include 'connect.php';
$id = $_SESSION["id"];

$subjectid = $_POST['subject'];
$departmentid = $_POST['department'];
$moodleid = $_POST['moodleid'];
$month = $_POST['month'];
$i = 0;
$present = 0;
$total = 0;
$final = array();
$query1 = "SELECT SessionID from qrcode where qrdate like '%-$month-%' AND SubjectQID='AISC'; ";
$result1 = mysqli_query($connection, $query1);
while ($row1 = mysqli_fetch_array($result1)) {
    $total = $total + 1;
    $s = $row1[0];

    $query2 = "SELECT COUNT(MoodleID) from attendance where SessionID='$s' AND MoodleID='$moodleid'";
    $result2 = mysqli_query($connection, $query2);
    $row2 = mysqli_fetch_array($result2);
    $present = $present + $row2[0];

    $query3 = "SELECT COUNT(SessionID) from attendance where SessionID='$s' AND MoodleID='$moodleid'";






    $i = $i + 1;
}
$absent = $total - $present;
$per = floor(($present/$total)*100);

array_push($final, $present,$absent,$total,$per);
echo json_encode($final);
// echo $present;