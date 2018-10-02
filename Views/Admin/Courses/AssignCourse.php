<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Assign Courses </title>


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
       include_once("Logic/AssignCourse_logic.php");
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
                     <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>


                    <div class="row">
                            
                    <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Courses.php" > &larr;Back to Courses</a></h4>
                       
                            
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                    

                                    <h4 class="">Assign Courses</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                          <div class="form-group">
                                            <label for="AC_CourseName" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                               <select id="AC_CourseName" class="form-control" name="AC_CourseName" title="Select Course Name" required="required">
                                                   <option  value="-1">Select Course Name </option>
                                                    <?php 
                                                   
                                                         $stmt1 = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode` FROM `courses"); //WHERE lecturers.LecturesID=1
                                                    $stmt1->execute();
                                                         if($stmt1->rowCount()>0)
                                                        {
                                                           while( $row=$stmt1->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              if($AC_CourseLecturerID==$row['CourseID']){
                                                                   echo "<option selected value=".$row['CourseID'].">".$row['CourseCode']." ".$row['CourseName']."</option>";
                                                              }else{
                                                              echo "<option selected value=".$row['CourseID'].">".$row['CourseCode']." ".$row['CourseName']."</option>";}

                                                            
                                                         }
                                                        }
                                                     
                                                    ?>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseLecturerID" class="col-sm-4 control-label">Course Lecturer </label>
                                            <div class="col-sm-8">
                                                
                                                <select id="AC_CourseLecturerID" class="form-control" name="AC_CourseLecturerID" title="Select Course Lecturer" required="required">
                                                   <option  value="-1">Select Course Lecturer </option>
                                                    <?php 
                                                  
                                                         $stmt2 = $DBConnect->prepare("SELECT `LecturesID`,`UsersID`, `lecturers`.`LecturerFirstname`,`lecturers`.`LecturerComputer`,`lecturers`.`LecturerLastname` FROM `lecturers` "); //WHERE lecturers.LecturesID=1
                                                    $stmt2->execute();
                                                         if($stmt2->rowCount()>0)
                                                        {
                                                           while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              if($AC_CourseLecturerID==$row['LecturesID']){
                                                                   echo "<option selected value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";
                                                              }else{
                                                               echo "<option value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";
                                                              }

                                                         }
                                                        }
                                                     
                                                    ?>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success col-xs-12" name="btn_submit" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Assign Course</button>
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

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 hidden-xs jumbotron">
                   <br/>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4> <label class="label label-success"> All Unassigned Courses  </label> </h4>
                        <div class="table-responsive">
                            <table id="myTable" class="table table-hover table-bordered text-left">
                                <thead>
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Name</th>
                                        <th>Course Type</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                               $stmt2 = $DBConnect->prepare("SELECT `CourseID`, `CourseName`, `CourseCode`, `courseType`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent` FROM `courses` WHERE `CourseLecturerID`=''"); //WHERE lecturers.LecturesID=1
                                                    $stmt2->execute();
                                                         if($stmt2->rowCount()>0)
                                                        {
                                                           while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              
                                       echo "<tr>
                                        <th>".$row['CourseCode']."</th>
                                        <td>".$row['CourseName']."</td>
                                        <td>".$row['courseType']."</td>

                                    </tr>";
                                                         }
                                                        }
                                                    
                                  ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /row -->

            <!-- show Added Courses -->
            <div class="row">
               <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <h4> <label class="label label-success"> Course Successfull Added </label> </h4>
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

                </div>-->
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