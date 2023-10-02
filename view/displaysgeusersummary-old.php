
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>User Name</th><th>Number of Jobs</th><th>Slots</th><th>Wall Clock Time (HRS)</th><th>CPU Usage</th><th>Memory Usage</th></tr></thead><tbody>";
//echo "<tfoot><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></tfoot><tbody>";
foreach($usrsumm as $job){
$wallclk=$job[2]/3600;
echo "<tr><td><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=User_Accounting&username=$job[5]\">$job[5]</a></td><td>$job[0]</td><td>$job[1]</td><td>$wallclk</td><td>$job[3]</td><td>$job[4]</td></tr>";
}
echo "</tbody></table>";
?>
<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    } );
} );
</script>

