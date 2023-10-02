<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.5/media/css/jquery.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jquery.dataTables.min.js"></script>

<div> 

 
<h3> Print Status </h3>


<table align="center"   cellspacing='0'  id ='mtab' border='1' > 
<thead>
<tr bgcolor='' >
    <th  > <strong> Request ID </strong> </th> 
    <th   ><strong> IC_No </strong> </th>
    <th   ><strong>Name </strong></th>
    <th   > <strong>Division</strong></th>
    <th   ><strong>Requested Date </strong> </th>
	<th  ><strong>Completed Date </strong></th>
	<th   ><strong>Phone No.</strong></th>
	<th   ><strong>Purpose </strong> </th>
	<th ><strong> Print Status </strong> </th> </tr> </thead>
<tbody>
	<?php 
	//print_r($r1);
 //$Print_completed="#6CB78A";
 
	foreach($r1 as $r){
	
 ?>
	<tr>
	
  <td ><?php echo $r[0]; ?></td>  
 <td > <a <?php echo htmlspecialchars($r[1]); ?>> <?php echo htmlspecialchars($r[1]); ?> </a> </td>      
 <td ><?php echo htmlspecialchars($r[2]); ?></td>
 <td ><?php echo htmlspecialchars($r[4]);?></td>
 <td ><?php echo htmlspecialchars($r[7]); ?></td>
 <td ><?php echo htmlspecialchars($r[8]); ?></td>
 <td ><?php echo htmlspecialchars($r[6])?></td>
 <td ><?php echo htmlspecialchars($r[3]); ?></td>
 <td > <?php   echo htmlspecialchars($r[9]); ?> </td> 
  </tr> 
		<?php } ?>
		
</tbody> </table>

</div>

<script>

$(document).ready(function() {
    $('#mtab').DataTable( {
        "paging":   true,
        "searching": false    
        } );
} );
</script>