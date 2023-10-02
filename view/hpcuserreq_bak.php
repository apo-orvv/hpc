<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 9px;
	font-style: italic;
}
-->
</style>
<form method="post"  action="" > 
<table  class='bordercollap' width='100%' border = "1" align='center' cellpadding='1' celspacing='0' bgcolor="#FFFFFF"> 
  <tr> <td>
  <table  width='100%' align='center' cellpadding='1' cellspacing='0'     >
   <tr valign ='top' align='center'  >
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" > <strong>  User Account Requisition Form </strong><br />
       <em>(Kindly fill the form, Take a print and submit through proper channel) </em></td> 
   </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
    <tr valign ='top' align='left'>
      <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' style="text-align:center;border:0" ><b>User Details </b> </td>
    </tr>
 <tr  valign ='top' align='left' >
 <td width="18%" height="15"  > IC. No.<span class="style1">*</span></td>
      <td width="27%" height="15" align='left'><b>
        <input name='icno' type='text' maxlength='10'  value="<?php echo $_POST['icno']; ?>" required="required"/>
       </b></td>
      <td width="22%" height="15" > Name <span class="style1">*</span></td>
      <td width="33%" height="15" align='left' ><b>
        <input name='name'  id='tnam' type='text' maxlength='30' required="required" value="<?php echo $_POST['name']; ?>"/>
      </b></td>  
    </tr>
<tr  valign ='top' align='left' >
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
      </b></td>
      <td width="18%" height="15"  > Section </td>
      <td width="27%" height="15" align='left'  ><b>
        <input name='sec' type='text' maxlength='30' value="<?php echo $_POST['sec']; ?>"  />
       </b></td>
    </tr>
    <tr valign ='top' align='center' >
      <td height="15" align="left"> Division </td>
      <td height="15" align='left' ><b>
    <input name='div'  id='tnam3' type='text' maxlength='30' value="<?php echo $_POST['div']; ?>"/>
      </b></td>
      <td height="15" align="left"> Group <span class="style1">*</span></td>
      <td height="15" align='left' ><b>
      <select id="grp" name="grp" >                      
      <option value="eig" <?php if($_POST['grp'] == "eig") { echo "selected=\"selected\""; } ?>>EIG</option>
      <option value="rdg" <?php if($_POST['grp'] == "rdg") { echo "selected=\"selected\""; } ?>>RDG</option>
      <option value="mmg" <?php if($_POST['grp'] == "mmg") { echo "selected=\"selected\""; } ?>>MMG</option>
      <option value="rpg" <?php if($_POST['grp'] == "rpg") { echo "selected=\"selected\""; } ?>>RPG</option>
      <option value="romg" <?php if($_POST['grp'] == "romg") { echo "selected=\"selected\""; } ?>>ROMG</option>
      <option value="frtg" <?php if($_POST['grp'] == "frtg") { echo "selected=\"selected\""; } ?>>FRTG</option>
      <option value="msg" <?php if($_POST['grp'] == "msg") { echo "selected=\"selected\""; } ?> >MSG</option>
      <option value="mc&mfcg" <?php if($_POST['grp'] == "mc&mfcg") { echo "selected=\"selected\""; } ?>>MC&MFCG</option>
      <option value="rseg" <?php if($_POST['grp'] == "rseg") { echo "selected=\"selected\""; } ?>>RSEG</option>
      <option value="esg" <?php if($_POST['grp'] == "esg") { echo "selected=\"selected\""; } ?>>ESG</option>
      <option value="rmg" <?php if($_POST['grp'] == "rmg") { echo "selected=\"selected\""; } ?>>RMG</option>
      <option value="frfcf" <?php if($_POST['grp'] == "frfcf") { echo "selected=\"selected\""; } ?>>FRFCF</option>
      <option value="sri" <?php if($_POST['grp'] == "sri") { echo "selected=\"selected\""; } ?>>SRI</option>
      <option value="barc" <?php if($_POST['grp'] == "barc") { echo "selected=\"selected\""; } ?>>BARCF</option>
      <option value="bhavini" <?php if($_POST['grp'] == "bhavini") { echo "selected=\"selected\""; } ?>> BHAVINI</option>
    </select>	
      </b></td>   
    </tr>
<tr valign ='top' align='center' >
      <td  height="15" align="left"> Phone<span class="style1">*</span></td>
      <td  height="15" align='left' ><b>
        <input name='phone'  id='tnam3' type='text' maxlength='30' required="required" value="<?php echo $_POST['phone']; ?>"/>
      </b></td>
      <td height="15" align='left'> E-Mail <span class="style1">*</span></td>
      <td height="15" align='left'><b>
        <input name='email' type='text' maxlength='30' required="required" value="<?php echo $_POST['email']; ?>"/>
        </b></td>
    </tr>
<tr valign ='top' align='center' >
      <td height="15" align="left"> Preferred Login Name(s): </td>
      <td height="15" align='left' ><b>
        <input name='lognames'  id='tnam3' type='text' maxlength='100' value="<?php echo $_POST['lognames']; ?>"/>
      </b></td>
      <td height="15" align='left'> IP. Address</td>
      <td height="15" align='left'><b>
        <input name='ipadd' type='text' maxlength='12' onchange='validate(this.value)' value="<?php echo $_POST['ipadd']; ?>"/>
        </b></td>
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
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ANSYS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ANSYS") { echo "checked=\"checked\""; break; }}} ?>/>
                ANSYS</strong></td>
              <td width="136" style="border:0"><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ABAQUS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
                ABAQUS </strong></td>
              <td style="border:0;" width="267" ><strong>
                   <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),COMSOL"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),COMSOL") { echo "checked=\"checked\""; break; }}} ?> />
                  COMSOL
                  </strong></td>
            </tr>
            <tr>
              <td style="border:0;"><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CASTEM" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CASTEM") { echo "checked=\"checked\""; break; }}} ?> />
                CASTEM</strong></td>
              <td style="border:0;"><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?> />
                CMD Codes <span class="style2">(VASP,  NAMD ) </span>
                </strong></td>
            <td style="border:0;" colspan="2"><strong>
              <input name="serapp[]"   type="checkbox" value= "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?> />
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
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
ABAQUS </strong></td>
    <td style="border:0;"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
MATHEMATICA</strong></td>

<td style="border:0;" width="136"><strong>
        <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),OPENFOAM" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),OPENFOAM") { echo "checked=\"checked\""; break; }}} ?> />
        OPEN FOAM</strong></td>
    </tr> 
  <tr>
    <td style="border:0;" colspan="2"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
      SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span></strong></td>
    <td style="border:0;" width="270"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?>/>
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
<tr> <td style="border:0;" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
    <b>FLUIDYN</b></td>
<td style="border:0;" colspan="2" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
  <b>SCI.COMPUTING <span class="style2">(Fortran;C/C++)  </span> </b></td>
</tr>
 </table></td>     
 </tr>
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td align="left" style="border:0;" ><strong>Workstation</strong> </td>
      <td align='left' valign ='top' style="border:0;">
<table width="557" style="border:0;"> <tr> <td style="border:0;" width="136">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,ANSYS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ANSYS") { echo "checked=\"checked\""; break; }}} ?> />
  ANSYS</strong></td>
<td style="border:0;" width="136">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
  ABAQUS</strong></td>
<td style="border:0;" width="108">
   <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,SYSWELD") { echo "checked=\"checked\""; break; }}} ?> />
  SYSWELD</strong></td>
<!--<td style="border:0;" width="157">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,CATIA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CATIA") { echo "checked=\"checked\""; break; }}} ?> />
  CATIA</strong></td> -->
  
  <td style="border:0;"><strong>
        <input name="serapp[]"   type="checkbox" value="Workstations,CFD-ACE+" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CFD-ACE+") { echo "checked=\"checked\""; break; }}} ?>  />
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
  <input name="serapp[]"   type="checkbox" value="Workstations,COMSOL"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
  COMSOL</strong></td>
<td style="border:0;"> <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,JMATPRO" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,JMATPRO") { echo "checked=\"checked\""; break; }}} ?> />  
  JMATPRO</strong></td>
<!--<td style="border:0;"> 
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,DELMIA"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,DELMIA") { echo "checked=\"checked\""; break; }}} ?> />
  DELMIA</strong></td> -->
  <td style="border:0;" colspan="2"><strong></strong><strong>
    <input name="serapp[]"   type="checkbox" value="Workstations,THERMOCALC" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,THERMOCALC") { echo "checked=\"checked\""; break; }}} ?>  />
    THERMOCALC/DICTRA</strong></td>
</tr> 
<tr>
  <td style="border:0;" colspan="2"><strong>
    <input name="serapp[]"   type="checkbox" value="Workstations,MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
  </strong><strong>MATHEMATICA</strong></td>
  
  </tr> </table></td> </tr>  
<tr valign ='middle' align='center' >
 <td align='left'style="border:0;"><strong>

Others if any</strong> </td>
<td align="left" style="border:0;"><input name="others" type="textbox"  maxlength='50' width="300" /></td>
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
 </td> </td> </table>
</td> </tr>
</table>
</form>



