<?php
session_start(); 
/*
require_once('model/model_hpc.php');

class Controller{
public $model;
public function __construct()
{
$this->model=new Model();
}

public function invoke()
{
$result=$this->model->login_func();
include 'view/login_hpc.php';

}
}
*/


require_once('model/model_hpc.php');

class Controller{
public $model;
public function __construct()
{
$this->model=new Model();
}

public function invoke()
{
$err_msg='';	
$result=$this->model->login_func($err_msg);
/*
if($result=='success')
{
include 'view/afterlogin_hpc.php';
}
else
{
include 'view/login_hpc.php';
}
*/

if($err_msg=='afterlogin')
{
	echo "After login".$err_msg;
//include 'view/afterlogin_hpc.php';
}
if($err_msg=='login' || $err_msg=='')
{
	echo "login".$err_msg;
include 'view/login_hpc.php';
}

}
}



?>





