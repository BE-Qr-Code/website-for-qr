<?php



session_start();

use const PHPSTORM_META\ANY_ARGUMENT;

include 'connect.php';
$id = $_SESSION['id'];
$sub = $_POST['subjectid'];

// echo "\n" . $subjectid;

// echo $id;
// function getDateAll($rows2){
//   $r = array_merge($rows2);

//   return $r;
// }
function getSession()
{
  include 'connect.php';
  $sub = $_POST['subjectid'];
  $id = $_SESSION['id'];
  $query1 = "SELECT SessionID from attendance where MoodleID='$id'";
  $result = mysqli_query($connection, $query1);
  $r1 = array();
  if(mysqli_num_rows($result) == 0) header('Location:report.php');
  while ($rows = mysqli_fetch_array($result)) {

    // print_r($rows);
    // echo "</br>";
    // $count=count($rows);
    // $rows = mysqli_fetch_array($result);
    // print_r($rows);
    // echo $rows['SessionID'];

    // for($i=0 ; $i<count($rows) ; $i++){
    $i = 0;
    $r = $rows[0];
    $query2 = "SELECT SubjectQID,qrdate from qrcode where SessionID='$r' AND SubjectQID='$sub'";
    $result2 = mysqli_query($connection, $query2);
    $rows2[$i] = mysqli_fetch_array($result2);
    // echo "</br>";
    // print_r($rows2[$i]);

    // }
    // }
    //  getdate($rows2);

    $r1 = array_merge($rows2[$i], $r1);
    sort($r1);
    $r1 = array_unique($r1);
    // print_r($r1);
    $i = $i + 1;
  }

  return $r1;
}
function details()
{
  $d = array();
  include 'connect.php';
  $id = $_SESSION['id'];

  $query3 = "SELECT fname,lname,DepartID from registration where MoodleID ='$id'";
  $result3 = mysqli_query($connection, $query3);
  $row3 = mysqli_fetch_array($result3);
  // print_r($row3);
  return $row3;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check attedance </title>
  <link rel="stylesheet" href="./css/main.css" class="css">
  <link rel="stylesheet" href="./css/checkatt.css" class="css">
  <link rel="preconnect" href="https:fonts.gstatic.com">
  <link rel="stylesheet" href="./css/add_man.css">
  <link href="https:fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="./css/report.css" class="css">

  <title>Report</title>
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


  </nav>
  <div class="limiter">
    <div class="container-login100" style="background-image: url('images/bg5.jpg');">
      <div class="report-box">
        <div class="header">
          <h1>MONTHLY REPORT</h1>
        </div>
        <div class="cont-rep">
          <div class="details">
            <?php
            $d =  details(); ?>
            <!-- <div class="row1"> -->
            <div style="width:550px;">
              <p class="d"> Name: <?php echo $d['fname'] . " " . $d['lname']; ?></p>
            </div>
            <div class="details-outer">
              <p class="d" value="<?php echo $id; ?>"> Moodle:
              <p id="id"> <?php echo $id; ?></p>
              </p>
            </div>
            <div class="details-outer">
              <p class="d" value="<?php echo $sub; ?>">Subject:
              <p id="sub"><?php echo $sub; ?>
              <p></p>
            </div>
            <div class="details-outer">
              <p class="d" value="<?php echo $d['DepartID']; ?>">Department:
              <p id="dep"><?php echo $d['DepartID']; ?></p>
              </p>
            </div>
            <!-- </div> -->


          </div>
          <div class="out">
            <div class="months-cont">

              <?php $rows2 = getSession();
              // print_r($rows2);
              $index = -1;
              foreach ($rows2 as $i) {
                $index++;
                if (DateTime::createFromFormat('Y-m-d', $i) !== false) {
                  // it's a date
                  $date = DateTime::createFromFormat('Y-m-d', $i);
                  $m[$index] = $date->format('F');

                  $m =  array_unique($m);
                  // $mon = date('m', $i) . " ";
                  // echo $m;
                  // echo "date";
                  // print_r($m);
              ?>

                <?php

                }
              }
              foreach ($m as $i) {
                ?>

                <div class="month-box">

                  <button class="month" id="<?php echo $i ?>" onclick="rep(this.id)" value="<?php echo $i ?>"><?php echo $i ?></php></button>
                </div>
              <?php }          ?>
            </div>
            <div class="det">

              <div class="detmin">
                <p>Number of Lectues attended:
                <p id="AT">
                </p>
                </p>
              </div>
              <hr class="solid">
              <div class="detmin">
                <p>Number of Lectues absent:
                <p id="AB">
                </p>
                </p>
              </div>
              <hr class="solid">

              <div class="detmin">
                <p>Total Lectues:
                <p id="T">
                </p>
                </p>
              </div>
              <hr class="solid">
              <div class="detmin">
                <p>Percentage:
                <p id="P">
                </p>
                </p>
              </div>
              <hr class="solid">
            </div>
          </div>

          <!-- <button class="btn btn-dark">komal</button> -->



        </div>

      </div>
    </div>

  </div>
  <script src="report.js"></script>
  <script src="./vendor/jquery/jquery-3.2.1.min.js"></script>
</body>

</html>