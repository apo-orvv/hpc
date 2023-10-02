
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

<form action="" method="post">
<label for="icno">Choose a RTC Members:</label>
<select name="icno">
<option value="" >none</option>
<?php
foreach($CD as $mem){
	echo '<option value="'.$mem["icno"].'">'.$mem["c_mem"].'</option>';
}
?>
</select>
<label for="month">Choose a Month:</label>
<select name="month">
<option value="" >none</option>
<?php
for($i=1;$i<=12;$i++){
	echo '<option value="'.$i.'">'.$i.'</option>';
}
?>
</select>
<label for="month">Choose a Year:</label>
<select name="year">
<option value="" >none</option>
<?php
for($j=2023;$j<=2032;$j++){
	echo '<option value="'.$j.'">'.$j.'</option>';
}
?>
</select>
<input type="submit" name="Submit">
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
<td colspan="9" align='center' bgcolor='#9999CC'><strong> Monthly Change Report of RTC shift Member "<?php echo $name['c_mem'];?>"</strong> <input  type='submit' name='printall' value='print' onclick='printit()' /> </td>  
</tr> </thead>
<tr bgcolor=''>
    <td width = '10%'  > <strong> Sl.No.  </strong> </td> 
    <td width = '35%'  ><strong>  Change Taken From  </strong> </td>
    <td width = '15%'  ><strong>  Type of Change  </strong> </td>
    <td width = '20%'  ><strong>  Date  </strong> </td></tr>
    <tbody>	
	<?php $slno=0; foreach ($shift_change as $r) { ?>
	<tr  >
	<td width = '10%'><?php $slno=$slno+1; echo $slno; ?></td>
        <td width = '35%'><?php echo htmlspecialchars($r['change_with']); ?></td>  
 <td width = '15%'> <?php echo htmlspecialchars($r['type']); ?>
     </a> </td>      
 <td width = '20%'><?php echo htmlspecialchars($r['from_date']) ?></td>
    </tr>
	<?php } ?>
</tbody>      
</table>
</div>
</form>