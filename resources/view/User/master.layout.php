<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:11
 */
?>
<!doctype html>
<html class="no-js" lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php if(isset($title)) echo $title ?></title>
    <meta name="description" content="<?php if(isset($description)) echo $description ?>">
    <meta name="keyword" content="<?php if(isset($keyword)) echo $keyword ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link href="public/images/icons/favicon.ico" rel="shortcut icon" >
    <!-- all css here -->
    <!-- Bootstrap -->
    <link href="public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animate css -->
    <link rel="stylesheet" href="public/css/animate.css">
    <!-- jquery-ui.min css -->
    <link rel="stylesheet" href="public/css/jquery-ui.min.css">
    <!-- meanmenu css -->
    <link rel="stylesheet" href="public/css/meanmenu.min.css">
    <!-- RS slider css -->
    <link rel="stylesheet" type="text/css" href="public/lib/rs-plugin/css/settings.css" media="screen" />
    <!-- owl.carousel css -->
    <link rel="stylesheet" href="public/css/owl.carousel.css">
    <!-- Font Awesome -->
    <link href="public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- style css -->
    <link rel="stylesheet" href="public/css/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="public/css/responsive.css">
    <!-- modernizr css -->
    <script src="public/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- SweetAlert -->
    <link href="public/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
    <!-- jquery latest version -->
    <script src="public/js/vendor/jquery-1.12.0.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
    <!-- Add your site or application content here -->

    <header>
    <?php
//    <!-- header-top-area start -->
    include 'resources/view/User/blocks/header-top.php';
//    <!-- header-top-area end -->
//    <!-- header-bottom-area start -->
    include 'resources/view/User/blocks/header-bottom.php';
//    <!-- header-bottom-area end -->
//    <!-- main-menu-area start -->
    include 'resources/view/User/blocks/main-menu.php';
//    <!-- main-menu-area end -->
//    <!-- mobile-menu-area start -->
    include 'resources/view/User/blocks/mobile-menu.php';
//    <!-- mobile-menu-area end -->
    ?>
    </header>
    <?php
    include 'resources/view/'. $path .'/' . $view . '.php';
    ?>
    <!-- service-area start -->
    <?php include 'resources/view/User/blocks/service.php'; ?>
    <!-- service-area end -->
    <!-- footer start -->
    <footer>
        <?php
//    <!-- footer-top-area start -->
    include 'resources/view/User/blocks/footer-top.php';
//    <!-- footer-top-area end -->
//    <!-- footer-bottom-area start -->
    include 'resources/view/User/blocks/footer-bottom.php';
//    <!-- footer-bottom-area end -->
?>
    </footer>
    <!-- footer end -->

    <!-- all js here -->

    <!-- Bootstrap -->
    <script src="public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- owl.carousel js -->
    <script src="public/js/owl.carousel.min.js"></script>
    <!-- jquery-ui js -->
    <script src="public/js/jquery-ui.min.js"></script>
    <!-- RS-Plugin JS -->
    <script type="text/javascript" src="public/lib/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="public/lib/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
    <script src="public/lib/rs-plugin/rs.home.js"></script>
    <!-- meanmenu js -->
    <script src="public/js/jquery.meanmenu.js"></script>
    <!-- wow js -->
    <script src="public/js/wow.min.js"></script>
    <!-- plugins js -->
    <script src="public/js/plugins.js"></script>
    <!-- main js -->
    <script src="public/js/main.js"></script>
    <!-- Sweet alert-->
    <script src="public/vendors/sweetalert2/sweetalert2.min.js"></script>

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
    </body>
</html>
