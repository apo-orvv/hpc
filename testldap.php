
<?php

	$ldaprdn="cn=Manager,dc=igcar,dc=cd";
	$ldappass="manager123";
	$ldapconn=ldap_connect("10.20.2.16");
	$cn="";
	$mail="";
	$phone="";
	$group="";
	if($ldapconn){
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldapbind=ldap_bind($ldapconn,$ldaprdn,$ldappass);
	}
// We have to set this option for the version of Active Directory we are using.
ldap_set_option($ldap_connection, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
ldap_set_option($ldap_connection, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.
echo"<table  width='100%' align='center' class='display' cellpadding='1' cellspacing='0'  id ='mtab' border='' >
    <thead> <tr  valign ='top' align='center' bgcolor=''  >
   <th height='5'width=''  >Sl. No </th>
     <th height='15'width='' >User ID </th>
	 <th height='10'width='' >IC. No. </th>
	 <th height='15'width='' >User Name </th>
	 <th height='15'width='' >Mail ID </th>
	 <th height='15'width='' >Server Name </th>
	 <th height='15'width='' >Intercom </th>
	 <th height='15'width='' >Host IP Address</th>
	 <th height='15'width='' > Group Name </th>
	 <th height='15'width='' > UID </th>
	 <th height='15'width='' > Group ID</th>
  </tr>  </thead>";
if (TRUE === ldap_bind($ldapconn,$ldaprdn,$ldappass)){
	echo "connected";
    $ldap_base_dn = 'DC=igcar,DC=cd';
    $search_filter = '(&(cn=*))';
    $attributes = array();
	$attributes[] = 'uid';
	$attributes[] ='employeenumber';
	$attributes[] = 'mail';
    $attributes[] = 'cn';
    $attributes[] = 'host';
	 $attributes[] = 'telephonenumber';
	 $attributes[] = 'employeetype';
	 $attributes[] = 'iphostnumber';
	 $attributes[] = 'uidnumber';
	 $attributes[] = 'gidnumber';
	 $attributes[] = 'ou';
	 $cnt=0;
    $result = ldap_search($ldapconn, $ldap_base_dn, $search_filter, $attributes);
    if (FALSE !== $result){
		
	    $entries = ldap_get_entries($ldapconn, $result);
		echo $entries['count'];
		
        for ($x=0; $x<$entries['count']; $x++)
		{
		   if (!empty($entries[$x]['uid'][0]) &&
                 !empty($entries[$x]['mail'][0]) &&
                 !empty($entries[$x]['cn'][0]) )
				 {
				 //echo "coming inside";
				 echo "\r";
				 $t1=$entries[$x]['uid'][0];
				 //echo $t1;
				 $cnt=$cnt+1;
				 //print_r($entries[$x]['host']);
				 $allhosts="";
				 foreach($entries[$x]['host'] as $hosts)
				 {
				//print_r($hosts);
				//echo $hosts;
				//echo "*******";
				if(!(is_numeric($hosts)))
				{
				$allhosts.=$hosts .",";
				}
				 }
				 
				 $allhosts=rtrim($allhosts,",");
				 //echo $allhosts;
				
			//exit;
				 echo"<tbody>
	<tr >
      <td height='5'width='' >" .$cnt; echo " </td>
	   <td height='15'width=''>" .$entries[$x]['uid'][0]; echo " </td>
	   <td height='15'width=''>" .$entries[$x]['employeenumber'][0]; echo " </td>
	   <td height='15'width=''>" .$entries[$x]['cn'][0]; echo " </td>
	  <td height='15'width=''>" .$entries[$x]['mail'][0]; echo " </td>
	  
	  
	  <td height='15'width=''>" .$allhosts; echo " </td>
		<td height='15'width=''>" .$entries[$x]['telephonenumber'][0]; echo " </td> 
		<td height='15'width=''>" .$entries[$x]['iphostnumber'][0]; echo " </td> 
		<td height='15'width=''>" .$entries[$x]['ou'][0]; echo " </td>
		<td height='15'width=''>" .$entries[$x]['uidnumber'][0]; echo " </td>
		<td height='15'width=''>" .$entries[$x]['gidnumber'][0]; echo " </td> 
	 </tr>";	 
        
            }
			
        }
echo" </tbody>
</table>";		
    }
ldap_unbind($ldapconn); // Clean up after ourselves.
}
$message .= "Retrieved ". count($ad_users) ." Active Directory users\n";

?>
