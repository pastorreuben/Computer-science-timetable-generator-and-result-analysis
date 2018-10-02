<!DOCTYPE html>
<html>
<head>
	<title>Data Presentations</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <script src="assests/plugins/charts/amcharts/amcharts.js"></script>
    <script src="assests/plugins/charts/amcharts/pie.js"></script>
    <script src="assests/plugins/charts/amcharts/plugins/export/export.min.js"></script>
    <link rel="stylesheet" href="assests/plugins/charts/amcharts/plugins/export/export.css" type="text/css" media="all" />
    <script src="assests/plugins/charts/amcharts/themes/light.js"></script> 
    <link rel="stylesheet" href="assests/css/custom.css" type="text/css">

    <script>
	  var chart = AmCharts.makeChart( "chartdiv", {
		  "type": "pie",
		  "theme": "light",
		  "dataProvider": [ {
		    "country": "Lithuania",
		    "value": 260
		  }, {
		    "country": "Ireland",
		    "value": 201
		  }, {
		    "country": "Germany",
		    "value": 65
		  }, {
		    "country": "Australia",
		    "value": 39
		  }, {
		    "country": "UK",
		    "value": 19
		  }, {
		    "country": "Latvia",
		    "value": 10
		  } ],
		  "valueField": "value",
		  "titleField": "country",
		  "outlineAlpha": 0.4,
		  "depth3D": 15,
		  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
		  "angle": 30,
		  "export": {
		    "enabled": true
		  }
		} );
     	
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