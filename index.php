<?php
//define('__ROOT__', dirname(dirname(__FILE__)));
//set_include_path('E:\wamp\www\');
require_once('controller/controller_main.php');
$controllers=new Controller();

if(isset($_GET['mode']))
$controllers->invoke_ajax();
else
$controllers->invoke();

?>
