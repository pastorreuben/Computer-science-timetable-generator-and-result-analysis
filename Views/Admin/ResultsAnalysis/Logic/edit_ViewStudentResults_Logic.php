<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();//to store errors  messages 
$success =array();// to store success message 
// array_push($error,"  <br/>");
$studentId=$CA_Course_Name=$CA_Test_1=$CA_Test_2=$CA_Test_3=$CA_Labs=$CA_Assignments=$CA_Project=$CA_Quizs=$gCA_MarksID=0;$resultsYear="";


if($_GET){
  
    if(isset($_GET['btn_edit_Link'])){
        try{
            
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT `GradeBookID`, `StudentComputerID`, gradebook.`CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grade`, `ResultsYear`, courses.CourseCode, courses.CourseName FROM `gradebook` JOIN courses on gradebook.`CourseID`=courses.CourseID WHERE GradeBookID=".(int)$_GET['btn_edit_Link']);
              $stmt->execute();
            
            if($stmt->rowCount()>0 )
            {
             while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
             {
                 // value="<?PhP echo $Min_Percentage_input;"
                 $studentId=$row['StudentComputerID'];
                $CA_Course_Name=$row['CourseID'];
                 
                $CA_Test_1=$row['Test_1(%)'];
                $CA_Test_2=$row['Test_2(%)'];
                $CA_Test_3=$row['Test_3(%)'];
                $CA_Labs=$row['TotalLabs(%)'];
                $CA_Assignments=$row['TotalAssigment(%)']; 
                $CA_Project=$row['ProjectsTotal(%)'];
                $CA_Quizs=$row['TotalQuiz(%)'];
                $CA_MarksID=$row['GradeBookID'];
                $resultsYear=$row['ResultsYear'];
                 
                $_SESSION['stdID']=$studentId;
                $_SESSION['CrsID']=$CA_Course_Name;
             }
                
           
            }

       
        }catch(PDOException $e){
             array_push($errors,''.$e->getMessage().'<br/>');
        

       }
                      
                     
        
    }
}

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




function add_course($DBConnect,$StudentComputerID,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal,$ResultsYear,$errors,$success,$gradeBookId,$action)
{
   global $errors;
    global $success;
    $flag=false;
    
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
            $grade=calculateGrade($DBConnect,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal);

            //checking if the type if edit or insert 
            if($action="edit" && !empty($gradeBookId)){
                $sqls = $DBConnect->prepare("UPDATE `gradebook` SET `StudentComputerID`=$StudentComputerID,`CourseID`=$CourseID,`TotalQuiz(%)`=$TotalQuiz,`TotalLabs(%)`=$TotalLabs,`TotalAssigment(%)`=$TotalAssigment,`Test_1(%)`=$Test_1,`Test_2(%)`=$Test_2,`Test_3(%)`=$Test_3,`ProjectsTotal(%)`=$ProjectsTotal,`grade`=$grade,`ResultsYear`=$ResultsYear WHERE `GradeBookID`=$gradeBookId");
                $string="Edited";
                //updating record
                if(!empty($grade) && $sqls->execute()){
                    array_push($success, " record successfully $string! for student Id $StudentComputerID <br>");
                    $flag =true;
                } else{
                    array_push($errors, "failed to add record! for student Id $StudentComputerID <br>");
                }
            } else if($action="insert"){
                $sqls=$string="";
                //checking if user exit in database
                $sql = $DBConnect->prepare("SELECT * FROM `gradebook` WHERE `StudentComputerID`=$StudentComputerID and  `CourseID`=$CourseID");
                $sql->execute();
                
                if($sql->rowCount()<1){
                    //insert new records
                    $sqls = $DBConnect->prepare("INSERT INTO `gradebook`(`StudentComputerID`, `CourseID`, `TotalQuiz(%)`, `TotalLabs(%)`, `TotalAssigment(%)`, `Test_1(%)`, `Test_2(%)`, `Test_3(%)`, `ProjectsTotal(%)`, `grade`, `ResultsYear`) VALUES ($StudentComputerID,$CourseID,$TotalQuiz,$TotalLabs,$TotalAssigment,$Test_1,$Test_2,$Test_3,$ProjectsTotal,$grade,$ResultsYear)");  
                    $string="Inserted";
                    if(!empty($grade) && $sqls->execute()){
                        array_push($success, " record successfully $string! for student Id $StudentComputerID <br>");
                        $flag =true;
                    } else{
                        array_push($errors, "failed to add record! for student Id $StudentComputerID <br>");
                    }
                }else{
                    array_push($errors, "The Results for student Id $StudentComputerID already exist . please delete the results to add again or edit the exit results <br>");
                }

            }

        }catch(PDOException $e ){
            array_push($errors, $e->getMessage());
            array_push($errors, "Database error, please try again later or the Student Id $StudentComputerID is not in the system<br/>");
        }
    }
    return $flag;
}



//Inser a new record in the database
if($_POST){
    if(isset($_POST['btn_insert'])){
        if( $_POST['btn_insert']="insert"){
            
           $studentId=$_POST['studentId'];
            $CA_Course_Name=$_POST['CA_Course_Name'];
            $CA_Test_1=$_POST['CA_Test_1'];
            $CA_Test_2=$_POST['CA_Test_2'];
            $CA_Test_3=$_POST['CA_Test_3'];
            $CA_Labs=$_POST['CA_Labs'];
            $CA_Assignments=$_POST['CA_Assignments']; 
            $CA_Project=$_POST['CA_Project'];
            $CA_Quizs=$_POST['CA_Quizs'];
            //$CA_MarksID=$_POST['CA_MarksID'];
             $Year=explode("-",$_POST['resultsYear']);
            $resultsYear=$Year[0];

          //calling add course function which varidate and insert a record or update the record ;
            $var=add_course($DBConnect,$studentId,$CA_Course_Name,$CA_Quizs,$CA_Labs,$CA_Assignments,$CA_Test_1,$CA_Test_2,$CA_Test_3,$CA_Project,$resultsYear,$errors,$success,"",$_POST['btn_insert']);
            //to keep entry if any error occurs
            if(!$var){
                $studentId=$_POST['studentId'];
                $CA_Course_Name=$_POST['CA_Course_Name'];
                $CA_Test_1=$_POST['CA_Test_1'];
                $CA_Test_2=$_POST['CA_Test_2'];
                $CA_Test_3=$_POST['CA_Test_3'];
                $CA_Labs=$_POST['CA_Labs'];
                $CA_Assignments=$_POST['CA_Assignments']; 
                $CA_Project=$_POST['CA_Project'];
                $CA_Quizs=$_POST['CA_Quizs'];
                $Year=explode("-",$_POST['resultsYear']);
                $resultsYear=$Year[0];
            }else{
            //emptying the variables
                $studentId=$CA_Course_Name=$CA_Test_1=$CA_Test_2=$CA_Test_3=$CA_Labs=$CA_Assignments=$CA_Project=$CA_Quizs=$CA_MarksID=$resultsYear=$gradeBookId=$action="";

          } 
        }
    }
   
               
}

//Inser a new record in the database
if($_POST){
    if(isset($_POST["btn_edit"])){
        if($_POST["btn_edit"]=="edit" ){
            
            $studentId=$_SESSION['stdID'];
            $CA_Course_Name=$_SESSION['CrsID'];
            $CA_Test_1=$_POST['CA_Test_1'];
            $CA_Test_2=$_POST['CA_Test_2'];
            $CA_Test_3=$_POST['CA_Test_3'];
            $CA_Labs=$_POST['CA_Labs'];
            $CA_Assignments=$_POST['CA_Assignments']; 
            $CA_Project=$_POST['CA_Project'];
            $CA_Quizs=$_POST['CA_Quizs'];
            $CA_MarksID=$_POST['CA_MarksID'];
             $Year=explode("-",$_POST['resultsYear']);
            $resultsYear=$Year[0];

          //calling add course function which varidate and insert a record or update the record ;
            $var=add_course($DBConnect,$studentId,$CA_Course_Name,$CA_Quizs,$CA_Labs,$CA_Assignments,$CA_Test_1,$CA_Test_2,$CA_Test_3,$CA_Project,$resultsYear,$errors,$success,$CA_MarksID,$_POST["btn_edit"]);
            //to keep entry if any error occurs
            if(!$var){
                 $studentId=$_SESSION['stdID'];
                $CA_Course_Name=$_SESSION['CrsID'];
                $CA_Test_1=$_POST['CA_Test_1'];
                $CA_Test_2=$_POST['CA_Test_2'];
                $CA_Test_3=$_POST['CA_Test_3'];
                $CA_Labs=$_POST['CA_Labs'];
                $CA_Assignments=$_POST['CA_Assignments']; 
                $CA_Project=$_POST['CA_Project'];
                $CA_Quizs=$_POST['CA_Quizs'];
                $CA_MarksID=$_POST['CA_MarksID'];
                 $Year=explode("-",$_POST['resultsYear']);
                $resultsYear=$Year[0];
            }else{
            //emptying the variables 
                $_SESSION['stdID']=$_SESSION['CrsID']=$studentId=$CA_Course_Name=$CA_Test_1=$CA_Test_2=$CA_Test_3=$CA_Labs=$CA_Assignments=$CA_Project=$CA_Quizs=$CA_MarksID=$resultsYear=$gradeBookId=$action="";

            }
         }
    }
   
               
}

?>