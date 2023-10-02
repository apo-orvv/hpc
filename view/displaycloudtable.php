
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>

<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jszip.min.js"> </script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.print.min.js"></script>

<?php
echo "<div class='w3-container'>";
echo "<h3>Cloud Server Allotment Details</h3>";
echo "<form method =\"POST\" action = \"index.php?hpcpage=cloud_allotment\"> <input type=\"hidden\" name=\"hpcpage\" value = \"cloud_allotment\"> <input type = 'submit' name='add' style = \"background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white\" value = 'Add'> <input type = 'submit' name='edit' style = \"background-color:blue;border:none;font-weight: bold;padding: 7px 20px;color:white\" value = 'Edit'> <input type = 'submit' onclick=\"confirm_delete()\" name=\"delete\" style = \"background-color:red;border:none;font-weight: bold;padding: 7px 20px;color:white\" value = 'Delete'>";
echo "<p>Choose the corresponding button to Edit/ Delete a Server</p>";
echo "<table id='jobtable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr><th>Server Name </th><th>IP Address</th><th>CPU</th><th>RAM</th><th>OS Image </th><th>Users</th><th>Email</th><th>Volumes</th><th>Division / Group </th><th>Remarks</th></tr></thead><tbody>";

foreach ($clouddata as $data){
$server=$data['server_name'];
$ip=$data['ip_address_dhcp'];
$os=$data['os_image'];
$flav=$data['flavor'];
$use=$data['users'];
$use2=$data['user2'];
$use3=$data['user3'];
$use4=$data['user4'];
$mail=$data['email'];
$mail2=$data['email2'];
$mail3=$data['email3'];
$mail4=$data['email4'];
$vol=$data['volume_allocated'];
#$date=$data['requested_mail_date'];
$rem=$data['remarks'];
$cpu=$data['CPU'];
$mem=$data['Memory'];
$div=$data['division'];
$grp=$data['groupname'];

$id=$data['id'];
echo "<tr><td>$server<br/><input type='radio' name='id' value=\"$id\"></td>";
echo "<td>$ip</td><td>$cpu</td><td>$mem</td><td>$os</td><td>$use <br/>$use2<br/>$use3<br/>$use4</td><td>$mail<br/>$mail2<br/>$mail3<br/>$mail4</td><td>$vol</td><td> $div / $grp </td><td>$rem</td></tr>";

}

echo "</tbody></table>";
echo "</form></div>";
?>

<script>

$(document).ready(function() {
    $('#jobtable').DataTable( {
	fixedHeader: true,
	"lengthMenu": [[15, 30, 45, -1], [15, 30, 45, "All"]],
	 dom: '<"top"Blf>rti<"bottom"p>',	
	 buttons: ['excel','pdf','print'],
   
 } );
} );
</script>


