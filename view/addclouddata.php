
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>

<?php
echo "<div class='w3-container'>";
echo "<h3>Add a Cloud Server </h3>";

echo "<form method = \"POST\" action = \"index.php?hpcpage=cloud_allotment\"><table align='center' border = 1> <tr> <th><b>Server Name:</b></br><input required type=\"text\" name=\"server_name\" ></th></tr><tr><th><b>IP Address</b></br><input  required type=\"text\" name=\"ip_address_dhcp\"> </th></tr><tr> <th><b>Flavor:</b></br><input type=\"text\" name=\"flavor\"> </th></tr>";

echo "<tr><th><b>CPUs Allocated:</b></br><input type=\"text\" name=\"cpu\" ></th> </tr><tr> <th><b>Memory allocated:</b></br><input required type=\"text\" name=\"mem\"> </th> </tr> ";
echo "<tr><th><b>OS Image:</b></br><input type=\"text\" name=\"os_image\" ></th> </tr>";
echo "<tr> <th><b>Users (You can add upto 4 users):</b> </br>User 1: <input required type=\"text\" name=\"users\"> </br></br> User 2: <input type=\"text\" name=\"user2\"> <br/> <br/>User 3: <input type=\"text\" name=\"user3\"><br/> <br/>User 4: <input type=\"text\" name=\"user4\">  </th> </tr> ";

echo "<tr><th><b>Emails:</b></br>Email 1: <input required type=\"text\" name=\"email\" ></br></br> Email 2: <input type=\"text\" name=\"email2\"> <br/> <br/>Email 3: <input type=\"text\" name=\"email3\"><br/> <br/>Email 4: <input type=\"text\" name=\"email4\"></th></tr>";
echo "<tr> <th><b>Volume Allocated:</b></br><input type=\"text\" name=\"volume_allocated\" ></th> </tr><tr> <th><b>Requested Mail Date:</b></br><input type=\"date\" name=\"requested_mail_date\" ></th></tr><tr><th><b>Remarks:</b></br><textarea name=\"remarks\" ></textarea></th></tr>";

echo "<tr><th><b>Division</b></br><input type=\"text\" name=\"div\" ></th> </tr>";
echo "<tr><th><b>Group</b></br><input type=\"text\" name=\"grp\" ></th> </tr>";
echo "<tr><th></br><input type=\"submit\" style = \"background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white\" name=\"save\" value=\"Save\"></th></tr></table>";



echo "</div>";
?>



