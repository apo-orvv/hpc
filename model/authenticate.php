<?php
require_once("hpcsession.php");
function ldapauthenticate($username,$password)
{
 ###$adServer = "10.20.2.16";
 #$adServer = "10.20.2.19"; #modified temporarily: suja 9Feb23
 $adServer = "10.20.2.17"; #modified: molly 2Mar23
	
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
           // echo "<p>You are accessing <strong> ". $info[$i]["uid"][0] .", " . $info[$i]["cn"][0] ."</strong><br /> (" . $info[$i]["employeenumber"][0] .")</p>\n";
          //  echo '<pre>';
//            var_dump($info);
          //  echo '</pre>';
            $userDn = $info[$i]["dn"][0];
            $uname = $info[$i]["cn"][0];
            $ic = $info[$i]["employeenumber"][0]; 
	    $email = $info[$i]["mail"][0];
	    $hpcsession = new HPCSession($username,'U',$uname,$ic,$email);
        }
        @ldap_close($ldap);
        //return true;
	return $hpcsession;
    } else {
        //$msg = "Invalid username / password";
        //echo $msg;
        return false;
    }
}?>
