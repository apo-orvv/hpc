<?php
require_once("model/model_main.php");
require_once("controller/logincontroller.php");
require_once("controller/systemdetailscontroller.php");
require_once('controller/controller_statusscreen.php');
require_once('controller/print_con.php');
require_once('controller/user_con.php');
require_once('controller/roster.php');
class Controller{

public $model;	
public $loginctrl;
public $printcon;	
public $usercon;
public $rostercon;
 public function __construct()
    {
     $this->model = new Model();
	 $this->loginctrl=new LoginController();
     $this->printcon=new print_con();
     $this->usercon=new user_con();	 
	 $this->rostercon=new roster_con();
    }
 public function invoke() {


	include "view/header.php";
	$loginstate=$this->loginctrl->getloginstatus();
	if($loginstate){
	 $username=$_SESSION['HPCSESSION']->getUserName();
	 $usertype=$_SESSION['HPCSESSION']->getUserType();
	 $userfullname=$_SESSION['HPCSESSION']->getUserFullName();
	
	}
	else{
	$username='';
	$usertype='';
	$userfullname='';
	}
	include "view/lmenu.php";
	
	if(isset($_GET['hpcresource'])){
		$myresource=stripslashes($_GET['hpcresource']);
		$myresource=str_replace('\'','',$myresource);
		include "view/hpcresources/$myresource";
	}
	else if(isset($_GET['hpcpage'])){

		$mypage=stripslashes($_GET['hpcpage']);
                $mypage=str_replace('\'','',$mypage);
		if(strcmp($mypage, "login")==0){

			if(isset($_GET['action'])){
			$this->loginctrl->checklogin();
			}
			else{
			$this->loginctrl->displaylogin();
			}
			//header("Location:index.php");
		}
		if(strcmp($mypage, "logout")==0){
			$this->loginctrl->end_session();
		//	include "view/logout";
		}
		if(strcmp($mypage,"login_success")==0){
			include "view/login_success";
		}
		if(strcmp($mypage, "statusscreen")==0){
			$statuscontrollers=new Controller_StatusScreen();
			$statuscontrollers->invoke();
		}
		/* Included for Printing on 24/11/2017 */
		
		if(strcmp($mypage, "printreq")==0)
				{
					//echo "hello";
                      $this->printcon->printreq();
                }
		if(strcmp($mypage, "printreqprint")==0)
				{
					//echo "hello";
                      $this->printcon->printreqprint();
                }	
		if(strcmp($mypage, "printstat")==0) 
		{
			if(!(isset ($_SESSION['HPCSESSION'])))
			{

			include "view/page_unauthorized";
			}
		      else{				//echo "hello";
                      $this->printcon->printstat();
			}
                }	

			if(strcmp($mypage, "rosterpattern")==0)
				{
					//echo "hello";
                      $this->rostercon->rosterpattern();
                }	
			if(strcmp($mypage, "rosterdisplay")==0)
				{
					//echo "hello";
                      $this->rostercon->rosterdisplay();
                }
			if(strcmp($mypage, "rosterupdate")==0)
				{
					//echo "hello";
                      $this->rostercon->rosterupdate();
                }
			if(strcmp($mypage, "leavereport")==0)
				{
					//echo "hello";
                      $this->rostercon->leavereport();
                }	
		if(strcmp($mypage, "actionreport")==0)
				{
					//echo "hello";
                      $this->rostercon->actionreport();
                }
if(strcmp($mypage, "hpcuserreq")==0)
				{
					//echo "hello";
                      $this->usercon->userreq();
                }
		if(strcmp($mypage, "hpcuserprt")==0)
				{
					//echo "hello";
                      $this->usercon->userreqprint();
                }	
		if(strcmp($mypage, "userstat")==0)
				{
					//echo "hello";
                      $this->usercon->user_stat();
                }				
		if(strcmp($mypage, "userfeedback")==0)
			
				{
		
				//echo "hello" .$username;
                $this->usercon->userfeedback($username);
				
					
                }		
		if(strcmp($mypage, "systemdetails")==0){

			if(!(isset ($_SESSION['HPCSESSION'])))
			{

			include "view/page_unauthorized";
			}
			else{

				if(isset($_GET['systemname'])){
				$smcontroller=new SmDetailsController();
				$sysname=stripslashes($_GET['systemname']);	
				$sysparam='';	
				if(isset($_GET['systemparam'])){
				$sysparam=stripslashes($_GET['systemparam']);	

				}
				$sysaction='';
				if(isset($_GET['action'])){
				$sysaction=stripslashes($_GET['action']);	

				}
				$smcontroller->getdetails($sysname,$sysparam,$sysaction);

				}
			}
		}
	}//if hpcpage
	else{
	include "view/slider.php";
	}
	include "view/footer.php";
}

public function invoke_ajax() {
if($_GET['hpcpage']=='statusscreen')
{
$statuscontrollers=new Controller_StatusScreen();
$statuscontrollers->invoke();
}

}

}
?>
