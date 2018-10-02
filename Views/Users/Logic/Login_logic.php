<?php
   
if(isset($_POST['LoginBtn'])){ 
 
    require_once('Logic/validate_user_input.php');
    
    $usercomputerIDNumber=test_input($_POST['loginUserName']);//test_input to validates user inputs
    $userEmail=test_input($_POST['loginUserName']);
    $userPassword=test_input($_POST['loginPassword']);
   
    
        if(empty($usercomputerIDNumber) || empty($userEmail) || empty($userPassword) )
        { 
           if(empty($usercomputerIDNumber)){
                echo('<div class="alert alert-danger"> UserName/Email is required</div>');
           } 
          
           if(empty($userPassword)){
                echo('<div class="alert alert-danger"> Passowrd can not be Empty </div>');
           }
        }else{
             
                require_once('../../Model/PDO.php');

                // set the PDO error mode to exception
                $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $DBConnect->prepare("SELECT  `LecturesID`, `UsersID`, `LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerAccountStatus`,UserRoleName FROM lecturers inner JOIN userrole on lecturers.LecturerRole = userrole.UserRoleID where `LecturerComputer`='$usercomputerIDNumber' or `LecturerEmail`='$userEmail'");
                $stmt->execute(); 

               if($stmt->rowCount()<1  )
               {
                    echo('<div class="alert alert-danger">  Login Details are incorrent</div>');

               }else if($stmt->rowCount() == 1 ){
                   $hashed_password=""; 

                   while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                       $hashed_password=$row['LecturerPassword'];

                      if(password_verify($userPassword, $hashed_password)){

                            $_SESSION["userid"]=$row['LecturesID'];
                            $_SESSION['username']= $row['LecturerFirstname'] . " " .$row['LecturerLastname'];//error
                            $_SESSION["role"] =mb_strtolower($row['UserRoleName'],'UTF-8');//convert the string role into lower case
                          if(!empty($_SESSION["role"])){
                              $url='Location:../'.ucfirst($_SESSION["role"]).'/Dashboard/Dashboard.php';//ucfirst method capitalize the first latter. url varibale contain the path to redirect user depening on there role
                              header($url);
                                exit;
                            }

                          /* if(mb_strtolower($row['UserRoleName'],'UTF-8') == "staff"){header('Location:../Staff/Dashboard/Dashboard.php');
                                exit;
                            }else //if user is Admin
                               if(mb_strtolower($row['UserRoleName'],'UTF-8')== "admin"){header('Location:../Admin/Dashboard/Dashboard.php');
                                exit;
                            }else //if user is hod
                               if(mb_strtolower($row['UserRoleName'],'UTF-8')== "hod"){header('Location:../Hod/Dashboard/Dashboard.php');
                                exit;
                            }else //if user is Admin
                               if(mb_strtolower($row['UserRoleName'],'UTF-8') == "coordinator"){header('Location:../Coordinator/Dashboard/Dashboard.php');
                                exit;}*/

                      }else{
                           echo('<div class="alert alert-danger">  Incorrent Username and Password</div>'); 

                      }

                }//while
           }
      
    
        }
}

?>