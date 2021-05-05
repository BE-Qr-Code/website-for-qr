<?php
session_start();

include 'connect.php';
// print_r($_SESSION);
if ($_SESSION["id"] == '') {
  header('Location:index.html');
}
$techid = $_SESSION["id"];

if ($_SESSION['isteacher'] == 'true') {
  $deptid = $_SESSION['deptid'];
  $name = $_SESSION['name'];
?>
  <!DOCTYPE html>
  <html>

  <head>
    <title>Generate QR</title>

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="css/styles.css"> -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/dash.css">
    <link rel="stylesheet" href="./css/add_man.css" class="css">
    <link rel="stylesheet" href="./css/qr.css" class="css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="./css/onlynavcss.css" class="css"> -->

    <style>

    </style>
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


    <!-- container-fluid -->
    <div class="container-login100" style="background-image: url('images/bg5.jpg');">
      <div class="altbox">
        <div class="row justify-content-center main-form">

          <form>
            <div class="cont-qr">
              <div class="b">
                <?php
                // random alphanumeric string
                $randomSessionID = substr(md5(microtime()), 0, 6);
                echo "<script>console.log(\"$randomSessionID\")</script>";

                // $sessioniddef = "SELECT SessionID from qrcode ORDER BY SessionID DESC limit 1  ;";
                // if ($resultsess = mysqli_query($connection, $sessioniddef)) {
                //   $rowres = mysqli_fetch_array($resultsess);
                //   if ($rowres > 1)
                //     $val = $rowres[0] + rand(10, 90);
                //   else {
                //     // echo 0;

                //     $val = 1110;
                //   }
                //   // echo $rowres[0];
                // }


                ?>
                <p class="label-text">Session:</p>
              </div>
              <div class="a">
                <input type="text" id="session" class="input2" value=<?php echo $randomSessionID ?>>
              </div>
            </div>

            <div class="cont-qr">
              <div class="b">
                <p class="label-text">Subject:</p>
              </div>
              <div class="a">
                <!-- <input type="text" id="subjectid" class="input2"> -->
                <select name="subject" id="subj_options" for="Select Subject" method=POST>
                  <option disabled selected>Select Subject</option>
                  <?php
                  include "connect.php";  // Using database connection file here
                  $id = $_SESSION['id'];
                  $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='$id'");  // Use select query here 

                  if ($result->num_rows > 0) {
                    while ($data = $result->fetch_assoc()) {
                      $id = $data['SubjectID'];
                      echo "<option value='$id'>$id</option>";
                    }
                  }


                  //Do what you need with this value, then echo what you want to be returned.


                  ?>
                </select>
              </div>
            </div>
            <div class="cont-qr">
              <div class="b">

                <p class="label-text">QrCode:</p>
              </div>
              <div class="a">
                <input type="text" id="qrcode" class="input2" placeholder="" id="qr">
              </div>
            </div>
            <div class="cont-qr">
              <div class="b">
                <p class="label-text">Dept. ID:</p>
              </div>
              <div class="a">
                <!-- <input type="text" id="department" class="input2"> -->
                <?php
                // include "connect.php";  // Using database connection file here
                // $id = $_SESSION['id'];
                // $result = mysqli_query($connection, "SELECT DepartSID from Subjects where TeacherID='$id'");  // Use select query here 

                // if ($result->num_rows > 0) {
                //   $data = $result->fetch_assoc();
                // $id = $data['DepartSID'];
                echo "<input type=\"text\" id=\"department\" class=\"input2\" value=\"$deptid\" readonly>";
                // }
                ?>

              </div>
            </div>

            <div class="viewcount">
              <button id="count"></button>

              <!-- <p id="count" class="count"></p> -->
            </div>
          </form>
        </div>

        <div class="row generateButton">
          <div class="col-md-4 d-flex justify-content-center">
            <button type="submit" class="btn btn-dark generateButton" onclick="generateQR()">Generate QR</button>
          </div>
        </div>



        <div class="row qrDiv" style="margin-bottom: 15px;">

          <div id="qr_display">
          </div>
        </div>
        <div id="divToPrint" style="display:none;">



          <div id="c" style="width:900px;height:1000px; display:flex; flex-direction:row; margin:5vh; font-size:25px;">
            >

            <div id="n" style="width:700px; height:700px;display:flex;flex-direction:column">

              <div style="display:flex; flex-direction:row">
                <p style=" height:20px;margin:2vh;">Prof. name:<?php echo $name; ?></p>
                <p style=" height:20px;margin:2vh;">Subject:
                <p style=" height:20px;margin:2vh;" id="subject"></p>
                </p>
                <p style=" height:20px;margin:2vh;">lect number:
                <p style=" height:20px;margin:2vh;"  id="lectNumber"></p>
                </p>


              </div>
              <div style="display:flex; flex-direction:row">
                <p style=" height:20px;margin:2vh;">Sr. no</p>
                <p style=" height:20px;margin:2vh;">Moodle ID</p>
                <p style="height:20px; margin:2vh;">Name</p>

              </div>
              <p>___________________________</p>
              <div style="display:flex; flex-direction:row">
                <div id="sr" style="margin:2vh;"></div>
                <div id="moodleid" style="margin:2vh;"></div>
                <div id="pdfname" style="margin:2vh;"></div>
              </div>
            </div>
          </div>
        </div>




        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <!-- <script data-main="scripts/main" src="scripts/require.js"></script> -->
        <script src="qrcode.min.js"></script>
        <script src="index.js"></script>
        <script src="report.js"></script>

  </body>

  </html>

<?php
} else {
  header("Location:dashboard.php");
}
?>