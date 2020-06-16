<?php

    require_once '../include/DbOperations.php';
    $response = array();
        
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $db = new DbOperations();

        if($result = $db->getRowSoal($_POST['mapel'], $_POST['kelas'])){            
            $response['jumlahsoal'] = $result;

            if($result2 = $db->checkBestScore($_POST['mapel'], $_POST['kelas'])){
                $response['error'] = false;
                $response['bestscore'] = $result2['score'];
            }else{
                $response['error'] = false;
                $response['message'] = "Belum Ada Score Terbaik";
                $response['bestscore'] = 0;
            }

        }else{
            $response['error'] = true;
            $response['message'] = "Something Error";
            $response['jumlahsoal'] = 999;
            $response['bestscore'] = 999999;
        }

    }

    echo json_encode($response);  
?>