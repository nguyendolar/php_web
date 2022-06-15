<?php
include('inc/connect.php');

if(isset($_POST['addproduct'])){
    $title = $_POST['title'];
    $price  = $_POST['price'];
    $image  = $_POST['image'];
    $quantity = $_POST['quantity'];
    $category  = $_POST['category'];
    $description  = $_POST['description'];
    $account = $_SESSION['id'];
    $query = "INSERT INTO products ( title, price, image, quantity, category_id, description, account_id ) VALUES ( '{$title}', '{$price}', '{$image}', '{$quantity}', '{$category}', '{$description}', '{$account}' ) ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      if($_SESSION['role'] == 1){
        header("Location: sanphamadmin.php?msg=1");
      } 
      else{
        header("Location: sanphamuser.php?msg=1");
      } 
    } 
}
if(isset($_POST['addimage'])){
    $id = $_POST['id'];
    $image  = $_POST['image'];
    $query = "INSERT INTO image ( product_id, image) VALUES ( '{$id}', '{$image}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
        if($_SESSION['role'] == 1){
          header("Location: sanphamadmin.php?msg=1");
        } 
        else{
          header("Location: sanphamuser.php?msg=1");
        } 
      } 
}
if(isset($_POST['editproduct'])){
    $title = $_POST['title'];
    $price  = $_POST['price'];
    $image  = $_POST['image'];
    $quantity = $_POST['quantity'];
    $category  = $_POST['category'];
    $description  = $_POST['description'];
    
    $id  = $_POST['id'];
    $query = "UPDATE `products` SET `title`='{$title}',`price`='{$price}',`image`='{$image}',`quantity`='{$quantity}',`category_id`='{$category}',`description`='{$description}',`updated_at`= CURRENT_TIMESTAMP() WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        if($_SESSION['role'] == 1){
          header("Location: sanphamadmin.php?msg=1");
        } 
        else{
          header("Location: sanphamuser.php?msg=1");
        } 
      } 
}
if(isset($_POST['deleteproduct'])){
    $id  = $_POST['id'];
    $queryimg = "DELETE FROM image WHERE `product_id`='{$id}'";
    $resultimg = mysqli_query($connect, $queryimg);
    $query = "DELETE FROM products WHERE `id`='{$id}'";
    $result = mysqli_query($connect, $query);
    if ($result) {
        if($_SESSION['role'] == 1){
          header("Location: sanphamadmin.php?msg=1");
        } 
        else{
          header("Location: sanphamuser.php?msg=1");
        } 
      } 
}
?>
