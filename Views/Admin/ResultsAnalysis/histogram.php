<!DOCTYPE html>
<html>
<head>
	<title>Data Presentations</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="assests/plugins/charts/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/serial.js" type="text/javascript"></script>
    <script src="assests/plugins/charts/amcharts/amstock.js" type="text/javascript"></script>
    <link rel="stylesheet" href="assests/plugins/charts/amcharts/style.css" type="text/css">
    <link rel="stylesheet" href="assests/css/custom.css" type="text/css">

    <script type="text/javascript">

            var chartData= [
							    {date: new Date(2011, 5, 1, 0, 0, 0, 0), val:10},
							    {date: new Date(2011, 5, 2, 0, 0, 0, 0), val:11},
							    {date: new Date(2011, 5, 3, 0, 0, 0, 0), val:12},
							    {date: new Date(2011, 5, 4, 0, 0, 0, 0), val:11},
							    {date: new Date(2011, 5, 5, 0, 0, 0, 0), val:10},
							    {date: new Date(2011, 5, 6, 0, 0, 0, 0), val:11},
							    {date: new Date(2011, 5, 7, 0, 0, 0, 0), val:13},
							    {date: new Date(2011, 5, 8, 0, 0, 0, 0), val:14},
							    {date: new Date(2011, 5, 9, 0, 0, 0, 0), val:17},
							    {date: new Date(2011, 5, 10, 0, 0, 0, 0), val:13}
							];

		    AmCharts.ready(function() {				
				var chart = new AmCharts.AmStockChart();				
	            chart.pathToImages = "assests/plugins/charts/amcharts/images/";

	            var dataSet = new AmCharts.DataSet();
	            dataSet.dataProvider = chartData;
	            dataSet.fieldMappings = dataSet.fieldMappings = [{fromField:"val", toField:"value"}];

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
</head>
<body>
	<div id="bg">
        <img src="assests/images/reports.jpg" alt="">
    </div>

    <div class="sidenav">
	  <a href="bar_chart.php">Bar Chart</a>
	  <a href="line_chart.php">Line Chart</a>
	  <a href="area_chart.php">Area Chart</a>
	  <a href="pie_chart.php">Pie Chart</a>
	  <a href="histogram.php">Histogram</a>
	</div>

	<div class="main">
	  <div id="chartdiv" style="width:100%; height:700px;"></div>
	</div>

	

</body>
</html>