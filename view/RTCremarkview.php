

<!-- for jquery calendar -->
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="view/jqdate1/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="view/jqdate1/style.css"> 
  
  <script src="view/jqdate1/jq.js"></script>
  <script src="view/jqdate1/jq2.js"></script> 
  
  
  <link type="text/css" href="view/DataTables-1.10.16/css/dataTables.tableTools.css" rel="stylesheet" />
<link type="text/css" href="view/DataTables-1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" />
<link type="text/css" href="view/FixedHeader-3.1.3/css/fixedHeader.dataTables.min.css" rel="stylesheet" />
<script type="text/javascript" charset="utf8" src="view/js/jquery-1.12.4.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="view/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="view/FixedHeader-3.1.3/js/dataTables.fixedHeader.min.js"></script>
 
  <script>
   $( function() {     
       $( "#fdate" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
   $( function() {      
       $( "#tdate" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
 

</script>


<!--jquer calendar end css and js -->
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
    width:100%;
    
} 

a {
    text-decoration: none;
}
th {
    background-color:#483D8B;
    color: white;
    height: 40px;
}

th,td {
	text-align:center;
        font-family: "Times New Roman", Times, serif;
        font-size:16px       
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

<body>
<h3> Remark status</h3>
<?php include "view/RTCdisplaybanner.php"; ?>
<form method="get" action="">
<input type="hidden" name="hpcpage" value="viewremark">
<table ><tr>
<td >From date:<input type= "text" id= "fdate"  name= "fdate" onchange="this.form.submit()" value="<?php echo $fdate;?>"></td>
<td >To date:<input type= "text" id= "tdate"  name= "tdate" onchange="this.form.submit()" value="<?php echo $tdate;?>"></td>
<td>Status: <select name="qstatus" onchange="this.form.submit()">
    <option value="" selected="selected">select Status</option>
	<option value="All" selected="selected">All</option>
    <option value="logged" selected="selected">logged</option>
    <option value="acknowledged" selected="selected">acknowledged</option>
    <option value="pending" selected="selected" >pending</option>
    <option value="in progress" selected="selected" >In progress</option>
    <option value="completed" selected="selected">completed</option>
</select></td></form>
<!--search form start -->
<form method="get" action="">
<input type="hidden" name="hpcpage" value="viewremark">
<td><input type="search" placeholder="type a keyword" name="search">
  <button type="submit" name="submit">search</i></button>
</form></td>
<!--search form end -->

</tr></table>




<table border='1'  id="queuetable">
<thead>
<tr><th>Remark Id</th><th>Date</th><th>Time</th>
<th>Shift</th>
<th>Remarks (problem or work description)</th>
<th>status</th>
<th>View history</th></tr> </thead>
<tbody>
<?php
for($x=0;$x<$rows;$x++){
	$slno=$sql9[$x][0];
	$sql10=$this->logmodel->getRemarkStatus($slno);
	$rows1=count($sql10);
	if ($rows1>=1){
		if($sql10[$rows1-1][5]=="acknowledged"){
			echo '<tr style="background-color:#FFD700">';
		}elseif($sql10[$rows1-1][5]=="pending"){
			echo '<tr style="background-color:#B0C4DE">';
		}elseif($sql10[$rows1-1][5]=="in progress"){
			echo '<tr style="background-color:#87CEEB">';
		}elseif($sql10[$rows1-1][5]=="completed"){
			echo '<tr style="background-color:#4CAF50">';
		}
		
		if ($qstatus==""){
			echo '<td style="text-align:left;">';
			if ($sql10[$rows1-1][5]=="completed"){
				echo $sql9[$x][0];
			}else{
				echo '<a href="index.php?hpcpage=editremark&slno='.$sql9[$x][0].'">'.$sql9[$x][0].'<img src="view/images/edit.jpeg" width="20" height="20"></a>';
			}
			echo '</td><td >';
			$cdate=date_create($sql9[$x][1]);
			echo date_format($cdate,"d-m-Y");
			echo '</td><td>'.$sql9[$x][2].'</td><td>'.$sql9[$x][3].'</td><td style = "text-align:left;" >'.$sql9[$x][4].'</td><td>';
			echo $sql10[$rows1-1][5];
			echo '</td><td><a href="index.php?hpcpage=viewremarkhistroy&slno='.$sql9[$x][0].'"><img src="view/images/eye.jpg" width="25" height="25"></a>
			</td></tr>';
			
		}elseif ($qstatus!=="" && $sql10[$rows1-1][5]==$qstatus){
			echo '<td style="text-align:left;">';
			if ($sql10[$rows1-1][5]=="completed"){
				echo $sql9[$x][0];
			}else{
				echo '<a href="index.php?hpcpage=editremark&slno='.$sql9[$x][0].'">'.$sql9[$x][0].'<img src="view/images/edit.jpeg" width="20" height="20"></a>';
			}
			echo '</td><td >';
			$cdate=date_create($sql9[$x][1]);
			echo date_format($cdate,"d-m-Y");
			echo '</td><td>'.$sql9[$x][2].'</td><td>'.$sql9[$x][3].'</td><td style = "text-align:left;" >'.$sql9[$x][4].'</td><td>';
			echo $sql10[$rows1-1][5];
			echo '</td><td><a href="index.php?hpcpage=viewremarkhistroy&slno='.$sql9[$x][0].'"><img src="view/images/eye.jpg" width="25" height="25"></a>
			</td></tr>';
		}
		
	}else{
		echo '<tr style="background-color:#FFA07A">';	
		if ($qstatus==""||$qstatus=="logged" && $rows1== 0){
			echo '<td style="text-align:left;">';
			echo '<a href="index.php?hpcpage=editremark&slno='.$sql9[$x][0].'">'.$sql9[$x][0].'<img src="view/images/edit.jpeg" width="20" height="20"></a>';
			echo '</td><td >';
			$cdate=date_create($sql9[$x][1]);
			echo date_format($cdate,"d-m-Y");
			echo '</td><td>'.$sql9[$x][2].'</td><td>'.$sql9[$x][3].'</td><td style = "text-align:left;" >'.$sql9[$x][4].'</td><td>';
			echo "logged";
			echo '</td><td><a href="index.php?hpcpage=viewremarkhistroy&slno='.$sql9[$x][0].'"><img src="view/images/eye.jpg" width="25" height="25"></a>
			</td></tr>';
		}	
	}		
						
}

?>
</tbody>
</table><br>
<!-- <a class ="button" href="rtc_log11.php">go to home page</a>-->
<?php //echo '<a class ="button" href="report.php?fdate2='.$fdate2.'&tdate2='.$tdate2.'&qstatus='.$qstatus.'">Generate Report</a>'; ?> 


</body>

</html>


<script>

$(document).ready(function() {
    $('#queuetable').DataTable( {
        "paging":   false,
        "searching": false    
        } );
} );
</script>







