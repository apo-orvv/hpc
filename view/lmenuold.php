<!-- DD menu -->
<link type="text/css" href="menu.css" rel="stylesheet" />
    
<?php
session_start();
//echo $_SESSION['type_session'];
if (isset($_SESSION['user_session']))
{
$lname=$_SESSION['user_session'];
}
if (isset($_SESSION['type_session']))
{
$ltype=$_SESSION['type_session'];
}
//echo $ltype;
//echo "welcome" .$lname;
?>
<body>
<div class="header">
<div class="header_resize">
<div class="logo"><h1> High performance Computing Facilities</h1></div> 
<?php 
if($ltype=='')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen"><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
         <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	     </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
          <li class="last"><a href="workfuji"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="workdell"><span>Dell Workstations</span></a></li>
</ul> </div> </li> </ul>
</div>
</li>   
<li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>HPC USER FORMS</span></a>
		<div><ul> 
<li class="last"><a href="hpcuserreq"><span>User Requistion Form</span></a></li>
<li class="last"><a href="userstat"><span>User Requistion Status</span></a></li>
<li class="last"><a href="hpcuserprt"><span>User Requistion Print</span></a></li>
</ul> </div>
          </li>
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul> 
<li class="last"><a href="printreq"><span>Print Requistion Form</span></a></li>
<li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
<li class="last"><a href="printreqprint"><span>Print  Requistion Print</span></a></li>
</ul> </div>
</li>


</ul>
</div>
</li>

<li><a href="login"><span style="line-height:1px">Login</span></a></li>';

}
if($ltype=='U')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index.php"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen.php"><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400.php"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134.php"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128.php" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade.php"><span>Blade Cluster</span></a></li>
         <li class="last"><a href="hpcgpu.php"><span>GPU Cluster</span></a></li>
	     <li class="last"><a href="hpcbull.php"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP.php"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>

<li class="last"><a href="softwaretable.php" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus.php" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol.php"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert.php"><span>CFD-Expert</span></a></li>
          	  <li class="last"><a href="hypermesh.php"><span>Hypermesh</span></a></li>
         <li class="last"><a href="lsdyna.php"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica.php"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics.php"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd.php"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld.php"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k.php"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi.php"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
<li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>HPC USER FORMS</span></a>
		<div><ul> 
<li class="last"><a href="userstat.php"><span>User Requistion Status</span></a></li>
<li class="last"><a href="usercreaappr.php"><span>User Creation Approval</span></a></li>
<li class="last"><a href="usercrea.php"><span>User Creation</span></a></li>
</ul> </div>
          </li>
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul> 
                 
<li class="last"><a href=""><span>Print Requistion Form</span></a></li>
		 <li class="last"><a href=""><span>Print  Requistion Status</span></a></li>

<li class="last"><a href="printapprove.php"><span>Print Approval</span></a></li>
<li class="last"><a href="printtake.php"><span>Download files</span></a></li>
<li class="last"><a href="printcomplete.php"><span>Print Status update</span></a></li>
<li class="last"><a href="printreport.php"><span>Print Report</span></a></li>
</ul> </div>
 </li>

<li class="last"><a href="hpcfeedback.php" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard.php"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd.php"><span>Change Password</span></a></li> 
<li class="last"><a href="logout.php"><span>Logout</span></a></li> </ul> </div> </li>';
}
if($ltype=='A')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen"><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
          <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	      <li class="last"><a href="hpcbull"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>

<li class="last"><a href="softwaretable" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert"><span>CFD-Expert</span></a></li>
          	  <li class="last"><a href="hypermesh"><span>Hypermesh</span></a></li>
         <li class="last"><a href="lsdyna"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
<li><a href="#" class="parent"><span style="line-height:1px">HPC Admin</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>User Account Management</span></a>
		<div><ul> 
<li class="last"><a href="userappr"><span>New Requests</span></a></li>
<li class="last"><a href="userstat"><span>Account Requisition Status</span></a></li>
<li class="last"><a href="ldapuser"><span>All Users</span></a></li>
<li class="last"><a href="hpcadmin"><span>Manage Account</span></a></li>

</ul> </div>
          </li>

         <li><a href="#" class="parent"><span>SGE usage Report</span></a>
		<div><ul> 
<li class="last"><a href="sgexeon"><span>128 node Cluster</span></a></li>
<li class="last"><a href="ugraph134"><span>134 node cluster</span></a></li>
<li class="last"><a href="ugraph400"><span>400 node cluster</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span>Application S/W usage Report</span></a>
		<div><ul> 
<li class="last"><a href="abaqus-log"><span>Abaqus Utilization Report</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld Utilization Report</span></a></li>
<li class="last"><a href="ansys"><span>Ansys Utilization Report</span></a></li>
</ul> </div> </li>

</ul> </div> </li>
 <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul>             

		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>



</ul> </div>
</li>
<li class="last"><a href="hpcfeedback" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd"><span>Change Password</span></a></li> 
<li class="last"><a href="logout"><span>Logout</span></a></li> </ul> </div> </li>';
}


if($ltype=='AI')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen."><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
          <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	      <li class="last"><a href="hpcbull"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>
<li class="last"><a href="softwaretable" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert"><span>CFD-Expert</span></a></li>
          	        <li class="last"><a href="hypermesh"><span>Hypermesh</span></a></li>
                    <li class="last"><a href="lsdyna"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>    
<li><a href="#" class="parent"><span style="line-height:1px">Shift Management</span></a>
         <div><ul>    
         
<li class="last"><a href="roster"><span>Roster</span></a></li>
<li class="last"><a href="updateroster"><span>Update Roster</span></a></li>
<li class="last"><a href="leave_report"><span>Leave Report</span></a></li>
<li class="last"><a href="action_report"><span>Action Report</span></a></li>
</ul> </div> </li>
 
<li><a href="#" class="parent"><span style="line-height:1px">HPC Admin</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>SGE usage Report</span></a>
		<div><ul> 
<li class="last"><a href="sgexeon"><span>128 node Cluster</span></a></li>
<li class="last"><a href="ugraph134"><span>134 node cluster</span></a></li>
<li class="last"><a href="ugraph400"><span>400 node cluster</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span>Application S/W usage Report</span></a>
		<div><ul> 
<li class="last"><a href="abaqus-log"><span>Abaqus Utilization Report</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld Utilization Report</span></a></li>
<li class="last"><a href="ansys"><span>Ansys Utilization Report</span></a></li>
</ul> </div> </li>
</ul> </div> </li>


 <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul>    
		 <li class="last"><a href="printforward"><span>Approve Print Requests</span></a></li>         
		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
</ul> </div>
</li>
<li class="last"><a href="hpcfeedback" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>
';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd"><span>Change Password</span></a></li> 
<li class="last"><a href="logout"><span>Logout</span></a></li> </ul> </div> </li>';
}





if($ltype=='AD')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen."><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
          <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	      <li class="last"><a href="hpcbull"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>
<li class="last"><a href="softwaretable" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert"><span>CFD-Expert</span></a></li>
          	        <li class="last"><a href="hypermesh"><span>Hypermesh</span></a></li>
                    <li class="last"><a href="lsdyna"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
<li><a href="#" class="parent"><span style="line-height:1px">HPC Admin</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>User Account Management</span></a>
		<div><ul> 
<li class="last"><a href="userforward"><span>New Requests</span></a></li>
<li class="last"><a href="userstat"><span>Account Requisition Status</span></a></li>
<li class="last"><a href="ldapuser"><span>All Users</span></a></li>
<li class="last"><a href="hpcadmin"><span>Manage Account</span></a></li>

</ul> </div>
          </li>
         <li><a href="#" class="parent"><span>SGE usage Report</span></a>
		<div><ul> 
<li class="last"><a href="sgexeon"><span>128 node Cluster</span></a></li>
<li class="last"><a href="ugraph134"><span>134 node cluster</span></a></li>
<li class="last"><a href="ugraph400"><span>400 node cluster</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span>Application S/W usage Report</span></a>
		<div><ul> 
<li class="last"><a href="abaqus-log"><span>Abaqus Utilization Report</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld Utilization Report</span></a></li>
<li class="last"><a href="ansys"><span>Ansys Utilization Report</span></a></li>
</ul> </div> </li>
</ul> </div> </li>
 <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
                   <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul>             

		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
</ul> </div>
</li>
<li class="last"><a href="hpcfeedback" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>
';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd"><span>Change Password</span></a></li> 
<li class="last"><a href="logout"><span>Logout</span></a></li> </ul> </div> </li>';
}



if($ltype=='AS')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen."><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
          <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	      <li class="last"><a href="hpcbull"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>
<li class="last"><a href="softwaretable" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert"><span>CFD-Expert</span></a></li>
          	        <li class="last"><a href="hypermesh"><span>Hypermesh</span></a></li>
                    <li class="last"><a href="lsdyna"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
<li><a href="#" class="parent"><span style="line-height:1px">HPC Admin</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>User Account Management</span></a>
		<div><ul> 
<li class="last"><a href="userprocess"><span>New Requests</span></a></li>
<li class="last"><a href="userstat"><span>Account Requisition Status</span></a></li>
<li class="last"><a href="ldapuser"><span>All Users</span></a></li>
<li class="last"><a href="hpcadmin"><span>Manage Account</span></a></li>

</ul> </div>
          </li>
         <li><a href="#" class="parent"><span>SGE usage Report</span></a>
		<div><ul> 
<li class="last"><a href="sgexeon"><span>128 node Cluster</span></a></li>
<li class="last"><a href="ugraph134"><span>134 node cluster</span></a></li>
<li class="last"><a href="ugraph400"><span>400 node cluster</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span>Application S/W usage Report</span></a>
		<div><ul> 
<li class="last"><a href="abaqus-log"><span>Abaqus Utilization Report</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld Utilization Report</span></a></li>
<li class="last"><a href="ansys"><span>Ansys Utilization Report</span></a></li>
</ul> </div> </li>
</ul> </div> </li>
 <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul>             

		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
</ul> </div>
</li>
<li class="last"><a href="hpcfeedback" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd"><span>Change Password</span></a></li> 
<li class="last"><a href="logout"><span>Logout</span></a></li> </ul> </div> </li>';
}
if($ltype=='O')
{
echo'
<div id="menu"  >
<ul class="menu" >
<li><a href="index"><span style="line-height:1px">Home</span></a></li>
<li><a href="statuscreen."><span style="line-height:1px">HPC Status</span></a></li>
<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>
<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="hpc400"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc134"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="hpc128" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="hpcblade"><span>Blade Cluster</span></a></li>
          <li class="last"><a href="hpcgpu"><span>GPU Cluster</span></a></li>
	      <li class="last"><a href="hpcbull"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="hpcxeonSMP"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a href="#"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="#"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>
<li class="last"><a href="softwaretable" ><span>Software List</span></a> </li>                    
<li class="last"><a href="abaqus" ><span>Abaqus</span></a> </li>
                    <li class="last"><a href="comsol"><span>Comsol</span></a></li>
                    <li class="last"><a href="cfdexpert"><span>CFD-Expert</span></a></li>
          	        <li class="last"><a href="hypermesh"><span>Hypermesh</span></a></li>
                    <li class="last"><a href="lsdyna"><span>LS-Dyna</span></a></li>
	 <li class="last"><a href="mathmatica"><span>Mathmatica</span></a></li>
         <li class="last"><a href="phoenics"><span>Phoenics</span></a></li>
<li class="last"><a href="starcd"><span>Star-CD</span></a></li>
<li class="last"><a href="sysweld"><span>Sysweld</span></a></li>
<li class="last"><a href="wien2k"><span>Wien-2K</span></a></li>
          </ul> </div>
</li>
<li ><a href="hpcperi"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
 <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>HPC USER FORMS</span></a>
		<div><ul> 
<li class="last"><a href="userstat"><span>User Requistion Status</span></a></li>
</ul> </div>
          </li>
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		  <div><ul>             
		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
<li class="last"><a href="printtake"><span>Download files</span></a></li>
<li class="last"><a href="printcomplete"><span>Print Status update</span></a></li>
		 
</ul> </div>
</li>

</ul>
</div>
</li>

<li><a href="#" class="parent"><span style="line-height:1px">HPC Activities</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>IP Address</span></a>
		<div><ul> 
<li class="last"><a href="addip"><span>Add IP Address</span></a></li>
<li class="last"><a href="printip"><span>Print IP address</span></a></li>
</ul> </div>
          </li>
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		  <div><ul>             
		 <li class="last"><a href="printstat"><span>Print  Requistion Status</span></a></li>
<li class="last"><a href="printtake"><span>Download files</span></a></li>
<li class="last"><a href="printcomplete"><span>Print Status update</span></a></li>
		 
</ul> </div>
</li>

</ul>
</div>
</li>


';

echo '<li> <a href="#" class="parent"> <span style="line-height:1px">' .$lname;
echo '</span></a> <div><ul> <li class="last"><a href="dashboard"><span>Dashboard</span></a></li>
<li class="last"><a href="chpasswd"><span>Change Password</span></a></li> 
<li class="last"><a href="logout"><span>Logout</span></a></li> </ul> </div> </li>';
}


?>
</ul>
</div>
</div>
</div>

<!-- <div class="content" style="background-color:#00FF00">  //removed on 26-04-2016--> 
 <div class="content"  > 
    <div class="content_resize" >
      <div class="mainbar" >
        <div class="article" >     
