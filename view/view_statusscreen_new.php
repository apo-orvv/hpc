<?php 

require_once('controller/controller_statusscreen_new.php');
require_once("model/model_statusscreen_new.php");
require_once("view/view_statusscreen_new.php");

class View_statusscreen_new
{	
public function view_ajax_table($model_screenstatus)
{

$outp = "";
$host_num=$model_screenstatus->host_no;
        for($i=0;$i<$host_num;$i++){
			if ($outp == "") {$outp .= "{";}
			
    	if ($outp != "{") {$outp .= ",";}
		$host_status=$model_screenstatus->host_obj[$i]->status;
    $outp .= '"ipstatus'.$i.'":"'.$host_status.'"';
    $service_num=$model_screenstatus->host_obj[$i]->service_no;
	for($j=0;$j<$service_num;$j++){
	$service_status=$model_screenstatus->host_obj[$i]->service[$j]->status;	
	$outp .= ',"servicestatus'.$i.'_'.$j.'":"'.$service_status.'"';
    
	}
	
	}
$outp .= ',"timestamp":"'.$model_screenstatus->time_stamp.'"}';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
//$out_json=json_encode($outp);
echo $outp;


/*$out_json=json_encode($model_screenstatus);
echo $out_json;
*/
//echo "ajax works";
}

public function view_ajax($model_screenstatus)
{

$outp = "";
$host_num=$model_screenstatus->host_no;

echo $host_num;

        for($i=0;$i<$host_num;$i++){
			$host_name=$model_screenstatus->host_obj[$i]->name;
			if ($outp == "") {$outp .= "{";}
			
    	if ($outp != "{") {$outp .= ",";}
		$host_status=$model_screenstatus->host_obj[$i]->status;
if($host_name=="IVY" || $host_name=="HN1" || $host_name=="XEON_SMP1" || $host_name=="XEON_SMP2" || $host_name=="Blade" || $host_name=="GPU" 
|| $host_name=="Tyrone" || $host_name=="QNAP" || $host_name=="HP" || $host_name=="igcardc" || $host_name=="igcardc-BU" 
|| $host_name=="WS-AD-1" || $host_name=="WS-AD-2" || $host_name=="HPCFIRE1" || $host_name=="HPCFIRE2" || $host_name=="CAELINLS" 
|| $host_name=="CAEWINLS" || $host_name=="WINLS3" || $host_name=="WINLSTMP" || $host_name=="GWS-1" || $host_name=="GWS-2" 
|| $host_name=="GWS-3" || $host_name=="GWS-4" || $host_name=="GWS-5" || $host_name=="GWS-6" || $host_name=="GWS-7" 
|| $host_name=="GWS-8" || $host_name=="GWS-9" || $host_name=="GWS-10" || $host_name=="GWS-11" || $host_name=="GWS-12" 
 || $host_name=="GWS-13" || $host_name=="GWS-14" || $host_name=="GWS-15"  ||  $host_name=="GWS-16" || $host_name=="GWS-17" 
 || $host_name=="GWS-18" || $host_name=="GWS-19" || $host_name=="GWS-20" || $host_name=="GWS-21" || $host_name=="GWS-22" 
 || $host_name=="GWS-23" || $host_name=="GWS-24" || $host_name=="GWS-25" || $host_name=="GWS-26" || $host_name=="GWS-27" 
 || $host_name=="GWS-28" || $host_name=="GWS-29"  || $host_name=="GWS-30" || $host_name=="GWS-31" || $host_name=="GWS-32" 
 || $host_name=="PRSER" || $host_name=="hpdesignjet" || $host_name=="CP" || $host_name=="hpofficejet" || $host_name=="HPLSR" 
 || $host_name=="Z6800-plotter" || $host_name=="scanner_printer"){	
if($host_status=='UP')
{
$service_status=$model_screenstatus->host_obj[$i]->min_service;			
if($service_status==1)				
{
	
$outp .= '"status_button'.$i.'":"yellow"';
	
}
else
{
$outp .= '"status_button'.$i.'":"green"';
}
}
else
{
$outp .= '"status_button'.$i.'":"red"';
}    

}
		} //for loop
	
$outp .= ',"timestamp":"'.$model_screenstatus->time_stamp.'"}';
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

echo $outp;

} //function close
public function view($model_screenstatus)
{


echo '

<script src="view/js/angularjsmin.js"></script>
 

    
      <div class="mainbar" >
        <div class="article" >  
<div id="hpcdiv" ng-app="hpcApp" ng-controller="hpcCtrl">
<center><p><b>Updated on: {{time_stamp}} </b></p></center>
 <p style="text-align:right;"><a href="index.php?hpcpage=statusscreen_new&table=1">Tabular View</a></p>   
    <img id="hpcimg" src="view/statusimg/hpcConnection.jpg" border="0" width="1060"  usemap="#maphpcimg" />
<map name="maphpcimg" id="Idhpcimg">
<area id="HPC400" alt="400 node" title="400 Node Cluster" href="index.php?hpcpage=systemdetails&systemname=Ivy" shape="rect" coords="12,65,147,168" style="outline:none;" target="_self"     />
<area id="hpci34" alt="hpc134" title="134 Node cluster" href="index.php?hpcpage=systemdetails&systemname=Neha" shape="rect" coords="174,59,277,164" style="outline:none;" target="_self"     />
<area id="hpcgpu" alt="hpcgpu" title="HPC GPU cluster" href="hpcgpu" shape="rect" coords="559,53,612,176" style="outline:none;" target="_self"     />
<area id="caelinls" alt="caelinls" title="License server" href="index.php?hpcpage=systemdetails&systemname=Licenses" shape="rect" coords="308,280,500,520" style="outline:none;" target="_self"     />
</map>  
<div>   
';

$host_num=$model_screenstatus->host_no;

 
for($i=0;$i<$host_num;$i++)
{
$host_name=$model_screenstatus->host_obj[$i]->name;
	
$host_status=$model_screenstatus->host_obj[$i]->status;	


if($host_name=="IVY" || $host_name=="HN1" || $host_name=="XEON_SMP1" || $host_name=="XEON_SMP2" || $host_name=="Blade" || $host_name=="GPU" 
|| $host_name=="Tyrone" || $host_name=="QNAP" || $host_name=="HP" || $host_name=="igcardc" || $host_name=="igcardc-BU" 
|| $host_name=="WS-AD-1" || $host_name=="WS-AD-2" || $host_name=="HPCFIRE1" || $host_name=="HPCFIRE2" || $host_name=="CAELINLS" 
|| $host_name=="CAEWINLS" || $host_name=="WINLS3" || $host_name=="WINLSTMP" || $host_name=="GWS-1" || $host_name=="GWS-2" 
|| $host_name=="GWS-3" || $host_name=="GWS-4" || $host_name=="GWS-5" || $host_name=="GWS-6" || $host_name=="GWS-7" 
|| $host_name=="GWS-8" || $host_name=="GWS-9" || $host_name=="GWS-10" || $host_name=="GWS-11" || $host_name=="GWS-12" 
 || $host_name=="GWS-13" || $host_name=="GWS-14" || $host_name=="GWS-15"  ||  $host_name=="GWS-16" || $host_name=="GWS-17" 
 || $host_name=="GWS-18" || $host_name=="GWS-19" || $host_name=="GWS-20" || $host_name=="GWS-21" || $host_name=="GWS-22" 
 || $host_name=="GWS-23" || $host_name=="GWS-24" || $host_name=="GWS-25" || $host_name=="GWS-26" || $host_name=="GWS-27" 
 || $host_name=="GWS-28" || $host_name=="GWS-29"  || $host_name=="GWS-30" || $host_name=="GWS-31" || $host_name=="GWS-32" 
 || $host_name=="PRSER" || $host_name=="hpdesignjet" || $host_name=="CP" || $host_name=="hpofficejet" || $host_name=="HPLSR" 
 || $host_name=="Z6800-plotter" || $host_name=="scanner_printer"){
if($host_status=='UP')
{
$service_status=$model_screenstatus->host_obj[$i]->min_service;			
if($service_status==1)				
{
echo '<img id="button'.$host_name.'" src="view/statusimg/yellowbutton.png" title="'.$host_name.'">';
}
else
{
echo '<img id="button'.$host_name.'" src="view/statusimg/greenbutton.png" title="'.$host_name.'">';
}

}
else
{
echo '<img id="button'.$host_name.'" src="view/statusimg/redbutton.png" title="'.$host_name.'">';
}	
}
}
 
echo "<table width='100%' ><tr><td><img src='view/statusimg/redbutton.png' width='15' height='15'></td><td width='95%'>system is down</td><tr><tr><td><img src='view/statusimg/greenbutton.png' width='15' height='15'></td><td width='95%'>system is up and important services are running</td><tr><tr><td><img src='view/statusimg/yellowbutton.png' width='15px' height='15px'></td><td width='95%' >system is up with minimal services</td><tr></table>";
echo '</div></div>';

echo '<script>
var app = angular.module('."'hpcApp'".', []);
app.controller('."'hpcCtrl'".', function($window,$scope,$http,$interval) {

var d=null;
var img_id="";
var newimg_url="";	


	';
	
echo '$scope.time_stamp="'.$model_screenstatus->time_stamp.'";';
//$host_num=31;
for($i=0;$i<$host_num;$i++)
{
$host_name=$model_screenstatus->host_obj[$i]->name;
$host_status=$model_screenstatus->host_obj[$i]->status;	

if($host_name=="IVY" || $host_name=="nx0" || $host_name=="HN1" || $host_name=="XEON_SMP1" || $host_name=="XEON_SMP2" || $host_name=="snap" || $host_name=="qnap" || $host_name=="igcardc" || $host_name=="HPCFIRE1" || $host_name=="HPCFIRE2" || $host_name=="CAELINLS" || $host_name=="CAEWINLS" || $host_name=="linls-3" || $host_name=="WINLS-TEMP" || $host_name=="hpdesignjet" || $host_name=="CP" || $host_name=="hpcolorlaser" || $host_name=="hpofficejet" || $host_name=="GWS-1" || $host_name=="GWS-2" || $host_name=="GWS-3" || $host_name=="GWS-5" || $host_name=="GWS-6" || $host_name=="GWS-7" || $host_name=="GWS-8" || $host_name=="GWS-10" || $host_name=="GWS-12" || $host_name=="GWS-13" || $host_name=="GWS-14" || $host_name=="GWSD-1" || $host_name=="GWSD-2" || $host_name=="GWSD-3" || $host_name=="GWSD-4")
{
if($host_status=='UP')
{
$service_status=$model_screenstatus->host_obj[$i]->min_service;	

//echo 		$service_status;
if($service_status==1)				
{
echo "var prev_status_button$i='yellow';";

}
else
{
echo "var prev_status_button$i='green';";
}

}
else
{
echo "var prev_status_button$i='red';";
}		
}
}



echo '$interval(function () {
		$http({method:"GET",url:"",params:{hpcpage:'."'statusscreen_new'".',mode:'."'ajax'".'}})
    .then(function(response) 
	{
		var hpc_response=response.data;
	    	
		';
		
for($i=0;$i<$host_num;$i++)
{

$host_name=$model_screenstatus->host_obj[$i]->name;

if($host_name=="IVY" || $host_name=="HN1" || $host_name=="XEON_SMP1" || $host_name=="XEON_SMP2" || $host_name=="Blade" || $host_name=="GPU" 
|| $host_name=="Tyrone" || $host_name=="QNAP" || $host_name=="HP" || $host_name=="igcardc" || $host_name=="igcardc-BU" 
|| $host_name=="WS-AD-1" || $host_name=="WS-AD-2" || $host_name=="HPCFIRE1" || $host_name=="HPCFIRE2" || $host_name=="CAELINLS" 
|| $host_name=="CAEWINLS" || $host_name=="WINLS3" || $host_name=="WINLSTMP" || $host_name=="GWS-1" || $host_name=="GWS-2" 
|| $host_name=="GWS-3" || $host_name=="GWS-4" || $host_name=="GWS-5" || $host_name=="GWS-6" || $host_name=="GWS-7" 
|| $host_name=="GWS-8" || $host_name=="GWS-9" || $host_name=="GWS-10" || $host_name=="GWS-11" || $host_name=="GWS-12" 
 || $host_name=="GWS-13" || $host_name=="GWS-14" || $host_name=="GWS-15"  ||  $host_name=="GWS-16" || $host_name=="GWS-17" 
 || $host_name=="GWS-18" || $host_name=="GWS-19" || $host_name=="GWS-20" || $host_name=="GWS-21" || $host_name=="GWS-22" 
 || $host_name=="GWS-23" || $host_name=="GWS-24" || $host_name=="GWS-25" || $host_name=="GWS-26" || $host_name=="GWS-27" 
 || $host_name=="GWS-28" || $host_name=="GWS-29"  || $host_name=="GWS-30" || $host_name=="GWS-31" || $host_name=="GWS-32" 
 || $host_name=="PRSER" || $host_name=="hpdesignjet" || $host_name=="CP" || $host_name=="hpofficejet" || $host_name=="HPLSR" 
 || $host_name=="Z6800-plotter" || $host_name=="scanner_printer")
{

echo "if(hpc_response.status_button$i!=prev_status_button$i)
{

img_id='button$host_name';


newimg_id='';
newimg_url='';
if(hpc_response.status_button$i=='red')
{
newimg_url='view/statusimg/redbutton.png';
}
if(hpc_response.status_button$i=='green')
{
newimg_url='view/statusimg/greenbutton.png';
}
if(hpc_response.status_button$i=='yellow')
{
newimg_url='view/statusimg/yellowbutton.png';
}

d=document.getElementById(img_id);
d.src=newimg_url;
            			
}

"."prev_status_button$i=hpc_response.status_button$i;
";
}
}
	
echo '$scope.time_stamp=hpc_response.timestamp;';
	
echo "});	
    }, 30000); });

</script>";



echo "

<style>

                #hpcimg   {
                                Position:relative;
                                left:-30px; 
                        }
				#buttonIVY {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-615px ;
                                left:55px;
								border:0; }	
								
				#buttonHN1 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-615px ;
                                left:145px;
								border:0; }
								
				#buttonXEON_SMP1 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-613px ;
                                left:270px;
								border:0; }
								
				#buttonXEON_SMP2 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-648px ;
                                left:250px;
								border:0; }
								
				#buttonBlade {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-613px ;
                                left:332px;
								border:0; }
								
				#buttonGPU {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-613px ;
                                left:447px;
								border:0; }
								
				#buttonTyrone {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-667px ;
                                left:596px;
								border:0; }
				#buttonQNAP {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-635px ;
                                left:574px;
								border:0; }
				#buttonHP {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-600px ;
                                left:553px;
								border:0; }
				#buttonigcardc {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-655px ;
                                left:668px;
								border:0; }
				#buttonigcardc-BU {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-608px ;
                                left:646px;
								border:0; }
				#buttonWS-AD-1 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-649px ;
                                left:746px;
								border:0; }
				#buttonWS-AD-2 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-613px ;
                                left:723px;
								border:0; }
				#buttonHPCFIRE1 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-272px ;
                                left:-137px;
								border:0; }
				#buttonHPCFIRE2 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-219px ;
                                left:-158px;
								border:0; }
				#buttonCAELINLS {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-431px ;
                                left:125px;
								border:0; }
				#buttonCAEWINLS {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-374px ;
                                left:103px;
								border:0; }
				#buttonWINLS3 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-314px ;
                                left:81px;
								border:0; }
				#buttonWINLSTMP {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-257px ;
                                left:60px;
								border:0; }
				#buttonGWS-1 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-466px ;
                                left:149px;
								border:0; }
				#buttonGWS-2 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-437px ;
                                left:130px;
								border:0; }
				#buttonGWS-3 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-412px ;
                                left:109px;
								border:0; }
				#buttonGWS-4 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-382px ;
                                left:86px;
								border:0; }
				#buttonGWS-5 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-352px ;
                                left:64px;
								border:0; }
				#buttonGWS-6 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-322px ;
                                left:42px;
								border:0; }
				#buttonGWS-7 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-294px ;
                                left:20px;
								border:0; }
				#buttonGWS-8 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-266px ;
                                left:0px;
								border:0; }
				#buttonGWS-9 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-235px ;
                                left:-21px;
								border:0; }
				#buttonGWS-10 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-205px ;
                                left:-43px;
								border:0; }
				#buttonGWS-11 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-177px ;
                                left:-64px;
								border:0; }
				#buttonGWS-12 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-149px ;
                                left:-85px;
								border:0; }
				#buttonGWS-13 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-121px ;
                                left:-106px;
								border:0; }
				#buttonGWS-14 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-91px ;
                                left:-126px;
								border:0; }
				#buttonGWS-15 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-61px ;
                                left:-148px;
								border:0; }
				#buttonGWS-16 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-32px ;
                                left:-170px;
								border:0; }
				#buttonGWS-17 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-469px ;
                                left:-79px;
								border:0; }
				#buttonGWS-18 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-439px ;
                                left:-98px;
								border:0; }
				#buttonGWS-19 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-414px ;
                                left:-119px;
								border:0; }
				#buttonGWS-20 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-383px ;
                                left:-141px;
								border:0; }
				#buttonGWS-21 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-353px ;
                                left:-163px;
								border:0; }
				#buttonGWS-22 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-324px ;
                                left:-185px;
								border:0; }
				#buttonGWS-23 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-295px ;
                                left:-205px;
								border:0; }
				#buttonGWS-24 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-266px ;
                                left:-226px;
								border:0; }
				#buttonGWS-25 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-235px ;
                                left:-248px;
								border:0; }
				#buttonGWS-26 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-206px ;
                                left:-270px;
								border:0; }
				#buttonGWS-27 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-177px ;
                                left:-292px;
								border:0; }
				#buttonGWS-28 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-149px ;
                                left:-312px;
								border:0; }
				#buttonGWS-29 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-142px ;
                                left:664px;
								border:0; }
				#buttonGWS-30 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-112px ;
                                left:644px;
								border:0; }
				#buttonGWS-31 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-85px ;
                                left:623px;
								border:0; }
				#buttonGWS-32 {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-56px ;
                                left:602px;
								border:0; }
				#buttonPRSER {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-483px ;
                                left:902px;
								border:0; }
				#buttonHPLSR {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-68px ;
                                left:880px;
								border:0; }
				#buttonhpdesignjet {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-353px ;
                                left:860px;
								border:0; }
				#buttonCP {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-275px ;
                                left:838px;
								border:0; }
				#buttonZ6800-plotter {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-430px ;
                                left:816px;
								border:0; }
				#buttonscanner_printer {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-135px ;
                                left:795px;
								border:0; }
				#buttonhpofficejet {	position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-200px ;
                                left:775px;
								border:0; }
				
								
								
</style>




";
	


}

public function view_table($model_screenstatus)
{


echo "
<script src='view/js/angularjsmin.js'></script>
 
 
 <center>
 <h1>HPC Status</h1>
 <h2><a href='index.php?hpcpage=statusscreen_new'>Click to see HPC layout</a></h2>
 
 <div ng-app='hpcApp' ng-controller='hpcCtrl'> 
 <center><p><b>Updated on: {{time_stamp}}</b></p></center>
 <table>
 <th>Host</th>
 <th>IP</th>
 <th>Status</th>

 <th>Service</th>
 <th>Status</th>";
 
$host_num=$model_screenstatus->host_no;
for($i=0;$i<$host_num;$i++)
{
$host_name=$model_screenstatus->host_obj[$i]->name;
$host_ip=$model_screenstatus->host_obj[$i]->ip;
	
echo '<tr>
                <td>'.$host_name.'</td>
                <td>'.$host_ip.'</td>
                <td><p ng-bind='."'ipstatus$i'".'></p></td>';

$service_num=$model_screenstatus->host_obj[$i]->service_no;			
if($service_num>0)				
{
echo "<td><table>";

for($j=0;$j<$service_num;$j++)
{
$service_name=$model_screenstatus->host_obj[$i]->service[$j]->name;	
echo "<tr><td>$service_name</td></tr>";
}
echo "</table></td>";
echo "<td><table>";

for($j=0;$j<$service_num;$j++)
{
echo '<tr><td><p ng-bind='."'servicestatus$i".'_'."$j'".'></p></td></tr>';
}
echo "</table></td>";
}
else
{
echo "<td>      </td>";
echo "<td>      </td>";
}

echo "</tr>";
}

echo '</table>
 </div>
 </center>';
 
 
 
echo '<script>
var app = angular.module('."'hpcApp'".', []);
app.controller('."'hpcCtrl'".', function($window,$scope,$http,$interval) {';

echo '$scope.time_stamp="'.$model_screenstatus->time_stamp.'";';	


for($i=0;$i<$host_num;$i++)
{
$host_status=$model_screenstatus->host_obj[$i]->status;	
echo '$scope.ipstatus'.$i."='$host_status';";

$service_num=$model_screenstatus->host_obj[$i]->service_no;
for($j=0;$j<$service_num;$j++)
{
$service_status=$model_screenstatus->host_obj[$i]->service[$j]->status;		
echo '$scope.servicestatus'.$i.'_'.$j."='$service_status';"; 
}

}

echo '$interval(function () {
		$http({method:"GET",url:"",params:{hpcpage:'."'statusscreen_new'".',mode:'."'ajax'".',table:1}})
    .then(function(response) 
	{
		var hpc_response=response.data;
		
		';
		

for($i=0;$i<$host_num;$i++)
{
echo '$scope.ipstatus'.$i."=hpc_response.ipstatus$i;";
//echo '$scope.ipstatus'.$i."=hpc_response;";

//echo '$scope.ipstatus'.$i."=hpc_response.host_obj[$i].status;";

$service_num=$model_screenstatus->host_obj[$i]->service_no;
for($j=0;$j<$service_num;$j++)
{		
echo '$scope.servicestatus'.$i.'_'.$j."=hpc_response.servicestatus$i".'_'."$j;"; 
}

}

echo '$scope.time_stamp=hpc_response.timestamp;';	
	
	
echo "});	
    }, 30000); });

</script>";


echo "

<style>
table, th , td {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 5px;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style>
";
	


}

}

?>

 
 
