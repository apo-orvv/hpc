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
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" bgcolor='#9999CC'> <strong>  User Details -  ADD /Update </strong><br />
    </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
  </table>
  

<label class="description" for="element_1">User Name </label>
<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="<?= $r1['SOFTNAME']; ?>"/> 
			<label class="description" for="element_12">Type of the Software </label>
		
		<select class="element select medium" id="element_12" name="element_12"> 
			<option value="FEA" >FEA</option>
<option value="CFD" >CFD</option>
<option value="Scientific">Scientific</option>
<option value="3D Modeling">3D Modeling</option>
		</select>
		
		
	  <ul >
	  <li id="li_8" >
		<label class="description" for="element_2">INSTALLED ON </label>
		<div>
				<input id='docom' name='element_2' value="<?= $r1['INSTALLEDON']; ?>">
		
		</div> 
		</li>
	 	<li id="li_3" >
		<label class="description" for="element_3">SOFTWARE USAGE </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="<?= $r1['SWUSAGE']; ?>"/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">PROCURED BY </label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value="<?= $r1['PROCUREDBY']; ?>"/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">INSTALLED BY </label>
		<div>
			<input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value="<?= $r1['INSTALLEDBY']; ?>"/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">NAME OF THE LICENSE SERVER </label>
		<div>
			<input id="element_6" name="element_6" class="element text medium" type="text" maxlength="255" value="<?= $r1['LICENSE_SERVER']; ?>"/> 
		</div> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">TYPE OF THE LICENSE</label>
		<div>
			<input id="element_7" name="element_7" class="element text medium" type="text" maxlength="255" value="<?= $r1['LICENSE_TYPE']; ?>"/> 
		</div> 
		</li>		

		<li id="li_9" >
		<label class="description" for="element_9">NUMBER OF LICENSE</label>
		<div>
			<input id="element_9" name="element_9" class="element text medium" type="text" maxlength="255" value="<?= $r1['NO_OF_LIC']; ?>"/> 
		</div> 
		</li>
		
 <li id="li_11" >
		<label class="description" for="element_8">EXPIRY DATE </label>
		<div>
				<input id='doexp' name='element_8' value="<?= $r1['EXPIRY_DATE']; ?>">
		
		</div> 
		</li>
		
		
		<li id="li_10" >
		<label class="description" for="element_10">Vendor </label>
		<div>
			<input id="element_10" name="element_10" class="element text medium" type="text" maxlength="255" value="<?= $r1['VENDOR']; ?>"/> 
		</div> 
		</li>					
	</ul>
    
      </td> </tr> </table>
	  <div style="align:center"> <input id="saveForm" class="button_text" type="submit" name="savesw" value="Save Details" /> </div>
	 
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
   
   $("#doexp").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
minDate: "2001-01-01",

numberOfMonths: 1
});
   
   
   
});
</script>