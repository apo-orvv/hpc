<?php
require_once("model/model_login.php");
class LoginController{

private $loginmodel;
public function __construct(){


	$this->loginmodel=new LoginModel();
	$this->start_session();
}	

public function start_session(){

        session_name("hpcportal");
        //session_cache_expire(15); //minutes
		session_cache_expire(30); //minutes
        session_start();
        session_regenerate_id();    // regenerated the session, delete the old one.
        $inactive =1900;
        if(isset($_SESSION['start']) ) {
                $session_life = time() - $_SESSION['start'];
                        if($session_life > $inactive){
                        session_destroy();
                        header("Location: index.php");
                        }
        }
        $_SESSION['start'] = time();

}

public function displaylogin(){

	include "view/login";

}
public function checklogin(){
		if(isset($_POST['submit'])){
                $username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS); //username and password sent from Form
                $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$hpcsession=$this->loginmodel->authenticateuser($username,$password);
		if($hpcsession){
			 $_SESSION['HPCSESSION']=$hpcsession;
		$usertype=$hpcsession->getUserType();
	//	echo "Your user type isssss $usertype\n";	
	//		include "view/login_success";
	//	header("Location:index.php?hpcpage='login_success'");
	 echo "<script> window.location.assign('index.php?hpcpage=login_success'); </script>";		

		}
		else{
			include "view/login_unsuccess";
		}
		}

		else{
		$this->displaylogin();
		}

}

public function getloginstatus(){
	if(isset($_SESSION['HPCSESSION'])){
                        return TRUE;
                }

        else{
                return FALSE;

	}
}

public function end_session(){
session_unset();
session_destroy();
echo "<script> window.location.assign('index.php'); </script>";		
}
}
?>
