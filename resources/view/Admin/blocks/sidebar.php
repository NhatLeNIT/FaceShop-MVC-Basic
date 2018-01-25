<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 16:09
 */
?>
<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="?c=dashboard" class="site_title"><i class="fa fa-paw"></i> <span>FaceShop Admin!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="public/images/icons/avatar2.png" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Xin chào,</span>
                <h2><?php echo $_SESSION['name_admin']?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Menu Quản Lý</h3>
                <ul class="nav side-menu">
                    <li><a href="?c=dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a></li>
                    <?php if($_SESSION['privilege'] == 1) { ?>
                    <li><a><i class="fa fa-user-circle" aria-hidden="true"></i> Quản Lý User <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="?c=user&a=add"><i class="fa fa-user-plus" aria-hidden="true"></i> Thêm Nhân Viên</a></li>
                            <li><a href="?c=user"><i class="fa fa-user-secret" aria-hidden="true"></i> Danh Sách Nhân Viên</a></li>
                            <li><a href="?c=customer"><i class="fa fa-users" aria-hidden="true"></i> Danh Sách Khách Hàng</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li><a><i class="fa fa-align-justify" aria-hidden="true"></i> Quản Lý Danh Mục <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="?c=category&a=add"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Danh Mục Mới</a></li>
                            <li><a href="?c=category"><i class="fa fa-list-ul" aria-hidden="true"></i> Danh Sách Danh Mục</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-cube" aria-hidden="true"></i> Quản Lý Sản Phẩm <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="?c=product&a=add"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Sản Phẩm Mới</a></li>
                            <li><a href="?c=product"><i class="fa fa-cubes" aria-hidden="true"></i> Danh Sách Sản Phẩm</a></li>
                        </ul>
                    </li>
                    <li><a href="?c=order"><i class="fa fa-shopping-bag"></i> Quản Lý Đơn Hàng</a></li>
<!--                    <li><a><i class="fa fa-cube" aria-hidden="true"></i> Quản Lý KV Giao Hàng <span class="fa fa-chevron-down"></span></a>-->
<!--                        <ul class="nav child_menu">-->
<!--                            <li><a href="?c=product&a=add"><i class="fa fa-plus-circle" aria-hidden="true"></i> Thêm Sản Phẩm Mới</a></li>-->
<!--                            <li><a href="?c=product"><i class="fa fa-cubes" aria-hidden="true"></i> Danh Sách Sản Phẩm</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
