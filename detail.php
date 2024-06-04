<?php
session_start();

if(!isset($_SESSION['login'])) {
    echo "
    <script>
    window.alert('Login Terlebih Dahulu!')
    window.location = 'login.php'
    </script>    
    ";
}

require 'function.php';

// Jika dataLaporan diklik maka
if (isset($_POST['dataLaporan'])) {
    $output = '';

    // mengambil data siswa dari nis yang berasal dari dataLaporan
    $sql = "SELECT * FROM laporan_main WHERE laporan_id = '" . $_POST['dataLaporan'] . "'";
    $result = mysqli_query($conn, $sql);

    $output .= '<div class="table-responsive">
                        <table class="table table-bordered">';
    foreach ($result as $row) {
        $output .= '<tr align="center">
                        <td colspan="2"><img src="img/' . $row['foto_aset'] . '" width="50%"></td>
                        </tr>
                        <tr>
                            <th width="40%">ID Laporan</th>
                            <td width="60%">' . $row['laporan_id'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Laporan Masuk</th>
                            <td width="60%">' . date("d M Y", strtotime($row['tanggal'])) . '</td>                            
                        </tr>
                        <tr>
                            <th width="40%">Kantor</th>
                            <td width="60%">' . $row['kantor'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Nama Aset</th>
                            <td width="60%">' . $row['nama_aset'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tingkat Kerusakan</th>
                            <td width="60%">' . $row['tingkat_rusak'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Prioritas</th>
                            <td width="60%">' . $row['prioritas'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Status</th>
                            <td width="60%">' . $row['status'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Tanggal Selesai</th>
                            <td width="60%">' . $row['tanggal_selesai'] . '</td>
                        </tr>
                        <tr>
                            <th width="40%">Catatan</th>
                            <td width="60%">' . $row['catatan'] . '</td>
                        </tr>
                        ';
    }
    $output .= '</table></div>';
    // Tampilkan $output
    echo $output;
}
// <td colspan="2"><img src="img/' . $row['gambar'] . '" width="50%"></td>
