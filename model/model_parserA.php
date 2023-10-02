<?php
class LogModel
{
    private $pdo;

    public function __construct()
    {
        // Database Credentials
        $dsn = 'mysql:host=localhost;dbname=test;charset=utf8';
        $username = 'root';
        $password = '';
        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `licenselogA` (
              `Date` date DEFAULT NULL,
              `Time` time DEFAULT NULL,
              `Software` varchar(255) DEFAULT NULL,
              `Status` varchar(255) DEFAULT NULL,
              `Feature` varchar(255) DEFAULT NULL,
              `UserMachine` varchar(255) DEFAULT NULL,
              `Licenses` int DEFAULT NULL
            )
        ";
        $this->pdo->exec($sql);
    }

    private function createTabledrop()
    {
        $sql = "
            DROP TABLE IF EXISTS `licenselogA`;
            CREATE TABLE IF NOT EXISTS `licenselogA` (
              `Date` date DEFAULT NULL,
              `Time` time DEFAULT NULL,
              `Software` varchar(255) DEFAULT NULL,
              `Status` varchar(255) DEFAULT NULL,
              `Feature` varchar(255) DEFAULT NULL,
              `UserMachine` varchar(255) DEFAULT NULL,
              `Licenses` int DEFAULT NULL
            )
        ";
        $this->pdo->exec($sql);
    }

    public function processLog($logContent, $fileMode)
    {
        $data = [];
        $currentDate = null;
        $lines = explode("\n", $logContent);
        if($fileMode==="append"){
            $this->createTable();
        } elseif($fileMode==="overwrite"){
            $this->createTabledrop();
        }
        

        foreach ($lines as $line) {
            if (preg_match('/(\d{2}:\d{2}:\d{2}) \((.*?)\) (.*?)\: "(.*?)" (.*?) (\(\d+ licenses\))/', $line, $matches)) {
                $timestampStr = $matches[1];
                $software = $matches[2];
                $status = $matches[3];
                $feature = $matches[4];
                $userMachine = $matches[5];
                $licensesCount = (int)preg_replace('/[^\d]/', '', $matches[6]);
                $timestamp = DateTime::createFromFormat('H:i:s', $timestampStr);

                if ($currentDate !== null) {
                    $data[] = [
                        "Date" => $currentDate,
                        "Time" => $timestamp->format('H:i:s'),
                        "Software" => $software,
                        "Status" => $status,
                        "Feature" => $feature,
                        "User Machine" => $userMachine,
                        "Licenses" => $licensesCount
                    ];
                }
            } elseif (strpos($line, "TIMESTAMP") !== false) {
                $dateParts = explode(" ", $line);
                $currentDateStr = end($dateParts);
                $currentDate = DateTime::createFromFormat('m/d/Y', $currentDateStr)->format('Y-m-d');
            }

            if ($currentDate !== null) {
                // Insert data into the database
                $this->insertDataToDatabase($currentDate, $timestamp->format('H:i:s'), $software, $status, $feature, $userMachine, $licensesCount);
            }
        }

        return $data;
    }

    private function insertDataToDatabase($date, $time, $software, $status, $feature, $userMachine, $licenses)
    {
        $sql = "INSERT IGNORE INTO licenselogA (Date, Time, Software, Status, Feature, UserMachine, Licenses) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$date, $time, $software, $status, $feature, $userMachine, $licenses]);
    }

    public function dates()
    {
        $minDateQuery = "SELECT MIN(Date) FROM licenselogA";
        $maxDateQuery = "SELECT MAX(Date) FROM licenselogA";
        $minDateStmt = $this->pdo->query($minDateQuery);
        $maxDateStmt = $this->pdo->query($maxDateQuery);
        $minDate = $minDateStmt->fetchColumn();
        $maxDate = $maxDateStmt->fetchColumn();
        return [
            'minDate' => $minDate,
            'maxDate' => $maxDate,
        ];
    }
    
    public function calculateFeatureDurations()
    {
        $sql = "SELECT DISTINCT * FROM(
            SELECT Feature, SEC_TO_TIME(SUM(TIME_TO_SEC(ABS(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    Feature, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogA
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature) AS T
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateFeatureDurationschoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM(
            SELECT Feature, SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    Feature, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogA
                WHERE Date >= ? AND Date <= ?
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature) AS T
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateFeatureDurationsByDay()
    {
        $minDateQuery = "SELECT MIN(Date) FROM licenselogA";
        $maxDateQuery = "SELECT MAX(Date) FROM licenselogA";
        $minDateStmt = $this->pdo->query($minDateQuery);
        $maxDateStmt = $this->pdo->query($maxDateQuery);
        $minDate = $minDateStmt->fetchColumn();
        $maxDate = $maxDateStmt->fetchColumn();

        $sql = "SELECT DISTINCT * FROM (
            SELECT
            Feature,
            Date,
            SEC_TO_TIME(SUM(TIME_TO_SEC(ABS(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT
                    Feature,
                    Date,
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogA
                WHERE Date >= :minDate AND Date <= :maxDate
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature, Date) AS T;
        ";

        $stmt = $this->pdo->prepare($sql);
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

    public function calculateFeatureDurationsByDaychoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM(
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
                FROM licenselogA
                WHERE Date >= ? AND Date <= ?
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature, Date) AS T;
        ";
        $stmt = $this->pdo->prepare($sql);
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

    public function denial()
    {
        $sql = "SELECT DISTINCT * FROM licenselogA WHERE Status = 'DENIED';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialchoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM licenselogA WHERE Status = 'DENIED' AND Date >= ? AND Date <= ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialcount()
    {
        $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM licenselogA WHERE Status = 'DENIED' AND Feature='abaqus') AS T GROUP BY Date;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialcountchoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM licenselogA WHERE Status = 'DENIED' AND Feature='abaqus' AND Date >= ? AND Date <= ?) AS T GROUP BY Date; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function lic()
    {
        $sql = "SELECT Date, Feature, ROUND(AVG(Licenses)) AS AVGLIC FROM (SELECT DISTINCT * FROM licenselogA) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function licchoice($startDate, $endDate)
    {
        $sql = "SELECT Date, Feature, ROUND(AVG(Licenses)) AS AVGLIC FROM (SELECT DISTINCT * FROM licenselogA WHERE Date >= ? AND Date <= ?) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
