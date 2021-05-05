<?php

session_start();

include 'connect.php';

$id = $_SESSION['id'];
$deptid = $_SESSION['deptid'];
// $subjectid = $_POST['subject'];
if (isset($_GET['submit'])) {
    // $subjectid = $_GET['subject'];
    // echo "\n".$subjectid; 
}
// echo
// print_r($_SESSION);
//  echo "\n". $subjectid;
// get_count($id,$subjectid,$deptid);





?>
<?php
// function get_count($moodleid, $subjectid, $deptid)
// {
//     include 'connect.php';
//     if ($result = mysqli_query($connection, "SELECT count(*), DepartrQID, SubjectQID FROM qrcode where DepartrQID='$deptid' AND SubjectQID='$subjectid'")) {
//         if (mysqli_num_rows($result) > 0) {
//             $row = mysqli_fetch_array($result);
//             print_r($row);
//             echo '</br>';
//             echo "calculating...";
//             if ($result1 = mysqli_query($connection, "SELECT count(*) FROM attendance where MoodleID='$moodleid' AND SubjectID='$subjectid' AND DepartAID='$deptid' ")) {

//                 $row1 = mysqli_fetch_array($result1);

//                 print_r($row1);
//                 echo '</br>';
//                 echo "Total lecs for " . $subjectid . ": " . $row[0];
//                 echo '</br>';
//                 echo "Present: " . $row1[0];
//                 echo '</br>';
//                 $r = $row[0] - $row1[0];
//                 echo "absent:" . $r;
//                 $d = $_SESSION['deptid'];
//                 echo ("dept:$d");
//                 $name= $_SESSION['name'];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check attedance </title>
    <link rel="stylesheet" href="./css/main.css" class="css">
    <link rel="stylesheet" href="./css/checkatt.css" class="css">
    <link rel="preconnect" href="https:fonts.gstatic.com">
    <link rel="stylesheet" href="./css/add_man.css">
    <link rel="stylesheet" href="./css/dash.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https:fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">



    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https:fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body>
    <nav class="nav-class">
        <div class="logo-for-attendance">
            <h4>ATTENDANCE</h4>
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php">Menu |</a></li>
            <li><a href="qr.html"> Generate QR Code |</a></li>
            <li><a href="logout.php">Log Out</a></li>
        </ul>
        <div class="welcome">
            <li><p class="welcomemsg">Welcome <?php echo $_SESSION['name']; ?> !</p></li>
        </div> 
    </nav>

    <div class="container-login100" style="background-image: url('images/bg5.jpg');">
        <div class="">
         <!-- div-for-card -->
            <div class="altbox">
                <div class="innerBox">
                <!-- outerbox -->
                    <!-- style="display:none" -->
                    <!-- </form> -->
                    <form action="" method="post">
                        <div class="selectcontainer">
                            <!-- <select name="subject" id="subj_options" for="Select Subject" onchange="m()"> -->
                            <div>
                            <select name="subject" id="subj_options" for="Select Subject" onchange="m()">
                                <option disabled selected>Select Subject</option>
                                <?php
                                include "connect.php";  // Using database connection file here
                                $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='$id'");  // Use select query here 

                                if ($result->num_rows > 0) {
                                    while ($data = $result->fetch_assoc()) {
                                        echo $data['SubjectID'];
                                        $id = $data['SubjectID'];
                                        echo "<option value='$id'>$id</option>";
                                    }
                                }

                                ?>
                            </select>
                            </div>
                        </div>
                        <!-- <div class="selectcontainer">
                            <input type="date" class="date" id="sessionDate" name="sessionDate">
                        </div> -->
                        <div class="selectcontainer">
                            <input type="submit" name="submit" class="dropbtn" value="Get Result"></input>
                        </div>
                            
                            <div class="hiddenDIV" style="display:none;">
                                <div>vcvx</div>
                            </div>
                        
                    </form>

                    <?php
                        if (isset($_POST['submit'])) {
                            if (!empty($_POST['subject'])) {
                                $selected = $_POST['subject'];
                                // echo $selected;
                                include 'connect.php';
                                
                                // if query is successfully executed
                                $result = mysqli_query($connection, "SELECT count(*), DepartAID, SubjectID 
                                                        FROM attendance where DepartAID='$deptid' AND SubjectID='$selected' 
                                                        GROUP BY DepartAID,SubjectID ;");

                                if($result){
                                    if(mysqli_num_rows($result) > 0){
                                        $name= $_SESSION['name'];
                                        // get total students 'present' for the subject
                                        $row = mysqli_fetch_array($result);

                                        echo "<script>console.log(".json_encode($row).")</script>";
                                        
                                        // select total no. of students enrolled for the subject selected
                                        $result1 = mysqli_query($connection, "SELECT count(MoodleID) from 
                                            registration where DepartID = (select DepartSID from Subjects where 
                                            SubjectID='$selected');");
                                        
                                        $row1 = mysqli_fetch_array($result1);
                                        $r = $row1[0] - $row[0];

                                        $subjectId = $selected;
                                        $deptid = $deptid;
                                        $teacherId =  $_SESSION['id'];
                                        echo "<script>console.log(\"$subjectId $deptid $teacherId\")</script>";

                                        /// Date Value
                                        // $date = $_POST['sessionDate'];
                                        // echo "<script>console.log(\"$date \")</script>";

                                        echo "<script>console.log(".json_encode($row1).")</script>";
                        ?>
                                        <div>
                                            <div class="selectcontainer">
                                            <label for="subjectid" class="labelclass">Prof.:</label>
                                            <input type="text" class="input3"  value="<?php echo($name); ?>" readonly>
                                            </div>
                                            <div class="selectcontainer">
                                            <label for="subjectid" class="labelclass">SUBJECT:</label>
                                            <input type="text" class="input3"  value="<?php echo "$row[2]";?>" readonly>
                                            </div>
                                            <div class="selectcontainer">
                                            <label for="present" class="labelclass">PRESENT:</label>
                                            <input type="text" class="input3"  value="<?php echo "$row[0]";?>" readonly>
                                            </div>
                                            <div class="selectcontainer">
                                            <label for="subjectid" class="labelclass">ABSENT:</label>
                                            <input type="text" class="input3"  value="<?php echo "$r";?>" readonly>
                                            </div>
                                            <div class="selectcontainer">
                                            <label for="subjectid" class="labelclass">TOTAL:</label>
                                            <input type="text" class="input3"  value="<?php echo "$row1[0]";?>" readonly>
                                            </div>
                                            <div class="selectcontainer">
                                                <a href="php-tcpdf-meh-tableHTML.php?subjectId=<?php echo $subjectId ?>&deptid=<?php echo $deptid ?>&teacherId=<?php echo $teacherId ?>" target="_blank">Generate PDF</a>
                                            </div>
                                        </div>

                                    
                                <?php }
                                else{ ?>
                                    <div class="containerop">
                                        <label>No Attendance Record Found!</label>
                                    </div>
                        <?php    }
                            }
                                else{ ?>
                                    <div class="containerop">
                                        <label>An unexpected error occured!</label>
                                    </div>
                        <?php    }
                            }
                        }
                    ?>
                        <!-- </div> -->
                </div>
                <!-- <input type="button" value="Back" class="checkbtn" onclick="history.back(-1)" readonly> -->
            </div>
            <!-- </div> -->

        </div>
    </div>
    <script src="month.js"></script>
</body>

</html>