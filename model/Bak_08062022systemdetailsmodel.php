<?php
require_once 'dbclass.php';
require_once 'ldapfetch.php';
class SmDetailsModel{

	public function __construct(){

	}

	public function getsystemparams($systemname,$usertype){

	$systemparamsadmin=array('Ivy'=>['Nodes','Nodes (Detailed)','Queues','Jobs','JobsChart','Users','Cluster_Usage_History','Queue_Usage','Storage_Logs','Storage_Status','Storage_Servers','Job_Accounting','User_Details','DDN_Storage','Backup_Status'],
				'Neha'=>['Nodes','Queues','Jobs','Users','Cluster_Usage_History','Storage_Logs','Storage_Status','Storage_Servers','Job_Accounting','User_Details','Backup_Status'],
				'Licenses'=>['Abaqus','CFD-ACE/SYSWELD','ANSYS_17_1','ANSYS_18_2','ANSYS_19','COMSOL','License_Users','Utilization'],
				'GWS'=>['GWS_Monthly_Usage','GWS_History_Usage','GWS_AD_Users']);
		$systemparamsuser=array('Ivy'=>['Nodes','Nodes (Detailed)','Queues','Jobs','JobsChart','Users','User_Details'],
				'Neha'=>['Nodes','Queues','Jobs','Users','User_Details'],
				'Licenses'=>['Abaqus','CFD-ACE/SYSWELD','ANSYS_17_1','ANSYS_18_2','ANSYS_19','COMSOL','License_Users','Utilization']);
		if(($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AI') || ($usertype == 'O')){
		if(array_key_exists($systemname,$systemparamsadmin)){
			return $systemparamsadmin[$systemname];

		}	
		else{
			return NULL;
		}
		}
		else if($usertype == 'U'){
		if(array_key_exists($systemname,$systemparamsuser)){
			return $systemparamsuser[$systemname];

		}	
		else{
			return NULL;
		}
		}
	}
	public function getsystemparamsfordisplay($systemname,$usertype){

		
	$systemparamsadmin=array('Ivy'=>['Nodes','Queues','Jobs','Users','Cluster_Usage_History','Queue_Usage','Storage_Logs','Storage_Status','Storage_Servers','Job_Accounting','DDN_Storage','Backup_Status'],
				'Neha'=>['Nodes','Queues','Jobs','Users','Cluster_Usage_History','Storage_Logs','Storage_Status','Storage_Servers','Job_Accounting','Backup_Status'],
				'Licenses'=>['Abaqus','CFD-ACE/SYSWELD','ANSYS_17_1','ANSYS_18_2','ANSYS_19','COMSOL','License_Users','Utilization'],
				'GWS'=>['GWS_Monthly_Usage','GWS_History_Usage','GWS_AD_Users']);
		$systemparamsuser=array('Ivy'=>['Nodes','Queues','Jobs','Users'],
				'Neha'=>['Nodes','Queues','Jobs','Users'],
				'Licenses'=>['Abaqus','CFD-ACE/SYSWELD','ANSYS_17_1','ANSYS_18_2','ANSYS_19','COMSOL','License_Users','Utilization']);

		if(($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AI') || ($usertype == 'O')){
		if(array_key_exists($systemname,$systemparamsadmin)){
			return $systemparamsadmin[$systemname];

		}	
		else{
			return NULL;
		}
		}
		else if($usertype == 'U'){
		if(array_key_exists($systemname,$systemparamsuser)){
			return $systemparamsuser[$systemname];

		}	
		else{
			return NULL;
		}
		}


	}

	public function getuserdetails($username){

	list($cn,$mail,$phone,$group)=getldapuser($username);	
	$userdetails=array($cn,$mail,$phone,$group);
	$db=new Db();
	$dbcon=$db->getInstance("hpcmonitor");

	$req=$dbcon->prepare("SELECT * from sgejobs where username =:name ");
	$req->execute(array('name' => $username));

	$alljobs=array();
	$i=0;

	foreach ($req->fetchAll() as $msg){
                $alljobs[$i]=array($msg['timeofmon'],$msg['clustername'],$msg['jobid'],$msg['jobname'],$msg['queuename'],$msg['starttime'],$msg['jobstatus'],$msg['processname'],$msg['slots']);
                $i++;

        }
	$req=$dbcon->prepare("SELECT * from slurmjobs where username =:name ");
	$req->execute(array('name' => $username));
	foreach ($req->fetchAll() as $msg){
                $alljobs[$i]=array($msg['timeofmon'],$msg['clustername'],$msg['jobid'],$msg['jobname'],$msg['partitionname'],$msg['starttime'],$msg['state'],$msg['processname'],$msg['cpus']);
                $i++;

        }
	$req=$dbcon->prepare("SELECT clustername,count(*) as jobs,sum(wallclock) as wallclk,sum(slots) as Slots FROM sgefinishedjobsinfo WHERE username=:name ");
	$req->execute(array('name' => $username));

	$jobhis=$req->fetch();

	$jobhistory=array();
	$jobhistory[0]=array($jobhis['clustername'],$jobhis['jobs'],$jobhis['wallclk'],$jobhis['Slots']);
	$req=$dbcon->prepare("SELECT clustername,count(*) as jobs,sum(ElapsedTime) as wallclk,sum(slots) as Slots FROM slurmfinishedjobsinfo WHERE username=:name ");
	$req->execute(array('name' => $username));

	$jobhis=$req->fetch();
	$jobhistory[1]=array($jobhis['clustername'],$jobhis['jobs'],$jobhis['wallclk'],$jobhis['Slots']);

        $dbcon=null;
	return	array($userdetails,$alljobs,$jobhistory);
	}
	public function getclusterusage($systemname,$fromdate,$todate){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		if(strcmp($fromdate,"today")==0){

		$this_day=date("Y-m-d");
		$req=$dbcon->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :today and clustername='$systemname' group by HOUR(timeofmon) ");
//For IGcsc		$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :today and clustername='$systemname'  ");
		$req->execute(array('today' => $this_day));
		$subtitle="Cluster usage for $this_day";
		$xaxis="Hour of Day";
        	}
        	else	{
		
		if(strcmp($fromdate,$todate)==0){
		$req=$dbcon->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :from  and clustername='$systemname'  group by HOUR(timeofmon) ");
	//For IGCSC 	$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :from  and clustername='$systemname' and HOUR(timeofmon) >= 12 and HOUR(timeofmon) < 22  ");
		$req->execute(array('from' => $fromdate));
		$subtitle="Cluster usage for $fromdate";
		$xaxis="Hour of Day";

		}
		else{
		$req=$dbcon->prepare("SELECT avg(UsedPercent) as UsedPercent,DATE(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)>= :from and DATE(timeofmon)<= :to  and clustername='$systemname'  group by DATE(timeofmon) ");
		$req->execute(array('from' => $fromdate,'to' => $todate));
		$subtitle="Cluster usage from $fromdate to $todate";
		$xaxis="Date";
		}
		}

		$usepercents=array();
		$timeunits=array();
		$graphlabels=array($subtitle,$xaxis);
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$usepercents[$i]=$msg['UsedPercent'];
			$timeunits[$i]=$msg['MYHOUR'];
			$i=$i+1;
		}
                $dbcon=null;
		return array($graphlabels,$usepercents,$timeunits);
	}
	public function getqueueusage($systemname,$partitionname,$fromdate,$todate){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		$partitions=array();
		$req=$dbcon->prepare("SELECT distinct partitionname FROM slurmqstatushistory where clustername='$systemname'");
		$req->execute();
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$partitions[$i]=$msg['partitionname'];
			$i=$i+1;
		}
		if(strcmp($fromdate,"today")==0){

		$this_day=date("Y-m-d");
		$req=$dbcon->prepare("SELECT avg(cpuusepercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM slurmqstatushistory where DATE(timeofmon)= :today and clustername='$systemname' and partitionname='$partitionname' group by HOUR(timeofmon) ");
//For IGcsc		$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :today and clustername='$systemname'  ");
		$req->execute(array('today' => $this_day));
		$subtitle="Queue usage: $partitionname for $this_day";
		$xaxis="Hour of Day";
        	}
        	else	{
		
		if(strcmp($fromdate,$todate)==0){
		$req=$dbcon->prepare("SELECT avg(cpuusepercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM slurmqstatushistory where DATE(timeofmon)= :from  and clustername='$systemname' and partitionname='$partitionname' group by HOUR(timeofmon) ");
	//For IGCSC 	$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :from  and clustername='$systemname' and HOUR(timeofmon) >= 12 and HOUR(timeofmon) < 22  ");
		$req->execute(array('from' => $fromdate));
		$subtitle="Queue usage : $partitionname for $fromdate";
		$xaxis="Hour of Day";

		}
		else{
		$req=$dbcon->prepare("SELECT avg(cpuusepercent) as UsedPercent,DATE(timeofmon) as MYHOUR FROM slurmqstatushistory where DATE(timeofmon)>= :from and DATE(timeofmon)<= :to and clustername='$systemname' and partitionname='$partitionname' group by DATE(timeofmon) ");
		$req->execute(array('from' => $fromdate,'to' => $todate));
		$subtitle="Queue usage : $partitionname from $fromdate to $todate";
		$xaxis="Date";
		}
		}

		$usepercents=array();
		$timeunits=array();
		$graphlabels=array($subtitle,$xaxis);
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$usepercents[$i]=$msg['UsedPercent'];
			$timeunits[$i]=$msg['MYHOUR'];
			$i=$i+1;
		}
                $dbcon=null;
		return array($partitions,$graphlabels,$usepercents,$timeunits);
	}
	public function getlicenseuserstatus($software){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		if(strcmp($software,"All")==0){
		$req=$dbcon->prepare("SELECT * from licenseusers ");
		$req->execute();
		}
		else{
		$req=$dbcon->prepare("SELECT * from licenseusers where software= :name ");
		$req->execute(array('name' => $software));
		}
		$licenseusers=array();
		$i=0;

		foreach ($req->fetchAll() as $msg){
                        $licenseusers[$i]=array($msg['username'],$msg['licenseserver'],$msg['feature'],$msg['machinename'],$msg['starttime'],$msg['software'],$msg['licenses']);
                        $i++;

                }
                $dbcon=null;
                return $licenseusers;
	}
public function getlicenseusedstatus(){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT distinct * from softwarelicenses where used>0 ");
		$req->execute();

		$req1=$dbcon->prepare("SELECT max(timeofmon) as TimeofMon from softwarelicenses ");
		$req1->execute();

		$lastmon=$req1->fetch();
		$lastmontime=$lastmon['TimeofMon'];
		$licenses=array();
		$i=0;

		foreach ($req->fetchAll() as $msg){
                        $licenses[$i]=array($msg['timeofmon'],$msg['software'],$msg['feature'],$msg['total'],$msg['used'],$msg['licenseserver']);
                        $i++;

                }
                $dbcon=null;
                return array($lastmontime,$licenses);
	}

public function getFeaturename($swname,$fromdate,$todate){
	
	//echo "Coming to Model";
	array($usedfea);
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		$i=$j=0;
	$reqfea=$dbcon->prepare("select distinct feature from softwarelicenseshistory where software=:swname and DATE(timeofmon)>= :from and DATE(timeofmon)<= :to and used>=1");
	$reqfea->execute(array('swname' => $swname,'from' => $fromdate,'to' => $todate));
	foreach ($reqfea->fetchAll() as $msg1){
								$usedfea[]=$msg1[0];
								$i=$i+1;
							
                      						}									
              return $usedfea; 
			
}	

	
	
	
public function getSWReportGraph($swname,$usedfea,$fromdate,$todate){
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		$i=$j=0;					
							
		$req=$dbcon->prepare("select  count(*) as usedhours, feature, DATE(timeofmon) as dateofmon  from softwarelicenseshistory where feature =:usedfea and used>=1 and software=:swname and DATE(timeofmon)>= :from and DATE(timeofmon)<= :to group by feature, DATE(timeofmon) ORDER BY DATE(timeofmon)");
		$req->execute(array('swname' => $swname,'from' => $fromdate,'to' => $todate,'usedfea' => $usedfea));

							foreach ($req->fetchAll() as $msg1){
						//$textcom.=$msg1[0]."," .$msg1[1].",". $msg1[2]."EOL";
						//$SWreport=$textcom;
						$SWreport[]=$msg1[0]."," .$msg1[1].",". $msg1[2];
						//$SWreport[]=array($msg1[0],$msg1[1],$msg1[2]);
					//print_r($SWreport[$i]);			
                      									}
			
                $dbcon=null;
				//return $SWreport;
              //return array($graphlabels,$WSnameall,$SWreport,$dayscount,$usedfeatures); .
			  return $SWreport;
				
			
}
	
public function getSWReportGraphPer($swname,$usedfea,$fromdate,$todate){
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		$i=$j=0;					
							
		$req=$dbcon->prepare("select avg(((used/total) * 100)) as avgusage, feature, DATE(timeofmon) as dateofmon from softwarelicenseshistory where feature =:usedfea and used>=1 and software=:swname and DATE(timeofmon)>= :from and DATE(timeofmon)<= :to group by feature, DATE(timeofmon) ORDER BY DATE(timeofmon)");
		$req->execute(array('swname' => $swname,'from' => $fromdate,'to' => $todate,'usedfea' => $usedfea));

							foreach ($req->fetchAll() as $msg1){
						
						$SWreport[]=$msg1[0]."," .$msg1[1].",". $msg1[2];
									
                      									}
			
                $dbcon=null;
				//return $SWreport;
              	  return $SWreport;
				
			
}
public function getgwscurstatus(){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT distinct * from curgwsusage ");
		$req->execute();

		$req1=$dbcon->prepare("SELECT max(Timemon) as TimeofMon from curgwsusage ");
		$req1->execute();

		$lastmon=$req1->fetch();
		$lastmontime=$lastmon['TimeofMon'];
		$gwsusage=array();
		$i=0;

		foreach ($req->fetchAll() as $msg){
                        $gwsusage[$i]=array($msg['gwsname'],$msg['loggedinuser'],$msg['CPULoad'],$msg['MemLoad'],$msg['CDrive'],$msg['Timemon']);
                        $i++;
                }
                $dbcon=null;
                return array($lastmontime,$gwsusage);
	}

public function getgwsusage($systemname,$fromdate,$todate){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
		if(strcmp($fromdate,"today")==0){

		$this_day=date("Y-m-d");
		$req=$dbcon->prepare("SELECT avg(CPULoad) as CPUUsedPercent, avg(MemLoad) as memUsedPercent,gwsname FROM gwsusage where DATE(Timemon)= :today group by length(gwsname),gwsname  ");
//For IGcsc		$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :today and clustername='$systemname'  ");
		$req->execute(array('today' => $this_day));
		$subtitle="GWS usage for $this_day";
		$xaxis="Workstation Names";
        	}
        	else	{
		
		if(strcmp($fromdate,$todate)==0){
			
		$req=$dbcon->prepare("SELECT avg(CPULoad) as CPUUsedPercent, avg(MemLoad) as memUsedPercent,gwsname FROM gwsusage where DATE(Timemon)= :from group by length(gwsname),gwsname  ");
		//$req=$dbcon->prepare("SELECT avg(UsedPercent) as UsedPercent,HOUR(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :from  and clustername='$systemname'  group by HOUR(timeofmon) ");
	//For IGCSC 	$req=$dbcon->prepare("SELECT UsedPercent as UsedPercent,timeofmon as MYHOUR FROM `clusterusage` where DATE(timeofmon)= :from  and clustername='$systemname' and HOUR(timeofmon) >= 12 and HOUR(timeofmon) < 22  ");
		$req->execute(array('from' => $fromdate));
		$subtitle="GWS usage for $fromdate";
		$xaxis="Workstation Names";

		}
		else{
			
				$req=$dbcon->prepare("SELECT avg(CPULoad) as CPUUsedPercent, avg(MemLoad) as memUsedPercent,gwsname FROM gwsusage where DATE(Timemon)>= :from and DATE(Timemon)>= :to group by length(gwsname),gwsname ");

		//$req=$dbcon->prepare("SELECT avg(UsedPercent) as UsedPercent,DATE(timeofmon) as MYHOUR FROM `clusterusage` where DATE(timeofmon)>= :from and DATE(timeofmon)<= :to  and clustername='$systemname'  group by DATE(timeofmon) ");
		$req->execute(array('from' => $fromdate,'to' => $todate));
		$subtitle="GWS usage from $fromdate to $todate";
		$xaxis="Workstation Names";
		}
		}
		$usepercents=array();
		$timeunits=array();
		$graphlabels=array($subtitle,$xaxis);
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$usepercents[$i]=$msg['CPUUsedPercent'];
			$timeunits[$i]=$msg['gwsname'];
			$i=$i+1;
		}
                $dbcon=null;
		
		return array($graphlabels,$usepercents,$timeunits);
	}
	
	
	public function getWSReport($wsname,$mon,$year){
			
		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

			if((strcmp($mon,CM)==0))
		{
			
		$req=$dbcon->prepare("SELECT gwsname,loggedinuser,count(loggedinuser) as loggedincount, avg(`CPULoad`) as averageCPU, date(`Timemon`) FROM `gwsusage` where loggedinuser <> 'Nil' and MONTH(`Timemon`)=MONTH(now()) and YEAR(`Timemon`)=YEAR(now())group by gwsname, date(`Timemon`)");
		$req->execute();
		}
		else {
			
//			$req=$dbcon->prepare("SELECT gwsname,loggedinuser,count(loggedinuser) as loggedincount, avg(`CPULoad`) as averageCPU, date(`Timemon`) FROM `gwsusage` where loggedinuser <> 'Nil' and DATE(Timemon)>= :from and DATE(Timemon)<= :to and gwsname=:gwsname group by gwsname, date(`Timemon`)");
		$req=$dbcon->prepare("SELECT gwsname,loggedinuser,count(loggedinuser) as loggedincount, avg(`CPULoad`) as averageCPU, date(`Timemon`) FROM `gwsusage` where loggedinuser <> 'Nil' and MONTH(`Timemon`)=:mon and YEAR(`Timemon`)=:year1 group by gwsname, date(`Timemon`)");

		$req->execute(array('mon' => $mon,'year1' => $year));
		}
		
		$req1=$dbcon->prepare("SELECT DISTINCT gwsname from gwsusage");
		$req1->execute();
		$WSnameall=array();
		$WSreport=array();
		$i=0;
				
		foreach ($req1->fetchAll() as $msg){
			$WSnameall[$i]=$msg['gwsname'];
			$i=$i+1;
             	}
						$i=0;	
					foreach ($req->fetchAll() as $msg1){
						
						$WSreport[$i]=array($msg1[0],$msg1[1],$msg1[2],$msg1[3],$msg1[4]);
					
			$i=$i+1;     		
							}		
		
               $dbcon=null;
                return array($WSnameall,$WSreport); 
			
}

public function getWSReportGraph($wsname,$fromdate,$todate){
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$subtitle="";
		$xaxis="";
	
		$req=$dbcon->prepare("SELECT gwsname,loggedinuser,count(loggedinuser) as loggedincount, avg(`CPULoad`) as averageCPU, date(`Timemon`) FROM `gwsusage` where loggedinuser <> 'Nil' and DATE(Timemon)>= :from and DATE(Timemon)<= :to and gwsname=:gwsname group by gwsname, date(`Timemon`)");
		$req->execute(array('gwsname' => $wsname,'from' => $fromdate,'to' => $todate));
		$subtitle="$wsname usage from $fromdate to $todate";
		$xaxis="Date";

		$usepercents=array();
		$timeunits=array();
		$graphlabels=array($subtitle,$xaxis);
	
		$req1=$dbcon->prepare("SELECT DISTINCT gwsname from gwsusage");
		$req1->execute();
		$WSnameall=array();
		$WSreport=array();
		$i=0;
		
		foreach ($req1->fetchAll() as $msg){
			$WSnameall[$i]=$msg['gwsname'];
			$i=$i+1;
                       		
							}
						$i=0;	
					foreach ($req->fetchAll() as $msg1){
						
						$WSreport[$i]=array($msg1[0],$msg1[1],$msg1[2],$msg1[3],$msg1[4]);
					
						$i=$i+1;
                      		
							}		
				
                $dbcon=null;
                return array($graphlabels,$WSnameall,$WSreport); 
				
			
}


public function getWSNames(){
	
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
$req1=$dbcon->prepare("SELECT DISTINCT gwsname from gwsusage");
		$req1->execute();
		$WSnameall=array();
	
		$i=0;
		
		foreach ($req1->fetchAll() as $msg){
			$WSnameall[$i]=$msg['gwsname'];
			$i=$i+1;
                       		
							}					
							return $WSnameall; 

}

	public function getADusers(){
		


		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$dbcon1=$db->getInstance("hpcweb");

		$req=$dbcon->prepare("SELECT * from gwsadusers");
		$req->execute();
		/*
		$sql1="SELECT hpcmonitor.gwsadusers.gwsusername, hpcweb.HPCUSER.mailid FROM hpcweb.HPCUSER, hpcmonitor.gwsadusers where hpcmonitor.gwsadusers.gwsaccname = 'ccop'";
		
		
		
		
		
		echo $sql1;
		$sql1=$dbcon->query($sql1);
		$sql1=$sql1->fetchAll();
		echo "Count". count($sql1);
print_r($sql1);
exit;*/
		$gwsadusers=array();
		$i=0;
		
		foreach ($req->fetchAll() as $msg){
			$usergroup=explode(",",$msg['gwsusergroup']);
			
                        $gwsadusers[$i]=array($msg['gwsaccname'],$msg['gwsusername'],$usergroup[1],$msg['gwslastlogin'],$msg['emailid']);
                        $i++;

                }
                $dbcon=null;
                return $gwsadusers;
	}
			
	
	
	public function getlicensestatus($software){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT * from softwarelicenses where software= :name group by `feature`");
		$req->execute(array('name' => $software));

		$licenses=array();
		$i=0;

		foreach ($req->fetchAll() as $msg){
                        $licenses[$i]=array($msg['timeofmon'],$msg['licenseserver'],$msg['feature'],$msg['total'],$msg['used']);
                        $i++;

                }
                $dbcon=null;
                return $licenses;
	}
	
	
public function getSWNames(){
	//echo "getSWNames";
	$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
$req1=$dbcon->prepare("SELECT DISTINCT software from softwarelicenseshistory");
		$req1->execute();
		$WSnameall=array();
	
		$i=0;
		
		foreach ($req1->fetchAll() as $msg){
			$SWnameall[$i]=$msg['software'];
			$i=$i+1;
                       		
							}					
							return $SWnameall; 

}
	
	
	public function getusernumber($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT count(*) as Users from loggedinusers where systemname= :name ");
		$req->execute(array('name' => $systemname));
		$users=$req->fetch();
		$dbcon=null;
		return $users['Users'];
	}
	public function getusers($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT * from loggedinusers where systemname= :name ");
		$req->execute(array('name' => $systemname));
		$users=array();
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$users[$i]=array($msg['timeofmon'],$msg['username'],$msg['IPaddress'],$msg['logintime'],$msg['process'],$msg['phoneno'],$msg['emailid'],$msg['userfullname']);
			$i++;
		}
		$dbcon=null;
		return $users;

	}
	
	
	public function getBackupStat($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT * FROM `backupstat` WHERE `bkgroupname`<>'FSStatus' and clustername= :name");
		$req->execute(array('name' => $systemname));
		$bkstat=array();
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$bkstat[$i]=array($msg['bkgroupname'],$msg['starttime'],$msg['endtime'],$msg['sentdata'],$msg['receivedata'],$msg['txrate'],$msg['totalsize'],$msg['speedup'],$msg['bkstatus']);
			$i++;
		}
		$dbcon=null;
		return $bkstat;

	}
	public function getlogmsgs($systemname){


		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT * from logmessages where cluster= :name and time >= DATE_SUB(CURDATE(), INTERVAL 10 DAY)order by time desc LIMIT 2000");
		$req->execute(array('name' => $systemname));
		$logmsgs=array();
		$i=0;
		foreach ($req->fetchAll() as $msg){
			$logmsgs[$i]=array($msg['time'],$msg['host'],$msg['message']);
			$i++;

		}
		$dbcon=null;
		return $logmsgs;

	}
	public function getslurmnodedetails($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from slurmnodestatus where clustername= :name");
		$req->execute(array('name' => $systemname));
		$nodedetails=array();
		$i=0;
		foreach ($req->fetchAll() as $detail){
			$timeofmon=$detail['timeofmon'];
			$partition=$detail['partitionname'];
			$nodename=$detail['nodename'];
			$state=$detail['state'];
			$cpualloc=$detail['cpualloc'];
			$cpuidle=$detail['cpuidle'];
			$cpuother=$detail['cpuother'];
			$cputotal=$detail['cputotal'];	
			$loadavg=$detail['loadavg'];
			$nodedetails[$i]=array($nodename,$partition,$timeofmon,$state,$cpualloc,$cpuidle,$cpuother,$cputotal,$loadavg);
			$i=$i+1;
		}
		$dbcon=null;
		return $nodedetails;
	}

	public function getslurmjobcharts($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT username,count(jobid) as numofjobs from slurmjobs where state='R' and clustername= :name group by username");
		$req->execute(array('name' => $systemname));
		$userjobs=array();

		foreach($req->fetchAll() as $detail){
			$userjob=array($detail['username'],$detail['numofjobs']);
			array_push($userjobs,$userjob);			
		}

		$req=$dbcon->prepare("SELECT username,sum(cpus) as cpucount from slurmjobs where state='R' and clustername= :name group by username");
		$req->execute(array('name' => $systemname));
		$usercores=array();
		foreach($req->fetchAll() as $detail){
			$usercpu=array($detail['username'],$detail['cpucount']);
			array_push($usercores,$usercpu);			
		}
		$req=$dbcon->prepare("SELECT partitionname,sum(cpus) as cpucount from slurmjobs where state='R' and clustername= :name group by partitionname");
		$req->execute(array('name' => $systemname));
		$partitioncores=array();
		foreach($req->fetchAll() as $detail){
			$parcpu=array($detail['partitionname'],$detail['cpucount']);
			array_push($partitioncores,$parcpu);			
		}
		$req=$dbcon->prepare("SELECT processname,sum(cpus) as cpucount from slurmjobs where state='R' and processname!='NA' and  clustername= :name group by processname");
		$req->execute(array('name' => $systemname));
		$processcores=array();
		foreach($req->fetchAll() as $detail){
			$proccpu=array($detail['processname'],$detail['cpucount']);
			array_push($processcores,$proccpu);			
		}
		$dbcon=null;
		return array($userjobs,$usercores,$partitioncores,$processcores);
	}
	public function getslurmjobdetails($systemname,$mystate){

		$db=new Db();
		$jobstates=array("CD"=>"Completed","CA"=>"Cancelled","CG"=>"Completing","F"=>"Failed","R"=>"Running","PD"=>"Pending");
		$dbcon=$db->getInstance("hpcmonitor");
		if(strcmp($mystate,"All")==0){
		$req=$dbcon->prepare("SELECT * from slurmjobs where clustername= :name");
		$req->execute(array('name' => $systemname));
		}
		if(strcmp($mystate,"Running")==0){
		$req=$dbcon->prepare("SELECT * from slurmjobs where state='R' and clustername= :name");
		$req->execute(array('name' => $systemname));
		}
		if(strcmp($mystate,"Others")==0){
		$req=$dbcon->prepare("SELECT * from slurmjobs where state != 'R' and clustername= :name");
		$req->execute(array('name' => $systemname));
		}
		$jobvals=array();
		$i=0;
		foreach ($req->fetchAll() as $jobdetail){
			$timeofmon=$jobdetail['timeofmon'];
			$jobid=$jobdetail['jobid'];
			$partition=$jobdetail['partitionname'];
			$jobname=$jobdetail['jobname'];
			$user=$jobdetail['username'];
			$state=$jobdetail['state'];
			if(array_key_exists($state,$jobstates)){
				$statedef=$jobstates[$state];
			}
			else{
				$statedef="unknown";
			}
			$start=$jobdetail['starttime'];
			$elapse=$jobdetail['elapsedtime'];
			$nodes=$jobdetail['nodes'];
			$nodelist=$jobdetail['nodelist'];
			$cpu=$jobdetail['cpus'];
			$process=$jobdetail['processname'];	
			$jobvals[$i]=array($jobid,$partition,$jobname,$user,$state,$start,$elapse,$nodes,$nodelist,$cpu,$timeofmon,$process,$statedef);
			$i=$i+1;
		}
		$dbcon=null;
		return $jobvals;


	}
	public function getslurmjobnumber($systemname){
		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as Jobs from slurmjobs where clustername= :name");
		$req->execute(array('name' => $systemname));
		$jobs=$req->fetch();
		$req1=$dbcon->prepare("SELECT count(*) as RunningJobs from slurmjobs where state='R' and clustername= :name");
		$req1->execute(array('name' => $systemname));
		$runningjobs=$req1->fetch();
		$req1=$dbcon->prepare("SELECT count(*) as PendingJobs from slurmjobs where state='PD' and clustername= :name");
		$req1->execute(array('name' => $systemname));
		$pendingjobs=$req1->fetch();
		$jobnum=array($jobs['Jobs'],$runningjobs['RunningJobs'],$pendingjobs['PendingJobs']);
		$dbcon=null;
		return $jobnum;

	}
	public function getsgejobnumber($systemname){
		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as Jobs from sgejobs where clustername= :name");
		$req->execute(array('name' => $systemname));
		$jobs=$req->fetch();
		$req1=$dbcon->prepare("SELECT count(*) as RunningJobs from sgejobs where jobstatus='r' and clustername= :name");
		$req1->execute(array('name' => $systemname));
		$runningjobs=$req1->fetch();
		$jobnum=array($jobs['Jobs'],$runningjobs['RunningJobs']);
		$dbcon=null;
		return $jobnum;

	}
	public function getsgejobdetails($systemname){
		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from sgejobs where clustername= :name");
		$req->execute(array('name' => $systemname));
		$jobvals=array();
		$i=0;
		foreach ($req->fetchAll() as $jobdetail){
			$timeofmon=$jobdetail['timeofmon'];
			$jobid=$jobdetail['jobid'];
			$partition=$jobdetail['queuename'];
			$jobname=$jobdetail['jobname'];
			$user=$jobdetail['username'];
			$state=$jobdetail['jobstatus'];
			$start=$jobdetail['starttime'];
			$priority=$jobdetail['priority'];
			$host=$jobdetail['hostname'];
			$cpu=$jobdetail['slots'];	
			$process=$jobdetail['processname'];	
			$jobvals[$i]=array($jobid,$partition,$jobname,$user,$state,$start,$priority,$host,$cpu,$timeofmon,$process);
			$i=$i+1;
		}
		$dbcon=null;
		return $jobvals;

	}

	public function getsgequeueinfo($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from sgeqstatus where clustername= :name");
		$req->execute(array('name' => $systemname));
		$jobvals=array();
		$i=0;
		$nodesummary=array();
		foreach ($req->fetchAll() as $jobdetail){
			$nodesummary[$i]=array($jobdetail['timeofmon'],$jobdetail['queuename'],$jobdetail['loadavg'],$jobdetail['used'],$jobdetail['available'],$jobdetail['total'],$jobdetail['cdsuE']);
			$i=$i+1;
		}

		$req=$dbcon->prepare("SELECT sum(loadavg) as loadavg,sum(used) as Used,sum(available) as Avail,sum(total) as Total,sum(cdsuE) as cdsuE FROM `sgeqstatus` WHERE clustername= :name"); 
		$req->execute(array('name' => $systemname));
		foreach ($req->fetchAll() as $jobdetail){
			$nodesummary[$i]=array($jobdetail['timeofmon'],'Total',$jobdetail['loadavg'],$jobdetail['Used'],$jobdetail['Avail'],$jobdetail['Total'],$jobdetail['cdsuE']);
			$i=$i+1;
		}
		$dbcon=null;
		return $nodesummary;

	}

	public function getstoragesummary($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from storagestatus where partitionname LIKE '%Summary' and clustername= :name");
		$req->execute(array('name' => $systemname));
		
		$i=0;
		$storsumm=array();
		foreach ($req->fetchAll() as $status){
			$storsumm[$i]=array($status['timeofmon'],$status['total'],$status['used'],$status['available'],$status['percent'],$status['mountpoint']);
			$i=$i+1;
		}
		$dbcon=null;
		return $storsumm;

	}
	public function getstoragestatus($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from storagestatus where clustername= :name");
		$req->execute(array('name' => $systemname));
		
		$i=0;
		$storstat=array();
		foreach ($req->fetchAll() as $status){
			$storstat[$i]=array($status['timeofmon'],$status['clustername'],$status['partitionname'],$status['total'],$status['used'],$status['available'],$status['percent'],$status['mountpoint']);
			$i=$i+1;
		}
		$dbcon=null;
		return $storstat;

	}	
	public function getstorageserverstatus($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from storageservers where clustername= :name");
		$req->execute(array('name' => $systemname));
		
		$i=0;
		$storserver=array();
		foreach ($req->fetchAll() as $status){
			$storserver[$i]=array($status['timeofmon'],$status['clustername'],$status['servername'],$status['status']);
			$i=$i+1;
		}
		$dbcon=null;
		return $storserver;
	}
	public function getsgenodeinfo($systemname){

		$db=new Db();
		$dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from sgenodestatus where clustername= :name");
		$req->execute(array('name' => $systemname));
		$jobvals=array();
		$i=0;
		$nodesummary=array();
		foreach ($req->fetchAll() as $jobdetail){
			$nodesummary[$i]=array($jobdetail['queuename'],$jobdetail['nodename'],$jobdetail['nodestatus'],$jobdetail['loadavg'],$jobdetail['usednodes'],$jobdetail['total'],$jobdetail['state'],$jobdetail['upordown'],$jobdetail['timeofmon']);
			$i=$i+1;
		}
		$dbcon=null;
		return $nodesummary;

	}
	public function getslurmnodesummary($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");

		$req1=$dbcon->prepare("Select count(*) as TotalNodes from slurmuniquenodes where clustername= :name");

                $req1->execute(array('name' => $systemname));
                $nodetotal=$req1->fetch();
		
		$req2=$dbcon->prepare("select count(*) as AllocNodes from slurmuniquenodes where clustername= :name and (state='alloc' or state='alloc*' or state='mix' or state='mix*')");  
                $req2->execute(array('name' => $systemname));
                $nodealloc=$req2->fetch();
		
		$req3=$dbcon->prepare("select count(*) as IdleNodes from slurmuniquenodes where clustername= :name and (state='idle' or state='idle*')");  
                $req3->execute(array('name' => $systemname));
                $nodeidle=$req3->fetch();
		
		$req4=$dbcon->prepare("select count(*) as DownNodes from slurmuniquenodes where clustername= :name and (state='down' or state='down*')");  
                $req4->execute(array('name' => $systemname));
                $nodedown=$req4->fetch();
		
                $req=$dbcon->prepare("SELECT sum(cpualloc) as cpuAlloc, sum(cpuidle) as cpuIdle, sum(cputotal) as cpuTotal,timeofmon FROM `slurmuniquenodes` WHERE clustername= :name");
                $req->execute(array('name' => $systemname));
                $nodedetail=$req->fetch();
	###	$totalnodes=$nodedetail['NodesIdle']+$nodedetail['NodesAlloc']+$nodedown['NodesDown'];
		$cpudown=$nodedown['DownNodes']*24;
		$nodesummary=array($nodeidle['IdleNodes'],$nodealloc['AllocNodes'],$nodedetail['cpuAlloc'],$nodedetail['cpuIdle'],$nodedetail['cpuTotal'],$nodedown['DownNodes'],$nodetotal['TotalNodes'],$cpudown,$nodedetail['timeofmon']);
		$dbcon=null;
		return $nodesummary;
	}

	public function getsgenodesummary($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");

		$req=$dbcon->prepare("SELECT sum(usednodes) as Used,sum(total-usednodes) as Avail,timeofmon FROM `sgenodestatus` where upordown='UP' and clustername= :name");
 
                $req->execute(array('name' => $systemname));
                $nodedetail=$req->fetch();

		$req=$dbcon->prepare("SELECT sum(total) as Down FROM `sgenodestatus` where upordown='DOWN' and clustername= :name");
                $req->execute(array('name' => $systemname));
                $nodedowndetail=$req->fetch();
		$req=$dbcon->prepare("SELECT sum(total) as Total FROM `sgenodestatus` where clustername= :name");
                $req->execute(array('name' => $systemname));
                $nodetotaldetail=$req->fetch();
		$req1=$dbcon->prepare("SELECT count(*) as IdleNodes FROM `sgenodestatus` where usednodes=0 and upordown='UP' and clustername= :name");
                $req1->execute(array('name' => $systemname));
                $nodeidle=$req1->fetch();
		$req2=$dbcon->prepare("SELECT count(*) as UsedNodes FROM `sgenodestatus` where usednodes>0 and upordown='UP'and clustername= :name");
                $req2->execute(array('name' => $systemname));
                $nodeused=$req2->fetch();
		$req3=$dbcon->prepare("SELECT count(*) as DownNodes FROM `sgenodestatus` where upordown='DOWN' and clustername= :name");
                $req3->execute(array('name' => $systemname));
                $nodedown=$req3->fetch();
//		$totalslots=$nodedetail['Used']+$nodedetail['Resv']+$nodedetail['Avail']+$nodedetail['Aoc']+$nodedetail['cds'];
	//	$slotsdown=$nodedetail['Aoc']+$nodedetail['cds'];
		$usednodes=$nodeused['UsedNodes'];
		$idlenodes=$nodeidle['IdleNodes'];
		$downnodes=$nodedown['DownNodes'];
		$totalnodes=$usednodes+$idlenodes+$downnodes;
		$nodesummary=array($idlenodes,$usednodes,$nodedetail['Used'],$nodedetail['Avail'],$nodetotaldetail['Total'],$downnodes,$totalnodes,$nodedowndetail['Down'],$nodedetail['timeofmon']);
		$dbcon=null;
		return $nodesummary;
	}
	public function getslurmnodeinfo($systemname){

                $db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
                $req=$dbcon->prepare("SELECT * from slurmqstatus where clustername= :name");
                $req->execute(array('name' => $systemname));
                $nodevals=array();
                $i=0;
                foreach ($req->fetchAll() as $nodedetail){
                $nodevals[$i]=array($nodedetail['partitionname'],$nodedetail['availstatus'],$nodedetail['nodes'],$nodedetail['state'],$nodedetail['nodelist'],$nodedetail['nodesallocated'],$nodedetail['nodesidle'],$nodedetail['cpuallocated'],$nodedetail['cpuidle'],$nodedetail['cpuother'],$nodedetail['cputotal'],$nodedetail['timeofmon']);
                $i=$i+1;

                }
		$dbcon=null;
		return $nodevals;
	}
	public function getslurmqueuesummary($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
                $req=$dbcon->prepare("SELECT * from slurmqstatus where clustername= :name");
                $req->execute(array('name' => $systemname));
                $nodevals=array();
                $i=0;
		foreach ($req->fetchAll() as $nodedetail){
		$nodevals[$i]=array($nodedetail['partitionname'],$nodedetail['availstatus'],$nodedetail['nodes'],$nodedetail['state'],$nodedetail['nodelist'],$nodedetail['nodesallocated'],$nodedetail['nodesidle'],$nodedetail['cpuallocated'],$nodedetail['cpuidle'],$nodedetail['cpuother'],$nodedetail['cputotal'],$nodedetail['timeofmon']);
		$i=$i+1;

		}
		$allstates=array('Allocated','Idle','Down','Mixed','Others');
		$allpartitions=array();
		foreach ($nodevals as $line){

        		$partition=$line[0];
       			array_push($allpartitions,$partition);
		}
		$allpartitions=array_unique($allpartitions);
		$queuesummary=array();
		$index=0;
		$i=0;
		foreach ($allpartitions as $partition){
		        $allocnodes=0;
       			 $idlenodes=0;
		        $downnodes=0;
        		$mixnodes=0;
        		$othernodes=0;
        		while($i<sizeof($nodevals)){
                		$mypart=$nodevals[$i][0];
                		if(strcmp($mypart,$partition)==0){
                        	$state=$nodevals[$i][3];
                        	$nodes=$nodevals[$i][2];
                        	if(preg_match('/alloc/',$state)==1){
                                	$allocnodes=$allocnodes+$nodes;
                        	}
                        	else if(preg_match('/idle/',$state)==1){
                                	$idlenodes=$idlenodes+$nodes;
                        	}
                        	else if(preg_match('/down*/',$state)==1){
                                	$downnodes=$downnodes+$nodes;
                        	}
                        	else if(preg_match('/mix/',$state)==1){
                                	$mixnodes=$nodes;
                        	}
                       	 	else{
                                	$othernodes=$nodes;
                        	}
                        	$i=$i+1;
                		}
               			 else{
                        		break;
                		}
        		}//while
		$queuesummary[$index]=array($partition,$allocnodes,$idlenodes,$downnodes,$mixnodes,$othernodes);
		$index=$index+1;

		}	//foreach

		$dbcon=null;
		return $queuesummary;
	}

	public function getsgegroupsummary($systemname,$fromval,$toval){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(wallclock) as wallclock,sum(cpuusage) as cpu ,sum(memusage) as mem,groupname FROM `sgefinishedjobsinfo` where clustername= :name and starttime>= :from and endtime <= :to group by groupname");	

                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));
		$grpsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$grpsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['cpu'],$jobstr['mem'],$jobstr['groupname']);
		$i=$i+1;

		}
		$dbcon=null;
		return $grpsumm;

	}

	public function getsgejobsummary($systemname,$fromval,$toval){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(wallclock) as wallclock,sum(cpuusage) as cpu ,sum(memusage) as mem,processname FROM `sgefinishedjobsinfo` where clustername= :name  and starttime>= :from and endtime <= :to and NOT processname='' group by processname");	

                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));

		$usrsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$usrsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['cpu'],$jobstr['mem'],$jobstr['processname']);
		$i=$i+1;
		}
		$dbcon=null;

		return $usrsumm;
	}
	public function getsgeusersummary($systemname,$fromval,$toval){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(wallclock) as wallclock,sum(cpuusage) as cpu ,sum(memusage) as mem,username FROM `sgefinishedjobsinfo` where clustername= :name  and starttime>= :from and endtime <= :to group by username");	

                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));

		$usrsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$usrsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['cpu'],$jobstr['mem'],$jobstr['username']);
		$i=$i+1;
		}
		$dbcon=null;

		return $usrsumm;
	}
	public function getsgeyearsummary($systemname){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(wallclock) as wallclock,sum(cpuusage) as cpu ,sum(memusage) as mem,year(starttime) as Year FROM `sgefinishedjobsinfo` where clustername= :name group by year(starttime)");	

                $req->execute(array('name' => $systemname));
		$yearsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$yearsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['cpu'],$jobstr['mem'],$jobstr['Year']);
		$i=$i+1;
		}
		$dbcon=null;

		return $yearsumm;
	}

	public function getsgemyusrdetails($systemname,$username){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(wallclock) as wallclock,sum(cpuusage) as cpu ,sum(memusage) as mem,year(starttime) as Year FROM `sgefinishedjobsinfo` where clustername= :name and username= :user group by year(starttime)");	

                $req->execute(array('name' => $systemname,'user' => $username));
		$yearsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$yearsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['cpu'],$jobstr['mem'],$jobstr['Year']);
		$i=$i+1;
		}
		$dbcon=null;
		return $yearsumm;

	}
	public function getslurmyearsummary($systemname){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(ElapsedTime) as wallclock,year(starttime) as Year FROM `slurmfinishedjobsinfo` where clustername= :name group by year(starttime)");	

                $req->execute(array('name' => $systemname));
		$yearsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$yearsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['Year']);
		$i=$i+1;
		}
		$dbcon=null;

		return $yearsumm;
	}
	public function getslurmgroupsummary($systemname,$fromdate,$todate){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(ElapsedTime) as wallclock,groupname FROM `slurmfinishedjobsinfo` where clustername= :name and starttime>= :from and endtime <= :to and groupname <> 'nobody' group by groupname");	

                $req->execute(array('name' => $systemname, 'from' => $fromdate,'to' => $todate));

		$grpsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$grpsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['wallclock'],$jobstr['groupname']);
		$i=$i+1;

		}
		$dbcon=null;
		return $grpsumm;
	}
	public function getslurmjobsummary($systemname,$fromdate,$todate){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(ElapsedTime) as totaltime,processname FROM `slurmfinishedjobsinfo` where clustername= :name and starttime>= :from and endtime <= :to and NOT processname='' group by processname");	

                $req->execute(array('name' => $systemname, 'from' => $fromdate,'to' => $todate));
		$jobsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$jobsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['totaltime'],$jobstr['processname']);
		$i=$i+1;
		}
		$dbcon=null;

		return $jobsumm;
	}
	public function getslurmusersummary($systemname,$fromdate,$todate){
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,sum(slots) as Slots,sum(ElapsedTime) as totaltime,username FROM `slurmfinishedjobsinfo` where clustername= :name and starttime>= :from and endtime <= :to group by username");	

                $req->execute(array('name' => $systemname, 'from' => $fromdate,'to' => $todate));
		$usrsumm=array();
                $i=0;
                foreach ($req->fetchAll() as $jobstr){
		$usrsumm[$i]=array($jobstr['TotalJobs'],$jobstr['Slots'],$jobstr['totaltime'],$jobstr['username']);
		$i=$i+1;
		}
		$dbcon=null;

		return $usrsumm;
	}
	public function getslurmfinishedjobs($systemname,$fromval,$toval){
		
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$dbcon->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
	//To fetch large amounts of data
		$req=$dbcon->prepare("select * from slurmfinishedjobsinfo where clustername= :name and starttime>= :from and endtime <= :to order by ElapsedTime desc LIMIT 5000 ");
                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));
                $finishedjobs=array();
		$i=0;	
		while($jobdetail=$req->fetch(PDO::FETCH_ASSOC)){
		$finishedjobs[$i]=array($jobdetail['jobid'],$jobdetail['jobname'],$jobdetail['username'],$jobdetail['groupname'],$jobdetail['queuename'],$jobdetail['starttime'],$jobdetail['endtime'],$jobdetail['jobstate'],$jobdetail['slots'],$jobdetail['ElapsedTime'],$jobdetail['Nodes'],$jobdetail['processname'],$jobdetail['jobtype']);
		$i=$i+1;	
		}

		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,min(starttime) as starttime from slurmfinishedjobsinfo where clustername= :name and starttime>= :from and endtime <= :to");
                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));
		$jobcount=$req->fetch();
		$jobsumm=array($jobcount['TotalJobs'],$jobcount['starttime']);
		$dbcon=null;
		return array($jobsumm,$finishedjobs);
	}
	public function getsgefinishedjobs($systemname,$fromval,$toval){
		
		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$dbcon->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
	//To fetch large amounts of data
		$req=$dbcon->prepare("select * from sgefinishedjobsinfo where clustername= :name and starttime>= :from and endtime <= :to order by wallclock desc LIMIT 5000 ");
                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));
                $finishedjobs=array();
		$i=0;	
		while($jobdetail=$req->fetch(PDO::FETCH_ASSOC)){
		$finishedjobs[$i]=array($jobdetail['jobid'],$jobdetail['jobname'],$jobdetail['username'],$jobdetail['groupname'],$jobdetail['queuename'],$jobdetail['starttime'],$jobdetail['endtime'],$jobdetail['exitstatus'],$jobdetail['slots'],$jobdetail['wallclock'],$jobdetail['processname'],$jobdetail['jobtype']);
		$i=$i+1;	
		}

		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,min(starttime) as starttime from sgefinishedjobsinfo where clustername= :name and starttime>= :from and endtime <= :to");
                $req->execute(array('name' => $systemname, 'from' => $fromval,'to' => $toval));
		$jobcount=$req->fetch();
		$jobsumm=array($jobcount['TotalJobs'],$jobcount['starttime']);
		$dbcon=null;
		return array($jobsumm,$finishedjobs);
	}
	public function getslurmaccounting($systemname){


		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$dbcon->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
	//To fetch large amounts of data
		$req=$dbcon->prepare("select * from slurmfinishedjobsinfo where clustername= :name order by jobid desc LIMIT 1000 ");
                $req->execute(array('name' => $systemname));
                $finishedjobs=array();
		$i=0;	
		while($jobdetail=$req->fetch(PDO::FETCH_ASSOC)){
		$finishedjobs[$i]=array($jobdetail['jobid'],$jobdetail['jobname'],$jobdetail['username'],$jobdetail['groupname'],$jobdetail['queuename'],$jobdetail['starttime'],$jobdetail['endtime'],$jobdetail['jobstate'],$jobdetail['slots'],$jobdetail['ElapsedTime'],$jobdetail['Nodes'],$jobdetail['processname'],$jobdetail['jobtype']);
		$i=$i+1;	
		}

		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,min(starttime) as starttime from slurmfinishedjobsinfo where clustername= :name");
                $req->execute(array('name' => $systemname));
		$jobcount=$req->fetch();
		$jobsumm=array($jobcount['TotalJobs'],$jobcount['starttime']);
		$dbcon=null;
		return array($jobsumm,$finishedjobs);
	}
	public function getsgeaccounting($systemname){


		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$dbcon->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
	//To fetch large amounts of data
		$req=$dbcon->prepare("select * from sgefinishedjobsinfo where clustername= :name order by jobid desc LIMIT 1000 ");
                $req->execute(array('name' => $systemname));
                $finishedjobs=array();
		$i=0;	
		while($jobdetail=$req->fetch(PDO::FETCH_ASSOC)){
		$finishedjobs[$i]=array($jobdetail['jobid'],$jobdetail['jobname'],$jobdetail['username'],$jobdetail['groupname'],$jobdetail['queuename'],$jobdetail['starttime'],$jobdetail['endtime'],$jobdetail['exitstatus'],$jobdetail['slots'],$jobdetail['wallclock'],$jobdetail['cpuusage'],$jobdetail['memusage'],$jobdetail['processname']);
		$i=$i+1;	
		}

		$req=$dbcon->prepare("SELECT count(*) as TotalJobs,min(starttime) as starttime from sgefinishedjobsinfo where clustername= :name");
                $req->execute(array('name' => $systemname));
		$jobcount=$req->fetch();
		$jobsumm=array($jobcount['TotalJobs'],$jobcount['starttime']);
		$dbcon=null;
		return array($jobsumm,$finishedjobs);
	}


		public function getddnstatus($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from ddnstatus  where clustername= :name");	

                $req->execute(array('name' => $systemname));
                $ddncons=array();
		$i=0;	
		while($mycon=$req->fetch(PDO::FETCH_ASSOC)){
		$ddncons[$i]=array($mycon['timeofmon'],$mycon['conip'],$mycon['controllers'],$mycon['enclosures'],$mycon['disks'],$mycon['assigneddisks'],$mycon['unassigneddisks'],$mycon['pools'],$mycon['internal']);
		$i=$i+1;	
		}
		$dbcon=null;
		return $ddncons;
		}
		public function getddnconstatus($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from ddncontrollerstats  where clustername= :name");	

                $req->execute(array('name' => $systemname));
                $ddncons=array();
		$i=0;	
		while($mycon=$req->fetch(PDO::FETCH_ASSOC)){
		$ddncons[$i]=array($mycon['timeofmon'],$mycon['controllerip'],$mycon['controllerid'],$mycon['mastership'],$mycon['locality'],$mycon['uptime'],$mycon['iden_num'],$mycon['State'],$mycon['Firmware']);
		$i=$i+1;	
		}
		$dbcon=null;
		return $ddncons;
		}
		public function getddnencl($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from ddnenclosurestats where clustername= :name");	

                $req->execute(array('name' => $systemname));
                $ddncons=array();
		$i=0;	
		while($mycon=$req->fetch(PDO::FETCH_ASSOC)){
		$ddncons[$i]=array($mycon['timeofmon'],$mycon['conip'],$mycon['ensid'],$mycon['enctype'],$mycon['vendorid'],$mycon['prodid'],$mycon['revision'],$mycon['firmware'],$mycon['responsive']);
		$i=$i+1;	
		}
		$dbcon=null;
		return $ddncons;
		}
		public function getddndisks($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from ddndiskstats  where clustername= :name");	

                $req->execute(array('name' => $systemname));
                $ddncons=array();
		$i=0;	
		while($mycon=$req->fetch(PDO::FETCH_ASSOC)){
		$ddncons[$i]=array($mycon['timeofmon'],$mycon['conip'],$mycon['slot'],$mycon['vendor'],$mycon['prodid'],$mycon['type'],$mycon['capacity'],$mycon['rpm'],$mycon['revision'],$mycon['serialno'],$mycon['pool'],$mycon['health']);
		$i=$i+1;	
		}
	
		$dbcon=null;
		return $ddncons;
		}
		public function getddnpools($systemname){

		$db=new Db();
                $dbcon=$db->getInstance("hpcmonitor");
		$req=$dbcon->prepare("SELECT * from ddnpoolstats  where clustername= :name");	

                $req->execute(array('name' => $systemname));
                $ddncons=array();
		$i=0;	
		while($mycon=$req->fetch(PDO::FETCH_ASSOC)){
		$ddncons[$i]=array($mycon['timeofmon'],$mycon['conip'],$mycon['poolid'],$mycon['poolname'],$mycon['poolstate'],$mycon['chunk'],$mycon['raid'],$mycon['jobs']);
		$i=$i+1;	
		}
	
		$dbcon=null;
		return $ddncons;
	}
}
