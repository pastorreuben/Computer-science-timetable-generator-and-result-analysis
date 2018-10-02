<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Edit ClassRooms </title>


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
          include_once("Logic/edit_ClassRooms_logic.php");
          


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
 
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 col-md-offset-2 jumbotron" id="mainContent">
                    <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="ClassRooms.php" > &larr;Back to ClassRooms</a></h4>
                    
                    
                     <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                       
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                  

                                    <h3 class="">Edit ClassRooms </h3> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="AC_id" class=" control-label"> </label>
                                            <div class="">
                                                <input id="AC_id" value="<?php echo $AC_id; ?>"   type="hidden" class="form-control" name="AC_id"  >
                                         </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_ClassRoomsname" class="col-sm-4 control-label"> ClassRooms name</label>
                                            <div class="col-sm-8">
                                                <input id="AC_ClassRoomsname" value="<?php echo $AC_ClassRoomsname; ?>"   type="text" class="form-control" name="AC_ClassRoomsname" title="Course Name" placeholder="Enter ClassRooms name" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="AC_ClassRoomsCapacity" class="col-sm-4 control-label">ClassRooms Capacity</label>
                                            <div class="col-sm-8">
                                                <input id="AC_ClassRoomsCapacity" value="<?php echo $AC_ClassRoomsCapacity; ?>"   type="text" class="form-control" name="AC_ClassRoomsCapacity" title=" Course Code" required="required" placeholder="Enter ClassRooms Capacity">
                                            </div>
                                        </div>

                                        <br/>
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" name="btn_saved_submit" class="btn btn-success col-xs-12" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save ClassRooms </button>
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

         
            <div style="margin-top:5%;">
                <?php
                    include_once("../../Template/Footer.php");
                ?>
            </div>


    </div>


</body>

</html>