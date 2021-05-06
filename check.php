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


    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

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
            <li>
                <a href="qr.html">Generate QR Code |</a>
            </li>
            <li><a href="logout.php">Log Out</a></li>


        </ul>

    </nav>

    <div class="container-login100" style="background-image: url('images/bg5.jpg');">
        <div class="div-for-card">

            <div class="altbox">
                <div class="outerbox">


                    <!-- style="display:none" -->
                    <!-- </form> -->
                    <form action="" method="post">
                        <div class="selectcontainer">
                            <select name="subject" id="subj_options" for="Select Subject" onchange="callme()">
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
                            <button style="margin:5px; text-decoration:underline;" onclick="reset()">click to select other sub</button>
                            <?php
                            if (isset($_POST['submit'])) {
                                if (!empty($_POST['subject'])) {
                                    $selected = $_POST['subject'];
                                    // echo $selected;
                                    include 'connect.php';
                                }
                            }
                            ?>
                            <!-- <input type="submit" name="submit" class="dropbtn" value="Get Result"></input> -->





                        </div>
                        <div id="hiddenDIV" class="DIV">
                            <div class="det">

                                <p class="profname"> Prof. Name:<?php echo $_SESSION['name']; ?></p>
                                <p class="datetime">
                                    Generarted on:<?php echo date("d/m/y"); ?> Time :<?php echo date("h:i:sa"); ?>
                                </p>

                            </div>
                            <div id="next-div">


                            </div>


                        </div>
                    </form>



                </div>
                <!-- <input type="button" value="Back" class="checkbtn" onclick="history.back(-1)" readonly> -->



            </div>
            <!-- </div> -->

        </div>
    </div>
    <script src="month.js"></script>
</body>

</html>