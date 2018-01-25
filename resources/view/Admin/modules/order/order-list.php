<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 03:16
 */
?>
<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý đơn hàng</a></li>
            <li class="active">Danh sách đơn hàng</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Đơn Hàng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table id="datatable-responsive" class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Mã đơn hàng</th>
                        <th>Họ tên</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Ngày đặt</th>
                        <th width="40">Tình Trạng</th>
                        <th width="20">Chi tiết</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0;?>
                    <?php foreach($data as $item) { ?>
                    <tr>
                        <td><?=++$i?></td>
                        <td><?=$item["id"]?></td>
                        <td> <?=$item["name"] ?> </td>
                        <td> <?= $item["mobile"] ?> </td>
                        <td> <?=$item["address"] ?> </td>
                        <td> <?=date('d-m-Y H:i:s', strtotime($item["datetime"])) ?> </td>
                        <td>
                            <?php $status = [ -1 => 'Đã hủy', 0 => 'Mới đặt', 1 => 'Đã xác nhận', 2 => 'Đang giao', 3 => 'Đã giao', 5 => 'Đã thanh toán']?>
                            <?= $status[$item['status']]?>
                        </td>
                        <td align="center"><a href="?c=order&a=detail&id=<?= $item['id']?>" class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></a></td>

                        <td align="center"><a href="?c=order&a=delete&id=<?= $item['id']?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa đơn hàng này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>

                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
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