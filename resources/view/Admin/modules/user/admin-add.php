<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 27-May-17
 * Time: 09:28
 */
?>
<div class="page-title">
    <div class="title_left">
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-tachometer" aria-hidden="true"></i> <a href="?c=dashboard">Dashboard</a>
            </li>
            <li><a href="?c=user">Quản lý user</a></li>
            <li class="active">Thêm nhân viên mới</li>
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
                <form action="?c=user&a=addProcess" method="post" id="form-input" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtUsername">Tên tài khoản <span class="required">*</span>
                            </label>

                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($username)) echo 'has-error'?>">
                                <input type="text" name="txtUsername" id="txtUsername" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($username_old)) echo $username_old?>">
                                <?php if(isset($username)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $username?></span>
                                <?php } ?>
                            </div>
                            <div id="error-user"> </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPassword">Mật khẩu <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($password)) echo 'has-error'?>">
                                <input type="password" id="txtPassword" name="txtPassword" required="required" class="form-control col-md-7 col-xs-12">
                                <?php if(isset($password)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $password?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRePassword">Nhập lại mật khẩu <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($rePassword)) echo 'has-error'?>">
                                <input type="password" id="txtRePassword" name="txtRePassword" required="required" class="form-control col-md-7 col-xs-12">
                                <?php if(isset($rePassword)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $rePassword?></span>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Họ tên <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12 <?php if(isset($name)) echo 'has-error'?>">
                                <input type="text" id="txtName" name="txtName" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($name_old)) echo $name_old?>">
                                <?php if(isset($name)) { ?>
                                    <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $name?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="heard" class="control-label col-md-3 col-sm-3 col-xs-12">Quyền hạn</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="heard" class="form-control" name="txtPrivilege" required>
                                    <option value="1">Admin</option>
                                    <option value="2" <?php if(isset($privilege_old) && $privilege_old == 2) echo 'selected'?>>Mod</option>
                                </select>
                            </div>
                        </div>

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

<script>
    $(document).ready(function () {
        var userObj = $('#txtUsername');
        userObj.blur(function () {
           var username = $('#txtUsername').val();
           $.ajax({
               url : '?c=user&a=checkIssetUserByAjax',
               type : 'POST',
               cache : false,
               data : {'username' : username},
               success : function (result) {

                   if(result === 'true') {
                       $('#error-user').html('<div class="col-md-4 col-md-offset-3  has-error">\
                           <span class="help-block"><i class="fa fa-bell-o"></i> Tài khoản này đã tồn tại!</span>\
                           </div>');
                       $('#form-input .btn-success').attr('disabled', 'disabled');
                   }
               }
           });
       });

        userObj.keypress(function () {
            $('#error-user').html('');
            $('#form-input .btn-success').removeAttr('disabled');
        });
    });
</script>
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
