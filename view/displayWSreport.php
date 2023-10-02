<!--<link type="text/css" href="view/DataTables-1.10.5/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" />-->
<link type="text/css" href="view/DataTables/Buttons-1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="/view/DataTables/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="/view/selectcss.css" rel="stylesheet" />
<link type="text/css" href="/view/js/jquery-ui.css" rel="stylesheet" />

<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>

<script type="text/javascript" charset="utf8" src="view/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.5/media/js/jszip.min.js"> </script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/pdfmake-0.1.32/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables/Buttons-1.5.1/js/buttons.print.min.js"></script>

<style>
    .ui-datepicker-calendar {
        display: none;
    }
    </style>
<?php
include "view/displaysystembanner.php";
echo "<div class='w3-container'>";

$timeofmon=$licenses[0][0];

echo "<form id='form1' method='post' action=\"index.php?hpcpage=systemdetails&systemname=$systemname&systemparam=GWS_Monthly_Usage\">";
echo "<table class='querytable' align='center'  cellspacing='0' border=1><tr><td>Select Month and Year</td><td><input type='text' id='txtFDt' name='monyear' /></td></tr><tr><td colspan='7' align='center' style='color:red'> <input type='submit' name='showgwsusage' value='Submit'>   $msg  </td></tr> <tr> </tr> </table>";
echo "</form><br/>";

echo "<h4>$pagetitle</h4>";
echo "<table id='usertable' class='display' align='center' cellpadding='1' cellspacing='0'  border=1><thead><tr ><th width='20%'>GWS Name </th><th width='20%'>Logged-in User </th><th width='20%'>Date </th><th width='20%'>Logged-in Hours</th><th width='20%'>Average CPU utilization</th></tr></thead><tbody>";
foreach ($WSReport as $GWSReport1){
	$nohours=$GWSReport1[2]*3;
	
	 $gwstime = date("d-m-Y", strtotime($GWSReport1[4])); 
echo "<tr><td>$GWSReport1[0]</td><td>$GWSReport1[1]</td><td>$gwstime</td><td>$nohours</td><td>".round($GWSReport1[3],2)."</td></tr>";
}

echo "</tbody></table>";
echo "</div>";
?>

<script>


$(document).ready(function() {
    $('#usertable').DataTable( {
        "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
		dom: 'Bfrtip',
        buttons: [
            'pdf', 'print'
        ]
        
    } );
	
	
	 $('#txtFDt').datepicker({
     changeMonth: true,
     changeYear: true,
     dateFormat: 'MM yy',
	 
       
     onClose: function() {
        var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
     },
       
     beforeShow: function() {
       if ((selDate = $(this).val()).length > 0) 
       {
          iYear = selDate.substring(selDate.length - 4, selDate.length);
          iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), $(this).datepicker('option', 'monthNames'));
          $(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
           $(this).datepicker('setDate', new Date(iYear, iMonth, 1));
       }
    }
  });
	
});
	
</script>




