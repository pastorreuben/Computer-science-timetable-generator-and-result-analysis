<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
// Start the session
 session_start();
 if(!(isset($_POST['LoginBtn']))){
              unset($_SESSION["username"]);
                 unset($_SESSION["role"]);
            session_destroy();

            }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title> Login User </title>
    <?php 
    require("../Resources/bootstrapCDN.php");


?>
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
                <div class="col-lg-3 col-md-3 col-sm-1 col-xs-12">

                </div>
                <div class="col-lg-6 col-md-8 col-sm-10 col-xs-12">


                    <form method="POST" role="form" id="contact-form" class="form thumbnail" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                        <?php 

                        if($_SERVER["REQUEST_METHOD"] == "POST")
                    {//$_SERVER["REQUEST_METHOD"] == "POST" or (isset($_POST['submit'])
                        //include_once('../../Controller/LoginController.php');
                        include_once('Logic/Login_logic.php');
                    } 
                    ?>
                         <br/><br/>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>

                            <input type="text" class="form-control" id="name" placeholder="Username or Computer Number" name="loginUserName" title="UserName or Computer Number" tabindex="1" required>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                           <input type="Password" class="form-control" id="email" name="loginPassword" title="Password" placeholder="Password" tabindex="2" required>
                        </div>
                        <div id="" class="input-group checkbox text-right" >
                            <label class="form-label" for="subject">Remember Me</label>
                            <input type="checkbox" value="false" class="form-control" id="subject" name="RememberMe" placeholder="Remember Me" tabindex="3">
                        </div>

                        <div class="col-xs-12" id="divsubmit">
                            <button type="submit" class="btn btn-start-order  btn-success col-xs-12" name="LoginBtn" value="Login">Login</button>
                        </div>

                        <div class="divlabel">
                            <label id="label" title="Forgot Password"><a class="diva" href="#" >Forgot Password?</a> </label>
                            <label id="label" title="Sign up"><a class="diva" href="../../Views/Users/SignUp.php" >Sign Up</a> </label>

                        </div>
                    </form>
                    <br/> <br/><br/>



      

<script type="text/javascript">                        

$(document).ready(function() {
// Test for placeholder support
$.support.placeholder = (function(){
    var i = document.createElement('input');
    return 'placeholder' in i;
})();

// Hide labels by default if placeholders are supported
if($.support.placeholder) {
    $('.form-label').each(function(){
        $(this).addClass('js-hide-label');
    });  

    // Code for adding/removing classes here
    $('.form-group').find('input, textarea').on('keyup blur focus', function(e){

        // Cache our selectors
        var $this = $(this),
            $parent = $this.parent().find("label");

                    switch(e.type) {
                        case 'keyup': {
                             $parent.toggleClass('js-hide-label', $this.val() == '');
                        } break;
                        case 'blur': {
                            if( $this.val() == '' ) {
                $parent.addClass('js-hide-label');
            } else {
                $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
            }
                        } break;
                        case 'focus': {
                            if( $this.val() !== '' ) {
                $parent.removeClass('js-unhighlight-label');
            }
                        } break;
                        default: break;
                    }
                    // previous implementation with ifs
       if (e.type == 'keyup') {
            if( $this.val() == '' ) {
                $parent.addClass('js-hide-label'); 
            } else {
                $parent.removeClass('js-hide-label');   
            }                     
        } 
        else if (e.type == 'blur') {
            if( $this.val() == '' ) {
                $parent.addClass('js-hide-label');
            } 
            else {
                $parent.removeClass('js-hide-label').addClass('js-unhighlight-label');
            }
        } 
        else if (e.type == 'focus') {
            if( $this.val() !== '' ) {
                $parent.removeClass('js-unhighlight-label');
            }
        }/
    });
} 
});                         

</script>                           




                </div>
                <div class="col-lg-3 col-md-3 col-sm-1 col-xs-12">

                </div>


            </div>

        </div>

          <div style="">
                <?php
                            include_once("../Template/Footer.php");
                            ?>

            </div>
   </div>
</body>

</html>