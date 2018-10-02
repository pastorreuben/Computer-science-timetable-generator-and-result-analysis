<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Results Analysis</title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
  
    ?>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>






    <script src="assests/plugins/charts/amcharts/amcharts.js"></script>
    <script src="assests/plugins/charts/amcharts/pie.js"></script>
    <script src="assests/plugins/charts/amcharts/serial.js"></script>
    <script src="assests/plugins/charts/amcharts/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="assests/plugins/charts/amcharts/plugins/export/export.css" type="text/css" media="all" />
    <script src="assests/plugins/charts/amcharts/themes/light.js"></script>








    <link rel="stylesheet" href="ResultsAnalysis.css">

</head>

<body>
    <div class="container-fluid ">

        <?php
         $show=false;//flag
        $selected="";
         include_once('../Template/checkUser.php');
          include_once("Logic/ResultsAnalysis_logic.php");
         

            ?>



            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <!--   the Navigation bar  -->
                    <?php
                        include_once('../Template/Menu/AdminTopMenu.php');
                   
                    ?>
                     <div>
                     <h4 class="pull-left"><span class="glyphicon glyphicon-door "></span> <a href="RADashboard.php"> &larr;Back to Results Analysis DashBoard</a></h4>
                    <?php 
                     include_once('../../../Controller/errors.php');
                     include_once('../../../Controller/success.php');
                    ?>
                    <br/>
                </div>
                </div>
            </div>


            <div class="row container-fluid">
               
                <div style="background-color:#336666; padding:30px; " >
                    <form class="form-inline" action="ResultsAnalysis.php" method="POST">
                       
                          <a href="Import_Courses.php" class="btn btn-success pull-left"> Import Students Results </a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="edit_ViewStudentResults.php" class="btn btn-success transparent pull-left"> Add Student Results </a><br/><br/>

                        <div class="form-group">
                            <label for="se_courseId" style="color:white">Select Course &nbsp; :&nbsp;&nbsp;</label>
                            <select id="se_courseId" class="form-control col-sms-4" name="selectCourse" title="Select Course " required="required">
                                                   <option  value="-1">Select Course  </option>
                                                    <?php 
                                                   $course="";

                                                         $stm = $DBConnect->prepare("SELECT courses.`CourseID`,`CourseName`, `CourseCode` FROM `courses` inner join ca_marks on courses.`CourseID`=ca_marks.`CourseID` where courses.CourseLecturerID=".$_SESSION["userid"]); //WHERE lecturers.LecturesID=1
                                                       $stm->execute();
                                                         if($stm->rowCount()>0)
                                                        {
                                                           while( $row=$stm->fetch(PDO::FETCH_ASSOC)) 
                                                          {
                                                              if($selected==$row['CourseID']){
                                                                   echo "<option selected value=".$row['CourseID'].">".$row['CourseCode']." ".$row['CourseName']."</option>";
                                                                  $course=$row['CourseCode']." ".$row['CourseName'];
                                                              }else{
                                                                   echo "<option value=".$row['CourseID'].">".$row['CourseCode']." ".$row['CourseName']."</option>";
                                                              }
                                                            
                                                              
                                                         }
                                                        }
                                                     
                                                    ?>
                                                    
                                                    
                              </select>
                        </div>
                        
                        <button type="submit" name="btn_analyse" class="btn btn-success">Analysis Results </button>&nbsp;&nbsp;|&nbsp;&nbsp;
                        <?php 
        if($_POST) {
        if($show){
             echo '<button type="submit" onclick="Print()" class="btn btn-primary">Print Results</button>&nbsp;&nbsp;|&nbsp;&nbsp;
            <!--<button type="submit"  class="btn btn-info">save</button>&nbsp;&nbsp;|&nbsp;&nbsp;-->';
            
            
        }
       } 
                        ?>
                    </form>

                </div>
            </div>
        
            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="container-fluid text-center ">
                        <h3 class="text-success">Course being Analysed
                            <?php echo $course; ?>
                        </h3>
                        <div class="table-responsive ">

                            <table id="myTable" class="table table-hover table-bordered text-left">
                                <thead>

                                    <tr>
                                        <th>#</th>
                                        <th>Student ID</th>
                                        <th>Full Names</th>
                                        <th >Quiz</th>
                                        <th> Labs</th>
                                        <th>Assigment </th>
                                        <th>Test1</th>
                                        <th>Test2</th>
                                        <th>Test3</th>
                                        <th>Projects</th>
                                        <th>CA Mark</th>
                                        <th>CA %</th>
                                        <th>Grade</th>
                                        

                                        <!-- <th>Actions</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php  
  $data2='';
                                    
if($_POST) {
    $TotalOverallCA=0.0;//to call
    $HigestCA=0;
    $LowerestCA=100;//to hold the lowest C.A for a student
    $ClassAveragePer=0.00;
    $ClassAverageCA=0.00;
        if(isset($_POST['btn_analyse']) && $_POST['selectCourse']!=-1 ){
                           
          if($stmt->rowCount()>0 )
           {
             $int =1;
               // The Overall Marks 
                $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmts = $DBConnect->prepare("SELECT `CA_MarksID`,`ca_marks`.`CourseID`, `Quizs(%)`, `Labs(%)`, `Assignments(%)`, `Test_1(%)`, `Test_2(%)`, `Test 3(%)`, `Project(%)` from ca_marks where `ca_marks`.`CourseID`=".$_POST['selectCourse']); 
                 $stmts->execute();
                 if($stmts->rowCount()==1)
                 {
                     while( $row=$stmts->fetch(PDO::FETCH_ASSOC))
                     {
                         $TotalOverallCA= $row['Test_1(%)'] + $row['Test_2(%)'] + $row['Test 3(%)'] + $row['Quizs(%)'] + $row['Labs(%)'] + $row['Project(%)'] + $row['Assignments(%)']+0.0;//calculation the overal C.A
                        
                           echo'<tr style="font-weight:bold">
                                    <th style="background-color:lightgreen;color:white;">0</th>
                                    <th style="background-color:lightgreen;" colspan="2" class="text-primary">Total Overall C.A  </th>
                                    <th style="background-color:lightgreen;" class="text-primary">'.$row['Quizs(%)'].' % </th>
                                    <th style="background-color:lightgreen;" class="text-primary"> '.$row['Labs(%)'].' % </th>
                                    <th style="background-color:lightgreen;"  class="text-primary">'.$row['Assignments(%)'].' % </th>
                                    <th style="background-color:lightgreen;"  class="text-primary">'.$row['Test_1(%)'].' % </th>
                                    <th style="background-color:lightgreen;" class="text-primary">'.$row['Test_2(%)'].' % </th>
                                    <th style="background-color:lightgreen;" class="text-primary">'.$row['Test 3(%)'].' % </th>
                                    <th style="background-color:lightgreen;" class="text-primary">'.$row['Project(%)'].' % </th>
                                     <th style="background-color:lightgreen;" class="text-warning"> '.$TotalOverallCA.' % </th>
                                    <th style="background-color:lightgreen;" class="text-warning"> 100% </th>
                                    <th style="background-color:lightgreen;" class="text-warning"> - </th>
                                   
                                 
                                </tr>';
                     }
                 }

               
              while( $row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
                   $Overall=$row['ProjectsTotal(%)']+$row['TotalQuiz(%)']+$row['TotalLabs(%)']+$row['TotalAssigment(%)']+$row['Test_1(%)']+$row['Test_2(%)']+$row['Test_3(%)'];//The total Overall C.A for each student
                  
                  //calculating the higest C.A mark
                  if($HigestCA < $Overall){
                      $HigestCA=$Overall;
                  }
                  //calculating the higest C.A mark
                  if($LowerestCA > $Overall){
                      $LowerestCA=$Overall;
                  }
                      
                  //the dataset need for the graph
                   $data .="{ StudentComputerID:'".$row['StudentComputerID']."  (C.A:".$Overall.")', project:".$row['ProjectsTotal(%)'].", Quiz:".$row['TotalQuiz(%)'].", labs:".$row['TotalLabs(%)'].", assigmnet:".$row['TotalAssigment(%)'].", test1: ".$row['Test_1(%)'].", test2:".$row['Test_2(%)'].", test3:".$row['Test_3(%)']."}, ";
                  //data set frot he graph
                 // $data2 .="{ 'StudentComputerID':'".$row['StudentComputerID']."', 'C.A':".$Overall."}, ";
                  
               // $chart_data .= "{ year:'".$row["year"]."', profit:".$row["profit"].", purchase:".$row["purchase"].", sale:".$row["sale"]."}, ";
                  $courseCode=checkCourse($row['CourseID'],$DBConnect);//get course Code
                echo'<tr>
                        <th>'.$int.'</th>
                        <td>'.$row['StudentComputerID'].' </td>
                        <td><b>'.$row['FullNames'].'</b> </td>
                        <td>'.$row['TotalQuiz(%)'].' % </td>
                        <td> '.$row['TotalLabs(%)'].' % </td>
                        <td> '.$row['TotalAssigment(%)'].' % </td>
                        <td>'.$row['Test_1(%)'].' % </td>
                        <td>'.$row['Test_2(%)'].' % </td>
                        <td>'.$row['Test_3(%)'].' % </td>
                        <td>'.$row['ProjectsTotal(%)'].' % </td>
                        <td><h3 class="text-warning">'.$Overall.'  </h3></td>
                        <td><h3 class="text-warning">'.($Overall/$TotalOverallCA)*100 .' % </h3></td>
                        <td><h3  class="text-primary">'.$row['gradeValue'].'</h3> </td>
                        
                        
                     </tr>';

                    $int ++;
                  $ClassAveragePer +=($Overall/$TotalOverallCA)*100;
                  $ClassAverageCA +=$Overall;

                }

            }
        }
}
                                   // print json_encode($Data);
 ?>

                                </tbody>
                            </table>
                        </div>
                       

                    </div>

                </div>
            </div>
        
         <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12">
                  <h3 class="text-success"> Results Computations Summary</h3>
                 
                 
                <div class="table-responsive ">

                    <table id="" class="table table-hover table-bordered text-left">
                        <thead>

                            <tr>
                                <th>#</th>
                                <th>Analysis</th>

                                <th>Quiz</th>
                                <th> Labs</th>
                                <th>Assigment </th>
                                <th>Test1</th>
                                <th>Test2</th>
                                <th>Test3</th>
                                <th>Projects</th>
                                 <th>CA Mark</th>
                                <th>CA %</th>
                                <th>Grade</th>
                               
                               
                                <!-- <th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i=0;
                            //CalcuteAverage
                              if($_POST) {
                                if(isset($_POST['btn_analyse']) && $_POST['selectCourse']!=-1 ){
                                     $stmts=CalcuteMaximum($DBConnect,$_POST['selectCourse']);//Computting the maximum school for each column
                                    if($stmts->rowCount()>0 )
                                    {
                                        while( $row=$stmts->fetch(PDO::FETCH_ASSOC))
                                        {$i++;
                                           
                                           echo'<tr>
                                            <th>'.$i.'</th>
                                            <th>Highest</th>

                                            <th>'.$row['quiz'].'%</th>
                                            <th> '.$row['lab'].'%</th>
                                            <th>'.$row['asign'].'%</th>
                                            <th>'.$row['test1'].'%</th>
                                            <th>'.$row['test2'].'%</th>
                                            <th>'.$row['test3'].'%</th>
                                            <th>'.$row['project'].'%</th>
                                            <th>'.$HigestCA.'</th>
                                            <th>'.$row['project'].'%</th>
                                            <th>'.$row['project'].'%</th>
                                          
                                            </tr>' ;
                                        }
                                    }
                                    //Computting the minimum school for each column
                                    $stmt_min=CalcuteMinimum($DBConnect,$_POST['selectCourse']);
                                    if($stmt_min->rowCount()>0 )
                                    {
                                        while( $row=$stmt_min->fetch(PDO::FETCH_ASSOC))
                                        {$i++;
                                           
                                           echo'<tr>
                                            <th>'.$i.'</th>
                                            <th>Lowerest</th>

                                            <th>'.$row['quiz'].'%</th>
                                            <th> '.$row['lab'].'%</th>
                                            <th>'.$row['asign'].'%</th>
                                            <th>'.$row['test1'].'%</th>
                                            <th>'.$row['test2'].'%</th>
                                            <th>'.$row['test3'].'%</th>
                                            <th>'.$row['project'].'%</th>
                                             <th>'.$LowerestCA.'%</th>
                                            <th>'.$row['project'].'%</th>
                                            <th>'.$row['project'].'%</th>
                                           
                                            </tr>' ;
                                        }
                                    }
                                    //Computting the Average school for each column
                                     $stmt_ave=CalcuteAverage($DBConnect,$_POST['selectCourse']);
                                    if($stmt_ave->rowCount()>0 )
                                    {
                                        while( $row=$stmt_ave->fetch(PDO::FETCH_ASSOC))
                                        {$i++;
                                           
                                           echo'<tr>
                                            <th>'.$i.'</th>
                                            <th>Average</th>

                                            <th>'.$row['quiz'].'%</th>
                                            <th> '.$row['lab'].'%</th>
                                            <th>'.$row['asign'].'%</th>
                                            <th>'.$row['test1'].'%</th>
                                            <th>'.$row['test2'].'%</th>
                                            <th>'.$row['test3'].'%</th>
                                            <th>'.$row['project'].'%</th>
                                              <th>'.$ClassAverageCA/$int.'%</th>
                                            <th>'.$ClassAveragePer/$int.'%</th>
                                            <th>'.$row['project'].'%</th>
                                          
                                            </tr>';
                                        }
                                    }

                                }
                              }

                            ?>
                        </tbody>
                    </table>
                </div>
                 
             </div>
         </div>
        
         
        <!---->
        
            <?php 
             $chart_data=substr($data,0,-2);
              $chartData=substr($data2,0,-2);
           //  echo($data);

        ?>

            <script>
                var chartData = [{
                    "country": "USA",
                    "visits": 4252
                }, {
                    "country": "China",
                    "visits": 1882
                }, {
                    "country": "Japan",
                    "visits": 1809
                }, {
                    "country": "Germany",
                    "visits": 1322
                }, {
                    "country": "UK",
                    "visits": 1122
                }, {
                    "country": "France",
                    "visits": 1114
                }, {
                    "country": "India",
                    "visits": 984
                }, {
                    "country": "Spain",
                    "visits": 711
                }, {
                    "country": "Netherlands",
                    "visits": 665
                }, {
                    "country": "Russia",
                    "visits": 580
                }, {
                    "country": "South Korea",
                    "visits": 443
                }, {
                    "country": "Canada",
                    "visits": 441
                }, {
                    "country": "Brazil",
                    "visits": 395
                }, {
                    "country": "Italy",
                    "visits": 386
                }, {
                    "country": "Australia",
                    "visits": 384
                }, {
                    "country": "Taiwan",
                    "visits": 338
                }, {
                    "country": "Poland",
                    "visits": 328
                }];
            </script>

            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div id="container" class="pull-left">
                        <div id="chart"></div>

                    </div>
                </div>

                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div id="container" class="pull-right">
                        <div id="charts"></div>

                    </div>
                </div>
            </div>
        
       
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="">
                        <!--   the footer Content  -->
                        <div style="margin-top:10%">
                            <?php
                                    include_once("../../Template/Footer.php");
                                    ?>

                        </div>


                    </div>
                </div>
            </div>


           

    </div>

</body>

</html>
<script>
    //   stacked:true,
    function Print() {
        window.print();
    }
    Morris.Bar({
        element: 'chart',
        data: [<?php echo $chart_data; ?>],
        xkey: 'StudentComputerID',
        ykeys: ['project', 'Quiz', 'labs', 'assigmnet', 'test1', 'test2', 'test3'],
        labels: ['project', 'Quiz', 'labs', 'assigmnet', 'test1', 'test2', 'test3'],
        hideHover: 'auto',
        stacked: true,

    });

    Morris.Bar({
        element: 'charts',
        data: [<?php echo $chart_data; ?>],
        xkey: 'StudentComputerID',
        ykeys: ['project', 'Quiz', 'labs', 'assigmnet', 'test1', 'test2', 'test3'],
        labels: ['project', 'Quiz', 'labs', 'assigmnet', 'test1', 'test2', 'test3'],
        hideHover: 'auto',

    });



    AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "dataProvider": chartData,
        "categoryField": "country",
        "categoryAxis": {
            "autoGridCount": false,
            "gridCount": chartData.length,
            "gridPosition": "start",
            "labelRotation": 90
        },
        "export": {
            "enabled": true
        },
        "graphs": [{
            "valueField": "visits",
            "type": "line",
            "fillAlphas": 0, // this line is redundant since the default is 0 (no fill) anyway
            "bullet": "round",
            "lineColor": "#8d1cc6"
        }]
    });
</script>