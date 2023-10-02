
<?php
//print_r($r);
 $icno=htmlspecialchars($r[1]); 
$name=htmlspecialchars($r[2]); 
//echo "ICNO,Name". $icno ;

$des=htmlspecialchars($r[10]);
$pur=htmlspecialchars($r[3]); 
$div=htmlspecialchars($r[4]);
$phno=htmlspecialchars($r[6]);
$email=htmlspecialchars($r[5]); 
$rdate=htmlspecialchars($r[8]);
$cdate=htmlspecialchars($r[9]);
$pstat=htmlspecialchars($r[9]);
//echo $name;
//echo $ser;
$f=$this->printmodel->fetchfile($regid); 
?>
<script type="text/javascript">
function printit()
   {
   var prtContent = document.getElementById('printdiv');
   document.getElementById('printdiv').setAttribute("style","margin-top:5px");
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
    -webkit-border-radius: 250px; 
    -moz-border-radius: 250px; 
    border-radius: 250px; 
    outline:0; 
    height:25px; 
    width: 125px; 
    padding-left:10px; 
    padding-right:10px; 
  } 
</style> 
<form method='post'>
<table align='center' cellpadding='0' cellspacing='0' width='100%'> 
 <tr valign ='top'>
    <td height='15' colspan='4'  ><b> Enter print request ID: </b> 
      <input class="textbox" name='seqno'  id='tnam2' type='text' maxlength='30' />
      <input  type='submit' name='show' value='Show details' />
      <input  type='submit' name='printall' value='print' onclick='printit()' />	
      </i></td>
  </tr> 
  <tr> <td> <?php

if($regid =='')  { $errMsg .= "The Request is not available for this request ID." ; echo '<div style="color:#FF0000;text-align:center;font-size:12px;">' .$errMsg;  }

?> </td> </tr>
  
</table>
</form>

<?php if((isset($_POST['show'])) || (isset($_SESSION['reqid'])) || ($_GET['reqid']!='')){ ?>
<div id='printdiv'>
<table  style="border:0" id ='mtab' cellpadding='10' cellspacing='0' width='100%' >
<tr > <td  colspan='4' style="border:0;text-align=right">  Req.Id <?php echo $regid ; ?> </td> </tr> 
<tr align='center'>
<td align='center' colspan='4' style="border:0;text-align=left" ><span> <b> Indira Gandhi Centre for Atomic Research <br>
Electronics Instrumentation Group <br>
Computer Division <br>
Print Requisition Form <br>  </b>
</span> <hr> </td>  </tr> 
<tr> <td style="border:0;text-align=left" height='20px'> Name : </td> <td style="border:0;text-align=left"><?php echo  $name; ?> </td> <td style="border:0;text-align=left"> IC No. : </td> <td style="border:0;text-align=left"> <?php echo $icno; ?> </td> </tr>
<tr> <td style="border:0;text-align=left" height='20px'> Sec/Div/Group:   </td> <td style="border:0;text-align=left" >  <?php echo $div; ?>   </td> <td style="border:0;text-align=left"> Designation : </td> <td style="border:0;text-align=left"> <?php echo $des; ?> </td> </tr>
<tr> <td style="border:0;text-align=left" height='20px'> Phone Number:    </td> <td style="border:0;text-align=left">  <?php echo $phno; ?>  </td> <td style="border:0;text-align=left"> E-mail : </td> <td style="border:0;text-align=left"> <?php echo $email; ?> </td> </tr>
<tr> <td style="border:0;text-align=left" colspan='4' height='30px' > Purpose :   <?php echo $pur; ?>  </td> </tr> </table>

<table  width='100%' style="border:0;text-align=left"> 
<tr> <td colspan='5' align='left'>  File Details </td> </tr>
<TR >
<TD width='10%'>Sl.No</TD> 
<TD width='30%'>File Name / Format</TD>
<TD width='25%' >Paper Type </TD>
<TD width='25%'>Paper Size</TD> 
<TD width='10%'>No.of Prints</TD>
</TR> 
<?php
$slno=0;
 foreach($f as $file)
{
$slno++;
echo"<tr> <TD width='10%'>".$slno."</TD> 
<TD width='30%'>".$file[fname]."</TD>
<TD width='25%' >".$file[papertype] ."</TD>
<TD width='25%'>".$file[papersize] ."</TD> 
<TD width='10%'>".$file[nprint] ."</TD>
</TR> "; 
} 
?>

</table> 
<table width='100%' style="border:0;text-align=left">
<tr> <td  style="border:0;text-align=left" colspan='2' height='80px'> </td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2'  height='50px'> Through :     Head of Section/Division  </td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2' height='20px'> </td> </tr>
<tr> <td  style="border:0;text-align=left" height='10px' align='left'>Date : <?php echo $rdate; ?> </td> 
<td   style="border:0;text-align=left" height='10px' align='right' >Signature of Applicant  </td> </tr>

<tr> <td style="border:0;text-align=left" colspan='2' height='30px'><hr> </td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2' height='10px'  align='center' >For Computer Division Use</td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2' height='10px'  align='left' >Approving Authority</td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2' height='10px'  align='left' >(Computer Division)</td> </tr>
<tr> <td style="border:0;text-align=left" colspan='2' height='10px'> </td> </tr>


<tr> <td style="border:0;text-align=left" colspan='2' height='30px'><hr> </td> </tr>
<tr> <td  style="border:0;text-align=left" colspan='' height='10px'  align='left' >Print Taken By:</td> <td style="border:0;text-align=right" align='right'> Print Collected By </td> </tr>
<tr> <td style="border:0;text-align=left" colspan='' height='10px'  align='left' >Date:</td> <td style="border:0;text-align=right" align='right'> </td> </tr>

</div>
</table> 
<?php } ?>


