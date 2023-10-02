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
<td colspan="2" height="35px" ><strong> Select the type of IP address for display </strong> </td> <td > 
<a href="index.php?hpcpage=editipadd&sysname=New"> Add New IP Address Detail </td>
</tr> 

<div id="divdisplay" style="display: none">
<tr>  
  
   <td> 
    <input type="radio" id="test3"  value="Internal" name="sysdet" />
    <label for="test3">Internal IP Address </label>
   </td>
   <td>  
    <input type="radio" id="test4"  value="External" name="sysdet" />
    <label for="test4">External IP Address </label>
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
   <strong><th   > System Name </th> </strong>
   <strong><th   > Login Name </th> </strong>
    <th   ><strong>Type</strong> </th>
	 <th   ><strong>IP Address </strong> </th>
	  <th    ><strong>Location </strong></th>
	  
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { 
 
 ?> 
<tr height="35px" border='2'>
<td  ><?php echo $i++; ?></td>
<td > <a href="index.php?hpcpage=editipadd&sysname=<?php echo htmlspecialchars($r['sysname']); ?>"> <?php echo htmlspecialchars($r['sysname']); ?>  </a> </td>      
 <td  ><?php echo htmlspecialchars($r['login_name']); ?></td>
 <td   ><?php echo htmlspecialchars($r['type']); ?></td>
 <td ><?php echo htmlspecialchars($r['ipadd'])?></td>
 <td  ><?php echo htmlspecialchars($r['location']); ?></td>
 
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

