
<form action="index.php?hpcpage=printcomplete" method="post" >
<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
<thead>
 <tr valign ='top' align='left'  >
      <td height="15" colspan="9" valign = "top"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor='#9999CC'><strong> Updating Print Status </strong></td> 
</tr> </thead>

<tr bgcolor='' height="35px">
    <td width = '2%'  > <strong> Request ID </td> 
    <td width = '3%'  ><strong> IC_No </td>
    <td width = '10%'  ><strong>Name</td>
    <td width = '10%'  > <strong>Division</td>
    <td width = '5%'  ><strong>Requested Date</td>
	<td width = '5%'  ><strong>Phone No.</td>
	<td width = '15%'  ><strong>Purpose</td>
	<td width = '25%'> <strong>Check </td>   
	<td width = '25%'><strong> Remarks</td> </tr>
<tbody>	
	<?php  foreach($r1 as $r) { ?>
	<tr height="35px" >
	
  <td width = '2%'><?php echo htmlspecialchars($r['PRINT_ID']); ?></td>  
 <td width = '3%'> <?php echo htmlspecialchars($r['IC_NO']); ?> </td>      
 <td width = '10%'><?php echo htmlspecialchars($r['NAME']); ?></td>
  <td width = '5%'><?php echo htmlspecialchars($r['DIVISION']);?></td>
 <td width = '5%'><?php echo htmlspecialchars($r['REQDATE']); ?></td>
  <td width = '5%'><?php echo htmlspecialchars($r['PHN_NO'])?></td>
 <td width = '15%'><?php echo htmlspecialchars($r['PURPOSE']); ?></td>
 <td width = '25%'><input type="radio" name="varup" value="<?php echo htmlspecialchars($r['PRINT_ID']); ?>" > Print_Completed</td>   
 <td width = '25%'> <?php echo '<input type="textbox" name="varrem[]">' ?> </td> </tr>
		<?php } ?>
<tr height="35px" ><td colspan="9" align="center" bgcolor='#CCCCCC'><input type="submit" name="save" value="Update Print Staus">  </td> </tr>		
</table>
</form>
