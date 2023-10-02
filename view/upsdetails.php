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
<td> <a href="index.php?hpcpage=editups&sysname=New"> Add New UPS </td>
</tr> 
</table>
</form>
<br/>
<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
    <th> <strong>UPS Name </strong></th> 
    <th   ><strong>Capacity</strong> </th>
	 <th   ><strong>Date of Instal.</strong> </th>
	  <th    ><strong>power supply Class </strong></th>
	  <th    ><strong>Input </strong> </th>
    <th   ><strong>Output</strong>  </th>
	 <th  ><strong>Connected load </strong> </th>
<th  ><strong>DC Bus</strong> </th>   
<th   ><strong>Charge Amps</strong> </th>
	 <th   ><strong>Battery Bank Volt </strong> </th>
	  <th    ><strong>Battery Details </strong></th>
	  <th    ><strong>Date of Bat. Repmt. </strong> </th>
    <th   ><strong>location</strong>  </th>
	 <th  ><strong>Status </strong> </th> </tr>
</thead> 
<tbody>
<?php $i=0; foreach ($r1 as $r)
 { 
 
 ?> 
<tr height="35px" border='2'>

<td > <a href="index.php?hpcpage=editups&sysname=<?php echo htmlspecialchars($r['ups_name']); ?>"> <?php echo htmlspecialchars($r['ups_name']); ?>  </a> </td>      
  <td   ><?php echo htmlspecialchars($r['capacity']); ?></td>
 <td ><?php echo htmlspecialchars($r['installed_on'])?></td>
 <td  ><?php echo htmlspecialchars($r['class']); ?></td>
 <td   border='1'><?php echo htmlspecialchars($r['input']); ?></td>
 <td   ><?php echo htmlspecialchars($r['output']); ?></td>
 <td  border='1'><?php echo htmlspecialchars($r['connected_load']); ?></td>
 <td  ><?php echo htmlspecialchars($r['dc_bus']); ?></td>
 <td   ><?php echo htmlspecialchars($r['charge_amps']); ?></td>
 <td ><?php echo htmlspecialchars($r['battery_bank'])?></td>
 <td  ><?php echo htmlspecialchars($r['battery_detail']); ?></td>
 <td   border='1'><?php echo htmlspecialchars($r['battery_installed']); ?></td>
 <td   ><?php echo htmlspecialchars($r['location']); ?></td>
 <td  border='1'><?php echo htmlspecialchars($r['status']); ?></td>
 
  </tr>
 <?php } ?>
 </tbody>								 												
</table>



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

