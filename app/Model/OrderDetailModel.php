<?php

/**
 * Created by PhpStorm.
 * User: NhatLe
 * Date: 31-May-17
 * Time: 01:16
 */
class OrderDetailModel extends N_Model
{
    public $id_order, $code_product, $qty, $price;
    public function __construct()
    {
        $this->connect();
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function getOrderDetail($id) {
        $sql = "SELECT `fs_order_detail`.price, `image`, `name`, `qty` FROM `fs_order_detail`, `fs_product` WHERE `id_order` = $id AND `fs_order_detail`.`code_product` = `fs_product`.`code`";
        $this->execute($sql);
        return $this->getResult();
    }
}