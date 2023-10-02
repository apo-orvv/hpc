<?php
// Defining a default value 
$usertype = '';
$userfullname = '';
$username = '';
// Check if a condition exists to set a different value
if (isset($_GET['usertype'])) {
  $usertype = $_GET['usertype'];
}
if (isset($_GET['userfullname'])) {
  $usertype = $_GET['userfullname'];
}
if (isset($_GET['username'])) {
  $usertype = $_GET['username'];
}
?>

<!-- DD menu -->
<link type="text/css" href="view/menu.css" rel="stylesheet" />


<body>
  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1> High performance Computing Facilities</h1>
      </div>


      <div id="menu">
        <ul class="menu">
          <li><a href="index.php"><span style="line-height:1px">Home</span></a></li>


          <li><a href="#" class="parent"><span style="line-height:1px">HPC Services</span></a>
            <div>
              <ul>


                <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'O') || ($usertype == 'U')) { ?>

                  <li><a href="index.php?hpcpage=statusscreen_new" class="parent"><span>HPC Server Status</span></a>
                    <div>
                      <ul>
                        <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Ivy"><span>400 Node Cluster</span></a></li>
                        <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Neha"><span>134 Node Cluster</span></a></li>
                        <!-- <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=GWS"><span>Graphics Workstations </span></a></li> -->

                      </ul>
                    </div>
                  </li>
                <?php } else { ?>

                  <li><a href="index.php?hpcpage=statusscreen_new"><span style="line-height:1px">HPC Server Status</span></a></li>
                <?php } ?>



                <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'O')) { ?>

                  <li><a href="#" class="parent"><span>Software License Details</span></a>
                    <div>
                      <ul>
                        <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=Licenses"><span>Software License Status</span></a></li>


                        <li class="last"><a href="index.php?hpcresource='ansys_weblink'"><span style="color:#99ccff;">Ansys WebLinks</span></a></li>


                      </ul>
                    </div>
                  </li>
                <?php } elseif ($usertype == 'U') { ?>
                  <li><a href="index.php?hpcpage=systemdetails&systemname=Licenses"><span style="line-height:1px">Software License Status</span></a></li>

                <?php } ?>


                <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'O')) { ?>
                  <li><a href="#" class="parent"><span style="color:#99ccff;">HPC System Details</span></a>
                    <div>
                      <ul>
                        <li class="last"><a href="index.php?hpcpage='viewipadd'"><span style="color:#99ccff;">IP Address Details</span></a></li>
                        <li class="last"><a href="index.php?hpcpage='viewhardware'"><span style="color:#99ccff;">HPC Hardware Details</span></a></li>
                        <li class="last"><a href="index.php?hpcpage='viewsoftware'"><span style="color:#99ccff;">HPC Software Details</span></a></li>
                        <li class="last"><a href="index.php?hpcpage='viewclusNodestat'"><span style="color:#99ccff;">HPC Old Cluster Node Status</span></a></li>
                      </ul>
                    </div>
                  <?php } ?>

                  <li><a href="#" class="parent"><span>HPC Clusters</span></a>
                    <div>
                      <ul>
                        <li class="last"><a href="index.php?hpcresource='hpc400'"><span>400 - Node Cluster</span></a></li>
                        <li class="last"><a href="index.php?hpcresource='hpc134'"><span>134 - Node Cluster</span></a></li>
                        <!--<li class="last"><a href="index.php?hpcresource='hpc128'" ><span>128 - Node Cluster</span></a> </li> 
          <li class="last"><a href="index.php?hpcresource='hpcblade'"><span>Blade Cluster</span></a></li> -->
                        <li class="last"><a href="index.php?hpcresource='hpcgpu'"><span>GPU Cluster</span></a></li>
                        <!-- <li class="last"><a href="index.php?hpcresource='hpcbull'"><span>16-Node Bull Nova Cluste</span></a></li> -->
                      </ul>
                    </div>
                  </li>


                  <li><a href="#" class="parent"><span>Workstations</span></a>
                    <div>
                      <ul>
                        <li class="last"> <a href="WS\Workstation User Policy.pdf" target="_blank"> <span>Workstation Policy</span></a> </li>
                        <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'O') || ($usertype == 'U') || ($usertype == 'CA')) { ?>
                          <li class="last"><a href="index.php?hpcresource='dellwork'"><span>Workstation Specification</span></a></li>
                          <li class="last"><a href="index.php?hpcpage=systemdetails&systemname=GWS"><span>Workstation Usage Details </span></a></li>
                          <li class="last"><a href="index.php?hpcpage='viewhighws'"><span style="color:#99ccff;">Workstation Assignment Details</span></a></li>
                        <?php } ?>
                      </ul>
                    </div>
                  </li>


                  <!--<li><a href="#" class="parent"><span >SMP Servers</span></a>
 <div><ul>
	 <li class="last"><a href="index.php?hpcresource='hpcxeonSMP'"><span>Xeon SMP Server</span></a></li>
      </ul> </div> 
</li> 
 <li><a href="#" class="parent"><a href="index.php?hpcresource='dellwork'"><span>Workstations</span></a>
<!--<div><ul>
                <li class="last"><a  href="index.php?hpcresource='fujiwork'"><span>Fujitsu Workstations</span></a></li>
		 <li class="last"><a href="index.php?hpcresource='dellwork'"><span>Dell Workstations</span></a></li>
</ul> </div> </li>-->
                  <li><a href="#" class="parent"><span>Application Softwares</span></a>
                    <div>
                      <ul>

                        <li class="last"><a href="index.php?hpcresource=software"><span>Software List & Invoking Methods</span></a> </li>
                      </ul>
                    </div>
                  </li>

                  <?php if (($usertype == 'A') || ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'AI')) { ?>
                    <li><a href="#" class="parent"><span style="color:#99ccff;">Documents</span></a>
                      <div>
                        <ul>
                          <li><a href="index.php?hpcpage=manualsgen\" class="last"><span style="color:#99ccff;">General Documents </span></a> </li>
                          <li><a href="index.php?hpcpage=manuals\" class="last"><span style="color:#99ccff;">HPC Related </span></a> </li>
                          <li><a href="index.php?hpcpage=manualsvdi\" class="last"><span style="color:#99ccff;">VDI Related </span></a> </li>
                          <li><a href="index.php?hpcpage=manualsIR\" class="last"><span style="color:#99ccff;">Internal Reports</span></a> </li>
                        </ul>
                      </div>
                    </li>
                  <?php } ?>




                  <!-- <li ><a href="index.php?hpcresource='hpcperi'"><span>Pheriperals</span></a></li> -->
              </ul>
            </div>
          </li>
          <li><a href="#" class="parent"><span style="line-height:1px">Forms</span></a>
            <div>
              <ul>
                <li><a href="#" class="parent"><span>HPC USER FORMS</span></a>
                  <div>
                    <ul>
                      <li class="last"><a href="index.php?hpcpage=hpcuserreq"><span>User Requistion </span></a></li>
                      <li class="last"><a href="index.php?hpcpage=hpcuserprt"><span>User Requistion Print</span></a></li>

                      <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD')) { ?>
                        <li class="last"><a href="index.php?hpcpage=userstat"><span style="color:#99ccff;">User Requistion Status</span></a></li>
                        <li class="last"><a href="index.php?hpcpage=allusers"><span style="color:#99ccff;">List of LDAP users</span></a></li>
                        <!--<li class="last"><a href="usercreaappr.php"><span>User Creation Approval</span></a></li>
<li class="last"><a href="usercrea.php"><span>User Creation</span></a></li> --> <?php } ?>
                    </ul>
                  </div>
                </li>
                <li><a href="#" class="parent"><span>Print Requisition Forms</span></a>
                  <div>
                    <ul>

                      <li class="last"><a href="index.php?hpcpage=printreq"><span>Print Requistion Form</span></a></li>
                      <li class="last"><a href="index.php?hpcpage=printreqprint"><span>Print Requistion Print</span></a></li>

                      <?php if (($usertype == 'AI') || ($usertype == 'A') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'O')) { ?>
                        <li class="last"><a href="index.php?hpcpage=printstat"><span style="color:#99ccff;">Print Requistion Status</span></a></li>
                        <li class="last"><a href="index.php?hpcpage=printtake"><span style="color:#99ccff;">Download files</span></a></li>

                      <?php } ?>
                    </ul>
                  </div>
                </li>
                <li class="last"><a href="index.php?hpcpage=userfeedback"><span>Feed Back Form</span></a> </li>
              </ul>
            </div>
          </li>

          <?php if (($usertype == 'A') || ($usertype == 'O') || ($usertype == 'AD')) { ?>
            <li><a href="#" class="parent"><span style="line-height:1px">Roster</span></a>
              <div>
                <ul>
                  <li><a href="index.php?hpcpage=rosterdisplay" class="last"><span style="color:#99ccff;">Display Roster </span></a> </li>
                  <!--<li><a href="index.php?hpcpage=change_crew_members" class="last"><span style="color:#99ccff;">View / Edit Crew Details</span></a> </li> -->
                </ul>
              </div>
            </li>
          <?php } ?>
          <?php if ($usertype == 'AI') { ?>
            <li><a href="#" class="parent"><span style="line-height:1px">Roster</span></a>
              <div>
                <ul>
                  <li><a href="index.php?hpcpage=rosterpattern" class="last"><span style="color:#99ccff;">Generate Roster Pattern</span></a> </li>
                  <li><a href="index.php?hpcpage=rosterdisplay" class="last"><span style="color:#99ccff;">Display Roster </span></a> </li>
                  <li><a href="index.php?hpcpage=rosterupdate" class="last"><span style="color:#99ccff;">Update Roster </span></a> </li>
                  <li><a href="index.php?hpcpage=change_crew_members" class="last"><span style="color:#99ccff;">View / Edit Crew Details</span></a> </li>
                  <li><a href="index.php?hpcpage=change_report" class="last"><span style="color:#99ccff;">Change Report </span></a> </li>
                  <li><a href="index.php?hpcpage=over_time_report" class="last"><span style="color:#99ccff;">Over Time Report </span></a> </li>
                  <li><a href="index.php?hpcpage=leavereport" class="last"><span style="color:#99ccff;">Leave Report </span></a> </li>
                  <li><a href="index.php?hpcpage=actionreport" class="last"><span style="color:#99ccff;">Action Report </span></a> </li>

                </ul>
              </div>
            </li>
          <?php } ?>

          <?php if ($usertype == 'AS') { ?>
            <li><a href="#" class="parent"><span style="line-height:1px">Roster</span></a>
              <div>
                <ul>

                  <li><a href="index.php?hpcpage=rosterdisplay" class="last"><span style="color:#99ccff;">Display Roster </span></a> </li>
                  <li><a href="index.php?hpcpage=rosterupdate" class="last"><span style="color:#99ccff;">Update Roster </span></a> </li>
                  <li><a href="index.php?hpcpage=change_crew_members" class="last"><span style="color:#99ccff;">Crew Details</span></a> </li>

                </ul>
              </div>
            </li>
          <?php } ?>




          <li><a href="index.php?hpcpage=vdi" class=""><span style="line-height:1px">VDI</span></a></li>

          <!-- Added LogParser option 
          <li><a href="index.php?hpcpage=logparserA"><span style="line-height:1px">ABAQUSLM Log Parser</span></a></li>
          <li><a href="index.php?hpcpage=logparserC"><span style="line-height:1px">COMSOL Log Parser</span></a></li> -->
          <li><a href="#" class="parent"><span style="line-height:1px">Log Parsers</span></a>
            <div>
              <ul>
                <!-- <li><a href="index.php?hpcpage=logparserA"><span style="line-height:1px">ABAQUS</span></a></li> -->
                <li><a href="#" class="parent"><span>ABAQUS</span></a>
                  <div>
                    <ul>
                      <li class="last"><a href="index.php?hpcpage=logparserA"><span>Insert New Data</span></a></li>
                      <li class="last"><a href="index.php?hpcpage=viewlpA"><span>View Analysis</span></a></li>
                    </ul>
                  </div>
                </li>
                
                <!-- <li><a href="index.php?hpcpage=logparserC"><span style="line-height:1px">COMSOL</span></a></li> -->
                <li><a href="#" class="parent"><span>COMSOL</span></a>
                  <div>
                    <ul>
                      <li class="last"><a href="index.php?hpcpage=logparserC"><span>Insert New Data</span></a></li>
                      <li class="last"><a href="index.php?hpcpage=viewlpC"><span>View Analysis</span></a></li>
                    </ul>
                  </div>
                </li>
                
                <!-- <li><a href="index.php?hpcpage=lpANSYS"><span style="line-height:1px">ANSYS</span></a></li> -->
                <li><a href="#" class="parent"><span>ANSYS</span></a>
                  <div>
                    <ul>
                      <li class="last"><a href="index.php?hpcpage=lpANSYS"><span>Insert New Data</span></a></li>
                      <li class="last"><a href="index.php?hpcpage=viewlpANSYS"><span>View Analysis</span></a></li>
                    </ul>
                  </div>
                </li>
                
              </ul>
            </div>
          </li>

          <!-- Added licenseHistory option -->
          <li><a href="#" class="parent"><span style="line-height:1px">License History</span></a>
            <div>
              <ul>
                <li><a href="#" class="parent"><span>View Activity</span></a>
                  <div>
                    <ul>
                      <li class="last"><a href="activeUsers.php"><span>User</span></a></li>
                      <li class="last"><a href="activeFeatures.php"><span>Feature</span></a></li>
                    </ul>
                  </div>
                </li>
                <li class="last"><a href="usageSoftware.php"><span>Software Interaction Timeline</span></a></li>
                <li class="last"><a href="featureDuration.php"><span>Day-to-Day Capability Analysis</span></a></li>
              </ul>
            </div>
          </li>

          <li><a href="index.php?hpcpage=gws" class='last'><span style='line-height:1px'>Workstation</span></a></li>

          <!-- new menu has been added for cloud servers on 12/09/2022-->
          <?php if (($usertype == 'A') || ($usertype == 'AI') || ($usertype == 'O') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'CA')) { ?>
            <li><a href="index.php?hpcpage=cloud_allotment" class=""><span style="line-height:1px;">Cloud</span></a>
            </li>
          <?php } ?>


          <?php
          if ($userfullname) {
            echo "<li><a href='#' class='parent'><span style='line-height:1px'>$userfullname</span></a><div><ul>";

            echo "<li class='last'><a href=\"index.php?hpcpage=systemdetails&systemname=Ivy&systemparam=User_Details&username=$username\"><span>My Profile</span></a></li>";
            if (($usertype == 'A') || ($usertype == 'O') || ($usertype == 'AI') || ($usertype == 'AS') || ($usertype == 'AD') || ($usertype == 'U')) {

              echo "<li class='last'><a href=\"index.php?hpcpage=manuals\"><span>HPC Manuals</span></a></li>";
            }
            echo "<li class='last'><a href=\"index.php?hpcpage=logout\"><span>Logout</span></a></li> </ul> </div> </li>";
          } else {

            echo "<li><a href=\"index.php?hpcpage=login\" class='last'><span style='line-height:1px'>Login</span></a></li>";
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">