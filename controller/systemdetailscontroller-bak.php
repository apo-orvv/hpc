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
	}
	if(strcmp($systemname,"Neha")==0){
		$nodesummary=$this->smdetailsmodel->getsgenodesummary($systemname);
	//	$queuesummary=$this->smdetailsmodel->getslurmqueuesummary($systemname);
		$jobnumber=$this->smdetailsmodel->getsgejobnumber($systemname);
		$storagesummary=$this->smdetailsmodel->getstoragesummary($systemname);
		$userno=$this->smdetailsmodel->getusernumber($systemname);
	}
	include "view/displaysystemparams.php";
	
	
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
		if(strcmp($systemparam,"Jobs")==0) {
		if(strcmp($systemname,"Ivy")==0){
		$jobdetails=$this->smdetailsmodel->getslurmjobdetails($systemname);
		$jobnumber=$this->smdetailsmodel->getslurmjobnumber($systemname);
		include "view/displayslurmjobs.php";
		}
		else{
		$jobdetails=$this->smdetailsmodel->getsgejobdetails($systemname);
		include "view/displaysgejobs.php";

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
		list($jobsumm,$finishedjobs)=$this->smdetailsmodel->getslurmfinishedjobs($systemname,$fromval,$toval);
		include "view/displayslurmfinishedjobs.php";
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
		if(strcmp($systemparam,"User_Accounting")==0){
		if(isset($_GET['username'])){
			$username=stripslashes($_GET['username']);
			if(strcmp($systemname,"Ivy")==0){
				$yearsumm=$this->smdetailsmodel->getslurmyusrdetails($systemname,$username);
				include "view/displayslurmmyusrsummary.php";

			}
			else{
				$yearsumm=$this->smdetailsmodel->getsgemyusrdetails($systemname,$username);
				include "view/displaysgemyusrsummary.php";
				}
		}//isset username
		}//User_accounting
		if(strcmp($systemparam,"Abaqus")==0){
		$software="Abaqus";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}
		if(strcmp($systemparam,"CFD-ACE/SYSWELD")==0){
		$software="CFD-ACE/SYSWELD";
		$licenses=$this->smdetailsmodel->getlicensestatus($software);
		include "view/displaylicensestatus.php";
		}
		
		if(strcmp($systemparam,"Sysweld_Users")==0){
		$software="CFD-ACE/SYSWELD";
		$licenseusers=$this->smdetailsmodel->getlicenseuserstatus($software);
		include "view/displaylicenseuserstatus.php";
		}
		if(strcmp($systemparam,"Abaqus_Users")==0){
		$software="Abaqus";
		$licenseusers=$this->smdetailsmodel->getlicenseuserstatus($software);
		include "view/displaylicenseuserstatus.php";
		}
		}###if in_array
		else{
		 include "view/page_unauthorized";
                }

	}##end of else
		
	}//function end
		


}
?>
