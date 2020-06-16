<?php
    require_once "script/preferences.php";
    $obj = new adminPanel();
    require_once '../../include/DbOperations.php';
    $response = array();

    if(isset($_POST['submit'])){
        $kelassoal = $_POST['kelassoal'];
        $mapel = $_POST['mapel'];
        $namasoal = $_POST['namasoal'];
        $jawaba = $_POST['jawaba'];
        $jawabb = $_POST['jawabb'];
        $jawabc = $_POST['jawabc'];
        $jawabd = $_POST['jawabd'];
        $jawabbenar = $_POST['jawabbenar'];
        $namagambar = $_FILES['gambar']['name'];        
        $sizegambar = $_FILES['gambar']['size'];
        $tmpnamegambar = $_FILES['gambar']['tmp_name'];

        if($kelassoal != "" && $mapel != "" && $namasoal != "" && $jawabbenar != ""){
            
            $db = new DbOperations();

            if($sizegambar == 0){
                $result = $db->insertSoal($kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar);                
            }else{
                $result = $db->insertSoalWithImage($kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $namagambar, $sizegambar, $tmpnamegambar);
            }
            
            if($result == 0){
                $response['error'] = true;
                $response['message'] = "Soal dengan pertanyaan yang sama sudah ada";
            }else if($result == 1){
                $response['error'] = false;
                $response['message'] = "Berhasil Menambahkan Soal";
            }else if($result == 2){
                $response['error'] = true;
                $response['message'] = "Gagal Menambahkan Soal";
            }else if($result == 3){
                $response['error'] = true;
                $response['message'] = "Ukuran File Terlalu Besar";
            }else if($result == 4){
                $response['error'] = true;
                $response['message'] = "Extensi Tidak Di Perbolehkan";
            }

        }else{
            $response['error'] = true;
            $response['message'] = "Required Field Can't Be Empty";
        }

        if (isset($_POST['submit']) && $result == 11){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Berhasil Menambahkan Soal (With Image)</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 12){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Berhasil Menambahkan Soal (Without Image)</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 0){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Soal dengan pertanyaan yang sama sudah ada</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 21){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Gagal menambahkan soal (with image)</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 22){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Gagal menambahkan soal (without Image)</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 3){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Ukuran file terlalu besar</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 4){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Extensi file tidak di perbolehkan</p>
                </div>';
        }
    }    
?>
<div class="card mb-4 mt-3">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Tambah Soal (Jumlah Total Soal Saat Ini : <?php echo $jmlsiswa = $obj->getCountSoal(); ?>)</div>
    <div class="card-body">
        <form id="form1" name="form1" class="form" method="post" enctype="multipart/form-data">
            <table border=0 cellpadding=3>               
                <tr>
                    <td>Soal Kelas : </td>
                    <td><select class="form-control" name="kelassoal" id="kelassoal">    
                            <?php
                                if(isset($_POST['submit'])){
                                    ?>
                                    <option value="1"<?=$kelassoal == '1' ? ' selected="selected"' : '';?>>1</option>
                                    <option value="2"<?=$kelassoal == '2' ? ' selected="selected"' : '';?>>2</option>
                                    <option value="3"<?=$kelassoal == '3' ? ' selected="selected"' : '';?>>3</option>
                                    <option value="4"<?=$kelassoal == '4' ? ' selected="selected"' : '';?>>4</option>
                                    <option value="5"<?=$kelassoal == '5' ? ' selected="selected"' : '';?>>5</option>
                                    <option value="6"<?=$kelassoal == '6' ? ' selected="selected"' : '';?>>6</option> 
                                    <?php
                                } else {
                                    ?>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <?php
                                }
                            ?>                            
                        </select></td>
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td><select class="form-control" name="mapel" id="mapel">
                            <?php
                                if(isset($_POST['submit'])){
                                    ?>
                                    <option value="B Indonesia"<?=$mapel == 'B Indonesia' ? ' selected="selected"' : '';?>>B Indonesia</option>
                                    <option value="Matematika"<?=$mapel == 'Matematika' ? ' selected="selected"' : '';?>>Matematika</option>
                                    <option value="PKN"<?=$mapel == 'PKN' ? ' selected="selected"' : '';?>>PKN</option>
                                    <option value="SBdP"<?=$mapel == 'SBdP' ? ' selected="selected"' : '';?>>SBdP</option>
                                    <option value="IPA"<?=$mapel == 'IPA' ? ' selected="selected"' : '';?>>IPA</option>
                                    <option value="IPS"<?=$mapel == 'IPS' ? ' selected="selected"' : '';?>>IPS</option> 
                                    <option value="PJOK"<?=$mapel == 'PJOK' ? ' selected="selected"' : '';?>>PJOK</option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="B Indonesia" >B Indonesia</option>
                                    <option value="Matematika">Matematika</option>
                                    <option value="PKN">PKN</option>
                                    <option value="SBdP">SBdP</option>
                                    <option value="IPA">IPA</option>
                                    <option value="IPS">IPS</option> 
                                    <option value="PJOK">PJOK</option>   
                                    <?php
                                }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Soal</td>
                    <td><textarea class="form-control" name="namasoal" rows="4" cols="100%" ></textarea></td>
                </tr>
                <tr>
                    <td>Gambar</td>
                    <td><input type="file" class="form-control-file" name="gambar" id="gambar" ></td>
                </tr>
                <tr>
                    <td>Jawaban A</td>
                    <td><input class="form-control" type="text" size="100%" name="jawaba"></td>
                </tr>
                <tr>
                    <td>Jawaban B</td>
                    <td><input class="form-control" type="text" size="100%" name="jawabb"></td>
                </tr>
                <tr>
                    <td>Jawaban C</td>
                    <td><input class="form-control" type="text" size="100%" name="jawabc"></td>
                </tr>
                <tr>
                    <td>Jawaban D</td>
                    <td><input class="form-control" type="text" size="100%" name="jawabd"></td>
                </tr>
                <tr>
                    <td>Jawaban Benar</td>
                    <td><div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenara" name="jawabbenar"
                        <?php if (isset($jawabbenar) && $jawabbenar=="a") echo "checked";?>
                        value="a">
                        <label class="form-check-label" for="jawabbenara">a</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenarb" name="jawabbenar"
                        <?php if (isset($jawabbenar) && $jawabbenar=="b") echo "checked";?>
                        value="b">
                        <label class="form-check-label" for="jawabbenarb">b</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenarc" name="jawabbenar"
                        <?php if (isset($jawabbenar) && $jawabbenar=="c") echo "checked";?>
                        value="c">
                        <label class="form-check-label" for="jawabbenarc">c</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenard"  name="jawabbenar"
                        <?php if (isset($jawabbenar) && $jawabbenar=="d") echo "checked";?>
                        value="d">
                        <label class="form-check-label" for="jawabbenard">d</label></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="btn btn-primary" type="submit" value="Tambah Soal" name="submit"></td>
                </tr>
            </table>
        </form>
    </div>
</div>    