<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Lecturers </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Lectures.css">


</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/Lectures_logic.php");
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

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--   the Navigation bar  -->
                    <?php
                        include_once('../Template/Menu/AdminTopMenu.php');
                    ?>
                </div>
            </div>

            <div class="container-fluid text-center">
                <div class="row content">
                    <!--   the Sidemenu  -->
                    <div class="col-lg-2 col-sm-2 col-md-3 col-xs-12 sidenav">

                        <?php include_once('../Template/Menu/AdminSideMenu.php');?>
                    </div>

                    <!--   The The Main Contents  -->
                    <div class=" col-lg-8 col-md-8 col-sm-9 col-xs-12 text-center">
                        <div id="home" class="centerContent ">
                            <h4> <label class="label label-success"> All Lecturers </label> </h4>

                            <div class="table-responsive">
                               <table id="myTable1" class="table table-hover table-bordered text-left">
                                    <thead>
                                        <tr>
                                         
                                            <th>#</th>
                                            <th>ComputerID</th>
                                            <th>Email</th>
                                            <th>Firstname</th>
                                             <th>lastname</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     
                                      
                                       <?php  
                                 $totallectures =0;      
       if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
               $totallectures ++;
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['LecturerComputer'].'</td>
                    <td>'.$row['LecturerEmail'].'</td>
                   <td> '.$row['LecturerFirstname'].'</td>
                   <th>'.$row['LecturerLastname'].'</th>
                   
                    <td><a href="View_Lectures.php?value='.$row['LecturesID'].'&btn_View_link='.$row['LecturesID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">View</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['LecturesID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['LecturesID'].'" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal Content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h1 class="modal-title"><span class="label label-danger">Are You Sure?</span></h1>
                            </div>
                            <div class="modal-body">
                                <p>This record will permanently be deleted / removed from the system. Do you wish to continue?</p>
                            </div>
                            <div class="modal-footer">
                            <form action="Lectures.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete" value="'.$row['LecturesID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';//'.$row['grading_id'].'

                
                
                
                $int ++;

            }

        }
                                                      
?>                                            
                   
                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>

                    <!--   the right side Content  -->
                    <div class="col-lg-2 col-md-2  col-sm-12 col-xs-12 sidenavR">
                       
                          <div class="jumbroton shadow text-center">
                               <h3>total Lecturers</h3>
                              <div class="thumbnail shadow text-center">
                              
                             <h2> <?php echo $totallectures; ?></h2>
                                                    
                          </div> 
                        </div>

                        <nav class="navbar navbar-inverse ">
                             
                                <ul class="nav navbar-nav">
                                    <!--<li><a href="View_Lectures.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Lectures</a></li>-->
                                    <li><a href="Assign_Lectures.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Assign Lectures </a></li>
                                    <li><a href="#" class="label"><span class="glyphicon glyphicon-upload"> </span> Import Lectures Details</a></li>
                                </ul>
                        </nav>

                    </div>
                </div>


            </div>

            <!--   the footer Content  -->
            <div style="margin-top:10%;">
                <?php
                                    include_once("../../Template/Footer.php");
                                    ?>

            </div>


    </div>
</body>

</html>