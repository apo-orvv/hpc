

<?php

function getldapuser($username){


	$ldaprdn="cn=Manager,dc=igcar,dc=cd";
	$ldappass="manager123";
	$ldapconn=ldap_connect("10.20.2.17","389");
	$cn="";
	$mail="";
	$phone="";
	$group="";
	if($ldapconn){
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldapbind=ldap_bind($ldapconn,$ldaprdn,$ldappass);

		$sr=ldap_search($ldapconn,"ou=People,dc=igcar,dc=cd","(uid=$username)");
	//	echo "Getting entries ...<p>";
    		$info = ldap_get_entries($ldapconn, $sr);
    	//	echo "Data for " . $info["count"] . " items returned:<p>";

	$cn=$info[0]["cn"][0];
	$mail=$info[0]["mail"][0];
	$phone=$info[0]["telephonenumber"][0];
	$group=$info[0]["ou"][0]."/".$info[0]["ou"][1]."/".$info[0]["ou"][2];	
    //	echo "Closing connection";
    	ldap_close($ldapconn);
	}

	return array($cn,$mail,$phone,$group);
}
?>
