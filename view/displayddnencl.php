
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
echo "<h4>DDN Enclosure Details for  $systemname</h4>";
echo " <div class=\"w3-bar w3-light-grey\"> <a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=DDN_Storage\" class=\"w3-bar-item w3-button\">DDN Home</a> <a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=DDN_Storage&systemattribute=Controllers\" class=\"w3-bar-item w3-button\">Controllers</a> <a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=DDN_Storage&systemattribute=Enclosures\" class=\"w3-bar-item w3-button\">Enclosures</a> <a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=DDN_Storage&systemattribute=Disks\" class=\"w3-bar-item w3-button\">Disks</a> <a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=DDN_Storage&systemattribute=Pools\" class=\"w3-bar-item w3-button \">Pools</a></div>";

echo "<br/><br/>";
echo "<table id='ddntable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Time of Monitoring </th><th>Controller IP</th><th>Enclosure ID</th><th>Enclosure Type</th><th>Vendor ID</th><th>Product ID</th><th> Revision</th><th>Firmware</th><th>Responsive</th></tr></thead><tbody>";
foreach ($ddndisks as $ddn){
echo "<tr><td>$ddn[0]</td><td>$ddn[1]</td><td>$ddn[2]</td><td>$ddn[3]</td><td>$ddn[4]</td><td>$ddn[5]</td><td>$ddn[6] </td><td>$ddn[7] </td><td> $ddn[8]</td></tr>";

}

echo "</tbody></table>";
echo "</div>";
?>

<script>

$(document).ready(function() {
    $('#ddntable').DataTable( {
	"lengthMenu": [[40, 80, 120, -1], [40,80, 120, "All"]],
	fixedHeader: true 
	
 } );
} );
</script>


