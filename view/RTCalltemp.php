<!DOCTYPE HTML>
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
		text: "CSS Temperature Chart View"
	},
	axisX: {
		valueFormatString: "##.00hrs"
	},
	axisY: {
		title: "Temperature (in °C)",
		includeZero: false,
		suffix: " °C"
	},
	legend:{
		cursor: "pointer",
		fontSize: 16,
		itemclick: toggleDataSeries
	},
	toolTip:{
		shared: true
	},
	data: [{
		name: "IVY Cluster",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [
			{x: 0, y: <?php if($data19[0]==""){echo "''";}else{echo $data19[0];}?>},
			{x: 1, y: <?php if($data20[0]==""){echo "''";}else{echo $data20[0];}?>},
			{x: 2, y: <?php if($data21[0]==""){echo "''";}else{echo $data21[0];}?>},
			{x: 3, y: <?php if($data22[0]==""){echo "''";}else{echo $data22[0];}?>},
			{x: 4, y: <?php if($data23[0]==""){echo "''";}else{echo $data23[0];}?>},
			{x: 5, y: <?php if($data24[0]==""){echo "''";}else{echo $data24[0];}?>},
			{x: 6, y: <?php if($data1[0]==""){echo "''";}else{echo $data1[0];}?>},
			{x: 7, y: <?php if($data2[0]==""){echo "''";}else{echo $data2[0];}?>},
			{x: 8, y: <?php if($data3[0]==""){echo "''";}else{echo $data3[0];}?>},
			{x: 9, y: <?php if($data4[0]==""){echo "''";}else{echo $data4[0];}?>},
			{x: 10, y: <?php if($data5[0]==""){echo "''";}else{echo $data5[0];}?>},
			{x: 11, y: <?php if($data6[0]==""){echo "''";}else{echo $data6[0];}?>},
			{x: 12, y: <?php if($data7[0]==""){echo "''";}else{echo $data7[0];}?>},
			{x: 13, y: <?php if($data8[0]==""){echo "''";}else{echo $data8[0];}?>},
			{x: 14, y: <?php if($data9[0]==""){echo "''";}else{echo $data9[0];}?>},
			{x: 15, y: <?php if($data10[0]==""){echo "''";}else{echo $data10[0];}?>},
			{x: 16, y: <?php if($data11[0]==""){echo "''";}else{echo $data11[0];}?>},
			{x: 17, y: <?php if($data12[0]==""){echo "''";}else{echo $data12[0];}?>},
			{x: 18, y: <?php if($data13[0]==""){echo "''";}else{echo $data13[0];}?>},
			{x: 19, y: <?php if($data14[0]==""){echo "''";}else{echo $data14[0];}?>},
			{x: 20, y: <?php if($data15[0]==""){echo "''";}else{echo $data15[0];}?>},
			{x: 21, y: <?php if($data16[0]==""){echo "''";}else{echo $data16[0];}?>},
			{x: 22, y: <?php if($data17[0]==""){echo "''";}else{echo $data17[0];}?>},
			{x: 23, y: <?php if($data18[0]==""){echo "''";}else{echo $data18[0];}?>},

		]
	},
	{
		name: "Cluster AC unit-1",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[2]==""){echo "''";}else{echo $data19[2];}?>},
			{x: 1, y: <?php if($data20[2]==""){echo "''";}else{echo $data20[2];}?>},
			{x: 2, y: <?php if($data21[2]==""){echo "''";}else{echo $data21[2];}?>},
			{x: 3, y: <?php if($data22[2]==""){echo "''";}else{echo $data22[2];}?>},
			{x: 4, y: <?php if($data23[2]==""){echo "''";}else{echo $data23[2];}?>},
			{x: 5, y: <?php if($data24[2]==""){echo "''";}else{echo $data24[2];}?>},
			{x: 6, y: <?php if($data1[2]==""){echo "''";}else{echo $data1[2];}?>},
			{x: 7, y: <?php if($data2[2]==""){echo "''";}else{echo $data2[2];}?>},
			{x: 8, y: <?php if($data3[2]==""){echo "''";}else{echo $data3[2];}?>},
			{x: 9, y: <?php if($data4[2]==""){echo "''";}else{echo $data4[2];}?>},
			{x: 10, y: <?php if($data5[2]==""){echo "''";}else{echo $data5[2];}?>},
			{x: 11, y: <?php if($data6[2]==""){echo "''";}else{echo $data6[2];}?>},
			{x: 12, y: <?php if($data7[2]==""){echo "''";}else{echo $data7[2];}?>},
			{x: 13, y: <?php if($data8[2]==""){echo "''";}else{echo $data8[2];}?>},
			{x: 14, y: <?php if($data9[2]==""){echo "''";}else{echo $data9[2];}?>},
			{x: 15, y: <?php if($data10[2]==""){echo "''";}else{echo $data10[2];}?>},
			{x: 16, y: <?php if($data11[2]==""){echo "''";}else{echo $data11[2];}?>},
			{x: 17, y: <?php if($data12[2]==""){echo "''";}else{echo $data12[2];}?>},
			{x: 18, y: <?php if($data13[2]==""){echo "''";}else{echo $data13[2];}?>},
			{x: 19, y: <?php if($data14[2]==""){echo "''";}else{echo $data14[2];}?>},
			{x: 20, y: <?php if($data15[2]==""){echo "''";}else{echo $data15[2];}?>},
			{x: 21, y: <?php if($data16[2]==""){echo "''";}else{echo $data16[2];}?>},
			{x: 22, y: <?php if($data17[2]==""){echo "''";}else{echo $data17[2];}?>},
			{x: 23, y: <?php if($data18[2]==""){echo "''";}else{echo $data18[2];}?>},

		]
	},
	{
		name: "Cluster AC unit-2",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[4]==""){echo "''";}else{echo $data19[4];}?>},
			{x: 1, y: <?php if($data20[4]==""){echo "''";}else{echo $data20[4];}?>},
			{x: 2, y: <?php if($data21[4]==""){echo "''";}else{echo $data21[4];}?>},
			{x: 3, y: <?php if($data22[4]==""){echo "''";}else{echo $data22[4];}?>},
			{x: 4, y: <?php if($data23[4]==""){echo "''";}else{echo $data23[4];}?>},
			{x: 5, y: <?php if($data24[4]==""){echo "''";}else{echo $data24[4];}?>},
			{x: 6, y: <?php if($data1[4]==""){echo "''";}else{echo $data1[4];}?>},
			{x: 7, y: <?php if($data2[4]==""){echo "''";}else{echo $data2[4];}?>},
			{x: 8, y: <?php if($data3[4]==""){echo "''";}else{echo $data3[4];}?>},
			{x: 9, y: <?php if($data4[4]==""){echo "''";}else{echo $data4[4];}?>},
			{x: 10, y: <?php if($data5[4]==""){echo "''";}else{echo $data5[4];}?>},
			{x: 11, y: <?php if($data6[4]==""){echo "''";}else{echo $data6[4];}?>},
			{x: 12, y: <?php if($data7[4]==""){echo "''";}else{echo $data7[4];}?>},
			{x: 13, y: <?php if($data8[4]==""){echo "''";}else{echo $data8[4];}?>},
			{x: 14, y: <?php if($data9[4]==""){echo "''";}else{echo $data9[4];}?>},
			{x: 15, y: <?php if($data10[4]==""){echo "''";}else{echo $data10[4];}?>},
			{x: 16, y: <?php if($data11[4]==""){echo "''";}else{echo $data11[4];}?>},
			{x: 17, y: <?php if($data12[4]==""){echo "''";}else{echo $data12[4];}?>},
			{x: 18, y: <?php if($data13[4]==""){echo "''";}else{echo $data13[4];}?>},
			{x: 19, y: <?php if($data14[4]==""){echo "''";}else{echo $data14[4];}?>},
			{x: 20, y: <?php if($data15[4]==""){echo "''";}else{echo $data15[4];}?>},
			{x: 21, y: <?php if($data16[4]==""){echo "''";}else{echo $data16[4];}?>},
			{x: 22, y: <?php if($data17[4]==""){echo "''";}else{echo $data17[4];}?>},
			{x: 23, y: <?php if($data18[4]==""){echo "''";}else{echo $data18[4];}?>},

		]
	},
	{
		name: "Cluster AC unit-3",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[6]==""){echo "''";}else{echo $data19[6];}?>},
			{x: 1, y: <?php if($data20[6]==""){echo "''";}else{echo $data20[6];}?>},
			{x: 2, y: <?php if($data21[6]==""){echo "''";}else{echo $data21[6];}?>},
			{x: 3, y: <?php if($data22[6]==""){echo "''";}else{echo $data22[6];}?>},
			{x: 4, y: <?php if($data23[6]==""){echo "''";}else{echo $data23[6];}?>},
			{x: 5, y: <?php if($data24[6]==""){echo "''";}else{echo $data24[6];}?>},
			{x: 6, y: <?php if($data1[6]==""){echo "''";}else{echo $data1[6];}?>},
			{x: 7, y: <?php if($data2[6]==""){echo "''";}else{echo $data2[6];}?>},
			{x: 8, y: <?php if($data3[6]==""){echo "''";}else{echo $data3[6];}?>},
			{x: 9, y: <?php if($data4[6]==""){echo "''";}else{echo $data4[6];}?>},
			{x: 10, y: <?php if($data5[6]==""){echo "''";}else{echo $data5[6];}?>},
			{x: 11, y: <?php if($data6[6]==""){echo "''";}else{echo $data6[6];}?>},
			{x: 12, y: <?php if($data7[6]==""){echo "''";}else{echo $data7[6];}?>},
			{x: 13, y: <?php if($data8[6]==""){echo "''";}else{echo $data8[6];}?>},
			{x: 14, y: <?php if($data9[6]==""){echo "''";}else{echo $data9[6];}?>},
			{x: 15, y: <?php if($data10[6]==""){echo "''";}else{echo $data10[6];}?>},
			{x: 16, y: <?php if($data11[6]==""){echo "''";}else{echo $data11[6];}?>},
			{x: 17, y: <?php if($data12[6]==""){echo "''";}else{echo $data12[6];}?>},
			{x: 18, y: <?php if($data13[6]==""){echo "''";}else{echo $data13[6];}?>},
			{x: 19, y: <?php if($data14[6]==""){echo "''";}else{echo $data14[6];}?>},
			{x: 20, y: <?php if($data15[6]==""){echo "''";}else{echo $data15[6];}?>},
			{x: 21, y: <?php if($data16[6]==""){echo "''";}else{echo $data16[6];}?>},
			{x: 22, y: <?php if($data17[6]==""){echo "''";}else{echo $data17[6];}?>},
			{x: 23, y: <?php if($data18[6]==""){echo "''";}else{echo $data18[6];}?>},

		]
	},
	{
		name: "Cluster AC unit-4",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[8]==""){echo "''";}else{echo $data19[8];}?>},
			{x: 1, y: <?php if($data20[8]==""){echo "''";}else{echo $data20[8];}?>},
			{x: 2, y: <?php if($data21[8]==""){echo "''";}else{echo $data21[8];}?>},
			{x: 3, y: <?php if($data22[8]==""){echo "''";}else{echo $data22[8];}?>},
			{x: 4, y: <?php if($data23[8]==""){echo "''";}else{echo $data23[8];}?>},
			{x: 5, y: <?php if($data24[8]==""){echo "''";}else{echo $data24[8];}?>},
			{x: 6, y: <?php if($data1[8]==""){echo "''";}else{echo $data1[8];}?>},
			{x: 7, y: <?php if($data2[8]==""){echo "''";}else{echo $data2[8];}?>},
			{x: 8, y: <?php if($data3[8]==""){echo "''";}else{echo $data3[8];}?>},
			{x: 9, y: <?php if($data4[8]==""){echo "''";}else{echo $data4[8];}?>},
			{x: 10, y: <?php if($data5[8]==""){echo "''";}else{echo $data5[8];}?>},
			{x: 11, y: <?php if($data6[8]==""){echo "''";}else{echo $data6[8];}?>},
			{x: 12, y: <?php if($data7[8]==""){echo "''";}else{echo $data7[8];}?>},
			{x: 13, y: <?php if($data8[8]==""){echo "''";}else{echo $data8[8];}?>},
			{x: 14, y: <?php if($data9[8]==""){echo "''";}else{echo $data9[8];}?>},
			{x: 15, y: <?php if($data10[8]==""){echo "''";}else{echo $data10[8];}?>},
			{x: 16, y: <?php if($data11[8]==""){echo "''";}else{echo $data11[8];}?>},
			{x: 17, y: <?php if($data12[8]==""){echo "''";}else{echo $data12[8];}?>},
			{x: 18, y: <?php if($data13[8]==""){echo "''";}else{echo $data13[8];}?>},
			{x: 19, y: <?php if($data14[8]==""){echo "''";}else{echo $data14[8];}?>},
			{x: 20, y: <?php if($data15[8]==""){echo "''";}else{echo $data15[8];}?>},
			{x: 21, y: <?php if($data16[8]==""){echo "''";}else{echo $data16[8];}?>},
			{x: 22, y: <?php if($data17[8]==""){echo "''";}else{echo $data17[8];}?>},
			{x: 23, y: <?php if($data18[8]==""){echo "''";}else{echo $data18[8];}?>},

		]
	},
	{
		name: "VDI AC unit-1",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[10]==""){echo "''";}else{echo $data19[10];}?>},
			{x: 1, y: <?php if($data20[10]==""){echo "''";}else{echo $data20[10];}?>},
			{x: 2, y: <?php if($data21[10]==""){echo "''";}else{echo $data21[10];}?>},
			{x: 3, y: <?php if($data22[10]==""){echo "''";}else{echo $data22[10];}?>},
			{x: 4, y: <?php if($data23[10]==""){echo "''";}else{echo $data23[10];}?>},
			{x: 5, y: <?php if($data24[10]==""){echo "''";}else{echo $data24[10];}?>},
			{x: 6, y: <?php if($data1[10]==""){echo "''";}else{echo $data1[10];}?>},
			{x: 7, y: <?php if($data2[10]==""){echo "''";}else{echo $data2[10];}?>},
			{x: 8, y: <?php if($data3[10]==""){echo "''";}else{echo $data3[10];}?>},
			{x: 9, y: <?php if($data4[10]==""){echo "''";}else{echo $data4[10];}?>},
			{x: 10, y: <?php if($data5[10]==""){echo "''";}else{echo $data5[10];}?>},
			{x: 11, y: <?php if($data6[10]==""){echo "''";}else{echo $data6[10];}?>},
			{x: 12, y: <?php if($data7[10]==""){echo "''";}else{echo $data7[10];}?>},
			{x: 13, y: <?php if($data8[10]==""){echo "''";}else{echo $data8[10];}?>},
			{x: 14, y: <?php if($data9[10]==""){echo "''";}else{echo $data9[10];}?>},
			{x: 15, y: <?php if($data10[10]==""){echo "''";}else{echo $data10[10];}?>},
			{x: 16, y: <?php if($data11[10]==""){echo "''";}else{echo $data11[10];}?>},
			{x: 17, y: <?php if($data12[10]==""){echo "''";}else{echo $data12[10];}?>},
			{x: 18, y: <?php if($data13[10]==""){echo "''";}else{echo $data13[10];}?>},
			{x: 19, y: <?php if($data14[10]==""){echo "''";}else{echo $data14[10];}?>},
			{x: 20, y: <?php if($data15[10]==""){echo "''";}else{echo $data15[10];}?>},
			{x: 21, y: <?php if($data16[10]==""){echo "''";}else{echo $data16[10];}?>},
			{x: 22, y: <?php if($data17[10]==""){echo "''";}else{echo $data17[10];}?>},
			{x: 23, y: <?php if($data18[10]==""){echo "''";}else{echo $data18[10];}?>},

		]
	},
	{
		name: "VDI AC unit-2",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[12]==""){echo "''";}else{echo $data19[12];}?>},
			{x: 1, y: <?php if($data20[12]==""){echo "''";}else{echo $data20[12];}?>},
			{x: 2, y: <?php if($data21[12]==""){echo "''";}else{echo $data21[12];}?>},
			{x: 3, y: <?php if($data22[12]==""){echo "''";}else{echo $data22[12];}?>},
			{x: 4, y: <?php if($data23[12]==""){echo "''";}else{echo $data23[12];}?>},
			{x: 5, y: <?php if($data24[12]==""){echo "''";}else{echo $data24[12];}?>},
			{x: 6, y: <?php if($data1[12]==""){echo "''";}else{echo $data1[12];}?>},
			{x: 7, y: <?php if($data2[12]==""){echo "''";}else{echo $data2[12];}?>},
			{x: 8, y: <?php if($data3[12]==""){echo "''";}else{echo $data3[12];}?>},
			{x: 9, y: <?php if($data4[12]==""){echo "''";}else{echo $data4[12];}?>},
			{x: 10, y: <?php if($data5[12]==""){echo "''";}else{echo $data5[12];}?>},
			{x: 11, y: <?php if($data6[12]==""){echo "''";}else{echo $data6[12];}?>},
			{x: 12, y: <?php if($data7[12]==""){echo "''";}else{echo $data7[12];}?>},
			{x: 13, y: <?php if($data8[12]==""){echo "''";}else{echo $data8[12];}?>},
			{x: 14, y: <?php if($data9[12]==""){echo "''";}else{echo $data9[12];}?>},
			{x: 15, y: <?php if($data10[12]==""){echo "''";}else{echo $data10[12];}?>},
			{x: 16, y: <?php if($data11[12]==""){echo "''";}else{echo $data11[12];}?>},
			{x: 17, y: <?php if($data12[12]==""){echo "''";}else{echo $data12[12];}?>},
			{x: 18, y: <?php if($data13[12]==""){echo "''";}else{echo $data13[12];}?>},
			{x: 19, y: <?php if($data14[12]==""){echo "''";}else{echo $data14[12];}?>},
			{x: 20, y: <?php if($data15[12]==""){echo "''";}else{echo $data15[12];}?>},
			{x: 21, y: <?php if($data16[12]==""){echo "''";}else{echo $data16[12];}?>},
			{x: 22, y: <?php if($data17[12]==""){echo "''";}else{echo $data17[12];}?>},
			{x: 23, y: <?php if($data18[12]==""){echo "''";}else{echo $data18[12];}?>},


		]
	},
	{
		name: "HPC Room",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[14]==""){echo "''";}else{echo $data19[14];}?>},
			{x: 1, y: <?php if($data20[14]==""){echo "''";}else{echo $data20[14];}?>},
			{x: 2, y: <?php if($data21[14]==""){echo "''";}else{echo $data21[14];}?>},
			{x: 3, y: <?php if($data22[14]==""){echo "''";}else{echo $data22[14];}?>},
			{x: 4, y: <?php if($data23[14]==""){echo "''";}else{echo $data23[14];}?>},
			{x: 5, y: <?php if($data24[14]==""){echo "''";}else{echo $data24[14];}?>},
			{x: 6, y: <?php if($data1[14]==""){echo "''";}else{echo $data1[14];}?>},
			{x: 7, y: <?php if($data2[14]==""){echo "''";}else{echo $data2[14];}?>},
			{x: 8, y: <?php if($data3[14]==""){echo "''";}else{echo $data3[14];}?>},
			{x: 9, y: <?php if($data4[14]==""){echo "''";}else{echo $data4[14];}?>},
			{x: 10, y: <?php if($data5[14]==""){echo "''";}else{echo $data5[14];}?>},
			{x: 11, y: <?php if($data6[14]==""){echo "''";}else{echo $data6[14];}?>},
			{x: 12, y: <?php if($data7[14]==""){echo "''";}else{echo $data7[14];}?>},
			{x: 13, y: <?php if($data8[14]==""){echo "''";}else{echo $data8[14];}?>},
			{x: 14, y: <?php if($data9[14]==""){echo "''";}else{echo $data9[14];}?>},
			{x: 15, y: <?php if($data10[14]==""){echo "''";}else{echo $data10[14];}?>},
			{x: 16, y: <?php if($data11[14]==""){echo "''";}else{echo $data11[14];}?>},
			{x: 17, y: <?php if($data12[14]==""){echo "''";}else{echo $data12[14];}?>},
			{x: 18, y: <?php if($data13[14]==""){echo "''";}else{echo $data13[14];}?>},
			{x: 19, y: <?php if($data14[14]==""){echo "''";}else{echo $data14[14];}?>},
			{x: 20, y: <?php if($data15[14]==""){echo "''";}else{echo $data15[14];}?>},
			{x: 21, y: <?php if($data16[14]==""){echo "''";}else{echo $data16[14];}?>},
			{x: 22, y: <?php if($data17[14]==""){echo "''";}else{echo $data17[14];}?>},
			{x: 23, y: <?php if($data18[14]==""){echo "''";}else{echo $data18[14];}?>},

		]
	},
	{
		name: "I/O Room",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[15]==""){echo "''";}else{echo $data19[15];}?>},
			{x: 1, y: <?php if($data20[15]==""){echo "''";}else{echo $data20[15];}?>},
			{x: 2, y: <?php if($data21[15]==""){echo "''";}else{echo $data21[15];}?>},
			{x: 3, y: <?php if($data22[15]==""){echo "''";}else{echo $data22[15];}?>},
			{x: 4, y: <?php if($data23[15]==""){echo "''";}else{echo $data23[15];}?>},
			{x: 5, y: <?php if($data24[15]==""){echo "''";}else{echo $data24[15];}?>},
			{x: 6, y: <?php if($data1[15]==""){echo "''";}else{echo $data1[15];}?>},
			{x: 7, y: <?php if($data2[15]==""){echo "''";}else{echo $data2[15];}?>},
			{x: 8, y: <?php if($data3[15]==""){echo "''";}else{echo $data3[15];}?>},
			{x: 9, y: <?php if($data4[15]==""){echo "''";}else{echo $data4[15];}?>},
			{x: 10, y: <?php if($data5[15]==""){echo "''";}else{echo $data5[15];}?>},
			{x: 11, y: <?php if($data6[15]==""){echo "''";}else{echo $data6[15];}?>},
			{x: 12, y: <?php if($data7[15]==""){echo "''";}else{echo $data7[15];}?>},
			{x: 13, y: <?php if($data8[15]==""){echo "''";}else{echo $data8[15];}?>},
			{x: 14, y: <?php if($data9[15]==""){echo "''";}else{echo $data9[15];}?>},
			{x: 15, y: <?php if($data10[15]==""){echo "''";}else{echo $data10[15];}?>},
			{x: 16, y: <?php if($data11[15]==""){echo "''";}else{echo $data11[15];}?>},
			{x: 17, y: <?php if($data12[15]==""){echo "''";}else{echo $data12[15];}?>},
			{x: 18, y: <?php if($data13[15]==""){echo "''";}else{echo $data13[15];}?>},
			{x: 19, y: <?php if($data14[15]==""){echo "''";}else{echo $data14[15];}?>},
			{x: 20, y: <?php if($data15[15]==""){echo "''";}else{echo $data15[15];}?>},
			{x: 21, y: <?php if($data16[15]==""){echo "''";}else{echo $data16[15];}?>},
			{x: 22, y: <?php if($data17[15]==""){echo "''";}else{echo $data17[15];}?>},
			{x: 23, y: <?php if($data18[15]==""){echo "''";}else{echo $data18[15];}?>},

		]
	},
	{
		name: "Anunet Room",
		type: "spline",
		yValueFormatString: "#0.## °C",
		showInLegend: true,
		dataPoints: [

			{x: 0, y: <?php if($data19[16]==""){echo "''";}else{echo $data19[16];}?>},
			{x: 1, y: <?php if($data20[16]==""){echo "''";}else{echo $data20[16];}?>},
			{x: 2, y: <?php if($data21[16]==""){echo "''";}else{echo $data21[16];}?>},
			{x: 3, y: <?php if($data22[16]==""){echo "''";}else{echo $data22[16];}?>},
			{x: 4, y: <?php if($data23[16]==""){echo "''";}else{echo $data23[16];}?>},
			{x: 5, y: <?php if($data24[16]==""){echo "''";}else{echo $data24[16];}?>},
			{x: 6, y: <?php if($data1[16]==""){echo "''";}else{echo $data1[16];}?>},
			{x: 7, y: <?php if($data2[16]==""){echo "''";}else{echo $data2[16];}?>},
			{x: 8, y: <?php if($data3[16]==""){echo "''";}else{echo $data3[16];}?>},
			{x: 9, y: <?php if($data4[16]==""){echo "''";}else{echo $data4[16];}?>},
			{x: 10, y: <?php if($data5[16]==""){echo "''";}else{echo $data5[16];}?>},
			{x: 11, y: <?php if($data6[16]==""){echo "''";}else{echo $data6[16];}?>},
			{x: 12, y: <?php if($data7[16]==""){echo "''";}else{echo $data7[16];}?>},
			{x: 13, y: <?php if($data8[16]==""){echo "''";}else{echo $data8[16];}?>},
			{x: 14, y: <?php if($data9[16]==""){echo "''";}else{echo $data9[16];}?>},
			{x: 15, y: <?php if($data10[16]==""){echo "''";}else{echo $data10[16];}?>},
			{x: 16, y: <?php if($data11[16]==""){echo "''";}else{echo $data11[16];}?>},
			{x: 17, y: <?php if($data12[16]==""){echo "''";}else{echo $data12[16];}?>},
			{x: 18, y: <?php if($data13[16]==""){echo "''";}else{echo $data13[16];}?>},
			{x: 19, y: <?php if($data14[16]==""){echo "''";}else{echo $data14[16];}?>},
			{x: 20, y: <?php if($data15[16]==""){echo "''";}else{echo $data15[16];}?>},
			{x: 21, y: <?php if($data16[16]==""){echo "''";}else{echo $data16[16];}?>},
			{x: 22, y: <?php if($data17[16]==""){echo "''";}else{echo $data17[16];}?>},
			{x: 23, y: <?php if($data18[16]==""){echo "''";}else{echo $data18[16];}?>},
		]
	},

		
	
	]
});
chart.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
</head>
<body>
<?php
$date1=date_create("$date");     
$date1=date_format($date1,"d-m-Y");  
?> 

<form method="get" action="">
<input type="hidden" name="hpcpage" value="chart">
<input type="hidden" name="value" value="<?php echo $value?>">
<table style="float: left;font-size:13px" border="1">
<tr><td >Date:<input size="8" type= "text" id= "date"  name= "date" onchange="this.form.submit()" value="<?php echo $date1;?>"></td></tr></table>
</form>

<div class="clear"></div>

<div id="chartContainer" style="height: 370px; width:100%; margin: 0px auto;"></div>
<script src="view/others/canvasjs.min.js"></script>
</body>
</html>