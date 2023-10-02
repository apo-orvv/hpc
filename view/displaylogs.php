
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h3>Storage Logs from $systemname</h3>";
echo "<table id='logtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></thead><tbody>";
//echo "<tfoot><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></tfoot><tbody>";
foreach($logmsgs as $mymsg){
echo "<tr><td>$mymsg[0]</td><td>$mymsg[1]</td><td>$mymsg[2]</td></tr>";
}
echo "</tbody></table>";
echo "</div>";
?>
<script>

$(document).ready(function() {
    $('#logtable').DataTable( {
        "lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
    } );
} );
</script>

