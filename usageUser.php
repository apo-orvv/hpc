<?php
include('view/header.php');
include('view/lmenu.php');
?>

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
    username,
    SUM(TIMESTAMPDIFF(HOUR, starttime_formatted, last_timeofmon)) AS duration
FROM (
    SELECT
        feature,
        username,
        starttime_formatted,
        MAX(timeofmon) AS last_timeofmon
    FROM licenseusershistory
    WHERE software='$softwareType' AND starttime_formatted >= '$startDate' AND starttime_formatted <= '$endDate'
    GROUP BY feature, username, starttime_formatted
) AS aggregated_data
GROUP BY feature, username;
";

$result = mysqli_query($connection, $query);

// Data for Google Charts
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = array($row['feature'] . ' - ' . $row['username'], (int)$row['duration']);
}

mysqli_close($connection);

// Convert data to JSON
$dataJson = json_encode($data);
?>

    <title>User Feature Usage Duration</title>
    <link type="text/css" href="view/menu.css" rel="stylesheet" />
<link type="text/css" href="view/style.css" rel="stylesheet" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart', 'table']});
        google.charts.setOnLoadCallback(drawVisualization);

        function drawVisualization() {
            var jsonData = <?php echo $dataJson; ?>;
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Feature - User');
            data.addColumn('number', 'Duration (Hours)');
            data.addRows(jsonData);

            var options = {
                title: 'Feature Usage Duration wrt Users',
                hAxis: {title: 'Feature - User', titleTextStyle: {color: '#333'}},
                vAxis: {title: 'Hours', minValue: 0}
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

            var tableData = new google.visualization.DataTable();
            tableData.addColumn('string', 'Feature - User');
            tableData.addColumn('number', 'Duration (Hours)');
            tableData.addRows(jsonData);

            var table = new google.visualization.Table(document.getElementById('table_div'));
            table.draw(tableData, {showRowNumber: true});
        }
    </script>

    <div class="container">
        <h1>User Feature Usage Duration</h1>
        <div id="chart_div" style="width: 100%; height: 400px;"></div>
        <div id="table_div"></div>
    </div>

