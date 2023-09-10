<?php
require_once("model/print_model.php");  
  
class print_con
{
public $printmodel;

public function __construct()
{
    $this->printmodel=new print_model();
    //$this->printreq();
}

public function printreq()
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 0) {
				$errMsg .="The uploaded file exceeds the maximum allowed file size (50MB)";
    }

if(isset($_POST['save'])) 
{
$data[c_date] = date ("Y-m-d");
$data[status] = 'print_requested';
$data[name]=$_POST['lastname'];
$data[icno]=$_POST['icno'];
$data[phone]=$_POST['phone'];
$data[desi]=$_POST['des'];
$data[email]=$_POST['email'];
$data[pur]=$_POST['purpose'];
$data[div]=$_POST['div'];
$errMsg='';
if((!empty($_POST['icno'])) && (!empty($_POST['lastname']))&& (!empty($_POST['phone'])))
{  
   if (!preg_match("/^[a-zA-Z ]*$/",$name)) 
     {
   $errMsg .= "Only letters and white space allowed"; 
     }
    if (($data[email]!="") &&  (!filter_var($data[email], FILTER_VALIDATE_EMAIL)))
	 {
      $errMsg .= "Invalid email format"; 
     } 
  if (!filter_var($data[icno], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid IC Number";
     }
if (!filter_var($data[phone], FILTER_VALIDATE_INT))
    {
    $errMsg .= "Invalid Phone Number";
     }
}//if 

if($errMsg=='')
{
try
{
$id=  $this->printmodel->print_req($data);
if($id!=0)
{
$data[f_id]=$id;
$cnt=0;
foreach($_FILES['uploaded_file']['name'] as $key => $value)
{ 
$cnt=$cnt+1;
$filerr=0;
if (($_FILES['uploaded_file']['error'][$key]==0))
  {
   $data[fname] = $_FILES['uploaded_file']['name'][$key];
   $tmpName  = $_FILES['uploaded_file']['tmp_name'][$key];
   $pic = $data[f_id]."_".$cnt."_".$data[fname];
   $data[uploadfname]="uploads/$pic";
   $data[size]=filesize($tmpName);
   		    $data[mime] = $_FILES['uploaded_file']['type'][$key];
   			$ext_str = "gif,jpg,jpeg,JPG,JPEG,bmp,doc,docx,ppt,pptx,txt,pdf";
   			$allowed_extensions=explode(',',$ext_str);
     		$ext = substr($data[fname], strrpos($data[fname], '.') + 1); //get file extension from last sub string from last . character
			if (!in_array($ext, $allowed_extensions))
			{
			$filerr=1;
			}
		$fp = fopen($tmpName, 'r');
$data[papertype]= $_POST['papertype'][$key];
$data[papersize]= $_POST['papersize'][$key];
$data[nprint]= $_POST['nprint'][$key];
$data[cus]=$_POST['cus1'][$key];
if($data[papersize]=="Custom")
{
$data[papersize]= $data[papersize].":-".$data[cus];
 } 
$data[datecre]= date ("Y-m-d");
if($filerr==0)
{

if(move_uploaded_file($tmpName,$data[uploadfname]))
    {
   $id1=$this->printmodel->insert_file($data);
//$id1=10;
if($id1!="")
{
echo "<script> alert('Print Requested successfully. Take a print and submit through proper channel');</script>";
$_SESSION['reqid'] = $data[f_id];
echo "<script> window.location.assign('index.php?hpcpage=printreqprint');</script> "; 
}  
else { $errMsg .= "File details not Inserted"; echo $errMsg;}
}
        else
        {
            echo "<script> alert('error while uploading file'); </script>";
			$upfile=0;
        } 
} //file err

else { $errMsg .= "Files Cannot be Uploaded. only".$ext_str." files allowed to upload"; }

} //if

else { echo "<script> alert('File not uploaded. Print Requested with out uploading the file. Take a print and submit through proper channel');</script>";
$_SESSION['reqid'] = $data[f_id];
echo "<script> window.location.assign('index.php?hpcpage=printreqprint');</script> ";} 
} //for
} //if 

} //try
catch (PDOException $e)
  {
    echo 'Database error storing file!';
  }
} //if not error
} //isset 
include "view/printreq.php";
} //controller function

public function printstat()
{ //echo "print Status";
$r1=$this->printmodel->printstat();
include "view/printstat.php";
}

public function printforward()
{ //echo "print forward"; 

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
$id2 =$this->printmodel->printupdateforward($reqid);
} //for

if($id2!="")
{
echo "forwarded sucessfully";
}
}
else
{
$r1=$this->printmodel->printforward();
include "view/printforward.php";
}
}


public function printtake()
{ //echo "print Status";
if(isset($_POST['save'])) 
{
$data[c_date] = date ("Y-m-d");
$data[status] = 'Print_Completed';
//$data[varup]=$_POST['varup'];
$data[varup]=filter_input(INPUT_POST,'varup',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
if($_POST['varup']!='')
{
	$r2=$this->printmodel->printupdate($data);
	
	if($r2!="")
	{
		echo"<script> alert('Print status updated successfully'); </script>";
		$r1=$this->printmodel->printtake();
include "view/printtake.php";
	}
}
}
else {
	
$r1=$this->printmodel->printtake();
include "view/printtake.php";
}
}

public function printreport()
{ //echo "print Status";
$r1=$this->printmodel->printreport();
include "view/printreport.php";
}


public function printreqprint()
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
$r=$this->printmodel->printreqprint($regid);
include "view/printreqprint.php"; 
} //function 


} //class


?>
