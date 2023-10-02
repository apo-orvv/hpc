 
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<link rel="stylesheet" href="view/js/jquery-ui.css">
<script src="view/js/jquery.min.js"></script>
<script src="view/js/jquery-ui.min.js"></script>

<link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>
 



<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	font-size: 9px;
	font-style: italic;
}
-->

.button {
    background-color: #9999CC; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
</style>
<form method="post"  action="" > 
<table  class='bordercollap' width='100%' border = "1" align='center' cellpadding='1' celspacing='0' bgcolor="#FFFFFF"> 
  <tr> <td>
  <table  width='100%' align='center' cellpadding='1' cellspacing='0' height="250px"    >
   <tr valign ='top' align='center'  >
       <td height="15" colspan="4" valign = "top" style="text-align:center;border:0" > <strong>  Requisition Form for Thin Client Installation  </strong><br /></td> 
   </tr>
     <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "to p" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr>
    <tr valign ='top' align='left'>
      <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' style="text-align:center;border:0" ><b>User Profile </b> </td>
    </tr>
 <tr  valign ='top' align='left' >
 <td width="18%" height="15"  > IC. No.<span class="style1">*</span></td>
      <td width="27%" height="15" align='left'><b>
        <input name='icno' type='text' maxlength='10'  value="<?php echo $_POST['icno']; ?>" required="required"/>
       </b></td>
      <td width="22%" height="15" > Name <span class="style1">*</span></td>
      <td width="33%" height="15" align='left' ><b>
        <input name='name'  id='tnam' type='text' maxlength='30' required="required" value="<?php echo $_POST['name']; ?>"/>
      </b></td>  
    </tr>
<tr  valign ='top' align='left' >
      <td height="15" align='left'> Designation</td>
      <td height="15" align='left'><b>
       <input name='des'  id='tnam3' type='text' maxlength='30' value="<?php echo $_POST['des']; ?>"/>
      </b></td>
      <td width="18%" height="15"  > Section </td>
      <td width="27%" height="15" align='left'  ><b>
        <input name='sec' type='text' maxlength='30' value="<?php echo $_POST['sec']; ?>"  />
       </b></td>
    </tr>
    <tr valign ='top' align='center' >
      <td height="15" align="left"> Division </td>
      <td height="15" align='left' ><b>
    <input name='div'  id='tnam3' type='text' maxlength='30' value="<?php echo $_POST['div']; ?>"/>
      </b></td>
      <td height="15" align="left"> Group <span class="style1">*</span></td>
      <td height="15" align='left' ><b>
      <select id="grp" name="grp" >                      
      <option value="eig" <?php if($_POST['grp'] == "eig") { echo "selected=\"selected\""; } ?>>EIG</option>
      <option value="rdg" <?php if($_POST['grp'] == "rdg") { echo "selected=\"selected\""; } ?>>RDG</option>
      <option value="mmg" <?php if($_POST['grp'] == "mmg") { echo "selected=\"selected\""; } ?>>MMG</option>
      <option value="rpg" <?php if($_POST['grp'] == "rpg") { echo "selected=\"selected\""; } ?>>RPG</option>
      <option value="rfg" <?php if($_POST['grp'] == "rfg") { echo "selected=\"selected\""; } ?>>RFG</option>
      <option value="frtg" <?php if($_POST['grp'] == "frtg") { echo "selected=\"selected\""; } ?>>FRTG</option>
      <option value="msg" <?php if($_POST['grp'] == "msg") { echo "selected=\"selected\""; } ?> >MSG</option>
      <option value="mc&mfcg" <?php if($_POST['grp'] == "mc&mfcg") { echo "selected=\"selected\""; } ?>>MC&MFCG</option>
      <option value="hseg" <?php if($_POST['grp'] == "hseg") { echo "selected=\"selected\""; } ?>>HSEG</option>
      <option value="esg" <?php if($_POST['grp'] == "esg") { echo "selected=\"selected\""; } ?>>ESG</option>
      <option value="rmg" <?php if($_POST['grp'] == "rmg") { echo "selected=\"selected\""; } ?>>RMG</option>
      <option value="frfcf" <?php if($_POST['grp'] == "frfcf") { echo "selected=\"selected\""; } ?>>FRFCF</option>
      <option value="sri" <?php if($_POST['grp'] == "sri") { echo "selected=\"selected\""; } ?>>SRI</option>
      <option value="barc" <?php if($_POST['grp'] == "barc") { echo "selected=\"selected\""; } ?>>BARCF</option>
      <option value="bhavini" <?php if($_POST['grp'] == "bhavini") { echo "selected=\"selected\""; } ?>> BHAVINI</option>
    </select>	
      </b></td>   
    </tr>
<tr valign ='top' align='center' >
      <td  height="15" align="left"> Phone<span class="style1">*</span></td>
      <td  height="15" align='left' ><b>
        <input name='phone'  id='tnam3' type='text' maxlength='30' required="required" value="<?php echo $_POST['phone']; ?>"/>
      </b></td>
      <td height="15" align='left'> E-Mail <span class="style1">*</span></td>
      <td height="15" align='left'><b>
        <input name='email' type='text' maxlength='30' required="required" value="<?php echo $_POST['email']; ?>"/>
        </b></td>
    </tr>
<tr valign ='top' align='center' >
      <td height="15" align="left"> Preferred Date: </td>
      <td height="15" align='left' ><b>
        <input id='datepicker' name='predate' value="<?php echo $_POST['predate']; ?>"> 
		
      </b></td>
      <td height="15" align='left'> IP. Address</td>
      <td height="15" align='left'><b>
        <input name='ipadd' type='text' maxlength='12' onchange='validate(this.value)' value="<?php echo $_POST['ipadd']; ?>"/>
        </b></td>
    </tr>
</table>
  <div  align='center'>
    <input  type='submit' name='csave' class="button" value='Submit' />
  </div>
 </table>
 </td> </td> </table>

</form>



<script>

$(document).ready(function() {
    $("#datepicker").datepicker({
changeMonth: true,
changeYear: true,
dateFormat: "yy-mm-dd",
numberOfMonths: 1
})
} );


</script>