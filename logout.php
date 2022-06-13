<?php session_start();
if (isset($_SESSION['taikhoan'])){
unset($_SESSION['taikhoan']); // xóa session login
session_destroy();
header("Location: login.php");
}
?>