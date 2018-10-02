<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');

$errors=array();//to store errors  messages 
$success =array();// to store success message 

 
//fuction that add imported data into the system.
function Add_ClassRooms($DBConnect,$AC_ClassRoomsname,$AC_ClassRoomsCapacity,$errors,$success)
{
   global $errors;
    global $success;
    
    //validate input
    if(empty($AC_ClassRoomsname) || empty($AC_ClassRoomsCapacity)){
        //$error_msg = "All input fields are required";
        array_push($errors, "- All input fields are required!<br>");
    }
    if(!is_numeric($AC_ClassRoomsCapacity) ){
        //$error_msg = "First Name or Last Name cannot contain numbers";
        array_push($errors, "ClassRooms Capacity has to be numbers!<br>");
    }
    //enter into database
    if(!empty($AC_ClassRoomsname) && !empty($AC_ClassRoomsCapacity)){
         
        try{
        //check if records exist in database
        $stmt = $DBConnect->prepare("SELECT * FROM `classrooms` WHERE ClassRoomName='".$AC_ClassRoomsname."'");

        $stmt->execute();
            // $results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
          $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()>=0 && !empty($row)){
            array_push($errors, "This record already exists!");
        }else{
            $sql = $DBConnect->prepare("INSERT INTO `classrooms` (`ClassRoomID`, `ClassRoomName`, `ClassRoomCapacity`) VALUES (NULL,:AC_ClassRoomsname,:AC_ClassRoomsCapacity)");

             $sql->bindParam(':AC_ClassRoomsname',$AC_ClassRoomsname,PDO::PARAM_STR);
             $sql->bindParam(':AC_ClassRoomsCapacity',$AC_ClassRoomsCapacity,PDO::PARAM_STR);
                          
            if($sql->execute()){
                 $AC_ClassRoomsname="";
                 $AC_ClassRoomsCapacity="";
                  
                 array_push($success, "ClassRoom successfully added!");
                
             
              } 
               
            }
          
        }catch(PDOException $e ){
            array_push($errors, $e-getMessage());
            array_push($errors, "Database error, please try again later");
        }
    }
    
}









//when the add button is clicked
if(isset($_POST['btn_addClassRooms']) && $_POST){
   
$AC_ClassRoomsname=test_input($_POST['AC_ClassRoomsname']);
$AC_ClassRoomsCapacity=test_input($_POST['AC_ClassRoomsCapacity']);

//$AC_ID=test_input($_POST['AC_CourseName']);
   
    
    
    //enter into database
    if(!empty($AC_ClassRoomsname) && !empty($AC_ClassRoomsCapacity) ){
        
         Add_ClassRooms($DBConnect,$AC_ClassRoomsname,$AC_ClassRoomsCapacity,$errors,$success);
       
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


