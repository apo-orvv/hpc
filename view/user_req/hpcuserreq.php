<?php 
session_start();
include 'dbconnect.php';
include 'header.php';
include 'lmenu.php';
if(isset($_POST['csave']))
{
$errMsg ='';
	if(trim($_POST['icno']) == "") 
	{
      $errMsg .= "<li>Please enter your name.</li>";
    } else { $icno=$_POST['icno']; }
	
//echo $icno;
if(trim($_POST['icno']) == " ") 
	{
      $errMsg .= "<li>Please enter your name.</li>";
    } else {$name=$_POST['name']; }
	
if(trim($_POST['phone']) == " ") 
	{
      $errMsg .= "<li>Please enter your name.</li>";
    } else { $phone=$_POST['phone']; }

if(trim($_POST['grp']) == " ") 
	{
      $errMsg .= "<li>Please Select Group.</li>";
    } else { $grp=$_POST['grp']; }

if(trim($_POST['email']) == " ") 
	{
      $errMsg .= "<li>Please enter your E-mail.</li>";
    } else { $email=$_POST['email']; }

$lognames=$_POST['lognames'];
$ipadd=$_POST['ipadd'];
$des=$_POST['des'];
$sec=$_POST['sec'];
$div=$_POST['div'];
$app=$_POST['others'];
//$checked_count = count($_POST['serapp']);
//$checked_count = $checked_count;
//foreach($_POST['serapp'] as $selected ) 
//{
//$serapp .= $selected.";";
//
//}

//echo $ser_app. "<br>";

//echo "************" .$ser_app;

//$appusage=  rtrim($serapp,";");
//$lst = explode(";", $appusage);
//$num=count($lst);
//echo "List of server ********" .$lst;
//echo "Count ______________".$num;
//for($i=0;$i<$num;$i++)
//{
 //   $serandapp=explode(",", $lst[$i]);
//    $ser .=$serandapp[0]. ",";
//    $app .=$serandapp[1]. ",";
//}

if(($_POST['serapp']==" ") || ($app==" ") )
{
$errMsg .= 'Please Select Any of the Application software / Provide software Name in Others<br>';
}
if((!empty($_POST['icno'])) &&(!empty($_POST['name']))&&(!empty($_POST['phone']))&& (!empty($_POST['email'])) && (!empty($_POST['grp'])))
{  
   //echo "----------------coming inside if";
   if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
     {
   $errMsg .= "Only letters and white space allowed for name <br>"; 
     }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
	 {
      $errMsg .= "Invalid email format <br>"; 
	  //echo $errMsg;
     } 
     if (!preg_match("/^[a-zA-Z ]*$/",$grp)) 
     {
      $errMsg = "Only letters allowed <br>"; 
      }
      if (($ipadd!="") && (!filter_var($ipadd, FILTER_VALIDATE_IP)))
	   {
    $errMsg .= "Invalid IP Address <br>";
        }
  if (!filter_var($icno, FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid IC Number <br>";
     }
if (!filter_var($phone, FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid Phone Number <br>";
     }
// Counting number of checked checkboxes.

}//if 

if($errMsg=='')
{
try 
{
$c_date = date ("Y-m-d");
$stat="User Requested";
$query = "INSERT INTO HPCUSER (`icno`,`user_name`,`phoneno`, `section`,`division`,`igroup`,`mailid`,`preuname`,`ipadd`,
`hpcstat`,`datereq`,`applusage`,`des`) 
VALUES (:icno,:name,:phone,:sec,:div,:grp,:email,:lognames,:ipadd,:stat,:reqdate,:app,:des)";
$stmt=$dbh->prepare($query);
$stmt->bindParam(':icno', $icno, PDO::PARAM_INT);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
$stmt->bindParam(':sec', $sec, PDO::PARAM_STR);
$stmt->bindParam(':div', $div, PDO::PARAM_STR);
$stmt->bindParam(':grp', $grp, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':lognames', $lognames, PDO::PARAM_STR);
$stmt->bindParam(':ipadd', $ipadd, PDO::PARAM_STR);
$stmt->bindParam(':app', $app, PDO::PARAM_STR);
//$stmt->bindParam(':ser', $ser, PDO::PARAM_STR);
$stmt->bindParam(':reqdate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':stat', $stat, PDO::PARAM_STR);
//$stmt->bindParam(':credate', $c_date, PDO::PARAM_STR);
$stmt->bindParam(':des', $des, PDO::PARAM_STR);
//$stmt->bindParam(':serapp', $serapp, PDO::PARAM_STR);
$stmt->execute();
//$dbh = null;        // Disconnect
$id = $dbh->lastInsertId();
//echo "Last Inserted Id ***************".$id;

if($id!=0)
{
//echo "Coming Inside";
//$f_id=$id;
$cnt=0;
foreach($_POST['serapp'] as $selected => $val ) 
{
$ser_app1=$_POST['serapp'][$selected];
//echo $ser_app1;
$lst = explode(",", $ser_app1);
$sername=$lst[0];
$appname=$lst[1];
//echo $sername ."<br>";
//echo $appname ."<br>";
$query = "INSERT INTO `hpcappser` (`reqid`,`sername`, `appname`) VALUES (:reqid,:sername, :appname)";
//echo $query;
$s = $dbh->prepare($query);
    $s->bindValue(':reqid',$id);
    $s->bindValue(':sername',$sername);
    $s->bindValue(':appname',$appname);
$s->execute();

} //for
} 
include 'webmail.php';
$d = new Zmail;
$content= "The User  ".$icno." Requested the HPC server with request id  ".$id;
$d->sendmail('hpcadm@igcar.gov.in', 'hpcadm', 'tripura@igcar.gov.in', 'sun', 'New user requested', $content);
echo "<script> window.location.assign('hpcuserprt.php');</script> "; 
$_SESSION['reqid'] = $id;
} //close try
catch(PDOException $e) 
{
    trigger_error('Error occured while trying to insert into the DB:' . $e->getMessage(), E_USER_ERROR);
	echo $e->getMessage();
}
//echo "<script> alert('User Requitision is Forwarded To Administrator:'); window.location.assign('userreqprint.php?uicno=$icno?'); ";
// $errMsg.='User Requitision is Forwarded To Administrator: ';
// echo "<script> window.location.assign('hpcuserprt.php');";
} //if
} //post if 
?>
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
<table  width='100%' border = "1" align='center' cellpadding='1' cellspacing='0' bgcolor="#FFFFFF"> 
  <tr> <td>
  <table  width='100%' align='center' cellpadding='1' cellspacing='0'     >
   <tr valign ='top' align='center'  >
       <td height="15" colspan="4" valign = "top" > <strong>  User Account Requisition Form </strong><br />
       <em>(Kindly fill the form, Take a print and submit through proper channel) </em></td> 
   </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
    <tr valign ='top' align='left'>
      <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' ><b>User Details </b> </td>
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
      <option value="cg" <?php if($_POST['grp'] == "cg") { echo "selected=\"selected\""; } ?>>CG</option>
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
  <table  width='100%' cellpadding='1' cellspacing='0'>  
    <tr valign ='middle' align='left'>
      <td height="23" colspan="2" bgcolor='#9999CC'><strong>Details of Servers and Applications <span class="style1">*</span></strong> (Select atleast one server / Applications) </td>
    </tr>
      <tr valign ='top' align='center' bgcolor='#D3D3D3'>
        <td  height="15" align="left"><strong>Ivy Cluster</strong> (400 node HPC Cluster) </td>
        <td  height="15" align='left' ><table width="555">
            <tr>
              <td width="136"><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ANSYS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ANSYS") { echo "checked=\"checked\""; break; }}} ?>/>
                ANSYS</strong></td>
              <td width="136"><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),ABAQUS"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
                ABAQUS </strong></td>
              <td width="267"><strong>
                   <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),LS-DYNA"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),LS-DYNA") { echo "checked=\"checked\""; break; }}} ?> />
                   LS-DYNA           
                  </strong></td>
            </tr>
            <tr>
              <td><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CFD-ACE+" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CFD-ACE+") { echo "checked=\"checked\""; break; }}} ?> />
                CFD ACE+ </strong></td>
              <td><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),SYSWELD") { echo "checked=\"checked\""; break; }}} ?>/>
                SYSWELD</strong></td>
              <td><strong>
                <input name="serapp[]"   type="checkbox" value="Ivy Cluster (400 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?> />
                CMD Codes <span class="style2">(VASP,  NAMD ) </span>
                </strong></td>
            </tr>
            <tr>
            <td colspan="2"><strong>
              <input name="serapp[]"   type="checkbox" value= "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Ivy Cluster (400 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?> />
SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span></strong></td>
            <td><strong></strong></td>
          </tr>
        </table></td>
        </tr>
      <tr valign ='top' align='center'>
      <td  height="15" align="left"> <strong>Neha Cluster </strong> (134 node HPC Cluster) </td>
      <td  height="15" align='left' >
<table width="558">
  <tr>
    <td width="136"><strong>
        <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),LS-DYNA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),LS-DYNA") { echo "checked=\"checked\""; break; }}} ?> />
        LS-DYNA</strong></td>
    <td width="136"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
ABAQUS </strong></td>
    <td><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
MATHEMATICA</strong></td>
    </tr> 
  <tr>
    <td colspan="2"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
      SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span></strong></td>
    <td width="270"><strong>
      <input name="serapp[]"   type="checkbox" value="Neha Cluster (134 node HPC Cluster),CMD Codes" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Neha Cluster (134 node HPC Cluster),CMD Codes") { echo "checked=\"checked\""; break; }}} ?>/>
CMD Codes <span class="style2">(VASP;Wien2k; NAMD/LAMPs ) </span>
</strong></td>
     </table>    </tr>
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td   align="left">  <strong>Xeon Cluster </strong> (128 node HPC Cluster) </td>
      <td   align='left' >
<table width="560">
  <tr>
      <td width="136"><strong>
         <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),LS-DYNA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),LS-DYNA") { echo "checked=\"checked\""; break; }}} ?> />
         LS-DYNA</strong></td>
<td width="136"><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),ABAQUS") { echo "checked=\"checked\""; break; }}} ?>/>
  ABAQUS</strong></td>
<td width="272">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),WIEN2K" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),WIEN2K") { echo "checked=\"checked\""; break; }}} ?>/>
  WIEN2K</strong></td></tr>
<tr> <td><strong>
    <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),PHOENICS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),PHOENICS") { echo "checked=\"checked\""; break; }}} ?>/>
    PHOENICS</strong></td>
<td><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
  FLUIDYN</strong></td>
<td><strong>
  <input name="serapp[]"   type="checkbox" value="Xeon Cluster (128 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon Cluster (128 node HPC Cluster),SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
  SCI. COMPUTING <span class="style2">(Fortran, C/C++) </span></strong></td> 
</tr>
 </table></td> </tr>
<tr valign ='top' align='center' >
      <td align="left"><strong>GPU Cluster </strong> </td>
      <td align='left'>
<table width="561">
  <tr>
    <td width="136"><strong>
        <input name="serapp[]"   type="checkbox" value="GPU Cluster,ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,ABAQUS") { echo "checked=\"checked\""; break; }}} ?>/>
        ABAQUS</strong></td>
    <td width="413"><strong>
      <input name="serapp[]"   type="checkbox" value="GPU Cluster,CMD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,CMD") { echo "checked=\"checked\""; break; }}} ?> />
CMD Codes <span class="style2">(VASP, Wien2k, NAMD/LAMPs )</span></strong></td>
  </tr> 
  <tr> <td colspan="2">
    <strong>
<input name="serapp[]"   type="checkbox" value="GPU Cluster,SCI. COMPUTING (Fortran;C/C++)"  <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "GPU Cluster,SCI. COMPUTING (Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?> />
SCI. COMPUTING <span class="style2"> (Fortran, C/C++) </span> </strong></td>
</tr> </table> </tr>
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
    <td  align="left"> <strong> Xeon SMP Servers (4 socket 6-core) </strong>  </td>     
<td   align='left'  valign="top">
<table width="561"> 
  <tr> <td width="136" valign="top" > 
<input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,SYSWELD") { echo "checked=\"checked\""; break; }}} ?> /> <b>SYSWELD </b> </td>
<td width="136" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,FEMLAB/COMSOL" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FEMLAB/COMSOL") { echo "checked=\"checked\""; break; }}} ?> />
  <b>COMSOL</b></td>
<td width="273" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,THERMOCALC/DICTRA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,THERMOCALC/DICTRA") { echo "checked=\"checked\""; break; }}} ?> />
  <b>THERMOCALC/DICTRA</b></td> </tr>
<tr> <td valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
    <b>FLUIDYN</b></td>
<td colspan="2" valign="top"><input name="serapp[]"   type="checkbox" value="Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,SCI.COMPUTING(Fortran;C/C++)") { echo "checked=\"checked\""; break; }}} ?>/>
  <b>SCI.COMPUTING <span class="style2">(Fortran;C/C++) </span> </b></td>
</tr>
 </table></td>     
 </tr>
<tr valign ='top' align='center' >
      <td align="left"><strong>Windows Servers/WS</strong> </td>
      <td align='left' valign ='top'>
<table width="557"> <tr> <td width="136">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,ANSYS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ANSYS") { echo "checked=\"checked\""; break; }}} ?> />
  ANSYS</strong></td>
<td width="136">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,ABAQUS" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ABAQUS") { echo "checked=\"checked\""; break; }}} ?> />
  ABAQUS</strong></td>
<td width="108">
   <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,SYSWELD" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,SYSWELD") { echo "checked=\"checked\""; break; }}} ?> />
  SYSWELD</strong></td>
<td width="157">
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,CATIA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CATIA") { echo "checked=\"checked\""; break; }}} ?> />
  CATIA</strong></td> 
</tr>
  <tr>
    <td><strong>
        <input name="serapp[]"   type="checkbox" value="Workstations,CFD-ACE+" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,CFD-ACE+") { echo "checked=\"checked\""; break; }}} ?>  />
        CFD-ACE+</strong></td>
    <td><strong>
        <input name="serapp[]"   type="checkbox" value="Workstations,FLUIDYN" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
        FLUIDYN</strong></td>
    <td><strong>
      <input name="serapp[]"   type="checkbox" value="Workstations,PVElite"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,PVElite") { echo "checked=\"checked\""; break; }}} ?>  />      
      PVElite</strong></td>
    <td><strong>
      <input name="serapp[]"   type="checkbox" value="Workstations,ISOGRAPH"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,ISOGRAPH") { echo "checked=\"checked\""; break; }}} ?>  />      
      ISOGRAPH</strong></td>
  </tr> 
<tr>
<td>
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,FACTSAGE" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,FACTSAGE") { echo "checked=\"checked\""; break; }}} ?> />
  FACTSAGE</strong></td>
<td>
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,COMSOL"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Xeon SMP Servers,FLUIDYN") { echo "checked=\"checked\""; break; }}} ?> />
  COMSOL</strong></td>
<td> <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,JMATPRO" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,JMATPRO") { echo "checked=\"checked\""; break; }}} ?> />  
  JMATPRO</strong></td>
<td> 
  <strong>
  <input name="serapp[]"   type="checkbox" value="Workstations,DELMIA"<?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,DELMIA") { echo "checked=\"checked\""; break; }}} ?> />
  DELMIA</strong></td> 
</tr>
<tr>
  <td colspan="2"><strong>
    <input name="serapp[]"   type="checkbox" value="Workstations,MATHEMATICA" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,MATHEMATICA") { echo "checked=\"checked\""; break; }}} ?> />
  </strong><strong>MATHEMATICA</strong></td>
  <td colspan="2"><strong></strong><strong>
    <input name="serapp[]"   type="checkbox" value="Workstations,THERMOCALC" <?php if(isset($_POST['serapp'])) { foreach($_POST['serapp'] as $tmp) { if($tmp == "Workstations,THERMOCALC") { echo "checked=\"checked\""; break; }}} ?>  />
    THERMOCALC/DICTRA</strong></td>
  </tr> </table></td> </tr>  
<tr valign ='middle' align='center' bgcolor='#D3D3D3'>
 <td align='left'><strong>

Others if any</strong> </td>
<td align="left"><input name="others" type="textbox"  maxlength='50' width="300" /></td>
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



