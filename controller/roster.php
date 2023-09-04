<?php
require_once("model/roster_model.php");  
  
class roster_con
{
public $rostermodel;

public function __construct()
{
  $this->rostermodel=new rostermodel();   
}

public function change_crew_members(){
	echo '<html><head><script>
		function confirm_delete(){
			alert("are you sure want to Delete?");		}
		</script></head><body>';	
	
	//echo "hello world";
	
	$crew_data = $this->rostermodel->fetch_crew_details();
	
	//var_dump($crew_data);	
	
	if(isset($_POST["UPDATE"])){		
		$id = $_POST["id"];
		$c_name = $_POST["c_name"];
		$c_mem = $_POST["c_mem"];
		$icno = $_POST["icno"];
		$desig = $_POST["desig"];
		$crew_as_on_date = $_POST["crew_as_on_date"];
		//$crew_date = $_POST["crew_as_on_date"];
		//$date = explode("/",$crew_date);
		//$crew_as_on_date = $date[2].'-'.$date[1].'-'.$date[0];
		$rows = count($id);
		$this->rostermodel->change_crew_members($c_name,$c_mem, $icno, $desig, $crew_as_on_date, $id, $rows);
		$this->rostermodel->duplicate_crew_details_table();
		echo "<script>
		alert('Data base table updated and Backup of Crew Details table is created successfully');
		window.location.replace('http://hpcs/index.php?hpcpage=change_crew_members');
		</script>";
	
	}		
	
	if(isset($_POST["ADD"])){
		$c_name = $_POST["c_name"];
		$c_mem = $_POST["c_mem"];
		$icno = $_POST["icno"];
		$desig = $_POST["desig"];
		$crew_as_on_date = $_POST["crew_as_on_date"];
		//$date = explode("/",$crew_date);
		//$crew_as_on_date = $date[2].'-'.$date[1].'-'.$date[0];
		$this->rostermodel->add_crew_member($c_name,$c_mem, $icno, $desig, $crew_as_on_date);
		echo "<script>
		alert('new Data added');
		window.location.replace('http://hpcs/index.php?hpcpage=change_crew_members');
		</script>";
	}
	
	if(isset($_POST["DELETE"])){
		$id = $_POST["id"];		
		if($id==""){
			echo 'Select any one of the row and click Delete Button!';
		}else{		
		$this->rostermodel->delete_crew_member($id);
		}
		echo "<script>
		alert('Deleted successfully');
		window.location.replace('http://hpcs/index.php?hpcpage=change_crew_members');
		</script>";
	}
		
	echo'<div align="right"><form action = "" method = "GET">
	Click any Option <input type="hidden" name="hpcpage" value="change_crew_members">
	<input type="submit" name="add" value="Add">
	<input type="submit" name="edit" value="Edit">
	<input type="submit" name="delete" value="Delete">
	</form></div>';
	if(isset($_GET["add"])){
		echo '<h3 align = "center">Add new Crew Member</h3>';
	}
	if(isset($_GET["edit"])){
		echo '<h3 align = "center">Update Crew Member</h3>';
	}
	if(isset($_GET["delete"])){
		echo '<h3 align = "center">Delete Crew Member</h3>';
	}
	
	echo '<form method = "POST" action =""><table width=100%>
	<tr>';
	if(!isset($_GET["add"])){
		echo '<td>Sl No</td>';
	}
	
	echo '<td>Crew Name</td>
	<td>Crew Member</td>
	<td>IC No</td>
	<td>Designation</td>
	<td>Crew As on Date</td>';
	if(isset($_GET["delete"])){
	echo '<td>select</td>';	
	}
	echo '</tr>';
	
	if(isset($_GET["add"])){
		$i=1;
	echo '<tr>
		<td><input size="15" type="text" name="c_name" value = "" required></td>
		<td><input size="15" type="text" name="c_mem" value = "" required></td>
		<td><input size="15" type="text" name="icno" value = "" required></td>
		<td><input size="15" type="text" name="desig" value = "" required></td>
		<td><input size="15" type="text" name="crew_as_on_date" value = "" placeholder="YYYY-MM-DD" required></td>		
		</tr>';
		echo '</table><div align="right">
		<input type="submit" name="ADD" value="ADD" style = "background-color:green;border:none;font-weight: bold;padding: 7px 20px;color:white">
		</div></form>';
	}
	
	else if(isset($_GET["edit"])){
		$i=1;
	foreach($crew_data as $data){
		
		echo '<tr>
		<td>'.$i.'<input size="15" type="hidden" name="id[]" value = "'. $data["id"].'"></td>
		<td><input size="15" type="text" name="c_name[]" value = "'. $data["c_name"].'"></td>
		<td><input size="15" type="text" name="c_mem[]" value = "'. $data["c_mem"].'"></td>
		<td><input size="15" type="text" name="icno[]" value = "'. $data["icno"].'"></td>
		<td><input size="15" type="text" name="desig[]" value = "'. $data["desig"].'"></td>
		<td><input size="15" type="text" name="crew_as_on_date[]" value = "'. $data["crew_as_on_date"].'" placeholder="YYYY-MM-DD"></td>		
		</tr>';
		$i++;
	}
	echo '</table><div align="right">
		<input type="submit" name="UPDATE" value="UPDATE" style = "background-color:blue;border:none;font-weight: bold;padding: 7px 20px;color:white">
		</div></form>';
	}
	
	else if(isset($_GET["delete"])){
	
	$i=1;
	foreach($crew_data as $data){
		
		echo '<tr>
		<td>'.$i.'</td>
		<td>'. $data["c_name"].'</td>
		<td>'. $data["c_mem"].'</td>
		<td>'. $data["icno"].'</td>
		<td>'. $data["desig"].'</td>
		<td>'. $data["crew_as_on_date"].'</td>
		<td><input type = "radio" name="id" value="'.$data["id"].'">
		</tr>';
		$i++;
	}
	echo '</table><div align="right">
		<input type="submit" name="DELETE" value="DELETE" onclick = "confirm_delete()"
		style = "background-color:red;border:none;font-weight: bold;padding: 7px 20px;color:white">
		</div></form>';
	}
	else{
	
	$i=1;
	
	
	foreach($crew_data as $data){
		
		echo '<tr>
		<td>'.$i.'</td>
		<td>'. $data["c_name"].'</td>
		<td>'. $data["c_mem"].'</td>
		<td>'. $data["icno"].'</td>
		<td>'. $data["desig"].'</td>
		<td>'. $data["crew_as_on_date"].'</td>
		</tr>';
		$i++;
	}
	echo '</table>';
	}

	
}

public function rosterpattern()
{
	$this->rostermodel->del_crew_pattern();
	
$curdate=date('Y-m-d');
$Apattern=array("III","O","O","II","II","II","II","O","I","I","I","I","O","III","III","III");
$Bpattern=array("O","III","III","III","III","O","O","II","II","II","II","O","I","I","I","I");
$Cpattern=array("I","I","I","I","O","III","III","III","III","O","O","II","II","II","II","O");
$Dpattern=array("II","II","II","O","I","I","I","I","O","III","III","III","III","O","O","II");
$Gpattern=array("O","G","G","G","G","G","O");

$nyears=9;
$syear=2017;

$maxyear=$syear + $nyears;
$s=0;
$g=0;
for($i=$syear;$i<=$maxyear;$i++)
{
for($j=1;$j<=12;$j++)
{
$ndays=cal_days_in_month(CAL_GREGORIAN,$j,$i);

for($k=1;$k<=$ndays;$k++)
{

$apattern.=$Apattern[$s];
$apattern.=",";

$bpattern.=$Bpattern[$s];
$bpattern.=",";

$cpattern.=$Cpattern[$s];
$cpattern.=",";

$dpattern.=$Dpattern[$s];
$dpattern.=",";

$gpattern.=$Gpattern[$g];
$gpattern.=",";

$s=$s+1;
$g=$g+1;

if($s==16){ $s=0;}

if($g==7){ $g=0;}
 } //for k


if($j<10){$m="0".$j; } else { $m=$j;}

$cdate=$i."-".$m."-"."01";
echo $cdate;

$apattern=rtrim($apattern,",");
$cname='A';

$store_A=$this->rostermodel->store_crew_pattern($cname,$cdate,$apattern);
$apattern="";

$bpattern=rtrim($bpattern,",");
$cname='B';

$store_B=$this->rostermodel->store_crew_pattern($cname,$cdate,$bpattern);
$bpattern="";

$cpattern=rtrim($cpattern,",");
$cname='C';

$store_C=$this->rostermodel->store_crew_pattern($cname,$cdate,$cpattern);
$cpattern="";

$dpattern=rtrim($dpattern,",");
$cname='D';

$store_D=$this->rostermodel->store_crew_pattern($cname,$cdate,$dpattern);
$dpattern="";

$gpattern=rtrim($gpattern,",");
$cname='G';

$store_G=$this->rostermodel->store_crew_pattern($cname,$cdate,$gpattern);
$gpattern="";
} //for j

} //for i 
}// function 

public function rosterdisplay()
{
$updateflag=0;
//introduced for previous Rosters Display
$quarter="";
$quarter = [
    1 => 'I',
    2 => 'I',
    3 => 'I',
    4 => 'II',
    5 => 'II',
    6 => 'II',
    7 => 'III',
    8 => 'III',
    9 => 'III',
    10 => 'IV',
    11 => 'IV',
    12 => 'IV',
];
//echo "hello";
if (isset($_POST['fetch']))
 {
$m = $_POST['month'];
$selected_month = $m;
$y = $_POST['year'];
$selected_year=$y;

$htdate=date("d");
//introduced for previous Rosters Display
$selquarter = isset($quarter[$m]) ? $quarter[$m] : 'Invalid Month Selection';
$selquarter=$selquarter."_".$selected_year;
//echo $selquarter;
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}
else {
$m = date("m");
$selected_month = $m;
$m=intval($m);
//echo $m;
$y = date('Y');
$selected_year=$y;
$htdate=date("d");
//introduced for previous Rosters Display
if (array_key_exists($m, $quarter)) {
	
	$selquarter=$quarter[$m];
    $selquarter=$selquarter."_".$selected_year;
}

//echo $selquarter;
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}

$govholidays=$this->rostermodel->govholidays($y,$m);
//var_dump($govholidays);
foreach ($govholidays as $day){
	$fes_day[]=$day['fes_day']-1;
	$festival[$day['fes_day']-1]=$day['name_of_festival'];
}
//print_r($festival);



$LA=$this->rostermodel->get_leave_action_details($m,$y);
//$CD=$this->rostermodel->get_all_crew_details();
//Updated on 05/07/2023 to view previos quarter crew
$CD=$this->rostermodel->get_all_crew_details($selquarter);
$cnt=0;

foreach ($CD as $crew)
{
$cnt++;
$cname[$cnt]=$crew['c_name'];
$icno=$crew['icno'];
$rA[$cnt]=$this->rostermodel->get_crew_pattern($cname[$cnt],$m,$y);
//$cA[$cnt]=$this->rostermodel->get_crew_details($icno);
$cA[$cnt]=$this->rostermodel->get_crew_details($icno,$selquarter);
$LA[$cnt]=$this->rostermodel->get_leave_action_details($icno,$m,$y);
}
$aH=$this->rostermodel->get_crew_pattern('A',$m,$y);
$bH=$this->rostermodel->get_crew_pattern('B',$m,$y);
$cH=$this->rostermodel->get_crew_pattern('C',$m,$y);
$dH=$this->rostermodel->get_crew_pattern('D',$m,$y);
$gH=$this->rostermodel->get_crew_pattern('G',$m,$y);
//print_r($aH);
$today=date("d")-1;
//echo $today;
$cAtoday = explode(',',$aH[c_pattern]);
$cBtoday = explode(',',$bH[c_pattern]); 
$cCtoday = explode(',',$cH[c_pattern]); 
$cDtoday = explode(',',$dH[c_pattern]); 
//print_r($cAtoday);
 $cAtoday= $cAtoday[$today];
 $cBtoday= $cBtoday[$today];
 $cCtoday= $cCtoday[$today];
 $cDtoday= $cDtoday[$today];
if($cAtoday=='I')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('A');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$Ishiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$Ishiftmem.=$mem['c_mem'].",";    }
} // Inside for
$Ishiftmem=rtrim($Ishiftmem,",");
}
if($cAtoday=='II')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('A');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIshiftmem;
$IIshiftmem=rtrim($IIshiftmem,",");
}

if($cAtoday=='III')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('A');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIIshiftmem;
$IIIshiftmem=rtrim($IIIshiftmem,",");
}

if($cBtoday=='I')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('B');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$Ishiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$Ishiftmem.=$mem['c_mem'].",";    }
} // Inside for
$Ishiftmem=rtrim($Ishiftmem,",");
}
if($cBtoday=='II')
{
$IIshift="CA";
$amem=$this->rostermodel->get_crew_members('B');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIshiftmem;
$IIshiftmem=rtrim($IIshiftmem,",");
}

if($cBtoday=='III')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('B');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIIshiftmem;
$IIIshiftmem=rtrim($IIIshiftmem,",");
}

if($cCtoday=='I')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('C');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$Ishiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$Ishiftmem.=$mem['c_mem'].",";    }
} // Inside for
$Ishiftmem=rtrim($Ishiftmem,",");
}
if($cCtoday=='II')
{
$IIshift="CA";
$amem=$this->rostermodel->get_crew_members('C');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIshiftmem;
$IIshiftmem=rtrim($IIshiftmem,",");
}

if($cCtoday=='III')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('C');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIIshiftmem;
$IIIshiftmem=rtrim($IIIshiftmem,",");
}

if($cDtoday=='I')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('D');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$Ishiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$Ishiftmem.=$mem['c_mem'].",";    }
} // Inside for
$Ishiftmem=rtrim($Ishiftmem,",");
}
if($cDtoday=='II')
{
$IIshift="CA";
$amem=$this->rostermodel->get_crew_members('D');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIshiftmem;
$IIshiftmem=rtrim($IIshiftmem,",");
}

if($cDtoday=='III')
{
$Ishift="CA";
$amem=$this->rostermodel->get_crew_members('D');
foreach ($amem as $mem)
{
$amemLA=$this->rostermodel->get_today_leave_action($mem['icno'],$m,$y,date("d"));
if( $amemLA[type]!="")
{
$IIIshiftmem.=$mem['c_mem']." - ".$amemLA[type].",";
}
else {$IIIshiftmem.=$mem['c_mem'].",";    }
} // Inside for
//echo $IIIshiftmem;
$IIIshiftmem=rtrim($IIIshiftmem,",");
}

include "view/rosterdisplay.php";
} //function

public function rosterupdate()
{
$updateflag=1;

$quarter="";
$quarter = [
    1 => 'I',
    2 => 'I',
    3 => 'I',
    4 => 'II',
    5 => 'II',
    6 => 'II',
    7 => 'III',
    8 => 'III',
    9 => 'III',
    10 => 'IV',
    11 => 'IV',
    12 => 'IV',
];

if (isset($_POST['update']))
    {
		
	$userfullname=$_SESSION['HPCSESSION']->getUserFullName();
					//echo $userfullname;
					//exit;
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if($_POST["change_with_leave"] == "F" || $_POST["change_with_leave"] == "S"){
	$data[type] = test_input($_POST["type"])."/".$_POST["change_with_leave"];
}else{
	$data[type] = test_input($_POST["type"]);
}


/*
$arr=explode("_",$type);
$type=$arr[1];
$typeofreq=$arr[0];
*/
$data[icno] = test_input($_POST["icno"]);
//$name=$this->rostermodel->get_crew_details($data[icno]);
$name=$this->rostermodel->get_crew_details($data[icno],$selquarter);
$data[name]=$name['c_mem'];
$data[doner_icno] = test_input($_POST["change_with"]);
//$donerName=$this->rostermodel->get_crew_details($data[doner_icno]);
$donerName=$this->rostermodel->get_crew_details($data[doner_icno],$selquarter);
$data[doner_name] = $donerName['c_mem'];
$data[over_time_start] = test_input($_POST["over_time_start_hour"]).":".test_input($_POST["over_time_start_min"]);
$data[over_time_end] = test_input($_POST["over_time_end_hour"]).":".test_input($_POST["over_time_end_min"]);
$data[section_of] = test_input($_POST["section_of"]);
$data[work_description] = test_input($_POST["work_description"]);
$data[work_alloted_by] = test_input($_POST["work_alloted_by"]);
$data[typeofreq] = test_input($_POST["typeofreq"]);
/*
$data[type] = $type;
$data[typeofreq] = $typeofreq;
*/
//$data[actionby]="Shift-In-Charge";
$data[actionby]=$userfullname;
$data[remarks] = test_input($_POST["remarks"]);
$fromdate = test_input($_POST["fdate"]);
$todate = test_input($_POST["tdate"]);
$reqdate = test_input($_POST["rdate"]);
$date=date_create("$fromdate");     //create date from string
$data[fromdate1]=date_format($date,"Y-m-d");     //format date in year of the day
$date=date_create("$todate");
$data[todate1]=date_format($date,"Y-m-d");
$date=date_create("$reqdate");
$data[reqdate1]=date_format($date,"Y-m-d");

if(($data[type]!="rub") && ($data[icno]!=""))
{
	
$rosterupdate=$this->rostermodel->store_leave_action_details($data);
//added on 04/01/2023
if($data[typeofreq] == 'C'){
$rosterupdate1=$this->rostermodel->store_leave_action_details_change_with($data);
}
if ($rosterupdate !="") { echo "<script> alert ('Roster is updated successfully');</script>";} 
}

elseif(($data[type]=="rub") && ($data[icno]!=""))
{ 
$rubroster=$this->rostermodel->rub_leave_action_details($data);
if ($rubroster !="") { echo "<script> alert ('Roster is updated successfully');</script>";}
}
else {echo "<script> alert ('please Select the crew member / action');</script>"; }
}

//elseif (isset($_POST['fetch']))
if (isset($_POST['fetch']))
 {
$m = $_POST['month'];
$y = $_POST['year'];
$htdate=date("d");

$selquarter = isset($quarter[$m]) ? $quarter[$m] : 'Invalid Month Selection';
$selquarter=$selquarter."_".$y;
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}
else {
$m = date("m");
$m=intval($m);
$y = date('Y');
$htdate=date("d");
if (array_key_exists($m, $quarter)) {
	
	$selquarter=$quarter[$m];
    $selquarter=$selquarter."_".$y;
}
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}

$updateflag=1;
$LA=$this->rostermodel->get_leave_action_details($m,$y);
//$CD=$this->rostermodel->get_all_crew_details();
//echo $selquarter;
$CD=$this->rostermodel->get_all_crew_details($selquarter);
$CD_STAFF=$this->rostermodel->get_cd_staff();
$cnt=0;

foreach ($CD as $crew)
{

$cnt++;
$cname[$cnt]=$crew['c_name'];
$icno=$crew['icno'];
$rA[$cnt]=$this->rostermodel->get_crew_pattern($cname[$cnt],$m,$y);
//$cA[$cnt]=$this->rostermodel->get_crew_details($icno);
$cA[$cnt]=$this->rostermodel->get_crew_details($icno,$selquarter);
$LA[$cnt]=$this->rostermodel->get_leave_action_details($icno,$m,$y);

}
$aH=$this->rostermodel->get_crew_pattern('A',$m,$y);
$bH=$this->rostermodel->get_crew_pattern('B',$m,$y);
$cH=$this->rostermodel->get_crew_pattern('C',$m,$y);
$dH=$this->rostermodel->get_crew_pattern('D',$m,$y);
$gH=$this->rostermodel->get_crew_pattern('G',$m,$y);
include "view/rosterdisplay.php";
} //function

public function view_update_crew_members()
{
	if (isset($_POST['cupdate']))
    {
	
	$crew = $_POST['crew'];
	
$member = $_POST['member'];
//$member = implode(",",$member);
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

$cnt=count($member);


$Amembers=$Bmembers=$Cmembers=$Dmembers=$Gmembers="";
for($i=0;$i<=$cnt;$i++)
{
	if($crew[$i]=='A')
		
		{
			$Amembers=$Amembers.",".$member[$i];
		}
	if($crew[$i]=='B')
		
		{
			$Bmembers=$Bmembers.",".$member[$i];
		}
	if($crew[$i]=='C')
		
		{
			$Cmembers=$Cmembers.",".$member[$i];
		}
	if($crew[$i]=='D')
		
		{
			$Dmembers=$Dmembers.",".$member[$i];
		}
		
	if($crew[$i]=='G')
		
		{
			$Gmembers=$Gmembers.",".$member[$i];
		}
}
$Amembers=ltrim($Amembers, ',');
$Bmembers=ltrim($Bmembers, ',');
$Cmembers=ltrim($Cmembers, ',');
$Dmembers=ltrim($Dmembers, ',');
$Gmembers=ltrim($Gmembers, ',');

echo $fdate;
$datestr=explode('/',$fdate);
$fmonth= $datestr[0];
$fyear= $datestr[1];

$datestr=explode('/',$tdate);
$tmonth= $datestr[0];
$tyear= $datestr[1];



$fdate = $fyear."-".$fmonth."-01";
$tdate = $tyear."-".$tmonth."-01";

echo $fdate;
//echo $tdate." ".$fdate." ".print_r($crew)." ".print_r($member);
//$store=$this->rostermodel->update_crew_members($fdate,$tdate,$crew,$member);	
	
	}
	//$r1=$this->rostermodel->get_all_crew_details();
	$r1=$this->rostermodel->get_all_crew_details($selquarter);
	//print_r($CD);
	include "view/view_update_crew_members.php";
}


public function crewupdate()
{
$updateflag=1;

if (isset($_POST['update']))
    {
    //echo "coming inside";
function test_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$type = test_input($_POST["type"]);
$arr=explode("_",$type);
$type=$arr[1];
$typeofreq=$arr[0];
$data[icno] = test_input($_POST["icno"]);
$data[type] = $type;
$data[typeofreq] = $typeofreq;
$data[actionby]="Shift-In-Charge";
  $data[remarks] = test_input($_POST["remarks"]);
  $fromdate = test_input($_POST["fdate"]);
  $todate = test_input($_POST["tdate"]);
  $reqdate = test_input($_POST["rdate"]);
$date=date_create("$fromdate");     //create date from string
$data[fromdate1]=date_format($date,"Y-m-d");     //format date in year of the day
$date=date_create("$todate");
$data[todate1]=date_format($date,"Y-m-d");
$date=date_create("$reqdate");
$data[reqdate1]=date_format($date,"Y-m-d");

if(($data[typeofreq]!="rub") && ($data[icno]!=""))
{
$rosterupdate=$this->rostermodel->store_leave_action_details($data);
if ($rosterupdate !="") { echo "<script> alert ('Roster is updated successfully');</script>";} 
}

elseif(($data[typeofreq]=="rub") && ($data[icno]!=""))
{ 
$rubroster=$this->rostermodel->rub_leave_action_details($data);
if ($rubroster !="") { echo "<script> alert ('Roster is updated successfully');</script>";}
}
else {echo "<script> alert ('please Select the crew member / action');</script>"; }
}
//elseif (isset($_POST['fetch']))
if (isset($_POST['fetch']))
 {
$m = $_POST['month'];
$y = $_POST['year'];
$htdate=date("d");
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}
else {
$m = date("m");
$y = date('Y');
$htdate=date("d");
$days=cal_days_in_month(CAL_GREGORIAN,$m,$y);
}

$updateflag=1;
$LA=$this->rostermodel->get_leave_action_details($m,$y);
//$CD=$this->rostermodel->get_all_crew_details();
$CD=$this->rostermodel->get_all_crew_details($selquarter);
$cnt=0;

foreach ($CD as $crew)
{

$cnt++;
$cname[$cnt]=$crew['c_name'];
$icno=$crew['icno'];
$rA[$cnt]=$this->rostermodel->get_crew_pattern($cname[$cnt],$m,$y);
//$cA[$cnt]=$this->rostermodel->get_crew_details($icno);
$cA[$cnt]=$this->rostermodel->get_crew_details($icno,$selquarter);
$LA[$cnt]=$this->rostermodel->get_leave_action_details($icno,$m,$y);

}
$aH=$this->rostermodel->get_crew_pattern('A',$m,$y);
$bH=$this->rostermodel->get_crew_pattern('B',$m,$y);
$cH=$this->rostermodel->get_crew_pattern('C',$m,$y);
$dH=$this->rostermodel->get_crew_pattern('D',$m,$y);
$gH=$this->rostermodel->get_crew_pattern('G',$m,$y);
include "view/rosterdisplay.php";
} //function


public function leavereport()
{
	$r1=$this->rostermodel->get_leave_report();
	include "view/leave_report.php";
}
public function actionreport()
{
	$r1=$this->rostermodel->get_action_report();
	include "view/action_report.php";
}

//included on 02/01/2023
public function change_report()
{
	if(isset($_POST["icno"]) and $_POST["icno"] != ""){
		$icno = $_POST["icno"];
		$month = $_POST["month"];
		$year = $_POST["year"];
		$shift_change=$this->rostermodel->shift_changes($icno,$month,$year);
		//var_dump($shift_change);
		$name=$this->rostermodel->get_crew_details($icno);
		//$name=$this->rostermodel->get_crew_details($icno,$selquarter);
		//echo $name['c_mem'];
		
	}else{
		$icno ="";
	}
	//$CD=$this->rostermodel->get_all_crew_details();	
	$CD=$this->rostermodel->get_all_crew_details($selquarter);
	include "view/change_report.php";
	
}

//included on 02/01/2023
public function over_time_report()
{
	if(isset($_POST["icno"]) and $_POST["icno"] != ""){
		$icno = $_POST["icno"];
		$overTime=$this->rostermodel->over_time($icno);
		//var_dump($overTime);
		$name=$this->rostermodel->get_crew_details($icno);
		//$name=$this->rostermodel->get_crew_details($icno$selquarter);
		//echo $name['c_mem'];
		
	}else{
		$icno ="";
	}
	//$CD=$this->rostermodel->get_all_crew_details();	
	$CD=$this->rostermodel->get_all_crew_details($selquarter);	
	include "view/over_time_report.php";
	
}








//new update on 28/06/2021
public function update_crew_members(){
	
	echo "coming";
	
/*if (isset($_POST['update_crew_members'])) {
echo "updating is in process";
*/
if ($_POST['fyear'] !="" and $_POST['fmonth'] !="" ){
$fdate = $_POST['fyear']."-".$_POST['fmonth']."-01";	
}else{	
$fdate = NULL;
}
if ($_POST['tyear'] !="" and $_POST['tmonth'] !="" ){
$tdate = $_POST['tyear']."-".$_POST['tmonth']."-01";	
}else{	
$tdate = NULL;
}

$crew = $_POST['crew'];
$member = $_POST['member'];
$member = implode(",",$member);

echo $tdate." ".$fdate." ".$crew." ".$member;
$store=$this->rostermodel->update_crew_members($fdate,$tdate,$crew,$member);	

//}
	//$CD=$this->rostermodel->get_all_crew_details();
	$CD=$this->rostermodel->get_all_crew_details($selquarter);
	include "view/update_crew_members.php";  


		
	
//new update on 28/06/2021
if (isset($_POST['view_crew_members'])) {	
	//echo "view";	
	
if ($_POST['fyear'] !="" and $_POST['fmonth'] !="" ){
$y = $_POST['fyear'];
$m = $_POST['fmonth'];	
}else{	
$fdate = NULL;
}
$cname = $_POST['crew'];
//echo $m."-".$y."-".$cname;
//get crew members icno string form shift patten data base table
//$CD=$this->rostermodel->get_all_crew_details();
$CD=$this->rostermodel->get_all_crew_details($selquarter);
$cpatten = $this->rostermodel->get_crew_pattern($cname,$m,$y);
//member_count;
//$m_count = count($cmembers);
include "view/view_crew_members.php";	
}

if (isset($_POST['submit']) == "submit"){
	$fdate = $_POST['fyear']."-".$_POST['fmonth']."-01";
	$crew = $_POST['crew'];
	$member = $_POST['member'];
	$member = implode(",",$member);
	//echo $fdate."-".$crew."-".$member;
	$alter = $this->rostermodel->alter_crew_members($fdate,$crew,$member);
}
	
}

















} //class
