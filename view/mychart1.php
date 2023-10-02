<html>
   <head>
      <title>Highcharts Tutorial</title>
      <script src = "js/jquery.min.js">
      </script>
      <script src = "js/highcharts.js"></script> 
   </head>
   <body>
<?php
$hpchost="localhost";
 $dbuser="hpcweb";
  $dbpasswd="web@hpc";
$dbname="hpcmonitor";
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$dbh = new PDO("mysql:host=$hpchost;dbname=$dbname", $dbuser, $dbpasswd);

$req=$dbh->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)='2017-10-25' group by HOUR(timeofmon) ");
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
	$myhour_str = json_encode($hours,JSON_NUMERIC_CHECK);
	echo "<p>OUR DATA FROM DB IS <br/>$usedpercentstr<br/>HOURS:$hourstr</p>";
	$dbh=null;
	echo "<p>OUR DATA FROM JSON IS <br/>$myjson_str<br/>HOUR_STR:$myhour_str</p>";
	

?>
   
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
         $(function() {

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

	});



      </script>
   </body>
   
</html>
