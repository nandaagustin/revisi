<?php
include 'config.php';

$nama = $_POST['nama'];
$kritik = $_POST['kritik'];
$saran = $_POST['saran'];

// Proses Upload Gambar
$gambar = null;
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $targetDir = "uploads/"; // Direktori untuk menyimpan gambar
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // Buat folder jika belum ada
    }
    $fileName = basename($_FILES['gambar']['name']);
    $targetFilePath = $targetDir . time() . "_" . $fileName;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFilePath)) {
        $gambar = $targetFilePath;
    }
}

$sql = "INSERT INTO kritik_saran (nama, kritik, saran, gambar) VALUES ('$nama', '$kritik', '$saran', '$gambar')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?status_kirim=success");
} else {
    header("Location: index.php?status_kirim=error");
}
?>
