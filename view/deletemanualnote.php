  <form action="index.php?hpcpage=deletemanualnote" method="post">
    <div>
<?php
echo "<p>Do you want to delete the note titled '$desc'</p>";
echo "<input type='hidden' name='manualid' value='$manualid' readonly>";

?>

      <input type="submit" name="deletenote" value="Delete Note"/>
    </div>
  </form>
