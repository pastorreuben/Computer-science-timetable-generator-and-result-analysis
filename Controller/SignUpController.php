<?php 
 ob_start();
    if(isset($_POST['computerIDNumber']) && isset($_POST['userFirstName']) && isset($_POST['UserLastName']) && isset($_POST['UserEmail']) && isset($_POST['UserPassword']) && isset($_POST['UserPassword2']) )
    {
        
        $usercomputerIDNumber=$_POST['computerIDNumber'];
        $userFirstName=$_POST['userFirstName'];
        $userLastName=$_POST['UserLastName'];
        $userEmail=$_POST['UserEmail'];
        $userPassword=$_POST['UserPassword'];
        $userPassword2=$_POST['UserPassword2'];
        
        //checking if the password is eqaul
        if($userPassword != $userPassword2)
        {
           echo('<div class="alert alert-danger"> Password did Not Match</div>');
           
        }else
        {
               require_once('../../Model/PDO.php');
            
           
               try{
                    // set the PDO error mode to exception
                     $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      $stmt = $DBConnect->prepare("INSERT INTO `lecturers` (`LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerAccountStatus`) VALUES (:usercomputerIDNumber, :userEmail,:userFirstName, :userLastName , :userPassword,'2', '1')");
            
                        $stmt->bindParam(':usercomputerIDNumber',$usercomputerIDNumber,PDO::PARAM_STR);
                        $stmt->bindParam(':userEmail', $userEmail,PDO::PARAM_STR);
                        $stmt->bindParam(':userFirstName', $userFirstName,PDO::PARAM_STR);
                        $stmt->bindParam(':userLastName', $userLastName,PDO::PARAM_STR);
                        $stmt->bindParam(':userPassword', password_hash($userPassword, PASSWORD_DEFAULT),PDO::PARAM_STR);//entering the hashed password
                        $stmt->execute();
                   
                
//                     echo '<div class="alert alert-success">
//                          <label title="Login"> <a  class="diva text-success" href="./Login.php" > Login</a> </label></div> ';
               
                   
     try
     {
        $stmt = $DBConnect->prepare("SELECT LecturesID, LecturerComputer,LecturerComputer,LecturerEmail ,LecturerFirstname ,LecturerLastname, LecturerRole,UserRoleName FROM lecturers inner JOIN userrole on lecturers.LecturerRole = userrole.UserRoleID where (lecturers.LecturerComputer=:lguserName or lecturers.LecturerEmail=:lguserName) and lecturers.LecturerPassword=:lgPassowrd");

        $stmt->bindParam(':lguserName',$userEmail,PDO::PARAM_STR);
        $stmt->bindParam(':lgPassowrd', $userPassword,PDO::PARAM_STR);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);

        if($stmt->rowCount()==1 && !empty($row))
        { 

            $_SESSION["userid"]=$row['LecturesID'];
            $_SESSION['username']= $row['LecturerFirstname'] . " " .$row['LecturerLastname'];//error
            if($row['UserRoleName'] == "admin")
            {
                $_SESSION["role"] =$row['UserRoleName']; 
                header('Location:../Admin/Dashboard/Dashboard.php');
                exit;
            }else if($row['UserRoleName'] == "staff"){
                $_SESSION["role"] =$row['UserRoleName']; 
                header('Location:../Admin/Dashboard/Dashboard.php');
                exit;
            }

        }
     }catch(PDOException $e)
     {
         echo '<div class="alert alert-danger">
                          Try Again! There was a problem Login Try Again.' . $e->getMessage().'</div> ';

     }  
      
                   
                   
               }catch(PDOException $e) {

                   echo '<div class="alert alert-danger">
                          Try Again! There was a problem Create an Account.' . $e->getMessage().'</div> ';

               }

                
        }
        
     
   }else
    {
        echo('Computer ID Number is required<br/>
        FirstName is required<br/>
        LastName is required<br/>
        Email Address
        Password is required 
       ');
    }
?>