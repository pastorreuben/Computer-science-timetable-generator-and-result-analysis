<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Courses C.A Overall Mark </title>
    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="Courses.css">


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>



</head>

<body>
    <div class="container-fluid ">

        <?php
         
         include_once('../Template/checkUser.php');
          include_once("Logic/CA_Overall_Mark_logic.php");

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
                <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Courses.php"> &larr;Back to Courses</a></h4>
 
              
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron" style="padding-left:15%;padding-right:15%;margin-top:-1%" id="mainContent">

                   <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                            <div class="panel panel-success">
                                <div class="panel-heading ">

                                    <h4 class="">Courses C.A Overall Mark</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="CA_MarksID" class="col-sm-4 control-label"></label>
                                            <div class="col-sm-8">
                                                <input id="CA_MarksID" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$gCA_MarksID";}?>" type="hidden" class="form-control" name="CA_MarksID" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Course_Name" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <select id="CA_Course_Name" <?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"disabled";}?> class="form-control" name="CA_Course_Name" title="Select Course ID" required="required">
                                                     <option   value="-1">Select Course </option>
                                                    
                                                      <?php 
                                                   
                                                         $stmt2 = $DBConnect->prepare("SELECT `courses`.`CourseID`, `CourseName`, `CourseCode`, `CourseLecturerID`, `CourseDepartmentID`, `YearOffer`, `CourseTotalStudent` FROM `courses` LEFT OUTER JOIN ca_marks on `courses`.`CourseID` = ca_marks.CourseID RIGHT JOIN lecturers ON `courses`.`CourseLecturerID`=lecturers.LecturesID where `courses`.CourseLecturerID=".$_SESSION["userid"]); //WHERE lecturers.LecturesID=1
                                                         $stmt2->execute();
                                                         if($stmt2->rowCount()>0)
                                                        {
                                                            
                                                          
                                                              while( $row=$stmt2->fetch(PDO::FETCH_ASSOC)) 
                                                              {
                                                                  if($CA_Course_Name==$row['CourseID']){
                                                                       echo "<option selected value=".$row['CourseID'].">".$row['CourseCode']."-".$row['CourseName']."</option>";
                                                                  }else{
                                                                  echo "<option value=".$row['CourseID'].">".$row['CourseCode']."-".$row['CourseName']."</option>";}


                                                             }
                                                           
                                                        }
                                                     
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                           
                                        <div class="form-group">
                                            <label for="CA_Test_1" class="col-sm-4 control-label">Test 1(%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_1" type="number" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Test_1";}?>" name="CA_Test_1" title="Test 1 Overall mark"  step='0.01' placeholder="Enter Test 1 Overall mark" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Test_2" class="col-sm-4 control-label">Test 2(%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_2" type="number" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Test_2";}?>" class="form-control" name="CA_Test_2" title=" Test 2(%)"  step='0.01' required="required" placeholder="Enter Test 2 Overall mark ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Test_3" class="col-sm-4 control-label">Test 3(%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_3" type="number" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Test_3";}?>" name="CA_Test_3" step='0.01'  title=" Test 3(%)"  placeholder="Enter Test 3 Overall mark ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Quizs" class="col-sm-4 control-label">Quizs (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Quizs" type="number" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Quizs";}?>" name="CA_Quizs" title="Quizs (%)" step='0.01' placeholder="Enter Quizs Overall mark or 0 if no Quiz" required="required">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="CA_Labs" class="col-sm-4 control-label">Labs (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Labs" type="number" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Labs";}?>" name="CA_Labs" title="Labs (%)" required="required"  step='0.01' placeholder="Enter Labs Overall mark or 0 if no Lab">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Assignments" class="col-sm-4 control-label">Assignments (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Assignments" type="number" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Assignments";}?>" class="form-control" name="CA_Assignments" title="Assignments (%) " step='0.01' required="required" placeholder="Enter Assignments Overall mark or 0 if no Assignment">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Project" class="col-sm-4 control-label">Project (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Project" type="number" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$CA_Project";}?>" class="form-control" name="CA_Project" step='0.01' title="Project (%)" required="required" placeholder="Enter Project Overall mark or 0 if no project">
                                            </div>
                                        </div>


                                         <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php
                                                try{
                                                    if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                    echo ' <button type="submit" value="edit" name="btn_edit" class="btn btn-success col-xs-12" data-toggle="modal"><i class="glyphicon glyphicon-ok-sign">Edit C.A</i></button>&nbsp;
                                                ';
                                                    }else if(@!($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                        echo ' <button type="submit" value="insert" name="btn_insert"  class="btn btn-danger col-xs-12">Insert C.A</button>&nbsp;';
                                                    }
                                                    
                                                }catch(Exception $e){
                                                    
                                                   
                                                }
                                                
                                                ?>
                                              
                                                
                                                
                                          
                                            </div>
                                        </div>


                                    </form>
                                  


                                </div>
                                <!-- /panel-body -->
                            </div>
                       
                </div>


            </div>
            <!-- /row -->

            <!-- show Added Courses -->
            <div class="row"><!--
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                </div>-->
            </div>
            <!--   the footer Content  -->
            <div style="margin-top:5%;">
                <?php
                    include_once("../../Template/Footer.php");
                ?>
            </div>


    </div>


</body>

</html>