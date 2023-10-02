<?php
include "view/displaysystembanner_new.php";
$timeofmon=strtotime($nodesummary[8]);
$mytime=date("d M Y H:i:s",$timeofmon);
echo "<h5 align='center'>$systemname Cluster Status Summary </h5>";
echo "<table class=\"systemdetails\" align='center'>";
echo "<tr><td colspan='8' align='center'><b>Monitored at $mytime</b></td></tr>";
$usepercent=($nodesummary[2]/$nodesummary[4]) *100;
$usepercent=round($usepercent,2);
echo "<tr><th>Cluster Usage % (Cores Allocated/ Total Cores): </th><td>$usepercent % &nbsp;&nbsp;</td></tr><tr> <th>Total Number of Jobs: </th><td>$jobnumber[0]</td></tr><tr><th>Running Jobs: </th><td>$jobnumber[1]</td></tr><tr><th>Logged In Users: </th><td>$userno</td></tr></table><br/>";

echo "<h5 align='center'>Node Utilization Summary</h5>";
echo "<table class=\"systemdetails\" align='center' >";
echo "<tr><th>Nodes Allocated</th><td>$nodesummary[1]&nbsp;</td>";
echo "<th>Nodes Idle</th><td>$nodesummary[0]&nbsp;</td>";
echo "<th>Nodes Down</th><td>$nodesummary[5]&nbsp;</td>";
echo "<th>Nodes Total</th><td>$nodesummary[6]&nbsp;</td></tr>";
echo "<tr><th>Cores Allocated</th><td>$nodesummary[2]&nbsp;</td>";
echo "<th>Cores Idle</th><td>$nodesummary[3]&nbsp;</td>";
echo "<th>Cores Down</th><td>$nodesummary[7]&nbsp;</td>";

echo "<th>Cores Total</th><td>$nodesummary[4]&nbsp;</td></tr></table><br/>";

echo "<h5 align='center'> Storage Utilization Summary</h5>";

echo "<table class=\"systemdetails\"   align='center' width='60%' >";
echo "<tr><td>Mount Point</td><td>Total</td><td>Used</td><td>Available</td><td>Used Percentage</td></tr>";
foreach($storagesummary as $store){
	echo "<tr><td>$store[5]</td><td>$store[1]</td><td>$store[2]</td><td>$store[3]</td><td>$store[4]</td></tr>";
}
echo "</table><br/><br/>";
?>
