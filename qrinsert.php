<?php
session_start();
include 'connect.php';
$id=$_SESSION["id"];


$SessionID=$_POST['SessionID'];
$qrcode=$_POST['qrcode'];
$qrdate=$_POST['qrdate'];
$timestamp=$_POST['timestamp'];
$DepartrQID=$_POST['DepartrQID'];
$SubjectQID=$_POST['SubjectQID'];
function test($msg)
{
    echo "<script> alert('$msg');</script>";
}
if ($result = mysqli_query($connection, "SELECT * from Subjects where SubjectID='$SubjectQID' AND DepartSID='$DepartrQID' AND TeacherID='$id'")) {
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);



$sql = "INSERT INTO qrcode (SessionID , qrcode, qrdate, timestamp, DepartrQID, SubjectQID ) VALUES (?, ?, ?, ?, ?, ?)";

            if ($stmt = $connection->prepare($sql)) {
                //    mysqli_prepare($connection, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "isssss", $SessionID, $qrcode, $qrdate, $timestamp, $DepartrQID, $SubjectQID);

                /* Set the parameters values and execute
       the statement again to insert another row */

                $res = mysqli_stmt_execute($stmt);

                if (!$res) {
                    echo mysqli_error($connection);
                }
                $afftected = $connection->affected_rows;

                if ($afftected == 1) {
                    echo 'Inserted';
                    // test("added successfully");
                    // header('Location:dashboard.html');
                    $timer=60;
                    while($remtime>1){
                        // $now = time();
                        $remtime = $timer-$timestamp;
                        $timer=$timer-1;
                        if($remtime ==1 ){
                            
                        }



                 }



                } else {
                    echo 'Did not insert';
                //   test("insert failed"); 
                    // header('Location: addmanually.html');




                }
            }


        } 
        else{

        echo "no such record";




               }
    }
   

?>