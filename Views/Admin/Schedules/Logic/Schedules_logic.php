<?php

require_once('../../../Model/PDO.php');
$errors=array();
$success=array(); 



//Delete from view

    if($_GET && $_GET['Confirm_delete']){
         
        if(!empty($_GET['Confirm_delete'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin"){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `scheduledtime` WHERE `scheduledtime`.`SecheduledID` = ".$_GET['Confirm_delete']);
                  $stmt->execute();
                          
                          array_push($success,"Successful deleted !!!");
            
              } 
               
               } catch (Exception $e)
          {
               array_push($errors,"lecturer deleted failed");
                   array_push($errors,$e->getMessage());
                 
                }

 
            
        }
        
    }



try{



          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $DBConnect->prepare("SELECT `SecheduledID`, `SecheduledDay`, `SecheduledTime` FROM `scheduledtime` order by SecheduledID desc");
       $stmt->execute();
     
        }catch(Exception $e){
        array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

       } 




?>