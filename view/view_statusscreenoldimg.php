<?php 

require_once('controller/controller_statusscreen.php');
require_once("model/model_statusscreen.php");
require_once("view/view_statusscreen.php");

class View_statusscreen
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
$outp .= "}";
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
        for($i=0;$i<$host_num;$i++){
			$host_name=$model_screenstatus->host_obj[$i]->name;
			if ($outp == "") {$outp .= "{";}
			
    	if ($outp != "{") {$outp .= ",";}
		$host_status=$model_screenstatus->host_obj[$i]->status;
		
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
	
	
$outp .= "}";
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

echo $outp;

}


public function view($model_screenstatus)
{


echo '

<script src="view/js/angularjsmin.js"></script>
 
<div class="content"  > 
    <div class="content_resize" >
      <div class="mainbar" >
        <div class="article" >  
<div id="hpcdiv" ng-app="hpcApp" ng-controller="hpcCtrl">
 <p style="text-align:right;"><a href="index.php?hpcpage=statusscreen&table=1">Tabular View</a></p>   
    <img id="hpcimg" src="view/statusimg/HPCpic.jpg" border="0" width="1060"  usemap="#maphpcimg" />
<map name="maphpcimg" id="Idhpcimg">
<area id="HPC400" alt="400 node" title="400 Node Cluster" href="index.php?hpcpage=systemdetails&systemname=Ivy" shape="rect" coords="12,65,147,168" style="outline:none;" target="_self"     />

<area id="hpci34" alt="hpc134" title="134 Node cluster" href="index.php?hpcpage=systemdetails&systemname=Neha" shape="rect" coords="174,59,277,164" style="outline:none;" target="_self"     />

<area id="hpc128" alt="hpc128" title="128 Node Cluster" href="hpc128" shape="rect" coords="308,58,426,173" style="outline:none;" target="_self"     />
<area id="smp" alt="smp" title="SMP server" href="hpcxeonSMP" shape="rect" coords="435,42,553,176" style="outline:none;" target="_self"     />
<area id="hpcblade" alt="hpcblade" title="HPC Blade cluster" href="hpcblade" shape="rect" coords="559,53,612,176" style="outline:none;" target="_self"     />
<area id="hpcgpu" alt="hpcgpu" title="GPU cluster" href="hpcgpu" shape="rect" coords="654,53,705,176" style="outline:none;" target="_self"     />
<area id="nas" alt="nas" title="HPC NAS server" href="#" shape="rect" coords="739,46,860,163" style="outline:none;" target="_self"     />
<area id="ldap" alt="ldap" title="LDAP server" href="#" shape="rect" coords="891,103,1015,184" style="outline:none;" target="_self"     />
<area id="caelinls" alt="caelinls" title="License server" href="index.php?hpcpage=systemdetails&systemname=Licenses" shape="rect" coords="308,280,500,520" style="outline:none;" target="_self"     />
</map>  
<div>   
';

$host_num=$model_screenstatus->host_no;
for($i=0;$i<$host_num;$i++)
{
$host_name=$model_screenstatus->host_obj[$i]->name;
	
$host_status=$model_screenstatus->host_obj[$i]->status;	

if($host_status=='UP')
{
$service_status=$model_screenstatus->host_obj[$i]->min_service;			
if($service_status==1)				
{
echo '<img id="button'.$host_name.'" src="view/statusimg/yellowbutton.png">';
}
else
{
echo '<img id="button'.$host_name.'" src="view/statusimg/greenbutton.png">';
}

}
else
{
echo '<img id="button'.$host_name.'" src="view/statusimg/redbutton.png">';
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
//$host_num=31;
for($i=0;$i<$host_num;$i++)
{
$host_name=$model_screenstatus->host_obj[$i]->name;
$host_status=$model_screenstatus->host_obj[$i]->status;	

if($host_status=='UP')
{
$service_status=$model_screenstatus->host_obj[$i]->min_service;			
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



echo '$interval(function () {
		$http({method:"GET",url:"",params:{hpcpage:'."'statusscreen'".',mode:'."'ajax'".'}})
    .then(function(response) 
	{
		var hpc_response=response.data;
	    	
		';
		
for($i=0;$i<$host_num;$i++)
{

$host_name=$model_screenstatus->host_obj[$i]->name;

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
	
	
echo "});	
    }, 5000); });

</script>";



echo "

<style>

                #hpcimg   {
                                Position:relative;
                                left:-10px; 
                        }

	
        #buttonnx0{       position: relative;
                                width: 1.5%;
                                height: 3%;
                                top: -580px;
                                left: 360px;
                                border:0;
}
	
	
        #buttonHN1{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-580px ;
                                left:190px;border:0;}

        #buttonXEON_SMP1{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-645px;
                                left:430px;border:0;}
        #buttonXEON_SMP2{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-610px ;
                                left:407px;border:0;}
        #buttonPVElite{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-100px;
                                left:375px;border:0;}
    #buttonGWS-1{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-300px ;
                                left:600px;border:0;}
        #buttonGWS-2{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-270px ;
                                left:577px;border:0;}
        #buttonGWS-3{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-240px ;
                                left:555px;border:0;}
        #buttonGWS-5{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-180px ;
                                left:533px;border:0;}
        #buttonGWS-6{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-150px ;
                                left:511px;border:0;}
        #buttonGWS-7{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-120px ;
                                left:489px;border:0;}
        #buttonGWS-8{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-90px;
                                left:467px;border:0;}
        #buttonGWS-10{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-545px ;
                                left:220px;border:0;}
        #buttonGWSD-1{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-410px;
                                left:449px;border:0;}
        #buttonGWSD-2{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-380px ;
                                left:427px;border:0;}
        #buttonGWSD-3{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-353px ;
                                left:405px;border:0;}
        #buttonGWSD-4{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-325px ;
                                left:383px;border:0;}
        #buttonPRSER{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-380px ;
                                left:640px;border:0;}
        #buttonHPLSR{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-180px;
                                left:617px;border:0;}
        #buttonLIPI3{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-110px;
                                left:595px;border:0;}
        #buttonns0{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-545px ;
                                left:220px;border:0;}

        #buttonHPCFIRE1{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-230px ;
                                left:-250px;border:0;}
        #buttonHPCFIRE2{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-175px ;
                                left:-271px;border:0;}
        #buttonHPCFIRE3{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-545px ;
                                left:220px;border:0;}
        #buttonGRIDFIRE{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-545px ;
                                left:220px;border:0;}
        #buttonCAELINLS{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-380px ;
                                left:5px;border:0;}
        #buttonCAEWINLS{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-325px ;
                                left:-17px;border:0;}
        #buttonlinls-3{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-270px ;
                                left:-40px;border:0;}
        #buttonWINLS{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-210px;
                                left:-63px;border:0;}
        #buttonCAELS{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-160px;
                                left:-83px;border:0;}
        #buttonCP{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-245px ;
                                left:423px;border:0;}
        #buttonsnap{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-636px ;
                                left:300px;border:0;}
        #buttonqnap{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-590px ;
                                left:277px;border:0;}
        #buttonigcardc{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-636px ;
                                left:390px;border:0;}
        #buttonIVY{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-580px ;
                                left:-560px;border:0;}
        #buttonGWS-4{ position: relative;
                                width: 1.5%;
                                height: 3%;
                                top:-213px ;
                                left:32px;border:0;}
 
</style>




";
	


}

public function view_table($model_screenstatus)
{


echo "
<script src='view/js/angularjsmin.js'></script>
 
 
 <center>
 <h1>HPC Status</h1>
 <h2><a href='index.php?hpcpage=statusscreen'>Click to see HPC layout</a></h2>
 
 <div ng-app='hpcApp' ng-controller='hpcCtrl'> 
 
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
		$http({method:"GET",url:"",params:{hpcpage:'."'statusscreen'".',mode:'."'ajax'".',table:1}})
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
	
	
echo "});	
    }, 5000); });

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

 
 
