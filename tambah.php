<?php
require_once 'database/config.php';

if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $motor_name = $_POST['motor_name'];
    $tag_no = $_POST['tag_no'];
    $kw = $_POST['kw'];
    $starter_type = $_POST['starter_type'];
    $speed_rpm = $_POST['speed_rpm'];
    $in_a = $_POST['in_a'];
    $voltage = $_POST['voltage'];
    $frame = $_POST['frame'];
    $prioritas_motor = $_POST['prioritas_motor'];

    $freq_hz = $_POST['freq_hz'];
    $load_current_r = $_POST['load_current_r'];
    $load_current_s = $_POST['load_current_s'];
    $load_current_t = $_POST['load_current_t'];
    $bearing_de_temp = $_POST['bearing_de_temp'];
    $bearing_nde_temp = $_POST['bearing_nde_temp'];
    $coil_temp = $_POST['coil_temp'];
    $vibrasi_bearing_class2_de = $_POST['vibrasi_bearing_class2_de'];
    $vibrasi_bearing_class2_nde = $_POST['vibrasi_bearing_class2_nde'];
    $vibrasi_bearing_class3_de = $_POST['vibrasi_bearing_class3_de'];
    $vibrasi_bearing_class3_nde = $_POST['vibrasi_bearing_class3_nde'];

    $tanggal = $_POST['tanggal'];

    // Query untuk menambahkan data motor
    $sql_motor = "INSERT INTO motor (motor_name, tag_no, kw, starter_type, speed_rpm, in_a, voltage, frame, prioritas_motor) VALUES ('$motor_name', '$tag_no', '$kw', '$starter_type', '$speed_rpm', '$in_a', '$voltage', '$frame', '$prioritas_motor')";
    $koneksi->query($sql_motor);

    // Query untuk menambahkan data pengukuran motor
    $sql_pengukuran = "INSERT INTO pengukuran_motor (tag_no, freq_hz, load_current_r, load_current_s, load_current_t, bearing_de_temp, bearing_nde_temp, coil_temp, vibrasi_bearing_class2_de, vibrasi_bearing_class2_nde, tanggal, vibrasi_bearing_class3_de, vibrasi_bearing_class3_nde) VALUES ('$tag_no', '$freq_hz', '$load_current_r', '$load_current_s', '$load_current_t', '$bearing_de_temp', '$bearing_nde_temp', '$coil_temp', '$vibrasi_bearing_class2_de', '$vibrasi_bearing_class2_nde', '$tanggal', '$vibrasi_bearing_class3_de', '$vibrasi_bearing_class3_nde')";
    $koneksi->query($sql_pengukuran);

    // Redirect ke index.php
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Data Motor</title>
    <?php include 'listlink.php'; ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/
    dist/umd/popper.min.js"></script>
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
                                <h3 class="card-title">Tambah Data Motor</h3>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Nama Motor</label>
                                        <input type="text" class="form-control" name="motor_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tag Nomor</label>
                                        <input type="text" class="form-control" name="tag_no" required>
                                    </div>
                                    <div class="form-group">
                                        <label>KW</label>
                                        <input type="text" class="form-control" name="kw" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Starter Type</label>
                                        <input type="text" class="form-control" name="starter_type" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Speed (RPM)</label>
                                        <input type="text" class="form-control" name="speed_rpm" required>
                                    </div>
                                    <div class="form-group">
                                        <label>In (A)</label>
                                        <input type="text" class="form-control" name="in_a" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Voltage</label>
                                        <input type="text" class="form-control" name="voltage" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Frame</label>
                                        <input type="text" class="form-control" name="frame" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Prioritas Motor</label>
                                        <input type="text" class="form-control" name="prioritas_motor" required>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label>Freq (Hz)</label>
                                        <input type="text" class="form-control" name="freq_hz" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Load Current R (A)</label>
                                        <input type="text" class="form-control" name="load_current_r" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Load Current S (A)</label>
                                        <input type="text" class="form-control" name="load_current_s" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Load Current T (A)</label>
                                        <input type="text" class="form-control" name="load_current_t" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Bearing DE Temp (°C)</label>
                                        <input type="text" class="form-control" name="bearing_de_temp" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Bearing NDE Temp (°C)</label>
                                        <input type="text" class="form-control" name="bearing_nde_temp" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Coil Temp (°C)</label>
                                        <input type="text" class="form-control" name="coil_temp" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Vibrasi Bearing Class 2 DE</label>
                                        <input type="text" class="form-control" name="vibrasi_bearing_class2_de" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Vibrasi Bearing Class 2 NDE</label>
                                        <input type="text" class="form-control" name="vibrasi_bearing_class2_nde" required>
                                    </div>
                                    <div class="form-group">
                                    <label>Vibrasi Bearing Class 3 DE</label>
                                    <input type="number" step="0.01" class="form-control" name="vibrasi_bearing_class3_de" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Vibrasi Bearing Class 3 NDE</label>
                                        <input type="number" step="0.01" class="form-control" name="vibrasi_bearing_class3_nde" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input type="date" class="form-control" name="tanggal" required>
                                    </div>

                                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                </form>
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

</body>
</html>