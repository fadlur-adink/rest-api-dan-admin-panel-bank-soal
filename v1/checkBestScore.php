<?php

    require_once '../include/DbOperations.php';
    $response = array();
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = new DbOperations();

        if($result = $db->checkBestScore($_POST['mapel'], $_POST['kelas'])){
            $response['error'] = false;
            $response['bestscore'] = $result['score'];
        }else{
            $response['error'] = false;
            $response['message'] = "Belum Ada Score Terbaik";
            $response['bestscore'] = 0;
        }
    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);  
?>