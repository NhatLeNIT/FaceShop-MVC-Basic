<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 03:36
 */
?>
<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý đơn hàng</a></li>
            <li class="active">Đơn hàng chi tiết</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Đơn Hàng Chi Tiết</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h4 class="text-center">Chi Tiết Đơn Hàng</h4>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td><i class="fa fa-user-md fa-lg"></i> Khách Hàng</td>
                                <td><?=$dataOrder[0]['name']?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-commenting-o fa-lg" aria-hidden="true"></i> Số điện thoại </td>
                                <td><?=$dataOrder[0]['mobile']?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-credit-card fa-lg" aria-hidden="true"></i> Phương Thức Thanh Toán </td>
                                <td><?php if($dataOrder[0]['payment_type'] == 1) echo 'Thanh toán trực tiếp'; else echo 'Thanh toán qua Bảo Kim'?></td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-truck fa-lg" aria-hidden="true"></i> Phương Thức Giao Hàng </td>
                                <td>
                                    <?php $s = new ShippingModel();
                                    $dataShip = $s->getShipping($dataOrder[0]['id_shipping']);
                                    if($dataShip[0]['type'] == 1) echo 'Giao hàng qua bưu điện'; else echo 'Chuyển phát nhanh';
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-usd fa-lg" aria-hidden="true"></i> Trạng Thái </td>
                                <td>
                                    <?php $status = [ -1 => 'Đã hủy', 0 => 'Mới đặt', 1 => 'Đã xác nhận', 2 => 'Đang giao', 3 => 'Đã giao', 5 => 'Đã thanh toán']?>
                                    <?= $status[$dataOrder[0]['status']]?>
                                </td>
                            </tr>
                            <tr>
                                <td><i class="fa fa-ship" aria-hidden="true"></i> Cập nhật trạng thái đơn hàng:  </td>
                                <td>
                                    <form action="?c=order&a=update" method="post" class="text-center">
                                        <input type="hidden" name="id" id="" value="<?= $_GET['id']?>">
                                        <select name="status" id="" class="form-control">
                                            <option value="-1"> Hủy đơn hàng</option>
                                            <option value="0"> Mới đặt</option>
                                            <option value="1"> Đã xác nhận</option>
                                            <option value="2"> Đang giao</option>
                                            <option value="3"> Đã giao</option>
                                            <option value="5"> Đã thanh toán</option>
                                        </select>
                                        <input type="submit" name="" id="" value="Cập nhật" class="btn btn-primary" style="margin-top: 10px">
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình</th>
                            <th>Số Lượng Mua</th>
                            <th>Đơn Giá</th>
                            <th>Thành Tiền</th>
                        </tr>
                        <?php $sum = 0;?>
                        <?php foreach($dataOrderDetail as $item) { ?>
                        <tr>
                            <td><?=$item['name']?></td>
                            <td><img src="public/images/uploads/products/<?=$item['image']?>" width="80" alt=""></td>
                            <td><?=$item['qty']?></td>
                            <td><?=number_format($item['price'] , 0, ',', '.')?><sup>đ</sup></td>
                            <td><?=number_format($item['qty']*$item['price'], 0, ',', '.') ?><sup>đ</sup></td>
                            <?php $sum+= $item['qty']*$item['price']?>
                        </tr>
                       <?php } ?>
                        <tr>
                            <td align="right" class="text-success" colspan="6">
                                <b>Tổng tiền</b>
                            </td>
                            <td class="text-danger"><b>
                                    <?=number_format($sum, 0, ",", ".")?><sup>đ</sup>
                                </b></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-offset-6">
                    <button type="button" onclick="history.back();" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Quay Về</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Datatables -->
<link href="public/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="public/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">

<!-- Datatables -->
<script src="public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<!-- Datatables -->
<script>
    $(document).ready(function() {
        $('#datatable-responsive').DataTable();
    });
</script>
<!-- /Datatables -->
<!-- My script -->
<script src="public/js/myscript.js"></script>

