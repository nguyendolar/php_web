<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Bảng điều khiển
                        </a>
                        <?php if( $_SESSION['role'] == 1){?>
                        <a class="nav-link" href="sanphamadmin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Quản lý sản phẩm
                        </a>
                        <?php } else {?>
                        <a class="nav-link" href="sanphamuser.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Quản lý sản phẩm
                        </a>
                        <?php } ?>
                    </div>
                </div>

            </nav>
        </div>