<script type="text/javascript">
function printit()
   {
   var prtContent = document.getElementById('printdiv');
   document.getElementById('printdiv').setAttribute("style","margin-top:13px; margin-bottom:4px; margin-left:4px; margin-right:4px;");
    var WinPrint = window.open('', '', 'left=0,top=0,width=600px,height=900px,toolbar=0,scrollbars=0,status=0');
    WinPrint.document.write( prtContent.innerHTML );
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    prtContent.innerHTML=strOldOne;
   }
</script>
<style> 
.textbox { 
    border: 1px solid #848484; 
    -webkit-border-radius: 30px; 
    -moz-border-radius: 30px; 
    border-radius: 30px; 
    outline:0; 
    height:25px; 
    width: 125px; 
    padding-left:10px; 
    padding-right:10px; 
  } 
</style> 

<form method='post'>
<table align='center' cellpadding='0' cellspacing='0' width='100%' style="border:0;"> 
         
 <tr valign ='top'>
    <td style='border:0;text-align:center' height='15' colspan='4' ><b> Enter Request  No. </b> 
      <input class="textbox" name='seqno'  id='tnam2' type='text' maxlength='30' />
        <input  type='submit' name='show' value='Show details' />
        <input  type='submit' name='printall' value='print' onclick='printit()' />
      </i> </td> </tr>
	  <tr>
	  <td> <?php
if($regid =='')  { $errMsg .= "The Request is not available for this request ID." ; echo '<div style="color:#FF0000;text-align:center;font-size:12px;">' .$errMsg;  }
?> </td> 
  </tr>
</table>
</form>
<?php

//$name=$r["user_name"];
$icno=htmlspecialchars($r['icno']);
$name=htmlspecialchars($r['user_name']); 
$phno=htmlspecialchars($r['phoneno']);
$sec=htmlspecialchars($r['section']); 
$div=htmlspecialchars($r['division']);
$grp=htmlspecialchars($r['igroup']);
$email=htmlspecialchars($r['mailid']);
$puname=htmlspecialchars($r['preuname']);
$reqdate=htmlspecialchars($r['datereq']);
$ipadd=htmlspecialchars($r['ipadd']);
$appl=htmlspecialchars($r['applusage']);
$des=htmlspecialchars($r['des']);
$dat=htmlspecialchars($r['datereq']);
//$ser_app=htmlspecialchars($r['ser_app']);
$s=$this->usermodel->serappreq($regid);
if($regid!=""){
//if((isset($_POST['show'])) || (isset($_SESSION['reqid'])) || ($_GET['reqid']!='')){ 
echo "
<div id='printdiv'>
<table  id ='mtab' align='center' cellpadding='10' cellspacing='0' width='100%' >
<tr align='right'> <td style='border:0;' colspan='4'>  Req.Id :  $regid </td> </tr> 
<tr align='center'>
<td style='border:0;text-align:center' align='center' colspan='4' ><span> <b> Indira Gandhi Centre for Atomic Research <br>
Electronics Instrumentation Group <br>
Computing Systems Section / Computer Division <br>
User Account Requisition Form <br> </span> <hr> </td></tr>
<tr> <td style='border:0;' height='12px'> Name : </td> <td style='border:0;'>  $name </td> <td style='border:0;'> IC No. : </td> <td style='border:0;'> $icno </td> </tr>
<tr> <td style='border:0;' height='12px'> Designation :   </td> <td style='border:0;'> $des     </td> <td style='border:0;'>Group/Div/Sec:  </td> <td style='border:0;'> $grp/$div/ $sec   </td> </tr>
<tr> <td style='border:0;' height='12px'> Phone Number:    </td> <td style='border:0;'>  $phno  </td> <td style='border:0;'> E-mail : </td> <td style='border:0;'> $email </td> </tr>
<tr> <td style='border:0;'  height='20px'> Preferred Login Name(s): </td> <td style='border:0;'>   $puname  </td>  </tr>

<tr> <td style='border:0;'  height='20px' colspan='4' >Also enable remote access to HPC system from my desktop PC.  IP Address :   $ipadd    <hr> </td> </tr>

<table  width='100%' > 
<tr> <td style='border:0;' colspan='4' >Requested Server and Application Details </td> </tr>
<TR bgcolor='#aabbcc' >
<TD width='10%'  >Sl.No</TD> 
<TD width='40%' >System Name </TD>
<TD width='50%'  >Applications / Usage </TD>
</TR>";
foreach($s as $r1)
{
 $i=$i+1;
//echo "$r1['fname']";
echo "<tr>
 <td style='border:0;'>$i </td>
 <td style='border:0;'> $r1[sername] </td>
 <td style='border:0;'> $r1[apname] </td>
 </tr>";
} 
$c=$i+1;
if($appl!='')
 { echo "<tr>
 <td style='border:0;'>$c </td>
 <td style='border:0;'>Other Server / Application  </td>
 <td style='border:0;'> $appl  </td> 
 </tr> ";
 }
echo" 
<tr> <td style='border:0;' height='20px' colspan='4'> <hr> </td> </tr>

<tr> <td style='border:0;' colspan='4' height='50px'> Through :     Head of Division  </td> </tr>
<tr> <td style='border:0;' height='10px' colspan='2' >Date : $dat </td> <td style='border:0;' align='right'> Signature of Applicant </td> </tr>
<tr> <td style='border:0;' height='30px' colspan='4'>   <hr> </td> </tr>
<tr> <td style='border:0;' height='20px' colspan='4' align='left' >To: Head, Computer Division</td> </tr>
<tr> <td style='border:0;' height='20px' colspan='4' align='left' ><hr> </td> </tr>

</table>
</div>
</table>";

}

?>
