<?php
require_once 'database/config.php';

if (isset($_GET['tag_no'])) {
    $tag_no = $_GET['tag_no'];

    // Hapus data pengukuran motor terlebih dahulu
    $sql_delete_pengukuran = "DELETE FROM pengukuran_motor WHERE tag_no = '$tag_no'";
    $koneksi->query($sql_delete_pengukuran); // Tidak perlu cek hasil, karena motor akan dihapus juga

    // Hapus data motor
    $sql_delete_motor = "DELETE FROM motor WHERE tag_no = '$tag_no'";

    if ($koneksi->query($sql_delete_motor) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql_delete_motor . "<br>" . $koneksi->error;
    }
} else {
    echo "Parameter tag_no tidak diberikan.";
}
?>