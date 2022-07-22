<?php

    require_once 'model.php';

    $model = new Model();

    
    $id = $_GET['id'];


    $response = $model->deleteRecords($id);
    echo json_encode(['response' => $response]); exit();
    
?>