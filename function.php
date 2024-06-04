<?php

$conn = mysqli_connect("localhost", "root", "", "mainmaster");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getNomorUrutanMasukanLaporan()
{
    global $conn;

    // Query untuk mendapatkan nomor urutan terakhir pada tanggal ini
    $query = "SELECT COUNT(*) AS jumlah FROM laporan_main WHERE tgl_ubah = CURDATE()";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Nomor urutan untuk hari ini
    $nomor_urutan = $row['jumlah'] + 1;

    return $nomor_urutan;
}

function tambah($data)
{
    global $conn;

    $pelapor = htmlspecialchars($data["pelapor"]);
    $tanggal = date("Y-m-d");
    $kantor = htmlspecialchars($data["kantor"]);
    $nama_aset = htmlspecialchars($data["nama_aset"]);
    $foto_aset = upload();
    $permasalahan = htmlspecialchars($data["permasalahan"]);
    $tingkat_rusak = htmlspecialchars($data["tingkat_rusak"]);
    $prioritas = htmlspecialchars($data["prioritas"]);
    $tindakan = htmlspecialchars($data["tindakan"]);
    $status = htmlspecialchars($data["status"]);
    $tanggal_selesai = "";
    $catatan = "";

    $singkatanKantor = substr($kantor, 0, 2);
    // Mengubah format tanggal menjadi YYMMDD
    $nomor_urutan = getNomorUrutanMasukanLaporan();
    $formatno = sprintf("%02d", $nomor_urutan);
    $tanggalYYMMDD = date("ymd", strtotime($tanggal));


    // Menggabungkan singkatan kantor dan tanggal untuk membentuk ID
    $laporan_id = $singkatanKantor . $tanggalYYMMDD . $formatno;

    

    $query = "INSERT INTO laporan_main (laporan_id, no, pelapor, kantor, nama_aset, foto_aset, permasalahan, tingkat_rusak, prioritas, tindakan, status, tanggal_selesai, catatan) VALUES 
    ('$laporan_id', '$nomor_urutan', '$pelapor', '$kantor', '$nama_aset', '$foto_aset', '$permasalahan', '$tingkat_rusak', '$prioritas', '$tindakan', '$status', '$tanggal_selesai', '$catatan')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function jumlahBelum()
{
    global $conn;

    $query = "SELECT COUNT(*) AS jumlah FROM laporan_main WHERE status = 'Belum'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Mengambil nilai jumlah dari hasil query
    $jumlahBelum = $row['jumlah'];

    return $jumlahBelum;
}
function jumlahSelesai()
{
    global $conn;

    $query = "SELECT COUNT(*) AS jumlah FROM laporan_main WHERE status = 'Selesai'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Mengambil nilai jumlah dari hasil query
    $jumlahSelesai = $row['jumlah'];

    return $jumlahSelesai;
}
function jumlahKendala()
{
    global $conn;

    $query = "SELECT COUNT(*) AS jumlah FROM laporan_main WHERE status = 'Terkendala'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Mengambil nilai jumlah dari hasil query
    $jumlahKendala = $row['jumlah'];

    return $jumlahKendala;
}
function jumlahPengadaan()
{
    global $conn;

    $query = "SELECT COUNT(*) AS jumlah FROM laporan_main WHERE status = 'Pengadaan Baru'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    // Mengambil nilai jumlah dari hasil query
    $jumlahPengadaan = $row['jumlah'];

    return $jumlahPengadaan;
}



function upload()
{
    // Syarat
    $namaFile = $_FILES['foto_aset']['name'];
    $ukuranFile = $_FILES['foto_aset']['size'];
    $error = $_FILES['foto_aset']['error'];
    $tmpName = $_FILES['foto_aset']['tmp_name'];

    // Jika tidak mengupload foto_aset atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    // if ($error === 4) {
    //     echo "<script>alert('Pilih foto_aset terlebih dahulu!');</script>";
    //     return false;
    // }

    // format atau ekstensi yang diperbolehkan untuk upload foto_aset adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // Jika ukuran foto_aset lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran foto_aset anda terlalu besar!');</script>";
        return false;
    }

    // nama foto_aset akan berubah angka acak/unik jika sudah berhasil tersimpan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan nama baru
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}



function hapus($laporan_id){
    global $conn;
    mysqli_query($conn, "DELETE FROM laporan_main WHERE laporan_id = '$laporan_id'");

    return mysqli_affected_rows($conn);
}


function ubah($data){
    global $conn;    
    
    $laporan_id = $data["laporan_id"];
    $tindakan = htmlspecialchars($data["tindakan"]);
    $status = htmlspecialchars($data["status"]);
    $dateTime = new DateTime($data['tanggal_selesai']);
    $tanggal_selesai = $dateTime->format('Y-m-d H:i:s');;
    $catatan = $data["catatan"];

    

    $query = "UPDATE laporan_main SET
                    tindakan = '$tindakan',
                    status = '$status',
                    tanggal_selesai = '$tanggal_selesai',
                    catatan = '$catatan'
              WHERE laporan_id = '$laporan_id';
            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
