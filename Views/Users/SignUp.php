<?php
ob_start();
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too--
// Start the session--
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title> Sign Up </title>
    <?php require("../Resources/bootstrapCDN.php"); ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="bg row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-xs-12" style=" background-color: rgba(01, 67, 01, 0.3); ">

                <div id="logoHeader ">
                    <img src="../Images/logo1.png" class="img-responsive center-block pull-left" alt="Logo" width="110" height="110" title="Logo" /> <img src="../Images/logo1.png" class="img-responsive center-block pull-right" alt="Logo" width="110" height="110" title="Logo" />
                    <h1 class="thumbnail h1-title">CS Department Class Timetable And Results Analysis</h1>

                </div>
                
                <div class="col-md-offset-2 col-md-8 ">

                    <!-- form <?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?> -->
                    <form method="POST" role="form" id="contact-form" action="SignUp.php" class="form thumbnail">

                        <h3 class="thumbnail ">User Sign Up</h1>
 <?php 
                         $usercomputerIDNumber=$userFirstName=$userLastName=$userEmail=$userPassword=$userPassword2="";
                             
                      if($_POST){ 
                          // include_once('../../Controller/SignUpController.php');
                          include_once('Logic/Signup_logic.php');
                        }
                        ?> 
                       
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="computerID" type="Number" value="<?php echo $usercomputerIDNumber;?>" class="form-control" name="computerIDNumber" title="Computer ID Number" placeholder="Enter Computer ID Number " required="required">
                        </div>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="userFirstName" type="text" value="<?php echo $userFirstName;?>" class="form-control" name="userFirstName" title="First Name" required="required" placeholder="Enter FirstName ">
                        </div>

                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="UserLastName" type="text" value="<?php echo $userLastName;?>" class="form-control" name="UserLastName" title="Last Name" placeholder="Enter LastName" required="required">
                        </div>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="UserEmail" type="Email" value="<?php echo $userEmail;?>" class="form-control" name="UserEmail" title="Email" required="required" placeholder="Enter Email : example@email.com">
                        </div>

                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="UserPassword" type="password" value="<?php echo $userPassword;?>" class="form-control" name="UserPassword" title="Password" required="required" placeholder="Password">
                        </div>
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="UserPassword2" type="password" value="<?php echo $userPassword2;?>" class="form-control" name="UserPassword2" title="repeat Password" required="required" placeholder=" repeat Password ">
                        </div>




                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                            <button id="submit" type="submit" name="submit" value="Sign UP" class="btn btn-success col-xs-12" > <i class="glyphicon glyphicon-ok-sign"></i> Sign UP</button>
                            </div>
                        </div>

                        <div class="text-left ">
                            <label title="Login">Already have an Account  <a  class="diva" href="./Login.php" > Login</a> </label>
                        </div>
                     <?php 
                         $usercomputerIDNumber=$userFirstName=$userLastName=$userEmail=$userPassword=$userPassword2="";
                             
                      if($_POST){ 
                          // include_once('../../Controller/SignUpController.php');
                          include_once('Logic/Signup_logic.php');
                        }
                        ?> <Br/><Br/>
                    </form>

                </div>
                

            </div>

        </div>

        <div style="margin-top:10%;">
            <?php include_once("../Template/Footer.php"); ?>
        </div>
    </div>
</body>

</html>

<script type="text/javascript">
    $(document).ready(function() {
        // Test for placeholder support
        $.support.placeholder = (function() {
            var i = document.createElement('input');
            return 'placeholder' in i;
        })();

        // Hide labels by default if placeholders are supported
        if ($.support.placeholder) {
            $('.form-label').each(function() {
                $(this).addClass('js-hide-label');
            });

            // Code for adding/removing classes here
            $('.form-group').find('input, textarea').on('keyup blur focus', function(e) {

                // Cache our selectors
                var $this = $(this),
                    $parent = $this.parent().find("label");

                switch (e.type) {
                    case 'keyup':
                        {
                            $parent.toggleClass('js-hide-label', $this.val() == '');
                        }
                        break;
                    case 'blur':
                        {
                            if ($this.val() == '') {
                                $parent.addClass('js-hide-label');
                            } else {
                                $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                            }
                        }
                        break;
                    case 'focus':
                        {
                            if ($this.val() !== '') {
                                $parent.removeClass('js-unhighlight-label');
                            }
                        }
                        break;
                    default:
                        break;
                }
                // previous implementation with ifs
                if (e.type == 'keyup') {
                    if ($this.val() == '') {
                        $parent.addClass('js-hide-label');
                    } else {
                        $parent.removeClass('js-hide-label');
                    }
                } else if (e.type == 'blur') {
                    if ($this.val() == '') {
                        $parent.addClass('js-hide-label');
                    } else {
                        $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
                    }
                } else if (e.type == 'focus') {
                    if ($this.val() !== '') {
                        $parent.removeClass('js-unhighlight-label');
                    }
                }
                
            });
        }
    });
</script>