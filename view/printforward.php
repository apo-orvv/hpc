<script >

var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
    for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
    }
});


for (var i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
            select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
            select_all.checked = true;
        }
    });
}
</script>
<form method="post" >

<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor="#00CCFF"><strong> Print Requests   </strong>  
</td> </tr> </thead>
<tr bgcolor='#888888' height="35px">
    <td width = '5%' >Sl. No. </td>
	<td width = '5%' > Select Print Req. ID </td>
    <td width = '5%' >IC_No </td>
    <td width = '10%' >Name</td>
    <td width = '10%' >Division</td>
    <td width = '10%' >Requested Date</td>
    <td width = '10%'>Purpose</td>
	<td width = '15%'>Status</td>
    <td width = '10%' >Details</td> </tr>
<tbody>
<tr>

 <?php foreach($r1 as $r){$cnt++; ?>
 <td>
  <?php echo $cnt; ?></td>
 <td> <?php echo"<input class='checkbox' name='check[]' type='checkbox' value='$r[PRINT_ID]'>"; echo  htmlspecialchars($r['PRINT_ID']); ?>  </td>
 <td> <?php echo htmlspecialchars($r['IC_NO']); ?></td> 
 <td><?php echo htmlspecialchars($r['NAME']); ?></td>
 <td><?php echo  htmlspecialchars($r['DIVISION']);?></td>
 <td><?php echo htmlspecialchars($r['REQDATE']); ?></td>
 <td> <?php echo htmlspecialchars($r['PURPOSE']); ?>  </td>
 <td><?php echo htmlspecialchars($r['PRINTSTAT']); ?></td>
  <td width = '50%'> 
 <table width='100%'  >
<tr >   <td width = '30%'> <?php echo htmlspecialchars($r1['fname']); ?> </td>      
  <td width = '15%' ><?php echo htmlspecialchars($r1['papertype']); ?></td>
  <td width = '15%' ><?php echo htmlspecialchars($r1['papersize']);?></td>
  <td width = '15%'><?php echo htmlspecialchars($r1['nprint']); ?></td>
  <td width = '15%'><a href='<?php echo htmlspecialchars($r1['path']);?>' >view</a></td> </tr>
</td> </tr> </table>
 </tbody>								 												
<?php } ?>
	<tr><td colspan="9" align="center">  <p>
	  <input  type='submit' name='forward' value='Approve' />
	</td> </tr>
		
</table>


</form>
