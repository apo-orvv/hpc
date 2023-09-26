<?php
require_once("model/roster_model.php");  
  
class roster_con
{
public $rostermodel;

public function __construct()
{
  $this->rostermodel=new rostermodel();   
}

public function rosterpattern()
{
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
//echo "hello";
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

$LA=$this->rostermodel->get_leave_action_details($m,$y);
$CD=$this->rostermodel->get_all_crew_details();
$cnt=0;

foreach ($CD as $crew)
{
$cnt++;
$cname[$cnt]=$crew['c_name'];
$icno=$crew['icno'];
$rA[$cnt]=$this->rostermodel->get_crew_pattern($cname[$cnt],$m,$y);
$cA[$cnt]=$this->rostermodel->get_crew_details($icno);
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
$CD=$this->rostermodel->get_all_crew_details();
$cnt=0;

foreach ($CD as $crew)
{

$cnt++;
$cname[$cnt]=$crew['c_name'];
$icno=$crew['icno'];
$rA[$cnt]=$this->rostermodel->get_crew_pattern($cname[$cnt],$m,$y);
$cA[$cnt]=$this->rostermodel->get_crew_details($icno);
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

} //class
