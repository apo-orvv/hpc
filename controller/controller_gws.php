<?php
require_once("model/model_gws.php");
require_once("view/view_gws.php");

class LogController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new LogModel();
        $this->view = new LogView();
    }

    public function handleRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit2'])) {
            $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
            $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $hrdiff = (($interval->days)*24)+24;
            $infodiff = $this->model->infochoice($startDate, $endDate, $hrdiff);
            $gwscpudiff = $this->model->gwscpuchoice($startDate, $endDate, $hrdiff);
            $usermemdiff = $this->model->usermemchoice($startDate, $endDate, $hrdiff);
            $gwsmemdiff = $this->model->gwsmemchoice($startDate, $endDate, $hrdiff);
            $usercpudiff = $this->model->usercpuchoice($startDate, $endDate, $hrdiff);
            $gwsdiff = $this->model->gwsperfchoice($startDate, $endDate, $hrdiff);
            $userdiff = $this->model->userperfchoice($startDate, $endDate, $hrdiff);

            $info = $this->model->peakinfochoice($startDate, $endDate);
            $gwscpu = $this->model->peakgwscpuchoice($startDate, $endDate);
            $usermem = $this->model->peakusermemchoice($startDate, $endDate);
            $gwsmem = $this->model->peakgwsmemchoice($startDate, $endDate);
            $usercpu = $this->model->peakusercpuchoice($startDate, $endDate);
            $gws = $this->model->peakgwsperfchoice($startDate, $endDate);
            $user = $this->model->peakuserperfchoice($startDate, $endDate);
            $this->view->displayData([
                'info' => $info,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'gwscpu' => $gwscpu,
                'usermem' => $usermem,
                'gwsmem' => $gwsmem,
                'usercpu' => $usercpu,
                'gws' => $gws,
                'user' => $user,

                'infodiff' => $infodiff,
                'gwscpudiff' => $gwscpudiff,
                'usermemdiff' => $usermemdiff,
                'gwsmemdiff' => $gwsmemdiff,
                'usercpudiff' => $usercpudiff,
                'gwsdiff' => $gwsdiff,
                'userdiff' => $userdiff,
            ]);
        } else {
            $dates = $this->model->dates();
            $startDate = $dates['minDate'];
            $endDate = $dates['maxDate'];
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $hrdiff = (($interval->days)*24)+24;
            
            $infodiff = $this->model->info($hrdiff);
            $gwscpudiff = $this->model->gwscpu($hrdiff);
            $usermemdiff = $this->model->usermem($hrdiff);
            $gwsmemdiff = $this->model->gwsmem($hrdiff);
            $usercpudiff = $this->model->usercpu($hrdiff);
            $gwsdiff = $this->model->gwsperf($hrdiff);
            $userdiff = $this->model->userperf($hrdiff);

            $info = $this->model->peakinfo();
            $gwscpu = $this->model->peakgwscpu();
            $usermem = $this->model->peakusermem();
            $gwsmem = $this->model->peakgwsmem();
            $usercpu = $this->model->peakusercpu();
            $gws = $this->model->peakgwsperf();
            $user = $this->model->peakuserperf();
            $this->view->displayData([
                'info' => $info,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'gwscpu' => $gwscpu,
                'usermem' => $usermem,
                'gwsmem' => $gwsmem,
                'usercpu' => $usercpu,
                'gws' => $gws,
                'user' => $user,

                'infodiff' => $infodiff,
                'gwscpudiff' => $gwscpudiff,
                'usermemdiff' => $usermemdiff,
                'gwsmemdiff' => $gwsmemdiff,
                'usercpudiff' => $usercpudiff,
                'gwsdiff' => $gwsdiff,
                'userdiff' => $userdiff,
            ]);
        }
    }
}

$controller = new LogController();
$controller->handleRequest();
