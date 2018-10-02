<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Edit Schedules </title>


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
          include_once("Logic/edit_Schedules_logic.php");
         

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
                          <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="Schedules.php"> &larr;Back to Schedules</a></h4>
                          <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>


                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading ">
                                   

                                    <h4 class="">Edit Schedules</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">

                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                          <div class="form-group">
                                            <label for="Scheduleday" class="col-sm-4 control-label">Schedule day</label>
                                            <div class="col-sm-8">
                                                <select id="Scheduleday" class="form-control" name="Scheduleday" title="Select Schedule day" required="required">
                                                     <option  value="-1">Select Schedule day</option>
                                                    <option <?php if($Scheduleday =="Monday"){echo "selected";} ?> value="Monday">Monday Only</option>
                                                    <option <?php if($Scheduleday =="Tuesday"){echo "selected";} ?> value="Tuesday">Tuesday Only</option>
                                                    <option <?php if($Scheduleday =="Wednesday"){echo "selected";} ?> value="Wednesday">Wednesday Only</option>
                                                    <option <?php if($Scheduleday =="Thursday"){echo "selected";} ?> value="Thursday">Thursday Only</option>
                                                    <option <?php if($Scheduleday =="Friday"){echo "selected";} ?> value="Friday">Friday Only</option>
                                                    
                                                    
                                                </select>
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="SchedulesTime" class="col-sm-4 control-label">Period Time Start</label>
                                            <div class="col-sm-8">
                                                <input id="SchedulesTimeStart" type="time" class="form-control" name="SchedulesTimeStart" title="Schedules Time" value="<?php echo $SchedulesTimeStart; ?>" required="required" placeholder="Enter Valid Schedules Time example 07:00">
                                            </div>
                                        
                                        </div>
                                        <div class="form-group">
                                            <label for="SchedulesTime" class="col-sm-4 control-label">Period Time End</label>
                                            <div class="col-sm-8">
                                                <input id="SchedulesTimeEnd" type="time" class="form-control" name="SchedulesTimeEnd" title="Schedules Time" value="<?php echo $SchedulesTimeEnd; ?>" required="required" placeholder="Enter Time End example 07:50">
                                            </div>
                                        
                                        </div>
                                     
                                        <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <button type="submit" value="<?php echo $SecheduledID; ?>"  name="btn_editSchedule" class="btn btn-success col-xs-12" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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
                    



                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                   
                    <h4> <label class="label label-success"> All Schedules </label></h4>
                    <div class="table-responsive">
                        <table id="myTable1" class="table table-hover table-bordered text-left">
                              <thead>
                                <tr>

                                    <th>Schedule day </th>
                                    <th>Schedules Time</th>

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


            </div>


            </div>
           

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