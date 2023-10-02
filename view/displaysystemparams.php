<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script>
 <script src = "view/js/exporting.js"></script>

<?php
include "view/displaysystembanner.php";
$title="Today's Cluster Usage";
$title=json_encode($title);
$usedpercentstr=join($usepercents,',');
$hourstr=join($timeunits,',');
$myjson_str = json_encode($usepercents,JSON_NUMERIC_CHECK);
$myhour_str = json_encode($timeunits);
$subtitle=json_encode($graphlabel[0]);
$xaxislabel=json_encode($graphlabel[1]);

$timeofmon=strtotime($nodesummary[8]);
$mytime=date("d M Y H:i:s",$timeofmon);
echo "<br/><br/>";
//echo "<h5 align='center'>$systemname Cluster Status Summary </h5>";
echo "<div class=\"w3-container w3-cell-row\"><div class=\"w3-container w3-cell \" style=\"width:40%\">";
echo "<h6 align='center'>$systemname Cluster Status Summary </h6>";
echo "<table align='center' class='systemdetails'  border='1px solid black'>";
echo "<tr><td colspan='2' align='center'><center><b>Monitored at $mytime</b></center></td></tr>";
$usepercent=($nodesummary[2]/$nodesummary[4]) *100;
$usepercent=round($usepercent,2);
echo "<tr><td>Cluster Usage % <br/>(Cores Allocated/ Total Cores): </td><td>$usepercent % &nbsp;&nbsp;</td></tr><tr> <td>Total Number of Jobs: </td><td>$jobnumber[0]</td></tr><tr><td>Running Jobs: </td><td>$jobnumber[1]</td></tr><tr><td>Logged In Users: </td><td>$userno</td></tr></table>";
echo "</div><div class=\"w3-container w3-cell\" style=\"width:60%\"><div id=\"graphcontainer\" style=\"width:450px; height: 300px; margin: 0; auto\"></div></div></div>";

$cores=array();
echo "<div class=\"w3-container w3-cell-row\"><div class=\"w3-container w3-cell \" style=\"width:40%\">";
echo "<h6 align='center'>Node Utilization Summary</h6>";
echo "<table align='center' class='systemdetails' border='1px solid black' >";
echo "<tr><td colspan='4' align='center'><center><b>Nodes</b></center></td></tr>";
echo "<tr><th>Allocated</th><td>$nodesummary[1]&nbsp;</td>";
echo "<th>Idle</th><td>$nodesummary[0]&nbsp;</td></tr>";
echo "<tr><th>Down</th><td>$nodesummary[5]&nbsp;</td>";
echo "<th>Total</th><td>$nodesummary[6]&nbsp;</td></tr>";
echo "<tr><td colspan='4' align='center'><center><b>Cores</b></center></td></tr>";
echo "<tr><th>Allocated</th><td>$nodesummary[2]&nbsp;</td>";
array_push($cores,array('Used',$nodesummary[2]));
echo "<th>Idle</th><td>$nodesummary[3]&nbsp;</td>";
array_push($cores,array('Idle',$nodesummary[3]));
echo "<tr><th> Down</th><td>$nodesummary[7]&nbsp;</td>";
array_push($cores,array('Down',$nodesummary[7]));
$myjson_slotstr = json_encode($cores,JSON_NUMERIC_CHECK);
echo "<th>Total</th><td>$nodesummary[4]&nbsp;</td></tr></table><br/>";
echo "</div><div class=\"w3-container w3-cell\" style=\"width:60%\"><div id=\"piechartcontainer\" style=\"width:450px; height: 300px; margin: 0; auto\"></div></div></div>";
echo "<div class=\"w3-container w3-cell-row\">";
echo "<h6 align='center'> Storage Utilization Summary</h6>";

echo "<table class=\"systemdetails\"   align='center' width='60%' >";
echo "<tr><td>Mount Point</td><td>Total</td><td>Used</td><td>Available</td><td>Used Percentage</td></tr>";
foreach($storagesummary as $store){
        echo "<tr><td>$store[5]</td><td>$store[1]</td><td>$store[2]</td><td>$store[3]</td><td>$store[4]</td></tr>";
}

echo "</table><br/><br/>";
echo "</div>";
?>
<script>
$(document).ready(function() {
var data_series = <?php echo $myjson_str; ?>;
var xaxis_data=<?php echo $myhour_str;?>;           
var xaxis_label=<?php echo $xaxislabel;?>;           
var subtitle=<?php echo $subtitle;?>;
var data_series1 = <?php echo $myjson_slotstr; ?>;
var title=<?php echo $title;?>;
           
        $('#graphcontainer').highcharts({
                chart: {
                        type: 'line'
                },
                title: {
                         style: {
                                color: '#783313',
                                fontWeight: 'normal',
				fontSize: "14px"
                        },
                        text: title
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
                        text: 'Percentage Usage'
                }

        },
		legend: {
			enabled: false,
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

	$('#piechartcontainer').highcharts({
                chart: {
                        type: 'pie'
                },
                title: {
                         style: {
                                color: '#783313',
                                fontWeight: 'normal',
				fontSize: "14px"
                        },
                        text: 'CPU Allocation Status'
                },
                
                plotOptions: {
                        pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        }
                        }
                },
        series: [{
                name: 'Cores',
                data: data_series1 
        }]
	});
} );
</script>
