
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4>Job details for $systemname</h4>";
$timeofmon=$jobdetails[0][10];
echo "<p class='systemdetails'>Monitored at $timeofmon <br/>Total Jobs: $jobnumber[0]<br/>Running Jobs: $jobnumber[1]<br/>Pending Jobs: $jobnumber[2]<center><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=JobsChart\" class='small-link'>View Charts</a></p>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Job ID </th><th>Job Name</th><th>User Name</th><th>Queue</th><th>State</th><th>Start Time</th><th>Elapsed Time</th><th>Nodes</th><th>Node List</th><th>Cores</th><th>Job Type</th></tr></thead><tbody>";
foreach ($jobdetails as $job){
$nodes = str_replace(",",", ",$job[8]);
echo "<tr><td>$job[0]</td><td>$job[2]</td><td><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=User_Details&username=$job[3]\" >$job[3]</a></td><td>$job[1]</td><td>$job[4] ($job[12])</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$nodes</td><td>$job[9]</td><td>$job[11]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
	 "lengthMenu": [[20, 40, 60, -1], [20,40, 60, "All"]],
	fixedHeader: true   
 } );
} );
</script>


