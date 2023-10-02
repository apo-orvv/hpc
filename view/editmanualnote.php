  <script type="text/javascript" src="view/ckeditor/ckeditor.js"></script>
<?php
$fd=fopen($fileloc,"r") or die("<p>$fileloc couldn't be read</p>");
$contents = fread($fd, filesize($fileloc));
fclose($fd);
?>
  <h1>Edit Note</h1>
  <form action="index.php?hpcpage=editmanualnote" method="post">
    <div>
	<label>Add title</label>
	&nbsp;&nbsp;

<?php
echo "<input type=\"text\" name='description' size='100' value=\"$desc\"/><br/><br/>";
echo "<input type='hidden' name='manualid' value='$manualid' readonly>";
echo " <textarea cols='50' rows='10' id='content' name='content'>  ";
echo " $contents    ";
echo "</textarea><br/><br/>";
?>
      <script type="text/javascript">
        CKEDITOR.replace( 'content' );
      </script>

	<label>Indented For</label>&nbsp;&nbsp;

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
      <input type="submit" name="editnote" value="Upload Note"/>
    </div>
  </form>
