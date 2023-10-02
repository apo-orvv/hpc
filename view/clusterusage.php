<html>
      <title>Highcharts Tutorial</title>
<link type="text/css" href="DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="js/jquery-ui.css">
<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
 <script src = "js/highcharts.js"></script> 
<?php
$hpchost="localhost";
 $dbuser="hpcweb";
  $dbpasswd="web@hpc";
$dbname="hpcmonitor";
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$dbh = new PDO("mysql:host=$hpchost;dbname=$dbname", $dbuser, $dbpasswd);

if(isset($_POST['submit']) ){
	if(isset($_POST['fromdate'])){
	$fromval=$_POST['fromdate'];
	}
	if(isset($_POST['todate'])){
	$toval=$_POST['todate'];
	}
	echo "<p> Selected Date Range: $fromval..$toval</p>";
	if(strcmp($fromval,$toval)==0){

$req=$dbh->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)='$fromval' group by HOUR(timeofmon) ");
	}
	else{

$req=$dbh->prepare("SELECT avg(UsedPercent) as UsedPercent,DATE(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)>='$fromval' and DATE(timeofmon)<='$toval'  group by DATE(timeofmon) ");
	}

	
}
else{
$this_day=date("Y-m-d");
echo "<p>Showing data for $this_day</p>";
$req=$dbh->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)='$this_day' group by HOUR(timeofmon) ");
}
                $req->execute();

	//	$usedpercent=$req->fetchAll();
		$usedpercents=array();
		$hours=array();
		$i=0;
                foreach ($req->fetchAll() as $msg){
		$usedpercents[$i]=$msg[	'UsedPercent'];
		$hours[$i]=$msg['MYHOUR'];
		$i=$i+1;
	}

	$usedpercentstr=join($usedpercents,',');
	$hourstr=join($hours,',');
	$myjson_str = json_encode($usedpercents,JSON_NUMERIC_CHECK);
	$myhour_str = json_encode($hours);
	echo "<p>OUR DATA FROM DB IS <br/>$usedpercentstr<br/>HOURS:$hourstr</p>";
	$dbh=null;
	echo "<p>OUR DATA FROM JSON IS <br/>$myjson_str<br/>HOUR_STR:$myhour_str</p>";

echo "<form id='form1' method='post' action=\"clusterusage.php\">";
	
echo "<table align='center' cellpadding='1' cellspacing='0' border=1><tr><td colspan='5'><tr><td>Select a time interval</td><td>From</td><td><input id='datepicker' name='fromdate'></td><td>To</td><td><input id='datepicker1' name='todate'></td></tr><tr><td colspan='5' align='center'> <input type='submit' name='submit' value='Submit'></td></tr></table>";
echo "</form>";
?>
   
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
  

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
	$('#container').highcharts({
                chart: {
                        type: 'line'
                },
                title: {
                        text: 'Used Percentage of Cluster'
                },
                xAxis: {
                categories:xaxis_data 
                },
                yAxis: {
                title: {
                        text: 'Percentage Usage'
                }
        },
        series: [{
        name: 'Used Percent',
                data: data_series 
        }]

        });

} );
</script>
 
</html>
