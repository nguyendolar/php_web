
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
                                        <th>#</th>
                                        <th>Tên sản phẩm</th>
                                        <th >Ảnh</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Danh mục</th>
                                        <th>Người dùng</th>
                                        <th>Mô tả</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT a.*,b.name,c.role,c.name as 'accountname' FROM products as a, category as b, accounts as c Where a.category_id = b.id AND a.account_id = c.id ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                        $idModelDel = "exampleModalDel".$arUser["id"] ;
                                        $idModelEdit = "exampleModalEdit".$arUser["id"];
                                        $idModelDes = "exampleModalDes".$arUser["id"];
                                        $idModelAddImg = "exampleModalAddImg".$arUser["id"];
                                    ?>
                                    <tr>
                                        <td style="width : 5px !important "><?php echo $stt ?></td>
                                        <td><?php echo $arUser["title"] ?></td>
                                        <td style="width : 210px !important "> <img height="150" width="200" src="<?php echo $arUser["image"] ?>">
                                            <?php 
                                                $qrimg = "SELECT * FROM image WHERE product_id = '{$arUser["id"]}'";
                                                $rsimg = mysqli_query($connect, $qrimg);
                                                while($arimg = mysqli_fetch_array($rsimg, MYSQLI_ASSOC)) { ?>
                                                <img height="150" width="200" style="margin-top : 5px" src="<?php echo $arimg["image"] ?>">
                                            <?php } ?>
                                        </td>
                                        <td style="width : 120px !important "><?php echo $arUser["price"] ?>đ</td>
                                        <td style="width : 20px !important "><?php echo $arUser["quantity"] ?></td>
                                        <td style="width : 130px !important "><?php echo $arUser["name"] ?></td>
                                        <td style="width : 110px !important "><?php echo $arUser["accountname"] ?></td>
                                        <td>
                                        <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDes ?>">
                                                Xem
                                        </a>
                                        </td>
                                        <!--Xem mô tả-->
                                        <div class="modal fade" id="<?php echo $idModelDes ?>" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo $arUser["title"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                        <?php echo $arUser["description"] ?>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Xem mô tả-->
                                        <?php if($arUser["role"] == 1 && $arUser["account_id"] != $_SESSION['id'] ){?>
                                            <td style="width : 230px !important ">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDel ?>">
                                                Xóa
                                            </button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelAddImg ?>">
                                                Thêm ảnh
                                            </button>
                                            
                                            <!--Xóa-->
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
                                                            Sản phẩm : <?php echo $arUser["title"] ?>
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-danger" name="deleteproduct"> Xóa</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Xóa-->
                                            <!--Thêm ảnh-->
                                            <div class="modal fade" id="<?php echo $idModelAddImg ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thêm ảnh cho sản phẩm : <?php echo $arUser["title"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="mb-3">
                                                                    <label for="category-film"
                                                                        class="col-form-label">Ảnh:</label>
                                                                    <input type="text" class="form-control" id="category-film" name="image" required>
                                                                </div>
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-warning" name="addimage"> Thêm</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Thêm ảnh-->
                                        </td>
                                            <?php } else{ ?>
                                        <td style="width : 230px !important ">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelEdit ?>">
                                                Sửa
                                            </button>
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelDel ?>">
                                                Xóa
                                            </button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#<?php echo $idModelAddImg ?>">
                                                Thêm ảnh
                                            </button>
                                            
                                            <!--Xóa-->
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
                                                            Sản phẩm : <?php echo $arUser["title"] ?>
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-danger" name="deleteproduct"> Xóa</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Xóa-->
                                            <!--Thêm ảnh-->
                                            <div class="modal fade" id="<?php echo $idModelAddImg ?>" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Thêm ảnh cho sản phẩm : <?php echo $arUser["title"] ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <form action="function.php" method="post">
                                                                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                                <div class="mb-3">
                                                                    <label for="category-film"
                                                                        class="col-form-label">Ảnh:</label>
                                                                    <input type="text" class="form-control" id="category-film" name="image" required>
                                                                </div>
                                                                <div class="modal-footer" style="margin-top: 20px">
                                                                    <button style="width:100px" type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">
                                                                        Đóng
                                                                    </button>
                                                                    <button style="width:100px" type="submit" class="btn btn-warning" name="addimage"> Thêm</button>

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--Thêm ảnh-->
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <!-- Sửa-->
                                    <div class="modal fade" id="<?php echo $idModelEdit ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cập nhập</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" >
                                                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $arUser["id"] ?>">
                                                        <div class="col">
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Tên sản phẩm:</label>
                                                        <input type="text" class="form-control" id="category-film" name="title" value="<?php echo $arUser["title"] ?>" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Giá:</label>
                                                        <input type="number" class="form-control" id="category-film" name="price" value="<?php echo $arUser["price"] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Ảnh:</label>
                                                               <input type="text" class="form-control" id="category-film" name="image" value="<?php echo $arUser["image"] ?>" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Số lượng:</label>
                                                        <input type="number" class="form-control" id="category-film" name="quantity" value="<?php echo $arUser["quantity"] ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-12 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Danh mục:</label>
                                                               <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="category" required>
                                                                    <option value="<?php echo $arUser["category_id"] ?>" selected><?php echo $arUser["name"] ?></option>
                                                                    <?php  
                                                                    $qrcn = "SELECT * FROM category WHERE level = 0";
                                                                    $rscn = mysqli_query($connect, $qrcn);
                                                                    while($arcn = mysqli_fetch_array($rscn, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcn['id'] ?>"><?php echo $arcn['name'] ?></option>
                                                                    <?php  
                                                                    $qrcncon = "SELECT * FROM category WHERE level = '{$arcn['id']}'";
                                                                    $rscncon = mysqli_query($connect, $qrcncon);
                                                                    while($arcncon = mysqli_fetch_array($rscncon, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcncon['id'] ?>">--- <?php echo $arcncon['name'] ?></option>
                                                                    
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Mô tả:</label>
                                                        <textarea class="form-control"  name="description" rows="4" required><?php echo $arUser["description"] ?> </textarea>      
                                                    </div>
                                                </div>
                                            </div> 
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="editproduct">Lưu</button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sửa-->
                                    <?php $stt++;} ?>
                                    <!-- Thêm -->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST">
                                                    <div class="col">
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Tên sản phẩm:</label>
                                                        <input type="text" class="form-control" id="category-film" name="title" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Giá:</label>
                                                        <input type="number" class="form-control" id="category-film" name="price" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Ảnh:</label>
                                                               <input type="text" class="form-control" id="category-film" name="image" required>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Số lượng:</label>
                                                        <input type="number" class="form-control" id="category-film" name="quantity" required>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="col-12 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Danh mục:</label>
                                                               <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="category" required>
                                                                    <option value="" selected>Chọn danh mục</option>
                                                                    <?php  
                                                                    $qrcn = "SELECT * FROM category WHERE level = 0";
                                                                    $rscn = mysqli_query($connect, $qrcn);
                                                                    while($arcn = mysqli_fetch_array($rscn, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcn['id'] ?>"><?php echo $arcn['name'] ?></option>
                                                                    <?php  
                                                                    $qrcncon = "SELECT * FROM category WHERE level = '{$arcn['id']}'";
                                                                    $rscncon = mysqli_query($connect, $qrcncon);
                                                                    while($arcncon = mysqli_fetch_array($rscncon, MYSQLI_ASSOC)) { ?>
                                                                    <option value="<?php echo $arcncon['id'] ?>">--- <?php echo $arcncon['name'] ?></option>
                                                                    
                                                                    <?php } ?>
                                                                    <?php } ?>
                                                                </select>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mb-3">
                                                        <label for="category-film"
                                                               class="col-form-label">Mô tả:</label>
                                                        <textarea class="form-control"  name="description" rows="4" required> </textarea>      
                                                    </div>
                                                </div>
                                            </div> 
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="addproduct">Lưu </button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Thêm-->
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