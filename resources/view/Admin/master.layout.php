<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 26-May-17
 * Time: 16:28
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

    <title><?php if(isset($title)) echo $title;?> | Admin</title>
    <meta content="<?php if(isset($description)) echo $description; ?>" name="description">
    <meta content="<?php if(isset($keywords)) echo $keywords; ?>" name="keywords">
    <link href="public/images/icons/favicon.ico" rel="shortcut icon" >
    <!-- Bootstrap -->
    <link href="public/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="public/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="public/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="public/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- SweetAlert -->
    <link href="public/vendors/sweetalert2/sweetalert2.min.css" rel="stylesheet" >
    <!-- Custom Theme Style -->
    <link href="public/css/custom.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="public/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Sweet alert-->
    <script src="public/vendors/sweetalert2/sweetalert2.min.js"></script>

</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
//        menu start
        include 'resources/view/Admin/blocks/sidebar.php';
//        menu end
//        top navigation
        include 'resources/view/Admin/blocks/topbar.php';
//        top navigation
            ?>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="">
                <?php
                include 'resources/view/'. $path .'/' . $view . '.php';
                ?>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include 'resources/view/Admin/blocks/footer.php'; ?>
        <!-- /footer content -->
    </div>
</div>
<!-- Bootstrap -->
<script src="public/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="public/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="public/vendors/nprogress/nprogress.js"></script>

<!-- jQuery Sparklines -->
<script src="public/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- Flot -->
<script src="public/vendors/Flot/jquery.flot.js"></script>
<script src="public/vendors/Flot/jquery.flot.pie.js"></script>
<script src="public/vendors/Flot/jquery.flot.time.js"></script>
<script src="public/vendors/Flot/jquery.flot.stack.js"></script>
<script src="public/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="public/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="public/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="public/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="public/vendors/DateJS/build/date.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="public/vendors/moment/min/moment.min.js"></script>
<script src="public/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- Custom Theme Scripts -->
<script src="public/js/custom.min.js"></script>

</body>
</html>
