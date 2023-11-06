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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $uploadedFile = $_FILES['log_file'];
    $fileMode = $_POST['file_mode'];
    if (isset($_FILES['log_file']) && $_FILES['log_file']['error'] === UPLOAD_ERR_OK) {
        // $logContent = file_get_contents($_FILES['log_file']['tmp_name']);
        // $processedData = processLog($logContent);

        if ($fileMode === "append") {
            $sql = "CREATE TABLE IF NOT EXISTS logansys (
                    Time TIME,
                    Software VARCHAR(255),
                    Status VARCHAR(50),
                    Feature VARCHAR(255),
                    UserMachine VARCHAR(255),
                    UniqueID INT,
                    Date DATE,
                    Licenses int DEFAULT NULL
                    )";
        } elseif ($fileMode === "overwrite") {
            $dropTableSQL = "DROP TABLE IF EXISTS logansys";
            $conn->query($dropTableSQL);
            $sql = "CREATE TABLE IF NOT EXISTS logansys (
                    Time TIME,
                    Software VARCHAR(255),
                    Status VARCHAR(50),
                    Feature VARCHAR(255),
                    UserMachine VARCHAR(255),
                    UniqueID INT,
                    Date DATE,
                    Licenses int DEFAULT NULL
                    )";
        }

        if ($conn->query($sql) === TRUE) {
            // echo "Table created successfully.<br>";

            $sourceFile = fopen($uploadedFile['tmp_name'], 'r');
            if ($sourceFile) {
                $currentDate = null;
                while (($line = fgets($sourceFile)) !== false) {
                    if (preg_match('/^(\d{1,2}:\d{1,2}:\d{1,2}) \((.*?)\) (OUT|DENIED|IN): "(.*?)" (.*?) \[(\d+)\]/', $line, $matches)) {
                        $time = $matches[1];
                        $software = $matches[2];
                        $status = $matches[3];
                        $feature = $matches[4];
                        $userMachine = $matches[5];
                        $uniqueID = $matches[6];
                        $licensesCount = 1;
                        if ($currentDate !== null) {
                            $sql = "INSERT INTO logansys (Time, Software, Status, Feature, UserMachine, UniqueID, Date, Licenses)
                                VALUES ('$time', '$software', '$status', '$feature', '$userMachine', '$uniqueID', '$currentDate', '$licensesCount')";

                            if ($conn->query($sql) !== TRUE) {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }
                        }
                    } elseif (preg_match('/TIMESTAMP (\d{1,2}\/\d{1,2}\/\d{4})/', $line, $dateMatches)) {
                        $currentDateStr = $dateMatches[1];
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
                // Generate CSV file and save it
                $csvFilename = 'ansys_info.csv';
                // $csvContent = $this->generateCSVContent($processedData);
                // file_put_contents($csvFilename, $csvContent);

                $featureDurations = calculateFeatureDurations();
                $featureDurationsByDay = calculateFeatureDurationsByDay();
                $denial = denial();
                $denialcount = denialcount();
                $view->success();
            }
        }
    }
} else {
    $view->showForm();
}


function generateCSVContent($data)
{
    $csvContent = "Date,Time,Software,Status,Feature,User Machine\n";
    foreach ($data as $entry) {
        $csvContent .= implode(',', $entry) . "\n";
    }
    return $csvContent;
}

class LogView
{
    public function showForm($error = null)
    {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <title>Log Processing</title>
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
                }
                .file-input-label:hover {
                    background-color: #2980b9;
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
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Log Processing</h1> <br><br>';

        if ($error) {
            echo '<p class="error">' . $error . '</p>';
        }

        echo '
                <form method="post" enctype="multipart/form-data">
                    <label for="log_file">Choose a Log File</label> 
                    <label class="file-input-label" for="log_file">Browse</label> <br>
                    <center><input type="file" name="log_file" id="log_file" required></center> <br><br>
                    <label>
                <input type="radio" name="file_mode" value="overwrite" required> Overwrite
                <input type="radio" name="file_mode" value="append" required> Append
            </label>
                    <button type="submit" name="submit">Process Log</button>
                </form>
            </div>
        </body>
        </html>';
    }

    public function success()
    {
        echo '<center><h3>Log File has been successfully parsed and saved in the Database!</h3></center>';
    }
}
