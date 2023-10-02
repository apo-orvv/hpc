
<form method="post" >
<table width="105%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
<thead>    
<tr> <td colspan="14" align='center' height="35px" bgcolor='#9999CC' style="text-align:center"><strong> Download Print Files</strong></td>  </tr> </thead>
<tr height="35px" bgcolor='#CCCCCC'>
    <td width = '2%' rowspan="2" > <strong> Request ID </strong> </td> 
    <td width = '3%' rowspan="2" ><strong> IC_No </strong> </td>
    <td width = '10%' rowspan="2" ><strong>Name </strong></td>
    <!-- <td width = '10%' rowspan="2" > <strong>Division </strong></td> -->
    <td width = '5%' rowspan="2" ><strong>Requested Date </strong></td>
	<td width = '3%' rowspan="2" ><strong>Phone No</strong></td>
	<td width = '12%' rowspan="2" ><strong>Purpose </strong></td>
    <td width = '52%'><strong>File Details </strong></td> 
<td width = '10%'><strong>Status update </strong></td>	
	</tr>
<tbody>
<?php  foreach($r1 as $r) { ?> 
<tr height="35px" >
 <td width = '2%'><?php echo htmlspecialchars($r['PRINT_ID']); ?></td>  
 <td width = '3%'> <?php echo htmlspecialchars($r['IC_NO']); ?> </td>      
 <td width = '10%'><?php echo htmlspecialchars($r['NAME']); ?></td>
<!--  <td width = '5%'><?php echo htmlspecialchars($r['DIVISION']);?></td> -->
 <td width = '5%'><?php echo htmlspecialchars($r['REQDATE']); ?></td>
  <td width = '3%'><?php echo htmlspecialchars($r['PHN_NO'])?></td>
 <td width = '15%'><?php echo htmlspecialchars($r['PURPOSE']); ?></td>
  <td width = '52%'> 
  <?php 
  $reqid=$r['PRINT_ID'];

$s=$this->printmodel->fetchfile($reqid);
foreach($s as $r1) { 
?> 
 <table width='100%' style="border:0" >
<tr> 
  <td width = '30%' style="border:0;text-align:left"> <?php echo htmlspecialchars($r1['fname']); ?> </td>      
  <td width = '15%' style="border:0;text-align:left"><?php echo htmlspecialchars($r1['papertype']); ?></td>
  <td width = '15%' style="border:0;text-align:left" ><?php echo htmlspecialchars($r1['papersize']);?></td>
  <td width = '15%' style="border:0;text-align:left"><?php echo htmlspecialchars($r1['nprint']); ?></td>
  <td width = '15%' style="border:0;color:blue;text-align:left" ><a href='<?php echo htmlspecialchars($r1['path']);?>' >Download</a></td> </tr>
</table>
 <?php } ?>
 </td> <td width = '10%'><input type="radio" name="varup" value="<?php echo htmlspecialchars($reqid); ?>" > Completed</td>
   <?php } ?>
 </tr>
 <tr height="35px" ><td colspan="9" style="text-align:center" bgcolor='#CCCCCC'><input type="submit" name="save" value="Update Print Staus">  </td> </tr>
 </tbody>								 												

</table>
</form>
