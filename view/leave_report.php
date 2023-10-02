
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
<td colspan="9" align='center' bgcolor='#9999CC'><strong> Monthly Leave Report of RTC shift Members</strong> <input  type='submit' name='printall' value='print' onclick='printit()' /> </td>  
</tr> </thead>
<tr bgcolor=''>
    <td width = '10%'  > <strong> Sl.No.  </strong> </td> 
    <td width = '35%'  ><strong>  Employee Name  </strong> </td>
    <td width = '15%'  ><strong>  Leave Type  </strong> </td>
    <td width = '20%'  ><strong> Number of Days  </strong> </td>
    <tbody>	
	<?php $slno=0; foreach ($r1 as $r) { ?>
	<tr  >
	<td width = '10%'><?php $slno=$slno+1; echo $slno; ?></td>
        <td width = '35%'><?php echo htmlspecialchars($r['c_mem']); ?></td>  
 <td width = '15%'> <?php echo htmlspecialchars($r['type']); ?>
     </a> </td>      
 <td width = '20%'><?php $diff=htmlspecialchars($r['DiffDate'])+1; echo $diff; ?></td>
    </tr>
	<?php } ?>
        
        
       
</table>


</td>
</div>
</form>
