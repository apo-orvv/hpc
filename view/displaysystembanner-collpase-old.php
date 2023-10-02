<link href="view/w3.css" rel="stylesheet" type="text/css" />
<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>
<?php
if(strcmp($systemname,"Licenses")==0){
	$displayname=$systemname;
}	
else{
	$displayname="$systemname Cluster";
}
echo "<div class=\"w3-sidebar w3-bar-block w3-card-2 w3-animate-left\" style=\"display:none\" id=\"mySidebar\">
  <button class=\"w3-bar-item w3-button w3-large\"
  onclick=\"w3_close()\">Close &times;</button>";
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname\"  class=\"w3-bar-item w3-button\">$systemname Home</a>";
foreach ($displaysysparams as $param){
$myparam=str_replace("_"," ",$param);
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=$param\" class=\"w3-bar-item w3-button\">$myparam</a>";
}
echo "</div>
<div id='main'>

<div class=\"w3-teal\">
  <button id=\"openNav\" class=\"w3-button w3-teal w3-large\" onclick=\"w3_open()\">&#9776;Menu</button>
  <div class=\"w3-container\">
    <h1>$displayname</h1>
  </div>
</div></div>";
?>
