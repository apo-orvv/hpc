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
echo "<h4>Node details for $systemname</h4>";
$timeofmon=$nodedetails[0][2];
echo "<p class='systemdetails'>Monitored at $timeofmon</p>";

echo "<table id='nodetable' class='display' width='95%' align='center' cellpadding='0' cellspacing='0'  border=1><thead><tr><th>Node Name</th><th>Queue Name </th><th>Status</th><th>Allocated Cores</th><th>Idle Cores</th><th>Other Cores</th><th>Total Cores</th><th>Load Avg</th></tr></thead><tbody>";

foreach ($nodedetails as $job){
echo "<tr><td>$job[0]</td><td>$job[1]</td><td>$job[3]</td><td>$job[4]</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$job[8]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#nodetable').DataTable( {

 	"lengthMenu": [[40, 80, 100, -1], [40, 80, 100, "All"]],
        fixedHeader: true  
	} );
} );
</script>


