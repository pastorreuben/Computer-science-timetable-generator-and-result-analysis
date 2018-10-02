
<?php

require_once('../../../Model/PDO.php');
$errors=array();
$success=array(); 



//Delete from view

    if($_GET){
        if(isset($_GET['btn_View_link'])){
           
try{



          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $DBConnect->prepare("SELECT `LecturesID`, `UsersID`, `LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerPhoto`, `LecturerAccountStatus`, userrole.UserRoleName FROM `lecturers` inner JOIN userrole on lecturers.LecturerRole=userrole.UserRoleID where LecturesID=".$_GET['value']);
       $stmt->execute();
     
        }catch(Exception $e){
        array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

       } 

  }
 }


?>