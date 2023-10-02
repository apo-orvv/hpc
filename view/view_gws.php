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
                .graph-container1, .graph-container2, .data-table, .data-table2, .info-container, .dgraph-container, .gwscpuchart, ,.gwsmemchart, .usermemchart, .usercpuchart, .gwschart, .userchart {
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f5f5f5;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .data-table, .data-table2, .info-container {
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
                .data-table:hover, .data-table2:hover, .info-container:hover, .gwscpuchart:hover, .dgraph-container:hover, .gwsmemchart:hover, .usermemchart:hover, .usercpuchart:hover, .gwschart:hover, .userchart:hover{
                    background-color: #f0f0f0;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }
            </style>
        </head>
        <body>
        
        <script>
        function getRandomColor() {
            var letters = "0123456789ABCDEF";
            var color = "#";
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        </script>

        <center><h2>WORKSTATION ANALYSIS</h2>
        <h3>(Currently Displaying Data from ' . $data["startDate"] . ' to ' . $data["endDate"] . ')</h3></center>
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

            <div class="gwschart">
            <br><center><h1>GWS Utilization</h1></center>
            <canvas id="gwschart" width="400" height="200"></canvas>
        
        
        <script>
            // PHP data from your query
            var gwsData = ' . json_encode($data["gws"]) . ';
            var gwscpuData = ' . json_encode($data["gwscpu"]) . ';
            var gwsmemData = ' . json_encode($data["gwsmem"]) . ';
        
            // Extract labels and data for the chart
            var labels = gwsData.map(function(item) {
                return item.GWSNAME;
            });
        
            var gwsUtilizationData = gwsData.map(function(item) {
                return parseFloat(item["perf"]);
            });
        
            var cpuUtilizationData = gwscpuData.map(function(item) {
                return parseFloat(item["ROUND(AVG(CPULoad))"]);
            });
        
            var memUtilizationData = gwsmemData.map(function(item) {
                return parseFloat(item["ROUND(AVG(MemLoad))"]);
            });
        
            var ctx = document.getElementById("gwschart").getContext("2d");
        
            var chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Overall Utilization",
                            backgroundColor: getRandomColor(),
                            borderWidth: 2,
                            data: gwsUtilizationData,
                        },
                        {
                            label: "CPU Utilization",
                            backgroundColor: getRandomColor(),
                            borderWidth: 2,
                            data: cpuUtilizationData,
                        },
                        {
                            label: "Memory Utilization",
                            backgroundColor: getRandomColor(),
                            borderWidth: 2,
                            data: memUtilizationData,
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            stacked: true,
                            ticks: {
                                display: false
                            },
                            title: {
                                display: true,
                                text: "Utilization(%)"
                            }
                        },
                        x: {
                            stacked: true,
                            title: {
                                display: true,
                                text: "GWS"
                            }
                        }
                    }
                }
            });
        </script>
        </div>

        <div class="userchart">
    <br><center><h1>User Utilization</h1></center>
    <canvas id="userchart" width="400" height="200"></canvas>
</div>

<script>
    // PHP data from your query
    var userData = ' . json_encode($data["user"]) . ';
    var userCpuData = ' . json_encode($data["usercpu"]) . ';
    var userMemData = ' . json_encode($data["usermem"]) . ';

    // Extract labels and data for the chart
    var labels = userData.map(function(item) {
        return item.loggedinuser;
    });

    var userUtilizationData = userData.map(function(item) {
        return parseFloat(item["perf"]);
    });

    var userCpuUtilizationData = userCpuData.map(function(item) {
        return parseFloat(item["ROUND(AVG(CPULoad))"]);
    });

    var userMemUtilizationData = userMemData.map(function(item) {
        return parseFloat(item["ROUND(AVG(MemLoad))"]);
    });

    var ctx = document.getElementById("userchart").getContext("2d");

    var chart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Overall Utilization",
                    backgroundColor: getRandomColor(),
                    borderWidth: 2,
                    data: userUtilizationData,
                },
                {
                    label: "CPU Utilization",
                    backgroundColor: getRandomColor(),
                    borderWidth: 2,
                    data: userCpuUtilizationData,
                },
                {
                    label: "Memory Utilization",
                    backgroundColor: getRandomColor(),
                    borderWidth: 2,
                    data: userMemUtilizationData,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    stacked: true,
                    ticks: {
                        display: false
                    },
                    title: {
                        display: true,
                        text: "Utilization(%)"
                    }
                },
                x: {
                    stacked: true,
                    title: {
                        display: true,
                        text: "User"
                    }
                }
            }
        }
    });
</script>

<div class="info-container">
                <script>
                    $(document).ready(function() {
                        $("#denialTable1").DataTable();
                    });
                </script>

                <h1>Workstation Utilization Statistics</h1>
                <table id="denialTable1" class="display">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>GWS</th>
                            <th>CDrive (%)</th>
                            <th>Memory (%)</th>
                            <th>CPU (%)</th>
                            <th>Overall (%)</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['info'] as $record) :
            echo '<tr>
                                <td>' . $record["loggedinuser"] . '</td>
                                <td>' . $record["gwsname"] . '</td>
                                <td>' . $record["ROUND(AVG(CDrive))"] . '</td>
                                <td>' . $record["ROUND(AVG(MemLoad))"] . '</td>
                                <td>' . $record["ROUND(AVG(CPULoad))"] . '</td>
                                <td>' . $record["perf"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>
        </body>
        </html>
        
        ';
    }
}
