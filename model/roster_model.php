<?php

require_once 'dbclass.php';
class rostermodel
{

public function __construct()
{
}   
   
public function store_crew_pattern($cname,$cdate,$apattern)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$query = "INSERT INTO crew_pattern (`c_name`,`c_date`,`c_pattern`) 
VALUES (:cname,:cdate,:cpattern)";
$stmt=$dbh->prepare($query);
$stmt->bindParam(':cname', $cname, PDO::PARAM_INT);
$stmt->bindParam(':cdate', $cdate, PDO::PARAM_STR);
$stmt->bindParam(':cpattern',$apattern, PDO::PARAM_INT);
$stmt->execute();

}
public function get_crew_pattern($cname,$m,$y)
{
//echo "coming to model";
//exit;
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM crew_pattern where c_name='".$cname. "' and MONTH(c_date)=" .$m. " and YEAR(c_date)=" .$y;
$sql1=$dbh->query($sql);
$s=$sql1->fetch();
return $s; 
}


public function store_crew_details($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$query = "INSERT INTO crew_details (`c_name`,`c_mem`,`icno`,`desig`) 
VALUES (:cname,:cmem,:icno,:desig)";
$stmt=$dbh->prepare($query);
$stmt->bindParam(':cname', $cname, PDO::PARAM_INT);
$stmt->bindParam(':cdate', $cdate, PDO::PARAM_STR);
$stmt->bindParam(':cpattern',$apattern, PDO::PARAM_INT);
$stmt->execute();
}
/*
function get_crew_details($icno)
{

$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM crew_details where icno='".$icno."'";

//$sql="SELECT * FROM crew_details_try where icno='".$icno."'"; 

SELECT * FROM `crew_details_try` WHERE `quarter`='III' and `selyear`='2023'
$sql1=$dbh->query($sql);
$sql1=$sql1->fetch();
return $sql1;
}
*/
function get_crew_details($icno,$selquarter)
{
$splitstr=explode('_',$selquarter);
$squarter= $splitstr[0];
$syear= $splitstr[1];


$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM crew_details where icno='".$icno."'";

//$sql="SELECT * FROM crew_details_try where icno='".$icno."'"; 

$sql="SELECT * FROM `crew_details_try` WHERE icno='".$icno."' and quarter='".$squarter."' and `selyear`='".$syear."'";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetch();
return $sql1;
}

function get_crew_members($cname)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");

$sql="SELECT * FROM crew_details where c_name='".$cname."'";
//$sql="SELECT * FROM crew_details_03042023 where c_name='".$cname."'";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}
/*
function get_all_crew_details()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM crew_details order by icno";
//$sql="SELECT * FROM crew_details_try order by icno";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}
*/
function get_all_crew_details($selquarter)
{
$splitstr=explode('_',$selquarter);
$squarter= $splitstr[0];
$syear= $splitstr[1];
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql="SELECT * FROM crew_details order by icno";
$sql="SELECT * FROM crew_details_try WHERE quarter='".$squarter."' and selyear='".$syear."' order by icno";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}


public function get_cd_staff()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM cd_staff order by icno";
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
return $sql1;
}


public function store_leave_action_details($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql= "insert into leave_action_details (`id`,`icno`, `req_date`, `from_date`, `to_date`, `type`,`typeofreq`, `actionby`, `remarks`,`change_with`,`over_time_start`,`over_time_end`,`section_of`,`work_description`,`work_alloted_by`) 
values (NULL,:icno,:reqdate1,:fromdate1,:todate1,:type,:typeofreq,:actionby,:remarks,:change_with, :over_time_start, :over_time_end, :section_of,:work_description,:work_alloted_by)";
//$sql= "insert into leave_action_details (`icno`, `req_date`, `from_date`, `to_date`, `type`, `actionby`, `remarks`,`typeofreq`) 
//values ($data[icno],'$data[reqdate1]','$data[fromdate1]','$data[todate1]','$data[type]','$data[actionby]','$data[remarks]','$data[typeofreq]')";
//$dbh->query($sql);
//echo $sql;
$stmt=$dbh->prepare($sql);
$stmt->bindParam(':icno', $data[icno]);
$stmt->bindParam(':reqdate1', $data[reqdate1]);
$stmt->bindParam(':fromdate1',$data[fromdate1]);
$stmt->bindParam(':todate1',$data[todate1]);
$stmt->bindParam(':type',$data[type]);
$stmt->bindParam(':typeofreq',$data[typeofreq]);
$stmt->bindParam(':actionby',$data[actionby]);
$stmt->bindParam(':remarks',$data[remarks]);
$stmt->bindParam(':change_with',$data[doner_name]);
$stmt->bindParam(':over_time_start',$data[over_time_start]);
$stmt->bindParam(':over_time_end',$data[over_time_end]);
$stmt->bindParam(':section_of',$data[section_of]);
$stmt->bindParam(':work_description',$data[work_description]);
$stmt->bindParam(':work_alloted_by',$data[work_alloted_by]);
$stmt->execute();
return $stmt->rowCount();
}
//added on 04/01/2023
public function store_leave_action_details_change_with($data)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql= "insert into leave_action_details (`id`,`icno`, `req_date`, `from_date`, `to_date`, `type`,`typeofreq`, `actionby`, `remarks`,`change_with`,`over_time_start`,`over_time_end`,`section_of`,`work_description`,`work_alloted_by`) 
values (NULL,:icno,:reqdate1,:fromdate1,:todate1,'.*.','D',:actionby,:remarks,:change_with, :over_time_start, :over_time_end, :section_of,:work_description,:work_alloted_by)";
//$sql= "insert into leave_action_details (`icno`, `req_date`, `from_date`, `to_date`, `type`, `actionby`, `remarks`,`typeofreq`) 
//values ($data[icno],'$data[reqdate1]','$data[fromdate1]','$data[todate1]','$data[type]','$data[actionby]','$data[remarks]','$data[typeofreq]')";
//$dbh->query($sql);
//echo $sql;
$stmt=$dbh->prepare($sql);
$stmt->bindParam(':icno', $data[doner_icno]);
$stmt->bindParam(':reqdate1', $data[reqdate1]);
$stmt->bindParam(':fromdate1',$data[fromdate1]);
$stmt->bindParam(':todate1',$data[todate1]);
$stmt->bindParam(':actionby',$data[actionby]);
$stmt->bindParam(':remarks',$data[remarks]);
$stmt->bindParam(':change_with',$data[name]);
$stmt->bindParam(':over_time_start',$data[over_time_start]);
$stmt->bindParam(':over_time_end',$data[over_time_end]);
$stmt->bindParam(':section_of',$data[section_of]);
$stmt->bindParam(':work_description',$data[work_description]);
$stmt->bindParam(':work_alloted_by',$data[work_alloted_by]);
$stmt->execute();
return $stmt->rowCount();
}







public function rub_leave_action_details($data)
{
//print_r($data);
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql =  "DELETE FROM  leave_action_details WHERE  icno = :icno AND from_date = :fromdate1 LIMIT 1 "; 
//echo $sql;
$stmt=$dbh->prepare($sql);
$stmt->bindParam(':icno', $data[icno]);
$stmt->bindParam(':fromdate1',$data[fromdate1]);
$stmt->execute();
return $stmt->rowCount();
}

function get_leave_action_details($icno,$m,$y)
{
//echo "Coming to Model Crew";
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$sql="SELECT * FROM leave_action_details where icno='".$icno."' AND (MONTH(from_date)='".$m ."' or MONTH(to_date)='".$m."') and (year(from_date)='".$y ."' or YEAR(to_date)='".$y."')";
//echo $sql;
$sql1=$dbh->query($sql);
$sql1=$sql1->fetchAll();
//print_r($sql1);
//exit;
return $sql1;
}

function get_today_leave_action($icno,$m,$y,$d)
{
//echo "Coming to Model Crew";
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql="SELECT type FROM leave_action_details where icno='".$icno."' AND (day(from_date)='".$d ."' or day(to_date)='".$d."') and  (MONTH(from_date)='".$m ."' or MONTH(to_date)='".$m."') and (year(from_date)='".$y ."' or YEAR(to_date)='".$y."')";

$sql="SELECT type FROM leave_action_details WHERE (from_date <= now() AND to_date >= now()) AND icno='".$icno."' ";

//echo $sql;
//exit;
$sql1=$dbh->query($sql);
$sql1=$sql1->fetch();
//echo $sql1;
//print_r($sql1);
//exit;
return $sql1;
}

function get_leave_report()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql="SELECT type FROM leave_action_details where icno='".$icno."' AND (day(from_date)='".$d ."' or day(to_date)='".$d."') and  (MONTH(from_date)='".$m ."' or MONTH(to_date)='".$m."') and (year(from_date)='".$y ."' or YEAR(to_date)='".$y."')";
//echo $sql;
//exit;
$sql1="SELECT DATEDIFF(`to_date`,`from_date`) AS DiffDate,leave_action_details.icno,leave_action_details.type,crew_details.c_mem from leave_action_details,crew_details where month(`from_date`)=month(CURRENT_DATE) AND crew_details.icno=leave_action_details.icno AND leave_action_details.type!='' AND typeofreq='L'";
$sql1=$dbh->query($sql1);
$leaverep = $sql1->fetchAll(); 
return $leaverep;
}

function get_action_report()
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql1="SELECT DATEDIFF(`to_date`,`from_date`) AS DiffDate,leave_action_details.icno,leave_action_details.type,crew_details.c_mem from leave_action_details,crew_details where month(`from_date`)=month(CURRENT_DATE) AND crew_details.icno=leave_action_details.icno AND leave_action_details.type!='' AND typeofreq='L'";
$sql1="SELECT DATEDIFF(`to_date`,`from_date`) AS DiffDate,leave_action_details.icno,leave_action_details.type,crew_details.c_mem from leave_action_details,crew_details where month(`from_date`)=month(CURRENT_DATE) AND crew_details.icno=leave_action_details.icno AND leave_action_details.type!=''  AND typeofreq='A' ";
$sql1=$dbh->query($sql1);
$actionrep = $sql1->fetchAll(); 
return $actionrep;
}


public function get_crew_names()
{
	$db=new Db();
$dbh=$db->getInstance("hpcweb");
//$sql="SELECT type FROM leave_action_details where icno='".$icno."' AND (day(from_date)='".$d ."' or day(to_date)='".$d."') and  (MONTH(from_date)='".$m ."' or MONTH(to_date)='".$m."') and (year(from_date)='".$y ."' or YEAR(to_date)='".$y."')";
//echo $sql;
//exit;
$sql1="SELECT DISTINCT c_name from crew_details";
$sql1=$dbh->query($sql1);
$cnames = $sql1->fetchAll(); 
return $cnames;
	
	
}

//update crew members for shift patten using form to date on 28/06/2021
public function update_crew_members($fdate,$tdate,$crew,$member)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$query = "UPDATE crew_pattern SET c_members = :member WHERE c_name = :crew and c_date between :fdate and :tdate ";

$stmt=$dbh->prepare($query);
$stmt->bindParam(':member', $member, PDO::PARAM_STR);
$stmt->bindParam(':crew', $crew, PDO::PARAM_STR);
$stmt->bindParam(':fdate', $fdate, PDO::PARAM_STR);
$stmt->bindParam(':tdate', $tdate, PDO::PARAM_STR);
$stmt->execute();
}

public function alter_crew_members($fdate,$crew,$member)
{
$db=new Db();
$dbh=$db->getInstance("hpcweb");
$query = "UPDATE crew_pattern SET c_members = :member WHERE c_name = :crew and c_date = :fdate ";

$stmt=$dbh->prepare($query);
$stmt->bindParam(':member', $member, PDO::PARAM_STR);
$stmt->bindParam(':crew', $crew, PDO::PARAM_STR);
$stmt->bindParam(':fdate', $fdate, PDO::PARAM_STR);
$stmt->execute();
}


// deleting Crew pattern

public function del_crew_pattern()
{
	
	echo "coming Inside";
	$db=new Db();
$dbh=$db->getInstance("hpcweb");
$dbh->query("TRUNCATE TABLE crew_pattern");

}


//Government holidays
public function govholidays($y,$m)
{
	$db = new Db();
	$dbh = $db->getInstance("hpcweb");
	$sql1="SELECT day(fes_date) as fes_day, name_of_festival from gov_holidays where year(fes_date) = $y and month(fes_date) = $m";
	$sql1=$dbh->query($sql1);
	$holidays = $sql1->fetchAll(); 
	return $holidays;
}


//change_crew_members added on 14/09/2022

public function change_crew_members($c_name,$c_mem, $icno, $desig, $crew_as_on_date, $id, $rows){			
		$db=new Db();
		$dbh = $db->getInstance("hpcweb");
		
		for( $i=0; $i<$rows; $i++ ){
		//$sql = "UPDATE crew_details_try SET c_name = :c_name,c_mem = :c_mem, icno = :icno,desig = :desig, crew_as_on_date = :crew_as_on_date WHERE id = :id";	
		$sql = "UPDATE crew_details SET c_name = :c_name,c_mem = :c_mem, icno = :icno,desig = :desig, crew_as_on_date = :crew_as_on_date WHERE id = :id";		
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':id', $id[$i], PDO::PARAM_STR);
		$stmt->bindparam(':c_name', $c_name[$i], PDO::PARAM_STR);
		$stmt->bindparam(':c_mem', $c_mem[$i], PDO::PARAM_STR);
		$stmt->bindparam(':icno', $icno[$i], PDO::PARAM_STR);
		$stmt->bindparam(':desig', $desig[$i], PDO::PARAM_STR);
		$stmt->bindparam(':crew_as_on_date', $crew_as_on_date[$i], PDO::PARAM_STR);			
		$stmt->execute();		
		}		
			
	}
	
//added on 14/09/2022	
	public function add_crew_member($c_name, $c_mem, $icno, $desig, $crew_as_on_date){
		$db=new Db();
		$dbh = $db->getInstance("hpcweb");
		//$sql = "INSERT INTO crew_details_try (id, c_name, c_mem, icno, desig, crew_as_on_date) VALUES (NULL, :c_name, :c_mem, :icno, :desig, :crew_as_on_date)";
		$sql = "INSERT INTO crew_details (id, c_name, c_mem, icno, desig, crew_as_on_date) VALUES (NULL, :c_name, :c_mem, :icno, :desig, :crew_as_on_date)";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':c_name', $c_name);
		$stmt->bindparam(':c_mem', $c_mem);
		$stmt->bindparam(':icno', $icno);
		$stmt->bindparam(':desig', $desig);
		$stmt->bindparam(':crew_as_on_date', $crew_as_on_date);		
		$stmt->execute();		
	}
	
//added on 14/09/2022	
	public function delete_crew_member($id){
		$db=new Db();
		$dbh = $db->getInstance("hpcweb");
		//$sql = "DELETE FROM crew_details_try WHERE id = :id";
		$sql = "DELETE FROM crew_details WHERE id = :id";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam(':id', $id, PDO::PARAM_STR);			
		$stmt->execute();
	}

//added on 14/09/2022
	public function fetch_crew_details(){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
		//$sql="SELECT *, date_format(crew_as_on_date,'%d/%m/%Y') as crew_as_on_date FROM crew_details_try order by icno";
		//$sql="SELECT * FROM crew_details_try order by icno";
		$sql="SELECT * FROM crew_details order by icno";
		//$sql="SELECT * FROM crew_details_03072023 order by icno"; 
		$sql1=$dbh->query($sql);
		$sql1=$sql1->fetchAll();
		return $sql1;
	}
	

//added on 16/09/2022
	public function duplicate_crew_details_table(){
		$suffix = date("dmY",time());
		$table = "crew_details_".$suffix;
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
		$sql = "CREATE TABLE ".$table." LIKE crew_details";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam();
		$stmt->execute();
		$sql="INSERT INTO ".$table." SELECT * FROM crew_details";
		$stmt = $dbh->prepare($sql);
		$stmt->bindparam();
		$stmt->execute();
	}

//added on 02/01/2023
	public function shift_changes($icno,$month,$year){
		
		//SELECT * FROM `leave_action_details` WHERE icno = 10384 AND typeofreq = "C" and month(from_date) = 12 and year(from_date)=2022
		//SELECT * FROM `leave_action_details` WHERE icno = 10384 AND typeofreq = "C" and month(from_date) = month(CURRENT_DATE)
		//and year(from_date)=year(CURRENT_DATE);
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
		
		$sql = "SELECT *,date_format(from_date,'%d/%m/%Y')as from_date FROM `leave_action_details` WHERE 
		typeofreq = 'C' and 
		month(from_date) = ".$month." and 
		year(from_date) = ".$year." and
		icno = ".$icno;		
		$sql1=$dbh->query($sql);		
		$sql1=$sql1->fetchAll();		
		return $sql1;
		
	}

//added on 03/01/2023
	public function over_time($icno){
		
		//SELECT * FROM `leave_action_details` WHERE icno = 10384 AND typeofreq = "C" and month(from_date) = 12 and year(from_date)=2022
		//SELECT * FROM `leave_action_details` WHERE icno = 10384 AND typeofreq = "C" and month(from_date) = month(CURRENT_DATE)
		//and year(from_date)=year(CURRENT_DATE);
		//select *from leave_action_details where from_date >= date_sub(now(),Interval 6 month)
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
		
		$sql = "SELECT *,date_format(from_date,'%d/%m/%Y')as from_date FROM `leave_action_details` WHERE 
		typeofreq = 'OT' and 
		from_date >= date_sub(now(),Interval 6 month) and
		icno = ".$icno;		
		$sql1=$dbh->query($sql);		
		$sql1=$sql1->fetchAll();		
		return $sql1;
		
	}


} //class
?>
