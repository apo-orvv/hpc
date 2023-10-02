<link href="view/w3.css" rel="stylesheet" type="text/css" />
<?php


if(strcmp($systemname,"Licenses")==0){
        $displayname=$systemname;
}
else{
        $displayname="$systemname Cluster";
}


echo "<div class=\"w3-container\"> <div class=\"w3-bar w3-black\"><a href=\"index.php?hpcpage=systemdetails&systemname=$systemname\" class=\"w3-bar-item w3-button w3-text-white\">$systemname Home</a>";
$nodesdetail=0;
$showstorage=0;
$showansys=0;
$showutil=0;
$storparams=array();
$storparams1=array();

foreach ($displaysysparams as $param){
$menu_color="w3-text-white";    
if(preg_match("/Storage/",$param,$match)){
$showstorage=1;
array_push($storparams,$param);
        continue;
}

if(preg_match("/ANSYS/",$param,$match)){
$showansys=1;
array_push($storparams,$param);
        continue;
}


if(preg_match("/Utilization/",$param,$match)){
$showutil=1; 
array_push($storparams1,$param);
        continue;
}



if($nodesdetail==1){
if(preg_match("/Nodes/",$param,$match)){
continue;
}
}
$myparam=str_replace("_"," ",$param);
if(preg_match("/Cluster_Usage_History/",$param,$match)){
$myparam="Cluster Usage";
}
if(!in_array($param,$sysparams_user_role))
        $menu_color="w3-text-blue";
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=$param\"  class=\"w3-bar-item w3-button $menu_color\">$myparam</a>";
}


if($showstorage==1){
if(!in_array($storparams[0],$sysparams_user_role))
        $button_color="w3-text-blue";
else
    $button_color="w3-text-white";
echo "<div class=\"w3-dropdown-hover\"> <button class=\"w3-button $button_color\">Storage</button> <div class=\"w3-dropdown-content w3-bar-block w3-card-4\"> ";
foreach($storparams as $param){
$myparam=str_replace("_"," ",$param);
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=$param\" class=\"w3-bar-item w3-button\">$myparam</a>";

}
echo "</div></div>";
}

if($showansys==1){
if(!in_array($storparams[0],$sysparams_user_role))
        $button_color="w3-text-blue";
else
    $button_color="w3-text-white";
echo "<div class=\"w3-dropdown-hover\"> <button class=\"w3-button $button_color\">ANSYS</button> <div class=\"w3-dropdown-content w3-bar-block w3-card-4\"> ";
foreach($storparams as $param){
$myparam=str_replace("_"," ",$param);
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=$param\" class=\"w3-bar-item w3-button\">$myparam</a>";

}

echo "</div></div>";
}

if($showutil==1){
if(!in_array($storparams1[0],$sysparams_user_role))
        $button_color="w3-text-blue";
else
    $button_color="w3-text-white";
echo "<div class=\"w3-dropdown-hover\"> <button class=\"w3-button $button_color\">Utilization</button> <div class=\"w3-dropdown-content w3-bar-block w3-card-4\"> ";
foreach($storparams1 as $param){
$myparam=str_replace("_"," ",$param);
echo "<a href=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=$param\" class=\"w3-bar-item w3-button\">$myparam</a>";

}
echo "</div></div>";
}

echo "</div></div>";
?>