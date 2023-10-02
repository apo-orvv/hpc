  <form action="index.php?hpcpage=deletemanualfile" method="post">
    <div>
<?php
$filename=pathinfo($fileloc,PATHINFO_BASENAME);
echo "<p>Do you want to delete the file \"$filename\" titled '$desc'</p>";
echo "<input type='hidden' name='manualid' value='$manualid' readonly>";

?>

      <input type="submit" name="deletefile" value="Delete File"/>
    </div>
  </form>
