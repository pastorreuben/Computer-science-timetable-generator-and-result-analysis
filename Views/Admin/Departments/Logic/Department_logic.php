<?php

require_once('../../../Model/PDO.php');
//require_once('Logic/validate_user_input.php');
$errors=array();
$success=array(); 



//Delete from view

if($_POST){
    if(isset($_POST['Confirm_delete_user']) ){
        if($_POST['Confirm_delete_user']){
           try { 
             

            $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $DBConnect->beginTransaction();
           
                $stm = $DBConnect->prepare("SELECT `LecturesID` FROM `lecturers` WHERE LecturerComputer=".$_POST["Confirm_delete_user"]);
                $stm->execute();
           
            if($stm->rowCount()>0){
              
                 $stmt = $DBConnect->prepare("DELETE FROM `lecturers` WHERE `LecturerComputer`=".$_POST["Confirm_delete_user"]);
                 $stmt->execute();
                if($stmt->execute()){
                   $stmt = $DBConnect->prepare("DELETE FROM `users` WHERE `UserComputerID`=".$_POST["Confirm_delete_user"]);
                   $stmt->execute(); 
                }else {
                    array_push($errors,"User could Not be  deleted ");
                      $DBConnect->rollBack();
                }
                 
               
            }else{
                 $stmt = $DBConnect->prepare("DELETE FROM `users` WHERE `UserID`=".$_POST["Confirm_delete_user"]);
                 $stmt->execute();
                
           
            }
               
               $DBConnect->commit();
               array_push($success,"Successful deleted user from the System!!!");

            } catch (Exception $e) 
            {
                array_push($errors,"User could Not be  deleted ");
                array_push($errors,$e->getMessage());
                $DBConnect->rollBack();
            } 
        }
       
    }
    if(isset($_POST['Confirm_delete_Student'])){

     
    if($_POST && $_POST['Confirm_delete_Student']){
         
        if(!empty($_POST['Confirm_delete_Student'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin" || $_SESSION["role"]=="hod"){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `student` WHERE `student`.`StudentComputerID` = ".$_POST['Confirm_delete_Student']);
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



    }
    if(isset($_GET['Confirmdelete2'])){


      try { 

          $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          // 

         //  $DBConnect->beginTransaction();

          $stmt = $DBConnect->prepare("DELETE FROM `ca_marks` WHERE `CA_MarksID`=".$_GET["Confirmdelete2"]);
          $stmt->execute();

          // $DBConnect->commit();

           array_push($success,"Courses C.A Overall Mark Successful deleted");


            } catch (Exception $e){
                array_push($errors,"Courses C.A Overall Mark deleted failed");
                array_push($errors,$e->getMessage());
                //   $DBConnect->rollBack();
            }



    }
}



try{

    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT `LecturesID`, `UsersID`, `LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerPhoto`, `LecturerAccountStatus` , `UserRoleName` FROM `lecturers` inner join userrole on lecturerRole=`UserRoleID`");
    $stmt->execute();
    $stmt1 = $DBConnect->prepare("SELECT `UserID`, `UserComputerID` FROM `users` ORDER BY UserID DESC");
    $stmt1->execute();

    $stmt2 = $DBConnect->prepare("SELECT `UserRoleID`, `UserRoleName`, `UserRoleDescription` FROM `userrole` WHERE 1");
    $stmt2->execute();

   $stmt3 = $DBConnect->prepare("SELECT `StudentComputerID`, `FullNames`, `Gander`, `YearOfStudy`, `StudentStatus` FROM `student` WHERE 1");
   $stmt3->execute();//for grades

    

}catch(Exception $e){
    array_push($errors, $e->getMessage()."<br/>"); //$DBConnect->close();

} 






?>