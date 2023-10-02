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
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" bgcolor='#9999CC'> <strong>  Workstation Assignment Status -  ADD /EDIT </strong><br />
    </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
  </table>
  
	
		<label class="description" for="element_1">Workstation Name </label>
		
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value="<?= $r1['WSname']; ?>"/> 
			
		 <ul ><li id="li_2" >
		<label class="description" for="element_2">Workstation Make </label>
		<div>
			<input id="element_2" name="element_2" class="element text medium" type="text" maxlength="255" value="<?= $r1['WSmake']; ?>"/> 
		</div> 
		</li>
		
		<li id="li_3" >
		<label class="description" for="element_3">Workstation OS</label>
		<div>
			<input id="element_3" name="element_3" class="element text medium" type="text" maxlength="255" value="<?= $r1['wsOS']; ?>"/> 
		</div> 
		</li>
		
		
		<li id="li_4" >
		<label class="description" for="element_4">Workstation IP</label>
		<div>
			<input id="element_4" name="element_4" class="element text medium" type="text" maxlength="255" value="<?= $r1['WSIP']; ?>"/> 
		</div> 
		</li>
		
		
		<li id="li_5" >
		<label class="description" for="element_5">Workstation Assignment Group</label>
		<select class="element select medium" id="element_5" name="element_5"> 
			<option value="RDTG"  >RDTG</option>
<option value="Common Workstation" >Common Workstation</option>
<option value="MCMFCG" >MCMFCG</option>
		</select>
		</li>
		</li>		<li id="li_6" >
		<label class="description" for="element_6">Workstation Status </label>
		<div>
			<textarea id="element_6" name="element_6" class="element text medium" type="text"  rows="4" cols="60"   onblur="document.getElementById('element_6').innerHTML=this.value.replace('\n','<br/>')"/>  <?= $r1['WScurstatus']; ?> </textarea>
		</div> 
	
			<li id="li_7" >
		<label class="description" for="element_7">Remarks </label>
		<div>
			<textarea id="element_7" name="element_7" class="element text medium" type="text"  rows="4" cols="60" /> <?= $r1['WSremarks']; ?></textarea>
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
