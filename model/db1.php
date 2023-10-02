<?php
require_once 'dbclass.php';

$db=new Db();
$dbcon=$db->getInstance("hpcmonitor");
if($dbcon){
echo "Successs...........";
}
else{
echo "No connect string..............Databse errorrrrrrrr";
}
$systemname="Ivy";
$req=$dbcon->prepare("SELECT * from slurmjobs where clustername= :name");
$req->execute(array('name' => $systemname));
$list=$req->fetchAll();
$jobvals=array();
$i=0;
 foreach($list as $jobdetail) {
$jobid=$jobdetail['jobid'];
$partition=$jobdetail['partitionname'];
$jobname=$jobdetail['jobname'];
$user=$jobdetail['username'];
$jobvals[$i]=array($jobid,$partition,$jobname,$user);
$i=$i+1;
}
//print_r($jobvals);

$req=$dbcon->prepare("SELECT * from logmessages where cluster= :name order by time desc");
$req->execute(array('name' => $systemname));
$logmsgs=array();
$i=0;
foreach ($req->fetchAll() as $msg){
$logmsgs[$i]=array($msg['time'],$msg['host'],$msg['message']);
$i++;

}
print_r($logmsgs);
?>

