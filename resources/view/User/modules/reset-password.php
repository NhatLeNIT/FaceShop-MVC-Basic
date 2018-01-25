<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 29-May-17
 * Time: 13:05
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
                    <li class="active">Khôi phục mật khẩu</li>
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
                <form action="?c=user&a=processReset" method="post" id="form-input">
                    <div class="form-fields">
                        <h2>Khôi phục mật khẩu</h2>
                        <?php
                        if(isset($error)) include "resources/view/Error/error-message.php";
                        if(isset($success)) include "resources/view/Error/success-message.php";
                        ?>

                        <div class="form-group <?php if(isset($email)) echo 'has-error'?>">
                            <p>
                                <label for="txtEmail">Email <span class="required">*</span></label>
                                <input id="txtEmail" name="txtEmail" type="email" placeholder="Nhập địa chỉ email" required value="<?php if(isset($email_old)) echo $email_old?>" autofocus/>
                                <?php if(isset($email)) { ?>
                                    <span class="help-block"><strong> <?php echo $email?></strong></span>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <div class="form-action">
                        <p class="lost_password"><a href="?c=user&a=register">Bạn chưa có tài khoản, đăng ký?</a></p>
                        <input class="btn" type="submit" value="Đồng ý" />
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