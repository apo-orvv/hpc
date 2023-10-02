<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
 <script src = "view/js/highcharts.js"></script>
 <script src = "view/js/exporting.js"></script>

<?php
		$swname="Abaqus";
		$fname=array("Abaqus","adams","aqua","cae","cfd","cse_token","design","explicit","foundation","moldflow","standard","viewer","ams", "cosim_acusolve","cosim_direct","cse","euler_lagrange","gpgpu","multiphysics","pydriver");
		
		$Featureusage1=$this->smdetailsmodel->getFeatureusage($swname,$fname[0]);
		
		$Featureusage2=$this->smdetailsmodel->getFeatureusage($swname,$fname[1]);
		
		$Featureusage3=$this->smdetailsmodel->getFeatureusage($swname,$fname[2]);
		
		$Featureusage4=$this->smdetailsmodel->getFeatureusage($swname,$fname[3]);
		
		$Featureusage5=$this->smdetailsmodel->getFeatureusage($swname,$fname[4]);
		
		$Featureusage6=$this->smdetailsmodel->getFeatureusage($swname,$fname[5]);
		 
		$Featureusage7=$this->smdetailsmodel->getFeatureusage($swname,$fname[6]);
		
		$Featureusage8=$this->smdetailsmodel->getFeatureusage($swname,$fname[7]);
		
		$Featureusage9=$this->smdetailsmodel->getFeatureusage($swname,$fname[8]);
		
		$Featureusage10=$this->smdetailsmodel->getFeatureusage($swname,$fname[9]);
		
		$Featureusage11=$this->smdetailsmodel->getFeatureusage($swname,$fname[10]);
		
		$Featureusage12=$this->smdetailsmodel->getFeatureusage($swname,$fname[11]);
		
		$Featureusage13=$this->smdetailsmodel->getFeatureusage($swname,$fname[12]);
		
		$Featureusage14=$this->smdetailsmodel->getFeatureusage($swname,$fname[13]);
		
		$Featureusage15=$this->smdetailsmodel->getFeatureusage($swname,$fname[14]);

		$Featureusage16=$this->smdetailsmodel->getFeatureusage($swname,$fname[15]);
		
		$Featureusage17=$this->smdetailsmodel->getFeatureusage($swname,$fname[16]);
		
		$Featureusage18=$this->smdetailsmodel->getFeatureusage($swname,$fname[17]);
		
		$Featureusage19=$this->smdetailsmodel->getFeatureusage($swname,$fname[18]);
		
		$Featureusage20=$this->smdetailsmodel->getFeatureusage($swname,$fname[19]);
//include "view/displaysystembanner.php";
$title="Today's $swname License Usage";
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

foreach($Featureusage7 as $msg1)
{
$hours7[]=$msg1[1];
$total7[]=$msg1[2];
$used7[]=$msg1[3];
}

foreach($Featureusage8 as $msg1)
{
$hours8[]=$msg1[1];
$total8[]=$msg1[2];
$used8[]=$msg1[3];
}

foreach($Featureusage9 as $msg1)
{
$hours9[]=$msg1[1];
$total9[]=$msg1[2];
$used9[]=$msg1[3];
}

foreach($Featureusage10 as $msg1)
{
$hours10[]=$msg1[1];
$total10[]=$msg1[2];
$used10[]=$msg1[3];
}

foreach($Featureusage11 as $msg1)
{
$hours11[]=$msg1[1];
$total11[]=$msg1[2];
$used11[]=$msg1[3];
}

foreach($Featureusage12 as $msg1)
{
$hours12[]=$msg1[1];
$total12[]=$msg1[2];
$used12[]=$msg1[3];
}


foreach($Featureusage13 as $msg1)
{
$hours13[]=$msg1[1];
$total13[]=$msg1[2];
$used13[]=$msg1[3];
}


foreach($Featureusage14 as $msg1)
{
$hours14[]=$msg1[1];
$total14[]=$msg1[2];
$used14[]=$msg1[3];
}

foreach($Featureusage14 as $msg1)
{
$hours15[]=$msg1[1];
$total15[]=$msg1[2];
$used15[]=$msg1[3];
}

foreach($Featureusage16 as $msg1)
{
$hours16[]=$msg1[1];
$total16[]=$msg1[2];
$used16[]=$msg1[3];
}

foreach($Featureusage17 as $msg1)
{
$hours17[]=$msg1[1];
$total17[]=$msg1[2];
$used17[]=$msg1[3];
}
foreach($Featureusage18 as $msg1)
{
$hours18[]=$msg1[1];
$total18[]=$msg1[2];
$used18[]=$msg1[3];
}


foreach($Featureusage19 as $msg1)
{
$hours19[]=$msg1[1];
$total19[]=$msg1[2];
$used19[]=$msg1[3];
}


foreach($Featureusage20 as $msg1)
{
$hours20[]=$msg1[1];
$total20[]=$msg1[2];
$used20[]=$msg1[3];
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
$myused8 = json_encode($used8,JSON_NUMERIC_CHECK);
$myused9 = json_encode($used9,JSON_NUMERIC_CHECK);
$myused10 = json_encode($used10,JSON_NUMERIC_CHECK);
$myused11 = json_encode($used11,JSON_NUMERIC_CHECK);
$myused12 = json_encode($used12,JSON_NUMERIC_CHECK);
$myused13 = json_encode($used13,JSON_NUMERIC_CHECK);
$myused14 = json_encode($used14,JSON_NUMERIC_CHECK);
$myused15 = json_encode($used15,JSON_NUMERIC_CHECK);
$myused16 = json_encode($used16,JSON_NUMERIC_CHECK);
$myused17 = json_encode($used17,JSON_NUMERIC_CHECK);
$myused18 = json_encode($used18,JSON_NUMERIC_CHECK);
$myused19 = json_encode($used19,JSON_NUMERIC_CHECK);
$myused20 = json_encode($used20,JSON_NUMERIC_CHECK);

$myfea = json_encode($fname[0],JSON_NUMERIC_CHECK);
$myfea1 = json_encode($fname[1],JSON_NUMERIC_CHECK);
$myfea2 = json_encode($fname[2],JSON_NUMERIC_CHECK);
$myfea3 = json_encode($fname[3],JSON_NUMERIC_CHECK);
$myfea4 = json_encode($fname[4],JSON_NUMERIC_CHECK);
$myfea5= json_encode($fname[5],JSON_NUMERIC_CHECK);
$myfea6= json_encode($fname[6],JSON_NUMERIC_CHECK);
$myfea7= json_encode($fname[7],JSON_NUMERIC_CHECK);
$myfea8= json_encode($fname[8],JSON_NUMERIC_CHECK);
$myfea9= json_encode($fname[9],JSON_NUMERIC_CHECK);
$myfea10= json_encode($fname[10],JSON_NUMERIC_CHECK);
$myfea11= json_encode($fname[11],JSON_NUMERIC_CHECK);
$myfea12= json_encode($fname[12],JSON_NUMERIC_CHECK);
$myfea13= json_encode($fname[13],JSON_NUMERIC_CHECK);
$myfea14= json_encode($fname[14],JSON_NUMERIC_CHECK);
$myfea15= json_encode($fname[15],JSON_NUMERIC_CHECK);
$myfea16= json_encode($fname[16],JSON_NUMERIC_CHECK);
$myfea17= json_encode($fname[17],JSON_NUMERIC_CHECK);
$myfea18= json_encode($fname[18],JSON_NUMERIC_CHECK);
$myfea19= json_encode($fname[19],JSON_NUMERIC_CHECK);
$myfea20= json_encode($fname[20],JSON_NUMERIC_CHECK);


//echo $myused;
//print_r($hours);

//echo "<h5 align='center'>$systemname Cluster Status Summary </h5>";
echo "<h6 align='center'>$swname Usage Summary </h6>";
echo "<div class=\"w3-container w3-cell-row\">";

echo "<div class=\"w3-container w3-cell\" style=\"width:50%\"><div id=\"graphcontainer1\" style=\"width:400px; height: 300px; margin: 0; auto\"></div></div>";
echo "<div class=\"w3-container w3-cell\" style=\"width:50%\"><div id=\"graphcontainer2\" style=\"width:400px; height: 300px; margin: 0; auto\"></div></div> </div>";



//$myjson_slotstr = json_encode($cores,JSON_NUMERIC_CHECK);



echo "</div>";
?>
<script>
$(document).ready(function() {
var Adata_series1 = <?php echo $myused; ?>;
var Adata_series2 = <?php echo $myused2; ?>;
var Adata_series3 = <?php echo $myused3; ?>;
var Adata_series4 = <?php echo $myused4; ?>;
var Adata_series5 = <?php echo $myused5; ?>;
var Adata_series6 = <?php echo $myused6; ?>;
var Adata_series7 = <?php echo $myused7; ?>;
var Adata_series8 = <?php echo $myused8; ?>;
var Adata_series9 = <?php echo $myused9; ?>;
var Adata_series10 = <?php echo $myused10; ?>;
var Adata_series11 = <?php echo $myused11; ?>;
var Adata_series12 = <?php echo $myused12; ?>;

var Adata_series13 = <?php echo $myused13; ?>;
var Adata_series14 = <?php echo $myused14; ?>;
var Adata_series15 = <?php echo $myused15; ?>;
var Adata_series16 = <?php echo $myused16; ?>;
var Adata_series17 = <?php echo $myused17; ?>;
var Adata_series18 = <?php echo $myused18; ?>;
var Adata_series19 = <?php echo $myused19; ?>;
var Adata_series20 = <?php echo $myused20; ?>;

var myfea = <?php echo $myfea; ?>;
var myfea2 = <?php echo $myfea2; ?>;
var myfea3 = <?php echo $myfea3; ?>;
var myfea4 = <?php echo $myfea4; ?>;
var myfea5 = <?php echo $myfea5; ?>;
var myfea6 = <?php echo $myfea6; ?>;
var myfea7 = <?php echo $myfea7; ?>;
var myfea8 = <?php echo $myfea8; ?>;
var myfea9 = <?php echo $myfea9; ?>;
var myfea10 = <?php echo $myfea10; ?>;
var myfea11 = <?php echo $myfea11; ?>;
var myfea12 = <?php echo $myfea12; ?>;
var myfea13 = <?php echo $myfea13; ?>;
var myfea14 = <?php echo $myfea14; ?>;
var myfea15 = <?php echo $myfea15; ?>;
var myfea16 = <?php echo $myfea16; ?>;
var myfea17 = <?php echo $myfea17; ?>;
var myfea18 = <?php echo $myfea18; ?>;
var myfea19 = <?php echo $myfea19; ?>;
var myfea20 = <?php echo $myfea20; ?>;

var Adata_seriestotal = <?php echo $mytotal; ?>;
var Adata_seriestotal2 = <?php echo $mytotal2; ?>;

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
        name: 'Total License',
                data: Adata_seriestotal,lineColor: '#FF3933'
        },{
        name: myfea,
                data: Adata_series1,lineColor: '#998877' 
        },{
        name: myfea2,
                data: Adata_series2 
        },{
        name: myfea3,
                data: Adata_series3 
        },{
        name: myfea4,
                data: Adata_series4 
        },{
        name: myfea5,
                data: Adata_series5 
        },{
        name: myfea6,
                data: Adata_series6 
        },{
        name: myfea7,
                data: Adata_series7 
        },{
        name: myfea8,
                data: Adata_series8 
        },{
        name: myfea9,
                data: Adata_series9 
        },{
        name: myfea10,
                data: Adata_series10 
        },{
        name: myfea11,
                data: Adata_series11 
        },{
        name: myfea12,
                data: Adata_series12 
        }]

        });
		
		
		
		
		
		$('#graphcontainer2').highcharts({
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
        name: 'Total License',
                data: Adata_seriestotal2,lineColor: '#FF3933'
        },{
        name: myfea13,
                data: Adata_series13,lineColor: '#998877' 
        },{
        name: myfea14,
                data: Adata_series14 
        },{
        name: myfea15,
                data: Adata_series15 
        },{
        name: myfea16,
                data: Adata_series16 
        },{
        name: myfea17,
                data: Adata_series17
        },{
        name: myfea18,
                data: Adata_series18 
        },{
        name: myfea19,
                data: Adata_series19
        },{
        name: myfea20,
                data: Adata_series20 
        }]

        });
		  
		
		

} );
</script>
