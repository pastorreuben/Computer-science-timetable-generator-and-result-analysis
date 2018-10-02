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
              if($_SESSION["role"]=="staff"){
                  $stmt = $DBConnect->prepare("DEsLETE FROM `users` WHERE `UserID`=(SELECT`UsersID` FROM `lecturers` WHERE `LecturesID`=".$_GET['Confirm_delete'].")");
              }else
              
              if($_SESSION["role"]=="admin"){
                /*   $stmt1 = $DBConnect->prepare("SELECT `CourseID` FROM `courses` WHERE `CourseLecturerID`=".$_GET['Confirm_delete']);
                  $stmt1->execute();
               array_push($errors,"------1");
                   if($stmt1->rowCount()>0)
                    {
                        array_push($errors,"------2");
                       while( $row=$stmt1->fetch(PDO::FETCH_ASSOC)) 
                      {array_push($errors,"------3");
                           $stmt2 = $DBConnect->prepare("UPDATE `courses` SET `CourseLecturerID` = 'NULL' WHERE `courses`.`CourseID` =".$row['CourseID']);
                          $stmt2->execute();*/
              
                           $stmt = $DBConnect->prepare("DELETE FROM `lecturers`  WHERE `LecturesID`=".$_GET['Confirm_delete']);
                          $stmt->execute();
                          
                          $DBConnect->commit();
                          /*array_push($success,"Successful deleted !!!");
             
          
                     }
                    }*/
                 
              } 
               
                } catch (Exception $e)
          {
               array_push($errors,"lecturer deleted failed");
                   array_push($errors,$e->getMessage());
                  $DBConnect->rollBack();
                }

 
            
        }
        
    }



try{



          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $DBConnect->prepare("SELECT `LecturesID`, `UsersID`, `LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerPhoto`, `LecturerAccountStatus` FROM `lecturers` ");
       $stmt->execute();
     
        }catch(Exception $e){
        array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

       } 




?>