<form method='post' action="" > 
<table  width='100%' border = "1" align='center' cellpadding='2' cellspacing='0' bgcolor="#FFFFFF"> <tr> <td>
  <table  width='100%' align='center' cellpadding='2' cellspacing='0'     >
   <tr valign ='top' align='center'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> <strong> User Feedback Form</td> 
   </tr>  
   
   <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" style="text-align:center;border:0"> 
          <?php if(isset($errMsg))
              {
            echo '<div style="color:#FF0000;text-align:center;font-size:12px;">'.$errMsg.'</div>'; }?>  </td>
    </tr> 
    <tr valign ='top' align='left'  >
      <td height="15" colspan="4" valign = "top" bgcolor='#9999CC' ><b> User Details </b> </td>
    </tr>
    <tr  valign ='top' align='left' >
	<td width="18%" height="15"  >  IC No <b style="color: blue; font-size: 1.2em">*</b> </td>
      <td width="27%" height="15" align='left'  ><b>
        <input name='uicno' type='text' maxlength='10'  value="<?php echo $r1[ic]; ?>" />
       </b></td> 
    <td width="18%" height="15"  > User ID </td>
      <td width="27%" height="15" align='left'  ><b>
        <input name='uid' type='text' maxlength='10'  value="<?php echo $uname; ?>" />
       </b></td> </tr> 
	   <tr  valign ='top' align='left' >
      <td width="22%" height="15" > Name <b style="color: blue; font-size: 1.2em">*</b></td>
      <td width="33%" height="15" align='left' ><b>
        <input name='name'  id='tnam' type='text' maxlength='30' value="<?php echo rtrim($r1[uname],"."); ?>" />
      </b></td>  
    

<td height="15" align='left'> Designation</td>
      <td height="15" align='left'><b>
        <input name='des' type='text' maxlength='10' value="<?php echo $r1[emptype]; ?>" />
        </b></td> 
		</tr>
		<tr valign ='top' align='center' >
      <td width="18%" height="15"  > Section / Division /Group <b style="color: blue; font-size: 1.2em">*</b></td>
      <td width="27%" height="15" align='left'  ><b>
        <input name='sec' type='text' maxlength='10' value="<?php echo $r1[grpinfo]; ?>" />
       </b></td>
    
        <td height="15" align="left">IP Address </td>
      <td height="15" align='left' ><b>
        <input name='ipadd'  id='tnam3' type='text' maxlength='30' value="<?php echo $r1[hostip] ?>" />
      </b></td>
         
    </tr>
<tr valign ='top' align='center' >
      <td  height="15" align="left"> Phone : <b style="color: blue; font-size: 1.2em">*</b> </td>
      <td  height="15" align='left' ><b>
        <input name='phone'  id='tnam3' type='text' maxlength='30' value="<?php echo $r1[phone]; ?>" />
      </b></td>
      <td height="15" align='left'> E-Mail <b style="color: blue; font-size: 1.2em">*</b> </td>
      <td height="15" align='left'><b>
        <input name='email' type='text' maxlength='30' value="<?php echo $r1[email]; ?>" />
        </b></td>
    </tr>

<!--<tr valign='top' align='left'>
 <td colspan='4'> Your User name is available in the <?php echo $serusage; ?> </td>
 </tr>-->

</table>
  <table  width='100%' align='center' cellpadding='2' cellspacing='0'>  
    <tr valign ='middle' align='left'>
      <td height="23" colspan="2" bgcolor='#9999CC'><strong>System / Software Usage </strong> <br/> ( Please select the servers / software relavent for you)</td>
    </tr>
      <tr valign ='top' align='center'>
      <td  height="15" align="left" > <strong>Servers <b style="color: blue; font-size: 1.2em">*</b></td>
      <td  height="15" align='left' >

<table> <tr> <td style="border:0">  <input name="serid[]" id="txt2" type="checkbox" value="SMP Server"><b>SMP Server</td>
<td style="border:0"> <input name="serid[]" id="txt2" type="checkbox" value="HPC Cluster"><b>HPC Clusters </td>
<td style="border:0"> <input name="serid[]" id="txt2" type="checkbox" value="Workstations"> <b> Workstations</td> </tr>
 </table>     
    </tr>

<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td   align="left" style="border:0">  <strong>Application Software <b style="color: blue; font-size: 1.2em">*</b></td>
      <td   align='left' >
<table><tr>
       <td style="border:0"><input name="serapp[]" id="txt2" type="checkbox" value="FEM&A"><b>FEM&A</td>
<td style="border:0"><input name="serapp[]" id="txt2" type="checkbox" value="CFD"><b>CFD</td>
<td style="border:0">
<input name="serapp[]" id="txt2" type="checkbox" value="3D MODELING"><b>3D MODELING
</td></tr>
<tr> <td colspan='3' style="border:0">
<p><input name="serapp[]" id="txt2" type="checkbox" value="MATHEMATICAL & SCI. COMPUTING (Fortran, C/C++)"><b>MATHEMATICAL & SCI. COMPUTING (Fortran, C/C++) </td> 
</td style="border:0">  <td colspan='3' style="border:0">
<p><input name="serapp" id="txt2" type="checkbox" ><b>Others if any <input name='othersw'  id='tnam' type='text' maxlength='100'/></td> </tr> </table>
</td> </tr>
<tr valign ='middle' align='left'>
      <td height="23" colspan="2" bgcolor='#9999CC'><strong>Please Rate the High Performance Computing (in a scale from 1 to 10, 10 being the highest rating )</td>
    </tr>
<tr> <td colspan="2">
<table style="text-align: center"> 
<tr> <td colspan="10" style="text-align: left"><strong>(1). Availability/Uptime of the Computing Facility <b style="color: blue; font-size: 1.2em">*</b></td>
 <td style="width: 30px"> 
  <div><input type="radio" name="availa" value="1" ></div> <div><b>1</div></td>
  <td style="width: 30px"> <div><input type="radio" name="availa" value="2" ></div><div><b> 2 </div></td>   
<td style="width: 30px"> <div><input type="radio" name="availa" value="3" ></div><div> <b>3 </div></td>
<td style="width: 30px"> <div><input type="radio" name="availa" value="4" ></div><div><b> 4 </div></td>
<td style="width: 30px">  <div><input type="radio" name="availa" value="5" ></div><div><b> 5 </div></td>
<td style="width: 30px"><div><input type="radio" name="availa" value="6" ></div><div><b> 6 </div></td>
<td style="width: 30px"><div><input type="radio" name="availa" value="7" > </div><div><b>7 </div></td>
<td style="width: 30px">  <div><input type="radio" name="availa" value="8" ></div><div><b> 8 </div></td>
<td style="width: 30px"><div><input type="radio" name="availa" value="9" ></div><div> <b>9 </div></td>
<td style="width: 30px"> <div><input type="radio" name="availa" value="10" ></div><div> <b>10 </div></td>
</tr>
<tr > <td colspan="10" style="text-align: left"> <strong>(2). Existing Computing Facility in meeting the user requirements <b style="color: blue; font-size: 1.2em">*</b></td> 
 <td> 
  <div><input type="radio" name="upgra" value="1" ></div><div><b> 1 </div></td>
  <td> <div><input type="radio" name="upgra" value="2" ></div><div><b> 2 </div></td>   
<td> <div><input type="radio" name="upgra" value="3" ></div><div><b> 3 </div></td>
<td> <div><input type="radio" name="upgra" value="4" ></div><div><b> 4 </div></td>
<td>  <div><input type="radio" name="upgra" value="5" ></div><div><b> 5 </div></td>
<td><div><input type="radio" name="upgra" value="6" > </div><div><b> 6 </div></td>
<td><div><input type="radio" name="upgra" value="7" ></div><div><b> 7 </div></td>
<td> <div><input type="radio" name="upgra" value="8" > </div><div><b>8 </div></td>
<td><div><input type="radio" name="upgra" value="9" > </div><div><b>9 </div></td>
<td> <div><input type="radio" name="upgra" value="10" ></div><div><b> 10 </div></td>
</tr>

<tr> <td colspan="10" style="text-align: left"> <strong>(3). Technical Support provided by computer centre <b style="color: blue; font-size: 1.2em">*</b></td>  <td> 
  <div><input type="radio" name="tech" value="1" ></div><div> <b> 1 </div></td>
  <td> <div><input type="radio" name="tech" value="2" ></div><div> <b>2 </div></td>   
<td> <div><input type="radio" name="tech" value="3" ></div><div><b> 3 </div></td>
<td> <div><input type="radio" name="tech" value="4" ></div><div><b> 4 </div></td>
<td>  <div><input type="radio" name="tech" value="5" ></div><div><b> 5 </div></td>
<td><div><input type="radio" name="tech" value="6" ></div><div><b> 6 </div></td>
<td><div><input type="radio" name="tech" value="7" ></div><div> <b>7 </div></td>
<td><div>  <input type="radio" name="tech" value="8" ></div><div><b> 8 </div></td>
<td><div><input type="radio" name="tech" value="9" ></div><div><b> 9 </div></td>
<td> <div><input type="radio" name="tech" value="10" ></div><div><b> 10 </div></td>
</tr>
</table> </td> </tr>
<tr valign ='top' align='center' bgcolor='#D3D3D3'>
      <td   align="left">  <strong>Overall User satisfaction index (0-100) <b style="color: blue; font-size: 1.2em">*</b></td>
      <td   align='left' > <input name='sindex' type='text' maxlength='3'/> % </td> </tr>
<tr valign ='top' align='center' >
      <td   align="left">  <strong>Suggestion / Remarks, if any</td>
      <td   align='left' > <textarea name='remark' rows='4' cols='80' maxlength="1000"> </textarea> </td> </tr>

<tr valign ='middle' align='center'>
 <td align='center' colspan=4 bgcolor='#666666'><i>
  <div  align='center'>
    <input  type='submit' name='csave' value='Submit' />
  </div>
</i></td>
    </tr>	
      <tr>
          <td align="left" colspan="4"> <div id="myform_errorloc" class="error_strings">
       </div></td>
      </tr>
  </table>
  <table width='100%'>
	<tr valign ='top' align='center'>
     <td height="15"align='left'  ><i>
        <div  align='Left'><i><?php echo ($comment); ?></i></div>
                              </i></td>
    </tr>
</table>
 </table>
 </td> </td> </table>
</td> </tr>
<tr><td><div><i>Note: Fields marked <b style="color: blue; font-size: 1.2em">*</b> are mandatory.</i></div></td></tr>
<tr><td></td></tr>
</table>
</form>

