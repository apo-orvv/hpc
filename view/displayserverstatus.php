
<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<?php
include "view/displaysystembanner.php";

echo "<h3>Storage  Server Status for $systemname</h3>";
echo "<table  class='systemdetails' align='center' cellpadding='1' cellspacing='1'  border=1><tr><th>Storage Server</th><th>Status</th></tr>";
foreach ($storserverstat as $storage){
echo "<tr><td>$storage[2]</td><td>$storage[3]</td></tr>";
}


echo "</table>";
?>

<script>

$(document).ready(function() {
    $('#storetable').DataTable( {
        "paging":   false,
        "searching": false    
        } );
} );
</script>



