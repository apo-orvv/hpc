<?php

require_once('model/model_statusscreen.php');
require_once('view/view_statusscreen.php');
require_once('controller/controller_statusscreen.php');


class Controller_StatusScreen{
public $model_screenstatus;

public function __construct()
{

$this->model_screenstatus=new Model_statusscreen;

$this->model_screenstatus->fetch_status();


}

public function invoke()
{

$view_obj=new View_statusscreen;

if(isset($_GET['table']))
{
if(isset($_GET['mode']))
{
$view_obj->view_ajax_table($this->model_screenstatus);
}
else	
$view_obj->view_table($this->model_screenstatus);
}
else
{	
if(isset($_GET['mode']))
{
$view_obj->view_ajax($this->model_screenstatus);
}
else	
$view_obj->view($this->model_screenstatus);
}

}
}





?>





