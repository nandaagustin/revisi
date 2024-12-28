<?php
session_start();
include "config.php";
$username=$_POST['username'];
$password=$_POST['password'];
$result = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if (mysqli_num_rows($result)>0){
    $_SESSION ['admin'] = true;
    header('Location: admin.php');
}
else {
    $_SESSION['error']="Password atau Username salah";
    header('Location: login.php');
    
}
?>