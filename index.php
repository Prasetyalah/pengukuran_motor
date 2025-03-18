<?php
require_once 'database/config.php';

// Ambil data motor
$sql_motor = "SELECT * FROM motor";
$result_motor = $koneksi->query($sql_motor);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengukuran Motor</title>
    <?php include 'listlink.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <?php include 'navbar.php'; ?>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
            <img src="img/logomotor.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Pengukuran Motor</span>
        </a>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Daftar Motor</h3>
                            </div>
                            <div class="card-body">
                            <a href="tambah.php" class="btn btn-success btn-sm mb-3">Tambah Data</a>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Motor</th>
                                            <th>Tag Nomor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result_motor->num_rows > 0) {
                                            while ($row_motor = $result_motor->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row_motor['motor_name'] . "</td>";
                                                echo "<td>" . $row_motor['tag_no'] . "</td>";
                                                echo "<td>";
                                                echo "<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#spesifikasiModal" . $row_motor['tag_no'] . "'>Spesifikasi</button>";
                                                echo "<button type='button' class='btn btn-info btn-sm ml-2' data-toggle='modal' data-target='#pengukuranModal" . $row_motor['tag_no'] . "'>Pengukuran</button>";
                                                echo "<a href='edit.php?tag_no=" . $row_motor['tag_no'] . "' class='btn btn-warning btn-sm ml-2'>Edit</a>";
                                                echo "<a href='hapus.php?tag_no=" . $row_motor['tag_no'] . "' class='btn btn-danger btn-sm ml-2' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                                                echo "</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='3'>Tidak ada data motor.</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php
                                $result_motor->data_seek(0); // Reset pointer result
                                while ($row_motor = $result_motor->fetch_assoc()) {
                                    ?>
                                    <div class="modal fade" id="spesifikasiModal<?php echo $row_motor['tag_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="spesifikasiModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="spesifikasiModalLabel">Spesifikasi Motor <?php echo $row_motor['motor_name']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>KW:</strong> <?php echo $row_motor['kw']; ?></p>
                                                    <p><strong>Starter Type:</strong> <?php echo $row_motor['starter_type']; ?></p>
                                                    <p><strong>Speed (RPM):</strong> <?php echo $row_motor['speed_rpm']; ?></p>
                                                    <p><strong>In (A):</strong> <?php echo $row_motor['in_a']; ?></p>
                                                    <p><strong>Voltage:</strong> <?php echo $row_motor['voltage']; ?></p>
                                                    <p><strong>Frame:</strong> <?php echo $row_motor['frame']; ?></p>
                                                    <p><strong>Prioritas Motor:</strong> <?php echo $row_motor['prioritas_motor']; ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="pengukuranModal<?php echo $row_motor['tag_no']; ?>" tabindex="-1" role="dialog" aria-labelledby="pengukuranModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="pengukuranModalLabel">Pengukuran Motor <?php echo $row_motor['motor_name']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                    $tag_no = $row_motor['tag_no'];
                                                    $sql_pengukuran = "SELECT * FROM pengukuran_motor WHERE tag_no = '$tag_no' ORDER BY tanggal DESC LIMIT 1";
                                                    $result_pengukuran = $koneksi->query($sql_pengukuran);
                                                    $pengukuran = $result_pengukuran->fetch_assoc();
                                                    
                                                    if ($pengukuran) { ?>
                                                        <p><strong>Tanggal:</strong> <?php echo $pengukuran['tanggal']; ?></p>
                                                        <p><strong>Freq (Hz):</strong> <?php echo $pengukuran['freq_hz']; ?></p>
                                                        <p><strong>Load Current R (A):</strong> <?php echo $pengukuran['load_current_r']; ?></p>
                                                        <p><strong>Load Current S (A):</strong> <?php echo $pengukuran['load_current_s']; ?></p>
                                                        <p><strong>Load Current T (A):</strong> <?php echo $pengukuran['load_current_t']; ?></p>
                                                        <p><strong>Bearing DE Temp (°C):</strong> <?php echo $pengukuran['bearing_de_temp']; ?></p>
                                                        <p><strong>Bearing NDE Temp (°C):</strong> <?php echo $pengukuran['bearing_nde_temp']; ?></p>
                                                        <p><strong>Coil Temp (°C):</strong> <?php echo $pengukuran['coil_temp']; ?></p>
                                                        <p><strong>Vibrasi Bearing Class 2 DE:</strong> <?php echo $pengukuran['vibrasi_bearing_class2_de']; ?></p>
                                                        <p><strong>Vibrasi Bearing Class 2 NDE:</strong> <?php echo $pengukuran['vibrasi_bearing_class2_nde']; ?></p>
                                                        <p><strong>Vibrasi Bearing Class 3 DE:</strong> <?php echo $pengukuran['vibrasi_bearing_class3_de']; ?></p>
                                                        <p><strong>Vibrasi Bearing Class 3 NDE:</strong> <?php echo $pengukuran['vibrasi_bearing_class3_nde']; ?></p>
                                                    <?php } else { ?>
                                                        <p>Tidak ada data pengukuran untuk motor ini.</p>
                                                    <?php } ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <?php include 'footer.php'; ?>
</div>

<?php include 'scripts.php'; ?>

<script>
    $(function () {
        if ($.fn.DataTable.isDataTable('#example1')) {
            $('#example1').DataTable().destroy();
        }

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>