<?php session_start();
require_once('../../../Model/PDO.php');

$errors=array();
$success=array(); 
 if($_POST && $_POST['Confirm_delete_info']){
         
        if(!empty($_POST['Confirm_delete_info'])){
          
          try { 
                 
              $DBConnect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
             
              if($_SESSION["role"]=="admin"){
               
                  $stmt = $DBConnect->prepare("DELETE FROM `student` WHERE `student`.`StudentComputerID` = ".$_POST['Confirm_delete_info']);
                  $stmt->execute();
                          
                          array_push($success,"Successful deleted !!!");
            
              } 
               
               } catch (Exception $e)
            {
               array_push($errors,"Student results deleted failed");
                   array_push($errors,$e->getMessage());
                 
                }

 
            
        }
        
    }


?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | View Student Information </title>
     <?php 
        include_once("../../Resources/bootstrapCDN.php");
  
    ?>


    <link rel="stylesheet" href="ResultsAnalysis.css">

</head>

<body>
    <div class="container-fluid ">

        <?php
         include_once('../Template/checkUser.php');
          //include_once("Logic/ViewStudentInformation_logic.php");
         

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
                        
                                <h1>View Student Information</h1>

                                <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>


                                <div class="table-responsive">

                                    <table id="myTable" class="table table-hover table-bordered text-left">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Student ID</th>
                                                <th>Gender</th>
                                                <th>YearOfStudy</th>
                                                
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

 <?php   
try{                                         
      $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $DBConnect->prepare("SELECT `StudentComputerID`, `Gander`, `YearOfStudy` FROM `student`ORDER by StudentComputerID DESC");
    $stmt->execute();

}catch(Exception $e){
    array_push($errors, $e->getMessage()."<br/>"); 
    $DBConnect->$close();

} 
                  
                        
      if($stmt->rowCount()>0 )
         {
             $int =1;
          while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
          {
             
            echo'<tr>
                    <th>'.$int.'</th>
                    <td>'.$row['StudentComputerID'].' </td>
                    <td>'.$row['Gander'].' </td>
                    <td> '.$row['YearOfStudy'].' </td>
                 
                    <td><!--<a href="edit_ResultsAnalysis.php?value='.$row['StudentComputerID'].'&btn_edit_link='.$row['StudentComputerID'].'"><button type="button"class="btn btn-success transparent" data-toggle="modal">Edit</button></a>-->&nbsp;
                    <button type="button"  class="btn btn-danger transparent" data-toggle="modal" data-target="#verifyDelete'.$row['StudentComputerID'].'">Delete</button></td>
                </tr>'; 
                
                
                   echo '  <div class="modal fade" id="verifyDelete'.$row['StudentComputerID'].'" role="dialog">
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
                               <form action="ViewStudentInformation.php"   method="post">
                                    <button type="submit" class="btn btn-primary" name="Confirm_delete_info" value="'.$row['StudentComputerID'].'">Yes</button>&nbsp;
                                    <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button> 
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';//'.$row['grading_id'].'Confirm_delete_info

                
                
                
                $int ++;

            }

        }
            
                                                            
                                                ?>

                                        </tbody>
                                    </table>
                                </div>
                        <a href="ImportStudentInformation.php" class="btn btn-success"> Import Student Information </a>

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