<?php

require_once('../../../Model/PDO.php');
$errors=array();
$success=array(); 



//Delete from view

if($_GET){
    if(isset($_GET['Confirm_delete'])){


        try { 

            $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $DBConnect->beginTransaction();
            $stmt = $DBConnect->prepare("DELETE FROM `courses` WHERE `courses`.`CourseID`=".$_GET["Confirm_delete"]);
            $stmt->execute();
            $DBConnect->commit();
            array_push($success,"Successful deleted !!!");

        } catch (Exception $e) 
        {
            array_push($errors,"Courses  deleted failed");
            array_push($errors,$e->getMessage());
            $DBConnect->rollBack();
        }


    }
    if(isset($_GET['Grade'])){

      try { 

            $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            //  $DBConnect->beginTransaction();
            $stmt = $DBConnect->prepare("DELETE FROM `grades` WHERE `Id`=".$_GET["Grade"]);
            $stmt->execute();
            // $DBConnect->commit();

            array_push($success,"Grades Successful deleted");


         } catch (Exception $e) 
         {
            array_push($errors,"Courses C.A Overall Mark deleted failed");
            array_push($errors,$e->getMessage());
            //   $DBConnect->rollBack();
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
    $stmt = $DBConnect->prepare("SELECT `CourseID`, `CourseName`,courseType, `CourseCode`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent`, `LecturerFirstname`, `LecturerLastname` FROM `courses` LEFT JOIN lecturers ON courses.CourseLecturerID=lecturers.LecturesID ");
    $stmt->execute();
    $stmt1 = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode`,courseType, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent`,lecturers.UsersID FROM `courses`INNER JOIN lecturers ON courses.CourseLecturerID=lecturers.LecturesID WHERE lecturers.LecturesID=".$_SESSION["userid"]);
    $stmt1->execute();

    $stmt2 = $DBConnect->prepare("SELECT `CA_MarksID`,`ca_marks`.`CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)`,`courses`.`CourseName`,`courses`.`CourseCode`,`courses`.`CourseLecturerID`,`lecturers`.`UsersID` FROM `ca_marks` JOIN `courses` ON `ca_marks`.`CourseID`=`courses`.`CourseID` INNER JOIN lecturers ON `courses`.`CourseLecturerID`=lecturers.LecturesID where  lecturers.LecturesID=".$_SESSION["userid"]);
    $stmt2->execute();

    $stmt3 = $DBConnect->prepare("SELECT `Id`, `minimum`, `maximum`, `gradeValue`, `description` FROM `grades` WHERE 1");
    $stmt3->execute();//for grades

    $stmt0=$stmt2;  

}catch(Exception $e){
    array_push($errors, $e->getMessage()."<br/>"); //$DBConnect->close();

} 




?>