<?php
session_start();

include 'connect.php';
// print_r($_SESSION);
if ($_SESSION["id"] == '') {
  header('Location:index.html');
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="./css/main.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="./css/onlynavcss.css" /> -->
  <!-- <link rel="stylesheet" href="./css/util.css" /> -->
  <link rel="stylesheet" href="./css/dash.css" />
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
      <div class="div-for-card">
        <div class="cards-list">
          <div class="card 1">
            <div class="card_image">
              <a class="addman-link" href="qr.php"><img src="./images/checklist(1).png" /></a>
            </div>
            <div class="card_title title-white">
              <p>Take Attendance</p>
            </div>
          </div>

          <div class="card 2">
            <div class="card_image">
              <a class="addman-link" href="checkmain.php"><img src="./images/timetable.png" /></a>
            </div>
            <div class="card_title title-white">
              <p>Check Attendance</p>
            </div>
          </div>

          <div class="card 3">
            <div class="card_image">
              <a class="addman-link" href="addmanually.php"><img id="addman" src="./images/resume.png" /></a>
            </div>
            <div class="card_title">
              <p>Add manually</p>
            </div>
          </div>

          <!-- <div class="card 4">
            <div class="card_image">
              <a class="addman-link" href="#"><img src="./images/building.png" /></a>
            </div>
            <div class="card_title title-black">
              <p></p>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>

</body>

</html>