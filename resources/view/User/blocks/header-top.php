<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 17:47
 */
?>
<div class="header-top-area bg-color hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-4">
                <div class="welcome">
                    <span class="phone">Phone: 0968403428</span> <span class="hidden-sm">/</span>
                    <span class="email hidden-sm">Email: admin@nhatle.net</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8">
                <div class="top-menu">
                    <?php if(!isset($_SESSION['id'])) { ?>
                    <ul>
                        <li><a href="?c=user&a=login"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Đăng nhập</a></li>
                        <li><a href="?c=user&a=register"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a></li>
                    </ul>
                    <?php } else { ?>
                    <ul id="language">
                        <li><a href="#">Xin chào <?= $_SESSION['name']?> <i class="fa fa-angle-down"></i></a>
                            <ul>
                                <li><a href="?c=user&a=profile&id=<?= $_SESSION['id']?>">Thông tin tài khoản</a></li>
                                <li>
                                    <a href="?c=user&a=logout"> <i class="fa fa-sign-out pull-right" style=""></i> Đăng xuất </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
