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

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Data berhasil Ditambahkan!');
            document.location.href = 'datalaporan.php';
        </script>        
        ";
    } else {
        echo "
        <script>
            alert('Data gagal Ditambahkan!');
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
    <link href="css/sweetalert2.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">


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
                    <h1 class="h3 mb-2 text-gray-800">Halaman Tambah Data Laporan</h1>

                    <!-- Container Data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"> Tambah Data Laporan Gangguan Aset</h6>
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
                                    <div class="panel-body">
                                        <div class="row">

                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label for="pelapor">Pelapor</label>
                                                    <input class="form-control" placeholder="Nama Pelapor" name="pelapor" id="pelapor">
                                                </div>

                                                <div class="form-group">

                                                    <label for="tanggal">Tanggal</label>
                                                    <?php
                                                    date_default_timezone_set("Asia/Jakarta");
                                                    $currentDateTime = date("Y-m-d\TH:i");
                                                    ?>

                                                    <input class="form-control" type="datetime-local" name="tanggal" id="tanggal" value="<?php echo $currentDateTime ?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="kantor">Kantor</label>
                                                    <select class="form-control form-select" name="kantor" id="kantor" required>
                                                        <option disabled selected value>Pilih Kantor</option>
                                                        <option value="KADIPIRO">Kadipiro</option>
                                                        <option value="UNU">UNU</option>
                                                        <option value="MEJING">Mejing</option>
                                                        <option value="SAWITSARI">Sawitsari</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_aset">Aset</label>
                                                    <input class="form-control" placeholder="Nama Aset" name="nama_aset" id="nama_aset">
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label for="foto_aset">Foto Item</label>
                                                    <input class="form-control" type="file" name="foto_aset" id="foto_aset">
                                                </div> -->
                                                <div class="form-group">
                                                    <label for="foto_aset" class="form-label">Foto Aset</label>
                                                    <input class="form-control form-control-sm w-50" id="foto_aset" name="foto_aset" type="file">
                                                </div>
                                                <div class="form-group">
                                                    <label for="permasalahan">Permasalahan</label>
                                                    <textarea class="form-control" rows="3" name="permasalahan" id="permasalahan"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tingkat_rusak">Tingkat Kerusakan</label>
                                                    <select class="form-control form-select" name="tingkat_rusak" id="tingkat_rusak" required>
                                                        <option disabled selected value>Pilih Tingkat Kerusakan</option>
                                                        <option value="Rusak Ringan">Rusak Ringan</option>
                                                        <option value="Rusak Sedang">Rusak Sedang</option>
                                                        <option value="Rusak Berat">Rusak Berat</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prioritas">Priotitas Perbaikan</label>
                                                    <select class="form-control form-select" name="prioritas" id="prioritas" required>
                                                        <option disabled selected value>Pilih Prioritas</option>
                                                        <option value="Not Urgent">Not Urgent</option>
                                                        <option value="Urgent">Urgent</option>
                                                        <option value="Very Urgent">Very Urgent</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tindakan">Tindakan</label>
                                                    <select class="form-control form-select" name="tindakan" id="tindakan">
                                                        <option value="belum">Pilih Perbaikan Oleh</option>
                                                        <option value="Tim Maintenance">Tim Maintenance</option>
                                                        <option value="Vendor">Vendor</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control form-select" name="status" id="status">
                                                        <option value="Belum">Belum</option>
                                                        <option value="Selesai">Selesai</option>
                                                        <option value="Terkendala">Terkedendala</option>
                                                        <option value="Pengadaan Baru">Pengadaan Baru</option>
                                                    </select>
                                                </div>
                                                <button type="submit" name="submit" class="btn btn-outline-primary">Submit</button>
                                                <button type="submit" name="reset" class="btn btn-outline-danger">Reset</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested)
                                    data-toggle="modal" data-target="#ModalSave"
                                    -->

                                        <!-- <div class="col-lg-6">
                                                    <h1>Disabled Form States</h1>
                                                    <form role="form">
                                                        <fieldset disabled="">
                                                            <div class="form-group">
                                                                <label for="disabledSelect">Disabled input</label>
                                                                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input" disabled="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="disabledSelect">Disabled select menu</label>
                                                                <select id="disabledSelect" class="form-control">
                                                                    <option>Disabled select</option>
                                                                </select>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    <input type="checkbox">Disabled Checkbox
                                                                </label>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Disabled Button</button>
                                                        </fieldset>
                                                    </form>
                                                    <h1>Form Validation States</h1>
                                                    <form role="form">
                                                        <div class="form-group has-success">
                                                            <label class="control-label" for="inputSuccess">Input with success</label>
                                                            <input type="text" class="form-control" id="inputSuccess">
                                                        </div>
                                                        <div class="form-group has-warning">
                                                            <label class="control-label" for="inputWarning">Input with warning</label>
                                                            <input type="text" class="form-control" id="inputWarning">
                                                        </div>
                                                        <div class="form-group has-error">
                                                            <label class="control-label" for="inputError">Input with error</label>
                                                            <input type="text" class="form-control" id="inputError">
                                                        </div>
                                                    </form>
                                                </div> -->
                                        <!-- /.col-lg-6 (nested) -->

                                        <!-- /.row (nested) -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->

                                <!-- /.col-lg-12 -->
                                <!-- Modal Pop Up Save -->
                                <div class="modal fade" id="ModalSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Perhatian</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalMessage">
                                                <!-- Pesan akan diisi melalui JavaScript -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirect()">OK!</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Pop Up Save -->
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
                                                <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
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
    <script src='js/sweetalert2.all.min.js'></script>

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