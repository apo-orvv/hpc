<?php
require_once('model/hpcsession.php');
require_once("model/manualmodel.php");
require_once("controller/logincontroller.php");

$loginctrl=new LoginController();
 if(isset($_SESSION['HPCSESSION'])){
$usertype=$_SESSION['HPCSESSION']->getUserType();
}
else{
echo "<p>Unable to get UserType</p>";
}
if(isset($_GET['fileid'])){
$manualid=$_GET['fileid'];
$manualmodel=new manualModel();
 $fileloc=$manualmodel->getmanualfile($usertype,$manualid);

if ((file_exists($fileloc)) && (is_readable($fileloc))) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($fileloc).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileloc));
    readfile($fileloc);

}
else{
	echo "<p>Unable to open file..$fileloc</p>";
}
}
?>
