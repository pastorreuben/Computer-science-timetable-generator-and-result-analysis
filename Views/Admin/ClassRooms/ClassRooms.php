<?php session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title> Admin | ClassRooms </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>
    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="ClassRooms.css">

</head>

<body>
    <div class="container-fluid ">

         <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/ClassRooms_logic.php");
          


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
                        <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                        
                        
                        <div id="home" class="centerContent ">
                            <h2> <label class="label label-success"> All ClassRooms </label> </h2>
                          
                            <div class="table-responsive">
                                <table id="myTable1" class="table table-hover table-bordered text-left">
                                    <thead>
                                        <tr>
                                            
                                            <th>#</th>
                                            <th>ClassRooms name</th>
                                            <th>ClassRooms Capacity</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
                                          <?php  
                                 $totalclass =0;      
       if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                $totalclass ++; 
                
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['ClassRoomName'].'</td>
                    <td>'.$row['ClassRoomCapacity'].'</td>
                  
                    <td><a href="edit_ClassRooms.php?value='.$row['ClassRoomID'].'&btn_edit_link='.$row['ClassRoomID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['ClassRoomID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['ClassRoomID'].'" role="dialog">
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
                            <form action="ClassRooms.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete" value="'.$row['ClassRoomID'].'">Yes</button>&nbsp;
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
                               <h3>total ClassRooms</h3>
                              <div class="thumbnail shadow text-center">
                              
                             <h2> <?php echo $totalclass; ?></h2>
                                                    
                          </div> 
                        </div>

                        <nav class="navbar navbar-inverse ">
                             
                                <ul class="nav navbar-nav">
                                     <li><a href="Add_ClassRooms.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add ClassRooms </a></li>
                                    <!--<li><a href="View_Lectures.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Lectures</a></li>
                                    <li><a href="Assign_ClassRooms.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Assign ClassRooms </a></li>
                                    <li><a href="#" class="label"><span class="glyphicon glyphicon-upload"> </span> Import ClassRooms Details</a></li>-->
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