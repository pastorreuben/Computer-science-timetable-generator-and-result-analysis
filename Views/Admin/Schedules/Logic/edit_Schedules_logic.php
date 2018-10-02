<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();
$success=array(); 


$SecheduledID="";
 $Scheduleday="";
$SchedulesTimeStart="";
$SchedulesTimeEnd="";
if($_GET && $_GET['btn_edit_link']){
    
        $SecheduledID=$_GET['value'];
        //check if records exist in database
        $stmt = $DBConnect->prepare("SELECT `SecheduledDay`, `SecheduledTime` FROM `scheduledtime` WHERE SecheduledID=".$SecheduledID);

        $stmt->execute();
    while( $row=$stmt->fetch(PDO::FETCH_ASSOC)){
        
       //$try= var_dump(explode(' ', $row['SecheduledTime']));
       // $try= var_dump(split(' +', $row['SecheduledTime']));
       $try=preg_split('/ +/', $row['SecheduledTime']);
        
        
        $Scheduleday=$row['SecheduledDay'];
        $SchedulesTime =$row['SecheduledTime'];
      
        $SchedulesTimeStart=$try[0];
        $SchedulesTimeEnd=$try[2];
        
    }
}


//fuction that add imported data into the system.
function edit_ClassRooms($DBConnect,$SecheduledID,$Scheduleday,$SchedulesTime,$errors,$success)
{
    global $errors;
    global $success;
    global $Scheduleday;
    global $SchedulesTimeStart;
    global $SchedulesTimeEnd;
        
    //validate input
    if(empty($Scheduleday) || empty($SchedulesTime)){
        //$error_msg = "All input fields are required";
        array_push($errors, "- All input fields are required!<br>");
    }
    
    //enter into database
    if(!empty($Scheduleday) && !empty($SchedulesTime)){
               
         $sql = $DBConnect->prepare("UPDATE `scheduledtime` SET `SecheduledDay`=:SecheduledDay,`SecheduledTime`=:SecheduledTime WHERE `SecheduledID`=".$SecheduledID);
         $sql->bindParam(':SecheduledDay',$Scheduleday,PDO::PARAM_STR);
         $sql->bindParam(':SecheduledTime',$SchedulesTime,PDO::PARAM_STR);
           try{
       
            if($sql->execute()){
                         
                array_push($success, "<b>".$Scheduleday."-".$SchedulesTime. "</b> successfully Editted!<br/>"); 
                $Scheduleday="";
                $SchedulesTimeStart="";
                $SchedulesTimeEnd="";

              }else{
                 array_push($errors, "an Error occur. please try again!<br/>"); 
                 
              }
               
          
        }catch(PDOException $e ){
            array_push($errors, $e-getMessage());
            array_push($errors, "Database error, please try again later<br/>");
        }
                
            
    }
    
}









//when the add button is clicked
if(isset($_POST['btn_editSchedule']) && $_POST){
    
    $SecheduledID=$_POST['btn_editSchedule'];
    $Scheduleday=test_input($_POST['Scheduleday']);
    $SchedulesTimeStart=test_input($_POST['SchedulesTimeStart']);
    $SchedulesTimeEnd=test_input($_POST['SchedulesTimeEnd']);

//$AC_ID=test_input($_POST['AC_CourseName']);
   
    
    
    //enter into database
    if(!empty($Scheduleday) && $Scheduleday !="-1" && !empty($SchedulesTimeStart) && !empty($SchedulesTimeEnd)){
        $SchedulesTime=$SchedulesTimeStart."-".$SchedulesTimeEnd;
         edit_ClassRooms($DBConnect,$SecheduledID,$Scheduleday,$SchedulesTime,$errors,$success);
       
    }else{  
                array_push($errors, "All field are required!");
       
            }
}



