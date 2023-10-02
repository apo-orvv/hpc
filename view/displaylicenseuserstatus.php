
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";

echo "<div class='w3-container'>";
echo "<h4 style='color:#2C589E;' align='center'>Software License Users</h4>";

echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1 ><thead style='color:#2C589E;'><tr><th>Software</th><th>Features / Modules </th><th>User Name</th><th>Machine Name</th><th>Start-Time</th><th>No. of Licenses</th></tr></thead><tbody>";
foreach ($licenseusers as $license){
echo "<tr><td>$license[5]</td><td>$license[2]</td><td>$license[0]</td><td>$license[3]</td><td>$license[4]</td><td>$license[6]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]]
    } );
} );
</script>


