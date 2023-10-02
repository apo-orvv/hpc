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
echo "<h4>Queue Details for $systemname</h4>";
echo "<table id='queuetable' class='display'  width='95%' align='center' cellpadding='1' cellspacing='1' >";
echo "<thead><tr><th>Queue</th><th>Allocated Nodes</th><th>Idle Nodes</th><th>Down Nodes</th><th>Mixed Nodes</th><th>Others</th></tr></thead><tbody>";
foreach ($queuesummary as $queue){
echo "<tr><td>$queue[0]</td><td>$queue[1]</td><td>$queue[2]</td><td>$queue[3]</td><td>$queue[4]</td><td>$queue[5]</td></tr>";
}
echo "</tbody></table><br/><br/>";
echo "</div>";
?>
<script>

$(document).ready(function() {
    $('#queuetable').DataTable( {
        "paging":   false,
        "searching": false    
        } );
} );
</script>

