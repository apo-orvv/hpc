<?php
include('view/header.php');
include('view/lmenu.php');
?>

<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = ""; // Assuming the password is blank
$database = "test";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection and handle errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user-selected features, start date, and end date from featureDuration.php
$features = isset($_POST["features"]) ? $_POST["features"] : [];
$start_date = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
$end_date = isset($_POST["end_date"]) ? $_POST["end_date"] : "";

// Construct SQL query to fetch data
$featureList = "'" . implode("','", $features) . "'";
$sql = "SELECT DATE(timeofmon) AS date, 
               SUM(TIMESTAMPDIFF(SECOND, starttime_formatted, (SELECT MAX(timeofmon) FROM licenseusershistory AS t2 WHERE t2.feature IN ($featureList) AND DATE(t2.timeofmon) = DATE(licenseusershistory.timeofmon))) / 3600) AS active_hours 
        FROM licenseusershistory 
        WHERE feature IN ($featureList) 
        AND DATE(timeofmon) BETWEEN '$start_date' AND '$end_date'
        GROUP BY date";

// Execute the SQL query and handle query execution errors
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Process data for the chart
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row["date"]] = round($row["active_hours"], 2); // Round to two decimal places
}

// Close the database connection
$conn->close();
?>

<title>Feature Duration Analysis</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link type="text/css" href="view/menu.css" rel="stylesheet" />
<link type="text/css" href="view/style.css" rel="stylesheet" />
<div class="container">
    <h1>Feature Duration Analysis</h1>

    <?php if (isset($data)) : ?>
        <h2>Active Hours per Day</h2>
        <canvas id="featureChart" width="400" height="200"></canvas>

        <script>
            var ctx = document.getElementById('featureChart').getContext('2d');
            var data = <?php echo json_encode($data); ?>;
            var dates = Object.keys(data);
            var activeHours = Object.values(data);

            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Active Hours',
                        data: activeHours,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</div>