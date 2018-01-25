<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 09:24
 */
?>

<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="?c=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm mới</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm Sản Phẩm Mới</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="?c=product&a=editProcess" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <input type="hidden" name="code" value="<?php echo $data[0]['code'] ?>">
                    <div class="col-md-9">
                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtName">Tên sản phẩm <span class="required">*</span>
                            </label>
                            <div class="col-xs-10 <?php if(isset($name)) echo 'has-error'?>">
                                <input type="text" name="txtName" id="txtName" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($name_old)) echo $name_old; else echo $data[0]['name'];?>">
                                <?php if(isset($name)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $name?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtCode">Mã sản phẩm <span class="required">*</span>
                            </label>
                            <div class="col-xs-10 <?php if(isset($code)) echo 'has-error'?>">
                                <input type="text" id="txtCode" disabled name="txtCode" required="required" class="form-control col-md-7 col-xs-12"  value="<?php if(isset($code_old)) echo $code_old; else echo $data[0]['code'];?>">
                                <?php if(isset($code)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $code?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2"><span style="color:red">(*)</span> Mã sản phẩm phải nhỏ hơn hoặc bằng 10 ký tự</div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtPrice">Giá <span class="required">*</span>
                            </label>
                            <div class="col-xs-10 <?php if(isset($price)) echo 'has-error'?>">
                                <input type="number" id="txtPrice" name="txtPrice" required="required" class="form-control col-md-7 col-xs-12"  value="<?php if(isset($price_old)) echo $price_old; else echo $data[0]['price'];?>">
                                <?php if(isset($price)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $price?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtDescription">Mô tả tóm tắt
                            </label>
                            <div class="col-xs-10 <?php if(isset($description)) echo 'has-error'?>">
                                <textarea class="form-control" name="txtDescription" id="txtDescription" rows="8"><?php if(isset($description_old)) echo $description_old; else echo $data[0]['desc'];?></textarea>
                                <?php if(isset($description)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $description?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtContent">Thông tin sản phẩm <span class="required">*</span>
                            </label>
                            <div class="col-xs-10 <?php if(isset($content)) echo 'has-error'?>">
                                <textarea required class="form-control" name="txtContent" id="txtContent"><?php if(isset($content_old)) echo $content_old; else echo $data[0]['detail'];?></textarea>
                                <?php if(isset($content)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $content?></span>
                                <?php } ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-2" for="txtStatus">Trạng thái</label>
                            <div class="col-xs-10">
                                <label><input type="checkbox" name="txtStatus" id="txtStatus" value="1" class="flat" <?php if(isset($status_old) && $status_old == 1) echo 'checked'; else if($data[0]['status'] == 1) echo 'checked';?> /> <button type="button" class="btn btn-info">Còn hàng</button> </label>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="txtCategory" class="control-label col-md-2">Loại sản phẩm</label>
                            <div class="col-md-10 <?php if(isset($image)) echo 'has-error'?>">
                                <select id="txtCategory" class="form-control" name="txtCategory" required>
                                    <option value="">Chọn loại sản phẩm</option>
                                    <?php foreach ($cateList as $item) { ?>
                                        <optgroup label="<?= $item['name']?>">
                                            <?php $cateObj = new CategoryModel();
                                            $dataCateChild = $cateObj->getListCateById($item['id']);
                                            foreach ($dataCateChild as $itemChild) {
                                                ?>
                                                <option value="<?= $itemChild['id']?>" <?php if(isset($category_old) && $category_old == $itemChild['id']) echo 'selected'; else  if($data[0]['id_cate'] == $itemChild['id']) echo 'selected';?>><?= $itemChild['name']?></option>
                                            <?php } ?>
                                        </optgroup>

                                    <?php } ?>
                                </select>
                                <?php if(isset($category)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $category?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="text-center"><b>Hình hiện tại</b></div>
                                <div id="list-image">
                                        <img src="public/images/uploads/products/<?= $data[0]['image']?>" class="img-responsive" id="image" alt="">
                                        <input type="hidden" name="txtImageCurrent" value="<?= $data[0]['image']?>">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtImage" class="control-label col-md-2">Hình sản phẩm</label>
                            <div class="col-md-10  <?php if(isset($image)) echo 'has-error'?>">
                                <input id="txtImage" class="form-control col-md-7 col-xs-12" type="file" name="txtImage">
                                <?php if(isset($image)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $image?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12"><span style="color:red">(*)</span> Định dạng của hình ảnh phải là jpg, jpeg, png</div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <div class="preview-area"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 text-center">
                            <button type="reset" class="btn btn-warning">Hủy</button>
                            <button type="submit" class="btn btn-success">Đồng ý</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- iCheck -->
<link href="public/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!--{{--CKEditor & CKFinder--}}-->
<script type="text/javascript" src="public/vendors/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="public/vendors/ckfinder/ckfinder.js"></script>
<script>
    var baseURL = "{!! url('/') !!}";
</script>

<script type="text/javascript" src="public/vendors/func_ckfinder.js"></script>
<!-- My script -->
<script src="public/js/myscript.js"></script>
<!-- Parsley -->
<script src="public/vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- iCheck -->
<script src="public/vendors/iCheck/icheck.min.js"></script>
<!-- jQuery Tags Input -->
<script src="public/vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>

<?php if(isset($error_msg)) {?>
    <script type="text/javascript">
        $(document).ready(function () {
            sweetAlert("Oops...", "<?php echo $error_msg?>", "error");
        });
    </script>
<?php }
?>

<script>
    ckeditor ("txtContent");
    $(document).ready(function () {
        $('div.has-error').each(function() {
            $(this).find('input').change(function () {
                $(this).closest('div').removeClass('has-error').addClass('has-success');
                $(this).parent().find(".help-block").css("display", "none");
            });
            $(this).find('select').change(function () {
                $(this).closest('div').removeClass('has-error').addClass('has-success');
                $(this).parent().find(".help-block").css("display", "none");
            });
        });
    });
</script>
<!-- Parsley -->
<script>
    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#form-input .btn[type="submit"]').on('click', function() {
            $('#form-input').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#form-input').parsley().isValid()) {
                $('.bs-callout-info').removeClass('hidden');
                $('.bs-callout-warning').addClass('hidden');
            } else {
                $('.bs-callout-info').addClass('hidden');
                $('.bs-callout-warning').removeClass('hidden');
            }
        };
    });
    try {
        hljs.initHighlightingOnLoad();
    } catch (err) {}
</script>
<!-- /Parsley -->
<!--{{--Preview for multiple images selected in file uploaded--}}-->
<script>
    var inputLocalFont = document.getElementById("txtImage");
    inputLocalFont.addEventListener("change",previewImages,false);

    function previewImages(){
        var fileList = this.files;

        var anyWindow = window.URL || window.webkitURL;

        for(var i = 0; i < fileList.length; i++){
            var objectUrl = anyWindow.createObjectURL(fileList[i]);
            $('.preview-area').append('<img class="img-responsive center-block" src="' + objectUrl + '" />');
            window.URL.revokeObjectURL(fileList[i]);
        }
    }
</script>