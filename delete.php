<?php

if (isset($_POST["id"])) {
    $id = $_POST["id"];

    include "model.php";

    $model = new Model();

    if ($model->delete($id)) {
        $data = ["result" => "success"];
    } else {
        $data = ["result" => "error"];
    }

    echo json_encode($data);
}

?>