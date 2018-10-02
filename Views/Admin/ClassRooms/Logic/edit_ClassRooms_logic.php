<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');

$errors=array();//to store errors  messages 
$success =array();// to store success message 

   $AC_ClassRoomsname="";
$AC_ClassRoomsCapacity="";


   $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if($_GET){


   $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_GET['btn_edit_link'])){
       
          try{
           
             // $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT `ClassRoomID`, `ClassRoomName`, `ClassRoomCapacity` FROM `classrooms` WHERE ClassRoomID=".$_GET['value']);
              $stmt->execute();
             if($stmt->rowCount()>0 )
            {
               while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
                  
   
                $AC_id=$row['ClassRoomID'];
                $AC_ClassRoomsname=$row['ClassRoomName'];
                $AC_ClassRoomsCapacity=$row['ClassRoomCapacity'];
                
              }
                
            }
      
        }catch(PDOException $e){
             echo $e->getMessage();
             array_push($errors,''.$e->getMessage().'<br/>');
                    
       }     
        
    }
}

if(($_POST) ){
  
    if(isset($_POST['btn_saved_submit']) && isset($_POST['AC_ClassRoomsname']) && isset($_POST['AC_ClassRoomsCapacity']) && isset($_POST['AC_id']))
    {
        
         
                     try{
                          $stmt = $DBConnect->prepare("UPDATE `classrooms` SET `ClassRoomName`=:AC_ClassRoomsname,`ClassRoomCapacity`=:AC_ClassRoomsCapacity WHERE `ClassRoomID`=".$_POST['AC_id']);
  
                          $stmt->bindParam(':AC_ClassRoomsname',$_POST['AC_ClassRoomsname'],PDO::PARAM_STR);
                          $stmt->bindParam(':AC_ClassRoomsCapacity',$_POST['AC_ClassRoomsCapacity'],PDO::PARAM_STR);
                          
                         $stmt->execute();
                         
                         array_push($success,"edit successful <a href='ClassRooms.php' class='btn btn-warning' > View </a> <br/>");

                         
                         
 $AC_ClassRoomsname="";
$AC_ClassRoomsCapacity="";
$AC_id="";
                       }catch(PDOException $e){
                      array_push($errors,''.$e->getMessage().'<br/>');
                         
                       }


       }else{
         
   $AC_ClassRoomsname=test_input($_POST['AC_ClassRoomsname']);
$AC_ClassRoomsCapacity=test_input($_POST['AC_ClassRoomsCapacity']);
$AC_id=test_input($_POST['AC_id']);
         array_push($errors,'fill all feild<br/>');
                       
     }   
        
        
} 

?>