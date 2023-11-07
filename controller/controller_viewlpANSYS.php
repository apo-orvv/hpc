<?php
require_once("model/model_lpANSYS.php");

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'test';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$view = new LogView();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit2'])) {
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

    $featureDurations = calculateFeatureDurationschoice($start_date, $end_date);
    $featureDurationsByDay = calculateFeatureDurationsByDaychoice($start_date, $end_date);
    $UserMachineDurations = calculateUserMachineDurationschoice($start_date, $end_date);
    $UserMachineDurationsByDay = calculateUserMachineDurationsByDaychoice($start_date, $end_date);
    $denial = denialchoice($start_date, $end_date);
    $denialcount = denialcountchoice($start_date, $end_date);
    $ftlic = ftlicchoice($start_date, $end_date);
    $utilftlic = utilftlicchoice($start_date, $end_date);
    $userlic = userlicchoice($start_date, $end_date);
    $calls = callschoice($start_date, $end_date);
    $usage = usagechoice($start_date, $end_date);
    $baseusage = baseusagechoice($start_date, $end_date);
    $view->displayData([
        'startDate' => $start_date,
        'endDate' => $end_date,
        'denial' => $denial,
        'denialcount' => $denialcount,
        'ftlic' => $ftlic,
        'utilftlic' => $utilftlic,
        'userlic' => $userlic,
        'usage' => $usage,
        'baseusage' => $baseusage,
        'calls' => $calls,
        'featureDurationsByDay' => $featureDurationsByDay,
        'featureDurations' => $featureDurations,
        'UserMachineDurations' => $UserMachineDurations,
        'UserMachineDurationsByDay' => $UserMachineDurationsByDay,
    ]);
} else {
    $dates = dates();
    $startDate = $dates['minDate'];
    $endDate = $dates['maxDate'];
    $featureDurations = calculateFeatureDurations();
    $featureDurationsByDay = calculateFeatureDurationsByDay();
    $UserMachineDurations = calculateUserMachineDurations();
    $UserMachineDurationsByDay = calculateUserMachineDurationsByDay();
    $denial = denial();
    $denialcount = denialcount();
    $ftlic = ftlic();
    $utilftlic = utilftlic();
    $userlic = userlic();
    $calls = calls();
    $usage = usage();
    $baseusage = baseusage();
    $view->displayData([
        'startDate' => $startDate,
        'endDate' => $endDate,
        'denial' => $denial,
        'denialcount' => $denialcount,
        'ftlic' => $ftlic,
        'utilftlic' => $utilftlic,
        'userlic' => $userlic,
        'calls' => $calls,
        'usage' => $usage,
        'baseusage' => $baseusage,
        'featureDurationsByDay' => $featureDurationsByDay,
        'featureDurations' => $featureDurations,
        'UserMachineDurations' => $UserMachineDurations,
        'UserMachineDurationsByDay' => $UserMachineDurationsByDay,
    ]);
}
?>

<?php
class LogView
{
    public function displayData($data)
    {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Feature Activity Visualization</title>
            <script src="view\js\chart.js"></script>
            <link rel="stylesheet" type="text/css" href="view\DataTables-1.10.24\css\jquery.dataTables.min.css">
            <script type="text/javascript" charset="utf8" src="view\js\jquery-3.5.1.js"></script>
            <script type="text/javascript" charset="utf8" src="view\DataTables-1.10.24\js\jquery.dataTables.min.js"></script>
            <link rel="stylesheet" type="text/css" href="view\DataTables-1.11.5\css\jquery.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="view\DataTables\Buttons-2.1.0\css\buttons.dataTables.min.css">
            <script type="text/javascript" charset="utf8" src="view\js\jquery-3.6.0.min.js"></script>
            <script type="text/javascript" charset="utf8" src="view\DataTables-1.11.5\js\jquery.dataTables.min.js"></script>
            <script type="text/javascript" charset="utf8" src="view\DataTables\Buttons-2.1.0\js\dataTables.buttons.min.js"></script>
            <script type="text/javascript" charset="utf8" src="view\DataTables\Buttons-2.1.0\js\buttons.html5.min.js"></script>
            <script type="text/javascript" charset="utf8" src="view\pdfmake-0.1.36\pdfmake.min.js"></script>
            <script type="text/javascript" charset="utf8" src="view\pdfmake-0.1.36\vfs_fonts.js"></script>
            <script type="text/javascript" charset="utf8" src="view\DataTables\Buttons-2.1.0\js\buttons.print.min.js"></script>
            
            <style>
            .graph-container1, .graph-container2, .data-table, .data-table2, .table-container, .dgraph-container, .lic-graph {
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f5f5f5;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .graph-container1 {
                max-width: 500px;
            }
            .graph-container2 {
                max-width: 800px;
            }
            .data-table, .data-table2, .table-container {
                margin: 20px auto;
                padding: 20px;
                border: 1px solid #ddd;
                border-radius: 5px;
                background-color: #f5f5f5;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                overflow-x: auto;
            }
            table {
                width: auto;
                border-collapse: collapse;
            }
            th {
                background-color: #4169E1;
                color: white;
                font-weight: bold;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            /* On hover, darken the container background and increase the box shadow */
            .graph-container1:hover, .graph-container2:hover,
            .data-table:hover, .data-table2:hover, .table-container:hover, .lic-graph:hover, .dgraph-container:hover{
                background-color: #f0f0f0;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            </style>
        </head>
        <body>
    
        <center><h2>ANSYS ANALYSIS</h2>
        <h3>(Currently Displaying Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . ')</h3></center>
        <center><form method="post" enctype="multipart/form-data">
            <!-- User Input Date Range -->
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>
            &nbsp;
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>
            <br><br>
            <button type="submit" name="submit2">Show Specified Data</button>
        </form></center>

        <div class="lic-graph">
            <center><h1>License Utilization</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="utilftLIC"></canvas>
                <script>
                    var licData = ' . json_encode($data["utilftlic"]) . ';
                
                    var dates = [];
                    var features = [];
                    var dataValues = {};
                
                    for (var i = 0; i < licData.length; i++) {
                        var date = licData[i].Date;
                        var feature = licData[i].feature;
                
                        if (!dates.includes(date)) {
                            dates.push(date);
                        }
                
                        if (!features.includes(feature)) {
                            features.push(feature);
                        }
                
                        if (!dataValues[date]) {
                            dataValues[date] = {};
                        }
                
                        dataValues[date][feature] = licData[i]["AVGLIC"];
                    }
                
                    var datasets = [];
                
                    for (var i = 0; i < features.length; i++) {
                        var feature = features[i];
                        var data = [];
                
                        for (var j = 0; j < dates.length; j++) {
                            var date = dates[j];
                            data.push(dataValues[date][feature] || 0);
                        }
                
                        var randomColor = getRandomColor();
                
                        datasets.push({
                            label: feature,
                            data: data,
                            backgroundColor: randomColor,
                            borderColor: randomColor,
                            borderWidth: 1,
                        });
                    }
                
                    var ctx = document.getElementById("utilftLIC").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: dates,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Utilization (%)"
                                    }
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
                </script>
            </div>
            
        <div class="lic-graph">
            <center><h1>Day-Wise License Calls wrt Feature</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="LICbarChart"></canvas>
                <script>
                    var licData = ' . json_encode($data["ftlic"]) . ';
                
                    // Extracting unique dates and features
                    var dates = [];
                    var features = [];
                    var dataValues = {};
                
                    for (var i = 0; i < licData.length; i++) {
                        var date = licData[i].Date;
                        var feature = licData[i].Feature;
                
                        if (!dates.includes(date)) {
                            dates.push(date);
                        }
                
                        if (!features.includes(feature)) {
                            features.push(feature);
                        }
                
                        if (!dataValues[date]) {
                            dataValues[date] = {};
                        }
                
                        dataValues[date][feature] = licData[i]["COUNTLIC"];
                    }
                
                    var datasets = [];
                
                    // Dataset for each feature with a random color
                    for (var i = 0; i < features.length; i++) {
                        var feature = features[i];
                        var data = [];
                
                        for (var j = 0; j < dates.length; j++) {
                            var date = dates[j];
                            data.push(dataValues[date][feature] || 0);
                        }
                
                        var randomColor = getRandomColor();
                
                        datasets.push({
                            label: feature,
                            data: data,
                            backgroundColor: randomColor,
                            borderColor: randomColor,
                            borderWidth: 1,
                        });
                    }
                
                    var ctx = document.getElementById("LICbarChart").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: dates,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Count"
                                    }
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
                </script>
            </div>

            <div class="lic-graph">
            <center><h1>Day-Wise License Calls wrt User</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="userLICbarChart"></canvas>
                <script>
                    var licData = ' . json_encode($data["userlic"]) . ';
                
                    // Extracting unique dates and users
                    var dates = [];
                    var users = [];
                    var dataValues = {};
                
                    for (var i = 0; i < licData.length; i++) {
                        var date = licData[i].Date;
                        var user = licData[i].U;
                
                        if (!dates.includes(date)) {
                            dates.push(date);
                        }
                
                        if (!users.includes(user)) {
                            users.push(user);
                        }
                
                        if (!dataValues[date]) {
                            dataValues[date] = {};
                        }
                
                        dataValues[date][user] = licData[i]["CNTLIC"];
                    }
                
                    var datasets = [];
                
                    // Dataset for each user with a random color
                    for (var i = 0; i < users.length; i++) {
                        var user = users[i];
                        var data = [];
                
                        for (var j = 0; j < dates.length; j++) {
                            var date = dates[j];
                            data.push(dataValues[date][user] || 0);
                        }
                
                        var randomColor = getRandomColor();
                
                        datasets.push({
                            label: user,
                            data: data,
                            backgroundColor: randomColor,
                            borderColor: randomColor,
                            borderWidth: 1,
                        });
                    }
                
                    var ctx = document.getElementById("userLICbarChart").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: dates,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Count"
                                    }
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
                </script>
            </div>

            <div class="Licenseconsumption">
                <br><center><h1>Top 5 License Consumption wrt User</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="LicenseconsumptionCanvas" width="400" height="200"></canvas>
            </div>

            <script>
                var userData = ' . json_encode($data["baseusage"]) . ';

                var groupedData = {};
                userData.forEach(function(item) {
                    var userMachine = item.UserMachine;
                    var Licenses = parseFloat(item.Licenses);

                    if (groupedData[userMachine]) {
                        groupedData[userMachine] += Licenses;
                    } else {
                        groupedData[userMachine] = Licenses;
                    }
                });

                var sortedDataArray = Object.entries(groupedData);

                sortedDataArray.sort(function(a, b) {
                    return b[1] - a[1];
                });

                var sortedGroupedData = {};
                sortedDataArray.forEach(function(item) {
                    sortedGroupedData[item[0]] = item[1];
                });


                var userMachines = Object.keys(sortedGroupedData).slice(0, 5);
                var LicenseData = Object.values(sortedGroupedData).slice(0, 5);

                var ctx = document.getElementById("LicenseconsumptionCanvas").getContext("2d");

                var chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: userMachines,
                        datasets: [
                            {
                                label: "Licenses Consumed",
                                backgroundColor: getRandomColors(userMachines.length),
                                borderWidth: 2,
                                data: LicenseData,
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Licenses"
                                }
                            },
                            x: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "UserMachine"
                                }
                            }
                        }
                    }
                });

                function getRandomColors(count) {
                    var colors = [];
                    for (var i = 0; i < count; i++) {
                        colors.push(getRandomColor());
                    }
                    return colors;
                }

                function getRandomColor() {
                    var letters = "0123456789ABCDEF";
                    var color = "#";
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            </script>

            <div class="Licenseconsumption">
                <br><center><h1>Top 5 License Consumption wrt Feature</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="LicenseconsumptionCanvas2" width="400" height="200"></canvas>
            </div>

            <script>
                var userData = ' . json_encode($data["usage"]) . ';

                var groupedData = {};
                userData.forEach(function(item) {
                    var Feature = item.Feature;
                    var Licenses = parseFloat(item.Licenses);

                    if (groupedData[Feature]) {
                        groupedData[Feature] += Licenses;
                    } else {
                        groupedData[Feature] = Licenses;
                    }
                });

                var sortedDataArray = Object.entries(groupedData);

                sortedDataArray.sort(function(a, b) {
                    return b[1] - a[1];
                });

                var sortedGroupedData = {};
                sortedDataArray.forEach(function(item) {
                    sortedGroupedData[item[0]] = item[1];
                });


                var Features = Object.keys(sortedGroupedData).slice(0, 5);
                var LicenseData = Object.values(sortedGroupedData).slice(0, 5);

                var ctx = document.getElementById("LicenseconsumptionCanvas2").getContext("2d");

                var chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: Features,
                        datasets: [
                            {
                                label: "Licenses Consumed",
                                backgroundColor: getRandomColors(Features.length),
                                borderWidth: 2,
                                data: LicenseData,
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Licenses"
                                }
                            },
                            x: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Feature"
                                }
                            }
                        }
                    }
                });

                function getRandomColors(count) {
                    var colors = [];
                    for (var i = 0; i < count; i++) {
                        colors.push(getRandomColor());
                    }
                    return colors;
                }

                function getRandomColor() {
                    var letters = "0123456789ABCDEF";
                    var color = "#";
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                }
            </script>

            <div class="table-container">
            <script>
                $(document).ready(function() {
                    $("#DT1").DataTable( {
                    dom: "Bfrtip",
                    buttons: [
                    "copy", "csv", "excel", "pdf", "print"
                    ]
                    } );
                } );
            </script>

                <center><h1>Overall Calls</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="DT1" class="display">
                    <thead>
                        <tr>
                            <th>Job ID</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Feature</th>
                            <th>UserMachine</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['calls'] as $record) :
            echo '<tr>
                                <td>' . $record["UniqueID"] . '</td>
                                <td>' . $record["Date"] . '</td>
                                <td>' . $record["Time"] . '</td>
                                <td>' . $record["Feature"] . '</td>
                                <td>' . $record["UserMachine"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>

            <div class="table-container">
            <script>
                $(document).ready(function() {
                    $("#denialTable1").DataTable( {
                    dom: "Bfrtip",
                    buttons: [
                    "copy", "csv", "excel", "pdf", "print"
                    ]
                    } );
                } );
            </script>

                <center><h1>DENIED Records</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="denialTable1" class="display">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Feature</th>
                            <th>UserMachine</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['denial'] as $record) :
            echo '<tr>
                                <td>' . $record["Date"] . '</td>
                                <td>' . $record["Time"] . '</td>
                                <td>' . $record["Feature"] . '</td>
                                <td>' . $record["UserMachine"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>

            <div class="dgraph-container">
            <center><h1>DENIED Record</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="denialLineGraph"></canvas>
                
                <script>
                    // Fetch and encode the denialcount data from PHP
                    var denialCountData = ' . json_encode($data["denialcount"]) . ';
                    var labels = denialCountData.map(item => item.Date); 
                    var datasets = [{
                        label: "Denial Count", 
                        data: denialCountData.map(item => item["COUNT(Status)"]),
                        borderColor: getRandomColor(),
                        fill: false
                    }];

                    var ctx = document.getElementById("denialLineGraph").getContext("2d");
                
                    new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Count"
                                    }
                                }
                            },
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
                </script>
            </div> 

            <div class="container" style="display: flex;">
            <div class="graph-container1" style="flex: fit;">
            <center><h1>Cumulative Feature Activity</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="featureGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("featureGraph").getContext("2d");
                    var featureData = ' . json_encode($data['featureDurations']) . ';
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
                                    getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor(),getRandomColor()
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
                </script>
            </div>

            <div class="graph-container1" style="flex: fit;">
            <center><h1>Top 5 Active UserMachines</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="UserMachineGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("UserMachineGraph").getContext("2d");
                    var UserMachineData = ' . json_encode($data['UserMachineDurations']) . ';
                    var labels = UserMachineData.map(item => item.UserMachine);
                    var data = UserMachineData.map(item => parseFloat(item.Duration));
                    new Chart(ctx, {
                        type: "pie",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Active Duration (hours)",
                                data: data,
                                backgroundColor: [
                                    getRandomColor(),getRandomColor(),getRandomColor(),
                                    getRandomColor(),getRandomColor()
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
                </script>
            </div>
            </div>

            <div class="data-table">
            <center><h1>Feature Activity Record</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="dataTable" class="display">
                    <thead><tr><th>Feature</th><th>Duration (hours)</th></tr></thead>
                    <tbody>';
        foreach ($data['featureDurations'] as $item) {
            echo '<tr><td>' . $item['Feature'] . '</td><td>' . $item['Duration'] . '</td></tr>';
        }
        echo '</tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $("#dataTable").DataTable( {
                        dom: "Bfrtip",
                        buttons: [
                        "copy", "csv", "excel", "pdf", "print"
                        ]
                        } );
                    } );
                </script>
            </div>
            <div class="graph-container2">
            <center><h1>Daily Engagement wrt Features</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="featureBarGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("featureBarGraph").getContext("2d");
                    var featureData = ' . json_encode($data['featureDurationsByDay']) . ';
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
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Hours"
                                    }
                                }
                            },
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
                </script>
            </div>

            <div class="data-table2">
                <center><h1>Engagement Dynamics wrt Features</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="dataTable2" class="display">
                    <thead><tr><th>Date</th>';

        // Print feature names as column headers
        foreach ($data['featureDurationsByDay'] as $featureData) {
            echo '<th>' . $featureData['Feature'] . '</th>';
        }

        echo '</tr></thead>
                    <tbody>';

        // Iterate through dates
        $dates = $data['featureDurationsByDay'][0]['Dates']; // Assuming Dates are the same for all features
        foreach ($dates as $date) {
            echo '<tr>
                            <td>' . $date . '</td>';

            // Iterate through features and find matching date
            foreach ($data['featureDurationsByDay'] as $featureData) {
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

        echo '</tbody>
                </table>
                <script>
                $(document).ready(function() {
                    $("#dataTable2").DataTable( {
                    dom: "Bfrtip",
                    buttons: [
                    "copy", "csv", "excel", "pdf", "print"
                    ]
                    } );
                } );
            </script>
            </div>
        </div>

        <div class="graph-container2">
            <center><h1>Daily Engagement wrt UserMachines</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="UserMachineBarGraph"></canvas>
                
                <script>
                    var ctx = document.getElementById("UserMachineBarGraph").getContext("2d");
                    var UserMachineData = ' . json_encode($data['UserMachineDurationsByDay']) . ';
                    var labels = UserMachineData[0].Dates; // Dates are the same for all UserMachines
                    var datasets = UserMachineData.map(item => {
                        return {
                            label: item.UserMachine,
                            data: item.Durations.map(d => parseFloat(d)),
                            borderColor: getRandomColor(),
                            fill: false
                        };
                    });
    
                    new Chart(ctx, {
                        type: "line",
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Hours"
                                    }
                                }
                            },
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
                </script>
            </div>

        <div class="data-table2">
            <center><h1>Engagement Dynamics wrt UserMachines</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
            <table id="dataTable3" class="display">
                <thead><tr><th>Date</th>';

                foreach ($dates as $date) {
                    echo '<th>' . $date . '</th>';
                }

        echo '</tr></thead>
                    <tbody>';

                    foreach ($data['UserMachineDurationsByDay'] as $UserMachineData) {
                        echo '<tr>';
                        echo '<td>' . $UserMachineData['UserMachine'] . '</td>';
            
                        foreach ($dates as $date) {
                            $UserMachineDateIndex = array_search($date, $UserMachineData['Dates']);
                            if ($UserMachineDateIndex !== false) {
                                $duration = $UserMachineData['Durations'][$UserMachineDateIndex];
                                echo '<td>' . $duration . '</td>';
                            } else {
                                echo '<td></td>';
                            }
                        }
            
                        echo '</tr>';
                    }

        echo '</tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $("#dataTable3").DataTable( {
                        dom: "Bfrtip",
                        buttons: [
                        "copy", "csv", "excel", "pdf", "print"
                        ]
                        } );
                    } );
                </script>
            </div>
        </div>

        <center><button id="printButtonFull">Print Page</button></center>
        <script>
            document.getElementById("printButtonFull").addEventListener("click", function() {
                window.print();
            });
        </script>
        </body>
        </html>';
    }
}
