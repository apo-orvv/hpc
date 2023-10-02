<html>
    <head>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 9px;
	font-style: italic;
}
-->
</style>
<script>
function retrieveUser(str) {//loadXMLDoc() {
    var unit = document.getElementById("unit").value;
    var servers = '';
    document.getElementById("loginname").readOnly=false;
    document.getElementById("ipaddr").readOnly=false;
    document.getElementById("tnam").readOnly=false;
    document.getElementById("des").readOnly=false;
    document.getElementById("grp").readOnly=false;
    document.getElementById("subgrp").readOnly=false;
    document.getElementById("div").readOnly=false;
    document.getElementById("sec").readOnly=false;
    //document.getElementById("phone").readOnly=false;
    //document.getElementById("email").readOnly=false;
    document.getElementsByClassName("ivyapps")[0].disabled=false;
    document.getElementsByClassName("ivyapps")[1].disabled=false;
    document.getElementsByClassName("ivyapps")[2].disabled=false;
    document.getElementsByClassName("ivyapps")[3].disabled=false;
    document.getElementsByClassName("ivyapps")[4].disabled=false;
    document.getElementsByClassName("ivyapps")[5].disabled=false;
    document.getElementsByClassName("nehaapps")[0].disabled=false;
    document.getElementsByClassName("nehaapps")[1].disabled=false;
    document.getElementsByClassName("nehaapps")[2].disabled=false;
    document.getElementsByClassName("nehaapps")[3].disabled=false;
    document.getElementsByClassName("nehaapps")[4].disabled=false;
    document.getElementsByClassName("xeonsmpapps")[0].disabled=false;
    document.getElementsByClassName("xeonsmpapps")[1].disabled=false;
    //document.getElementById("ivyansys").disabled=false;
    document.getElementsByClassName("wsapps")[0].disabled=false;
    document.getElementsByClassName("wsapps")[1].disabled=false;
    document.getElementsByClassName("wsapps")[2].disabled=false;
    document.getElementsByClassName("wsapps")[3].disabled=false;
    document.getElementsByClassName("wsapps")[4].disabled=false;
    document.getElementsByClassName("wsapps")[5].disabled=false;
    document.getElementsByClassName("wsapps")[6].disabled=false;
    document.getElementsByClassName("wsapps")[7].disabled=false;
    if(str!=null && unit=="")
    {
        document.getElementById("unit").focus();
        alert("Select Unit");
        return false;
    }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("demo").innerHTML = this.responseText;
      user=this.responseText.split(',');
      document.getElementById("tnam").value = user[1];
      document.getElementById("des").value = user[2];
      //org=user[3].toString().split('/');
      document.getElementById("grp").value = user[3];
      document.getElementById("subgrp").value = user[4];
      document.getElementById("div").value = user[5];
      document.getElementById("sec").value = user[6];
      document.getElementById("phone").value = user[7];
      document.getElementById("email").value = user[8];
      document.getElementById("clusacct").value = user[9];
      document.getElementById("homefldr").value = user[10];
      document.getElementById("loginname").value = user[11];
      document.getElementById("ipaddr").value = user[12];
      document.getElementById("homefldr_existing").value = user[13];
      document.getElementById("adacct").value = user[14];
      document.getElementById("addetl").value = user[15];
      servers=user[9];
      if(user[1]!="")
      {
          document.getElementById("tnam").readOnly=true;
          document.getElementById("des").readOnly=true;
          document.getElementById("grp").readOnly=true;
          document.getElementById("subgrp").readOnly=true;
          document.getElementById("div").readOnly=true;
          document.getElementById("sec").readOnly=true;
          //document.getElementById("phone").readOnly=true;
          //document.getElementById("email").readOnly=true;
      }
      if(servers.includes("IVY") || servers.includes("Neha") || servers.includes("XeonSMP"))
      {
          document.getElementById("loginname").readOnly=true;
          document.getElementById("ipaddr").readOnly=true;
      }
      if(servers.includes("IVY"))
      {
          document.getElementsByClassName("ivyapps")[0].disabled=true;
          document.getElementsByClassName("ivyapps")[1].disabled=true;
          document.getElementsByClassName("ivyapps")[2].disabled=true;
          document.getElementsByClassName("ivyapps")[3].disabled=true;
          document.getElementsByClassName("ivyapps")[4].disabled=true;
          document.getElementsByClassName("ivyapps")[5].disabled=true;
          //document.getElementById("ivyansys").disabled=true;
      }
      if(servers.includes("Neha"))
      {
          document.getElementsByClassName("nehaapps")[0].disabled=true;
          document.getElementsByClassName("nehaapps")[1].disabled=true;
          document.getElementsByClassName("nehaapps")[2].disabled=true;
          document.getElementsByClassName("nehaapps")[3].disabled=true;
          document.getElementsByClassName("nehaapps")[4].disabled=true;    
      }
      if(servers.includes("XeonSMP"))
      {
          document.getElementsByClassName("xeonsmpapps")[0].disabled=true;
          document.getElementsByClassName("xeonsmpapps")[1].disabled=true;
      }
      if(servers.includes("Workstation"))
      {
          document.getElementsByClassName("wsapps")[0].disabled=true;
          document.getElementsByClassName("wsapps")[1].disabled=true;
          document.getElementsByClassName("wsapps")[2].disabled=true;
          document.getElementsByClassName("wsapps")[3].disabled=true;
          document.getElementsByClassName("wsapps")[4].disabled=true;
          document.getElementsByClassName("wsapps")[5].disabled=true;
          document.getElementsByClassName("wsapps")[6].disabled=true;
          document.getElementsByClassName("wsapps")[7].disabled=true;
      }
    }
  };
  xhttp.open("GET", "model/global_ldap.php?icno=" + str + "&unit=" + unit , true);
  xhttp.send();
}
function validateUnit(unit)
{
    //var unit = document.getElementById("unit").value;
    if(unit=="")
    {
        alert("Select Unit");
        return false;
    }
    document.getElementById("icno").focus();
    document.getElementById("icno").value = "";
    alert("Fill IC No.");
}
</script>
</head>
<body>
<form id="form1" method="post" action="" > 
<table  class='bordercollap' width='100%' border = "1" align='center' cellpadding='1' celspacing='0' bgcolor="#FFFFFF">  
    <table  width='100%' align='center' cellpadding='1' cellspacing='0'>
        <tr valign ='top' align='center'>
            <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" > <strong>  User Account Requisition Form </strong><br />
                <em>(Kindly fill the form, Take a print and submit through proper channel) </em></td>
        </tr>
        <tr valign ='top' align='left'>
            <td height="15" colspan="4" valign = "top" style="text-align:center;border:0">
            <?php if(isset($errMsg))
                {
                    echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
                }
            ?>
            </td>
        </tr>
        <tr valign ='top' align='left'>
            <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' style="text-align:center;border:0" ><b>User Details </b> </td>
        </tr>
        <tr  valign ='top' align='left' >
            <td height="15" align='left'>Unit<span class="style1">*</span></td>
            <td height="15" align='left'><b>
                    <select id="unit" name="unit" onchange="validateUnit(this.value)">
                        <option value="">Select</option>
                        <option value="IGCAR" <?php if($_POST['unit'] == "IGCAR") { echo "selected=\"selected\""; } ?>>IGCAR</option>
                        <option value="BARCF" <?php if($_POST['unit'] == "BARCF") { echo "selected=\"selected\""; } ?>>BARCF</option>
                        <option value="BHAVINI" <?php if($_POST['unit'] == "BHAVINI") { echo "selected=\"selected\""; } ?> >BHAVINI</option>
                        <option value="SRI" <?php if($_POST['unit'] == "SRI") { echo "selected=\"selected\""; } ?>>SRI</option>
                    </select>
                </b>
            </td>
            <td width="18%" height="15"> IC. No.<span class="style1">*</span></td>
            <td width="27%" height="15" align='left'><b>
                    <input id='icno' name='icno' type='text' maxlength='10'  value="<?php echo $_POST['icno']; ?>" required="required" onblur="retrieveUser(this.value)"/></b>
            </td>
        </tr>
        <tr  valign ='top' align='left'>
            <td width="22%" height="15" > Name <span class="style1">*</span></td>
            <td width="33%" height="15" align='left' ><b>
                    <input name='name'  id='tnam' type='text' maxlength='30' required="required" value="<?php echo $_POST['name']; ?>"/>
                </b>
            </td>
            <td height="15" align='left'> Designation</td>
            <td height="15" align='left'><b>
                    <select id="des" name="des" >
                        <option value="SO/C" <?php if($_POST['des'] == "SO/C") { echo "selected=\"selected\""; } ?>>SO/C</option>
                        <option value="SO/D" <?php if($_POST['des'] == "SO/D") { echo "selected=\"selected\""; } ?>>SO/D</option>
                        <option value="SO/E" <?php if($_POST['des'] == "SO/E") { echo "selected=\"selected\""; } ?> >SO/E</option>
                        <option value="SO/F" <?php if($_POST['des'] == "SO/F") { echo "selected=\"selected\""; } ?>>SO/F</option>
                        <option value="SO/G" <?php if($_POST['des'] == "SO/G") { echo "selected=\"selected\""; } ?>>SO/G</option>
                        <option value="SO/H" <?php if($_POST['des'] == "SO/H") { echo "selected=\"selected\""; } ?>>SO/H</option>
                        <option value="SO/SB" <?php if($_POST['des'] == "SO/SB") { echo "selected=\"selected\""; } ?>>SO/SB</option>
                        <option value="SA/B" <?php if($_POST['des'] == "SA/B") { echo "selected=\"selected\""; } ?>>SA/B</option>
                        <option value="SA/C" <?php if($_POST['des'] == "SA/C") { echo "selected=\"selected\""; } ?>>SA/C</option>
                        <option value="SA/D" <?php if($_POST['des'] == "SA/D") { echo "selected=\"selected\""; } ?>>SA/D</option>
                        <option value="SA/E" <?php if($_POST['des'] == "SA/E") { echo "selected=\"selected\""; } ?>>SA/E</option>
                        <option value="SA/F" <?php if($_POST['des'] == "SA/F") { echo "selected=\"selected\""; } ?>>SA/F</option>
                        <option value="SA/G" <?php if($_POST['des'] == "SA/G") { echo "selected=\"selected\""; } ?>>SA/G</option>
                        <option value="JRF" <?php if($_POST['des'] == "JRF") { echo "selected=\"selected\""; } ?>>JRF</option>
                        <option value="SRF" <?php if($_POST['des'] == "SRF") { echo "selected=\"selected\""; } ?>>SRF</option>
                        <option value="VS" <?php if($_POST['des'] == "VS") { echo "selected=\"selected\""; } ?>>VS</option>
                    </select>
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center' >
            <td height="15" align="left"> Group <span class="style1">*</span></td>
            <td height="15" align='left' ><b>
                    <select id="grp" name="grp" >                      
                        <option value="EIG" <?php if($_POST['grp'] == "eig") { echo "selected=\"selected\""; } ?>>EIG</option>
                        <option value="ESG" <?php if($_POST['grp'] == "ESG") { echo "selected=\"selected\""; } ?>>ESG</option>
                        <option value="MCMFCG" <?php if($_POST['grp'] == "MCMFCG") { echo "selected=\"selected\""; } ?>>MCMFCG</option>
                        <option value="MSG" <?php if($_POST['grp'] == "MSG") { echo "selected=\"selected\""; } ?> >MSG</option>
                        <option value="MMG" <?php if($_POST['grp'] == "MMG") { echo "selected=\"selected\""; } ?>>MMG</option>
                        <option value="RDTG" <?php if($_POST['grp'] == "RDTG") { echo "selected=\"selected\""; } ?>>RDTG</option>      <option value="RFG" <?php if($_POST['grp'] == "RFG") { echo "selected=\"selected\""; } ?>>RFG</option>
                        <option value="RPG" <?php if($_POST['grp'] == "RPG") { echo "selected=\"selected\""; } ?>>RPG</option>
                        <option value="FRFCF" <?php if($_POST['grp'] == "FRFCF") { echo "selected=\"selected\""; } ?>>FRFCF</option>
                        <option value="SQRMG" <?php if($_POST['grp'] == "SQRMG") { echo "selected=\"selected\""; } ?>>SQRMG</option>
                        <option value="SRI" <?php if($_POST['grp'] == "SRI") { echo "selected=\"selected\""; } ?>>SRI</option>
                        <option value="BARCF" <?php if($_POST['grp'] == "BARCF") { echo "selected=\"selected\""; } ?>>BARCF</option>
                        <option value="BHAVINI" <?php if($_POST['grp'] == "BHAVINI") { echo "selected=\"selected\""; } ?>> BHAVINI</option>
                    </select></b>
            </td>
            <td width="18%" height="15" align='left'>Sub Group</td>
            <td width="27%" height="15" align='left'><b>
                    <input name='subgrp' id='subgrp' type='text' maxlength='30' value="<?php echo $_POST['subgrp']; ?>"  />
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center' >
            <td height="15" align="left"> Division </td>
            <td height="15" align='left' ><b>
                    <input name='div' id='div' type='text' maxlength='30' value="<?php echo $_POST['div']; ?>"/>
                </b>
            </td>
            <td width="18%" height="15" align='left'> Section </td>
            <td width="27%" height="15" align='left'><b>
                    <input name='sec' id='sec' type='text' maxlength='30' value="<?php echo $_POST['sec']; ?>"  />
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center'>
            <td  height="15" align="left"> Phone<span class="style1">*</span></td>
            <td  height="15" align='left' ><b>
                    <input name='phone' id='phone' type='text' maxlength='30' required="required" value="<?php echo $_POST['phone']; ?>"/>
                </b>
            </td>
            <td height="15" align='left'> E-Mail <span class="style1">*</span></td>
            <td height="15" align='left'><b>
                    <input name='email' id='email' type='text' maxlength='30' required="required" value="<?php echo $_POST['email']; ?>"/>
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center'>
            <td height="15" align="left"> Existing / Preferred Login Name(s): </td>
            <td height="15" align='left' ><b>
                    <input name='lognames'  id='loginname' type='text' maxlength='100' value="<?php echo $_POST['lognames']; ?>"/>
                </b>
            </td>
            <td height="15" align='left'> IP Address of user system</td>
            <td height="15" align='left'><b>
                    <input name='ipadd' id='ipaddr' type='text' maxlength='12' onchange='validate(this.value)' value="<?php echo $_POST['ipadd']; ?>"/>
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center'>
            <td height="15" align="left"> Account exists in: </td>
            <td height="15" align='left' ><b>
                    <input name='clusacct'  id='clusacct' type='text' maxlength='100' value="<?php echo $_POST['clusacct']; ?>" readonly="readonly"/>
                </b>
            </td>
            <td height="15" align='left'> User home group in cluster: </td><!--Home folder location:</td>-->
            <td height="15" align='left'><b>
                    <input name='homefldr' id='homefldr' type='text' maxlength='12' onchange='validate(this.value)' value="<?php echo $_POST['homefldr']; ?>" readonly="readonly"/>
                    <input name='homefldr_existing' id='homefldr_existing' type='text' maxlength='12' onchange='validate(this.value)' value="<?php echo $_POST['homefldr_existing']; ?>" readonly="readonly" hidden="hidden"/>
                </b>
            </td>
        </tr>
        <tr valign ='top' align='center'>
            <td height="15" align="left"> Workstation account: </td> <!--Active Directory -->
            <td height="15" align='left' ><b>
                    <input name='adacct'  id='adacct' type='text' maxlength='100' value="<?php echo $_POST['adacct']; ?>" readonly="readonly"/>
                </b>
            </td>
            <td height="15" align='left' hidden="hidden"> Active Directory details: </td>
            <td height="15" align='left' hidden="hidden"><b>
                    <input name='addetl' id='addetl' type='text' maxlength='12' value="<?php echo $_POST['addetl']; ?>" readonly="readonly" hidden="hidden"/>
                </b>
            </td>
        </tr>
    </table>
    <table  class='bordercollap' width='100%' cellpadding='1' cellspacing='0' style="border:0">
        <tr valign ='middle' align='left'>
            <td height="23" colspan="2" bgcolor='#9999CC'><strong>Details of Servers and Applications <span class="style1">*</span></strong> (Select atleast one server / Applications) </td>
        </tr>
        <tr valign ='top' align='center' bgcolor='#D3D3D3'>
        <td  height="15" align="left" style="border:0;"><strong>Ivy Cluster</strong> (400 node HPC Cluster) </td>
        <td  height="15" align='left' style="border:0;" ><table width="555"  style="border:0;">
            <tr>
              <td width="136" style="border:0"><strong>
                <input name="serapp[]" id="ivyansys" class="ivyapps" type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ANSYS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ANSYS") { echo "checked=\"checked\""; break; }}} ?>/>
                ANSYS</strong></td>
              <td width="136" style="border:0"><strong>
                <input name="serapp[]" class="ivyapps" type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ABAQUS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
                ABAQUS </strong></td>
              <td style="border:0;" width="267" ><strong>
                   <input name="serapp[]" class="ivyapps" type="checkbox" value="Ivy Cluster (400 node HPC Cluster),COMSOL"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),COMSOL") { echo "checked=\"checked\""; break; }}} ?> />
                  COMSOL
                  </strong></td>
            </tr>
            <tr>
              <td style="border:0;"><strong>
                <input name="serapp[]" class="ivyapps" type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CASTEM" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CASTEM") { echo "checked=\"checked\""; break; }}} ?> />
                CASTEM</strong></td>
              <td style="border:0;"><strong>
                <input name="serapp[]" class="ivyapps" type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?> />
                CMD Codes <span class="style2">(VASP,  NAMD ) </span>
                </strong></td>
            <td style="border:0;" colspan="2"><strong>
              <input name="serapp[]" class="ivyapps" type="checkbox" value= "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?> />
SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span></strong></td>
            <td style="border:0;"><strong></strong></td>
          </tr>
        </table></td>
        </tr>
      <tr valign ='top' align='center'>
      <td style="border:0;"  height="15" align="left"> <strong>Neha Cluster </strong> (134 node HPC Cluster) </td>
      <td style="border:0;"  height="15" align='left' >
<table width="558"  style="border:0;">
  <tr>
    <td style="border:0;" width="136"><strong>
      <input name="serapp[]" class="nehaapps" type="checkbox" value="Neha Cluster (134 node HPC Cluster),ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
ABAQUS </strong></td>
    <td style="border:0;"><strong>
      <input name="serapp[]" class="nehaapps" type="checkbox" value="Neha Cluster (134 node HPC Cluster),MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
MATHEMATICA</strong></td>

<td style="border:0;" width="136"><strong>
        <input name="serapp[]" class="nehaapps" type="checkbox" value="Neha Cluster (134 node HPC Cluster),OPENFOAM" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),OPENFOAM") { echo "checked=\"checked\""; break; }}} ?> />
        OPEN FOAM</strong></td>
    </tr> 
  <tr>
    <td style="border:0;" colspan="2"><strong>
      <input name="serapp[]" class="nehaapps" type="checkbox" value="Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
      SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span></strong></td>
    <td style="border:0;" width="270"><strong>
      <input name="serapp[]" class="nehaapps" type="checkbox" value="Neha Cluster (134 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?>/>
CMD Codes <span class="style2">(VASP;Wien2k; NAMD/LAMPs ) </span>
</strong></td>
     </table>    </tr>
<!-- <tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td style="border:0;"   align="left">  <strong>Xeon Cluster </strong> (128 node HPC Cluster) </td>
      <td style="border:0;"   align='left' >
<table width="560"  style="border:0;">
  <tr>
      <td style="border:0;" width="136"><strong>
         <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),LS-DYNA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),LS-DYNA") { echo "checked=\"checked\""; break; }}} ?> />
         LS-DYNA</strong></td>
<td style="border:0;" width="136"><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?>/>
  ABAQUS</strong></td>
<td style="border:0;" width="272">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),WIEN2K" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),WIEN2K") { echo "checked=\"checked\""; break; }}} ?>/>
  WIEN2K</strong></td></tr>
<tr> <td style="border:0;"><strong>
    <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),PHOENICS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),PHOENICS") { echo "checked=\"checked\""; break; }}} ?>/>
    PHOENICS</strong></td>
<td style="border:0;"><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
  FLUIDYN</strong></td>
<td style="border:0;"><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
  SCI. COMPUTING <span class="style2">(Fortran, C/C++) </span></strong></td> 
</tr>
 </table></td> </tr> -->
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td style="border:0;" align="left"><strong>GPU Cluster </strong> </td>
      <td style="border:0;" align='left'>
<table width="561"  style="border:0;" >
  <tr>
    <td style="border:0;" width="136"><strong>
        <input name="serapp[]"   type="checkbox" value="GPU Cluster,ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,ABAQUS") { echo "checked=\"checked\""; break; }}} ?>/>
        ABAQUS</strong></td>
    <td style="border:0;" width="413"><strong>
      <input name="serapp[]"   type="checkbox" value="GPU Cluster,CMD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,CMD") { echo "checked=\"checked\""; break; }}} ?> />
CMD Codes <span class="style2">(VASP, Wien2k, NAMD/LAMPs )</span></strong></td>
  </tr> 
  <tr> <td colspan="2" style="border:0;">
    <strong>
<input name="serapp[]"   type="checkbox" value="GPU Cluster,SCI. COMPUTING (Fortran;C/C++)"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?> />
SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span> </strong></td>
</tr> </table> </tr>
<tr valign ='top' align='center' >
    <td  align="left" style="border:0;"> <strong> Xeon SMP Servers (4 socket 6-core) </strong>  </td>     
<td style="border:0;"   align='left'  valign="top">
<table width="561" style="border:0;"> 
 <!-- <tr> <td style="border:0;" width="136" valign="top" > 
<input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,SYSWELD") { echo "checked=\"checked\""; break; }}} ?> /> <b>SYSWELD </b> </td>
<td style="border:0;" width="136" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,FEMLAB/COMSOL" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FEMLAB/COMSOL") { echo "checked=\"checked\""; break; }}} ?> />
  <b>COMSOL</b></td>
<td style="border:0;" width="273" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,THERMOCALC/DICTRA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,THERMOCALC/DICTRA") { echo "checked=\"checked\""; break; }}} ?> />
  <b>THERMOCALC/DICTRA</b></td> </tr> -->
<tr> <td style="border:0;" valign="top"><input name="serapp[]" class="xeonsmpapps" type="checkbox" value="Xeon SMP Servers,FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
    <b>FLUIDYN</b></td>
<td style="border:0;" colspan="2" valign="top"><input name="serapp[]" class="xeonsmpapps" type="checkbox" value="Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
  <b>SCI.COMPUTING <span class="style2">(Fortran;C/C++)  </span> </b></td>
</tr>
 </table></td>     
 </tr>
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td align="left" style="border:0;" ><strong>Workstation</strong> </td>
      <td align='left' valign ='top' style="border:0;">
<table width="557" style="border:0;"> <tr> <td style="border:0;" width="136">
  <strong>
  <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,ANSYS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ANSYS") { echo "checked=\"checked\""; break; }}} ?> />
  ANSYS</strong></td>
<td style="border:0;" width="136">
  <strong>
  <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
  ABAQUS</strong></td>
<td style="border:0;" width="108">
   <strong>
  <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,SYSWELD") { echo "checked=\"checked\""; break; }}} ?> />
  SYSWELD</strong></td>
<!--<td style="border:0;" width="157">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,CATIA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CATIA") { echo "checked=\"checked\""; break; }}} ?> />
  CATIA</strong></td> -->
  
  <td style="border:0;"><strong>
        <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,CFD-ACE+" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CFD-ACE+") { echo "checked=\"checked\""; break; }}} ?>  />
        CFD-ACE+</strong></td>
</tr>
  <!--<tr>
    <td style="border:0;"><strong>
        <input name="serapp[]"   type="checkbox" value="Workstations,CFD-ACE+" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CFD-ACE+") { echo "checked=\"checked\""; break; }}} ?>  />
        CFD-ACE+</strong></td>
    <td style="border:0;"><strong>
        <input name="serapp[]"   type="checkbox" value="Workstations,FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
        FLUIDYN</strong></td>
    <td style="border:0;"><strong>
      <input name="serapp[]"   type="checkbox" value="Workstations,PVElite"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,PVElite") { echo "checked=\"checked\""; break; }}} ?>  />      
      PVElite</strong></td>
    <td style="border:0;"><strong>
      <input name="serapp[]"   type="checkbox" value="Workstations,ISOGRAPH"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ISOGRAPH") { echo "checked=\"checked\""; break; }}} ?>  />      
      ISOGRAPH</strong></td>
  </tr> -->
<tr>
<!--<td style="border:0;">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,FACTSAGE" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,FACTSAGE") { echo "checked=\"checked\""; break; }}} ?> />
  FACTSAGE</strong></td> -->
<td style="border:0;">
  <strong>
  <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,COMSOL"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
  COMSOL</strong></td>
<td style="border:0;"> <strong>
  <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,JMATPRO" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,JMATPRO") { echo "checked=\"checked\""; break; }}} ?> />  
  JMATPRO</strong></td>
<!--<td style="border:0;"> 
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,DELMIA"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,DELMIA") { echo "checked=\"checked\""; break; }}} ?> />
  DELMIA</strong></td> -->
  <td style="border:0;" colspan="2"><strong></strong><strong>
    <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,THERMOCALC" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,THERMOCALC") { echo "checked=\"checked\""; break; }}} ?>  />
    THERMOCALC/DICTRA</strong></td>
</tr> 
<tr>
  <td style="border:0;" colspan="2"><strong>
    <input name="serapp[]" class="wsapps" type="checkbox" value="Workstations,MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
  </strong><strong>MATHEMATICA</strong></td>
  
  </tr> </table></td> </tr>  
<tr valign ='middle' align='center' >
 <td align='left'style="border:0;"><strong>

Others if any</strong> </td>
<td align="left" style="border:0;"><input name="others" type="textbox"  maxlength='50' width="300" /></td>
    </tr>
<tr>
    <td><br></td>
</tr>
<tr valign ='middle' align='center'>
    <td height="23" colspan="2"><strong><span class="style1"><i><u>Note:</u> Existing users of a cluster cannot apply for account in the same cluster again. </i></span></strong></td>
</tr>
<tr valign ='middle' align='center' >
 <td align='center' colspan=4 bgcolor='#666666'><i>
  <div  align='center'>
    <input  type='submit' name='csave' value='Save & Print ' />
  </div>
</i></td>
    </tr>	
    </table>
</table>
</form>
    <script>
        retrieveUser(<?php echo $_REQUEST["icno"]?>);
    </script>
    </body>
</html>



