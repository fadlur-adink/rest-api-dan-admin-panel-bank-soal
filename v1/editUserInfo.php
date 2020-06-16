<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
        $db = new DbOperations();

        //eksekusi function createUser() 
        //dan simpan return value dari function createUser() ke dalam variable result
        $result = $db->editUserInfo($_POST['idsiswa'], $_POST['username'], $_POST['namalengkap'], $_POST['password']);
        
        if($result == 1){
            $response['error'] = false;
            $response['message'] = "Berhasil Berhasil Merubah Info Akun";
        }else if($result == 0){
            $response['error'] = true;
            $response['message'] = "Gagal Merubah Info Akun";
        }

    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);
?>