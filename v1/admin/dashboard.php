<?php
    require_once "script/preferences.php";
    $obj = new adminPanel();
?>
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row mt-3">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Siswa</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#"><?php echo $jmlsiswa = $obj->getCountSiswa(); ?></a>        
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Total Soal</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#"><?php echo $jmlsiswa = $obj->getCountSoal(); ?></a>        
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Bahasa Indonesia</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalbindo = $obj->getCountSoalBindonesia();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalbindo[$i]."<br>";    
                        }                    
                    ?>
                </a>        
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-dark text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Matematika</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalmtk = $obj->getCountSoalMatematika();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalmtk[$i]."<br>";    
                        }
                    ?>
                </a>        
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-light text-dark mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Pendidikan Kewarganegaraan (PKN)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-dark stretched-link" href="#">
                    <?php 
                        $jmlsoalpkn = $obj->getCountSoalPKN();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalpkn[$i]."<br>";    
                        }
                    ?>
                </a>        
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-secondary text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Ilmu Pengetahuan Alam (IPA)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalipa = $obj->getCountSoalIPA();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalipa[$i]."<br>";    
                        }
                    ?>
                </a> 
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Ilmu Pengetahuan Sosial (IPS)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalips = $obj->getCountSoalIPS();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalips[$i]."<br>";    
                        }
                    ?>
                </a> 
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Seni Budaya dan Prakarya (SBdP)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalsbdp = $obj->getCountSoalSBdP();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalsbdp[$i]."<br>";    
                        }
                    ?>
                </a>         
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-info text-white mb-4">
            <div class="card-body font-weight-bold">Jumlah Soal Pendidikan Jasmani Olahraga dan Kesehatan (PJOK)</div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">
                    <?php 
                        $jmlsoalpjok = $obj->getCountSoalPJOK();
                        for($i = 1; $i <= 6; $i++){
                            echo "Kelas ".$i." : ".$jmlsoalpjok[$i]."<br>";    
                        }
                    ?>
                </a> 
            </div>
        </div>
    </div>
</div>