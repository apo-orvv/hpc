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
<td colspan="4" height="35px" ><strong> Select the required software parameters for display </strong> </td> <td colspan="2"> <a href="index.php?hpcpage=editsoftwares&softname=New"> Add New Software </td>
</tr> 
<div id="divdisplay" style="display: none">
<tr>  
   <td> 
    <input type="checkbox" id="test3"  value="TYPE" name="softdet[]" />
    <label for="test3">TYPE </label>
   </td>
   <td>  
    <input type="checkbox" id="test4"  value="INSTALLEDON" name="softdet[]" />
    <label for="test4">INSTALLEDON </label>
   </td>
  <td> 
    <input type="checkbox" id="test5"  value="SWUSAGE" name="softdet[]" />
    <label for="test5">SWUSAGE </label>
  </td> 
<td>
    <input type="checkbox" id="test6"  value="PROCUREDBY" name="softdet[]" />
    <label for="test6">PROCUREDBY </label>
 </td>
<td>
    <input type="checkbox" id="test7"  value="INSTALLEDBY" name="softdet[]" />
    <label for="test7">INSTALLEDBY </label>
   </td>
   <td>
    <input type="checkbox" id="test8"  value="LICENSE_SERVER" name="softdet[]" />
    <label for="test8">LICENSE_SERVER </label> 
 </td> 
   </tr>
  <tr>
 <td>
    <input type="checkbox" id="test9"  value="LICENSE_TYPE" name="softdet[]" />
    <label for="test9">LICENSE_TYPE </label> 
 </td>  
<td>
    <input type="checkbox" id="test10"  value="NO_OF_LIC" name="softdet[]" />
    <label for="test10">NO_OF_LIC</label> 
 </td> 
<td>
    <input type="checkbox" id="test11"  value="EXPIRY_DATE" name="softdet[]" />
    <label for="test11">EXPIRY_DATE </label> 
 </td> 
<td >
    <input type="checkbox" id="test12"  value="VENDOR" name="softdet[]" />
    <label for="test12">VENDOR </label> 
 </td> 
 <td> </td>
 <td> </td>
 </tr>
     <input type="checkbox" id="test2"  value="SOFTNAME" name="softdet[]" checked />
    <label for="test2" style="display:none">SOFTNAME</label>
</div>
<tr> <td colspan="6" > <input style="align:center" type="submit" value="Fetch Detail" name="fetch"> </td> </tr>
</table>
</form>
<br/>

<?php 
if($softdetail=="All") {
?>
<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
   <strong> <th   > SOFTNAME </th> </strong>
    <th   ><strong>Type</strong> </th>
	 <th   ><strong>INSTALLEDON </strong> </th>
	  <th    ><strong>SWUSAGE </strong></th>
	  
	 <th  ><strong>LICENSE_SERVER </strong> </th>
 <th   ><strong>NO_OF_LIC </strong> </th>
   
</thead> </tr> 
<tbody>
<?php $i=0; foreach ($r1 as $r)
 { 
  ?> 
<tr height="35px" border='2'>
<td > <a href="index.php?hpcpage=editsoftwares&softname=<?php echo htmlspecialchars($r['SOFTNAME']); ?>"> <?php echo htmlspecialchars($r['SOFTNAME']); ?>  </a> </td>      
<td  ><?php echo htmlspecialchars($r['TYPE']); ?></td>
<td   ><?php echo htmlspecialchars($r['INSTALLEDON']); ?></td>
 <td  ><?php echo htmlspecialchars($r['SWUSAGE']); ?></td>
 
 <td   ><?php echo htmlspecialchars($r['LICENSE_SERVER'])?></td>
 <td  ><?php echo htmlspecialchars($r['NO_OF_LIC']); ?></td>
 
 </tr>
 <?php } ?>
 </tbody>								 												
</table>
<?php }

else {
echo "<table align='center'  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style='width:100%;table-layout:fixed'> <thead> <tr> "; foreach($softdetail as $title=> $val){ if($softdetail[$title]=='SOFTID') {echo "<td>Software</td>"; } else echo "<td>" .$softdetail[$title] ."</td>"; } echo "</thead></tr>";

echo "<tbody> ";
$i=0;
foreach ($r1 as $r) //For each row
	{ echo"<tr>"; 
	//print_r($softdetail);
	foreach($softdetail as $title=> $val) // For each column
	{ 
    if($softdetail[$title]=='SOFTNAME') { echo "<td> <a href='index.php?hpcpage=editsoftwares&softname='".$r[$softdetail[$title]].">" .$r[$softdetail[$title]] ."</td>"; }
	    else	{
	echo "<td>" .$r[$softdetail[$title]] ."</td>";  }
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

