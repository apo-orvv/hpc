<?php

require_once('model/hpcsession.php');
require_once('model/authenticate.php');

class LoginModel{

	  public function __construct(){


        }

	public function authenticateuser($username,$password){

		$hpcsession=ldapauthenticate($username,$password);
		if($hpcsession){
		$uname=$hpcsession->getUserName();
		$usertype=$this->getuserPrivilege($uname);
		echo "User type is $usertype\n";
                $hpcsession->setUserType($usertype);
		return $hpcsession;
		}
		else{
		return FALSE;
		}

	}

	public function getuserPrivilege($uname){


		$db=new Db();
                $dbcon=$db->getInstance("hpcweb");

		$query="SELECT * FROM HPCPORTALUSRS WHERE LDAPUSRNAME= :name";
                $req = $dbcon->prepare($query);
                $req-> execute(array(':name' => $uname));
                $userRow=$req->fetch(PDO::FETCH_ASSOC);
                if($req->rowCount() > 0)
                {
                      $usertype= $userRow['MEMTYPE'];

		}
		else{
			$usertype='U';
		}
		return $usertype;
	}	

}
