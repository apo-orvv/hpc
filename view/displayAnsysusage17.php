<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script>
 <script src = "view/js/exporting.js"></script>

<?php
		$swname="ANSYS_17_1";
		$fname=array("a_spaceclaim_dirmod","acfd_preppost","acfd_solver","acfx_pre","anshpc_pack","meba","preppost");
			
		
		$Featureusage1=$this->smdetailsmodel->getFeatureusage($swname,$fname[0]);
		
		$Featureusage2=$this->smdetailsmodel->getFeatureusage($swname,$fname[1]);
		
		$Featureusage3=$this->smdetailsmodel->getFeatureusage($swname,$fname[2]);
		
		$Featureusage4=$this->smdetailsmodel->getFeatureusage($swname,$fname[3]);
		
		$Featureusage5=$this->smdetailsmodel->getFeatureusage($swname,$fname[4]);
		
		$Featureusage6=$this->smdetailsmodel->getFeatureusage($swname,$fname[5]);
		 
		$Featureusage7=$this->smdetailsmodel->getFeatureusage($swname,$fname[6]);
		
		
//include "view/displaysystembanner.php";
$title="Today's Aysys 17 License Usage";
$title=json_encode($title);
$usedpercentstr=join($usepercents,',');
$hourstr=join($timeunits,',');
$myjson_str = json_encode($usepercents,JSON_NUMERIC_CHECK);
$myhour_str = json_encode($timeunits);
$subtitle=json_encode($graphlabel[0]);
$xaxistit="Hour of Day";
$xaxislabel=json_encode($xaxistit);

$timeofmon=strtotime($nodesummary[8]);
$mytime=date("d M Y H:i:s",$timeofmon);

foreach($Featureusage1 as $msg1)
{
$hours[]=$msg1[1];
$total[]=$msg1[2];
$used[]=$msg1[3];
}
foreach($Featureusage2 as $msg1)
{
$hours2[]=$msg1[1];
$total2[]=$msg1[2];
$used2[]=$msg1[3];
}

foreach($Featureusage3 as $msg1)
{
$hours3[]=$msg1[1];
$total3[]=$msg1[2];
$used3[]=$msg1[3];
}

foreach($Featureusage4 as $msg1)
{
$hours4[]=$msg1[1];
$total4[]=$msg1[2];
$used4[]=$msg1[3];
}


foreach($Featureusage5 as $msg1)
{
$hours5[]=$msg1[1];
$total5[]=$msg1[2];
$used5[]=$msg1[3];
}


foreach($Featureusage6 as $msg1)
{
$hours6[]=$msg1[1];
$total6[]=$msg1[2];
$used6[]=$msg1[3];
}



//print_r($used);
$myhours = json_encode($hours,JSON_NUMERIC_CHECK);
//Total no. of License for Graph 1
$mytotal = json_encode($total,JSON_NUMERIC_CHECK); 
//Total no. of License for Graph 2
$mytotal2 = json_encode($total20,JSON_NUMERIC_CHECK);

$myused = json_encode($used,JSON_NUMERIC_CHECK);
$myused2 = json_encode($used2,JSON_NUMERIC_CHECK);
$myused3 = json_encode($used3,JSON_NUMERIC_CHECK);
$myused4 = json_encode($used4,JSON_NUMERIC_CHECK);
$myused5 = json_encode($used5,JSON_NUMERIC_CHECK);
$myused6 = json_encode($used6,JSON_NUMERIC_CHECK);
$myused7 = json_encode($used7,JSON_NUMERIC_CHECK);


$myfea = json_encode($fname[0],JSON_NUMERIC_CHECK);
$myfea1 = json_encode($fname[1],JSON_NUMERIC_CHECK);
$myfea2 = json_encode($fname[2],JSON_NUMERIC_CHECK);
$myfea3 = json_encode($fname[3],JSON_NUMERIC_CHECK);
$myfea4 = json_encode($fname[4],JSON_NUMERIC_CHECK);
$myfea5= json_encode($fname[5],JSON_NUMERIC_CHECK);
$myfea6= json_encode($fname[6],JSON_NUMERIC_CHECK);
$myfea7= json_encode($fname[7],JSON_NUMERIC_CHECK);



//echo $myused;
//print_r($hours);

//echo "<h5 align='center'>$systemname Cluster Status Summary </h5>";
echo "<h6 align='center'>Ansys 17.1 Usage Summary </h6>";
echo "<div class=\"w3-container w3-cell-row\">";

echo "<div class=\"w3-container w3-cell\" style=\"width:50%\"><div id=\"graphcontainer1\" style=\"width:400px; height: 300px; margin: 0; auto\"></div></div>";
echo "<div class=\"w3-container w3-cell\" style=\"width:50%\"><div id=\"graphcontainer2\" style=\"width:400px; height: 300px; margin: 0; auto\"></div></div> </div>";
//$myjson_slotstr = json_encode($cores,JSON_NUMERIC_CHECK);
echo "</div>";
?>
<script>
$(document).ready(function() {
var data_series1 = <?php echo $myused; ?>;
var data_series2 = <?php echo $myused2; ?>;
var data_series3 = <?php echo $myused3; ?>;
var data_series4 = <?php echo $myused4; ?>;
var data_series5 = <?php echo $myused5; ?>;
var data_series6 = <?php echo $myused6; ?>;
var data_series7 = <?php echo $myused7; ?>;



var myfea = <?php echo $myfea; ?>;
var myfea2 = <?php echo $myfea2; ?>;
var myfea3 = <?php echo $myfea3; ?>;
var myfea4 = <?php echo $myfea4; ?>;
var myfea5 = <?php echo $myfea5; ?>;
var myfea6 = <?php echo $myfea6; ?>;
var myfea7 = <?php echo $myfea7; ?>;


var data_seriestotal = <?php echo $mytotal; ?>;
var data_seriestotal2 = <?php echo $mytotal2; ?>;

var xaxis_data=<?php echo $myhours;?>;   
 
var xaxis_label=<?php echo $xaxislabel;?>;           
var subtitle=<?php echo $subtitle;?>;

var title=<?php echo $title;?>;
           
        $('#graphcontainer1').highcharts({
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
                        text: 'No. Of License Invoked'
                }

        },
		legend: {
			enabled: true,
		},
                plotOptions: {
                        series: {
                                
                }
                },
        series: [{
        name: myfea,
                data: data_series1,lineColor: '#998877' 
        },{
        name: myfea2,
                data: data_series2 
        },{
        name: myfea3,
                data: data_series3 
        },{
        name: myfea4,
                data: data_series4 
        },{
        name: myfea5,
                data: data_series5 
        },{
        name: myfea6,
                data: data_series6 
        },{
        name: myfea7,
                data: data_series7 
        }]

        });
		
		
		
		
		
	
		  
		
		

} );
</script>
