<link href="view/w3.css" rel="stylesheet" type="text/css" />

<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4>Node details for $systemname</h4>";
$timeofmon=$nodedetails[0][11];
echo "<p class='systemdetails'>Monitored at $timeofmon";
echo " <center><a href=\"index.php?hpcpage=systemdetails&systemname=Ivy&systemparam=Nodes%20(Detailed)\" class='small-link' >Individual Node Details</a></center></p>";
echo "<table id='nodetable' class='display' width='95%' align='center' cellpadding='0' cellspacing='0'  border=1><thead><tr><th>Queue Name </th><th>Status</th><th>State</th><th>Node List</th><th>Allocated Nodes</th><th>Idle Nodes</th><th>Total Nodes</th><th>Allocated Cores</th><th>Idle Cores</th><th>Total Cores</th></tr></thead><tbody>";

foreach ($nodedetails as $job){
$nodes = str_replace(",",", ",$job[4]);
echo "<tr><td>$job[0]</td><td>$job[1]</td><td>$job[3]</td><td>$nodes</td><td>$job[5]</td><td>$job[6]</td><td>$job[2]</td><td>$job[7]</td><td>$job[8]</td><td>$job[10]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#nodetable').DataTable( {
 	"paging":   false,
        "searching": false    
	} );
} );

</script>


