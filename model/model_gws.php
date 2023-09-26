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
        $minDateQuery = "SELECT MIN(DATE(Timemon)) FROM `gwsusage`";
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

    public function info()
    {
        $sql = "SELECT loggedinuser, gwsname, AVG(CDrive), AVG(MemLoad), AVG(CPULoad), ROUND(AVG((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil', 'Admin') GROUP BY loggedinuser;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwscpu()
    {
        $sql = "SELECT GWSNAME, AVG(CPULoad) FROM `gwsusage` GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwscpuchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, AVG(CPULoad) FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsmem()
    {
        $sql = "SELECT GWSNAME, AVG(MemLoad) FROM `gwsusage` GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsmemchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, AVG(MemLoad) FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsperf()
    {
        $sql = "SELECT GWSNAME, ROUND(AVG((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function gwsperfchoice($startDate, $endDate)
    {
        $sql = "SELECT GWSNAME, ROUND(AVG((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY gwsname; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usermem()
    {
        $sql = "SELECT loggedinuser, AVG(MemLoad) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usermemchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, AVG(MemLoad) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usercpu()
    {
        $sql = "SELECT loggedinuser, AVG(CPULoad) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function usercpuchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, AVG(CPULoad) FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userperf()
    {
        $sql = "SELECT loggedinuser, ROUND(AVG((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function userperfchoice($startDate, $endDate)
    {
        $sql = "SELECT loggedinuser, ROUND(AVG((CPULoad+MemLoad)/2)) AS perf FROM `gwsusage` WHERE loggedinuser NOT IN ('0%', '99.5%', '%', '1.5%', '3.5%', '95.5%', '7.5%', '26.5%', '22%', '1%', 'Nil') AND DATE(Timemon) >= ? AND DATE(Timemon) <= ? GROUP BY loggedinuser; ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$startDate, $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
