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
            $info = $this->model->info();
            $gwscpu = $this->model->gwscpuchoice($startDate, $endDate);
            $usermem = $this->model->usermemchoice($startDate, $endDate);
            $gwsmem = $this->model->gwsmemchoice($startDate, $endDate);
            $usercpu = $this->model->usercpuchoice($startDate, $endDate);
            $gws = $this->model->gwsperfchoice($startDate, $endDate);
            $user = $this->model->userperfchoice($startDate, $endDate);
            //$workstation = $this->model->workstation();
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
                //'workstation' => $workstation
            ]);
            // $featureDurations = $this->model->calculateFeatureDurationschoice($start_date, $end_date);
            // $featureDurationsByDay = $this->model->calculateFeatureDurationsByDaychoice($start_date, $end_date);
            // $denial = $this->model->denialchoice($start_date, $end_date);
            // $denialcount = $this->model->denialcountchoice($start_date, $end_date);
            // $lic = $this->model->licchoice($start_date, $end_date);
            // $this->view->displayData([
            //     'denial' => $denial,
            //     'denialcount' => $denialcount,
            //     'lic' => $lic,
            //     'featureDurationsByDay' => $featureDurationsByDay,
            //     'featureDurations' => $featureDurations,
            // ]);
        } else {
            $dates = $this->model->dates();
            $info = $this->model->info();
            $startDate = $dates['minDate'];
            $endDate = $dates['maxDate'];
            $gwscpu = $this->model->gwscpu();
            $usermem = $this->model->usermem();
            $gwsmem = $this->model->gwsmem();
            $usercpu = $this->model->usercpu();
            $gws = $this->model->gwsperf();
            $user = $this->model->userperf();
            //$workstation = $this->model->workstation();
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
                //'workstation' => $workstation
            ]);
            // $featureDurations = $this->model->calculateFeatureDurations();
            // $featureDurationsByDay = $this->model->calculateFeatureDurationsByDay();
            // $denial = $this->model->denial();
            // $denialcount = $this->model->denialcount();
            // $lic = $this->model->lic();
            // $this->view->displayData([
            //     'denial' => $denial,
            //     'denialcount' => $denialcount,
            //     'lic' => $lic,
            //     'featureDurationsByDay' => $featureDurationsByDay,
            //     'featureDurations' => $featureDurations,
            // ]);
        }
    }
}

$controller = new LogController();
$controller->handleRequest();
