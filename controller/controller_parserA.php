<?php
require_once("model/model_parserA.php");
require_once("view/view_parserA.php");

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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            if (isset($_FILES['log_files']) && !empty($_FILES['log_files']['name'])) {
                $fileMode = $_POST['file_mode'];
                $files = $_FILES['log_files'];
                $numFiles = count($files['name']);
                $successCount = 0;
                
                for ($i = 0; $i < $numFiles; $i++) {
                    if ($files['error'][$i] === UPLOAD_ERR_OK) {
                        $logContent = file_get_contents($files['tmp_name'][$i]);
                        $processedData = $this->model->processLog($logContent, $fileMode);

                        // Generate CSV file and save it
                        $csvFilename = 'abaqus_info_' . $i . '.csv';
                        $csvContent = $this->generateCSVContent($processedData);
                        file_put_contents($csvFilename, $csvContent);

                        $successCount++;
                    }
                }
                
                if ($successCount > 0) {
                    $this->view->success();
                    echo '<center><p>' . $successCount . ' file(s) successfully processed and saved.</p></center>';
                }
            }
        } else {
            $this->view->showForm();
        }
    }

    private function generateCSVContent($data)
    {
        $csvContent = "Date,Time,Software,Status,Feature,User Machine,Licenses\n";
        foreach ($data as $entry) {
            $csvContent .= implode(',', $entry) . "\n";
        }
        return $csvContent;
    }
}

$controller = new LogController();
$controller->handleRequest();
?>
