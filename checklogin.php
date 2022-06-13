<?php
include('inc/connect.php');

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass  = $_POST['matkhau'];
    $query = "SELECT * FROM accounts WHERE email='$email'";
    $result = mysqli_query($connect, $query);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows == 0) {
      header("Location: login.php?fail=1");
    } 
    else {
    
      $row = mysqli_fetch_array($result);
      if ($pass != $row['password']) {
        header("Location: login.php?fail=1");
      }
      else{
        header("Location: index.php?msg=1");
        $_SESSION['taikhoan'] = $email;
        $_SESSION['hoten'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['id'] = $row['id'];
      }
    }
}
if(isset($_POST['register'])){
  $name  = $_POST['name'];
  $email  = $_POST['email'];
  $matkhau  = $_POST['matkhau'];
  $querycheck = "SELECT * FROM accounts WHERE email='$email'";
  $resultcheck = mysqli_query($connect, $querycheck);
  $num_rows = mysqli_num_rows($resultcheck);
  if ($num_rows != 0) {
    header("Location: register.php?fail=1");
  } 
  else{
    $query = "INSERT INTO accounts (email, password, name, role) VALUES ( '{$email}', '{$matkhau}', '{$name}', 2) ";
    $result = mysqli_query($connect, $query);
    header("Location: login.php?msg=1");
  }
}
 ?> 