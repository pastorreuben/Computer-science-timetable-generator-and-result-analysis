<?php
$time = $_SERVER['REQUEST_TIME'];

/**
* for a 15 minute timeout, specified in seconds
*/
$timeout_duration = 900;

/**
* Here we look for the user's LAST_ACTIVITY timestamp. If
* it's set and indicates our $timeout_duration has passed,
* blow away any previous $_SESSION data and start a new one.
*/
if (isset($_SESSION['LAST_ACTIVITY']) && 
   ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/**
* Finally, update LAST_ACTIVITY so that our timeout
* is based on it and not the user's login time.
*/
$_SESSION['LAST_ACTIVITY'] = $time;



require_once('../../../Model/PDO.php');
            //checking that users are Login or Logout users
            if(isset($_POST['Logout'])){
              unset($_SESSION["username"]);
                 unset($_SESSION["role"]);
                unset($_SESSION["userid"]);
            session_destroy();

            }
        
         //checking that  Login user Role is Admin else redirect to Login.php$_SESSION["userid"]
            if(!($_SESSION["role"]=="staff" || $_SESSION["role"]=="admin" ) && empty($_SESSION["username"]) && empty($_SESSION["userid"])){
                header('location:../../Users/Login.php');
                die;
            }


?>
