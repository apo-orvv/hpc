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
echo "<h4>$systemname Cluster Backup status to NAS</h4>";
echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Backup Group </th><th>Start Time</th><th>End Time</th><th>Sent Data in MB</th><th>Received Data in MB</th><th>Transfer Rate MBPS</th><th>Total Size in MB</th><th>Speed Up</th><th>Time taken in Sec</th><th>Status</th></tr></thead><tbody>";
foreach ($bkstat as $bkst){
	$sent = explode(" ", $bkst[3]);
	$sent = round($sent[0] / (1024*1024),4);
	$received = explode(" ", $bkst[4]);
	$received = round($received[0] / (1024*1024),4);
	$trate = explode(" ", $bkst[5]);
	$trate = round($trate[0] / (1024*1024),4) ;
	$tsize = explode(" ", $bkst[6]);
	$tsize = round($tsize[0] / (1024*1024),4);
	$timetaken=round($sent / $trate,4);
echo "<tr><td>$bkst[0]</td><td>$bkst[1]</td><td>$bkst[2]</td><td>$sent </td><td>$received</td><td>$trate</td><td>$tsize</td><td>$bkst[7]</td><td>$timetaken </td><td>$bkst[8]</td></tr>";

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


