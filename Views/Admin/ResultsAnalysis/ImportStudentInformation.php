<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Import Student Information  </title>
    <!-- To set the back ground Color for the left side bar -->
    <link rel="stylesheet" href="ResultsAnalysis.css">


    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>



</head>

<body>
    <div class="container-fluid ">

        <?php
          

         include_once('../Template/checkUser.php');
          include_once("Logic/ImportStudentInfo_login.php");

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
                
                 <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="RADashboard.php"> &larr;Back to Results Analysis DashBoard</a></h4>
                     <h4 class="pull-right"><span class="glyphicon glyphicon-door "></span> <a href="ViewStudentInformation.php"> View All  Imported Student &rarr; &nbsp;</a></h4>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron" style="padding-left:15%;padding-right:15%;margin-top:-1%" id="mainContent">

                    <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                    <div class="panel panel-success">
                        <div class="panel-heading ">

                            <h4 class="">Import Student Information</h4> <br/>
                        </div>
                       

                        <!-- /panel-heading -->
                        <div class="panel-body">
                            <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                 
                                <div class="form-group">
                                    <label for="file" class="col-sm-offset-2 col-sm-2 control-label">Select File</label>
                                   
                                    <div class="col-sm-8">
                                        <input type="file" value="" name="file" class="btn btn-success col-xs-12 form-control" id="file">&nbsp;

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">

                                        <button type="submit" value="import" name="btn_import_StudentInfo" class="btn btn-success col-xs-12" data-toggle="modal"><i class="glyphicon glyphicon-ok-sign">Import Student Information</i></button>&nbsp;

                                    </div>
                                </div>


                            </form>



                        </div>
                         <!-- /panel-body --><h3>Excel Sample</h3>
                         <img src="../../Images/student.png" class="col-sm-offset-3 img-responsive" width="70%" /> 

                    </div>
                
                </div>


            </div>
            <!-- /row -->


            <!--   the footer Content  -->
            <div style="margin-top:5%;">
                <?php
                                    include_once("../../Template/Footer.php");
                                    ?>
            </div>


    </div>


</body>

</html>