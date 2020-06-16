<?php
    $idsoal = $_GET['id'];
    require_once "script/preferences.php";
    $obj = new adminPanel();
    require_once '../../include/DbOperations.php';
    $row = $obj->getSoalDetail($idsoal);

    if(isset($_POST['submit'])){
        $kelassoal = $_POST['kelassoal'];
        $mapel = $_POST['mapel'];
        $namasoal = $_POST['namasoal'];
        $jawaba = $_POST['jawaba'];
        $jawabb = $_POST['jawabb'];
        $jawabc = $_POST['jawabc'];
        $jawabd = $_POST['jawabd'];
        $jawabbenar = $_POST['jawabbenar'];

        if($kelassoal != "" AND $mapel != "" AND $namasoal != "" AND $jawabbenar != ""){                    

            $result = $obj->updateSoal($kelassoal, $mapel, $namasoal, $jawaba, $jawabb, $jawabc, $jawabd, $jawabbenar, $idsoal);
            
            if($result == 0){
                $response['error'] = true;
                $response['message'] = "Soal dengan pertanyaan yang sama sudah ada";
            }else if($result == 1){
                $response['error'] = false;
                $response['message'] = "Berhasil Menambahkan Soal";
            }

        }else{
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Harap isi <b>field</b> yang masih kosong!</p>
                </div>';
        }

        if (isset($_POST['submit']) && $result == 1){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Berhasil Merubah Soal</p>
                </div>';
        }else if(isset($_POST['submit']) && $result == 0){
            echo '<div class="alert alert-warning alert-dismissable mt-3">
                <button class="close" data-dismiss="alert">&times;</button>
                <p>Gagal Merubah Soal</p>
                </div>';
        }
    }    
?>
<div class="card mb-4 mt-3">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Edit Soal <?php echo $row['mapel_soal'].' '.$row['kelas_soal'];?></div>
    <div class="card-body">
        <form id="form1" name="form1" class="form" method="post">
            <table border=0 cellpadding=3>               
                <tr>
                    <td>Soal Kelas : </td>
                    <td><select class="form-control" name="kelassoal" id="kelassoal">                            
                            <option value="1"<?=$row['kelas_soal'] == '1' ? ' selected="selected"' : '';?>>1</option>
                            <option value="2"<?=$row['kelas_soal'] == '2' ? ' selected="selected"' : '';?>>2</option>
                            <option value="3"<?=$row['kelas_soal'] == '3' ? ' selected="selected"' : '';?>>3</option>
                            <option value="4"<?=$row['kelas_soal'] == '4' ? ' selected="selected"' : '';?>>4</option>
                            <option value="5"<?=$row['kelas_soal'] == '5' ? ' selected="selected"' : '';?>>5</option>
                            <option value="6"<?=$row['kelas_soal'] == '6' ? ' selected="selected"' : '';?>>6</option>    
                        </select></td>
                </tr>
                <tr>
                    <td>Mata Pelajaran</td>
                    <td><select class="form-control" name="mapel" id="mapel">
                            <option value="B Indonesia"<?=$row['mapel_soal'] == 'B Indonesia' ? ' selected="selected"' : '';?>>B Indonesia</option>
                            <option value="Matematika"<?=$row['mapel_soal'] == 'Matematika' ? ' selected="selected"' : '';?>>Matematika</option>
                            <option value="PKN"<?=$row['mapel_soal'] == 'PKN' ? ' selected="selected"' : '';?>>PKN</option>
                            <option value="SBdP"<?=$row['mapel_soal'] == 'SBdP' ? ' selected="selected"' : '';?>>SBdP</option>
                            <option value="IPA"<?=$row['mapel_soal'] == 'IPA' ? ' selected="selected"' : '';?>>IPA</option>
                            <option value="IPS"<?=$row['mapel_soal'] == 'IPS' ? ' selected="selected"' : '';?>>IPS</option> 
                            <option value="PJOK"<?=$row['mapel_soal'] == 'PJOK' ? ' selected="selected"' : '';?>>PJOK</option>  
                        </select></td>
                </tr>
                <tr>
                    <td>Soal</td>
                    <td><textarea class="form-control" name="namasoal" rows="4" cols="100%" ><?php echo $row['nama_soal']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Jawaban A</td>
                    <td><input class="form-control" type="text" value="<?php echo $row['jawaban_a']; ?>" size="100%" name="jawaba"></td>
                </tr>
                <tr>
                    <td>Jawaban B</td>
                    <td><input class="form-control" type="text" value="<?php echo $row['jawaban_b']; ?>" size="100%" name="jawabb"></td>
                </tr>
                <tr>
                    <td>Jawaban C</td>
                    <td><input class="form-control" type="text" value="<?php echo $row['jawaban_c']; ?>" size="100%" name="jawabc"></td>
                </tr>
                <tr>
                    <td>Jawaban D</td>
                    <td><input class="form-control" type="text" value="<?php echo $row['jawaban_d']; ?>" size="100%" name="jawabd"></td>
                </tr>
                <tr>
                    <td>Jawaban Benar</td>                    
                    <td><div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenara" name="jawabbenar"
                        <?php if ($row['jawaban_benar'] == "a") echo "checked";?>
                        value="a">
                        <label class="form-check-label" for="jawabbenara">a</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenarb" name="jawabbenar"
                        <?php if ($row['jawaban_benar'] == "b") echo "checked";?>
                        value="b">
                        <label class="form-check-label" for="jawabbenarb">b</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenarc" name="jawabbenar"
                        <?php if ($row['jawaban_benar'] == "c") echo "checked";?>
                        value="c">
                        <label class="form-check-label" for="jawabbenarc">c</label></div>

                        <div class="form-check-inline form-check">
                        <input type="radio" class="form-check-input" id="jawabbenard"  name="jawabbenar"
                        <?php if ($row['jawaban_benar'] == "d") echo "checked";?>
                        value="d">
                        <label class="form-check-label" for="jawabbenard">d</label></div>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input class="btn btn-primary" type="submit" value="Edit Soal" name="submit">
                    <a href="index.php?page=soal" class="btn btn-danger">Kembali</a></td>
                </tr>
            </table>
        </form>
    </div>
</div>    