<?php
class LogModel
{
    private $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=test;charset=utf8';
        $username = 'root';
        $password = '';

        $this->pdo = new PDO($dsn, $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function createTable()
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `licenselogC` (
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
            DROP TABLE IF EXISTS `licenselogC`;
            CREATE TABLE IF NOT EXISTS `licenselogC` (
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

        $lines = explode("\r\n", $logContent);
        if ($fileMode === "append") {
            $this->createTable();
        } elseif ($fileMode === "overwrite") {
            $this->createTabledrop();
        }
        foreach ($lines as $line) {
            if (preg_match('/(\d{2}:\d{2}:\d{1,2}) \(([^)]+)\) ([A-Z]+): "(.*?)" (\S+)/', $line, $matches)) {
                $timestampStr = $matches[1];
                $software = $matches[2];
                $status = $matches[3];
                $feature = $matches[4];
                $userMachine = $matches[5];
                $licensesCount = 1;
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
                $this->insertDataToDatabase($currentDate, $timestamp->format('H:i:s'), $software, $status, $feature, $userMachine, $licensesCount);
            }
        }

        return $data;
    }

    private function insertDataToDatabase($date, $time, $software, $status, $feature, $userMachine, $licenses)
    {
        $sql = "INSERT IGNORE INTO licenselogC (Date, Time, Software, Status, Feature, UserMachine, Licenses) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$date, $time, $software, $status, $feature, $userMachine, $licenses]);
    }

    public function dates()
    {
        $minDateQuery = "SELECT MIN(Date) FROM licenselogC";
        $maxDateQuery = "SELECT MAX(Date) FROM licenselogC";
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
        $sql = "
            SELECT Feature, SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    Feature, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogC
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateFeatureDurationschoice($startDate, $endDate)
    {
        $sql = "
            SELECT Feature, SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    Feature, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogC
                WHERE Date >= ? AND Date <= ?
                GROUP BY Feature, Date
            ) AS FeatureStatus
            GROUP BY Feature
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateFeatureDurationsByDay()
    {
        $minDateQuery = "SELECT MIN(Date) FROM licenselogC";
        $maxDateQuery = "SELECT MAX(Date) FROM licenselogC";
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
                FROM licenselogC
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

        // Filling of missing entries with NULL values
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
            array_multisort($featureData['Dates'], $featureData['Durations']);
        }

        return array_values($featureDurationsByDay);
    }

    public function calculateFeatureDurationsByDaychoice($startDate, $endDate)
    {
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
            FROM licenselogC
            WHERE Date >= ? AND Date <= ?
            GROUP BY Feature, Date
        ) AS FeatureStatus
        GROUP BY Feature, Date;
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

        // Filling of missing entries with NULL values
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
            array_multisort($featureData['Dates'], $featureData['Durations']);
        }

        return array_values($featureDurationsByDay);
    }

    public function calculateUserMachineDurations()
    {
        $sql = "SELECT DISTINCT * FROM(
            SELECT UserMachine, SEC_TO_TIME(SUM(TIME_TO_SEC(ABS(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    UserMachine, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogC
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine) AS T  
            ORDER BY `T`.`Duration` DESC LIMIT 5;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateUserMachineDurationschoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM(
            SELECT UserMachine, SEC_TO_TIME(ABS(SUM(TIME_TO_SEC(TIMEDIFF(IN_TIME, OUT_TIME))))) AS Duration
            FROM (
                SELECT 
                    UserMachine, 
                    MAX(CASE WHEN Status = 'IN' THEN Time END) AS IN_TIME,
                    MIN(CASE WHEN Status = 'OUT' THEN Time END) AS OUT_TIME
                FROM licenselogC
                WHERE Date >= ? AND Date <= ?
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine) AS T
            ORDER BY `T`.`Duration` DESC LIMIT 5;
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calculateUserMachineDurationsByDay()
    {
        $minDateQuery = "SELECT MIN(Date) FROM licenselogC";
        $maxDateQuery = "SELECT MAX(Date) FROM licenselogC";
        $minDateStmt = $this->pdo->query($minDateQuery);
        $maxDateStmt = $this->pdo->query($maxDateQuery);
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
                FROM licenselogC
                WHERE Date >= :minDate AND Date <= :maxDate
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine, Date) AS T;
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

    public function calculateUserMachineDurationsByDaychoice($startDate, $endDate)
    {
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
                FROM licenselogC
                WHERE Date >= ? AND Date <= ?
                GROUP BY UserMachine, Date
            ) AS UserMachineStatus
            GROUP BY UserMachine, Date) AS T;
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

    public function denial()
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status = 'DENIED';";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialchoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status = 'DENIED' AND Date >= ? AND Date <= ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialcount()
    {
        $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM licenselogC WHERE Status = 'DENIED' AND Feature='COMSOL') AS T GROUP BY Date;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function denialcountchoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT COUNT(Status), Date FROM (SELECT DISTINCT * FROM licenselogC WHERE Status = 'DENIED' AND Feature='COMSOL' AND Date >= ? AND Date <= ?) AS T GROUP BY Date; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ftlic()
    {
        $sql = "SELECT Date, Feature, COUNT(Feature) AS COUNTLIC FROM (SELECT DISTINCT * FROM licenselogC) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ftlicchoice($startDate, $endDate)
    {
        $sql = "SELECT Date, Feature, COUNT(Feature) AS COUNTLIC FROM (SELECT DISTINCT * FROM licenselogC WHERE Date >= ? AND Date <= ?) AS T WHERE Status='OUT' GROUP BY Date,Feature; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userlic()
    {
        $sql = "SELECT Date, SUBSTRING_INDEX(UserMachine, '@', 1) AS U, COUNT(Feature) AS `CNTLIC` FROM (SELECT DISTINCT * FROM licenselogC) AS `T` WHERE Status='OUT' GROUP BY Date, SUBSTRING_INDEX(UserMachine, '@', 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userlicchoice($startDate, $endDate)
    {
        $sql = "SELECT Date, SUBSTRING_INDEX(UserMachine, '@', 1) AS U, COUNT(Feature) AS `CNTLIC` FROM (SELECT DISTINCT * FROM licenselogC WHERE Date >= ? AND Date <= ?) AS `T` WHERE Status='OUT' GROUP BY Date, SUBSTRING_INDEX(UserMachine, '@', 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function calls()
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT'; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function callschoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT' AND Date >= ? AND Date <= ?; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function utilftlic()
    {
        $sql = "SELECT DATE(timeofmon) AS Date, feature, (used / total)*100 AS `AVGLIC` FROM softwarelicenseshistory 
        WHERE feature IN ('ACDC', 'CADIMPORT', 'CADIMPORTUSER', 'cfd', 'COMSOL', 'COMSOLGUI', 'COMSOLUSER', 'CORROSION', 'PARTICLETRACING', 'SERIAL') 
        GROUP BY DATE(timeofmon), feature";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function utilftlicchoice($startDate, $endDate)
    {
        $sql = "SELECT DATE(timeofmon) AS Date, feature, (used / total)*100 AS `AVGLIC` FROM softwarelicenseshistory 
        WHERE feature IN ('ACDC', 'CADIMPORT', 'CADIMPORTUSER', 'cfd', 'COMSOL', 'COMSOLGUI', 'COMSOLUSER', 'CORROSION', 'PARTICLETRACING', 'SERIAL') 
        AND DATE(timeofmon) >= ? AND DATE(timeofmon) <= ?
        GROUP BY DATE(timeofmon), feature";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function baseusage()
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT' AND Feature='COMSOL'; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function baseusagechoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT' AND Feature='COMSOL' AND Date >= ? AND Date <= ?; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usage()
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT'; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usagechoice($startDate, $endDate)
    {
        $sql = "SELECT DISTINCT * FROM licenselogC WHERE Status='OUT' AND Date >= ? AND Date <= ?; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
