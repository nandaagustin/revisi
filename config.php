<?php
$host="localhost";
$user="root";
$password="";
$db="kritik_saran";
$conn=mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno()) {
    echo "Database Gagal Terhubung!";

}
?>