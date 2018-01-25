<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 13:45
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
                    <li>
                        <a href="?c=product&a=getListProduct&id=<?= $cate[0]['id'] ?>"><?= $cate[0]['name'] ?></a>
                    </li>
                    <li class="active"><?= $data[0]['name']?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area start -->
<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <div class="single-pro-tab-content">
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div role="tabpanel" class="tab-pane active" id="image"><a href="#"><img src="public/images/uploads/products/<?= $data[0]['image']?>" alt="<?= $data[0]['name']?>" /></a></div>

                            </div>
                            <!-- Nav tabs -->
                        </div>
                    </div>
                    <div class="col-md-7 col-sm-7 col-xs-12 shop-list">
                        <div class="product-info">
                            <h3><a href="#"><?= $data[0]['name']?></a></h3>
                            <div class="pro-price">
                                    <span class="normal">
                                        <?=number_format($data[0 ]['price'], 0, ',', '.') ?><sup>đ</sup>
                                    </span>
                            </div>
                            <div style="margin-top: 5px">Tình trạng: <?php if($data[0]['status'] == 1) echo 'Còn hàng'; else 'Hết hàng'?></div>
                            <div class="product-action">
                                <form action="?c=cart&a=add&code=<?= $data[0]['code']?>" method="post">
                                <div class="cart-plus-minus">
                                    <p>
                                        <label for="txtQuantity">Số lượng: </label>
                                        <input id="txtQuantity" name="qty" type="text" value="1"/>
                                    </p>
                                </div>
                                <button <?php if($data[0]['status'] == 0) echo 'disabled'?> type="submit"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Mua ngay</button>
                                </form>
                                <div class="clearfix"></div>
                                <div class="desc"><?= $data[0]['desc'] ?></div>
                            </div>
                            <div class="widget-icon"> <b>Chia sẻ:
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                </b>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="product-tabs">
                            <div>
                                <!-- Nav tabs -->
                                <ul class="pro-details-tab" role="tablist">
                                    <li role="presentation" class="active"><a href="#tab-desc" aria-controls="tab-desc" role="tab" data-toggle="tab">Mô tả sản phẩm</a></li>
                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="tab-desc">
                                        <div class="product-tab-desc">
                                            <?= $data[0]['detail'] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- right-sidebar start -->
            <div class="col-lg-3 col-md-3">
                <div id="intro-area">
                    <h3>Shop thời trang</h3>
                    <div class="intro-border">
                        <a href="{!! route('getHDMH') !!}" target="_blank">Hướng dẫn mua hàng</a>
                        <ul class="info-service">
                            <li><span>1</span> Giao hàng TOÀN QUỐC</li>
                            <li><span>2</span> Thanh toán khi nhận hàng</li>
                            <li><span>3</span> Đổi trả trong 15 ngày</li>
                            <li><span>4</span> Chất lượng đảm bảo</li>
                            <li><span>5</span> Hàng luôn sẵn có </li>
                            <li><span>6</span> MIỄN PHÍ vận chuyển:</li>
                            <li style="padding-left:30px;">» Đơn hàng trên 500.0000 đồng</li>
                        </ul>
                    </div>
                </div>
                <div class="margin-top-20"></div>
                <!-- recent start -->
                <aside class="widget widget-categories margin-top-20">
                    <h3 class="sidebar-title">Có thể bạn quan tâm</h3>
                    <div class="widget-curosel">
                        <?php foreach($dataRandom as $item) { ?>
                        <!-- single-product start -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                    <img class="primary-img" src="public/images/uploads/products/<?=$item['image']?>" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?=$item['name'] ?></a></h3>
                                <div class="pro-price">
                                        <span class="normal">
                                                <?=number_format($item['price'], 0, ',', '.')  ?><sup>đ</sup>
                                        </span>
                                </div>
                            </div>
                        </div>
                        <!-- single-product end -->
                       <?php } ?>
                    </div>
                </aside>
                <!-- recent end -->
            </div>
            <!-- right-sidebar end -->
        </div>
    </div>
</div>
<!-- single-product-area end -->

<!-- Parsley -->
<script src="public/vendors/parsleyjs/dist/parsley.min.js"></script>
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
});
try {
    hljs.initHighlightingOnLoad();
} catch (err) {}
</script>
<!-- /Parsley -->

