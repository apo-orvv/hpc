
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>
 <script src = "view/js/highcharts.js"></script>
 <script src = "view/js/exporting.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<h3> $systemname Cluster Jobs: Group wise Summary</h3>";
echo "<h6> Data from $fromval to $toval</h6>";
echo " <div id =\"container\" style = \"width: 700px; height: 600px; margin: 0 auto\"></div><br/><br/>";
echo " <div id =\"container1\" style = \"width: 700px; height: 600px; margin: 0 auto\"></div><br/><br/>";
echo " <div id =\"container2\" style = \"width: 700px; height: 600px; margin: 0 auto\"></div><br/><br/>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Group Name</th><th>Number of Jobs</th><th>Cores</th><th>Wall Clock Time (HRS)</th><th>CPU Usage (Seconds) </th><th>Memory Usage (Gbytes CPU Seconds)</th></tr></thead><tbody>";
//echo "<tfoot><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></tfoot><tbody>";
$slots=array();
$subtitle=json_encode("Usage from $fromval to $toval");
$numjobs=array();
$elapsed_time=array();
$i=0;
foreach($grpsumm as $job){
$wallclk=$job[2]/3600;
$wallclk=round($wallclk,2);
$job[3]=round($job[3],2);
$job[4]=round($job[4],2);
echo "<tr><td><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=User_Details&username=$job[5]\">$job[5]</a></td><td>$job[0]</td><td>$job[1]</td><td>$wallclk</td><td>$job[3]</td><td>$job[4]</td></tr>";
$myslot=array($job[5],$job[1]);
array_push($slots,$myslot);
$myjob=array($job[5],$job[0]);
array_push($numjobs,$myjob);
$mytime=array($job[5],$wallclk);
array_push($elapsed_time,$mytime);
}
echo "</tbody></table>";
$myjson_slotstr = json_encode($slots,JSON_NUMERIC_CHECK);
$myjson_usrstr = json_encode($numjobs,JSON_NUMERIC_CHECK);
$myjson_timestr = json_encode($elapsed_time,JSON_NUMERIC_CHECK);
?>
<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
var data_series1 = <?php echo $myjson_slotstr; ?>;
var data_series2 = <?php echo $myjson_usrstr; ?>;
var data_series3 = <?php echo $myjson_timestr; ?>;
var subtitle = <?php echo $subtitle;?>; 
 $('#container').highcharts({
                chart: {
                        type: 'pie'
                },
                title: {
                         style: {
                                color: '#CD7F32',
                                fontWeight: 'bold'
                        },
                        text: 'Neha Cluster Jobs - Cores Used/Group '
                },
		
                subtitle: {
                        text: subtitle
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
                                fontWeight: 'bold'
                        },
                        text: 'Neha Cluster Jobs - Jobs/Group '
                },
		
                subtitle: {
                        text: subtitle
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
                                fontWeight: 'bold'
                        },
                        text: 'Neha Cluster Jobs - Total Running Time (Hrs)/Group '
                },
		
                subtitle: {
                        text: subtitle
                },
		plotOptions: {
        		pie: {
            		allowPointSelect: true,
            		cursor: 'pointer',
            		dataLabels: {
                		enabled: true,
                		format: '<b>{point.name}</b>: {point.y:.2f} Hrs: {point.percentage:.1f} %',
            		}
        		}
    		},
        series: [{
        	name: 'Job Running Time (Hrs)',
                data: data_series3 
        }]

        });
	
} );
</script>

