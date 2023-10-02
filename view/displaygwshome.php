<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4 class='systemdetails'>Current Utilization of Workstations</h4>";

 $timeofmon = date("F j, Y, g:i a", strtotime($timeofmon));  
echo "<p class='systemdetails'>Monitored at $timeofmon</p>";
echo "<table id='usertable' class=\"display\" align='center' width='70%'>";
echo "<thead><tr><th>GWS Name</th><th>Logged In Users </th><th>CPU utilization</th><th>Memory utilization</th><th>C Drive free space</th></tr></thead><tbody>";
foreach ($gwssummary as $lic){
echo "<tr><td>$lic[0]</td><td>$lic[1]</td><td>$lic[2]</td><td>$lic[3]</td><td>$lic[4]</td></tr>";
}
echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
    "paging":   false,
        "searching": false 
} );
} );
</script>


