<link rel="stylesheet" href="view/bootstrap-3.3.7/css/bootstrap.min.css">
<link href="view/w3.css" rel="stylesheet" type="text/css" />

  <script src="view/js/jquery.min.js"></script>
  <script src="view/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<?php
if(($usertype=='A') || ($usertype=='AI') or ($usertype=='O') || ($usertype=='AS') || ($usertype=='AD')){
echo "<nav class=\"navbar navbar-inverse\">  <div class=\"container-fluid\"><div class=\"navbar-header\"></div>";
echo " <ul class=\"nav navbar-nav\"> <li class=\"active\"><a href=\"index.php?hpcpage=uploadmanualnote\">Upload a Note</a></li> <li class=\"active\"><a href=\"index.php?hpcpage=uploadmanualfile\">Upload a File</a></li>  </ul> </div> </nav>";
}
 if($mymanualcat=="HPC") { echo "<h3>HPC Documents and manuals</h3>";}
 if($mymanualcat=="VDI") { echo "<h3>VDI Documents and manuals</h3>";}
 if($mymanualcat=="IR") { echo "<h3>Internal Reports</h3>";}
 if($mymanualcat=="GEN") { echo "<h3>General Documents</h3>";}

$i=1;
foreach($mymanuals as $manual){
$divid="demo".$i;
if(strcmp($manual[2],"note")==0){
$file=$manual[3];
$fd=fopen($file,"r") or die("<p>$file couldn't be read</p>");
$contents = fread($fd, filesize($file));
fclose($fd);
echo "<div class='panel-group'> <div class='panel panel-default'> <div class='panel-heading'><p class='panel-title'><span class=\"glyphicon\">&#x2b;</span><a data-toggle=\"collapse\" href=\"#$divid\"> $manual[4]</a></p></div>";

echo "<div id=\"$divid\" class=\"panel-collapse collapse\"> <div class=\"panel-body\">$contents</div>";

if(strcmp($username,$manual[5])==0){
echo "<div class=\"panel-footer\"><a class='small-link' href=\"index.php?hpcpage=editmanualnote&manualid=$manual[0]\"><span class=\"glyphicon\">&#xe065;</span>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='small-link' href=\"index.php?hpcpage=deletemanualnote&manualid=$manual[0]\"><span class=\"glyphicon\">&#xe020;</span>Delete</a> </div></div></div></div>";
}
else{
echo "</div></div></div>";
}
}//manualnote
if(strcmp($manual[2],"file")==0){
if(strcmp($username,$manual[5])==0){
echo "<div class='panel-group'> <div class='panel panel-default'> <div class='panel-heading'><p class='panel-title'><span class=\"glyphicon\">&#x2b;</span><a data-toggle=\"collapse\" href=\"#$divid\"> $manual[4]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='small-link' href=\"filedownload.php?fileid=$manual[0]\" target=\"_blank\"><span class=\"glyphicon\">&#xe026;</span>Download</a></p></div>";
echo "<div id=\"$divid\" class=\"panel-collapse collapse\"> <div class=\"panel-body\"><a class='small-link' href=\"index.php?hpcpage=editmanualfile&manualid=$manual[0]\"><span class=\"glyphicon\">&#xe065;</span>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='small-link' href=\"index.php?hpcpage=deletemanualfile&manualid=$manual[0]\"><span class=\"glyphicon\">&#xe020;</span>Delete</a> </div></div></div></div>";
}
else{
echo "<div class='panel-group'> <div class='panel panel-default'> <div class='panel-heading'><p class='panel-title'> $manual[4]</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class='small-link' href=\"filedownload.php?fileid=$manual[0]\" target=\"_blank\"><span class=\"glyphicon\">&#xe026;</span>Download</a></p></div>";
echo "</div></div>";
}

}
$i++;
    
}//foreach

?>

