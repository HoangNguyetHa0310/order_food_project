<!-- ADMIN NAVBAR HEADER -->

<header class="headerMenu сlearfix sb-page-header">
    <div class="nav-header">
        <a class="navbar-brand font-weight-bold" href="#">
            Chào Mừng Phan Hoang !
        </a>
    </div>

    <div class="nav-controls top-nav">
        <ul class="nav top-menu">
            <li id="user-btn" class="main-li dropdown" style="background:none;">
                <div class="dropdown show">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        <span class="username">Chỉnh sửa và cài đặt</span>
                        <b class="caret"></b>
                    </a>
                    <!-- DROPDOWN MENU -->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="users.php?do=Edit&user_id=<?php echo $_SESSION['userid_restaurant_qRewacvAqzA'] ?>">
                            <i class="fas fa-user-cog"></i>
                            <span style="padding-left:6px">
                                Chỉnh sửa Hồ sơ
                            </span>
                        </a>
                        <a class="dropdown-item" href="website-settings.php">
                            <i class="fas fa-cogs"></i>
                            <span style="padding-left:6px">
                                Cài đặt Trang web
                            </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">
                            <i class="fas fa-sign-out-alt"></i>
                            <span style="padding-left:6px">
                                Đăng xuất
                            </span>
                        </a>
                    </div>
                </div>
            </li>
            <li class="main-li webpage-btn">
                <a class="nav-item-button " href="../" target="_blank">
                    <i class="fas fa-eye"></i>
                    <span>Xem trang web</span>
                </a>
            </li>
        </ul>
    </div>
</header>

<!-- VERTICAL NAVBAR -->

<aside class="vertical-menu" id="vertical-menu">
    <div>
        <ul class="menu-bar">
            <div class="sidenav-menu-heading">
                Tất cả Danh mục
            </div>

            <div class="dropdown-divider"></div>

            <li>
                <a href="dashboard.php" class="a-verMenu dashboard_link">
                    <i class="fas fa-tachometer-alt icon-ver"></i>
                    <span style="padding-left:6px;">Bảng điều khiển</span>
                </a>
            </li>

            <div class="dropdown-divider"></div>

            <div class="sidenav-menu-heading">
                Thực đơn
            </div>

            <div class="dropdown-divider"></div>

            <li>
                <a href="menu_categories.php" class="a-verMenu menu_categories_link">
                    <i class="fas fa-list icon-ver"></i>
                    <span style="padding-left:6px;">Danh mục thực đơn</span>
                </a>
            </li>
            <li>
                <a href="menus.php" class="a-verMenu menus_link">
                    <i class="fas fa-utensils icon-ver"></i>
                    <span style="padding-left:6px;">Thực đơn</span>
                </a>
            </li>
            <li>
                <a href="gallery.php" class="a-verMenu gallery_link">
                    <i class="far fa-image icon-ver"></i>
                    <span style="padding-left:6px;">Đặc trưng nổi bật</span>
                </a>
            </li>

            <div class="dropdown-divider"></div>

            <div class="sidenav-menu-heading">
                Khách hàng & Nhân viên
            </div>

            <div class="dropdown-divider"></div>

            <li>
                <a href="clients.php" class="a-verMenu clients_link">
                    <i class="far fa-address-card icon-ver"></i>
                    <span style="padding-left:6px;">Khách hàng</span>
                </a>
            </li>
            <li>
                <a href="users.php" class="a-verMenu users_link">
                    <i class="far fa-user icon-ver"></i>
                    <span style="padding-left:6px;">Người dùng</span>
                </a>
            </li>


            <div class="dropdown-divider"></div>

        </ul>
    </div>
</aside>

<!-- START BODY CONTENT  -->

<div id="content" style="margin-left:240px;">
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;">
        <div class="inside-page" style="padding:20px">
            <div class="page_title_top" style="margin-bottom: 1.5rem!important;">
                <h1 style="color: #5a5c69!important;font-size: 1.75rem;font-weight: 400;line-height: 1.2;">
                    <?php echo $pageTitle; ?>
                </h1>
            </div>