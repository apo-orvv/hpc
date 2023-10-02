  <h1>Edit Manual</h1>
  <form action="index.php?hpcpage=editmanualfile"  enctype="multipart/form-data" method="post">
    <div>
	<label>Add a Title</label>
	&nbsp;&nbsp;
<?php
$filename=pathinfo($fileloc,PATHINFO_BASENAME);
echo "<input type='text' name='description' size='100' value='$desc'/><br/><br/>";
echo "<input type='hidden' name='manualid' value='$manualid' readonly>";
echo "<label>File Available: <a class='small-link' href=\"filedownload.php?fileid=$manualid\" target=\"_blank\">$filename</a></label> <br/><br/>";
echo "<label> Select a New File</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type='file' name='manualfile'><br/><br/>";
?>
	<label>Indented For</label>
	&nbsp;&nbsp;
<?php
if($indented == "AOU"){
echo "<select name='indented'><option value='AOU' selected>Users</option><option value='AO'>Operators & Administrators</option><option value='A'>Administrators Only</option></select><br/><br/>";
}
if($indented == "AO"){
echo "<select name='indented'><option value='AOU' >Users</option><option value='AO' selected>Operators & Administrators</option><option value='A'>Administrators Only</option></select><br/><br/>";
}
if($indented == "A"){
echo "<select name='indented'><option value='AOU' selected>Users</option><option value='AO'>Operators & Administrators</option><option value='A' selected>Administrators Only</option></select><br/><br/>";
}
?>

      <input type="submit" name="editfile" value="Edit Manual"/>
    </div>
  </form>
