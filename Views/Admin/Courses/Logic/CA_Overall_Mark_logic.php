<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();//to store errors  messages 
$success =array();// to store success message 
// array_push($error,"  <br/>");

if($_GET){
  
    if(isset($_GET['btn_edit_Link'])){
        try{
           /* SELECT `CA_MarksID`,`ca_marks`.`CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)`,`courses`.`CourseName`,`courses`.`CourseCode`,lecturers.UsersID FROM `ca_marks` JOIN `courses` ON `ca_marks`.`CourseID`=`courses`.`CourseID` where CA_MarksID =".$_GET['value']." ad lecturers.UsersID=".$_SESSION["userid"]*/
            
          
            
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT `CA_MarksID`,`ca_marks`.`CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)`,`courses`.`CourseName`,`courses`.`CourseCode`,`courses`.`CourseLecturerID`,`lecturers`.`LecturesID` FROM `ca_marks` JOIN `courses` ON `ca_marks`.`CourseID`=`courses`.`CourseID` INNER JOIN lecturers ON `courses`.`CourseLecturerID`=lecturers.LecturesID where CA_MarksID =".$_GET['value']." and lecturers.LecturesID=".$_SESSION["userid"]);


              $stmt->execute();
            
            if($stmt->rowCount()>0 )
            {
             while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
             {
                 // value="<?PhP echo $Min_Percentage_input;"
              
                $CA_Course_Name=$row['CourseName'];
                $CA_Test_1=$row['Test_1(%)'];
                $CA_Test_2=$row['Test_2(%)'];
                $CA_Test_3=$row['Test 3(%)'];
                $CA_Labs=$row['Labs(%)'];
                $CA_Assignments=$row['Assignments(%)']; 
                $CA_Project=$row['Project(%)'];
                $CA_Quizs=$row['Quizs(%)'];
                $gCA_MarksID=$row['CA_MarksID'];
             }
                
            
            }

       
        }catch(PDOException $e){
             array_push($errors,''.$e->getMessage().'<br/>');
        

       }
                      
                     
        
    }
}
function check($CA_Test_1,$Test_2,$Test_3,$Labs,$Assignments,$Quizs,$Project){
    global $errors;
    global $success;

    if(!(is_numeric($CA_Test_1)) )
    { 
        array_push($errors,"Test_1 mark has to  be number ..  <br/>"); 
           
    }
    if(!(is_numeric($Test_2)))
    {
         array_push($errors,"Test_2 mark has to be   number ..  <br/>"); 
           
    }
    if(!(is_numeric($Test_3)))
    {
         array_push($errors,"Test_3 mark has to be  number ..or 0 if no Test 3 <br/>"); 
           
    }
    if(!( is_numeric($Labs)) )
    {
         array_push($errors,"Labs mark has to be  number ..  <br/>"); 
           
    }
    if(!(is_numeric($Assignments)) )
    {
         array_push($errors,"Assignments mark has to be number ..  <br/>"); 
           
    }
    if(!(is_numeric($Quizs)) )
    {
         array_push($errors,"Quizs mark has to  be  number .. <br/>"); 
           
    } if(!(is_numeric($Project)) )
    {
         array_push($errors,"Project mark has to be  number ..  <br/>"); 
           
    }
}

if($_POST){
    
    if(isset($_POST['btn_edit']) && $_POST['btn_edit']="edit")
    {
        $test3=0;
        if(!empty($_POST['CA_Test_3'])){
             $test3=$_POST['CA_Test_3'];
        }
        echo $test3;
        
         if(!(is_numeric($_POST['CA_Test_1'])  and is_numeric($_POST['CA_Test_2']) and is_numeric($test3) and is_numeric($_POST['CA_Labs']) and is_numeric($_POST['CA_Assignments']) and is_numeric($_POST['CA_Quizs'])and is_numeric($_POST['CA_Project'])) )
         {
            check($_POST['CA_Test_1'],$_POST['CA_Test_2'],$test3,$_POST['CA_Labs'],$_POST['CA_Assignments'],$_POST['CA_Quizs'],$_POST['CA_Project']);
            $CA_Course_Name=$_POST['CA_Course_Name'];
            $CA_Test_1=$_POST['CA_Test_1'];
            $CA_Test_2=$_POST['CA_Test_2'];
            $CA_Test_3=$test3;
            $CA_Labs=$_POST['CA_Labs'];
            $CA_Assignments=$_POST['CA_Assignments']; 
            $CA_Project=$_POST['CA_Project'];
            $CA_Quizs=$_POST['CA_Quizs'];
            $gCA_MarksID=$_POST['CA_MarksID'];
           
         }else{
             try{
                 // $Max_Percentage +=0.0;UPDATE `grading` SET `Max_Percentage` = :Max_Percentage, `Min_Percentage` =:Min_Percentage, `grading` =:grading, `grading_comments` = :grading_comments WHERE `grading`.`grading_id` 
                 // $Min_Percentage +=0.0;
                  $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $DBConnect->prepare("UPDATE `ca_marks` SET `Quizs(%)`=:CA_Quizs,`Labs(%)`=:CA_Labs,`Assignments(%)`=:CA_Assignments,`Test_1(%)`=:CA_Test_1,`Test_2(%)`=:CA_Test_2,`Test 3(%)`=:CA_Test_3,`Project(%)`=:CA_Project WHERE `CA_MarksID`=".$_POST['CA_MarksID']);




                  $stmt->bindParam(':CA_Test_1',$_POST['CA_Test_1'],PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Test_2',$_POST['CA_Test_2'],PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Test_3',$test3,PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Labs',$_POST['CA_Labs'],PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Assignments',$_POST['CA_Assignments'],PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Quizs',$_POST['CA_Quizs'],PDO::PARAM_STR);
                  $stmt->bindParam(':CA_Project',$_POST['CA_Project'],PDO::PARAM_STR);

                 $stmt->execute();
                 array_push($success,"Courses C.A Overall Mark editted <a href='Courses.php' class='btn btn-warning' > View </a> <br/>");

                   $CA_Course_Name="";
                    $CA_Test_1="";
                    $CA_Test_2="";
                    $CA_Test_3="";
                    $CA_Labs="";
                    $CA_Assignments=""; 
                    $CA_Project="";
                    $CA_Quizs="";
                    $gCA_MarksID="";

               }catch(PDOException $e){
                    array_push($errors,''.$e->getMessage().'<br/>');
                    $CA_Course_Name=$_POST['CA_Course_Name'];
                    $CA_Test_1=$_POST['CA_Test_1'];
                    $CA_Test_2=$_POST['CA_Test_2'];
                    $CA_Test_3=$_POST['CA_Test_3'];
                    $CA_Labs=$_POST['CA_Labs'];
                    $CA_Assignments=$_POST['CA_Assignments']; 
                    $CA_Project=$_POST['CA_Project'];
                    $CA_Quizs=$_POST['CA_Quizs'];
                    $gCA_MarksID=$_POST['CA_MarksID'];
               }
         }
    }
     
}


if($_POST){
    
    if(isset($_POST['btn_insert']) && $_POST['btn_insert']="insert")
    {
         $test3=0;
        if(!empty($_POST['CA_Test_3'])){
             $test3=$_POST['CA_Test_3'];
        }
        echo $test3;
        
         if(!(is_numeric($_POST['CA_Test_1'])  and is_numeric($_POST['CA_Test_2']) and is_numeric($test3) and is_numeric($_POST['CA_Labs']) and is_numeric($_POST['CA_Assignments']) and is_numeric($_POST['CA_Quizs'])and is_numeric($_POST['CA_Project'])) )
         {
            check($_POST['CA_Test_1'],$_POST['CA_Test_2'],$_POST['CA_Test_3'],$_POST['CA_Labs'],$_POST['CA_Assignments'],$_POST['CA_Quizs'],$_POST['CA_Project']);
            $CA_Course_Name=$_POST['CA_Course_Name'];
            $CA_Test_1=$_POST['CA_Test_1'];
            $CA_Test_2=$_POST['CA_Test_2'];
            $CA_Test_3=$_POST['CA_Test_3'];
            $CA_Labs=$_POST['CA_Labs'];
            $CA_Assignments=$_POST['CA_Assignments']; 
            $CA_Project=$_POST['CA_Project'];
            $CA_Quizs=$_POST['CA_Quizs'];
            $gCA_MarksID=$_POST['CA_MarksID'];
           
         }else
         {
             
            try{
                // $Max_Percentage +=0.0;UPDATE `grading` SET `Max_Percentage` = :Max_Percentage, `Min_Percentage` =:Min_Percentage, `grading` =:grading, `grading_comments` = :grading_comments WHERE `grading`.`grading_id` 
                // $Min_Percentage +=0.0;
                $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $DBConnect->prepare("INSERT INTO `ca_marks`( `CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)`) VALUES (:CA_Course_Name,:CA_Quizs,:CA_Labs,:CA_Assignments,:CA_Test_1,:CA_Test_2,:CA_Test_3,:CA_Project)");

                $stmt->bindParam(':CA_Course_Name',$_POST['CA_Course_Name'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Test_1',$_POST['CA_Test_1'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Test_2',$_POST['CA_Test_2'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Test_3',$test3,PDO::PARAM_STR);
                $stmt->bindParam(':CA_Labs',$_POST['CA_Labs'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Assignments',$_POST['CA_Assignments'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Quizs',$_POST['CA_Quizs'],PDO::PARAM_STR);
                $stmt->bindParam(':CA_Project',$_POST['CA_Project'],PDO::PARAM_STR);


                $stmt->execute();
                array_push($success,"Courses C.A Overall Mark added<a href='Courses.php' class='btn btn-warning' > View </a> <br/>");

                $CA_Course_Name="";
                $CA_Test_1="";
                $CA_Test_2="";
                $CA_Test_3="";
                $CA_Labs="";
                $CA_Assignments=""; 
                $CA_Project="";
                $CA_Quizs="";
                $gCA_MarksID="";

            }catch(PDOException $e){
                array_push($errors,"Failed to add C.A. The course C.A Is There Already<br/><a href='Courses.php' class='btn btn-warning' > View </a>");
                $CA_Course_Name=$_POST['CA_Course_Name'];
                $CA_Test_1=$_POST['CA_Test_1'];
                $CA_Test_2=$_POST['CA_Test_2'];
                $CA_Test_3=$_POST['CA_Test_3'];
                $CA_Labs=$_POST['CA_Labs'];
                $CA_Assignments=$_POST['CA_Assignments']; 
                $CA_Project=$_POST['CA_Project'];
                $CA_Quizs=$_POST['CA_Quizs'];
                $gCA_MarksID=$_POST['CA_MarksID'];
            }
         }
    }
    
    
    
}

?>