<?php
require_once("model/model_main.php");

class Controller{

 public $model;	
 public function __construct()
    {
        $this->model = new Model();

    }
 public function invoke() {
	include "view/header.php";
	$loginstate=$this->model->getlogin();
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
		include "view/$mypage";
		}
		if(strcmp($mypage, "logout")==0){
			$this->model->end_session();
		}

	}
	else{
	include "view/slider.php";
	}
	include "view/footer.php";
}



}
?>
