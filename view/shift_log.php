<html>
<head>
<title>RTC Shift Log</title>

<style>
th {
    background-color: #191970;
	font-size: 80%;
    color: white;
    
}
table,th,tr,td {
    border: 1px solid black;
   
    }
td {
    text-align: center; 
	font-size: 75%; 
	font-weight:bold;
}
</style>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shift Roster Update</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

   $( function() {
       
       $( "#day" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
  
 
</script>

</head>

<?php

$today=date("Y-m-d");

    if (isset($_REQUEST['day'])) {

        $selected_day = $_REQUEST['day'];

    }
    else {

        $selected_day = date("d-m-Y");

    }

echo $selected_day;

$date=date_create("$selected_day");
echo "<br>";
$today = date_format($date,"Y-m-d");
echo $today;
?>











<?php
// define variables and set to empty values

$ivy_temp6 = $ivy_temp7 = $ivy_temp8 = $ivy_temp9 = $ivy_temp10 = $ivy_temp11 = $ivy_temp12 =$ivy_temp13 = "";
$ivy_temp14 = $ivy_temp15 = $ivy_temp16 = $ivy_temp17 = $ivy_temp18 = $ivy_temp19 = $ivy_temp20 = $ivy_temp21 = "";
$ivy_temp22 = $ivy_temp23 = $ivy_temp0 = $ivy_temp1 = $ivy_temp2 = $ivy_temp3 = $ivy_temp4 =  $ivy_temp5 = "";

$ivy_hum6 = $ivy_hum7 = $ivy_hum8 = $ivy_hum9 = $ivy_hum10 = $ivy_hum11 = $ivy_hum12 =$ivy_hum13 = "";
$ivy_hum14 = $ivy_hum15 = $ivy_hum16 = $ivy_hum17 = $ivy_hum18 = $ivy_hum19 = $ivy_hum20 = $ivy_hum21 = "";
$ivy_hum22 = $ivy_hum23 = $ivy_hum0 = $ivy_hum1 = $ivy_hum2 = $ivy_hum3 = $ivy_hum4 =  $ivy_hum5 = "";

$cluster_ac1_temp6 = $cluster_ac1_temp7 = $cluster_ac1_temp8 = $cluster_ac1_temp9 = $cluster_ac1_temp10 = $cluster_ac1_temp11 = $cluster_ac1_temp12 =$cluster_ac1_temp13 = "";
$cluster_ac1_temp14 = $cluster_ac1_temp15 = $cluster_ac1_temp16 = $cluster_ac1_temp17 = $cluster_ac1_temp18 = $cluster_ac1_temp19 = $cluster_ac1_temp20 = $cluster_ac1_temp21 = "";
$cluster_ac1_temp22 = $cluster_ac1_temp23 = $cluster_ac1_temp0 = $cluster_ac1_temp1 = $cluster_ac1_temp2 = $cluster_ac1_temp3 = $cluster_ac1_temp4 =  $cluster_ac1_temp5 = "";

$cluster_ac1_hum6 = $cluster_ac1_hum7 = $cluster_ac1_hum8 = $cluster_ac1_hum9 = $cluster_ac1_hum10 = $cluster_ac1_hum11 = $cluster_ac1_hum12 =$cluster_ac1_hum13 = "";
$cluster_ac1_hum14 = $cluster_ac1_hum15 = $cluster_ac1_hum16 = $cluster_ac1_hum17 = $cluster_ac1_hum18 = $cluster_ac1_hum19 = $cluster_ac1_hum20 = $cluster_ac1_hum21 = "";
$cluster_ac1_hum22 = $cluster_ac1_hum23 = $cluster_ac1_hum0 = $cluster_ac1_hum1 = $cluster_ac1_hum2 = $cluster_ac1_hum3 = $cluster_ac1_hum4 =  $cluster_ac1_hum5 = "";

$cluster_ac2_temp6 = $cluster_ac2_temp7 = $cluster_ac2_temp8 = $cluster_ac2_temp9 = $cluster_ac2_temp10 = $cluster_ac2_temp11 = $cluster_ac2_temp12 =$cluster_ac2_temp13 = "";
$cluster_ac2_temp14 = $cluster_ac2_temp15 = $cluster_ac2_temp16 = $cluster_ac2_temp17 = $cluster_ac2_temp18 = $cluster_ac2_temp19 = $cluster_ac2_temp20 = $cluster_ac2_temp21 = "";
$cluster_ac2_temp22 = $cluster_ac2_temp23 = $cluster_ac2_temp0 = $cluster_ac2_temp1 = $cluster_ac2_temp2 = $cluster_ac2_temp3 = $cluster_ac2_temp4 =  $cluster_ac2_temp5 = "";

$cluster_ac2_hum6 = $cluster_ac2_hum7 = $cluster_ac2_hum8 = $cluster_ac2_hum9 = $cluster_ac2_hum10 = $cluster_ac2_hum11 = $cluster_ac2_hum12 =$cluster_ac2_hum13 = "";
$cluster_ac2_hum14 = $cluster_ac2_hum15 = $cluster_ac2_hum16 = $cluster_ac2_hum17 = $cluster_ac2_hum18 = $cluster_ac2_hum19 = $cluster_ac2_hum20 = $cluster_ac2_hum21 = "";
$cluster_ac2_hum22 = $cluster_ac2_hum23 = $cluster_ac2_hum0 = $cluster_ac2_hum1 = $cluster_ac2_hum2 = $cluster_ac2_hum3 = $cluster_ac2_hum4 =  $cluster_ac2_hum5 = "";

$cluster_ac3_temp6 = $cluster_ac3_temp7 = $cluster_ac3_temp8 = $cluster_ac3_temp9 = $cluster_ac3_temp10 = $cluster_ac3_temp11 = $cluster_ac3_temp12 =$cluster_ac3_temp13 = "";
$cluster_ac3_temp14 = $cluster_ac3_temp15 = $cluster_ac3_temp16 = $cluster_ac3_temp17 = $cluster_ac3_temp18 = $cluster_ac3_temp19 = $cluster_ac3_temp20 = $cluster_ac3_temp21 = "";
$cluster_ac3_temp22 = $cluster_ac3_temp23 = $cluster_ac3_temp0 = $cluster_ac3_temp1 = $cluster_ac3_temp2 = $cluster_ac3_temp3 = $cluster_ac3_temp4 =  $cluster_ac3_temp5 = "";

$cluster_ac3_hum6 = $cluster_ac3_hum7 = $cluster_ac3_hum8 = $cluster_ac3_hum9 = $cluster_ac3_hum10 = $cluster_ac3_hum11 = $cluster_ac3_hum12 =$cluster_ac3_hum13 = "";
$cluster_ac3_hum14 = $cluster_ac3_hum15 = $cluster_ac3_hum16 = $cluster_ac3_hum17 = $cluster_ac3_hum18 = $cluster_ac3_hum19 = $cluster_ac3_hum20 = $cluster_ac3_hum21 = "";
$cluster_ac3_hum22 = $cluster_ac3_hum23 = $cluster_ac3_hum0 = $cluster_ac3_hum1 = $cluster_ac3_hum2 = $cluster_ac3_hum3 = $cluster_ac3_hum4 =  $cluster_ac3_hum5 = "";

$cluster_ac4_temp6 = $cluster_ac4_temp7 = $cluster_ac4_temp8 = $cluster_ac4_temp9 = $cluster_ac4_temp10 = $cluster_ac4_temp11 = $cluster_ac4_temp12 =$cluster_ac4_temp13 = "";
$cluster_ac4_temp14 = $cluster_ac4_temp15 = $cluster_ac4_temp16 = $cluster_ac4_temp17 = $cluster_ac4_temp18 = $cluster_ac4_temp19 = $cluster_ac4_temp20 = $cluster_ac4_temp21 = "";
$cluster_ac4_temp22 = $cluster_ac4_temp23 = $cluster_ac4_temp0 = $cluster_ac4_temp1 = $cluster_ac4_temp2 = $cluster_ac4_temp3 = $cluster_ac4_temp4 =  $cluster_ac4_temp5 = "";

$cluster_ac4_hum6 = $cluster_ac4_hum7 = $cluster_ac4_hum8 = $cluster_ac4_hum9 = $cluster_ac4_hum10 = $cluster_ac4_hum11 = $cluster_ac4_hum12 =$cluster_ac4_hum13 = "";
$cluster_ac4_hum14 = $cluster_ac4_hum15 = $cluster_ac4_hum16 = $cluster_ac4_hum17 = $cluster_ac4_hum18 = $cluster_ac4_hum19 = $cluster_ac4_hum20 = $cluster_ac4_hum21 = "";
$cluster_ac4_hum22 = $cluster_ac4_hum23 = $cluster_ac4_hum0 = $cluster_ac4_hum1 = $cluster_ac4_hum2 = $cluster_ac4_hum3 = $cluster_ac4_hum4 =  $cluster_ac4_hum5 = "";

$hpc_room_temp6 = $hpc_room_temp7 = $hpc_room_temp8 = $hpc_room_temp9 = $hpc_room_temp10 = $hpc_room_temp11 = $hpc_room_temp12 =$hpc_room_temp13 = "";
$hpc_room_temp14 = $hpc_room_temp15 = $hpc_room_temp16 = $hpc_room_temp17 = $hpc_room_temp18 = $hpc_room_temp19 = $hpc_room_temp20 = $hpc_room_temp21 = "";
$hpc_room_temp22 = $hpc_room_temp23 = $hpc_room_temp0 = $hpc_room_temp1 = $hpc_room_temp2 = $hpc_room_temp3 = $hpc_room_temp4 =  $hpc_room_temp5 = "";

$io_room_temp6 = $io_room_temp7 = $io_room_temp8 = $io_room_temp9 = $io_room_temp10 = $io_room_temp11 = $io_room_temp12 =$io_room_temp13 = "";
$io_room_temp14 = $io_room_temp15 = $io_room_temp16 = $io_room_temp17 = $io_room_temp18 = $io_room_temp19 = $io_room_temp20 = $io_room_temp21 = "";
$io_room_temp22 = $io_room_temp23 = $io_room_temp0 = $io_room_temp1 = $io_room_temp2 = $io_room_temp3 = $io_room_temp4 =  $io_room_temp5 = "";

$anunet_room_temp6 = $anunet_room_temp7 = $anunet_room_temp8 = $anunet_room_temp9 = $anunet_room_temp10 = $anunet_room_temp11 = $anunet_room_temp12 =$anunet_room_temp13 = "";
$anunet_room_temp14 = $anunet_room_temp15 = $anunet_room_temp16 = $anunet_room_temp17 = $anunet_room_temp18 = $anunet_room_temp19 = $anunet_room_temp20 = $anunet_room_temp21 = "";
$anunet_room_temp22 = $anunet_room_temp23 = $anunet_room_temp0 = $anunet_room_temp1 = $anunet_room_temp2 = $anunet_room_temp3 = $anunet_room_temp4 =  $anunet_room_temp5 = "";

$hpc_status6 = $hpc_status7 = $hpc_status8 = $hpc_status9 = $hpc_status10 = $hpc_status11 = $hpc_status12 =$hpc_status13 = "";
$hpc_status14 = $hpc_status15 = $hpc_status16 = $hpc_status17 = $hpc_status18 = $hpc_status19 = $hpc_status20 = $hpc_status21 = "";
$hpc_status22 = $hpc_status23 = $hpc_status0 = $hpc_status1 = $hpc_status2 = $hpc_status3 = $hpc_status4 =  $hpc_status5 = "";

$workstation_status6 = $workstation_status7 = $workstation_status8 = $workstation_status9 = $workstation_status10 = $workstation_status11 = $workstation_status12 =$workstation_status13 = "";
$workstation_status14 = $workstation_status15 = $workstation_status16 = $workstation_status17 = $workstation_status18 = $workstation_status19 = $workstation_status20 = $workstation_status21 = "";
$workstation_status22 = $workstation_status23 = $workstation_status0 = $workstation_status1 = $workstation_status2 = $workstation_status3 = $workstation_status4 =  $workstation_status5 = "";

$email_server_status6 = $email_server_status7 = $email_server_status8 = $email_server_status9 = $email_server_status10 = $email_server_status11 = $email_server_status12 =$email_server_status13 = "";
$email_server_status14 = $email_server_status15 = $email_server_status16 = $email_server_status17 = $email_server_status18 = $email_server_status19 = $email_server_status20 = $email_server_status21 = "";
$email_server_status22 = $email_server_status23 = $email_server_status0 = $email_server_status1 = $email_server_status2 = $email_server_status3 = $email_server_status4 =  $email_server_status5 = "";

$inter_intra_status6 = $inter_intra_status7 = $inter_intra_status8 = $inter_intra_status9 = $inter_intra_status10 = $inter_intra_status11 = $inter_intra_status12 =$inter_intra_status13 = "";
$inter_intra_status14 = $inter_intra_status15 = $inter_intra_status16 = $inter_intra_status17 = $inter_intra_status18 = $inter_intra_status19 = $inter_intra_status20 = $inter_intra_status21 = "";
$inter_intra_status22 = $inter_intra_status23 = $inter_intra_status0 = $inter_intra_status1 = $inter_intra_status2 = $inter_intra_status3 = $inter_intra_status4 =  $inter_intra_status5 = "";

$ups_status6 = $ups_status7 = $ups_status8 = $ups_status9 = $ups_status10 = $ups_status11 = $ups_status12 =$ups_status13 = "";
$ups_status14 = $ups_status15 = $ups_status16 = $ups_status17 = $ups_status18 = $ups_status19 = $ups_status20 = $ups_status21 = "";
$ups_status22 = $ups_status23 = $ups_status0 = $ups_status1 = $ups_status2 = $ups_status3 = $ups_status4 =  $ups_status5 = "";

$switch_status6 = $switch_status7 = $switch_status8 = $switch_status9 = $switch_status10 = $switch_status11 = $switch_status12 =$switch_status13 = "";
$switch_status14 = $switch_status15 = $switch_status16 = $switch_status17 = $switch_status18 = $switch_status19 = $switch_status20 = $switch_status21 = "";
$switch_status22 = $switch_status23 = $switch_status0 = $switch_status1 = $switch_status2 = $switch_status3 = $switch_status4 =  $switch_status5 = "";

$log_date = date("Y-m-d");



//data base login

   $dbhost = 'localhost';

   $dbuser = 'root';

   $dbpass = '';

   $conn = mysql_connect($dbhost, $dbuser, $dbpass);

   if(! $conn ){

        die('Could not connect: ' . mysql_error());
   }

   echo 'Connected successfully';

mysql_select_db('rtc_shift_log'); // select the database



$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '6:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $ivy_temp6 = test_input($_POST["ivy_temp6"]);
   $ivy_hum6 = test_input($_POST["ivy_hum6"]);
   $cluster_ac1_temp6 = test_input( $_POST["cluster_ac1_temp6"]);
   $cluster_ac1_hum6 = test_input( $_POST["cluster_ac1_hum6"]);
   $cluster_ac2_temp6 = test_input($_POST["cluster_ac2_temp6"]);
   $cluster_ac2_hum6 = test_input($_POST["cluster_ac2_hum6"]);
   $cluster_ac3_temp6 = test_input( $_POST["cluster_ac3_temp6"]);
   $cluster_ac3_hum6 = test_input( $_POST["cluster_ac3_hum6"]);
   $cluster_ac4_temp6 = test_input( $_POST["cluster_ac4_temp6"]);
   $cluster_ac4_hum6 = test_input( $_POST["cluster_ac4_hum6"]);
   $hpc_room_temp6 = test_input( $_POST["hpc_room_temp6"]);
   $io_room_temp6 = test_input( $_POST["io_room_temp6"]);
   $anunet_room_temp6 = test_input( $_POST["anunet_room_temp6"]);
   $hpc_status6 = test_input( $_POST["hpc_status6"]);
   $workstation_status6 = test_input( $_POST["workstation_status6"]);
   $email_server_status6 = test_input( $_POST["email_server_status6"]);
   $inter_intra_status6 = test_input( $_POST["inter_intra_status6"]);
   $ups_status6 = test_input( $_POST["ups_status6"]);
   $switch_status6 = test_input( $_POST["switch_status6"]);
}

}




$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '7:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $ivy_temp7 = test_input($_POST["ivy_temp7"]);
   $ivy_hum7 = test_input($_POST["ivy_hum7"]);
   $cluster_ac1_temp7 = test_input( $_POST["cluster_ac1_temp7"]);
   $cluster_ac1_hum7 = test_input( $_POST["cluster_ac1_hum7"]);
   $cluster_ac2_temp7 = test_input($_POST["cluster_ac2_temp7"]);
   $cluster_ac2_hum7 = test_input($_POST["cluster_ac2_hum7"]);
   $cluster_ac3_temp7 = test_input( $_POST["cluster_ac3_temp7"]);
   $cluster_ac3_hum7 = test_input( $_POST["cluster_ac3_hum7"]);
   $cluster_ac4_temp7 = test_input( $_POST["cluster_ac4_temp7"]);
   $cluster_ac4_hum7 = test_input( $_POST["cluster_ac4_hum7"]);
   $hpc_room_temp7 = test_input( $_POST["hpc_room_temp7"]);
   $io_room_temp7 = test_input( $_POST["io_room_temp7"]);
   $anunet_room_temp7 = test_input( $_POST["anunet_room_temp7"]);
   $hpc_status7 = test_input( $_POST["hpc_status7"]);
   $workstation_status7 = test_input( $_POST["workstation_status7"]);
   $email_server_status7 = test_input( $_POST["email_server_status7"]);
   $inter_intra_status7 = test_input( $_POST["inter_intra_status7"]);
   $ups_status7 = test_input( $_POST["ups_status7"]);
   $switch_status7 = test_input( $_POST["switch_status7"]);
}
}


$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '8:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp8 = test_input($_POST["ivy_temp8"]);
   $ivy_hum8 = test_input($_POST["ivy_hum8"]);
   $cluster_ac1_temp8 = test_input( $_POST["cluster_ac1_temp8"]);
   $cluster_ac1_hum8 = test_input( $_POST["cluster_ac1_hum8"]);
   $cluster_ac2_temp8 = test_input($_POST["cluster_ac2_temp8"]);
   $cluster_ac2_hum8 = test_input($_POST["cluster_ac2_hum8"]);
   $cluster_ac3_temp8 = test_input( $_POST["cluster_ac3_temp8"]);
   $cluster_ac3_hum8 = test_input( $_POST["cluster_ac3_hum8"]);
   $cluster_ac4_temp8 = test_input( $_POST["cluster_ac4_temp8"]);
   $cluster_ac4_hum8 = test_input( $_POST["cluster_ac4_hum8"]);
   $hpc_room_temp8 = test_input( $_POST["hpc_room_temp8"]);
   $io_room_temp8 = test_input( $_POST["io_room_temp8"]);
   $anunet_room_temp8 = test_input( $_POST["anunet_room_temp8"]);
   $hpc_status8 = test_input( $_POST["hpc_status8"]);
   $workstation_status8 = test_input( $_POST["workstation_status8"]);
   $email_server_status8 = test_input( $_POST["email_server_status8"]);
   $inter_intra_status8 = test_input( $_POST["inter_intra_status8"]);
   $ups_status8 = test_input( $_POST["ups_status8"]);
   $switch_status8 = test_input( $_POST["switch_status8"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '9:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp9 = test_input($_POST["ivy_temp9"]);
   $ivy_hum9 = test_input($_POST["ivy_hum9"]);
   $cluster_ac1_temp9 = test_input( $_POST["cluster_ac1_temp9"]);
   $cluster_ac1_hum9 = test_input( $_POST["cluster_ac1_hum9"]);
   $cluster_ac2_temp9 = test_input($_POST["cluster_ac2_temp9"]);
   $cluster_ac2_hum9 = test_input($_POST["cluster_ac2_hum9"]);
   $cluster_ac3_temp9 = test_input( $_POST["cluster_ac3_temp9"]);
   $cluster_ac3_hum9 = test_input( $_POST["cluster_ac3_hum9"]);
   $cluster_ac4_temp9 = test_input( $_POST["cluster_ac4_temp9"]);
   $cluster_ac4_hum9 = test_input( $_POST["cluster_ac4_hum9"]);
   $hpc_room_temp9 = test_input( $_POST["hpc_room_temp9"]);
   $io_room_temp9 = test_input( $_POST["io_room_temp9"]);
   $anunet_room_temp9 = test_input( $_POST["anunet_room_temp9"]);
   $hpc_status9 = test_input( $_POST["hpc_status9"]);
   $workstation_status9 = test_input( $_POST["workstation_status9"]);
   $email_server_status9 = test_input( $_POST["email_server_status9"]);
   $inter_intra_status9 = test_input( $_POST["inter_intra_status9"]);
   $ups_status9 = test_input( $_POST["ups_status9"]);
   $switch_status9 = test_input( $_POST["switch_status9"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '10:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp10 = test_input($_POST["ivy_temp10"]);
   $ivy_hum10 = test_input($_POST["ivy_hum10"]);
   $cluster_ac1_temp10 = test_input( $_POST["cluster_ac1_temp10"]);
   $cluster_ac1_hum10 = test_input( $_POST["cluster_ac1_hum10"]);
   $cluster_ac2_temp10 = test_input($_POST["cluster_ac2_temp10"]);
   $cluster_ac2_hum10 = test_input($_POST["cluster_ac2_hum10"]);
   $cluster_ac3_temp10 = test_input( $_POST["cluster_ac3_temp10"]);
   $cluster_ac3_hum10 = test_input( $_POST["cluster_ac3_hum10"]);
   $cluster_ac4_temp10 = test_input( $_POST["cluster_ac4_temp10"]);
   $cluster_ac4_hum10 = test_input( $_POST["cluster_ac4_hum10"]);
   $hpc_room_temp10 = test_input( $_POST["hpc_room_temp10"]);
   $io_room_temp10 = test_input( $_POST["io_room_temp10"]);
   $anunet_room_temp10 = test_input( $_POST["anunet_room_temp10"]);
   $hpc_status10 = test_input( $_POST["hpc_status10"]);
   $workstation_status10 = test_input( $_POST["workstation_status10"]);
   $email_server_status10 = test_input( $_POST["email_server_status10"]);
   $inter_intra_status10 = test_input( $_POST["inter_intra_status10"]);
   $ups_status10 = test_input( $_POST["ups_status10"]);
   $switch_status10 = test_input( $_POST["switch_status10"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '11:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp11 = test_input($_POST["ivy_temp11"]);
   $ivy_hum11 = test_input($_POST["ivy_hum11"]);
   $cluster_ac1_temp11 = test_input( $_POST["cluster_ac1_temp11"]);
   $cluster_ac1_hum11 = test_input( $_POST["cluster_ac1_hum11"]);
   $cluster_ac2_temp11 = test_input($_POST["cluster_ac2_temp11"]);
   $cluster_ac2_hum11 = test_input($_POST["cluster_ac2_hum11"]);
   $cluster_ac3_temp11 = test_input( $_POST["cluster_ac3_temp11"]);
   $cluster_ac3_hum11 = test_input( $_POST["cluster_ac3_hum11"]);
   $cluster_ac4_temp11 = test_input( $_POST["cluster_ac4_temp11"]);
   $cluster_ac4_hum11 = test_input( $_POST["cluster_ac4_hum11"]);
   $hpc_room_temp11 = test_input( $_POST["hpc_room_temp11"]);
   $io_room_temp11 = test_input( $_POST["io_room_temp11"]);
   $anunet_room_temp11 = test_input( $_POST["anunet_room_temp11"]);
   $hpc_status11 = test_input( $_POST["hpc_status11"]);
   $workstation_status11 = test_input( $_POST["workstation_status11"]);
   $email_server_status11 = test_input( $_POST["email_server_status11"]);
   $inter_intra_status11 = test_input( $_POST["inter_intra_status11"]);
   $ups_status11 = test_input( $_POST["ups_status11"]);
   $switch_status11 = test_input( $_POST["switch_status11"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '12:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp12 = test_input($_POST["ivy_temp12"]);
   $ivy_hum12 = test_input($_POST["ivy_hum12"]);
   $cluster_ac1_temp12 = test_input( $_POST["cluster_ac1_temp12"]);
   $cluster_ac1_hum12 = test_input( $_POST["cluster_ac1_hum12"]);
   $cluster_ac2_temp12 = test_input($_POST["cluster_ac2_temp12"]);
   $cluster_ac2_hum12 = test_input($_POST["cluster_ac2_hum12"]);
   $cluster_ac3_temp12 = test_input( $_POST["cluster_ac3_temp12"]);
   $cluster_ac3_hum12 = test_input( $_POST["cluster_ac3_hum12"]);
   $cluster_ac4_temp12 = test_input( $_POST["cluster_ac4_temp12"]);
   $cluster_ac4_hum12 = test_input( $_POST["cluster_ac4_hum12"]);
   $hpc_room_temp12 = test_input( $_POST["hpc_room_temp12"]);
   $io_room_temp12 = test_input( $_POST["io_room_temp12"]);
   $anunet_room_temp12 = test_input( $_POST["anunet_room_temp12"]);
   $hpc_status12 = test_input( $_POST["hpc_status12"]);
   $workstation_status12 = test_input( $_POST["workstation_status12"]);
   $email_server_status12 = test_input( $_POST["email_server_status12"]);
   $inter_intra_status12 = test_input( $_POST["inter_intra_status12"]);
   $ups_status12 = test_input( $_POST["ups_status12"]);
   $switch_status12 = test_input( $_POST["switch_status12"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '13:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp13 = test_input($_POST["ivy_temp13"]);
   $ivy_hum13 = test_input($_POST["ivy_hum13"]);
   $cluster_ac1_temp13 = test_input( $_POST["cluster_ac1_temp13"]);
   $cluster_ac1_hum13 = test_input( $_POST["cluster_ac1_hum13"]);
   $cluster_ac2_temp13 = test_input($_POST["cluster_ac2_temp13"]);
   $cluster_ac2_hum13 = test_input($_POST["cluster_ac2_hum13"]);
   $cluster_ac3_temp13 = test_input( $_POST["cluster_ac3_temp13"]);
   $cluster_ac3_hum13 = test_input( $_POST["cluster_ac3_hum13"]);
   $cluster_ac4_temp13 = test_input( $_POST["cluster_ac4_temp13"]);
   $cluster_ac4_hum13 = test_input( $_POST["cluster_ac4_hum13"]);
   $hpc_room_temp13 = test_input( $_POST["hpc_room_temp13"]);
   $io_room_temp13 = test_input( $_POST["io_room_temp13"]);
   $anunet_room_temp13 = test_input( $_POST["anunet_room_temp13"]);
   $hpc_status13 = test_input( $_POST["hpc_status13"]);
   $workstation_status13 = test_input( $_POST["workstation_status13"]);
   $email_server_status13 = test_input( $_POST["email_server_status13"]);
   $inter_intra_status13 = test_input( $_POST["inter_intra_status13"]);
   $ups_status13 = test_input( $_POST["ups_status13"]);
   $switch_status13 = test_input( $_POST["switch_status13"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '14:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp14 = test_input($_POST["ivy_temp14"]);
   $ivy_hum14 = test_input($_POST["ivy_hum14"]);
   $cluster_ac1_temp14 = test_input( $_POST["cluster_ac1_temp14"]);
   $cluster_ac1_hum14 = test_input( $_POST["cluster_ac1_hum14"]);
   $cluster_ac2_temp14 = test_input($_POST["cluster_ac2_temp14"]);
   $cluster_ac2_hum14 = test_input($_POST["cluster_ac2_hum14"]);
   $cluster_ac3_temp14 = test_input( $_POST["cluster_ac3_temp14"]);
   $cluster_ac3_hum14 = test_input( $_POST["cluster_ac3_hum14"]);
   $cluster_ac4_temp14 = test_input( $_POST["cluster_ac4_temp14"]);
   $cluster_ac4_hum14 = test_input( $_POST["cluster_ac4_hum14"]);
   $hpc_room_temp14 = test_input( $_POST["hpc_room_temp14"]);
   $io_room_temp14 = test_input( $_POST["io_room_temp14"]);
   $anunet_room_temp14 = test_input( $_POST["anunet_room_temp14"]);
   $hpc_status14 = test_input( $_POST["hpc_status14"]);
   $workstation_status14 = test_input( $_POST["workstation_status14"]);
   $email_server_status14 = test_input( $_POST["email_server_status14"]);
   $inter_intra_status14 = test_input( $_POST["inter_intra_status14"]);
   $ups_status14 = test_input( $_POST["ups_status14"]);
   $switch_status14 = test_input( $_POST["switch_status14"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '15:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp15 = test_input($_POST["ivy_temp15"]);
   $ivy_hum15 = test_input($_POST["ivy_hum15"]);
   $cluster_ac1_temp15 = test_input( $_POST["cluster_ac1_temp15"]);
   $cluster_ac1_hum15 = test_input( $_POST["cluster_ac1_hum15"]);
   $cluster_ac2_temp15 = test_input($_POST["cluster_ac2_temp15"]);
   $cluster_ac2_hum15 = test_input($_POST["cluster_ac2_hum15"]);
   $cluster_ac3_temp15 = test_input( $_POST["cluster_ac3_temp15"]);
   $cluster_ac3_hum15 = test_input( $_POST["cluster_ac3_hum15"]);
   $cluster_ac4_temp15 = test_input( $_POST["cluster_ac4_temp15"]);
   $cluster_ac4_hum15 = test_input( $_POST["cluster_ac4_hum15"]);
   $hpc_room_temp15 = test_input( $_POST["hpc_room_temp15"]);
   $io_room_temp15 = test_input( $_POST["io_room_temp15"]);
   $anunet_room_temp15 = test_input( $_POST["anunet_room_temp15"]);
   $hpc_status15 = test_input( $_POST["hpc_status15"]);
   $workstation_status15 = test_input( $_POST["workstation_status15"]);
   $email_server_status15 = test_input( $_POST["email_server_status15"]);
   $inter_intra_status15 = test_input( $_POST["inter_intra_status15"]);
   $ups_status15 = test_input( $_POST["ups_status15"]);
   $switch_status15 = test_input( $_POST["switch_status15"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '16:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp16 = test_input($_POST["ivy_temp16"]);
   $ivy_hum16 = test_input($_POST["ivy_hum16"]);
   $cluster_ac1_temp16 = test_input( $_POST["cluster_ac1_temp16"]);
   $cluster_ac1_hum16 = test_input( $_POST["cluster_ac1_hum16"]);
   $cluster_ac2_temp16 = test_input($_POST["cluster_ac2_temp16"]);
   $cluster_ac2_hum16 = test_input($_POST["cluster_ac2_hum16"]);
   $cluster_ac3_temp16 = test_input( $_POST["cluster_ac3_temp16"]);
   $cluster_ac3_hum16 = test_input( $_POST["cluster_ac3_hum16"]);
   $cluster_ac4_temp16 = test_input( $_POST["cluster_ac4_temp16"]);
   $cluster_ac4_hum16 = test_input( $_POST["cluster_ac4_hum16"]);
   $hpc_room_temp16 = test_input( $_POST["hpc_room_temp16"]);
   $io_room_temp16 = test_input( $_POST["io_room_temp16"]);
   $anunet_room_temp16 = test_input( $_POST["anunet_room_temp16"]);
   $hpc_status16 = test_input( $_POST["hpc_status16"]);
   $workstation_status16 = test_input( $_POST["workstation_status16"]);
   $email_server_status16 = test_input( $_POST["email_server_status16"]);
   $inter_intra_status16 = test_input( $_POST["inter_intra_status16"]);
   $ups_status16 = test_input( $_POST["ups_status16"]);
   $switch_status16 = test_input( $_POST["switch_status16"]);
}
}


$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '17:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp17 = test_input($_POST["ivy_temp17"]);
   $ivy_hum17 = test_input($_POST["ivy_hum17"]);
   $cluster_ac1_temp17 = test_input( $_POST["cluster_ac1_temp17"]);
   $cluster_ac1_hum17 = test_input( $_POST["cluster_ac1_hum17"]);
   $cluster_ac2_temp17 = test_input($_POST["cluster_ac2_temp17"]);
   $cluster_ac2_hum17 = test_input($_POST["cluster_ac2_hum17"]);
   $cluster_ac3_temp17 = test_input( $_POST["cluster_ac3_temp17"]);
   $cluster_ac3_hum17 = test_input( $_POST["cluster_ac3_hum17"]);
   $cluster_ac4_temp17 = test_input( $_POST["cluster_ac4_temp17"]);
   $cluster_ac4_hum17 = test_input( $_POST["cluster_ac4_hum17"]);
   $hpc_room_temp17 = test_input( $_POST["hpc_room_temp17"]);
   $io_room_temp17 = test_input( $_POST["io_room_temp17"]);
   $anunet_room_temp17 = test_input( $_POST["anunet_room_temp17"]);
   $hpc_status17 = test_input( $_POST["hpc_status17"]);
   $workstation_status17 = test_input( $_POST["workstation_status17"]);
   $email_server_status17 = test_input( $_POST["email_server_status17"]);
   $inter_intra_status17 = test_input( $_POST["inter_intra_status17"]);
   $ups_status17 = test_input( $_POST["ups_status17"]);
   $switch_status17 = test_input( $_POST["switch_status17"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '18:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp18 = test_input($_POST["ivy_temp18"]);
   $ivy_hum18 = test_input($_POST["ivy_hum18"]);
   $cluster_ac1_temp18 = test_input( $_POST["cluster_ac1_temp18"]);
   $cluster_ac1_hum18 = test_input( $_POST["cluster_ac1_hum18"]);
   $cluster_ac2_temp18 = test_input($_POST["cluster_ac2_temp18"]);
   $cluster_ac2_hum18 = test_input($_POST["cluster_ac2_hum18"]);
   $cluster_ac3_temp18 = test_input( $_POST["cluster_ac3_temp18"]);
   $cluster_ac3_hum18 = test_input( $_POST["cluster_ac3_hum18"]);
   $cluster_ac4_temp18 = test_input( $_POST["cluster_ac4_temp18"]);
   $cluster_ac4_hum18 = test_input( $_POST["cluster_ac4_hum18"]);
   $hpc_room_temp18 = test_input( $_POST["hpc_room_temp18"]);
   $io_room_temp18 = test_input( $_POST["io_room_temp18"]);
   $anunet_room_temp18 = test_input( $_POST["anunet_room_temp18"]);
   $hpc_status18 = test_input( $_POST["hpc_status18"]);
   $workstation_status18 = test_input( $_POST["workstation_status18"]);
   $email_server_status18 = test_input( $_POST["email_server_status18"]);
   $inter_intra_status18 = test_input( $_POST["inter_intra_status18"]);
   $ups_status18 = test_input( $_POST["ups_status18"]);
   $switch_status18 = test_input( $_POST["switch_status18"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '19:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp19 = test_input($_POST["ivy_temp19"]);
   $ivy_hum19 = test_input($_POST["ivy_hum19"]);
   $cluster_ac1_temp19 = test_input( $_POST["cluster_ac1_temp19"]);
   $cluster_ac1_hum19 = test_input( $_POST["cluster_ac1_hum19"]);
   $cluster_ac2_temp19 = test_input($_POST["cluster_ac2_temp19"]);
   $cluster_ac2_hum19 = test_input($_POST["cluster_ac2_hum19"]);
   $cluster_ac3_temp19 = test_input( $_POST["cluster_ac3_temp19"]);
   $cluster_ac3_hum19 = test_input( $_POST["cluster_ac3_hum19"]);
   $cluster_ac4_temp19 = test_input( $_POST["cluster_ac4_temp19"]);
   $cluster_ac4_hum19 = test_input( $_POST["cluster_ac4_hum19"]);
   $hpc_room_temp19 = test_input( $_POST["hpc_room_temp19"]);
   $io_room_temp19 = test_input( $_POST["io_room_temp19"]);
   $anunet_room_temp19 = test_input( $_POST["anunet_room_temp19"]);
   $hpc_status19 = test_input( $_POST["hpc_status19"]);
   $workstation_status19 = test_input( $_POST["workstation_status19"]);
   $email_server_status19 = test_input( $_POST["email_server_status19"]);
   $inter_intra_status19 = test_input( $_POST["inter_intra_status19"]);
   $ups_status19 = test_input( $_POST["ups_status19"]);
   $switch_status19 = test_input( $_POST["switch_status19"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '20:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp20 = test_input($_POST["ivy_temp20"]);
   $ivy_hum20 = test_input($_POST["ivy_hum20"]);
   $cluster_ac1_temp20 = test_input( $_POST["cluster_ac1_temp20"]);
   $cluster_ac1_hum20 = test_input( $_POST["cluster_ac1_hum20"]);
   $cluster_ac2_temp20 = test_input($_POST["cluster_ac2_temp20"]);
   $cluster_ac2_hum20 = test_input($_POST["cluster_ac2_hum20"]);
   $cluster_ac3_temp20 = test_input( $_POST["cluster_ac3_temp20"]);
   $cluster_ac3_hum20 = test_input( $_POST["cluster_ac3_hum20"]);
   $cluster_ac4_temp20 = test_input( $_POST["cluster_ac4_temp20"]);
   $cluster_ac4_hum20 = test_input( $_POST["cluster_ac4_hum20"]);
   $hpc_room_temp20 = test_input( $_POST["hpc_room_temp20"]);
   $io_room_temp20 = test_input( $_POST["io_room_temp20"]);
   $anunet_room_temp20 = test_input( $_POST["anunet_room_temp20"]);
   $hpc_status20 = test_input( $_POST["hpc_status20"]);
   $workstation_status20 = test_input( $_POST["workstation_status20"]);
   $email_server_status20 = test_input( $_POST["email_server_status20"]);
   $inter_intra_status20 = test_input( $_POST["inter_intra_status20"]);
   $ups_status20 = test_input( $_POST["ups_status20"]);
   $switch_status20 = test_input( $_POST["switch_status20"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '21:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp21 = test_input($_POST["ivy_temp21"]);
   $ivy_hum21 = test_input($_POST["ivy_hum21"]);
   $cluster_ac1_temp21 = test_input( $_POST["cluster_ac1_temp21"]);
   $cluster_ac1_hum21 = test_input( $_POST["cluster_ac1_hum21"]);
   $cluster_ac2_temp21 = test_input($_POST["cluster_ac2_temp21"]);
   $cluster_ac2_hum21 = test_input($_POST["cluster_ac2_hum21"]);
   $cluster_ac3_temp21 = test_input( $_POST["cluster_ac3_temp21"]);
   $cluster_ac3_hum21 = test_input( $_POST["cluster_ac3_hum21"]);
   $cluster_ac4_temp21 = test_input( $_POST["cluster_ac4_temp21"]);
   $cluster_ac4_hum21 = test_input( $_POST["cluster_ac4_hum21"]);
   $hpc_room_temp21 = test_input( $_POST["hpc_room_temp21"]);
   $io_room_temp21 = test_input( $_POST["io_room_temp21"]);
   $anunet_room_temp21 = test_input( $_POST["anunet_room_temp21"]);
   $hpc_status21 = test_input( $_POST["hpc_status21"]);
   $workstation_status21 = test_input( $_POST["workstation_status21"]);
   $email_server_status21 = test_input( $_POST["email_server_status21"]);
   $inter_intra_status21 = test_input( $_POST["inter_intra_status21"]);
   $ups_status21 = test_input( $_POST["ups_status21"]);
   $switch_status21 = test_input( $_POST["switch_status21"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '22:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp22 = test_input($_POST["ivy_temp22"]);
   $ivy_hum22 = test_input($_POST["ivy_hum22"]);
   $cluster_ac1_temp22 = test_input( $_POST["cluster_ac1_temp22"]);
   $cluster_ac1_hum22 = test_input( $_POST["cluster_ac1_hum22"]);
   $cluster_ac2_temp22 = test_input($_POST["cluster_ac2_temp22"]);
   $cluster_ac2_hum22 = test_input($_POST["cluster_ac2_hum22"]);
   $cluster_ac3_temp22 = test_input( $_POST["cluster_ac3_temp22"]);
   $cluster_ac3_hum22 = test_input( $_POST["cluster_ac3_hum22"]);
   $cluster_ac4_temp22 = test_input( $_POST["cluster_ac4_temp22"]);
   $cluster_ac4_hum22 = test_input( $_POST["cluster_ac4_hum22"]);
   $hpc_room_temp22 = test_input( $_POST["hpc_room_temp22"]);
   $io_room_temp22 = test_input( $_POST["io_room_temp22"]);
   $anunet_room_temp22 = test_input( $_POST["anunet_room_temp22"]);
   $hpc_status22 = test_input( $_POST["hpc_status22"]);
   $workstation_status22 = test_input( $_POST["workstation_status22"]);
   $email_server_status22 = test_input( $_POST["email_server_status22"]);
   $inter_intra_status22 = test_input( $_POST["inter_intra_status22"]);
   $ups_status22 = test_input( $_POST["ups_status22"]);
   $switch_status22 = test_input( $_POST["switch_status22"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '23:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp23 = test_input($_POST["ivy_temp23"]);
   $ivy_hum23 = test_input($_POST["ivy_hum23"]);
   $cluster_ac1_temp23 = test_input( $_POST["cluster_ac1_temp23"]);
   $cluster_ac1_hum23 = test_input( $_POST["cluster_ac1_hum23"]);
   $cluster_ac2_temp23 = test_input($_POST["cluster_ac2_temp23"]);
   $cluster_ac2_hum23 = test_input($_POST["cluster_ac2_hum23"]);
   $cluster_ac3_temp23 = test_input( $_POST["cluster_ac3_temp23"]);
   $cluster_ac3_hum23 = test_input( $_POST["cluster_ac3_hum23"]);
   $cluster_ac4_temp23 = test_input( $_POST["cluster_ac4_temp23"]);
   $cluster_ac4_hum23 = test_input( $_POST["cluster_ac4_hum23"]);
   $hpc_room_temp23 = test_input( $_POST["hpc_room_temp23"]);
   $io_room_temp23 = test_input( $_POST["io_room_temp23"]);
   $anunet_room_temp23 = test_input( $_POST["anunet_room_temp23"]);
   $hpc_status23 = test_input( $_POST["hpc_status23"]);
   $workstation_status23 = test_input( $_POST["workstation_status23"]);
   $email_server_status23 = test_input( $_POST["email_server_status23"]);
   $inter_intra_status23 = test_input( $_POST["inter_intra_status23"]);
   $ups_status23 = test_input( $_POST["ups_status23"]);
   $switch_status23 = test_input( $_POST["switch_status23"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '0:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp0 = test_input($_POST["ivy_temp0"]);
   $ivy_hum0 = test_input($_POST["ivy_hum0"]);
   $cluster_ac1_temp0 = test_input( $_POST["cluster_ac1_temp0"]);
   $cluster_ac1_hum0 = test_input( $_POST["cluster_ac1_hum0"]);
   $cluster_ac2_temp0 = test_input($_POST["cluster_ac2_temp0"]);
   $cluster_ac2_hum0 = test_input($_POST["cluster_ac2_hum0"]);
   $cluster_ac3_temp0 = test_input( $_POST["cluster_ac3_temp0"]);
   $cluster_ac3_hum0 = test_input( $_POST["cluster_ac3_hum0"]);
   $cluster_ac4_temp0 = test_input( $_POST["cluster_ac4_temp0"]);
   $cluster_ac4_hum0 = test_input( $_POST["cluster_ac4_hum0"]);
   $hpc_room_temp0 = test_input( $_POST["hpc_room_temp0"]);
   $io_room_temp0 = test_input( $_POST["io_room_temp0"]);
   $anunet_room_temp0 = test_input( $_POST["anunet_room_temp0"]);
   $hpc_status0 = test_input( $_POST["hpc_status0"]);
   $workstation_status0 = test_input( $_POST["workstation_status0"]);
   $email_server_status0 = test_input( $_POST["email_server_status0"]);
   $inter_intra_status0 = test_input( $_POST["inter_intra_status0"]);
   $ups_status0 = test_input( $_POST["ups_status0"]);
   $switch_status0 = test_input( $_POST["switch_status0"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '1:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp1 = test_input($_POST["ivy_temp1"]);
   $ivy_hum1 = test_input($_POST["ivy_hum1"]);
   $cluster_ac1_temp1 = test_input( $_POST["cluster_ac1_temp1"]);
   $cluster_ac1_hum1 = test_input( $_POST["cluster_ac1_hum1"]);
   $cluster_ac2_temp1 = test_input($_POST["cluster_ac2_temp1"]);
   $cluster_ac2_hum1 = test_input($_POST["cluster_ac2_hum1"]);
   $cluster_ac3_temp1 = test_input( $_POST["cluster_ac3_temp1"]);
   $cluster_ac3_hum1 = test_input( $_POST["cluster_ac3_hum1"]);
   $cluster_ac4_temp1 = test_input( $_POST["cluster_ac4_temp1"]);
   $cluster_ac4_hum1 = test_input( $_POST["cluster_ac4_hum1"]);
   $hpc_room_temp1 = test_input( $_POST["hpc_room_temp1"]);
   $io_room_temp1 = test_input( $_POST["io_room_temp1"]);
   $anunet_room_temp1 = test_input( $_POST["anunet_room_temp1"]);
   $hpc_status1 = test_input( $_POST["hpc_status1"]);
   $workstation_status1 = test_input( $_POST["workstation_status1"]);
   $email_server_status1 = test_input( $_POST["email_server_status1"]);
   $inter_intra_status1 = test_input( $_POST["inter_intra_status1"]);
   $ups_status1 = test_input( $_POST["ups_status1"]);
   $switch_status1 = test_input( $_POST["switch_status1"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '2:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp2 = test_input($_POST["ivy_temp2"]);
   $ivy_hum2 = test_input($_POST["ivy_hum2"]);
   $cluster_ac1_temp2 = test_input( $_POST["cluster_ac1_temp2"]);
   $cluster_ac1_hum2 = test_input( $_POST["cluster_ac1_hum2"]);
   $cluster_ac2_temp2 = test_input($_POST["cluster_ac2_temp2"]);
   $cluster_ac2_hum2 = test_input($_POST["cluster_ac2_hum2"]);
   $cluster_ac3_temp2 = test_input( $_POST["cluster_ac3_temp2"]);
   $cluster_ac3_hum2 = test_input( $_POST["cluster_ac3_hum2"]);
   $cluster_ac4_temp2 = test_input( $_POST["cluster_ac4_temp2"]);
   $cluster_ac4_hum2 = test_input( $_POST["cluster_ac4_hum2"]);
   $hpc_room_temp2 = test_input( $_POST["hpc_room_temp2"]);
   $io_room_temp2 = test_input( $_POST["io_room_temp2"]);
   $anunet_room_temp2 = test_input( $_POST["anunet_room_temp2"]);
   $hpc_status2 = test_input( $_POST["hpc_status2"]);
   $workstation_status2 = test_input( $_POST["workstation_status2"]);
   $email_server_status2 = test_input( $_POST["email_server_status2"]);
   $inter_intra_status2 = test_input( $_POST["inter_intra_status2"]);
   $ups_status2 = test_input( $_POST["ups_status2"]);
   $switch_status2 = test_input( $_POST["switch_status2"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '3:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp3 = test_input($_POST["ivy_temp3"]);
   $ivy_hum3 = test_input($_POST["ivy_hum3"]);
   $cluster_ac1_temp3 = test_input( $_POST["cluster_ac1_temp3"]);
   $cluster_ac1_hum3 = test_input( $_POST["cluster_ac1_hum3"]);
   $cluster_ac2_temp3 = test_input($_POST["cluster_ac2_temp3"]);
   $cluster_ac2_hum3 = test_input($_POST["cluster_ac2_hum3"]);
   $cluster_ac3_temp3 = test_input( $_POST["cluster_ac3_temp3"]);
   $cluster_ac3_hum3 = test_input( $_POST["cluster_ac3_hum3"]);
   $cluster_ac4_temp3 = test_input( $_POST["cluster_ac4_temp3"]);
   $cluster_ac4_hum3 = test_input( $_POST["cluster_ac4_hum3"]);
   $hpc_room_temp3 = test_input( $_POST["hpc_room_temp3"]);
   $io_room_temp3 = test_input( $_POST["io_room_temp3"]);
   $anunet_room_temp3 = test_input( $_POST["anunet_room_temp3"]);
   $hpc_status3 = test_input( $_POST["hpc_status3"]);
   $workstation_status3 = test_input( $_POST["workstation_status3"]);
   $email_server_status3 = test_input( $_POST["email_server_status3"]);
   $inter_intra_status3 = test_input( $_POST["inter_intra_status3"]);
   $ups_status3 = test_input( $_POST["ups_status3"]);
   $switch_status3 = test_input( $_POST["switch_status3"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '4:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp4 = test_input($_POST["ivy_temp4"]);
   $ivy_hum4 = test_input($_POST["ivy_hum4"]);
   $cluster_ac1_temp4 = test_input( $_POST["cluster_ac1_temp4"]);
   $cluster_ac1_hum4 = test_input( $_POST["cluster_ac1_hum4"]);
   $cluster_ac2_temp4 = test_input($_POST["cluster_ac2_temp4"]);
   $cluster_ac2_hum4 = test_input($_POST["cluster_ac2_hum4"]);
   $cluster_ac3_temp4 = test_input( $_POST["cluster_ac3_temp4"]);
   $cluster_ac3_hum4 = test_input( $_POST["cluster_ac3_hum4"]);
   $cluster_ac4_temp4 = test_input( $_POST["cluster_ac4_temp4"]);
   $cluster_ac4_hum4 = test_input( $_POST["cluster_ac4_hum4"]);
   $hpc_room_temp4 = test_input( $_POST["hpc_room_temp4"]);
   $io_room_temp4 = test_input( $_POST["io_room_temp4"]);
   $anunet_room_temp4 = test_input( $_POST["anunet_room_temp4"]);
   $hpc_status4 = test_input( $_POST["hpc_status4"]);
   $workstation_status4 = test_input( $_POST["workstation_status4"]);
   $email_server_status4 = test_input( $_POST["email_server_status4"]);
   $inter_intra_status4 = test_input( $_POST["inter_intra_status4"]);
   $ups_status4 = test_input( $_POST["ups_status4"]);
   $switch_status4 = test_input( $_POST["switch_status4"]);
}
}

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' and time = '5:00' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
      $time[$i]     = $row['time'];
     
            
$i=$i+1;

}

$count = $i;  //found hard do not delete this line its counting rows;

if($count== 1){

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $ivy_temp5 = test_input($_POST["ivy_temp5"]);
   $ivy_hum5 = test_input($_POST["ivy_hum5"]);
   $cluster_ac1_temp5 = test_input( $_POST["cluster_ac1_temp5"]);
   $cluster_ac1_hum5 = test_input( $_POST["cluster_ac1_hum5"]);
   $cluster_ac2_temp5 = test_input($_POST["cluster_ac2_temp5"]);
   $cluster_ac2_hum5 = test_input($_POST["cluster_ac2_hum5"]);
   $cluster_ac3_temp5 = test_input( $_POST["cluster_ac3_temp5"]);
   $cluster_ac3_hum5 = test_input( $_POST["cluster_ac3_hum5"]);
   $cluster_ac4_temp5 = test_input( $_POST["cluster_ac4_temp5"]);
   $cluster_ac4_hum5 = test_input( $_POST["cluster_ac4_hum5"]);
   $hpc_room_temp5 = test_input( $_POST["hpc_room_temp5"]);
   $io_room_temp5 = test_input( $_POST["io_room_temp5"]);
   $anunet_room_temp5 = test_input( $_POST["anunet_room_temp5"]);
   $hpc_status5 = test_input( $_POST["hpc_status5"]);
   $workstation_status5 = test_input( $_POST["workstation_status5"]);
   $email_server_status5 = test_input( $_POST["email_server_status5"]);
   $inter_intra_status5 = test_input( $_POST["inter_intra_status5"]);
   $ups_status5 = test_input( $_POST["ups_status5"]);
   $switch_status5 = test_input( $_POST["switch_status5"]);
}
}


/*

  $ivy_hum = test_input($_POST["ivy_hum"]);
  $cluster_ac1_temp = test_input($_POST["cluster_ac1_temp"]);
  $cluster_ac1_hum = test_input($_POST["cluster_ac1_hum"]);
  $cluster_ac2_temp = test_input($_POST["cluster_ac2_temp"]);
  $cluster_ac2_hum = test_input($_POST["cluster_ac2_hum"]);
  $cluster_ac3_temp = test_input($_POST["cluster_ac3_temp"]);
  $cluster_ac3_hum = test_input($_POST["cluster_ac3_hum"]);
  $cluster_ac4_temp = test_input($_POST["cluster_ac4_temp"]);
  $cluster_ac4_hum = test_input($_POST["cluster_ac4_hum"]);
  $hpc_room_temp = test_input($_POST["hpc_room_temp"]);
  $io_room_temp = test_input($_POST["io_room_temp"]);
  $anunet_room_temp = test_input($_POST["anunet_room_temp"]);
  $hpc_status = test_input($_POST["hpc_status"]);
  $workstation_status = test_input($_POST["workstation_status"]);
  $email_server_status = test_input($_POST["email_server_status"]);
  $inter_intra_status = test_input($_POST["inter_intra_status"]);
  $ups_status = test_input($_POST["ups_status"]);
  $switch_status = test_input($_POST["switch_status"]);
  $remark = test_input($_POST["remark"]);
  $switch_status = test_input($_POST["switch_status"]);
*/






function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




$time = $ivy_temp = $ivy_hum = $cluster_ac1_temp = $cluster_ac1_hum = $cluster_ac2_temp = $cluster_ac2_hum = "";
$cluster_ac3_temp = $cluster_ac3_hum = $cluster_ac4_temp = $cluster_ac4_hum = $hpc_room_temp = $io_room_temp = "";
$anunet_room_temp = $hpc_status = $workstation_status = $email_server_status = $inter_intra_status = $ups_status = "";
$switch_status = $remark = "";

if($ivy_temp6 !== ""){
$ivy_temp=$ivy_temp6;
$time = "6:00";
}
if($ivy_temp7 !== ""){
$time = "7:00";
$ivy_temp=$ivy_temp7;
}
if($ivy_temp8 !== ""){
$time = "8:00";
$ivy_temp=$ivy_temp8;
}
if($ivy_temp9 !== ""){
$time = "9:00";
$ivy_temp=$ivy_temp9;
}
if($ivy_temp10 !== ""){
$time = "10:00";
$ivy_temp=$ivy_temp10;
}
if($ivy_temp11 !== ""){
$time = "11:00";
$ivy_temp=$ivy_temp11;
}
if($ivy_temp12 !== ""){
$time = "12:00";
$ivy_temp=$ivy_temp12;
}
if($ivy_temp13 !== ""){
$time = "13:00";
$ivy_temp=$ivy_temp13;
}
if($ivy_temp14 !== ""){
$time = "14:00";
$ivy_temp=$ivy_temp14;
}
if($ivy_temp15 !== ""){
$time = "15:00";
$ivy_temp=$ivy_temp15;
}
if($ivy_temp16 !== ""){
$time = "16:00";
$ivy_temp=$ivy_temp16;
}
if($ivy_temp17 !== ""){
$time = "17:00";
$ivy_temp=$ivy_temp17;
}
if($ivy_temp18 !== ""){
$time = "18:00";
$ivy_temp=$ivy_temp18;
}
if($ivy_temp19 !== ""){
$time = "19:00";
$ivy_temp=$ivy_temp19;
}
if($ivy_temp20 !== ""){
$time = "20:00";
$ivy_temp=$ivy_temp20;
}
if($ivy_temp21 !== ""){
$time = "21:00";
$ivy_temp=$ivy_temp21;
}
if($ivy_temp22 !== ""){
$time = "22:00";
$ivy_temp=$ivy_temp22;
}
if($ivy_temp23 !== ""){
$time = "23:00";
$ivy_temp=$ivy_temp23;
}
if($ivy_temp0 !== ""){
$time = "0:00";
$ivy_temp=$ivy_temp0;
}
if($ivy_temp1 !== ""){
$time = "1:00";
$ivy_temp=$ivy_temp1;
}
if($ivy_temp2 !== ""){
$time = "2:00";
$ivy_temp=$ivy_temp2;
}
if($ivy_temp3 !== ""){
$time = "3:00";
$ivy_temp=$ivy_temp3;
}
if($ivy_temp4 !== ""){
$time = "4:00";
$ivy_temp=$ivy_temp4;
}
if($ivy_temp5 !== ""){
$time = "5:00";
$ivy_temp=$ivy_temp5;
}


if($ivy_hum6 !== ""){
$ivy_hum=$ivy_hum6;
}
if($ivy_hum7 !== ""){
$ivy_hum=$ivy_hum7;
}
if($ivy_hum8 !== ""){
$ivy_hum=$ivy_hum8;
}
if($ivy_hum9 !== ""){
$ivy_hum=$ivy_hum9;
}
if($ivy_hum10 !== ""){
$ivy_hum=$ivy_hum10;
}
if($ivy_hum11 !== ""){
$ivy_hum=$ivy_hum11;
}
if($ivy_hum12 !== ""){
$ivy_hum=$ivy_hum12;
}
if($ivy_hum13 !== ""){
$ivy_hum=$ivy_hum13;
}
if($ivy_hum14 !== ""){
$ivy_hum=$ivy_hum14;
}
if($ivy_hum15 !== ""){
$ivy_hum=$ivy_hum15;
}
if($ivy_hum16 !== ""){
$ivy_hum=$ivy_hum16;
}
if($ivy_hum17 !== ""){
$ivy_hum=$ivy_hum17;
}
if($ivy_hum18 !== ""){
$ivy_hum=$ivy_hum18;
}
if($ivy_hum19 !== ""){
$ivy_hum=$ivy_hum19;
}
if($ivy_hum20 !== ""){
$ivy_hum=$ivy_hum20;
}
if($ivy_hum21 !== ""){
$ivy_hum=$ivy_hum21;
}
if($ivy_hum22 !== ""){
$ivy_hum=$ivy_hum22;
}
if($ivy_hum23 !== ""){
$ivy_hum=$ivy_hum23;
}
if($ivy_hum0 !== ""){
$ivy_hum=$ivy_hum0;
}
if($ivy_hum1 !== ""){
$ivy_hum=$ivy_hum1;
}
if($ivy_hum2 !== ""){
$ivy_hum=$ivy_hum2;
}
if($ivy_hum3 !== ""){
$ivy_hum=$ivy_hum3;
}
if($ivy_hum4 !== ""){
$ivy_hum=$ivy_hum4;
}
if($ivy_hum5 !== ""){
$ivy_hum=$ivy_hum5;
}

if($cluster_ac1_temp6 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp6;
}
if($cluster_ac1_temp7 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp7;
}
if($cluster_ac1_temp8 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp8;
}
if($cluster_ac1_temp9 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp9;
}
if($cluster_ac1_temp10 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp10;
}
if($cluster_ac1_temp11 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp11;
}
if($cluster_ac1_temp12 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp12;
}
if($cluster_ac1_temp13 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp13;
}
if($cluster_ac1_temp14 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp14;
}
if($cluster_ac1_temp15 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp15;
}
if($cluster_ac1_temp16 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp16;
}
if($cluster_ac1_temp17 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp17;
}
if($cluster_ac1_temp18 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp18;
}
if($cluster_ac1_temp19 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp19;
}
if($cluster_ac1_temp20 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp20;
}
if($cluster_ac1_temp21 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp21;
}
if($cluster_ac1_temp22 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp22;
}
if($cluster_ac1_temp23 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp23;
}
if($cluster_ac1_temp0 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp0;
}
if($cluster_ac1_temp1 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp1;
}
if($cluster_ac1_temp2 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp2;
}
if($cluster_ac1_temp3 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp3;
}
if($cluster_ac1_temp4 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp4;
}
if($cluster_ac1_temp5 !== ""){
$cluster_ac1_temp=$cluster_ac1_temp5;
}

if($cluster_ac1_hum6 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum6;
}
if($cluster_ac1_hum7 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum7;
}
if($cluster_ac1_hum8 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum8;
}
if($cluster_ac1_hum9 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum9;
}
if($cluster_ac1_hum10 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum10;
}
if($cluster_ac1_hum11 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum11;
}
if($cluster_ac1_hum12 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum12;
}
if($cluster_ac1_hum13 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum13;
}
if($cluster_ac1_hum14 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum14;
}
if($cluster_ac1_hum15 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum15;
}
if($cluster_ac1_hum16 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum16;
}
if($cluster_ac1_hum17 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum17;
}
if($cluster_ac1_hum18 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum18;
}
if($cluster_ac1_hum19 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum19;
}
if($cluster_ac1_hum20 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum20;
}
if($cluster_ac1_hum21 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum21;
}
if($cluster_ac1_hum22 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum22;
}
if($cluster_ac1_hum23 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum23;
}
if($cluster_ac1_hum0 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum0;
}
if($cluster_ac1_hum1 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum1;
}
if($cluster_ac1_hum2 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum2;
}
if($cluster_ac1_hum3 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum3;
}
if($cluster_ac1_hum4 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum4;
}
if($cluster_ac1_hum5 !== ""){
$cluster_ac1_hum=$cluster_ac1_hum5;
}

if($cluster_ac2_temp6 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp6;
}
if($cluster_ac2_temp7 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp7;
}
if($cluster_ac2_temp8 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp8;
}
if($cluster_ac2_temp9 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp9;
}
if($cluster_ac2_temp10 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp10;
}
if($cluster_ac2_temp11 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp11;
}
if($cluster_ac2_temp12 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp12;
}
if($cluster_ac2_temp13 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp13;
}
if($cluster_ac2_temp14 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp14;
}
if($cluster_ac2_temp15 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp15;
}
if($cluster_ac2_temp16 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp16;
}
if($cluster_ac2_temp17 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp17;
}
if($cluster_ac2_temp18 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp18;
}
if($cluster_ac2_temp19 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp19;
}
if($cluster_ac2_temp20 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp20;
}
if($cluster_ac2_temp21 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp21;
}
if($cluster_ac2_temp22 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp22;
}
if($cluster_ac2_temp23 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp23;
}
if($cluster_ac2_temp0 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp0;
}
if($cluster_ac2_temp1 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp1;
}
if($cluster_ac2_temp2 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp2;
}
if($cluster_ac2_temp3 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp3;
}
if($cluster_ac2_temp4 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp4;
}
if($cluster_ac2_temp5 !== ""){
$cluster_ac2_temp=$cluster_ac2_temp5;
}

if($cluster_ac2_hum6 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum6;
}
if($cluster_ac2_hum7 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum7;
}
if($cluster_ac2_hum8 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum8;
}
if($cluster_ac2_hum9 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum9;
}
if($cluster_ac2_hum10 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum10;
}
if($cluster_ac2_hum11 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum11;
}
if($cluster_ac2_hum12 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum12;
}
if($cluster_ac2_hum13 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum13;
}
if($cluster_ac2_hum14 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum14;
}
if($cluster_ac2_hum15 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum15;
}
if($cluster_ac2_hum16 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum16;
}
if($cluster_ac2_hum17 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum17;
}
if($cluster_ac2_hum18 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum18;
}
if($cluster_ac2_hum19 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum19;
}
if($cluster_ac2_hum20 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum20;
}
if($cluster_ac2_hum21 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum21;
}
if($cluster_ac2_hum22 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum22;
}
if($cluster_ac2_hum23 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum23;
}
if($cluster_ac2_hum0 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum0;
}
if($cluster_ac2_hum1 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum1;
}
if($cluster_ac2_hum2 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum2;
}
if($cluster_ac2_hum3 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum3;
}
if($cluster_ac2_hum4 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum4;
}
if($cluster_ac2_hum5 !== ""){
$cluster_ac2_hum=$cluster_ac2_hum5;
}

if($cluster_ac3_temp6 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp6;
}
if($cluster_ac3_temp7 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp7;
}
if($cluster_ac3_temp8 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp8;
}
if($cluster_ac3_temp9 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp9;
}
if($cluster_ac3_temp10 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp10;
}
if($cluster_ac3_temp11 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp11;
}
if($cluster_ac3_temp12 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp12;
}
if($cluster_ac3_temp13 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp13;
}
if($cluster_ac3_temp14 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp14;
}
if($cluster_ac3_temp15 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp15;
}
if($cluster_ac3_temp16 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp16;
}
if($cluster_ac3_temp17 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp17;
}
if($cluster_ac3_temp18 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp18;
}
if($cluster_ac3_temp19 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp19;
}
if($cluster_ac3_temp20 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp20;
}
if($cluster_ac3_temp21 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp21;
}
if($cluster_ac3_temp22 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp22;
}
if($cluster_ac3_temp23 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp23;
}
if($cluster_ac3_temp0 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp0;
}
if($cluster_ac3_temp1 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp1;
}
if($cluster_ac3_temp2 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp2;
}
if($cluster_ac3_temp3 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp3;
}
if($cluster_ac3_temp4 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp4;
}
if($cluster_ac3_temp5 !== ""){
$cluster_ac3_temp=$cluster_ac3_temp5;
}

if($cluster_ac3_hum6 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum6;
}
if($cluster_ac3_hum7 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum7;
}
if($cluster_ac3_hum8 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum8;
}
if($cluster_ac3_hum9 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum9;
}
if($cluster_ac3_hum10 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum10;
}
if($cluster_ac3_hum11 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum11;
}
if($cluster_ac3_hum12 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum12;
}
if($cluster_ac3_hum13 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum13;
}
if($cluster_ac3_hum14 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum14;
}
if($cluster_ac3_hum15 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum15;
}
if($cluster_ac3_hum16 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum16;
}
if($cluster_ac3_hum17 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum17;
}
if($cluster_ac3_hum18 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum18;
}
if($cluster_ac3_hum19 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum19;
}
if($cluster_ac3_hum20 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum20;
}
if($cluster_ac3_hum21 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum21;
}
if($cluster_ac3_hum22 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum22;
}
if($cluster_ac3_hum23 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum23;
}
if($cluster_ac3_hum0 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum0;
}
if($cluster_ac3_hum1 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum1;
}
if($cluster_ac3_hum2 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum2;
}
if($cluster_ac3_hum3 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum3;
}
if($cluster_ac3_hum4 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum4;
}
if($cluster_ac3_hum5 !== ""){
$cluster_ac3_hum=$cluster_ac3_hum5;
}

if($cluster_ac4_temp6 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp6;
}
if($cluster_ac4_temp7 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp7;
}
if($cluster_ac4_temp8 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp8;
}
if($cluster_ac4_temp9 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp9;
}
if($cluster_ac4_temp10 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp10;
}
if($cluster_ac4_temp11 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp11;
}
if($cluster_ac4_temp12 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp12;
}
if($cluster_ac4_temp13 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp13;
}
if($cluster_ac4_temp14 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp14;
}
if($cluster_ac4_temp15 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp15;
}
if($cluster_ac4_temp16 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp16;
}
if($cluster_ac4_temp17 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp17;
}
if($cluster_ac4_temp18 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp18;
}
if($cluster_ac4_temp19 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp19;
}
if($cluster_ac4_temp20 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp20;
}
if($cluster_ac4_temp21 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp21;
}
if($cluster_ac4_temp22 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp22;
}
if($cluster_ac4_temp23 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp23;
}
if($cluster_ac4_temp0 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp0;
}
if($cluster_ac4_temp1 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp1;
}
if($cluster_ac4_temp2 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp2;
}
if($cluster_ac4_temp3 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp3;
}
if($cluster_ac4_temp4 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp4;
}
if($cluster_ac4_temp5 !== ""){
$cluster_ac4_temp=$cluster_ac4_temp5;
}

if($cluster_ac4_hum6 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum6;
}
if($cluster_ac4_hum7 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum7;
}
if($cluster_ac4_hum8 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum8;
}
if($cluster_ac4_hum9 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum9;
}
if($cluster_ac4_hum10 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum10;
}
if($cluster_ac4_hum11 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum11;
}
if($cluster_ac4_hum12 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum12;
}
if($cluster_ac4_hum13 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum13;
}
if($cluster_ac4_hum14 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum14;
}
if($cluster_ac4_hum15 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum15;
}
if($cluster_ac4_hum16 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum16;
}
if($cluster_ac4_hum17 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum17;
}
if($cluster_ac4_hum18 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum18;
}
if($cluster_ac4_hum19 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum19;
}
if($cluster_ac4_hum20 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum20;
}
if($cluster_ac4_hum21 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum21;
}
if($cluster_ac4_hum22 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum22;
}
if($cluster_ac4_hum23 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum23;
}
if($cluster_ac4_hum0 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum0;
}
if($cluster_ac4_hum1 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum1;
}
if($cluster_ac4_hum2 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum2;
}
if($cluster_ac4_hum3 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum3;
}
if($cluster_ac4_hum4 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum4;
}
if($cluster_ac4_hum5 !== ""){
$cluster_ac4_hum=$cluster_ac4_hum5;
}

if($hpc_room_temp6 !== ""){
$hpc_room_temp=$hpc_room_temp6;
}
if($hpc_room_temp7 !== ""){
$hpc_room_temp=$hpc_room_temp7;
}
if($hpc_room_temp8 !== ""){
$hpc_room_temp=$hpc_room_temp8;
}
if($hpc_room_temp9 !== ""){
$hpc_room_temp=$hpc_room_temp9;
}
if($hpc_room_temp10 !== ""){
$hpc_room_temp=$hpc_room_temp10;
}
if($hpc_room_temp11 !== ""){
$hpc_room_temp=$hpc_room_temp11;
}
if($hpc_room_temp12 !== ""){
$hpc_room_temp=$hpc_room_temp12;
}
if($hpc_room_temp13 !== ""){
$hpc_room_temp=$hpc_room_temp13;
}
if($hpc_room_temp14 !== ""){
$hpc_room_temp=$hpc_room_temp14;
}
if($hpc_room_temp15 !== ""){
$hpc_room_temp=$hpc_room_temp15;
}
if($hpc_room_temp16 !== ""){
$hpc_room_temp=$hpc_room_temp16;
}
if($hpc_room_temp17 !== ""){
$hpc_room_temp=$hpc_room_temp17;
}
if($hpc_room_temp18 !== ""){
$hpc_room_temp=$hpc_room_temp18;
}
if($hpc_room_temp19 !== ""){
$hpc_room_temp=$hpc_room_temp19;
}
if($hpc_room_temp20 !== ""){
$hpc_room_temp=$hpc_room_temp20;
}
if($hpc_room_temp21 !== ""){
$hpc_room_temp=$hpc_room_temp21;
}
if($hpc_room_temp22 !== ""){
$hpc_room_temp=$hpc_room_temp22;
}
if($hpc_room_temp23 !== ""){
$hpc_room_temp=$hpc_room_temp23;
}
if($hpc_room_temp0 !== ""){
$hpc_room_temp=$hpc_room_temp0;
}
if($hpc_room_temp1 !== ""){
$hpc_room_temp=$hpc_room_temp1;
}
if($hpc_room_temp2 !== ""){
$hpc_room_temp=$hpc_room_temp2;
}
if($hpc_room_temp3 !== ""){
$hpc_room_temp=$hpc_room_temp3;
}
if($hpc_room_temp4 !== ""){
$hpc_room_temp=$hpc_room_temp4;
}
if($hpc_room_temp5 !== ""){
$hpc_room_temp=$hpc_room_temp5;
}

if($io_room_temp6 !== ""){
$io_room_temp=$io_room_temp6;
}
if($io_room_temp7 !== ""){
$io_room_temp=$io_room_temp7;
}
if($io_room_temp8 !== ""){
$io_room_temp=$io_room_temp8;
}
if($io_room_temp9 !== ""){
$io_room_temp=$io_room_temp9;
}
if($io_room_temp10 !== ""){
$io_room_temp=$io_room_temp10;
}
if($io_room_temp11 !== ""){
$io_room_temp=$io_room_temp11;
}
if($io_room_temp12 !== ""){
$io_room_temp=$io_room_temp12;
}
if($io_room_temp13 !== ""){
$io_room_temp=$io_room_temp13;
}
if($io_room_temp14 !== ""){
$io_room_temp=$io_room_temp14;
}
if($io_room_temp15 !== ""){
$io_room_temp=$io_room_temp15;
}
if($io_room_temp16 !== ""){
$io_room_temp=$io_room_temp16;
}
if($io_room_temp17 !== ""){
$io_room_temp=$io_room_temp17;
}
if($io_room_temp18 !== ""){
$io_room_temp=$io_room_temp18;
}
if($io_room_temp19 !== ""){
$io_room_temp=$io_room_temp19;
}
if($io_room_temp20 !== ""){
$io_room_temp=$io_room_temp20;
}
if($io_room_temp21 !== ""){
$io_room_temp=$io_room_temp21;
}
if($io_room_temp22 !== ""){
$io_room_temp=$io_room_temp22;
}
if($io_room_temp23 !== ""){
$io_room_temp=$io_room_temp23;
}
if($io_room_temp0 !== ""){
$io_room_temp=$io_room_temp0;
}
if($io_room_temp1 !== ""){
$io_room_temp=$io_room_temp1;
}
if($io_room_temp2 !== ""){
$io_room_temp=$io_room_temp2;
}
if($io_room_temp3 !== ""){
$io_room_temp=$io_room_temp3;
}
if($io_room_temp4 !== ""){
$io_room_temp=$io_room_temp4;
}
if($io_room_temp5 !== ""){
$io_room_temp=$io_room_temp5;
}

if($anunet_room_temp6 !== ""){
$anunet_room_temp=$anunet_room_temp6;
}
if($anunet_room_temp7 !== ""){
$anunet_room_temp=$anunet_room_temp7;
}
if($anunet_room_temp8 !== ""){
$anunet_room_temp=$anunet_room_temp8;
}
if($anunet_room_temp9 !== ""){
$anunet_room_temp=$anunet_room_temp9;
}
if($anunet_room_temp10 !== ""){
$anunet_room_temp=$anunet_room_temp10;
}
if($anunet_room_temp11 !== ""){
$anunet_room_temp=$anunet_room_temp11;
}
if($anunet_room_temp12 !== ""){
$anunet_room_temp=$anunet_room_temp12;
}
if($anunet_room_temp13 !== ""){
$anunet_room_temp=$anunet_room_temp13;
}
if($anunet_room_temp14 !== ""){
$anunet_room_temp=$anunet_room_temp14;
}
if($anunet_room_temp15 !== ""){
$anunet_room_temp=$anunet_room_temp15;
}
if($anunet_room_temp16 !== ""){
$anunet_room_temp=$anunet_room_temp16;
}
if($anunet_room_temp17 !== ""){
$anunet_room_temp=$anunet_room_temp17;
}
if($anunet_room_temp18 !== ""){
$anunet_room_temp=$anunet_room_temp18;
}
if($anunet_room_temp19 !== ""){
$anunet_room_temp=$anunet_room_temp19;
}
if($anunet_room_temp20 !== ""){
$anunet_room_temp=$anunet_room_temp20;
}
if($anunet_room_temp21 !== ""){
$anunet_room_temp=$anunet_room_temp21;
}
if($anunet_room_temp22 !== ""){
$anunet_room_temp=$anunet_room_temp22;
}
if($anunet_room_temp23 !== ""){
$anunet_room_temp=$anunet_room_temp23;
}
if($anunet_room_temp0 !== ""){
$anunet_room_temp=$anunet_room_temp0;
}
if($anunet_room_temp1 !== ""){
$anunet_room_temp=$anunet_room_temp1;
}
if($anunet_room_temp2 !== ""){
$anunet_room_temp=$anunet_room_temp2;
}
if($anunet_room_temp3 !== ""){
$anunet_room_temp=$anunet_room_temp3;
}
if($anunet_room_temp4 !== ""){
$anunet_room_temp=$anunet_room_temp4;
}
if($anunet_room_temp5 !== ""){
$anunet_room_temp=$anunet_room_temp5;
}

if($hpc_status6 !== ""){
$hpc_status=$hpc_status6;
}
if($hpc_status7 !== ""){
$hpc_status=$hpc_status7;
}
if($hpc_status8 !== ""){
$hpc_status=$hpc_status8;
}
if($hpc_status9 !== ""){
$hpc_status=$hpc_status9;
}
if($hpc_status10 !== ""){
$hpc_status=$hpc_status10;
}
if($hpc_status11 !== ""){
$hpc_status=$hpc_status11;
}
if($hpc_status12 !== ""){
$hpc_status=$hpc_status12;
}
if($hpc_status13 !== ""){
$hpc_status=$hpc_status13;
}
if($hpc_status14 !== ""){
$hpc_status=$hpc_status14;
}
if($hpc_status15 !== ""){
$hpc_status=$hpc_status15;
}
if($hpc_status16 !== ""){
$hpc_status=$hpc_status16;
}
if($hpc_status17 !== ""){
$hpc_status=$hpc_status17;
}
if($hpc_status18 !== ""){
$hpc_status=$hpc_status18;
}
if($hpc_status19 !== ""){
$hpc_status=$hpc_status19;
}
if($hpc_status20 !== ""){
$hpc_status=$hpc_status20;
}
if($hpc_status21 !== ""){
$hpc_status=$hpc_status21;
}
if($hpc_status22 !== ""){
$hpc_status=$hpc_status22;
}
if($hpc_status23 !== ""){
$hpc_status=$hpc_status23;
}
if($hpc_status0 !== ""){
$hpc_status=$hpc_status0;
}
if($hpc_status1 !== ""){
$hpc_status=$hpc_status1;
}
if($hpc_status2 !== ""){
$hpc_status=$hpc_status2;
}
if($hpc_status3 !== ""){
$hpc_status=$hpc_status3;
}
if($hpc_status4 !== ""){
$hpc_status=$hpc_status4;
}
if($hpc_status5 !== ""){
$hpc_status=$hpc_status5;
}

if($workstation_status6 !== ""){
$workstation_status=$workstation_status6;
}
if($workstation_status7 !== ""){
$workstation_status=$workstation_status7;
}
if($workstation_status8 !== ""){
$workstation_status=$workstation_status8;
}
if($workstation_status9 !== ""){
$workstation_status=$workstation_status9;
}
if($workstation_status10 !== ""){
$workstation_status=$workstation_status10;
}
if($workstation_status11 !== ""){
$workstation_status=$workstation_status11;
}
if($workstation_status12 !== ""){
$workstation_status=$workstation_status12;
}
if($workstation_status13 !== ""){
$workstation_status=$workstation_status13;
}
if($workstation_status14 !== ""){
$workstation_status=$workstation_status14;
}
if($workstation_status15 !== ""){
$workstation_status=$workstation_status15;
}
if($workstation_status16 !== ""){
$workstation_status=$workstation_status16;
}
if($workstation_status17 !== ""){
$workstation_status=$workstation_status17;
}
if($workstation_status18 !== ""){
$workstation_status=$workstation_status18;
}
if($workstation_status19 !== ""){
$workstation_status=$workstation_status19;
}
if($workstation_status20 !== ""){
$workstation_status=$workstation_status20;
}
if($workstation_status21 !== ""){
$workstation_status=$workstation_status21;
}
if($workstation_status22 !== ""){
$workstation_status=$workstation_status22;
}
if($workstation_status23 !== ""){
$workstation_status=$workstation_status23;
}
if($workstation_status0 !== ""){
$workstation_status=$workstation_status0;
}
if($workstation_status1 !== ""){
$workstation_status=$workstation_status1;
}
if($workstation_status2 !== ""){
$workstation_status=$workstation_status2;
}
if($workstation_status3 !== ""){
$workstation_status=$workstation_status3;
}
if($workstation_status4 !== ""){
$workstation_status=$workstation_status4;
}
if($workstation_status5 !== ""){
$workstation_status=$workstation_status5;
}

if($email_server_status6 !== ""){
$email_server_status=$email_server_status6;
}
if($email_server_status7 !== ""){
$email_server_status=$email_server_status7;
}
if($email_server_status8 !== ""){
$email_server_status=$email_server_status8;
}
if($email_server_status9 !== ""){
$email_server_status=$email_server_status9;
}
if($email_server_status10 !== ""){
$email_server_status=$email_server_status10;
}
if($email_server_status11 !== ""){
$email_server_status=$email_server_status11;
}
if($email_server_status12 !== ""){
$email_server_status=$email_server_status12;
}
if($email_server_status13 !== ""){
$email_server_status=$email_server_status13;
}
if($email_server_status14 !== ""){
$email_server_status=$email_server_status14;
}
if($email_server_status15 !== ""){
$email_server_status=$email_server_status15;
}
if($email_server_status16 !== ""){
$email_server_status=$email_server_status16;
}
if($email_server_status17 !== ""){
$email_server_status=$email_server_status17;
}
if($email_server_status18 !== ""){
$email_server_status=$email_server_status18;
}
if($email_server_status19 !== ""){
$email_server_status=$email_server_status19;
}
if($email_server_status20 !== ""){
$email_server_status=$email_server_status20;
}
if($email_server_status21 !== ""){
$email_server_status=$email_server_status21;
}
if($email_server_status22 !== ""){
$email_server_status=$email_server_status22;
}
if($email_server_status23 !== ""){
$email_server_status=$email_server_status23;
}
if($email_server_status0 !== ""){
$email_server_status=$email_server_status0;
}
if($email_server_status1 !== ""){
$email_server_status=$email_server_status1;
}
if($email_server_status2 !== ""){
$email_server_status=$email_server_status2;
}
if($email_server_status3 !== ""){
$email_server_status=$email_server_status3;
}
if($email_server_status4 !== ""){
$email_server_status=$email_server_status4;
}
if($email_server_status5 !== ""){
$email_server_status=$email_server_status5;
}

if($inter_intra_status6 !== ""){
$inter_intra_status=$inter_intra_status6;
}
if($inter_intra_status7 !== ""){
$inter_intra_status=$inter_intra_status7;
}
if($inter_intra_status8 !== ""){
$inter_intra_status=$inter_intra_status8;
}
if($inter_intra_status9 !== ""){
$inter_intra_status=$inter_intra_status9;
}
if($inter_intra_status10 !== ""){
$inter_intra_status=$inter_intra_status10;
}
if($inter_intra_status11 !== ""){
$inter_intra_status=$inter_intra_status11;
}
if($inter_intra_status12 !== ""){
$inter_intra_status=$inter_intra_status12;
}
if($inter_intra_status13 !== ""){
$inter_intra_status=$inter_intra_status13;
}
if($inter_intra_status14 !== ""){
$inter_intra_status=$inter_intra_status14;
}
if($inter_intra_status15 !== ""){
$inter_intra_status=$inter_intra_status15;
}
if($inter_intra_status16 !== ""){
$inter_intra_status=$inter_intra_status16;
}
if($inter_intra_status17 !== ""){
$inter_intra_status=$inter_intra_status17;
}
if($inter_intra_status18 !== ""){
$inter_intra_status=$inter_intra_status18;
}
if($inter_intra_status19 !== ""){
$inter_intra_status=$inter_intra_status19;
}
if($inter_intra_status20 !== ""){
$inter_intra_status=$inter_intra_status20;
}
if($inter_intra_status21 !== ""){
$inter_intra_status=$inter_intra_status21;
}
if($inter_intra_status22 !== ""){
$inter_intra_status=$inter_intra_status22;
}
if($inter_intra_status23 !== ""){
$inter_intra_status=$inter_intra_status23;
}
if($inter_intra_status0 !== ""){
$inter_intra_status=$inter_intra_status0;
}
if($inter_intra_status1 !== ""){
$inter_intra_status=$inter_intra_status1;
}
if($inter_intra_status2 !== ""){
$inter_intra_status=$inter_intra_status2;
}
if($inter_intra_status3 !== ""){
$inter_intra_status=$inter_intra_status3;
}
if($inter_intra_status4 !== ""){
$inter_intra_status=$inter_intra_status4;
}
if($inter_intra_status5 !== ""){
$inter_intra_status=$inter_intra_status5;
}

if($ups_status6 !== ""){
$ups_status=$ups_status6;
}
if($ups_status7 !== ""){
$ups_status=$ups_status7;
}
if($ups_status8 !== ""){
$ups_status=$ups_status8;
}
if($ups_status9 !== ""){
$ups_status=$ups_status9;
}
if($ups_status10 !== ""){
$ups_status=$ups_status10;
}
if($ups_status11 !== ""){
$ups_status=$ups_status11;
}
if($ups_status12 !== ""){
$ups_status=$ups_status12;
}
if($ups_status13 !== ""){
$ups_status=$ups_status13;
}
if($ups_status14 !== ""){
$ups_status=$ups_status14;
}
if($ups_status15 !== ""){
$ups_status=$ups_status15;
}
if($ups_status16 !== ""){
$ups_status=$ups_status16;
}
if($ups_status17 !== ""){
$ups_status=$ups_status17;
}
if($ups_status18 !== ""){
$ups_status=$ups_status18;
}
if($ups_status19 !== ""){
$ups_status=$ups_status19;
}
if($ups_status20 !== ""){
$ups_status=$ups_status20;
}
if($ups_status21 !== ""){
$ups_status=$ups_status21;
}
if($ups_status22 !== ""){
$ups_status=$ups_status22;
}
if($ups_status23 !== ""){
$ups_status=$ups_status23;
}
if($ups_status0 !== ""){
$ups_status=$ups_status0;
}
if($ups_status1 !== ""){
$ups_status=$ups_status1;
}
if($ups_status2 !== ""){
$ups_status=$ups_status2;
}
if($ups_status3 !== ""){
$ups_status=$ups_status3;
}
if($ups_status4 !== ""){
$ups_status=$ups_status4;
}
if($ups_status5 !== ""){
$ups_status=$ups_status5;
}


if($switch_status6 !== ""){
$switch_status=$switch_status6;
}
if($switch_status7 !== ""){
$switch_status=$switch_status7;
}
if($switch_status8 !== ""){
$switch_status=$switch_status8;
}
if($switch_status9 !== ""){
$switch_status=$switch_status9;
}
if($switch_status10 !== ""){
$switch_status=$switch_status10;
}
if($switch_status11 !== ""){
$switch_status=$switch_status11;
}
if($switch_status12 !== ""){
$switch_status=$switch_status12;
}
if($switch_status13 !== ""){
$switch_status=$switch_status13;
}
if($switch_status14 !== ""){
$switch_status=$switch_status14;
}
if($switch_status15 !== ""){
$switch_status=$switch_status15;
}
if($switch_status16 !== ""){
$switch_status=$switch_status16;
}
if($switch_status17 !== ""){
$switch_status=$switch_status17;
}
if($switch_status18 !== ""){
$switch_status=$switch_status18;
}
if($switch_status19 !== ""){
$switch_status=$switch_status19;
}
if($switch_status20 !== ""){
$switch_status=$switch_status20;
}
if($switch_status21 !== ""){
$switch_status=$switch_status21;
}
if($switch_status22 !== ""){
$switch_status=$switch_status22;
}
if($switch_status23 !== ""){
$switch_status=$switch_status23;
}
if($switch_status0 !== ""){
$switch_status=$switch_status0;
}
if($switch_status1 !== ""){
$switch_status=$switch_status1;
}
if($switch_status2 !== ""){
$switch_status=$switch_status2;
}
if($switch_status3 !== ""){
$switch_status=$switch_status3;
}
if($switch_status4 !== ""){
$switch_status=$switch_status4;
}
if($switch_status5 !== ""){
$switch_status=$switch_status5;
}



/*
echo $time;
echo "<br>";
echo $ivy_temp;
echo "<br>";
echo $ivy_hum;
echo "<br>";
echo $cluster_ac1_temp;
echo "<br>";
echo $cluster_ac1_hum;
echo "<br>";
echo $cluster_ac2_temp;
echo "<br>";
echo $cluster_ac2_hum;
echo "<br>";
echo $cluster_ac3_temp;
echo "<br>";
echo $cluster_ac3_hum;
echo "<br>";
echo $cluster_ac4_temp;
echo "<br>";
echo $cluster_ac4_hum;
echo "<br>";
echo $hpc_room_temp;
echo "<br>";
echo $io_room_temp;
echo "<br>";
echo $anunet_room_temp;
echo "<br>";
echo $ups_status;
echo "<br>";
echo $inter_intra_status;
echo "<br>";
echo $email_server_status;
echo "<br>";
echo $workstation_status;
echo "<br>";
echo $hpc_status;
echo "<br>";
echo $switch_status;

*/

?>


<?php


if ($time !== "") {

$sql= " insert into 

rtc_shift_log ( `logdate`, `time`, `ivy_temp`, `ivy_hum`, `cluster_ac1_temp`, `cluster_ac1_hum`, `cluster_ac2_temp`, `cluster_ac2_hum`, `cluster_ac3_temp`, `cluster_ac3_hum`, `cluster_ac4_temp`, `cluster_ac4_hum`, `hpc_room_temp`, `io_room_temp`, `anunet_room_temp`, `hpc_status`, `workstation_status`, `email_server_status`, `inter_intra_status`, `ups_status`, `switch_status`) 

values ( '$log_date', '$time', '$ivy_temp', '$ivy_hum', '$cluster_ac1_temp', '$cluster_ac1_hum', '$cluster_ac2_temp', '$cluster_ac2_hum', '$cluster_ac3_temp', '$cluster_ac3_hum', '$cluster_ac4_temp', '$cluster_ac4_hum', '$hpc_room_temp', '$io_room_temp', '$anunet_room_temp', '$hpc_status', '$workstation_status', '$email_server_status', '$inter_intra_status', '$ups_status', '$switch_status') ";

$retval = mysql_query( $sql, $conn ); //querying the select

if(! $retval )
{
  die('Could not inset data: ' . mysql_error());
}

if ($retval){
echo "<br>";
echo "Log Data inserted successfully";
}

}


?>




<body style="width:80%;margin: auto; ">
<h1 align="center"> RTC Shift Log </h1>

<table border=1>
<tr><th colspan="2">DATE :</th>
<td colspan="8" style="background-color:#FFD700">1st SHIFT</td>
<td colspan="8" style="background-color:#FFB6C1">2nd SHIFT</td>
<td colspan="8" style="background-color:#87CEFA">3rd SHIFT</td></tr>


<tr><form method="get" action=""><th>
<input type= "text" id= "day" name= "day" size="8" onchange="this.form.submit()" style="cursor: pointer" value = "<?php echo $selected_day;?>" >
</th></form> <th >Time</th>
<?php
for ($x=6; $x<=13; $x++){
echo "<td style='background-color:#FFD700; width:4%'>";
echo $x.":00";
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td style='background-color:#FFB6C1;width: 2.5%;'>";
echo $x.":00";
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td style='background-color:#87CEFA;width: 2.5%;'>";
echo $x.":00";
echo "</td>";
}

for ($x=0; $x<=5; $x++){
echo "<td style='background-color:#87CEFA;width: 2.5%;'>";
echo $x.":00";
echo "</td>";
}
?> 
</tr>


<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 

<tr><th rowspan="2" >IVY Cluster</th>
<td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00a' style='background-color:#FFD700'>";
echo '<input type= "text" name= "ivy_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00a' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "ivy_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00a' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "ivy_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00a' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "ivy_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA">';
echo "</td>";
}
?> 
</tr>


<tr><td style='background-color:#B0E0E6'>Humidity</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00b' style='background-color:#FFD700'>";
echo '<input type= "text" name= "ivy_hum';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00b' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "ivy_hum';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00b' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "ivy_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00b' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "ivy_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><th rowspan="2">CLUSTER AC UNIT 1</th>
<td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00c' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac1_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00c' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac1_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00c' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac1_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00c' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac1_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><td style='background-color:#B0E0E6'>Humidity</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00d' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac1_hum';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00d' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac1_hum';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00d' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac1_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00d' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac1_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><th rowspan="2">CLUSTER AC UNIT 2</th>
<td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00e' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac2_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00e' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac2_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00e' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac2_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00e' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac2_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><td style='background-color:#B0E0E6'>Humidity</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00f' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac2_hum';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00f' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac2_hum';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00f' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac2_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00f' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac2_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><th rowspan="2">CLUSTER AC UNIT 3</th>
<td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00g' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac3_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00g' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac3_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00g' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac3_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00g' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac3_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><td style='background-color:#B0E0E6'>Humidity</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00h' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac3_hum';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00h' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac3_hum';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00h' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac3_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00h' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac3_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?>  
</tr>


<tr><th rowspan="2">CLUSTER AC UNIT 4</th>
<td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00i' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac4_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00i' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac4_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00i' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac4_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00i' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac4_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA">';
echo "</td>";
}
?>  
</tr>


<tr><td style='background-color:#B0E0E6'>Humidity</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00j' style='background-color:#FFD700'>";
echo '<input type= "text" name= "cluster_ac4_hum';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00j' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "cluster_ac4_hum';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00j' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac4_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00j' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "cluster_ac4_hum';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?>  
</tr>


<tr><th>HPC Room</th><td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00k' style='background-color:#FFD700'>";
echo '<input type= "text" name= "hpc_room_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00k' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "hpc_room_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00k' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "hpc_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00k' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "hpc_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><th>I/O Room</th><td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00l' style='background-color:#FFD700'>";
echo '<input type= "text" name= "io_room_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00l' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "io_room_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00l' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "io_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00l' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "io_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA;">';
echo "</td>";
}
?> 
</tr>


<tr><th>ANUNET Room</th><td style='background-color:#FFA07A'>Temp</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00m' style='background-color:#FFD700'>";
echo '<input type= "text" name= "anunet_room_temp';echo $x;echo '" size="1"  style="background-color: #FFD700;">';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00m' style='background-color:#FFB6C1'>";
echo '<input type= "text" name= "anunet_room_temp';echo $x;echo '" size="1"  style="background-color: #FFB6C1;">';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00m' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "anunet_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA">';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00m' style='background-color:#87CEFA'>";
echo '<input type= "text" name= "anunet_room_temp';echo $x;echo '" size="1"  style="background-color: #87CEFA">';
echo "</td>";
}
?>  
</tr>


<tr><th >HPC </th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00n' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "hpc_status';echo $x;echo '" size="1"  style="background-color: #FFD700;">';

echo '<select name= "hpc_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00n' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "hpc_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1">';

echo '<select name= "hpc_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00n' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "hpc_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "hpc_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00n' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "hpc_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "hpc_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>


<tr><th  >WORKSTATION </th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00o' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "workstation_status';echo $x;echo '" size="1"  style="background-color: #FFD700;">';

echo '<select name= "workstation_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00o' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "workstation_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1">';

echo '<select name= "workstation_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00o' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "workstation_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "workstation_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00o' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "workstation_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "workstation_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>


<tr><th  >E-MAIL SERVER </th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00p' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "email_server_status';echo $x;echo '" size="1"  style="background-color: #FFD700;">';

echo '<select name= "email_server_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00p' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "email_server_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1">';

echo '<select name= "email_server_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00p' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "email_server_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "email_server_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00p' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "email_server_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "email_server_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>



<tr><th >Inter/Intra </th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00q' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "inter_intra_status';echo $x;echo '" size="1"  style="background-color: #FFD700;">';

echo '<select name= "inter_intra_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00q' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "inter_intra_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1">';

echo '<select name= "inter_intra_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00q' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "inter_intra_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "inter_intra_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00q' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "inter_intra_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "inter_intra_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>


<tr><th  >UPS </th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00r' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "ups_status';echo $x;echo '" size="1"  style="background-color: #FFD700;">';

echo '<select name= "ups_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00r' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "ups_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1">';

echo '<select name= "ups_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00r' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "ups_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "ups_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00r' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "ups_status';echo $x;echo '" size="1"  style="background-color: #87CEFA">';

echo '<select name= "ups_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>


<tr><th>SWITCH</th><td style='background-color:#B0C4DE'>Status</td>
<?php
for ($x=6; $x<=13; $x++){
echo "<td id='$x:00s' style='background-color:#FFD700'>";
//echo '<input type= "text" name= "switch_status';echo $x;echo '" size="1"  style="background-color: #FFD700;" >';

echo '<select name= "switch_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=14; $x<=21; $x++){
echo "<td id='$x:00s' style='background-color:#FFB6C1'>";
//echo '<input type= "text" name= "switch_status';echo $x;echo '" size="1"  style="background-color: #FFB6C1" >';

echo '<select name= "switch_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=22; $x<=23; $x++){
echo "<td id='$x:00s' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "switch_status';echo $x;echo '" size="1"  style="background-color: #87CEFA" >';

echo '<select name= "switch_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
for ($x=0; $x<=5; $x++){
echo "<td id='$x:00s' style='background-color:#87CEFA'>";
//echo '<input type= "text" name= "switch_status';echo $x;echo '" size="1"  style="background-color: #87CEFA" >';

echo '<select name= "switch_status';echo $x;echo '">
    <option value=""></option>
    <option value="&#10003;">&#10003;</option><option value="&#10007;">&#10007;</option></select>';
echo "</td>";
}
?> 
</tr>

<tr><th colspan="6">1st Shift Remarks</th>
<th colspan="10">2nd Shift Remarks</th><th colspan="10">3rd Shift Remarks</th></tr>
<tr height="100">
<td colspan="6" id="remark1"></td>
<td colspan="10" id="remark2"></td>
<td colspan="10" id="remark3"></td>
</tr>

</table>

<input type="submit" value="submit"> 
</form>
<a href="shift_log13.php">refresh</a>
<a href="remark.php">Remark</a>




<?php



If ( $time == ""){

//$today=date("Y-m-d");

mysql_select_db('rtc_shift_log'); // select the database

$sql = " SELECT * FROM rtc_shift_log 
        WHERE logdate = '$today' ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
     $time[$i]     = $row['time'];
     $ivy_temp[$i] = $row['ivy_temp'];
     $ivy_hum[$i] = $row['ivy_hum'];
     $cluster_ac1_temp[$i] = $row['cluster_ac1_temp'];
     $cluster_ac1_hum[$i] = $row['cluster_ac1_hum'];
     $cluster_ac2_temp[$i] = $row['cluster_ac2_temp'];
     $cluster_ac2_hum[$i] = $row['cluster_ac2_hum'];
     $cluster_ac3_temp[$i] = $row['cluster_ac3_temp'];
     $cluster_ac3_hum[$i] = $row['cluster_ac3_hum'];
     $cluster_ac4_temp[$i] = $row['cluster_ac4_temp'];
     $cluster_ac4_hum[$i] = $row['cluster_ac4_hum'];
     $hpc_room_temp[$i] = $row['hpc_room_temp'];
     $io_room_temp[$i] = $row['io_room_temp'];
     $anunet_room_temp[$i] = $row['anunet_room_temp'];
     $hpc_status[$i] = $row['hpc_status'];
     $workstation_status[$i] = $row['workstation_status'];
     $email_server_status[$i] = $row['email_server_status'];
     $inter_intra_status[$i] = $row['inter_intra_status'];
     $ups_status[$i] = $row['ups_status'];
     $switch_status[$i] = $row['switch_status'];
            
$i=$i+1;
}



$count = $i;  //found hard do not delete this line its counting rows;

for ($i=1; $i <= $count-1; $i++) {
echo "<script>";

echo " document.getElementById('";
echo $time[$i];
echo "a').innerHTML =";
echo "'$ivy_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "b').innerHTML =";
echo "'$ivy_hum[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "c').innerHTML =";
echo "'$cluster_ac1_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "d').innerHTML =";
echo "'$cluster_ac1_hum[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "e').innerHTML =";
echo "'$cluster_ac2_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "f').innerHTML =";
echo "'$cluster_ac2_hum[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "g').innerHTML =";
echo "'$cluster_ac3_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "h').innerHTML =";
echo "'$cluster_ac3_hum[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "i').innerHTML =";
echo "'$cluster_ac4_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "j').innerHTML =";
echo "'$cluster_ac4_hum[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "k').innerHTML =";
echo "'$hpc_room_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "l').innerHTML =";
echo "'$io_room_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "m').innerHTML =";
echo "'$anunet_room_temp[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "n').innerHTML =";
echo "'$hpc_status[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "o').innerHTML =";
echo "'$workstation_status[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "p').innerHTML =";
echo "'$email_server_status[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "q').innerHTML =";
echo "'$inter_intra_status[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "r').innerHTML =";
echo "'$ups_status[$i]';";

echo " document.getElementById('";
echo $time[$i];
echo "s').innerHTML =";
echo "'$switch_status[$i]';";

echo "</script>";
}





mysql_select_db('rtc_shift_log'); // select the database

$sql = " SELECT * FROM shift_remark 
        WHERE logdate = '$today' AND HOUR(time) BETWEEN 6 AND 13 ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
     $remark[$i]     = $row['remark'];
     $time[$i]     = $row['time'];
     
            
$i=$i+1;
}

$count = $i;  //found hard do not delete this line its counting rows;

$remarkdata1 = "";
for ($i=1; $i<= $count-1; $i++){
$remarkdata1 = "$remark[$i]"." $remarkdata1";
}

//echo $remarkdata1;

echo "<script>";
echo " document.getElementById('remark1').innerHTML =";
echo "'$remarkdata1';";
echo "</script>"; 



$sql = " SELECT * FROM shift_remark 
        WHERE logdate = '$today' AND HOUR(time) BETWEEN 14 AND 21 ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
     $remark[$i]     = $row['remark'];
     $time[$i]     = $row['time'];
     
            
$i=$i+1;
}

$count = $i;  //found hard do not delete this line its counting rows;

$remarkdata2 = "";
for ($i=1; $i<= $count-1; $i++){
$remarkdata2 = "$remark[$i]"." $remarkdata2";
}

//echo $remarkdata2;

echo "<script>";
echo " document.getElementById('remark2').innerHTML =";
echo "'$remarkdata2';";
echo "</script>"; 



$sql = " SELECT * FROM shift_remark 
        WHERE logdate = '$today' AND HOUR(time) BETWEEN 22 AND 23 ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
     $remark[$i]     = $row['remark'];
     $time[$i]     = $row['time'];
     
            
$i=$i+1;
}

$count = $i;  //found hard do not delete this line its counting rows;

$remarkdata3 = "";
for ($i=1; $i<= $count-1; $i++){
$remarkdata3 = "$remark[$i]"." $remarkdata3";
}

//echo $remarkdata3;

echo "<script>";
echo " document.getElementById('remark3').innerHTML =";
echo "'$remarkdata3';";
echo "</script>"; 


$sql = " SELECT * FROM shift_remark 
        WHERE logdate = '$today' AND HOUR(time) BETWEEN 0 AND 5 ";
$retval = mysql_query( $sql, $conn ); //querying the select
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}

$i=1;
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
     $remark[$i]     = $row['remark'];
     $time[$i]     = $row['time'];
     
            
$i=$i+1;
}

$count = $i;  //found hard do not delete this line its counting rows;

$remarkdata3 = "";
for ($i=1; $i<= $count-1; $i++){
$remarkdata3 = "$remark[$i]"." $remarkdata3";
}

//echo $remarkdata3;

echo "<script>";
echo " document.getElementById('remark3').innerHTML =";
echo "'$remarkdata3';";
echo "</script>"; 


}

?>

<p>I will display &#10003;</p>
<p>I will display &#10007;</p>


<select>
<option value="&#10003;">&#10003;</option>
<option value="&#10003;">&#10007;</option>
</select>









</body>
</html>
