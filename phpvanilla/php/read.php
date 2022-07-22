<?php

    require_once 'model.php';

    $model = new Model();

    $response = $model->fetchAllRecords();
    echo json_encode(['response' => $response]); exit();
    
?>