
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";

echo "<div class='w3-container'>";
echo "<h3>Storage Status for $systemname</h3>";
$timeofmon=$storstat[0][0];
echo "<p class='systemdetails'>Monitored at $timeofmon</p>";
echo "<table id='storetable' class='display' align='center' cellpadding='1' cellspacing='1'  border=1><thead><tr><th>Partition</th><th>Total Space</th><th> Used Space</th><th> Available Space</th><th>Percentage</th><th>Mounted On</th></tr></thead><tbody>";
foreach ($storstat as $storage){
echo "<tr><td>$storage[2]</td><td>$storage[3]</td><td>$storage[4]</td><td>$storage[5]<td>$storage[6]</td><td>$storage[7]</td></tr>";
}
echo "</tbody></table><br/><br/>";
echo "</div>";

?>

<script>

$(document).ready(function() {
    $('#storetable').DataTable( {
        "paging":   false,
        "searching": false    
        } );
} );
</script>



