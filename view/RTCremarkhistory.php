<html>
<head>

<style>
h3 {
    text-align: center;
    color: blue;
    letter-spacing: 2px;
    line-height: 0.05;
    word-spacing: 5px;
    font-family: "Times New Roman", Times, serif;
}

table {
    border-collapse: collapse;
    border: 1px solid black;
}  

th {
    background-color:#483D8B;
    color: white;
    height: 30px;
    text-align:center;
}

th,td {
	
        font-family: "Times New Roman", Times, serif;
        font-size:16px
        
}




mark { 
    background-color: yellow;
    color: black;
} 

</style>


</head>


<body>


<h3> Remark History</h3>
<?php include "view/RTCdisplaybanner.php"; ?>

<table border=1 style="width:100%;">

<tr>
<th>Remark Id</th>
<th>Date</th>
<th>Time</th>
<th>Shift</th>
<th>Remarks</th>
<th>status</th>
<th>Action by</th>
</tr>



<!-- Remark which is quirey for history -->
<?php
for ($x=0; $x<$count1; $x++){
echo '<tr>
<td><mark>'.$sql14[$x][0].'</mark></td><td><mark>';
$cdate=date_create($sql14[$x][1]);
echo date_format($cdate,"d-m-Y");
echo '</mark></td><td><mark>'.$sql14[$x][2].'</mark></td>
<td><mark>'.$sql14[$x][3].'</mark></td>
<td><mark>'.$sql14[$x][4].'</mark></td>
<td><mark>logged</mark></td>
<td><mark>'.$sql14[$x][5].'</mark></td>
</tr>';
}
?>



<!-- Remark history -->
<?php

for ($x=0; $x<$count2; $x++){
echo '<tr>
<td>'.$sql15[$x][0].'</td><td>';
$cdate=date_create($sql15[$x][1]);
echo date_format($cdate,"d-m-Y");
echo '</td><td>'.$sql15[$x][2].'</td>
<td>'.$sql15[$x][3].'</td>
<td>'.$sql15[$x][4].'</td>
<td>'.$sql15[$x][5].'</td>
<td>'.$sql15[$x][6].'</td>
</tr>';
}
?>

</table>

</div>
</body>

</html>