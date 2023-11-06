<?php

function dates()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $minDateQuery = "SELECT MIN(Date) FROM logansys";
    $maxDateQuery = "SELECT MAX(Date) FROM logansys";
    $minDateStmt = $pdo->query($minDateQuery);
    $maxDateStmt = $pdo->query($maxDateQuery);
    $minDate = $minDateStmt->fetchColumn();
    $maxDate = $maxDateStmt->fetchColumn();
    return [
        'minDate' => $minDate,
        'maxDate' => $maxDate,
    ];
}

// Function to calculate feature durations
function calculateFeatureDurations()
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "
    SELECT Feature, 
           IFNULL(SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))), '00:00:00') AS Duration
    FROM (
        SELECT 
            Feature, 
            MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
            MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
        FROM logansys
        GROUP BY Feature, Date
    ) AS FeatureStatus
    GROUP BY Feature
";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calculateFeatureDurationschoice($startDate, $endDate)
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "
    SELECT Feature, 
           IFNULL(SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))), '00:00:00') AS Duration
    FROM (
        SELECT 
            Feature, 
            MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
            MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
        FROM logansys
        WHERE Date >= ? AND Date <= ?
        GROUP BY Feature, Date
    ) AS FeatureStatus
    GROUP BY Feature
";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to calculate feature durations by day
function calculateFeatureDurationsByDay()
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $minDateQuery = "SELECT MIN(Date) FROM logansys";
    $maxDateQuery = "SELECT MAX(Date) FROM logansys";
    $minDateStmt = $pdo->query($minDateQuery);
    $maxDateStmt = $pdo->query($maxDateQuery);
    $minDate = $minDateStmt->fetchColumn();
    $maxDate = $maxDateStmt->fetchColumn();

    $sql = "
            SELECT
            Feature,
            Date,
            SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
        FROM (
            SELECT
                Feature,
                Date,
                MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
            FROM logansys
            WHERE Date >= :minDate AND Date <= :maxDate
            GROUP BY Feature, Date
        ) AS FeatureStatus
        GROUP BY Feature, Date;
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":minDate", $minDate);
    $stmt->bindParam(":maxDate", $maxDate);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a list of dates within the range
    $dateRange = [];
    $currentDate = new DateTime($minDate);
    $endDateObj = new DateTime($maxDate);

    while ($currentDate <= $endDateObj) {
        $dateRange[] = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 day');
    }

    // Initialize the result array
    $featureDurationsByDay = [];

    // Fill in the missing entries with NULL values
    foreach ($data as $row) {
        $feature = $row['Feature'];
        $date = $row['Date'];
        $duration = $row['Duration'];

        if (!isset($featureDurationsByDay[$feature])) {
            $featureDurationsByDay[$feature] = [
                'Feature' => $feature,
                'Dates' => [],
                'Durations' => []
            ];
        }

        $featureDurationsByDay[$feature]['Dates'][] = $date;
        $featureDurationsByDay[$feature]['Durations'][] = $duration;
    }

    // Fill in missing dates with NULL values
    foreach ($featureDurationsByDay as &$featureData) {
        foreach ($dateRange as $date) {
            if (!in_array($date, $featureData['Dates'])) {
                $featureData['Dates'][] = $date;
                $featureData['Durations'][] = null; // NULL value for missing date
            }
        }
        // Replace NULL durations with "00:00:00"
        foreach ($featureData['Durations'] as &$duration) {
            if ($duration === null) {
                $duration = "00:00:00";
            }
        }
        // Sort the data by date
        array_multisort($featureData['Dates'], $featureData['Durations']);
    }

    return array_values($featureDurationsByDay);
}

function calculateFeatureDurationsByDaychoice($startDate, $endDate)
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "
            SELECT
            Feature,
            Date,
            SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
        FROM (
            SELECT
                Feature,
                Date,
                MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
            FROM logansys
            WHERE Date >= ? AND Date <= ?
            GROUP BY Feature, Date
        ) AS FeatureStatus
        GROUP BY Feature, Date;
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create a list of dates within the range
    $dateRange = [];
    $currentDate = new DateTime($startDate);
    $endDateObj = new DateTime($endDate);

    while ($currentDate <= $endDateObj) {
        $dateRange[] = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 day');
    }

    // Initialize the result array
    $featureDurationsByDay = [];

    // Fill in the missing entries with NULL values
    foreach ($data as $row) {
        $feature = $row['Feature'];
        $date = $row['Date'];
        $duration = $row['Duration'];

        if (!isset($featureDurationsByDay[$feature])) {
            $featureDurationsByDay[$feature] = [
                'Feature' => $feature,
                'Dates' => [],
                'Durations' => []
            ];
        }

        $featureDurationsByDay[$feature]['Dates'][] = $date;
        $featureDurationsByDay[$feature]['Durations'][] = $duration;
    }

    // Fill in missing dates with NULL values
    foreach ($featureDurationsByDay as &$featureData) {
        foreach ($dateRange as $date) {
            if (!in_array($date, $featureData['Dates'])) {
                $featureData['Dates'][] = $date;
                $featureData['Durations'][] = null; // NULL value for missing date
            }
        }
        // Replace NULL durations with "00:00:00"
        foreach ($featureData['Durations'] as &$duration) {
            if ($duration === null) {
                $duration = "00:00:00";
            }
        }
        // Sort the data by date
        array_multisort($featureData['Dates'], $featureData['Durations']);
    }

    return array_values($featureDurationsByDay);
}

function calculateUserMachineDurations()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM(
            SELECT UserMachine, SEC_TO_TIME(SUM(TIME_TO_SEC(ABS(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    UserMachine, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM logansys
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine) AS T  
            ORDER BY `T`.`Duration` DESC LIMIT 5;
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calculateUserMachineDurationschoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM(
            SELECT UserMachine, SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    UserMachine, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM logansys
                WHERE Date >= ? AND Date <= ?
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine) AS T
            ORDER BY `T`.`Duration` DESC LIMIT 5;
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calculateUserMachineDurationsByDay()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $minDateQuery = "SELECT MIN(Date) FROM logansys";
    $maxDateQuery = "SELECT MAX(Date) FROM logansys";
    $minDateStmt = $pdo->query($minDateQuery);
    $maxDateStmt = $pdo->query($maxDateQuery);
    $minDate = $minDateStmt->fetchColumn();
    $maxDate = $maxDateStmt->fetchColumn();

    $sql = "SELECT DISTINCT * FROM (
            SELECT
            UserMachine,
            Date,
            SEC_TO_TIME(SUM(TIME_TO_SEC(ABS(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT
                    UserMachine,
                    Date,
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM logansys
                WHERE Date >= :minDate AND Date <= :maxDate
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine, Date) AS T;
        ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":minDate", $minDate);
    $stmt->bindParam(":maxDate", $maxDate);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // list of dates within the range
    $dateRange = [];
    $currentDate = new DateTime($minDate);
    $endDateObj = new DateTime($maxDate);

    while ($currentDate <= $endDateObj) {
        $dateRange[] = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 day');
    }

    $UserMachineDurationsByDay = [];

    // Filling missing entries with NULL values
    foreach ($data as $row) {
        $UserMachine = $row['UserMachine'];
        $date = $row['Date'];
        $duration = $row['Duration'];

        if (!isset($UserMachineDurationsByDay[$UserMachine])) {
            $UserMachineDurationsByDay[$UserMachine] = [
                'UserMachine' => $UserMachine,
                'Dates' => [],
                'Durations' => []
            ];
        }

        $UserMachineDurationsByDay[$UserMachine]['Dates'][] = $date;
        $UserMachineDurationsByDay[$UserMachine]['Durations'][] = $duration;
    }
    foreach ($UserMachineDurationsByDay as &$UserMachineData) {
        foreach ($dateRange as $date) {
            if (!in_array($date, $UserMachineData['Dates'])) {
                $UserMachineData['Dates'][] = $date;
                $UserMachineData['Durations'][] = null; // NULL value for missing date
            }
        }
        // Replace NULL durations with "00:00:00"
        foreach ($UserMachineData['Durations'] as &$duration) {
            if ($duration === null) {
                $duration = "00:00:00";
            }
        }
        array_multisort($UserMachineData['Dates'], $UserMachineData['Durations']);
    }

    return array_values($UserMachineDurationsByDay);
}

function calculateUserMachineDurationsByDaychoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM(
            SELECT
            UserMachine,
            Date,
            SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT
                    UserMachine,
                    Date,
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM logansys
                WHERE Date >= ? AND Date <= ?
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine, Date) AS T;
        ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // list of dates within the range
    $dateRange = [];
    $currentDate = new DateTime($startDate);
    $endDateObj = new DateTime($endDate);

    while ($currentDate <= $endDateObj) {
        $dateRange[] = $currentDate->format('Y-m-d');
        $currentDate->modify('+1 day');
    }

    $UserMachineDurationsByDay = [];

    // Filling missing entries with NULL values
    foreach ($data as $row) {
        $UserMachine = $row['UserMachine'];
        $date = $row['Date'];
        $duration = $row['Duration'];

        if (!isset($UserMachineDurationsByDay[$UserMachine])) {
            $UserMachineDurationsByDay[$UserMachine] = [
                'UserMachine' => $UserMachine,
                'Dates' => [],
                'Durations' => []
            ];
        }

        $UserMachineDurationsByDay[$UserMachine]['Dates'][] = $date;
        $UserMachineDurationsByDay[$UserMachine]['Durations'][] = $duration;
    }
    foreach ($UserMachineDurationsByDay as &$UserMachineData) {
        foreach ($dateRange as $date) {
            if (!in_array($date, $UserMachineData['Dates'])) {
                $UserMachineData['Dates'][] = $date;
                $UserMachineData['Durations'][] = null; // NULL value for missing date
            }
        }
        // Replace NULL durations with "00:00:00"
        foreach ($UserMachineData['Durations'] as &$duration) {
            if ($duration === null) {
                $duration = "00:00:00";
            }
        }
        array_multisort($UserMachineData['Dates'], $UserMachineData['Durations']);
    }

    return array_values($UserMachineDurationsByDay);
}

function denial()
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT * FROM logansys WHERE Status = 'DENIED';";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function denialchoice($startDate, $endDate)
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT * FROM logansys WHERE Status = 'DENIED' AND Date >= ? AND Date <= ?;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function denialcount()
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM logansys WHERE Status = 'DENIED') AS T GROUP BY Date;";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function denialcountchoice($startDate, $endDate)
{
    // Establish a database connection (replace with your database details)
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM logansys WHERE Status = 'DENIED' AND Date >= ? AND Date <= ?) AS T GROUP BY Date; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ftlic()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT Date, Feature, COUNT(Feature) AS COUNTLIC FROM (SELECT DISTINCT * FROM logansys) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ftlicchoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT Date, Feature, COUNT(Feature) AS COUNTLIC FROM (SELECT DISTINCT * FROM logansys WHERE Date >= ? AND Date <= ?) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function userlic()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT Date, SUBSTRING_INDEX(UserMachine, '@', 1) AS U, COUNT(Feature) AS `CNTLIC` FROM (SELECT DISTINCT * FROM logansys) AS `T` WHERE Status='OUT' GROUP BY Date, SUBSTRING_INDEX(UserMachine, '@', 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function userlicchoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT Date, SUBSTRING_INDEX(UserMachine, '@', 1) AS U, COUNT(Feature) AS `CNTLIC` FROM (SELECT DISTINCT * FROM logansys WHERE Date >= ? AND Date <= ?) AS `T` WHERE Status='OUT' GROUP BY Date, SUBSTRING_INDEX(UserMachine, '@', 1)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function calls()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT'; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function callschoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT' AND Date >= ? AND Date <= ?; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function utilftlic()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DATE(timeofmon) AS Date, feature, (used / total)*100 AS `AVGLIC` FROM testtable 
    WHERE feature IN (
    'a_spaceclaim_dirmod' 
    ,'acfdsol3'
    ,'anshpc_pack'
    ,'agppi' 
    ,'acfd_preppost'
    ,'advanced_meshing'
    ,'cfd_preppost' 
    ,'cfd_base'
    ,'preppost'
    ,'meba'
    ,'acdi_adprepost'
    ,'cfd_solve_level2'
    ,'cfd_solve_level1'
    ,'acfd_solver' 
    ,'electronics_desktop'
    ,'electronics3d_gui'
    ,'simplorer_gui'
    ,'fluent_meshing'
    ,'cfd_solve_level3'
    ,'disco_level1'
    ,'rdpara'
    ,'m3dfs_qs_solve'
    ,'maxwell_desktop'
    ,'hfss_solve'
    ,'electronics2d_gui'
    ,'emit_legacy_gui' 
    ,'m2dfs_qs_solve')
    GROUP BY DATE(timeofmon), feature;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function utilftlicchoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DATE(timeofmon) AS Date, feature, (used / total)*100 AS `AVGLIC` FROM testtable 
    WHERE feature IN (
'a_spaceclaim_dirmod' 
,'acfdsol3'
,'anshpc_pack'
,'agppi' 
,'acfd_preppost'
,'advanced_meshing'
,'cfd_preppost' 
,'cfd_base'
,'preppost'
,'meba'
,'acdi_adprepost'
,'cfd_solve_level2'
,'cfd_solve_level1'
,'acfd_solver' 
,'electronics_desktop'
,'electronics3d_gui'
,'simplorer_gui'
,'fluent_meshing'
,'cfd_solve_level3'
,'disco_level1'
,'rdpara'
,'m3dfs_qs_solve'
,'maxwell_desktop'
,'hfss_solve'
,'electronics2d_gui'
,'emit_legacy_gui' 
,'m2dfs_qs_solve')
AND DATE(timeofmon) >= ? AND DATE(timeofmon) <= ?
GROUP BY DATE(timeofmon), feature;
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function baseusage()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT'; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function baseusagechoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT' AND Date >= ? AND Date <= ?; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function usage()
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT'; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function usagechoice($startDate, $endDate)
{
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    $sql = "SELECT DISTINCT * FROM logansys WHERE Status='OUT' AND Date >= ? AND Date <= ?; ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$startDate, $endDate]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
