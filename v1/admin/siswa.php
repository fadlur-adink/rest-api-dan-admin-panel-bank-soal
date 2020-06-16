<?php
    require_once "script/preferences.php";
    $obj = new adminPanel();
?>

<div class="card mb-4 mt-3">
    <div class="card-header"><i class="fas fa-table mr-1"></i>Daftar Siswa</div>
    <div class="card-body">
        <div class="table-responsive">
            <?php $obj->viewSiswa(); ?>
        </div>
    </div>
</div>