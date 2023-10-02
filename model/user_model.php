<?php

require_once 'dbclass.php';
class user_model
{

 public function __construct(){

	}   
    
public function user_req($data)
 {
  //echo "coming inside if";
try

{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$c_date = date ("Y-m-d");
$stat="User_Requested";
$query = "INSERT INTO HPCUSER (`icno`,`user_name`,`phoneno`, `section`,`division`,`igroup`,`mailid`,`preuname`,`ipadd`,
`hpcstat`,`datereq`,`applusage`,`des`,`unit`,`subgroup`,`clustergroup`,`existing_account`,`clustergroup_existing`,`ad_uname`) 
VALUES (:icno,:name,:phone,:sec,:div,:grp,:email,:lognames,:ipadd,:stat,:reqdate,:app,:des,:unit,:subgrp,:homefldr,:clusacct,:homefldr_existing,:adacct)";
$stmt=$dbh->prepare($query);
$stmt->bindParam(':icno', $data[icno], PDO::PARAM_INT);
$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
$stmt->bindParam(':phone', $data[phone], PDO::PARAM_INT);
$stmt->bindParam(':sec', $data[sec], PDO::PARAM_STR);
$stmt->bindParam(':div', $data[div], PDO::PARAM_STR);
$stmt->bindParam(':grp', $data[grp], PDO::PARAM_STR);
$stmt->bindParam(':email', $data[email], PDO::PARAM_STR);
$stmt->bindParam(':lognames', $data[lognames], PDO::PARAM_STR);
$stmt->bindParam(':ipadd', $data[ipadd], PDO::PARAM_STR);
$stmt->bindParam(':app', $data[app], PDO::PARAM_STR);
//$stmt->bindParam(':ser', $ser, PDO::PARAM_STR);
$stmt->bindParam(':reqdate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':stat', $stat, PDO::PARAM_STR);
//$stmt->bindParam(':credate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':des', $data[des], PDO::PARAM_STR);
$stmt->bindParam(':unit', $data[unit], PDO::PARAM_STR);
$stmt->bindParam(':subgrp', $data[subgrp], PDO::PARAM_STR);
$stmt->bindParam(':homefldr', $data[homefldr], PDO::PARAM_STR);
$stmt->bindParam(':clusacct', $data[clusacct], PDO::PARAM_STR);
$stmt->bindParam(':homefldr_existing', $data[homefldr_existing], PDO::PARAM_STR);
$stmt->bindParam(':adacct', $data[adacct], PDO::PARAM_STR);
//$stmt->bindParam(':serapp', $serapp, PDO::PARAM_STR);
$stmt->execute();
//$dbh = null;        // Disconnect
$id = $dbh->lastInsertId();
//echo "Last Inserted Id ***************".$id;

if($id!=0)
{
//echo "Coming Inside";
//$f_id=$id;
$cnt=0;
foreach($data[serapp] as $selected => $val ) 
{
$ser_app1=$data[serapp][$selected];
//echo $ser_app1;
$lst = explode(",", $ser_app1);
$sername=$lst[0];
$appname=$lst[1];
//echo $sername ."<br>";
//echo $appname ."<br>";
$query = "INSERT INTO `hpcappser` (`reqid`,`sername`, `appname`) VALUES (:reqid,:sername, :appname)";

$s = $dbh->prepare($query);
    $s->bindValue(':reqid',$id);
    $s->bindValue(':sername',$sername);
    $s->bindValue(':appname',$appname);
$s->execute();
} //for
return $id;
} 

} //close try
catch(PDOException $e) 
{
    trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
    //error_log("Error occured while trying to insert into the DB:" . $e->getMessage());
	echo $e->getMessage();
}
//echo "<script> alert('User Requitision is Forwarded To Administrator:'); window.location.assign('userreqprint.php?uicno=$icno?'); ";
// $errMsg.='User Requitision is Forwarded To Administrator: ';
// echo "<script> window.location.assign('hpcuserprt.php');";
} //function 	   



public function userstat()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from HPCUSER";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function serappreq($reqid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sqlser="SELECT sername,appname FROM `hpcappser` where reqid='$reqid' group by sername";

$sqlser="SELECT sername, GROUP_CONCAT(appname SEPARATOR ',') as apname FROM `hpcappser` where reqid='$reqid' group by sername";

$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetchAll();
return $sqlser;
}

public function userreqprint($reqid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sqlser="SELECT * FROM HPCUSER where reqid='$reqid'";
$sqlser=$dbh->query($sqlser);
$sqlser=$sqlser->fetch();
return $sqlser;
}

public function ldapconnect()
{
	echo "inside admin model";
	//exit;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from HPCUSER where hpcstat='Request in Process'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function divtodivapproval()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from HPCUSER where (hpcstat='User_Requested') OR (hpcstat='User Requested')";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}


public function savedivtodivapproval($regid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//echo "model";
//exit;
$query = "UPDATE HPCUSER SET `hpcstat`='Request_Forwarded_To_CD' WHERE reqid=:reqid";
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$regid);
$up->execute();
$id1 = $up->rowcount();
return $id1;
}


public function divtosecapproval()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql1="select * from HPCUSER where hpcstat='Request_Forwarded_To_CD'";
$sql1="select * from HPCUSER where hpcstat='User Requested'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}


public function savedivtosecapproval($regid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//echo "model";
//exit;
$query = "UPDATE HPCUSER SET `hpcstat`='Forwarded_To_Section' WHERE reqid=:reqid";
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$regid);
$up->execute();
$id1 = $up->rowcount();
return $id1;
}

public function sectoadminapproval()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from HPCUSER where hpcstat='Forwarded_To_Section'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function savesectoadminapproval($regid,$adminuser)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//echo "model";
//exit;
$query = "UPDATE HPCUSER SET `hpcstat`='Request in Process' WHERE reqid=:reqid";
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$regid);
$up->execute();
$id1 = $up->rowcount();
return $id1;
}


public function fetchadminapproval()
{
	echo "inside admin model";
	//exit;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="select * from HPCUSER where hpcstat='Request in Process'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}


public function fetchadminusers()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql1="SELECT * FROM `HPCPORTALUSRS` WHERE MEMTYPE='A' OR MEMTYPE='AI' OR MEMTYPE='AS'";
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
//print_r($sql1);
return $sql1;
}


public function saveadmin($regid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//echo "model";
//exit;
$query = "UPDATE HPCUSER SET `hpcstat`='In-process' WHERE reqid=:reqid";
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$regid);
$up->execute();
$id1 = $up->rowcount();
return $id1;
}



public function userupdateforward($regid)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//echo "model";
//exit;
$query = "UPDATE `user_FORM` SET `userSTAT`='usering in  Progress' WHERE user_ID=:reqid";
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$regid);
$up->execute();
$id1 = $up->rowcount();
return $id1;
}

public function userrequser($regid)
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



public function usertake()
{
//echo $regid;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="select * from user_FORM where userSTAT ='usering in Progress'";
$sql1=$dbh->query($sql);
$sql1=$dbh->query($sql1);
$sql1=$sql1->fetchAll();
return $sql1;
}

public function getldapuser($username)
{
	//echo "inside Model".  $username;
 $ldapServer = "10.20.2.19";
 $ldap = ldap_connect($ldapServer);
 $ldaprdn = 'uid='. $username.',ou=People,dc=igcar,dc=cd';
 ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
 ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
 $bind = @ldap_bind($ldap);
// $bind = @ldap_bind($ldap);
    if ($bind) {
		//echo "inside bind";
        $filter="(uid=$username)";
        $result = ldap_search($ldap,"dc=igcar,dc=cd",$filter);
		//echo "result" .$result;
//        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
			$userDn = $info[$i]["dn"][0];
            $uname = $info[$i]["cn"][0];
            $ic = $info[$i]["employeenumber"][0]; 
	        $email = $info[$i]["mail"][0];
			$cn = $info[$i]["cn"][0];
			$host = $info[$i]["host"][0];
			$phone = $info[$i]["telephonenumber"][0];
			$emptype = $info[$i]["employeetype"][0];
			$hostip = $info[$i]["iphostnumber"][0];
			$grpinfo=$info[$i]["ou"][2]."/".$info[$i]["ou"][1]."/".$info[$i]["ou"][0];
		     
        }
		//echo "Ic ". $ic;
		$ldapuser[userDn]=$userDn;
		$ldapuser[uname]=$uname;
		$ldapuser[ic]=$ic;
		$ldapuser[email]=$email;
		$ldapuser[cn]=$cn;
		$ldapuser[host]=$host;
		$ldapuser[phone]=$phone;
		$ldapuser[emptype]=$emptype;
		$ldapuser[hostip]=$hostip;
		$ldapuser[grpinfo]=$grpinfo;
		//print_r($ldapuser);
		return $ldapuser;
		
        }
}



public function save_feedback($data)
{print_r($data);

	//exit;
	$str=explode("/",$data[sec]);
$grp=$str[0];
$div=$str[1];
$sec=$str[2];

$db=new Db();

$dbh=$db->getInstance("hpcweb");
$query = "INSERT INTO `FEEDBACK`(`ICNO`, `UID`, `NAME`, `DESIG`, `SEC`, `DIVISION`, `PHNO`, `UGROUP`, `EMAIL`, `SERNAME`, `SOFTWARF_USAGE`, `FEEDBACKYEAR`, `AVILA`, `UPDRA`, `TECH`, `FINDEX`, `OTHERSW`, `REMARKS`, `CLIENTIP`, `INTERNALIP_LAN`) VALUES (:icno,:uid,:name,:des,:sec,:div,:phone,:grp,:email,:serid,:serapp,:fyear,:availa,:upgra,:tech,:sindex,:othersw,:remark,:clientip,:internalip)";
$stmt=$dbh->prepare($query);
echo $query;
echo $grp;

$stmt->bindParam(':icno', $data[icno], PDO::PARAM_INT);
$stmt->bindParam(':uid', $data[uid], PDO::PARAM_STR);
$stmt->bindParam(':name', $data[name], PDO::PARAM_STR);
$stmt->bindParam(':des', $data[des], PDO::PARAM_STR);
$stmt->bindParam(':phone', $data[phone], PDO::PARAM_STR);
$stmt->bindParam(':sec', $sec, PDO::PARAM_STR);
$stmt->bindParam(':div', $div, PDO::PARAM_STR);
$stmt->bindParam(':grp', $grp, PDO::PARAM_STR);
$stmt->bindParam(':email', $data[email], PDO::PARAM_STR);
$stmt->bindParam(':serid', $data[serid], PDO::PARAM_STR);
$stmt->bindParam(':serapp', $data[serapp], PDO::PARAM_STR);
$stmt->bindParam(':othersw', $data[othersw], PDO::PARAM_STR);
$stmt->bindParam(':availa', $data[availa], PDO::PARAM_STR);
$stmt->bindParam(':upgra', $data[upgra], PDO::PARAM_STR);
$stmt->bindParam(':tech', $data[tech], PDO::PARAM_STR);
$stmt->bindParam(':sindex', $data[sindex], PDO::PARAM_STR);
$stmt->bindParam(':remark', $data[remark], PDO::PARAM_STR);
$stmt->bindParam(':fyear', $data[fyear], PDO::PARAM_STR);

//Client IP address
$stmt->bindParam(':clientip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
$stmt->bindParam(':internalip', $_SERVER['HTTP_X_FORWARDED_FOR'], PDO::PARAM_STR);
$stmt->execute(); 
$id = $dbh->lastInsertId();

return $id;
}


public function userfeedback()
{
/*if (isset($_SESSION['icno_session']))
{
$lname=$_SESSION['icno_session'];
} */
//echo $lname;
$sql="select * from HPCUSERINFO where icno='$lname'";

$sql1=$dbh->query($sql);
$count=0;
while($r=$sql1->fetch(PDO::FETCH_ASSOC))
{
$count=$count+1;
$uid[$count]=htmlspecialchars($r['userid']);
$uname[$count]=htmlspecialchars($r['user_name']);
$uph[$count]=htmlspecialchars($r['phoneno']);
$usec[$count]=htmlspecialchars($r['section']);
$udiv[$count]=htmlspecialchars($r['division']);
$ugrp[$count]=htmlspecialchars($r['igroup']);
$umail[$count]=htmlspecialchars($r['mailid']);
$udes[$count]=htmlspecialchars($r['designation']);
$userv[$count]=htmlspecialchars($r['serverid']);
}
//echo $count;
if ($userv[1]=='neha' || $userv[2]=='neha' || $userv[3]=='neha')
{$clu134="134 Node HPC Cluster";}
if ($userv[1]=='smp' || $userv[2]=='smp' || $userv[3]=='smp')
{$smp="Xeon Based SMP Server";}
if ($userv[1]=='xeon' || $userv[2]=='xeon' || $userv[2]=='xeon')
{$clu128="128 Node HPC Cluster";}
$serusage = $clu134 .','  .$smp .',' .$clu128;
//echo $serusage;

//Find Clients IP Address
if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

}
} //class
?>
