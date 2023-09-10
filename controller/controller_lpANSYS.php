<?php
require_once("model/model_lpANSYS.php");

// Define database connection details
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user-inputted start and end dates
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $uploadedFile = $_FILES['file'];
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload failed with error code: " . $_FILES['file']['error'];
        exit;
    }

    // Validate and sanitize user inputs (you can add more validation here)
    $startDate = filter_var($startDate, FILTER_SANITIZE_SPECIAL_CHARS);
    $endDate = filter_var($endDate, FILTER_SANITIZE_SPECIAL_CHARS);

    $dropTableSQL = "DROP TABLE IF EXISTS logansys";
    $conn->query($dropTableSQL);

    // Define SQL query to create the table
    $sql = "CREATE TABLE IF NOT EXISTS logansys (
        Time TIME,
        Software VARCHAR(255),
        Status VARCHAR(50),
        Feature VARCHAR(255),
        UserMachine VARCHAR(255),
        UniqueID INT,
        Date DATE
    )";

    // Execute the query to create the table
    if ($conn->query($sql) === TRUE) {
        // echo "Table created successfully.<br>";

        // Open the text file for reading (your code for reading and inserting data)
        $sourceFile = fopen($uploadedFile['tmp_name'], 'r');

        if ($sourceFile) {
            // Initialize the date variable
            $currentDate = null;

            // Loop through each line in the text file
            while (($line = fgets($sourceFile)) !== false) {
                // Extract the relevant data from each line
                if (preg_match('/^(\d{1,2}:\d{1,2}:\d{1,2}) \((.*?)\) (OUT|DENIED|IN): "(.*?)" (.*?) \[(\d+)\]/', $line, $matches)) {
                    $time = $matches[1];
                    $software = $matches[2];
                    $status = $matches[3];
                    $feature = $matches[4];
                    $userMachine = $matches[5];
                    $uniqueID = $matches[6];

                    // Check if the date is present before inserting data
                    if ($currentDate !== null) {
                        // Insert the extracted data into the database table
                        $sql = "INSERT INTO logansys (Time, Software, Status, Feature, UserMachine, UniqueID, Date)
                                VALUES ('$time', '$software', '$status', '$feature', '$userMachine', '$uniqueID', '$currentDate')";

                        if ($conn->query($sql) !== TRUE) {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                } elseif (preg_match('/TIMESTAMP (\d{1,2}\/\d{1,2}\/\d{4})/', $line, $dateMatches)) {
                    $currentDateStr = $dateMatches[1];
                    // Try to create a DateTime object with different date formats
                    $dateFormats = ['m/d/Y', 'n/j/Y', 'd/m/Y', 'Y-m-d'];
                    foreach ($dateFormats as $dateFormat) {
                        $currentDate = DateTime::createFromFormat($dateFormat, $currentDateStr);
                        if ($currentDate !== false) {
                            $currentDate = $currentDate->format('Y-m-d');
                            break; // Stop trying other formats once a valid one is found
                        }
                    }
                    if ($currentDate === false) {
                        echo "Error: Invalid date format - $currentDateStr";
                    }
                }
            }

            // Close the text file
            fclose($sourceFile);
            // echo "Data extraction and storage completed.";

            $featureDurations = calculateFeatureDurations($startDate, $endDate);
            $featureDurationsByDay = calculateFeatureDurationsByDay($startDate, $endDate);
        } else {
            echo "Error: Unable to open the source text file.";
        }
    } else {
        echo "Error creating table: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Feature Activity Visualization</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        label {
            font-size: 18px;
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        .file-input-label {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            min-width: fit-content;
        }

        .file-input-label:hover {
            background-color: #2980b9;
        }

        input[type="file"] {
            display: none;
        }

        button[type="submit"] {
            background-color: #2ecc71;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #27ae60;
        }

        .error {
            color: #d63031;
            text-align: center;
            margin-top: 10px;
        }

        .graph-container1,
        .graph-container2,
        .data-table {
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background-image: linear-gradient(to bottom, #ffffff, #f5f5f5);
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .graph-container1 {
            max-width: 500px;
        }

        .data-table {
            background-color: #f9f9f9;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4169E1;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* On hover, darken the container background and increase the box shadow */
        .graph-container1:hover,
        .graph-container2:hover,
        .data-table:hover {
            background-color: #f0f0f0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Log Processing</h1>

        <form method="post" enctype="multipart/form-data">
            <label for="file">Upload ANSYS Log File</label>
            <center><label class="file-input-label" for="file">Browse</label></center>
            <input type="file" name="file" id="file" required>
            <br>
            <!-- User Input Date Range -->
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required><br>
            <br>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required><br><br>

            <button type="submit" name="submit">Process Log</button>
        </form>
    </div>

    <?php
    // Display the results (if available)
    if (isset($featureDurations) && isset($featureDurationsByDay)) {
        $csvFileName = 'logansys_data.csv';

        // Create a CSV file pointer
        $csvFile = fopen($csvFileName, 'w');

        // Write the CSV header
        fputcsv($csvFile, array('Time', 'Software', 'Status', 'Feature', 'UserMachine', 'UniqueID', 'Date'));

        // Export the entire logansys table to the CSV file
        $exportSQL = "SELECT * FROM logansys";
        $exportResult = $conn->query($exportSQL);

        while ($row = $exportResult->fetch_assoc()) {
            fputcsv($csvFile, array(
                $row['Time'],
                $row['Software'],
                $row['Status'],
                $row['Feature'],
                $row['UserMachine'],
                $row['UniqueID'],
                $row['Date']
            ));
        }

        // Close the CSV file
        fclose($csvFile);

        // Provide a link to download the CSV file
        echo '<p style="text-align: center;">Processed CSV file ready for download: <a href="' . $csvFileName . '">' . $csvFileName . '</a></p>';

        echo '<div class="graph-container1">';
        echo '
                    <h1>Cumulative Feature Tracker</h1>
                    <canvas id="featureGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("featureGraph").getContext("2d");
                    
                    var featureData = ' . json_encode($featureDurations) . ';
                    var labels = featureData.map(item => item.Feature);
                    var data = featureData.map(item => parseFloat(item.Duration));
    
                    new Chart(ctx, {
                        type: "doughnut",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Feature Activity Duration (hours)",
                                data: data,
                                backgroundColor: [
                                    getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor(),getRandomColor(),getRandomColor()
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "top",
                                }
                            }
                        }
                    });
                    function getRandomColor() {
                        var letters = "0123456789ABCDEF";
                        var color = "#";
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                        }
                        return color;
                    }
                </script>';
        echo '</div>';

        echo '<div class="data-table">';
        echo '<h2>Feature Monitor</h2>';
        echo '<table id="dataTable" class="display">';
        echo '<thead><tr><th>Feature</th><th>Duration (hours)</th></tr></thead>';
        echo '<tbody>';
        foreach ($featureDurations as $item) {
            echo '<tr><td>' . $item['Feature'] . '</td><td>' . $item['Duration'] . '</td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '<script>
            $(document).ready(function() {
                $("#dataTable").DataTable();
            });
        </script>';
        echo '</div>';

        echo '<div class="graph-container2">';
        echo '
                    <h1>Feature Flux: Charting Daily Engagement</h1>
                    <canvas id="featureBarGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("featureBarGraph").getContext("2d");
                    
                    var featureData = ' . json_encode($featureDurationsByDay) . ';
                    var labels = featureData[0].Dates; // Dates are the same for all features
                    var datasets = featureData.map(item => {
                        return {
                            label: item.Feature,
                            data: item.Durations.map(d => parseFloat(d)),
                            backgroundColor: getRandomColor(),
                            fill: false
                        };
                    });
    
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: "top",
                                }
                            }
                        }
                    });
    
                    function getRandomColor() {
                        var letters = "0123456789ABCDEF";
                        var color = "#";
                        for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                        }
                        return color;
                    }
                </script>';
        echo '</div>';

        echo '<div class="data-table">';
        echo '<h2>Engagement Dynamics: Daily Feature Activity</h2>';
        echo '<table id="dataTable2" class="display">';
        echo '<thead><tr><th>Date</th>';

        // Print feature names as column headers
        foreach ($featureDurationsByDay as $featureData) {
            echo '<th>' . $featureData['Feature'] . '</th>';
        }

        echo '</tr></thead>';
        echo '<tbody>';

        // Iterate through dates
        $dates = $featureDurationsByDay[0]['Dates']; // Assuming Dates are the same for all features
        foreach ($dates as $date) {
            echo '<tr>';
            echo '<td>' . $date . '</td>';

            // Iterate through features and find matching date
            foreach ($featureDurationsByDay as $featureData) {
                $featureDateIndex = array_search($date, $featureData['Dates']);
                if ($featureDateIndex !== false) {
                    $duration = $featureData['Durations'][$featureDateIndex];
                    echo '<td>' . $duration . '</td>';
                } else {
                    // Date not found for this feature, display an empty cell
                    echo '<td></td>';
                }
            }

            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '<script>
            $(document).ready(function() {
                $("#dataTable2").DataTable();
            });
        </script>';
    }

    echo '</div>';
    echo '</body></html>';
    ?>
</body>

</html>