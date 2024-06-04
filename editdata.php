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

$id = $_GET['laporan_id'];
$laporan_id = str_replace(' ', '', $id);

$data = query("SELECT * FROM laporan_main WHERE laporan_id='$laporan_id' ")[0];

if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "
        <script>
            alert('Data Berhasil Diubah!');
            document.location.href = 'datalaporan.php';
        </script>        
        ";
    } else {
        echo "
        <script>
            alert('dData Gagal Diubah!');
            document.location.href = 'datalaporan.php';
        </script>  
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainMaster - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Bootstrap Detail Laporan -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include 'navbar.php'; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Halaman Edit Data Laporan</h1>

                    <!-- Container Data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"> Edit Data Laporan ID - <?= $data['laporan_id'] ?></h6>
                            <a class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#ModalCancel">
                                <span class="icon text-white-50">
                                    <i class="fas fa-angle-left"></i>
                                </span>
                                <span class="text">Kembali</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">

                                <div class="panel panel-default">
                                    <form action="" role="form" method="post">
                                        <table class="table">
                                            <input type="hidden" name="laporan_id" value="<?= $data['laporan_id'] ?>">
                                            <tr align="center">
                                                <td colspan="3">
                                                    <img src="img/<?= $data['foto_aset'] ?>" alt="" width="20%">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th width="20%">Nama Aset</th>
                                                <td colspan="2" width="80%"><input class="form-control" type="text" disabled="" value="<?= $data['nama_aset'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th width="20%">Pelapor</th>
                                                <td colspan="2" width="80%"><input class="form-control" type="text" disabled="" value="<?= $data['pelapor'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th width="20%">Kantor</th>
                                                <td colspan="2" width="80%"><input class="form-control" type="text" disabled="" value="<?= $data['kantor'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th width="20%">Tanggal</th>
                                                <td colspan="2" width="80%"><input class="form-control" disabled="" value="<?= strftime("%A, %e %B %Y %H:%M:%S", strtotime($data['tanggal'])) ?>"></td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>Tingkat Kerusakan<input class="form-control" type="text" disabled="" value="<?= $data['tingkat_rusak'] ?>"> </td>
                                                <td>Prioritas Perbaikan<input class="form-control" type="text" disabled="" value="<?= $data['prioritas'] ?>"></td>
                                            </tr>
                                            <tr>
                                                <th width="20%">Permasalahan</th>
                                                <td colspan="2" rowspan="2" width="80%"><input name="Permasalahan" class="form-control" style="height: 160px;" type="text" disabled="" value="<?= $data['permasalahan'] ?>"></td>
                                            </tr>

                                            <tr>
                                            </tr>

                                            <tr>
                                                <th></th>
                                                <td><label for="tindakan">Tindakan</label>
                                                    <select class="form-control form-select" name="tindakan" id="tindakan">
                                                        <option value="belum">Pilih Perbaikan Oleh</option>
                                                        <option value="Tim Maintenance">Tim Maintenance</option>
                                                        <option value="Vendor">Vendor</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <label for="status">Status</label>
                                                    <select class="form-control form-select" name="status" id="status">
                                                        <option value="Belum">Belum</option>
                                                        <option value="Selesai">Selesai</option>
                                                        <option value="Terkendala">Terkedendala</option>
                                                        <option value="Pengadaan Baru">Pengadaan Baru</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Selesai</th>
                                                <th colspan="2"><input class="form-control" type="datetime-local" name="tanggal_selesai"></th>
                                            </tr>
                                            <tr>
                                                <th width="20%">Catatan</th>
                                                <td colspan="2"><textarea class="form-control" rows="3" name="catatan"></textarea></td>
                                            </tr>
                                        </table>
                                        <button type="submit" name="submit" class="btn btn-outline-primary" data-toggle="modal" data-target="#ModalSave">Submit</button>
                                        <button type="reset" class="btn btn-outline-danger">Reset</button>
                                    </form>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->

                                <!-- /.col-lg-12 -->
                                <!-- Modal Pop Up Cancel -->
                                <div class="modal fade" id="ModalCancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perhatian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin akan keluar halaman ini?
                                                <span>Jika anda keluar data yang sudah diinput akan hilang</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                <button class="btn btn-primary" onclick="history.back()">Ya</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Pop Up Cancel -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Genairs-MBKM-06 2024</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <script>
        $(document).ready(function() {
            $('#ModalSave').modal('show'); // Membuka modal ketika halaman dimuat
        });
    </script>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>