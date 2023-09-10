<?php

require_once 'dbclass.php';
class vdi_model
{

 public function __construct(){

	}   
    
public function vdireq($data)
 {
  //echo "coming inside if";
try
{
$db=new Db();
$dbh=$db->getInstance("vdiweb");
$c_date = date ("Y-m-d");
$stat="User_Requested";
$query = "INSERT INTO vdirequest (`icno`,`user_name`,`phoneno`, `section`,`division`,`igroup`,`mailid`,`predate`,`ipadd`,
`reqstat`,`datereq`,`des`) 
VALUES (:icno,:name,:phone,:sec,:div,:grp,:email,:predate,:ipadd,:stat,:reqdate,:des)";
$stmt=$dbh->prepare($query);
$stmt->bindParam(':icno', $data[icno], PDO::PARAM_INT);
$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
$stmt->bindParam(':phone', $data[phone], PDO::PARAM_INT);
$stmt->bindParam(':sec', $data[sec], PDO::PARAM_STR);
$stmt->bindParam(':div', $data[div], PDO::PARAM_STR);
$stmt->bindParam(':grp', $data[grp], PDO::PARAM_STR);
$stmt->bindParam(':email', $data[email], PDO::PARAM_STR);
$stmt->bindParam(':predate', $data[predate], PDO::PARAM_STR);
$stmt->bindParam(':ipadd', $data[ipadd], PDO::PARAM_STR);
//$stmt->bindParam(':app', $data[app], PDO::PARAM_STR);
//$stmt->bindParam(':ser', $ser, PDO::PARAM_STR);
$stmt->bindParam(':reqdate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':stat', $stat, PDO::PARAM_STR);
//$stmt->bindParam(':credate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':des', $data[des], PDO::PARAM_STR);
//$stmt->bindParam(':serapp', $serapp, PDO::PARAM_STR);
$stmt->execute();
//$dbh = null;        // Disconnect
$id = $dbh->lastInsertId();
//echo "Last Inserted Id ***************".$id;
return $id;
} 

catch(PDOException $e) 
{
    trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
	echo $e->getMessage();
}
//echo "<script> alert('User Requitision is Forwarded To Administrator:'); window.location.assign('userreqprint.php?uicno=$icno?'); ";
// $errMsg.='User Requitision is Forwarded To Administrator: ';
// echo "<script> window.location.assign('vdirequestprt.php');";
} //function 	   



public function vdireqstat()
{
$db=new Db();
$dbh=$db->getInstance("vdiweb");
$sql1="select * from vdirequest";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function serappreq($reqid)
{
$db=new Db();
$dbh=$db->getInstance("vdiweb");
//$sqlser="SELECT sername,appname FROM `hpcappser` where reqid='$reqid' group by sername";

$sqlser="SELECT sername, GROUP_CONCAT(appname SEPARATOR ',') as apname FROM `hpcappser` where reqid='$reqid' group by sername";

$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetchAll();
return $sqlser;
}

} //class
?>
