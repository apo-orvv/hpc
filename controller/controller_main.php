<?php
require_once("model/model_main.php");
require_once("controller/logincontroller.php");
require_once("controller/systemdetailscontroller.php");
//require_once('controller/controller_statusscreen.php');
require_once('controller/controller_statusscreen_new.php');
//require_once("controller/accountmanagementcontroller.php");
require_once('controller/print_con.php');
require_once('controller/user_con.php');
require_once('controller/roster.php');
require_once('controller/hardware_con.php');
require_once('controller/software_con.php');
require_once('controller/manualcontroller.php');
require_once 'controller/ControllerRTClog.php';
require_once('controller/vdicontroller.php');
require_once('controller/cloud-controller.php');


class Controller
{

	public $model;
	public $loginctrl;
	public $printcon;
	public $usercon;
	public $rostercon;
	public function __construct()
	{
		$this->model = new Model();
		$this->loginctrl = new LoginController();
		$this->printcon = new print_con();
		$this->usercon = new user_con();
		$this->rostercon = new roster_con();
		//$this->vdicon=new vdiController();
	}
	public function invoke()
	{


		include "view/header.php";
		$loginstate = $this->loginctrl->getloginstatus();
		if ($loginstate) {
			$username = $_SESSION['HPCSESSION']->getUserName();
			$usertype = $_SESSION['HPCSESSION']->getUserType();
			$userfullname = $_SESSION['HPCSESSION']->getUserFullName();
		} else {
			$username = '';
			$usertype = '';
			$userfullname = '';
		}
		include "view/lmenu.php";

		if (isset($_GET['hpcresource'])) {
			$myresource = stripslashes($_GET['hpcresource']);
			$myresource = str_replace('\'', '', $myresource);
			include "view/hpcresources/$myresource";
		} else if (isset($_GET['hpcpage'])) {

			$mypage = stripslashes($_GET['hpcpage']);
			$mypage = str_replace('\'', '', $mypage);
			if (strcmp($mypage, "login") == 0) {

				if (isset($_GET['action'])) {
					$this->loginctrl->checklogin();
				} else {
					$this->loginctrl->displaylogin();
				}
				//header("Location:index.php");
			}
			if (strcmp($mypage, "logparserA") == 0) {
				include "controller/controller_parserA.php";
			}
			if (strcmp($mypage, "logparserC") == 0) {
				include "controller/controller_parserC.php";
			}
			if (strcmp($mypage, "lpANSYS") == 0) {
				include "controller/controller_lpANSYS.php";
			}
			if (strcmp($mypage, "logout") == 0) {
				$this->loginctrl->end_session();
				//	include "view/logout";
			}
			if (strcmp($mypage, "login_success") == 0) {
				include "view/login_success";
			}
			if (strcmp($mypage, "statusscreen") == 0) {
				$statuscontrollers = new Controller_StatusScreen();
				$statuscontrollers->invoke();
			}

			if (strcmp($mypage, "statusscreen_new") == 0) {

				//echo "hello";

				$statuscontrollers1 = new Controller_StatusScreen_new();

				$statuscontrollers1->invoke();
			}

			if (strcmp($mypage, "statusscreen_new") == 0) {

				//echo "hello";

				$statuscontrollers1 = new Controller_StatusScreen_new();

				$statuscontrollers1->invoke();
			}


			//included on 02/09/2022
			if (strcmp($mypage, "cloud_allotment") == 0) {

				//echo "hello";

				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'CA') || ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {

					$statuscontrollers1 = new Controller_cloud();

					$statuscontrollers1->invoke();
				} else {
					include "view/page_unauthorized";
				}
			}

			//included on 13/09/2022
			if (strcmp($mypage, "change_crew_members") == 0) {

				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'O'))) {

					//echo "hello";
					$this->rostercon->change_crew_members();
				} else {
					include "view/page_unauthorized";
				}
			}

			//included on 02/01/2023
			if (strcmp($mypage, "change_report") == 0) {

				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'O'))) {

					//echo "hello";
					$this->rostercon->change_report();
				} else {
					include "view/page_unauthorized";
				}
			}


			//included on 02/01/2023
			if (strcmp($mypage, "over_time_report") == 0) {

				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'O'))) {

					//echo "hello";
					$this->rostercon->over_time_report();
				} else {
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "manageaccount") == 0) {
				if (isset($_SESSION['HPCSESSION']) && $_SESSION['HPCSESSION']->getUserType() == 'A') {
					$acctmgmtcontrollers = new AccountManagementController();
					$acctmgmtcontrollers->invoke();
				} else {
					include "view/page_unauthorized";
				}
			}
			/* Included for Printing on 24/11/2017 */

			if (strcmp($mypage, "printreq") == 0) {
				//echo "hello";
				$this->printcon->printreq();
			}
			if (strcmp($mypage, "printreqprint") == 0) {
				//echo "hello";
				$this->printcon->printreqprint();
			}
			if (strcmp($mypage, "printstat") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {

					$this->printcon->printstat();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "printtake") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {

					$this->printcon->printtake();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "printreport") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'O'))) {

					$this->printcon->printreport();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "rosterpattern") == 0) {
				//echo "hello";
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS'))) {
					$this->rostercon->rosterpattern();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}	//rosterpattern
			if (strcmp($mypage, "rosterdisplay") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {
					//echo "hello";
					$this->rostercon->rosterdisplay();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //rosterdisplay
			if (strcmp($mypage, "rosterupdate") == 0) {

				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {
					//echo "hello";


					$this->rostercon->rosterupdate();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //rosterupdate

			if (strcmp($mypage, "crewview") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {
					//echo "hello";
					$this->rostercon->view_update_crew_members();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //Crew View


			if (strcmp($mypage, "crewupdate") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {
					//echo "hello";
					$this->rostercon->update_crew_members();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //Crew View
			if (strcmp($mypage, "leavereport") == 0) {
				//echo "hello";
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$this->rostercon->leavereport();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //leavereport	
			if (strcmp($mypage, "actionreport") == 0) {
				//echo "hello";
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$this->rostercon->actionreport();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			} //acionreport
			if (strcmp($mypage, "hpcuserreq") == 0) {
				//echo "hello";
				$this->usercon->userreq();
			}
			if (strcmp($mypage, "hpcuserprt") == 0) {
				//echo "hello";
				$this->usercon->userreqprint();
			}
			if (strcmp($mypage, "userstat") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					//echo "hello";
					$this->usercon->user_stat();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "allusers") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					//echo "hello";
					$this->usercon->ldapusersall();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "wsallusers") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					//echo "hello";
					$this->usercon->wsldapusersall();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "wsapprove") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					//echo "hello";
					$this->usercon->wsuser();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "divtodivforward") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'AID'))) {
					echo "hello";
					$this->usercon->divtodivapproval();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "divtosecforward") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'AD'))) {
					echo "hello";
					$this->usercon->divtosecapproval();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "sectoadminforward") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'AS'))) {
					echo "hello";
					$this->usercon->sectoadminapproval();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "hpcadminprocess") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'A'))) {
					//echo "hello";
					$this->usercon->hpcadminprocess();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "addhpcuser") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'A'))) {
					//echo "hello";
					$this->usercon->addhpcuser();
				} else {				//echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "hpcadminapproval") == 0) {
				if ((isset($_SESSION['HPCSESSION'])) && (($usertype == 'A'))) {
					//echo "hello";
					$this->usercon->userapproval();
					echo "approval";
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "userfeedback") == 0) {

				//echo "hello" .$username;
				$this->usercon->userfeedback($username);
			}


			if (strcmp($mypage, "viewipadd") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->viewipadd();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "editipadd") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->editipadd();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}


			//Old Cluster node assignment		

			if (strcmp($mypage, "viewclusNodestat") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->viewclusNodestat();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "editclusNode") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->editclusNode();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}



			//New Workstation assignment		

			if (strcmp($mypage, "viewhighws") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->viewhighws();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "edithighws") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->edithighws();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "viewhardware") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->viewhardware();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "edithardwares") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->edithardwares();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "viewups") == 0) {
				//echo "hello";

				$hardwarecontroller = new hardwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$hardwarecontroller->viewups();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			/*
if(strcmp($mypage,"editups")==0){
//echo "hello";

		$hardwarecontroller=new hardwareController();
			 if((isset ($_SESSION['HPCSESSION'])) &&  (($usertype=='A') || ($usertype=='AI') or ($usertype=='O') || ($usertype=='AS') || ($usertype=='AD') )){
		$hardwarecontroller->edithardwares();
                        }
                      else{                             //echo "hello";
                        include "view/page_unauthorized";
                        }
		}
		
*/

			if (strcmp($mypage, "viewsoftware") == 0) {
				//echo "hello";

				$softwarecontroller = new softwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$softwarecontroller->viewsoftware();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "editsoftwares") == 0) {
				//echo "hello";

				$softwarecontroller = new softwareController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$softwarecontroller->editsoftwares();
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "vdi") == 0) {
				//echo "hello";
				include "view/vdi.php";
				//$this->vdicon->vdipage();
			}

			if (strcmp($mypage, "vdirequest") == 0) {
				//echo "hello";
				$vdicon = new vdicontroller();
				$vdicon->vdireq();
				//include "view/vdirequest.php";
			}

			// RTC Shift Log Pages


			if (strcmp($mypage, "templog") == 0) {
				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->templog();
				}
			}

			if (strcmp($mypage, "modify") == 0) {

				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->modify();
				}
			}

			if (strcmp($mypage, "modifydata") == 0) {

				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->modifyData();
				}
			}

			if (strcmp($mypage, "viewremark") == 0) {

				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->viewRemark();
				}
			}

			if (strcmp($mypage, "editremark") == 0) {

				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->editRemark();
				}
			}

			if (strcmp($mypage, "updateremark") == 0) {
				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->updateRemark();
				}
			}

			if (strcmp($mypage, "viewremarkhistroy") == 0) {
				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->viewRemarkHistory();
				}
			}
			if (strcmp($mypage, "chart") == 0) {
				$RTClogcon = new ControllerRTClog();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AID'))) {

					$RTClogcon->chartView();
				}
			}

			if (strcmp($mypage, "systemdetails") == 0) {

				if (!(isset($_SESSION['HPCSESSION']))) {

					include "view/page_unauthorized";
				} else {

					if (isset($_GET['systemname'])) {
						$smcontroller = new SmDetailsController();
						$sysname = stripslashes($_GET['systemname']);
						$sysparam = '';
						if (isset($_GET['systemparam'])) {
							$sysparam = stripslashes($_GET['systemparam']);
						}
						$sysaction = '';
						if (isset($_GET['action'])) {
							$sysaction = stripslashes($_GET['action']);
						}


						$smcontroller->getdetails($sysname, $sysparam, $sysaction);
					}
				}
			}
			if (strcmp($mypage, "manuals") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'U'))) {
					$mymanuals = $manualcontroller->viewmanual($usertype, $username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "manualsvdi") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'U'))) {
					$mymanuals = $manualcontroller->viewmanualvdi($usertype, $username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}


			if (strcmp($mypage, "manualsgen") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'U'))) {
					$mymanuals = $manualcontroller->viewmanualgen($usertype, $username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "manualsIR") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'U'))) {
					$mymanuals = $manualcontroller->viewmanualIR($usertype, $username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}

			if (strcmp($mypage, "uploadmanualnote") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->addmanualnote($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "uploadmanualfile") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->addmanualfile($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "editmanualnote") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->editmanualnote($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "editmanualfile") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->editmanualfile($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "deletemanualfile") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->deletemanualfile($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
			if (strcmp($mypage, "deletemanualnote") == 0) {

				$manualcontroller = new manualController();
				if ((isset($_SESSION['HPCSESSION'])) &&  (($usertype == 'A') || ($usertype == 'AI') or ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD'))) {
					$manualcontroller->deletemanualnote($username);
				} else {                             //echo "hello";
					include "view/page_unauthorized";
				}
			}
		} //if hpcpage
		else {
			include "view/slider.php";
		}
		include "view/footer.php";
	}

	public function invoke_ajax()
	{
		if ($_GET['hpcpage'] == 'statusscreen') {
			$statuscontrollers = new Controller_StatusScreen();
			$statuscontrollers->invoke();
		}
	}



	//Included on 29/09/2020

	public function invoke_ajax_new()
	{
		if ($_GET['hpcpage'] == 'statusscreen_new') {
			$statuscontrollers = new Controller_StatusScreen_new();
			$statuscontrollers->invoke();
		}
	}

	//included on 02/09/2022





}