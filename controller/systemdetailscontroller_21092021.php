<?php

require_once("model/systemdetailsmodel.php");
class SmDetailsController{

	private $smdetailsmodel;
	public function  __construct(){
		$this->smdetailsmodel=new SmDetailsModel();
	}
	
	public function getdetails($systemname,$systemparam,$systemaction){

	if($systemparam==''){
	$myusertype=$_SESSION['HPCSESSION']->getUserType();
	$displaysysparams=$this->smdetailsmodel->getsystemparamsfordisplay($systemname,$myusertype);
	if(strcmp($systemname,"Ivy")==0){
		$nodesummary=$this->smdetailsmodel->getslurmnodesummary($systemname);
	//	$queuesummary=$this->smdetailsmodel->getslurmqueuesummary($systemname);
		$jobnumber=$this->smdetailsmodel->getslurmjobnumber($systemname);
		$storagesummary=$this->smdetailsmodel->getstoragesummary($systemname);
		$userno=$this->smdetailsmodel->getusernumber($systemname);
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getclusterusage($systemname,"today","today");

		include "view/displaysystemparams.php";
	}
	if(strcmp($systemname,"Neha")==0){
		$nodesummary=$this->smdetailsmodel->getsgenodesummary($systemname);
	//	$queuesummary=$this->smdetailsmodel->getslurmqueuesummary($systemname);
		$jobnumber=$this->smdetailsmodel->getsgejobnumber($systemname);
		$storagesummary=$this->smdetailsmodel->getstoragesummary($systemname);
		$userno=$this->smdetailsmodel->getusernumber($systemname);
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getclusterusage($systemname,"today","today");

		include "view/displaysystemparams.php";
	}
	if(strcmp($systemname,"Licenses")==0){
		list($timeofmon,$licensesummary)=$this->smdetailsmodel->getlicenseusedstatus();
		include "view/displaylicensehome.php";
	}
	
	if(strcmp($systemname,"GWS")==0){
		list($timeofmon,$gwssummary)=$this->smdetailsmodel->getgwscurstatus();
		include "view/displaygwshome.php";
	}
	
	
//	$jobdetails=$this->smdetailsmodel->getjobdetails($systemname);
//	include "view/displayjobs.php";
	}

	else{
		$myusertype=$_SESSION['HPCSESSION']->getUserType();
		$displaysysparams=$this->smdetailsmodel->getsystemparamsfordisplay($systemname,$myusertype);
		$sysparams=$this->smdetailsmodel->getsystemparams($systemname,$myusertype);
		if(in_array($systemparam,$sysparams))
		{
			##this parameter can be viewed by this user
		
		if(strcmp($systemparam,"Storage_Logs")==0){
		$logmsgs=$this->smdetailsmodel->getlogmsgs($systemname);
		include "view/displaylogs.php";
		} 
		if(strcmp($systemparam,"Storage_Servers")==0){
		$storserverstat=$this->smdetailsmodel->getstorageserverstatus($systemname);
		include "view/displayserverstatus.php";
		}
		if(strcmp($systemparam,"Storage_Status")==0){
		$storstat=$this->smdetailsmodel->getstoragestatus($systemname);

		include "view/displaystoragestatus.php";
		} 
		if(strcmp($systemparam,"DDN_Storage")==0){
		if(isset($_GET['systemattribute'])){
		$ddndevname = filter_input(INPUT_GET,'systemattribute',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		if(strcmp($ddndevname,"Controllers")==0){
			$ddnconstat=$this->smdetailsmodel->getddnconstatus($systemname);
			 include "view/displayddnconstatus.php";
		}
		if(strcmp($ddndevname,"Enclosures")==0){
			$ddndisks=$this->smdetailsmodel->getddnencl($systemname);
			 include "view/displayddnencl.php";
		}
		if(strcmp($ddndevname,"Disks")==0){
			$ddndisks=$this->smdetailsmodel->getddndisks($systemname);
			 include "view/displayddndisks.php";
		}
		if(strcmp($ddndevname,"Pools")==0){
			$ddndisks=$this->smdetailsmodel->getddnpools($systemname);
			 include "view/displayddnpools.php";
		}
		}
		else{
		$ddnconstat=$this->smdetailsmodel->getddnstatus($systemname);
		include "view/displayddnstatus.php";
		}
		}
		if(strcmp($systemparam,"Users")==0){
		$users=$this->smdetailsmodel->getusers($systemname);
		include "view/displayusers.php";
		} 
		if(strcmp($systemparam,"Cluster_Usage_History")==0) {
		if(isset($_POST['showclusterusage']) ){
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getclusterusage($systemname,$fromval,$toval);
		}
		else{
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getclusterusage($systemname,"today","today");
		}
		include "view/displayclusterusage.php";
		}
		if(strcmp($systemparam,"Queue_Usage")==0) {
		if(isset($_POST['showclusterusage']) ){
        		if(isset($_POST['partition'])){
        		 $partitionval = filter_input(INPUT_POST,'partition',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
		list($partitions,$graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getqueueusage($systemname,$partitionval,$fromval,$toval);
		}
		else{
		
		list($partitions,$graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getqueueusage($systemname,"all.q*","today","today");
		}
		include "view/displayqueuehistoryusage.php";
		}
		if(strcmp($systemparam,"Jobs")==0) {
		if(strcmp($systemname,"Ivy")==0){
		$jobdetails=$this->smdetailsmodel->getslurmjobdetails($systemname,"All");
		$jobnumber=$this->smdetailsmodel->getslurmjobnumber($systemname);
		include "view/displayslurmjobs.php";
		}
		else{
		$jobdetails=$this->smdetailsmodel->getsgejobdetails($systemname);
		include "view/displaysgejobs.php";

		} 
		}
		if(strcmp($systemparam,"JobsChart")==0) {
		if(strcmp($systemname,"Ivy")==0){
		list($userjobs,$usercores,$partitioncores,$processcores)=$this->smdetailsmodel->getslurmjobcharts($systemname,"All");
		include "view/displayjobcharts.php";
		}
		}
		if(strcmp($systemparam,"Queues")==0) {
		if(strcmp($systemname,"Ivy")==0){
		$queuesummary=$this->smdetailsmodel->getslurmqueuesummary($systemname);
		include "view/displayslurmqueues.php";
		}
		else{
		$nodesummary=$this->smdetailsmodel->getsgequeueinfo($systemname);
		include "view/displaysgequeues.php";
		}
		}
		if(strcmp($systemparam,"Nodes (Detailed)")==0) {
		$nodedetails=$this->smdetailsmodel->getslurmnodedetails($systemname);
		include "view/displayslurmnodedetails.php";	
		}
		if(strcmp($systemparam,"Nodes")==0) {
		if(strcmp($systemname,"Ivy")==0){
		$nodesummary=$this->smdetailsmodel->getslurmnodesummary($systemname);
		$nodedetails=$this->smdetailsmodel->getslurmnodeinfo($systemname);
		include "view/displayslurmnodes.php";	

		}
		else{
		$nodedetails=$this->smdetailsmodel->getsgenodeinfo($systemname);
		include "view/displaysgenodes.php";	

		}
		}
		if(strcmp($systemparam,"Job_Accounting")==0){
		if(strcmp($systemname,"Ivy")==0){
		if(isset($_POST['slurmaccounting']) ){
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['summarytype'])){
        		 $summary_type = filter_input(INPUT_POST,'summarytype',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
			if($summary_type=="User"){
		$usrsumm=$this->smdetailsmodel->getslurmusersummary($systemname,$fromval,$toval);
		include "view/displayslurmusersummary.php";
			}
			if($summary_type=="Group"){
		$grpsumm=$this->smdetailsmodel->getslurmgroupsummary($systemname,$fromval,$toval);
		include "view/displayslurmgroupsummary.php";
			}
			if($summary_type=="Jobtype"){
		$jobsumm=$this->smdetailsmodel->getslurmjobsummary($systemname,$fromval,$toval);
		include "view/displayslurmjobsummary.php";
			}
			if($summary_type=="Display"){
		list($jobsumm,$finishedjobs)=$this->smdetailsmodel->getslurmfinishedjobs($systemname,$fromval,$toval);
		include "view/displayslurmfinishedjobs.php";
			}
		}
		else{
		list($jobsumm,$finishedjobs)=$this->smdetailsmodel->getslurmaccounting($systemname);
		include "view/displayslurmaccounting.php";
		}
		}
		if(strcmp($systemname,"Neha")==0){
		if(isset($_POST['sgeaccounting']) ){
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['summarytype'])){
        		 $summary_type = filter_input(INPUT_POST,'summarytype',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
			if($summary_type=="User"){
		$usrsumm=$this->smdetailsmodel->getsgeusersummary($systemname,$fromval,$toval);
		include "view/displaysgeusersummary.php";
			}
			if($summary_type=="Group"){
		$grpsumm=$this->smdetailsmodel->getsgegroupsummary($systemname,$fromval,$toval);
		include "view/displaysgegroupsummary.php";
			}
			if($summary_type=="Jobtype"){
		$jobsumm=$this->smdetailsmodel->getsgejobsummary($systemname,$fromval,$toval);
		include "view/displaysgejobsummary.php";
			}
			if($summary_type=="Display"){
		list($jobsumm,$finishedjobs)=$this->smdetailsmodel->getsgefinishedjobs($systemname,$fromval,$toval);
		include "view/displaysgefinishedjobs.php";
			}
		}
		else{
		list($jobsumm,$finishedjobs)=$this->smdetailsmodel->getsgeaccounting($systemname);
		include "view/displaysgeaccounting.php";
		}
		}
		}//Job Accounting
		if(strcmp($systemparam,"Year_Accounting_Summary")==0){
		if(strcmp($systemname,"Ivy")==0){
		$yearsumm=$this->smdetailsmodel->getslurmyearsummary($systemname);
		include "view/displayslurmyearsummary.php";

		}
		else{
		$yearsumm=$this->smdetailsmodel->getsgeyearsummary($systemname);
		include "view/displaysgeyearsummary.php";
		}
		}
		
		//GWS History Usage
		
		if(strcmp($systemparam,"GWS_History_Usage")==0) {
			
			/*
			//echo $systemname;
		if(isset($_POST['showgwsusage']) ){
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        		}
		//$timeunits represents X-axis value, here Workstation names are X-axis
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getgwsusage($systemname,$fromval,$toval);
		}
		else{
		list($graphlabel,$usepercents,$timeunits)=$this->smdetailsmodel->getgwsusage($systemname,"today","today");
			
		}
				//include "view/displaygwsusage.php"; */
				
				
		
				
		if(isset($_POST['showgwsusage']) ){
			
			//echo "welcome to post";
        		if(isset($_POST['partition'])){
        		 $wsname = filter_input(INPUT_POST,'partition',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
				
        		}
        		if(isset($_POST['fromdate'])){
        		 $fromval = filter_input(INPUT_POST,'fromdate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
				
        		}
        		if(isset($_POST['todate'])){
        		 $toval = filter_input(INPUT_POST,'todate',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
				
        		}
				list($WSnameall,$WSReport)=$this->smdetailsmodel->getWSReport($wsname,$fromval,$toval);
				//print_r($WSReport);
		}
			
		else {			list($WSnameall,$WSReport)=$this->smdetailsmodel->getWSReport("All","CM","CM"); }
			
					
						
		include "view/displayWSreport.php";
		}
		
		
		//GWS AD users
		
		if(strcmp($systemparam,"GWS_AD_Users")==0) {
			
			$gwsadusers=$this->smdetailsmodel->getADusers(); 
			
					
						
		include "view/displayADusers.php";
		}
		
		
		
		
		
		if(strcmp($systemparam,"Abaqus")==0){
		$software="Abaqus";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}
		if(strcmp($systemparam,"ANSYS_18_2")==0){
		$software="ANSYS_18_2";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}

	if(strcmp($systemparam,"ANSYS_17_1")==0){
		$software="ANSYS_17_1";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}

if(strcmp($systemparam,"ANSYS_19")==0){
		$software="ANSYS_19";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}

                if(strcmp($systemparam,"COMSOL")==0){
                $software="COMSOL";
                $licenses=$this->smdetailsmodel->getlicensestatus($software);
                include "view/displaylicensestatus.php";
                }
		if(strcmp($systemparam,"CFD-ACE/SYSWELD")==0){
		$software="CFD-ACE/SYSWELD";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}
		
		if(strcmp($systemparam,"License_Users")==0){
		$licenseusers=$this->smdetailsmodel->getlicenseuserstatus("All");
		include "view/displaylicenseuserstatus.php";
		}

		if(strcmp($systemparam,"User_Details")==0){
        	$username = filter_input(INPUT_GET,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
		list($userdetails,$alljobs,$jobhistory)=$this->smdetailsmodel->getuserdetails($username);
		include "view/displayuserdetails.php";

		}
		}###if in_array
		else{
		 include "view/page_unauthorized";
                }

	}##end of else
		
	}//function end
		


}
?>
