<?php 
session_start();
include 'dbconnect.php';
include 'header.php';
include 'lmenu.php';

//Feedback Link for all users
if ($_SESSION['type_session']!='O')
{
 echo " <br><table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'>
  <tr valign ='top' align='center'  >
	<td height='15' colspan='4' valign = 'top' style='color: midnightblue; font-size: 1.5em'> <em>Kindly give your valuable feedback for the HPC Services by clicking on the following link: </em> <a href='hpcfeedback' > HPC user Feedback Form </a></td>  
  </tr>
</table>
<br>";
}


if ($_SESSION['type_session']=='AD')
{
echo " <table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'> 
  <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > Administrator Notice </a></td> 
   </tr>
   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='userforward' > Check For User Request Forwards </a></td> 
   </tr>
    
</table>";
}
if ($_SESSION['type_session']=='AS')
{
echo " <table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'> 

  <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > Administrator Notice </a></td> 
   </tr>
   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='userprocess' > Check For User Request </a></td> 
   </tr>
   
</table>";
}


if ($_SESSION['type_session']=='AS')
{
echo " <table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'> 

  <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > Administrator Notice </a></td> 
   </tr>
   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='userappr' > User Creation </a></td> 
   </tr>
   
</table>";
}

if ($_SESSION['type_session']=='U')
{
echo " <table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'> 

<!--  <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > Feedback for the HPC services </a></td> 
   </tr>

   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='hpcfeedback' > HPC user Feedback Form </a></td> 
   </tr> -->
    
   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > Logout </a></td> 
   </tr>
   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='logout' > Logout </a></td> 
   </tr>
</table>";
}

if ($_SESSION['type_session']=='O')
{
echo " <table  width='100%' border='0' align='center' cellpadding='2' cellspacing='0' bgcolor='#FFFFFF'> 

  <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' ><a href='printtake'> Download Files from Print Requisition </a></td> 
   </tr>

   <tr valign ='top' align='center'  >
      <td height='15' colspan='4' valign = 'top' > <a href='printcomplete' > Print Status Update </a></td> 
   </tr>
   
</table>";
}

?>


