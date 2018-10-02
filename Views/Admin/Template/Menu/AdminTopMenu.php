<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">CS DEPARTMENT CLASS TIMETABLE AND RESULTS ANALYSIS</a>
        </div>
        <ul class="nav navbar-nav">


        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Welcome  <?php  echo($_SESSION["role"]) ?> :
                                <?php  echo($_SESSION["username"]) ?> 
                               </a></li>
             <li class="" id="Profile"><a href="../Profile/Profile.php"><span class="glyphicon glyphicon-user"> Profile</span></a></li>
            <li><a href="../../../Views/Users/Login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>