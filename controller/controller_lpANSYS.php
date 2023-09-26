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
$view = new LogView();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $uploadedFile = $_FILES['log_file'];
    if (isset($_FILES['log_file']) && $_FILES['log_file']['error'] === UPLOAD_ERR_OK) {
        // $logContent = file_get_contents($_FILES['log_file']['tmp_name']);
        // $processedData = processLog($logContent);

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
                // Generate CSV file and save it
                $csvFilename = 'ansys_info.csv';
                // $csvContent = $this->generateCSVContent($processedData);
                // file_put_contents($csvFilename, $csvContent);

                $featureDurations = calculateFeatureDurations();
                $featureDurationsByDay = calculateFeatureDurationsByDay();
                $denial = denial();
                $denialcount = denialcount();
                $view->success();
                // $view->displayData([
                //     'denial' => $denial,
                //     'denialcount' => $denialcount,
                //     'featureDurationsByDay' => $featureDurationsByDay,
                //     'featureDurations' => $featureDurations,
                // ], $csvFilename);
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
// Check if the form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Retrieve user-inputted start and end dates
//     $startDate = $_POST['start_date'];
//     $endDate = $_POST['end_date'];
//     $uploadedFile = $_FILES['file'];
//     if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
//         echo "File upload failed with error code: " . $_FILES['file']['error'];
//         exit;
//     }

//     // Validate and sanitize user inputs (you can add more validation here)
//     $startDate = filter_var($startDate, FILTER_SANITIZE_SPECIAL_CHARS);
//     $endDate = filter_var($endDate, FILTER_SANITIZE_SPECIAL_CHARS);

//     $dropTableSQL = "DROP TABLE IF EXISTS logansys";
//     $conn->query($dropTableSQL);

//     // Define SQL query to create the table
//     $sql = "CREATE TABLE IF NOT EXISTS logansys (
//         Time TIME,
//         Software VARCHAR(255),
//         Status VARCHAR(50),
//         Feature VARCHAR(255),
//         UserMachine VARCHAR(255),
//         UniqueID INT,
//         Date DATE
//     )";

//     // Execute the query to create the table
//     if ($conn->query($sql) === TRUE) {
//         // echo "Table created successfully.<br>";

//         // Open the text file for reading (your code for reading and inserting data)
//         $sourceFile = fopen($uploadedFile['tmp_name'], 'r');

//         if ($sourceFile) {
//             // Initialize the date variable
//             $currentDate = null;

//             // Loop through each line in the text file
//             while (($line = fgets($sourceFile)) !== false) {
//                 // Extract the relevant data from each line
//                 if (preg_match('/^(\d{1,2}:\d{1,2}:\d{1,2}) \((.*?)\) (OUT|DENIED|IN): "(.*?)" (.*?) \[(\d+)\]/', $line, $matches)) {
//                     $time = $matches[1];
//                     $software = $matches[2];
//                     $status = $matches[3];
//                     $feature = $matches[4];
//                     $userMachine = $matches[5];
//                     $uniqueID = $matches[6];

//                     // Check if the date is present before inserting data
//                     if ($currentDate !== null) {
//                         // Insert the extracted data into the database table
//                         $sql = "INSERT INTO logansys (Time, Software, Status, Feature, UserMachine, UniqueID, Date)
//                                 VALUES ('$time', '$software', '$status', '$feature', '$userMachine', '$uniqueID', '$currentDate')";

//                         if ($conn->query($sql) !== TRUE) {
//                             echo "Error: " . $sql . "<br>" . $conn->error;
//                         }
//                     }
//                 } elseif (preg_match('/TIMESTAMP (\d{1,2}\/\d{1,2}\/\d{4})/', $line, $dateMatches)) {
//                     $currentDateStr = $dateMatches[1];
//                     // Try to create a DateTime object with different date formats
//                     $dateFormats = ['m/d/Y', 'n/j/Y', 'd/m/Y', 'Y-m-d'];
//                     foreach ($dateFormats as $dateFormat) {
//                         $currentDate = DateTime::createFromFormat($dateFormat, $currentDateStr);
//                         if ($currentDate !== false) {
//                             $currentDate = $currentDate->format('Y-m-d');
//                             break; // Stop trying other formats once a valid one is found
//                         }
//                     }
//                     if ($currentDate === false) {
//                         echo "Error: Invalid date format - $currentDateStr";
//                     }
//                 }
//             }

//             // Close the text file
//             fclose($sourceFile);
//             // echo "Data extraction and storage completed.";

//             $featureDurations = calculateFeatureDurations($startDate, $endDate);
//             $featureDurationsByDay = calculateFeatureDurationsByDay($startDate, $endDate);
//         } else {
//             echo "Error: Unable to open the source text file.";
//         }
//     } else {
//         echo "Error creating table: " . $conn->error;
//     }
// }
?>

<?php
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
                    <button type="submit" name="submit">Process Log</button>
                </form>
            </div>
        </body>
        </html>';
    }

    public function success(){
        echo '<center><h3>Log File has been successfully parsed and saved in the Database!</h3></center>';
    }
}
