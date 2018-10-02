<?php 
if(isset($_POST['loginUserName']) && isset($_POST['loginPassword']) ){
         $lguserName=$_POST['loginUserName'];
        $lgPassowrd=$_POST['loginPassword'];
        
        require_once('../../Model/PDO.php');
    
       // set the PDO error mode to exception
    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT  `LecturerPassword` FROM `lecturers` WHERE `LecturerComputer`='$lguserName' or lecturers.LecturerEmail='$lguserName'");
    $stmt->execute(); 
    $hashed_password="";
    //hash password
    while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $hashed_password=$row['LecturerPassword'];
    }

    if(password_verify($lgPassowrd, $hashed_password))
    {
       try
         {
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $stmt = $DBConnect->prepare("SELECT LecturesID, LecturerComputer,LecturerComputer,LecturerEmail ,LecturerFirstname ,LecturerLastname, LecturerRole,UserRoleName FROM lecturers inner JOIN userrole on lecturers.LecturerRole = userrole.UserRoleID where (lecturers.LecturerComputer=:lguserName or lecturers.LecturerEmail=:lguserName) and lecturers.LecturerPassword=:lgPassowrd");

                $stmt->bindParam(':lguserName',$lguserName,PDO::PARAM_STR);
                $stmt->bindParam(':lgPassowrd',$hashed_password,PDO::PARAM_STR);
                $stmt->execute();
            // $results = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

              $row=$stmt->fetch(PDO::FETCH_ASSOC);

             if($stmt->rowCount()>=0 && !empty($row))
            { 
                while($row){
                      $_SESSION["userid"]=$row['LecturesID'];
                    $_SESSION['username']= $row['LecturerFirstname'] . " " .$row['LecturerLastname'];//error
                        if($row['UserRoleName'] == "admin")
                        {
                           $_SESSION["role"] =$row['UserRoleName']; 
                            header('Location:../Admin/Dashboard/Dashboard.php');
                             exit; 
                        }else if($row['UserRoleName'] == "staff"){

                             $_SESSION["role"] =$row['UserRoleName']; 
                                header('Location:../Staff/Dashboard/Dashboard.php');
                                exit; 
                        }
                }
            }else
            {
                 echo '<div class="alert alert-danger">
                       <strong>User ComputerID or emial and passowrd is not correct </strong>  </div>';
            }
         }catch(PDOException $e)
         {
             echo '<div class="alert alert-danger">
                              Try Again! There was a problem Login Try Again.' . $e->getMessage().'</div> ';

         }
 
    }else{
        echo '<div class="alert alert-danger">
                  User ComputerID/ emial and Password is incorretsss ';
    }
    
         
        
        
        
   }else
    {
         echo '<div class="alert alert-danger">
                  User ComputerID or emial and Password is required  </div>';
       
    }
?>