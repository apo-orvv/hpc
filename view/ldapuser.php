<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function() {
    $('#usertable').DataTable( {
    
} );
} );
</script>
<?php
echo "<h4 class='systemdetails'>HPC LDAP users details</h4>";
  
 // exit;
if (TRUE === ldap_bind($ldapconn,$ldaprdn,$ldappass)){
	//echo "connected";
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
		
		
echo" 

<table id='usertable' class=\"display\" align='center'>
    <thead> <tr>
     <th>Sl. No </th>
     <th>User ID </th>
	 <th>IC. No. </th>
	 <th>User Name </th>
	 <th>Mail ID </th>
	 <th>Server Name </th>
	 <th>Intercom </th>
	 <th>Host IP Address</th>
	 <th> Group Name </th>
	 <th> UID </th>
	 <th> Group ID</th>
  </tr>  </thead> <tbody>";
  
  
		
	    $entries = ldap_get_entries($ldapconn, $result);
				//echo $entries['count'];
		
        for ($x=0; $x<$entries['count']; $x++)
		{
		   if (!empty($entries[$x]['uid'][0]) &&
                 !empty($entries[$x]['mail'][0]) &&
                 !empty($entries[$x]['cn'][0]) )
				 {
				 //echo "coming inside";
				 //echo "\r";
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
				$allhosts.=$hosts .", ";
				}
				 }
				 
				 $allhosts=rtrim($allhosts,",");
				 //echo $allhosts;
				
				
				$t2=$entries[$x]['employeenumber'][0];
				$t3=$entries[$x]['cn'][0];
				$t4=$entries[$x]['mail'][0];
				$t5=$entries[$x]['telephonenumber'][0];
				$t6=$entries[$x]['iphostnumber'][0];
				$t7=$entries[$x]['ou'][0];
				$t8=$entries[$x]['uidnumber'][0];
				$t9=$entries[$x]['gidnumber'][0];
			//exit;
				 echo"
	<tr>
      <td    >$cnt </td>
	   <td   >$t1 </td>
	   <td   >$t2 </td>
	   <td   >$t3</td>
	  <td   >$t4</td>
	    <td  >$allhosts </td>
		<td   >$t5 </td> 
		<td   >$t6 </td> 
		<td   >$t7  </td>
		<td   >$t8  </td>
		<td   >$t9  </td> 
	 </tr>";	 
        
            }
			
        }
		
		}
echo" </tbody></table>";		
    
ldap_unbind($ldapconn); // Clean up after ourselves.
}
?>
