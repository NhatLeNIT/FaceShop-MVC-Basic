<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 30-May-17
 * Time: 10:26
 */
?>
<?php
if(isset($_GET['price_from']))
    $price_from = $_GET['price_from'];
else
    $price_from = '';
if(isset($_GET['price_to']))
    $price_to = $_GET['price_to'];
else
    $price_to = '';
if(isset($_GET['sort']))
    $sort = $_GET['sort'];
else
    $sort = 1;
?>
<div id="breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ol class="breadcrumb">
                    <li>
                        <a href="/"><i class="fa fa-home" aria-hidden="true"></i> Trang chủ</a>
                    </li>
                    <?php if($cateNameParent != '') { ?>
                        <li>
                            <a href="?c=product&a=getListProduct&id=<?= $cateNameParent[0]['id'] ?>"> <?= $cateNameParent[0]['name'] ?></a>
                        </li>
                    <?php } ?>
                    <li class="active"><?= $cateName ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- shop-area start -->
<div class="shop-area">
    <div class="container">
        <div class="row">
            <!-- left-sidebar start -->
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <!-- widget-categories start -->
                <aside class="widget widget-categories">
                    <h3 class="sidebar-title">Các Loại Tương Tự</h3>
                    <ul class="sidebar-menu">
                        <?php foreach($cateList as $item) { ?>
                            <li><a href="?c=product&a=getListProduct&id=<?= $item['id'] ?>"><?= $item['name'] ?></a></li>
                        <?php } ?>
                    </ul>
                </aside>
                <!-- widget-categories end -->
                <!-- shop-filter start -->
                <aside class="widget shop-filter">
                    <h3 class="sidebar-title">Tìm kiếm theo giá</h3>
                    <div class="info_widget">
                        <div class="price_filter">
                            <form action="?c=product&a=getListProduct&id=1" method="get">
                                <input type="hidden" name="c" value="product">
                                <input type="hidden" name="a" value="getListProduct">
                                <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                <div id="slider-range">
                                    <input type="text" name="price_from" value="<?= $price_from ?>" placeholder="Giá từ" />
                                    <input type="text" name="price_to" value="<?= $price_to ?>" placeholder="Giá đến" />
                                </div>
                                <div class="price_slider_amount center-block">
                                    <input type="submit"  value="Lọc"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </aside>
                <!-- shop-filter end -->

            </div>
            <!-- left-sidebar end -->
            <!-- shop-content start -->
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <div class="shop-content">
                    <!-- Nav tabs -->
                    <ul class="shop-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#active" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th"></i></a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-list"></i></a></li>
                    </ul>
                    <div class="show-result">
                        <p> Hiển thị <?= $position ?> đến <?= $lastItem ?> của <?= $totalRow ?> sản phẩm</p>
                    </div>
                    <div class="toolbar-form">
                        <form action="" method="get">
                            <?php if($price_from != '' || $price_to != '') { ?>
                                <input type="hidden" name="price_from" value="<?= $price_from ?>" placeholder="Giá từ" />
                                <input type="hidden" name="price_to" value="<?= $price_to ?>" placeholder="Giá đến" />

                            <?php } ?>

                            <input type="hidden" name="c" value="product">
                            <input type="hidden" name="a" value="getListProduct">
                            <input type="hidden" name="id" value="<?=$_GET['id']?>">

                            <div class="tolbar-select">
                                <select name="sort" onchange="this.form.submit()">
                                    <option value="1" <?php if($sort == 1) echo 'selected' ?>>Sắp xếp theo sản phẩm mới nhất</option>
                                    <option value="2" <?php if($sort == 2) echo 'selected' ?>>Sắp xếp theo sản phẩm xem nhiều nhất</option>
                                    <option value="3" <?php if($sort == 3) echo 'selected' ?>>Sắp xếp theo sản phẩm bán nhiều nhất</option>
                                    <option value="4" <?php if($sort == 4) echo 'selected' ?>>Sắp xếp theo giá cao đến thấp</option>
                                    <option value="5" <?php if($sort == 5) echo 'selected' ?>>Sắp xếp theo giá thấp đến cao</option>
                                </select>
                            </div>

                        </form>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="active">
                            <div class="row">

                                <?php
                                if(empty($data)) echo "Không có sản phẩm nào để hiển thị";
                                foreach($data as $item) { ?>
                                    <!-- single-product start -->
                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                                    <img class="primary-image" src="public/images/uploads/products/<?=$item['image']?>" alt="<?=$item['name'] ?>" />
                                                </a>
                                                <?php if($item['status'] != 1) {?>
                                                    <span class="sale">Hết hàng</span>
                                                <?php } ?>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="?c=product&a=detail&code=<?= $item['code']?>"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                                        <a href="?c=cart&a=add&code=<?= $item['code']?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="product-info">
                                                <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?=$item['name'] ?></a></h3>
                                                <div class="pro-price text-center">
                                                <span class="normal">
                                                  <?= number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                <?php } ?>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="row shop-list">
                                <?php foreach($data as $item) { ?>
                                    <!-- single-product start -->
                                    <div class="col-md-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="?c=product&a=detail&code=<?= $item['code']?>">
                                                    <img class="primary-image" src="public/images/uploads/products/<?=$item['image']?>" alt="<?=$item['name']?>" />
                                                </a>
                                                <?php if($item['status'] != 1) {?>
                                                    <span class="sale">Hết hàng</span>
                                                <?php } ?>
                                            </div>
                                            <div class="product-info">
                                                <h3><a href="?c=product&a=detail&code=<?= $item['code']?>"><?=$item['name']?></a></h3>
                                                <div class="pro-price">
                                                   <span class="normal">
                                                          <?= number_format($item['price'], 0, ',', '.')?><sup>đ</sup>
                                                        </span>
                                                </div>
                                                <div class="product-desc">

                                                    <p><?=strip_tags(cutString($item['desc'], 300))?></p>
                                                </div>
                                                <div class="product-action">
                                                    <div class="pro-button-top">
                                                        <a href="?c=product&a=detail&code=<?= $item['code']?>"><i class="fa fa-eye" aria-hidden="true"></i> Xem</a>
                                                        <a href="?c=cart&a=add&code=<?= $item['code']?>"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Mua</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product end -->
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <div class="shop-pagination text-center">
                        <?= $paginate?>
                    </div>
                </div>
                <!-- shop-content end -->
            </div>
        </div>
    </div>
</div>
<!-- shop-area end -->
