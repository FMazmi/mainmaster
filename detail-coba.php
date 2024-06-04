<?php
    require 'function.php';

    $laporan_id = $_GET['laporan_id'];

    $data = query("SELECT * FROM laporan_main WHERE laporan_id == '$laporan_id' ");
    var_dump($data);


?>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr align="center">
            <td colspan="2">
                <img src="img/undraw_posting_photo.svg" alt="" width="50%">
            </td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%"></td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
        <tr>
            <th width="40%">Nama Item</th>
            <td width="60%">Isi</td>
        </tr>
    </table>

</div>