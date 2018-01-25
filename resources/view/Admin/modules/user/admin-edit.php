<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 12:17
 */
?>


<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="?c=user">Quản lý user</a></li>
            <li class="active">Cập nhật thông tin nhân viên</li>
        </ol>
    </div>
</div>
<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm Nhân Viên Mới</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form action="?c=user&a=editProcess" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data[0]['id'] ?>">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtUsername">Tên tài khoản <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($username)) echo 'has-error'?>">
                                <input type="text" name="txtUsername" id="txtUsername" required="required" disabled class="form-control col-md-7 col-xs-12" value="<?php if(isset($username_old)) echo $username_old; else echo $data[0]['username']; ?>">
                                <?php if(isset($username)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $username?></span>
                                <?php } ?>
                            </div>
                            <div id="error-user"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPassword">Mật khẩu mới <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($password)) echo 'has-error'?>">
                                <input type="password" id="txtPassword" name="txtPassword"  class="form-control col-md-7 col-xs-12">
                                <?php if(isset($password)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $password?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRePassword">Nhập lại mật khẩu <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($rePassword)) echo 'has-error'?>">
                                <input type="password" id="txtRePassword" name="txtRePassword" class="form-control col-md-7 col-xs-12">
                                <?php if(isset($rePassword)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $rePassword?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Họ tên <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($name)) echo 'has-error'?>">
                                <input type="text" id="txtName" name="txtName" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($name_old)) echo $name_old; else echo $data[0]['name'];?>">
                                <?php if(isset($name)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $name?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <?php if ($_SESSION['id_admin'] != $data[0]['id']) {?>
                        <div class="form-group">
                            <label for="heard" class="control-label col-md-3 col-sm-3 col-xs-12">Quyền hạn</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="heard" class="form-control" name="txtPrivilege" required>
                                    <option value="1">Admin</option>
                                    <option value="2" <?php if(isset($privilege_old) && $privilege_old == 2) echo 'selected'; else if($data[0]['privilege'] == 2) echo 'selected';?>>Mod</option>
                                </select>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="ln_solid"></div>
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

<?php if(isset($error_msg)) {?>
    <script type="text/javascript">
        $(document).ready(function () {
            sweetAlert("Oops...", "<?php echo $error_msg?>", "error");
        });
    </script>
<?php }
?>
<!-- My script -->
<script src="public/js/myscript.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="public/vendors/moment/min/moment.min.js"></script>
<script src="public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Parsley -->
<script src="public/vendors/parsleyjs/dist/parsley.min.js"></script>

<!-- jquery.inputmask -->
<script src="public/vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
<!-- jquery.inputmask -->
<script>
    $(document).ready(function() {
        $(":input").inputmask();
    });
</script>
<!-- /jquery.inputmask -->

<!-- Parsley -->
<script>
    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#form-input .btn-success').on('click', function() {
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
