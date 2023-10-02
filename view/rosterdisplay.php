<?php
//:wecho "welcom View" .$Ishiftmem;
function display_heading($pat,$days,$fes_day,$festival, $fes)
{
//print_r($pat);
$p_pattern=explode(',',$pat);
for ($i=0; $i<$days; $i++)
	{
if($p_pattern[$i]=="II"){ echo ' <td class="rostertable" style="background-color:#FFB6C1">'  .$p_pattern[$i]. '</td> ';} 

if($p_pattern[$i]=="III"){ echo ' <td class="rostertable" style="background-color:#87CEFA">'  .$p_pattern[$i]. '</td> ';}

 if($p_pattern[$i]=="I"){ echo ' <td  class="rostertable" style="background-color:#FFD700">'  .$p_pattern[$i]. '</td> ';}

//if($p_pattern[$i]=="O"){ echo ' <td class="rostertable" style="background-color:#F5F5F5">'  .$p_pattern[$i]. '</td> ';}

if($p_pattern[$i]=="O"){ 

if (in_array($i,$fes_day) && $fes==1 ){
	echo ' <td class="rostertable" style="background-color:#90EE90" title ="'.$festival[$i].'">GH</td> ';
	
}else{
	echo ' <td class="rostertable" style="background-color:#F5F5F5">'  .$p_pattern[$i]. '</td> ';
}

}




//if($p_pattern[$i]=="G"){ echo ' <td class="rostertable" style="background-color:#DEB887">'  .$p_pattern[$i]. '</td> ';}
//govenment holidays for general shift people
if($p_pattern[$i]=="G"){ 

if (in_array($i,$fes_day)){
	echo ' <td class="rostertable" style="background-color:#90EE90" title ="'.$festival[$i].'">GH</td> ';
}else{
	echo ' <td class="rostertable" style="background-color:#DEB887">'  .$p_pattern[$i]. '</td> ';
}

}



}
 echo'</tr>';
}

function display_roster($cpat,$cmem,$days,$LA,$dm, $fes_day,$festival,$fes)
{
foreach($LA as $leave)
{
$day=date("d");
$cmon=date("m");
//echo "today". $day;
$from_date=date(d,strtotime($leave['from_date']));
$to_date=date(d,strtotime($leave['to_date']));

$from_month=date(m,strtotime($leave['from_date']));
$to_month=date(m,strtotime($leave['to_date']));

$from_date=ltrim($from_date,0);
$to_date=ltrim($to_date,0);
$no_of_days=date(d,strtotime($leave['to_date']))-date(d,strtotime($leave['from_date']));

if($from_month==$to_month)
{
for($i=$from_date;$i<=$to_date;$i++)
{
$la_pat[$i]=$leave['type'];

if($la_pat[$i]=="X"||$la_pat[$i]=="X/L"){
	$leave_marked_by[$i]="Over Time From ".$leave['over_time_start']."Hrs To ".$leave['over_time_end']."Hrs | Alloted By ".$leave['work_alloted_by']." | For The Work --".$leave['section_of']." | Marked by ".$leave['actionby'];
}else{
	if($leave['typeofreq'] == "C"){
		$leave_marked_by[$i]="Change Taken From ".$leave['change_with']." | Marked by ".$leave['actionby'];	
	}else{
	$leave_marked_by[$i]="Marked by ".$leave['actionby'];	
	}
	}
//$leave_marked_by[$i]=$leave['actionby'];
}
}
else 
{
if(($dm==$from_month) && ($from_month <=$to_month))
{
for($i=$from_date;$i<=$days;$i++)
{
$la_pat[$i]=$leave['type'];
if($la_pat[$i]=="X"||$la_pat[$i]=="X/L"){
	$leave_marked_by[$i]="Over Time From ".$leave['over_time_start']."Hrs To ".$leave['over_time_end']."Hrs Alloted By ".$leave['work_alloted_by']." For The Work --".$leave['section_of']."-- Marked by ".$leave['actionby'];
}else{
	$leave_marked_by[$i]="Marked by ".$leave['actionby'];	
}
//$leave_marked_by[$i]=$leave['actionby'];
}
}
if(($dm==$to_month) && ($from_month <=$to_month))
{

for($i=1;$i<=$to_date;$i++)
{
$la_pat[$i]=$leave['type'];
if($la_pat[$i]=="X"||$la_pat[$i]=="X/L"){
	$leave_marked_by[$i]="Over Time From ".$leave['over_time_start']."Hrs To ".$leave['over_time_end']."Hrs Alloted By ".$leave['work_alloted_by']." For The Work --".$leave['section_of']."-- Marked by ".$leave['actionby'];
}else{
	$leave_marked_by[$i]="Marked by ".$leave['actionby'];	
}
//$leave_marked_by[$i]=$leave['actionby'];
}
}
if(($dm!=$from_month) && ($dm!=$to_month))
{

//echo "coming inside";
for($i=1;$i<=$days;$i++)
{
$la_pat[$i]=$leave['type'];
if($la_pat[$i]=="X"||$la_pat[$i]=="X/L"){
	$leave_marked_by[$i]="Over Time From ".$leave['over_time_start']."Hrs To ".$leave['over_time_end']."Hrs Alloted By ".$leave['work_alloted_by']." For The Work --".$leave['section_of']."-- Marked by ".$leave['actionby'];
}else{
	$leave_marked_by[$i]="Marked by ".$leave['actionby'];	
}
//$leave_marked_by[$i]=$leave['actionby'];
}
}
}
}

$p_pattern=explode(',',$cpat);
echo'<td class="rostertable" style="background-color:#008080;color:white">'. $cmem['c_mem'].'</td>';
echo'<td class="rostertable" style="background-color:#008080;color:white">'. $cmem['icno'].'</td>';
for ($i=0; $i<$days; $i++) 
{
if($la_pat[$i+1]==null){
$p_pattern[$i]=$p_pattern[$i];
}
else { $p_pattern[$i]=$la_pat[$i+1];// echo " ********* pattern with leave" .$p_pattern[$i]; 
		$p_leave_marked_by[$i] = $leave_marked_by[$i+1];
}

//echo " ********* pattern with leave---------------" .$p_pattern[$i]; 
if($p_pattern[$i]=="II") { echo '<td class="rostertable" style="background-color:#FFB6C1"></td>'; }
if($p_pattern[$i]=="III"){ echo '<td class="rostertable" style="background-color:#87CEFA"></td> ';} 
if($p_pattern[$i]=="I"){ echo ' <td class="rostertable" style="background-color:#FFD700"></td> ';}
//if($p_pattern[$i]=="O"){ echo ' <td class="rostertable" style="background-color:#F5F5F5"></td> ';}
if($p_pattern[$i]=="O"){ 

if (in_array($i,$fes_day) && $fes==1 ){
	echo ' <td class="rostertable" style="background-color:#90EE90" title ="'.$festival[$i].'"></td> ';
	
}else{
	echo ' <td class="rostertable" style="background-color:#F5F5F5"></td> ';
}

}


//if($p_pattern[$i]=="G"){ echo ' <td class="rostertable" style="background-color:#DEB887"></td> ';}

//governmet holidays
if($p_pattern[$i]=="G"){

if (in_array($i,$fes_day)){
	echo ' <td class="rostertable" style="background-color:#90EE90" title ="'.$festival[$i].'"></td> ';
}else{
	echo ' <td class="rostertable" style="background-color:#DEB887"></td> ';
}
	
}

if (!(($p_pattern[$i]=="I" ) || ($p_pattern[$i]=="II") || ($p_pattern[$i]=="III") || ($p_pattern[$i]=="G") || ($p_pattern[$i]=="O")) ){
		if(($p_pattern[$i]=="X")||($p_pattern[$i]=="X/L")){
		echo ' <td class="rostertable" style="background-color:green;color:white" title ="'.$p_leave_marked_by[$i].'">'.$p_pattern[$i].'</td> ';
		}else{
		echo ' <td class="rostertable" style="background-color:#A52A2A;color:white" title ="'.$p_leave_marked_by[$i].'">'.$p_pattern[$i].'</td> ';		
		}
}

if($p_pattern[$day-1]=="I") { $todayIshift.=$cmem['c_mem'];  }

if($p_pattern[$day-1]=="II") { $todayIIshift.=$cmem['c_mem'];  }

if($p_pattern[$day-1]=="III") { $todayIIIshift.=$cmem['c_mem'];  }
 } //inner for
//echo " ********* pattern with leave" ;
//print_r($p_pattern); 
echo'</tr>';
} //function

?>

<title>Shift Roster</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Shift Roster Update</title>
<link rel="stylesheet" href="view/jquery-ui.css" type="text/css"> 
<script type="text/javascript" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" src="view/js/jquery-ui.js"></script>
<script>
   $( function() {
 
       $( "#fdate" ).datepicker({dateFormat: 'dd-mm-yy' }).val();

       } ); 
  $( function() {
       $( "#tdate" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } );

  $( function() {
       $( "#rdate" ).datepicker({ dateFormat: 'dd-mm-yy' }).val();
       } );
 </script>
 
<script language="javascript">
function printdiv(printpage)
{
	
	var d = new Date();
var yr = d.getFullYear();
var mnth = d.getMonth()+1;

//document.getElementById('print_table').setAttribute("style","width:95%");
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
/*var newstr = document.all.item(printpage).innerHTML;*/
var oldstr = document.body.innerHTML;

var x = document.createElement("h1");
x.setAttribute("style", "text-align: center");                         // Create a <p> node
var t = document.createTextNode("Computing System Section (CSS) CD : RTC Duty Roster : <?php echo $m.'/'.$y?>");    // "+mnth+"/"+yrCreate a text node

x.appendChild(t); 
                                         // Append the text to <p>
document.body.appendChild(x); 
var div_print = document.getElementById("div_print");
var child = document.getElementById("print_table");
child.setAttribute("style","margin-left: auto;margin-right: auto;width:98%");

var linebreak1 = document.createElement ("BR");
div_print.insertBefore(linebreak1,child);

div_print.insertBefore(x,child);

var linebreak2 = document.createElement ("BR");
div_print.insertBefore(linebreak2,child);

var remove_tag1 = document.getElementById("select_month");
remove_tag1.remove();

var remove_tag2 = document.getElementById("select_year");
remove_tag2.remove();

var remove_tag3 = document.getElementById("month_year_submit");
remove_tag3.remove();
 
var newstr = document.all.item(printpage).innerHTML;

document.body.innerHTML = newstr;
window.print();
document.body.innerHTML = oldstr;
document.getElementById('print_table').setAttribute("style","width:105%");
return false;
return false;
}
</script>


<style>
.optButtion {
  background-color: #000080;
  border: none;
  color: white;
  padding: 8px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 14px;
  cursor: pointer;
}
</style>


</head>
<body>

<?php if($updateflag==1)
{
?>
<div align="center" width="105%" style="align:center;border:1px solid red;" >
<form  method="post" action="">
<table><tr>
<td><input type="submit" class="optButtion" name="type_of_req" value="Leave"></td>
<td><input type="submit" class="optButtion" name="type_of_req" value="Action"></td>
<td><input type="submit" class="optButtion" name="type_of_req" value="On Request Change"></td>
<td><input type="submit" class="optButtion" name="type_of_req" value="On Requirement Change"></td>
<td><input type="submit" class="optButtion" name="type_of_req" value="Over Time"></td>
</tr></table>
</form>
<?php 

echo '<form  method="post" action="index.php?hpcpage=rosterupdate">
<table class="rostertable" width="100%" border="1"  style="align:center;border:1;color:#003399;
font-size:16px;font:"Times New Roman", Times, serif;text-align:left;" >'; 

  
if($_POST["type_of_req"] == "Leave"){
	echo '<tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
<label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
<td style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select> </td>';
	echo '<td colspan="2"></td></tr>
<tr><td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>
<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>
<tr></tr>';
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of '.$_POST["type_of_req"].' </b></lable></td>
<td style="text-align:left;color:#003399;" > <select  name="type" >
<optgroup style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px">
    <!--	<option value="">none</option> -->
	<option value="CL">Casual Leave</option>
	<option value="CO">Compensatory Off</option>
	<option value="EL">Earned Leave</option>
	<option value="ML">Medical Leave</option>
	<option value="FH">First Half Leave</option>
	<option value="SH">Second Half leave</option>
	<option value="OD">On Duty</option>
	<option value="PL">Paternity Leave</option>
	<option value="UL">Unauthorised Leave</option>
	<option value="UE">Unauthorised Emergency Leave</option>
	<option value="L" selected="selected">Leave</option>
 </optgroup></select><input type="hidden" name="typeofreq" value="L"></td></tr>'; 
 }
 if($_POST["type_of_req"] == "Action"){
	 echo '<tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
<label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
<td  style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select> </td>';
	 echo '</tr>
<tr><td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>
<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>
<tr></tr>';
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of '.$_POST["type_of_req"].' </b></lable></td>
<td style="text-align:left;color:#003399;" > <select  name="type" >
<optgroup style="cursor:pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="rub">RUB</option>
	<option value="UC">Un Authorised shift change</option>
	</optgroup></select><input type="hidden" name="typeofreq" value="A"></td></tr>'; 
 }
 if($_POST["type_of_req"] == "On Request Change"){	 
	 echo '<tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
<label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
<td  style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select> </td>';
echo '<td width="17%"  style="border:1;text-align:left;color:#003399;"> 
    <label for="option" style="font-size:14px"> <b>Change Taken From:</b> </label></td> 
    <td  style="text-align:left">
<select id="icno " name="change_with" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select></td>';
	 echo '</tr>
<tr><td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>
<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>
<tr></tr>';
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of Change </b></lable></td>
	<td style="text-align:left;color:#003399;" > <select  name="type" >
	<optgroup style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="C1">First Shift Change</option>
	<option value="C2">Second Shift Change</option>
	<option value="C3">Night Shift Change</option>
	<option value="CG">General Shift Change</option>
	<option value="F+S">Continue From First to Second Shift</option>
	<option value="S+N">Continue From Second Shift to Night Shift</option>
	<option value="N+F">Continue From Night Shift to First Shift</option>
	<option value="N<F">Continue Previous shift from current shift (Night + First)</option>
	<option value="F<S">Continue Previous shift from current shift (First + Second)</option>
	<option value="S<N">Continue Previous shift from current shift (Second + Night)</option>
	</optgroup></select></td>
	<td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Half day Leave </b></lable></td>
	<td style="text-align:left;color:#003399;" > <select  name="change_with_leave" >
	<optgroup  style="cursor: pointer;"  style="text-align:left;color:#003399;font-size:14px" >
	<option value="none">none</option>
	<option value="F">First Half Leave</option>
	<option value="S">Second Half Leave</option>
	</optgroup></select><input type="hidden" name="typeofreq" value="C"></td>
	</tr>'; 
 }
  if($_POST["type_of_req"] == "On Requirement Change"){
	  echo '<tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
<label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
<td  style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select> </td>';
	  echo '</tr>
<tr><td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>
<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>
<tr></tr>';
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of Change </b></lable></td>
<td style="text-align:left;color:#003399;" > <select  name="type" >
	<optgroup  style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="RC1">On Requirement First Shift Change</option>
	<option value="RC2">On Requirement Second Shift Change</option>
    <option value="RC3">On Requirement Night Shift Change</option>
    <option value="RN+F">On Requirement Continue I Shift</option>
    <option value="RF+S">On Requirement Continue II Shift</option>
    <option value="RS+N">On Requirement Continue III Shift</option>
	<option value="RCG">On Requirement General Shift Change</option>
	<option value="RN<F">On Requirement Previous shift + current shift (Night + First)</option>
	<option value="RF<S">On Requirement Previous shift + current shift (First + Second)</option>
	<option value="RS<N">On Requirement Previous shift + current shift (Second + Night)</option>
    </optgroup></select><input type="hidden" name="typeofreq" value="RC"></td></tr>'; 
 }
 
 
 
  if($_POST["type_of_req"] == "Over Time"){
	  
	  
	  echo '<tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
<label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
<td  style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>';
foreach ($CD as $crew){
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}
echo '</select> </td>';
	  
	  echo '</tr>
<tr><td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>
<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>';
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Start Time </b></lable></td>
<td style="text-align:left;color:#003399;" >
	<select  name="over_time_start_hour" >
	<optgroup  style="cursor: pointer;" label="Hour" style="text-align:left;color:#003399;font-size:14px" >';
	for($i=0;$i<24;$i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</optgroup></select>
	<select  name="over_time_start_min" >
	<optgroup  style="cursor: pointer;" label="Minute" style="text-align:left;color:#003399;font-size:14px" >';
	for($i=0;$i<60;$i+=5){
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</optgroup></select>
	
	
	</td>
	<td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> End Time </b></lable></td>
	<td style="text-align:left;color:#003399;" > 
	<select  name="over_time_end_hour" >
	<optgroup  style="cursor: pointer;" label="Hour" style="text-align:left;color:#003399;font-size:14px" >';
	for($i=0;$i<24;$i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</optgroup></select>
	<select  name="over_time_end_min" >
	<optgroup  style="cursor: pointer;" label="Minute" style="text-align:left;color:#003399;font-size:14px" >';
	for($i=0;$i<60;$i+=5){
	echo '<option value="'.$i.'">'.$i.'</option>';
	}
	echo '</optgroup></select>
	
	</td></tr>'; 
	  
	  
echo '<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of '.$_POST["type_of_req"].' </b></lable></td>
	<td style="text-align:left;color:#003399;" > <select  name="type" >
	<optgroup  style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="X">Over Time On Working Day</option>
	<option value="X/L">Over Time On Leave Day</option>
    </optgroup></select></td>
	
	<td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Work Description </b></lable></td>
	<td style="text-align:left;color:#003399;" >
	<textarea rows="4" cols="45" name="work_description"></textarea>
	</td>
	
	</tr>
	
	<tr><td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Section of </b></lable></td>
	<td style="text-align:left;color:#003399;" > <select  name="section_of" >
	<optgroup  style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="CSS">CSS</option>
	<option value="Network">Network</option>
	<option value="WSN">WSN</option>
	<option value="CISS">CISS</option>
	<option value="CD Office">CD Office</option>
	<option value="Others">Others</option>	
    </optgroup></select></td>
	<td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Work Alloted By </b></lable></td>
	<td style="text-align:left;color:#003399;" > <select  name="work_alloted_by" >
	<optgroup  style="cursor: pointer;" style="text-align:left;color:#003399;font-size:14px" >
	<option value="">none</option>';
	foreach ($CD_STAFF as $cd_staff){
			echo'<option value="'.$cd_staff[name].'">'.$cd_staff[name] .'</option>';
		}
	echo '</optgroup></select><input type="hidden" name="typeofreq" value="OT"></td></tr>'; 
}

 echo '<tr>
 <td colspan="8"> 
 <input style="cursor: pointer;" type="submit" name="update" value="Update" >
 <input style="cursor: pointer;" type="reset" name= "reset" value="Reset">
 <a href="index.php?hpcpage=rosterupdate">Click Here to refresh </a> </td>
 </tr>
 </table></form>';

?>
 
<?php } ?>
<form method="post" action="">

<?php $Ishiftmem=explode(",",$Ishiftmem);
$Iscnt=count($Ishiftmem);

$IIshiftmem=explode(",",$IIshiftmem);
$IIscnt=count($IIshiftmem);
$IIIshiftmem=explode(",",$IIIshiftmem);
$IIIscnt=count($IIIshiftmem);
$selected_month =date("m"); 

$selected_year = date('Y');

if($updateflag==0){
	echo '<table class="rostertable" width="105%">';
	echo "<tr  class='rostertable' style = 'background-color:LightGray'><th class='rostertable' colspan='11'>
	<h2 style='text-align: center;font-family: Times New Roman; color: black;'>
	Computing System Section (CSS) CD : RTC Duty Roster : <u>".date("F",mktime(0,0,0,$m))." ".$y."</u></h2></th></tr>";

?>
<tr class="rostertable" ><th style='text-align: center;font-family: Times New Roman; color:Black'><h3>Today : <?php echo date("d")."-".date("m")."-".date("Y");?></h3></th>

<th class="rostertable" width='10%' style='color: black;text-align:right' > <input name='b_print' type='button' onClick="printdiv('div_print');" value=" Print" </th>

</tr>
</table>
<?php } ?>
<div id="div_print">

<?php
if($updateflag==0){
echo '<table id="print_table" class=\"rostertable\" width="105%" >';
}
else 
{
echo '<table class=\"rostertable\" border=1 width="100%">';
}
?>
<tr class="rostertable">
<th class="rostertable" width="" style="background-color:#32cd32">
<select name="month" size="1" style="cursor: pointer" id="select_month">
    <option value="1" <?php if($selected_month == "01"){ echo "selected"; } ?> >Jan</option>
    <option value="2" <?php if($selected_month == "02"){ echo "selected"; } ?> >Feb</option>
    <option value="3" <?php if($selected_month == "03"){ echo "selected"; } ?> >Mar</option>
	<option value="4" <?php if($selected_month == "04"){ echo "selected"; } ?> >Apr</option>
	<option value="5" <?php if($selected_month == "05"){ echo "selected";} ?> >May</option>
	<option value="6" <?php if($selected_month == "06"){ echo "selected"; } ?> >Jun</option>
	<option value="7" <?php if($selected_month == "07"){ echo "selected"; } ?> >Jul</option>
	<option value="8" <?php if($selected_month == "08"){ echo "selected"; } ?> >Aug</option>
	<option value="9" <?php if($selected_month == "09"){ echo "selected"; } ?> >Sep</option>
	<option value="10" <?php if($selected_month == "10"){ echo "selected"; } ?> >Oct</option>
	<option value="11" <?php if($selected_month == "11"){ echo "selected"; } ?> >Nov</option>
	<option value="12" <?php if($selected_month == "12"){ echo "selected";} ?> >Dec</option>
    </select>

<select name="year" size="1" style="cursor: pointer" id="select_year">
    <option value="2017" <?php if($selected_year == "2017"){ echo "selected"; } ?> >2017</option>
	<option value="2018" <?php if($selected_year == "2018"){ echo "selected"; } ?> >2018</option>
    <option value="2019" <?php if($selected_year == "2019"){ echo "selected"; } ?> >2019</option>
    <option value="2020" <?php if($selected_year == "2020"){ echo "selected"; } ?> >2020</option>
	<option value="2021" <?php if($selected_year == "2021"){ echo "selected"; } ?> >2021</option>
	<option value="2022" <?php if($selected_year == "2022"){ echo "selected"; } ?> >2022</option>
	<option value="2023" <?php if($selected_year == "2023"){ echo "selected"; } ?> >2023</option>
	<option value="2024" <?php if($selected_year == "2024"){ echo "selected"; } ?> >2024</option>
	<option value="2025" <?php if($selected_year == "2025"){ echo "selected"; } ?> >2025</option>
	<option value="2026" <?php if($selected_year == "2026"){ echo "selected"; } ?> >2026</option>
     </select><input type="submit" name="fetch" value="Fetch" id="month_year_submit">

</th>
<th class="rostertable" style="background-color:#B22222"><?php echo "".date("M",mktime(0,0,0,$m,1)) ." - $y". ""; ?></th> <?php

//echo $days;
for ($i=1; $i<=$days; $i++) {

if ($i==$htdate and $m == date("m") ){
echo "<th class='rostertable' style='background-color:#A32b2b;border:1;text-align: center;' >"; echo $i; } else { echo "<th class='rostertable' style='background-color:#11cc00;border:1;text-align: center' >"; echo $i; }

echo "</th >";

}

echo" </tr>
<tr class='rostertable'>
<th class='rostertable' style='background-color:#CD853F;border:1'>Crew Members</th> <th class='rostertable' style='background-color:#CD853F;border:1'>Day</th>";

for ($x=1; $x<=$days; $x++) {
$day=date("D", mktime(0,0,0,$m,$x,$y));
if ( $day =="Sun" ) {
echo "<td class='rostertable' style= 'border:1;background-color: #8B4513; color:white; font-size: 95%;' >"; }
elseif ( $day == "Sat" ) {
echo "<td class='rostertable' style= 'background-color: #8B4513; color:white; font-size: 95%;' >";
}
else {
echo "<td class='rostertable' style='background-color: #CD853F; color:white; font-size: 95%;' >";
}
echo date("D", mktime(0,0,0,$m,$x,$y));
echo "</td >";
}
echo "</tr>
<tr class='rostertable'>";
echo"<th class='rostertable' style='background-color:#2F4F4F;border:1'>Crew A</th> <th class='rostertable' style='background-color:#2F4F4F'>IC No</th>";
display_heading($aH['c_pattern'],$days);
//echo "selected month " .$m;
for($i=1;$i<=$cnt;$i++)
{
if($cname[$i]=='A'){
display_roster($rA[$i]['c_pattern'],$cA[$i],$days,$LA[$i],$m);
//print_r($rA[$i]['c_pattern']);
}
}

echo" <tr class='rostertable'> <th class='rostertable' style='background-color:#2F4F4F'>Crew B</th> <th class='rostertable' style='background-color:#2F4F4F'>IC No</th>";
display_heading($bH['c_pattern'],$days);
for($i=1;$i<=$cnt;$i++)
{
if($cname[$i]=='B'){
 display_roster($rA[$i]['c_pattern'],$cA[$i],$days,$LA[$i],$m);
}
}
echo"<tr class='rostertable'> <th class='rostertable' style='background-color:#2F4F4F'>Crew C</th> <th class='rostertable' style='background-color:#2F4F4F'>IC No</th>";
display_heading($cH['c_pattern'],$days);
for($i=1;$i<=$cnt;$i++)
{
if($cname[$i]=='C'){
display_roster($rA[$i]['c_pattern'],$cA[$i],$days,$LA[$i],$m);
}
}
echo"<tr class='rostertable'> <th class='rostertable' style='background-color:#2F4F4F'>Crew D</th> <th class='rostertable' style='background-color:#2F4F4F'>IC No</th>";
display_heading($dH['c_pattern'],$days);
for($i=1;$i<=$cnt;$i++)
{
if($cname[$i]=='D'){
display_roster($rA[$i]['c_pattern'],$cA[$i],$days,$LA[$i],$m);
}
}

echo"<tr class='rostertable'> <th class='rostertable' style='background-color:#2F4F4F'>General</th> <th class='rostertable' style='background-color:#2F4F4F'>IC No</th>";
display_heading($gH['c_pattern'],$days, $fes_day, $festival, $fes=1);
for($i=1;$i<=$cnt;$i++)
{
if($cname[$i]=='G'){
display_roster($rA[$i]['c_pattern'],$cA[$i],$days,$LA[$i],$m, $fes_day,$festival, $fes=1);

}
}
?>
</tr>
</table>
</div>
</form>

