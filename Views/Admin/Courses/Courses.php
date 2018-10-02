<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Courses </title>
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
          include_once("Logic/Courses_logic.php");
          

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
                                        <li class="active"><a data-toggle="tab" href="#home">All Courses</a></li>
                                        <li><a data-toggle="tab" href="#menu1">My Courses</a></li>
                                        <li><a data-toggle="tab" href="#menu2">Courses C.A Overall Mark</a></li>
                                        <li><a data-toggle="tab" href="#menu3">Grades</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            <h2> <label class=""> All Courses </label> </h2>

                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                <div class="table-responsive">

                                                    <table id="myTable" class="table table-hover table-bordered text-left">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Course name</th>
                                                                <th>Code</th>
                                                                <th>Type</th>
                                                                <th> Lecture</th>
                                                                <!-- <th>Department </th>-->
                                                                <th>Total Student</th>
                                                                <th>Academic Year</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php                                                       
      if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                 /* <th>'.$row['CourseDepartmentID'].'</th>*/
                
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['CourseName'].'</td>
                    <td>'.$row['CourseCode'].'</td>
                    <td>'.$row['courseType'].'</td>
                   <td> '.$row['LecturerFirstname'].'-'.$row['LecturerLastname'].'</td>
                  
                    <td>'.$row['CourseTotalStudent'].'</td>
                    <td>'.$row['YearOffer'].'</td>
                 
                    <td><a href="editCourses.php?value='.$row['CourseID'].'&btn_edit_link='.$row['CourseID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['CourseID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['CourseID'].'" role="dialog">
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
                            <form action="Courses.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete" value="'.$row['CourseID'].'">Yes</button>&nbsp;
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
                                        <div id="menu1" class="tab-pane fade ">

                                            <h3>My Courses</h3>

                                            <?php            
                                            
      if($stmt1->rowCount()>0 )
         {
             
             
             
           while( $row=$stmt1->fetch(PDO::FETCH_ASSOC))
            {
               
                echo'   
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="">'.$row['CourseName'].'  </h3>
        </div>
        <div class="panel-body">
        
            <table id="myTable" class="table table-user-information">
            <tbody class="text-left">
            <tr>
            <td>Course Code:</td>
            <td><h3 class="text-success">'.$row['CourseCode'].'</h3></td>
            </tr>
            <tr>
            <td>Course Year:</td>
            <td>'.$row['YearOffer'].' </td>
            </tr>

            <tr>
            <td>Type :</td>
            <td><span class="text-success">'.$row['courseType'].'</span></td>
            </tr>
            <tr>
            <td>Students No#</td>
            <td><h3 class="text-success">'.$row['CourseTotalStudent'].'</h3></td>
            </tr>


            </tbody>
            </table>

        </div>
        <div class="modal-footer">
           <span class="pull-left">
            <a href="editCourses.php?value='.$row['CourseID'].'&btn_edit_link='.$row['CourseID'].'" class="btn btn-info transparent"> Edit</a>&nbsp;
            </span>
           <span class="pull-right">
            <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete1'.$row['CourseID'].'">Delete</button>
            </span>
        </div>

    </div>


</div>
                      
                                
       ';
echo '  <div class="modal fade" id="verifyDelete1'.$row['CourseID'].'" role="dialog">
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
                            <form action="Courses.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete" value="'.$row['CourseID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }  
             
             
             
   

        }
            
                                                            
?>



                                        </div>
                                        <div id="menu2" class="tab-pane fade">
                                            <h3>Courses C.A Overall Mark</h3>

                                            <div class="table-responsive">
                                                <table id="myTable1" class="table table-hover table-bordered text-left">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Course</th>
                                                            <th>Test1</th>
                                                            <th>Test2</th>
                                                            <th>Test3</th>
                                                            <th>Quizs</th>
                                                            <th>Labs</th>
                                                            <th>Project</th>
                                                            <th>Assignments</th>
                                                            <th>C.A</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php  
                                                        
      if($stmt2->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt2->fetch(PDO::FETCH_ASSOC))
            {
                $marks=0.0;
                $marks= $row['Test_1(%)'] + $row['Test_2(%)'] + $row['Test 3(%)'] + $row['Quizs(%)'] + $row['Labs(%)'] + $row['Project(%)'] + $row['Assignments(%)']+0.0;
                echo'<tr>
                    <th>'.$int.'</th>
                    <td> '.$row['CourseCode'].'</td>
                    <td>'.$row['Test_1(%)'].'%</td>
                   <td>'.$row['Test_2(%)'].'%</td>
                   <th>'.$row['Test 3(%)'].'%</th>
                    <td>'.$row['Quizs(%)'].'%</td>
                    <td>'.$row['Labs(%)'].'%</td>
                    <td>'.$row['Project(%)'].'%</td>
                    <td>'.$row['Assignments(%)'].'%</td> 
                    <td><h3>'.$marks.'%</h3></td>
                 
                    <td><a href="CA_Overall_Mark.php?value='.$row['CA_MarksID'].'&btn_edit_Link='.$row['CA_MarksID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDeletes'.$row['CA_MarksID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDeletes'.$row['CA_MarksID'].'" role="dialog">
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
                            <form action="Courses.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Confirmdelete2" value="'.$row['CA_MarksID'].'">Yes</button>&nbsp;
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
                                        <div id="menu3" class="tab-pane fade ">


                                            <div class="col-md-12">
                                                <h3>Course Grades</h3>

                                                <div class="table-responsive">
                                                    <table id="myTable3" class="table table-hover table-bordered text-left">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Marks Range</th>
                                                                <th>gradeValue</th>
                                                                <th>description</th>
                                                               
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php  
                                                        
      if($stmt3->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt3->fetch(PDO::FETCH_ASSOC))
            {
                
                echo'<tr>
                    <th>'.$int.'</th>
                    <td>From  '.$row['minimum'].' - '.$row['maximum'].'</td>
                    <td><h3  class="text-primary">'.$row['gradeValue'].'</h3></td>
                   <td>'.$row['description'].'</td>
                
                    <td><a href="Grade.php?value='.$row['Id'].'&btn_edit_Link='.$row['Id'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDeletes'.$row['Id'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDeletes'.$row['Id'].'" role="dialog">
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
                            <form action="Courses.php"   method="get">
                                <button type="submit" class="btn btn-primary" name="Grade" value="'.$row['Id'].'">Yes</button>&nbsp;
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
                                    </div>


                                </div>
                            </div>
                            <!--   ADD COURSES Content  -->

                            <!--   the right side Content  -->
                            <div class="col-lg-1 col-md-1  col-sm-2 col-xs-12 sidenavR">

                                <nav class="navbar navbar-inverse ">
                                    <div class="">
                                        <div class="navbar-header">
                                            <!--      <a class="navbar-brand" href="#"> </a> <ul class="nav navbar-nav">


                                        </ul> -->
                                        </div>

                                        <ul class="nav navbar-nav">
                                         <?php  if(true){
                                               echo '<li><a href="Grade.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Grade</a></li>';
                                           } ?>
                                            <li><a href="Add_Course.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add Courses</a></li>
                                            <li><a href="CA_Overall_Mark.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Add  C.A Mark</a></li>
                                            <li><a href="AssignCourse.php" class="label"><span class="glyphicon glyphicon-plus"> </span> Assign Courses </a></li>
                                            <li><a href="#" class="label"><span class="glyphicon glyphicon-upload"> </span> Import Courses</a></li>
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








