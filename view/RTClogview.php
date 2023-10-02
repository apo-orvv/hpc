<html>
<head>
<!-- for jquery calendar -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shift Roster Update</title>
  <link rel="stylesheet" href="view/jqdate1/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="view/jqdate1/style.css">
  <script src="view/jqdate1/jq.js"></script>
  <script src="view/jqdate1/jq2.js"></script>

<script>

   $( function() {
       
       $( "#date" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
 
</script>


<!--jquer calendar end css and js -->
<style>
.center
{
  position: absolute;
  margin: auto;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 1050px;
  height: 700px;
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
	width:34px;
	height:22px;
	text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size:13px;
}

td:hover {background-color:#f5f5f5;}
input[type=number] {
  width: 31px;
  height:17px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
input[type=number]:focus {
  width: 35px;
}

input[type=text] {
  width: 75px;
  height:17px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
input[type=text]:focus {
  width: 90px;
}

select {
  width: 31px;
  height:17px;
  font-family: "Times New Roman", Times, serif;
  font-size:13px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
select:focus {
  width: 35px;
}

textarea {
  width: 80px;
  height:17px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
textarea:focus {
  width: 321px;
  height: 100px;
}

.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
    font-family: "Times New Roman", Times, serif;
}

.button:hover {
    background-color: white;
    color: green;
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

<h3>Rtc Shift Log Register</h3>
<?php include "view/RTCdisplaybanner.php"; ?>
<form method="get" action="">
<input type="hidden" name="hpcpage" value="templog">
<table style="float: left;font-size:13px" border="1">
<tr><td style="width:117px">Date:<input type= "text" id= "date"  name= "date" onchange="this.form.submit()" value="<?php echo $date1;?>"></td></tr></table>
</form>


<?php
for ($x=6;$x<=23;$x++){
	echo '<table style="float: left;font-size:13px" border="1"><tr>';
	if($x>=6 && $x<=13){	
	echo '<td style="background-color:#FFD700;">'.$x.':00</td></tr></table>';
	}
	elseif($x>=14 && $x<=21){	
	echo '<td style="background-color:#FFB6C1;">'.$x.':00</td></tr></table>';
	}
	elseif($x<=23){	
	echo '<td style="background-color:#87CEFA;">'.$x.':00</td></tr></table>';
	}
}
for ($x=0;$x<=5;$x++){
	echo '<table style="float: left;font-size:13px" border="1"><tr>';
	echo '<td style="background-color:#87CEFA;">'.$x.':00</td></tr></table>';
}
?>

<table style="float:left;font-size:13px" border="1" bgcolor="#B0E0E6">
<tr> <td rowspan="2" style="width:80px;" >IVY Cluster</td> <td><a href="index.php?hpcpage=chart&value=0&date=<?php echo $selectedDate?>" target="_blank"> Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=1&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-1</td><td><a href="index.php?hpcpage=chart&value=2&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=3&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-2</td><td><a href="index.php?hpcpage=chart&value=4&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=5&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-3</td><td><a href="index.php?hpcpage=chart&value=6&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=7&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">Cluster AC unit-4</td><td><a href="index.php?hpcpage=chart&value=8&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=9&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">VDI AC unit-1</td><td><a href="index.php?hpcpage=chart&value=10&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=11&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr> <td rowspan="2">VDI AC unit-2</td><td><a href="index.php?hpcpage=chart&value=12&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td> </tr>
<tr><td><a href="index.php?hpcpage=chart&value=13&date=<?php echo $selectedDate?>" target="_blank">Hum</a></td></tr>

<tr><td>HPC Room</td><td><a href="index.php?hpcpage=chart&value=14&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td></tr>
<tr><td>I/O Room</td><td><a href="index.php?hpcpage=chart&value=15&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td></tr>
<tr><td>Anunet Room</td><td><a href="index.php?hpcpage=chart&value=16&date=<?php echo $selectedDate?>" target="_blank">Temp</a></td></tr>
<tr> <td colspan="2">HPC status</td></tr>
<tr> <td colspan="2">Workstation status</td></tr>
<tr> <td colspan="2">E-mail server status</td></tr>
<tr> <td colspan="2">Inter/intra status</td></tr>
<tr> <td colspan="2">UPS status</td></tr>
<tr> <td colspan="2">Switch status</td></tr>
</table>
<form method="post" action="">
<?php
//form table for temp, hum and status

for ($y=1;$y<=24;$y++){

//to match logtime with server time
if($y<=18){
$logtime=$y+5;
}
else{
$logtime=$y-19;
}

echo '<table border="1" style="float: left;">';
for ($x=0; $x<=22; $x++){
echo '<tr>';

	if($y<=8){	
	echo '<td style="background-color:#FFD700;">';
	}
	elseif($y>=9 && $y<=16){	
	echo '<td style="background-color:#FFB6C1;">';
	}
	elseif($y>=17){	
	echo '<td style="background-color:#87CEFA;">';
	}
if (${"data".$y}!="" && ${'time'.$y}==$y){
if($x<17){
echo ${"data".$y}[$x];
}
else{
echo "&#".${"data".$y}[$x].";";
}
}
	
else {	

if($x<17 && $selectedDate==$today && $logtime==$H){

echo '<input type = "number" step="0.1" min="10" max="80" name = "col[]" ></td></tr>';
//$time=$y;

}

elseif($x>16 && $selectedDate==$today && $logtime==$H){	
echo '<select name= "col[]">
     
      <option value="10003" selected>&#10003;</option><option value="10007">&#10007;</option></select></td></tr>';
//$time=$y;
}



}


}

echo '</table>';
}


//echo "the current hour is ".$H;
?>





<div class="clear"></div>




<?php
//form table for shift remarks

for ($x=1; $x<=3; $x++){
echo '<table style="float: left;border: 2px solid lightblue"><tr>';	
echo '<td style="height:100px;width:338px;">';

for($y=0;$y<${"rows".$x};$y++){
echo ${"remark".$x}[$y][4];
echo '.... <br>';
}

if ($serverTime<14 && $serverTime>=6 && $x==1 && $selectedDate==$today){
echo '<textarea  name = "remark" placeholder="1st shift Remark.."></textarea>';
echo '<select  name="loggedby" style="cursor: pointer;width: 80px;" required>
<option value="">Logged by</option> 
<option value="Karuthapandian P">Karuthapandian P</option> 
<option value="Balu v">Balu v</option>
<option value="Solairaj P">Solairaj P</option>
<option value="Srinivas Rao v">Srinivas Rao v</option>
<option value="Venkatesan S">Venkatesan S</option>
<option value="Radhakrishnan N">Radhakrishnan N</option>
<option value="Rajesh K">Rajesh K</option>
<option value="Nandakumar R">Nandakumar R</option>
<option value="Anil yadav">Anil yadav</option>
<option value="Ibrahim Khan">Ibrahim Khan</option>
<option value="Boopalan A">Boopalan A</option>
<option value="Sathish Kumar N">Sathish Kumar N</option>
<option value="Srinivasan S N">Srinivasan S N</option>
<option value="Krishnaveni P">Krishnaveni P</option>
</select>';
echo '<input type="hidden" name="shift" value='.$x.'>';
}

elseif ($serverTime<22 && $serverTime>=14 && $x==2 && $selectedDate==$today){
echo '<textarea  name = "remark" placeholder="2nd shift Remark.."></textarea>';
echo '<select  name="loggedby" style="cursor: pointer;width: 80px;" required>
<option value="">Logged by</option> 
<option value="Karuthapandian P">Karuthapandian P</option> 
<option value="Balu v">Balu v</option>
<option value="Solairaj P">Solairaj P</option>
<option value="Srinivas Rao v">Srinivas Rao v</option>
<option value="Venkatesan S">Venkatesan S</option>
<option value="Radhakrishnan N">Radhakrishnan N</option>
<option value="Rajesh K">Rajesh K</option>
<option value="Nandakumar R">Nandakumar R</option>
<option value="Anil yadav">Anil yadav</option>
<option value="Ibrahim Khan">Ibrahim Khan</option>
<option value="Boopalan A">Boopalan A</option>
<option value="Sathish Kumar N">Sathish Kumar N</option>
<option value="Srinivasan S N">Srinivasan S N</option>
<option value="Krishnaveni P">Krishnaveni P</option>
</select>';
echo '<input type="hidden" name="shift" value='.$x.'>';
}

elseif($serverTime<6 && $x==3 && $selectedDate==$today || $serverTime>=22 && $x==3 && $selectedDate==$today){
echo '<textarea  name = "remark" placeholder="3rd shift Remark.."></textarea>';
echo '<select  name="loggedby" style="cursor: pointer;width: 80px;" required>
<option value="">Logged by</option> 
<option value="Karuthapandian P">Karuthapandian P</option> 
<option value="Balu v">Balu v</option>
<option value="Solairaj P">Solairaj P</option>
<option value="Srinivas Rao v">Srinivas Rao v</option>
<option value="Venkatesan S">Venkatesan S</option>
<option value="Radhakrishnan N">Radhakrishnan N</option>
<option value="Rajesh K">Rajesh K</option>
<option value="Nandakumar R">Nandakumar R</option>
<option value="Anil yadav">Anil yadav</option>
<option value="Ibrahim Khan">Ibrahim Khan</option>
<option value="Boopalan A">Boopalan A</option>
<option value="Sathish Kumar N">Sathish Kumar N</option>
<option value="Srinivasan S N">Srinivasan S N</option>
<option value="Krishnaveni P">Krishnaveni P</option>
</select>';
echo '<input type="hidden" name="shift" value='.$x.'>';
}
echo '</td></tr></table>';
}
?>

<div class="clear">
<button class="button" value="submit" name="submit">Submit</button>
</form>
<a href="index.php?hpcpage=chart&value=all&date=<?php echo $selectedDate?>" class="button" target="_blank">View ALL Temp Chart</button></a>
<a href="index.php?hpcpage=viewremark" class="button" target="_blank">View Remark</a>
<a href="index.php?hpcpage=modify" class="button">Modify Data</a>

<?php
echo "<meta http-equiv='refresh' content='300'>";
?>






