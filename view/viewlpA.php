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
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
            <style>
                .graph-container1, .graph-container2, .data-table, .data-table2, .denial-container, .dgraph-container, .lic-graph {
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
                .data-table, .data-table2, .denial-container {
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
                .data-table:hover, .data-table2:hover, .denial-container:hover, .lic-graph:hover, .dgraph-container:hover{
                    background-color: #f0f0f0;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }
            </style>
        </head>
        <body>
            <center><h2>ABAQUS ANALYSIS</h2>
            <h3>(Currently Displaying Data from ' .$data["startDate"]. ' to ' .$data["endDate"]. ')</h3></center>
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
            <h1>FEATURE TOKEN USAGE</h1>
                <canvas id="LICbarChart"></canvas>
                <script>
                    var licData = ' . json_encode($data["lic"]) . ';
                
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
                
                        dataValues[date][feature] = licData[i]["AVGLIC"];
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
                                        text: "Tokens"
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

            <div class="denial-container">
                <script>
                    $(document).ready(function() {
                        $("#denialTable1").DataTable();
                    });
                </script>

                <h1>DENIED Records</h1>
                <table id="denialTable1" class="display">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Feature</th>
                            <th>UserMachine</th>
                            <th>Tokens</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['denial'] as $record) :
            echo '<tr>
                                <td>' . $record["Date"] . '</td>
                                <td>' . $record["Time"] . '</td>
                                <td>' . $record["Feature"] . '</td>
                                <td>' . $record["UserMachine"] . '</td>
                                <td>' . $record["Licenses"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>
            
            <!-- <div class="denial-container2">
                <script>
                    $(document).ready(function() {
                        $("#denialTable2").DataTable();
                    });
                </script>

                <h1>DENIED COUNT</h1>
                <table id="denialTable2" class="display">
                    <thead>
                        <tr>
                            <th>Frequency</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['denialcount'] as $record) :
            echo '<tr>
                                <td>' . $record["COUNT(Status)"] . '</td>
                                <td>' . $record["Date"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div> -->

            <div class="dgraph-container">
                <h1>DENIAL COUNT</h1>
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


            <div class="graph-container1">
                <h1>Cumulative Feature Tracker</h1>
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
            <div class="data-table">
                <h2>Feature Monitor</h2>
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
                        $("#dataTable").DataTable();
                    });
                </script>
            </div>
            <div class="graph-container2">
                <h1>Feature Flux: Charting Daily Engagement</h1>
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
                <h2>Engagement Dynamics: Daily Feature Activity</h2>
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
                        $("#dataTable2").DataTable();
                    });
                </script>
            </div>
        </div>
        </body>
        </html>';
    }
}
