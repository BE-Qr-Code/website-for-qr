<?php
session_start();
include 'connect.php';
if($_SESSION['isteacher']=='true')
{
    header('Location:check.php');

}
else{

    header('Location:checkatt.php');
}

?>