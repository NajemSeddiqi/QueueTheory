<?php

class prodController {

    private $prodModel;

    public function __construct() {
        $this->prodModel = new prodModel();
    }

    public function getCalcs() {
        return json_encode($this->prodModel->getCalcs());
    }

    public function clearTable(){
        return json_encode($this->prodModel->clearTable());
    }

    public function insertValues()
    {
        $values = new stdClass();
        $values->ARRIVAL_RATE = filter_var($_POST['ARRIVAL_RATE'],FILTER_SANITIZE_STRING);
        $values->SERVICE_RATE = filter_var($_POST['SERVICE_RATE'],FILTER_SANITIZE_STRING);
        $values->LQ = filter_var($_POST['LQ'],FILTER_SANITIZE_STRING);
        $values->LS = filter_var($_POST['LS'],FILTER_SANITIZE_STRING);
        $values->WS = filter_var($_POST['WS']);
        $values->WQ = filter_var($_POST['WQ']);
        $values->PBUSY = filter_var($_POST['PBUSY']);
        $values->LE = filter_var($_POST['LE']);
        return json_encode($this->prodModel->insertValues($values));
    }

    public function getData() {
        $csvData = file_get_contents("./chartData.csv");
        $lines = explode(PHP_EOL, $csvData);
        $lines = array_slice($lines, 0, count($lines) - 1);
        $data = array();
        foreach ($lines as $line) {
            $line = str_getcsv($line);
            $data[] = $line;
        }
        return $data;
    }
    
    public function getCsvData() {
        $data = $this->getData();
        echo json_encode($data);
    }

    public function insertData() {
        $csvData = $this->getData();
        $file = fopen("./chartData.csv", "w");
        echo $csvData[0];
    
        $csvData[] = [$_POST["ARRIVAL_RATE"],
            $_POST["SERVICE_RATE"],
            $_POST["LQ"],
            $_POST["LS"],
            $_POST["WS"],
            $_POST["WQ"],
            $_POST["PBUSY"],
            $_POST["LE"]];
    
        foreach ($csvData as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
    }

}

?>
