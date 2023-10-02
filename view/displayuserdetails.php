<link href="view/w3.css" rel="stylesheet" type="text/css" />

<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
//include "view/displaysystembanner.php";
echo "<h3>User details for $username</h3>";
echo "<table class='systemdetails' align='center' cellpadding='1' cellspacing='0'  border=1>";
echo "<tr><th>User Name</th><td>$userdetails[0]</td></tr>";
echo "<tr><th>Email</th><td>$userdetails[1]</td></tr>";
echo "<tr><th>Phone</th><td>$userdetails[2]</td></tr>";
echo "<tr><th>Group</th><td>$userdetails[3]</td></tr>";
echo "</table><br/>";
echo "<h4>Running Jobs</h4>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Cluster Name</th><th>Job ID </th><th>Job Name</th><th>Queue Name</th><th>State</th><th>Start Time</th><th>Cores</th><th>Process Name</th></tr></thead><tbody>";
foreach ($alljobs as $job){
echo "<tr><td>$job[1]</td><td>$job[2]</td><td>$job[3]</td><td>$job[4]</td><td>$job[6]</td><td>$job[5]</td><td>$job[8]</td><td>$job[7]</td></tr>";

}

echo "</tbody></table>";
echo "<h4>Usage History</h4>";
echo "<table id='historytable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Cluster Name</th><th>No. of Jobs </th><th>Total Cores</th><th>Total Wallclock Time (Hrs)</th></tr></thead><tbody>";
foreach ($jobhistory as $job){
if($job[1]==0){
	continue;
}
$wallclk=$job[2]/3600;
$wallclk=round($wallclk,2);
echo "<tr><td>$job[0]</td><td>$job[1]</td><td>$job[3]</td><td>$wallclk</td></tr>";

}

echo "</tbody></table>";
?>

<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
        "lengthMenu": [[5, 20, 40, -1], [5, 20, 40, "All"]]
    } );
    $('#historytable').DataTable( {
        "paging": false,
	"searching":false
    } );
} );
</script>


