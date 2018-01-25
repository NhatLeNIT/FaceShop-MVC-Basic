<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 02:40
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
                    <li class="active">Chi tiết đơn hàng</li>
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
                                <?= $data['0']['name'] ?>
                            </div>

                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li><a href="?c=user&a=profile&id=<?= $data['0']['id'] ?>"> <i class="fa fa-home" aria-hidden="true"></i> Tổng quan </a></li>
                                <li class="active"><a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> Xem đơn hàng chi tiết </a></li>
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
                <!-- BEGIN PORTLET -->
                <div class="portlet light">
                    <div class="portlet-title tabbable-line">
                        <div class="caption caption-md">
                            <i class="icon-globe theme-font hide"></i>
                            <span class="caption-subject font-blue-madison bold uppercase"><span style="font-weight: bold; text-transform: uppercase">Thông Tin ĐƠn Hàng</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Đơn hàng chi tiết</a></li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Hình</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dataOrderDetail as $item) { ?>
                                    <tr>
                                        <td><?=$item['name']?></td>
                                        <td><img src="public/images/uploads/products/<?=$item['image']?>" class="img-responsive" alt="Image" width="80"></td>
                                        <td><?=number_format($item['price'], 0, ',', '.')?><sup>đ</sup></td>
                                        <td><?=$item['qty']?></td>
                                    </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                                <p>Người nhận: <?= $dataOrder[0]['name']?></p>
                                <p>SĐT: <?= $dataOrder[0]['mobile']?></p>
                                <p>Địa chỉ nhận: <?= $dataOrder[0]['address']?></p>
                                <?php $status = [ -1 => 'Đã hủy', 0 => 'Mới đặt', 1 => 'Đã xác nhận', 2 => 'Đang giao', 3 => 'Đã giao', 5 => 'Đã thanh toán']?>
                                <p>Trạng thái: <?= $status[$dataOrder[0]['status']]?></p>

                                <?php if($dataOrder[0]['status'] == 0) { ?>
                                <button class="btn btn-warning" onclick="cancelOrder()">Hủy đơn hàng</button>
                                <?php } ?>
                            </div>
                            <!-- END PERSONAL INFO TAB -->
                        </div>
                    </div>
                </div>
                <!-- END PORTLET -->
            </div>
            <!-- END PORTLET -->
            <!-- END PROFILE CONTENT -->
        </div>
    </div>
    <script>
        function cancelOrder() {
            if(confirm("Bạn có chắc muốn hủy đơn hàng này không?")){
                window.location.href = '?c=order&a=cancel&id=<?=$_GET['id']?>';
            }
        }
    </script>
    <?php if(isset($_SESSION['success_msg'])) {?>
        <script>
            $(document).ready(function () {
                swal("Thành Công!", "<?php echo $_SESSION['success_msg']?>", "success");
            });
        </script>
    <?php }
    unset($_SESSION['success_msg']);
    ?>
    <?php if(isset($_SESSION['error_msg'])) {?>
        <script type="text/javascript">
            $(document).ready(function () {
                sweetAlert("Oops...", "<?php echo $_SESSION['error_msg']?>", "error");
            });
        </script>
    <?php }
    unset($_SESSION['error_msg']);
    ?>
