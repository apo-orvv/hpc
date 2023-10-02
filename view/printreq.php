<SCRIPT TYPE="text/javascript">
function toggleFields(id)
 {
     var e = document.getElementById(id);
     var d = document.getElementById('papersize').value;
       if(d==1)
	   {
	           e.style.display = 'inline';
		  }
       else
          e.style.display = 'none';
}


function enableTextbox() {
if (document.getElementById("papersize").value == "Custom") {
document.getElementById("cus1").disabled = false;
}
else {
document.getElementById("cus1").disabled = true;
}
}

function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 5){							// limit the user for number of files uploading
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Maximum File Upload per request is 5.");
	   
	}
}
function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null !== chkbox && true === chkbox.checked) {
			if(rowCount <= 1) { 						// limit the user from removing all the fields
				alert("Cannot Remove all the Files.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}
</SCRIPT>  
<style>
/* Tooltip container */
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color:#9999FF;
    color: black;
    text-align: center;
    padding: 5px 0;
    border-radius: 6px;
 
    /* Position the tooltip text - see examples below! */
    position: absolute;
    z-index: 1;
}
/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
    visibility: visible;
}
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 9px;
	font-style: italic;
}
-->
</style>

<form method='post' action="index.php?hpcpage=printreq" name="myform" id="myform" enctype="multipart/form-data"> 
<table  width='100%' border = "1" align='center' cellpadding='1' cellspacing='0' bgcolor="#FFFFFF" > 
  <tr> <td>
  <table width='100%'  align='center' cellpadding='1' cellspacing='0'>
   <tr valign ='top' align='center'  >
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> <strong>  Print Requisition Form </strong><br />
       <em >(Kindly fill the form, Take a print and submit through proper channel) </em>
	   <br> <em style="color:blue">(Total allowed File size for uploading: 50MB, Allowed Formats:jpeg,bmp,doc,docx,ppt,pptx,pdf) </em></td> 
   </tr>
   <tr valign ='top' align='left'  >
      <td style="text-align:center;border:0" height="15" colspan="4" valign = "top"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
    <tr valign ='top' align='left'>
      <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' style="text-align:center;border:0" ><b>User Details </b> </td>
    </tr>
  <tr>
    <td width="25%" > IC_No:  <span class="style1">*</span> </td>
    <td width="25%" ><input type="text" required="required" name="icno" id="icno"  value="<?php echo $_POST['icno']; ?>"/>    </td>
    <td  width="25%"><label for="name">Name:</label>  <span class="style1">*</span>  </td>
    <td  width="25%"><input required="required" type="text" name="lastname" id="name" value="<?php echo $_POST['lastname']; ?>" />    </td>
  </tr>
  <tr>
    <td ><label for="division">Section/Division/Group:</label> <span class="style1">*</span>   </td>
    <td ><input type="text" required="required" name="div" id="division" value="<?php echo $_POST['div']; ?>" /></td>
    <td  ><label for="date">Designation</label></td>
    <td  ><b>
      <select id="des" name="des" >
        <option value="SO/C" <?php if($_POST['des'] == "SO/C") { echo "selected=\"selected\""; } ?>>SO/C</option>
        <option value="SO/D" <?php if($_POST['des'] == "SO/D") { echo "selected=\"selected\""; } ?>>SO/D</option>
        <option value="SO/E" <?php if($_POST['des'] == "SO/E") { echo "selected=\"selected\""; } ?> >SO/E</option>
        <option value="SO/F" <?php if($_POST['des'] == "SO/F") { echo "selected=\"selected\""; } ?>>SO/F</option>
        <option value="SO/G" <?php if($_POST['des'] == "SO/G") { echo "selected=\"selected\""; } ?>>SO/G</option>
        <option value="SO/H" <?php if($_POST['des'] == "SO/H") { echo "selected=\"selected\""; } ?>>SO/H</option>
        <option value="SO/SB" <?php if($_POST['des'] == "SO/SB") { echo "selected=\"selected\""; } ?>>SO/SB</option>
        <option value="SA/B" <?php if($_POST['des'] == "SA/B") { echo "selected=\"selected\""; } ?>>SA/B</option>
        <option value="SA/C" <?php if($_POST['des'] == "SA/C") { echo "selected=\"selected\""; } ?>>SA/C</option>
        <option value="SA/D" <?php if($_POST['des'] == "SA/D") { echo "selected=\"selected\""; } ?>>SA/D</option>
        <option value="SA/E" <?php if($_POST['des'] == "SA/E") { echo "selected=\"selected\""; } ?>>SA/E</option>
        <option value="SA/F" <?php if($_POST['des'] == "SA/F") { echo "selected=\"selected\""; } ?>>SA/F</option>
        <option value="SA/G" <?php if($_POST['des'] == "SA/G") { echo "selected=\"selected\""; } ?>>SA/G</option>
        <option value="JRF" <?php if($_POST['des'] == "JRF") { echo "selected=\"selected\""; } ?>>JRF</option>
        <option value="SRF" <?php if($_POST['des'] == "SRF") { echo "selected=\"selected\""; } ?>>SRF</option>
        <option value="VS" <?php if($_POST['des'] == "VS") { echo "selected=\"selected\""; } ?>>VS</option>
      </select>
    </b></td>
  </tr>
  <tr>
    <td> Email Address: </td>
    <td ><input type="text" name="email" required="required" id="emailAddress" value="<?php echo $_POST['email']; ?>" />    </td>
    <td > Phone no. <span class="style1">*</span></td>
    <td ><input type="text" name="phone" required="required" id="phn"  value="<?php echo $_POST['phone']; ?>" />    </td>
  </tr>
  <tr>
     <td ><label for="purpose">Purpose:</label>    </td>
    <td ><input type="text" width="250" name="purpose" required="required" id="purpose"  value="<?php echo $_POST['purpose']; ?>"/>    
	</td>
	<td  ><label for="date">Date 
of Requisition </label></td>
    <td  ><input type="text" name="email2" id="email"  disabled="disabled" value="<?php echo date('Y-m-d'); ?>"/> </td>
  </tr>	
</table>
<table border="1" width="100%" align="left">
<TR  align="left" >
 <td colspan="6"  bgcolor="" align="left"> <div class="tooltip"><img src="view/image/addfile.png" alt="Add File" style="width:35px;height:30px;" value="Add File" onClick="addRow('dataTable')"  >
  <span class="tooltiptext">Upload more</span></div>
  
  <div class="tooltip"><img src="view/image/delfile.png" alt="Delete selected" style="width:35px;height:30px;" value="Remove File" onClick="deleteRow('dataTable')"  >
  <span class="tooltiptext">Delete selected File</span></div>
 </td> 
</tr>
<TR bgcolor='#9999CC'>
<TD width="5%">Check</TD> 
<TD width="30%">Upload File</TD>
<TD width="23%">Paper Type </TD>
<TD width="22%">Paper Size</TD> 
<TD width="20%">No.of Prints</TD>
</TR>
</table>
<table id="dataTable" width="100%" border="1">
   <tbody>
   <tr>
        <td width="5%"><input type="checkbox" name="chk[]" checked="" /></td>
		<TD width="30%" ><input type="file" name="uploaded_file[]" value="<?php echo $_POST['uploaded_file']; ?>"/></TD>
		<td width="23%"><select id="papertype" name="papertype[]">
            <option value="Glossy" <?php if($_POST['papertype'] == "Glossy") { echo "selected=\"selected\""; } ?> >Glossy</option>
            <option value="Plain" <?php if($_POST['papertype'] == "Plain") { echo "selected=\"selected\""; } ?>>Plain</option>
          </select></td>				  
<td width="22%" > <select id="papersize" name="papersize[]" onChange="enableTextbox()";>                      
      <option value="A0" selected="selected" <?php if($_POST['papersize'] == "A0") { echo "selected=\"selected\""; } ?>>A0</option>
      <option value="A1" <?php if($_POST['papersize'] == "A1") { echo "selected=\"selected\""; } ?>>A1</option>
      <option value="A2" <?php if($_POST['papersize'] == "A2") { echo "selected=\"selected\""; } ?> >A2</option>
      <option value="A3" <?php if($_POST['papersize'] == "A3") { echo "selected=\"selected\""; } ?> >A3</option>
      <option value="Custom" <?php if($_POST['papersize'] == "") { echo "selected=\"selected\""; } ?>>Custom</option>
    </select> <div id="cus[]">
  <input name="cus1[]" type="text" id="cus1"  value=""/>
</div> </td>
<td width="20%">
			<input type="text" required="required" name="nprint[]" value=""/>        </td>			
      </tr></tbody></table>
<table width="100%" align="center">
    <tr align="centre">
<td style="text-align:center;border:0" ><input type="submit" value="Apply & Print" name="save" /></td>
</tr> </table> 
</td> </tr> </table>
</form>



