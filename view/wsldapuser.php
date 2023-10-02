<!--<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />-->
<link type="text/css" href="view/DataTables/Buttons-1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="/view/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="/view/selectcss.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jszip.min.js"> </script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.print.min.js"></script>

<script>

$(document).ready(function() {
    $('#mtab').DataTable( {
               
    } );
	
} );

</script>

 

<?php 
/*
echo "hellloooooooooooooooooooooooo";
echo"<table  style='width:100%;table-layout:fixed' align='center' class='display' cellpadding='1' cellspacing='0'  id ='mtab' border='' >
    <thead> <tr  valign ='top' align='center' bgcolor=''  >
   <th style='width:5%'  >Sl. No </th>
     <th  style='width:10%' >User ID </th>
	 <th  style='width:5%' >IC. No. </th>
	 <th  style='width:15%' >User Name </th>
	 <th  style='width:25%' >Mail ID </th>
	 <th  style='width:10%' >Server Name </th>
	 <th  style='width:5%' >Intercom </th>
	 <th  style='width:10%' >Host IP Address</th>
	 <th  style='width:5%' > Group Name </th>
	 <th  style='width:5%' > UID </th>
	 <th  style='width:5%' > Group ID</th>
  </tr>  </thead>";


//if (TRUE === ldap_bind($ldap_connection,"10.20.2.63@gws.gov.in",""))
if($ldapbind)
{
	
	//$search_filter = '(|(objectCategory=person)(objectclass=user))';
    $attributes = array();
    $attributes[] = 'givenname';
    $attributes[] = 'mail';
    $attributes[] = 'samaccountname';
    $attributes[] = 'sn';
	
	//$ldapbind=ldap_bind($ldapconn,"10.20.3.62@gws.gov.in",$ldappass);
	
	if (TRUE === $ldapbind)
	{
		echo "LDAP Bind";
		//$ldap_base_dn = 'cn=gws.gov.in,dc=GWS,dc=GWS'; 
		$ldap_base_dn = 'DC=VDIDOM,DC=GOV,DC=IN';
		$search_filter = '((givenname="ag"))';
		//$search_filter = "user=*";
		$result = ldap_search($ldapconn, $ldap_base_dn, $search_filter);
		echo $result;
	}
   
    if (FALSE !== $result){
		echo "Coming inside #######################";
        $entries = ldap_get_entries($ldapconn, $result);
		print_r($entries);
		exit;
        for ($x=0; $x<$entries['count']; $x++){
            if (!empty($entries[$x]['givenname'][0]) &&
                 !empty($entries[$x]['mail'][0]) &&
                 !empty($entries[$x]['samaccountname'][0]) &&
                 !empty($entries[$x]['sn'][0]) &&
                 'Shop' !== $entries[$x]['sn'][0] &&
                 'Account' !== $entries[$x]['sn'][0]){
                $ad_users[strtoupper(trim($entries[$x]['samaccountname'][0]))] = array('email' => strtolower(trim($entries[$x]['mail'][0])),'first_name' => trim($entries[$x]['givenname'][0]),'last_name' => trim($entries[$x]['sn'][0]));
            }
        }
    }
    ldap_unbind($ldap_connection); // Clean up after ourselves.
}

$message .= "Retrieved ". count($ad_users) ." Active Directory users\n";
     
//print_r($message);

*/



echo "Coming View";
set_time_limit(30);
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);

// config
$ldapserver = "10.20.3.62";
$ldapuser      = "GWS\Administrator"; 
$ldappass     = "gwsdomain@2019";
$ldaptree    = "ou=WS,dc=GWS,dc=GOV,dc=IN";

// connect
$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");

if($ldapconn) {
echo "binding to ldap server";
    $ldapbind = ldap_bind($ldapconn, $ldapuser, $ldappass) or die ("Error trying to bind: ".ldap_error($ldapconn));
    // verify binding
    if ($ldapbind) {
        echo "LDAP bind successful...<br /><br />";
       
       $filter = "(&(samAccountName=*))";
        $result = ldap_search($ldapconn,$ldaptree,$filter ) or die ("Error in search query: ".ldap_error($ldapconn));
        $entries = ldap_get_entries($ldapconn, $result);
	
		
		/*
		print_r($data[51]);
			exit;
		
		
		
		echo $data["count"];
		
		
		
		
		
		
		
        for ($i=0; $i<$data["count"]; $i++) {
			
			
            //echo "dn is: ". $data[$i]["dn"] ."<br />";
            echo "User: ". $data[$i]["cn"][0] ."<br />";
			echo "ou: ". $data[$i]["ou"][0] ."<br />";
			
			if(isset($data[$i]["SamAccountName"][0])) {
                echo "Acc Name: ". $data[$i]["SamAccountName"][0] ."<br /><br />";
            }
			
			echo "Emp No: ". $data[$i]["EmployeeNumber"][0] ."<br />";
			echo "Emp Type: ". $data[$i]["employeeType"][0] ."<br />";
            if(isset($data[$i]["mail"][0])) {
                echo "Email: ". $data[$i]["mail"][0] ."<br /><br />";
            } else {
                echo "Email: None<br /><br />";
            }
        } */
        // print number of entries found
		
		 //Create a table to display the output 
        echo '<h2>AD User Results</h2></br>';
        echo '<table border = "1"><tr bgcolor="#cccccc"><td>Username</td><td>Last Name</td><td>First Name</td><td>Company</td><td>Department</td><td>Office Phone</td><td>Fax</td><td>Mobile</td><td>DDI</td><td>E-Mail Address</td><td>Home Phone</td></tr>';
 
        //For each account returned by the search
        for ($x = 0; $x < $entries['count']; $x++) {
 
            //
            //Retrieve values from Active Directory
            //
 
            //Windows Usernaame
            $LDAP_samaccountname = "";
 
            if (!empty($entries[$x]['samaccountname'][0])) {
                $LDAP_samaccountname = $entries[$x]['samaccountname'][0];
                if ($LDAP_samaccountname == "NULL") {
                    $LDAP_samaccountname = "";
                }
            } else {
                //#There is no samaccountname s0 assume this is an AD contact record so generate a unique username
 
                $LDAP_uSNCreated = $entries[$x]['usncreated'][0];
                $LDAP_samaccountname = "CONTACT_" . $LDAP_uSNCreated;
            }
 
            //Last Name
            $LDAP_LastName = "";
 
            if (!empty($entries[$x]['sn'][0])) {
                $LDAP_LastName = $entries[$x]['sn'][0];
                if ($LDAP_LastName == "NULL") {
                    $LDAP_LastName = "";
                }
            }
 
            //First Name
            $LDAP_FirstName = "";
 
            if (!empty($entries[$x]['givenname'][0])) {
                $LDAP_FirstName = $entries[$x]['givenname'][0];
                if ($LDAP_FirstName == "NULL") {
                    $LDAP_FirstName = "";
                }
            }
 
            //Company
            $LDAP_CompanyName = "";
 
            if (!empty($entries[$x]['company'][0])) {
                $LDAP_CompanyName = $entries[$x]['company'][0];
                if ($LDAP_CompanyName == "NULL") {
                    $LDAP_CompanyName = "";
                }
            }
 
            //Department
            $LDAP_Department = "";
 
            if (!empty($entries[$x]['ou'][0])) {
                $LDAP_Department = $entries[$x]['ou'][0];
                if ($LDAP_Department == "NULL") {
                    $LDAP_Department = "";
                }
            }
 
            //Job Title
            $LDAP_JobTitle = "";
 
            if (!empty($entries[$x]['title'][0])) {
                $LDAP_JobTitle = $entries[$x]['title'][0];
                if ($LDAP_JobTitle == "NULL") {
                    $LDAP_JobTitle = "";
                }
            }
 
            //IPPhone
            $LDAP_OfficePhone = "";
 
            if (!empty($entries[$x]['ipphone'][0])) {
                $LDAP_OfficePhone = $entries[$x]['ipphone'][0];
                if ($LDAP_OfficePhone == "NULL") {
                    $LDAP_OfficePhone = "";
                }
            }
 
            //FAX Number
            $LDAP_OfficeFax = "";
 
            if (!empty($entries[$x]['memberof'][0])) {
                $LDAP_OfficeFax = $entries[$x]['memberof'][0];
                if ($LDAP_OfficeFax == "NULL") {
                    $LDAP_OfficeFax = "";
                }
            }
 
            //Mobile Number
            $LDAP_CellPhone = "";
 
            if (!empty($entries[$x]['mobile'][0])) {
                $LDAP_CellPhone = $entries[$x]['mobile'][0];
                if ($LDAP_CellPhone == "NULL") {
                    $LDAP_CellPhone = "";
                }
            }
 
            //Telephone Number
            $LDAP_DDI = "";
 
            if (!empty($entries[$x]['telephonenumber'][0])) {
                $LDAP_DDI = $entries[$x]['telephonenumber'][0];
                if ($LDAP_DDI == "NULL") {
                    $LDAP_DDI = "";
                }
            }
 
            //Email address
            $LDAP_InternetAddress = "";
 
            if (!empty($entries[$x]['mail'][0])) {
                $LDAP_InternetAddress = $entries[$x]['mail'][0];
                if ($LDAP_InternetAddress == "NULL") {
                    $LDAP_InternetAddress = "";
                }
            }
 
            //Home phone
            $LDAP_HomePhone = "";
 
            if (!empty($entries[$x]['homephone'][0])) {
                $LDAP_HomePhone = $entries[$x]['homephone'][0];
                if ($LDAP_HomePhone == "NULL") {
                    $LDAP_HomePhone = "";
                }
            }
 
            echo "<tr><td><strong>" . $LDAP_samaccountname . "</strong></td><td>" . $LDAP_LastName . "</td><td>" . $LDAP_FirstName . "</td><td>" . $LDAP_CompanyName . "</td><td>" . $LDAP_Department . "</td><td>" . $LDAP_OfficePhone . "</td><td>" . $LDAP_OfficeFax . "</td><td>" . $LDAP_CellPhone . "</td><td>" . $LDAP_DDI . "</td><td>" . $LDAP_InternetAddress . "</td><td>" . $LDAP_HomePhone . "</td></tr>";
        } //END for loop
		
		
		
		
		
		
		
        echo "Number of entries found: " . ldap_count_entries($ldapconn, $result);
    } else {
        echo "LDAP bind failed...";
    }

}

// all done? clean up
ldap_close($ldapconn);
?>



