<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');

$errors=array();//to store errors  messages 
$success =array();// to store success message 

 $AC_CourseName=""; $AC_CourseCode=""; $courseTypes=""; $AC_CourseLecturerID=""; $AC_CourseDepID=1; $AC_CourseTotalstudent=""; $YearOffered="";
//fuction that add imported data into the system.
function add_course($DBConnect,$AC_CourseName,$AC_CourseCode, $AC_CourseLecturerID, $AC_CourseDepID, $AC_CourseTotalstudent,$YearOffered,$courseTypes,$errors,$success)
{
   global $AC_CourseName, $AC_CourseCode,$courseTypes,$AC_CourseLecturerID,$AC_CourseDepID,$AC_CourseTotalstudent,$YearOffered,$AC_ID;
    
   global $errors;
    global $success;
    
     $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //validate input
    if(empty($AC_CourseName) || empty($AC_CourseCode) || $AC_CourseLecturerID =="-1" || $courseTypes =="-1" || empty($AC_CourseTotalstudent) || empty($YearOffered)){
        //$error_msg = "All input fields are required";
        array_push($errors, "- All input fields are required!<br>");
    }
    if(!is_numeric($AC_CourseTotalstudent) ){
        //$error_msg = "First Name or Last Name cannot contain numbers";
        array_push($errors, "Course Total student has to be numbers!<br>");
    }
    //enter into database
    if(!empty($AC_CourseName) && !empty($AC_CourseCode) && $AC_CourseLecturerID !="-1"  && $courseTypes !="-1" && !empty($AC_CourseTotalstudent) && !empty($YearOffered)){
        
        try{
        //check if records exist in database
        $stmt = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode`, `courseType`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent` FROM `courses` WHERE `CourseCode`='".$AC_CourseCode."'");

        $stmt->execute();
            // $results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()>=0 && !empty($row)){
           
            array_push($errors, "This record already exists!");
        }
            
        if($stmt->rowCount()==0 && empty($row)){
             
            $sql = $DBConnect->prepare("INSERT INTO `courses`( `CourseName`, `CourseCode`, `courseType`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent`) VALUES (:AC_CourseNames,:AC_CourseCodes,:courseTypes,:AC_CourseLecturerIDs,:CourseDepartmentID,:YearOffereds,:AC_CourseTotalstudents)");

          /*  $sql->bindParam(':AC_CourseNames',$_POST['AC_CourseName'],PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseCodes',$_POST['AC_CourseCode'],PDO::PARAM_STR);
            $sql->bindParam(':courseTypes',$_POST['courseTypes'],PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseLecturerIDs',$_POST['AC_CourseLecturerID'],PDO::PARAM_STR);
            $sql->bindParam(':CourseDepartmentID',$_POST['AC_CourseDepID'],PDO::PARAM_STR);
            $sql->bindParam(':YearOffereds',$_POST['YearOffered'],PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseTotalstudents',$_POST['AC_CourseTotalstudent'],PDO::PARAM_STR); */
            
              
             $sql->bindParam(':AC_CourseNames',$AC_CourseName,PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseCodes',$AC_CourseCode,PDO::PARAM_STR);
             $sql->bindParam(':courseTypes',$courseTypes,PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseLecturerIDs',$AC_CourseLecturerID,PDO::PARAM_STR);
            $sql->bindParam(':CourseDepartmentID',$AC_CourseDepID,PDO::PARAM_STR);
            $sql->bindParam(':YearOffereds',$YearOffered,PDO::PARAM_STR);
            $sql->bindParam(':AC_CourseTotalstudents',$AC_CourseTotalstudent,PDO::PARAM_STR);  
                
            if($sql->execute()){
               
                 $AC_CourseName="";
                    $AC_CourseCode="";
                $courseTypes="";
                    $AC_CourseLecturerID="";
                    $AC_CourseDepID="";
                    $AC_CourseTotalstudent="";
                    $YearOffered="";  
                    $AC_ID="";
                 array_push($success, "record successfully added!");
                
             
              } else{
                
                array_push($errors, "failed to add record!");
            }
               
            }
          
        }catch(PDOException $e ){
            array_push($errors, $e->getMessage());
            array_push($errors, "Database error, please try again later");
        }
    }
    
}







if(isset($_POST["btn_import"]) )
{
    
    $filename=$_FILES["file"]["tmp_name"];
    $excelArray = array();
    $sql;
    
    try{
        $importfiletype = PHPExcel_IOFactory::identify($filename);
        $objectReader = PHPExcel_IOFactory::createReader($importfiletype);
        $objectPHPExcel = $objectReader->load($filename);
        
    }catch(Exception $e)
    {
        $e->getMessage();
        die;
    }
    
    $sheet = $objectPHPExcel -> getSheet(0);
    $heightestRow = $sheet-> getHighestRow();
    $heightestColumn = $sheet-> getHighestColumn();
    
    for($row =1;$row <= $heightestRow; $row++ )
    {
          $rowData = $sheet -> rangeToArray('A'.$row.':'.$heightestColumn.$row,NULL,TRUE,FALSE);
      //  add_course($DBConnect,$rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][3],$errors,$success);
       // add_course($AC_CourseName,$AC_CourseCode, $AC_CourseLecturerID, $AC_CourseDepID, $AC_CourseTotalstudent,$YearOffered,$errors,$success)
        
      
    }
    
}




//when the add button is clicked
if(isset($_POST['btn_add_course'])){
   
$AC_CourseName=test_input($_POST['AC_CourseName']);
$AC_CourseCode=test_input($_POST['AC_CourseCode']);
$courseTypes=test_input($_POST['courseTypes']);
$AC_CourseLecturerID=test_input($_POST['AC_CourseLecturerID']);
$AC_CourseDepID=1;
$AC_CourseTotalstudent=test_input($_POST['AC_CourseTotalstudent']);
$YearOffered=test_input($_POST['YearOffered']); 
$AC_ID=test_input($_POST['AC_ID']);
   
    
   
    //enter into database
    if(!empty($AC_CourseName) && !empty($AC_CourseCode) && $AC_CourseLecturerID !="-1" && $courseTypes !="-1" && !empty($AC_CourseTotalstudent) && !empty($YearOffered)){
        
         add_course($DBConnect,$AC_CourseName,$AC_CourseCode, $AC_CourseLecturerID, $AC_CourseDepID, $AC_CourseTotalstudent,$YearOffered,$courseTypes,$errors,$success);
        
    }else{
        //$error_msg = "All input fields are required";
         
        array_push($errors, "- All input fields are required!<br>");
    }
}

