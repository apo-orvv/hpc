<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $softwareType = $_GET["software_type"];
    $startDate = $_GET["start_date"];
    $endDate = $_GET["end_date"];
} else {
    // Handle invalid access
    echo "Invalid access to this page.";
    exit;
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'test';

$connection = mysqli_connect($host, $user, $password, $database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT
    feature,
    machinename,
    SUM(TIMESTAMPDIFF(HOUR, starttime_formatted, last_timeofmon)) AS duration
FROM (
    SELECT
        feature,
        machinename,
        starttime_formatted,
        MAX(timeofmon) AS last_timeofmon
    FROM licenseusershistory
    WHERE software='$softwareType' AND starttime_formatted >= '$startDate' AND starttime_formatted <= '$endDate'
    GROUP BY feature, machinename, starttime_formatted
) AS aggregated_data 
GROUP BY feature, machinename;
";

$result = mysqli_query($connection, $query);

// Data for Google Charts
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['feature'] . ' - ' . $row['machinename'], (int)$row['duration']);
}

// mysqli_close($connection);

// Convert data to JSON 
$dataJson = json_encode($data);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Feature Usage Duration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff; /* White */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333; /* Dark Gray */
            font-size: 24px;
            margin-bottom: 20px;
        }

        #chart_div, #table_div {
            margin-top: 20px;
            text-align: center;
        }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'table']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = <?php echo $dataJson; ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Feature - Machine');
            data.addColumn('number', 'Duration (Hours)');
            data.addRows(jsonData);

            var options = {
                title: 'Feature Usage Duration wrt Machines',
                hAxis: {title: 'Feature - Machine', titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Hours', minValue: 0}
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

            var tableData = new google.visualization.DataTable();
            tableData.addColumn('string', 'Feature - Machine');
            tableData.addColumn('number', 'Duration (Hours)');
            tableData.addRows(jsonData);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(tableData, {showRowNumber: true});
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Feature Usage Duration</h1>
        <div id="chart_div" style="width: 100%; height: 400px;"></div>
        <div id="table_div"></div>
    </div>
</body>
</html>
