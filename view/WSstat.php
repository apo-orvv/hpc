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
<p align="center" style="font-size:20px;"> <b> Workstation Assignment Details </b></p>

<p align="left" style="color:red; font-size:15px;">  <a href="index.php?hpcpage=edithighws&sysname=New"> <img src="view\img1\Add.png" width="30" height="20" style="border: none; outline: none;" > Add New Workstation </a> </p>

<br/>

<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
   <strong>
  
   <th style="width:3%"> Sl. No.</th></strong>
   <strong><th style="width:5%"  > WS Name </th> </strong>
   <strong><th style="width:5%"  > WS Make </th> </strong>
     <th style="width:5%"  ><strong >WS OS</strong> </th>
	  <th style="width:7%"   ><strong >IP Address</strong></th>
	   <th style="width:7%"   ><strong >WS Group</strong></th>
	  <th style="width:30%"   ><strong >Workstation Status</strong> </th>
	   <th style="width:38%"  ><strong >Remarks</strong> </th>
	  
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { 

 ?> 
<tr height="35px" border='2'>
<td   ><?php echo htmlspecialchars($r['WSno']); ?></td>
<td > <a href="index.php?hpcpage=edithighws&sysname=<?php echo htmlspecialchars($r['WSno']); ?>"> <?php echo htmlspecialchars($r['WSname']); ?>  </a> </td>      
 <td  ><?php echo htmlspecialchars($r['WSmake']); ?></td>
 <td   ><?php echo htmlspecialchars($r['wsOS']); ?></td>
 <td  ><?php echo htmlspecialchars($r['WSIP'])?></td>
 <td  ><?php echo htmlspecialchars($r['WStype']); ?></td>
  <td  ><?php echo htmlspecialchars($r['WScurstatus']); ?></td>
   <td  ><?php echo htmlspecialchars($r['WSremarks']); ?></td>
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

