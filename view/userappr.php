<?php 
session_start();
include 'header.php';
include 'lmenu.php';
include 'dbconnect.php';
if (isset($_SESSION['icno_session']))
{
$lname=$_SESSION['icno_session'];
}
if (isset($_SESSION['type_session']))
{
$ltype=$_SESSION['type_session'];
}
if (isset($_SESSION['user_session']))
{
$mname=$_SESSION['user_session'];
}

if(($ltype=='A') || ($ltype=='AA'))
{
//echo "coming Inside";
$sql="select * from HPCUSER where HPCSTAT='Request in Process' and ASSIGNTO='$mname'";
//echo $sql;
}
else 
{
echo "Sorry, You are not authorized to view this page. Please Login.";
}

?>
<form action="" >
<table width="100%" align="center"  class='display' cellpadding='3' cellspacing='0'  id ='mtab' border='2' > 
    
<tr>  
<td colspan="9" align='center' height="35px" bgcolor="#00CCFF"><strong>  User Requests For Approval   
</td> </tr> </thead>
<tr bgcolor='#888888' height="35px">
    <td width = '10%' >Sl.No. </td>
    <td width = '10%' >IC_No </td>
    <td width = '10%' >Name</td>
    <td width = '10%' >Section/Div/Group</td>
    <td width = '10%' >Requested Date</td>
    <td width = '10%'>Created Date</td>
	<td width = '10%'>Servers</td>
    <td width = '15%'>Applications</td>
    <td width = '15%'>Status</td> </tr>
<tbody>
<?php 
$sql1=$dbh->query($sql);
$sql1->setFetchMode(PDO::FETCH_ASSOC);  
while ($r = $sql1->fetch()): 
?> 
<tr>
 <td ><?php echo htmlspecialchars($r["reqid"]); ?></td>
 <td> <a href='hpcuserupdate?uicno=<?php echo htmlspecialchars($r["icno"]);?>&seqno=<?php echo htmlspecialchars($r["reqid"]);?>' > <?php echo htmlspecialchars($r['icno']); ?>
     </a> </td> 
 <td><?php echo htmlspecialchars($r['user_name']); ?></td>
 <td><?php echo htmlspecialchars($r['section']); ?>/<?php echo  htmlspecialchars($r['division']);?>/<?php echo  htmlspecialchars($r['igroup']);?></td>
 <td><?php echo htmlspecialchars($r['datereq']); ?></td>
 <td><?php echo htmlspecialchars($r['datecreated']);?></td>
 <td><?php echo htmlspecialchars($r['sername']); ?></td>
 <td><?php echo htmlspecialchars($r['applusage']); ?></td>
 <td><?php echo htmlspecialchars($r['hpcstat']); ?></td>
 </tr>
 <?php endwhile; ?>
 </tbody>								 												
<tr> 
    <td colspan="9">   </td> </tr>
</table>
</form>
