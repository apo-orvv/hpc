
<script type="text/javascript">
function printit()
   {
   var prtContent = document.getElementById('printdiv');
   document.getElementById('printdiv').setAttribute("style","margin-top:0px; margin-bottom:0px; margin-left:4px; margin-right:4px;");
    var WinPrint = window.open('', '', 'left=0,top=0,width=600px,height=1000px,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write( '<span style="font-size:8px">' + prtContent.innerHTML + '<span>' );
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    prtContent.innerHTML=strOldOne;
   }
</script>

<form action="" method="post" onclick = submit()>
<label for="icno">Choose a RTC Members:</label>
<select name="icno">
<option value="" >none</option>
<?php
foreach($CD as $mem){
	echo '<option value="'.$mem["icno"].'">'.$mem["c_mem"].'</option>';
}
?>
</select>
</form>

<form action="" method="post" >
    <table width="100%" align="center"  class='display' > 
    </table>

<div id='printdiv'>
<table width="100%" align="center"  class='display' > 
<tr>  <td colspan="9" align='center'  >Electronics & Instrumentation Group </td> </tr>
<tr>  <td colspan="9" align='center'  > Computer Division</td> </tr>
</table>

<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 

<thead>    


<tr>  
<td colspan="9" align='center' bgcolor='#9999CC'><strong> Last 6 months Over time Report of RTC shift Member "<?php echo $name['c_mem'];?>"</strong> <input  type='submit' name='printall' value='print' onclick='printit()' /> </td>  
</tr> </thead>
<tr bgcolor=''>
    <td  > <strong> Sl.No.  </strong> </td>		
    <td   ><strong>  Date  </strong> </td>	
    <td  ><strong>  Section  </strong> </td>
    <td  ><strong>  Work Description  </strong> </td>	
    <td  ><strong>  Work Alloted By  </strong> </td>
    <td   ><strong>  Start Time  </strong> </td>
    <td  ><strong>  End Time  </strong> </td></tr>
    <tbody>	
	<?php $slno=0; foreach ($overTime as $r) { ?>
	<tr  >
	<td ><?php $slno=$slno+1; echo $slno; ?></td>
    <td><?php echo htmlspecialchars($r['from_date']); ?></td>  
	<td > <?php echo htmlspecialchars($r['section_of']); ?> </td>      
	<td><?php echo htmlspecialchars($r['work_description']) ?></td>    
	<td ><?php echo htmlspecialchars($r['work_alloted_by']) ?></td>    
	<td ><?php echo htmlspecialchars($r['over_time_start']) ?></td>   
	<td ><?php echo htmlspecialchars($r['over_time_end']) ?></td>
    </tr>
	<?php } ?>
</tbody>      
</table>
</div>
</form>