<?php

    require_once '../include/DbOperations.php';
    $response = array();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){    

        $db = new DbOperations();

        $newscore = $_POST['score'];

        $result = $db->checkBestScore($_POST['mapel'], $_POST['kelas']);
        $bestscore = $result['score'];

        if($db->isScoreExist($_POST['mapel'], $_POST['kelas'])){
            if($newscore > $bestscore){
                $result1 = $db->updateBestScore($_POST['mapel'], $_POST['kelas'], $newscore);

                if($result1 == 1){
                    $response['error'] = false;
                    $response['message'] = "Berhasil Input High Score Baru";
                }else if($result1 == 0){
                    $response['error'] = true;
                    $response['message'] = "Gagal Input High Score Baru";
                }
            }else{
                $response['error'] = false;
                $response['message'] = "Tidak Input High Score Baru Karena Newscore Lebih Kecil Dari High Score Lama";
            }
        }else{
            $result1 = $db->insertBestScore($_POST['mapel'], $_POST['kelas'], $newscore);

            if($result1 == 1){
                $response['error'] = false;
                $response['message'] = "Berhasil Input High Score Baru";
            }else if($result1 == 0){
                $response['error'] = true;
                $response['message'] = "Gagal Input High Score Baru";
            }
        }

    }else{
        $response ['error'] = true;
        $response ['message'] = "Invalid Request";
    }

    echo json_encode($response);
?>