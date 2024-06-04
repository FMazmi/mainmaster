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
$laporan = query("SELECT * FROM laporan_main");

$message = "";
$alertType = "";
$alertIcon = "";

if (isset($_GET["laporan_id"])) {

    $id = $_GET['laporan_id'];
    $laporan_id = str_replace(' ', '', $id);


    if (hapus($laporan_id) > 0) {
        $message = "Data Gagal dihapus.";
        $alertType = "success";
        $alertIcon = "#check-circle-fill";
    } else {
        $message = "Data Gagal dihapus.";
        $alertType = "danger";
        $alertIcon = "#exclamation-triangle-fill";
    }
} else{

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


    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>

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
                    <h1 class="h3 mb-2 text-gray-800">Data Laporan Gangguan Aset</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Data Laporan Gangguan Aset</h6>
                            <a href="tambahdata.php" class="btn btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah Data</span>
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Laporan</th>
                                            <th>Tanggal</th>
                                            <th>Pelapor</th>
                                            <th>Kantor</th>
                                            <th>Kategori Kerusakan</th>
                                            <th>Prioritas</th>
                                            <th>Tombol</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID Laporan</th>
                                            <th>Tanggal</th>
                                            <th>Pelapor</th>
                                            <th>Kantor</th>
                                            <th>Kategori Kerusakan</th>
                                            <th>Prioritas</th>
                                            <th>Tombol</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach ($laporan as $row) : ?>
                                            <tr>
                                                <td> <?= $row["laporan_id"]; ?> </td>
                                                <td> <?= $row["tanggal"]; ?> </td>
                                                <td> <?= $row["pelapor"]; ?> </td>
                                                <td> <?= $row["kantor"]; ?> </td>
                                                <td> <?= $row["tingkat_rusak"]; ?> </td>
                                                <td> <?= $row["prioritas"]; ?> </td>
                                                <td>
                                                    <button class="btn btn-success btn-sm text-white detail" data-id="<?= $row['laporan_id']; ?>" style="font-weight: 600;"><i class="bi bi-info-circle-fill"></i>&nbsp;Detail</button> |

                                                    <a href="editdata.php?laporan_id= <?= $row["laporan_id"] ?>" class="btn btn-warning btn-sm" style="font-weight: 600;"><i class="bi bi-pencil-square"></i>&nbsp;Edit</a> |

                                                    <a class="btn btn-danger btn-sm" style="font-weight: 600;" data-toggle="modal" data-target="#ModalCancel"><i class="bi bi-trash-fill"></i>&nbsp;Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
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

    <!-- Modal Detail Data -->
    <div class="modal fade" id="detail" tabindex="-1" aria-labelledby="detail" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-uppercase" id="detail">Detail Data Laporan Gangguan Aset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center" id="detail-laporan">
                </div>
            </div>
        </div>
    </div>
    <!-- Close Modal Detail Data -->

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
                    Apakah Anda yakin akan menghapus Data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" name="cancel" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <a href="?laporan_id= <?= $row["laporan_id"] ?>" class="btn btn-primary" name="hapus" id="hapus">Ya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pop Up Cancel -->

    <!-- Modal Pop Up Hapus -->
    <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="alert alert-<?= $alertType ?>" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="<?= $alertIcon ?>"/></svg>
                <?= $message ?>
            </div>
        </div>
    </div>


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var message = "<?php echo $message; ?>";
            if (message.includes("success") || message.includes("danger"))  {
                $('#resultModal').modal('show');
                setTimeout(function() {
                    $('#resultModal').modal('hide');
                }, 2000);
            }
        });

        var resultModal = document.getElementById('resultModal');
        resultModal.addEventListener('hidden.bs.modal', function() {
            // Fokuskan kembali ke elemen yang sesuai setelah modal ditutup
            document.getElementById('data-table').focus();
        });
    </script>

    <script>
        var myAlert = document.getElementById('myAlert');
        if (myAlert) {
            myAlert.addEventListener('closed.bs.alert', function() {
                // Fokuskan kembali ke elemen yang sesuai
                document.getElementById('data-table').focus();
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Fungsi Table
            $('#data').DataTable();
            // Fungsi Table

            // Fungsi Detail
            $('.detail').click(function() {
                var dataLaporan = $(this).attr("data-id");
                $.ajax({
                    url: "detail.php",
                    method: "post",
                    data: {
                        dataLaporan,
                        dataLaporan
                    },
                    success: function(data) {
                        $('#detail-laporan').html(data);
                        $('#detail').modal("show");
                    }
                });
            });
            // Fungsi Detail

            $('.btn-close').click(function() {
                $('#detail').modal("hide");
            });
        });
    </script>
    
</body>

</html>