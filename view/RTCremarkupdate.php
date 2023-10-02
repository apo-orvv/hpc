
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
}

th,td {
	text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size:16px
        
}


textarea {
  width: 399px;
  height:21px;
  -webkit-transition: width .35s ease-in-out;
  transition: width .35s ease-in-out;
}
textarea:focus {
  height: 100px;
}

.button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 8px 15px;
    text-align: center;
    font-size: 16px;
    cursor: pointer;
    font-family: "Times New Roman", Times, serif;
}

.button:hover {
    background-color: white;
    color: green;
}



</style>
</head>


<body>


<h3> Remark update</h3>
<?php include "view/RTCdisplaybanner.php"; ?>
<form method="get" action="">
<input type="hidden" name="hpcpage" value="updateremark">

<table border=1 style="width:100%">

<tr>
<th>Remark Id</th><th>Date</th>
<th>Shift</th>
<th>Remarks</th>
<th>status</th>
<th>Action by</th>
</tr>


<?php

for ($x=0; $x<=$count-1; $x++){


echo '<tr>
<td><input type="radio" name="slno" value="'.$sql12[$x][0].'" checked>'.$sql12[$x][0].'</td>
<td>'.date("d-m-Y").'</td>
<td><select name="ushift">
    <option value="1">1st shift</option>
    <option value="2">2nd shift</option>
    <option value="3">3rd shift</option>
    <option value="3">gen shift</option>
    </select></td>

<td><textarea name = "uremark" >'.$sql12[$x][4].'</textarea></td>';

echo 
 '<td><select name="status">
    <option value="acknowledged">acknowledged</option>
    <option value="pending">pending</option>
    <option value="in progress">in progress</option>
    <option value="completed">completed</option>
  </select></td>

<td><select  name="actionby" style="cursor: pointer">
<option value="Karuthapandian P">Karuthapandian P</option> 
<option value="Balu v">Balu v</option>
<option value="Solairaj P">Solairaj P</option>
<option value="Srinivas Rao v">Srinivas Rao v</option>
<option value="Venkatesan S">Venkatesan S</option>
<option value="Radhakrishnan N">Radhakrishnan N</option>
<option value="Rajesh K">Rajesh K</option>
<option value="Nandakumar R">Nandakumar R</option>
<option value="Anil yadav">Anil yadav</option>
<option value="Ibrahim Khan">Ibrahim Khan</option>
<option value="Boopalan A">Boopalan A</option>
<option value="Sathish Kumar N">Sathish Kumar N</option>
<option value="Srinivasan S N">Srinivasan S N</option>
<option value="Krishnaveni P">Krishnaveni P</option>
</select></td>
</tr>';


}
?>

</table>
<div align="right">
<input class = "button" type="submit" value="submit">
</div>
</form>


</body>

</html>