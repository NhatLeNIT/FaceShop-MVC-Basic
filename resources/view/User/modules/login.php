<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 19:01
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
                    <li class="active">Đăng nhập</li>
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
                <form action="?c=user&a=processLogin" method="post" id="form-input">
                    <div class="form-fields">
                        <h2>Đăng nhập</h2>
                        <?php
                        if(isset($error)) include "resources/view/Error/error-message.php";
                        ?>
                        <div class="form-group <?php if(isset($email)) echo 'has-error'?>">
                            <p>
                                <label for="email">Email <span class="required">*</span></label>
                                <input id="email" name="email" type="email" placeholder="Nhập địa chỉ email" required value="<?php if(isset($email_old)) echo $email_old?>" autofocus/>
                                <?php if(isset($email)) { ?>
                                    <span class="help-block"><strong> <?php echo $email?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                        <div class="form-group <?php if(isset($password)) echo 'has-error'?>">
                            <p>
                                <label for="password">Mật khẩu <span class="required">*</span></label>
                                <input id="password" name="password" type="password" placeholder="Nhập mật khẩu của bạn" required/>
                                <?php if(isset($password)) { ?>
                                    <span class="help-block"><strong><?php echo $password?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-action">
                        <p class="lost_password"><a href="?c=user&a=register">Đăng ký tài khoản mới</a></p>
                        <input class="btn" type="submit" value="Đăng nhập" />
                        <label><a href="?c=user&a=reset">Bạn quên mật khẩu?</a></label>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- my-account-area end -->
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
<script>
    $(document).ready(function () {
        $('form').find('input').keyup(function () {
            $('form').find(".alert-danger").slideUp(500) ;
        });
    });
</script>
