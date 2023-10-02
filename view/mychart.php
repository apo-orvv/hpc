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

$req=$dbh->prepare("SELECT avg(UsedPercent) as UsedPercent, HOUR(timeofmon) FROM `clusterusage` group by HOUR(timeofmon) ");
                $req->execute();
		$usedpercents=array();
		$i=0;
                foreach ($req->fetchAll() as $msg){
		$usedpercents[$i]=$msg[	'UsedPercent'];
		$i=$i+1;
	}

	$usedpercentstr=join($usedpercents,',');
	echo "<p>OUR DATA FROM DB IS <br/>$usedpercentstr</p>";
	$dbh=null;
	 $myjson_str=json_encode($usedpercentstr,JSON_NUMERIC_CHECK);
	echo "<p>OUR DATA FROM JSON IS <br/>$myjson_str</p>";
	

?>
   
      <div id = "container" style = "width: 550px; height: 400px; margin: 0 auto"></div>
      <script language = "JavaScript">
         $(document).ready(function() {

	    var data_series = <?php echo $myjson_str; ?>;
            var title = {
               text: 'Monthly Average Temperature'   
            };
            var subtitle = {
               text: 'Source: WorldClimate.com'
            };
            var xAxis = {
               categories: ['0', '1', '2', '3', '4', '5',
                  '6', '7', '8', '9', '10', '11','12','13','14','15','16','17','18','19','20','21','22','23']
            };
            var yAxis = {
               title: {
                  text: 'Temperature (\xB0C)'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   

            var tooltip = {
               valueSuffix: '\xB0C'
            }
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var series =  [{
                  name: 'UsedPercent',
                  data: data_series
               }];

            var json = {};
            json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;

            $('#container').highcharts(json);
         });
      </script>
   </body>
   
</html>
