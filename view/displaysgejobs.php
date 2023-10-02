
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4>Job details for $systemname</h4>";
$timeofmon=$jobdetails[0][9];
echo "<p class='systemdetails'>Monitored at $timeofmon</p>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Job ID </th><th>Job Name</th><th>User Name</th><th>Queue Name</th><th>State</th><th>Start Time</th><th>Priority</th><th>Host</th><th>Cores</th><th>Process Name</th></tr></thead><tbody>";
foreach ($jobdetails as $job){
echo "<tr><td>$job[0]</td><td>$job[2]</td><td><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=User_Details&username=$job[3]\">$job[3]</a></td><td>$job[1]</td><td>$job[4]</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$job[8]</td><td>$job[10]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]]
    } );
} );
</script>


