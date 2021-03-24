
<?php
session_start();

include 'connect.php';
// print_r($_SESSION);
if($_SESSION["id"]==''){
  header('Location:index.html');
}
if($_SESSION['isteacher']=='true'){

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>


    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./css/dash.css">
    <link rel="stylesheet" href="./css/add_man.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="./css/onlynav.css"> -->
<title>Document</title>
</head>
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
               <div class="div-logo-add">
                   <h1 class="logo-add">
                        Add Manually
                   </h1>
                </div> 
                <form action="addatt.php">
                <div class="content">
                    
                    <input type="text" class="input1" name="session" method="GET" placeholder="Session ID" >
                    <input type="text" class="input1" name="subjectid" method="GET" placeholder="Subject ID">
               <input type="text" class="input1" name="moodleid" method="GET" placeholder="Moodle ID"> 
                 <input type="text" class="input1" name="deptid" method="GET" placeholder="Department ID">
                      <!-- <input type="text" class="input1" name="techerid" method="GET" placeholder="Teacher ID">
                    <input type="password" class="input1" name="pass" method="GET" placeholder="Teacher Password"> -->
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

<?php  }
else {
  header('Location:dashboard.php');
} ?>