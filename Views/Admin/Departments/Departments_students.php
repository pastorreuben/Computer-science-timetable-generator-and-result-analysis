<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Student Results </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
  
    ?>


    <link rel="stylesheet" href="ResultsAnalysis.css">

</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/Departments_students_logic.php");

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
                <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Departments.php"> &larr;Return</a></h4>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron" style="padding-left:15%;padding-right:15%;margin-top:-1%" id="mainContent"> 
                   
                    <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                    <div class="panel panel-success">
                        <div class="panel-heading ">
                            

                            <h4 class="">Add / Edit Student Information </h4> <br/>
                        </div>
                        <!-- /panel-heading -->
                        <div class="panel-body">
                            <form class="form-horizontal"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                               
                                <div class="form-group">
                                    <label for="CA_MarksID" class="col-sm-4 control-label"></label>
                                    <div class="col-sm-8">
                                        <input id="CA_MarksID" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$ID";}?>" type="hidden" class="form-control" name="CA_MarksID" required="required">
                                    </div>
                                </div>
                            
                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                     <div class="form-group">
                                    <label for="studentId" class="col-sm-4 control-label">Student Computer ID</label>
                                    <div class="col-sm-8">
                                        <input id="studentId" <?php if(@($_GET['btn_edit_Link'] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){ echo "disabled";}?> value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]) || $_POST['btn_insert'] && $_POST['btn_insert']="insert")){  echo "$studentId";}?>"  type="number" class="form-control" name="studentId" required="required">
                                    </div>
                                </div>
                                    
                                      <div class="form-group">
                                    <label for="CA_Quizs" class="col-sm-4 control-label">Full Names</label>
                                    <div class="col-sm-8">
                                        <input id="CA_Quizs" type="text" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]) || $_POST['btn_insert'] && $_POST['btn_insert']="insert")){  echo $fullName;}?>" name="fullName"   placeholder="Enter Student Full Names" required="required">
                                    </div>
                                </div>
                                   
                                    
                                   

                                
                                    
                                </div><!-- end of inner div column 2-->
                                
                                
                                
                                
                                
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                      <div class="form-group">
                                    <label for="gendar" class="col-sm-4 control-label">Student Gendar</label>
                                    <div class="col-sm-8">
                                        <select id="gendar" class="form-control" name="gendar" title="Select Gendar" required="required">
                                                     
                                                      <option  value="-1">Select Student Gendar</option>
                                                    <?php 
                                                         if($gendar=="M"){
                                                            echo '<option  value="M">M</option>'; 
                                                         }else if($gendar=="F"){
                                                            
                                                                  echo '<option  value="F">F</option> ';
                                                         }else
                                                         {
                                                             echo '<option  value="M">M</option>';                                               echo'  <option  value="F">F</option>';
                                                         }
                                            
                                                     
                                                    ?>
                                                   </select>
                                    </div>
                                </div>

                                    <div class="form-group">
                                    <label for="month" class="col-sm-4 control-label">Year of Study</label>
                                    <div class="col-sm-8">
                                        <input type="month" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]) || $_POST['btn_insert'] && $_POST['btn_insert']="insert")){  echo $Year."-10";}?>" required="required" name="Year" class="form-control" id="month">&nbsp;

                                    </div>
                                </div>


                                    
                                </div><!-- end of inner div colomn-->
                                
                               
                                <div class="form-group">
                                    
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <?php
                                                try{
                                                    if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                    echo ' <button type="submit" value="edit" name="btn_edit" class="btn btn-success col-xs-12" data-toggle="modal"><i class="glyphicon glyphicon-ok-sign">Edit C.A</i></button>&nbsp;';
                                                    }else if(@!($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                        echo ' <button type="submit" value="insert" name="btn_insert"  class="btn btn-success col-xs-12 transparent">Insert C.A</button>&nbsp;';
                                                    }
                                                    
                                                }catch(Exception $e){
                                                    
                                                   
                                                }
                                                
                                                ?>
                                    </div>
                                </div>

                               <br/> <a href="Import_Courses.php" class="pull-left ">Click to Import  Students Departments Students </a>&nbsp;&nbsp;&nbsp;&nbsp;


                            </form>



                        </div>
                        <!-- /panel-body -->
                    </div>

                </div>


            </div>
            <!-- /row -->

            <!-- show Added Courses -->
            <div class="row">
                <!--
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