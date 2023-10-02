<?php 
$sql1="select * from FEEDBACK  where FEEDBACKYEAR = 2016 AND FINDEX >=70";

$sql1=$dbh->query($sql1);
$sql1->setFetchMode(PDO::FETCH_ASSOC);  

$statement = $dbh->prepare("select AVG(FINDEX) from FEEDBACK  where FEEDBACKYEAR = 2016 AND FINDEX >=70");
$statement->execute();
$result = $statement->FetchAll();
	
?>

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

<input  type='submit' name='printall' value='print' onclick='printit()' />
<div id='printdiv'>
<table width="100%" align="center"  class='display' > 

<tr>  <td colspan="9" align='center'  >Electronics & Instrumentation Group </td> </tr>
<tr>  <td colspan="9" align='center'  > Computer Division</td> </tr>
<tr>  <td colspan="9" align='center' ><strong>
                                            High Performance Scientific Computing facility   </td> </tr>			
  </table>

<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 

<thead>    


<tr>  
<td colspan="9" align='center' bgcolor='#9999CC'><strong> Customers satisfaction Index for the year 2016 </strong></td>  
</tr> </thead>
<tr bgcolor=''>
    <td width = '5%'  > <strong> Sl.No.  </strong> </td> 
    <td width = '5%'  ><strong>  IC_No  </strong> </td>
    <td width = '40%'  ><strong> Name  </strong> </td>
    <td width = '30%'  > <strong> Sec / Div / Group  </strong> </td>
    <td width = '20%'><strong> Rating(max 100)  </strong> </td> </tr>
<tbody>	
	<?php $slno=0; while ($r = $sql1->fetch()): ?>
	<tr  >
	<td width = '5%'><?php $slno=$slno+1; echo $slno; ?></td>
  <td width = '5%'><?php echo htmlspecialchars($r['ICNO']); ?></td>  
 <td width = '40%'> <?php echo htmlspecialchars($r['NAME']); ?>
     </a> </td>      
 <td width = '30%'><?php echo htmlspecialchars($r['SEC']) . '/' . htmlspecialchars($r['DIVISION'])  . '/' .  htmlspecialchars($r['UGROUP'])  ; ?></td>
  
 <td width = '20%'><?php echo htmlspecialchars($r['FINDEX']); ?> </td>   
  </tr>
		<?php endwhile; ?>
        
        
    <tr> <td colspan="4" height="20"> Customer Satisfaction Index </td> <td> <?php  echo $result[0][0]; ?> </td> </tr>
    
</table>


</td>
</div>
</form>
