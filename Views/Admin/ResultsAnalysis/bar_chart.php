<?php 
  
  include "base.php";

?>

<head>
	<script type="text/javascript">
        var chartData = [ {
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
       	} ];

     	

		AmCharts.makeChart( "chartdiv", {
	        "type": "serial",
	        "theme": "light",
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
	            "type": "column",
	            "fillAlphas": 0.8,
	            "angle": 30,
                "depth3D": 15,
                "balloonText": "[[category]]: <b>[[value]]</b>"
	        } ]
	    } ); 
	</script>
</head>

<body>
	<div class="main">
	  <div id="chartdiv" style="width:100%; height:700px;"></div>
	</div>
	
</body>