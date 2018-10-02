<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | View Lecturer</title>


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Courses.css">


</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/view_Lectures_logic.php");
          /*  //checking that users are Login or Logout users
            if(isset($_POST['Logout'])){
              unset($_SESSION["username"]);
                 unset($_SESSION["role"]);
                unset($_SESSION["userid"]));
            session_destroy();

            }
        
         //checking that  Login user Role is Admin else redirect to Login.php$_SESSION["userid"]
            if(($_SESSION["role"]!="staff" || $_SESSION["role"]!="admin" ) && empty($_SESSION["username"]) && empty($_SESSION["userid"])){
                header('location:../../Users/Login.php');
                die;
            }
*/

            ?>
            <!--   Header   -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--   the Navigation bar  -->
                    <?php
                        include_once('../Template/Menu/AdminTopMenu.php');
                    ?>
                </div>
            </div>




            <div class="row content">

                <div class="col-md-8 col-md-offset-2 jumbotron" id="mainContent">
    
                    <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Lectures.php" > &larr;Back to Lecturers</a></h4>
                    <div class="row">
                        <div class="col-md-12">
                            
                           
                           <h2>View  Lecturer</h2> 
                            
                            
                            
                                          
                       <?php  
                                 $totallectures =0;      
       if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
               
                echo'                      
                                
                                
                                
            <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">'.$row['LecturerFirstname'].'    '.$row['LecturerLastname'].'</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                  <img alt="User Pic"  <img alt="User Pic" 
                  ';
                if(!empty($row["LecturerPhoto"]))
         {
                  echo 'src="data:image/jpeg;base64,'.base64_encode($row["LecturerPhoto"]).'"'; 
                  
          }else{ 
              echo 'src="https://cdn2.iconfinder.com/data/icons/website-icons/512/User_Avatar-512.png"'; 
         }
            echo '  class="img-thumbnail  img-responsive"> 
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody> 
               
                 
                <tr>
                    		<td>Computer ID:</td>
                    		<td><h3 class="text-success">'.$row['LecturerComputer'].'</h3></td>
                    	</tr>
                    	<tr>
                    		<td>First Name:</td>
                    		<td>'.$row['LecturerFirstname'].'</td>
                    	</tr>
                    	<tr>
                    		<td>Last Name:</td>
                    		<td>'.$row['LecturerLastname'].'</td>
                    	</tr>
                    	<tr>
                    		<td>Other Names:</td>
                    		<td>-</td>
                    	</tr>
                    	<tr>
                        <td>Email:</td>
                        <td>'.$row['LecturerEmail'].'</td>
                      </tr>
                      <tr>
                    		<td></td>
                    		<td></td>
                    	</tr>
                      <tr>
                        <td>Lecturer Role</td>
                        <td><h4 class="text-success">'.$row['UserRoleName'].'</h4></td>
                      </tr>
                     
                     
                      </tr>
                        
                    
                    
                    
                    
                    </tbody>
                  </table>
                  
                
                </div>
              </div>
            </div>
             
          </div>
                            
                                
                                
       ';

            }

        }
                                                      
?>                                            
                   
                    
                                     
                                
                                
                                
                                
                     
                            
                            
                            
                            
                            
                        </div>
                        <!-- /col-dm-12 -->
                    </div>
                    <!-- /row -->



                </div>

    </div>
    <!-- /row -->

   

    <!--   the footer Content  -->

    <!--   the footer Content  -->
    <div style="margin-top:5%;">
        <?php
                                    include_once("../../Template/Footer.php");
                                    ?>
    </div>


    </div>


</body>

</html>