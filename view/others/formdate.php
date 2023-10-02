<!--jquery form output and date value assign-->
<?php

//echo $serverTime;
//echo $H;
//echo $M;

if($H==5&&$M>30){
$today=$date1=date('d-m-Y',strtotime("-1 days"));
}

else{
$today=date('Y-m-d');//for insert data
$date1 =date("d-m-Y");//for quirey data
}

if (isset($_REQUEST['date'])) {

        $date1 = $_REQUEST['date'];
//echo $date1;

    }
//string date to iso date format for mysqml data base

$date2=date_create("$date1");     //create date from string
$selectedDate=date_format($date2,"Y-m-d");     //format date in year of the day

//echo $selectedDate;



?>   
<!--jquery form output end -->