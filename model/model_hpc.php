<?php



/*
require_once("model/model_hpc.php");

class Model
{
public function _construct()
{
}

public function login_func()
{
if(isset($_POST['submit']))
{	
$errMsg = '';
 
 $username = trim($_POST['username']); //username and password sent from Form
 $password = trim($_POST['password']);
 
 if($username == ''){
 $errMsg .= 'Enter your Username<br>';}
 
 else if($password == ''){
 $errMsg .= 'Enter your Password<br>';}

else
{
if(username!='jaideep')
errMsg='User Not existing';
else
{
if(password!='10002')
errMsg='Invalid Password';
else
errMsg='Successful login';	
}

	*/

//$uname = '';
//$ic = '';
			/*if(authenticate($username,$password,$uname,$ic))
			    {
                           
			       $_SESSION['user_session'] = $uname;
			       $_SESSION['icno_session'] = $ic;
			       
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
                                			
				errMsg.='<script> window.location.assign('dashboard.php'); </script>';
				}
				if($_SESSION['type_session'] =='AS')
				{
                                			
				errMsg.='<script> window.location.assign('dashboard.php'); </script>';
				}
                
				if($_SESSION['type_session'] =='AD')
				{
                                			
				errMsg.='<script> window.location.assign('dashboard.php'); </script>';
				}


				if($_SESSION['type_session'] =='O')
				{
                    
				errMsg.='<script> window.location.assign('dashboard.php'); </script>';
				}

				if($_SESSION['type_session'] =='U')
				{
				errMsg.='<script> window.location.assign('hpcfeedback.php'); </script>';
				}	                          
*/
/*
}	
}	
 return errMsg;
 } 
}*/

require_once("model/model_hpc.php");
class Model{

public function _construct()
{

}
/*
function authenticate($username,$password,&$uname,&$ic)
{
 $adServer = "10.20.2.17";
	
    $ldap = ldap_connect($adServer);
//    $username = $_POST['username'];
//    $password = $_POST['password'];

    $ldaprdn = 'uid='. $username.',ou=People,dc=igcar,dc=cd';

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);
// $bind = @ldap_bind($ldap);
    if ($bind) {
        $filter="(uid=$username)";
        $result = ldap_search($ldap,"dc=igcar,dc=cd",$filter);
//        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
            echo "<p>You are accessing <strong> ". $info[$i]["uid"][0] .", " . $info[$i]["cn"][0] ."</strong><br /> (" . $info[$i]["employeenumber"][0] .")</p>\n";
            echo '<pre>';
//            var_dump($info);
            echo '</pre>';
            $userDn = $info[$i]["dn"][0];
            $uname = $info[$i]["cn"][0];
            $ic = $info[$i]["employeenumber"][0]; 
        }
        @ldap_close($ldap);
        return true;
    } else {
        //$msg = "Invalid username / password";
        //echo $msg;
        return false;
    }
}
*/

public function login_func(&$err_msg)
{
include 'dbconnect.php';
include 'authenticate.php';

if(isset($_POST['submit']))
{	

 
 $username = $_POST['username']; //username and password sent from Form
 $password = $_POST['password'];
 
 if($username == ''){
$err_msg='login';	 
 return 'Enter your Username<br>';}
 
 else if($password == ''){
 $err_msg='login';
 return 'Enter your Password<br>';}

else
{
//if($username!='jaideep')
//return 'User Not existing';
//else
//{
//if($password!='10002')
//return 'Invalid Password';
//else
//{

$uname = '';
$ic = '';

/*
$hpchost="localhost";
//$hpcdbuser="root";
//$hpcdbpasswd="root123";
$hpcdbuser="hpcweb";
$hpcdbpasswd="web@hpc";
$hpcdb="hpcweb";

$dbh = new PDO("mysql:host=$hpchost;dbname=$hpcdb", $hpcdbuser, $hpcdbpasswd);
$dbh->exec("SET CHARACTER SET utf8");

*/

echo "before ldap <br>";
if(authenticate($username,$password,$uname,$ic)!=FALSE)
			    {
                        echo "after ldap <br>";   
			       $_SESSION['user_session'] = $uname;
			       $_SESSION['icno_session'] = $ic;
			       
                            $query="SELECT * FROM HPCMEMBERS_2015 WHERE ICNO= :ic ";
                            $records = $dbh->prepare($query);
                            $records-> execute(array(':ic'=>$ic));
                            $userRow=$records->fetch(PDO::FETCH_ASSOC);
			    if($records->rowCount() > 0)
                                { $_SESSION['type_session'] = $userRow['MEMTYPE']; }
                                
                                else { $_SESSION['type_session'] = 'U'; }
                                
                        }
			else 
				{
					echo "after ldap1 <br>".$username." AND ".$password;
                            $query="SELECT * FROM HPCMEMBERS_2015 WHERE ICNO=".$username." AND MEMPASSWD='".$password."'";
                            $records = $dbh->prepare($query);
                            $records-> execute(array(':uname'=>$username,':upass'=>$password));
                            $userRow=$records->fetch(PDO::FETCH_ASSOC);
							echo "after ldap12 <br>";
			if($records->rowCount() > 0)
                            { 
						echo "after ldap13 <br>";
						$_SESSION['user_session'] = $userRow['ICNO'];
                            
                           $_SESSION['user_session'] = $userRow['MEMNAME'];
                            $_SESSION['name_session'] = $userRow['ICNO'];
                            $_SESSION['type_session'] = $userRow['MEMTYPE'];}
							
                                    
 
else {
	echo "after ldap2 <br>";
	                $err_msg='login';
					return 'Your Username is not found in the HPC users database <br>';
				       
}
}

if($_SESSION['type_session'] =='A')
				{
					echo "after ldap3 <br>";
                $err_msg='afterlogin';                			
				return "<script> window.location.assign('dashboard.php'); </script>";
				}
				if($_SESSION['type_session'] =='AS')
				{
					echo "after ldap4 <br>";
                $err_msg='afterlogin';                			
				return "<script> window.location.assign('dashboard.php'); </script>";
				}
                
				if($_SESSION['type_session'] =='AD')
				{
					echo "after ldap5 <br>";
                $err_msg='afterlogin';                			
				return "<script> window.location.assign('dashboard.php'); </script>";
				}


				if($_SESSION['type_session'] =='O')
				{
					echo "after ldap6 <br>";
                 $err_msg='afterlogin';   
				return "<script> window.location.assign('dashboard.php'); </script>";
				}

				if($_SESSION['type_session'] =='U')
				{
					echo "after ldap7 <br>";
				$err_msg='afterlogin';	
				return "<script> window.location.assign('hpcfeedback.php'); </script>";
				}	                          



//return "success";
}	
}
}


}
//return errMsg;
//}

//}

?>
