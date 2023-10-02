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
$leave_marked_by[$i]=$leave['actionby'];
}
}
else 
{
if(($dm==$from_month) && ($from_month <=$to_month))
{
for($i=$from_date;$i<=$days;$i++)
{
$la_pat[$i]=$leave['type'];
$leave_marked_by[$i]=$leave['actionby'];
}
}
if(($dm==$to_month) && ($from_month <=$to_month))
{

for($i=1;$i<=$to_date;$i++)
{
$la_pat[$i]=$leave['type'];
$leave_marked_by[$i]=$leave['actionby'];
}
}
if(($dm!=$from_month) && ($dm!=$to_month))
{

//echo "coming inside";
for($i=1;$i<=$days;$i++)
{
$la_pat[$i]=$leave['type'];
$leave_marked_by[$i]=$leave['actionby'];
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

if (!(($p_pattern[$i]=="I" ) || ($p_pattern[$i]=="II") || ($p_pattern[$i]=="III") || ($p_pattern[$i]=="G") || ($p_pattern[$i]=="O")) )

	{ echo ' <td class="rostertable" style="background-color:#A52A2A;color:white" title ="Done by '.$p_leave_marked_by[$i].'">'.$p_pattern[$i].'</td> ';}

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

<script>

function myFunction1() {
    var x = document.getElementById('leave');
	var y = document.getElementById('change1');
	var z = document.getElementById('change2');
	var a = document.getElementById('action');
         a.style.display = "block";
         x.style.display = "none";    
         y.style.display = 'none';
		 z.style.display = 'none';
		 }

function myFunction2() {
    var x = document.getElementById('leave');
    var y = document.getElementById('change1');
	var z = document.getElementById('change2');
    var a = document.getElementById('action');
         a.style.display = "none";
         x.style.display = "block";    
         y.style.display = 'none';
		 z.style.display = 'none';
		 }
		 
function myFunction3() {
    var x = document.getElementById('leave');
    var y = document.getElementById('change1');
	var z = document.getElementById('change2');
    var a = document.getElementById('action');
         a.style.display = "none";
         x.style.display = "none";    
         y.style.display = 'block';
		 z.style.display = 'none';
		 }
function myFunction4() {
    var x = document.getElementById('leave');
    var y = document.getElementById('change1');
	var z = document.getElementById('change2');
    var a = document.getElementById('action');
         a.style.display = "none";
         x.style.display = "none";    
         y.style.display = 'none';
		 z.style.display = 'block';
		 }


		 
		 
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

</head>
<body>
<?php if($updateflag==1)
{
?>
<div align="center" width="105%" style="align:center;border:1px solid red;" >
  <form  method="post" action="index.php?hpcpage=rosterupdate">
  <table class="rostertable" width="100%" border="1"  style="align:center;border:1;color:#003399; font-size:16px;font:'Times New Roman', Times, serif;text-align:left;" > 
    <tr > <td width="17%"  style="border:1;text-align:left;color:#003399;"> 
     <label for="option" style="font-size:14px"> <b> Crew Member </b> </label></td> 
      <td colspan="3" style="text-align:left">
<select id="icno " name="icno" style="cursor: pointer">
<option value="">none</option>
<?php foreach ($CD as $crew)
{
echo'<option value="'.$crew[icno].'">'.$crew[c_mem] .'</option>';
}?>
</select> </td> </tr>
<tr>
<td  style="text-align:left;color:#003399;font-size:14px"><b>  From: </b>  </td> <td style="text-align:left;font-size:14px">  <input  type= "text" id= "fdate" name= "fdate" size="8" > </td>

<td width="19%" style="text-align:left;color:#003399;font-size:14px"><b> To:    </b> </td> 
<td width="26%" style="text-align:left"> <input type= "text" id= "tdate" name= "tdate" size="8"> </td> </tr>
<tr></tr>
    <tr> <td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input" > <b> Type of Request </b></lable> </td>
    <td style="text-align:left;color:#003399;font-size:14px" colspan="3"> <input type="radio" id="l1" name="leav" value="" onClick="myFunction2()" checked> <b> Leave </b> <input type="radio" id="a1" name="leav" value="" onClick="myFunction1()" > <b> Action </b>  <input type="radio" id="c1" name="leav" value="" onClick="myFunction3()"> <b> On Request change </b> <input type="radio" id="c2" name="leav" value="" onClick="myFunction4()"> <b> On Requirement change </b> </td> 
    </tr>
<tr>
<td style="text-align:left;color:#003399;font-size:14px"> <lable for= "input"> <b> Type of Leave / Action </b></lable></td>
<td style="text-align:left;color:#003399;" colspan="3"> <select  name="type" >
<optgroup id="leave" style="cursor: pointer; display:block;" label="leave" style="text-align:left;color:#003399;font-size:14px">
    <!--	<option value="">none</option> -->
	<option value="L_CL">Casual Leave</option>
	<option value="L_CO">Compensatory Off</option>
	<option value="L_CC">Compensatory Off on Continuation</option>
	<option value="L_EL">Earned Leave</option>
	<option value="L_ML">Medical Leave</option>
	<option value="L_FHD">Half day leave (FN)</option>
	<option value="L_SHD">Half day leave (AN)</option>
	<option value="L_SPL">Special Leave</option>
	<option value="L_LND">Leave Not Due</option>
	<option value="L_OD">On Duty</option>
	<option value="L_PL">Paternity Leave</option>
	<option value="L_UL">Unauthorised Leave</option>
	<option value="L_UE">Unauthorised Emergency Leave</option>
	<option value="L_L" selected="selected">Leave, but leave type not informed</option>
 </optgroup> 
 <optgroup id="change1" style="cursor: pointer; display:none;" label="On Request change" style="text-align:left;color:#003399;font-size:14px" >
	<option value="A_C1">First Shift Change</option>
	<option value="A_C2">Second Shift Change</option>
	<option value="A_C3">Night Shift Change</option>
	<option value="A_CG">General Shift Change</option>
	<option value="A_F+S">Continue From First to Second Shift</option>
	<option value="A_S+N">Continue From Second Shift to Night Shift</option>
	<option value="A_N+F">Continue From Night Shift to First Shift</option>
	<option value="A_N<F">Continue Previous shift from current shift (Night + First)</option>
	<option value="A_F<S">Continue Previous shift from current shift (First + Second)</option>
	<option value="A_S<N">Continue Previous shift from current shift (Second + Night)</option>
	</optgroup>
	 
	 <optgroup id="action" style="cursor: pointer; display:none;" label="Action" style="text-align:left;color:#003399;font-size:14px" >
	<option value="A_UC">Un Authorised shift change</option>
	<option value="rub">RUB</option>
	<option value="A_FTP">Forgot ID Card</option>
	</optgroup>
	<optgroup id="change2" style="cursor: pointer; display:none;" label="On Requirement change" style="text-align:left;color:#003399;font-size:14px" >
	<option value="A_RC1">On Requirement First Shift Change</option>
	<option value="A_RC2">On Requirement Second Shift Change</option>
    <option value="A_RC3">On Requirement Night Shift Change</option>
    <option value="A_RN+F">On Requirement Continue I Shift</option>
    <option value="A_RF+S">On Requirement Continue II Shift</option>
    <option value="A_RS+N">On Requirement Continue III Shift</option>
	<option value="A_RCG">On Requirement General Shift Change</option>
	<option value="A_RN<F">On Requirement Previous shift + current shift (Night + First)</option>
	<option value="A_RF<S">On Requirement Previous shift + current shift (First + Second)</option>
	<option value="A_RS<N">On Requirement Previous shift + current shift (Second + Night)</option>
    </optgroup>
	
</select></td> </tr>
    <td width="17%" style="text-align:left;color:#003399;font-size:14px"> <lable for = "input" > <b> Remarks </b> </lable> </td>
    <td width="38%" style="text-align:left;color:#003399;"> <input type = "txt" name="remarks" size="20"></td>
     <td style="text-align:left;color:#003399;font-size:14px"> <b>  Request on:  </b></td> <td style="text-align:left"><input type= "text" id= "rdate" name= "rdate" size="8"></td>  
    </tr>
    <tr> <td colspan="8"> 
    <input style="cursor: pointer;" type="submit" name="update" value="Update" >
<input style="cursor: pointer;" type="reset" name= "reset" value="Reset">
<a href="index.php?hpcpage=rosterupdate">Click Here to refresh </a> </td> </tr> </table>
</form>
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

