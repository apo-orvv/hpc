<?php
//require_once('model/clus_search.php');
    $db=new stdclass();
    $ic = $_REQUEST["icno"];
    $unit = $_REQUEST["unit"];
    $group = "";
    $subgrp = "";
    $div = "";
    $sec = "";
    $clusgrp = "";
    
    $ic = ltrim($ic,"0");
    
    
    ////////////////////Retrieve details from Global LDAP///////////////
    if($unit=='IGCAR')
    {
    $db->icno=$ic;
    $db->unit=$unit;
    //$db->icno='5410';//'7990';//'10207';//'10732';
    $jsn = json_encode($db);
    //$url = "http://10.30.1.18/login/emp/".base64_encode($jsn);
    $url = "http://10.30.1.71/auth/login/emp/".base64_encode($jsn);
    $user_data_all = file_get_contents($url);
    $uad = json_decode($user_data_all);
    ////echo $user_data_all;
    $user_data_p = trim(stripslashes($user_data_all),"{}");
    ////echo str_replace(":","=>",$user_data_p);
    ////$user_data_p=str_replace(":","=>",$user_data_p);
    //echo '<br>';
    //echo $user_data_p;
    ////$user_data = array($user_data_p);
    $records = explode(',', $user_data_p);
    //echo count($records);
    $user_data = [];
    $keys = [];
    $values = [];
    for($i=0; $i<count($records); $i++) {
        $rec = explode(':', $records[$i]);
        $keys[$i] = trim($rec[0],"\"");
        $values[$i] = trim($rec[1],"\"");
        //echo '<br>';
        //echo $keys[$i];
        //echo $values[$i];
    }
    $user_data = array_combine($keys, $values);
    $org = explode('/', $user_data["org"]);
    if(count($org)==5)
    {
        $group = $org[1];
        $subgrp = $org[2];
        $div = $org[3];
        $sec = $org[4];
    }
    else {
        if(count($org)>=2)
        {
            if(substr($org[1],-1)=='G')
            {
                $group = $org[1];
                if(count($org)>=3)
                {
                    if(substr($org[2],-1)=='G')
                    {
                        $subgrp = $org[2];
                        if(count($org)==4)
                        {
                            if(substr($org[3],-1)=='D')
                                $div = $org[3];
                            else if(substr($org[3],-1)=='S')
                                $sec = $org[3];
                        }
                    }
                    else if(substr($org[2],-1)=='D')
                    {
                        $div = $org[2];
                        if(count($org)==4)// && substr($org[3],-1)=='S')
                        {
                            $sec = $org[3];
                        }
                    }
                    else if(substr($org[2],-1)=='S')
                        $sec = $org[2];
                }
            }
            
        }
    }
    }
    else if($unit=='BARCF')
        $group='BARCF';
    else if($unit=='BHAVINI')
        $group='BHAVINI';
    else if($unit=='SRI')
        $group='SRI';
    ////////////////////Retrieve details from Global LDAP - close///////////////
    
    
    
    ////////////////////Determine cluster group///////////////
    if($unit=='IGCAR')
    {
        if($group=='EIG')
            $clusgrp='eig';
        else if($group=='ESG')
            $clusgrp='esg';
        else if($group=='MCMFCG')
            $clusgrp='cg';
        else if($group=='MSG')
            $clusgrp='msg';
        else if($group=='MMG')
            $clusgrp='mmg';
        else if($group=='RPG')
            $clusgrp='rpg';
        else if($group=='RFG')
            $clusgrp='romg';
        else if(($group=='SQRMG') && ($subgrp=='HSEG' || $subgrp=='RESG'))
            $clusgrp='rseg';
        else if(($group=='SQRMG') && ($div=='PHRMD' || $div=='SIRD' || $div=='IC' || $div=='LP'))
            $clusgrp='rmg';
        else if(($group=='RDTG') && ($subgrp=='SFG'))
            $clusgrp='frtg';
        else if(($group=='RDTG') && ($subgrp=='NSDG'))
            $clusgrp='rdg';
        else if(($group=='RDTG') && ($div=='PPCD' || $div=='SMD' || $div=='THD'))
            $clusgrp='rdg';
        else if(($group=='RDTG') && ($div=='ETHD' || $div=='RMIED' || $div=='SEHD'))
            $clusgrp='frtg';
    }
    else if($unit=='BARCF')
        $clusgrp='barcf';
    else if($unit=='BHAVINI')
        $clusgrp='bhavini';
    else if($unit=='SRI')
        $clusgrp='sri';
    ////////////////////Determine cluster group - close///////////////
    
    
    
    ////////////////////HPC LDAP search///////////////
    $servers="";
    $loginname="";
    $ipaddr="";
    $hosts="";
    $ds=ldap_connect("10.1.2.17");
    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
    //echo "connect result is " . $ds . "<br />";
    if ($ds) {
        //echo "Binding ...";
        $r=ldap_bind($ds);
        //echo "Bind result is " . $r . "<br />";
        //    echo "Searching for (uid=A*) ...";
    
        $sr=ldap_search($ds, "dc=igcar,dc=cd", "employeenumber=".$ic, array("uid", "cn", "telephonenumber", "ou", "mail", "employeetype", "iphostnumber", "homedirectory","host"));
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
                $uipaddr[$count]=$info[$i]["iphostnumber"][0];
                $uhome[$count]=$info[$i]["homedirectory"][0];
                //echo "no. of hosts is " . $info[$i]["host"]["count"];
                for ($j=0; $j<$info[$i]["host"]["count"]; $j++) {
                    if($j == 0)
                        $userv[$count]=$info[$i]["host"][$j];
                    else
			$userv[$count]=$userv[$count] . ";" . $info[$i]["host"][$j];
                }
            }
            if(($unit=='IGCAR' && ($ugrp[$count]=='eig' || $ugrp[$count]=='esg' || $ugrp[$count]=='cg' || $ugrp[$count]=='msg' || $ugrp[$count]=='mmg' || $ugrp[$count]=='rpg' || $ugrp[$count]=='rmg' || $ugrp[$count]=='rseg' || $ugrp[$count]=='romg' || $ugrp[$count]=='frtg' || $ugrp[$count]=='rdg' || $ugrp[$count]=='frfcf')) || ($unit=='BARCF' && $ugrp[$count]=='barcf') || ($unit=='BHAVINI' && $ugrp[$count]=='bhavini') || ($unit=='SRI' && $ugrp[$count]=='sri'))
            {
                $loginname=$uid[$count];
                $ipaddr=$uipaddr[$count];
                $homedir=$uhome[$count];
                //echo "Servers are " . $userv[$count];
                $hosts=$userv[$count];
                if ((strpos($hosts, 'head1') !== false) || (strpos($hosts, 'head2') !== false))
                {
                    $servers=$servers . "IVY;";
                }
                if ((strpos($hosts, 'hn1') !== false) || (strpos($hosts, 'hn2') !== false))
                {
                    $servers=$servers . "Neha;";
                }
                if ((strpos($hosts, 'xeonsmp1') !== false) || (strpos($hosts, 'xeonsmp2') !== false))
                {
                    $servers=$servers . "XeonSMP;";
                }
                $servers=  trim($servers, ';');
            }
        }
        else
        {
            //echo "No entries found";
            //      return false;
        }
        //echo "Closing connection";
        ldap_close($ds);
    }
    else {
    //echo "<h4>Unable to connect to LDAP server</h4>";
    //return false;
    }
    ////////////////////HPC LDAP search - close///////////////
    
    
    
    ////////////////////WS AD search///////////////
    //$servers="";
    $ad_loginname="";
    $ad_details="";
    $ds1=ldap_connect("10.20.3.62");
    ldap_set_option($ds1, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ds1, LDAP_OPT_REFERRALS, 0);
    $mesg = "connect result is " . $ds1;// . "<br />";
    if ($ds1) {
        $r1=ldap_bind($ds1, "CN=Administrator,CN=Users,DC=GWS,DC=GOV,DC=IN", "gwsdomain@2019");
        $mesg = "Bind result is " . $r1;// . "<br />";
        //$email = "arjun@igcar.gov.in";
        //$ad_cn = "Arjun";
        //$ad_ic = "6837";
            
        //$sr1=ldap_search($ds1, "ou=WS,dc=GWS,dc=GOV,dc=IN", "employeenumber=".$ic, array("uid", "cn", "telephonenumber", "ou", "mail", "employeetype", "iphostnumber", "host"));
        $sr1=ldap_search($ds1, "OU=WS,DC=GWS,DC=GOV,DC=IN", "(&(ou=".$unit.")(employeenumber=".$ic."))", array("cn", "telephonenumber", "mail", "samaccountname", "userprincipalname", "employeetype"));
        //echo "Search result is " . $sr . "<br />";
        $mesg = "Search result is " . $sr1;// . "<br />";
        //echo "Number of entries returned is " . ldap_count_entries($ds, $sr) . "<br />";
        $mesg = "Number of entries returned is " . ldap_count_entries($ds1, $sr1);// . "<br />";

        $count=ldap_count_entries($ds1, $sr1);
        if($count>=1)
        {
            //echo "Getting entries ...<p>";
            $info = ldap_get_entries($ds1, $sr1);
            //echo "Data for " . $info["count"] . " items returned:<p>";

            for ($i=0; $i<$info["count"]; $i++) {
                
                //$uid[$count]=$info[$i]["uid"][0];
                $uname[$count]=$info[$i]["cn"][0];
                $uph[$count]=$info[$i]["telephonenumber"][0];
                $ulogin[$count]=$info[$i]["samaccountname"][0];
                //$usec[$count]=$info[$i]["ou"][2];
                //$udiv[$count]=$info[$i]["ou"][1];
                //$ugrp[$count]=$info[$i]["ou"][0];
                $umail[$count]=$info[$i]["mail"][0];
                $udes[$count]=$info[$i]["employeetype"][0];
                //$uipaddr[$count]=$info[$i]["iphostnumber"][0];
                //echo "no. of hosts is " . $info[$i]["host"]["count"];
                /*for ($j=0; $j<$info[$i]["host"]["count"]; $j++) {
                    if($j == 0)
                        $userv[$count]=$info[$i]["host"][$j];
                    else
			$userv[$count]=$userv[$count] . ";" . $info[$i]["host"][$j];
                }*/
            }
            $ad_loginname=$ulogin[$count];
            $ad_details=$uname[$count].$udes[$count].$uph[$count].$umail[$count];
            $servers=$servers.";Workstation";
	    $servers=  trim($servers, ';');
        }
        ldap_close($ds1);
    }
    ////////////////////WS AD search - close///////////////
    
    
    if($user_data["name"]=="null")
        $user_data["name"]="";
    //$servers=clussearch($ic);
    //echo '<br>';
    //echo $user_data["icno"] . "," . $user_data["name"] . "," . $user_data["idesig"] . "," . strtoupper($group) . "," . strtoupper($subgrp) . "," . strtoupper($div) . "," . strtoupper($sec) . "," . $user_data["intercom1"] . "," . $user_data["igemail"] . "," . $servers . "," . $clusgrp . "," . $loginname . "," . $ipaddr;
    echo $user_data["icno"] . "," . $user_data["name"] . "," . $user_data["desig"] . "," . strtoupper($group) . "," . strtoupper($subgrp) . "," . strtoupper($div) . "," . strtoupper($sec) . "," . $user_data["telephonenumber"] . "," . $user_data["email"] . "," . $servers . "," . $clusgrp . "," . $loginname . "," . $ipaddr . "," . $homedir . "," . $ad_loginname . "," . $ad_details;//$mesg
//print_r(explode(',',$str,2));
//trim($str,"Hed!");
?>
