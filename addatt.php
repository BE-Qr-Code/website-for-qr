<?php
// session_start();
$S=isset($_SERVER["id"]);
// if(){
    echo $S;
// }

// print_r($_SESSION);

function test($msg)
{
    echo "<script> alert('$msg');</script>";
}


// else {$e= $_SERVER["id"]; echo $e;}
$output = array();
include 'connect.php';
// test("connected");

$session = $_GET['session'];
$subjectid = $_GET['subjectid'];
$moodleid = $_GET['moodleid'];
$deptid = $_GET['deptid'];


// echo $session;     
// // 223.189.60.89
// echo '</br>';
// echo $subjectid;
// echo '</br>';
// echo $moodleid;
// echo '</br>';
// echo $deptid;
// echo '</br>';


// $time=strtotime($now=time());


$date = date("d", time());
$month = date("m", time());
$year = date("Y", time());

$final_date = $year . '-' . $month . '-' . $date;
// echo $final_date;
// echo '</br>';
// echo var_dump($final_date);

$stmt = $connection->prepare("SELECT SessionID,qrdate from qrcode where SessionID=? and qrdate=? ");
$stmt->bind_param('is', $session, $final_date);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    // die("Connection failed: " . $connection->connect_error);
    // echo mysqli_error($connection);
    // test(mysqli_error($connection));
  
    // header('Location:addmanually.html');
    

} else {
    $stmt->bind_result($session, $final_date);
    $stmt->fetch();
    $user_details = array(
        'session' => $session
);
    //    echo "komal";
    if ($result = mysqli_query($connection, "SELECT MoodleID from registration where MoodleID='$moodleid'")) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            // echo $row['MoodleID'];
// --------------------------------------------------------------------
//   separater
// --------------------------------------------------------------------


            $sql = "INSERT INTO attendance (SessionID , SubjectID, DepartAID, MoodleID ) VALUES (?, ?, ?, ?)";

            if ($stmt = $connection->prepare($sql)) {
                //    mysqli_prepare($connection, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "issi", $session, $subjectid, $deptid, $moodleid);

                /* Set the parameters values and execute
       the statement again to insert another row */

                $res = mysqli_stmt_execute($stmt);

                if (!$res) {
                    echo mysqli_error($connection);
                }
                $afftected = $connection->affected_rows;

                if ($afftected == 1) {
                    // echo 'Inserted';
                    test("added successfully");
                    header('Location:dashboard.php');
                } else {
                    // echo 'Did not insert';
                    test("did not insert ");
                    header('Location: addmanually.html');
                }
            }
        } else {
            // echo "Moodle ID not registered";
            test("moodle not registered");
        }
    }
}
