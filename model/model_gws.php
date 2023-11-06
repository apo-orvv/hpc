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

    public function dates()
    {
        $minDateQuery = "SELECT MIN(DATE(Timemon)) FROM `gwsusage` WHERE Timemon != '0000-00-00 00:00:00'";
        $maxDateQuery = "SELECT MAX(DATE(Timemon)) FROM `gwsusage`";
        $minDateStmt = $this->pdo->query($minDateQuery);
        $maxDateStmt = $this->pdo->query($maxDateQuery);
        $minDate = $minDateStmt->fetchColumn();
        $maxDate = $maxDateStmt->fetchColumn();
        return [
            'minDate' => $minDate,
            'maxDate' => $maxDate,
        ];
    }

    public function info($hrdiff)
    {
        $sql = "SELECT loggedinuser, gwsname, ROUND((AVG(CDrive))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T1, ROUND((AVG(MemLoad))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T2, ROUND((AVG(CPULoad))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T3, ROUND((AVG((CPULoad+MemLoad)/2))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS perf, TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)) AS D FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function infochoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT loggedinuser, gwsname, ROUND((AVG(CDrive))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T1, ROUND((AVG(MemLoad))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T2, ROUND((AVG(CPULoad))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS T3, ROUND((AVG((CPULoad+MemLoad)/2))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff,2) AS perf, TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)) AS D FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwscpu($hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG(CPULoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwscpuchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG(CPULoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsmem($hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG(MemLoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsmemchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG(MemLoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsperf($hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG((CPULoad+MemLoad)/2)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS perf FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsperfchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT GWSNAME, (ROUND(AVG((CPULoad+MemLoad)/2)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS perf FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usermem($hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG(MemLoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usermemchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG(MemLoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usercpu($hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG(CPULoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usercpuchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG(CPULoad)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS T FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userperf($hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG((CPULoad+MemLoad)/2)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userperfchoice($startDate, $endDate, $hrdiff)
    {
        $sql = "SELECT loggedinuser, (ROUND(AVG((CPULoad+MemLoad)/2)))*(TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)))/$hrdiff AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function peakinfo()
    {
        $sql = "SELECT loggedinuser, gwsname, ROUND(MAX(CDrive)), ROUND(MAX(MemLoad)), ROUND(MAX(CPULoad)), ROUND(MAX((CPULoad+MemLoad)/2)) AS perf, TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)) AS D FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakinfochoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, gwsname, ROUND(MAX(CDrive)), ROUND(MAX(MemLoad)), ROUND(MAX(CPULoad)), ROUND(MAX((CPULoad+MemLoad)/2)) AS perf, TIMESTAMPDIFF(HOUR, MIN(Timemon), MAX(Timemon)) AS D FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwscpu()
    {
        $sql = "SELECT GWSNAME, ROUND(MAX(CPULoad)) FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwscpuchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, ROUND(MAX(CPULoad)) FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwsmem()
    {
        $sql = "SELECT GWSNAME, ROUND(MAX(MemLoad)) FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwsmemchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, ROUND(MAX(MemLoad)) FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwsperf()
    {
        $sql = "SELECT GWSNAME, ROUND(MAX((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE Timemon!='0000-00-00 00:00:00' GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakgwsperfchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, ROUND(MAX((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakusermem()
    {
        $sql = "SELECT loggedinuser, ROUND(MAX(MemLoad)) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakusermemchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, ROUND(MAX(MemLoad)) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakusercpu()
    {
        $sql = "SELECT loggedinuser, ROUND(MAX(CPULoad)) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakusercpuchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, ROUND(MAX(CPULoad)) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakuserperf()
    {
        $sql = "SELECT loggedinuser, ROUND(MAX((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND Timemon!='0000-00-00 00:00:00' GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function peakuserperfchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, ROUND(MAX((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
