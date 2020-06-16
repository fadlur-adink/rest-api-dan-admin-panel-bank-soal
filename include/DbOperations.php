<?php
    class DbOperations{
        private $con;

        function __construct(){

            require_once dirname(__FILE__).'/DbConnect.php';

            $db = new DbConnect();

            $this->con = $db->connect();
        }

        //function cek apakah username sudah terdaftar atau belum
        private function IsUserExist($username){
            $stmt = $this->con->prepare("SELECT id_user FROM tbl_users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        private function IsSoalExist($namasoal){
            $stmt = $this->con->prepare("SELECT id_soal FROM tbl_soal WHERE nama_soal = ?");
            $stmt->bind_param("s", $namasoal);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        public function createUser($namalengkap, $username, $pass){
            //cek apakah username sudah terdaftar atau belum
            if($this->IsUserExist($username)){
                return 0;//kalau sudah terdaftar return 0
            }else{
                //kalau username belum terdaftar eksekusi perintah dibawah
                $password = md5($pass);
                //pertama masukan data ke tbl_users
                $stmt = $this->con->prepare("INSERT INTO `tbl_users` (`id_user`, `username`, `password`, `level`) VALUES (NULL, ?, ?, 'Siswa');");
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $stmt->close();
                $q1 = "SELECT * FROM tbl_users ORDER BY id_user DESC";
                if ($result = $this->con->query($q1))
                {
                    $data = $result->fetch_row();
                    $lastId = $data[0];	 // ambil id yang terakhir yg masuk
                    //kedua masukan data ke tbl_siswa
                    $stmt = $this->con->prepare("INSERT INTO `tbl_siswa` (`id_siswa`, `id_user`, `username`, `nama`, `kelas`) VALUES (NULL, ?, ?, ?, 1);");
                    $stmt->bind_param("sss", $lastId, $username, $namalengkap);
                    if($stmt->execute()){
                        return 1;//kalau berhasil input return 1
                    }else{
                        return 2;//kalau gagal input return 2
                    }
                }else{
                    return false;
                }
            }
        }

        public function userLogin($username, $pass){
            $password = md5($pass);
            $stmt = $this->con->prepare("SELECT id_user FROM tbl_users WHERE username = ? AND password = ?");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();                     
            return $stmt->get_result()->fetch_assoc();
        }

        public function adminLogin($username, $pass){
            $password = md5($pass);
            $stmt = $this->con->prepare("SELECT * FROM tbl_users WHERE username = ? AND password = ? AND level = 'admin'");
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();                     
            return $stmt->get_result()->fetch_assoc();
        }

        public function getUserDetail($iduser){
            $stmt = $this->con->prepare("SELECT * FROM tbl_siswa WHERE id_user = ?");
            $stmt->bind_param("i", $iduser);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }

        public function insertSoalWithImage($kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $namagambar, $sizegambar, $tmpnamegambar){
            if($this->IsSoalExist($namasoal)){
                return 0;//kalau sudah terdaftar return 0
            }else{
                $ekstensi_diperbolehkan	= array('png','jpg');
                $nama = $namagambar;
                $x = explode('.', $nama);
                $ekstensi = strtolower(end($x));
                $ukuran	= $sizegambar;
                $file_tmp = $tmpnamegambar;

                if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                    if($ukuran < 1044070){
                        move_uploaded_file($file_tmp, '../gambar/'.$nama);
					    $stmt = $this->con->prepare("INSERT INTO `tbl_soal` (`id_soal`, `kelas_soal`, `mapel_soal`, `nama_soal`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`, `gambar`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
                        $stmt->bind_param("issssssss", $kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $nama);
                        if($stmt->execute()){
                            return 11;//kalau berhasil input return 1
                        }else{
                            return 21;//kalau gagal input return 2
                        }
                    }else{
                        return 31;//ukuran file terlalu besar
                    }
                }else{
                    return 41;//extensi file tidak diperbolehkan
                }
            }
        }

        public function insertSoal($kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar){
            if($this->IsSoalExist($namasoal)){
                return 0;//kalau sudah terdaftar return 0
            }else{                
                $stmt = $this->con->prepare("INSERT INTO `tbl_soal` (`id_soal`, `kelas_soal`, `mapel_soal`, `nama_soal`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`, `gambar`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, 'Tidak_Ada.jpg');");
                $stmt->bind_param("isssssss", $kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar);
                if($stmt->execute()){
                    return 12;//kalau berhasil input return 1
                }else{
                    return 22;//kalau gagal input return 2
                }
            }
        }

        public function editUserInfo($idsiswa, $username, $namalengkap, $pass){
            $password = md5($pass);
            $stmt = $this->con->prepare("UPDATE tbl_siswa SET username=?, nama=? WHERE id_siswa=?");
            $stmt->bind_param("ssi", $username, $namalengkap, $idsiswa);
            $stmt->execute();
            $stmt->close();
            $q1 = "SELECT id_user FROM tbl_siswa WHERE id_siswa = $idsiswa";
            if ($result = $this->con->query($q1))
            {
                $data = $result->fetch_row();
                $iduser = $data[0];	 // ambil iduser 
                $stmt = $this->con->prepare("UPDATE tbl_users SET username=?, password=? WHERE id_user=?");
                $stmt->bind_param("ssi", $username, $password, $iduser);
                if($stmt->execute()){
                    return 1;//kalau berhasil input return 1
                }else{
                    return 0;//kalau gagal input return 0
                }
            }else{
                return false;
            }
        }

        public function getRowSoal($mapel, $kelas){
            $stmt = $this->con->prepare("SELECT id_soal FROM tbl_soal WHERE mapel_soal = ? AND kelas_soal = ?");
            $stmt->bind_param("si", $mapel, $kelas);
            $stmt->execute();
            $stmt->bind_result($idsoal);
            $stmt->store_result();
            return $nRows = $stmt->num_rows();
        }

        public function updateStatusMapel($mapel, $username){
            if($mapel == "B Indonesia"){
                $mapelupdate = "b_indonesia";
            }else if($mapel == "Matematika"){
                $mapelupdate = "matematika";
            }else if($mapel == "PKN"){
                $mapelupdate = "pkn";
            }else if($mapel == "SBdP"){
                $mapelupdate = "sbdp";
            }else if($mapel == "IPA"){
                $mapelupdate = "ipa";
            }else if($mapel == "IPS"){
                $mapelupdate = "ips";
            }else{
                $mapelupdate = "pjok";
            }
            $stmt = $this->con->prepare("UPDATE tbl_siswa SET ".$mapelupdate."=1 WHERE username=?");
            $stmt->bind_param("s", $username);
            if($stmt->execute()){
                return 1;//kalau berhasil input return 1
            }else{
                return 0;//kalau gagal input return 0
            }
        }

        public function updateKelasSiswa($kelas, $username){
            $kelasupdate = $kelas+1;
            $stmt = $this->con->prepare("UPDATE tbl_siswa SET kelas=?, b_indonesia=0, matematika=0, pkn=0, sbdp=0, ipa=0, ips=0, pjok=0 WHERE username=?");
            $stmt->bind_param("is", $kelasupdate, $username);
            if($stmt->execute()){
                return 1;//kalau berhasil input return 1
            }else{
                return 0;//kalau gagal input return 0
            }
        }

        public function isScoreExist($mapel, $kelas){
            $stmt = $this->con->prepare("SELECT id_score FROM tbl_score WHERE mapel = ? AND kelas = ?");
            $stmt->bind_param("si", $mapel, $kelas);
            $stmt->execute();
            $stmt->store_result();
            return $stmt->num_rows > 0;
        }

        public function checkBestScore($mapel, $kelas){
            if($this->isScoreExist($mapel, $kelas)){
                $stmt = $this->con->prepare("SELECT score FROM tbl_score WHERE mapel = ? AND kelas = ?");
                $stmt->bind_param("si", $mapel, $kelas);
                $stmt->execute();
                return $stmt->get_result()->fetch_assoc();
            }else{
                return 0;
            }
        }

        public function insertBestScore($mapel, $kelas, $score){
            $stmt = $this->con->prepare("INSERT INTO `tbl_score` (`id_score`, `mapel`, `kelas`, `score`) VALUES (NULL, ?, ?, ?);");
            $stmt->bind_param("sii", $mapel, $kelas, $score);
            if($stmt->execute()){
                return 1;
            }else{
                return 0;
            }
        }

        public function updateBestScore($mapel, $kelas, $score){
            $stmt = $this->con->prepare("UPDATE tbl_score SET score = ? WHERE mapel=? AND kelas=?");
            $stmt->bind_param("isi", $score, $mapel, $kelas);
            if($stmt->execute()){
                return 1;
            }else{
                return 0;
            }
        }
    }

?>