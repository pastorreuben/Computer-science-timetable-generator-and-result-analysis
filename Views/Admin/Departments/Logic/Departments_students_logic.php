<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();//to store errors  messages 
$success =array();// to store success message 
// array_push($error,"  <br/>");
$studentId=$gendar=$fullName=$Year="";$ID=0;

  //$ca_marr=ID;$studentId;$CA_Quizs=$fullName;CA_Course_Name=gendar;resultsYear=Year
                                               
if($_GET){
  
    if(isset($_GET['btn_edit_Link'])){
        try{
            
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT `StudentComputerID`, `FullNames`, `Gander`, `YearOfStudy`, `StudentStatus` FROM `student` WHERE `StudentComputerID`=".(int)$_GET['btn_edit_Link']);
              $stmt->execute();
            
            if($stmt->rowCount()>0 )
            {
             while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
             {
                 // value="<?PhP echo $Min_Percentage_input;"
                $studentId=$row['StudentComputerID'];
                $gendar=$row['Gander'];
                $fullName=$row['FullNames'];
                $ID=$row['StudentComputerID'];
                $Year=$row['YearOfStudy'];
               
               
             }
                
           
            }

       
        }catch(PDOException $e){
             array_push($errors,''.$e->getMessage().'<br/>');
        

       }
                      
                     
        
    }
}
?>