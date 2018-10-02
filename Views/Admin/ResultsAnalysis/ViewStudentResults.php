<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | View Student Results </title>
     <?php 
        include_once("../../Resources/bootstrapCDN.php");
  
    ?>


    <link rel="stylesheet" href="ResultsAnalysis.css">

</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
          include_once("Logic/ViewStudentResults_logic.php");
         

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
                     <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="RADashboard.php"> &larr;Back to Results Analysis DashBoard</a></h4>
                    
                    <div class="container-fluid text-center">
                        
                                <h1>View Student Results</h1>

                                <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?><br/><br/>
                        
                        <a href="Import_Courses.php" class="btn btn-success"> Import Students Results </a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_ViewStudentResults.php" class="btn btn-success transparent"> Add Student Results </a><br/><br/>

                                <div class="table-responsive">

                                    <table id="myTable" class="table table-hover table-bordered text-left">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student ID</th>
                                                <th>Course</th>
                                                <th>Quiz</th>
                                                <th> Labs</th>
                                                <th>Assigment </th>
                                                <th>Test1</th>
                                                <th>Test2</th>
                                                <th>Test3</th>
                                                 <th>Projects</th>
                                                <th>Overall CA</th>
                                                <th>Grades</th>
                                                
                                                <th>ResultsYear</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

 <?php   
    function  checkCourse($course_ID,$DBConnect){
        $courseCode=$course_ID;
          $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $DBConnect->prepare("SELECT `CourseCode` FROM `courses` WHERE `CourseID`=$course_ID");
          $stmt->execute();
         if($stmt->rowCount()>0 )
         {
              while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
                    $courseCode=$row['CourseCode'];
              }
         }
        return $courseCode;
     
    }                                       
                        
      if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
             $Overall=$row['ProjectsTotal(%)']+$row['TotalQuiz(%)']+$row['TotalLabs(%)']+$row['TotalAssigment(%)']+$row['Test_1(%)']+$row['Test_2(%)']+$row['Test_3(%)'];
              $courseCode=checkCourse($row['CourseID'],$DBConnect);
            echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['StudentComputerID'].' </td>
                    <td>'.$courseCode.' </td>
                    <td>'.$row['TotalQuiz(%)'].' % </td>
                    <td> '.$row['TotalLabs(%)'].' % </td>
                    <td> '.$row['TotalAssigment(%)'].' % </td>
                    <td>'.$row['Test_1(%)'].' % </td>
                    <td>'.$row['Test_2(%)'].' % </td>
                    <td>'.$row['Test_3(%)'].' % </td>
                    <td>'.$row['ProjectsTotal(%)'].' % </td>
                    <td><h3>'.$Overall.'  </h3></td>
                    <td><h3 class="text-success">'.$row['gradeValue'].'</h3></td>
                   
                    <td>'.$row['ResultsYear'].' </td>
                 
                    <td><a href="edit_ViewStudentResults.php?value='.$row['GradeBookID'].'&btn_edit_Link='.$row['GradeBookID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['GradeBookID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['GradeBookID'].'" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal Content -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h1 class="modal-title"><span class="label label-danger">Are You Sure?</span></h1>
                            </div>
                            <div class="modal-body">
                                <p>This record will permanently be deleted / removed from the system. Do you wish to continue?</p>
                            </div>
                            <div class="modal-footer">
                            <form action="ViewStudentResults.php"   method="post">
                                <button type="submit" class="btn btn-primary" name="Confirm_delete_viewsStudent" value="'.$row['GradeBookID'].'">Yes</button>&nbsp;
                                <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';//'.$row['grading_id'].'

                
                
                
                $int ++;

            }

        }
            
                                                            
                                                ?>

                                        </tbody>
                                    </table>
                                </div>
                        <a href="Import_Courses.php" class="btn btn-success"> Import Student Results </a>

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