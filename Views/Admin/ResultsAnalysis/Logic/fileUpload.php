<?php 

require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
require_once('../../PHPExcel/Classes/PHPExcel.php');
$errors=array();
$success=array(); 

 $totalCA=0.0;
//calculating the results grade
function calculateGrade($DBConnect,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal){
    $gradeId="";
    $TotalOverallCA=0.0;//the total Overall CA 
     $totalCA=0.0;//the total student CA 
      $totalCA= $TotalQuiz+$TotalLabs+$TotalAssigment+$Test_1+$Test_2+$Test_3+$ProjectsTotal;
    
      $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $DBConnect->prepare("SELECT `CA_MarksID`,`ca_marks`.`CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)` from ca_marks where `ca_marks`.`CourseID`=".$CourseID);
     $stmt->execute();
     if($stmt->rowCount()==1)
     {
         while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
         {
             $TotalOverallCA= $row['Test_1(%)'] + $row['Test_2(%)'] + $row['Test 3(%)'] + $row['Quizs(%)'] + $row['Labs(%)'] + $row['Project(%)'] + $row['Assignments(%)']+0.0;
         }
     }
    
     $totalCA=($totalCA/$TotalOverallCA)*100;//calculation the percentage for his C.A
    //calculating the student gradeId
    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $DBConnect->prepare("SELECT Id from grades where `minimum` <=$totalCA and `maximum` >=$totalCA");
     $stmt->execute();
     if($stmt->rowCount()==1)
     {
         while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
         {
            $gradeId=$row['Id'];
            
         }
     }
    
    return $gradeId;
}




function add_course($DBConnect,$StudentComputerID,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal,$ResultsYear,$errors,$success)
{
   global $errors;
    global $success;
    
     $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //validate input
    if(strlen($StudentComputerID ) !=10 && strlen($StudentComputerID ) !=8  ){   array_push($errors,"$StudentComputerID is invalid student computer number<br>"); }
    if($TotalQuiz >100 || $TotalQuiz <0){ array_push($errors,"$TotalQuiz is invalid mark value . Range 0 t0 100  $StudentComputerID <br>"); }
    if($TotalLabs >100 || $TotalLabs <0){ array_push($errors,"$TotalLabs is invalid mark value . Range 0 t0 100  $StudentComputerID<br>"); }
    if($TotalAssigment >100 || $TotalAssigment <0){ array_push($errors,"$TotalAssigment is invalid mark value . Range 0 t0 100 <br>"); }
    if($Test_1 >100 || $Test_1 <0){ array_push($errors,"$Test_1 is invalid mark value . Range 0 t0 100  $StudentComputerID<br>");}
    if($Test_2 >100 || $Test_2 <0){ array_push($errors,"$Test_2 is invalid mark value . Range 0 t0 100  $StudentComputerID<br>");}
    if($Test_3 >100 || $Test_3 <0){ array_push($errors,"$Test_3 is invalid mark value . Range 0 t0 100  $StudentComputerID<br>");}
    if($ProjectsTotal >100 || $ProjectsTotal <0){array_push($errors,"$ProjectsTotal is invalid  number<br>for student $StudentComputerID<br>");}
    if( strlen($ResultsYear ) !=4){ array_push($errors,"$ResultsYear is invalid  number<br>for student $StudentComputerID<br><br>");}

    if(!is_numeric($StudentComputerID) || !is_numeric($TotalQuiz) || !is_numeric($TotalLabs) || !is_numeric($TotalAssigment) || !is_numeric($Test_1) || !is_numeric($Test_2) || !is_numeric($Test_3) || !is_numeric($ProjectsTotal) || !is_numeric($ResultsYear) ){
        //$error_msg = "First Name or Last Name cannot contain numbers";
       // array_push($errors, "Course Total student has to be numbers!<br>");
        
        if(!is_numeric($StudentComputerID)){   array_push($errors," studentComputerID has to be a number<br>"); }
        if(!is_numeric($TotalQuiz)){ array_push($errors,"TotalQuiz has to be a number for student $StudentComputerID <br>"); }
        if(!is_numeric($TotalLabs)){ array_push($errors,"TotalLabs has to be a numberfor student $StudentComputerID <br>"); }
        if(!is_numeric($TotalAssigment)){ array_push($errors,"TotalAssigment has to be a number<br>for student $StudentComputerID <br>"); }
        if(!is_numeric($Test_1)){ array_push($errors,"Test_1 has to be a number for student $StudentComputerID <br>");}
        if(!is_numeric($Test_2)){ array_push($errors,"Test_2 has to be a number for student $StudentComputerID <br>");}
        if(!is_numeric($Test_3)){ array_push($errors,"Test_3 has to be a number for student $StudentComputerID <br>");}
        if(!is_numeric($ProjectsTotal)){array_push($errors,"ProjectsTotal has to be a number for student $StudentComputerID");}
        if(!is_numeric($ResultsYear)){ array_push($errors," ResultsYear has to be a number for student $StudentComputerID <br><br>");}

        
        
    }else if((strlen($StudentComputerID ) ==10 || strlen($StudentComputerID ) ==8 ) && (!empty($CourseID))  && ($TotalQuiz <=100.0 && $TotalQuiz >=0.0) && ($TotalLabs <=100.0 && $TotalLabs >=0.0) && ($TotalAssigment <=100.0 && $TotalAssigment >=0.0) && ($Test_1 <=100.0 && $Test_1 >=0.0) && ($Test_2 <=100.0 && $Test_2 >=0.0) && ($Test_3 <=100.0 && $Test_3 >=0.0) && ($ProjectsTotal <=100.0 && $ProjectsTotal >=0.0) && ( strlen($ResultsYear ) ==4 ) ){
        
        try{
              $sql = $DBConnect->prepare("SELECT * FROM `gradebook` WHERE `StudentComputerID`=$StudentComputerID and  `CourseID`=$CourseID");
              $sql->execute();
             if($sql->rowCount()<1){
                 $grade=calculateGrade($DBConnect,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal);

              
                  $sql = $DBConnect->prepare("INSERT INTO `gradebook`(`StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grade`, `ResultsYear`) VALUES ($StudentComputerID,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal,$grade,$ResultsYear)");


                if(!empty($grade) && $sql->execute()){
                    array_push($success, " record successfully added! for student Id $StudentComputerID <br>");
                  } else{

                    array_push($errors, "failed to add record! for student Id $StudentComputerID <br>");
                }
             }else{
                 array_push($errors, "The Results for student Id $StudentComputerID already exist . please delete the results to add again or edit the exit results <br>");
             }

               /*$grade=calculate($DBConnect,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal);

                $sql = $DBConnect->prepare("INSERT INTO `gradebook`(`StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grade`, `ResultsYear`) VALUES ($StudentComputerID,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal,$grade,$ResultsYear)");


                if($sql->execute()){
                    array_push($success, " record successfully added! for student Id $StudentComputerID <br>");
                  } else{

                    array_push($errors, "failed to add record! for student Id $StudentComputerID <br>");
                }
*/
               // }
          
        }catch(PDOException $e ){
            array_push($errors, $e->getMessage());
            array_push($errors, "Database error, please try again later or the Student Id $StudentComputerID is not in the system<br/>");
        }
    }
    
}



if($_POST )
{

    if(isset($_POST["btn_import"]) && isset($_POST['month']) && isset($_FILES["file"]) && $_POST['AC_CourseLecturerID']!='-1')
    {

        $filename=$_FILES["file"]['tmp_name'];
        $fileType=strtolower(end(explode('.',$_FILES["file"]['name'])));
        $allowedUpload=array('xlsx','xls');

        if(in_array($fileType,$allowedUpload)){


                $excelArray = array();
                $sql;

                try{
                    $importfiletype = PHPExcel_IOFactory::identify($filename);
                    $objectReader = PHPExcel_IOFactory::createReader($importfiletype);
                    $objectPHPExcel = $objectReader->load($filename);

                }catch(Exception $e)
                {
                    array_push($errors, $e->getMessage()."<br/>");
                    die;
                }

                $sheet = $objectPHPExcel -> getSheet(0);
                $heightestRow = $sheet-> getHighestRow();
                $heightestColumn = $sheet-> getHighestColumn();
                $StComputerID='';//hold current fomputer number 
                try{
                    $year=explode("-",$_POST['month']);//

                        $DBConnect->beginTransaction();

                            for($row =2;$row <= $heightestRow; $row++ )
                            {

                              $rowData = $sheet -> rangeToArray('A'.$row.':'.$heightestColumn.$row,NULL,TRUE,FALSE);
                              $StComputerID=$rowData[0][0];
                              add_course($DBConnect,$rowData[0][0],$_POST['AC_CourseLecturerID'],$rowData[0][1],$rowData[0][2],$rowData[0][3],$rowData[0][4],$rowData[0][5],$rowData[0][6],$rowData[0][7],"$year[0]",$errors,$success);

                            } 
                            $DBConnect->commit();
                       
                }
                catch(Exception $e)
                {
                    array_push($errors, $e->getMessage()."No! results where uploaded <br/>please try again later or the Student Id $StComputerID is not in the system<br/>");
                    $DBConnect->rollBack();
                }
          }else{
              array_push($errors,"Only Excel Format allowed such Xls and Xlsx<br/>");
          }

      }else {
            array_push($errors,"All fields required<br/>");

        }

}

?>