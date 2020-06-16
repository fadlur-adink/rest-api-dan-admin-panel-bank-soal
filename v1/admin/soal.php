<?php
    require_once "script/preferences.php";
    $obj = new adminPanel();

    if (isset($_GET["id"]) && isset($_GET["status"]) && $_GET["status"] == "hapus")
    {
        $obj->deleteSoal(strip_tags($_GET["id"]));
    }
    if(isset($_GET['search'])){
        $statussearch = 1;
    }else if(!isset($_GET['search'])){
        $statussearch = 0;
    }
?>

<div class="card mb-4 mt-3">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Daftar Soal</div>
    <div class="card-body">
        <a href="index.php?page=insertsoal" class="btn btn-success mb-4">Tambah Soal</a>
        <a class="btn btn-primary mb-4" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">Search</a>
        <div class="collapse" id="collapseExample">            
            <div class="card card-body">
                <form id="form1" name="form1" class="form" method="get">
                    <input type="hidden" name="page" value="soal"/>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Kelas
                        </div>
                        <div class="col">
                            <select class="form-control" name="kelassoal">
                                <option value="1" >1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option> 
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Mata Pelajaran
                        </div>
                        <div class="col">
                            <select class="form-control" name="mapelsoal">
                                <option value="B Indonesia" >B Indonesia</option>
                                <option value="Matematika">Matematika</option>
                                <option value="PKN">PKN</option>
                                <option value="SBdP">SBdP</option>
                                <option value="IPA">IPA</option>
                                <option value="IPS">IPS</option> 
                                <option value="PJOK">PJOK</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Soal
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="soal" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Jawaban A
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="jawabana" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Jawaban B
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="jawabanb" />
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-2 font-weight-bold">
                            Jawaban C
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="jawabanc" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 font-weight-bold">
                            Jawaban D
                        </div>
                        <div class="col">
                            <input class="form-control" type="text" name="jawaband" />
                        </div>
                    </div>
                    <input class="btn btn-info mt-2" type="submit" value="Search" name="search">
                </form>
            </div>
        </div>        
        <div class="table-responsive">
            <?php
                if($statussearch == 0){
                    $obj->viewSoal();
                }else if($statussearch == 1){
                    $obj->viewSearchSoal($_GET['kelassoal'], $_GET['mapelsoal'], $_GET['soal'], $_GET['jawabana'], $_GET['jawabanb'], $_GET['jawabanc'], $_GET['jawaband']);
                }
            ?>
        </div>
    </div>
</div>