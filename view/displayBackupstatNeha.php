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
echo "<h4>NEHA Cluster Backup status to NAS</h4>";
echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Backup Group </th><th>Start Time</th><th>End Time</th><th>Sent Data</th><th>Received Data</th><th>Transfer Rate</th><th>Total Size</th><th>Speed Up</th><th>Status</th></tr></thead><tbody>";
foreach ($bkstat as $bkst){
echo "<tr><td>$bkst[0]</td><td>$bkst[1]</td><td>$bkst[2]</td><td>$bkst[3]</td><td>$bkst[4]</td><td>$bkst[5]</td><td>$bkst[6]</td><td>$bkst[7]</td><td>$bkst[8]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	fixedHeader: true
    } );
} );
</script>


