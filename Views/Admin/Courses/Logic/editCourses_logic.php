<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');

$errors=array();//to store errors  messages 
$success =array();// to store success message 

$stmt2;
$stmt3;

$DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($_GET){
    $AC_CourseName="";
    $AC_CourseCode="";
    $AC_CourseLecturerID="";
    $AC_CourseDepID="";
    $AC_CourseTotalstudent="";
    $YearOffered="";  
    $AC_id="";

    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_GET['btn_edit_link'])){

        $_SESSION["value"]=$_GET['value'];
        try{

            // $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent` FROM `courses` WHERE `CourseID`=".$_GET['value']);
            $stmt->execute();
            if($stmt->rowCount()>0 )
            {
                while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
                {


                    $AC_id=$row['CourseID'];
                    $AC_CourseName=$row['CourseName'];
                    $AC_CourseCode=$row['CourseCode'];
                    $AC_CourseLecturerID=$row['CourseLecturerID'];
                    $AC_CourseDepID=$row['CourseDepartmentID'];
                    $AC_CourseTotalstudent=$row['CourseTotalStudent'];
                    $YearOffered=$row['YearOffer']; 
                    //$stmt3 = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent` FROM `courses` WHERE `CourseID`=".$_GET['value']);
                    // $stmt->execute();us` 
                }
                
                $stmt2 = $DBConnect->prepare("SELECT `LecturesID`,`UsersID`, `lecturers`.`LecturerFirstname`,`lecturers`.`LecturerComputer`,`lecturers`.`LecturerLastname` FROM `lecturers`"); //WHERE lecturers.LecturesID=1
                $stmt2->execute();

            }

        }catch(PDOException $e){
            echo $e->getMessage();
            array_push($errors,''.$e->getMessage().'<br/>');

        }     

    }
}

if(($_POST) ){
  
    if(isset($_POST['btn_edit_course_submit']) && $_POST['AC_CourseLecturerID']!="-1" && isset($_POST['AC_id']) && $_POST['YearOffered']!="-1")
    {
        

        try{
            $stmt = $DBConnect->prepare("UPDATE `courses` SET `CourseName`= :AC_CourseNames,`CourseCode`= :AC_CourseCodes,`CourseLecturerID`= :AC_CourseLecturerIDs,`YearOffer`= :YearOffereds,`CourseTotalStudent`= :AC_CourseTotalstudents WHERE`CourseID`=".$_POST['AC_id']);

            $stmt->bindParam(':AC_CourseNames',$_POST['AC_CourseName'],PDO::PARAM_STR);
            $stmt->bindParam(':AC_CourseCodes',$_POST['AC_CourseCode'],PDO::PARAM_STR);
            $stmt->bindParam(':AC_CourseLecturerIDs',$_POST['AC_CourseLecturerID'],PDO::PARAM_STR);

            $stmt->bindParam(':YearOffereds',$_POST['YearOffered'],PDO::PARAM_STR);
            $stmt->bindParam(':AC_CourseTotalstudents',$_POST['AC_CourseTotalstudent'],PDO::PARAM_STR);
            $stmt->execute();

            array_push($success,"edit successful <a href='Courses.php' class='btn btn-warning' > View </a> <br/>");



            $AC_CourseName="";
            $AC_CourseCode="";
            $AC_CourseLecturerID="";
            $AC_CourseDepID="";
            $AC_CourseTotalstudent="";
            $YearOffered="";  
            $AC_id="";
        }catch(PDOException $e){
            array_push($errors,''.$e->getMessage().'<br/>');

        }


       }else{
            $stmt2 = $DBConnect->prepare("SELECT `LecturesID`,`UsersID`, `lecturers`.`LecturerFirstname`,`lecturers`.`LecturerComputer`,`lecturers`.`LecturerLastname` FROM `lecturers`"); //WHERE lecturers.LecturesID=1
            $stmt2->execute();

            $AC_CourseName=test_input($_POST['AC_CourseName']);
            $AC_CourseCode=test_input($_POST['AC_CourseCode']);
            $AC_CourseLecturerID=test_input($_POST['AC_CourseLecturerID']);
            //$AC_CourseDepID=test_input($_POST['AC_CourseDepID']);
            $AC_CourseTotalstudent=test_input($_POST['AC_CourseTotalstudent']);
            $YearOffered=test_input($_POST['YearOffered']); 
            $AC_id=test_input($_POST['AC_id']);
            array_push($errors,'fill all feild<br/>');
                       
     }   
        
        
} 

?>