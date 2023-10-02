<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4 class='systemdetails'>Workstation AD Users</h4>";

echo "<table id='usertable' class=\"display\" align='center'>";
echo "<thead><tr><th>AD Account Name</th><th>User Name </th> <th>IC.No</th><th>Email ID</th><th>Group Name</th><th>Last Login Date & Time</th> </tr></thead><tbody>";
foreach ($gwsadusers as $lic){
echo "<tr><td>$lic[0]</td><td>$lic[1]</td><td>$lic[6]</td><td>$lic[4]</td><td>$lic[2]</td><td>$lic[3]</td></tr>";
}
echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
    
} );
} );
</script>


