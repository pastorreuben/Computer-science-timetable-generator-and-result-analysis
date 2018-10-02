<?php
require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();//to store errors  messages 
$success =array();// to store success message 
// array_push($error,"  <br/>");

if($_GET){
  
    if(isset($_GET['btn_edit_Link'])){
        try{
            
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT `Id`, `minimum`, `maximum`, `gradeValue`, `description` FROM `grades` WHERE Id=".$_GET['value']);


              $stmt->execute();
            
            if($stmt->rowCount()>0 )
            {
             while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
             {
                 // value="<?PhP echo $Min_Percentage_input;"
              
                $Id=$row['Id'];
                $min=$row['minimum'];
                $max=$row['maximum'];
                $grade=$row['gradeValue'];
                $descr=$row['description'];
               
             }
                
            
            }

       
        }catch(PDOException $e){
             array_push($errors,''.$e->getMessage().'<br/>');
        

       }
                      
                     
        
    }
}
function check($max,$min){
    global $errors;
global $success;
    
    if(!(is_numeric($min)) )
    {
         array_push($errors,"Minimum mark has to  be number ..  <br/>"); 
           
    }
    if(!(is_numeric($max)))
    {
         array_push($errors,"Maxamum mark has to be   number ..  <br/>"); 
           
    }
}

if($_POST){
    
    if(isset($_POST['btn_edit']) && $_POST['btn_edit']="edit")
    {
        
         if(!(is_numeric($_POST['max'])  and is_numeric($_POST['min']) ) )
         {
             check($_POST['max'],$_POST['min']);
           
         }else{
                     try{
                         // $Max_Percentage +=0.0;UPDATE `grading` SET `Max_Percentage` = :Max_Percentage, `Min_Percentage` =:Min_Percentage, `grading` =:grading, `grading_comments` = :grading_comments WHERE `grading`.`grading_id` 
                         // $Min_Percentage +=0.0;
                          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $stmt = $DBConnect->prepare("UPDATE `grades` SET `minimum`=:minimum,`maximum`=:maximum,`gradeValue`=:gradeValue,`description`=:description WHERE Id=".$_POST['Id']);
                         
                           $stmt->bindParam(':minimum',$_POST['min'],PDO::PARAM_STR);
                          $stmt->bindParam(':maximum',$_POST['max'],PDO::PARAM_STR);
                          $stmt->bindParam(':gradeValue',$_POST['grade'],PDO::PARAM_STR);
                          $stmt->bindParam(':description',$_POST['descr'],PDO::PARAM_STR);
                       
                         $stmt->execute();
                         array_push($success,"Grade editted <a href='Courses.php' class='btn btn-warning' > View </a> <br/>");

                            $Id="";
                            $min="";
                            $max="";
                         $grade="";
                            $descr="";
                         
                       }catch(PDOException $e){
                         array_push($errors,''.$e->getMessage().'<br/>');
                          
                       $Id=$_POST['Id'];
                        $min=$_POST['min'];
                        $max=$_POST['max'];
                        $descr=$_POST['descr'];
                         $grade=$_POST['grade'];
               
                
                       }
         }
    }
     
}


if($_POST){
    
    if(isset($_POST['btn_insert']) && $_POST['btn_insert']="insert")
    {
        
         if(!(is_numeric($_POST['max'])  and is_numeric($_POST['min']) ) )
         {
             check($_POST['max'],$_POST['min']);
           
         }else{
                     try{
                         // $Max_Percentage +=0.0;UPDATE `grading` SET `Max_Percentage` = :Max_Percentage, `Min_Percentage` =:Min_Percentage, `grading` =:grading, `grading_comments` = :grading_comments WHERE `grading`.`grading_id` 
                         // $Min_Percentage +=0.0;
                          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                          $stmt = $DBConnect->prepare("INSERT INTO `grades`( `minimum`, `maximum`, `gradeValue`, `description`) VALUES (:minimum,:maximum,:gradeValue,:description)");
                    
                          $stmt->bindParam(':minimum',$_POST['min'],PDO::PARAM_STR);
                          $stmt->bindParam(':maximum',$_POST['max'],PDO::PARAM_STR);
                          $stmt->bindParam(':gradeValue',$_POST['grade'],PDO::PARAM_STR);
                          $stmt->bindParam(':description',$_POST['descr'],PDO::PARAM_STR);
                       
                         
                         $stmt->execute();
                         array_push($success,"Grade added<a href='Courses.php' class='btn btn-warning' > View </a> <br/>");

                           $Id="";
                            $min="";
                            $max="";
                         $grade="";
                             $descr="";       
                         
                       }catch(PDOException $e){
                         array_push($errors,"Failed..! There Already such a fild <br/><a href='Courses.php' class='btn btn-warning' > View </a>");
                          $Id=$_POST['Id'];
                        $min=$_POST['min'];
                        $max=$_POST['max'];
                         $grade=$_POST['grade'];
                        $descr=$_POST['descr'];
                       }
         }
    }
    
    
    
}

?>