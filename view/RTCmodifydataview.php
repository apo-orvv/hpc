<?php
//echo "<br>";

$time= $_GET['time'];
//echo "<br>";
//echo $sql[0][0];
//echo "<br>";
//echo $sql[0][3];
if (empty($sql)){
 $data=array('','','','','','','','','','','','','','','','','','','','','','','','');
}else {
    $data=explode(", ",$sql[0][3]);
}
?>


<html>
<head>
<style>

.center
{
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 350px;
  height: 850px;
  
}


div.a {
    width: auto; 
}

div.clear {
    clear: both;
}

h3 {
    text-align: center;
    color: blue;
    letter-spacing: 2px;
    line-height: 0.05;
    word-spacing: 5px;
    font-family: "Times New Roman", Times, serif;
}
a {
    text-decoration: none;
}

table {
    border-collapse: collapse;
    border: 1px solid  black;


} 
th,td {
    border: 1px solid  black;
	width:80px;
	height:22px;
	text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size:13px
}

td:hover {background-color:#f5f5f5;}



input[type=number] {
  width: 60px;
  height:17px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
input[type=number]:focus {
  width: 70px;
}



select {
  width: 60px;
  height:17px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
select:focus {
  width: 70px;
}

/* For Firefox to remove arrow in input number*/
input[type='number'] {
    -moz-appearance:textfield;
}

/* Webkit browsers like Safari and Chrome to remove arrow in input number*/
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
</style>
</head>
<body>
<h3> Modify Log data </h3>

<?php include "view/RTCdisplaybanner.php"; ?>

<table style="float:left;font-size:13px" border="1" bgcolor="#B0E0E6">
<tr><td colspan="2">Name of The Data</td>
<tr> <td rowspan="2" style="width:80px;" >IVY Cluster</td> <td><a href="tempchart1/ivy_temp_chart.php" target="_blank"> Temp</a></td> </tr>
<tr><td><a href="tempchart1/ivy_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-1</td><td><a href="tempchart1/custer_ac_unit_1_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/custer_ac_unit_1_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-2</td><td><a href="tempchart1/custer_ac_unit_2_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/custer_ac_unit_2_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-3</td><td><a href="tempchart1/custer_ac_unit_3_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/custer_ac_unit_3_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-4</td><td><a href="tempchart1/custer_ac_unit_4_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/custer_ac_unit_4_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">VDI AC unit-1</td><td><a href="tempchart1/vdi_ac_unit_1_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/vdi_ac_unit_1_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">VDI AC unit-2</td><td><a href="tempchart1/vdi_ac_unit_2_temp_chart.php" target="_blank">Temp</a></td> </tr>
<tr><td><a href="tempchart1/vdi_ac_unit_2_hum_chart.php" target="_blank">Hum</a></td></tr>

<tr><td>HPC Room</td><td><a href="tempchart1/hpc_room_temp_chart.php" target="_blank">Temp</a></td></tr>
<tr><td>I/O Room</td><td><a href="tempchart1/io_room_temp_chart.php" target="_blank">Temp</a></td></tr>
<tr><td>Anunet Room</td><td><a href="tempchart1/anunet_room_temp_chart.php" target="_blank">Temp</a></td></tr>
<tr> <td colspan="2">HPC status</td></tr>
<tr> <td colspan="2">Workstation status</td></tr>
<tr> <td colspan="2">E-mail server status</td></tr>
<tr> <td colspan="2">Inter/intra status</td></tr>
<tr> <td colspan="2">UPS status</td></tr>
<tr> <td colspan="2">Switch status</td></tr>
</table>


<form method="POST" action="">

<?php

	
echo '<table border="1" style="float: left;"><tr><td><input type="radio" name="time" value="'.$time.'" checked>';
if ($time<19){echo $time+5;echo ":00hrs";}else{echo $time-19;echo ":00hrs";}
echo '</td><tr>';

for ($x=0; $x<=22; $x++){
echo '<tr>';

	if($time<=8){	
	echo '<td style="background-color:#FFD700;">';
	}
	elseif($time>=9 && $time<=16){	
	echo '<td style="background-color:#FFB6C1;">';
	}
	elseif($time>=17){	
	echo '<td style="background-color:#87CEFA;">';
	}

if($x<17){
echo '<input type = "number" step="0.1" min="10" max="80" name = "col[]" value="'.$data[$x].'" ></td></tr>';
}

elseif($x>16){	
echo '<select name= "col[]">    
      <option value="10003" selected>&#10003;</option><option value="10007">&#10007;</option></select></td></tr>';
}
}
echo '</table>';

?>
<div class="clear"></div>
<button class="button" value="submit" name="submit">Submit</button>
</form>

</body>
</html>
