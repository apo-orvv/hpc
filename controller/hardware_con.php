 <?php

require_once("model/hardware_model.php");
class hardwareController {

	private $hardwaremodel;
	public function  __construct(){
		$this->hardwaremodel=new HardwareModel();
	}
	
	
public function viewhardware()
{ //echo "user Status";
//$sysdetail=array();

if(isset($_POST['fetch']) )
		{
		$sysdetail=$_POST['sysdet'];
		if($sysdetail=="") $sysdetail="All"; 
			
	$r1=$this->hardwaremodel->hardwaredetails($sysdetail);
				
		}
		else 
		{ 
$sysdetail="All";
$r1=$this->hardwaremodel->hardwaredetails($sysdetail);
 }
 
  
include "view/hardwaredetails.php";
	}
 

 public function viewups()
 {
echo "UPS";
$r1=$this->hardwaremodel->upsdetails();
include "view/upsdetails.php";
	}




public function edithardwares()
{ 
if(($_GET[sysname])!="New")
{
$sname=$_GET[sysname];
$r1=$this->hardwaremodel->fetchhardware($sname);	
}
$r2=$this->hardwaremodel->fetchallsoftware();	
//print_r($r2);

if(isset($_POST['savehw']) )
		{
			$data[sysname]= filter_input(INPUT_POST,'element_1',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[type]= $_POST['element_12'];
			$data[description]= filter_input(INPUT_POST,'element_2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[config]= filter_input(INPUT_POST,'element_3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[perf]= filter_input(INPUT_POST,'element_4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[processor]= filter_input(INPUT_POST,'element_5',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			//$data[network]= filter_input(INPUT_POST,'element_6',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[network]=$_POST['element_6'];
			$data[storage]= filter_input(INPUT_POST,'element_7',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[doc]= filter_input(INPUT_POST,'docom',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[procured]= filter_input(INPUT_POST,'element_9',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[vendor]= filter_input(INPUT_POST,'element_10',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[ipadd]= filter_input(INPUT_POST,'element_11',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[software]= $_POST['selsoft'];
			//print_r($data[software]);
			//print_r($data);
			$id=$this->hardwaremodel->savehardware($data);
			if($id!="") 
				echo "<script> window.location.assign('index.php?hpcpage=viewhardware');</script> "; 
		}
		
include "view/edithardware.php";
		
	}




public function viewipadd()
{ //echo "user Status";
//$sysdetail=array();

if(isset($_POST['fetch']))
		{
		$sysdetail=$_POST['sysdet'];
					
	$r1=$this->hardwaremodel->fetchipadd($sysdetail);
	include "view/ipdetails.php";	
 }
 else {
 $r1=$this->hardwaremodel->fetchipadd("All");
 include "view/ipdetails.php"; }
	}

public function editipadd()
{ 
if(($_GET[sysname])!="New")
{
$sname=$_GET[sysname];
$r1=$this->hardwaremodel->fetchsysip($sname);	
}

if(isset($_POST['saveip']) )
		{
			$data[sysname]= filter_input(INPUT_POST,'element_1',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[login_name]= filter_input(INPUT_POST,'element_2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[type]= $_POST['element_12'];
			$data[ipaddress]= filter_input(INPUT_POST,'element_3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[location]= filter_input(INPUT_POST,'element_4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                         $data[remark]= filter_input(INPUT_POST,'element_5',FILTER_SANITIZE_FULL_SPECIAL_CHARS);			
			//print_r($data[software]);
			print_r($data);

                          if(($_GET[sysname])=="New"){
			$id=$this->hardwaremodel->ipcheck($data[ipaddress]);}

			if($id=="")
			{
			$id1=$this->hardwaremodel->saveip($data,$sname);
			if($id1!=""){ 
				echo "<script> window.location.assign('index.php?hpcpage=viewipadd');</script> "; }
		}
		if($id!="") {echo "<script> alert('IP Conflict will Occur. Please Give Some other IP');</script> "; }
		}
		
include "view/editipadd.php";
			
	}

	
	//Old Cluster node assignment
	
public function viewclusNodestat()
{ //echo "user Status";
//$sysdetail=array();


if(isset($_POST['fetch']))
		{
		$sysdetail=$_POST['sysdet'];
					
	$r1=$this->hardwaremodel->fetchclusNodestat($sysdetail);
include "view/clusNodestat.php";	
 }
 else {
$r1=$this->hardwaremodel->fetchclusNodestat("All");
include "view/clusNodestat.php"; }

	}

public function editclusNode()
{ 
	if (($_GET[sysname])!="New") {
		

			$seqID=$_GET[sysname];
				$r1=$this->hardwaremodel->fetchclusNode($seqID);
				//print_r($r1);
	}
if(isset($_POST['saveip']) )
		{
			$data[clusname]= filter_input(INPUT_POST,'element_1',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[nodename]= filter_input(INPUT_POST,'element_2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[issuedto]= filter_input(INPUT_POST,'element_3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[issueddate]= filter_input(INPUT_POST,'element_4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[divgrp]= filter_input(INPUT_POST,'element_5',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[assignment_type]= filter_input(INPUT_POST,'element_6',FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
			$data[returndate]= filter_input(INPUT_POST,'element_9',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[purpose]= filter_input(INPUT_POST,'element_7',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[remarks]= filter_input(INPUT_POST,'element_8',FILTER_SANITIZE_FULL_SPECIAL_CHARS);			

        if(($_GET[sysname])=="New")
		{
					
			$id1=$this->hardwaremodel->saveclusNode($data);		
			if($id1!=""){  echo "<script> window.location.assign('index.php?hpcpage=viewclusNodestat');</script> "; }
		}
		
		  else
		{
			$data[seqID]=$_GET[sysname];
			
			$id1=$this->hardwaremodel->updateclusNode($data);		
			if($id1!=""){  echo "<script> window.location.assign('index.php?hpcpage=viewclusNodestat');</script> "; }
		}	
		}	
include "view/editclusNodestat.php";
	
	}

//Workstation assignment
	
public function viewhighws()
{ 
$r1=$this->hardwaremodel->fetchWSstat();
include "view/WSstat.php"; 
	}	
	
public function edithighws()
{ 
	if (($_GET[sysname])!="New") {
		

			$seqID=$_GET[sysname];
				$r1=$this->hardwaremodel->fetchWS($seqID);
				//print_r($r1);
	}
if(isset($_POST['saveip']) )
		{
			$data[WSname]= filter_input(INPUT_POST,'element_1',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[WSmake]= filter_input(INPUT_POST,'element_2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[wsOS]= filter_input(INPUT_POST,'element_3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[WSIP]= filter_input(INPUT_POST,'element_4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[WStype]= filter_input(INPUT_POST,'element_5',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[WScurstatus]= filter_input(INPUT_POST,'element_6',FILTER_SANITIZE_FULL_SPECIAL_CHARS);	
			$data[WSremarks]= filter_input(INPUT_POST,'element_7',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		

		
        if(($_GET[sysname])=="New")
		{
			$id1=$this->hardwaremodel->saveWS($data);
		
			if($id1!=""){echo "<script> window.location.assign('index.php?hpcpage=viewhighws');</script> ";
			}
		}
		
		  else
		{
			$data[seqID]=$_GET[sysname];
			
			$id1=$this->hardwaremodel->updateWS($data);		
			if($id1!=""){  echo "<script> window.location.assign('index.php?hpcpage=viewhighws');</script> "; }
		}	
		}	
include "view/editWS.php";
	
	}

	
	
	
	
}
?>
