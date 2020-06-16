<?php
    $response = array();

    $con;

    require_once '../include/DbConnect.php';

    $db = new DbConnect();

    $con = $db->connect();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mapel = $_POST['mapel'];
        $kelas = $_POST['kelas'];

        $stmt = $con->prepare("SELECT nama_soal, jawaban_a, jawaban_b, jawaban_c, jawaban_d, jawaban_benar, gambar FROM tbl_soal WHERE mapel_soal = ? AND kelas_soal = ?");
        $stmt->bind_param("si", $mapel, $kelas);    
        $stmt->execute();
        $stmt->bind_result($soal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $gambar);
        $temp = array();
        while($stmt->fetch()){
                    
            $temp['soal'] = $soal;
            $temp['jawaba'] = $jawaba;
            $temp['jawabb'] = $jawabb;
            $temp['jawabc'] = $jawabc;
            $temp['jawabd'] = $jawabd;
            $temp['jawabbenar'] = $jawabbenar;
            $temp['gambar'] = $gambar;
            
            array_push($response, $temp);
        }

    }

    echo json_encode($response);
?>