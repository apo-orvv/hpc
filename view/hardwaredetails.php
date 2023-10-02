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
<form method="post"  >
<table style="" align="center"  class='querytable'  cellpadding='3' cellspacing='0'   border='2' > 
 
<tr>  
<td colspan="4" height="35px" ><strong> Select the required system parameters for display </strong> </td> <td colspan="2"> <a href="index.php?hpcpage=edithardwares&sysname=New"> Add New Hardware </td>
</tr> 

<div id="divdisplay" style="display: none">
<tr>  
  
   <td> 
    <input type="checkbox" id="test3"  value="TYPE" name="sysdet[]" />
    <label for="test3">TYPE </label>
   </td>
   <td>  
    <input type="checkbox" id="test4"  value="DESCRIPTION" name="sysdet[]" />
    <label for="test4">DESCRIPTION </label>
   </td>
  <td> 
    <input type="checkbox" id="test5"  value="CONFIG" name="sysdet[]" />
    <label for="test5">Configuration </label>
  </td> 
<td>
    <input type="checkbox" id="test6"  value="PERFORMANCE" name="sysdet[]" />
    <label for="test6">PERFORMANCE </label>
 </td>
<td>
    <input type="checkbox" id="test7"  value="PROCESSOR" name="sysdet[]" />
    <label for="test7">PROCESSOR </label>
   </td>
   <td>
    <input type="checkbox" id="test8"  value="NETWORK" name="sysdet[]" />
    <label for="test8">NETWORK </label> 
 </td> 
   </tr>
  <tr>

 <td>
    <input type="checkbox" id="test9"  value="SYSSTORAGE" name="sysdet[]" />
    <label for="test9">SYSSTORAGE </label> 
 </td>  
<td>
    <input type="checkbox" id="test10"  value="DOCOMI" name="sysdet[]" />
    <label for="test10">DOCOMI</label> 
 </td> 
<td>

    <input type="checkbox" id="test11"  value="PROCUREDBY" name="sysdet[]" />
    <label for="test11">PROCUREDBY </label>
  
 </td> 
<td>

    <input type="checkbox" id="test12"  value="VENDOR" name="sysdet[]" />
    <label for="test12">VENDOR </label>
  
 </td> 
 <td>

    <input type="checkbox" id="test13"  value="IPADDRESS" name="sysdet[]" />
    <label for="test13">IPADDRESS </label>
  
 </td>
<td> 
<input type="checkbox" id="test14"  value="SOFTID" name="sysdet[]" />
<label for="test14">Software </label>

   </td>
 </tr>
     <input type="checkbox" id="test2"  value="SYSNAME" name="sysdet[]" checked />
    <label for="test2" style="display:none">SYSNAME</label>
</div>
<tr> <td colspan="6" > <input style="align:center" type="submit" value="Fetch Detail" name="fetch"> </td> </tr>
</table>

</form>
<br/>

<?php if($sysdetail=="All") { ?>
<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
   <strong> <th   > System Name </th> </strong>
    <th   ><strong>Type</strong> </th>
	 <th   ><strong>Description </strong> </th>
	  <th    ><strong>Configuration </strong></th>
	  <th    ><strong>Performance </strong> </th>
    <th   ><strong>Processor</strong>  </th>
	 <th  ><strong>Network </strong> </th>

<th  ><strong>IPAddress</strong> </th>   </thead> </tr> 
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { 
 
 ?> 
<tr height="35px" border='2'>

<td > <a href="index.php?hpcpage=edithardwares&sysname=<?php echo htmlspecialchars($r['SYSNAME']); ?>"> <?php echo htmlspecialchars($r['SYSNAME']); ?>  </a> </td>      
 <td  ><?php echo htmlspecialchars($r['TYPE']); ?></td>
 <td   ><?php echo htmlspecialchars($r['DESCRIPTION']); ?></td>
 <td ><?php echo htmlspecialchars($r['CONFIG'])?></td>
 <td  ><?php echo htmlspecialchars($r['PERFORMANCE']); ?></td>
 <td   border='1'><?php echo htmlspecialchars($r['PROCESSOR']); ?></td>
 <td   ><?php echo htmlspecialchars($r['NETWORK']); ?></td>

 <td  border='1'><?php echo htmlspecialchars($r['IPADDRESS']); ?></td>
  </tr>
 <?php } ?>
 </tbody>								 												
</table>
<?php }

else {
echo "<table align='center'  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style='width:100%;table-layout:fixed'> <thead> <tr> "; foreach($sysdetail as $title=> $val){ if($sysdetail[$title]=='SOFTID') {echo "<td>Software</td>"; } else echo "<td>" .$sysdetail[$title] ."</td>"; } echo "</thead></tr>";

echo "<tbody> ";
$i=0;
foreach ($r1 as $r) //For each row
	{ echo"<tr>"; 
	foreach($sysdetail as $title=> $val) // For each column
	{ 
	    	
    if($sysdetail[$title]=='SYSNAME') { echo "<td> <a href='index.php?hpcpage=edithardwares&sysname='".$r[$sysdetail[$title]].">" .$r[$sysdetail[$title]] ."</td>"; }
	elseif($sysdetail[$title]=='SOFTID') {
	$sname=$r['SYSNAME']; $s=$this->hardwaremodel->fetchsoftware($sysdetail[$title],$sname); echo "<td>" .$s ."</td>";  }
    else	{
	echo "<td>" .$r[$sysdetail[$title]] ."</td>";  }
	} //  column Closing
	echo" </tr>"; }  //  row Closing
echo "</tbody></table> "; 

}?>


<script>

$(document).ready(function() {
    $('#mtab').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
	
} );

</script>

