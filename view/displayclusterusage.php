<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script> 
 <script src = "view/js/exporting.js"></script> 
<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4>Cluster Usage for $systemname (Used Cores / Total Cores)</h4>";

$title="$systemname Cluster Usage";
$title=json_encode($title);
$usedpercentstr=join($usepercents,',');
$hourstr=join($timeunits,',');
$myjson_str = json_encode($usepercents,JSON_NUMERIC_CHECK);
$myhour_str = json_encode($timeunits);
$subtitle=json_encode($graphlabel[0]);
$xaxislabel=json_encode($timeunits);
echo "<form id='form1' method='post' action=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=Cluster_Usage_History\">";
	
echo "<table class='querytable' align='center'  cellspacing='0' border=1><tr><td>Select a time interval</td><td>From</td><td><input id='datepicker' name='fromdate'></td><td>To</td><td><input id='datepicker1' name='todate'></td></tr><tr><td colspan='5' align='center'> <input type='submit' name='showclusterusage' value='Submit'></td></tr></table>";
echo "</form><br/><br/><br/>";
echo "</div>";
?>
   
      <div id = "container" style = "width: 700px; height: 600px; margin: 0 auto"></div>
  

<script>

$(document).ready(function() {
    $("#datepicker").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
minDate: "2017-10-24",
maxDate: "+1D",
numberOfMonths: 1
});
    $("#datepicker1").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
minDate: "2017-10-24",
maxDate: "+1D",
numberOfMonths: 1

});
var data_series = <?php echo $myjson_str; ?>;
var xaxis_data=<?php echo $myhour_str;?>;           
var xaxis_label=<?php echo $xaxislabel;?>;           
var subtitle=<?php echo $subtitle;?>;
var title=<?php echo $title;?>;
           
	$('#container').highcharts({
                chart: {
                        type: 'line'
                },
                title: {
			 style: {
            			color: '#CD7F32',
            			fontWeight: 'bold'
        		},
                        text: title
                },
		subtitle: {
        		text: subtitle
    		},
                xAxis: {
                title: {
                        text: xaxis_label
                },
		gridLineWidth: 1,
                categories:xaxis_data 
                },
                yAxis: {
                title: {
                        text: 'Percentage Usage (Used Cores/ Total Cores)'
                }

        },
		plotOptions: {
        		series: {
            			color: '#783313'
        	}
    		},
        series: [{
        name: 'Used Percent',
                data: data_series 
        }]

        });

} );
</script>
 
