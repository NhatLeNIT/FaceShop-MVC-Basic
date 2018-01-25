<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 07:45
 */
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login | Admin </title>
    <base>
    <link href="public/images/icons/favicon.ico" rel="shortcut icon" >
    <!-- Bootstrap -->
    <link href="public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="public/vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="public/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="?c=login&a=check" method="post">
                    <h1>Đăng nhập</h1>
                    <?php
                        if(isset($error)) include "resources/view/Error/error-message.php";
                    ?>
                    <div class="<?php if(isset($username)) echo 'has-error'?>">
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" required="" value="<?php if(isset($username_old)) echo $username_old?>" autofocus/>
                        <?php if(isset($username)) { ?>
                        <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $username?></span>
                        <?php } ?>
                    </div>
                    <div class="<?php if(isset($password)) echo 'has-error'?>">
                        <input id="password" type="password" name="password" class="form-control" placeholder="Mật khẩu" required="" />
                        <?php if(isset($password)) { ?>
                        <span class="help-block"><i class="fa fa-bell-o"></i> <?php echo $password?></span>
                        <?php } ?>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit btn-primary"><i class="fa fa-paper-plane-o" aria-hidden="true"></i> Đăng nhập</button>

                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <div class="clearfix"></div>
                        <br />
                        <div>
                            <h1><i class="fa fa-paw"></i> FaceShop Control Panel!</h1>
                            <p>©2016 All Rights Reserved. NhatLe.Net</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!-- jQuery -->
<script src="public/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('div.has-error').each(function() {
            $(this).find('input').keyup(function () {
                $(this).closest('div').removeClass('has-error');
                $(this).parent().find(".help-block").slideUp(300);
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('form').find('input').keyup(function () {
            $('form').find(".alert-danger").slideUp(500) ;
        });
    });
</script>
</body>
</html>


