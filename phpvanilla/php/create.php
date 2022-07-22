<?php

    require_once 'model.php';

    $model = new Model();

    if (isset($_FILES['file'])) {
        if ( 0 < $_FILES['file']['error'] ) {
            $error = [
                'Error'=>$_FILES['file']['error']
            ];
            echo json_encode( $error ); exit();
        }
        else {
            $data = [
                'title'     => $_POST['title'],
                'filename'  => preg_replace('/\s+/', '_', $_FILES['file']['name'])
            ];
            $response = $model->insert($data);
            $path = $_SERVER['DOCUMENT_ROOT'] . '/uploaded_files/';
            
            move_uploaded_file($_FILES['file']['tmp_name'], $path . $data['filename']);
        }
        echo json_encode(['response' => $response]); exit();
    }


    // echo json_encode($_FILES['file']['name']); exit();
    // echo json_encode($data); exit();

    // $fileName = $_FILES['file_upload']['name'];

    // print_r($fileName);
    // exit;
    
    
?>