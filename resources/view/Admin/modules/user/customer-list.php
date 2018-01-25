<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 13:58
 */
?>

<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý user</a></li>
            <li class="active">Danh sách khách hàng</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Khách Hàng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Email</th>
                        <th>Họ tên</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th width="20">Sửa</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($data as $item) { ?>
                        <tr>
                            <td><?= ++$position ?></td>
                            <td><?= $item['email']?></td>
                            <td><?= $item['name']?></td>
                            <td><?= $item["address"] ?></td>
                            <td><?= $item["mobile"] ?></td>
                            <td><?= date('d-m-Y', strtotime($item["dob"])) ?></td>
                            <td class="text-center">
                                <?php if($item["gender"] == 1) echo 'Nam'; else echo 'Nữ'; ?>
                            </td>
                            <td align="center"><a href="?c=user&a=edit&id=<?php echo $item['id'] ?>" class="btn btn-info btn-xs"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
                            <td align="center"><a href="?c=customer&a=del&id=<?php echo $item['id'] ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa khách hàng này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="text-center">
                    <?php  echo $paginate; ?>
                </div>
            </div>
        </div>
    </div>
</div>

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
