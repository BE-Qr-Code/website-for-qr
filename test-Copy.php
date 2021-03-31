<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href=".animsition/animsition.css">
      <title>Document</title>
  </head>
  <body>
    <form action="" method="post">
      <select name="subject" id="subj_options">
          <option >-- Select City --</option>
          <?php
            include "connect.php";  // Using database connection file here
            $result = mysqli_query($connection, "SELECT SubjectID from Subjects where TeacherID='CS1'");  // Use select query here 

            if ($result->num_rows>0) {
              while($data = $result->fetch_assoc()){ 
                $id = $data['SubjectID'];
                echo "<option value='$id'>$id</option>"; 
               }
            }      
          ?>          
      </select>
      <input type="submit" name="submit" value="Get Value"></input>
    </form>  

      <?php
        if(isset($_POST['submit'])){
          if(!empty($_POST['subject'])) {
            $selected = $_POST['subject'];
            echo 'You have chosen: '.$selected;
          }
          else {
            echo 'Please select the value.';
          }
        }
      ?>
  </body>
</html>