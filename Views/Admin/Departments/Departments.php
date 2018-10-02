<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Departments </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Departments.css">


</head>

<body>
    <div class="container-fluid ">

       <?php
         include_once('../Template/checkUser.php');
           include_once("Logic/Department_logic.php");
          

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
                                <div class="centerContent">
                                     <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                        

                                    <ul class="nav nav-tabs  ">
                                        <li class="active"><a data-toggle="tab" href="#home">Departments</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Systems Users ComputerID</a></li>
                                        <li><a data-toggle="tab" href="#menu2">Students </a></li>
                                        <li><a data-toggle="tab" href="#menu3">User Role</a></li>
                                       <!-- <li><a data-toggle="tab" href="#menu2">Courses C.A Overall Mark</a></li>-->
                                    </ul>

                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            <h4> <label class="label label-success"> Departmental Summary</label> </h4>

                                           
  
                                                    
                                                    
                                                    
                                                    
                                                    
                                                                        
                       <?php  
                   
       if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
               
                echo'   
                 <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"> '.$row['LecturerFirstname'].'    '.$row['LecturerLastname'].'</h3>
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
          
            
            
        </div>
          <table id="" class="table table-user-information">
            <tbody class="text-left">
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
                <td>Role :</td>
                    <td><h3 class="text-success">'.$row['UserRoleName'].'</h3></td>
                </tr>


            </tbody>
          </table>

        </div>
            <div class="modal-footer"><h4 class="text-success"> '.$row['LecturerEmail'].'</h4></div>
        </div>

          </div>
                            
            
 </div>
                      
                                
       ';

            }

        }
                                                      
?>                                            
                   
                          
                                        </div>
                                        <div id="menu1" class="tab-pane fade row">
                                            <h3>Systems Users ComputerID</h3>
                                            <div class="col-lg-12 ">
                                               <div class="table-responsive">

                                                    <table id="myTable2" class="table table-hover table-bordered text-left">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Systems Users ComputerID</th>
                                                            <th>Availability Comment</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php  
                   
       if($stmt1->rowCount()>0 )
         {
             $int =1;
             while( $row=$stmt1->fetch(PDO::FETCH_ASSOC))
            {//`UserID`, `UserComputerID`
                $available='<Span class="text-danger">Not in user</span>';
                $action=false;
                 $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stm = $DBConnect->prepare("SELECT `LecturesID` FROM `lecturers` WHERE LecturerComputer=".$row['UserComputerID']);
                $stm->execute();
                
                if($stm->rowCount()>0){
                     $action=true;
                     $available='<Span class="text-success"> The ComptuerID has Account</span>';
                }
               
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['UserComputerID'].'</td>
                     <td>'.$available.'</td>';
                   if($action){
                       while($rows=$stm->fetch(PDO::FETCH_ASSOC)){
                           echo '<td>

                           <a href="../Lectures/View_Lectures.php?value='.$rows['LecturesID'].'&btn_View_link='.$rows['LecturesID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">View</button></a>&nbsp;
                         <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['UserID'].'">Delete</button>
                          </td>';
                          
                       }
                   }else{
                        echo '<td><button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['UserID'].'">Delete</button></td>';
                   }
                    
               echo '</tr>';
                
                
                 echo '  <div class="modal fade" id="verifyDelete'.$row['UserID'].'" role="dialog">
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
                            <form action="Departments.php"   method="POST">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete_user" value="'.$row['UserComputerID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
                
                $int++;
                

            }

        }
                                                      
?>                
                                                    </tbody>
                                                </table>
                                            </div>
                                                
                                            </div>
                                        </div>
                                        
                                           <div id="menu2" class="tab-pane fade row">
                                            <h3> Departments User Role</h3>
                                            <div class="col-lg-12 ">
                                               <div class="table-responsive">

                                                    <table id="myTable3" class="table table-hover table-bordered text-left">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Cmmputer ID</th>
                                                            <th>Full Names</th>
                                                             <th>Gender</th>
                                                            <th>Year Of Study</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                        <?php  
                   
       if($stmt3->rowCount()>0 )
         {
             $int =1;
             while( $row=$stmt3->fetch(PDO::FETCH_ASSOC))
            {//`StudentComputerID`, `FullNames`, `Gander`, `YearOfStudy`, `StudentStatus`
                
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['StudentComputerID'].'</td>
                     <td>'.$row['FullNames'].'</td> 
                     <td>'.$row['Gander'].'</td>
                     <td>'.$row['YearOfStudy'].'</td>
                     <td> <a href="Departments_students.php?value='.$row['StudentComputerID'].'&btn_edit_Link='.$row['StudentComputerID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                         <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['StudentComputerID'].'">Delete</button>
                          </td>
                          
                      </tr>';
                
                
                 echo '  <div class="modal fade" id="verifyDelete'.$row['StudentComputerID'].'" role="dialog">
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
                            <form action="Departments.php"   method="POST">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete_Student" value="'.$row['StudentComputerID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
                
                $int++;
                

            }

        }
                                                      
?>                
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                           <div id="menu3" class="tab-pane fade row">
                                            <h3> Departments</h3>
                                            <div class="col-lg-12 table-responsive">
                                                 <div class="table-responsive">

                                                    <table id="myTable" class="table table-hover table-bordered text-left">
                                                    <thead>
                                                        <tr>
                                                           <th>#</th>
                                                            <th>Role </th>
                                                            <th>Description</th>
                                                           
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         <?php  
                   
       if($stmt2->rowCount()>0 )
         {
             $int =1;
             while( $row=$stmt2->fetch(PDO::FETCH_ASSOC))
            {//`StudentComputerID`, `FullNames`, `Gander`, `YearOfStudy`, `StudentStatus`
                
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['UserRoleName'].'</td>
                     <td>'.$row['UserRoleDescription'].'</td> 
                     <td>

                           <a href="#?value='.$rows['UserRoleID'].'&btn_View_link='.$rows['UserRoleID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                         <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['UserRoleID'].'">Delete</button>
                          </td>
                          
                      </tr>';
                
                
                 echo '  <div class="modal fade" id="verifyDelete'.$row['UserRoleID'].'" role="dialog">
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
                            <form action="Departments.php"   method="POST">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete_role" value="'.$row['UserRoleID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
                
                $int++;
                

            }

        }
                                                      
?>                
                                                    </tbody>
                                                </table>
                                            </div>
                                                
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                                <!--   ADD COURSES Content  -->


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
                                             <li><a href="Add_Departments.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add  System <br/>User</a></li>
                                             <li><a href="Departments_students.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Student<br/>User </a></li>
                                            <li><!--<a href="Add_Departments.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add User Role</a>--></li>
                                           
                                          
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