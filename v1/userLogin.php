<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['username']) AND isset($_POST['password'])){

            $db = new DbOperations();

            if($temp = $db->userLogin($_POST['username'], $_POST['password'])){
                $data['iduser'] = $temp['id_user'];
                $user = $db->getUserDetail($data['iduser']);
                $response['error'] = false;
                $response['id'] = $user['id_siswa'];
                $response['username'] = $user['username'];
                $response['namalengkap'] = $user['nama'];
                $response['kelas'] = $user['kelas'];
                $response['bindonesia'] = $user['b_indonesia'];
                $response['matematika'] = $user['matematika'];
                $response['pkn'] = $user['pkn'];
                $response['ipa'] = $user['ipa'];
                $response['ips'] = $user['ips'];
                $response['sbdp'] = $user['sbdp'];
                $response['pjok'] = $user['pjok'];
            }else{
                $response['error'] = true;
                $response['message'] = "Username atau Password Salah";
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