<?php
   
if(isset($_POST['submit'])){
 
    require_once('Logic/validate_user_input.php');
    
    $usercomputerIDNumber=test_input($_POST['computerIDNumber']);//test_input to validates user inputs
    $userFirstName=test_input($_POST['userFirstName']);
    $userLastName=test_input($_POST['UserLastName']);
    $userEmail=test_input($_POST['UserEmail']);
    $userPassword=test_input($_POST['UserPassword']);
    $userPassword2=test_input($_POST['UserPassword2']);
    
    //checking if the passwrod and repeat passwrd does match
    if($userPassword != $userPassword2){
         echo('<div class="alert alert-danger"> Password did Not Match</div>');
    }else{
       
        if(empty($usercomputerIDNumber) || empty($userFirstName) || empty($userEmail) || empty($userPassword) || empty($userPassword2) )
        { 
           if(empty($usercomputerIDNumber)){
                echo('<div class="alert alert-danger"> Please Computer Id number  id required</div>');
           } 
           if(empty($userFirstName)){
                echo('<div class="alert alert-danger"> Please first name is required</div>');
           } 
           if(empty($userLastName)){
                echo('<div class="alert alert-danger"> Please last name is required</div>');
           } 
           if(empty($userEmail)){
                echo('<div class="alert alert-danger"> You didnt Provide an Email required</div>');
           } 
           if(empty($userPassword)){
                echo('<div class="alert alert-danger"> Passowrd can not be Empty </div>');
           } 
           if(empty($userPassword2)){
                echo('<div class="alert alert-danger">repeat Passowrd  can not be Empty</div>');
           } 
            
        }else{
            //checking for charactors
            if(!preg_match("/^[a-zA-Z]*$/",$userFirstName) || !preg_match("/^[a-zA-Z]*$/",$userLastName) || !is_numeric($usercomputerIDNumber) || strlen($usercomputerIDNumber) < 8 || strlen($userPassword) < 6 ){
               
               if(!preg_match("/^[a-zA-Z]*$/",$userFirstName)){ echo('<div class="alert alert-danger"> First Name should have Only letter </div>');
               } 
               if(!preg_match("/^[a-zA-Z]*$/",$userLastName)){ echo('<div class="alert alert-danger"> Last Name should have Only letter </div>');
               } 
               if(!is_numeric($usercomputerIDNumber)){echo('<div class="alert alert-danger"> Computer ID '.$usercomputerIDNumber.' has to be a number</div>');
               }
                if(strlen($usercomputerIDNumber) < 8){ echo('<div class="alert alert-danger"> Computer ID '.$usercomputerIDNumber.' is to short length has to be 8</div>');}
                if(strlen($userPassword) < 6){ echo('<div class="alert alert-danger"> Passwords  are to short length has to be 6 or more</div>');}
                
            }else {
                    //checking emails
                   if(!filter_var($userEmail,FILTER_VALIDATE_EMAIL)){
                       echo('<div class="alert alert-danger"> Invalid email address  </div>');
                   }else{
                        require_once('../../Model/PDO.php');
                       
                            // set the PDO error mode to exception
                            $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $stmt = $DBConnect->prepare("SELECT * FROM `lecturers` WHERE `LecturerComputer`='$usercomputerIDNumber' or `LecturerEmail`='$userEmail'");
                            $stmt->execute(); 
                            $row=$stmt->fetch(PDO::FETCH_ASSOC); 
                       if($stmt->rowCount()>0 )
                       {
                            echo('<div class="alert alert-danger"> Computer ID '.$usercomputerIDNumber.' or '.$userEmail.' is to already in use</div>');
                           
                       }else{
                           //hashing the password
                           $hashed_password = password_hash($userPassword, PASSWORD_DEFAULT);
                           
                           //check if the user computer number is allowed to create account
                           $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                           $stmt = $DBConnect->prepare("SELECT * FROM `users` where `UserComputerID`=$usercomputerIDNumber");
                           $stmt->execute();
                           if($stmt->rowCount()>0){
                               
                               //inserting user into database
                                try{
                                       // set the PDO error mode to exception
                                      $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                      $stmt = $DBConnect->prepare("INSERT INTO `lecturers` (`LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerAccountStatus`) VALUES (:usercomputerIDNumber, :userEmail,:userFirstName, :userLastName , :userPassword,'2', '1')");

                                        $stmt->bindParam(':usercomputerIDNumber',$usercomputerIDNumber,PDO::PARAM_STR);
                                        $stmt->bindParam(':userEmail', $userEmail,PDO::PARAM_STR);
                                        $stmt->bindParam(':userFirstName', $userFirstName,PDO::PARAM_STR);
                                        $stmt->bindParam(':userLastName', $userLastName,PDO::PARAM_STR);
                                        $stmt->bindParam(':userPassword', $hashed_password,PDO::PARAM_STR);//entering the hashed password
                                        $stmt->execute();

                                        try
                                        {
                                            $stmt = $DBConnect->prepare("SELECT LecturesID, LecturerComputer,LecturerComputer,LecturerEmail ,LecturerFirstname ,LecturerLastname, LecturerRole,UserRoleName FROM lecturers inner JOIN userrole on lecturers.LecturerRole = userrole.UserRoleID where (lecturers.LecturerComputer=:lguserName or lecturers.LecturerEmail=:lguserName) and lecturers.LecturerPassword=:lgPassowrd");

                                            $stmt->bindParam(':lguserName',$usercomputerIDNumber,PDO::PARAM_STR);
                                            $stmt->bindParam(':lgPassowrd', $hashed_password,PDO::PARAM_STR);
                                            $stmt->execute();
                                            $row=$stmt->fetch(PDO::FETCH_ASSOC);

                                            if($stmt->rowCount()==1 && !empty($row))
                                            { 
                                                $_SESSION["userid"]=$row['LecturesID'];
                                                $_SESSION['username']=$row['LecturerFirstname'] . " " .$row['LecturerLastname'];//error
                                                if(mb_strtolower($row['UserRoleName'],'UTF-8') =="staff"){
                                                    $_SESSION["role"] = $row['UserRoleName']; 
                                                    header('Location:../Staff/Dashboard/Dashboard.php');
                                                    exit;
                                                }

                                            }
                                            //header('Location: Login.php');
                                        }catch(PDOException $e){ echo '<div class="alert alert-danger"> There was a problem Login Try Again.  Account has being created!' . $e->getMessage().'</div> '; }
                                    
                                }catch(PDOException $e) { echo '<div class="alert alert-danger"> Try Again! There was a problem Create an Account.' . $e->getMessage().'</div> ';}//end of try block
                               
                           }else{
                                echo '<div class="alert alert-danger"> You computer is not registered for this service. Contact Head of Department or the Administrator </div> ';
                             }


                       
                       }
                   }
                   
            }
            
        }
        
    }
    
       
    
    
}
?>