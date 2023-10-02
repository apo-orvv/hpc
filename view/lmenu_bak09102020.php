<!-- DD menu -->
<link type="text/css" href="view/menu.css" rel="stylesheet" />
    

<body>
<div class="header">
<div class="header_resize">
<div class="logo"><h1> High performance Computing Facilities</h1></div> 


<div id="menu"  >
<ul class="menu" >
<li><a href="index.php"><span style="line-height:1px">Home</span></a></li>


<li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
<div><ul>


<?php if(($usertype=='AI') || ($usertype=='A') || ($usertype=='AS') || ($usertype== 'AD') || ($usertype == 'O')|| ($usertype == 'U') ) { ?>

<li><a href="index.php?hpcpage=statusscreen" class="parent"><span >HPC Status</span></a>
<div><ul>
          <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Ivy"><span>400 Node Cluster</span></a></li>
          <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Neha"><span>134 Node Cluster</span></a></li>
          <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Licenses"><span>Software Licenses</span></a></li>
<?php if(!($usertype=='U')  ) { ?>
		  <li class="last"><a target=_blank href="http://10.20.2.9:1084/ANSYSLMCenter.html?sBuildDate=20170714"><span>Ansys 17 License Manager</span></a></li>
		  <li class="last"><a target=_blank href="http://10.20.2.14:1084/ANSYSLMCenter.html?sBuildDate=20170714"><span>Ansys 18.2 License Manager</span></a></li>
		  <li class="last"><a target=_blank href="http://10.20.2.10:1084/ANSYSLMCenter.html?sBuildDate=20170714"><span>Ansys 19 License Manager</span></a></li>
<?php } ?>
</ul></div></li>
<?php } else {?>
<li><a href="index.php?hpcpage=statusscreen" ><span style="line-height:1px">HPC Status</span></a></li>
<?php } ?>

<?php if(($usertype=='AI') || ($usertype=='A') || ($usertype=='AS') || ($usertype== 'AD') || ($usertype == 'O')) { ?>
<li><a href="#" class="parent"><span >HPC System Details</span></a>
<div><ul>
          <li class="last"><a href="index.php?hpcpage='viewipadd'"><span>IP Address Details</span></a></li>
		  <li class="last"><a href="index.php?hpcpage='viewhardware'"><span>HPC Hardware Details</span></a></li>
          <li class="last"><a href="index.php?hpcpage='viewsoftware'"><span>HPC Software Details</span></a></li>
</ul> </div>
	<?php } ?>	  

<li><a href="#" class="parent"><span >HPC Clusters</span></a>
<div><ul>
          <li class="last"><a href="index.php?hpcresource='hpc400'"><span>400 - Node Cluster</span></a></li>
          <li class="last"><a href="index.php?hpcresource='hpc134'"><span>134 - Node Cluster</span></a></li>
          <li class="last"><a href="index.php?hpcresource='hpc128'" ><span>128 - Node Cluster</span></a> </li>
          <li class="last"><a href="index.php?hpcresource='hpcblade'"><span>Blade Cluster</span></a></li>
         <li class="last"><a href="index.php?hpcresource='hpcgpu'"><span>GPU Cluster</span></a></li>
	     <li class="last"><a href="index.php?hpcresource='hpcbull'"><span>16-Node Bull Nova Cluste</span></a></li>
          </ul> </div>
</li>  
<li><a href="#" class="parent"><span >SMP Servers</span></a>
<div><ul>
	 <li class="last"><a href="index.php?hpcresource='hpcxeonSMP'"><span>Xeon SMP Server</span></a></li>
      </ul> </div>
</li> 
 <li><a href="#" class="parent"><span>Workstations</span></a>
<div><ul>
                <li class="last"><a  href="index.php?hpcresource='fujiwork'"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="index.php?hpcresource='dellwork'"><span>Dell Workstations</span></a></li>
</ul> </div> </li>
<li><a href="#" class="parent"><span >Application Softwares</span></a>
<div><ul>

<li class="last"><a href="index.php?hpcresource=software" ><span>Software List & Invoking Methods</span></a> </li>                    
          </ul> </div>
</li>
<li ><a href="index.php?hpcresource='hpcperi'"><span>Pheriperals</span></a></li>
 </ul>
</div>
</li>     
<li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
         <div><ul>    
         <li><a href="#" class="parent"><span>HPC USER FORMS</span></a>
		<div><ul> 
<li class="last"><a href="index.php?hpcpage=hpcuserreq"><span>User Requistion </span></a></li>
<li class="last"><a href="index.php?hpcpage=hpcuserprt"><span>User Requistion Print</span></a></li>

<?php if(($usertype=='AI') || ($usertype=='A') || ($usertype=='AS') || ($usertype== 'AD')) { ?>
<li class="last"><a href="index.php?hpcpage=userstat"><span>User Requistion Status</span></a></li>
<li class="last"><a href="index.php?hpcpage=allusers"><span>List of LDAP users</span></a></li>
<!--<li class="last"><a href="usercreaappr.php"><span>User Creation Approval</span></a></li>
<li class="last"><a href="usercrea.php"><span>User Creation</span></a></li> --> <?php } ?>
</ul> </div>
          </li> 
          <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
		<div><ul> 
                 
<li class="last"><a href="index.php?hpcpage=printreq"><span>Print Requistion Form</span></a></li>
<li class="last"><a href="index.php?hpcpage=printreqprint"><span>Print  Requistion Print</span></a></li>

<?php if(($usertype=='AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype== 'AD') ||($usertype =='O')) { ?>
<li class="last"><a href="index.php?hpcpage=printstat"><span>Print  Requistion Status</span></a></li>
<li class="last"><a href="index.php?hpcpage=printtake"><span>Download files</span></a></li>

<?php } ?>
</ul> </div>
</li>
<li class="last"><a href="index.php?hpcpage=userfeedback" ><span>Feed Back Form</span></a> </li>
</ul>
</div>
</li>

<li><a href="index.php?hpcpage=vdi" class=""><span style="line-height:1px">VDI</span></a>

</li>





<?php if(($usertype=='A')||($usertype == 'O')|| ($usertype == 'AS') || ($usertype== 'AD') ) { ?>
<li><a href="#" class="parent"><span style="line-height:1px">Roster</span></a>
<div><ul>    
		 <li><a href="index.php?hpcpage=rosterdisplay" class="last"><span>Display Roster </span></a> </li>
		</ul> </div> 
</li>
 <?php } ?>
<?php if($usertype=='AI') { ?>
<li><a href="#" class="parent"><span style="line-height:1px">Roster</span></a>
<div><ul>    
         <li><a href="index.php?hpcpage=rosterpattern" class="last"><span>Generate Roster Pattern</span></a> </li>
		 <li><a href="index.php?hpcpage=rosterdisplay" class="last"><span>Display Roster </span></a> </li>
		 <li><a href="index.php?hpcpage=rosterupdate" class="last"><span>Update Roster </span></a> </li>
		 <li><a href="index.php?hpcpage=leavereport" class="last"><span>Leave Report </span></a> </li>
		 <li><a href="index.php?hpcpage=actionreport" class="last"><span>Action Report </span></a> </li>
		</ul> </div>
</li>
<?php } ?>

<?php if(($usertype=='A')||($usertype == 'O')|| ($usertype == 'AS') || ($usertype== 'AD') ) { ?>
<li><a href="#" class="parent"><span style="line-height:1px">Documents</span></a>
<div><ul>    
     <li><a href="index.php?hpcpage=manualsgen\" class="last"><span>General Documents </span></a> </li>
		 <li><a href="index.php?hpcpage=manuals\" class="last"><span>HPC Related </span></a> </li>
     <li><a href="index.php?hpcpage=manualsvdi\" class="last"><span>VDI Related </span></a> </li> 
     <li><a href="index.php?hpcpage=manualsIR\" class="last"><span>Internal Reports</span></a> </li> 
		</ul> </div> 
</li>
 <?php } ?>

<?php
if($userfullname){
echo "<li><a href='#' class='parent'><span style='line-height:1px'>$userfullname</span></a><div><ul>";

echo "<li class='last'><a href=\"index.php?hpcpage=systemdetails&systemname=Ivy&systemparam=User_Details&username=$username\"><span>My Profile</span></a></li>";
if(($usertype=='A')||($usertype == 'O')||($usertype == 'AI')|| ($usertype == 'AS') || ($usertype== 'AD') ||($usertype == 'U') ){

echo "<li class='last'><a href=\"index.php?hpcpage=manuals\"><span>HPC Manuals</span></a></li>";
}
echo "<li class='last'><a href=\"index.php?hpcpage=logout\"><span>Logout</span></a></li> </ul> </div> </li>";
}
else{

echo "<li><a href=\"index.php?hpcpage=login\" class='last'><span style='line-height:1px'>Login</span></a></li>";
}
?>
</ul>
</div>
</div>
</div>
 <div class="content"  >
    <div class="content_resize" >
      <div class="mainbar" >
        <div class="article" >

