
<?php

require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
$errors=array();
$success=array(); 


// this file validates user input
/*function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlentities($data);
    return $data;
}*/

if($_POST){
            

    $usercomputerIDNumber=test_input($_POST['compId']);//test_input to validates user inputs
    $userFirstName=test_input($_POST['firstname']);
    $userLastName=test_input($_POST['lastname']);
    $userEmail=test_input($_POST['email']);
    $userPassword=test_input($_POST['Currentpwd']);
    $userPassword2=test_input($_POST['Newpwd']);
            
    //if the new password is empty then user does not want to change the password..set new password to old password
    if(empty($userPassword2)){
        $userPassword2=$userPassword;
    }
    
    //checking if the passwrod and repeat passwrd does match

    if(empty($usercomputerIDNumber) || empty($userFirstName) || empty($userEmail) || empty($userPassword) || empty($userPassword2) )
    { 
       if(empty($usercomputerIDNumber)){
            array_push($errors,' Please Computer Id number  id required <br/>');
       } 
       if(empty($userFirstName)){
            array_push($errors,'Please first name is required <br/>');
       } 
       if(empty($userLastName)){
           array_push($errors,' Please last name is required <br/>');
       } 
       if(empty($userEmail)){
            array_push($errors,' You didnt Provide an Email required<br/>');
       } 
       if(empty($userPassword)){
            array_push($errors,'Passowrd can not be Empty <br/>');
       } 
        

    }else{
        //checking for charactors
        if(!preg_match("/^[a-zA-Z]*$/",$userFirstName) || !preg_match("/^[a-zA-Z]*$/",$userLastName) || !is_numeric($usercomputerIDNumber) || strlen($usercomputerIDNumber) < 8 || strlen($userPassword2) < 6 ){

           if(!preg_match("/^[a-zA-Z]*$/",$userFirstName)){ array_push($errors,'First Name should have Only letter <br/>');
           } 
           if(!preg_match("/^[a-zA-Z]*$/",$userLastName)){ array_push($errors,'Last Name should have Only letter <br/>');
           } 
           if(!is_numeric($usercomputerIDNumber)){array_push($errors,' Computer ID '.$usercomputerIDNumber.' has to be a number<br/>');
           }
            if(strlen($usercomputerIDNumber) < 8){ array_push($errors,'Computer ID '.$usercomputerIDNumber.' is to short length has to be 8<br/>');}
            if(strlen($userPassword2) < 6){ array_push($errors,' Passwords  are to short length has to be 6 or more<br/>');}

        }else {
                //checking emails
               if(!filter_var($userEmail,FILTER_VALIDATE_EMAIL)){
                   array_push($errors,'Invalid email address  <br/>');
               }else{
                    

                        // set the PDO error mode to exception
                        $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $DBConnect->prepare("SELECT  `LecturerPassword` FROM `lecturers` WHERE `LecturerComputer`='$usercomputerIDNumber' ");
                        $stmt->execute(); 
                   $hashed_password="";
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
                            $hashed_password=$row['LecturerPassword'];
                        }
                   
                  if(password_verify($userPassword, $hashed_password)){
                       //hashing the new passwords
                       $hashed_password2 = password_hash($userPassword2, PASSWORD_DEFAULT);

                       
                           //inserting user into database
                            try{
                                   // set the PDO error mode to exception
                                  $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                  $stmt = $DBConnect->prepare("UPDATE `lecturers` SET `LecturerEmail`=:userEmail,`LecturerFirstname`=:userFirstName,`LecturerLastname`=:userLastName,`LecturerPassword`=:userPassword WHERE `LecturerComputer`=:usercomputerIDNumber");

                                    $stmt->bindParam(':usercomputerIDNumber',$usercomputerIDNumber,PDO::PARAM_STR);
                                    $stmt->bindParam(':userEmail', $userEmail,PDO::PARAM_STR);
                                    $stmt->bindParam(':userFirstName', $userFirstName,PDO::PARAM_STR);
                                    $stmt->bindParam(':userLastName', $userLastName,PDO::PARAM_STR);
                                    $stmt->bindParam(':userPassword', $hashed_password2,PDO::PARAM_STR);//entering the hashed password
                                    $stmt->execute();
                                array_push($success,'Profile successful Editted');

                            }catch(PDOException $e) { array_push($errors,' Try Again! There was a problem Editting you Account.' . $e->getMessage().'<br/> ');}//end of try block
                   }else{
                        array_push($errors,'Current Password is Incorrent ! No changes made');
                     
                   }
               }

        }

    }
        
             

}



 if(isset($_SESSION["userid"])){
           
try{



          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $DBConnect->prepare("SELECT `LecturesID`, `UsersID`, `LecturerComputer`, `LecturerEmail`, `LecturerFirstname`, `LecturerLastname`, `LecturerPassword`, `LecturerRole`, `LecturerPhoto`, `LecturerAccountStatus`, userrole.UserRoleName FROM `lecturers` inner JOIN userrole on lecturers.LecturerRole=userrole.UserRoleID where LecturesID=".$_SESSION["userid"]);
       $stmt->execute();
     
        }catch(Exception $e){
        array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

       } 

  }


?>