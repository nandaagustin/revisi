<?php
include 'config.php';
$nama = $_POST['nama'];
$kritik = $_POST['kritik'];
$saran = $_POST['saran'];

$sql = "INSERT INTO kritik_saran (nama, kritik, saran) VALUES ('$nama', '$kritik', '$saran')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?status_kirim=success");
} else {
    header("Location: index.php?status_kirim=error");
}
?>