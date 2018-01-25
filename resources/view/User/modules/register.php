<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 19:14
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
                    <li class="active">Đăng ký</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- my-account-area start -->
<div class="my-account-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-md-offset-3">
                <form action="?c=user&a=processRegister" method="post" id="form-input">
                    <div class="form-fields">
                        <h2 class="text-center">Đăng ký</h2>
                        <div class="form-group <?php if(isset($email)) echo 'has-error'?>">
                            <p>
                                <label for="txtEmail">Email <span class="required">*</span></label>
                                <input id="txtEmail" name="txtEmail" type="email" placeholder="Nhập địa chỉ email" required  value="<?php if(isset($email_old)) echo $email_old?>"/>
                                <?php if(isset($email)) { ?>
                                    <span class="help-block"><strong> <?php echo $email?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="form-group <?php if(isset($password)) echo 'has-error'?>">
                            <p>
                                <label for="txtPassword">Mật khẩu <span class="required">*</span></label>
                                <input id="txtPassword" name="txtPassword" type="password" placeholder="Nhập mật khẩu của bạn" required/>
                                <?php if(isset($password)) { ?>
                                    <span class="help-block"><strong> <?php echo $password?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="form-group">
                            <p>
                                <label for="txtRePassword">Nhập lại mật khẩu <span class="required">*</span></label>
                                <input id="txtRePassword" type="password" name="txtRePassword" required placeholder="Nhập lại mật khẩu vừa nhập ở trên">
                            </p>
                        </div>
                        <div class="form-group <?php if(isset($name)) echo 'has-error'?>">
                            <p>
                                <label for="txtName">Họ tên <span class="required">*</span></label>
                                <input id="txtName" name="txtName" type="text" placeholder="Nhập tên của bạn" value="<?php if(isset($name_old)) echo $name_old?>" required/>
                                <?php if(isset($name)) { ?>
                                    <span class="help-block"><strong> <?php echo $name?></strong></span>
                                <?php } ?>
                            </p>
                        </div>

                        <div class="form-group <?php if(isset($phone)) echo 'has-error'?>">
                            <p>
                            <label for="txtPhone">Số điện thoại <span class="required">*</span></label>
                                <input placeholder="Nhập số điện thoại của bạn" required id="txtPhone" type="text" name="txtPhone" value="<?php if(isset($phone_old)) echo $phone_old?>" required>
                                <?php if(isset($phone)) { ?>
                                    <span class="help-block"><strong> <?php echo $phone?></strong></span>
                                <?php } ?>
                            </p>
                        </div>

                        <div class="form-group <?php if(isset($dob)) echo 'has-error'?>">
                            <p>
                            <label for="txtBirthday">Ngày sinh</label>
                                <input required id="txtBirthday" type="text" name="txtBirthday" class="date-picker" data-inputmask="'mask': '99/99/9999'"  value="<?php if(isset($dob_old)) echo $dob_old?>">
                                <?php if(isset($dob)) { ?>
                                    <span class="help-block"><strong> <?php echo $dob?></strong></span>
                                <?php } ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label style="margin-right: 20px;">Giới tính</label>
                            <label style="margin-right: 15px;"><input type="radio" class="flat" name="txtGender" id="genderM" value="1" checked required /> Nam</label>
                            <label><input type="radio" class="flat" name="txtGender" id="genderF" value="0" <?php if(isset($gender_old) && $gender_old == 0) echo 'checked'?>/> Nữ</label>

                        </div>

                        <div class="form-group <?php if(isset($address)) echo 'has-error'?>">
                            <p>
                            <label for="txtAddress" >Địa chỉ <span class="required">*</span></label>
                                <input required placeholder="Nhập địa chỉ của bạn" id="txtAddress"  type="text" name="txtAddress" value="<?php if(isset($address_old)) echo $address_old?>">
                                <?php if(isset($address)) { ?>
                                    <span class="help-block"><strong> <?php echo $address?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="form-group <?php if(isset($captcha)) echo 'has-error'?>">

                                <label for="txtAddress" >Captcha <span class="required">*</span></label>
                                <div class="g-recaptcha" data-sitekey="6LdiOSMUAAAAAMGzYd5BmjGHeOX6lCnWIImrr0Ea"></div>
                            <?php if(isset($captcha)) { ?>
                                <span class="help-block"><strong> <?php echo $captcha?></strong></span>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-action">
                        <p class="lost_password"><a href="?c=user&a=login">Bạn có tài khoản? Đăng nhập</a></p>
                        <input class="btn" type="submit" value="Đăng ký" />
                        <label><a href="?c=user&a=reset">Bạn quên mật khẩu?</a></label>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- my-account-area end -->


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
                format: 'DD-MM-YYYY',
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
<script src="public/vendors/parsleyjs/dist/parsley.min.js"></script>
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
