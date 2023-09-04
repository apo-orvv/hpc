<?php
require_once("model/model_statusscreen_new.php");


class service_class
{
public $name;	
public $status;
}


class host_class
{
public $name;	
public $ip;
public $status;
public $service_no;
public $service;
public $min_service;
}



class Model_statusscreen_new
{	

public function fetch_status()
{	
$dbhost='localhost';
        $dbuser='root';
        $dbpass='root@HPCWeb';
        $ip_no=0;
        $conn=mysql_connect($dbhost,$dbuser,$dbpass);
        mysql_select_db('hpcweb');
		
		$sql1="select TIMESTAMP from time_monitor";
        $retval1=mysql_query($sql1,$conn);
        while($row1=mysql_fetch_assoc($retval1)) $this->time_stamp=$row1['TIMESTAMP'];
		
		$sql0="select DISTINCT host,ip,status from serverinfo";
        $retval0=mysql_query($sql0,$conn);
        $i=0;
        while($row0=mysql_fetch_assoc($retval0)){
			$this->host_obj[$i]=new host_class;
			$this->host_obj[$i]->name=$row0['host'];
			$this->host_obj[$i]->ip=$row0['ip'];
			$this->host_obj[$i]->status=$row0['status'];
			
			$ip_addr=$this->host_obj[$i]->ip;
			
			$sql2="select service,status from server_service where ip='$ip_addr' and service not in ('TRYD')";
			$retval2=mysql_query($sql2,$conn);
			$j=0;
			$this->host_obj[$i]->min_service=0;
			
			while($row2=mysql_fetch_assoc($retval2)){
			    $this->host_obj[$i]->service[$j]=new service_class; 	
				$this->host_obj[$i]->service[$j]->name=$row2['service'];
				$service_status=$this->host_obj[$i]->service[$j]->status=$row2['status'];
				if($service_status=='DOWN')
					$this->host_obj[$i]->min_service=1;
				
				
				$j++;
				
				
			}
			$this->host_obj[$i]->service_no=$j;
		$i++;
		}
		$this->host_no=$i;
		
		
        		
				
}
}

?>