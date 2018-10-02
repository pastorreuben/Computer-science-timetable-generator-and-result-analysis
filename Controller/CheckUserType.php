<?php

public class ValidateUser
{
    function _const ValidateUser()
    {
        
    }
    
     function checkrole($role)
           {
                if($_SESSION["role"]!=$role && empty($_SESSION["username"])){
                    header('location:../Users/Login.php');
                    die;
                }
           }
    function logoutUser($Logout){
         //checking that users are Login or Logout users
            if(isset($_POST[$Logout])){
              unset($_SESSION["username"]);
                 unset($_SESSION["role"]);
            session_destroy();

            }

    }
}
           

           
          


 ?>