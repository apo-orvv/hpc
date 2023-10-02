<!DOCTYPE HTML>  
<html>
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shift Roster Update</title>
  <link rel="stylesheet" href="jqdate1/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="jqdate1/style.css">
  <script src="jqdate1/jq.js"></script>
  <script src="jqdate1/jq2.js"></script>

<script>

   $( function() {
       
       $( "#date" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
 
</script>




</head>
<body>  

<?php
// define variables and set to empty values
$date1 = "";

if (isset($_REQUEST['date'])) {

        $date1 = $_REQUEST['date'];
//echo $date1;

    }

?>   

<form method="get" action="">
<input type= "text" id= "date" size="2" name= "date" onchange="this.form.submit()"  >
</form>


<?php


//string date to iso date format for mysqml data base

$date2=date_create("$date1");     //create date from string
$today=date_format($date2,"Y-m-d");     //format date in year of the day

//echo $today;
?>


</body>
</html>




