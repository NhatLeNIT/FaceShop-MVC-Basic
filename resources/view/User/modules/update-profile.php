<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 29-May-17
 * Time: 16:25
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
                    <li class="active">Cập nhật thông tin tài khoản</li>
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
                                <li class="active"><a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> Cập nhật tài khoản </a></li>
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
                            <span class="caption-subject font-blue-madison bold uppercase"><span style="font-weight: bold; text-transform: uppercase">Thông Tin Tài Khoản</span>
                        </div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1_1" data-toggle="tab">Thông Tin Cá Nhân</a></li>
                        </ul>
                    </div>
                    <div class="portlet-body">
                        <div class="tab-content">
                            <!-- PERSONAL INFO TAB -->
                            <div class="tab-pane active" id="tab_1_1">
                                <form action="?c=user&a=processUpdate" method="POST" id="form-input" data-parsley-validate class="form-horizontal">
                                    <input type="hidden" name="id" value="<?= $data['0']['id'] ?>">
                                    <div class="form-group <?php if(isset($email)) echo 'has-error'?>">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtEmail">Email
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input readonly type="text" id="txtEmail" name="txtEmail"  class="form-control col-md-7 col-xs-12" value="<?php echo $data[0]['email'];?>">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtName">Họ tên <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12 <?php if(isset($name)) echo 'has-error'?>">
                                            <input type="text" id="txtName" name="txtName" required="required" class="form-control col-md-7 col-xs-12" value="<?php if(isset($name_old)) echo $name_old; else echo $data[0]['name'];?>">
                                            <?php if(isset($name)) { ?>
                                                <span class="help-block"><strong> <?php echo $name?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtPhone" class="control-label col-md-3 col-sm-3 col-xs-12">Số điện thoại <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12 <?php if(isset($phone)) echo 'has-error'?>">
                                            <input id="txtPhone" class="form-control col-md-7 col-xs-12" type="text" name="txtPhone" value="<?php if(isset($phone_old)) echo $phone_old; else echo $data[0]['mobile'];?>">
                                            <?php if(isset($phone)) { ?>
                                                <span class="help-block"><strong> <?php echo $phone?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtAddress" class="control-label col-md-3 col-sm-3 col-xs-12">Địa chỉ <span class="required">*</span></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12 <?php if(isset($address)) echo 'has-error'?>">
                                            <input id="txtAddress" class="form-control col-md-7 col-xs-12" type="text" name="txtAddress" value="<?php if(isset($address_old)) echo $address_old; else echo $data[0]['address'];?>">
                                            <?php if(isset($address)) { ?>
                                                <span class="help-block"><strong> <?php echo $address?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtBirthday" class="control-label col-md-3 col-sm-3 col-xs-3">Ngày sinh</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12 <?php if(isset($dob)) echo 'has-error'?>">
                                            <input id="txtBirthday" type="text" name="txtBirthday" class="date-picker form-control" data-inputmask="'mask': '99/99/9999'"  value="<?php if(isset($dob_old)) echo $dob_old; else echo date('d/m/Y', strtotime($data[0]['dob']));?>">
                                            <?php if(isset($dob)) { ?>
                                                <span class="help-block"><strong> <?php echo $dob?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Giới tính</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <label style="margin-right: 10px"><input type="radio"  name="txtGender" id="genderM" value="1" checked="" required /> Nam</label>
                                            <label><input type="radio"  name="txtGender" id="genderF" value="0" <?php if(isset($gender_old) && $gender_old == 0) echo 'checked'; else if($data[0]['gender'] == 0) echo 'checked';?>/> Nữ</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPassword">Mật khẩu hiện tại <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 <?php if(isset($password)) echo 'has-error'?>">
                                            <input type="password" id="txtPassword" name="txtPassword" required="required" class="form-control col-md-7 col-xs-12" placeholder="Nhập mật khẩu hiện tại">
                                            <?php if(isset($password)) { ?>
                                                <span class="help-block"><strong> <?php echo $password?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtPasswordNew">Mật khẩu mới
                                        </label>
                                        <div class="col-md-9 <?php if(isset($newPassword)) echo 'has-error'?>">
                                            <input type="password" id="txtPasswordNew" name="txtPasswordNew" class="form-control col-md-7 col-xs-12" required placeholder="Nhập mật khẩu mới">
                                            <?php if(isset($newPassword)) { ?>
                                                <span class="help-block"><strong> <?php echo $newPassword?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="txtRePasswordNew">Nhập lại mật khẩu mới
                                        </label>
                                        <div class="col-md-9 <?php if(isset($reNewPassword)) echo 'has-error'?>">
                                            <input type="password" id="txtRePasswordNew" name="txtRePasswordNew" class="form-control col-md-7 col-xs-12" required placeholder="Nhập lại mật khẩu mới">
                                            <?php if(isset($reNewPassword)) { ?>
                                                <span class="help-block"><strong> <?php echo $reNewPassword?></strong></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="margiv-top-10 text-center">
                                        <input type="submit" class="btn btn-primary" value="Cập nhật">
                                        <input type="reset" class="btn default" value="Hủy">
                                    </div>
                                </form>
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
<script>
    $(document).ready(function() {
        var obj;
        $('.profile-usermenu li').mouseover(function () {
            obj = $('.profile-usermenu').find('.active');
            obj.removeClass('active');
        });
        $('.profile-usermenu li').mouseleave(function () {
            obj.addClass('active');
        })
    })
</script>
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
<!-- bootstrap-daterangepicker -->
<script>
    $(document).ready(function() {
        $('#txtBirthday').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            calender_style: "picker_4",
            locale: {
                format: 'DD/MM/YYYY',
                "fromLabel": "From",
                "toLabel": "To",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "CN",
                    "Hai",
                    "Ba",
                    "Tư",
                    "Năm",
                    "Sáu",
                    "Bảy"
                ],
                "monthNames": [
                    "Tháng 1",
                    "Tháng 2",
                    "Tháng 3",
                    "Tháng 4",
                    "Tháng 5",
                    "Tháng 6",
                    "Tháng 7",
                    "Tháng 8",
                    "Tháng 9",
                    "Tháng 10",
                    "Tháng 11",
                    "Tháng 12"
                ]
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<!-- /bootstrap-daterangepicker -->

<!-- Parsley -->
<script>
    $(document).ready(function() {
        $.listen('parsley:field:validate', function() {
            validateFront();
        });
        $('#form-input .btn').on('click', function() {
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
        $('#form-input-pass .btn').on('click', function() {
            $('#form-input').parsley().validate();
            validateFront();
        });
        var validateFront = function() {
            if (true === $('#form-input-pass').parsley().isValid()) {
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
