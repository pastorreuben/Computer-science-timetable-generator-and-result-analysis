<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Profile </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>
     <link rel="stylesheet" href="Profile.css">
   
</head>

<body>
    <div class="container-fluid ">

      
        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/Profile_logic.php");
          

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



 <div class="row"> 
                    <div class="container-fluid text-center">
                        <div class="col-lg-2 col-sm-2 col-md-3 col-xs-12 sidenav">
                            <?php include_once('../Template/Menu/AdminSideMenu.php');?>
                        </div>

                    <!--   The The Main Contents  -->
                         <div class=" col-lg-8 col-md-8 col-sm-9 col-xs-12 text-center">
                        <div class=" jumbotron" id="mainContent">
                            <div class="row">
                        <div class="col-md-12">
                           <h2>User  Profile</h2>  
                           
                             <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>

                            
                            
                                          
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
              <h3 class="panel-title">My Profile :'.$row['LecturerFirstname'].'    '.$row['LecturerLastname'].'</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                  <img alt="User Pic" 
                  ';
                if(!empty($row["LecturerPhoto"]))
         {
                  echo 'src="data:image/jpeg;base64,'.base64_encode($row["LecturerPhoto"]).'"'; 
                  
          }else{ 
              echo 'src="https://cdn2.iconfinder.com/data/icons/website-icons/512/User_Avatar-512.png"'; 
         }
            echo '  class="img-thumbnail  img-responsive"> 
          
             <div class="form-group">
                <label class="control-label col-sm-6" for="lastname">Uploaded Profile Photo</label>
                <div class="col-sm-6"> 
                   <input type="file" class="form-control" id="profile" >
                </div>
              </div>
            
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
                    		<td>'.$row['LecturerFirstname'].' </td>
                    	</tr>
                    	<tr>
                    		<td>Last Name:</td>
                    		<td>'.$row['LecturerLastname'].'</td>
                    	</tr>
                    	<tr>
                    		<td></td>
                    		<td></td>
                    	</tr>
                    	<tr>
                        <td>Email:</td>
                        <td>'.$row['LecturerEmail'].'</td>
                      </tr>
                      <tr>
                    		<td>Role :</td>
                    		<td><h3 class="text-success">'.$row['UserRoleName'].'</h3></td>
                    	</tr>
                      <tr>
                        <td></td>
                        <td></td>
                      </tr>
                     
                      <tr> <td></td>
                       <td>
                    <button type="button"  class="btn btn-primary transparent" data-toggle="modal" data-target="#verifyDelete'.$row['LecturesID'].'">Edit Profile</button></td>
                    
                      </tr>
                      </tr>
                        
                    
                    
                    
                    
                    </tbody>
                  </table>
                  
                    <div class="modal fade" id="verifyDelete'.$row['LecturesID'].'" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal Content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="modal-title"><span class="label label-success">Make Changes to Your Profile</span></h3>
                            </div>
                            <div class="modal-body">
                            <form class="form-horizontal" action="Profile.php"   method="POST">
                                 <div class="form-group">
                                    <label class="control-label col-sm-3" for="compId">Computer ID</label>
                                    <div class="col-sm-9">
                                      <input type="hidden" class="form-control" required="required" value="'.$row['LecturerComputer'].'" name="compId" id="compId" placeholder="">
                                       <input type="text" disabled class="form-control" required="required" value="'.$row['LecturerComputer'].'" name="" id="" placeholder="">
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-3" for="firstname">First Name (*):</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" required="required" value="'.$row['LecturerFirstname'].'" name="firstname" id="firstname" placeholder="Enter First Name">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="lastname">Last Name (*):</label>
                                    <div class="col-sm-9"> 
                                      <input type="text" class="form-control" required="required" value="'.$row['LecturerLastname'].'" name="lastname" id="lastname" placeholder="Enter Last Name">
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">Email (*):</label>
                                    <div class="col-sm-9"> 
                                      <input type="email" name="email" class="form-control" required="required"  value="'.$row['LecturerEmail'].'" id="email" placeholder="Enter Email Address">
                                    </div>
                                  </div>
                                   <div class="form-group">
                                    <label class="control-label col-sm-3" for="Currentpwd">Current Password (*):</label>
                                    <div class="col-sm-9">
                                      <input type="password" name="Currentpwd" required="required"  value="" class="form-control" id="Currentpwd" placeholder="Enter Current password">
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-3" for="Newpwd">New Password:</label>
                                    <div class="col-sm-9"> 
                                      <input type="password" name="Newpwd" value="" class="form-control" id="Newpwd" placeholder="Enter New password Change or leave it empty">Leave new Password Empty to keep your current Password<br/>
                                    </div>
                                  </div>
                                 
                                  <div class="form-group"> 
                                    <div class="col-sm-offset-3 col-sm-9">
                                     <button type="submit" class="btn btn-primary" required="required" name="SaveChanges" value="'.$row['LecturesID'].'">Save Changes </button>&nbsp;
                                    </div>
                                  </div>
                                  
                                </form>
                            </div>
                            <div class="modal-footer">
                           
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                               
                            </div>
                        </div>
                    </div>
                </div>
                  
                
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
                        </div>    
                       </div> 
    <!-- /row --> </div>
           </div>
          <!--   the footer Content  -->
                    <div style="">
                        <?php
                                    include_once("../../Template/Footer.php");
                                    ?>

                    </div>
                </div>
            </div>


    </div>
</body>

</html>