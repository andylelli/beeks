<?php

include "model.php";

$model = new Model();

$data = $model->fetchAll();

$response = ["data" => $data];

echo json_encode($response);

?>