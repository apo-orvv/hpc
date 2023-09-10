<?php

class HPCSession {
	
public $loggedin;
public $username;
public $usertype;
public $usericno;
public $useremail;

public function __construct($username,$usertype,$useric,$usermail){
	$this->loggedin=false;
}

public function getsessionstatus(){
	return $this->loggedin;
}

public function start_my_session(){
	session_name("hpcportal");
 	session_cache_expire(5); //minutes
        session_start();
	session_regenerate_id();    // regenerated the session, delete the old one.
	$inactive = 300;
	if(isset($_SESSION['start']) ) {
		$session_life = time() - $_SESSION['start'];
			if($session_life > $inactive){
			session_destroy();
			header("Location: logout.php");
			}
	}
	$_SESSION['start'] = time();
}

public function setsession(){
	if((isset($_SESSION['USERNAME'])) && (isset($_SESSION['USERTYPE']))){
		$this->loggedin=true;
		$this->username=$_SESSION['USERNAME'];
		$this->usertype=$_SESSION['USERTYPE'];
	}
	else{
		$this->loggedin=false;
		$this->username='';
		$this->usertype='';
	}


}	
  }
?>
