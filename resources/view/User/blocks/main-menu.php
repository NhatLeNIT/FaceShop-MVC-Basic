<?php
/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 28-May-17
 * Time: 18:12
 */
?>
<div class="main-menu-area bg-color hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="main-menu">
                    <nav>
                        <ul>
                            <li><a href="/">Trang chủ</a></li>
                            <?php foreach ($dataCate as $item) { ?>
                            <li><a href="?c=product&a=getListProduct&id=<?= $item['id'] ?>"><?= $item['name']?></a>
                                <ul>
                                    <?php
                                    $cateObj = new CategoryModel();
                                    $dataCateChild = $cateObj->getListCateById($item['id']);
                                    foreach ($dataCateChild as $itemChild) {
                                    ?>
                                    <li><a href="?c=product&a=getListProduct&id=<?= $itemChild['id'] ?>"><?= $itemChild['name'] ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
