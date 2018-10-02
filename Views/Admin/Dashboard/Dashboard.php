<?php session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <title> Admin | Dashboard </title>
    <?php 
        include_once("../../Resources/bootstrapCDN.php");
      
    ?>



    <script src="assests/plugins/charts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/serial.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/amstock.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assests/plugins/charts/amcharts/style.css" type="text/css">


    <style>
        #Dashboard {
            background-color: #016701;
            color: white;
        }

        #Dashboard a {

            color: white;
        }

    </style>

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
                        include_once('../Template/Menu/AdminTopMenu.php');
                    ?>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="container-fluid text-center">
                        <div class="row content">
                            <!--   the Sidemenu  -->
                            <div class="col-lg-2 col-sm-2 col-md-2 sidenav">

                                <?php include_once('../Template/Menu/AdminSideMenu.php');?>
                            </div>
                            <!--   the The Main Contents  -->
                            <div class="col-sm-8 col-lg-8 col-md-8 text-center">


                                <div class="centerContent">

                                    <ul class="nav nav-tabs">

                                        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                                        <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                        <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                                    </ul>

                                    <div class="tab-content">
                                        <div id="home" class="tab-pane fade in active">
                                            <h3>HOME</h3>





                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <i class="glyphicon glyphicon-check"></i> Order Report
                                                        </div>
                                                        <!-- /panel-heading -->
                                                        <div class="panel-body">

                                                            <form class="form-horizontal" action="php_action/getOrderReport.php" method="post" id="getOrderReportForm">
                                                                <div class="form-group">
                                                                    <label for="startDate" class="col-sm-2 control-label">Start Date</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="endDate" class="col-sm-2 control-label">End Date</label>
                                                                    <div class="col-sm-10">
                                                                        <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-offset-2 col-sm-10">
                                                                        <button type="submit" class="btn btn-success" id="generateReportBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Generate Report</button>
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
                                        <div id="menu1" class="tab-pane fade">
                                            <h3>Menu 1</h3>
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                        <div id="menu2" class="tab-pane fade">
                                            <h3>Menu 2</h3>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                        </div>
                                        <div id="menu3" class="tab-pane fade">
                                            <h3>Menu 3</h3>
                                            <div id="bg">
                                                <img src="custom/css/reports.jpg" alt="">
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                             
    <script type="text/javascript">
        var chartData = [{
                date: new Date(2011, 5, 1, 0, 0, 0, 0),
                val: 10
            },
            {
                date: new Date(2011, 5, 2, 0, 0, 0, 0),
                val: 11
            },
            {
                date: new Date(2011, 5, 3, 0, 0, 0, 0),
                val: 12
            },
            {
                date: new Date(2011, 5, 4, 0, 0, 0, 0),
                val: 11
            },
            {
                date: new Date(2011, 5, 5, 0, 0, 0, 0),
                val: 10
            },
            {
                date: new Date(2011, 5, 6, 0, 0, 0, 0),
                val: 11
            },
            {
                date: new Date(2011, 5, 7, 0, 0, 0, 0),
                val: 13
            },
            {
                date: new Date(2011, 5, 8, 0, 0, 0, 0),
                val: 14
            },
            {
                date: new Date(2011, 5, 9, 0, 0, 0, 0),
                val: 17
            },
            {
                date: new Date(2011, 5, 10, 0, 0, 0, 0),
                val: 13
            }
        ];

        AmCharts.ready(function() {
            var chart = new AmCharts.AmStockChart();
            chart.pathToImages = "assests/plugins/charts/amcharts/images/";

            var dataSet = new AmCharts.DataSet();
            dataSet.dataProvider = chartData;
            dataSet.fieldMappings = dataSet.fieldMappings = [{
                fromField: "val",
                toField: "value"
            }];

            dataSet.categoryField = "date";
            chart.dataSets = [dataSet];

            var stockPanel = new AmCharts.StockPanel();
            chart.panels = [stockPanel];

            var panelsSettings = new AmCharts.PanelsSettings();
            panelsSettings.startDuration = 1;
            chart.panelsSettings = panelsSettings;

            var graph = new AmCharts.StockGraph();
            graph.valueField = "value";
            graph.type = "column";

            graph.fillAlphas = 1;
            graph.title = "My Graph"
            stockPanel.addStockGraph(graph);

            chart.write("chartdiv");

        });

    </script>   
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                
                                                <script src="custom/js/report.js"></script>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!--   the right side Content  -->
                            <div class="col-lg-2 col-sm-2 col-md-2 sidenavR">
                                <br/>uae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <br/>
                            </div>
                        </div>
                    </div>

                    <!--   the footer Content  -->

                </div>
            </div>

            <div style="">
                 <script src="assests/plugins/charts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/serial.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/amstock.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assests/plugins/charts/amcharts/style.css" type="text/css">

                <?php
                
                                    include_once("../../Template/Footer.php");
                                    ?>

                    <script src="custom/js/report.js"></script>

            </div>


    </div>
</body>

</html>
