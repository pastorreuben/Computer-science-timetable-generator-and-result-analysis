<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Staff | Settings </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>
     <link rel="stylesheet" href="Index.css">
   
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


            if(($_SESSION["role"]!="staff" || $_SESSION["role"]!="admin" ) && empty($_SESSION["username"])){
                header('location:../../Users/Login.php');
                die;
            }


            ?>




            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                   <!--   the Navigation bar  -->
                    <?php
                        include_once('../Template/Menu/StaffTopMenu.php');
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="container-fluid text-center">
                        <div class="row content">
                            <!--   the Sidemenu  -->
                            <div class="col-lg-2 col-sm-2 col-md-2 sidenav">

                                <?php include_once('../Template/Menu/StaffSideMenu.php');?>
                            </div>
                            <!--   the The Main Contents  -->
                            <div class="col-sm-8 col-lg-8 col-md-8 text-center">
                                <h1>Setting</h1>
                                
                                <hr>
                               
                                <p>Lorem ipsum...</p>
                            </div>
                            <!--   the right side Content  -->
                            <div class="col-lg-2 col-sm-2 col-md-2 sidenavR">
                                <br/><br/>
                            </div>
                        </div>
                    </div>
                    
          <!--   the footer Content  -->
                    <div style="">
                        <?php
                                    include_once("../../Template/Footer.php");
                                    ?>

                    </div>
                </div>
            </div>


    </div>
</body>

</html>