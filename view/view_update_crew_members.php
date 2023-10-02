
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>
<link rel="stylesheet" href="view/jQueryMonth-Year-Picker/jquerysctipttop.css">

<script type="text/javascript" charset="utf8" src="view/jQueryMonth-Year-Picker/jquery.mtz.monthpicker.js"></script>
<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>




<form id='form1' method='post' action="index.php?hpcpage=crewview">

<br/>

<table class='display' width="100%" > <tr> 
 <td>   <strong>  crew from date  </strong> </td> <td > <input id='mypicker' name='fromdate'></td>
<td> 	 <strong>crew to date</strong> </td> <td ><input id='mypicker1' name='todate'></td>
  <td   ><input type='submit' name='cupdate' value='Update'></td> </tr> </table>
<table align="center"  class='display' cellpadding='0' cellspacing='0'  id ='mtab' border='2' style="width:100%;table-layout:fixed" >
<thead> <tr bgcolor='' height="35px">
   
    <th   ><strong>Crew Member</strong> </th>
	 <th   ><strong>ICNO </strong> </th>
	  <th    ><strong>Choose Crew Name</strong></th>
	
    
 </tr> </thead>
<tbody>

<?php $i=0; foreach ($r1 as $r)
 { 
  ?> 
<tr height="35px" border='2'>

 <?php
 
$cnames=$this->rostermodel->get_crew_names();

$mystr="<select name='crew[]'>";

foreach($cnames as $par){

	if($par['c_name']==$r['c_name']){
		
		$cn=$par['c_name'];
$mystr=$mystr."<option value=\"$cn\" selected>$cn</option>";
}
else{
	$cn=$par['c_name'];
$mystr=$mystr."<option value=\"$cn\">$cn</option>";
}
}
$mystr=$mystr."</select>";
?>

     
<td  ><?php echo htmlspecialchars($r['c_mem']); ?></td>
<td   ><?php echo htmlspecialchars($r['icno']); ?> <input name="member[]" type="textbox"  maxlength='50' width="300" hidden value="<?php echo htmlspecialchars($r['icno']); ?>"/></td>
   <td ><?php  echo $mystr  ?></td> 
   
 </tr>
 <?php } ?>
 

 </tbody>								 												
</table>

</form>
<script>
$(document).ready(function() {
   $('#mtab').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]]
    } );
	
	$('#mypicker').monthpicker();
	$('#mypicker1').monthpicker();
	$("#datepicker").datepicker({
changeMonth: true,
changeYear: true,
changeDate: false,
dateFormat: "yy-mm-dd",
minDate: "2021-07-01",
maxDate: "+1D",
numberOfMonths: 1
            
});
    $("#datepicker1").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
numberOfMonths: 1

});
	
	
	
} );
</script>

