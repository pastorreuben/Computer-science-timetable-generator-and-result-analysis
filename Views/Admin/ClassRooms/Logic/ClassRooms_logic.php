<?php

require_once('../../../Model/PDO.php');
$errors=array();
$success=array(); 



//Delete from view

    if($_GET){
        if(isset($_GET['Confirm_delete'])){
            
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              // 
              
            $DBConnect->beginTransaction();
            $stmt = $DBConnect->prepare("DELETE FROM `classrooms` WHERE `ClassRoomID`=".$_GET['Confirm_delete']);
            
              $stmt->execute();
              
            
               $DBConnect->commit();
              
               array_push($success,"Successful deleted !!!");
             
          
                } catch (Exception $e){
               array_push($errors,"lecturer deleted failed");
                   array_push($errors,$e->getMessage());
                  $DBConnect->rollBack();
                }




            
            
            
        }
        
 /*       if(isset($_GET['Confirmdelete2'])){
            
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
              // 
              
             //  $DBConnect->beginTransaction();
            
              $stmt = $DBConnect->prepare("DELETE FROM `ca_marks` WHERE `CA_MarksID`=".$_GET["Confirmdelete2"]);
              $stmt->execute();
            
              // $DBConnect->commit();
              
               array_push($success,"Courses C.A Overall Mark Successful deleted");
             
          
                } catch (Exception $e) 
          {
               array_push($errors,"Courses C.A Overall Mark deleted failed");
                   array_push($errors,$e->getMessage());
               //   $DBConnect->rollBack();
                }




            
            
            
        }*/
    }



try{

          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
          $stmt = $DBConnect->prepare("SELECT `ClassRoomID`, `ClassRoomName`, `ClassRoomCapacity` FROM `classrooms`");
       $stmt->execute();
    
  
     
        }catch(Exception $e){
        array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

       } 




?>