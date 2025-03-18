<?php
require_once 'database/config.php';

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM pengukuran_motor WHERE no = $id";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect kembali ke index.php
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<?php
require_once 'database/config.php';

// Edit Data (Formulir)
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $freq_hz = $_POST['freq_hz'];
    $load_current_r = $_POST['load_current_r'];
    $load_current_s = $_POST['load_current_s'];
    $load_current_t = $_POST['load_current_t'];
    $bearing_de_temp = $_POST['bearing_de_temp'];
    $bearing_nde_temp = $_POST['bearing_nde_temp'];
    $coil_temp = $_POST['coil_temp'];
    $vibrasi_bearing_class2_de = $_POST['vibrasi_bearing_class2_de'];
    $vibrasi_bearing_class2_nde = $_POST['vibrasi_bearing_class2_nde'];
    $tanggal = $_POST['tanggal'];

    $sql = "UPDATE pengukuran_motor SET 
                freq_hz = '$freq_hz',
                load_current_r = '$load_current_r',
                load_current_s = '$load_current_s',
                load_current_t = '$load_current_t',
                bearing_de_temp = '$bearing_de_temp',
                bearing_nde_temp = '$bearing_nde_temp',
                coil_temp = '$coil_temp',
                vibrasi_bearing_class2_de = '$vibrasi_bearing_class2_de',
                vibrasi_bearing_class2_nde = '$vibrasi_bearing_class2_nde',
                tanggal = '$tanggal'
            WHERE no = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect kembali ke index.php
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>