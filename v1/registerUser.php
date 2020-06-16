<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama = $_POST['namalengkap'];

        if($username != "" AND $password != "" AND $nama != ""){
            
            $db = new DbOperations();

            //eksekusi function createUser() 
            //dan simpan return value dari function createUser() ke dalam variable result
            $result = $db->createUser($_POST['namalengkap'], $_POST['username'], $_POST['password']);
            
            if($result == 1){
                $response['error'] = false;
                $response['message'] = $_POST['namalengkap']." Berhasil Terdaftar, Silahkan Login Untuk Melanjutkan";
            }else if($result == 2){
                $response['error'] = true;
                $response['message'] = "Terjadi Kesalahan, Silahkan COba Lagi";
            }else if($result == 0){
                $response['error'] = true;
                $response['message'] = "Gagal Mendaftarkan User, Username sudah terdaftar";
            }

        }else{
            $response['error'] = true;
            $response['message'] = "Required Field Can't Be Empty";
        }

    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);
?>