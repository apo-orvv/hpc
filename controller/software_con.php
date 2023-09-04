 <?php
require_once("model/software_model.php");
class softwareController {

	private $softwaremodel;
	public function  __construct(){
		$this->softwaremodel=new SoftwareModel();
	}
	
public function viewsoftware()
{ //echo "user Status";
//$softdetail=array();
//echo"hello";
if(isset($_POST['fetch']) )
		{
		$softdetail= $_POST['softdet'];
		//print_r($softdetail);
		
		if($softdetail=="") $softdetail="All"; 
			
	$r1=$this->softwaremodel->softwaredetails($softdetail);
				
		}
		else 
		{ 
$softdetail="All";
$r1=$this->softwaremodel->softwaredetails($softdetail);
//print_r($r1);
 }
 
include "view/softwaredetails.php";
	}

	

	
public function editsoftwares()
{ 

if(($_GET[sysname])!="New")
{
$sname=$_GET[softname];

$r1=$this->softwaremodel->fetchsoftware($sname);	
//print_r($r1);
}

if(isset($_POST['savesw']) )
			{
			$data[sname]= filter_input(INPUT_POST,'element_1',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[stype]= $_POST['element_12'];
			$data[installedon]= filter_input(INPUT_POST,'element_2',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[swusage]= filter_input(INPUT_POST,'element_3',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[procuredby]= filter_input(INPUT_POST,'element_4',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[installedby]= filter_input(INPUT_POST,'element_5',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[licser]= filter_input(INPUT_POST,'element_6',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[lictype]= filter_input(INPUT_POST,'element_7',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[expdate]= filter_input(INPUT_POST,'element_8',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
						$data[nolic]= filter_input(INPUT_POST,'element_9',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$data[vendor]= filter_input(INPUT_POST,'element_10',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			
			$id=$this->softwaremodel->savesoftware($data);
			if($id!="") 
				echo "<script> window.location.assign('index.php?hpcpage=viewsoftware');</script> "; 
		}
	
include "view/editsoftware.php";
			
	}

}
?>