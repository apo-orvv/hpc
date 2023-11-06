<?php
require_once("model/model_parserC.php");
require_once("view/viewlpC.php");

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
            $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : null;
            $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : null;

            $UserMachineDurations = $this->model->calculateUserMachineDurationschoice($start_date, $end_date);
            $UserMachineDurationsByDay = $this->model->calculateUserMachineDurationsByDaychoice($start_date, $end_date);
            $featureDurations = $this->model->calculateFeatureDurationschoice($start_date, $end_date);
            $featureDurationsByDay = $this->model->calculateFeatureDurationsByDaychoice($start_date, $end_date);
            $denial = $this->model->denialchoice($start_date, $end_date);
            $denialcount = $this->model->denialcountchoice($start_date, $end_date);
            $ftlic = $this->model->ftlicchoice($start_date, $end_date);
            $utilftlic = $this->model->utilftlicchoice($start_date, $end_date);
            $userlic = $this->model->userlicchoice($start_date, $end_date);
            $calls = $this->model->callschoice($start_date, $end_date);
            $usage = $this->model->usagechoice($start_date, $end_date);
            $baseusage = $this->model->baseusagechoice($start_date, $end_date);
            $this->view->displayData([
                'startDate' => $start_date,
                'endDate' => $end_date,
                'denial' => $denial,
                'denialcount' => $denialcount,
                'ftlic' => $ftlic,
                'utilftlic' => $utilftlic,
                'userlic' => $userlic,
                'usage' => $usage,
                'baseusage' => $baseusage,
                'calls' => $calls,
                'featureDurationsByDay' => $featureDurationsByDay,
                'featureDurations' => $featureDurations,
                'UserMachineDurations' => $UserMachineDurations,
                'UserMachineDurationsByDay' => $UserMachineDurationsByDay,
            ]);
        } else {
            $dates = $this->model->dates();
            $startDate = $dates['minDate'];
            $endDate = $dates['maxDate'];
            $UserMachineDurations = $this->model->calculateUserMachineDurations();
            $UserMachineDurationsByDay = $this->model->calculateUserMachineDurationsByDay();
            $featureDurations = $this->model->calculateFeatureDurations();
            $featureDurationsByDay = $this->model->calculateFeatureDurationsByDay();
            $denial = $this->model->denial();
            $denialcount = $this->model->denialcount();
            $ftlic = $this->model->ftlic();
            $utilftlic = $this->model->utilftlic();
            $userlic = $this->model->userlic();
            $calls = $this->model->calls();
            $usage = $this->model->usage();
            $baseusage = $this->model->baseusage();
            $this->view->displayData([
                'startDate' => $startDate,
                'endDate' => $endDate,
                'denial' => $denial,
                'denialcount' => $denialcount,
                'ftlic' => $ftlic,
                'utilftlic' => $utilftlic,
                'userlic' => $userlic,
                'usage' => $usage,
                'baseusage' => $baseusage,
                'calls' => $calls,
                'featureDurationsByDay' => $featureDurationsByDay,
                'featureDurations' => $featureDurations,
                'UserMachineDurations' => $UserMachineDurations,
                'UserMachineDurationsByDay' => $UserMachineDurationsByDay,
            ]);
        }
    }
}

$controller = new LogController();
$controller->handleRequest();
