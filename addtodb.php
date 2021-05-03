<?php
session_start();
include 'connect.php';

$id = $_SESSION["id"];
$Session = $_POST['Session'];
$count = $_POST['count'];
$subject = $_POST['subject'];

$result =mysqli_query($connection,"SELECT count(MoodleID) from attendance where SessionID='$Session'");
$row = mysqli_fetch_array($result);
$present = $row['0'];
$query2 = "SELECT Enrolled from Subjects where SubjectID='$subject'";
$result2= mysqli_query($connection,$query2);
$row2 = mysqli_fetch_array($result2);
$total = $row2['0'];
$absent = $total- $present;

$per = floor(($present/$total)*100);
$query3= "UPDATE countvalues SET present= '$present' , absent = '$absent',percentage='$per' WHERE session='$Session'";
$result = mysqli_query($connection,$query3);
$r = mysqli_affected_rows($connection);
if($r == 0) 
echo "not updated";
else
echo "updated";