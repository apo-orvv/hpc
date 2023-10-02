<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4>Queue details for $systemname</h4>";

echo "<table id='nodetable' class='display' align='center' cellpadding='1' cellspacing='1'  border=1><thead><tr><th>Queue Name</th><th>Load Avg</th><th> Used Cores</th><th> Available Cores</th><th>Total Cores</th><th>Down Cores</th></tr></thead><tbody>";
foreach ($nodesummary as $nodelist){
$nodelist[2]=round($nodelist[2],2);
echo "<tr><td>$nodelist[1]</td><td>$nodelist[2]</td><td>$nodelist[3]</td><td>$nodelist[4]</td><td>$nodelist[5]</td><td>$nodelist[6]</td></tr>";
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




