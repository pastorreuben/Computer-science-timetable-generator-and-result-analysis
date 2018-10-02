<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();
$success=array(); 



 $Scheduleday="";
$SchedulesTime="";
$SchedulesTimeStart="";
$SchedulesTimeEnd="";
//fuction that add  data into the system.
function execs($DBConnect,$Scheduleday,$SchedulesTime,$errors,$success,$sql)
{
   global $errors;
    global $success;
    
     try{
        //check if records exist in database
        $stmt = $DBConnect->prepare("SELECT * FROM `scheduledtime` WHERE SecheduledDay='".$Scheduleday."' && SecheduledTime='".$SchedulesTime."'");

        $stmt->execute();
            // $results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()>=0 && !empty($row)){
            array_push($errors,"<b>".$Scheduleday."-".$SchedulesTime. "</b> already exists!<br/>");
        }else{
            if($sql->execute()){
                         
                         array_push($success, "<b>".$Scheduleday."-".$SchedulesTime. "</b> successfully added!<br/>"); 
                $Scheduleday="";
                $SchedulesTimeStart="";
                $SchedulesTimeEnd="";

                    }
        }
          
        }catch(PDOException $e ){
            array_push($errors, $e-getMessage());
            array_push($errors, "Database error, please try again later<br/>");
        }
    
 }

//fuction that add imported data into the system.
function Add_ClassRooms($DBConnect,$Scheduleday,$SchedulesTime,$errors,$success)
{
   global $errors;
    global $success;
    
    //validate input
    if(empty($Scheduleday) || empty($SchedulesTime)){
        //$error_msg = "All input fields are required";
        array_push($errors, "- All input fields are required!<br>");
    }
    
    //enter into database
    if(!empty($Scheduleday) && !empty($SchedulesTime)){
         
       
            if($Scheduleday !="All"){
                 $sql = $DBConnect->prepare("INSERT INTO `scheduledtime` (`SecheduledID`, `SecheduledDay`, `SecheduledTime`) VALUES (NULL, :SecheduledDay,:SecheduledTime)");

                 $sql->bindParam(':SecheduledDay',$Scheduleday,PDO::PARAM_STR);
                 $sql->bindParam(':SecheduledTime',$SchedulesTime,PDO::PARAM_STR);

                  execs($DBConnect,$Scheduleday,$SchedulesTime,$errors,$success,$sql);   

                }else if($Scheduleday =="All")
            {
                   
                $days=array("Monday","Tuesday","Wednesday","Thursday","Friday");
               foreach($days as $day){
                    $sql = $DBConnect->prepare("INSERT INTO `scheduledtime` (`SecheduledID`, `SecheduledDay`, `SecheduledTime`) VALUES (NULL, :SecheduledDay,:SecheduledTime)");

                 $sql->bindParam(':SecheduledDay',$day,PDO::PARAM_STR);
                 $sql->bindParam(':SecheduledTime',$SchedulesTime,PDO::PARAM_STR);
                   execs($DBConnect,$day,$SchedulesTime,$errors,$success,$sql); 
               }
                      
                
              } 
               
          
    }
    
}



//when the add button is clicked
if(isset($_POST['btn_addSchedule']) && $_POST){
   
$Scheduleday=test_input($_POST['Scheduleday']);
$SchedulesTimeStart=test_input($_POST['SchedulesTimeStart']);
$SchedulesTimeEnd=test_input($_POST['SchedulesTimeEnd']);

//$AC_ID=test_input($_POST['AC_CourseName']);
   
    
    
    //enter into database
    if(!empty($Scheduleday) && $Scheduleday !="-1" && !empty($SchedulesTimeStart) && !empty($SchedulesTimeEnd)){
        $SchedulesTime=$SchedulesTimeStart." - ".$SchedulesTimeEnd;
         Add_ClassRooms($DBConnect,$Scheduleday,$SchedulesTime,$errors,$success);
       
    }else{  
                array_push($errors, "All field are required!");
       
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


