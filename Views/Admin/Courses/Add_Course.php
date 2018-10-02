<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Add Courses </title>


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
           include_once("Logic/Add_Course_logic.php");


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
                                    


                                    <h4 class="">Add Courses</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" id="">
                                        <div class="form-group">
                                            <label for="AC_ID" class="col-sm-4 control-label"></label>
                                            <div class="col-sm-8">
                                                <input id="AC_ID" type="hidden" class="form-control" name="AC_ID" required="required">
                                               </div>
                                            </div>
                                        <div class="form-group">
                                            <label for="AC_CourseName" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseName" type="text" value="<?php echo $AC_CourseName; ?>" class="form-control" name="AC_CourseName" title="Course Name" placeholder="Enter Course Name" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseCode" class="col-sm-4 control-label">Course Code</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseCode" type="text" value="<?php echo $AC_CourseCode; ?>"   class="form-control" name="AC_CourseCode" title=" Course Code" required="required" placeholder="Enter Course Code e.g CSC 1121 ">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <label for="courseType" class="col-sm-4 control-label">Course Type</label>
                                            <div class="col-sm-8">
                                                 <select id="courseType" value="<?php echo $courseTypes; ?>"  class="form-control" name="courseTypes" title="Select Course Type" required="required">
                                                     <option selected  value="-1">Course Type year </option>
                                                    <option  value="FullCourse">Full Course</option>
                                                    <option  value="FirstHalf">First Half</option>
                                                    <option  value="SecondHalf">Second Half</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseLecturerID" class="col-sm-4 control-label">Course Lecturer ID</label>
                                            <div class="col-sm-8">
                                                
                                                <select id="AC_CourseLecturerID" class="form-control" name="AC_CourseLecturerID" title="Select student year" required="required">
                                                   <option  value="-1">Select Course Lecturer </option>
                                                    <?php 

                                                         $stmt2 = $DBConnect->prepare("SELECT `LecturesID`, `LecturerComputer`, `LecturerFirstname`, `LecturerLastname` FROM `lecturers` WHERE 1"); //WHERE lecturers.LecturesID=1
                                                    $stmt2->execute();
                                                         if($stmt2->rowCount()>0)
                                                        {
                                                           while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              if($AC_CourseLecturerID==$row['LecturesID']){
                                                                   echo "<option selected value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";
                                                              }else{
                                                              echo "<option  value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";}

                                                            
                                                         }
                                                        }
                                                     
                                                    ?>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>
                                         


                                        <div class="form-group">
                                            <label for="AC_CourseDepID" class="col-sm-4 control-label">Courses DepartmentID</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseDepID" disabled type="number" value="<?php echo $AC_CourseDepID; ?>"   class="form-control" name="AC_CourseDepID" title="Course Department ID" required="required" placeholder="Enter Valid Course Department ID">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseTotalstudent" class="col-sm-4 control-label">Course Total Capcity</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseTotalstudent" type="number" value="<?php echo $AC_CourseTotalstudent; ?>"   class="form-control" name="AC_CourseTotalstudent" title="Course Total Student Capacity" required="required" placeholder="Course Total student Capacity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="YearOffered" class="col-sm-4 control-label">Course offered year</label>
                                            <div class="col-sm-8">
                                                 <select id="YearOffered" value="<?php echo $YearOffered; ?>"  class="form-control" name="YearOffered" title="Select Course offered year" required="required">
                                                     <option selected  value="-1">Course offered year </option>
                                                    <option  value="Second Years">Second Years</option>
                                                    <option  value="Third Years">Third Years</option>
                                                    <option  value="Fouth Years">Fouth Years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success col-xs-12" name="btn_add_course" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Insert Course</button>
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
                    <h2> <label class="label label-success"> All Lectures </label> </h2>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered text-left">
                            <thead>
                                <tr>
                                    <th>Computer ID</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                               $stmt2 = $DBConnect->prepare("SELECT `LecturesID`,`UsersID`, `lecturers`.`LecturerFirstname`,`lecturers`.`LecturerComputer`,`lecturers`.`LecturerLastname` FROM `lecturers` "); //WHERE lecturers.LecturesID=1
                                                    $stmt2->execute();
                                                         if($stmt2->rowCount()>0)
                                                        {
                                                           while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              
                                       echo "<tr>
                                        <th>".$row['LecturerComputer']."</th>
                                        <td>".$row['LecturerFirstname']."</td>
                                        <td>".$row['LecturerLastname']."</td>

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