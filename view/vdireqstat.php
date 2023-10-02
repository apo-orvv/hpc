<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>
<form action="" >

<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'   border='2' > 
<thead>    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor='#9999CC' ><strong> User requests for Thin Client Installation </strong> </td> 
</tr> </thead>
</table>
<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' >
<thead> <tr bgcolor='' height="35px">
   <strong> <th width = '5%' > Request ID </th> </strong>
    <th width = '10%' ><strong>IC_No</strong> </th>
	 <th width = '10%'  ><strong>Name </strong> </th>
	  <th width = '10%'  ><strong>Group </strong></th>
	  <th width = '10%'  ><strong>Division </strong> </th>
    <th width = '10%' ><strong>Requested Date</strong>  </th>
	 <th width = '10%' ><strong>
	 </strong> </th>
 <th width = '10%' ><strong>Server Name </strong> </th>
  <th width = '10%' ><strong>Status </strong> </th> </thead> </tr>
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { ?> 
<tr height="35px" border='2'>
<td width = '15%' ><?php echo htmlspecialchars($r['reqid']); ?></td>
 <td width = '5%'> <a href="hpcuserprt?reqid=<?php echo htmlspecialchars($r['reqid']); ?>"> <?php echo htmlspecialchars($r['icno']); ?>  </a> </td>      
 <td width = '15%'><?php echo htmlspecialchars($r['user_name']); ?></td>
 <td width = '10%'><?php echo htmlspecialchars($r['igroup']); ?></td>
 <td width = '10%'><?php echo htmlspecialchars($r['division'])?></td>
 <td width = '10%'><?php echo htmlspecialchars($r['datereq']); ?></td>
 <td width = '10%' border='1'><?php echo htmlspecialchars($r['datecreated']); ?></td>
 <td> <?php 
 
 $id2 =$this->usermodel->serappreq($r['reqid']);
 

$sername='';
foreach ($id2 as $r2)
 {
 $sername.=$r2['sername']. ", ";
//echo "$r1['fname']";
}
$sername=rtrim($sername,', ');
echo  $sername ;
//endwhile;  
 ?> </td>
 <td width = '15%'><?php echo htmlspecialchars($r['hpcstat']); ?></td>
 </tr>
 <?php } ?>
 </tbody>								 												
</table>
</form>

<script>

$(document).ready(function() {

$('#mtab').DataTable( {
        "lengthMenu": [[20, 50, 100, -1], [20, 50, 100, "All"]],
	fixedHeader: true	
    } );
} );

</script>

