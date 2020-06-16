<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $db = new DbOperations();

        //eksekusi function createUser() 
        //dan simpan return value dari function createUser() ke dalam variable result
        $result = $db->updateStatusMapel($_POST['mapel'], $_POST['username']);
        
        if($result == 1){
            $response['error'] = false;
            $response['message'] = "Berhasil Berhasil Merubah Status Mapel";
        }else if($result == 0){
            $response['error'] = true;
            $response['message'] = "Gagal Merubah Status Mapel";
        }

    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);
?>