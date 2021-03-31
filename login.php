<?php
session_start();
require 'connect.php';

$username=$_GET['username'];
$pass=md5($_GET['pass']);
$_SESSION["id"]=$username;
$_SESSION['deptid']='';
$_SESSION['name']='';
function get_dept($moodleId){
    include 'connect.php';
    if ($result = mysqli_query($connection, "SELECT DepartID,fname FROM registration where MoodleID='$moodleId'")) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
           $_SESSION['deptid'] =$row[0];
           $_SESSION['name'] =$row[1];

        }

}

}

// radiobutton




// $query_fetch = ;  isset($result_fetch->num_rows)
$output=array();

$stmt=$connection->prepare("SELECT MoodleID,userpass FROM registration WHERE MoodleID=? AND userpass=?");
$stmt->bind_param("is",$username,$pass);
$stmt->execute();
$stmt->store_result();



if($stmt->num_rows==0){
    $output['isSuccess']=0;
    $output['message']="Incorrect MoodleId or Password";
    $str='wrong credentials';
    header('Location:error.html');
   


}
else{
    
    
    $stmt->bind_result($moodleId,$password);
    $stmt->fetch();
    // include 'checkatt.html';
    get_dept($moodleId);
    $user_details=array(
        'moodleId'=>$moodleId
    );
    get_dept($moodleId);
    $_SESSION["isteacher"]='false';
    header('Location: dashboard.php');
//    include 'dashboard.php';
    // $output['isSuccess']=1;
    // $output['message']="Login Successfull!";  ?redirect=plan1.php
    // $output['user_details']=$user_details;    
//    include('/dashboard.html';

}

// echo json_encode($output);
?>