<?php

function dates()
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
