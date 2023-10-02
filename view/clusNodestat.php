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
<td colspan="2" height="35px" ><strong> Select the Cluster Name for display </strong> </td> <td > 
<a href="index.php?hpcpage=editclusNode&sysname=New"> <img src="view\img1\Add.png" width="30" height="20" style="border: none; outline: none;" > Add New Node Assignment </td>
</tr> 

<div id="divdisplay" style="display: none">
<tr>  
  
   <td> 
    <input type="radio" id="test3"  value="xeon" name="sysdet" />
    <label for="test3">128 Node Xeon  </label>
   </td>
   <td>  
    <input type="radio" id="test4"  value="neha" name="sysdet" />
    <label for="test4">134 Node Neha </label>
   </td>
  <td> 
    <input type="radio" id="test5"  value="All" name="sysdet" />
    <label for="test5">ALL </label>
  </td> 
   </tr>
 
<tr> <td colspan="6" > <input style="align:center" type="submit" value="Fetch Detail" name="fetch"> </td> </tr>
</table>

</form>
<br/>

<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
   <strong>
  
  
   
   <th> Sl.No.</th></strong>
   <strong><th   > Cluster Name </th> </strong>
   <strong><th   > Node Name </th> </strong>
     <th   ><strong>Issued to </strong> </th>
	  <th    ><strong>Issued Date </strong></th>
	   <th    ><strong>Division / Group </strong></th>
	  <th   ><strong>Assignment Type</strong> </th>
	   <th   ><strong>Return Date</strong> </th>
	  <th   ><strong>Purpose</strong> </th>
	  <th   ><strong>Remarks</strong> </th>
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { 
 
 ?> 
<tr height="35px" border='2'>
<td  ><?php echo htmlspecialchars($r['slno']); ?></td>
<td > <a href="index.php?hpcpage=editclusNode&sysname=<?php echo htmlspecialchars($r['slno']); ?>"> <?php echo htmlspecialchars($r['clusname']); ?>  </a> </td>      
 <td  ><?php echo htmlspecialchars($r['nodename']); ?></td>
 <td   ><?php echo htmlspecialchars($r['issuedto']); ?></td>
 <td ><?php echo htmlspecialchars($r['issueddate'])?></td>
 <td  ><?php echo htmlspecialchars($r['divgrp']); ?></td>
  <td  ><?php echo htmlspecialchars($r['assignment_type']); ?></td>
   <td  ><?php echo htmlspecialchars($r['returndate']); ?></td>
    <td  ><?php echo htmlspecialchars($r['purpose']); ?></td>
	<td  ><?php echo htmlspecialchars($r['remarks']); ?></td>
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

