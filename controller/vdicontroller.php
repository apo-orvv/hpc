<?php
require_once("model/vdi_model.php");  
  
class vdicontroller
{
public $vdimodel;

public function __construct()
{
    $this->vdimodel=new vdi_model();
    //$this->userreq();
}

public function vdireq()
{
if(isset($_POST['csave'])) 
{
$errMsg ='';
if(trim($_POST['icno']) == "") 
	{
      $errMsg .= "<li>Please enter your ICNO.</li>";
    } else { $icno=$_POST['icno']; }
	
//echo $icno;
if(trim($_POST['name']) == " ") 
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
$data[icno]=$_POST['icno'];
$data[name]=$_POST['name'];
$data[phone]=$_POST['phone'];
$data[grp]=$_POST['grp'];
$data[email]=$_POST['email']; 
$data[predate]=$_POST['predate'];

$data[ipadd]=$_POST['ipadd'];
$data[des]=$_POST['des'];
$data[sec]=$_POST['sec'];
$data[div]=$_POST['div'];


if((!empty($_POST['icno'])) &&(!empty($_POST['name']))&&(!empty($_POST['phone']))&& (!empty($_POST['email'])) && (!empty($_POST['grp'])))
{  
   //echo "----------------coming inside if";
   if (!preg_match("/^[a-zA-Z ]*$/",$data[name])) 
     {
   $errMsg .= "Only letters and white space allowed for name <br>"; 
     }
    if (!filter_var($data[email], FILTER_VALIDATE_EMAIL))
	 {
      $errMsg .= "Invalid email format <br>"; 
	  //echo $errMsg;
     } 
     if (!preg_match("/^[a-zA-Z ]*$/",$data[grp])) 
     {
      $errMsg = "Only letters allowed <br>"; 
      }
      if (($data[ipadd]!="") && (!filter_var($data[ipadd], FILTER_VALIDATE_IP)))
	   {
    $errMsg .= "Invalid IP Address <br>";
        }
  if (!filter_var($data[icno], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid IC Number <br>";
     }
if (!filter_var($data[phone], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid Phone Number <br>";
     }
// Counting number of checked checkboxes.
}//if 
if($errMsg=='')
{
$reqid=$this->vdimodel->vdireq($data);
/*include 'webmail.php';
$d = new Zmail;
$content= "The User  ".$icno." Requested the HPC server with request id  ".$id;
$d->sendmail('hpcadm@igcar.gov.in', 'hpcadm', 'tripura@igcar.gov.in', 'sun', 'New user requested', $content);
$_SESSION['reqid'] = $reqid;*/
if($reqid!=""){ 

//echo "Success";

echo '<script language="javascript">';
  echo 'alert("Request Submitted Successfully")';  //not showing an alert box.
  echo '</script>';
echo "<script> window.location.assign('index.php?hpcpage=vdi');</script> ";   
}

} 
//if
} //post if 


include "view/vdirequest.php"; 
} //controller function

public function user_stat()
{ //echo "user Status";
$r1=$this->vdimodel->userstat();
include "view/userstat.php";
}

public function userforward()
{ //echo "user forward"; 

if(isset($_POST['forward']))
{
echo "Coming Inside";
//$f_id=$id;
$cnt=0;
foreach($_POST['check'] as $selected => $val )
{
$reqid=$_POST['check'][$selected];
//echo $reqid;
//echo "test";
$id2 =$this->usermodel->userupdateforward($reqid);
} //for

if($id2!="")
{
echo "forwarded sucessfully";
}
}
else
{
$r1=$this->usermodel->userforward();
include "view/userforward.php";
}
}

public function usercomplete()
{ //echo "user Status";
$r1=$this->usermodel->usercomplete();
include "view/usercomplete.php";
}

public function userreqprint()
{
if (isset($_SESSION['reqid']))
{
unset($_GET['reqid']);
unset($_POST['seqno']);
$regid=$_SESSION['reqid'];
}
if(isset($_POST['show']))
{
session_destroy();
unset($_GET['reqid']);
$regid=$_POST['seqno'];
}
if($_GET['reqid']!='')
{
unset($_POST['seqno']);
session_destroy();
$regid=$_GET['reqid'];
}
$r=$this->usermodel->userreqprint($regid);
include "view/hpcuserprt.php";
} //function 


public function userfeedback($uname)
{ 
if(isset($_POST['csave']))
{
	
$serflag=0;
$appflag=0;
$fflag=0;
$iflag=0;
$uflag=0;

if(trim($_POST['uicno']) == "") 
	{
      $errMsg .= "<li>Please enter your ICNO.</li>";
    } else { $icno=$_POST['icno']; }
	
//echo $icno;
if(trim($_POST['name']) == " ") 
	{
      $errMsg .= "<li>Please enter your name.</li>";
    } else {$name=$_POST['name']; }
	
if(trim($_POST['phone']) == " ") 
	{
      $errMsg .= "<li>Please enter your name.</li>";
    } else { $phone=$_POST['phone']; }

if(trim($_POST['sec']) == " ") 
	{
      $errMsg .= "<li>Please Enter Group/Division/Section.</li>";
    } else { $grp=$_POST['grp']; }

if(trim($_POST['email']) == " ") 
	{
      $errMsg .= "<li>Please enter your E-mail.</li>";
    } else { $email=$_POST['email']; }

$data[icno]=$_POST['uicno'];
$data[uid]=$_POST['uid'];
$data[name]=$_POST['name'];
$data[phone]=$_POST['phone'];
$data[email]=$_POST['email']; 
$data[ipadd]=$_POST['ipadd'];
$data[sec]=$_POST['sec'];
$data[des]=$_POST['des'];
$data[app]=$_POST['othersw'];
if (!preg_match("/^[a-zA-Z ]*$/",$data[name])) 
     {
   $errMsg .= "Only letters and white space allowed for name <br>"; 
     }
    if (!filter_var($data[email], FILTER_VALIDATE_EMAIL))
	 {
      $errMsg .= "Invalid email format <br>"; 
	  //echo $errMsg;
     } 
    
      if (($data[ipadd]!="") && (!filter_var($data[ipadd], FILTER_VALIDATE_IP)))
	   {
    $errMsg .= "Invalid IP Address <br>";
        }
  if (!filter_var($data[icno], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid IC Number <br>";
     }
if (!filter_var($data[phone], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid Phone Number <br>";
     }



if(!empty($_POST['serapp']))
 {
//echo "Counting number of checked checkboxes.";
$checked_count = count($_POST['serapp']);
$checked_count = $checked_count;
$serflag=1;
foreach($_POST['serapp'] as $selected) 
{
$data[serapp] .= $selected." ";
}
}
else
{
$serflag=0;
$errMsg .= "<b>Please Select Application detail.</b>";
}

if(!empty($_POST['serid']))
 {
$checked_count = count($_POST['serid']);
$checked_count = $checked_count;
$appflag=1;
foreach($_POST['serid'] as $selected) 
{
$data[serid] .= $selected." ";
}
}
else
{
$appflag=0;
$errMsg .= "<b>Please Select Server details.</b>";
}

if($_POST['availa'] !='' &&  $_POST['upgra']!='' &&  $_POST['tech']!='' )
{
	$data[availa]=$_POST['availa'];
	$data[upgra]=$_POST['upgra'];
	$data[tech]=$_POST['tech'];
$fflag=1;
}
else { $fflag=0;

$errMsg .= "<b>Please rate HPC services </b>";}

if (!(ctype_digit($_POST['sindex'])))
{
$data[sindex]=$_POST['sindex'];	
$errMsg .="Please provide number between 0 to 100";
$iflag=0;
}
else { 

$chkno = $_POST['sindex'];
if ($chkno>0 && $chkno<101)
{ 
$data[sindex]=$_POST['sindex'];
$iflag=1; }

else { $errMsg .= "Please provide number between 0 to 100";
$iflag=0;  } 
} 
$data[fyear] = 2017;
if($serflag==1 && $appflag==1 && $fflag==1 && $iflag==1 && $errMsg=="")
{
$reqid=$this->usermodel->save_feedback($data);
}

if($reqid!="")
{
echo "<script> alert('Thank you for your valuable feedback');</script> ";
echo "<script> window.location.assign('index.php');</script> "; 
}
}
$r1=$this->usermodel->getldapuser($uname);
//print_r($r1);
include "view/hpcfeedback.php";
}



public function ldapusers()
{ //echo "user Status";
//$r1=$this->usermodel->getldapuser();
//print_r($r1);
include "view/ldapuser.php";
}

public function divtodivapproval()
{
	
	if(isset($_POST['divforward']))
{
	
	if(!empty($_POST['check_list'])){
echo "*************";
foreach($_POST['check_list'] as $selected){
	
//echo $selected."</br>";
$reqid=$selected;
$r1=$this->usermodel->savedivtodivapproval($reqid);
}
}
	$r1=$this->usermodel->divtodivapproval();
	
}
else 
$r1=$this->usermodel->divtodivapproval();
//print_r($r1);
include "view/divtodivapproval.php";
	
}


public function divtosecapproval()
{
	
	if(isset($_POST['divforward']))
{
	
	if(!empty($_POST['check_list'])){
echo "*************";
foreach($_POST['check_list'] as $selected){
	
//echo $selected."</br>";
$reqid=$selected;
$r1=$this->usermodel->savedivtosecapproval($reqid);
}
}
$r1=$this->usermodel->divtosecapproval();
}
else 
$r1=$this->usermodel->divtosecapproval();
//print_r($r1);
include "view/divtosecapproval.php";
}


public function sectoadminapproval()
{
	
	if(isset($_POST['divforward']))
{
	
	if(!empty($_POST['check_list'])){
echo "*************";
foreach($_POST['check_list'] as $selected){
	
//echo $selected."</br>";
$reqid=$selected;
$r1=$this->usermodel->savesectoadminapproval($reqid);
}
}
$r1=$this->usermodel->sectoadminapproval();
}
else 
$r1=$this->usermodel->sectoadminapproval();
//print_r($r1);
include "view/sectoadminapproval.php";
}



/*

public function useradd()
{ 


echo 'Entered';
$ds = "10.1.2.17";

    $ldap = ldap_connect($ds);
//    $username = $_POST['username'];
//    $password = $_POST['password'];

    $ldaprdn = 'cn=Manager,dc=igcar,dc=cd';
    $password = 'manager123';
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);
// $bind = @ldap_bind($ldap);

$hashed_password = crypt($_POST['uid']."123");

    if ($bind) {
echo 'Bind was successfull';
                $dn = "uid=".$_POST['uid'].",ou=People,dc=igcar,dc=cd";
                $info["objectclass"][0] = "account";
                $info["objectclass"][1] = "posixAccount";
                $info["objectclass"][2] = "shadowAccount";
                $info["objectclass"][3] = "auxPerson";
                $info["cn"] = $_POST['name'];
                $info["mail"] = $_POST['email'];
                $info["employeenumber"] = $lname;
                $info["uidnumber"] = "554";
                $info["gidnumber"] = "501";
                $info["userpassword"] = $_POST['uid']."123";
                $info["gecos"] = $_POST['name'];
                $info["loginshell"] = "/bin/bash";
                $info["homedirectory"] = "/home/".$_POST['grp']."/".$_POST['uid'];
                $info["shadowexpire"] = "-1";
                $info["shadowflag"] = "0";
                $info["shadowwarning"] = "7";
                $info["shadowmin"] = "0";
                $info["shadowmax"] = "99999";
                $info["shadowlastchange"] = "0";
                $info["ou"][0] = $_POST['grp'];
                $info["ou"][1] = $_POST['div'];
                $info["ou"][2] = $_POST['sec'];
                $info["employeetype"] = $_POST['des'];
                $info["iphostnumber"] = "_";
                $info["telephonenumber"] = $_POST['phone'];
                $i=0;
                foreach($_POST['serid'] as $selected)
                {
                        $info["host"][$i] = $selected;
                        $i=$i+1;
                }
		$info["userpassword"] = "{crypt}" . $hashed_password;
                $r = ldap_add($ldap, $dn, $info);
                if($r==1)
        { echo 'User details submitted successfully';}
        else
        { echo 'User details could not be submitted';}
        @ldap_close($ldap);
    } else {
        $msg = "Could not bind with ldap server";
        echo $msg;
    }


//include "view/ldapuser.php";
}

public function userapproval()
{ 

session_start();
include 'header.php';
include 'lmenu.php';
include 'dbconnect.php';
if (isset($_SESSION['icno_session']))
{
$lname=$_SESSION['icno_session'];
}
if (isset($_SESSION['type_session']))
{
$ltype=$_SESSION['type_session'];
}
if (isset($_SESSION['user_session']))
{
$mname=$_SESSION['user_session'];
}

if(($ltype=='A') || ($ltype=='AA')|| ($ltype=='AS'))
{
//echo "coming Inside";
$sql="select * from HPCUSER where HPCSTAT='User Requested'";
//echo $sql;
}
else 
{
echo "Sorry, You are not authorized to view this page. Please Login.";
}

?>
<form action="" >
<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor="#00CCFF"><strong>  User Requests    
</td> </tr> </thead>
<tr bgcolor='#888888' height="35px">
    <td width = '10%' >Sl.No. </td>
    <td width = '10%' >IC_No </td>
    <td width = '10%' >Name</td>
    <td width = '10%' >Section/Div/Group</td>
    <td width = '10%' >Requested Date</td>
    <td width = '10%'>Created Date</td>
	<td width = '10%'>Servers</td>
    <td width = '15%'>Applications</td>
    <td width = '15%'>Status</td> </tr>
<tbody>
<?php 
$sql1=$dbh->query($sql);
$sql1->setFetchMode(PDO::FETCH_ASSOC);  
while ($r = $sql1->fetch()): 
?> 
<tr>
 <td ><?php echo htmlspecialchars($r["reqid"]); ?></td>
 <td> <a href='hpcuserupdate?uicno=<?php echo htmlspecialchars($r["icno"]);?>&seqno=<?php echo htmlspecialchars($r["reqid"]);?>' > <?php echo htmlspecialchars($r['icno']); ?>
     </a> </td> 
 <td><?php echo htmlspecialchars($r['user_name']); ?></td>
 <td><?php echo htmlspecialchars($r['section']); ?>/<?php echo  htmlspecialchars($r['division']);?>/<?php echo  htmlspecialchars($r['igroup']);?></td>
 <td><?php echo htmlspecialchars($r['datereq']); ?></td>
 <td><?php echo htmlspecialchars($r['datecreated']);?></td>
 <td><?php echo htmlspecialchars($r['sername']); ?></td>
 <td><?php echo htmlspecialchars($r['applusage']); ?></td>
 <td><?php echo htmlspecialchars($r['hpcstat']); ?></td>
 </tr>
 <?php endwhile; ?>
 </tbody>								 												
<tr> 
    <td colspan="9">   </td> </tr>
</table>
</form>

<?php

}




public function userforward()
{
	
	if ($ltype=='AD')
{
//echo "coming Inside";
$sql="select * from HPCUSER where HPCSTAT='USER Requested'";
//echo $sql;
}
else 
{
echo "Sorry, You are not authorized to view this page. Please Login.";
}


if(isset($_POST['forward']))
{
echo "Coming Inside";
//$f_id=$id;
$cnt=0;
foreach($_POST['check'] as $selected => $val ) 
{
$reqid=$_POST['check'][$selected];
//echo "Selected" .$icno;
$query = "UPDATE `HPCUSER` SET `hpcstat`='Request Forwarded' WHERE reqid=:reqid";
//echo $query;
$up = $dbh->prepare($query);
$up->bindValue(':reqid',$reqid);
    //$s->bindValue(':sername',$sername);
    //$s->bindValue(':appname',$appname);
$up->execute();
} //for
} 



?>
<script >

var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
<form action="userforward" method="post" >
<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' >  
<tr>  
<td colspan="9" align='center' height="35px" bgcolor="#00CCFF"><strong>  User Requests    
</td> </tr> </thead>
<tr bgcolor='#888888' height="35px">
    <td width = '10%' >Sl. No. </td>
	<td width = '10%' ><input type="checkbox" id="select_all"/> Select All </td>
    <td width = '10%' >IC_No </td>
    <td width = '10%' >Name</td>
    <td width = '10%' >Section/Div/Group</td>
    <td width = '10%' >Requested Date</td>
    <td width = '10%'>Created Date</td>
	<td width = '10%'>Servers</td>
    <td width = '15%'>Status</td> </tr>
<tbody>
<?php 
$sql1=$dbh->query($sql);
$sql1->setFetchMode(PDO::FETCH_ASSOC);  
while ($r = $sql1->fetch()): 
?> 
<tr>
 <td ><?php echo htmlspecialchars($r["reqid"]); ?></td>
 <td> <?php echo"<input class='checkbox' name='check[]' type='checkbox' value='$r[reqid]'"; ?> </td>
 <td> <?php echo htmlspecialchars($r['icno']); ?></td> 
 <td><?php echo htmlspecialchars($r['user_name']); ?></td>
 <td><?php echo htmlspecialchars($r['section']); ?>/<?php echo  htmlspecialchars($r['division']);?>/<?php echo  htmlspecialchars($r['igroup']);?></td>
 <td><?php echo htmlspecialchars($r['datereq']); ?></td>
 <td><?php echo htmlspecialchars($r['datecreated']);?></td>
 <td><?php 
 
$sqlser="SELECT sername FROM `hpcappser` where reqid='$r[reqid]' group by sername";
$sqlser=$dbh->query($sqlser);
$sqlser->setFetchMode(PDO::FETCH_ASSOC);  
$sername='';
 while ($r2 = $sqlser->fetch())
 {
 $sername.=$r2['sername']. ", ";
//echo "$r1['fname']";
}
$sername=rtrim($sername,', ');
echo $sername;
//endwhile;  
 ?> </td>
 
 <td><?php echo htmlspecialchars($r['hpcstat']); ?></td>
 </tr>
 <?php endwhile; ?>
 </tbody>								 												

	<tr><td colspan="9" align="center">  <p>
	  <input  type='submit' name='forward' value='Forward To Section Head ' />
	</td> </tr>
		
</table>


</form>

	
<?php	
	
}

public function userprocess()
{
session_start();
include 'header.php';
include 'lmenu.php';
include 'dbconnect.php';
if (isset($_SESSION['icno_session']))
{
$lname=$_SESSION['icno_session'];
}
if (isset($_SESSION['type_session']))
{
$ltype=$_SESSION['type_session'];
}

if ($ltype=='AS')
{
//echo "coming Inside";
$sql="select * from HPCUSER where HPCSTAT='Request Forwarded'";
//echo $sql;
}
else 
{
echo "Sorry, You are not authorized to view this page. Please Login.";
}


if(isset($_POST['forward']))
{
echo "Coming Inside";
//$f_id=$id;
$cnt=0;

$sno=$_POST['pforward'];
//$aname=$_POST['fileselect'];
//echo $aname;
echo $sno;
//$query = "UPDATE `HPCUSER` SET `hpcstat`='Process Requests' `ASSIGNTO`='$aname' WHERE reqid=:reqid";
//echo $query;
//$up = $dbh->prepare($query);
//$up->bindValue(':reqid',$reqid);
    //$s->bindValue(':sername',$sername);
    //$s->bindValue(':appname',$appname);
//$up->execute();
 //for
} 



?>
<script >

var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
<form action="userprocess" method="post" >

<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor="#00CCFF"><strong>  User Requests    
</td> </tr> </thead>
<tr bgcolor='#888888' height="35px">
    <td width = '10%' >Sl. No. </td>
    <td width = '10%' >IC_No </td>
    <td width = '10%' >Name</td>
    <td width = '10%' >Section/Div/Group</td>
    <td width = '10%' >Requested Date</td>
    	<td width = '10%'>Servers</td>
	
<tbody>
<?php 
$sql1=$dbh->query($sql);
$sql1->setFetchMode(PDO::FETCH_ASSOC);  
while ($r = $sql1->fetch()): 
?> 
<tr>
    <?php 
 
$sqlser="SELECT sername FROM `hpcappser` where reqid='$r[reqid]' group by sername";
$sqlser=$dbh->query($sqlser);
$sqlser->setFetchMode(PDO::FETCH_ASSOC);  
$sername='';
 while ($r2 = $sqlser->fetch())
 {
 $sername.=$r2['sername']. ", "; 
//echo "$r1['fname']";
}
$sername=rtrim($sername,', ');
echo  $sername ;
//endwhile;  
 ?>
 <td ><?php echo htmlspecialchars($r["reqid"]); ?></td>
 <td> <a href="assignadmin?reqid=<?php echo htmlspecialchars($r['reqid']);?>&&uname=<?php echo htmlspecialchars($r['user_name']);?>"> <?php echo htmlspecialchars($r['icno']); ?>  </a>  </td> 
 <td><?php echo htmlspecialchars($r['user_name']); ?></td>
 <td><?php echo htmlspecialchars($r['section']); ?>/<?php echo  htmlspecialchars($r['division']);?>/<?php echo  htmlspecialchars($r['igroup']);?></td>
 <td><?php echo htmlspecialchars($r['datereq']); ?></td>
 <td><?php echo  $sername ; ?></td> 
 

 </tr>
 <?php endwhile; ?>
 </tbody>								 												
	
		
</table>


</form>

	
	
	
	
}



public function usersearch()
{
	<?php
//echo $lname;
$ds=ldap_connect("10.1.2.17");
//echo "connect result is " . $ds . "<br />";
if ($ds) {
    //echo "Binding ...";
    $r=ldap_bind($ds);              
    //echo "Bind result is " . $r . "<br />";
//    echo "Searching for (uid=A*) ...";
    $sr=ldap_search($ds, "dc=igcar,dc=cd", "employeenumber=".$lname, array("uid", "cn", "telephonenumber", "ou", "mail", "employeetype", "host", "iphostnumber"));
    //echo "Search result is " . $sr . "<br />";
    //echo "Number of entries returned is " . ldap_count_entries($ds, $sr) . "<br />";
  $count=ldap_count_entries($ds, $sr);
  if($count>=1)
  {
    //echo "Getting entries ...<p>";
    $info = ldap_get_entries($ds, $sr);
    //echo "Data for " . $info["count"] . " items returned:<p>";
    for ($i=0; $i<$info["count"]; $i++) {
        
	$uid[$count]=$info[$i]["uid"][0];
	$uname[$count]=$info[$i]["cn"][0];
    	$uph[$count]=$info[$i]["telephonenumber"][0];
    	$usec[$count]=$info[$i]["ou"][2];
    	$udiv[$count]=$info[$i]["ou"][1];
	$ugrp[$count]=$info[$i]["ou"][0];
	$umail[$count]=$info[$i]["mail"][0];
	$udes[$count]=$info[$i]["employeetype"][0];
	$uip[$count]=$info[$i]["iphostnumber"][0];
	//echo "no. of hosts is " . $info[$i]["host"]["count"];
	for ($j=0; $j<$info[$i]["host"]["count"]; $j++) {
		if($j == 0)
			$userv[$count]=$info[$i]["host"][$j];
		else
			$userv[$count]=$userv[$count] . "," . $info[$i]["host"][$j];
	}
    }
    //echo "Servers are " . $userv[$count];
  }
  else
  {
    //echo "No entries found";
  }
    //echo "Closing connection";
    ldap_close($ds);

} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
?>



	
	
	
	
}


public function usercreation()
{
	
	<?php
$regid=$_GET['seqno'];
echo "Req id **************" .$regid;
$sql="select * from HPCUSER where REQID='$regid'";
 $records = $dbh->prepare($sql);
 $records-> execute();
 $r=$records->fetch(PDO::FETCH_ASSOC);
if($records->rowCount() > 0)
{
$serusage=htmlspecialchars($r['sername']);
$serusage=  explode(",", $serusage);
echo "*******************" ;
echo count($serusage);
echo $serusage;
}
echo "</tr>  
   <tr  valign ='top' align='left' >
    <td width='18%' height='15'  >IC No. </td>
      <td width='27%' height='15' align='left' ><input name='uicno1' type='text' value='$lname' maxlength='10' readonly /></td>	  
	  <td width='18%' height='15'  > User ID </td>
      <td width='27%' height='15' align='left' ><b>
        <input name='uid' type='text' maxlength='10'  value='$uid[$count]'/>
       </b></td>   
    </tr>
    <tr  valign ='top' align='left' >
	<td height='15' align='left'> Designation</td>
      <td height='15' align='left'><b>
        <input name='des' type='text' maxlength='10' value= '$udes[$count]' readonly/>
        </b></td> 
	   <td width='22%' height='15' > Name </td>
      <td width='33%' height='15' align='left' ><b>
        <input name='name'  id='tnam' type='text' maxlength='30' value='$uname[$count]' readonly />
      </b></td>  
    </tr>
<tr  valign ='top' align='left'>

		<td width='18%' height='15'  > Ip Address </td>
      <td width='27%' height='15' align='left' ><b>
        <input name='ipadd' type='text' maxlength='10'  value='$uip[$count]' readonly/>
       </b></td>
      <td width='18%' height='15'  > Section </td>
      <td width='27%' height='15' align='left'  ><b>
        <input name='sec' type='text' maxlength='10' value='$usec[$count]' readonly />
       </b></td>
    </tr>
    <tr valign ='top' align='center' >
      <td height='15' align='left'> Division </td>
      <td height='15' align='left' ><b>
        <input name='div'  id='tnam3' type='text' maxlength='30' value= '$udiv[$count]' readonly />
      </b></td>
      <td height='15' align='left'> Group </td>
      <td height='15' align='left' ><b>
        <input name='grp'  id='tnam3' type='text' maxlength='30' value='$ugrp[$count]' readonly/>
      </b></td>     
    </tr>
<tr valign ='top' align='center' >
      <td  height='15' align='left'> Phone : </td>
      <td  height='15' align='left' ><b>
        <input name='phone'  id='tnam3' type='text' maxlength='30' value='$uph[$count]' readonly/>
      </b></td>
      <td height='15' align='left'> E-Mail</td>
      <td height='15' align='left'><b>
        <input name='email' type='text' maxlength='30' value='$umail[$count]' readonly/>
        </b></td>
    </tr>
	 <tr valign ='middle' align='left'>
    <td height='23' colspan='4' ><strong>Server Name: $userv[$count]</td> </tr>
     <tr valign ='middle' align='left'>
    <td height='23' colspan='4' ><strong>Name of the server 
<input name='serid[]' type='checkbox' maxlength='30' value='nx0'/> 128 Node cluster
<input name='serid[]' type='checkbox' maxlength='30' value='hn1.hpc.igcar.in'/> 134 Node cluster
<input name='serid[]' type='checkbox' maxlength='30' value='xeonsmp1'/> Xeon SMP server1
<input name='serid[]' type='checkbox' maxlength='30' value='xeonsmp2'/> Xeon SMP server2
<input name='serid[]' type='checkbox' maxlength='30' value='head1.igcar.gov.in'/>400 Node cluster
<input name='serid[]' type='checkbox' maxlength='30' value='GPU Cluster'/> GPU cluster
<input name='serid[]' type='checkbox' maxlength='30' value='Blade Cluster'/> Blade cluster
<input name='serid[]' type='checkbox' maxlength='30' value='Workstation'/> Workstation
</td>
 </tr>
      <tr valign ='middle' align='center'>
 <td align='center' colspan=4 bgcolor='#666666'><i>
  <div  align='center'>
    <input  type='submit' name='cupdate' value='Update' /> 
  </div>
</i></td>
    </tr>	";
	?>
	
	
}
*/


} //class






?>
