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
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
            <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
            <style>
                .info-container, .gwschart, .userchart, .gwschartdiff, .userchartdiff {
                    margin: 20px auto;
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    background-color: #f5f5f5;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                }

                .info-container {
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
                .info-container:hover, .gwschart:hover, .userchart:hover, .gwschartdiff:hover, .userchartdiff:hover{
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
            <center>
            <div class="gwschartdiff">
            <br><center><h1>GWS Utilization</h1></center>
            <div id="chartContainer" style="display: none;"></div>

            <canvas id="gwschartdiff" width="400" height="200"></canvas>
            <button id="printButton">Print Chart</button></center>


        
        <script>
            // PHP data from your query
            var gwsData = ' . json_encode($data["gwsdiff"]) . ';
            var gwscpuData = ' . json_encode($data["gwscpudiff"]) . ';
            var gwsmemData = ' . json_encode($data["gwsmemdiff"]) . ';
        
            // Extract labels and data for the chart
            var labels = gwsData.map(function(item) {
                return item.GWSNAME;
            });
        
            var gwsUtilizationData = gwsData.map(function(item) {
                return parseFloat(item["perf"]);
            });
        
            var cpuUtilizationData = gwscpuData.map(function(item) {
                return parseFloat(item["T"]);
            });
        
            var memUtilizationData = gwsmemData.map(function(item) {
                return parseFloat(item["T"]);
            });
        
            var ctx = document.getElementById("gwschartdiff").getContext("2d");
        
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

            document.getElementById("printButton").addEventListener("click", function() {
                var containerToPrint = document.querySelector(".gwschartdiff");
                var clonedContainer = containerToPrint.cloneNode(true);
                var newWindow = window.open("", "_blank");
              
                newWindow.document.body.appendChild(clonedContainer);
              
                var chartCanvas = document.getElementById("gwschartdiff");
                var chartImage = new Image();
                chartImage.src = chartCanvas.toDataURL("image/png");
                var chartContainerInPrint = newWindow.document.getElementById("chartContainer");
                chartContainerInPrint.style.display = "block";
                chartContainerInPrint.appendChild(chartImage);
                newWindow.print();
                newWindow.close();
              });
              
        </script>
        </div>

        <div class="userchartdiff">
    <br><center><h1>User Utilization</h1></center>
    <div id="chartContainer" style="display: none;"></div>
    <canvas id="userchartdiff" width="400" height="200"></canvas>
    <center><button id="printButton2">Print Chart</button></center>
</div>

<script>
    // PHP data from your query
    var userData = ' . json_encode($data["userdiff"]) . ';
    var userCpuData = ' . json_encode($data["usercpudiff"]) . ';
    var userMemData = ' . json_encode($data["usermemdiff"]) . ';

    // Extract labels and data for the chart
    var labels = userData.map(function(item) {
        return item.loggedinuser;
    });

    var userUtilizationData = userData.map(function(item) {
        return parseFloat(item["perf"]);
    });

    var userCpuUtilizationData = userCpuData.map(function(item) {
        return parseFloat(item["T"]);
    });

    var userMemUtilizationData = userMemData.map(function(item) {
        return parseFloat(item["T"]);
    });

    var ctx = document.getElementById("userchartdiff").getContext("2d");

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

    document.getElementById("printButton2").addEventListener("click", function() {
        var containerToPrint = document.querySelector(".userchartdiff");
        var clonedContainer = containerToPrint.cloneNode(true);
        var newWindow = window.open("", "_blank");
      
        newWindow.document.body.appendChild(clonedContainer);
      
        var chartCanvas = document.getElementById("userchartdiff");
        var chartImage = new Image();
        chartImage.src = chartCanvas.toDataURL("image/png");
        var chartContainerInPrint = newWindow.document.getElementById("chartContainer");
        chartContainerInPrint.style.display = "block";
        chartContainerInPrint.appendChild(chartImage);
        newWindow.print();
        newWindow.close();
      });
</script>

<div class="info-container">
                <script>
                $(document).ready(function() {
                    $("#utilTable").DataTable( {
                    dom: "Bfrtip",
                    buttons: [
                    "copy", "csv", "excel", "pdf", "print"
                    ]
                    } );
                } );
                </script>

                <center><h1>Utilization Statistics</h1></center>
                <table id="utilTable" class="display">
                    <thead>
                        <tr>
                            <th>UserName</th>
                            <th>GWS</th>
                            <th>CDrive (%)</th>
                            <th>Memory (%)</th>
                            <th>CPU (%)</th>
                            <th>Overall (%)</th>
                            <th>Duration (Hrs)</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach ($data['infodiff'] as $record) :
            echo '<tr>
                                <td>' . $record["loggedinuser"] . '</td>
                                <td>' . $record["gwsname"] . '</td>
                                <td>' . $record["T1"] . '</td>
                                <td>' . $record["T2"] . '</td>
                                <td>' . $record["T3"] . '</td>
                                <td>' . $record["perf"] . '</td>
                                <td>' . $record["D"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>


            <div class="gwschart">
            <br><center><h1>Peak GWS Utilization</h1></center>
            <div id="chartContainer" style="display: none;"></div>
            <canvas id="gwschart" width="400" height="200"></canvas>
            <center><button id="printButton3">Print Chart</button></center>
            
            
        
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
                return parseFloat(item["ROUND(MAX(CPULoad))"]);
            });
        
            var memUtilizationData = gwsmemData.map(function(item) {
                return parseFloat(item["ROUND(MAX(MemLoad))"]);
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

            document.getElementById("printButton3").addEventListener("click", function() {
                var containerToPrint = document.querySelector(".gwschart");
                var clonedContainer = containerToPrint.cloneNode(true);
                var newWindow = window.open("", "_blank");
              
                newWindow.document.body.appendChild(clonedContainer);
              
                var chartCanvas = document.getElementById("gwschart");
                var chartImage = new Image();
                chartImage.src = chartCanvas.toDataURL("image/png");
                var chartContainerInPrint = newWindow.document.getElementById("chartContainer");
                chartContainerInPrint.style.display = "block";
                chartContainerInPrint.appendChild(chartImage);
                newWindow.print();
                newWindow.close();
              });
        </script>
        </div>

        <div class="userchart">
    <br><center><h1>Peak User Utilization</h1></center>
    <div id="chartContainer" style="display: none;"></div>
    <canvas id="userchart" width="400" height="200"></canvas>
    <center><button id="printButton4">Print Chart</button></center>
    
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
        return parseFloat(item["ROUND(MAX(CPULoad))"]);
    });

    var userMemUtilizationData = userMemData.map(function(item) {
        return parseFloat(item["ROUND(MAX(MemLoad))"]);
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

    document.getElementById("printButton4").addEventListener("click", function() {
        var containerToPrint = document.querySelector(".userchart");
        var clonedContainer = containerToPrint.cloneNode(true);
        var newWindow = window.open("", "_blank");
      
        newWindow.document.body.appendChild(clonedContainer);
      
        var chartCanvas = document.getElementById("userchart");
        var chartImage = new Image();
        chartImage.src = chartCanvas.toDataURL("image/png");
        var chartContainerInPrint = newWindow.document.getElementById("chartContainer");
        chartContainerInPrint.style.display = "block";
        chartContainerInPrint.appendChild(chartImage);
        newWindow.print();
        newWindow.close();
      });
</script>

<div class="info-container">
                <script>
                $(document).ready(function() {
                    $("#peakTable").DataTable( {
                    dom: "Bfrtip",
                    buttons: [
                    "copy", "csv", "excel", "pdf", "print"
                    ]
                    } );
                } );
                </script>

                <center><h1>Peak Utilization Statistics</h1></center>
                <table id="peakTable" class="display">
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
                                <td>' . $record["ROUND(MAX(CDrive))"] . '</td>
                                <td>' . $record["ROUND(MAX(MemLoad))"] . '</td>
                                <td>' . $record["ROUND(MAX(CPULoad))"] . '</td>
                                <td>' . $record["perf"] . '</td>
                            </tr>';
        endforeach;
        echo '</tbody>
                </table>
            </div>
            <center><button id="printButtonFull">Print Page</button></center>
            <script>
                document.getElementById("printButtonFull").addEventListener("click", function() {
                    window.print();
                });
            </script>
        </body>
        </html>
        
        ';
    }
}
