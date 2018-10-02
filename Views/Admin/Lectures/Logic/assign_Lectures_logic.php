<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');

$errors=array();//to store errors  messages 
$success =array();// to store success message 

if(isset($_POST["btn_submit"])){

//validate input
    $CourseID=$_POST["AC_CourseName"];
    $AC_CourseLecturerID=$_POST["AC_CourseLecturerID"];
    if(!empty($CourseID) && !empty($AC_CourseLecturerID)){
         
        try{
       
        if($AC_CourseLecturerID !="-1" && $CourseID !="-1"){
            $sql = $DBConnect->prepare("UPDATE `courses` SET `CourseLecturerID`=$AC_CourseLecturerID WHERE CourseID=$CourseID");

           
            if($sql->execute()){
                
                 array_push($success, "record successfully assign!");
                
              }else{
                
                array_push($errors, "all fill field !");
            } 
               
    array_push($success, "------------!");
            }else{
                
                array_push($errors, "failed to add record!");
            }
          
   
        }catch(PDOException $e ){
            array_push($errors, $e-getMessage());
            array_push($errors, "Database error, please try again later");
        }
    } 
 }


?>
