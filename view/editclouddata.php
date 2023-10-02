
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>

<?php
echo "<div class='w3-container'>";
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
$date=$data['requested_mail_date'];
$rem=$data['remarks'];
$cpu=$data['CPU'];
$mem=$data['Memory'];
$div=$data['division'];
$grp=$data['groupname'];
echo "<h3>Edit Data on  Cloud Server:$server </h3>";
echo "<form method = \"POST\" action = \"index.php?hpcpage=cloud_allotment\"><table align='center' border = 1> <tr> <th><input type=\"hidden\" name=\"id\" value='$id'><b>Server Name:</b></br><input required type=\"text\" name=\"server_name\" value='$server' ></th></tr><tr><th><b>IP Address</b></br><input  required type=\"text\" name=\"ip_address_dhcp\" value='$ip'> </th></tr><tr> <th><b>Flavor:</b></br><input type=\"text\" name=\"flavor\" value=$flav> </th></tr>";

echo "<tr><th><b>CPUs Allocated:</b></br><input type=\"text\" name=\"cpu\" value='$cpu'></th> </tr><tr> <th><b>Memory allocated:</b></br><input required type=\"text\" name=\"mem\" value='$mem'> </th> </tr> ";
echo "<tr><th><b>OS Image:</b></br><input type=\"text\" name=\"os_image\" value='$os'></th> </tr>";
echo "<tr> <th><b>Users (You can add upto 4 users):</b> </br>User 1: <input required type=\"text\" name=\"users\" value='$use'> </br></br> User 2: <input type=\"text\" name=\"user2\" value='$use2'> <br/> <br/>User 3: <input type=\"text\" name=\"user3\" value='$use3'><br/> <br/>User 4: <input type=\"text\" name=\"user4\" value='$use4'>  </th> </tr> ";

echo "<tr><th><b>Emails:</b></br>Email 1: <input required type=\"text\" name=\"email\" value='$mail' ></br></br> Email 2: <input type=\"text\" name=\"email2\" value='$mail2'> <br/> <br/>Email 3: <input type=\"text\" name=\"email3\" value='$mail3'><br/> <br/>Email 4: <input type=\"text\" name=\"email4\" value='$mail4'></th></tr>";
echo "<tr> <th><b>Volume Allocated:</b></br><input type=\"text\" name=\"volume_allocated\" value='$vol'></th> </tr><tr> <th><b>Requested Mail Date:</b></br><input type=\"date\" name=\"requested_mail_date\" value='$date'></th></tr><tr><th><b>Remarks:</b></br><textarea name=\"remarks\" value='$rem' ></textarea></th></tr>";

echo "<tr><th><b>Division</b></br><input type=\"text\" name=\"div\" value='$div'></th> </tr>";
echo "<tr><th><b>Group</b></br><input type=\"text\" name=\"grp\" value='$grp' ></th> </tr>";
echo "<tr><th></br><input type=\"submit\" style = \"background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white\" name=\"update\" value=\"Update\"></th></tr></table>";



echo "</div>";
?>



