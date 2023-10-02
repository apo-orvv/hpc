<head>
 <style type="text/css">

<meta name="viewport" content="width=device-width, initial-scale=1">
* {
    box-sizing: border-box;
}

body {
    margin: 0;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 50px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}

</style>
</head>
<link rel="stylesheet" type="text/css" href="view/view.css" media="all">
<script type="text/javascript" src="view/view.js"></script>

<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>

<form method="post"  action="" > 
<div class='w3-container'>
<table  class='bordercollap' width='100%' border = "1" align='center' cellpadding='1' cellspacing='0' bgcolor="#FFFFFF"> 
  <tr> <td>
  <table  width='100%' align='center' cellpadding='1' cellspacing='0'     >
   <tr valign ='top' align='center'  >
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" bgcolor='#9999CC'> <strong>  IP Address Details -  ADD /EDIT </strong><br />
    </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
  </table>
  
	
		<label class="description" for="element_1">System Name </label>
		
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="<?= $r1['sysname']; ?>"/> 
			
		 <ul ><li id="li_2" >
		<label class="description" for="element_2">Login Name </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="<?= $r1['login_name']; ?>"/> 
		</div> 
		</li>
			<label class="description" for="element_12">Select type of the IP Address </label>
		
		<select class="element select medium" id="element_12" name="element_12"> 
			<option value="Internal" >HPC Network</option>
<option value="External" >External Network</option>
<option value="internal & External" >Both</option>
		</select>
		
			<li id="li_3" >
		<label class="description" for="element_3">IP Address </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="<?= $r1['ipadd']; ?>"/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Location </label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value="<?= $r1['location']; ?>"/> 
		</div> 
		</li>		


 <li id="li_5" >
                <label class="description" for="element_5">Remarks, if any </label>
                <div>
                        <input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value="<?= $r1['remark']; ?>"/>
                </div>
                </li>
		</ul>
    
      </td> </tr> </table>
	  <div style="align:center"> <input id="saveForm" class="button_text" type="submit" name="saveip" value="Submit" /> </div>
	 
	 </div>
</form>
</html>

<script>
$(document).ready(function() {
    $("#docom").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
minDate: "2001-01-01",
maxDate: "+1D",
numberOfMonths: 1
});
   
});
</script>
