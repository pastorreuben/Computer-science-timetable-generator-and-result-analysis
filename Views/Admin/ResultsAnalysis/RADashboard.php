<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin |Results Analysis Dashboard  </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
  
    ?>


    <link rel="stylesheet" href="ResultsAnalysis.css">

</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
         // include_once("Logic/ResultsAnalysis_logic.php");
         

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
                            <!--   the The Main Contents  -->
                            <div class="col-sm-10 col-lg-10 col-md-10 text-center">
                                <h1>Results Anlaysis Dashboard</h1>

                                <?php 
                                
                    // include_once('../../../Controller/errors.php');
                     //include_once('../../../Controller/success.php');
                    ?>
                                <br/> <br/> <br/>


                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="ViewStudentResults.php">

                                        <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success" >View Student Results</h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">

                                                Take a view of all student results and class Performance
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>
                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="Import_Courses.php">

                                        <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success">Add Student Results</h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">
                                                Import  Student results at Once.<br/>or 
                                                Add a Single Student Record
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>

                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="ViewStudentInformation.php">
                                        
                                    <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success">View Student Information</h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">
                                                View student information and Import more Student All at once
                                                
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>
                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="ImportStudentInformation.php">

                                        <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success">Add Student</h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">
                                                View student information and Import more Student All at once
                                                
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>

                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="ResultsAnalysis.php">

                                        <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success">Results Analysis</h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">
                                                Print and Analysis course results.
                                                Student Performance 
                                               
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>

                                 <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 ">

                                    <a href="StdentImport.php">

                                        <div  class="panel panel-success">
                                            <div class="panel-heading">
                                                <h3 class="panel-title btn  text-success" >Student Results Summary </h3>
                                            </div>
                                            <div class="panel-body text-left" style="padding:10px;">
                                                Showing idivdual student Performances 
                                            </div>
                                            <div class="panel-footer"><span class="glyphicon glyphicon-plus"> </span></div>

                                        </div>
                                    </a>
                                </div>

                                


                            </div>

                        </div>
                    </div>

                    <!--   the footer Content  -->
                    <div style="margin-top:10%">
                        <?php
                                    include_once("../../Template/Footer.php");
                                    ?>

                    </div>
                </div>
            </div>


    </div>
</body>

</html>