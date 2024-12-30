<?php
session_start();
include "config.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $_SESSION['admin'] = true;
    header('Location: admin.php');
    exit;
} else {
    $_SESSION['error'] = "Username atau password salah!";
    session_write_close();
    header('Location: login.php');
    exit;
}
?>
