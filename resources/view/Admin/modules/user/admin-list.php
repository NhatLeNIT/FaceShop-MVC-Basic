<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 22:08
 */
?>

<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý user</a></li>
            <li class="active">Danh sách nhân viên</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Nhân Viên</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh đại diện</th>
                        <th>Username</th>
                        <th>Họ tên</th>
                        <th>Chức vụ</th>
                        <th width="20">Sửa</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($data as $item) { ?>
                    <tr>
                        <td><?= ++$position ?></td>
                        <td align="center" >
                            <img src="public/images/icons/avatar2.png" width="80px" height="80px" class="img-responsive">
                        </td>
                        <td><?= $item['username']?></td>
                        <td><?= $item["name"] ?></td>
                        <td class="text-center">
                            <?php if($item["privilege"] == 1 && $item["id"] == 1) { ?>
                            <span class="label label-danger" style="font-weight: bold; font-size: 13px;">SuperAdmin</span>
                             <?php } elseif ($item["privilege"] == 1) { ?>
                            <span class="label label-primary" style="font-weight: bold; font-size: 13px;">Admin</span>
                            <?php } elseif ($item["privilege"] == 2) { ?>
                            <span class="label label-success" style="font-weight: bold; font-size: 13px;">Mod</span>
                            <?php } ?>
                        </td>
                        <td align="center"><a href="?c=user&a=edit&id=<?php echo $item['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                        <td align="center"><a href="?c=user&a=del&id=<?php echo $item['id'] ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa nhân viên này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
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
