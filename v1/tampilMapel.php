<?php
    $response = array();

    $con;

    require_once '../include/DbConnect.php';

    $db = new DbConnect();

    $con = $db->connect();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $bindonesia = $_POST['bindonesia'];
        $matematika = $_POST['matematika'];
        $pkn = $_POST['pkn'];
        $ipa = $_POST['ipa'];
        $ips = $_POST['ips'];
        $sbdp = $_POST['sbdp'];
        $pjok = $_POST['pjok'];

        $stmt = $con->prepare("SELECT mapel_soal FROM tbl_soal GROUP BY mapel_soal ORDER BY max(mapel_soal)DESC");
        $stmt->execute();
        $stmt->bind_result($mapel);
        $temp = array();
        while($stmt->fetch()){
                    
            if($mapel == "Matematika" && $matematika == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "B Indonesia" && $bindonesia == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "PKN" && $pkn == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "SBdP" && $sbdp == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "IPA" && $ipa == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "IPS" && $ips == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
            if($mapel == "PJOK" && $pjok == "0"){
                $temp['mapel'] = $mapel;
                array_push($response, $temp);
            }
        }
    }

    echo json_encode($response);
?>