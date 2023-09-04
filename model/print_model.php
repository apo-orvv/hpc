<?php

require_once 'dbclass.php';
class print_model
{

 public function __construct(){

	}   
 
public function print_req($data)
 {
	 
	 
//echo "coming inside model";
  $db=new Db();
  $dbh=$db->getInstance("hpcweb");
$query1 = "INSERT INTO PRINT_FORM (`IC_NO`, `NAME`, `PURPOSE`, `DIVISION`, `EMAIL_ADDRESS`, `PHN_NO`, 
`REQDATE`, `PRINTSTAT`,`DESIG`) 
VALUES (:icno,:name,:purpose,:div,:email,:phone,:reqdate,:stat,:des)";
$stmt=$dbh->prepare($query1);
$stmt->bindParam(':icno', $data[icno], PDO::PARAM_INT);
$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
$stmt->bindParam(':purpose', $data[pur], PDO::PARAM_STR);
$stmt->bindParam(':div', $data[div], PDO::PARAM_STR);
$stmt->bindParam(':email', $data[email], PDO::PARAM_STR);
$stmt->bindParam(':phone', $data[phone], PDO::PARAM_INT);
$stmt->bindParam(':reqdate', $data[c_date], PDO::PARAM_STR);
//$stmt->bindParam(':comdate', $c_date, PDO::PARAM_NULL);
$stmt->bindParam(':des',$data[desi]);
$stmt->bindParam(':stat', $data[status], PDO::PARAM_STR);
$stmt->execute(); 
$id = $dbh->lastInsertId();
return $id;
} 
 
public function insert_file($data)
 {
  //echo "coming inside if";
  //print_r($data);
   $db=new Db();
   $dbh=$db->getInstance("hpcweb");
   $query = "INSERT INTO `file` (`PRINT_ID`,`fname`, `mime`, `size`, `created`,`papertype`,`papersize`,`nprint`,`path`) VALUES (:fid,:fname, :mime, :size, :datecre,:papertype,:papersize,:nprint,:path)";
//echo $query;
    $s = $dbh->prepare($query);
    $s->bindValue(':fid',$data[f_id]);
    $s->bindValue(':fname',$data[fname]);
    $s->bindValue(':mime', $data[mime]);
   // $s->bindValue(':data', $data[data);
    $s->bindValue(':size', $data[size]);
    $s->bindValue(':datecre',$data[datecre]);
    $s->bindValue(':papertype',$data[papertype]);
    $s->bindValue(':papersize',$data[papersize]);
    $s->bindValue(':nprint',$data[nprint]);
	$s->bindValue(':path',$data[uploadfname]);
$s->execute();
$id1 = $dbh->lastInsertId();
return $id1;
 }

public function printstat()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from PRINT_FORM";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function serappreq($reqid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sqlser="SELECT sername,appname FROM `hpcappser` where reqid='$reqid' group by sername";
$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetchAll();
return $sqlser;
}
public function fetchfile($reqid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sqlser="SELECT * FROM `file` where PRINT_ID='$reqid'";
$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetchAll();
return $sqlser;
}

public function printreqprint($reqid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sqlser="SELECT * FROM PRINT_FORM where PRINT_ID='$reqid'";
$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetch();
return $sqlser;
}

public function printforward()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from user_FORM where userSTAT='user_requested'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}
public function printupdate($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql = "UPDATE PRINT_FORM SET 
            PRINTSTAT =:printstat, 
            COMPDATE = :c_date
        WHERE PRINT_ID = :upvar";
//echo $sql;
$stmt = $dbh->prepare($sql);                                  
$stmt->bindParam(':printstat',$data[status], PDO::PARAM_STR);    
$stmt->bindParam(':c_date',$data[c_date]);   
$stmt->bindParam(':upvar',$data[varup], PDO::PARAM_INT); 

$stmt->execute();
return $stmt->rowCount();
//return $dbh->lastInsertId();
}

public function printrequser($regid)
{
//echo $regid;
$db=new Db();
$dbh=$db->getInstance("hpcweb");


$sql="select * from user_FORM where user_ID='$regid'";
//echo $sql;
 $records = $dbh->prepare($sql);
 $records-> execute();
// $r=$records->fetch(PDO::FETCH_ASSOC);
//  $rc=$records->rowCount();
$r=$records->fetch();

//user_r($r);
//$sql1="hello user Status";

return $r;
}

public function printtake()
{
//echo $regid;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="select * from PRINT_FORM where PRINTSTAT ='print_requested'";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function printreport()
{
echo model;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="select * from PRINT_FORM where PRINTSTAT ='Print_Completed'";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}


} //class
?>
