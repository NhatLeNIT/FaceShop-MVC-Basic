<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 29-May-17
 * Time: 16:13
 */
?>
<div id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                    </li>
                    <li class="active">Thông tin tài khoản</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- my-account-area start -->
<div class="my-account-area">
    <div class="container">
        <div class="row">
            <!-- BEGIN PROFILE SIDEBAR -->
            <div class="col-md-2 col-md-offset-1">
                <!-- BEGIN PROFILE SIDEBAR -->
                <div class="profile-sidebar" style="width: 300px;">
                    <!-- PORTLET MAIN -->
                    <div class="portlet light profile-sidebar-portlet">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="public/images/icons/avatar2.png" class="img-responsive" width="100%" alt="">
                        </div>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name text-center" style="font-weight: bold; font-size: 20px; color: #1F568B; margin-top: 10px">
                                <?= $data[0]['name']?>
                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="active"><a href="#"> <i class="fa fa-home" aria-hidden="true"></i> Tổng quan </a></li>
                                <li><a href="?c=user&a=update&id=<?= $data[0]['id'] ?>"> <i class="fa fa-cog" aria-hidden="true"></i> Cập nhật tài khoản </a></li>
<!--                                <li><a href="#action"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> {!! $order_count !!} đơn hàng  </a></li>-->
                            </ul>
                        </div>
                        <!-- END MENU -->
                    </div>
                    <!-- END PORTLET MAIN -->
                </div>
            </div>
            <!-- END PROFILE SIDEBAR -->
            <!-- BEGIN PROFILE CONTENT -->
            <div class="col-md-7 pull-right">

                <!-- Hiển thị thông tin cá nhân -->
                <div class="portlet light">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class=""><b>THÔNG TIN TÀI KHOẢN</b></span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <p style="font-size: 16px;">Họ Tên: <?= $data[0]['name']?></p>
                        <p style="font-size: 16px;">Số Điện Thoại: <?= $data[0]['mobile']?></p>
                        <p style="font-size: 16px;">Địa Chỉ:  <?= $data[0]['address']?></p>
                        <p style="font-size: 16px;">Giới tính:<?php if($data[0]['gender'] == 1) echo 'Nam'; else echo 'Nữ'?> </p>
                        <p style="font-size: 16px;">Ngày sinh: <?= date('d-m-Y', strtotime($data[0]['dob']))?></p>
                        <!-- END PERSONAL INFO TAB -->
                    </div>
                </div>
                <!-- end Hiển thị thông tin cá nhân -->
                <!-- BEGIN PORTLET -->
                <div class="portlet light" id="action">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class=""><b>HOẠT ĐỘNG</b></span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1_1" data-toggle="tab">Đơn hàng đã đặt</a>
                            </li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <!--BEGIN TABS-->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1_1">
                                <div class="scroller" style="height: 320px;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2">
                                    <ul class="feeds">
                                        <li>
                                            <div class="col1">
                                                <div class="cont">
                                                    <?php foreach($dataOrder as $item) { ?>
                                                    <div class="row order-list">
                                                        <div class="col-md-1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-shopping-bag"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-11">
                                                            <div class="desc">
                                                                <a href="?c=user&a=getOrderDetail&id=<?= $item['id'] ?>">
                                                                    <span style="margin-left: 10px; font-size: 16px;"> Đơn Hàng: <?= $item['id'] ?> - Ngày đặt: <?=date('d-m-Y', strtotime($item['datetime'])) ?> </span><br>
                                                                    <span style="margin-left: 10px;">
                                                                            <?php $status = [ -1 => 'Đã hủy', 0 => 'Mới đặt', 1 => 'Đã xác nhận', 2 => 'Đang giao', 3 => 'Đã giao', 5 => 'Đã thanh toán']?>
                                                                        Chi tiết:  tổng tiền: <?=number_format($item['total'], 0, ',', '.') ?> VNĐ - trạng thái: <?=$status[$item['status']]?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        <!--END TABS-->
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
            <!-- END PORTLET -->
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
</div>
<!-- my-account-area end -->


<!-- Parsley -->
<script src="public/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Parsley -->
<script>
$(document).ready(function() {
    var obj;
    $('.profile-usermenu li').mouseover(function () {
        obj = $('.profile-usermenu').find('.active');
        obj.removeClass('active');
    });
    $('.profile-usermenu li').mouseleave(function () {
        obj.addClass('active');
    })
})
</script>
<!-- /Parsley -->

