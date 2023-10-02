<?php
require_once('model/hpcsession.php');
require_once('model/authenticate.php');
require_once('model/start_session.php');

class Model{

	public $hpcsession;
	public function __construct(){

		start_my_session();
		
	}	
	
	public function getlogin(){
		
		if(isset($_SESSION['HPCSESSION'])){
			return TRUE;
		}
	
		else if(isset($_POST['submit'])){
		$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_FULL_SPECIAL_CHARS); //username and password sent from Form
		$password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

		$hpcsession=authenticate($username,$password);


		if($hpcsession){
		$_SESSION['HPCSESSION']=$hpcsession;
		return TRUE;
		}
	}
	else{
		return FALSE;

}
}

public function end_session(){
session_unset();
session_destroy();
}
}
?>
