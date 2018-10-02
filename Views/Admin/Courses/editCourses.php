<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Edit Courses </title>


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
        include_once("Logic/editCourses_logic.php");
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
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                    

                                    <h4 class="">Edit Courses</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">
  
                                                   
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                         <div class="form-group">
                                            <label for="AC_id" class="col-sm-4 control-label"></label>
                                            <div class="col-sm-8">
                                                <input id="AC_id" type="hidden" class="form-control" name="AC_id" title="Course Name" placeholder="Enter Course Name" value="<?php echo $AC_id; ?>" >
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseName" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseName" type="text" class="form-control" name="AC_CourseName" title="Course Name" placeholder="Enter Course Name" value="<?php echo $AC_CourseName; ?>" required="required">
                                            </div>
                                          
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_CourseCode" class="col-sm-4 control-label">Course Code</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseCode" type="text" class="form-control" name="AC_CourseCode" title=" Course Code" required="required"  value="<?php echo $AC_CourseCode; ?>" placeholder="Enter Course Code e.g CSC 1121 ">
                                            </div>
                                        </div>
                                        
                                          <div class="form-group">
                                          <label for="AC_CourseLecturerID" class="col-sm-4 control-label">Course Lecturer</label>
                                            <div class="col-sm-8">
                                                <select id="AC_CourseLecturerID" class="form-control" name="AC_CourseLecturerID" title="Select student year" required="required">
                                                   <option  value="-1">Select Course Lecturer </option>
                                                    <?php 
                                                  
                                                    if(!empty($AC_CourseLecturerID)&&!empty($stmt2))
                                                    { 
                                                         if($stmt2->rowCount()>0 )
                                                        {
                                                           while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              if($AC_CourseLecturerID==$row['LecturesID']){
                                                                   echo "<option selected value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";
                                                              }else{
                                                              echo "<option  value=".$row['LecturesID'].">".$row['LecturerComputer']." ".$row['LecturerFirstname']." ".$row['LecturerLastname']."</option>";}

                                                            
                                                         }
                                                        }
                                                        
                                                    }
                                                    ?>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        


                                        <div class="form-group">
                                            <label for="AC_CourseDepID" class="col-sm-4 control-label">Courses DepartmentID</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseDepID" disabled type="number" class="form-control" name="AC_CourseDepID" title="Course Department ID" value="<?php echo $AC_CourseDepID; ?>"  required="required" placeholder="Enter Valid Course Department ID">
                                            </div>
                                        </div>
                                        
                                         <!--<div class="form-group">
                                          
                                            <div class="col-sm-8">
                                                <select id="YearOffered" class="form-control" name="YearOffered" title="Select student year" required="required">
                                                     <option  value="-1">Select student year </option>
                                                    <option  value="2">Second Years</option>
                                                    
                                                </select>
                                            </div>
                                        </div>-->
                                        
                                        <div class="form-group">
                                            <label for="AC_CourseTotalstudent" class="col-sm-4 control-label">Course Total Capcity</label>
                                            <div class="col-sm-8">
                                                <input id="AC_CourseTotalstudent" type="number" class="form-control" name="AC_CourseTotalstudent" value="<?php echo $AC_CourseTotalstudent; ?>" title="Course Total Student Capacity" required="required" placeholder="Course Total student Capacity">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="YearOffered" class="col-sm-4 control-label">Course offered year</label>
                                            <div class="col-sm-8">
                                                <select id="YearOffered" value="<?php echo $YearOffered; ?>"  class="form-control" name="YearOffered" title="Select Course offered year" required="required">
                                                     <option  value="-1">Select Course offered year </option>
                                                    <option <?php if(!empty($YearOffered) && $YearOffered =="Second Years") { echo 'Selected'; } ?> value="Second Years">Second Years</option>
                                                    <option <?php if(!empty($YearOffered) && $YearOffered =="Third Years") { echo 'Selected'; } ?> value="Third Years">Third Years</option>
                                                    <option <?php if(!empty($YearOffered) && $YearOffered =="Fouth Years") { echo 'Selected'; } ?> value="Fouth Years">Fouth Years</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success col-xs-12" id="generateReportBtn" name="btn_edit_course_submit"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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


                    </div>


                    <br/><br/><br/>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h4> <label class="label label-success"> All Lectures </label> </h4>
                        <div class="table-responsive">
                             <table id="myTable1" class="table table-hover table-bordered text-left">
                                <thead>
                                    <tr>
                                        <th>Computer ID</th>
                                        <th>Firstname</th>
                                        <th>Lastname</th>

                                    </tr>
                                </thead>
                                <tbody>

            
                                    <?php 
                                               $stmt2 = $DBConnect->prepare("SELECT `LecturesID`,`UsersID`, `lecturers`.`LecturerFirstname`,`lecturers`.`LecturerComputer`,`lecturers`.`LecturerLastname` FROM `lecturers`"); //WHERE lecturers.LecturesID=1
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