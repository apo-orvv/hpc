
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script>
 <script src = "view/js/exporting.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4> $systemname Cluster Running Jobs: User wise and Process wise Usage</h4>";
echo " <div id =\"container\" style = \"width: 600px; height: 350px; margin: 0 auto\"></div>";
echo " <div id =\"container1\" style = \"width: 600px; height: 350px; margin: 0 auto\"></div>";
echo " <div id =\"container2\" style = \"width: 600px; height: 350px; margin: 0 auto\"></div><br/><br/>";
echo "</div>";
$myjson_slotstr = json_encode($usercores,JSON_NUMERIC_CHECK);
$myjson_usrstr = json_encode($userjobs,JSON_NUMERIC_CHECK);
$myjson_procstr = json_encode($processcores,JSON_NUMERIC_CHECK);
?>
<script>

$(document).ready(function() {
var data_series1 = <?php echo $myjson_slotstr; ?>;
var data_series2 = <?php echo $myjson_usrstr; ?>;
var data_series3 = <?php echo $myjson_procstr; ?>;
 $('#container').highcharts({
                chart: {
                        type: 'pie'
                },
                title: {
                         style: {
                                color: '#CD7F32',
                                fontWeight: 'normal',
				fontSize: "14px"
                        },
                        text: 'Running Jobs - CPU Cores/User'
                },
		
		plotOptions: {
        		pie: {
            		allowPointSelect: true,
            		cursor: 'pointer',
            		dataLabels: {
                		enabled: true,
                		format: '<b>{point.name}</b>: {point.y} Cores: {point.percentage:.1f} %',
            		}
        		}
    		},
        series: [{
        	name: 'Cores Used',
                data: data_series1 
        }]

        });
 $('#container1').highcharts({
                chart: {
                        type: 'pie'
                },
                title: {
                         style: {
                                color: '#CD7F32',
                                fontWeight: 'normal',
				fontSize: "14px"
                        },
                        text: 'Running Jobs - Jobs/User'
                },
		
		plotOptions: {
        		pie: {
            		allowPointSelect: true,
            		cursor: 'pointer',
            		dataLabels: {
                		enabled: true,
                		format: '<b>{point.name}</b>: {point.y} Jobs: {point.percentage:.1f} %',
            		}
        		}
    		},
        series: [{
        	name: 'Number of Jobs',
                data: data_series2 
        }]

        });
 $('#container2').highcharts({
                chart: {
                        type: 'pie'
                },
                title: {
                         style: {
                                color: '#CD7F32',
                                fontWeight: 'normal',
				fontSize: "14px"
                        },
                        text: 'Running Jobs - CPU Cores/Process '
                },
		
		plotOptions: {
        		pie: {
            		allowPointSelect: true,
            		cursor: 'pointer',
            		dataLabels: {
                		enabled: true,
                		format: '<b>{point.name}</b>: {point.y} Cores: {point.percentage:.1f} %',
            		}
        		}
    		},
        series: [{
        	name: 'Cores Used',
                data: data_series3 
        }]

        });
	
} );
</script>

