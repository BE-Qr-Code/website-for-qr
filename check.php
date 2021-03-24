<?php

session_start();

include 'connect.php';

$id = $_SESSION['id'];
$deptid = $_SESSION['deptid'];
// $subjectid = $_POST['subject'];
if(isset($_GET['submit'])){
    // $subjectid = $_GET['subject'];
// echo "\n".$subjectid; 
}
echo
 print_r($_SESSION);
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
     <link href="https:fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    
 </head>
 <body>
     <nav class="nav-class">
         <div class="logo-for-attendance">
             <h4>ATTENDANCE</h4>
         </div>
         <ul class="nav-links">
             <li><a href="dashboard.php">Menu |</a></li>
             <li>
                 <a href="qr.html"> Generate QR Code |</a>
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
             <div class="outerbox">


                    <!-- style="display:none" -->
                <!-- </form> -->
                <form action="" method="post">
                    <div class="selectcontainer">
      <select name="subject" id="subj_options" for="Select Subject">
          <option disabled selected>Select Subject</option>
          <?php
            include "connect.php";  // Using database connection file here
            $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='$id'");  // Use select query here 

            if ($result->num_rows>0) {
              while($data = $result->fetch_assoc()){ 
                $id = $data['SubjectID'];
                echo "<option value='$id'>$id</option>"; 
               }
            }
              
          ?>          
      </select>
      <input type="submit" name="submit" class="dropbtn" value="Get Result"></input>
      </div>
    </form>  

    <?php
        if(isset($_POST['submit'])){
          if(!empty($_POST['subject'])) {
            $selected = $_POST['subject'];
           
   
        
    
            include 'connect.php';
    if ($result = mysqli_query($connection, "SELECT count(*), DepartAID, SubjectID FROM attendance where DepartAID='$deptid' AND SubjectID='$selected' GROUP BY DepartAID,SubjectID ;")) {
        if (mysqli_num_rows($result) > 0) {
            // echo $selected;
            $name= $_SESSION['name'];
            $row = mysqli_fetch_array($result);
            // print_r($row);
            // echo '</br>';
            // echo "calculating...";
            if ($result1 = mysqli_query($connection, "SELECT count(MoodleID) from registration where DepartID = (select DepartID from Subjects where SubjectID='$selected');")) {

                $row1 = mysqli_fetch_array($result1);
                $r = $row1[0] - $row[0];

            ?>
           
                 <div class="containerop">
                <label for="subjectid" class="labelclass">Prof.:</label>
                <input type="text" class="input3"  value="<?php echo($name); ?>" readonly>
                </div>
                 <div class="containerop">
                <label for="subjectid" class="labelclass">SUBJECT:</label>
                <input type="text" class="input3"  value="<?php echo "$row[2]";?>" readonly>
                </div>
                 <div class="containerop">
                <label for="present" class="labelclass">PRESENT:</label>
                <input type="text" class="input3"  value="<?php echo "$row[0]";?>" readonly>
                </div>
                 <div class="containerop">
                <label for="subjectid" class="labelclass">ABSENT:</label>
                <input type="text" class="input3"  value="<?php echo "$r";?>" readonly>
                </div>
                 <div class="containerop">
                <label for="subjectid" class="labelclass">TOTAL:</label>
                <input type="text" class="input3"  value="<?php echo "$row1[0]";?>" readonly>
                </div>
                </div>
                <!-- <input type="button" value="Back" class="checkbtn" onclick="history.back(-1)" readonly> -->
            
            
            
             </div> 
             <!-- </div> -->
         
     </div>
     </div>
 </body>
 </html> 








<?php


                

            
            }
        }
        else{
            $row[2]=$selected;
            $row[0]=0;
            $row1[0]=0;
            $r=0;
            $name= $_SESSION['name'];
            ?>
             <!-- <div class="outerbox"> -->
            <div class="containerop">
            <label for="subjectid" class="labelclass">Prof. Name:</label>
            <input type="text" class="input3"  value="<?php echo($name); ?>" readonly>
            </div>
             <div class="containerop">
            <label for="subjectid" class="labelclass">SUBJECT:</label>
            <input type="text" class="input3"  value="<?php echo "$row[2]";?>" readonly>
            </div>
             <div class="containerop">
            <label for="present" class="labelclass">PRESENT:</label>
            <input type="text" class="input3"  value="<?php echo "$row[0]";?>" readonly>
            </div>
             <div class="containerop">
            <label for="subjectid" class="labelclass">ABSENT:</label>
            <input type="text" class="input3"  value="<?php echo "$r";?>" readonly>
            </div>
             <div class="containerop">
            <label for="subjectid" class="labelclass">TOTAL:</label>
            <input type="text" class="input3"  value="<?php echo "$row1[0]";?>" readonly>
            </div>
             <!-- </div> -->
<?php
        }
    }
}
        }




?>







