
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>

<?php
echo "<h1>Job details for $systemname</h1>";
$timeofmon=$jobdetails[0][10];
echo "<h3>Monitored at $timeofmon</h3>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Job ID </th><th>Job Name</th><th>User Name</th><th>Partition</th><th>State</th><th>Start Time</th><th>Elapsed Time</th><th>Nodes</th><th>Node List</th><th>CPUs</th><th>Job Type</th></tr></thead><tbody>";
foreach ($jobdetails as $job){
$nodes = str_replace(",",", ",$job[8]);
echo "<tr><td>$job[0]</td><td>$job[2]</td><td>$job[3]</td><td>$job[1]</td><td>$job[4]</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$nodes</td><td>$job[9]</td><td>$job[11]</td></tr>";

}

echo "</tbody></table>";
?>

<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
	"scrollX": false,
	"scrollY": 800,
	"scrollCollapse": true,
  	"paging": false
    } );
} );
</script>


