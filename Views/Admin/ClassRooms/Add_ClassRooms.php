<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Add Lectures</title>


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
          include_once("Logic/Add_ClassRooms_logic.php");
          


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
                      <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="ClassRooms.php" > &larr;Back to ClassRooms</a></h4>
                    
                    
                     <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                       
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                    <!--<h5 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="ClassRooms.php" class=" label label-success">Back to ClassRooms</a></h5>
-->

                                    <h3 class="">Add ClassRooms </h3> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="AC_ClassRoomsname" class="col-sm-4 control-label"> ClassRooms name</label>
                                            <div class="col-sm-8">
                                                <input id="AC_ClassRoomsname" type="text" class="form-control" name="AC_ClassRoomsname" title="Course Name" placeholder="Enter ClassRooms name" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_ClassRooms" class="col-sm-4 control-label">ClassRooms Capacity</label>
                                            <div class="col-sm-8">
                                                <input id="AC_ClassRooms" type="number" class="form-control" name="AC_ClassRoomsCapacity" title=" Course Code" required="required" placeholder="Enter ClassRooms Capacity">
                                            </div>
                                        </div>

                                        <br/>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="btn_addClassRooms" class="btn btn-success col-xs-12" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Add ClassRooms </button>
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
                       

                    </div>
  
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">
                           <div class="jumbroton shadow text-center"></br>  <h4> <label > All ClassRooms </label> </h4>
                            <div class="thumbnail shadow">
                                <h1><?php
                                    
                                    
                                     $stmt = $DBConnect->prepare("SELECT * FROM `classrooms`");

        $stmt->execute();
         if($stmt->rowCount()>0 )
         {
           echo $stmt->rowCount();
          }                          
                                    ?></h1>
                            </div>
                        </div>
                      </div>

<br/>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-xs ">

                      
                     

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