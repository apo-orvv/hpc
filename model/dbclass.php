<?php

class Db {
	

public $hpchost;
public $hpcdbuser;
public $hpcdbpasswd;

public function __construct(){

 $this->hpchost="localhost";
  $this->hpcdbuser="hpcweb";
  $this->hpcdbpasswd="web@hpc";
}


    public  function getInstance($hpcdb) {

try{	    
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$dbh = new PDO("mysql:host=$this->hpchost;dbname=$hpcdb", $this->hpcdbuser, $this->hpcdbpasswd);
      return $dbh;
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    return false;	
}
    }
  }
?>
