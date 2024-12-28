<?php
include 'config.php';
$id=$_POST ['id'];
$balasan=$_POST ['balasan'];
$sql="UPDATE kritik_saran set balasan = '$balasan' WHERE id='$id'";
if (mysqli_query($conn, $sql)){
    header('Location: admin.php');
}
else {
  $_SESSION['error']="Password atau Username salah";
  header('Location: login.php');
    
}
?>