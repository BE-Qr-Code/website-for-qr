<?php
session_start();
print_r($_SESSION);
//before destroying the session
//printing the session
if(isset($_SESSION['id'])){
unset($_SESSION['id']);
unset($_SESSION['deptid']);
unset($_SESSION['name']);
unset($_SESSION['isteacher']);
session_destroy();
echo 'Session destroyed';
}
else{
    echo 'no session';
}
//after destroying the session
//printing the session
print_r($_SESSION);

?>