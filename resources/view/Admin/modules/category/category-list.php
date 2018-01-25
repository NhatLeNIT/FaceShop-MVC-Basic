<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 15:16
 */
?>

<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý loại sản phẩm</a></li>
            <li class="active">Danh sách loại sản phẩm</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Loại Sản Phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="cate-list">
                <form action="" method="get" name="formCate" class="form-horizontal">
                    <input type="hidden" name="c" value="category">
                    <div class="form-group">
                        <label for="cate" class="col-md-2 control-label">Chọn loại cha: </label>
                        <div class="col-md-3">
                            <select name="cate" id="cate" class="form-control" onchange="document.formCate.submit()">
                                <option value="">Tất cả</option>
                                <?php foreach ($cateList as $item) { ?>
                                <option value="<?= $item['id']?>" <?php if(isset($_GET['cate']) && $_GET['cate'] == $item['id']) echo 'selected'?>><?= $item['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tên loại sản phẩm</th>
                        <th width="20">Sửa</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($data as $item) { ?>
                        <tr>
                            <td><?= ++$position ?></td>
                            <td><?= $item['name']?></td>
                            <td align="center"><a href="?c=category&a=edit&id=<?php echo $item['id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                            <td align="center"><a href="?c=category&a=del&id=<?php echo $item['id'] ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa khách hàng này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php }
                    if(empty($data)) { ?>
                        <tr>
                            <td colspan="12" align="center">Không có loại sản phẩm con nào để hiển thị</td>
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
