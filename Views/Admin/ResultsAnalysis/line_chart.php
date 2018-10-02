<?php 
  
  include "base.php";

?>

<head>
	<script type="text/javascript">
		AmCharts.makeChart( "chartdiv", {
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
	        "graphs": [ {
			  "valueField": "visits",
			  "type": "line",
			  "fillAlphas": 0, // this line is redundant since the default is 0 (no fill) anyway
			  "bullet": "round",
			  "lineColor": "#8d1cc6"
			} ]
	    } ); 
	</script>
</head>

<body>
	<div class="main">
	  <div id="chartdiv" style="width:100%; height:700px;"></div>
	</div>
	
</body>