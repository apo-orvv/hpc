
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>

<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>


<?php
include "view/displaysystembanner.php";
echo "<h3>$systemname cluster Finished Jobs</h3>";
echo "<h6> Data from $fromval to $toval</h6>";

echo "<p class='systemdetails'>Total Number of Jobs=$jobsumm[0] starting from $jobsumm[1]</p>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Job Id</th><th>Job Name</th><th>User / Group</th><th> Queue Name</th><th>Start Time</th><th>End time</th><th>Exit Status</th><th>Cores</th><th>Wall Clock Time (Minutes)</th><th>Process</th></tr></thead><tbody>";
//echo "<tfoot><tr><th>Log Time </th><th>Server Name</th><th>Message</th></tr></tfoot><tbody>";
foreach($finishedjobs as $job){
$wallclk=$job[9]/60;
$wallclk=round($wallclk,2);
echo "<tr><td>$job[0]</td><td>$job[1]</td><td><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=User_Details&username=$job[2]\">$job[2] / $job[3]</a></td><td>$job[4]</td><td>$job[5]</td><td>$job[6]</td><td>$job[7]</td><td>$job[8]</td><td>$wallclk</td><td>$job[11]</td></tr>";
}
echo "</tbody></table>";
?>
<script>

$(document).ready(function() {

$('#jobtable').DataTable( {
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
	fixedHeader: true	
    } );
} );

</script>

