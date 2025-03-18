<?php
require_once 'database/config.php';

if (isset($_GET['tag_no'])) {
    $tag_no = $_GET['tag_no'];

    // Ambil data motor
    $sql_motor = "SELECT * FROM motor WHERE tag_no = '$tag_no'";
    $result_motor = $koneksi->query($sql_motor);

    if ($result_motor->num_rows == 1) {
        $row_motor = $result_motor->fetch_assoc();
    } else {
        echo "Data motor tidak ditemukan.";
        exit;
    }

    // Ambil data pengukuran motor
    $sql_pengukuran = "SELECT * FROM pengukuran_motor WHERE tag_no = '$tag_no' ORDER BY tanggal DESC LIMIT 1";
    $result_pengukuran = $koneksi->query($sql_pengukuran);

    if ($result_pengukuran->num_rows == 1) {
        $row_pengukuran = $result_pengukuran->fetch_assoc();
    } else {
        $row_pengukuran = array(); // Inisialisasi array kosong jika tidak ada data pengukuran
    }
} else {
    echo "Parameter tag_no tidak diberikan.";
    exit;
}

if (isset($_POST['update_motor'])) {
    // ... (Kode update data motor seperti sebelumnya) ...
    $motor_name = $_POST['motor_name'];
    $kw = $_POST['kw'];
    $starter_type = $_POST['starter_type'];
    $speed_rpm = $_POST['speed_rpm'];
    $in_a = $_POST['in_a'];
    $voltage = $_POST['voltage'];
    $frame = $_POST['frame'];
    $prioritas_motor = $_POST['prioritas_motor'];

    $sql_update = "UPDATE motor SET 
                    motor_name = '$motor_name',
                    kw = '$kw',
                    starter_type = '$starter_type',
                    speed_rpm = '$speed_rpm',
                    in_a = '$in_a',
                    voltage = '$voltage',
                    frame = '$frame',
                    prioritas_motor = '$prioritas_motor'
                    WHERE tag_no = '$tag_no'";

    if ($koneksi->query($sql_update) === TRUE) {
        // Update data pengukuran jika ada
        if (!empty($row_pengukuran)) {
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

            $sql_update_pengukuran = "UPDATE pengukuran_motor SET 
                                        freq_hz = '$freq_hz',
                                        load_current_r = '$load_current_r',
                                        load_current_s = '$load_current_s',
                                        load_current_t = '$load_current_t',
                                        bearing_de_temp = '$bearing_de_temp',
                                        bearing_nde_temp = '$bearing_nde_temp',
                                        coil_temp = '$coil_temp',
                                        vibrasi_bearing_class2_de = '$vibrasi_bearing_class2_de',
                                        vibrasi_bearing_class2_nde = '$vibrasi_bearing_class2_nde',
                                        vibrasi_bearing_class3_de = '$vibrasi_bearing_class3_de',
                                        vibrasi_bearing_class3_nde = '$vibrasi_bearing_class3_nde'
                                        WHERE tag_no = '$tag_no' AND tanggal = '" . $row_pengukuran['tanggal'] . "'";

            if ($koneksi->query($sql_update_pengukuran) === TRUE) {
                header("Location: index.php");
                exit;
            } else {
                echo "Error update pengukuran: " . $sql_update_pengukuran . "<br>" . $koneksi->error;
            }
        } else {
            header("Location: index.php"); // Redirect jika hanya update motor
            exit;
        }
    } else {
        echo "Error update motor: " . $sql_update . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Motor</title>
    <?php include 'listlink.php'; ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
                                <h3 class="card-title">Edit Data Motor</h3>
                            </div>
                            <div class="card-body">
                                <form method="post">
                                    <div class="form-group">
                                        <label>Nama Motor</label>
                                        <input type="text" class="form-control" name="motor_name" value="<?php echo $row_motor['motor_name']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>KW</label>
                                        <input type="text" class="form-control" name="kw" value="<?php echo $row_motor['kw']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Starter Type</label>
                                        <input type="text" class="form-control" name="starter_type" value="<?php echo $row_motor['starter_type']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Speed (RPM)</label>
                                        <input type="text" class="form-control" name="speed_rpm" value="<?php echo $row_motor['speed_rpm']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>In (A)</label>
                                        <input type="text" class="form-control" name="in_a" value="<?php echo $row_motor['in_a']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Voltage</label>
                                        <input type="text" class="form-control" name="voltage" value="<?php echo $row_motor['voltage']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Frame</label>
                                        <input type="text" class="form-control" name="frame" value="<?php echo $row_motor['frame']; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Prioritas Motor</label>
                                        <input type="text" class="form-control" name="prioritas_motor" value="<?php echo $row_motor['prioritas_motor']; ?>" required>
                                    </div>

                                    <?php if (!empty($row_pengukuran)) { ?>
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Data Pengukuran</h3>
                                        </div>
                                        <div class="form-group">
                                            <label>Freq (Hz)</label>
                                            <input type="text" class="form-control" name="freq_hz" value="<?php echo $row_pengukuran['freq_hz']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Load Current R (A)</label>
                                            <input type="text" class="form-control" name="load_current_r" value="<?php echo $row_pengukuran['load_current_r']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Load Current S (A)</label>
                                            <input type="text" class="form-control" name="load_current_s" value="<?php echo $row_pengukuran['load_current_s']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Load Current T (A)</label>
                                            <input type="text" class="form-control" name="load_current_t" value="<?php echo $row_pengukuran['load_current_t']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Bearing DE Temp (°C)</label>
                                            <input type="text" class="form-control" name="bearing_de_temp" value="<?php echo $row_pengukuran['bearing_de_temp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Bearing NDE Temp (°C)</label>
                                            <input type="text" class="form-control" name="bearing_nde_temp" value="<?php echo $row_pengukuran['bearing_nde_temp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Coil Temp (°C)</label>
                                            <input type="text" class="form-control" name="coil_temp" value="<?php echo $row_pengukuran['coil_temp']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Vibrasi Bearing Class 2 DE</label>
                                            <input type="text" class="form-control" name="vibrasi_bearing_class2_de" value="<?php echo $row_pengukuran['vibrasi_bearing_class2_de']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Vibrasi Bearing Class 2 NDE</label>
                                            <input type="text" class="form-control" name="vibrasi_bearing_class2_nde" value="<?php echo $row_pengukuran['vibrasi_bearing_class2_nde']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Vibrasi Bearing Class 3 DE</label>
                                            <input type="text" class="form-control" name="vibrasi_bearing_class3_de" value="<?php echo $row_pengukuran['vibrasi_bearing_class3_de']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Vibrasi Bearing Class 3 NDE</label>
                                            <input type="text" class="form-control" name="vibrasi_bearing_class3_nde" value="<?php echo $row_pengukuran['vibrasi_bearing_class3_nde']; ?>">
                                        </div>
                                    <?php } ?>

                                    <button type="submit" name="update_motor" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <aside class="control-sidebar control-sidebar-dark"></aside>
    <?php include 'footer.php'; ?>
</div>
<?php include 'scripts.php'; ?>
</body>
</html>