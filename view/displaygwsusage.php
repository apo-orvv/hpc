<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script> 
 <script src = "view/js/exporting.js"></script> 
<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4></h4>";
$mystr="<select name='partition'>";

foreach($WSnameall as $par){
	
	if($par==$wsname){
$mystr=$mystr."<option value=\"$par\" selected>$par</option>";
}
else{
$mystr=$mystr."<option value=\"$par\">$par</option>";
}
}
$mystr=$mystr."</select>";

if($flag==1)
{
foreach($WSReport as $wsrt)
{
	$Noofhours[]=$wsrt[2];
	$timeunits[]=$wsrt[4];

}
}

else {foreach($WSReport as $wsrt)
{
	if($wsrt[2] >=7){
		
	$Noofhours[]=24; }

else	{
$Noofhours[]=$wsrt[2]*3; }
	
	$timeunits[]=$wsrt[4];

} }
//print_r($Noofhours);

$title="$wsname Usage";
$title=json_encode($title);
$usedpercentstr=join($usepercents,',');
$hourstr=join($timeunits,',');
$myjson_str = json_encode($Noofhours,JSON_NUMERIC_CHECK);
$myhour_str = json_encode($timeunits);
$subtitle=json_encode($graphlabels[0]);
$xaxislabel=json_encode($graphlabels[1]);
echo "<form id='form1' method='post' action=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=GWS_History_Usage\">";
	

echo "<table class='querytable' align='center'  cellspacing='0' border=1><tr><td>GWS Name</td><td>$mystr</td><td>Select a time interval</td><td>From</td><td><input id='datepicker' name='fromdate'></td><td>To</td><td><input id='datepicker1' name='todate'></td></tr><tr><td colspan='7' align='center' style='color:red'> <input type='submit' name='showgwsusage' value='Submit'>   $msg  </td></tr>
<tr> </tr>
</table>";
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
minDate: "2021-05-15",
maxDate: "+1D",
numberOfMonths: 1
});
    $("#datepicker1").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
minDate: "2021-05-15",
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
                        text: 'No. of hours Loggedin'
                }

        },
		plotOptions: {
        		series: {
            			color: '#990099'
        	}
    		},
        series: [{
        name: 'No. of hours Loggedin',
                data: data_series 
        }]

        });

} );
</script>
 
