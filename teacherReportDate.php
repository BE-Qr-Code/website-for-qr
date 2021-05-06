<?php
session_start();

include 'connect.php';
// print_r($_SESSION);
if ($_SESSION["id"] == '') {
  header('Location:index.html');
}
$id = $_SESSION["id"];

echo "<script>console.log(\"$id\")</script>";

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$teacherId = $_SESSION['id'];
$teacherName = $_SESSION['name'];
$deptid = $_SESSION['deptid'];

// $total_students = 0;
// $total_present = 0;
// $total_absent = 0;

echo "<script>console.log(\"$teacherId $teacherName $deptid\")</script>";


// echo "<script>console.log(".json_encode($myJSON).")</script>";
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daily Attendance Report</title>
  <link rel="stylesheet" href="./css/main.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/dash.css" />
  <link rel="stylesheet" href="./css/dailyAttReport.css" />

  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

</head>

<body>

  <nav class="nav-class">
    <div class="logo-for-attendance">
      <h4>ATTENDANCE</h4>
    </div>
    <ul class="nav-links">
      <li><a href="dashboard.php">Menu |</a></li>
      <li>
        <a href="qr.php">Generate QR Code |</a>
      </li>
      <li><a href="logout.php">Log Out</a></li>


    </ul>
    <div class="welcome">

      <li>
        <p class="welcomemsg">Welcome <?php echo $_SESSION['name']; ?>!</i></p>
      </li>
    </div>

  </nav>
  <div class="limiter" style="height: 90vh;">
    <div class="container-login100" style="background-image: url('images/bg5.jpg');">
      <div class="box-check-daily">
        <!-- div class="altbox"> -->
        <div>
          <div class="div-labelclass">
            <h1>Daily Attendance Report</h1>
          </div>
          <div>
            <form class="form-class" method="post">
              <div class="form-class-divs">
                <label for="date">Subject</label>
                <select name="subject" id="subj_options" for="Select Subject">
                  <!-- onchange="m()" -->
                  <option disabled selected>Select Subject</option>
                  <?php
                  include "connect.php";  // Using database connection file here
                  $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='$teacherId'");  // Use select query here 

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
              <div class="form-class-divs">
                <label for="date">Date</label>
                <input type="date" class="date" id="sessionDate" name="sessionDate">
              </div>
              <div class="form-class-divs daily-btn">
                <input type="submit" id="daily-form-btn" name="submit" value="Get Result" />
              </div>
            </form>

            <?php
            if (isset($_POST['submit'])) {
              if (!empty($_POST['subject']) && !empty($_POST['sessionDate'])) {
                $selected = $_POST['subject'];
                $subjectId = $selected;
                $date = $_POST['sessionDate'];
                $sessionDate = strval($date);
                // echo $selected;
                include 'connect.php';

                echo "<script>console.log(\"$subjectId $sessionDate $deptid\")</script>";

                $res_date = mysqli_query($connection, "SELECT SessionID
                        FROM qrcode where DepartrQID='$deptid' AND SubjectQID='$selected' AND qrdate='$sessionDate'");
                // if ($res_date->num_rows>1) {
                //   while($row = $res_date->fetch_assoc()) {
                //     echo "<script>console.log(".json_encode($row).")</script>";                            
                //   }
                // }
                // else{
                //   $row = mysqli_fetch_array($res_date);
                //   $sessionId = $row[0];
                //   echo "<script>console.log(".$sessionId.")</script>";
                // }

                if ($res_date) {
                  if (mysqli_num_rows($res_date) == 1) {
                    $name = $_SESSION['name'];
                    $row = mysqli_fetch_array($res_date);
                    $sessionId = $row[0];

                    ///////////////////////////////////////////////////////////////////////////////// to get absent students
                    $result1 = mysqli_query($connection, "SELECT count(*), MoodleID from test.attendance where SubjectID='$subjectId' group by MoodleID;");
                    if ($result1->num_rows > 0) {
                      while ($row = $result1->fetch_assoc()) {
                        echo "<script>console.log(" . json_encode($row) . ")</script>";
                      }
                    }
                    $randoms = substr(md5(microtime()), 0, 6);
                    echo "<script>console.log(\"$randoms\")</script>";

                    //////////////////////////////////////////////////////////////////////////////////////////////

                    // get students present for that session
                    $result = mysqli_query($connection, "SELECT count(*), DepartAID, SubjectID 
                          FROM attendance where DepartAID='$deptid' AND SubjectID='$selected' AND SessionID='$sessionId'
                          GROUP BY DepartAID,SubjectID ;");

                    $row = mysqli_fetch_array($result);

                    echo "<script>console.log(" . json_encode($row) . ")</script>";

                    // select total no. of students enrolled for the subject selected
                    $result1 = mysqli_query($connection, "SELECT count(MoodleID) from 
                              registration where DepartID = (select DepartSID from Subjects where 
                              SubjectID='$selected');");

                    $row1 = mysqli_fetch_array($result1);
                    $r = $row1[0] - $row[0];

                    // $subjectId = $selected;
                    $deptid = $deptid;
                    $teacherId =  $_SESSION['id'];
                    echo "<script>console.log(\"$subjectId $deptid $teacherId $date $sessionId\")</script>";

                    // echo "<script>console.log(".json_encode($row1).")</script>";
            ?>

                    <div>
                      <div class="div-labelclass">
                        <label for="subjectid" class="labelclass">Prof.:</label>
                        <input type="text" class="input3" value="<?php echo ($teacherName); ?>" readonly>
                      </div>
                      <div class="div-labelclass">
                        <label for="subjectid" class="labelclass">SUBJECT:</label>
                        <input type="text" class="input3" value="<?php echo "$row[2]"; ?>" readonly>
                      </div>
                      <div class="div-labelclass">
                        <label for="present" class="labelclass">PRESENT:</label>
                        <input type="text" class="input3" value="<?php echo "$row[0]"; ?>" readonly>
                      </div>
                      <div class="div-labelclass">
                        <label for="subjectid" class="labelclass">ABSENT:</label>
                        <input type="text" class="input3" value="<?php echo "$r"; ?>" readonly>
                      </div>
                      <div class="div-labelclass">
                        <label for="subjectid" class="labelclass">TOTAL:</label>
                        <input type="text" class="input3" value="<?php echo "$row1[0]"; ?>" readonly>
                      </div>
                    </div>
                    <div class="link-pdf">
                      <a href="php-tcpdf-daily-tableHTML.php?subjectId=<?php echo $subjectId ?>&deptid=<?php echo $deptid ?>&sessionId=<?php echo $sessionId ?>&date=<?php echo $date ?>&teacherName=<?php echo $teacherName ?>&total_present=<?php echo $row[0] ?>&total_students=<?php echo $row1[0] ?>" target="_blank">Generate PDF</a>
                    </div>
                    <div class="link-pdf">
                      <a href="php-tcpdf-monthly-tableHTML.php?subjectId=<?php echo $subjectId ?>&deptid=<?php echo $deptid ?>&teacherName=<?php echo $teacherName ?>&total_students=<?php echo $row1[0] ?>" target="_blank">Overall PDF Report</a>
                    </div>

                    <?php } else if ($res_date->num_rows > 1) {
                    while ($row = $res_date->fetch_assoc()) {
                      echo "<script>console.log(" . json_encode($row['SessionID']) . ")</script>";
                      $sessionId = $row['SessionID'];

                      $result = mysqli_query($connection, "SELECT count(*), DepartAID, SubjectID 
                      FROM attendance where DepartAID='$deptid' AND SubjectID='$selected' AND SessionID='$sessionId'
                      GROUP BY DepartAID,SubjectID ;");
                      $row = mysqli_fetch_array($result);
                      echo "<script>console.log(" . json_encode($row) . ")</script>";

                      // select total no. of students enrolled for the subject selected
                      $result1 = mysqli_query($connection, "SELECT count(MoodleID) from 
                          registration where DepartID = (select DepartSID from Subjects where 
                          SubjectID='$selected');");
                      $row1 = mysqli_fetch_array($result1);
                      $r = $row1[0] - $row[0];

                      $deptid = $deptid;
                      $teacherId =  $_SESSION['id'];
                      echo "<script>console.log(\"$subjectId $deptid $teacherId $date $sessionId\")</script>";
                    ?>
                      <div class="link-pdf">
                        <a href="php-tcpdf-daily-tableHTML.php?subjectId=<?php echo $subjectId ?>&deptid=<?php echo $deptid ?>&sessionId=<?php echo $sessionId ?>&date=<?php echo $date ?>&teacherName=<?php echo $teacherName ?>&total_present=<?php echo $row[0] ?>&total_students=<?php echo $row1[0] ?>" target="_blank">Get PDF for Session - <?php echo $sessionId ?></a>
                      </div>
                    <?php    } ?>
                    <div class="link-pdf">
                      <a href="php-tcpdf-monthly-tableHTML.php?subjectId=<?php echo $subjectId ?>&deptid=<?php echo $deptid ?>&teacherName=<?php echo $teacherName ?>&total_students=<?php echo $row1[0] ?>" target="_blank">Overall PDF Report</a>
                    </div>

                  <?php    }
                } else { ?>
                  <div class="containerop">
                    <label>An unexpected error occured!</label>
                  </div>
                <?php  }
              } else { ?>
                <div class="containerop">
                  <label>Kindly select all the values...</label>
                </div>
            <?php   }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>



</html>