<?php

require_once 'dbclass.php';
class RTCLogModel {
    
    public function __construct() {
      
    }
    
    public function getTemp($selectedDate){
        
        echo 'from log model <br>';
        echo $selectedDate;
        
        $db = new Db();
	
$dbh=$db->getInstance("hpcweb");
        $sql = "SELECT * FROM rtclog where date='$selectedDate'"; 
		
        $sql=$dbh->query($sql);
        $sql=$sql->fetchall();
	
        return $sql;     
                
    }
    
    public function getLog($x, $selectedDate){
                      
        $db = new Db();
		$dbh=$db->getInstance("hpcweb");
       
        $sql1 = "SELECT * FROM rtc_remark where shift='$x' and date='$selectedDate'";
        $sql1=$dbh->query($sql1);
        $sql1=$sql1->fetchall();
        return $sql1;
    }
    
    public function insertColumn($H, $today, $col){
                
        if ($col!==", , , , , , , , , , , , , , , , , 10003, 10003, 10003, 10003, 10003, 10003" && $col!== ""){
            
            if($H>=6){
		$time=$H-5;
            }else{
		$time=$H+19;
		}
              
            $db=new Db();
			$dbh=$db->getInstance("hpcweb");
            
            $sql2 = "INSERT INTO rtclog (`logtime`,`date`, `time`, `data`) VALUES ('$H:00 hrs','$today', '$time', '$col')";
            $sql2=$dbh->exec($sql2); 
        
            if(! $sql2 ){
                die('Could not inset data: ' . mysql_error());
            }
            
            if ($sql2){
            //echo "<br>";
            //echo "Log Data inserted successfully";
            }
                
        }

        
        
    }
    
    
    
    public function insertRemark($today, $serverTime, $shift, $remark, $loggedby){     
        if ($remark!=""&&$loggedby!=""){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
		
		$sql3 = "INSERT INTO rtc_remark (`date`,`serverTime`, `shift`, `remark`, `loggedby`) VALUES ('$today','$serverTime', '$shift', '$remark', '$loggedby')";
		$sql3=$dbh->exec($sql3); 

                if(! $sql3 ){
                    die('Could not inset data: ' . mysql_error());
                }


                if ($sql3){
                    //echo "<br>";
                    //echo "Remark Data inserted successfully";
                }
        }

       //echo "<meta http-equiv='refresh' content='0'>";
    }
        
      
    
    
    public function deleteColumn($today, $time){
        
        $db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
        $sql4 = "DELETE FROM rtclog WHERE date='$today' and time=".$time;
        $del = $dbh->exec($sql4); 
        if(!$del){
            die('Could not get data: ' . mysql_error());
        }
        if($del){
            echo '<h3>Deleted successfully</h3>';
            //auto redirect specific url with in 2senconds
            echo '<meta http-equiv="refresh" content="2; URL=index.php?hpcpage=templog">
            <meta name="keywords" content="automatic redirection">';
        }
        
    }
    
    
    public function getColumn($today, $time){
        
        $db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
        $sql5="select * from rtclog where date='$today' and time='$time' "; 
        $sql5=$dbh->query($sql5);
        $sql5=$sql5->fetchall();
        //print_r($sql1);
        return $sql5;
    }
    
    
    public function updateColumn($logtime, $today, $time, $col){
        $db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
        $sql6="select * from rtclog where date='$today' and time='$time' "; 
        $sql6=$dbh->query($sql6);
        $sql6=$sql6->fetchall();     
        
        if(empty($sql6)){
     
            $sql7 = "INSERT INTO rtclog (`logtime`,`date`, `time`, `data`) VALUES ('$logtime:00 hrs','$today', '$time', '$col')";
            $sql7=$dbh->exec($sql7);  
         } else {
            $sql8 = "UPDATE rtclog SET data = '$col' where date= '$today' and time =".$time ; 
            $sql8=$dbh->exec($sql8);
         }    
        echo "hello please wait";    
        echo '<meta http-equiv="refresh" content="2; URL=index.php?hpcpage=templog">
        <meta name="keywords" content="automatic redirection">';
      
    }
    
    
    public function getRemark($fdate2, $tdate2){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
       
		$sql9 = "SELECT * FROM rtc_remark where date between '$fdate2' and '$tdate2' ";
		$sql9=$dbh->query($sql9);
        $sql9=$sql9->fetchall();
		return $sql9;
	}
    
	
	public function getRemarkAll(){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
       
		$sql9 = "SELECT * FROM rtc_remark";
		$sql9=$dbh->query($sql9);
        $sql9=$sql9->fetchall();
		return $sql9;
	}
    public function getRemarkStatus($slno){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
		$sql10 = 'SELECT * FROM rtc_remark_status where slno='.$slno;
		$sql10=$dbh->query($sql10);
        $sql10=$sql10->fetchall();
		return $sql10;
	}
    
    public function remarkSearch($search){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
		$sql11 = "SELECT * FROM rtc_remark WHERE remark LIKE '%$search%' LIMIT 0, 30 ";
		$sql11=$dbh->query($sql11);
        $sql11=$sql11->fetchall();
		return $sql11;

	}
	
	
	public function getRemarkBySlno($slno){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
        
		$sql12 = 'SELECT * FROM rtc_remark where slno ='.$slno ;
		$sql12=$dbh->query($sql12);
        $sql12=$sql12->fetchall();
		return $sql12;
	}
    
    public function updateRemarkStatus($slno, $today, $serverTime, $ushift, $uremark, $status, $actionby){
		$db=new Db();
		$dbh=$db->getInstance("hpcweb");
      
		$sql13 = "INSERT INTO rtc_remark_status (`slno`, `udate`,`utime`, `ushift`, `uremark`, `status`, `actionby`)
		VALUES ('$slno', '$today', '$serverTime', '$ushift', '$uremark', '$status', '$actionby')";
		$sql13=$dbh->exec($sql13);
		
		
if ($sql13 !=="")
{
echo '<script>
alert("The Status is Updated Successfully");
</script>
<meta http-equiv="refresh" content="2; URL=index.php?hpcpage=viewremark">
        <meta name="keywords" content="automatic redirection">';	
}
	
        echo '';
	
	}
        
    
    
    
}
