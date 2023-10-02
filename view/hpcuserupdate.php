<?php 
//session_start();
include 'header.php';
include 'dbconnect.php';
include 'lmenu.php';
include 'webmail.php';
if($_GET['uicno']!='')
{
$lname=$_GET['uicno'];
}
if(isset($_POST['csave']))
{
$lname=  filter_input(INPUT_POST, uicno1);

if($lname!='')
{
$errMsg ='';
if((!empty($_POST['uicno1'])) && (!empty($_POST['name']))&& (!empty($_POST['phone']))&& (!empty($_POST['email'])) && (!empty($_POST['grp'])) && (!empty($_POST['ipadd'])) && (!empty($_POST['serid'])) )
{  
   //echo "coming inside if";
if (!preg_match("/^[a-zA-Z ]*$/",$_POST['name'])) 
     {
   $errMsg .= "Only letters and white space allowed"; 
     }
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	 {
      $errMsg .= "Invalid email format"; 
     } 
if (!preg_match("/^[a-zA-Z ]*$/",$_POST['grp'])) 
     {
      $errMsg = "Only letters allowed"; 
      }
if (!filter_var($_POST['ipadd'], FILTER_VALIDATE_IP))
	   {
    $errMsg .= "Invalid IP Address";
        }
if (!filter_var($_POST['uicno1'], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid IC Number";
     }
if (!filter_var($_POST['phone'], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid Phone Number";
     }
}
if(isset($errMsg))
{
echo '<tr> <div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div> </tr>';
}
if($errMsg=='')
{
include 'useradd.php';
}
}
}
if(isset($_POST['cupdate']))
{
$lname=  filter_input(INPUT_POST, uicno1);
echo $lname;
//include 'usermod.php';
}
?>
<form method='post' action="hpcuserupdate.php" name="myform" id="myform" > 
<table  width='100%' border = "1" align='center' cellpadding='2' cellspacing='0' bgcolor="#FFFFFF"> 

   <tr valign ='top' align='center' >
      <td height="15" colspan="4" valign = "top" bgcolor="#99CCFF" > <strong> HPC users Management </strong> </td>  
   </tr>  
<?php 
if(!empty($_GET['uicno']))
{
$lname=$_GET['uicno'];
$sql="select * from HPCUSERINFO where icno='$lname'";
$sql1=$dbh->query($sql);
include 'usersearch.php';
if ($count>0)
{
$disMsg .= 'User details already available, If necessary Update or delete the user <br>';
if(isset($disMsg))
{
echo '<tr> <div style="color:#FF0000;text-align:center;font-size:12px;">'.$disMsg.'</div> </tr>';
}
include 'userdetail.php';
//include 'useradmindetail.php';
}
else
{
$disMsg .= 'New User Request, Kindly check the details before adding into server<br>';
if(isset($disMsg))
{
echo '<tr> <div style="color:#FF0000;text-align:center;font-size:12px;">'.$disMsg.'</div> </tr>';
}
if($_GET['seqno']!='')
{
$regid=$_GET['seqno'];
include 'newreqdetail.php';
}
}
}
?>

</table>  
</form>





