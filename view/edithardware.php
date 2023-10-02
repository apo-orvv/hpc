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
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" bgcolor='#9999CC'> <strong>  System Hardware Details -  ADD /EDIT </strong><br />
    </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
  </table>
  
	
		<label class="description" for="element_1">System Name </label>
		
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="<?= $r1['SYSNAME']; ?>"/> 
			<label class="description" for="element_12">Select type of the System </label>
		
		<select class="element select medium" id="element_12" name="element_12"> 
			<option value="Cluster" >Cluster</option>
<option value="Server" >Server</option>
<option value="Workstation" >Workstation</option>
<option value="Printer" >Printer</option>
<option value="Switch" >Switch</option> 
		</select>
		
		
	  <ul ><li id="li_2" >
		<label class="description" for="element_2">Description </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="<?= $r1['DESCRIPTION']; ?>"/> 
		</div> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Configuration </label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="<?= $r1['CONFIG']; ?>"/> 
		</div> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Performance </label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value="<?= $r1['PERFORMANCE']; ?>"/> 
		</div> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Processor </label>
		<div>
			<input id="element_5" name="element_5" class="element text medium" type="text" maxlength="255" value="<?= $r1['PROCESSOR']; ?>"/> 
		</div> 
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Select type of network </label>
		<div>
		<select class="element select medium" id="element_6" name="element_6"> 
			<option value="HPC" >HPC Network</option>
            <option value="External" >External Network</option>

		</select>
		
			<!-- <input id="element_6" name="element_6" class="element text medium" type="text" maxlength="255" hidden value="<?= $r1['NETWORK']; ?>"/> -->
		</div> 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Sysstorage </label>
		<div>
			<input id="element_7" name="element_7" class="element text medium" type="text" maxlength="255" value="<?= $r1['SYSSTORAGE']; ?>"/> 
		</div> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">Date of commisioned </label>
		<div>
		
		<input id='docom' name='docom' value="<?= $r1['DOCOMI']; ?>">
		
		
		</div> 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">Procured by </label>
		<div>
			<input id="element_9" name="element_9" class="element text medium" type="text" maxlength="255" value="<?= $r1['PROCUREDBY']; ?>"/> 
		</div> 
		</li>		<li id="li_10" >
		<label class="description" for="element_10">Vendor </label>
		<div>
			<input id="element_10" name="element_10" class="element text medium" type="text" maxlength="255" value="<?= $r1['VENDOR']; ?>"/> 
		</div> 
		</li>		<li id="li_11" >
		<label class="description" for="element_11">IP Address </label>
		<div>
			<input id="element_11" name="element_11" class="element text medium" type="text" maxlength="255" value="<?= $r1['IPADDRESS']; ?>"/> 
		</div> 
		</li>
			
		<li id="li_12" >
		<label class="description" for="element_12">Software Installed </label>
		<div>
		<select id ="element_12" multiple name=selsoft[]>
    <?php foreach($r2 as $soft): ?>
        <option value="<?= $soft['SOFTID']; ?>"><?= $soft['SOFTNAME']; ?></option>
    <?php endforeach; ?>
</select>

		</div> 
		</li>			
				
	
			</ul>
    
      </td> </tr> </table>
	  <div style="align:center"> <input id="saveForm" class="button_text" type="submit" name="savehw" value="Submit" /> </div>
	 
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