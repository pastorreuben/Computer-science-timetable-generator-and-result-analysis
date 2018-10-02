<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Courses C.A Overall Mark </title>


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>

    <!-- To set the back ground Color for the left side bar -->
        <link rel="stylesheet" href="Schedules.css">



</head>

<body>
    <div class="container-fluid ">

        
        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/Lectures_logic.php");
         

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
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                    
                                    <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Schedules.php"> &larr;Back to Schedules</a></h4>
                                      <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>



                                    <h4 class="">Courses C.A Overall Mark</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="CA_Course_ID" class="col-sm-4 control-label">Course Name</label>
                                            <div class="col-sm-8">
                                                <select id="CA_Course_ID" class="form-control" name="CA_Course_ID" title="Select Course ID" required="required">
                                                     <option selected  value="-1">Select Course ID</option>
                                                    <option  value="2">11323</option>
                                                    <option  value="3">3535</option>
                                                    <option  value="4">5457</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Test_1" class="col-sm-4 control-label">Test 1(%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_1" type="decimal" class="form-control" name="CA_Test_1" title="Test 1(%)" placeholder="Enter Test 1(%)" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Test_2" class="col-sm-4 control-label">Test 2(%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_2" type="decimal" class="form-control" name="CA_Test_2" title=" Test 2(%)" required="required" placeholder="Enter Test 2(%) ">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Quizs" class="col-sm-4 control-label">Quizs (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Quizs" type="decimal" class="form-control" name="CA_Quizs" title="Quizs (%)" placeholder="Enter Quizs (%)" required="required">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="CA_Labs" class="col-sm-4 control-label">Labs (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Labs" type="decimal" class="form-control" name="CA_Labs" title="Labs (%)" required="required" placeholder="Enter Labs (%)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Assignments" class="col-sm-4 control-label">Assignments (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Assignments" type="decimal" class="form-control" name="CA_Assignments" title="Assignments (%)" required="required" placeholder="Enter Assignments (%)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Project" class="col-sm-4 control-label">Project (%)</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Project" type="decimal" class="form-control" name="CA_Labs" title="Project (%)" required="required" placeholder="Enter Project (%)">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" class="btn btn-success col-xs-12 transparent" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Insert C.A</button>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           
                                <li><a href="#" class="thumbnail shadow label"><span class="glyphicon glyphicon-upload"> </span> Import C.A</a></li>
                           

                        </div>

                      
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron">
                            <div class="text-left">
                                <p>sdgdsssssssssssssssfgdg<br>
                                    fffffffffffffffffffffgdg<br>
                                    fdgfdgddddddddddddddddddd<br>
                                    hgfhhhhhhhhhhhhhhhhhhhhhh<br>
                                    hhhhhhhfhfhhhhhhhhhhhhh<br>
                                    hhhhhhhhhhhhh
                                </p>

                            </div>

                        </div>

                    </div>

                </div>





            </div>
            <!-- /row -->

            <!-- show Added Courses -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <h3>Courses C.A Overall Mark</h3>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Course Name</th>
                                    <th>Test 1(%)</th>
                                    <th>Test 2(%)</th>
                                    <th>Quizs (%)</th>
                                    <th>Labs (%)</th>
                                    <th>Project (%)</th>
                                    <th>Assignments (%)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>1</th>
                                    <td>advaced</td>
                                    <td>csc4630</td>
                                    <td>Phiri</td>
                                    <td>CSC</td>
                                    <td>CSC</td>
                                    <td>2018</td>
                                    <td>2018</td>
                                    <td><a href="CA_Overal_Mark.php"><button type="button" class="btn btn-success transparent" data-toggle="modal" data-target="#verifyEdit">Edit</button> </a> &nbsp;
                                        <a href="CA_Overall_Mark.php"><button type="button" class="btn btn-primary transparent" data-toggle="modal" data-target="#verifyEdit">View</button> </a> &nbsp;
                                        <button type="button" class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete">Delete</button></td>
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