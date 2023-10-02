<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";
echo "<h4 class='systemdetails' style='color:#2C589E;' align='center'>License Utilization Summary </h4>";
//echo "<p class='systemdetails' style='color:#047bbf;'><i>Last Updated on  $timeofmon</i></p>";


 $timeofmon = date("d-M-Y H:i:s", strtotime($timeofmon));
  

echo "<p class='systemdetails' style='color:#047bbf;'><i>Last Updated on  $timeofmon</i></p>";

   
echo "<table id='usertable' class=\"display\" align='center' width='70%'>";
echo "<thead style='color:#2C589E;' ><tr><th>Software</th><th>Features/Modules</th><th>Total Licenses</th><th>Licenses Used</th></tr></thead><tbody>";
foreach ($licensesummary as $lic){
	if(($lic[2]=="abaqus") || ($lic[2]=="COMSOL"))
	{ 
	echo "<tr style='color:#FF8C00;'><td style='font-weight:bold;'>$lic[1](Base License)</td><td style='font-weight:bold;'>$lic[2]</td style='font-weight:bold;'><td style='font-weight:bold;'>$lic[3]</td><td style='font-weight:bold;'>$lic[4]</td></tr>";
	}
	else
	{
	echo "<tr><td>$lic[1]</td><td>$lic[2]</td><td>$lic[3]</td><td>$lic[4]</td></tr>"; 
	}
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


