<?php

$search = $_GET['search'];

$json = json_decode(file_get_contents('params.json'));
$params = $json->params; 

$fieldArr = array();

foreach($params as $param) {
    if(property_exists($param, 'fieldname')) {
        $fieldname = $param->fieldname;
        $datatype = $param->datatype;
        if($datatype != 'image') {
            array_push($fieldArr, filter_var($fieldname, FILTER_SANITIZE_ADD_SLASHES));
        }
    }
}	

include "model.php";

$model = new Model();

$data = $model->searchAll($search, $fieldArr);

$response = ["data" => $data];

echo json_encode($response);



function writeToLog($log_entry){

    //$log_file = file_get_contents("/home/567470.cloudwaysapps.com/fammrmtndz/public_html/home/QR.txt");
    $log_file = file_get_contents("log.txt");

    $log = date("d/m/y H:i:s - ", time()) . $log_entry . "\r";
    $log_all = $log_file . $log . "\n";

    //$myFile = "/home/567470.cloudwaysapps.com/fammrmtndz/public_html/home/QR.txt";
    $myFile = "log.txt";

    $fh = fopen($myFile, 'w') or die("can't open file");
    fwrite($fh, $log_all);
    fclose($fh);
    $log_entry = '';
} 

?>