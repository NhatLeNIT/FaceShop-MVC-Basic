<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:07
 */
?>
<div class="header-bottom-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="logo">
                    <a href="/"><img src="public/images/icons/logo.png" alt="" /></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 hidden-xs">
                <div class="header-search">
                    <form action="" method="get">
                        <input type="hidden" name="c" value="product">
                        <input type="hidden" name="a" value="search">
                        <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="<?php if(isset($keyword)) echo $keyword ?>"/>
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 pad-left">
                <div class="total-cart">
                    <div class="cart-toggler">
                        <a href="#">
                            <span class="cart-title"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></span>
                            <span class="cart-quantity"><?= $cartCount ?> sản phẩm</span>
                        </a>
                        <a class="checkout" href="?c=cart&a=view">Xem</a>
                    </div>
                    <ul>
                        <?php foreach($cartContent as $item) { ?>
                        <li>
                            <div class="cart-img">
                                <a href="#"><img src="public/images/uploads/products/<?= $item['image']?>" alt="" /></a>
                                <span><?= $item['qty']?></span>
                            </div>
                            <div class="cart-info">
                                <h4><a href="#"><?= $item['name']?></a></h4>
                                <span><?=number_format($item['price'], 0, ",", ".")?> <span>x <?= $item['qty']?></span></span>
                            </div>

                        </li>
                 <?php } ?>
                        <li>
                            <div class="subtotal-text">Tổng cộng </div>
                            <div class="subtotal-price"><?= number_format($cartTotal, 0, '.', ',')?><sup>đ</sup></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
