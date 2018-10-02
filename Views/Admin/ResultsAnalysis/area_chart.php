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
			  "fillAlphas": 0.5
			} ]
	    } ); 
	</script>
</head>

<body>
	<div class="main">
	  <div id="chartdiv" style="width:100%; height:700px;"></div>
	</div>
	
</body>