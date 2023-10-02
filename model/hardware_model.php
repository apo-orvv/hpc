<?php 
require_once 'dbclass.php';
class HardwareModel
{
	
	 public function __construct(){

	}  
	
public function hardwaredetails($sel)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
if($sel=="All")
{
	//print_r($sel);
	//$qp="SYSNAME, TYPE, DESCRIPTION, CONFIG, PERFORMANCE, PROCESSOR, NETWORK, IPADDRESS";
$sql1="select * from SYSTEM_DETAIL";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}
else
{ 
$qp="";
foreach($sel as $qselect=> $val){ if(($sel[$qselect])!="SOFTID"){ $qp =$qp .$sel[$qselect].","; } 
}
$qp=rtrim($qp,",");

$sql1="select $qp from SYSTEM_DETAIL";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}
}


public function upsdetails()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from upsdetail";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function fetchipadd($type)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
if(($type)!="All")

$sql1="select * from ipdetail where type='$type'";

else 
$sql1="select * from ipdetail";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();

return $sql1;
}

public function fetchsysip($sname)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from ipdetail where sysname='$sname'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

return $sql1;
} 


public function saveip($data,$sname)
{

$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from ipdetail where sysname='$sname'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

if($sql1!="")
{
$qdel="DELETE FROM ipdetail where sysname=:sname";
$up = $dbh->prepare($qdel);
$up->bindValue(':sname',$sname);
$up->execute();
}

$insert=$dbh->prepare("INSERT INTO ipdetail (`sysname`, `login_name`, `ipadd`, `type`, `location`,`Remarks`) values (:sname,:loginname,:ipaddress,:type,:location,:remark)");
$insert->execute(array('sname'=>$data[sysname],
		'loginname'=>$data[login_name],
		'ipaddress'=>$data[ipaddress],
		'type'=>$data[type],
		'location'=>$data[location],
		'remark'=>$data[remark]));
		$id=$dbh->lastInsertId();
return($id);
}


public function ipcheck($ipadd)
{
echo $ipadd;
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from ipdetail where ipadd='$ipadd'";
echo $sql1;
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();
echo $sql1;
	
return($sql1);
}


public function fetchsoftware($softid,$sname)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$softwares="";
$sql1="select SOFTNAME from SOFTWARE_DETAIL, SYSTEM_SOFTWARE where SYSTEM_SOFTWARE.SOFTID = SOFTWARE_DETAIL.SOFTID AND SYSTEM_SOFTWARE.SYSNAME='$sname'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
foreach($sql1 as $rows){ $softwares = $softwares.$rows[SOFTNAME].",";}
$softwares=rtrim($softwares,",");
return $softwares;
}

public function fetchallsoftware()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$softwares="";
$sql1="select SOFTID,SOFTNAME from SOFTWARE_DETAIL";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function fetchhardware($sname)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from SYSTEM_DETAIL where SYSNAME='$sname'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

return $sql1;
} 

public function savehardware($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from SYSTEM_DETAIL where SYSNAME='$data[sysname]'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

if($sql1!="")
{
	$qdel="DELETE FROM SYSTEM_DETAIL where SYSNAME=:sname";
	$up = $dbh->prepare($qdel);
$up->bindValue(':sname',$data[sysname]);
$up->execute();
}

$insert=$dbh->prepare("insert into SYSTEM_DETAIL (SYSNAME,TYPE,DESCRIPTION, CONFIG, PERFORMANCE,PROCESSOR,NETWORK,SYSSTORAGE,DOCOMI,PROCUREDBY,VENDOR,IPADDRESS) 
values (:sname,:stype,:sdesc,:sconfig,:sper,:sprocessor,:snet,:sstorage,:sdoc,:sproc,:svendor,:sip)");
$insert->execute(array('sname'=>$data[sysname],
		'stype'=>$data[type],
		'sdesc'=>$data[description],
		'sconfig'=>$data[config],
		'sper'=>$data[perf],
		'sprocessor'=>$data[processor],
		'snet'=>$data[network],
		'sstorage'=>$data[storage],
		'sdoc'=>$data[doc],
		'sproc'=>$data[procured],
		'svendor'=>$data[vendor],'sip'=>$data[ipadd]
		));
		$id=$dbh->lastInsertId();
		
//print_r($data[software]);		
foreach($data[software] as $softid=> $val)		
{	
//echo $data[software][$softid];
$insyssoft=$dbh->prepare("insert into SYSTEM_SOFTWARE (SYSNAME,SOFTID) values (:sname,:softid)");
$insyssoft->execute(array('sname'=>$data[sysname],'softid'=>$data[software][$softid]));		
}

return($id);
}

/*
public function saveups($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from upsdetail where ups_name='$data[upsname]'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

if($sql1!="")
{
	$qdel="DELETE FROM upsdetail where ups_name=:sname";
	$up = $dbh->prepare($qdel);
$up->bindValue(':sname',$data[sysname]);
$up->execute();
}

$insert=$dbh->prepare("insert into SYSTEM_DETAIL (SYSNAME,TYPE,DESCRIPTION, CONFIG, PERFORMANCE,PROCESSOR,NETWORK,SYSSTORAGE,DOCOMI,PROCUREDBY,VENDOR,IPADDRESS) 
values (:sname,:stype,:sdesc,:sconfig,:sper,:sprocessor,:snet,:sstorage,:sdoc,:sproc,:svendor,:sip)");
$insert->execute(array('sname'=>$data[sysname],
		'stype'=>$data[type],
		'sdesc'=>$data[description],
		'sconfig'=>$data[config],
		'sper'=>$data[perf],
		'sprocessor'=>$data[processor],
		'snet'=>$data[network],
		'sstorage'=>$data[storage],
		'sdoc'=>$data[doc],
		'sproc'=>$data[procured],
		'svendor'=>$data[vendor],'sip'=>$data[ipadd]
		));
		$id=$dbh->lastInsertId();
		
//print_r($data[software]);		
foreach($data[software] as $softid=> $val)		
{	
//echo $data[software][$softid];
$insyssoft=$dbh->prepare("insert into SYSTEM_SOFTWARE (SYSNAME,SOFTID) values (:sname,:softid)");
$insyssoft->execute(array('sname'=>$data[sysname],'softid'=>$data[software][$softid]));		
}

return($id);
}


*/

//Old Cluster node assignment

public function fetchclusNodestat($type)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");


if(($type)!="All")

$sql1="select * from oldclusnode where clusname='$type'";

else 
$sql1="select * from oldclusnode";

$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();

return $sql1;

}


public function fetchclusNode($seqID)
{
			
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from oldclusnode where slno=$seqID";

$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

return $sql1;
}

public function saveclusNode($data)
{

$db=new Db();
$dbh=$db->getInstance("hpcweb");


$insert=$dbh->prepare("INSERT INTO oldclusnode (`clusname`, `nodename`, `issuedto`, `issueddate`, `divgrp`, `assignment_type`, `returndate`, `purpose`, `remarks`) VALUES (:clusname,:nodename,:issuedto,:issueddate,:divgrp,:assignment_type,:returndate,:purpose,:remarks)");
$insert->execute(array( 'clusname'=>$data[clusname],
            'nodename'=>$data[nodename],         
			'issuedto'=>$data[issuedto],
			'issueddate'=>$data[issueddate],
			'divgrp'=>$data[divgrp],
			'assignment_type'=>$data[assignment_type],
            'returndate'=>$data[returndate],			
			'purpose'=>$data[purpose],
			'remarks'=>$data[remarks]));
		$id=$dbh->lastInsertId();
return($id);
}



public function updateclusNode($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$insert=$dbh->prepare("UPDATE oldclusnode SET `clusname`=:clusname, `nodename`=:nodename, `issuedto`=:issuedto, `issueddate`=:issueddate, `divgrp`=:divgrp, `assignment_type`=:assignment_type, `returndate`=:returndate, `purpose`=:purpose, `remarks`=:remarks where slno=:slno");
$insert->execute(array( 
			'slno'=>$data[seqID],
			'clusname'=>$data[clusname],
            'nodename'=>$data[nodename],         
			'issuedto'=>$data[issuedto],
			'issueddate'=>$data[issueddate],
			'divgrp'=>$data[divgrp],
			'assignment_type'=>$data[assignment_type],
            'returndate'=>$data[returndate],			
			'purpose'=>$data[purpose],
			'remarks'=>$data[remarks]));
		$id=$dbh->lastInsertId();
return($id);
}
//Workstation Assignment

public function fetchWSstat()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");


$sql1="select * from WorkstationAssign";

$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();

return $sql1;
}

public function fetchWS($seqID)
{
			
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql1="select * from WorkstationAssign where WSno=$seqID";

$sql1=$dbh->query($sql1);
$sql1=$sql1->fetch();

return $sql1;
}

public function saveWS($data)
{
	
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$insert=$dbh->prepare("INSERT INTO WorkstationAssign (`WSname`, `WSmake`, `wsOS`, `WSIP`, `WStype`, `WScurstatus`, `WSremarks`) VALUES (:WSname,:WSmake,:wsOS,:WSIP,:WStype,:WScurstatus,:WSremarks)");
$insert->execute(array( 'WSname'=>$data[WSname],         
			'WSmake'=>$data[WSmake],
			'wsOS'=>$data[wsOS],
			'WSIP'=>$data[WSIP],
			'WStype'=>$data[WStype],
            'WScurstatus'=>$data[WScurstatus],			
			'WSremarks'=>$data[WSremarks]));
		$id=$dbh->lastInsertId();
		
		
return($id);
}


public function updateWS($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$insert=$dbh->prepare("UPDATE WorkstationAssign SET `WSname`=:WSname, `WSmake`=:WSmake, `wsOS`=:wsOS, `WSIP`=:WSIP, `WStype`=:WStype, `WScurstatus`=:WScurstatus, `WSremarks`=:WSremarks where WSno=:slno");
$insert->execute(array( 
			'slno'=>$data[seqID],
			'WSname'=>$data[WSname],         
			'WSmake'=>$data[WSmake],
			'wsOS'=>$data[wsOS],
			'WSIP'=>$data[WSIP],
			'WStype'=>$data[WStype],
            'WScurstatus'=>$data[WScurstatus],			
			'WSremarks'=>$data[WSremarks]
			));
		$id=$dbh->lastInsertId();
return($id);
}



}
?>
