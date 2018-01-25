<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 09:20
 */
?>
<div class="category-area pad-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="section-title">
                    <h2>Sản phẩm bán chạy</h2>
                </div>
                <div class="category-curosel">

                    <?php for($index = 1; $index <= 3; $index++) {

                    $nop = 3;
                    $pos = ($index - 1) * $nop;
                    $dataObj = new ProductModel();
                    $dataSold = $dataObj->getListProductSold($pos,$nop);
                    ?>
                    <div class="category-item">
                        <?php foreach($dataSold as $item) { ?>
                        <!-- single-product start -->
                        <div class="single-product">
                            <div class="product-img">
                                <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                    <img class="primary-img" src="public/images/uploads/products/<?=$item['image']?>" alt="<?= $item['name']?>" />
                                </a>
                            </div>
                            <div class="product-info">
                                <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?= $item['name']?></a></h3>
                                <div class="pro-price">
                                        <span class="normal">
                                                <?= number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                        </span>
                                </div>
                                <div class="product-action">
                                    <div class="pro-button-top">
                                        <a href="?c=product&a=detail&code=<?= $item['code']?>">Xem</a>
                                        <a href="?c=cart&a=add&code=<?= $item['code']?>">Mua</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- single-product end -->
                        <?php } ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div class="section-title">
                    <h2>Sản phẩm xem nhiều</h2>
                </div>

                <div class="category-curosel">
                    <?php for($index = 1; $index <= 3; $index++) {

                        $nop = 3;
                        $pos = ($index - 1) * $nop;
                        $dataSold = $dataObj->getListProductView($pos,$nop);
                        ?>
                        <div class="category-item">
                            <?php foreach($dataSold as $item) { ?>
                                <!-- single-product start -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                            <img class="primary-img" src="public/images/uploads/products/<?=$item['image']?>" alt="<?= $item['name']?>" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?= $item['name']?></a></h3>
                                        <div class="pro-price">
                                        <span class="normal">
                                                <?= number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                        </span>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="?c=product&a=detail&code=<?= $item['code']?>">Xem</a>
                                                <a href="?c=cart&a=add&code=<?= $item['code']?>">Mua</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product end -->
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 hidden-sm">
                <div class="section-title">
                    <h2>Có thể bạn quan tâm</h2>
                </div>
                <div class="category-curosel">

                    <?php for($index = 1; $index <= 3; $index++) {

                        $nop = 3;
                        $pos = ($index - 1) * $nop;
                        $dataSold = $dataObj->getListProductRandom($pos,$nop);
                        ?>
                        <div class="category-item">
                            <?php foreach($dataSold as $item) { ?>
                                <!-- single-product start -->
                                <div class="single-product">
                                    <div class="product-img">
                                        <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                            <img class="primary-img" src="public/images/uploads/products/<?=$item['image']?>" alt="<?= $item['name']?>" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?= $item['name']?></a></h3>
                                        <div class="pro-price">
                                        <span class="normal">
                                                <?= number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                        </span>
                                        </div>
                                        <div class="product-action">
                                            <div class="pro-button-top">
                                                <a href="?c=product&a=detail&code=<?= $item['code']?>">Xem</a>
                                                <a href="?c=cart&a=add&code=<?= $item['code']?>">Mua</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product end -->
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
