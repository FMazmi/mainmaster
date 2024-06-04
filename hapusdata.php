<?php
require 'function.php';

$id = $_GET['laporan_id'];
$laporan_id = str_replace(' ', '', $id);

if (hapus($laporan_id) > 0) {
    echo "
        <script>
            alert('Data Berhasil Dihapus!');
            document.location.href = 'datalaporan.php';
        </script>        
        ";
}else{
    echo "
        <script>
            alert('Data Gagal Dihapus!');
            document.location.href = 'datalaporan.php';
        </script>        
        ";
}
?>