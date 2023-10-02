
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'  >";
echo "<h4 style='color:#2C589E;' align='center'>License Availability for $software</h4>";
$timeofmon=$licenses[0][0];
 $server=$licenses[0][1];
echo "<p class='systemdetails'>$software License Server is  <b>$server</b></p>";
 $timeofmon = date("d-M-Y H:i:s", strtotime($timeofmon));
echo "<p class='systemdetails' style='color:#047bbf;'><i>Last Updated on  $timeofmon</i></p>";
 
?>

<form action="index.php?hpcpage=systemdetails&systemname=Licenses&systemparam=License_Users" method="POST">
 <input type="hidden" id="swname" name="swname" value="<?php echo $software;?> ">
<input style='color:#2C589E;' type="submit" name='swname1' value="<?php echo "License Users of $software"?>" class='submit' /><br/>


</form>


<br></br>
<?php


echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1 width='70%'><thead style='color:#2C589E;'><tr><th>Features/Modules </th><th>Total Licenses</th><th>Licenses Used</th><th>Licenses Available</th></tr></thead><tbody>";
foreach ($licenses as $license){
$var=	$license[3]-$license[4];
echo "<tr><td>$license[2]</td><td>$license[3]</td><td>$license[4]</td><td>$var</td></tr>";

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


