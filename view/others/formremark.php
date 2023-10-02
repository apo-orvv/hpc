<!--jquery form output date value assign-->
<?php
// define variables and set to empty values
$fdate=$tdate=$qstatus="";


$dt = new DateTime(null, new DateTimeZone('Asia/Kolkata'));
$dt->sub(new DateInterval('P30D'));
$fdate=$dt->format('d-m-Y');
$fdate2=$dt->format('Y-m-d');
$tdate=date("d-m-Y");
$tdate2=date("Y-m-d");
//echo "from date is ".$fdate." and to date is ".$tdate;

if (isset($_REQUEST['fdate'])) {

        $fdate = $_REQUEST['fdate'];
//echo $fdate;
//echo "<br>";

//string date to iso date format for mysqml data base

$fdate1=date_create("$fdate");     //create date from string
$fdate2=date_format($fdate1,"Y-m-d");     //format date into iso Y-m-d format
//echo $fdate2;
//echo "<br>";
}


if (isset($_REQUEST['tdate'])) {

        $tdate = $_REQUEST['tdate'];
//echo $tdate;
//echo "<br>";


//string date to iso date format for mysqml data base

$tdate1=date_create("$tdate");     //create date from string
$tdate2=date_format($tdate1,"Y-m-d");     //format date into iso Y-m-d format
//echo $tdate2;
//echo "<br>";

}

if (isset($_REQUEST['qstatus'])) {

        $qstatus = $_REQUEST['qstatus'];
        //echo $qstatus;
}

$search="";
if (isset($_REQUEST['submit'])) {

        $search = $_REQUEST['search'];
       // echo $search;
}



?>   
<!--jquery form output end -->