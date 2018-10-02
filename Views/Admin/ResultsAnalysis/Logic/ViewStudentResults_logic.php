<?php

require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();
$success=array(); 



//Delete from viewSELECT `StudentComputerID`, `Gander`, `YearOfStudy` FROM `student`ORDER by StudentComputerID DESC

    if($_POST && isset($_POST['Confirm_delete_viewsStudent'])){
         
        if(!empty($_POST['Confirm_delete_viewsStudent'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin" || $_SESSION["role"]=="hod"){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `gradebook` WHERE `gradebook`.`GradeBookID` = ".$_POST['Confirm_delete_viewsStudent']);
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



try{



    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // $stmt = $DBConnect->prepare("SELECT `GradeBookID`, `StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`,`Test_3(%)`, `ProjectsTotal(%)`, `ResultsYear` FROM `gradebook` WHERE  `CourseID`=2 order bY CourseID ASC");
     $stmt = $DBConnect->prepare("SELECT `GradeBookID`, `StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grades`.`gradeValue`, `ResultsYear` FROM `gradebook` inner JOIN grades on grade=grades.Id order bY CourseID ASC");
    $stmt->execute();

}catch(Exception $e){
    array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

} 

  


?>