<?php
session_start();

include 'connect.php';
$subjectId = $_POST['subjectId'];
$montharr = array();
$countarr = array();
$percentage = array();
$array = array();
$finalarray = array();
$record=0;
$result = mysqli_query($connection, "SELECT monthnum from countvalues where subject='$subjectId'");
while ($row = mysqli_fetch_array($result)) {
    $month = $row['0'];

    array_push($montharr, $month);
    $montharr = array_unique($montharr);
}
foreach ($montharr as $r){
  $record=$record+1;
    $stmt = mysqli_query($connection,"SELECT count(*),sum(percentage) from countvalues where subject='$subjectId' AND monthnum='$r'");
    $result= mysqli_fetch_array($stmt);
    $count = $result['0'];
    $sumper = $result['1'];
    if($count==0)
    {
        $per=0;
    }
    else{
        $per= $sumper/$count;
    }
    array_push($countarr, $count);
    array_push($percentage, $per);
}

$array=array_merge($array,$montharr);
$array=array_merge($array,$percentage);
$finalarray=array_merge($array,$countarr);


// $finalarray=array_push($finalarray,$record);

echo json_encode($finalarray);
// echo json_encode($array);
