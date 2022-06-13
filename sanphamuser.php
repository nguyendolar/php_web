
<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>

<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Danh sách sản phẩm</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAdd">
                                Thêm mới
                            </button>
                             
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <!-- <th>Thể loại</th>
                                        <th>Mô tả</th> -->
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT * FROM products Where account_id = '{$_SESSION['id']}' ORDER BY id DESC";
                                    $result = mysqli_query($connect, $query);
                                
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel".$arUser["id"] ;
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["title"] ?></td>
                                        <td> <img height="200px" width="300px" src="<?php echo $arUser["image"] ?>"></td>
                                        <td><?php echo $arUser["price"] ?></td>
                                        <td><?php echo $arUser["quantity"] ?></td>
                                        <!-- <td><?php echo $arUser["category_id"] ?></td>
                                        <td><?php echo $arUser["description"] ?></td> -->
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelEdit ?>">
                                                Cập nhập
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDel ?>">
                                                Xóa
                                            </button>
                                            <!--Dele-->
                                            <div class="modal fade" id="<?php echo $idModelDel ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Bạn chắc chắn muốn xóa ?</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            Xe : <?php echo $arUser["ten"] ?>
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-danger" name="deleteoto"> Xóa</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Dele-->
                                        </td>

                                    </tr>
                                    <!-- Modal Update-->
                                    <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhập</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" >
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Tên xe:</label>
                                                            <input type="text" class="form-control" id="category-film" name="ten" value="<?php echo $arUser["ten"] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Ảnh:</label>
                                                            <input type="text" class="form-control" id="category-film" name="anh" value="<?php echo $arUser["anh"] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Giá:</label>
                                                            <input type="number" class="form-control" id="category-film" name="gia" value="<?php echo $arUser["gia"] ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Chi nhánh:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="chinhanh" required>
                                                                    <option value="<?php echo $arUser["chinhanh_id"] ?>" selected><?php echo $arUser["chinhanh"] ?></option>
                                                                    <?php 
                                                                    $qrcn = "SELECT * FROM chinhanh";
                                                                    $rscn = mysqli_query($connect, $qrcn);
                                                                    while($arcns = mysqli_fetch_array($rscn, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcns['id'] ?>"><?php echo $arcns['ten'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="editoto">Lưu</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST">
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Tên xe:</label>
                                                            <input type="text" class="form-control" id="category-film" name="ten" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Ảnh:</label>
                                                            <input type="text" class="form-control" id="category-film" name="anh" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Giá:</label>
                                                            <input type="number" class="form-control" id="category-film" name="gia" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="category-film"
                                                                class="col-form-label">Chi nhánh:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="chinhanh" required>
                                                                    <option value="" selected>Chọn chi nhánh</option>
                                                                    <?php  
                                                                    $qrcn = "SELECT * FROM chinhanh";
                                                                    $rscn = mysqli_query($connect, $qrcn);
                                                                    while($arcn = mysqli_fetch_array($rscn, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcn['id'] ?>"><?php echo $arcn['ten'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="addoto">Lưu </button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>