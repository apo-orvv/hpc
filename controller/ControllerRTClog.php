<?php
require_once("model/RTCLogModel.php");
class ControllerRTClog {
    public $logmodel;
    
    public function __construct() {
       $this->logmodel=new RTCLogModel();
    }
   
    public function templog(){
		
		echo "************Coming inside";
        require_once 'view/others/serverTime.php';
        require_once 'view/others/formdate.php';
        
         if (isset($_POST["submit"])){
            
            $remark=$col="";
            if (isset($_POST["col"])){
               $col=implode(", ",$_POST["col"]);
               $this->logmodel->insertColumn($H, $today, $col);
            }
            if (isset($_POST["remark"])){
                $remark=$_POST["remark"];
                $loggedby=$_POST["loggedby"];
                $shift=$_POST["shift"];
                $this->logmodel->insertRemark($today, $serverTime, $shift, $remark, $loggedby);
            } 
        }   
        $sql=$this->logmodel->getTemp($selectedDate);
        $rows=count($sql);
		echo "Count **********".$rows;
            //set empty value
        for ($x=1;$x<=24;$x++){
            ${'data'.$x}="";
            ${'time'.$x}="";
        }
              
        for ($y=0;$y<$rows;$y++){
	
            for($x=1;$x<=24;$x++){
		
		if($sql[$y][2]==$x){
			${'time'.$x}=$sql[$y][2];
			${"data".$x}=explode(", ",$sql[$y][3]);
		}
            }
	
	}     
        for ($x=1;$x<=3;$x++){
         ${"remark".$x}=$this->logmodel->getLog($x, $selectedDate);
         ${"rows".$x}=count(${"remark".$x});
        }  
		
        include 'view/RTClogview.php'; 
          
    }
    
    public function modify(){
        include "view/RTCmodifyview.php";
        $today=date('Y-m-d');
        $action=$time="";
        if (isset($_REQUEST['submit'])) {
	$time = $_REQUEST['time'];
        $action = $_REQUEST['action'];
        }
        
        if($action=="del" && $time!=""){
            $this->logmodel->deleteColumn($today, $time);
        }
               
        
    }
    
    public function modifyData(){
        $today=date('Y-m-d');
        $action=$time="";
        if (isset($_REQUEST['submit'])) {
	$time = $_REQUEST['time'];
        $action = $_REQUEST['action'];
        }
        
        if($action=="mod" && $time!=""){
           $sql=$this->logmodel->getColumn($today, $time);
           include "view/RTCmodifydataview.php";
          }
          
          
          if (isset($_POST["submit"])) {
            $time = $_POST["time"];
            $col = implode(", ",$_POST["col"]);  
            if ($time<19){
            $logtime=$time+5;
            }else{
            $logtime=$time-19;
            } 
            $this->logmodel->updateColumn($logtime, $today, $time, $col);         
             
          }
        
        
    }

    
	
	public function viewRemark(){
		
	require_once 'view/others/formremark.php';
		if ($search!==""){
			$sql9=$this->logmodel->remarkSearch($search);
		}
		else {
			//$sql9=$this->logmodel->getRemark($fdate2, $tdate2);
			$sql9=$this->logmodel->getRemarkAll();
		}
		if($_GET[fdate] && $_GET[tdate])
		{
			$sql9=$this->logmodel->getRemark($fdate2, $tdate2);
		}
		else { $sql9=$this->logmodel->getRemarkAll();}
        $rows=count($sql9);
		include 'view/RTCremarkview.php';
		
		
	}
    
	public function editRemark(){
		$slno = $_GET['slno'];
		$sql12=$this->logmodel->getRemarkBySlno($slno);
		$count=count($sql12);
		include 'view/RTCremarkupdate.php';
		
	}
	
	public function updateRemark(){
		require_once 'view/others/serverTime.php';
		$today=date("Y-m-d");
		// define variables and set to empty values
		$ushift = $uremark = $status = $actionby = "";
		//asign values for variables
		if ($_SERVER["REQUEST_METHOD"] == "GET") {
			$slno=$_GET["slno"];	  
			$ushift=$_GET["ushift"];
			$uremark=$_GET["uremark"];
			$status=$_GET["status"];
			$actionby=$_GET["actionby"];
			$sql13=$this->logmodel->updateRemarkStatus($slno, $today, $serverTime, $ushift, $uremark, $status, $actionby);
		}
		
	}
	
	public function viewRemarkHistory(){
		$slno = $_GET['slno'];
		$sql14=$this->logmodel->getRemarkBySlno($slno);
		$count1=count($sql14);
		$sql15=$this->logmodel->getRemarkStatus($slno);
		$count2=count($sql15);
		include 'view/RTCremarkhistory.php';
		
	}

	public function chartView(){
		
		
		$value = $_GET['value'];
		$date = $_GET['date'];
		$selectedDate=date_create("$date");     
		$selectedDate=date_format($selectedDate,"Y-m-d");
		echo $value.' '.$date.' '.$selectedDate;
		
		$sql=$this->logmodel->getTemp($selectedDate);
	
        $rows=count($sql);
		//echo $sql[1][3];
		  
        //set empty value
        for ($x=1;$x<=24;$x++){
            ${'data'.$x}=array("","","","","","","","","","","","","","","","","","","");
            ${'time'.$x}="";
        }
        
        
        for ($y=0;$y<$rows;$y++){
	
            for($x=1;$x<=24;$x++){
		
				if($sql[$y][2]==$x){
					${'time'.$x}=$sql[$y][2];
					${"data".$x}=explode(", ",$sql[$y][3]);
				}
            }
		}
		require_once 'others/charttitle.php';
		if($value=='all'){
			echo "all temp";
			include 'view/RTCalltemp.php';
		}else{
			include 'view/RTCchartview.php';
		}
		
	}

}
