<!DOCTYPE html>
<html>
<head>
    <title>Feature Analysis</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedFeatures = isset($_POST["features"]) ? $_POST["features"] : array();
        $startDate = isset($_POST["start_date"]) ? $_POST["start_date"] : "";
        $endDate = isset($_POST["end_date"]) ? $_POST["end_date"] : "";

        // Database connection
        $host = "localhost";
        $dbname = "test";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }

        // Query and data processing
        $query = "SELECT DATE(timeofmon) AS usage_date, feature, TIME_TO_SEC(TIMEDIFF(timeofmon, starttime_formatted))/3600 AS total_hours
          FROM licenseusershistory 
          WHERE feature IN ('" . implode("','", $selectedFeatures) . "') 
          AND DATE(timeofmon) BETWEEN :start_date AND :end_date 
          GROUP BY usage_date, feature 
          ORDER BY usage_date, feature";

        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":start_date", $startDate);
        $stmt->bindParam(":end_date", $endDate);
        $stmt->execute();

        // Process data for plotting
        $usageData = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usageDate = $row["usage_date"];
            $feature = $row["feature"];
            $totalHours = (float) $row["total_hours"]; // Corrected variable name

            if (!isset($usageData[$usageDate])) {
                $usageData[$usageDate] = array();
            }
            $usageData[$usageDate][$feature] = $totalHours; // Corrected variable name
        }

        // Prepare data for plotting
        $dates = array_keys($usageData);
        $datasets = array();

        foreach ($selectedFeatures as $feature) {
            $featureUsage = array();
            foreach ($dates as $date) {
                $featureUsage[] = isset($usageData[$date][$feature]) ? $usageData[$date][$feature] : 0;
            }
            $datasets[] = array(
                "label" => $feature,
                "data" => $featureUsage,
            );
        }

        // Generate JavaScript code for plotting
        $plotData = json_encode(array("labels" => $dates, "datasets" => $datasets));

        echo <<<EOL
        <h2>Feature Usage Graph</h2>
        <canvas id="featureGraph"></canvas>
        <script>
            var ctx = document.getElementById('featureGraph').getContext('2d');
            var featureChart = new Chart(ctx, {
                type: 'line',
                data: $plotData,
                options: {
                    // Configure chart options as needed
                }
            });
        </script>
        EOL;
    }
    ?>
</body>
</html>
