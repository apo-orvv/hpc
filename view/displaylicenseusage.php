<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script> 
 <script src = "view/js/exporting.js"></script> 
<?php
/*
$mystr="<select name='partition'>";
foreach($swnameall as $par){
	
	if($par==$swname){
$mystr=$mystr."<option value=\"$par\" selected>$par</option>";
}
else{
$mystr=$mystr."<option value=\"$par\">$par</option>";
}
}
$mystr=$mystr."</select>";

*/




include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4></h4>";

if ($usagetype =="hours")
{
$temparr1=$SWReport[0];
$temparr2=$SWReport[1];
$temparr3=$SWReport[2];
$temparr4=$SWReport[3];
$temparr5=$SWReport[4];
if ($swname == "ANSYS_19") {$fact=3.54;}
if ($swname == "ANSYS_18_2") {$fact=4.75;}
if ($swname == "ANSYS_17_1") {$fact=3.54;}
if ($swname == "Abaqus") {$fact=12;}
if ($swname == "CFD-ACE/SYSWELD") {$fact=12;}
if ($swname == "COMSOL") {$fact=3.56;}
if ($swname == "RECURDYN") {$fact=3.56;}
foreach($temparr1 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$temp=ceil($pieces[0]/$fact);
if ($temp > 23) { $Noofhours1[]=24;} else {$Noofhours1[]=$temp; }
$features1=$pieces[1];
$timeunits1[]=$pieces[2];
}


foreach($temparr2 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$temp=ceil($pieces[0]/$fact);
if ($temp > 23) { $Noofhours2[]=24;} else {$Noofhours2[]=$temp; }
$features2=$pieces[1];
$timeunits2[]=$pieces[2];
}

foreach($temparr3 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$temp=ceil($pieces[0]/$fact);
if ($temp > 23) { $Noofhours3[]=24;} else {$Noofhours3[]=$temp; }
$features3=$pieces[1];
$timeunits3[]=$pieces[2];
}


foreach($temparr4 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$temp=ceil($pieces[0]/$fact);
if ($temp > 23) { $Noofhours4[]=24;} else {$Noofhours4[]=$temp; }

$features4=$pieces[1];
$timeunits4[]=$pieces[2];
}


foreach($temparr5 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$temp=ceil($pieces[0]/$fact);
if ($temp > 23) { $Noofhours5[]=24;} else {$Noofhours5[]=$temp; }
$features5=$pieces[1];
$timeunits5[]=$pieces[2];
}


$title="$swname Usage";
$title=json_encode($title);

$yaxis_label="No. of hours Utilized";
$yaxis_label=json_encode($yaxis_label);

$myjson_str1 = json_encode($Noofhours1,JSON_NUMERIC_CHECK);
$myhour_str1 = json_encode($timeunits1);
$myfeature1 = json_encode($features1);

$myjson_str2 = json_encode($Noofhours2,JSON_NUMERIC_CHECK);
$myhour_str2 = json_encode($timeunits2);
$myfeature2 = json_encode($features2);

$myjson_str3 = json_encode($Noofhours3,JSON_NUMERIC_CHECK);
$myhour_str3 = json_encode($timeunits3);
$myfeature3 = json_encode($features3);

$myjson_str4 = json_encode($Noofhours4,JSON_NUMERIC_CHECK);
$myhour_str4 = json_encode($timeunits4);
$myfeature4 = json_encode($features4);

$myjson_str5 = json_encode($Noofhours5,JSON_NUMERIC_CHECK);
$myhour_str5 = json_encode($timeunits5);
$myfeature5 = json_encode($features5);

$subtitle=json_encode($subtitle);
$xaxislabel=json_encode($graphlabels[1]);
}


//include "view/displaysystembanner.php";
//echo "<div class='w3-container'>";
//echo "<h4></h4>";
if ($usagetype =="percen")
{
$temparr1=$SWReport[0];
$temparr2=$SWReport[1];
$temparr3=$SWReport[2];
$temparr4=$SWReport[3];
$temparr5=$SWReport[4];



foreach($temparr1 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$Noofhours1[]=$pieces[0];
$features1=$pieces[1];
$timeunits1[]=$pieces[2];
}



foreach($temparr2 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$Noofhours2[]=$pieces[0];
$features2=$pieces[1];
$timeunits2[]=$pieces[2];
}

foreach($temparr3 as $msg1=>$val)
{
	
$pieces = explode(",", $val);
$Noofhours3[]=$pieces[0];
$features3=$pieces[1];
$timeunits3[]=$pieces[2];
}


foreach($temparr4 as $msg1=>$val)
{
$pieces = explode(",", $val);
$Noofhours4[]=$pieces[0];
$features4=$pieces[1];
$timeunits4[]=$pieces[2];
}


foreach($temparr5 as $msg1=>$val)
{
$pieces = explode(",", $val);
$Noofhours5[]=$pieces[0];
$features5=$pieces[1];
$timeunits5[]=$pieces[2];
}


$title="$swname Usage";
$title=json_encode($title);

$subtitle=json_encode($subtitle);

$yaxis_label="Percentage of Usage";
$yaxis_label=json_encode($yaxis_label);

$myjson_str1 = json_encode($Noofhours1,JSON_NUMERIC_CHECK);
$myhour_str1 = json_encode($timeunits1);
$myfeature1 = json_encode($features1);

$myjson_str2 = json_encode($Noofhours2,JSON_NUMERIC_CHECK);
$myhour_str2 = json_encode($timeunits2);
$myfeature2 = json_encode($features2);

$myjson_str3 = json_encode($Noofhours3,JSON_NUMERIC_CHECK);
$myhour_str3 = json_encode($timeunits3);
$myfeature3 = json_encode($features3);

$myjson_str4 = json_encode($Noofhours4,JSON_NUMERIC_CHECK);
$myhour_str4 = json_encode($timeunits4);
$myfeature4 = json_encode($features4);

$myjson_str5 = json_encode($Noofhours5,JSON_NUMERIC_CHECK);
$myhour_str5 = json_encode($timeunits5);
$myfeature5 = json_encode($features5);


$xaxislabel=json_encode($graphlabels[1]);
}


echo "<form id='form1' method='post' action=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=Utilization_Month\">";
echo "<table class='querytable' align='center'  cellspacing='0' border=1><tr><td>Select Software Name</td><td><select name='partition'><option value='COMSOL'>COMSOL</option><option value='ANSYS_17_1'>ANSYS_17_1</option><option value='CFD-ACE/SYSWELD'>CFD-ACE/SYSWELD</option><option value='ANSYS_19'>ANSYS_19</option><option value='Abaqus'>Abaqus</option><option value='ANSYS_18_2'>ANSYS_18_2</option><option value='RECURDYN'>RECURDYN</option></select></td><td><input type='radio' name='summarytype' value='hours' checked='checked'>Usage on No. Of Hours<input type='radio' name='summarytype' value='percen'>Usage on Percentage </td></tr><tr>  <td>Select a time interval</td><td>From : <input id='datepicker' name='fromdate'></td><td>To : <input id='datepicker1' name='todate'></td></tr><tr><td colspan='3' align='center' style='color:red'> <input type='submit' name='showswusage' value='Submit'>   $msg  </td></tr>
<tr> </tr>
</table>";
echo "</form><br/><br/><br/>";
echo "</div>";


?>
   
      <div id = "container" style = "width: 700px; height: 600px; margin: 0 auto"> </div>
  <p style='color:#047bbf;' align='center' > <i><?php echo $chartmsg; ?> </i></p>

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
var data_series1 = <?php echo $myjson_str1; ?>;
var data_series2 = <?php echo $myjson_str2; ?>;
var data_series3 = <?php echo $myjson_str3; ?>;
var data_series4 = <?php echo $myjson_str4; ?>;
var data_series5 = <?php echo $myjson_str5; ?>;



var feature1=<?php echo $myfeature1; ?>;
var feature2=<?php echo $myfeature2; ?>;
var feature3=<?php echo $myfeature3; ?>;
var feature4=<?php echo $myfeature4; ?>;
var feature5=<?php echo $myfeature5; ?>;
var xaxis_data=<?php echo $myhour_str1;?>;           
var xaxis_label="Date";  
var yaxis_label=<?php echo $yaxis_label;?>;  
         
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
                        text: yaxis_label
                }

        },
		
		
		
		plotOptions: {
        		series: {
            			
        	}
    		},
        series: [{
        name: feature1,
                data: data_series1,lineColor: '#998877' 
        },
		{
        name: feature2,
                data: data_series2 ,lineColor: '#7785A2'
        },
		{
        name: feature3,
                data: data_series3,lineColor: '#3975A2' 
        },
		{
        name: feature4,
                data: data_series4,lineColor: '#EEEEEE'  
        },
		{
        name: feature5,
                data: data_series5
        }
		]

        });

} );
</script>
 
