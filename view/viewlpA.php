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
                .container, .graph-container1, .graph-container2, .data-table, .data-table2, .table-container, .dgraph-container, .utilgraph, .tokenconsumption{
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f5f5f5;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }
                .graph-container1 {
                    max-width: 500px;
                    max-height: 5000px;
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
                .tokenconsumption:hover, .container:hover, .graph-container1:hover, .graph-container2:hover,
                .data-table:hover, .data-table2:hover, .table-container:hover, .utilgraph:hover, .dgraph-container:hover{
                    background-color: #f0f0f0;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }
                .show-lic-graph-by-feature,
                .show-lic-graph-by-user,
                .tknconuser,
                .tknconft {
                margin-right: 10px;
                background-color: #ccc;
                padding: 10px;
                border-radius: 5px;
                }
                .lic-graph, .tokenconsumption {
                display: none;
                }
                .show-both-lic-graphs, .tknconboth {
                    background-color: #00CED1;
                    color: #fff;
                }
                .incsize {
                    font-size: 18px;
                }                  
            </style>
        </head>
        <body>
            <center><h2>ABAQUS ANALYSIS</h2>
            <h3>(Currently Displaying Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . ')</h3></center>
            <center><form method="post" enctype="multipart/form-data">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" required>
                &nbsp;
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" required>
                <br><br>
                <button type="submit" name="submit2">Show Specified Data</button>
            </form></center>
    
            <div class="utilgraph">
            <center><h1>Token Utilization (%)</h1>
                    <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="utilftLIC"></canvas>
                <script>
                    var licData = ' . json_encode($data["utilftlic"]) . ';
                
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
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            borderSkipped: false, 
                        });
                    }
                
                    var ctx = document.getElementById("utilftLIC").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "bar",
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
            </div><br>

            <div><center class="incsize">
                Day-Wise Avg. Token Usage: &nbsp;
                <button class="show-lic-graph-by-feature">Feature</button> / 
                &nbsp;&nbsp;&nbsp;<button class="show-lic-graph-by-user">User</button><br><br>
                <button class="show-both-lic-graphs">Display Both</button>
            </center></div><br><br><br>

            <div id="lic-graph-by-feature" class="lic-graph">
            <center><h1>Day-Wise Avg. Token Usage wrt Feature</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="ftLICbarChart"></canvas>
                <script>
                    var licData = ' . json_encode($data["ftlic"]) . ';
                
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
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            borderSkipped: false, 
                        });
                    }
                
                    var ctx = document.getElementById("ftLICbarChart").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: dates,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    stacked: true,
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Token Count"
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

            <div id="lic-graph-by-user" class="lic-graph">
                <center><h1>Day-Wise Avg. Token Usage wrt User</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="userLICbarChart"></canvas>
                <script>
                    var licData = ' . json_encode($data["userlic"]) . ';
                
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
                
                        dataValues[date][user] = licData[i]["AVGLIC"];
                    }
                
                    var datasets = [];
                
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
                            borderWidth: 2,
                            borderRadius: Number.MAX_VALUE,
                            borderSkipped: false, 
                        });
                    }
                
                    var ctx = document.getElementById("userLICbarChart").getContext("2d");
                    var myBarChart = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: dates,
                            datasets: datasets
                        },
                        options: {
                            scales: {
                                x: {
                                    stacked: true,
                                    title: {
                                        display: true,
                                        text: "Date"
                                    }
                                },
                                y: {
                                    stacked: true,
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: "Token Count"
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

            <script>
                const featureLicGraph = document.getElementById("lic-graph-by-feature");
                const userLicGraph = document.getElementById("lic-graph-by-user");

                const showLicGraphByFeatureButton = document.querySelector(".show-lic-graph-by-feature");
                showLicGraphByFeatureButton.addEventListener("click", () => {
                featureLicGraph.style.display = "block";
                userLicGraph.style.display = "none";
                });
                const showLicGraphByUserButton = document.querySelector(".show-lic-graph-by-user");
                showLicGraphByUserButton.addEventListener("click", () => {
                userLicGraph.style.display = "block";
                featureLicGraph.style.display = "none";
                });
                const showBothLicGraphsButton = document.querySelector(".show-both-lic-graphs");
                showBothLicGraphsButton.addEventListener("click", () => {
                featureLicGraph.style.display = "block";
                userLicGraph.style.display = "block";
                });
            </script>

            <div><center class="incsize">
                Top 5 Token Consumption: &nbsp;
                <button class="tknconuser">User [Base License]</button> / 
                &nbsp;&nbsp;&nbsp;<button class="tknconft">Feature</button><br><br>
                <button class="tknconboth">Display Both</button>
            </center></div><br>

            <div id="conuser" class="tokenconsumption">
                <br><center><h1>Top 5 Token Consumption wrt User [Base License]</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="tokenconsumptionCanvas" width="400" height="200"></canvas>
            </div>

            <script>
                var userData = ' . json_encode($data["baseusage"]) . ';

                var groupedData = {};
                userData.forEach(function(item) {
                    var userMachine = item.UserMachine;
                    var tokens = parseFloat(item.Licenses);

                    if (groupedData[userMachine]) {
                        groupedData[userMachine] += tokens;
                    } else {
                        groupedData[userMachine] = tokens;
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
                var tokenData = Object.values(sortedGroupedData).slice(0, 5);

                var ctx = document.getElementById("tokenconsumptionCanvas").getContext("2d");

                var chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: userMachines,
                        datasets: [
                            {
                                label: "Tokens Consumed",
                                backgroundColor: getRandomColors(userMachines.length),
                                borderWidth: 2,
                                borderRadius: Number.MAX_VALUE,
                                borderSkipped: false, 
                                data: tokenData,
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Tokens"
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

            <div id="conft" class="tokenconsumption">
                <br><center><h1>Top 5 Token Consumption wrt Feature</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="tokenconsumptionCanvas2" width="400" height="200"></canvas>
            </div>

            <script>
                var userData = ' . json_encode($data["usage"]) . ';

                var groupedData = {};
                userData.forEach(function(item) {
                    var Feature = item.Feature;
                    var tokens = parseFloat(item.Licenses);

                    if (groupedData[Feature]) {
                        groupedData[Feature] += tokens;
                    } else {
                        groupedData[Feature] = tokens;
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
                var tokenData = Object.values(sortedGroupedData).slice(0, 5);

                var ctx = document.getElementById("tokenconsumptionCanvas2").getContext("2d");

                var chart = new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: Features,
                        datasets: [
                            {
                                label: "Tokens Consumed",
                                backgroundColor: getRandomColors(Features.length),
                                borderWidth: 2,
                                borderRadius: Number.MAX_VALUE,
                                borderSkipped: false, 
                                data: tokenData,
                            }
                        ],
                    },
                    options: {
                        scales: {
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: "Tokens"
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

            <script>
                const userConGraph = document.getElementById("conuser");
                const ftConGraph = document.getElementById("conft");

                const conGraphByUser = document.querySelector(".tknconuser");
                conGraphByUser.addEventListener("click", () => {
                userConGraph.style.display = "block";
                ftConGraph.style.display = "none";
                });
                const conGraphByFt = document.querySelector(".tknconft");
                conGraphByFt.addEventListener("click", () => {
                ftConGraph.style.display = "block";
                userConGraph.style.display = "none";
                });
                const conGraphBoth = document.querySelector(".tknconboth");
                conGraphBoth.addEventListener("click", () => {
                userConGraph.style.display = "block";
                ftConGraph.style.display = "block";
                });
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

                <center><h1>Overall Usage</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="DT1" class="display">
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
        foreach ($data['usage'] as $record) :
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

            <div class="table-container">
                <script>
                    $(document).ready(function() {
                        $("#DT2").DataTable( {
                        dom: "Bfrtip",
                        buttons: [
                        "copy", "csv", "excel", "pdf", "print"
                        ]
                        } );
                    } );
                </script>

                <center><h1>DENIED Records</h1>
                <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="DT2" class="display">
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

            <div class="dgraph-container">
            <center><h1>DENIED Record [Base License]</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <canvas id="denialLineGraph"></canvas>
                
                <script>
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
                        type: "pie",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Active Duration (hours)",
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
            <center><h1>Engagement Dynamics wrt Features</h1>
            <h3>Data from ' . date("d-m-Y", strtotime($data["startDate"])) . ' to ' . date("d-m-Y", strtotime($data["endDate"])) . '</h3></center>
                <table id="dataTable2" class="display">
                    <thead><tr><th>Date</th>';

        foreach ($data['featureDurationsByDay'] as $featureData) {
            echo '<th>' . $featureData['Feature'] . '</th>';
        }

        echo '</tr></thead>
                    <tbody>';

        $dates = $data['featureDurationsByDay'][0]['Dates'];
        foreach ($dates as $date) {
            echo '<tr><td>' . $date . '</td>';
            foreach ($data['featureDurationsByDay'] as $featureData) {
                $featureDateIndex = array_search($date, $featureData['Dates']);
                if ($featureDateIndex !== false) {
                    $duration = $featureData['Durations'][$featureDateIndex];
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
