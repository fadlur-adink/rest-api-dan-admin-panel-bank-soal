<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $db = new DbOperations();

        //eksekusi function createUser() 
        //dan simpan return value dari function createUser() ke dalam variable result
        $result = $db->updateKelasSiswa($_POST['kelas'], $_POST['username']);
        
        if($result == 1){
            $response['error'] = false;
            $response['message'] = "Berhasil Mengupdate Kelas Siswa";        
        }else if($result == 0){
            $response['error'] = true;
            $response['message'] = "Gagal Mengupdate Kelas Siswa";
        }

    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);
?>