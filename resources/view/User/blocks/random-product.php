<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 08:28
 */
?>
<div class="features-area" style="margin-top: 28px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-center">
                    <h2>Sản phẩm nổi bật</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="product-curosel">
                <?php foreach($dataRandom as $item) { ?>
                <!-- single-product start -->
                <div class="col-lg-12">
                    <div class="single-product">
                        <div class="product-img">
                            <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                <img class="primary-image" src="public/images/uploads/products/<?=$item['image']?>" alt="<?=$item['name'] ?>" />
                            </a>
                            <div class="product-action">
                                <div class="pro-button-top">
                                    <a href="?c=product&a=detail&code=<?= $item['code']?>"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                    <a href="?c=cart&a=add&code=<?= $item['code']?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                </div>
                            </div>
                        </div>
                        <div class="product-info">
                            <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?=$item['name']?></a></h3>
                            <div class="pro-price text-center">
                                <span class="normal">
                                       <?=number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single-product end -->
                <?php } ?>
            </div>
        </div>
    </div>
</div>
