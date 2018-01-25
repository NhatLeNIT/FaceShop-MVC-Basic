<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 22:12
 */
?>
<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="#">Quản lý sản phẩm</a></li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh Sách Sản Phẩm</h2>
                <div class="clearfix"></div>
            </div>
            <div class="cate-list">
                <form action="" method="get" name="formCate" class="form-horizontal">
                    <input type="hidden" name="c" value="product">
                    <div class="form-group">
                    <label for="cate" class="col-md-2 control-label">Chọn loại sản phẩm: </label>
                        <div class="col-md-3">
                            <select name="cate" id="cate" class="form-control" onchange="document.formCate.submit()">
                                <option value="">Tất cả</option>
                                <?php foreach ($cateList as $item) { ?>
                                    <optgroup label="<?= $item['name']?>">
                                        <?php $cateObj = new CategoryModel();
                                        $dataCateChild = $cateObj->getListCateById($item['id']);
                                        foreach ($dataCateChild as $itemChild) {
                                            ?>
                                            <option value="<?= $itemChild['id']?>" <?php if(isset($_GET['cate']) && $_GET['cate'] == $itemChild['id']) echo 'selected'?>><?= $itemChild['name']?></option>
                                        <?php } ?>
                                    </optgroup>

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
                        <th width="100">Mã SP</th>
                        <th width="250">Tên sản phẩm</th>
                        <th width="100">Hình</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th>Số lượt xem</th>
                        <th>Số lần bán</th>
                        <th width="20">Xem</th>
                        <th width="20">Sửa</th>
                        <th width="20">Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach($data as $item) { ?>
                        <tr>
                            <td><?= ++$position ?></td>
                            <td><?= $item['code']?></td>
                            <td><?= $item['name']?></td>
                            <td align="center"><img src="public/images/uploads/products/<?=$item['image']?>" width="80px" height="80px" class="img-responsive"></td>
                            <td><?= cutString($item['desc'], 200)?></td>
                            <td><?= number_format($item['price'],0, ',', '.')?><sup>đ</sup></td>
                            <td align="center">
                                <?php if($item['status'] == 1) { ?>
                                    <span class="label label-success" style="font-size: 13px;">Còn hàng</span>
                                <?php } else { ?>
                                    <span class="label label-warning" style="font-size: 13px;">Hết hàng</span>
                                <?php } ?>
                            </td>
                            <td><?= $item['view']?></td>
                            <td><?= $item['sold']?></td>
                            <td align="center"><a href="#" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a></td>
                            <td align="center"><a href="?c=product&a=edit&code=<?php echo $item['code'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i></a></td>
                            <td align="center"><a href="?c=product&a=del&code=<?php echo $item['code'] ?>" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa khách hàng này?')" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php }
                    if(empty($data)) { ?>
                    <tr>
                        <td colspan="12" align="center">Không có sản phẩm nào để hiển thị</td>
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
