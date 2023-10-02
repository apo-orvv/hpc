<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>

<?php
include "view/displaysystembanner.php";

echo "<div class='w3-container'>";
echo "<h4>Logged in User details for $systemname</h4>";
$timeofmon=$users[0][0];
echo "<p class='systemdetails'>Monitored at $timeofmon</p>";
echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>User </th><th>Full Name</th><th>IP Address</th><th>Phone Number</th><th>Email</th><th>Login Time</th><th>Process</th></tr></thead><tbody>";
foreach ($users as $user){
echo "<tr><td>$user[1]</td><td>$user[7]</td><td>$user[2]</td><td>$user[5]</td><td>$user[6]</td><td>$user[3]</td><td>$user[4]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
	fixedHeader: true
    } );
} );
</script>


