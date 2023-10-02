<div> 
<table align="center"   cellspacing='0'  id ='mtab' border='1' > 
<thead>    
<tr>  
<td colspan="9" align='center' bgcolor='#9999CC'><strong> Monthly Print Report </strong></td> 
</tr> </thead>
<tbody>	
<tr bgcolor='' >
    <td  > <strong> Request ID </strong> </td> 
    <td   ><strong> IC_No </strong> </td>
    <td   ><strong>Name </strong></td>
    <td   > <strong>Division</strong></td>
    <td   ><strong>Requested Date </strong> </td>
	<td  ><strong>Completed Date </strong></td>
	<td   ><strong>Paper Size</strong></td>
	<td   ><strong>Purpose </strong> </td>
	<td ><strong> Print Status </strong> </td> </tr>

	<?php 
	//print_r($r1);
 //$Print_completed="#6CB78A";
	foreach($r1 as $r){
	
 ?>
	<tr  >
	
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
		</tbody>
</table>

</div>