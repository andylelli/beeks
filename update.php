<?php

$json = json_decode(file_get_contents('params.json'));
$params = $json->params; 

$params = array_filter($params,function($obj) {
    return property_exists($obj, 'fieldname');
}); 

$fieldArr=array();
$valueArr=array();

foreach($_POST as $key => $value) {
    array_push($fieldArr, filter_var($key, FILTER_SANITIZE_ADD_SLASHES));
    array_push($valueArr, filter_var($value, FILTER_SANITIZE_ADD_SLASHES));
}

$arrLen = count($fieldArr);
$validation = true;

for ($x = 0; $x < $arrLen; $x++) {

    $fieldname = $fieldArr[$x];   
 
    $param = array_filter($params,function($obj) use($fieldname) {
        return $obj->fieldname == $fieldname;
    }); 

    foreach($param as $key) {
        $mandatory = $key->mandatory;
    }	

    if($mandatory == 'true') {

       if($valueArr[$x] == "") {
           $validation = false;           
       }
    }
}

if ($validation == true) {

    include "model.php";

    $model = new Model();

    if ($model->update($fieldArr, $valueArr)) {
        $data = ["result" => "success"];
    } else {
        $data = ["result" => "error"];
    }

    echo json_encode($data);
}

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