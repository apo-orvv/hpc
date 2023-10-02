
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
echo "<p><b>Total Number of Jobs=$jobsumm[0] starting from $jobsumm[1]</b></p>";
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=Grp_Accounting_Summary\">Get Group wise Summary</a><br/>";
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=Usr_Accounting_Summary\">Get User wise Summary</a><br/>";
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=Year_Accounting_Summary\">Get Year wise Summary</a><br/>";
echo "<h3> Displaying latest 1000 Jobs</h3>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Job Id</th><th>Job Name</th><th>User Name</th><th>User Group</th><th> Queue Name</th><th>Start Time</th><th>End time</th><th>Exit Status</th><th>Slots</th><th>Wall Clock Time</th><th>CPU Usage</th><th>Memory Usage</th><th>IO Usage</th></tr></thead><tbody>";
//echo "<tfoot><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></tfoot><tbody>";
foreach($finishedjobs as $job){
echo "<tr><td>$job[0]</td><td>$job[1]</td><td>$job[2]</td><td>$job[3]</td><td>$job[4]</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$job[8]</td><td>$job[9]</td><td>$job[10]</td><td>$job[11]</td><td>$job[12]</td></tr>";
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

