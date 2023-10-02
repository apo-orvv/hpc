<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>

<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>
<?php
echo "<form id='form1' method='post' action=\"index.php?hpcpage=update_crew_members\">";
echo"<>";
echo "<table class='querytable' align='center'  cellspacing='0' border=1><tr><td>GWS Name</td><td>$mystr</td><td>Select a time interval</td><td>From</td><td><input id='datepicker' name='fromdate'></td><td>To</td><td><input id='datepicker1' name='todate'></td></tr><tr><td colspan='7' align='center'> <input type='submit' name='showgwsusage' value='Submit'></td></tr></table>";
echo "</form><br/>";







<h3>Update/View or Change crew members<h3>
<form name = "form1" method = "post" action="index.php?hpcpage=update_crew_members">	
	
<?php
$x=0;
if (isset($_POST["myform"]) == "Add"){
	$x=$_POST["x"]+1;
}
if(isset($_POST["myform1"]) == "Remove"){
	$x=$_POST["x"]-1;
}



echo '<table><tr><th>From</th></th><th>
<select name="fmonth" size="1" style="cursor: pointer" required>
	<option value = "" >None</option>
    <option value="01"  >Jan</option>
    <option value="02"  >Feb</option>
    <option value="03"  >Mar</option>
	<option value="04"  >Apr</option>
	<option value="05"  >May</option>
	<option value="06"  >Jun</option>
	<option value="07"  >Jul</option>
	<option value="08"  >Aug</option>
	<option value="09"  >Sep</option>
	<option value="10"  >Oct</option>
	<option value="11"  >Nov</option>
	<option value="12"  >Dec</option>
    </select><select name="fyear" size="1" style="cursor: pointer" required>
	<option value = "" >None</option>
    <option value="2017"  >2017</option>
	<option value="2018"  >2018</option>
    <option value="2019"  >2019</option>
    <option value="2020"  >2020</option>
	<option value="2021"  >2021</option>
	<option value="2022"  >2022</option>
	<option value="2023"  >2023</option>
	<option value="2024"  >2024</option>
	<option value="2025"  >2025</option>
	<option value="2026"  >2026</option>
     </select></th></tr>

<tr><th>TO</th><th>
<select name="tmonth" size="1" style="cursor: pointer" required>
	<option value = "" >None</option>
    <option value="01"  >Jan</option>
    <option value="02"  >Feb</option>
    <option value="03"  >Mar</option>
	<option value="04"  >Apr</option>
	<option value="05"  >May</option>
	<option value="06"  >Jun</option>
	<option value="07"  >Jul</option>
	<option value="08"  >Aug</option>
	<option value="09"  >Sep</option>
	<option value="10"  >Oct</option>
	<option value="11"  >Nov</option>
	<option value="12"  >Dec</option>
    </select>
	<select name="tyear" size="1" style="cursor: pointer" required>
	<option value = "" >None</option>
    <option value="2017"  >2017</option>
	<option value="2018"  >2018</option>
    <option value="2019"  >2019</option>
    <option value="2020"  >2020</option>
	<option value="2021"  >2021</option>
	<option value="2022"  >2022</option>
	<option value="2023"  >2023</option>
	<option value="2024"  >2024</option>
	<option value="2025"  >2025</option>
	<option value="2026"  >2026</option>
     </select>
	 </th></tr><tr><th>Crew</th><th>	 
<select name="crew" required>
<option value = "" >None</option>
<option value = "A" > A</option>
<option value = "B" > B</option>
<option value = "C" > C</option>
<option value = "D" > D</option>
<option value = "G" > G</option>
</select></th></tr>';

//<tr><th>Crew member1</th><th>

for ($i=0;$i<$x;$i++ ){
		$nos=$i+1;
		echo '<tr><th>Crew member - '.$nos.'</th><th><select name="member[]" size="1" style="cursor: pointer" required>
		<option value = "" >None</option>';
		foreach ($CD as $crew){
		echo '<option value="'.$crew["icno"].'"  >'.$crew["c_mem"].'</option>';
		}
		echo '</select></th></tr>';
		}
	


echo '</table><table><tr><td><input type="submit" name="update_crew_members" value="update_crew_members">
		</form><form method = "post" action="index.php?hpcpage=update_crew_members">';	
	
	echo "<input type='hidden' name='x' value='$x'><input type='hidden' name='update' value='update'>";
		echo "</td><td><input type='submit' name='myform' value='Add'></td><td>
		<input type='submit' name='myform1' value='Remove'></form></td></tr></table></form>";


?>










