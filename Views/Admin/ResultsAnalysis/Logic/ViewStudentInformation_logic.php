<?php session_start();
require_once('../../../Model/PDO.php');

$errors=array();
$success=array(); 
 if($_POST && $_POST['Confirm_delete_info']){
         
        if(!empty($_POST['Confirm_delete_info'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin" || $_SESSION["role"]=="hod" ){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `student` WHERE `student`.`StudentComputerID` = ".$_POST['Confirm_delete_info']);
                  $stmt->execute();
                          
                          array_push($success,"Successful deleted !!!");
            
              } 
               
               } catch (Exception $e)
            {
               array_push($errors,"Student results deleted failed");
                   array_push($errors,$e->getMessage());
                 
                }

 
            
        }
        
    }


?>
