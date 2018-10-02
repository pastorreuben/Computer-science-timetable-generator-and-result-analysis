<?php session_start();
?>
<!DOCTYPE html>

<html>

<head>
    <title> Admin | Grades </title>
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
          include_once("Logic/Grade_logic.php");

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

                                    <h4 class="">Grade</h4> <br/>
                                </div>
                                <!-- /panel-heading -->
                                <div class="panel-body">
                                    <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="">
                                        <div class="form-group">
                                            <label for="CA_MarksID" class="col-sm-4 control-label"></label>
                                            <div class="col-sm-8">
                                                <input id="CA_MarksID" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$Id";}?>" type="hidden" class="form-control" name="Id" required="required">
                                            </div>
                                        </div>
                                       
                                           
                                        <div class="form-group">
                                            <label for="CA_Test_1" class="col-sm-4 control-label">Minimum</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_1" type="number" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$min";}?>" name="min" title="minimum value" placeholder="Enter minimum value" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="CA_Test_2" class="col-sm-4 control-label">Maximum</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_2" type="number" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo "$max";}?>" class="form-control" name="max" title=" maximun value" required="required" placeholder="Enter maximun value ">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="CA_Test_3" class="col-sm-4 control-label">Grade</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_3" type="text" class="form-control" value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo"$grade";}?>" name="grade" title=" grade" required="required" placeholder="Enter Grade  example A+">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label for="CA_Test_2" class="col-sm-4 control-label">Description</label>
                                            <div class="col-sm-8">
                                                <input id="CA_Test_2" type="text" multiple  value="<?php if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){  echo "$descr";}?>" class="form-control" name="descr" title=" description"  placeholder="Enter description ">
                                            </div>
                                        </div>
                                       
                                       

                                         <div class="form-group">
                                            <div class="col-sm-offset-2 col-sm-10">
                                                <?php
                                                try{
                                                    if(@($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                    echo ' <button type="submit" value="edit" name="btn_edit" class="btn btn-success col-xs-12" data-toggle="modal"><i class="glyphicon glyphicon-ok-sign">Edit Grade</i></button>&nbsp;
                                                ';
                                                    }else if(@!($_GET["btn_edit_Link"] || ($_POST["btn_edit"]=="edit" && $_POST["btn_edit"]))){
                                                        echo ' <button type="submit" value="insert" name="btn_insert"  class="btn btn-danger col-xs-12">Add Grade</button>&nbsp;';
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


            <!--   the footer Content  -->
            <div style="margin-top:5%;">
                <?php
                                    include_once("../../Template/Footer.php");
                                    ?>
            </div>


    </div>


</body>

</html>