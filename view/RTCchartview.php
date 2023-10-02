<html>
<head>
<!-- for jquery calendar -->
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Shift Roster Update</title>
  <link rel="stylesheet" href="view/jqdate1/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="view/jqdate1/style.css">
  <script src="view/jqdate1/jq.js"></script>
  <script src="view/jqdate1/jq2.js"></script>

<script>

   $( function() {
       
       $( "#date" ).datepicker({dateFormat: 'dd-mm-yy' }).val();
       } ); 
 
</script>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,  
	title:{
		text: "<?php echo $title;?>"
	},
	axisY: {
		title: "Temp",
		suffix: "°C",
		stripLines: [{
			value: 25,
			label: "Max 25°C"
		}]
	},

	axisX: {
		title: "Hours",
		suffix: ".00 hrs",
	},


	data: [{
		xValueFormatString: "##.00 hrs",
		yValueFormatString: "##.#°C",
		type: "splineArea",
                color: "<?php 
				if ($value==1||$value==3||$value==5||$value==7||$value==9||$value==11||$value==13){
					echo 'rgba(54,158,173,.7)';
				}else{	
					echo 'rgba(255, 99, 71,.7)';
				}
				?>",
		dataPoints: [

			{x: 0, y: <?php if($data19[$value]==""){echo "''";}else{echo $data19[$value];}?>},
			{x: 1, y: <?php if($data20[$value]==""){echo "''";}else{echo $data20[$value];}?>},
			{x: 2, y: <?php if($data21[$value]==""){echo "''";}else{echo $data21[$value];}?>},
			{x: 3, y: <?php if($data22[$value]==""){echo "''";}else{echo $data22[$value];}?>},
			{x: 4, y: <?php if($data23[$value]==""){echo "''";}else{echo $data23[$value];}?>},
			{x: 5, y: <?php if($data24[$value]==""){echo "''";}else{echo $data24[$value];}?>},
			{x: 6, y: <?php if($data1[$value]==""){echo "''";}else{echo $data1[$value];}?>},
			{x: 7, y: <?php if($data2[$value]==""){echo "''";}else{echo $data2[$value];}?>},
			{x: 8, y: <?php if($data3[$value]==""){echo "''";}else{echo $data3[$value];}?>},
			{x: 9, y: <?php if($data4[$value]==""){echo "''";}else{echo $data4[$value];}?>},
			{x: 10, y: <?php if($data5[$value]==""){echo "''";}else{echo $data5[$value];}?>},
			{x: 11, y: <?php if($data6[$value]==""){echo "''";}else{echo $data6[$value];}?>},
			{x: 12, y: <?php if($data7[$value]==""){echo "''";}else{echo $data7[$value];}?>},
			{x: 13, y: <?php if($data8[$value]==""){echo "''";}else{echo $data8[$value];}?>},
			{x: 14, y: <?php if($data9[$value]==""){echo "''";}else{echo $data9[$value];}?>},
			{x: 15, y: <?php if($data10[$value]==""){echo "''";}else{echo $data10[$value];}?>},
			{x: 16, y: <?php if($data11[$value]==""){echo "''";}else{echo $data11[$value];}?>},
			{x: 17, y: <?php if($data12[$value]==""){echo "''";}else{echo $data12[$value];}?>},
			{x: 18, y: <?php if($data13[$value]==""){echo "''";}else{echo $data13[$value];}?>},
			{x: 19, y: <?php if($data14[$value]==""){echo "''";}else{echo $data14[$value];}?>},
			{x: 20, y: <?php if($data15[$value]==""){echo "''";}else{echo $data15[$value];}?>},
			{x: 21, y: <?php if($data16[$value]==""){echo "''";}else{echo $data16[$value];}?>},
			{x: 22, y: <?php if($data17[$value]==""){echo "''";}else{echo $data17[$value];}?>},
			{x: 23, y: <?php if($data18[$value]==""){echo "''";}else{echo $data18[$value];}?>},

			
		]
	}]
});
chart.render();

}
</script>

<!--jquer calendar end css and js -->

<style>
div.clear {
    clear: both;
}
</style>
</head>
<?php
$date1=date_create("$date");     
$date1=date_format($date1,"d-m-Y");  
?>   

<body>

<form method="get" action="">
<input type="hidden" name="hpcpage" value="chart">
<input type="hidden" name="value" value="<?php echo $value?>">
<table style="float: left;font-size:13px" border="1">
<tr><td >Date:<input size="8" type= "text" id= "date"  name= "date" onchange="this.form.submit()" value="<?php echo $date1;?>"></td></tr></table>
</form>

<div class="clear"></div>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="view/others/canvasjs.min.js"></script>
</body>
</html>