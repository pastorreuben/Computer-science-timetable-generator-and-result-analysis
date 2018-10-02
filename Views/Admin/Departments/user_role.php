<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Add User Role </title>


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Courses.css">


</head>

<body>
    <div class="container-fluid ">

        <?php
            //checking that users are Login or Logout users
            if(isset($_POST['Logout'])){
              unset($_SESSION["username"]);
                 unset($_SESSION["role"]);
            session_destroy();

            }
        
         //checking that  Login user Role is Admin else redirect to Login.php
            if(($_SESSION["role"]!="staff" || $_SESSION["role"]!="admin" ) && empty($_SESSION["username"])){
                header('location:../../Users/Login.php');
                die;
            }


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

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 jumbotron" id="mainContent">

                    <div class="row">
                        
                    <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Courses.php" > &larr;Back to Courses</a></h4>
                        <div class="col-md-12">
                            
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                    


                                    <h4 class="">Add User Role </h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="AC_CourseName" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseName" type="text" class="form-control" name="AC_CourseName" title="Course Name" placeholder="Enter Course Name" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseCode" class="col-sm-4 control-label">Course Code</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseCode" type="text" class="form-control" name="AC_CourseCode" title=" Course Code" required="required" placeholder="Enter Course Code e.g CSC 1121 ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseLecturerID" class="col-sm-4 control-label">Course Lecturer ID</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseLecturerID" type="number" class="form-control" name="AC_CourseLecturerID" title="Course LecturerID" placeholder="Enter Course Lecture ID" required="required">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="AC_CourseDepID" class="col-sm-4 control-label">Courses DepartmentID</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseDepID" type="number" class="form-control" name="AC_CourseDepID" title="Course Department ID" required="required" placeholder="Enter Valid Course Department ID">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseTotalstudent" class="col-sm-4 control-label">Course Total Capcity</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseTotalstudent" type="number" class="form-control" name="AC_CourseTotalstudent" title="Course Total Student Capacity" required="required" placeholder="Course Total student Capacity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="YearOffered" class="col-sm-4 control-label">Course Total Capcity</label>
                                            <div class="col-sm-8">
                                                <select id="YearOffered" class="form-control" name="YearOffered" title="Select student year" required="required">
                                                     <option selected  value="-1">Select student year </option>
                                                    <option  value="2">Second Years</option>
                                                    <option  value="3">Third Years</option>
                                                    <option  value="4">Fouth Years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success col-xs-12" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Insert Course</button>
                                            </div>
                                        </div>


                                    </form>

                                </div>
                                <!-- /panel-body -->
                            </div>
                        </div>
                        <!-- /col-dm-12 -->
                    </div>
                    <!-- /row -->



                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 jumbotron">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="">
                           <li><a href="#" class="thumbnail shadow label"><span class="glyphicon glyphicon-upload"> </span> Import Courses</a></li> 
                        </div>

                    </div>



                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">
                   
                    <h4> <label class="label label-success"> All Department </label></h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th>ID </th>
                                    <th>Department Name</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>1232</td>
                                    <td>Computer Science Department</td>

                                </tr>

                            </tbody>
                        </table>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="verifyDelete" role="dialog">
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
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>&nbsp;
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <br/><br/><br/>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">
                    <h4> <label class="label label-success"> All Lectures </label> </h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Computer ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>14029049</th>
                                    <td>John</td>
                                    <td>Doe</td>

                                </tr>
                                <tr>
                                    <th>14029049</th>
                                    <td>Mary</td>
                                    <td>Moe</td>

                                </tr>
                                <tr>
                                    <th>14029049</th>
                                    <td>July</td>
                                    <td>Dooley</td>

                                </tr>
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>





    </div>
    <!-- /row -->

    <!-- show Added Courses -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h4> <label class="label label-success"> Courses Successfull Added </label> </h4>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Account Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                            <td>active</td>
                            <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                            <td>active</td>
                            <td>
                                </button>&nbsp;<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                            <td>active</td>
                            <td>
                                </button>&nbsp;<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>

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