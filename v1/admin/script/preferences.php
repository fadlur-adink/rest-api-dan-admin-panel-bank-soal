<?php

class adminPanel
{
    private $host = "localhost";
	private $user = "root";
	private $pass = "";
	private $database = "db_bank_soal";
    public $mysqli="";
    
    public function SS_GetConnection () 
	{
		$this->mysqli = new MySQLi($this->host, $this->user, $this->pass, $this->database);
		if (!$this->mysqli->connect_errno){
			return $this->mysqli; 
		}
    }
    
    public function getCountSiswa(){
        if ($this->SS_GetConnection())
		{
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT * FROM tbl_siswa");
            $stmt->execute();
            $stmt->store_result();
            return $nRows = $stmt->num_rows();
        }
    }

    public function getCountSoalBindonesia(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'B Indonesia' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalMatematika(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'Matematika' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalPKN(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'PKN' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalIPA(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'IPA' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalIPS(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'IPS' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalSBdP(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'SBdP' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoalPJOK(){
        if ($this->SS_GetConnection())
		{
            $temp = array();
            $stmt = $this->mysqli->stmt_init();
            for($i = 1; $i <= 6; $i++){
                $stmt->prepare("SELECT * FROM tbl_soal WHERE mapel_soal = 'PJOK' AND kelas_soal = ?");
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $temp[$i] = $stmt->num_rows();
            }
            return $temp;
        }
    }

    public function getCountSoal(){
        if ($this->SS_GetConnection())
		{
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT * FROM tbl_soal");
            $stmt->execute();
            $stmt->store_result();
            return $nRows = $stmt->num_rows();
        }
    }

    public function viewSoal(){
        if ($this->SS_GetConnection())
		{
            // Cek apakah terdapat data pada page URL
            $hal = (isset($_GET['hal'])) ? $_GET['hal'] : 1;

            $limit = 10; // Jumlah data per halamanya

            // Buat query untuk menampilkan daa ke berapa yang akan ditampilkan pada tabel yang ada di database
            $limit_start = ($hal - 1) * $limit;    

            $no = $limit_start + 1; // Untuk penomoran tabel
            $query = "SELECT * FROM tbl_soal LIMIT ".$limit_start.",".$limit;
			if ($result = $this->mysqli->query($query)){
                echo "<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Mapel Soal</th>";
                echo "<th>Kelas Soal</th>";
                echo "<th>Soal</th>";
                echo "<th>Jawaban A</th>";
                echo "<th>Jawaban B</th>";
                echo "<th>Jawaban C</th>";
                echo "<th>Jawaban D</th>";
                echo "<th>Jawaban Benar</th>";
                echo "<th>Ada Gambar?</th>";
                echo "<th>Aksi</th>";
                echo "</tr>";
                echo "</thead>";            
                echo "<tbody>";
                while ($data = $result->fetch_row())
				{
                    if($data[9] == "Tidak_Ada.jpg"){
                        $gambar = "Tidak Ada";
                    }else{
                        $gambar = "Ada";
                    }
                    echo "<tr>";        
					echo "<td>".($data[2])."</td>";
                    echo "<td>".($data[1])."</td>";
					echo "<td>".($data[3])."</td>";
                    echo "<td>".($data[4])."</td>";
                    echo "<td>".($data[5])."</td>";
                    echo "<td>".($data[6])."</td>";
                    echo "<td>".($data[7])."</td>";
                    echo "<td>".($data[8])."</td>";
                    echo "<td>".($gambar)."</td>";
					echo "<td>";
					echo "<a class='btn btn-info btn-sm' href=index.php?page=editsoal&id=$data[0]>Edit</a> | <a class='btn btn-danger btn-sm' onclick=\"return confirm('Anda yakin ingin menghapus soal ini?')\" href=index.php?page=soal&id=$data[0]&status=hapus>Hapus</a>";
					echo "</td>";
					echo "</tr>";				
				}
                echo "</tbody>";
                echo "</table>";
            }
            echo "<ul class='pagination'>";
            if ($hal == 1) { // Jika page adalah pake ke 1, maka disable link PREV
                echo "<li class='page-item disabled'><a class='page-link' href='#'>First</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";
            } else { // Jika buka page ke 1
                $link_prev = ($hal > 1) ? $hal - 1 : 1;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=1'>First</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal= ".$link_prev."'>&laquo;</a></li>";
            }

            // Buat query untuk menghitung semua jumlah data
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT id_soal FROM tbl_soal");
            $stmt->execute();
            $stmt->bind_result($idsoal);
            $stmt->store_result();
            $get_jumlah = $stmt->num_rows();

            $jumlah_page = ceil($get_jumlah / $limit); // Hitung jumlah halamanya
            $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
            $start_number = ($hal > $jumlah_number) ? $hal - $jumlah_number : 1; // Untuk awal link member
            $end_number = ($hal < ($jumlah_page - $jumlah_number)) ? $hal + $jumlah_number : $jumlah_page; // Untuk akhir link number

            for ($i = $start_number; $i <= $end_number; $i++) {
                if($hal == $i){
                    $link_active = "class='page-item active'";
                }else{
                    $link_active = "";
                }            
                echo "<li ".$link_active."><a class='page-link' href='index.php?page=soal&hal=".$i."'>".$i."</a></li>";
            }
            // Jika page sama dengan jumlah page, maka disable link NEXT nya
            // Artinya page tersebut adalah page terakhir
            if ($hal == $jumlah_page) { // Jika page terakhir
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>Last</a></li>";
            } else { // Jika bukan page terakhir
                $link_next = ($hal < $jumlah_page) ? $hal + 1 : $jumlah_page;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$link_next."'>&raquo;</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$jumlah_page."'>Last</a></li>";
            }
            
            echo "</ul>";
        }
    }

    public function viewSearchSoal($kelas, $mapel, $soal, $jawaba, $jawabb, $jawabc, $jawabd){
        if ($this->SS_GetConnection())
		{
            // Cek apakah terdapat data pada page URL
            $hal = (isset($_GET['hal'])) ? $_GET['hal'] : 1;

            $limit = 10; // Jumlah data per halamanya

            // Buat query untuk menampilkan daa ke berapa yang akan ditampilkan pada tabel yang ada di database
            $limit_start = ($hal - 1) * $limit;    

            $no = $limit_start + 1; // Untuk penomoran tabel
            $query = "SELECT * FROM tbl_soal WHERE kelas_soal=".$kelas." AND mapel_soal = '".$mapel."' AND nama_soal LIKE '%".$soal."%' AND jawaban_a LIKE '%".$jawaba."%' AND jawaban_b LIKE '%".$jawabb."%' AND jawaban_c LIKE '%".$jawabc."%' AND jawaban_d LIKE '%".$jawabd."%' LIMIT ".$limit_start.",".$limit;
			if ($result = $this->mysqli->query($query)){
                echo "<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Mapel Soal</th>";
                echo "<th>Kelas Soal</th>";
                echo "<th>Soal</th>";
                echo "<th>Jawaban A</th>";
                echo "<th>Jawaban B</th>";
                echo "<th>Jawaban C</th>";
                echo "<th>Jawaban D</th>";
                echo "<th>Jawaban Benar</th>";
                echo "<th>Ada Gambar?</th>";
                echo "<th>Aksi</th>";
                echo "</tr>";
                echo "</thead>";            
                echo "<tbody>";
                while ($data = $result->fetch_row())
				{
                    if($data[9] == "Tidak_Ada.jpg"){
                        $gambar = "Tidak Ada";
                    }else{
                        $gambar = "Ada";
                    }
                    echo "<tr>";        
					echo "<td>".($data[2])."</td>";
                    echo "<td>".($data[1])."</td>";
					echo "<td>".($data[3])."</td>";
                    echo "<td>".($data[4])."</td>";
                    echo "<td>".($data[5])."</td>";
                    echo "<td>".($data[6])."</td>";
                    echo "<td>".($data[7])."</td>";
                    echo "<td>".($data[8])."</td>";
                    echo "<td>".($gambar)."</td>";
					echo "<td>";
					echo "<a class='btn btn-info btn-sm' href=index.php?page=editsoal&id=$data[0]>Edit</a> | <a class='btn btn-danger btn-sm' onclick=\"return confirm('Anda yakin ingin menghapus soal ini?')\" href=index.php?page=soal&id=$data[0]&status=hapus>Hapus</a>";
					echo "</td>";
					echo "</tr>";				
				}
                echo "</tbody>";
                echo "</table>";
            }
            echo "<ul class='pagination'>";
            if ($hal == 1) { // Jika page adalah pake ke 1, maka disable link PREV
                echo "<li class='page-item disabled'><a class='page-link' href='#'>First</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";
            } else { // Jika buka page ke 1
                $link_prev = ($hal > 1) ? $hal - 1 : 1;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=1&kelassoal=".$kelas."&mapelsoal=".$mapel."&soal=".$soal."&jawabana=".$jawaba."&jawabanb=".$jawabb."&jawabanc=".$jawabc."&jawaband=".$jawabd."&search=Search'>First</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal= ".$link_prev."&kelassoal=".$kelas."&mapelsoal=".$mapel."&soal=".$soal."&jawabana=".$jawaba."&jawabanb=".$jawabb."&jawabanc=".$jawabc."&jawaband=".$jawabd."&search=Search'>&laquo;</a></li>";
            }

            // Buat query untuk menghitung semua jumlah data
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT id_soal FROM tbl_soal WHERE kelas_soal=".$kelas." AND mapel_soal = '".$mapel."' AND nama_soal LIKE '%".$soal."%' AND jawaban_a LIKE '%".$jawaba."%' AND jawaban_b LIKE '%".$jawabb."%' AND jawaban_c LIKE '%".$jawabc."%' AND jawaban_d LIKE '%".$jawabd."%'");
            $stmt->execute();
            $stmt->bind_result($idsoal);
            $stmt->store_result();
            $get_jumlah = $stmt->num_rows();

            $jumlah_page = ceil($get_jumlah / $limit); // Hitung jumlah halamanya
            $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
            $start_number = ($hal > $jumlah_number) ? $hal - $jumlah_number : 1; // Untuk awal link member
            $end_number = ($hal < ($jumlah_page - $jumlah_number)) ? $hal + $jumlah_number : $jumlah_page; // Untuk akhir link number

            for ($i = $start_number; $i <= $end_number; $i++) {
                if($hal == $i){
                    $link_active = "class='page-item active'";
                }else{
                    $link_active = "";
                }            
                echo "<li ".$link_active."><a class='page-link' href='index.php?page=soal&hal=".$i."&kelassoal=".$kelas."&mapelsoal=".$mapel."&soal=".$soal."&jawabana=".$jawaba."&jawabanb=".$jawabb."&jawabanc=".$jawabc."&jawaband=".$jawabd."&search=Search'>".$i."</a></li>";
            }
            // Jika page sama dengan jumlah page, maka disable link NEXT nya
            // Artinya page tersebut adalah page terakhir
            if ($hal == $jumlah_page) { // Jika page terakhir
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>Last</a></li>";
            } else { // Jika bukan page terakhir
                $link_next = ($hal < $jumlah_page) ? $hal + 1 : $jumlah_page;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$link_next."&kelassoal=".$kelas."&mapelsoal=".$mapel."&soal=".$soal."&jawabana=".$jawaba."&jawabanb=".$jawabb."&jawabanc=".$jawabc."&jawaband=".$jawabd."&search=Search'>&raquo;</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$jumlah_page."&kelassoal=".$kelas."&mapelsoal=".$mapel."&soal=".$soal."&jawabana=".$jawaba."&jawabanb=".$jawabb."&jawabanc=".$jawabc."&jawaband=".$jawabd."&search=Search'>Last</a></li>";
            }
            
            echo "</ul>";
        }
    }

    public function viewSiswa(){
        if ($this->SS_GetConnection())
		{
            // Cek apakah terdapat data pada page URL
            $hal = (isset($_GET['hal'])) ? $_GET['hal'] : 1;

            $limit = 10; // Jumlah data per halamanya

            // Buat query untuk menampilkan daa ke berapa yang akan ditampilkan pada tabel yang ada di database
            $limit_start = ($hal - 1) * $limit;    

            $no = $limit_start + 1; // Untuk penomoran tabel            
            $query = "SELECT * FROM tbl_siswa LIMIT ".$limit_start.",".$limit;
			if ($result = $this->mysqli->query($query)){
                echo "<table class='table table-bordered' id='dataTable' width='100%'' cellspacing='0'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Nama Lengkap</th>";
                echo "<th>Username</th>";
                echo "<th>Kelas</th>";
                echo "<th>B Indonesia</th>";
                echo "<th>Matematika</th>";
                echo "<th>PKN</th>";
                echo "<th>SBdP</th>";
                echo "<th>IPA</th>";
                echo "<th>IPS</th>";
                echo "<th>PJOK</th>";
                echo "<th>Aksi</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($data = $result->fetch_row())
				{
                    if($data[5] == 0){
                        $bindo = "Belum Selesai";
                    }else{
                        $bindo = "Sudah Selesai";
                    }
                    if($data[6] == 0){
                        $mtk = "Belum Selesai";
                    }else{
                        $mtk = "Sudah Selesai";
                    }
                    if($data[7] == 0){
                        $pkn = "Belum Selesai";
                    }else{
                        $pkn = "Sudah Selesai";
                    }
                    if($data[8] == 0){
                        $sbdp = "Belum Selesai";
                    }else{
                        $sbdp = "Sudah Selesai";
                    }
                    if($data[9] == 0){
                        $ipa = "Belum Selesai";
                    }else{
                        $ipa = "Sudah Selesai";
                    }
                    if($data[10] == 0){
                        $ips = "Belum Selesai";
                    }else{
                        $ips = "Sudah Selesai";
                    }
                    if($data[11] == 0){
                        $pjok = "Belum Selesai";
                    }else{
                        $pjok = "Sudah Selesai";
                    }
                    echo "<tr>";        
					echo "<td>".($data[3])."</td>";
                    echo "<td>".($data[2])."</td>";
					echo "<td>".($data[4])."</td>";
                    echo "<td>".($bindo)."</td>";
                    echo "<td>".($mtk)."</td>";
                    echo "<td>".($pkn)."</td>";
                    echo "<td>".($sbdp)."</td>";
                    echo "<td>".($ipa)."</td>";
                    echo "<td>".($ips)."</td>";
                    echo "<td>".($pjok)."</td>";
					echo "<td>";
					echo "<a class='btn btn-info btn-sm' href=index.php?page=editdatakegiatan&id=$data[0]>Edit</a> | <a class='btn btn-danger btn-sm' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" href=index.php?page=datakegiatan&id=$data[0]&status=hapus>Hapus</a>";
					echo "</td>";
					echo "</tr>";				
				}
                echo "</tbody>";
                echo "</table>";
            }
            echo "<ul class='pagination'>";
            if ($hal == 1) { // Jika page adalah pake ke 1, maka disable link PREV
                echo "<li class='page-item disabled'><a class='page-link' href='#'>First</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";
            } else { // Jika buka page ke 1
                $link_prev = ($hal > 1) ? $hal - 1 : 1;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=1'>First</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal= ".$link_prev."'>&laquo;</a></li>";
            }

            // Buat query untuk menghitung semua jumlah data
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT id_siswa FROM tbl_siswa");
            $stmt->execute();
            $stmt->bind_result($idsoal);
            $stmt->store_result();
            $get_jumlah = $stmt->num_rows();

            $jumlah_page = ceil($get_jumlah / $limit); // Hitung jumlah halamanya
            $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
            $start_number = ($hal > $jumlah_number) ? $hal - $jumlah_number : 1; // Untuk awal link member
            $end_number = ($hal < ($jumlah_page - $jumlah_number)) ? $hal + $jumlah_number : $jumlah_page; // Untuk akhir link number

            for ($i = $start_number; $i <= $end_number; $i++) {
                if($hal == $i){
                    $link_active = "class='page-item active'";
                }else{
                    $link_active = "";
                }            
                echo "<li ".$link_active."><a class='page-link' href='index.php?page=soal&hal=".$i."'>".$i."</a></li>";
            }
            // Jika page sama dengan jumlah page, maka disable link NEXT nya
            // Artinya page tersebut adalah page terakhir
            if ($hal == $jumlah_page) { // Jika page terakhir
                echo "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>";
                echo "<li class='page-item disabled'><a class='page-link' href='#'>Last</a></li>";
            } else { // Jika bukan page terakhir
                $link_next = ($hal < $jumlah_page) ? $hal + 1 : $jumlah_page;
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$link_next."'>&raquo;</a></li>";
                echo "<li class='page-item'><a class='page-link' href='index.php?page=soal&hal=".$jumlah_page."'>Last</a></li>";
            }
            
            echo "</ul>";
        }
    }

    public function getSoalDetail($idsoal){
        if ($this->SS_GetConnection())
		{
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("SELECT * FROM tbl_soal WHERE id_soal = ?");
            $stmt->bind_param("i", $idsoal);
            $stmt->execute();
            return $stmt->get_result()->fetch_assoc();
        }                
    }

    public function updateSoal($kelas, $mapel, $soal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $idsoal){
        if($this->SS_GetConnection()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare("UPDATE tbl_soal SET kelas_soal = ?, mapel_soal = ?, nama_soal = ?, jawaban_a = ?, jawaban_b = ?, jawaban_c = ?, jawaban_d = ?, jawaban_benar = ? WHERE id_soal = ?");
            $stmt->bind_param("isssssssi", $kelas, $mapel, $soal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $idsoal);
            if($stmt->execute()){
                return 1;
            }else{
                return 0;
            }
        }
    }

    public function deleteSoal($idsoal){
        if ($this->SS_GetConnection())
		{
			// hapus data
			$stmt = $this->mysqli->stmt_init();
			$stmt->prepare("DELETE FROM tbl_soal WHERE id_soal = ?");
			$stmt->bind_param("i", $idsoal);
			$stmt->execute();
			$stmt->close();
		}
    }
}
?>