<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Schedules </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Schedules.css">


</head>

<body>
    <div class="container-fluid">

        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/Schedules_logic.php");
         

            ?>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--   the Navigation bar  -->
                    <?php
                        include_once('../Template/Menu/AdminTopMenu.php');
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="container-fluid text-center">
                        <div class="row content">
                            <!--   the Sidemenu  -->
                            <div class="col-lg-2 col-sm-2 col-md-2 sidenav">

                                <?php include_once('../Template/Menu/AdminSideMenu.php');?>
                            </div>

                            <!--   The The Main Contents  -->
                            <div class=" col-lg-9 col-md-9 col-sm-8 col-xs-12 text-center">
                                  <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>

                                <div class="centerContent">

                                    <ul class="nav nav-tabs  ">
                                        <li class="active"><a data-toggle="tab" href="#home">All Period Schedules</a></li>
                                        <li><a data-toggle="tab" href="#menu1">My Period Schedules</a></li>
                                       <!-- <li><a data-toggle="tab" href="#menu2">Courses C.A Overall Mark</a></li>-->
                                    </ul>

                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            <h2>  All  Period Schedules</h2>

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                <div class="table-responsive">
                                                 <table id="myTable" class="table table-hover table-bordered text-left">
                                                     <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Schedules Day</th>
                                                                <th>Schedules Time</th>
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
                    <td>'.$row['SecheduledDay'].'</td>
                    <td>'.$row['SecheduledTime'].'</td>
                 
                    <td><a href="edit_Schedules.php?value='.$row['SecheduledID'].'&btn_edit_link='.$row['SecheduledID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['SecheduledID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['SecheduledID'].'" role="dialog">
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
                            <form action="Schedules.php"   method="GET">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete" value="'.$row['SecheduledID'].'">Yes</button>&nbsp;
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
                                        <div id="menu1" class="tab-pane fade row">
                                           <h2>My Period Schedules</h2>
                                           
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                                <div class="thumbnail shadow">
                                                    <h3>Scheduled Time</h3>
                                                   <h2>ClassRoom</h2>
                                                    <a href="My_Schedules.php"><button type="button" class="btn btn-success transparent" data-toggle="modal" data-target="#verifyEdit">Edit</button> </a>&nbsp;
                                                    <button type="button" class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                                <div class="thumbnail shadow">
                                                    <h3>Scheduled Time</h3>
                                                   <h2>ClassRoom</h2>
                                                    <button type="button" class="btn btn-success transparent" data-toggle="modal" data-target="#verifyEdit">Edit</button>&nbsp;
                                                    <button type="button" class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                                <div class="thumbnail shadow">
                                                    <h3>Scheduled Time</h3>
                                                   <h2>ClassRoom</h2>
                                                    <button type="button" class="btn btn-success transparent" data-toggle="modal" data-target="#verifyEdit">Edit</button>&nbsp;
                                                    <button type="button" class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">
                                                <div class="thumbnail shadow">
                                                    <h3>Scheduled Time</h3>
                                                   <h2>ClassRoom</h2>
                                                    <button type="button" class="btn btn-success transparent" data-toggle="modal" data-target="#verifyEdit">Edit</button>&nbsp;
                                                    <button type="button" class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                                                </div>
                                            </div>

                                            <div class="row ">

                                            </div>

                                          
                                        </div>
                                      
                                    </div>
                                </div>
                              
                                
                            </div>

                            <!--   the right side Content  -->
                            <div class="col-lg-1 col-md-1  col-sm-2 col-xs-12 sidenavR">

                                <nav class="navbar navbar-inverse ">
                                    <div class="">
                                        <div class="navbar-header">
                                            <!--      <a class="navbar-brand" href="#"> </a> <ul class="nav navbar-nav">


                                        </ul> -->
                                        </div>

                                        <ul class="nav navbar-nav">
                                            <li><a href="Add_Schedules.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Schedules</a></li>
                                            <!--<li><a href="CA_Overal_Mark.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Courses</a></li>
                                           -- <li><a href="AssignCourse.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Assign Courses </a></li>-->
                                           
                                        </ul>
                                    </div>
                                </nav>

                            </div>
                        </div>


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