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

            $featureDurations = $this->model->calculateFeatureDurationschoice($start_date, $end_date);
            $featureDurationsByDay = $this->model->calculateFeatureDurationsByDaychoice($start_date, $end_date);
            $denial = $this->model->denialchoice($start_date, $end_date);
            $denialcount = $this->model->denialcountchoice($start_date, $end_date);
            $lic = $this->model->licchoice($start_date, $end_date);
            $this->view->displayData([
                'startDate' => $start_date,
                'endDate' => $end_date,
                'denial' => $denial,
                'denialcount' => $denialcount,
                'lic' => $lic,
                'featureDurationsByDay' => $featureDurationsByDay,
                'featureDurations' => $featureDurations,
            ]);
        } else {
            $dates = $this->model->dates();
            $startDate = $dates['minDate'];
            $endDate = $dates['maxDate'];
            $featureDurations = $this->model->calculateFeatureDurations();
            $featureDurationsByDay = $this->model->calculateFeatureDurationsByDay();
            $denial = $this->model->denial();
            $denialcount = $this->model->denialcount();
            $lic = $this->model->lic();
            $this->view->displayData([
                'startDate' => $startDate,
                'endDate' => $endDate,
                'denial' => $denial,
                'denialcount' => $denialcount,
                'lic' => $lic,
                'featureDurationsByDay' => $featureDurationsByDay,
                'featureDurations' => $featureDurations,
            ]);
        }
    }
}

$controller = new LogController();
$controller->handleRequest();
