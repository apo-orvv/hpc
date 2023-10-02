<?php
$today=date('Y-m-d');
//echo $today;

?>
<html>
<head>
<style>
table {
    border-collapse: collapse;
    border: 1px solid  black;
} 
th,td {
    border: 1px solid  black;
	width:200px;
	text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size:18px
}
h3 {
    text-align: center;
    color: blue;
    letter-spacing: 2px;
    line-height: 2;
    word-spacing: 5px;
    font-family: "Times New Roman", Times, serif;
}
</style>
</head>
<body>
<h3>Delete or Modify Log Data</h3>
<form method="get" action="">
<input type="hidden" name="hpcpage" value="modifydata">
<table align="center" border="1">
<tr>
<td>Select hour : <select name="time">
<option value="">none</option>
<?php

for($x=0;$x<=23;$x++){
if ($x<6){
echo '<option value="';echo $x+19;echo '">';echo $x;echo ':00</option>';
}
else{
echo '<option value="';echo $x-5;echo '">';echo $x;echo ':00</option>';
}
}

?>
</select></td>
<td><input type="radio" name="action" value="del" > Delete</td>
<td><input type="radio" name="action" value="mod" > Modify</td>
<td><input type="submit" name="submit" value="submit"></td>
</tr>
</table>
</form><br><br>
</body>
</html>















