<?php
session_start();

include 'connect.php';
// print_r($_SESSION);
$moodleid = $_SESSION["id"];
echo $moodleid;
if ($_SESSION["id"] == '') {
  header('Location:index.html');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Check attedance </title>
  <link rel="stylesheet" href="./css/main.css" class="css">
  <link rel="stylesheet" href="./css/dash.css">
  <link rel="stylesheet" href="./css/checkatt.css" class="css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="stylesheet" href="./css/add_man.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">

  <!-- <script type="text/javascript">
   function showHide() {
     var div = document.getElementById('hidden_div');
     if (div.style.display == 'none') {
       div.style.display = '';
     }
     else {
       div.style.display = 'none';
     }
  
  </script> -->

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
    <div class="welcome">

      <li>
        <p class="welcomemsg">Welcome <?php echo $_SESSION['name']; ?> !</p>
      </li>
    </div>
  </nav>
  <div class="container-login100" style="background-image: url('images/bg5.png');">
    <div class="div-for-card">
      <div class="altbox">

        <form action='studentcheck.php'>
          <div class="outerbox">
            <div class="content5">
              <input type="text" class="subjectid" name="subjectid" method="GET" placeholder="Subject ID" required>


              <!-- </div> -->
              <!-- <div class="btn2"> -->
              <button id='login-btn' type="submit" class="login100-form-btn">
                SUBMIT
              </button>
            </div>




        </form>
      </div>
    </div>
  </div>
  </div>

</body>
</head>

</html>

<?php


?>
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check attedance </title>
    <link rel="stylesheet" href="./css/main.css" class="css">
    <link rel="stylesheet" href="./css/dash.css">
    <link rel="stylesheet" href="./css/checkatt.css" class="css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="./css/add_man.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet"> -->

<!-- <script type="text/javascript">
 function showHide() {
   var div = document.getElementById('hidden_div');
   if (div.style.display == 'none') {
     div.style.display = '';
   }
   else {
     div.style.display = 'none';
   }
 }
</script> -->
<!-- </head>
<body>
    <nav class="nav-class">
        <div class="logo-for-attendance">
          <h4>ATTENDANCE</h4>
        </div>
        <ul class="nav-links">
          <li><a href="dashboard.php">Menu  |</a></li>
          <li>
            <a href="qr.html">Generate QR Code |</a>
          </li>
          <li><a href="logout.php">Log Out</a></li>
        
          
         
        </ul>
        <div class="welcome">

<li><p class="welcomemsg">Welcome <?php echo $_SESSION['name']; ?> !</p></li>
</div> 
      </nav>
    <div class="container-login100" style="background-image: url('images/bg5.png');">
        <div class="div-for-card" >
            <div class="altbox">
            
                <form action='studentcheck.php'>
               
                    <div class="content">
                        <input type="text" class="input1" name="subjectid" method="GET" placeholder="Subject ID" required>
                        
                        
                    </div>
                        <div class="btn2">
                        <button id='login-btn' type="submit"  class="login100-form-btn">
                            SUBMIT
                        </button>
                    </div>
                 



                </form>
            </div>
        </div>
    </div>

</body>
</html>
<body>
      <nav class="nav-class">
          <div class="logo-for-attendance">
            <h4>ATTENDANCE</h4>
          </div>
          <ul class="nav-links">
            <li><a href="dashboard.php">Menu  |</a></li>
            <li>
              <a href="qr.html">Generate QR Code |</a>
            </li>
            <li><a href="logout.php">Log Out</a></li>
          
            
           
          </ul>
          <div class="welcome">
  
  <li><p class="welcomemsg">Welcome <?php echo $_SESSION['name']; ?> !</p></li>
  </div> 
        </nav>
      <div class="container-login100" style="background-image: url('images/bg5.png');">
          <div class="div-for-card" >
              <div class="altbox">
              
              <form action="check.php" method="post">
      <select name="subject" id="subj_options">
          <option --disabled >-- Select City --</option>
          <?php
          include "connect.php";  // Using database connection file here
          $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='$moodleid'");  // Use select query here 

          if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
              $id = $data['SubjectID'];
              echo "<option value='$id'>$id</option>";
            }
          }
          ?>          
      </select>
      <input type="submit" name="submit" value="Get Value"></input>
    </form>  

       <?php
        if (isset($_POST['submit'])) {
          if (!empty($_POST['subject'])) {
            $selected = $_POST['subject'];
            // echo 'You have chosen: '.$selected;
          } else {
            echo 'Please select the value.';
          }
        }
        ?>
   
  
                  </form>
              </div>
          </div>
      </div>
  
  </body>
 -->