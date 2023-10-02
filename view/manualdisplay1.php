<link rel="stylesheet" href="view/bootstrap-3.3.7/css/bootstrap.min.css">
  <script src="view/js/jquery.min.js"></script>
  <script src="view/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<?php

echo "<h4> Admin Manuals</h4>";
echo "<p>User Type is $usertype</p>";
$i=1;
foreach($mymanuals as $manual){
$divid="demo".$i;
//echo "<p>$manual[0].....$manual[1]........$manual[2]..$manual[3]......$manual[4]..$manual[5]</p>";
if(strcmp($manual[2],"note")==0){
$file=$manual[3];
$fd=fopen($file,"r") or die("<p>$file couldn't be read</p>");
$contents = fread($fd, filesize($file));
fclose($fd);
echo "<button data-toggle=\"collapse\" data-target=\"#$divid\">$manual[4]</button>";
echo "<div id=\"$divid\" class=\"collapse\">$contents</div>";
$i++;
}
if(strcmp($manual[2],"file")==0){
echo "<p>$manual[4]</p>";
echo "<a href=\"filedownload.php?fileid=$manual[0]\" target=\"_blank\">Download</a><br/>";
}
    
}

?>

