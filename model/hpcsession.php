<?php

class HPCSession {
	
//public $loggedin;
private $username;
private $usertype;
private $userfullname;
private $usericno;
private $useremail;

public function __construct($uname,$utype,$ufullname,$useric,$usermail){
	//$this->loggedin=false;
	$this->username = $uname;
	$this->usertype = $utype;
	$this->userfullname = $ufullname;
	$this->usericno = $useric;
	$this->useremail = $usermail;
}

/*public function getsessionstatus(){
	return $this->loggedin;
}*/

/*public function setsession(){
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


}*/

public function getUserName()
{
	return $this->username;
}

public function getUserType()
{
        return $this->usertype;
}
public function setUserType($usertype){

	$this->usertype=$usertype;
}
public function getUserFullName()
{
        return $this->userfullname;
}

public function getUserICNo()
{
        return $this->usericno;
}

public function getUserEmail()
{
        return $this->useremail;
}

	
  }
?>
