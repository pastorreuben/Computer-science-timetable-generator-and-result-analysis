<?php 
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();
$success=array(); 

$data="";
//function to fine the Average entry from the gradebook table and accepting auguments  database Connection and course Id 
function CalcuteAverage($DBConnect,$course_ID){
    $stmt=0;
    $courseCode=$course_ID;
    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT AVG(`TotalQuiz(%)`) as quiz, AVG(`TotalLabs(%)`) as lab, AVG(`TotalAssigment(%)`) as asign, AVG(`Test_1(%)`) as test1, AVG(`Test_2(%)`) as test2, AVG(`Test_3(%)`) as test3, AVG(`ProjectsTotal(%)`) as project FROM `gradebook` WHERE `CourseID` =$course_ID");
    $stmt->execute();
    
    return $stmt;
}

//function to fine the Minimum entry from the gradebook table and accepting auguments  database Connection and course Id 
function CalcuteMinimum($DBConnect,$course_ID){
    $stmt=0;
    $courseCode=$course_ID;
    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT min(`TotalQuiz(%)`) as quiz, min(`TotalLabs(%)`) as lab, min(`TotalAssigment(%)`) as asign, min(`Test_1(%)`) as test1, min(`Test_2(%)`) as test2, min(`Test_3(%)`) as test3, min(`ProjectsTotal(%)`) as project FROM `gradebook` WHERE `CourseID` =$course_ID");
    $stmt->execute();
    
    return $stmt;
}
//function to fine the maximum entry from the gradebook table and accepting auguments  database Connection and course Id 
function CalcuteMaximum($DBConnect,$course_ID){
    $stmt=0;
    $courseCode=$course_ID;
    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT max(`TotalQuiz(%)`) as quiz, max(`TotalLabs(%)`) as lab, max(`TotalAssigment(%)`) as asign, max(`Test_1(%)`) as test1, max(`Test_2(%)`) as test2, max(`Test_3(%)`) as test3, max(`ProjectsTotal(%)`) as project FROM `gradebook` WHERE `CourseID` =$course_ID");
    $stmt->execute();
    
    return $stmt;
}
function  checkCourse($course_ID,$DBConnect){
    $courseCode=$course_ID;
      $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $DBConnect->prepare("SELECT `CourseCode` FROM `courses` WHERE `CourseID`=$course_ID");
      $stmt->execute();
     if($stmt->rowCount()>0 )
     {
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
                $courseCode=$row['CourseCode'];
          }
     }
    return $courseCode;

}                                       
      

if($_POST) {
        if(isset($_POST['btn_analyse']) && $_POST['selectCourse']!=-1 ){
            
        try{



            $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $DBConnect->prepare("SELECT `GradeBookID`, gradebook.`StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grades`.`gradeValue`, `ResultsYear`, FullNames FROM `gradebook` inner JOIN grades on grade=grades.Id inner join student on gradebook.`StudentComputerID`=student.`StudentComputerID` WHERE  `CourseID`=".$_POST['selectCourse']." order bY CourseID ASC");
            $stmt->execute();
             
            if($stmt->rowCount()>0 )
            {
                $show=true;
                $selected=$_POST['selectCourse'];
            }

        }catch(Exception $e){
            array_push($errors, $e->getMessage()."<br/>"); 
            $DBConnect->$close();

        } 

  
            
        }
       } 


//Delete from viewSELECT `StudentComputerID`, `Gander`, `YearOfStudy` FROM `student`ORDER by StudentComputerID DESC

    if($_POST && isset($_POST['Confirm_delete'])){
         
        if(!empty($_POST['Confirm_delete'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin"){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `gradebook` WHERE `gradebook`.`GradeBookID` = ".$_POST['Confirm_delete']);
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