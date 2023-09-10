<?php 
require_once 'dbclass.php';
class SoftwareModel
{
	
	 public function __construct(){

	}  
public function softwaredetails($sel)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
if($sel=="All")
{
//print"model";
	//print_r($sel);
	//$qp="SOFTID, SOFTNAME, TYPE, INSTALLEDON, SWUSAGE, LICENSE_SERVER, LICENSE_TYPE, NO_OF_LIC"; 
$sql1="select * from SOFTWARE_DETAIL";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
//print_r($sql1);
return $sql1;
}
else
{
$qp="";
	
foreach($sel as $qselect=> $val){  $qp =$qp .$sel[$qselect].",";  
}
$qp=rtrim($qp,",");
//echo $qp;
$sql1="select $qp from SOFTWARE_DETAIL";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}
}

public function fetchsoftware($sname)
{

$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from SOFTWARE_DETAIL where SOFTNAME='$sname'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();


return $sql1;
	
}



public function savesoftware($data)
{
	//print_r($data);
	
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from SOFTWARE_DETAIL where SOFTNAME='$data[sname]'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

if($sql1!="")
{
	$qdel="DELETE FROM SOFTWARE_DETAIL where SOFTNAME=:sname";
	$up = $dbh->prepare($qdel);
$up->bindValue(':sname',$data[sname]);
$up->execute();
}

$insert=$dbh->prepare("insert into SOFTWARE_DETAIL (`SOFTID`, `SOFTNAME`, `TYPE`, `INSTALLEDON`, `SWUSAGE`, `PROCUREDBY`, `INSTALLEDBY`, `LICENSE_SERVER`, `LICENSE_TYPE`, `NO_OF_LIC`, `EXPIRY_DATE`, `VENDOR`) 
values (:softid, :softname, :type, :installedon, :swusage, :procuredby, :installedby, :licser, :lictype, :nolic, :expdate, :vendor)");
$insert->execute(array('softid'=>$data[sname],
		'softname'=>$data[sname],
		'type'=>$data[stype],
		'installedon'=>$data[installedon],
		'swusage'=>$data[swusage],
		'procuredby'=>$data[procuredby],
		'installedby'=>$data[installedby],
		'licser'=>$data[licser],
		'lictype'=>$data[lictype],
		'nolic'=>$data[nolic],  
		'expdate'=>$data[expdate],
		'vendor'=>$data[vendor]));
		
		$id=$dbh->lastInsertId();
		
return($id);
}



}
?>