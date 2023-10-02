<?php
$x=0;
if (isset($_POST["myform"]) == "Add"){
	$x=$_POST["x"]+1;
}
if(isset($_POST["myform1"]) == "Remove"){
	$x=$_POST["x"]-1;
}


if (is_null($cpatten['c_members'])){
	echo "Crew member list is empty! Please add some members";
	echo "<h3>Crew - ".$cpatten['c_name']." Members for ".$m."/".$y."</h3><table>";
	echo '<form method = "post" action="index.php?hpcpage=update_crew_members">';
	
	for ($i=0;$i<$x;$i++ ){
		echo '<tr><td><select name="member[]" size="1" style="cursor: pointer" required>
		<option value = "" >None</option>';
		foreach ($CD as $crew){
		echo '<option value="'.$crew["icno"].'"  >'.$crew["c_mem"].'</option>';
		}
		echo '</select></td></tr>';
	}
	echo"</table><input type='hidden' name='x' value='$x'>";
		//<input type='submit' name='myform' value='add'>
	echo '<input type = "hidden" name="fmonth" value = "'.$m.'">
		<input type = "hidden" name="fyear" value = "'.$y.'">
		<input type = "hidden" name="crew" value = "'.$cname.'">';
	echo "<table><tr><td><input type='submit' name='submit' value='submit'></form>";
	
	echo '<form method = "post" action="index.php?hpcpage=update_crew_members">';
	echo "<input type='hidden' name='x' value='$x'>";
	echo '<input type="hidden" name="view_crew_members" value="view_crew_members">
		<input type = "hidden" name="fmonth" value = "'.$m.'">
		<input type = "hidden" name="fyear" value = "'.$y.'">
		<input type = "hidden" name="crew" value = "'.$cname.'">';
		echo "</td><td><input type='submit' name='myform' value='Add'></td><td>
		<input type='submit' name='myform1' value='Remove'></form></td></tr></table></form>";
	
	
}else{
	$cmembers = explode("," , $cpatten['c_members']);
	echo "<h3>Crew - ".$cpatten['c_name']." Members for ".$m."/".$y."</h3><table>";
	echo '<form method = "post" action="index.php?hpcpage=update_crew_members">';
	foreach ($cmembers as $icno){
		$cmem=$this->rostermodel->get_crew_details($icno);
		
		//echo $cmem['c_mem']." - ".$icno. "<br>";
				
		echo '<tr><td><select name="member[]" size="1" style="cursor: pointer" required>
		<option value = "" >None</option>';
		foreach ($CD as $crew){
			
			if($crew["icno"] == $icno){
				echo '<option value="'.$crew["icno"].'"  selected>'.$crew["c_mem"].'</option>';
			}else{
				echo '<option value="'.$crew["icno"].'"  >'.$crew["c_mem"].'</option>';
			}
		}
	
echo '</select></td></tr>';	
		
	}
	
	for ($i=0;$i<$x;$i++ ){
		echo '<tr><td><select name="member[]" size="1" style="cursor: pointer" required>
		<option value = "" >None</option>';
		foreach ($CD as $crew){
		echo '<option value="'.$crew["icno"].'"  >'.$crew["c_mem"].'</option>';
		}
		echo '</select></td></tr>';
	}
		
	echo"</table>";
	echo '<input type = "hidden" name="fmonth" value = "'.$m.'">
		<input type = "hidden" name="fyear" value = "'.$y.'">
		<input type = "hidden" name="crew" value = "'.$cname.'">';
	echo "<table><tr><td><input type='submit' name='submit' value='submit'></form>";
	
	echo '<form method = "post" action="index.php?hpcpage=update_crew_members">';
	echo "<input type='hidden' name='x' value='$x'>";
	echo '<input type="hidden" name="view_crew_members" value="view_crew_members">
		<input type = "hidden" name="fmonth" value = "'.$m.'">
		<input type = "hidden" name="fyear" value = "'.$y.'">
		<input type = "hidden" name="crew" value = "'.$cname.'">';
		echo "</td><td><input type='submit' name='myform' value='Add'></td><td>
		<input type='submit' name='myform1' value='Remove'></form></td></tr></table></form>";
		
}


?>
