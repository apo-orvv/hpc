<?php
session_start(); 
include 'header.php';
include 'lmenu.php';
include 'dbconnect.php';
include 'authenticate.php';

if(isset($_POST['submit']))
{
 $errMsg = '';
 
 $username = trim($_POST['username']); //username and password sent from Form
 $password = trim($_POST['password']);
 
 if($username == ''){
 $errMsg .= 'Enter your Username<br>';}
 
 if($password == ''){
 $errMsg .= 'Enter your Password<br>';}
 
if($errMsg == '')
{
    
    echo "coming inside";
//$query="SELECT * FROM HPCMEMBERS WHERE ICNO= :uname AND MEMPASSWD= :upass";
 //$records = $dbh->prepare($query);
 //$records-> execute(array(':uname'=>$username,':upass'=>$password));
 //$userRow=$records->fetch(PDO::FETCH_ASSOC);
//			if($records->rowCount() > 0)
$uname = '';
$ic = '';
			if(authenticate($username,$password,$uname,$ic))
			    {
                            //echo "coming inside";
              			//$_SESSION['user_session'] = $userRow['ICNO'];
//                             $_SESSION['user_session'] = $userRow['MEMNAME'];
//                             $_SESSION['icno_session'] = $userRow['ICNO'];
			       $_SESSION['user_session'] = $uname;
			       $_SESSION['icno_session'] = $ic;
			       //$_SESSION['type_session'] = 'A';
//                             $_SESSION['type_session'] = $userRow['MEMTYPE'];
//			       $_SESSION['userid_session'] = $username;
                              // echo "Ic no. ". $ic;
                            $query="SELECT * FROM HPCMEMBERS_2015 WHERE ICNO= :ic ";
                            $records = $dbh->prepare($query);
                            $records-> execute(array(':ic'=>$ic));
                            $userRow=$records->fetch(PDO::FETCH_ASSOC);
			    if($records->rowCount() > 0)
                                { $_SESSION['type_session'] = $userRow['MEMTYPE']; }
                                
                                else { $_SESSION['type_session'] = 'U'; }
                                
                        }
			elseif(!(authenticate($username,$password,$uname,$ic))) 
				{
                            $query="SELECT * FROM HPCMEMBERS_2015 WHERE ICNO= :uname AND MEMPASSWD= :upass";
                            $records = $dbh->prepare($query);
                            $records-> execute(array(':uname'=>$username,':upass'=>$password));
                            $userRow=$records->fetch(PDO::FETCH_ASSOC);
			if($records->rowCount() > 0)
                            { $_SESSION['user_session'] = $userRow['ICNO'];
                            
                           $_SESSION['user_session'] = $userRow['MEMNAME'];
                            $_SESSION['name_session'] = $userRow['ICNO'];
                            $_SESSION['type_session'] = $userRow['MEMTYPE'];}
                                    
} 
else {
					$errMsg .= 'Your Username is not found in the HPC users database <br>';
				       
}
                if($_SESSION['type_session'] =='A')
				{
                                			
				echo "<script> window.location.assign('dashboard.php'); </script>";
				}
				if($_SESSION['type_session'] =='AS')
				{
                                			
				echo "<script> window.location.assign('dashboard.php'); </script>";
				}
                
				if($_SESSION['type_session'] =='AD')
				{
                                			
				echo "<script> window.location.assign('dashboard.php'); </script>";
				}
                
				if($_SESSION['type_session'] =='AI')
				{
                                			
				echo "<script> window.location.assign('dashboard.php'); </script>";
				}
 
				if($_SESSION['type_session'] =='O')
				{
                    
				echo "<script> window.location.assign('dashboard.php'); </script>";
				}

				if($_SESSION['type_session'] =='U')
				{
				echo "<script> window.location.assign('hpcfeedback.php'); </script>";
				}	                          
			
}
  }
?>
 <div align="center">
 <div style="width:300px; border: solid 1px #006D9C; " align="left">
 
<?php
 if(isset($errMsg)){
 echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>';
 }
 ?>

 <div style="background-color:#006D9C; color:#FFFFFF; padding:3px;"><b>Login</b></div>
 <div style="margin:30px">

 <form action="login" method="post">
 <label>Username  :</label><input type="text" name="username" class="box"/><br /><br />
 <label>Password  :</label><input type="password" name="password" class="box" /><br/><br />
 <input type="submit" name='submit' value="Submit" class='submit'/><br />
<label><i> Please enter HPC username and password </i> </label><br/>
 </form>

 </div>
 </div>
 </div> 


